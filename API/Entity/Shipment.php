<?php
namespace Inkifi\Pwinty\API\Entity;
// 2019-04-04 «Each shipment in the order» https://www.pwinty.com/api/#callbacks
/** @used-by \Inkifi\Pwinty\Event::shipments() */
final class Shipment extends \Df\API\Document {
	/**
	 * 2019-04-04 «An array of item IDs included in the shipment».
	 * @return int[]
	 */
	function items() {return df_int($this['items']);}
	
	/**
	 * 2019-04-04 «Either `InProgress` or `Shipped`».
	 * @return string
	 */
	function status() {return $this['status'];}

	/**
	 * 2019-04-04 «MQ121286142GB».
	 * @return string
	 */
	function trackingNumber() {return $this['trackingNumber'];}

	/**
	 * 2019-04-04 «http://www.royalmail.com/portal/rm/track?trackNumber=MQ121286142GB».
	 * @return string
	 */
	function trackingUrl() {return $this['trackingUrl'];}
}