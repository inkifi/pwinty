<?php
namespace Inkifi\Pwinty\T\CaseT\V26\Order;
use Inkifi\Pwinty\API\B\Order\Create as bCreate;
use Inkifi\Pwinty\API\Facade\Order as F;
use Magento\Customer\Model\Customer;
use Magento\Sales\Model\Order as O;
use Magento\Sales\Model\Order\Address as OA;
// 2019-04-04
final class Create extends \Inkifi\Pwinty\T\CaseT {
	/** @test 2019-04-04 */
	function t00() {}

	/**
	 * 2019-04-04
	 */
	function t01() {echo df_json_encode(bCreate::p(df_order(60055))->a());}

	/**
	 * 2019-04-04
	 * https://www.pwinty.com/api#orders-create
	 */
	function t02() {
		$o = df_order(60055); /** @var O $o */
		$c = df_customer($o); /** @var Customer $c */
		$a = $o->getShippingAddress(); /** @var OA $a */
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
			// «Payment option for order, either `InvoiceMe` or `InvoiceRecipient`. Default `InvoiceMe`».
			// Optional.
			,'payment' => 'InvoiceMe'
			// 2019-04-04 «Postal or zip code of the recipient». Required.
			,'postalOrZipCode' => $a->getPostcode()
			// 2019-04-04
			// «Possible values are `Budget`, `Standard`, `Express`, and `Overnight`».
			// Required.
			,'preferredShippingMethod' => 'Standard'
			// 2019-04-04 «Recipient name». Required.
			,'recipientName' => null
			// 2019-04-04 «State, county or region of the recipient». Required.
			,'stateOrCounty' => $a->getRegion()
			// 2019-04-04
			// «Customer's non-mobile phone number for shipping updates and courier contact».
			// Optional.
			,'telephone' => $a->getTelephone()
		])->a());
	}
}