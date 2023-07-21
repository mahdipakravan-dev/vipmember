<?php
require_once VIP_DIR . "includes/vip.db-helper.php";
function api__plan__getMany() {
    $result = VipDBHelper::find(
        VipDBHelper::VIP_PLANS_TABLE,
        []
    );

    if ($result) {
        wp_send_json_success(array(
            'message' => 'founded!',
            'data'    => $result
        ));
    } else {
        wp_send_json_error(new WP_Error( 'error', '', array( 'status' => 500)));
    }
}