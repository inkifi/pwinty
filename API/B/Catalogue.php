<?php
namespace Inkifi\Pwinty\API\B;
use Inkifi\Pwinty\API\Facade\Catalogue as F;
use Magento\Store\Model\Store as S;
// 2019-04-06
final class Catalogue {
	/**
	 * 2019-03-19
	 * 1) `$api->getCatalogue` is a legacy API call: https://www.pwinty.com/api/2.2/#products-list
	 * It is absent in the latest Pwinty version (2.3.0).
	 * 2) $catalogue has the following format (this example is from the official documentation):
	 *	{
	 *		"country": "United Kingdom",
	 *		"countryCode": "GB",
	 *		"qualityLevel": "Pro",
	 *		"items": [
	 *			{
	 *				attributes: [
	 *					{
	 *						name: "finish",
	 *						validValues: ["matte", "glossy"]
	 *					}
	 *				],
	 *				description: "10x12 Print",
	 *				fullProductHorizontalSize: 10,
	 *				fullProductVerticalSize: 12,
	 *				imageHorizontalSize: 10,
	 *				imageVerticalSize: 12,
	 *				name: "10x12",
	 *				priceGBP: 150,
	 *				priceUSD: 350,
	 *				recommendedHorizontalResolution: 1500,
	 *				recommendedVerticalResolution: 1800,
	 *				shippingBand: "Prints",
	 *				sizeUnits: "inches"
	 *			},
	 *			{}
	 *		],
	 *		shippingRates: [
	 *			{
	 *				band: "Canvas",
	 *				description: "Canvas tracked- UPS",
	 *				isTracked: true,
	 *				priceGBP: 700,
	 *				priceUSD: 1100
	 *			},
	 *			{}
	 *		]
	 *	}
	 * 2019-04-02
	 * I have got a real response via the @see \Inkifi\Pwinty\T\CaseT\V26\Catalogue::t01() test case:
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
	 * 2019-04-06 https://www.pwinty.com/api/2.6/#products-list
	 * @used-by \Inkifi\Pwinty\AvailableForDownload::images()
	 * @used-by \Inkifi\Pwinty\T\CaseT\V26\Catalogue::t01()
	 * @used-by \Inkifi\Pwinty\T\CaseT\V26\Catalogue::t02()
	 * @used-by \Inkifi\Pwinty\T\CaseT\V26\Catalogue::t03()
	 * @param S $s
	 * @return array(array(string => mixed))
	 */
	static function p(S $s) {return dfcf(function() use($s) {return
		F::s()->get(ikf_pw_country($s), 'Pro')['items']
	;}, [$s->getCode()]);}
}