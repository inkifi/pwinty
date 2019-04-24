<?php
namespace Inkifi\Pwinty\T\CaseT\V30\Order;
use Inkifi\Pwinty\API\B\Order\AddImage as bAddImage;
use Inkifi\Pwinty\API\B\Order\Create as bCreate;
use Inkifi\Pwinty\API\B\Order\Validate as bValidate;
use Inkifi\Pwinty\API\Entity\Order as eO;
// 2019-04-24
final class Validate extends \Inkifi\Pwinty\T\CaseT {
	/** 2019-04-24 */
	function t00() {}

	/**
	 * 2019-04-24
	 * A response:
	 *	{
	 *		"generalErrors": ["NoItemsInOrder"],
	 *		"id": "778536",
	 *		"isValid": false,
	 *		"photos": []
	 *	}
	 */
	function t01() {echo df_json_encode(bValidate::p(bCreate::p(df_order(60055)))->a());}

	/** 2019-04-24 A response: `false` */
	function t02() {echo df_bts(bValidate::p(bCreate::p(df_order(60055)))->valid());}

	/** 2019-04-24 A response: ["NoItemsInOrder"] */
	function t03() {echo df_json_encode(bValidate::p(bCreate::p(df_order(60055)))->errors());}

	/**
	 * @test
	 * 2019-04-07
	 * A response from API 2.6:
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
	 * 2019-04-24
	 * A response from API 3.0:
	 *	{
	 *		"generalErrors": [],
	 *		"id": "778541",
	 *		"isValid": true,
	 *		"photos": []
	 *	}
	 */
	function t04() {
		$eO = bCreate::p(df_order(60055)); /** @var eO $eO */
		bAddImage::p($eO, [
			'attributes' => []
			,'copies' => 1
			,'sizing' => 'Crop'
			,'sku' => 'FRA-INSTA-30X30'
			,'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg'
		]);
		echo df_json_encode(bValidate::p($eO)->a());
	}
}