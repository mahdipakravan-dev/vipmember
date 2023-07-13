<?php

class VipAdmin {
	private $plugin_name;
	private $version;

	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/vip.admin.css', array(), $this->version, 'all' );
	}

	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/vip.admin.js', array( 'jquery' ), $this->version, false );
	}

	public function register_menu() {
		add_menu_page(
			'VIP Settings',
			'VIP Settings',
			'manage_options',
			'vipmember-settings',
			fn() => require_once VIP_DIR . 'admin/partials/vip__display.php',
			'dashicons-superhero-alt'
		);
	
		// Add the first submenu item
		add_submenu_page(
			'vipmember-settings',
			'Users',
			'Users',
			'manage_options',
			'manage-users',
			fn() => require_once VIP_DIR . 'admin/partials/vip__users.php',
		);

		add_submenu_page(
			'vipmember-settings',
			'Add user',
			'Add user',
			'manage_options',
			'add-user',
			fn() => require_once VIP_DIR . 'admin/partials/vip__addUser.php',
		);
	}

	public function show_profile($user) {
		// if($_POST["vip__phoneNumber"]) {
		// 	update_user_meta( $user->ID, "vip__phoneNumber", $_POST["vip__phoneNumber"]);
		// }

		var_dump($_POST);

		require_once VIP_DIR . 'admin/partials/fields/field_phoneNumber.create.php';
	}

	public function save_profile($userId) {
		return update_user_meta( $userId, "vip__phoneNumber", $_REQUEST["vip__phoneNumber"]);
	}
}

