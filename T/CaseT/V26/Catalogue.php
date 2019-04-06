<?php
namespace Inkifi\Pwinty\T\CaseT\V26;
use Inkifi\Pwinty\API\B\Catalogue as bCatalogue;
// 2019-04-06
final class Catalogue extends \Inkifi\Pwinty\T\CaseT {
	/** @test 2019-04-06 */
	function t00() {}

	/**
	 * 2019-04-06
	 */
	function t01() {echo df_json_encode(bCatalogue::p(df_order(60055)->getStore())->a());}
}