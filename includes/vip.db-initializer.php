<?php
require_once VIP_DIR . "includes/vip.db-helper.php";
class VipDBInitializer {
    public function __construct()
    {
    }

    public function initialize()
    {
        self::init_plans_table();
    }

    private function init_plans_table()
    {
        $table_name = VipDBHelper::get_table_name(VipDBHelper::VIP_PLANS_TABLE);
        VipDBHelper::create_table("CREATE TABLE $table_name (
        id INT NOT NULL AUTO_INCREMENT,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        day INT NOT NULL,
        PRIMARY KEY (id))");
    }
}