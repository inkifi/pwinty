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
 * 2019-04-10
 * @used-by \Inkifi\Pwinty\API\B\Catalogue::p()
 * @used-by \Inkifi\Pwinty\API\B\Order\Create::p()
 * @param Store $s
 * @return string
 */
function ikf_pw_country(Store $s) {return strtoupper(dftr($s->getCode(), ['uk' => 'gb']));}