<?php
namespace Inkifi\Pwinty\API\Facade;
use Df\API\Client as ClientBase;
/**
 * 2019-04-04
 * @used-by \Inkifi\Pwinty\API\B\Order\AddImage::p()
 * @used-by \Inkifi\Pwinty\API\B\Order\AddImages::p()
 * @used-by \Inkifi\Pwinty\API\B\Order\Create::p()
 * @used-by \Inkifi\Pwinty\API\B\Order\Submit::p()
 * @used-by \Inkifi\Pwinty\API\B\Order\Validate::p()
 * @method static Order s()
 */
final class Order extends \Df\API\Facade {
	/**
	 * 2019-04-24
	 * @override
	 * @see \Df\API\Facade::adjustClient()
	 * @used-by \Df\API\Facade::p()
	 * @param ClientBase $c
	 */
	protected function adjustClient(ClientBase $c) {$c->logging(true);}
}