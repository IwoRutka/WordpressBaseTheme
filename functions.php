<?php

// Load Style

use PHPMailer\PHPMailer\PHPMailer;

function load_css()
{
    wp_register_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.min.css', array(), false, 'all' );
    wp_enqueue_style( 'bootstrap');
    wp_register_style( 'main', get_template_directory_uri().'/css/main.css', array(), false, 'all' );
    wp_enqueue_style( 'main');
    wp_register_style( 'magnific-popup', get_template_directory_uri().'/css/magnific-popup.css', array(), false, 'all' );
    wp_enqueue_style( 'magnific-popup');    
}

add_action( 'wp_enqueue_scripts', 'load_css');


// load JavaScripts
function load_js()
{
    wp_enqueue_script( 'jquery' );
    wp_register_script( 'bootstrap', get_template_directory_uri().'/js/bootstrap.bundle.min.js', 'jquery', false, true);
    wp_enqueue_script( 'bootstrap' );
    wp_register_script( 'magnific-popup', get_template_directory_uri().'/js/jquery.magnific-popup.min.js', 'jquery', false, true);
    wp_enqueue_script( 'magnific-popup' );
    wp_register_script( 'custom', get_template_directory_uri().'/js/custom.js', 'jquery', false, true);
    wp_enqueue_script( 'custom' );    
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
        'mobile-menu' => 'Mobile Menu Location',
        // 'main-menu' => 'Main menu'
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
            register_sidebar(
                array(
                    'name' => 'Offers Sidebar',
                    'id' => 'offers-sidebar',
                    'before_title' => '<h4 class="widget-title">',
                    'after_title' => '</h4>'
                )
                );
}
add_action('widgets_init', 'my_sidebars');

function custom_post_type(){
    $args = array(
        'labels' => array(
            'name' => 'Offers',
            'singular_name' => 'offer'
        ),
        'hierarchical' => false,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-email-alt',
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        //'rewrite' => array('slug' => 'my-cars'),
    );
    register_post_type('offers', $args);
}
add_action('init', 'custom_post_type');

function custom_post_taxonomy(){
    $args = array(
        'labels' => array(
            'name' => 'Offer type',
            'singular_name' => 'offer type'
        ),
        'hierarchical' => true,
        'public' => true,
       // 'has_archive' => true,
       // 'menu_icon' => 'dashicons-email-alt',
       'supports' => array('title', 'editor', 'thumbnail'),
        //'rewrite' => array('slug' => 'my-cars'),
    );
    register_taxonomy('offer-type', array('offers'), $args);

};

add_action('init', 'custom_post_taxonomy');

// Ajax enquiry function
add_action('wp_ajax_enquiry', 'enquiry_form');
add_action('wp_ajax_nopriv_enquiry', 'enquiry_form');
function enquiry_form()
{
    if( !wp_verify_nonce( $_POST['nonce'], 'ajax-nonce')){
        wp_send_json_error('Nonce is incorrect', 401);
        die();
    }


    $formdata = [];
    wp_parse_str($_POST['enquiry'], $formdata);
    $admin_email = get_option('admin_email');
    
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From:' . $admin_email;
    $headers[] = 'Replay-to:' . $formdata['email'];

    $send_to = $admin_email;

    $subject = "Enquiry from" . get_option('blogname');

    $message = '';

    foreach($formdata as $index => $field)
    {
        $message .= '<strong>' . $index . '</strong>: ' . $field . '<br>';
    }

    try {
        if(wp_mail($send_to, $subject, $message, $headers))
        {
            wp_send_json_success('Email sent');
        }
        else{
            wp_send_json_success('Email error');
        }
    } catch (Exception $e)
    {
        wp_send_json_success($e->getMessage());
    }

    // wp_send_json_success($formdata['fname']);
}

// bootstrap 5 wp_nav_menu walker
class bootstrap_5_wp_nav_menu_walker extends Walker_Nav_menu
{
  private $current_item;
  private $dropdown_menu_alignment_values = [
    'dropdown-menu-start',
    'dropdown-menu-end',
    'dropdown-menu-sm-start',
    'dropdown-menu-sm-end',
    'dropdown-menu-md-start',
    'dropdown-menu-md-end',
    'dropdown-menu-lg-start',
    'dropdown-menu-lg-end',
    'dropdown-menu-xl-start',
    'dropdown-menu-xl-end',
    'dropdown-menu-xxl-start',
    'dropdown-menu-xxl-end'
  ];

  function start_lvl(&$output, $depth = 0, $args = null)
  {
    $dropdown_menu_class[] = '';
    foreach($this->current_item->classes as $class) {
      if(in_array($class, $this->dropdown_menu_alignment_values)) {
        $dropdown_menu_class[] = $class;
      }
    }
    $indent = str_repeat("\t", $depth);
    $submenu = ($depth > 0) ? ' sub-menu' : '';
    $output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr(implode(" ",$dropdown_menu_class)) . " depth_$depth\">\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
  {
    $this->current_item = $item;

    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    $li_attributes = '';
    $class_names = $value = '';

    $classes = empty($item->classes) ? array() : (array) $item->classes;

    $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
    $classes[] = 'nav-item';
    $classes[] = 'nav-item-' . $item->ID;
    if ($depth && $args->walker->has_children) {
      $classes[] = 'dropdown-menu dropdown-menu-end';
    }

    $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = ' class="' . esc_attr($class_names) . '"';

    $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
    $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

    $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

    $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
    $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
    $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

    $active_class = ($item->current || $item->current_item_ancestor || in_array("current_page_parent", $item->classes, true) || in_array("current-post-ancestor", $item->classes, true)) ? 'active' : '';
    $nav_link_class = ( $depth > 0 ) ? 'dropdown-item ' : 'nav-link ';
    $attributes .= ( $args->walker->has_children ) ? ' class="'. $nav_link_class . $active_class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="'. $nav_link_class . $active_class . '"';

    $item_output = $args->before;
    $item_output .= '<a' . $attributes . '>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}

// register a new menu
register_nav_menu('main-menu', 'Main menu');

add_action('phpmailer_init', 'custom_mailer');
function custom_mailer(PHPMailer $phpmailer)
{
    $phpmailer->setFrom('admin@iworutka.com', 'Administrator www');
    $phpmailer->Host = 'smtp.cyberfolks.pl';
    $phpmailer->Port = 587;
    $phpmailer->SMTPAuth = true;
    $phpmailer->SMTPSecure = 'tsl';
    $phpmailer->Username = SMTP_LOGIN;
    $phpmailer->Password = SMTP_PASSWORD;
    $phpmailer->IsSMTP();
}