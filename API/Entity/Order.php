<?php
namespace Inkifi\Pwinty\API\Entity;
/**
 * 2019-04-05 https://www.pwinty.com/api#orders-create
 * @used-by \Inkifi\Pwinty\API\B\Order\Create::p()
 * A response:
 *	{
 *		"address1": "47 Wolverhampton Road",
 *		"address2": "",
 *		"addressTownOrCity": "Dudley",
 *		"canCancel": true,
 *		"canHold": true,
 *		"canUpdateImages": false,
 *		"canUpdateShipping": true,
 *		"countryCode": "GB",
 *		"created": "2019-04-04T02:51:28.8362052Z",
 *		"errorMessage": null,
 *		"id": 775498,
 *		"images": [],
 *		"invoiceAmountNet": 0,
 *		"invoiceCurrency": null,
 *		"invoiceTax": 0,
 *		"lastUpdated": "2019-04-04T02:51:28.8362052Z",
 *		"merchantOrderId": "60055",
 *		"mobileTelephone": "07756595424",
 *		"payment": "InvoiceMe",
 *		"paymentUrl": null,
 *		"postalOrZipCode": "DY3 1RG",
 *		"preferredShippingMethod": "Standard",
 *		"price": 0,
 *		"recipientName": "Jessica Bowkley ",
 *		"shippingInfo": {
 *			"price": 0,
 *			"shipments": []
 *		},
 *		"stateOrCounty": "England",
 *		"status": "NotYetSubmitted"
 *	}
 */
final class Order extends \Df\API\Document {}