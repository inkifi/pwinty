<?php
namespace Inkifi\Pwinty\API\B\Order;
use Df\Core\O;
use Inkifi\Pwinty\API\Entity\Order as eOrder;
use Inkifi\Pwinty\API\Facade\Order as F;
// 2019-04-08
final class Submit {
	/**
	 * 2019-04-08 API 2.6: https://www.pwinty.com/api/2.6/#orders-update-status
	 * 2019-04-24 API 3.0: https://www.pwinty.com/api/#orders-update-status
	 * @used-by \Inkifi\Pwinty\AvailableForDownload::_p()
	 * @param eOrder $o
	 * @return O
	 */
	static function p(eOrder $o) {return F::s($o->magentoOrder())->post(
		['status' => 'Submitted'], "{$o->id()}/status"
	)->res();}
}