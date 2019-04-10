<?php
namespace Inkifi\Pwinty\API\B\Order;
use Inkifi\Pwinty\API\Entity\Image as eImage;
use Inkifi\Pwinty\API\Entity\Order as eOrder;
use Inkifi\Pwinty\API\Facade\Order as F;
// 2019-04-08
final class AddImages {
	/**
	 * 2019-04-08 https://www.pwinty.com/api/2.6#photos-create-multiple
	 * A response:
	 *	{
	 *		"errorMessage": null,
	 *		"items": [
	 *			{
	 *				"attributes": [],
	 *				"copies": 1,
	 *				"errorMessage": null,
	 *				"id": 986901,
	 *				"md5Hash": null,
	 *				"previewUrl": null,
	 *				"price": 1500,
	 * 				"priceToUser": null,
	 *				"sizing": "Crop",
	 *				"status": "NotYetDownloaded",
	 *				"thumbnailUrl": null,
	 *				"type": "MiniFrame_16x16_LustrePaper_gb",
	 *				"url": "https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg"
	 *			},
	 *			{
	 *				"attributes": [],
	 *				"copies": 1,
	 *				"errorMessage": null,
	 *				"id": 986902,
	 *				"md5Hash": null,
	 *				"previewUrl": null,
	 *				"price": 1500,
	 *				"priceToUser": null,
	 *				"sizing": "Crop",
	 *				"status": "NotYetDownloaded",
	 *				"thumbnailUrl": null,
	 *				"type": "MiniFrame_16x16_LustrePaper_gb",
	 *				"url": "https://upload.wikimedia.org/wikipedia/commons/thumb/a/a6/Dog_anatomy_lateral_skeleton_view.jpg/726px-Dog_anatomy_lateral_skeleton_view.jpg"
	 *			}
	 *		]
	 *	}
	 * @used-by \Inkifi\Pwinty\T\CaseT\V26\Order\AddImages::t01()
	 * @param eOrder $o
	 * @param eImage[] $images
	 * @return eImage[]
	 */
	static function p(eOrder $o, array $images) {return array_map(
		function(array $i) {return new eImage($i);}
		,F::s($o->magentoOrder())->post(
			array_map(function(eImage $i) {return $i->a();}, $images), "{$o->id()}/Photos/Batch"
		)['items']
	);}
}