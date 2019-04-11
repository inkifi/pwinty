<?php
namespace Inkifi\Pwinty\API\B\Order;
use Df\API\FacadeOptions as FO;
use Inkifi\Pwinty\API\Entity\Order as eOrder;
use Inkifi\Pwinty\API\Entity\Order\ValidationResult as R;
use Inkifi\Pwinty\API\Facade\Order as F;
// 2019-04-05
final class Validate {
	/**
	 * 2019-04-05 https://www.pwinty.com/api/#orders-validate
	 * @used-by \Inkifi\Pwinty\AvailableForDownload::_p()
	 * @used-by \Inkifi\Pwinty\T\CaseT\V26\Order\Create::t01()
	 * @used-by \Inkifi\Pwinty\T\CaseT\V26\Order\Validate::t01()
	 * @used-by \Inkifi\Pwinty\T\CaseT\V26\Order\Validate::t02()
	 * @used-by \Inkifi\Pwinty\T\CaseT\V26\Order\Validate::t03()
	 * @param eOrder $o
	 * @return R
	 */
	static function p(eOrder $o) {return F::s($o->magentoOrder())->get(
		$o->id(), 'SubmissionStatus', FO::i()->resC(R::class)
	)->res();}
}