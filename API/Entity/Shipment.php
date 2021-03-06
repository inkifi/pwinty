<?php
namespace Inkifi\Pwinty\API\Entity;
/**
 * 2019-04-04 «Each shipment in the order» https://www.pwinty.com/api/#callbacks
 * 2019-05-13
 *	{
 *		"items": [11629476],
 *		"status": "shipped",
 *		"trackingNumber": "VB153813327GB",
 *		"trackingUrl": "http://www.royalmail.com/portal/rm/track?trackNumber=VB153813327GB"
 *	}
 * @used-by \Inkifi\Pwinty\Event::shipments()
 */
final class Shipment extends \Df\Core\O {
	/**
	 * 2019-04-04 «Either `InProgress` or `Shipped`».
	 * 2019-05-13
	 * In contradiction to its own specification, Pwinty passes shipment statuses in the lower case, e.g.:
	 * 		"status": "shipped"
	 * @used-by \Inkifi\Pwinty\Event::shipmentsShipped()
	 * @return string
	 */
	function isShipped() {/** @noinspection PhpParamsInspection */ return
		'shipped' === strtolower($this['status'])
	;}
	
	/**
	 * 2019-04-04
	 * «An array of item IDs included in the shipment».
	 * Currently, it is never used.
	 * 2019-05-13 "items": [11629476]
	 * @return int[]
	 */
	function items() {return df_int($this['items']);}

	/**
	 * 2019-04-04 «MQ121286142GB»
	 * 2019-05-13 «VB153813327GB»
	 * 2019-05-15
	 * The «N/A» value fixes the «Cannot save track» / «Number can not be empty» error.
	 * It is similar to: https://github.com/Inkifi-Connect/Media-Clip-Inkifi/blob/2019-05-14/Controller/Index/OneflowResponse.php#L101-L114
	 * @see \Mangoit\MediaclipHub\Controller\Index\OneflowResponse::execute()
	 * https://log.mage2.pro/inkifi/pwinty/issues/126
	 * @used-by \Inkifi\Pwinty\Controller\Index\Index::execute()
	 * @return string
	 */
	function trackingNumber() {return $this['trackingNumber'] ?: 'N/A';}

	/**
	 * 2019-04-04 «http://www.royalmail.com/portal/rm/track?trackNumber=MQ121286142GB»
	 * 2019-05-13 «http://www.royalmail.com/portal/rm/track?trackNumber=VB153813327GB»
	 * @used-by \Inkifi\Pwinty\Controller\Index\Index::execute()
	 * @return string
	 */
	function trackingUrl() {return $this['trackingUrl'];}
}