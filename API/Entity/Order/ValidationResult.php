<?php
namespace Inkifi\Pwinty\API\Entity\Order;
/**
 * 2019-04-06 https://www.pwinty.com/api/#orders-validatee
 * @used-by \Inkifi\Pwinty\API\B\Order\Validate::p()
 * Data structure:
 *	{
 *		"generalErrors": ["NoItemsInOrder"],
 *		"id": "775865",
 *		"isValid": false,
 *		"photos": []
 *	}
 */
final class ValidationResult extends \Df\API\Document {
	/**
	 * 2019-04-06
	 * @used-by \Inkifi\Pwinty\T\CaseT\V26\Order\Validate::t03()
	 * @return string[]
	 */
	function errors() {return $this['generalErrors'];}

	/**
	 * 2019-04-06
	 * @used-by \Inkifi\Pwinty\API\Entity\Order\ValidationResult::valid()
	 * @return bool
	 */
	function valid() {return $this['isValid'];}
}