<?php
namespace Inkifi\Pwinty;
/**
 * 2019-03-13
 * @used-by \Inkifi\Pwinty\AvailableForDownload::_p()
 * @method static Settings s()
 */
final class Settings extends \Df\API\Settings {
	/**
	 * 2019-03-13
	 * @override
	 * @see \Df\Config\Settings::prefix()
	 * @used-by \Df\Config\Settings::v()
	 * @return string
	 */
	protected function prefix() {return 'api/pwinty';}
}