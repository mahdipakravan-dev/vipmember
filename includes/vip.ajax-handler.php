<?php
require_once VIP_DIR . "api/plan/create.php";
require_once VIP_DIR . "api/plan/get_many.php";
class VipAjaxHandler {
    public function __construct() {
        self::register_routes();
    }

    public function register_routes() {
        add_action('wp_ajax_vip_plan_create', "api__plan__create");
        add_action('wp_ajax_vip_plan_getMany', "api__plan__getMany");
    }
}
