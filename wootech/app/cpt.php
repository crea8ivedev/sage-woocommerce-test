<?php

add_action('init', 'register_cpt_testimonial');

function register_cpt_testimonial() {
  register_post_type('testimonial', array(
    'labels' => array(
      'name' => _x('Testimonials', 'testimonial'),
      'singular_name' => _x('Testimonial', 'testimonial'),
      'add_new' => _x('Add New', 'testimonial'),
      'add_new_item' => _x('Add New Testimonial', 'testimonial'),
      'edit_item' => _x('Edit Testimonial', 'testimonial'),
      'new_item' => _x('New Testimonial', 'testimonial'),
      'view_item' => _x('View Testimonial', 'testimonial'),
      'search_items' => _x('Search Testimonials', 'testimonial'),
      'not_found' => _x('No Testimonials found', 'testimonial'),
      'not_found_in_trash' => _x('No Testimonials found in Trash', 'testimonial'),
      'parent_item_colon' => _x('Parent Testimonial:', 'testimonial'),
      'menu_name' => _x('Testimonials', 'testimonial')
    ),
    'hierarchical' => true,
    'description' => '',
    'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
    'taxonomies' => array(),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_icon' => 'dashicons-testimonial',
    'menu_position' => '5',
    'show_in_nav_menus' => true,
    'publicly_queryable' => false,
    'exclude_from_search' => true,
    'has_archive' => false,
    'query_var' => true,
    'can_export' => true,
    'capability_type' => 'post',
    'rewrite' => true
  ));
}