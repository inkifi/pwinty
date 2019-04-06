<?php
namespace Inkifi\Pwinty\API\B;
use Df\API\Document as D;
use Inkifi\Pwinty\API\Facade\Catalogue as F;
use Magento\Store\Model\Store as S;
// 2019-04-06
final class Catalogue {
	/**
	 * 2019-04-06 https://www.pwinty.com/api/2.6/#products-list
	 * @param S $s
	 * @return D
	 */
	static function p(S $s) {return F::s()->get(
		strtoupper(dftr($s->getCode(), ['uk' => 'gb'])), 'Pro'
	)->res();}
}