<?php
namespace Inkifi\Pwinty\API\B\Order;
use Df\API\Document as D;
use Inkifi\Pwinty\API\Entity\Order as eOrder;
use Inkifi\Pwinty\API\Facade\Order as F;
// 2019-04-08
final class Submit {
	/**
	 * 2019-04-08 https://www.pwinty.com/api/2.6/#orders-update-status
	 * @param eOrder $o
	 * @return D
	 */
	static function p(eOrder $o) {return F::s($o->magentoOrder())->post(
		['status' => 'Submitted'], "{$o->id()}/Status"
	)->res();}
}