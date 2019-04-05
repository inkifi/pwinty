<?php
namespace Inkifi\Pwinty\API\B\Order;
use Df\API\FacadeOptions as FO;
use Inkifi\Pwinty\API\Entity\Image as R;
use Inkifi\Pwinty\API\Entity\Order as eOrder;
use Inkifi\Pwinty\API\Facade\Order as F;
// 2019-04-06
final class AddImage {
	/**
	 * 2019-04-06 https://www.pwinty.com/api/#images-add
	 * @used-by \Inkifi\Pwinty\T\CaseT\V30\Order\AddImage::t01()
	 * @param eOrder $o
	 * @param array(string => mixed)$d
	 * @return R
	 */
	static function p(eOrder $o, array $d) {return F::s($o->magentoOrder())->post(
		$d, "{$o->id()}/images", FO::i()->resC(R::class)
	)->res();}
}