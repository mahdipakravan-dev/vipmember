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
		require_once VIP_DIR . 'admin/partials/fields/field_phoneNumber.create.php';
	}

	public function save_profile($userId) {
		return update_user_meta( $userId, "vip__phoneNumber", $_REQUEST["vip__phoneNumber"]);
	}

	public function vip_content_shortcode() {

	}

    public function book_post_type() {
        $labels = array(
            'name'                  => _x( 'Books', 'Post type general name', 'textdomain' ),
            'singular_name'         => _x( 'Book', 'Post type singular name', 'textdomain' ),
            'menu_name'             => _x( 'Books', 'Admin Menu text', 'textdomain' ),
            'name_admin_bar'        => _x( 'Book', 'Add New on Toolbar', 'textdomain' ),
            'add_new'               => __( 'Add New', 'textdomain' ),
            'add_new_item'          => __( 'Add New Book', 'textdomain' ),
            'new_item'              => __( 'New Bsook', 'textdomain' ),
            'edit_item'             => __( 'Edit Book', 'textdomain' ),
            'view_item'             => __( 'View Book', 'textdomain' ),
            'all_items'             => __( 'All Books', 'textdomain' ),
            'search_items'          => __( 'Search Books', 'textdomain' ),
            'parent_item_colon'     => __( 'Parent Books:', 'textdomain' ),
            'not_found'             => __( 'No books found.', 'textdomain' ),
            'not_found_in_trash'    => __( 'No books found in Trash.', 'textdomain' ),
            'featured_image'        => _x( 'Book Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'archives'              => _x( 'Book archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
            'insert_into_item'      => _x( 'Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
            'filter_items_list'     => _x( 'Filter books list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
            'items_list_navigation' => _x( 'Books list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
            'items_list'            => _x( 'Books list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'movie' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => true,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        );

        register_post_type( 'books', $args );
    }
}

