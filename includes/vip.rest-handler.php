<?php
require_once VIP_DIR . "api/plan/create.php";
class VipRestHandler {
    const PREFIX = "vip/v1";
    public function __construct() {
        add_action( 'rest_api_init', array( $this, 'register_routes' ) );
    }

    public function register_routes() {
        register_rest_route(
            self::PREFIX,
            '/vip-plans',
            array(
                'methods'             => WP_REST_Server::READABLE,
                'callback'            => "api__plan__create",
                'permission_callback' => array( $this, 'check_permissions' ),
            )
        );
    }

    public function check_permissions()
    {
        return true;
    }
}
