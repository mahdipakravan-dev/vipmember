<?php
class VipI18n {
	public function load_plugin_textdomain() {
		load_plugin_textdomain(
			'VipMember',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
