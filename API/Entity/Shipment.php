<?php
namespace Inkifi\Pwinty\API\Entity;
// 2019-04-04 «Each shipment in the order» https://www.pwinty.com/api/#callbacks
/** @used-by \Inkifi\Pwinty\Event::shipments() */
final class Shipment extends \Df\API\Document {
	/**
	 * 2019-04-04 «Either `InProgress` or `Shipped`».
	 * @used-by \Inkifi\Pwinty\Event::shipmentsShipped()
	 * @return string
	 */
	function isShipped() {return 'Shipped' === $this['status'];}
	
	/**
	 * 2019-04-04
	 * «An array of item IDs included in the shipment».
	 * Currently, it is never used.
	 * @return int[]
	 */
	function items() {return df_int($this['items']);}

	/**
	 * 2019-04-04 «MQ121286142GB».
	 * @used-by \Inkifi\Pwinty\Controller\Index\Index::execute()
	 * @return string
	 */
	function trackingNumber() {return $this['trackingNumber'];}

	/**
	 * 2019-04-04 «http://www.royalmail.com/portal/rm/track?trackNumber=MQ121286142GB».
	 * @used-by \Inkifi\Pwinty\Controller\Index\Index::execute()
	 * @return string
	 */
	function trackingUrl() {return $this['trackingUrl'];}
}