<?php
use Inkifi\Pwinty\Settings as SS;
use Magento\Store\Model\Store;
use pwinty\PhpPwinty as API;
/**
 * 2019-04-02
 * An API response before evaluating the ['items'] hash:
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
 * @used-by ikf_pw_items()
 * @used-by \Inkifi\Pwinty\AvailableForDownload::_p()
 * @param Store|int|null $s [optional]
 * @return API
 */
function ikf_pw_api($s = null) {return dfcf(function(Store $s) {
	$ss = SS::s($s); /** @var SS $ss */
	return new API([
		'api' => $ss->test() ? 'sandbox' : 'production'
		,'apiKey' => $ss->privateKey()
		,'merchantId' => $ss->merchantID()
	]); /** @var API $api */
}, [df_store($s)]);}

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
 * I have got a real response via the @see \Inkifi\Pwinty\T\CaseT\V22\Catalogue::t01() test case:
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
 * @used-by \Inkifi\Pwinty\AvailableForDownload::_p()
 * @used-by \Inkifi\Pwinty\T\CaseT\V22\Catalogue::t01()
 * @used-by \Inkifi\Pwinty\T\CaseT\V22\Catalogue::t02()
 * @used-by \Inkifi\Pwinty\T\CaseT\V22\Catalogue::t03()
 * @param Store|int|null $s [optional]
 * @return mixed
 */
function ikf_pw_items($s = null) {return ikf_pw_api($s)->getCatalogue('GB', 'Pro')['items'];}