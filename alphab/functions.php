<?php
/**
 * ALPHAB functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 */
require_once get_theme_file_path('/inc/tgm.php');
require_once get_theme_file_path('/inc/acf-mb.php');
require_once get_theme_file_path('/inc/cmb2-mb.php');
if( class_exists('Attachments')){
    require_once "lib/attachments.php";
}

 if(site_url()=="http://localhost/wpdev/"){
    define("VERSION", time());
 }else{
    define("VERSION", wp_get_theme()->get("Version"));
 }

// Theme setup functions 

function alphab_functions() {
    // Text Domain 
    load_theme_textdomain('alphab', get_template_directory().'/lang');
    // Theme supports 
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form'));
    $alphab_custom_header_details = array(
        'header-text'   => true,
        'default-text-color'    => '#dd3333',
        'width' => 1200,
        'height'    => 600,
        'flex-height'   => true,
        'flex-width'    => true,
    );
    add_theme_support('custom-header', $alphab_custom_header_details);
    $alphab_custom_logo_defaults = array(
        "width" => '100',
        "height"    => '100'
    );
    add_theme_support('custom-logo');
    add_theme_support('custom-background');
    register_nav_menu('top-menu', __('Top Menu', 'alphab'));
    register_nav_menu('footer-menu', __('Footer Menu', 'alphab'));

    add_theme_support( "post-formats", array("image", "quote", "video", "audio", "link") );
    add_image_size( "alphab-square",400,400,true );
    add_image_size( "alphab-portrait",400,9999 );
    add_image_size( "alphab-landscape",9000,400 );
    add_image_size( "alphab-landscape-hard-cropped",600,400 );

}
add_action('after_setup_theme', 'alphab_functions');

// Including the styles
function alphab_styles(){
    
    wp_enqueue_style('stylesheet', get_stylesheet_uri(), null, VERSION);
    wp_enqueue_style('maxcdn', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
    wp_enqueue_style("dashicons");
    wp_enqueue_style('featherlight-css', '//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.css');
    wp_enqueue_style("tns-style", "//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css");
    wp_enqueue_style("alphab-style", get_template_directory_uri()."/assets/css/alphab.css");
    // wp_enqueue_style("alphab-style", get_theme_file_uri("/assets/css/alphab.css"));
}
add_action('wp_enqueue_scripts', 'alphab_styles');



function alphab_scripts(){
    wp_enqueue_script( "tns-js", "//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js", null, VERSION, true );
    wp_enqueue_script('featherlight-js', '//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.js', array('jquery'), VERSION, true);
    wp_enqueue_script( "alphab-main", get_theme_file_uri( "assets/js/main.js" ), array("jquery", "featherlight-js"), VERSION, true );
    
}
add_action('wp_enqueue_scripts', 'alphab_scripts');


function alphab_sidebar(){
    register_sidebar( array(
        'name'  => __('Single Post Sidebar'),
        'id'    => 'sidebar-1',
        'description'   => __('Right Sidebar', 'alphab'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action("widgets_init", "alphab_sidebar");

if(!function_exists("alphab_the_excerpt")){
    function alphab_the_excerpt($excerpt){
        if( !post_password_required() ){
            return $excerpt;
        }else {
            echo get_the_password_form();
        }
    }
    add_filter("the_excerpt", "alphab_the_excerpt");
}


function alphab_protected_title_change(){
    return "%s";
}
add_filter("protected_title_format", "alphab_protected_title_change");

function alphab_menu_item_class($classes , $item){
    $classes[] = "list-inline-item";
    return $classes;
}
add_filter("nav_menu_css_class", "alphab_menu_item_class", 10, 2);

function alphab_header_image(){
    if(is_front_page()){
        if(current_theme_supports("custom-header")){
            ?>
            <style>
                .header{
                    background-image: url(<?php echo header_image(); ?>);
                    background-size: contain;
                    margin-bottom: 50px;
                }
                .header h1.heading a, h3.tagline {
                    color: #<?php echo get_header_textcolor(); ?>;
                    <?php
                    if(!display_header_text()){
                        echo "display: none;";
                    }
                    ?>
                }

            </style>
        <?php
        }

    }
}
add_action("wp_head", "alphab_header_image");

function alphab_highlight_search_results($text){
    if(is_search()){

        $pattern = '/('. join('|', explode(' ', get_search_query())).')/i';
        $text = preg_replace($pattern, '<span class="search-highlight">\0</span>', $text);
    }
    return $text;
}

add_filter('the_content', 'alphab_highlight_search_results');
add_filter('the_excerpt', 'alphab_highlight_search_results');
add_filter('the_title', 'alphab_highlight_search_results');

function alphab_image_srcset(){
    return null;
}
add_filter('wp_calculate_image_srcset', 'alphab_image_srcset');
// add_filter('wp_calculate_image_srcset', '__return _null');


function alphab_modify_main_query($wpq){
    if(is_home() && $wpq->is_main_query()){
        $wpq->set("post__not_in", array(6));
    }
    
}
add_action("pre_get_posts","alphab_modify_main_query");
add_filter('acf/settings/show_admin', '__return_false');


function alpha_admin_assets($hook){

    if (isset( $_REQUEST['post']) || isset( $_REQUEST['post_ID'])){
        $post_id = empty( $_REQUEST['post_ID']) ? $_REQUEST['post'] : $_REQUEST['post_ID'];
    }
            if("post.php" == $hook) {
                $post_format = get_post_format($post_id);
             wp_enqueue_script("admin-js",get_theme_file_uri("assets/js/admin.js"),array("jquery"), VERSION, true);       
            }
            wp_localize_script("admin-js","alphab_pf",array("format"=>$post_format));
}
add_action("admin_enqueue_scripts","alpha_admin_assets");