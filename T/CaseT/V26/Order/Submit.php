<?php
namespace Inkifi\Pwinty\T\CaseT\V26\Order;
use Inkifi\Pwinty\API\B\Order\AddImage as bAddImage;
use Inkifi\Pwinty\API\B\Order\Create as bCreate;
use Inkifi\Pwinty\API\B\Order\Submit as bSubmit;
use Inkifi\Pwinty\API\Entity\Order as eO;
// 2019-04-08
final class Submit extends \Inkifi\Pwinty\T\CaseT {
	/** @test 2019-04-08 */
	function t00() {}

	/** 2019-04-08 */
	function t01() {
		$eO = bCreate::p(df_order(60055)); /** @var eO $eO */
		bAddImage::p($eO, [
			'attributes' => []
			,'copies' => 1
			,'sizing' => 'Crop'
			,'type' => 'MiniFrame_16x16_LustrePaper_gb'
			,'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg'
		]);
		echo df_json_encode(bSubmit::p($eO)->a());
	}
}