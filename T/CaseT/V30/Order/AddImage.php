<?php
namespace Inkifi\Pwinty\T\CaseT\V30\Order;
use Inkifi\Pwinty\API\B\Order\AddImage as bAddImage;
use Inkifi\Pwinty\API\B\Order\Create as bCreate;
// 2019-04-06
final class AddImage extends \Inkifi\Pwinty\T\CaseT {
	/** @test 2019-04-06 */
	function t00() {}

	/**
	 * 2019-04-06
	 * «SKU not in catalogue»
	 */
	function t01() {echo df_json_encode(bAddImage::p(bCreate::p(df_order(60055)), [
		'attributes' => []
		,'copies' => 1
		,'md5Hash' => md5(df_uid())
		//,'priceToUser' => ''
		,'sizing' => 'Crop'
		,'sku' => df_uid()
		,'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg'
	])->a());}

	/**
	 * 2019-04-06
	 * «SKU has been deleted from the catalogue»
	 */
	function t02() {echo df_json_encode(bAddImage::p(bCreate::p(df_order(60055)), [
		'attributes' => []
		,'copies' => 1
		,'md5Hash' => md5(df_uid())
		//,'priceToUser' => ''
		,'sizing' => 'Crop'
		,'sku' => 'ART-PRI-HPG-20X28-PRODIGI_GB'
		,'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Cat_poster_1.jpg/1024px-Cat_poster_1.jpg'
	])->a());}
}