<?php
namespace Inkifi\Pwinty\T\CaseT\V30\Order;
use Inkifi\Pwinty\API\B\Order\AddImage as bAddImage;
use Inkifi\Pwinty\API\B\Order\Create as bCreate;
use Inkifi\Pwinty\API\B\Order\Get as bGet;
use Inkifi\Pwinty\API\Entity\Order as eO;
// 2019-04-24
final class Get extends \Inkifi\Pwinty\T\CaseT {
	/** @test 2019-04-24 */
	function t00() {}

	/**
	 * 2019-04-24
	 *	{
	 *		"address1": "47 Wolverhampton Road",
	 *		"address2": "",
	 *		"addressTownOrCity": "Dudley",
	 *		"canCancel": true,
	 *		"canHold": false,
	 *		"canUpdateImages": false,
	 *		"canUpdateShipping": true,
	 *		"countryCode": "GB",
	 *		"created": "2019-04-24T12:22:47.79",
	 *		"errorMessage": null,
	 *		"id": 778534,
	 *		"images": [
	 *			{
	 *				"attributes": null,
	 *				"copies": 1,
	 *				"errorMessage": null,
	 *				"id": 988514,
	 *				"md5Hash": "ae69fc80aef4c30d419cb92d19437930",
	 *				"previewUrl": "https://pwintyimages.blob.core.windows.net/imagestorage-sandbox/778534/00000000-0000-0000-0000-000000000000.jpg?sv=2018-03-28&sr=b&sig=PRUfmw8NqC%2FHVIf9SxfpUzESXixk%2Fo3pO9WBdyqUTpE%3D&se=2019-05-24T12%3A22%3A49Z&sp=rw",
	 *				"price": 0,
	 *				"priceToUser": null,
	 *				"sizing": "Crop",
	 *				"sku": "FRA-INSTA-30X30",
	 *				"status": "Ok",
	 *				"thumbnailUrl": "https://pwintyimages.blob.core.windows.net/imagestorage-sandbox/778534/b5fc2dcc-d4f0-4c76-ac4e-b7019fedb81d.jpg?sv=2018-03-28&sr=b&sig=O5pTb2yR3UfJaUjeBwncKEXiPw4RoOHPJczM8iat1%2F0%3D&se=2019-05-24T12%3A22%3A49Z&sp=rw",
	 *				"url": "https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg"
	 *			}
	 *		],
	 *		"invoiceAmountNet": 0,
	 *		"invoiceCurrency": null,
	 *		"invoiceTax": 0,
	 *		"lastUpdated": "2019-04-24T12:22:48.94",
	 *		"merchantOrderId": "60055",
	 * 		"mobileTelephone": "07756595424",
	 *		"payment": "InvoiceMe",
	 *		"paymentUrl": null,
	 *		"postalOrZipCode": "DY3 1RG",
	 *		"preferredShippingMethod": "Standard",
	 *		"price": 0,
	 *		"recipientName": "Jessica Bowkley ",
	 *		"shippingInfo": {
	 *			"price": 595,
	 *			"shipments": [
	 *				{
	 *					"carrier": "UK NonLiveShippingInfoService Postal Service",
	 *					"earliestEstimatedArrivalDate": "2019-04-25T00:00:00Z",
	 *					"isTracked": false,
	 *					"latestEstimatedArrivalDate": "2019-04-27T23:59:59Z",
	 *					"photoIds": [988514],
	 *					"shipmentId": null,
	 *					"shippedOn": null,
	 *					"trackingNumber": null,
	 *					"trackingUrl": null
	 *				}
	 *			]
	 *		},
	 *		"stateOrCounty": "England",
	 *		"status": "NotYetSubmitted"
	 *	}
	 */
	function t01() {
		$eO = bCreate::p(df_order(60055)); /** @var eO $eO */
		bAddImage::p($eO, [
			'attributes' => []
			,'copies' => 1
			,'sizing' => 'Crop'
			,'sku' => 'FRA-INSTA-30X30'
			,'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg'
		]);
		echo df_json_encode(bGet::p($eO)->a());
	}
}