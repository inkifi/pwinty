<?php
namespace Inkifi\Pwinty;
use Inkifi\Mediaclip\API\Entity\Order\Item as mOI;
use Inkifi\Mediaclip\Event as Ev;
use Inkifi\Mediaclip\Printer;
use Inkifi\Pwinty\Settings as S;
use Magento\Customer\Model\Customer;
use Magento\Sales\Model\Order as O;
use Magento\Sales\Model\Order\Item as OI;
use Magento\Store\Model\StoreManagerInterface as IStoreManager;
use Mangoit\MediaclipHub\Model\Orders as mOrder;
use Mangoit\MediaclipHub\Model\Product as mP;
use pwinty\PhpPwinty as API;
use Zend\Log\Logger as zL;
// 2019-02-24
final class AvailableForDownload {
	/**
	 * 2019-02-24
	 * @used-by p()
	 */
	private function __construct() {}

	/**
	 * 2019-02-24
	 * @used-by p()
	 */
	private function _p() {
		$ev = Ev::s(); /** @var Ev $ev */
		$s = S::s($ev->store()); /** @var S $s */
		$api = new API([
			'api' => $s->test() ? 'sandbox' : 'production'
			,'apiKey' => $s->privateKey()
			,'merchantId' => $s->merchantID()
		]); /** @var API $api */
		// 2018-08-16 Dmitry Fedyuk https://www.upwork.com/fl/mage2pro
		// «Modify orders numeration for Mediaclip»
		// https://github.com/Inkifi-Connect/Media-Clip-Inkifi/issues/1
		$o = $ev->o(); /** @var O $o */
		$imageArray = [];
		$catalogue = $api->getCatalogue('GB', 'Pro');
		foreach (ikf_api_oi($o->getId(), Printer::PWINTY) as $mOI) { /** @var mOI $mOI */
			$oi = $ev->oi(); /** @var OI $oi */
			$mP = $mOI->mProduct(); /** @var mP $mP */
			$pwintyProduct = $mP['pwinty_product_name'];
			$frameColour = $mP['frame_colour'];
			// 2019-02-27 TODO
			$filesUploadPath = '';//AFD::path($oi, 'pwinty', $mP['product_label']);
			$imgPath = explode('html/', $filesUploadPath);
			$storeManager = df_o(IStoreManager::class);
			$store = $storeManager->getStore();
			$baseUrl = $store->getBaseUrl();
			if ($filesUploadPath != '') {
				$quantity = 0 ;
				foreach (new \DirectoryIterator($filesUploadPath) as $key => $fileInfo) {
					if ($fileInfo->isDot() || $fileInfo->isDir())
					   continue;
					if ($fileInfo->isFile() && $fileInfo->getExtension() != 'csv') {
						$img = $baseUrl.$imgPath[1].'/'.$fileInfo->getFilename();
						$imgAttribute = [];
						$imgAttribute['url'] = $img;
						$imgAttribute['sizing'] = "ShrinkToFit";
						$imgAttribute['priceToUser'] = "0";
						$imgAttribute['copies'] = $quantity+1;
						$imgAttribute['type'] = $pwintyProduct;
						foreach ($catalogue['items'] as $value) {
							//check if product has frame attribute
							if ($value['name'] == $pwintyProduct) {
								if($frameColour != "" && !empty($value['attributes'])) {
									$imgAttribute['attributes'][$value['attributes'][0]['name']] = strtolower($frameColour);
								}
							}
						}
						$imageArray[$oi->getId()] = $imgAttribute;
						$quantity++;
					}
				}
			}
		}
		$imageArray = array_values($imageArray);
		$address = $o->getShippingAddress();
		$postcode = $address->getPostcode();
		$countryCode = $address->getCountryId();
		$region = $address->getRegion();
		if ($address->getCompany() != ''){
			$street1 = $address->getCompany().','.$address->getStreet()[0];
		} else {
			$street1 = $address->getStreet()[0];
		}
		if (isset($address->getStreet()[1])) {
			$street2 = $address->getStreet()[1];
		} else{
			$street2 = '';
		}
		$city = $address->getCity();
		$customerId = $o->getCustomerId();
		$customer = df_new_om(Customer::class)->load($customerId);
		$name = $customer['firstname'].' '.$customer['lastname'];
		$email = $customer['email'];
		$pOrder = $api->createOrder(// create order to pwinty
			$name,          //name
			$email,         //email address
			$street1,    //address1
			$street2,    //address 2
			$city,          //town
			$region,        //state
			$postcode,      //postcode or zip
			'GB',            //country code
			$countryCode,    //destination code
			true,            //tracked shipping
			"InvoiceMe",     //payment method
			"Pro"            //quality
		);
		$zl = ikf_logger('pwinty_orders_status'); /** @var zL $zl */
		$zl->info($pOrder);
		$pwintyOrderId = $pOrder['id'];
		//save pwinty id to custom table
		$mOrderModel = df_new_om(mOrder::class);
		$mOrderModelCollection = $mOrderModel->getCollection();
		$mOrder = $mOrderModelCollection
			->addFieldToFilter('magento_order_id', ['eq' => $ev->oidE()]);
		foreach ($mOrder as $key => $value) {
			$value->setPwintyOrderId($pwintyOrderId);
			$value->save();
		}
		$photos =  $api->addPhotos( //add photos to order
			$pwintyOrderId, //order id
			$imageArray
		);
		$zl->info($photos);
		$getOrderStatus = $api->getOrderStatus(// check order status
			$pwintyOrderId              //orderid
			 //status
		);
		$zl->info($getOrderStatus);
		if ($getOrderStatus['isValid'] == 1) {// submit order if no error
			$api->updateOrderStatus(
				$pwintyOrderId,              //orderid
				"Submitted"         //status
			);
		} else {
			$zl->info('order is not submitted');
		}
	}

	/**
	 * 2019-02-24
	 * @used-by \Inkifi\Mediaclip\H\AvailableForDownload::_p()
	 */
	static function p() {$i = new self; /** @var self $i */ $i->_p();}
}