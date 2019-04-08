<?php
namespace Inkifi\Pwinty\T\CaseT\V26\Order;
use Inkifi\Pwinty\API\B\Order\AddImage as bAddImage;
use Inkifi\Pwinty\API\B\Order\Create as bCreate;
use Inkifi\Pwinty\API\B\Order\Get as bGet;
use Inkifi\Pwinty\API\B\Order\Submit as bSubmit;
use Inkifi\Pwinty\API\Entity\Order as eO;
// 2019-04-08
final class Submit extends \Inkifi\Pwinty\T\CaseT {
	/** @test 2019-04-08 */
	function t00() {}

	/** 2019-04-08 */
	function t01() {
		$eO = bCreate::p(df_order(60055)); /** @var eO $eO */
		bAddImage::p($eO, [
			'attributes' => []
			,'copies' => 1
			,'sizing' => 'Crop'
			,'type' => 'MiniFrame_16x16_LustrePaper_gb'
			,'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg'
		]);
		echo df_json_encode(bSubmit::p($eO)->a());
	}

	/**
	 * 2019-04-08
	 *	{
	 *		"address1": "47 Wolverhampton Road",
	 *		"address2": "",
	 *		"addressTownOrCity": "Dudley",
	 *		"canCancel": true,
	 *		"canHold": false,
	 *		"canUpdateImages": false,
	 *		"canUpdateShipping": true,
	 *		"countryCode": "GB",
	 *		"created": "2019-04-08T07:56:04.693",
	 *		"destinationCountryCode": "GB",
	 *		"errorMessage": null,
	 *		"id": 776098,
	 *		"invoiceAmountNet": 0,
	 *		"invoiceCurrency": "GBP",
	 *		"invoiceTax": 0,
	 *		"lastUpdated": "2019-04-08T07:56:07.09",
	 *		"merchantOrderId": "60055",
	 *		"mobileTelephone": "07756595424",
	 *		"payment": "InvoiceMe",
	 *		"paymentUrl": null,
	 *		"photos": [
	 *			{
	 *				"attributes": [],
	 *				"copies": 1,
	 *				"errorMessage": null,
	 *				"id": 986408,
	 *				"md5Hash": null,
	 *				"previewUrl": null,
	 *				"price": 1500,
	 *				"priceToUser": null,
	 *				"sizing": "Crop",
	 *				"status": "NotYetDownloaded",
	 *				"thumbnailUrl": null,
	 *				"type": "MiniFrame_16x16_LustrePaper_gb",
	 *				"url": "https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg"
	 *			}
	 *		],
	 *		"postalOrZipCode": "DY3 1RG",
	 *		"preferredShippingMethod": "PRIORITY",
	 *		"price": 2495,
	 *		"qualityLevel": "Pro",
	 *		"recipientName": "Jessica Bowkley ",
	 *		"shippingInfo": {
	 *			"price": 995,
	 *			"shipments": [
	 *				{
	 *					"carrier": "UK NonLiveShippingInfoService Postal Service",
	 *					"earliestEstimatedArrivalDate": "2019-04-09T00:00:00Z",
	 *					"isTracked": true,
	 *					"latestEstimatedArrivalDate": "2019-04-11T23:59:59Z",
	 *					"photoIds": [986408],
	 *					"shipmentId": null,
	 *					"shippedOn": null,
	 *					"trackingNumber": null,
	 *					"trackingUrl": null
	 *				}
	 *			]
	 *		},
	 *		"stateOrCounty": "England",
	 *		"status": "Submitted"
	 *	}
	 */
	function t02() {
		$eO = bCreate::p(df_order(60055)); /** @var eO $eO */
		bAddImage::p($eO, [
			'attributes' => []
			,'copies' => 1
			,'sizing' => 'Crop'
			,'type' => 'MiniFrame_16x16_LustrePaper_gb'
			,'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg'
		]);
		bSubmit::p($eO);
		echo df_json_encode(bGet::p($eO)->a());
	}
}