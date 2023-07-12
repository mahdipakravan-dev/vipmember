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
	}

}
