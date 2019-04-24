<?php
namespace Inkifi\Pwinty\API\Entity;
/**
 * 2019-04-07
 * https://www.pwinty.com/api/#images-object
 * https://www.pwinty.com/api/2.6/#photos-get
 * Data structure in API 2.6:
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
 * 2019-04-24
 * Data structures in API 3.0.
 * 1) Without attributes:
 *	{
 *		"attributes": null,
 *		"copies": 1,
 *		"errorMessage": null,
 *		"id": 988488,
 *		"md5Hash": null,
 *		"previewUrl": null,
 *		"price": 0,
 *		"priceToUser": null,
 *		"sizing": "Crop",
 *		"sku": "FRA-INSTA-30X30",
 *		"status": "NotYetDownloaded",
 *		"thumbnailUrl": null,
 *		"url": "https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg"
 *	}
 * 2) With an attribute:
 * {
 *		"attributes": {"frameColour": "white"},
 *		"copies": 1,
 *		"errorMessage": null,
 *		"id": 988508,
 *		"md5Hash": null,
 *		"previewUrl": null,
 *		"price": 0,
 *		"priceToUser": null,
 *		"sizing": "Crop",
 *		"sku": "FRA-INSTA-30X30",
 *		"status": "NotYetDownloaded",
 *		"thumbnailUrl": null,
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
	 * @used-by \Inkifi\Pwinty\AvailableForDownload::images()
	 * @param string[]|null $v [optional]
	 * @return string[]|$this
	 */
	function attributes($v = null) {return df_prop($this, $v);}

	/**
	 * 2019-04-10
	 * «Number of copies of the photo to include in the order».
	 * https://www.pwinty.com/api/2.6/#photos-get
	 * https://www.pwinty.com/api/2.6/#photos-create
	 * https://www.pwinty.com/api/2.6/#photos-create-multiple
	 * @used-by \Inkifi\Pwinty\AvailableForDownload::images()
	 * @param int|null $v [optional]
	 * @return int|$this
	 */
	function copies($v = null) {return df_prop($this, $v, 'int');}

	/**
	 * 2019-04-07
	 * «Unique integer identifying the photo.»
	 * https://www.pwinty.com/api/2.6/#photos-get
	 * @return int «986207»
	 */
	function id() {return (int)$this[__FUNCTION__];}

	/**
	 * 2019-04-10
	 * 1) «How the image should be resized when printing».
	 * https://www.pwinty.com/api/2.6/#photos-get
	 * https://www.pwinty.com/api/2.6/#photos-create
	 * https://www.pwinty.com/api/2.6/#photos-create-multiple
	 * 2) `Crop`, `ShrinkToFit`, `ShrinkToExactFit`
	 * https://www.pwinty.com/api/2.6/#photos-resizing
	 * @used-by \Inkifi\Pwinty\AvailableForDownload::images()
	 * @param string|null $v [optional]
	 * @return string|$this
	 */
	function sizing($v = null) {return df_prop($this, $v);}

	/**
	 * 2019-04-10
	 * API 2.6. «Type of photo».
	 * https://www.pwinty.com/api/2.6/#photos-get
	 * https://www.pwinty.com/api/2.6/#photos-create
	 * https://www.pwinty.com/api/2.6/#photos-create-multiple
	 * 2019-04-24
	 * API 3.0 «An identification code of the product associated with this image».
	 * https://www.pwinty.com/api/#images-object
	 * @used-by \Inkifi\Pwinty\AvailableForDownload::images()
	 * @param string|null $v [optional]
	 * @return string|$this
	 */
	function sku($v = null) {return df_prop($this, $v);}

	/**
	 * 2019-04-10
	 * «If photo is to be downloaded by Pwinty, the photo's URL».
	 * https://www.pwinty.com/api/2.6/#photos-get
	 * https://www.pwinty.com/api/2.6/#photos-create
	 * https://www.pwinty.com/api/2.6/#photos-create-multiple
	 * @used-by \Inkifi\Pwinty\AvailableForDownload::images()
	 * @param string|null $v [optional]
	 * @return string|$this
	 */
	function url($v = null) {return df_prop($this, $v);}
}