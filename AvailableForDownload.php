<?php
namespace Inkifi\Pwinty;
use Inkifi\Mediaclip\API\Entity\Order\Item as mOI;
use Inkifi\Mediaclip\API\Entity\Order\Item\File as F;
use Inkifi\Mediaclip\Event as Ev;
use Inkifi\Mediaclip\Printer;
use Inkifi\Pwinty\API\B\Order\AddImages as bAddImages;
use Inkifi\Pwinty\API\B\Order\Create as bCreate;
use Inkifi\Pwinty\API\B\Order\Submit as bSubmit;
use Inkifi\Pwinty\API\B\Order\Validate as bValidate;
use Inkifi\Pwinty\API\Entity\Image as eImage;
use Inkifi\Pwinty\API\Entity\Order as eOrder;
use Inkifi\Pwinty\API\Entity\Order\ValidationResult as R;
use Magento\Sales\Model\Order as O;
use Mangoit\MediaclipHub\Model\Product as mP;
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
		$mOIs = ikf_api_oi($o->getId(), Printer::PWINTY); /** @var mOI[] $mOIs */
		/** @var array(string => int) $smWeights */
		$smWeights = array_flip(['Budget', 'Standard', 'Express', 'Overnight']);
		/**
		 * @param string $v
		 * @return int
		 */
		$smWeight = function($v) use($smWeights) {return dftr($v, $smWeights);};
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
		$eOrder = bCreate::p($o, df_first(df_sort(
			array_unique(array_map(function(mOI $mOI) {return
				$mOI->mProduct()->pwintyShippingMethod()
			;}, $mOIs))
			,function($a, $b) use($smWeight) {return $smWeight($b) - $smWeight($a);}
		))); /** @var eOrder $eOrder */
		/**
		 * 2019-04-02
		 * 1) «Add multiple photos to an order»: https://www.pwinty.com/api/2.2/#photos-create-multiple
		 * 2) This API endpoint is absent in the latest Pwinty API version (3.0).
		 * Pwinty API 3.0 provides another endpoint: https://www.pwinty.com/api/#images-add-batch
		 */
		bAddImages::p($eOrder, dfa_flatten(df_map($mOIs, function(mOI $mOI) {return $this->images($mOI);})));
		$r = bValidate::p($eOrder); /** @var R $r */
		if (!$r->valid()) {
			df_error($r->j());
		}
		bSubmit::p($eOrder);
	}

	/**
	 * 2019-04-02
	 * 2019-04-10
	 * An order item is usally assotiated with multiple images
	 * because most of printing products require multiple images from customers.
	 * @used-by _p()
	 * @param mOI $mOI
	 * @return eImage[]
	 */
    private function images(mOI $mOI) {
    	$r = []; /** @var array(string => mixed) $r */
		$mP = $mOI->mProduct(); /** @var mP $mP */
		/**
		 * 2019-04-17 I think we do not need the `$mP->sendJson()` condition for Pwinty.
		 * 2019-04-24
		 * «But just to confirm the SKU for the PWINTY product has to be pulled from here.
		 * "Pwinty Product Name"
		 * If the Pwinty SKU is added into this box
		 * then the product should be sent to Pwinty when an order is placed.
		 * If the Pwinty SKU is not added into this box then Magneto should not send this product to Pwinty.»
		 * https://www.upwork.com/messages/rooms/room_759684bcafe746240e5c091d3745e787/story_1c38f1480b95d93d83fe42345cd2097c
		 */
		if (($files = $mOI->files()) && ($pwSKU = $mP->pwintyProductSku())) { /** @var string|null $pwSKU */
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
			$frameColour = $mP->frameColor(); /** @var string $frameColour */
			foreach ($files as $f) { /** @var F $f */
				$image = (new eImage)
					->copies(df_oqi_qty($mOI->oi()))
					->sizing('ShrinkToFit')
					->sku($pwSKU)
					->url($f->url())
				;  /** @var eImage $image */
				if ($frameColour) {
					// 2019-04-24
					// In Pwinty API 2.6 the frame color attibute has the `frame_сolour` name.
					// In Pwinty API 3.0 the frame color attibute has the `frameColour` name.
					$image->attributes(['frameColour' => strtolower($frameColour)]);
				}
				$r[] = $image;
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