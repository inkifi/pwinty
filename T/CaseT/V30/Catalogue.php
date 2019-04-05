<?php
namespace Inkifi\Pwinty\T\CaseT\V30;
use Inkifi\Pwinty\API\B\Catalogue\Prices as bPrices;
// 2019-04-06
final class Catalogue extends \Inkifi\Pwinty\T\CaseT {
	/** 2019-04-06 */
	function t00() {}

	/**
	 * @test 2019-04-06
	 */
	function t01() {echo df_json_encode(bPrices::p(df_order(60055)->getStore())->a());}
}