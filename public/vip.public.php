<?php

class VipPublic {

	private $plugin_name;
	private $version;

	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/vip.public.css', array(), $this->version, 'all' );
	}
	public function enqueue_scripts() {
		wp_enqueue_script( "localstorage", plugin_dir_url( __FILE__ ) . 'js/utils/localstorage.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( "vip", plugin_dir_url( __FILE__ ) . 'js/vip.public.js', array( 'jquery' , 'localstorage'), $this->version, false );
		// wp_enqueue_script( $handle:string, $src:string, $deps:array, $ver:string|boolean|null, $in_footer:boolean )
	}

	public function suggest_vip_modal() {
		if(is_user_logged_in()) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/vip__suggest.modal.php';
		}
	}
}
