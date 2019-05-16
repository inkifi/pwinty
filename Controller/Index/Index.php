<?php
namespace Inkifi\Pwinty\Controller\Index;
use Df\Framework\W\Result\Text;
use Df\Sales\Model\Order as DFO;
use Inkifi\Pwinty\API\Entity\Shipment as pwShipment;
use Inkifi\Pwinty\Event;
use Magento\Sales\Model\Convert\Order as Converter;
use Magento\Sales\Model\Order as O;
use Magento\Sales\Model\Order\Item as OI;
use Magento\Sales\Model\Order\Shipment;
use Magento\Sales\Model\Order\Shipment\Item as SI;
use Magento\Sales\Model\Order\Shipment\Track;
use Magento\Shipping\Model\ShipmentNotifier;
use Mangoit\MediaclipHub\Model\Orders as mOrder;
/**
 * 2019-04-04 https://www.pwinty.com/api#callbacks
 * «Pwinty can make callbacks to a custom URL whenever the status of one of your orders changes.
 * Setup your callback URL under the Integrations section of the Dashboard.
 * Pwinty will make an JSON formatted HTTP POST to your chosen URL with the following parameters.»
 * @final Unable to use the PHP «final» keyword here because of the M2 code generation.
 */
class Index extends \Df\Framework\Action {
	/**
	 * 2019-04-04 https://www.pwinty.com/api/#callbacks
	 * @final Unable to use the PHP «final» keyword here because of the M2 code generation.
	 * @override
	 * @see \Magento\Framework\App\Action\Action::execute()
	 * @used-by \Magento\Framework\App\Action\Action::dispatch():
	 * 		$result = $this->execute();
	 * https://github.com/magento/magento2/blob/2.2.1/lib/internal/Magento/Framework/App/Action/Action.php#L84-L125
	 * @see \Mangoit\MediaclipHub\Controller\Index\OneflowResponse::execute()
	 * @return Text
	 */
	function execute() {
		/** @var Text $r */
		try {
			$e = Event::s(); /** @var Event $e */
			$orderId_Magento = $e->orderId_Magento(); /** @var int $orderId_Magento */
			$orderId_Pwinty = $e->orderId_Pwinty(); /** @var int $orderId_Pwinty */
			$orderId_Log = $orderId_Magento ?: "PW-$orderId_Pwinty";  /** @var int|string  $orderId_Log */
			if (!df_my_local()) {
				df_log_l($this, $e->a(), "$orderId_Log-{$e->status()}");
				df_sentry_extra($this, 'Event', $e->a());
				df_sentry($this, "$orderId_Log: {$e->status()}");
			}
			/**
			 * 2019-05-13
			 * Possible statuses: `NotYetSubmitted`, `Submitted`, `Complete`, or `Cancelled`.
			 * We create shipment documents only on the `Submitted` event.
			 * Pwinty will later send us the `Complete` event for the same items,
			 * and we should not create shipment documents again.
			 *
			 * 2019-05-14
			 * 1) $orderId_Magento is `0` if the order was added to Pwinty not via Magento (e.g., manually).
			 * 2) An example of such order:
			 * https://beta-dashboard.pwinty.com/orders/2086054/detail
			 * The Magento's Customer: Ortal Mendelawe
			 * https://inkifi.com/canvaspr_admin/customer/index/edit/id/79904
			 * The customer does not have assotiated orders in Magento.
			 * 3) We do not handle such orders because we are unable to create Magento shipping documents
			 * for non-existent Magento order documents.
			 */
			if ($orderId_Magento && $e->status_Submitted()) {
				foreach ($e->shipmentsShipped() as $sh) { /** @var pwShipment $sh */
					$mOrder = mOrder::byOId($orderId_Magento); /** @var $mOrder $mOrder */
					$o = $mOrder->o(); /** @var O|DFO $o */
					// 2019-05-16 https://log.mage2.pro/inkifi/pwinty/issues/179
					if (!$o->canShip()) {
						if (!df_my_local()) {
							df_sentry($this, "$orderId_Magento: not eligible for shipping", ['extra' => [
								'Order Flags' => [
									'canUnhold' => df_bts_yn($o->canUnhold())
									,'isPaymentReview' => df_bts_yn($o->isPaymentReview())
									,'getIsVirtual' => df_bts_yn($o->getIsVirtual())
									,'getActionFlag(O::ACTION_FLAG_SHIP)' =>
										df_bts_yn($o->getActionFlag(O::ACTION_FLAG_SHIP)())
								]
							]]);
						}
					}
					else {
						$mOrder->trackingNumberSet($sh->trackingNumber());
						$mOrder->trackingUrlSet($sh->trackingUrl());
						$mOrder->save();
						$converter = df_new_om(Converter::class); /** @var Converter $converter */
						$shipment = $converter->toShipment($o); /** @var Shipment $shipment */
						foreach ($o->getAllItems() as $oi) { /** @var OI $oi */
							if ($oi->getQtyToShip() && !$oi->getIsVirtual()) {
								$qtyShipped = $oi->getQtyToShip();
								$si = $converter->itemToShipmentItem($oi); /** @var SI $si */
								$si->setQty($qtyShipped);
								$shipment->addItem($si);
							}
						}
						$shipment->register();
						$o->setIsInProcess(true);
						$t = df_new_om(Track::class); /** @var Track $t */
						$t->setCarrierCode('Pwinty');
						$t->setDescription('Pwinty');
						$t->setNumber($sh->trackingNumber());
						$t->setTitle(ikf_pw_carrier($sh->trackingUrl()));
						$t->setUrl($sh->trackingUrl());
						$shipment->addTrack($t);
						$shipment->save();
						$o->save();
						df_new_om(ShipmentNotifier::class)->notify($shipment);
						$shipment->save();
						if (!df_my_local()) {
							df_sentry($this, "$orderId_Magento: a shipment is created", ['extra' => [
								'shipment' => $shipment->getIncrementId()
							]]);
						}
					}
				}
			}
			/**
			 * 2019-05-09
			 * «Pwinty will continue to try and make the callback
			 * until it receives an OK (200) Status code response from your server,
			 * or until the callback has failed 15 times.
			 * The time between each callback retry attempt will increase each time there is a failure.»
			 * https://www.pwinty.com/api#callbacks
			 */
			$r = Text::i('OK');
		}
		catch (\Exception $e) {
			df_response_code(500);
			$r = Text::i(df_ets($e));
			df_log($e, $this);
			if (df_my_local()) {
				throw $e; // 2016-03-27 It is convenient for me to the the exception on the screen.
			}
		}
		return $r;
	}
}