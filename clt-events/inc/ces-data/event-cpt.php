<?php

class CLT_Events_CPT {

// Register Custom Post Type
static public function register() {

    $labels = array(
        'name'                  => _x( 'CLT Events', 'Post Type General Name', CLT_EVENTS_TRANS ),
        'singular_name'         => _x( 'CLT Event', 'Post Type Singular Name', CLT_EVENTS_TRANS ),
        'menu_name'             => __( 'CLT Events', CLT_EVENTS_TRANS ),
        'name_admin_bar'        => __( 'CLT Events', CLT_EVENTS_TRANS ),
        'archives'              => __( 'CLT Events', CLT_EVENTS_TRANS ),
        'attributes'            => __( 'Event Attributes', CLT_EVENTS_TRANS ),
        'parent_item_colon'     => __( 'Parent Event', CLT_EVENTS_TRANS ),
        'all_items'             => __( 'All CLT Events', CLT_EVENTS_TRANS ),
        'add_new_item'          => __( 'Add New CLT Event', CLT_EVENTS_TRANS ),
        'add_new'               => __( 'Add New', CLT_EVENTS_TRANS ),
        'new_item'              => __( 'New CLT Event', CLT_EVENTS_TRANS ),
        'edit_item'             => __( 'Edit CLT Event', CLT_EVENTS_TRANS ),
        'update_item'           => __( 'Update CLT Event', CLT_EVENTS_TRANS ),
        'view_item'             => __( 'View CLT Event', CLT_EVENTS_TRANS ),
        'view_items'            => __( 'View CLT Events', CLT_EVENTS_TRANS ),
        'search_items'          => __( 'Search CLT Event', CLT_EVENTS_TRANS ),
        'not_found'             => __( 'Not found', CLT_EVENTS_TRANS ),
        'not_found_in_trash'    => __( 'Not found in Trash', CLT_EVENTS_TRANS ),
        'featured_image'        => __( 'Featured image', CLT_EVENTS_TRANS ),
        'set_featured_image'    => __( 'Set featured image', CLT_EVENTS_TRANS ),
        'remove_featured_image' => __( 'Remove featured image', CLT_EVENTS_TRANS ),
        'use_featured_image'    => __( 'Use as featured image', CLT_EVENTS_TRANS ),
        'insert_into_item'      => __( 'Insert into CLT Event', CLT_EVENTS_TRANS ),
        'uploaded_to_this_item' => __( 'Uploaded to this CLT Event', CLT_EVENTS_TRANS ),
        'items_list'            => __( 'CLT Events list', CLT_EVENTS_TRANS ),
        'items_list_navigation' => __( 'CLT Events list navigation', CLT_EVENTS_TRANS ),
        'filter_items_list'     => __( 'Filter CLT Events list', CLT_EVENTS_TRANS ),
    );
    $args = array(
        'label'                 => __( 'CLT Event', CLT_EVENTS_TRANS ),
        'description'           => __( 'CLT Events by month', CLT_EVENTS_TRANS ),
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

static public function startDateFromSlug() {
    global $post;
    $post_slug = $post->post_name;
    return $post_slug . '-1'; // Adding a day component to the slug
}

static public function endDateFromSlug() {
    $start = CLT_Events_CPT::startDateFromSlug();
    $date = new DateTime($start);
    return $date->format( 'Y-m-t' ); // 't' gives no of days in the month
}


}


add_action( 'init', ['CLT_Events_CPT', 'register'], 0 );

?>