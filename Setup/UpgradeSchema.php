<?php
namespace Inkifi\Pwinty\Setup;
use Mangoit\MediaclipHub\Model\Product as mP;
// 2019-05-01
/** @final Unable to use the PHP «final» keyword here because of the M2 code generation. */
class UpgradeSchema extends \Df\Framework\Upgrade\Schema {
	/**
	 * 2019-05-01
	 * @override
	 * @see \Df\Framework\Upgrade::_process()
	 * @used-by \Df\Framework\Upgrade::process()
	 */
	final protected function _process() {
		if ($this->v('0.2.0')) {
			/**
			 * 2019-05-01
			 * 1) «Implement the `preferredShippingMethod` backend input and pass its value to Pwinty»:
			 * https://github.com/inkifi/pwinty/issues/1
			 * 2) API 3.0: «Possible values are `Budget`, `Standard`, `Express`, and `Overnight`»:
			 * https://www.pwinty.com/api#orders-create
			 */
			$this->column('mediacliphub_product', mP::F__PWINTY_SHIPPING_METHOD, 'varchar(255) DEFAULT NULL');
		}
	}
}