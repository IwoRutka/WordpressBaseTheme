<?php

// Load Style
function load_css()
{
    wp_register_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.min.css', array(), false, 'all' );
    wp_enqueue_style( 'bootstrap');
    wp_register_style( 'main', get_template_directory_uri().'/css/main.css', array(), false, 'all' );
    wp_enqueue_style( 'main');
}

add_action( 'wp_enqueue_scripts', 'load_css');


// load JavaScripts
function load_js()
{
    wp_enqueue_script( 'jquery' );
    wp_register_script( 'bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', 'jquery', false, false);
    wp_enqueue_script( 'bootstrap' );

}

add_action( 'wp_enqueue_scripts', 'load_js');

//Team options

add_theme_support( 'menus');
add_theme_support( 'post-thumbnails');


//Menus

register_nav_menus(
    array(
        'header-menu' => 'Header Menu Location',
        'footer-menu' => 'Footer Menu Location',
        'mobile-menu' => 'Mobile Menu Location'
    )
    );

// Add Custom Image Sizes
add_image_size('blog-large', 800, 400, false);
add_image_size('blog-small', 400, 200, false);

//Register Sidebar
function my_sidebars(){
        register_sidebar(
            array(
                'name' => 'Page Sidebar',
                'id' => 'page-sidebar',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>'
            )
            );
            register_sidebar(
                array(
                    'name' => 'Blog Sidebar',
                    'id' => 'blog-sidebar',
                    'before_title' => '<h4 class="widget-title">',
                    'after_title' => '</h4>'
                )
                );
}
add_action('widgets_init', 'my_sidebars');

function custom_post_type(){
    $args = array(
        'labels' => array(
            'name' => 'Kontakty',
            'singular_name' => 'Formularz kontaktowy'
        ),
        'hierarchical' => true,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-email-alt',
        'supports' => array('title', 'editor', 'thumbnail'),
        //'rewrite' => array('slug' => 'my-cars'),
    );
    register_post_type('kontakty', $args);
}
add_action('init', 'custom_post_type');

function custom_post_taxonomy(){
    $args = array(
        'labels' => array(
            'name' => 'Formularze kontaktowe',
            'singular_name' => 'Formularze kontaktowe'
        ),
        'hierarchical' => true,
        'public' => true,
       // 'has_archive' => true,
       // 'menu_icon' => 'dashicons-email-alt',
       'supports' => array('title', 'editor', 'thumbnail'),
        //'rewrite' => array('slug' => 'my-cars'),
    );
    register_taxonomy('formularze_kontaktowe', array('kontakty'), $args);

};

add_action('init', 'custom_post_taxonomy');