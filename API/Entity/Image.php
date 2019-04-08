<?php
namespace Inkifi\Pwinty\API\Entity;
/**
 * 2019-04-07
 * https://www.pwinty.com/api/#images-object
 * https://www.pwinty.com/api/2.6/#photos-get
 * Data structure:
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
 */
final class Image extends \Df\API\Document {
	/**
	 * 2019-04-07
	 * 1) «An object containing all the attributes set on the object.
	 * Refer to the product list for valid attributes for each product.»
	 * https://www.pwinty.com/api/2.6/#photos-get
	 * 2) «An object with properties representing the attributes for the photo.
	 * For valid attributes see the product list.»
	 * https://www.pwinty.com/api/2.6/#photos-create
	 * @return string[]
	 */
	function attributes() {return $this[__FUNCTION__];}

	/**
	 * 2019-04-07
	 * «Unique integer identifying the photo.»
	 * https://www.pwinty.com/api/2.6/#photos-get
	 * @return int «986207»
	 */
	function id() {return (int)$this[__FUNCTION__];}
}