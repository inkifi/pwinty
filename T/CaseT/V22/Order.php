<?php
namespace Inkifi\Pwinty\T\CaseT\V22;
use Magento\Customer\Model\Customer;
use Magento\Sales\Model\Order as O;
use Magento\Sales\Model\Order\Address as OA;
// 2019-04-03
final class Order extends \Inkifi\Pwinty\T\CaseT {
	/** @test 2019-04-03 */
	function t00() {}

	/**
	 * 2019-04-03
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
		echo df_json_encode(ikf_pw_api()->createOrder(
			df_cc_s($customer['firstname'], $customer['lastname'])
			,$customer['email']
			,df_ccc(', ', $sa->getCompany(), $sa->getStreetLine(1))
			,$sa->getStreetLine(2)
			,$sa->getCity()
			,$sa->getRegion()
			,$sa->getPostcode()
			,'GB'
			,$sa->getCountryId()
			,true
			,'InvoiceMe' //payment method
			,'Pro' //quality
		));
	}
}