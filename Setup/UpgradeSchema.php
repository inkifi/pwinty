<?php
namespace Inkifi\Pwinty\Setup;
// 2019-04-03
/** @final Unable to use the PHP «final» keyword here because of the M2 code generation. */
class UpgradeSchema extends \Df\Framework\Upgrade\Schema {
	/**
	 * 2019-04-03
	 * @override
	 * @see \Df\Framework\Upgrade::_process()
	 * @used-by \Df\Framework\Upgrade::process()
	 */
	final protected function _process() {
		if ($this->v('0.0.2')) {
			// 2019-04-03 A Pwinty order ID: «775277»
			$this->column('sales_order', self::F__PWINTY_ORDER_ID, 'int(11)');
		}
	}

	/**
	 * 2019-04-03
	 * @used-by _process()
	 * @var string
	 */
	const F__PWINTY_ORDER_ID = 'pwinty_order_id';
}