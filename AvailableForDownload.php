<?php
namespace Inkifi\Pwinty;
use Inkifi\Mediaclip\API\Entity\Order\Item as mOI;
use Inkifi\Mediaclip\API\Entity\Order\Item\File as F;
use Inkifi\Mediaclip\Event as Ev;
use Inkifi\Mediaclip\Printer;
use Inkifi\Pwinty\API\B\Order\Create as bCreate;
use Inkifi\Pwinty\API\Entity\Order as eOrder;
use Magento\Sales\Model\Order as O;
use Mangoit\MediaclipHub\Model\Orders as mOrder;
use Mangoit\MediaclipHub\Model\Product as mP;
use pwinty\PhpPwinty as API;
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
		// 2018-08-16 Dmitry Fedyuk https://www.upwork.com/fl/mage2pro
		// «Modify orders numeration for Mediaclip»
		// https://github.com/Inkifi-Connect/Media-Clip-Inkifi/issues/1
		$o = $ev->o(); /** @var O $o */
		$images = array_merge(df_map(ikf_api_oi($o->getId(), Printer::PWINTY), function(mOI $mOI) {return
			$this->pOI($mOI)
		;}));
		$api = ikf_pw_api($ev->store()); /** @var API $api */
		/**
		 * 2019-04-02
		 * «Create an order» https://www.pwinty.com/api/2.2/#orders-create
		 * A response:
		 * {
		 *		"address1": "47 Wolverhampton Road",
		 *		"address2": "",
		 *		"addressTownOrCity": "Dudley",
		 *		"countryCode": "GB",
		 *		"destinationCountryCode": "GB",
		 *		"errorMessage": null,
		 *		"id": 775277,
		 *		"payment": "InvoiceMe",
		 *		"paymentUrl": null,
		 *		"photos": [],
		 *		"postalOrZipCode": "DY3 1RG",
		 *		"price": 0,
		 *		"qualityLevel": "Pro",
		 *		"recipientName": "Jessica Bowkley ",
		 *		"shippingInfo": {
		 *			"isTracked": false,
		 *			"price": 0,
		 *			"trackingNumber": null,
		 *			"trackingUrl": null
		 *		},
		 *		"stateOrCounty": "England",
		 *		"status": "NotYetSubmitted"
		 *	}
		 */
		$eOrder = bCreate::p($o); /** @var eOrder $eOrder */
		/** 2019-04-03 @used-by \Inkifi\Pwinty\Controller\Index\Index::execute() */
		$ev->mo()->oidPwintySet($pwOid = $eOrder->id())->save();  /** @var int $pwOid*/ // 2019-04-03 «775277»
		/**
		 * 2019-04-02
		 * 1) «Add multiple photos to an order»: https://www.pwinty.com/api/2.2/#photos-create-multiple
		 * 2) This API endpoint is absent in the latest Pwinty API version (3.0).
		 * Pwinty API 3.0 provides another endpoint: https://www.pwinty.com/api/#images-add-batch
		 */
		$api->addPhotos($pwOid, array_values($images));
		$getOrderStatus = $api->getOrderStatus($pwOid);
		if ($getOrderStatus['isValid'] == 1) {
			$api->updateOrderStatus($pwOid, 'Submitted');
		}
	}

	/**
	 * 2019-04-02
	 * @used-by _p()
	 * @param mOI $mOI
	 * @return array(array(string => mixed))
	 */
    private function pOI(mOI $mOI) {
    	$catalogueItems = ikf_pw_items(Ev::s()->store()); /** @var array(string => mixed) $catalogueItems */
    	$r = []; /** @var array(string => mixed) $r */
		$mP = $mOI->mProduct(); /** @var mP $mP */
		if ($mP->sendJson() && ($files = $mOI->files())) { /** @var F[] $files */
			/**
			 * 2018-11-02 Dmitry Fedyuk https://www.upwork.com/fl/mage2pro
			 * «Generate JSON data for photo-books»
			 * https://github.com/Inkifi-Connect/Media-Clip-Inkifi/issues/9
			 * 2019-03-12
			 * Data item examples:
			 * 1)
			 *		{
			 *			"id": "photobook-jacket",
			 *			"productId": "$(package:inkifi/photobooks)/products/hard-cover-gray-210x210mm-70",
			 *			"plu": "INKIFI-HCB210-M-70",
			 *			"quantity": 1,
			 *			"url": "https://renderstouse.blob.core.windows.net/0c25168e-eda3-41d4-b266-8259566d2507/dust.pdf?sv=2018-03-28&sr=c&sig=XzCB%2B2CWlpqNFqVf6CnoVr8ICDGufTexaNqyzxMDUx8%3D&st=2018-11-02T19%3A36%3A41Z&se=2018-12-02T19%3A38%3A41Z&sp=r",
			 *			"order": 0
			 *		}
			 * 2)
			 *		{
			 *			"id": "photobook-pages",
			 *			"productId": "$(package:inkifi/photobooks)/products/hard-cover-gray-210x210mm-70",
			 *			"plu": "INKIFI-HCB210-M-70",
			 *			"quantity": 1,
			 *			"url": "https://renderstouse.blob.core.windows.net/0c25168e-eda3-41d4-b266-8259566d2507/0d0e8542-db8d-475b-95bb-33156dc6551a_0c25168e-eda3-41d4-b266-8259566d2507.pdf?sv=2018-03-28&sr=c&sig=maMnPG2XIrQuLC3mArAgf3YKrM6EzFwNMggwApqMTeo%3D&st=2018-11-02T19%3A36%3A43Z&se=2018-12-02T19%3A38%3A43Z&sp=r",
			 *			"order": 1
			 *		}
			*/
			$pwintyProduct = $mP['pwinty_product_name']; /** @var string $pwintyProduct */
			$frameColour = $mP['frame_colour'];
			$quantity = 0; /** @var int $quantity */
			foreach ($files as $f) { /** @var F $f */
				$image = [
					'copies' => 1 + $quantity
					,'priceToUser' => '0'
					,'sizing' => 'ShrinkToFit'
					,'type' => $pwintyProduct
					,'url' => $f->url()
				]; /** @var array(string => string) $image */
				if ($frameColour) {
					foreach ($catalogueItems as $value) {
						/**
						 * 2019-03-19
						 * $value has the following format:
						 *	{
						 *		attributes: [
						 *			{
						 *				name: "finish",
						 *				validValues: ["matte", "glossy"]
						 *			}
						 *		],
						 *		description: "10x12 Print",
						 *		fullProductHorizontalSize: 10,
						 *		fullProductVerticalSize: 12,
						 *		imageHorizontalSize: 10,
						 *		imageVerticalSize: 12,
						 *		name: "10x12",
						 *		priceGBP: 150,
						 *		priceUSD: 350,
						 *		recommendedHorizontalResolution: 1500,
						 *		recommendedVerticalResolution: 1800,
						 *		shippingBand: "Prints",
						 *		sizeUnits: "inches"
						 *	}
						 * 2019-04-02
						 * 1) I have got a real item with attributes
						 * via the @see \Inkifi\Pwinty\T\CaseT\V22\Catalogue::t02() test case:
						 *	{
						 *		"attributes": [
						 *			{
						 *				"name": "finish",
						 *				"validValues": ["matte", "glossy"]
						 *			}
						 *		],
						 *		"description": "5x5 inch print",
						 *		"errorMessage": null,
						 *		"fullProductHorizontalSize": 5,
						 *		"fullProductVerticalSize": 5,
						 *		"imageHorizontalSize": 5,
						 *		"imageVerticalSize": 5,
						 *		"itemType": "Print",
						 *		"name": "5x5",
						 *		"priceGBP": 60,
						 *		"priceUSD": 78,
						 *		"recommendedHorizontalResolution": 750,
						 *		"recommendedVerticalResolution": 750,
						 *		"shippingBand": "Prints",
						 *		"sizeUnits": "inches"
						 *	}
						 * 1) I have got a real item with multiple attributes
						 * via the @see \Inkifi\Pwinty\T\CaseT\V22\Catalogue::t0s() test case:
						 *	{
						 *		"attributes": [
						 *			{
						 *				"name": "paper",
						 *				"validValues": ["smooth_art", "cold_press_watercolour"]
						 *			},
						 *			{
						 *				"name": "frame_colour",
						 *				"validValues": [
						 * 					"gold", "silver", "natural", "dark_brown", "black", "white"
						 * 				]
						 *			},
						 *			{
						 *				"name": "hanging_orientation",
						 *				"validValues": ["portrait", "landscape"]
						 *			},
						 *			{
						 *				"name": "glaze",
						 *				"validValues": ["float_glass", "acrylic"]
						 *			}
						 *		],
						 *		"description": "Box Framed, unmounted 24x48 fine art print",
						 *		"errorMessage": null,
						 *		"fullProductHorizontalSize": 24,
						 *		"fullProductVerticalSize": 48,
						 *		"imageHorizontalSize": 24,
						 *		"imageVerticalSize": 48,
						 *		"itemType": "Framed Poster",
						 *		"name": "BoxFrame_24x48_Unmounted",
						 *		"priceGBP": 9750,
						 *		"priceUSD": 12735,
						 *		"recommendedHorizontalResolution": 3600,
						 *		"recommendedVerticalResolution": 7200,
						 *		"shippingBand": "FramedPrints",
						 *		"sizeUnits": "inches"
						 *	}
						 */
						if (($a = dfa($value, 'attributes')) && $pwintyProduct === $value['name']) {
							$image['attributes'][$a[0]['name']] = strtolower($frameColour);
						}
					}
				}
				$r[] = $image;
				$quantity++;
			}
		}
		return $r;
	}

	/**
	 * 2019-02-24
	 * @used-by \Inkifi\Mediaclip\H\AvailableForDownload::_p()
	 */
	static function p() {$i = new self; /** @var self $i */ $i->_p();}
}