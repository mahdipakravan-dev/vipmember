<?php

require_once VIP_DIR . "inc/helpers/exchange-helper.php";
class Activator {
	public static function activate() {
        $table_name = VipDBHelper::get_table_name(VipDBHelper::VIP_PLANS_TABLE);
        VipDBHelper::create_table("CREATE TABLE $table_name (
                id INT NOT NULL AUTO_INCREMENT,
                name VARCHAR(255) NOT NULL,
                city VARCHAR(255) NOT NULL,
                sale BOOLEAN,
                buy BOOLEAN,
                phoneNumber VARCHAR(20),
                phoneNumberWhatsapp VARCHAR(20),
                address TEXT,
                PRIMARY KEY (id)
        ");
	}

}
