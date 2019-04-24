<?php
namespace Inkifi\Pwinty\T\CaseT\V30\Order;
use Inkifi\Pwinty\API\B\Order\AddImage as bAddImage;
use Inkifi\Pwinty\API\B\Order\Create as bCreate;
use Inkifi\Pwinty\API\B\Order\Get as bGet;
use Inkifi\Pwinty\API\B\Order\Submit as bSubmit;
use Inkifi\Pwinty\API\Entity\Order as eO;
// 2019-04-24
final class Submit extends \Inkifi\Pwinty\T\CaseT {
	/** @test 2019-04-24 */
	function t00() {}

	/** 2019-04-24 The response: [] */
	function t01() {
		$eO = bCreate::p(df_order(60055)); /** @var eO $eO */
		bAddImage::p($eO, [
			'attributes' => []
			,'copies' => 1
			,'sizing' => 'Crop'
			,'sku' => 'FRA-INSTA-30X30'
			,'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg'
		]);
		echo df_json_encode(bSubmit::p($eO)->a());
	}

	/**
	 * 2019-04-08
	 * A response from API 2.6:
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
	 * 2019-04-24
	 * A response from API 3.0:
	 * {
	 *		"address1": "47 Wolverhampton Road",
	 *		"address2": "",
	 *		"addressTownOrCity": "Dudley",
	 *		"canCancel": true,
	 *		"canHold": false,
	 *		"canUpdateImages": false,
	 *		"canUpdateShipping": true,
	 *		"countryCode": "GB",
	 *		"created": "2019-04-24T12:48:08.527",
	 *		"errorMessage": null,
	 *		"id": 778543,
	 *		"images": [
	 *			{
	 *				"attributes": null,
	 *				"copies": 1,
	 *				"errorMessage": null,
	 *				"id": 988518,
	 *				"md5Hash": "ae69fc80aef4c30d419cb92d19437930",
	 *				"previewUrl": "https://pwintyimages.blob.core.windows.net/imagestorage-sandbox/778543/00000000-0000-0000-0000-000000000000.jpg?sv=2018-03-28&sr=b&sig=idPPCAXEnvJ4p%2BnPLdX6LtmCbDCSTzJad%2BdTQc162gw%3D&se=2019-05-24T12%3A48%3A10Z&sp=rw",
	 *				"price": 0,
	 *				"priceToUser": null,
	 *				"sizing": "Crop",
	 *				"sku": "FRA-INSTA-30X30",
	 *				"status": "Ok",
	 *				"thumbnailUrl": "https://pwintyimages.blob.core.windows.net/imagestorage-sandbox/778543/173b16dd-d030-4441-af0b-d09f3395b141.jpg?sv=2018-03-28&sr=b&sig=gXh9gXRvv8XsqGrtLzufNEEiXL5f10MW8hszCNTAzF0%3D&se=2019-05-24T12%3A48%3A10Z&sp=rw",
	 *				"url": "https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg"
	 *			}
	 *		],
	 *		"invoiceAmountNet": 0,
	 *		"invoiceCurrency": null,
	 *		"invoiceTax": 0,
	 *		"lastUpdated": "2019-04-24T12:48:09.96",
	 *		"merchantOrderId": "60055",
	 *		"mobileTelephone": "07756595424",
	 *		"payment": "InvoiceMe",
	 *		"paymentUrl": null,
	 *		"postalOrZipCode": "DY3 1RG",
	 *		"preferredShippingMethod": "Standard",
	 *		"price": 1695,
	 *		"recipientName": "Jessica Bowkley ",
	 *		"shippingInfo": {
	 *			"price": 595,
	 *			"shipments": [
	 *				{
	 *					"carrier": "UK NonLiveShippingInfoService Postal Service",
	 *					"earliestEstimatedArrivalDate": "2019-04-25T00:00:00Z",
	 *					"isTracked": false,
	 *					"latestEstimatedArrivalDate": "2019-04-27T23:59:59Z",
	 *					"photoIds": [988518],
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
			,'sku' => 'FRA-INSTA-30X30'
			,'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg'
		]);
		bSubmit::p($eO);
		echo df_json_encode(bGet::p($eO)->a());
	}
}