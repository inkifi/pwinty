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
 * 2019-04-07
 * Other data example:
 *	{
 *		"generalErrors": [],
 *		"id": "776007",
 *		"isValid": true,
 *		"photos": [
 *			{
 *				"errors": [],
 *				"id": 986282,
 *				"warnings": ["CouldNotValidateImageSize", "CouldNotValidateAspectRatio"]
 *			}
 *		]
 *	}
 * https://www.pwinty.com/api/2.6/#photo-warnings
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