<?php
namespace Inkifi\Pwinty\T\CaseT\V22;
use Inkifi\Pwinty\Settings as S;
use pwinty\PhpPwinty as API;
// 2019-04-02
final class Catalogue extends \Inkifi\Pwinty\T\CaseT\V22 {
	/** @test 2019-04-02 */
	function t00() {}

	/** @test 2019-04-02 */
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