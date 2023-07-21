<?php

function api__plan__create() {
    $params = $_POST;

    check_ajax_referer( 'create-plan', 'security' );

    if ( empty( $params['title'] ) || empty( $params['description'] ) || empty( $params['day'] ) || !is_numeric($params["day"]) ) {
        wp_send_json_error(new WP_Error( 'invalid_data', 'Title, description, and day fields are required.', array( 'status' => 400 )));
    }

    $title       = sanitize_text_field( $params['title'] );
    $description = sanitize_textarea_field( $params['description'] );
    $day         = intval( $params['day'] );

    $data = array(
        'title'       => $title,
        'description' => $description,
        'day'         => $day,
    );

    $insert_result = VipDBHelper::insert_data(
        VipDBHelper::VIP_PLANS_TABLE,
        array(
            "title" => $title,
            "description" => $description,
            "day" => $day,
        )
    );

    if ( $insert_result !== false ) {
        wp_send_json_success(array(
            'message' => 'VIP plan created successfully!',
            'data'    => $data,
            'redirect_url' => admin_url("admin.php?page=vipmember-settings&tab=plans")
        ));
    } else {
        wp_send_json_error(new WP_Error( 'insert_failed', 'Failed to create VIP plan.', array( 'status' => 500)));
    }
}