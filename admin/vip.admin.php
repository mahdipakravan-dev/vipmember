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
        wp_enqueue_style( $this->plugin_name . "bootstrap", plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );
	}

	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/vip.admin.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_script( $this->plugin_name . "bootstrap", plugin_dir_url( __FILE__ ) . 'js/bootstrap.bundle.min.js', array( 'jquery' ), $this->version, false );
	}

	public function vip_role() {
		add_role(
			'vip_member',
			'Vip Member',
		);
		$vip_role = get_role( "vip_member" );
		$vip_role->add_cap("vip_content");
		get_role( "administrator" )
			->add_cap("vip_content");
	}

	public function register_menu() {
        require_once VIP_DIR . 'admin/vip.menu.php';
        new VipSettingMenu();
	}

	public function show_profile($user) {
		require_once VIP_DIR . 'admin/partials/fields/field_phoneNumber.create.php';
	}

	public function save_profile($userId) {
		return update_user_meta( $userId, "vip__phoneNumber", $_REQUEST["vip__phoneNumber"]);
	}
}

