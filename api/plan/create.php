<?php
require_once VIP_DIR . "includes/vip.db-helper.php";
function api__plan__create(WP_REST_Request $request) {
    $params = $request->get_params();

    // Validate the request data
    if ( empty( $params['title'] ) || empty( $params['description'] ) || empty( $params['day'] ) || !is_numeric($params["day"]) ) {
        return new WP_Error( 'invalid_data', 'Title, description, and day fields are required.', array( 'status' => 400 ) );
    }

    // Sanitize and prepare the data
    $title       = sanitize_text_field( $params['title'] );
    $description = sanitize_textarea_field( $params['description'] );
    $day         = intval( $params['day'] );

    // Process the data and insert the VIP plan into the database
    // Example: You can use the insert_data() function from the previous example
    // Insert the data into your wp_vip_plans table
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
        return array(
            'message' => 'VIP plan created successfully!',
            'data'    => $data,
        );
    } else {
        return new WP_Error( 'insert_failed', 'Failed to create VIP plan.', array( 'status' => 500 ) );
    }
}