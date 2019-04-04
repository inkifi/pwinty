<?php
namespace Inkifi\Pwinty\API;
use Inkifi\Pwinty\Settings as S;
// 2019-04-04 https://www.pwinty.com/api
final class Client extends \Df\API\Client {
	/**
	 * 2019-04-04 https://www.pwinty.com/api#format
	 * @override
	 * @see \Df\API\Client::_construct()
	 * @used-by \Df\API\Client::__construct()
	 */
	protected function _construct() {
		parent::_construct();
		$this->reqJson();
		$this->resJson();
		// 2019-04-04 A response: {"data": {<...>}, "statusCode": 200, "statusTxt": "OK"}
		$this->resPath('data');
	}

	/**
	 * 2019-04-04 https://www.pwinty.com/api#format
	 * @override
	 * @see \Df\API\Client::headers()
	 * @used-by \Df\API\Client::__construct()
	 * @used-by \Df\API\Client::_p()
	 * @return array(string => string)
	 */
	protected function headers() {$s = $this->s(); /** @var S $s */ return [
		'Accept' => 'application/json'
		,'Content-Type' => 'application/json'
		// 2019-04-04 https://www.pwinty.com/api#authentication
		,'X-Pwinty-MerchantId' => $s->merchantID()
		,'X-Pwinty-REST-API-Key' => $s->privateKey()
	];}

	/**
	 * 2019-04-04
	 * @override
	 * @see \Df\API\Client::responseValidatorC()
	 * @used-by \Df\API\Client::p()
	 * @return string
	 */
	protected function responseValidatorC() {return \Inkifi\Pwinty\API\Validator::class;}

	/**
	 * 2019-04-04
	 * @override
	 * @see \Df\API\Client::urlBase()
	 * @used-by \Df\API\Client::__construct()
	 * @used-by \Df\API\Client::url()
	 * @return string
	 */
	protected function urlBase() {return df_url_staged(
		$this->s()->test(), 'https://{stage}.pwinty.com/v3.0', ['sandbox', 'api']
	);}

	/**
	 * 2019-04-04
	 * @used-by headers()
	 * @used-by urlBase()
	 * @return S
	 */
	private function s() {return dfc($this, function() {return S::s($this->store());});}
}