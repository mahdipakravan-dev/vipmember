<?php
require_once VIP_DIR . "includes/vip.db-helper.php";
class VipSettingMenu {
    public function __construct() {
        $this->register_menu();
    }

    public function register_menu() {
        add_menu_page(
            'VIP Settings',
            'VIP Settings',
            'manage_options',
            'vipmember-settings',
            array( $this, 'vip_main_page' ),
            'dashicons-superhero-alt'
        );

        // Add the first submenu item
        add_submenu_page(
            'vipmember-settings',
            'Users',
            'Users',
            'manage_options',
            'manage-users',
            array( $this, 'vip_users_page' )
        );

        add_submenu_page(
            'vipmember-settings',
            'Add user',
            'Add user',
            'manage_options',
            'add-user',
            array( $this, 'vip_add_user_page' )
        );
    }

    public function vip_main_page() {
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            if ( ! isset( $_POST['add_vip_plan_nonce'] ) || ! wp_verify_nonce( $_POST['add_vip_plan_nonce'], 'add_vip_plan_action' ) ) {
                wp_die( 'Invalid nonce. Please try again.' );
            }

            // Process the form data
            if ( isset( $_POST['title'] ) && isset( $_POST['description'] ) && isset( $_POST['day'] ) ) {
                $title       = sanitize_text_field( $_POST['title'] );
                $description = sanitize_textarea_field( $_POST['description'] );
                $day         = intval( $_POST['day'] );

                VipDBHelper::insert_data(
                    VipDBHelper::VIP_PLANS_TABLE,
                    array(
                        "title" => $title,
                        "description" => $description,
                        "day" => $day,
                    )
                );
                wp_redirect( add_query_arg( 'vip_plan_added', 'true', admin_url( 'admin.php?page=your_plugin_page' ) ) );
                exit;
            } else {
                wp_die( 'Please fill in all the required fields.' );
            }
        }
        require_once VIP_DIR . 'admin/partials/vip__display.php';
    }

    public function vip_users_page() {
        require_once VIP_DIR . 'admin/partials/vip__users.php';
    }

    public function vip_add_user_page() {
        require_once VIP_DIR . 'admin/partials/vip__addUser.php';
    }
}
