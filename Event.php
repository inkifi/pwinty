<?php
namespace Inkifi\Pwinty;
use Inkifi\Pwinty\API\Entity\Shipment;
// 2019-04-04 https://www.pwinty.com/api#callbacks
final class Event extends \Df\API\Document {
	/**
	 * 2019-04-04 «The Pwinty ID of the order». «971961»
	 * @used-by \Inkifi\Pwinty\Controller\Index\Index::execute()
	 * @return int
	 */
	function orderId() {return (int)$this['orderId'];}

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
	 * «The current status of the order.
	 * One of `NotYetSubmitted`, `Submitted`, `Complete`, or `Cancelled`.»
	 * Currently, it is never used.
	 * @return string
	 */
	function status() {return $this['status'];}

	/**
	 * 2019-04-04
	 * «Each shipment in the order.
	 * Note that this can be empty if the shipments have not yet been allocated,
	 * and it may change.
	 * You will receive a callback each time a new shipment is created,
	 * or a shipment status changes.»
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
	static function s() {return dfcf(function() {return new self(df_json_decode(file_get_contents(
		'php://input'
	)));});}
}