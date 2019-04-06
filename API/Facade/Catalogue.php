<?php
namespace Inkifi\Pwinty\API\Facade;
use Df\API\Client as ClientBase;
use Inkifi\Pwinty\API\Client;
/**
 * 2019-04-06 https://www.pwinty.com/api/2.6/#products-list
 * @used-by \Inkifi\Pwinty\API\B\Order\Create::p()
 * @used-by \Inkifi\Pwinty\API\B\Order\Validate::p()
 * @method static Order s()
 */
final class Catalogue extends \Df\API\Facade {
	/**
	 * 2019-04-06
	 * There is no possiblity to get the catalog in the latest Pwinty API version (3.0),
	 * so I use a legacy version for it.
	 * @override
	 * @see \Df\API\Facade::adjustClient()
	 * @used-by \Df\API\Facade::p()
	 * @param Client|ClientBase $c
	 */
	protected function adjustClient(ClientBase $c) {/*$c->version('2.6');*/}

	/**
	 * 2019-04-06
	 * @override
	 * @see \Df\API\Facade::path()
	 * @used-by \Df\API\Facade::p()
	 * @param int|string|null $id
	 * @param string|null $suffix
	 * @return string
	 */
	protected function path($id, $suffix) {return "Catalogue/$id/$suffix";}
}