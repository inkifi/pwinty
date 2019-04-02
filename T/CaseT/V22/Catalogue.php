<?php
namespace Inkifi\Pwinty\T\CaseT\V22;
use Inkifi\Pwinty\Settings as S;
use pwinty\PhpPwinty as API;
// 2019-04-02
final class Catalogue extends \Inkifi\Pwinty\T\CaseT\V22 {
	/** @test 2019-04-02 */
	function t00() {}

	/** 2019-04-02 */
	function t01() {echo df_json_encode(self::catalogue());}

	/**
	 * @test 2019-04-02
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
	function t02() {echo df_json_encode(array_filter(self::catalogue()['items'], function(array $i) {return
		$i['attributes']
	;}));}

	/**
	 * 2019-04-02
	 * A response:
	 * {
	 *		"country": "UNITED KINGDOM",
	 *		"countryCode": "GB",
	 *		"errorMessage": null,
	 *		"items": {
	 *			"0": {
	 *				"attributes": [],
	 *				"description": "10x10 inch print",
	 *				"errorMessage": null,
	 *				"fullProductHorizontalSize": 10,
	 *				"fullProductVerticalSize": 10,
	 *				"imageHorizontalSize": 10,
	 *				"imageVerticalSize": 10,
	 *				"itemType": "Print",
	 *				"name": "10x10",
	 *				"priceGBP": 200,
	 *				"priceUSD": 261,
	 *				"recommendedHorizontalResolution": 1500,
	 *				"recommendedVerticalResolution": 1500,
	 *				"shippingBand": "Prints",
	 *				"sizeUnits": "inches"
	 *			},
	 *			<...>
	 *		},
	 *		"qualityLevel": "Pro",
	 *		"shippingRates": [
	 *			{
	 *				"band": "LargePrints",
	 *				"description": "1st Class Royal Mail",
	 *				"isTracked": false,
	 *				"priceGBP": 399,
	 *				"priceUSD": 521
	 *			},
	 *			<...>
	 *		]
	 *	}
	 * @used-by t01()
	 * @used-by t02()
	 * @return @var array(string => mixed)
	 */
	private static function catalogue() {
		$s = S::s(); /** @var S $s */
		$api = new API([
			'api' => $s->test() ? 'sandbox' : 'production'
			,'apiKey' => $s->privateKey()
			,'merchantId' => $s->merchantID()
		]); /** @var API $api */
		return $api->getCatalogue('GB', 'Pro');
	}
}