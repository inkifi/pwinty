<?php
namespace Inkifi\Pwinty\Plugin\Shipping\Model\Order;
use Magento\Framework\DataObject as _DO;
use Magento\Shipping\Model\Order\Track as Sb;
use Mangoit\MediaclipHub\Model\Orders as mO;
// 2019-05-15
final class Track {
	/**
	 * 2019-05-15
	 * @see \Magento\Shipping\Model\Order\Track::getNumberDetail()
	 * @param Sb $sb
	 * @param \Closure $f
	 * @return Sb
	 */
	function aroundGetNumberDetail(Sb $sb, \Closure $f) {
		if ('Pwinty' !== $sb->getCarrierCode()) {
			$r = $f();
		}
		else {
			$mo = mO::byOId($sb->getOrderId()); /** @var mO $mo */
			$r = new _DO([
				'carrier_title' => ikf_pw_carrier($mo->trackingUrlGet())
				,'tracking' => $sb->getTrackNumber()
				,'url' => $mo->trackingUrlGet()
			]);
		}
		return $r;
	}
}