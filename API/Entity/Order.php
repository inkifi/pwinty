<?php
namespace Inkifi\Pwinty\API\Entity;
use Magento\Sales\Model\Order as O;
/**
 * 2019-04-06
 * https://www.pwinty.com/api#orders-create
 * https://www.pwinty.com/api/2.6/#orders-create
 * 1) A response from API 3.0:
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
 * 2) A response from API 2.6:
 *	{
 *		"address1": "47 Wolverhampton Road",
 *		"address2": "",
 *		"addressTownOrCity": "Dudley",
 *		"canCancel": true,
 *		"canHold": true,
 *		"canUpdateImages": false,
 *		"canUpdateShipping": true,
 *		"countryCode": "GB",
 *		"created": "2019-04-06T01:59:03.1440157Z",
 *		"destinationCountryCode": "GB",
 *		"errorMessage": null,
 *		"id": 775896,
 *		"invoiceAmountNet": 0,
 *		"invoiceCurrency": "GBP",
 *		"invoiceTax": 0,
 *		"lastUpdated": "2019-04-06T01:59:03.1440157Z",
 *		"merchantOrderId": "60055",
 *		"mobileTelephone": "07756595424",
 *		"payment": "InvoiceMe",
 *		"paymentUrl": null,
 *		"photos": [],
 *		"postalOrZipCode": "DY3 1RG",
 *		"preferredShippingMethod": "PRIORITY",
 *		"price": 0,
 *		"qualityLevel": "Pro",
 *		"recipientName": "Jessica Bowkley ",
 *		"shippingInfo": {
 *			"price": 0,
 *			"shipments": []
 *		},
 *		"stateOrCounty": "England",
 *		"status": "NotYetSubmitted"
 *	}
 * @used-by \Inkifi\Pwinty\API\B\Order\Create::p()
 */
final class Order extends \Df\API\Document {
	/**
	 * 2019-04-05
	 * @used-by \Inkifi\Pwinty\API\B\Order\AddImage::p()
	 * @used-by \Inkifi\Pwinty\API\B\Order\Validate::p()
	 * @return int
	 */
	function id() {return (int)$this['id'];}

	/**
	 * 2019-04-05
	 * @used-by \Inkifi\Pwinty\API\B\Order\AddImage::p()
	 * @used-by \Inkifi\Pwinty\API\B\Order\Create::p()
	 * @used-by \Inkifi\Pwinty\API\B\Order\Validate::p()
	 * @param O|null $v [optional]
	 * @return O|null
	 */
	function magentoOrder($v = null) {return df_prop($this, $v);}
}