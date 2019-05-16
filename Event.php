<?php
namespace Inkifi\Pwinty;
use Inkifi\Pwinty\API\Entity\Shipment;
/**
 * 2019-04-04 https://www.pwinty.com/api#callbacks
 * 2019-05-13
 * 	{
 *		"environment": "live",
 *		"id": 2091271,
 *		"merchantOrderId": "65785",
 *		"shipments": [
 *			{
 *				"items": [11629476],
 *				"status": "shipped",
 *				"trackingNumber": "VB153813327GB",
 *				"trackingUrl": "http://www.royalmail.com/portal/rm/track?trackNumber=VB153813327GB"
 *			}
 *		],
 *		"status": "Submitted",
 *		"timestamp": "2019-05-13T12:21:47.9708616Z"
 *	}
 */
final class Event extends \Df\API\Document {
	/**
	 * 2019-05-10
	 * This key is undecomented. We pass its value in @see \Inkifi\Pwinty\API\B\Order\Create::p()
	 * 2019-05-14
	 * 1) The result will be `0` if the order was added to Pwinty not via Magento (e.g., manually).
	 * 2) An example of such order:
	 * https://beta-dashboard.pwinty.com/orders/2086054/detail
	 * The Magento's Customer: Ortal Mendelawe
	 * https://inkifi.com/canvaspr_admin/customer/index/edit/id/79904
	 * The customer does not have assotiated orders in Magento.
	 * @used-by \Inkifi\Pwinty\Controller\Index\Index::execute()
	 * @return int
	 */
	function orderId_Magento() {return (int)$this['merchantOrderId'];}

	/**
	 * 2019-04-04 «The Pwinty ID of the order». «2088955»
	 * 2019-05-10
	 * Despite the Pwinty API documentation tells that the key is `orderId`, actually it is `id`
	 * @used-by \Inkifi\Pwinty\Controller\Index\Index::execute()
	 * @return int
	 */
	function orderId_Pwinty() {return (int)$this['id'];}

	/**
	 * 2019-04-04
	 * @used-by \Inkifi\Pwinty\Controller\Index\Index::execute()
	 * @return Shipment[]
	 */
	function shipmentsShipped() {return dfc($this, function() {return
		array_filter($this->shipments(), function(Shipment $s) {return $s->isShipped();})
	;});}

	/**
	 * 2019-04-04
	 * «The current status of the order. One of `NotYetSubmitted`, `Submitted`, `Complete`, or `Cancelled`.»
	 * 2019-05-13 "status": "Submitted"
	 * @used-by status_Submitted()
	 * @used-by \Inkifi\Pwinty\Controller\Index\Index::execute()
	 * @return string
	 */
	function status() {return $this['status'];}

	/**
	 * 2019-05-13
	 * @used-by \Inkifi\Pwinty\Controller\Index\Index::execute()
	 * @return bool
	 */
	function status_Submitted() {return 'Submitted' === $this->status();}

	/**
	 * 2019-04-04
	 * «Each shipment in the order.
	 * Note that this can be empty if the shipments have not yet been allocated,
	 * and it may change.
	 * You will receive a callback each time a new shipment is created,
	 * or a shipment status changes.»
	 * 2019-05-13
	 *	[
 	 *		{
 	 *			"items": [11629476],
 	 *			"status": "shipped",
 	 *			"trackingNumber": "VB153813327GB",
 	 *			"trackingUrl": "http://www.royalmail.com/portal/rm/track?trackNumber=VB153813327GB"
 	 *		}
 	 *	]
	 * @used-by shipmentsShipped()
	 * @return Shipment[]
	 */
	private function shipments() {return dfc($this, function() {return df_map(
		$this['shipments'], function(array $a) {return new Shipment($a);}
	);});}
	
	/**
	 * 2019-04-04
	 * @used-by \Inkifi\Pwinty\Controller\Index\Index::execute()
	 * @return Event
	 */
	static function s() {return dfcf(function() {return new self(df_json_decode(
		!df_my_local() ? file_get_contents('php://input') :
			'{
				"environment": "live",
				"id": 2094661,
				"merchantOrderId": "65938",
				"shipments": [
					{
						"items": [
							11637686
						],
						"status": "shipped",
						"trackingNumber": "VB154056014GB",
						"trackingUrl": "http://www.royalmail.com/portal/rm/track?trackNumber=VB154056014GB"
					}
				],
				"status": "Submitted",
				"timestamp": "2019-05-15T11:57:54.4149099Z"
			}'
	));});}
}