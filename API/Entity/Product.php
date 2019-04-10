<?php
namespace Inkifi\Pwinty\API\Entity;
/**
 * 2019-04-11
 * https://www.pwinty.com/api/2.6/#products-list
 * Data structure:
 *	{
 *		"attributes": [
 *			{
 *				"name": "paper",
 *				"validValues": ["smooth_art", "cold_press_watercolour"]
 *			},
 *			{
 *				"name": "frame_colour",
 *				"validValues": ["gold", "silver", "natural", "dark_brown", "black", "white"]
 *			},
 *			{
 *				"name": "hanging_orientation",
 *				"validValues": ["portrait", "landscape"]
 *			},
 *			{
 *				"name": "glaze",
 *				"validValues": ["float_glass", "acrylic"]
 *			}
 *		],
 *		"description": "Box Framed, unmounted 24x48 fine art print",
 *		"errorMessage": null,
 *		"fullProductHorizontalSize": 24,
 *		"fullProductVerticalSize": 48,
 *		"imageHorizontalSize": 24,
 *		"imageVerticalSize": 48,
 *		"itemType": "Framed Poster",
 *		"name": "BoxFrame_24x48_Unmounted",
 *		"priceGBP": 9750,
 *		"priceUSD": 12735,
 *		"recommendedHorizontalResolution": 3600,
 *		"recommendedVerticalResolution": 7200,
 *		"shippingBand": "FramedPrints",
 *		"sizeUnits": "inches"
 *	}
 */
final class Product extends \Df\API\Document {
	/**
	 * 2019-04-11
	 * @return bool
	 */
	function hasFrameColor() {return dfc($this, function() {return !!df_find(
		$this->attributes(), function(array $a) {'frame_colour' === $a['name'];})
	;});}

	/** @noinspection PhpDocSignatureInspection */
	/**
	 * 2019-04-11 «MiniFrame_16x16_LustrePaper_gb»
	 * @used-by \Inkifi\Pwinty\AvailableForDownload::images()
	 * @return string
	 */
	function name() {return $this[__FUNCTION__];}

	/**
	 * 2019-04-11
	 *		[
	 *			{
	 *				"name": "paper",
	 *				"validValues": ["smooth_art", "cold_press_watercolour"]
	 *			},
	 *			{
	 *				"name": "frame_colour",
	 *				"validValues": [
	 * 					"gold", "silver", "natural", "dark_brown", "black", "white"
	 * 				]
	 *			},
	 *			{
	 *				"name": "hanging_orientation",
	 *				"validValues": ["portrait", "landscape"]
	 *			},
	 *			{
	 *				"name": "glaze",
	 *				"validValues": ["float_glass", "acrylic"]
	 *			}
	 *		]
	 * @used-by hasFrameColor()
	 * @return array(array(string => mixed))
	 */
	private function attributes() {return $this[__FUNCTION__];}
}