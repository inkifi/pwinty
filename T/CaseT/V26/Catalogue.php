<?php
namespace Inkifi\Pwinty\T\CaseT\V26;
use Inkifi\Pwinty\API\B\Catalogue as bCatalogue;
// 2019-04-06
final class Catalogue extends \Inkifi\Pwinty\T\CaseT {
	/** @test 2019-04-06 */
	function t00() {}

	/** 2019-04-06 https://www.pwinty.com/api/2.6/#products-list */
	function t01() {echo df_json_encode(bCatalogue::p(df_order(60055)->getStore()));}

	/**
	 * 2019-04-02
	 * An item with attributes:
	 *	{
	 *		"attributes": [
	 *			{
	 *				"name": "finish",
	 *				"validValues": ["matte", "glossy"]
	 *			}
	 *		],
	 *		"description": "5x5 inch print",
	 *		"errorMessage": null,
	 *		"fullProductHorizontalSize": 5,
	 *		"fullProductVerticalSize": 5,
	 *		"imageHorizontalSize": 5,
	 *		"imageVerticalSize": 5,
	 *		"itemType": "Print",
	 *		"name": "5x5",
	 *		"priceGBP": 60,
	 *		"priceUSD": 78,
	 *		"recommendedHorizontalResolution": 750,
	 *		"recommendedVerticalResolution": 750,
	 *		"shippingBand": "Prints",
	 *		"sizeUnits": "inches"
	 *	}
	 */
	function t02() {echo df_json_encode(array_filter(
		bCatalogue::p(df_order(60055)->getStore()), function(array $i) {return $i['attributes'];}
	));}

	/**
	 * 2019-04-02
	 * An item with multiple attributes:
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
	function t03() {echo df_json_encode(array_filter(
		bCatalogue::p(df_order(60055)->getStore())
		,function(array $i) {return 1 < count($i['attributes']);}
	));}

	/** 2019-04-11 */
	function t04() {
		/** @var array(array(string => mixed)) $products */
		$products = bCatalogue::p(df_order(60055)->getStore());
		$map = []; /** @var array(string => array(string => mixed)) $map */
		foreach ($products as $p) { /** @var array(string => mixed) $p */
			$n = $p['name']; /** @var string $n */
			if (!isset($map[$n])) {
				$map[$n] = $p;
			}
			else {
				echo "A duplicated name: $n\n";
			}
		}
	}
}