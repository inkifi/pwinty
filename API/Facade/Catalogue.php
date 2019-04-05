<?php
namespace Inkifi\Pwinty\API\Facade;
/**
 * 2019-04-06
 * @used-by \Inkifi\Pwinty\API\B\Order\Create::p()
 * @used-by \Inkifi\Pwinty\API\B\Order\Validate::p()
 * @method static Order s()
 */
final class Catalogue extends \Df\API\Facade {
	/**
	 * 2019-04-06
	 * @override
	 * @see \Df\API\Facade::path()
	 * @used-by \Df\API\Facade::p()
	 * @param int|string|null $id
	 * @param string|null $suffix
	 * @return string
	 */
	protected function path($id, $suffix) {return "catalogue/prodigi%20direct/destination/$suffix";}
}