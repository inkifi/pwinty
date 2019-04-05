<?php
namespace Inkifi\Pwinty\T\CaseT\V30\Order;
use Inkifi\Pwinty\API\B\Order\AddImage as bAddImage;
use Inkifi\Pwinty\API\B\Order\Create as bCreate;
// 2019-04-06
final class AddImage extends \Inkifi\Pwinty\T\CaseT {
	/** @test 2019-04-06 */
	function t00() {}

	/** 2019-04-06 */
	function t01() {echo df_json_encode(bAddImage::p(bCreate::p(df_order(60055)), [])->a());}
}