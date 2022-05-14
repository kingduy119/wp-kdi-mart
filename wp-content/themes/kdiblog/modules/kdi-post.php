<?php

require_once dirname( __FILE__ ) . '/widgets/abstract/fields-widget.php';
require_once dirname( __FILE__ ) . '/widgets/post-widget.php';

if( ! class_exists( 'KDI_Post' ) ):
final class KDI_Post {
    public function __construct() {
        add_action( 'init', array( $this, 'init' ) );
        add_action( 'widgets_init', array( $this, 'widgets_init' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'load_css_script' ) );
    }

    public function init() {
        // remove_theme_support('widgets-block-editor');
        add_theme_support( 'custom-logo');
        add_theme_support( 'post-thumbnails' );
    
        // menus:
        register_nav_menu('main-menu', __('Main menu') );
    
        // widget:
        if (function_exists('register_sidebar')) {
            // Header
            register_sidebar(array(
                'name'              => 'Page header',
                'id'                => 'header',
                'before_sidebar'    => '<div id="page-header">',
                'after_sidebar'     => '</div>',
                'before_widget'     => '<div id="%1$s">',
                'after_widget'      => '</div>',
            ));
    
            // Sidebar
            register_sidebar(array(
                'name'              => 'Sidebar',
                'id'                => 'sidebar',
                'before_sidebar'    => '<div id="page-sidebar">',
                'after_sidebar'     => '</div>',
                'before_widget'     => '<div id="%1$s" class="widget">',
                'after_widget'      => '</div>',
            ));
            // register_sidebar(array(
            //     'name'              => 'Sidebar product',
            //     'id'                => 'sidebar-product',
            //     'before_sidebar'    => '<div id="page-sidebar">',
            //     'after_sidebar'     => '</div>',
            //     'before_widget'     => '<div id="%1$s" class="widget">',
            //     'after_widget'      => '</div>',
            // ));
    
            // Footer
            register_sidebar(array(
                'name'              => 'Page footer',
                'id'                => 'page-footer',
                'before_sidebar'    => '<div id="page-footer">',
                'after_sidebar'     => '</div>',
                'before_widget'     => '<div id="%1$s">',
                'after_widget'      => '</div>',
            ));
            // register_sidebar(array(
            //     'name'              => 'Footer 1',
            //     'id'                => 'footer-1',
            //     'before_sidebar'    => '<div id="widget-footer-1" class="col">',
            //     'after_sidebar'     => '</div>',
            //     'before_widget'     => '<div id="%1$s" class="wp-widget">',
            //     'after_widget'      => '</div>',
            // ));
            // register_sidebar(array(
            //     'name'              => 'Footer 2',
            //     'id'                => 'footer-2',
            //     'before_sidebar'    => '<div id="widget-footer-2" class="col">',
            //     'after_sidebar'     => '</div>',
            //     'before_widget'     => '<div id="%1$s" class="wp-widget">',
            //     'after_widget'      => '</div>',
            // ));
            // register_sidebar(array(
            //     'name'              => 'Footer 3',
            //     'id'                => 'footer-3',
            //     'before_sidebar'    => '<div id="widget-footer-3" class="col">',
            //     'after_sidebar'     => '</div>',
            //     'before_widget'     => '<div id="%1$s" class="wp-widget">',
            //     'after_widget'      => '</div>',
            // ));
            // register_sidebar(array(
            //     'name'              => 'Footer 4',
            //     'id'                => 'footer-4',
            //     'before_sidebar'    => '<div id="widget-footer-4" class="col">',
            //     'after_sidebar'     => '</div>',
            //     'before_widget'     => '<div id="%1$s" class="wp-widget">',
            //     'after_widget'      => '</div>',
            // ));
        }
    }

    public function load_css_script() {
        // add_action('wp_enqueue_scripts', function () {
            $styles = array(
                assets( 'css/reset.css' ),
                assets( 'css/main.css' ),
                assets( 'lib/bootstrap-5/dist/css/bootstrap.css' ),
                'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css', // bootstrap icons
                'https://fonts.googleapis.com/css2?family=Roboto+Serif:wght@500&display=swap', // google font
            );
            foreach( $styles as $key => $link ) {
                wp_enqueue_style( "kdi-style-{$key}", $link );
            }

            $scripts = array(
                assets('js/main.js'),
                assets('lib/bootstrap-5/dist/js/bootstrap.js'),
                // 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js',
            );
            foreach( $scripts as $key => $link ) {
                wp_enqueue_script( "kdi-script-{$key}", $link );
            }

            global $wp_query;
            wp_localize_script( 'kdi-script-0', 'kdi_ajax', [
                'ajax_url'      => admin_url( 'admin-ajax.php' ),
                'query_vars'    => json_encode( $wp_query->query ),
            ] );
        // } );
    }

    public function widgets_init() {
        // add_action('widgets_init', function() {
        unregister_widget('WP_Widget_Pages');
        unregister_widget('WP_Widget_Calendar');
        unregister_widget('WP_Widget_Archives');
        unregister_widget('WP_Widget_Links');
        unregister_widget('WP_Widget_Meta');
        // unregister_widget('WP_Widget_Search');
        unregister_widget('WP_Widget_Categories');
        unregister_widget('WP_Widget_Recent_Posts');
        unregister_widget('WP_Widget_Recent_Comments');
        unregister_widget('WP_Widget_RSS');
        unregister_widget('WP_Widget_Tag_Cloud');
        unregister_widget('WP_Nav_Menu_Widget');
    
        register_widget('KDI_Widget_Post');
        // });
    }

}

new KDI_Post();
endif;