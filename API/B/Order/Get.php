<?php
namespace Inkifi\Pwinty\API\B\Order;
use Df\API\FacadeOptions as FO;
use Inkifi\Pwinty\API\Entity\Order as eOrder;
use Inkifi\Pwinty\API\Facade\Order as F;
// 2019-04-08
final class Get {
	/**
	 * 2019-04-08 https://www.pwinty.com/api/2.6/#orders-get
	 * function@used-by \Inkifi\Pwinty\T\CaseT\V30\Order\Get::t01()
	 * function@used-by \Inkifi\Pwinty\T\CaseT\V30\Order\Submit::t02()
	 * @param eOrder $o
	 * @return eOrder
	 */
	static function p(eOrder $o) {return F::s($o->magentoOrder())->get(
		$o->id(), null, FO::i()->resC(eOrder::class)
	)->res();}
}