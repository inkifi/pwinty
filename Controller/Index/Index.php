<?php
namespace Inkifi\Pwinty\Controller\Index;
use Df\Framework\W\Result\Text;
use Df\Sales\Model\Order as DFO;
use Inkifi\Pwinty\API\Entity\Shipment as pwShipment;
use Inkifi\Pwinty\Event;
use Magento\Framework\Exception\LocalizedException as LE;
use Magento\Sales\Model\Convert\Order as Converter;
use Magento\Sales\Model\Order as O;
use Magento\Sales\Model\Order\Item as OI;
use Magento\Sales\Model\Order\Shipment;
use Magento\Sales\Model\Order\Shipment\Item as SI;
use Magento\Sales\Model\Order\Shipment\Track;
use Magento\Shipping\Model\ShipmentNotifier;
use Mangoit\MediaclipHub\Model\Orders as mOrder;
/**
 * 2019-04-04 https://www.pwinty.com/api/#callbacks
 * «Pwinty can make callbacks to a custom URL whenever the status of one of your orders changes.
 * Setup your callback URL under the Integrations section of the Dashboard.
 * Pwinty will make an JSON formatted HTTP POST to your chosen URL with the following parameters.»
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
	 * @return Text
	 */
	function execute() {
		$e = Event::s(); /** @var Event $e */
		foreach ($e->shipmentsShipped() as $sh) { /** @var pwShipment $sh */
			/**
			 * 2019-04-03
			 * The `pwinty_order_id` field is initialized by
			 * @see \Inkifi\Pwinty\AvailableForDownload::_p()
			 */
			$mOrder = mOrder::byPwintyOrderId($e->orderId()); /** @var $mOrder $mOrder */
			$o = $mOrder->o(); /** @var O|DFO $o */
			df_assert($o->canShip());
			// 2019-04-03
			// Currently, these values are only set to the database,
			// but they are never retrieved from there.
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
			try {
				$track = df_new_om(Track::class); /** @var Track $track */
				$track->setCarrierCode('Pwinty');
				$track->setDescription("Pwinty");
				$track->setNumber($sh->trackingNumber());
				$track->setTitle('Pwinty');
				$track->setUrl($sh['trackingUrl']);
				$shipment->addTrack($track);
				$shipment->save();
				$shipment->getOrder()->save();
				df_new_om(ShipmentNotifier::class)->notify($shipment);
				$shipment->save();
			} catch (\Exception $e) {
				throw new LE(__($e->getMessage()));
			}
		}
		return Text::i('OK');
	}
}