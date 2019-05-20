<?php
namespace Inkifi\Pwinty\T\CaseT;
// 2019-05-20
final class Logging extends \Inkifi\Pwinty\T\CaseT {
	/** @test 2019-05-20 */
	function t00() {}

	/** 2019-05-20 */
	function t01() {
		df_sentry_extra_f('Line 1');
		df_sentry_extra_f('Line 2');
		df_sentry($this, 'Message');
	}

	/** 2019-05-20 */
	function t02() {
		df_sentry_extra_f('Key 1', 'Value 1');
		df_sentry_extra_f('Key 2', 'Value 2');
		df_sentry($this, 'Message');
	}
	
	/** 2019-05-20 */
	function t03() {
		df_sentry_extra_f(['Key 1' => 'Value 1']);
		df_sentry_extra_f(['Key 2' => 'Value 2']);
		df_sentry($this, 'Message');
	}
}