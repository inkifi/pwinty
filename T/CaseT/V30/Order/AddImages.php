<?php
namespace Inkifi\Pwinty\T\CaseT\V30\Order;
use Inkifi\Pwinty\API\B\Order\AddImages as bAddImages;
use Inkifi\Pwinty\API\B\Order\Create as bCreate;
use Inkifi\Pwinty\API\Entity\Image as eImage;
// 2019-04-24
final class AddImages extends \Inkifi\Pwinty\T\CaseT {
	/** 2019-04-24 */
	function t00() {}

	/** @test 2019-04-24 */
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

	/**
	 * 2019-04-24
	 *	[
	 *		{
	 *			"attributes": {"frame_colour": "gold"},
	 *			"copies": 1,
	 *			"errorMessage": null,
	 *			"id": 986984,
	 *			"md5Hash": null,
	 * 			"previewUrl": null,
	 *			"price": 9750,
	 *			"priceToUser": null,
	 *			"sizing": "Crop",
	 *			"status": "NotYetDownloaded",
	 *			"thumbnailUrl": null,
	 *			"type": "BoxFrame_24x48_Unmounted",
	 *			"url": "https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg"
	 *		}
	 *	]
	 */
	function t02() {echo df_json_encode(array_map(
		function(eImage $i) {return $i->a();}
		,bAddImages::p(bCreate::p(df_order(60055)), [
			(new eImage)
				->attributes(['frame_colour' => 'gold'])
				->copies(1)
				->sizing('Crop')
				->sku('BoxFrame_24x48_Unmounted')
				->url('https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg')
		])
	));}
}