<?php
namespace Inkifi\Pwinty\API\B\Catalogue;
use Df\API\Document as D;
use Inkifi\Pwinty\API\Facade\Catalogue as F;
use Magento\Store\Model\Store as S;
// 2019-04-06
final class Prices {
	/**
	 * 2019-04-06
	 * https://www.pwinty.com/api/#catalogue-prices
	 * @param S $s
	 * @return D
	 */
	static function p(S $s) {return F::s()->post([], "{$s->getCode()}/prices")->res();}
}