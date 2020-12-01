<?php

// Register Custom Post Type
function odu_clt_register_post_type_clt_event() {

    $labels = array(
        'name'                  => _x( 'CLT Events', 'Post Type General Name', 'CLT_TRANS_DOMAIN' ),
        'singular_name'         => _x( 'CLT Event', 'Post Type Singular Name', 'CLT_TRANS_DOMAIN' ),
        'menu_name'             => __( 'CLT Events', 'CLT_TRANS_DOMAIN' ),
        'name_admin_bar'        => __( 'CLT Events', 'CLT_TRANS_DOMAIN' ),
        'archives'              => __( 'CLT Events', 'CLT_TRANS_DOMAIN' ),
        'attributes'            => __( 'Event Attributes', 'CLT_TRANS_DOMAIN' ),
        'parent_item_colon'     => __( 'Parent Event', 'CLT_TRANS_DOMAIN' ),
        'all_items'             => __( 'All CLT Events', 'CLT_TRANS_DOMAIN' ),
        'add_new_item'          => __( 'Add New CLT Event', 'CLT_TRANS_DOMAIN' ),
        'add_new'               => __( 'Add New', 'CLT_TRANS_DOMAIN' ),
        'new_item'              => __( 'New CLT Event', 'CLT_TRANS_DOMAIN' ),
        'edit_item'             => __( 'Edit CLT Event', 'CLT_TRANS_DOMAIN' ),
        'update_item'           => __( 'Update CLT Event', 'CLT_TRANS_DOMAIN' ),
        'view_item'             => __( 'View CLT Event', 'CLT_TRANS_DOMAIN' ),
        'view_items'            => __( 'View CLT Events', 'CLT_TRANS_DOMAIN' ),
        'search_items'          => __( 'Search CLT Event', 'CLT_TRANS_DOMAIN' ),
        'not_found'             => __( 'Not found', 'CLT_TRANS_DOMAIN' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'CLT_TRANS_DOMAIN' ),
        'featured_image'        => __( 'Featured image', 'CLT_TRANS_DOMAIN' ),
        'set_featured_image'    => __( 'Set featured image', 'CLT_TRANS_DOMAIN' ),
        'remove_featured_image' => __( 'Remove featured image', 'CLT_TRANS_DOMAIN' ),
        'use_featured_image'    => __( 'Use as featured image', 'CLT_TRANS_DOMAIN' ),
        'insert_into_item'      => __( 'Insert into CLT Event', 'CLT_TRANS_DOMAIN' ),
        'uploaded_to_this_item' => __( 'Uploaded to this CLT Event', 'CLT_TRANS_DOMAIN' ),
        'items_list'            => __( 'CLT Events list', 'CLT_TRANS_DOMAIN' ),
        'items_list_navigation' => __( 'CLT Events list navigation', 'CLT_TRANS_DOMAIN' ),
        'filter_items_list'     => __( 'Filter CLT Events list', 'CLT_TRANS_DOMAIN' ),
    );
    $args = array(
        'label'                 => __( 'CLT Event', 'CLT_TRANS_DOMAIN' ),
        'description'           => __( 'CLT Events by month', 'CLT_TRANS_DOMAIN' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'custom-fields' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 10,
        'menu_icon'             => 'dashicons-calendar',
        'show_in_admin_bar'     => false,
        'show_in_nav_menus'     => true,
        'can_export'            => false,
        'has_archive'           => true,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'show_in_rest'          => false,
    );
    register_post_type( 'clt-events', $args );
}

add_action( 'init', 'odu_clt_register_post_type_clt_event', 0 );

?>