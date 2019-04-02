<?php
namespace Inkifi\Pwinty\T\CaseT\V22;
use Inkifi\Pwinty\Settings as S;
use pwinty\PhpPwinty as API;
// 2019-04-02
final class Catalogue extends \Inkifi\Pwinty\T\CaseT\V22 {
	/** @test 2019-04-02 */
	function t00() {}

	/**
	 * @test 2019-04-02
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
	 */
	function t01() {
		$s = S::s(); /** @var S $s */
		$api = new API([
			'api' => $s->test() ? 'sandbox' : 'production'
			,'apiKey' => $s->privateKey()
			,'merchantId' => $s->merchantID()
		]); /** @var API $api */
		$catalogue = $api->getCatalogue('GB', 'Pro'); /** @var array(string => mixed) $catalogue */
		echo df_json_encode($catalogue);
	}
}