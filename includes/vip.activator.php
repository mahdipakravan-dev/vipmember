<?php

require_once VIP_DIR . "includes/vip.db-initializer.php";
class VipActivator {
	public static function activate() {
        $dbInitializer = new VipDBInitializer();
        $dbInitializer->initialize();
	}

}
