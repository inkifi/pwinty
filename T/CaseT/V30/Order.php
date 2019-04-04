<?php
namespace Inkifi\Pwinty\T\CaseT\V30;
use Inkifi\Pwinty\API\Facade\Order as F;
use Magento\Customer\Model\Customer;
use Magento\Sales\Model\Order as O;
use Magento\Sales\Model\Order\Address as OA;
// 2019-04-04
final class Order extends \Inkifi\Pwinty\T\CaseT {
	/** 2019-04-04 */
	function t00() {}

	/**
	 * @test 2019-04-04
	 * https://www.pwinty.com/api#orders-create
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
	function t01() {
		$o = df_order(60055); /** @var O $o */
		$customer = df_customer($o); /** @var Customer $customer */
		$sa = $o->getShippingAddress(); /** @var OA $sa */
		echo df_json_encode(F::s($o)->post([
			// 2019-04-04 «First line of recipient address». Required.
			'address1' => null
			// 2019-04-04 «Second line of recipient address». Optional.
			,'address2' => null
			// 2019-04-04 «Town or city of the recipient». Required.
			,'addressTownOrCity' => null
			// 2019-04-04 «Two-letter country code of the recipient». Required.
			,'countryCode' => null
			// 2019-04-04 «Customer's email address». Optional.
			,'email' => null
			// 2019-04-04
			// «Used for orders where an invoice amount must be supplied (e.g. to Middle East)».
			// Optional.
			,'invoiceAmountNet' => null
			// 2019-04-04
			// «Used for orders where an invoice amount must be supplied (e.g. to Middle East)».
			// Optional.
			,'invoiceCurrency' => null
			// 2019-04-04
			// «Used for orders where an invoice amount must be supplied (e.g. to Middle East)».
			// Optional.
			,'invoiceTax' => null
			// 2019-04-04 «Your identifier for this order». Optional.
			,'merchantOrderId' => null
			// 2019-04-04 «Customer's mobile number for shipping updates and courier contact».
			,'mobileTelephone' => null
			// 2019-04-04
			// «Payment option for order, either `InvoiceMe` or `InvoiceRecipient`. Default `InvoiceMe`».
			// Optional.
			,'payment' => null
			// 2019-04-04 «Postal or zip code of the recipient». Required.
			,'postalOrZipCode' => null
			// 2019-04-04 «Possible values are `Budget`, `Standard`, `Express`, and `Overnight`».
			,'preferredShippingMethod' => null
			// 2019-04-04 «Recipient name». Required.
			,'recipientName' => null
			// 2019-04-04 «State, county or region of the recipient». Required.
			,'stateOrCounty' => null
			// 2019-04-04
			// «Customer's non-mobile phone number for shipping updates and courier contact».
			// Optional.
			,'telephone' => null
		]));
	}
}