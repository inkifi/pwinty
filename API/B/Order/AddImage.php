<?php
namespace Inkifi\Pwinty\API\B\Order;
use Df\API\FacadeOptions as FO;
use Inkifi\Pwinty\API\Entity\Image as R;
use Inkifi\Pwinty\API\Entity\Order as eOrder;
use Inkifi\Pwinty\API\Facade\Order as F;
// 2019-04-06
final class AddImage {
	/**
	 * 2019-04-06 https://www.pwinty.com/api/#images-add
	 * A response:
	 *	{
	 *		"attributes": [],
	 *		"copies": 1,
	 *		"errorMessage": null,
	 *		"id": 986207,
	 *		"md5Hash": null,
	 *		"previewUrl": null,
	 *		"price": 1500,
 	 *		"priceToUser": null,
	 *		"sizing": "Crop",
	 *		"status": "NotYetDownloaded",
	 *		"thumbnailUrl": null,
	 *		"type": "MiniFrame_16x16_LustrePaper_gb",
	 *		"url": "https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg"
	 *	}
	 * @used-by \Inkifi\Pwinty\T\CaseT\V30\Order\AddImage::t01()
	 * @used-by \Inkifi\Pwinty\T\CaseT\V30\Order\AddImage::t02()
	 * @used-by \Inkifi\Pwinty\T\CaseT\V30\Order\Get::t01()
	 * @param eOrder $o
	 * @param array(string => mixed)$d
	 * @return R
	 */
	static function p(eOrder $o, array $d) {return F::s($o->magentoOrder())->post(
		$d, "{$o->id()}/images", FO::i()->resC(R::class)
	)->res();}
}