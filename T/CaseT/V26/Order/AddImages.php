<?php
namespace Inkifi\Pwinty\T\CaseT\V26\Order;
use Inkifi\Pwinty\API\B\Order\AddImages as bAddImages;
use Inkifi\Pwinty\API\B\Order\Create as bCreate;
// 2019-04-08
final class AddImages extends \Inkifi\Pwinty\T\CaseT {
	/** 2019-04-08 */
	function t00() {}

	/** @test 2019-04-08 */
	function t01() {echo df_json_encode(bAddImages::p(bCreate::p(df_order(60055)), [
		[
			'attributes' => []
			,'copies' => 1
			,'sizing' => 'Crop'
			,'type' => 'MiniFrame_16x16_LustrePaper_gb'
			,'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg'
		]
		,[
			'attributes' => []
			,'copies' => 1
			,'sizing' => 'Crop'
			,'type' => 'MiniFrame_16x16_LustrePaper_gb'
			,'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a6/Dog_anatomy_lateral_skeleton_view.jpg/726px-Dog_anatomy_lateral_skeleton_view.jpg'
		]
	]));}
}