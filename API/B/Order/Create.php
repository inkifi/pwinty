<?php
namespace Inkifi\Pwinty\API\B\Order;
use Df\API\FacadeOptions as FO;
use Inkifi\Pwinty\API\Entity\Order as R;
use Inkifi\Pwinty\API\Facade\Order as F;
use Magento\Customer\Model\Customer;
use Magento\Sales\Model\Order as O;
use Magento\Sales\Model\Order\Address as OA;
// 2019-04-05
final class Create {
	/**
	 * 2019-04-05 https://www.pwinty.com/api#orders-create
	 * 2019-04-06 https://www.pwinty.com/api/2.6/#orders-create
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
	 * @used-by \Inkifi\Pwinty\AvailableForDownload::_p()
	 * @param O $o
	 * @return R
	 */
	static function p(O $o) {
		$c = df_customer($o); /** @var Customer $c */
		$a = $o->getShippingAddress(); /** @var OA $a */
		$r = F::s($o)->post([
			// 2019-04-04 «First line of recipient address». Required.
			'address1' => $a->getStreetLine(1)
			// 2019-04-04 «Second line of recipient address». Optional.
			,'address2' => $a->getStreetLine(2)
			// 2019-04-04 «Town or city of the recipient». Required.
			,'addressTownOrCity' => $a->getCity()
			// 2019-04-04
			// API 3.0: «Two-letter country code of the recipient». Required.
			// API 2.6: «Two-letter country code where the order should be printed.». Required.
			,'countryCode' => $a->getCountryId()
			// 2019-04-04 «Customer's email address». Optional.
			,'email' => $c->getEmail()
			// 2019-04-04
			// «Used for orders where an invoice amount must be supplied (e.g. to Middle East)».
			// Optional.
			,'invoiceAmountNet' => $o->getGrandTotal()
			// 2019-04-04
			// «Used for orders where an invoice amount must be supplied (e.g. to Middle East)».
			// Optional.
			,'invoiceCurrency' => $o->getOrderCurrencyCode()
			// 2019-04-04
			// «Used for orders where an invoice amount must be supplied (e.g. to Middle East)».
			// Optional.
			,'invoiceTax' => $o->getTaxAmount()
			// 2019-04-04 «Your identifier for this order». Optional.
			,'merchantOrderId' => $o->getId()
			// 2019-04-04
			// «Customer's mobile number for shipping updates and courier contact».
			// Optional.
			,'mobileTelephone' => $a->getTelephone()
			// 2019-04-04
			// API 3.0:
			// «Payment option for order, either `InvoiceMe` or `InvoiceRecipient`. Default `InvoiceMe`».
			// Optional.
			// API 2.6: Required.
			,'payment' => 'InvoiceMe'
			// 2019-04-04 «Postal or zip code of the recipient». Required.
			,'postalOrZipCode' => $a->getPostcode()
			/**
			 * 2019-04-04
			 * API 3.0:
			 * «Possible values are `Budget`, `Standard`, `Express`, and `Overnight`». Required.
			 * 2019-04-06
			 * API 2.6:
			 * «Standard values are CHEAPEST or PRIORITY, contact us for more details». Optional.
			 */
			,'preferredShippingMethod' => 'Standard'
			// 2019-04-04 «Recipient name». Required.
			,'recipientName' => $c->getName()
			// 2019-04-04 «State, county or region of the recipient». Required.
			,'stateOrCounty' => $a->getRegion()
		], null, FO::i()->resC(R::class))->res(); /** @var R $r */
		$r->magentoOrder($o);
		return $r;
	}
}