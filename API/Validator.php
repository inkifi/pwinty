<?php
namespace Inkifi\Pwinty\API;
/**
 * 2019-04-04
 * The official Pwinty API 3.0 documentation contains a wrong information:
 * it says that in an error case the response should contain the `errorMessage` key:
 * https://www.pwinty.com/api#errors
 * But in my practice with Pwinty API 3.0 a error response looks like this:
 *	{
 *		"data": null,
 *		"statusCode": 500,
 *		"statusTxt": "An error occurred : Something unexpected happened while processing this request"
 *	}
 * @used-by \Inkifi\Pwinty\API\Client::responseValidatorC()
 */
final class Validator extends \Df\API\Response\Validator {
	/**
	 * 2019-04-04
	 * @override
	 * @see \Df\API\Exception::long()
	 * @used-by \Df\API\Client::_p()
	 * @return string|null
	 */
	function long() {return $this->r('data/errorMessage') ?: $this->r('statusTxt');}

	/**
	 * 2019-04-04
	 * @override
	 * @see \Df\API\Response\Validator::valid()
	 * @used-by \Df\API\Client::_p()
	 * @return bool
	 */
	function valid() {return 200 === $this->r('statusCode');}
}