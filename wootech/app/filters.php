<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

add_filter('block_categories', function ($categories, $post) { 
    $categories [] = [ 'slug' => 'wootech', 'title' => 'Wootech Blocks', 'icon' => 'visibility', ]; 
    return $categories; 
}, 10, 2);
