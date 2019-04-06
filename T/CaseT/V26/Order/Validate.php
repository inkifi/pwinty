<?php
namespace Inkifi\Pwinty\T\CaseT\V26\Order;
use Inkifi\Pwinty\API\B\Order\Create as bCreate;
use Inkifi\Pwinty\API\B\Order\Validate as bValidate;
// 2019-04-05
final class Validate extends \Inkifi\Pwinty\T\CaseT {
	/** @test 2019-04-05 */
	function t00() {}

	/** 2019-04-05 */
	function t01() {echo df_json_encode(bValidate::p(bCreate::p(df_order(60055)))->a());}

	/** 2019-04-05 */
	function t02() {echo df_bts(bValidate::p(bCreate::p(df_order(60055)))->valid());}

	/** 2019-04-05 */
	function t03() {echo df_json_encode(bValidate::p(bCreate::p(df_order(60055)))->errors());}
}