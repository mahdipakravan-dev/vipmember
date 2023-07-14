<?php

class Vip {
	protected $loader;
	protected $plugin_name;
	protected $version;
	
	public function __construct() {
		if ( defined( 'VIP_VERSION' ) ) {
			$this->version = VIP_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'VipMember';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	private function load_dependencies() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/vip.loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/vip.i18n.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/vip.admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/vip.public.php';

		$this->loader = new VipLoader();

	}

	private function set_locale() {

		$plugin_i18n = new VipI18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	private function define_admin_hooks() {

		$plugin_admin = new VipAdmin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'init', $plugin_admin, 'vip_role' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'register_menu' );

		$this->loader->add_action( 'show_user_profile', $plugin_admin, 'show_profile' );
		$this->loader->add_action( 'edit_user_profile', $plugin_admin, 'show_profile' );

		$this->loader->add_action('personal_options_update', $plugin_admin, 'save_profile');
		$this->loader->add_action('edit_user_profile_update', $plugin_admin, 'save_profile');
		$this->loader->add_action('user_register', $plugin_admin, 'save_profile');

	}

	private function define_public_hooks() {

		$plugin_public = new VipPublic( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'wp_footer', $plugin_public, 'suggest_vip_modal' );

		$this->loader->add_shortcode("vip-content", $plugin_public , "vip_content_shortcode");
	}

	public function run() {
		$this->loader->run();
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_loader() {
		return $this->loader;
	}
	public function get_version() {
		return $this->version;
	}

}
