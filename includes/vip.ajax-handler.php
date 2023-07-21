<?php
require_once VIP_DIR . "api/plan/create.php";
class VipAjaxHandler {
    const PREFIX = "vip/v1";
    public function __construct() {
        self::register_routes();
    }

    public function register_routes() {
        add_action('wp_ajax_vip_plan_create', "api__plan__create");
        add_action('wp_ajax_nopriv_vip_plan_create', "api__plan__create"); // For non-authenticated users

//        register_rest_route(
//            self::PREFIX,
//            '/create-plan',
//            array(
//                'methods'             => WP_REST_Server::ALLMETHODS,
//                'callback'            => "api__plan__create",
//                'permission_callback' => array( $this, 'check_permissions' ),
//            )
//        );
    }

    public function api__plan__create() {
        return [
            "Success" => "Salam"
        ];
    }
}
