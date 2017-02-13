<?php
/**
 * Created by PhpStorm.
 * User: WIn
 * Date: 2/6/2017
 * Time: 5:18 PM
 */

function my_theme_enqueue_styles() {

    $parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


/*  Get featured gym center count
/* ------------------------------------ */
if ( ! function_exists( 'ac_featured_gym_centers_count' ) ) {

    function ac_featured_gym_centers_count() {

        // Get total number
        $featured_posts_nr = get_posts( array(
            'meta_key' => 'ac_featured_article',
            'meta_value' => 1,
            'post_type'        => 'gym_center',
        ));

        $count_featured_posts = count( $featured_posts_nr );

        return $count_featured_posts;
    }

}

add_action( 'cmb2_admin_init', 'cmb2_gym_center_metaboxes' );
/**
 * Define the metabox and field configurations.
 */
function cmb2_gym_center_metaboxes() {

    // Start with an underscore to hide fields from custom fields list
    $prefix = '_yourprefix_';

    /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => 'test_metabox',
        'title'         => __( 'Test Metabox', 'cmb2' ),
        'object_types'  => array( 'gym_center', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );

    $cmb->add_field( array(
        'name' => esc_html__( 'Featured Gym', 'cmb2' ),
        'desc' => esc_html__( 'Make this become Featured Post', 'cmb2' ),
//        'id'   => $prefix . 'checkbox',
        'id' => 'ac_featured_article',
        'type' => 'text',
    ) );

}

/*  Categories title output (columns widgets)
/* ---------------------------------------------- */
if ( ! function_exists( 'ac_widget_cols_title' ) ) {

    function ac_widget_cols_title( $cat_name = '' ) {

        if( $cat_name != '' ) {
//            $category_name = get_cat_name( absint( $cat_name ) );
            $category_name = get_term_by('id', $cat_name, 'location')->name;
            if( has_filter( 'ac_widget_cats_cols_title_filter') ) {
                $title_output = '<h3 class="section-col-title">' .  apply_filters( 'ac_widget_cats_cols_title_filter', esc_html( $category_name ) ) . '</h3>';
                echo $title_output;
            } else {
                $title_output = '<h3 class="section-col-title">' . esc_html( $category_name ) . '</h3>';
                echo $title_output;
            }
        } else {
            echo '<h3 class="section-col-title">' . __( 'No category selected', 'justwrite' ) . '</h3>';
        }
    }

}

/*  Widgets and Sidebars Setup
/* ------------------------------------ */
if ( ! function_exists( 'ac_sidebars_widgets' ) ) {

    function ac_sidebars_widgets() {

        // Include Widgets
        require_once get_template_directory() . '/acosmin/widgets/ac-default-widgets-init.php';
        require_once get_template_directory() . '/acosmin/widgets/ac-custom-widgets-init.php';

        // Main sidebar that appears on the right.
        register_sidebar( array(
            'name'          => __( 'Main Sidebar', 'justwrite' ),
            'id'            => 'main-sidebar',
            'description'   => __( 'Main sidebar that appears on the right.', 'justwrite' ),
            'before_widget' => '<aside id="%1$s" class="side-box clearfix widget %2$s"><div class="sb-content clearfix">',
            'after_widget'  => '</div></aside><!-- END .sidebox .widget -->',
            'before_title'  => '<h3 class="sidebar-heading">',
            'after_title'   => '</h3>',
        ) );

        // Same as above, designed for the articles area.
        register_sidebar( array(
            'name'          => __( 'Posts Sidebar', 'justwrite' ),
            'id'            => 'posts-sidebar',
            'description'   => __( 'Same as "Main Sidebar", designed for the posts.', 'justwrite' ),
            'before_widget' => '<aside id="%1$s" class="side-box clearfix widget %2$s"><div class="sb-content clearfix">',
            'after_widget'  => '</div></aside><!-- END .sidebox .widget -->',
            'before_title'  => '<h3 class="sidebar-heading">',
            'after_title'   => '</h3>',
        ) );

        // Same as above, designed for the gym center custom post.
        register_sidebar( array(
            'name'          => __( 'Gym Centers Sidebar', 'justwrite' ),
            'id'            => 'gym-centers-sidebar',
            'description'   => __( 'Same as "Main Sidebar", designed for the Gym Centers.', 'justwrite' ),
            'before_widget' => '<aside id="%1$s" class="side-box clearfix widget %2$s"><div class="sb-content clearfix">',
            'after_widget'  => '</div></aside><!-- END .sidebox .widget -->',
            'before_title'  => '<h3 class="sidebar-heading">',
            'after_title'   => '</h3>',
        ) );

        // Main Page - Before posts
        register_sidebar( array(
            'name'          => __( 'Sections - Before posts', 'justwrite' ),
            'id'            => 'main-page-before',
            'description'   => __( 'Use this area with the special designed widgets.("AC SEC:" prefix and bright blue background color).', 'justwrite' ),
            'before_widget' => '<section id="%1$s" class="container %2$s builder clearfix">',
            'after_widget'  => '</section><div class="cleardiv"></div><!-- END .container .builder -->',
            'before_title'  => '<h3 class="sidebar-heading">',
            'after_title'   => '</h3>',
        ) );

        // Main Page - After posts
        register_sidebar( array(
            'name'          => __( 'Sections - After posts', 'justwrite' ),
            'id'            => 'main-page-after',
            'description'   => __( 'Use this area with the special designed widgets.("AC SEC:" prefix and bright blue background color).', 'justwrite' ),
            'before_widget' => '<section id="%1$s" class="container %2$s builder clearfix">',
            'after_widget'  => '</section><div class="cleardiv"></div><!-- END .container .builder -->',
            'before_title'  => '<h3 class="sidebar-heading">',
            'after_title'   => '</h3>',
        ) );

        // All pages - After header
        register_sidebar( array(
            'name'          => __( 'Sections - After header', 'justwrite' ),
            'id'            => 'all-pages-header-after',
            'description'   => __( 'Widgets will appear on all pages (except main page), after the header location. Use this area with the special designed widgets ("AC SEC:" prefix and bright blue background color).', 'justwrite' ),
            'before_widget' => '<section id="%1$s" class="container %2$s builder' . ac_sidebars_all_pages_disabled_mini() . ' clearfix">',
            'after_widget'  => '</section><div class="cleardiv"></div><!-- END .container .builder -->',
            'before_title'  => '<h3 class="sidebar-heading">',
            'after_title'   => '</h3>',
        ) );

        // All pages - Before footer
        register_sidebar( array(
            'name'          => __( 'Sections - Before footer', 'justwrite' ),
            'id'            => 'all-pages-footer-before',
            'description'   => __( 'Widgets will appear on all pages (except main page), before the widgetized footer area. Use this area with the special designed widgets ("AC SEC:" prefix and bright blue background color).', 'justwrite' ),
            'before_widget' => '<section id="%1$s" class="container %2$s builder' . ac_sidebars_all_pages_disabled_mini() . ' clearfix">',
            'after_widget'  => '</section><div class="cleardiv"></div><!-- END .container .builder -->',
            'before_title'  => '<h3 class="sidebar-heading">',
            'after_title'   => '</h3>',
        ) );

        // Footer - Area #1
        register_sidebar( array(
            'name'          => __( 'Footer - Area #1', 'justwrite' ),
            'id'            => 'footer-area-1',
            'description'   => __( 'Displays widgets in area #1 (footer).', 'justwrite' ),
            'before_widget' => '<aside id="%1$s" class="side-box clearfix widget %2$s"><div class="sb-content clearfix">',
            'after_widget'  => '</div></aside><!-- END .sidebox .widget -->',
            'before_title'  => '<h3 class="sidebar-heading">',
            'after_title'   => '</h3>',
        ) );

        // Footer - Area #2
        register_sidebar( array(
            'name'          => __( 'Footer - Area #2', 'justwrite' ),
            'id'            => 'footer-area-2',
            'description'   => __( 'Displays widgets in area #2 (footer).', 'justwrite' ),
            'before_widget' => '<aside id="%1$s" class="side-box clearfix widget %2$s"><div class="sb-content clearfix">',
            'after_widget'  => '</div></aside><!-- END .sidebox .widget -->',
            'before_title'  => '<h3 class="sidebar-heading">',
            'after_title'   => '</h3>',
        ) );

        // Footer - Area #3
        register_sidebar( array(
            'name'          => __( 'Footer - Area #3', 'justwrite' ),
            'id'            => 'footer-area-3',
            'description'   => __( 'Displays widgets in area #3 (footer).', 'justwrite' ),
            'before_widget' => '<aside id="%1$s" class="side-box clearfix widget %2$s"><div class="sb-content clearfix">',
            'after_widget'  => '</div></aside><!-- END .sidebox .widget -->',
            'before_title'  => '<h3 class="sidebar-heading">',
            'after_title'   => '</h3>',
        ) );

        // Footer - Area #4
        register_sidebar( array(
            'name'          => __( 'Footer - Area #4', 'justwrite' ),
            'id'            => 'footer-area-4',
            'description'   => __( 'Displays widgets in area #4 (footer).', 'justwrite' ),
            'before_widget' => '<aside id="%1$s" class="side-box clearfix widget %2$s"><div class="sb-content clearfix">',
            'after_widget'  => '</div></aside><!-- END .sidebox .widget -->',
            'before_title'  => '<h3 class="sidebar-heading">',
            'after_title'   => '</h3>',
        ) );

    }

}
add_action( 'widgets_init', 'ac_sidebars_widgets' );
?>