<?php
namespace Inkifi\Pwinty\T\CaseT\V30\Order;
use Inkifi\Pwinty\API\B\Order\AddImages as bAddImages;
use Inkifi\Pwinty\API\B\Order\Create as bCreate;
use Inkifi\Pwinty\API\Entity\Image as eImage;
// 2019-04-24
final class AddImages extends \Inkifi\Pwinty\T\CaseT {
	/** @test 2019-04-24 */
	function t00() {}

	/** 2019-04-24 */
	function t01() {echo df_json_encode(array_map(
		function(eImage $i) {return $i->a();}
		,bAddImages::p(bCreate::p(df_order(60055)), [
			(new eImage)
				->attributes([])
				->copies(1)
				->sizing('Crop')
				->sku('FRA-INSTA-30X30')
				->url('https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg')
			,(new eImage)
				->attributes([])
				->copies(1)
				->sizing('Crop')
				->sku('FRA-INSTA-30X30')
				->url('https://upload.wikimedia.org/wikipedia/commons/thumb/a/a6/Dog_anatomy_lateral_skeleton_view.jpg/726px-Dog_anatomy_lateral_skeleton_view.jpg')
		])
	));}

	/** 2019-04-24 «Invalid attribute name frame_colour» */
	function t02() {echo df_json_encode(array_map(
		function(eImage $i) {return $i->a();}
		,bAddImages::p(bCreate::p(df_order(60055)), [
			(new eImage)
				->attributes(['frame_colour' => 'gold'])
				->copies(1)
				->sizing('Crop')
				->sku('FRA-INSTA-30X30')
				->url('https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg')
		])
	));}

	/**
	 * 2019-04-24
	 * «Value of 'gold' supplied for attribute 'frameColour' isn't in the list of supported values.
	 * Valid values are: [white,black]»
	 */
	function t03() {echo df_json_encode(array_map(
		function(eImage $i) {return $i->a();}
		,bAddImages::p(bCreate::p(df_order(60055)), [
			(new eImage)
				->attributes(['frameColour' => 'gold'])
				->copies(1)
				->sizing('Crop')
				->sku('FRA-INSTA-30X30')
				->url('https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg')
		])
	));}

	/**
	 * 2019-04-24
	 * [
	 *		{
	 *			"attributes": {
	 *				"frameColour": "white"
	 *			},
	 *			"copies": 1,
	 *			"errorMessage": null,
	 *			"id": 988508,
	 *			"md5Hash": null,
	 *			"previewUrl": null,
	 *			"price": 0,
	 *			"priceToUser": null,
	 *			"sizing": "Crop",
	 *			"sku": "FRA-INSTA-30X30",
	 *			"status": "NotYetDownloaded",
	 *			"thumbnailUrl": null,
	 *			"url": "https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg"
	 *		}
	 *	]
	 */
	function t04() {echo df_json_encode(array_map(
		function(eImage $i) {return $i->a();}
		,bAddImages::p(bCreate::p(df_order(60055)), [
			(new eImage)
				->attributes(['frameColour' => 'white'])
				->copies(1)
				->sizing('Crop')
				->sku('FRA-INSTA-30X30')
				->url('https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg')
		])
	));}
}