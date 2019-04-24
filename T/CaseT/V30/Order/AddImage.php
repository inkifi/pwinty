<?php
namespace Inkifi\Pwinty\T\CaseT\V30\Order;
use Inkifi\Pwinty\API\B\Order\AddImage as bAddImage;
use Inkifi\Pwinty\API\B\Order\Create as bCreate;
// 2019-04-24
final class AddImage extends \Inkifi\Pwinty\T\CaseT {
	/** 2019-04-24 */
	function t00() {}

	/** 2019-04-24 «SKU not in catalogue» */
	function t01() {echo df_json_encode(bAddImage::p(bCreate::p(df_order(60055)), [
		'attributes' => []
		,'copies' => 1
		,'md5Hash' => md5(df_uid())
		,'sizing' => 'Crop'
		,'sku' => df_uid()
		,'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg'
	])->a());}

	/** 2019-04-24 «SKU has been deleted from the catalogue» */
	function t02() {echo df_json_encode(bAddImage::p(bCreate::p(df_order(60055)), [
		'attributes' => []
		,'copies' => 1
		,'md5Hash' => md5(df_uid())
		,'sizing' => 'Crop'
		,'sku' => 'ART-PRI-HPG-20X28-PRODIGI_GB'
		,'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg'
	])->a());}

	/** 2019-04-24 «This SKU is for an earlier version of the API» */
	function t03() {echo df_json_encode(bAddImage::p(bCreate::p(df_order(60055)), [
		'attributes' => []
		,'copies' => 1
		,'md5Hash' => md5(df_uid())
		,'sizing' => 'Crop'
		,'sku' => 'samsunggalaxys6edge_case'
		,'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg'
	])->a());}

	/** 2019-04-24 «This SKU is for an earlier version of the API» */
	function t04() {echo df_json_encode(bAddImage::p(bCreate::p(df_order(60055)), [
		'attributes' => []
		,'copies' => 1
		,'md5Hash' => md5(df_uid())
		,'sizing' => 'Crop'
		,'sku' => 'MiniFrame_16x16_LustrePaper_gb'
		,'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg'
	])->a());}

	/** 2019-04-24 */
	function t05() {echo df_json_encode(bAddImage::p(bCreate::p(df_order(60055)), [
		'attributes' => []
		,'copies' => 1
		,'sizing' => 'Crop'
		,'sku' => 'FRA-INSTA-30X30'
		,'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg'
	])->id());}

	/** @test 2019-04-24
	 * A response:
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
	 */
	function t06() {echo df_json_encode(bAddImage::p(bCreate::p(df_order(60055)), [
		'attributes' => []
		,'copies' => 1
		,'sizing' => 'Crop'
		,'sku' => 'FRA-INSTA-30X30'
		,'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg'
	])->a());}
}