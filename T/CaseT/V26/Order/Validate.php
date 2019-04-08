<?php
namespace Inkifi\Pwinty\T\CaseT\V26\Order;
use Inkifi\Pwinty\API\B\Order\AddImage as bAddImage;
use Inkifi\Pwinty\API\B\Order\Create as bCreate;
use Inkifi\Pwinty\API\B\Order\Validate as bValidate;
use Inkifi\Pwinty\API\Entity\Order as eO;
// 2019-04-05
final class Validate extends \Inkifi\Pwinty\T\CaseT {
	/** 2019-04-05 */
	function t00() {}

	/** 2019-04-05 */
	function t01() {echo df_json_encode(bValidate::p(bCreate::p(df_order(60055)))->a());}

	/** 2019-04-05 */
	function t02() {echo df_bts(bValidate::p(bCreate::p(df_order(60055)))->valid());}

	/** 2019-04-05 */
	function t03() {echo df_json_encode(bValidate::p(bCreate::p(df_order(60055)))->errors());}

	/**
	 * @test 2019-04-07
	 *	{
	 *		"generalErrors": [],
	 *		"id": "776007",
	 *		"isValid": true,
	 *		"photos": [
	 *			{
	 *				"errors": [],
	 *				"id": 986282,
	 *				"warnings": ["CouldNotValidateImageSize", "CouldNotValidateAspectRatio"]
	 *			}
	 *		]
	 *	}
	 * https://www.pwinty.com/api/2.6/#photo-warnings
	 */
	function t04() {
		$eO = bCreate::p(df_order(60055)); /** @var eO $eO */
		bAddImage::p($eO, [
			'attributes' => []
			,'copies' => 1
			,'sizing' => 'Crop'
			,'type' => 'MiniFrame_16x16_LustrePaper_gb'
			,'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg'
		]);
		echo df_json_encode(bValidate::p($eO)->a());
	}
}