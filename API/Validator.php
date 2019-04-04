<?php
namespace Inkifi\Pwinty\API;
// 2019-04-04 https://www.pwinty.com/api#errors
/** @used-by \Inkifi\Pwinty\API\Client::responseValidatorC() */
final class Validator extends \Df\API\Response\Validator {
	/**
	 * 2019-04-04
	 * @override
	 * @see \Df\API\Exception::long()
	 * @used-by valid()
	 * @used-by \Df\API\Client::_p()
	 * @return string|null
	 */
	function long() {return $this->r('errorMessage');}

	/**
	 * 2019-04-04
	 * @override
	 * @see \Df\API\Response\Validator::valid()
	 * @used-by \Df\API\Client::_p()
	 * @return bool
	 */
	function valid() {return !$this->long();}
}