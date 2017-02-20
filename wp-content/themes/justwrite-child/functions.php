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

/*  Load JavaScript files
/* ------------------------------------ */
if ( ! function_exists( 'ac_js_files' ) ) {

    function ac_js_files() {

        // Enqueue
        wp_enqueue_script( 'ac_js_fitvids', get_template_directory_uri() . '/assets/js/jquery.fitvids.js', array('jquery'), '1.1', true );
        wp_enqueue_script( 'ac_js_menudropdown', get_template_directory_uri() . '/assets/js/menu-dropdown.js', array('jquery'), '1.4.8', true );

        if( is_home() && get_theme_mod( 'ac_enable_slider', false ) ) {
            wp_enqueue_script( 'ac_js_slider', get_template_directory_uri() . '/assets/js/slider.js', array('jquery'), '0.3.0', true );
        }

        wp_enqueue_script( 'ac_js_myscripts', get_template_directory_uri() . '/assets/js/myscripts.js', array('jquery'), '1.0.6', true );
        wp_enqueue_script( 'ac_js_html5', get_template_directory_uri() . '/assets/js/html5.js', array('jquery'), '3.7.0', false );

        // Comments Script
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }

        wp_enqueue_script( 'aom_site', get_stylesheet_directory_uri() . '/site.js', array('jquery'), '3.7.0', false );
    }

}
add_action( 'wp_enqueue_scripts', 'ac_js_files' );
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
        'id'            => 'gym_center_metabox',
        'title'         => __( 'Gym Center Metabox', 'cmb2' ),
        'object_types'  => array( 'gym_center', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );

    $cmb->add_field( array(
        'name' => esc_html__( 'Featured Gym', 'cmb2' ),
        'desc' => esc_html__( 'Make this become Featured', 'cmb2' ),
        'id' => 'ac_featured_article',
        'type' => 'text',
    ) );

    $cmb->add_field( array(
        'name' => esc_html__( 'Address', 'cmb2' ),
        'desc' => esc_html__( 'Street Address', 'cmb2' ),
        'id' => 'aom_street_address_gym_center',
        'type' => 'text',
    ) );

    $cmb->add_field( array(
        'name' => esc_html__( 'Land Line', 'cmb2' ),
        'desc' => esc_html__( 'Land Line Number', 'cmb2' ),
        'id' => 'aom_land_line_gym_center',
        'type' => 'text',
    ) );

    $cmb->add_field( array(
        'name' => esc_html__( 'Mobile', 'cmb2' ),
        'desc' => esc_html__( 'Mobile Number', 'cmb2' ),
        'id' => 'aom_mobile_gym_center',
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

/*  Single post details
/* ------------------------------------ */
if ( ! function_exists( 'ac_single_post_details' ) ) {

    function ac_single_post_details() {
        global $post;

        $author_id = $post->post_author;
        $author_info = get_userdata( $author_id );
        $author_name = $author_info->display_name;
        $author_url = get_author_posts_url( $author_id );
        $author_output = '<a href="' . esc_url( $author_url ) . '">' . esc_html( $author_name ) . '</a>';

        $show_date = apply_filters( 'ac_single_post_details_sd', true );
        $show_author = apply_filters( 'ac_single_post_details_sa', true );
        $show_category = apply_filters( 'ac_single_post_details_sc', true );

        do_action( 'ac_single_post_details_before' );
        ?>
        <header class="details clearfix">
            <?php do_action( 'ac_single_post_details_before_items' ); ?>
            <?php if( $show_date = false ) { ?><time class="detail left index-post-date" datetime="<?php echo get_the_date( 'Y-m-d' ); ?>"><?php echo get_the_date( 'M d, Y' ); ?></time><?php }; ?>

            <?php $street = get_post_meta( get_the_ID(), 'aom_street_address_gym_center', true );
            if (!empty($street)){
                ?>
            <span class="detail left index-post-category"><em><?php echo $street; ?></em></span>
            <?php
            }
            ?>
            <?php do_action( 'ac_single_post_details_after_items' ); ?>
        </header><!-- END .details -->
        <?php
        do_action( 'ac_single_post_details_after' );
    }

}

/*  Pagination
/* ------------------------------------ */
if ( ! function_exists( 'ac_paginate' ) ) {

    function ac_paginate() {
        if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
            return;
        }

        $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
        $pagenum_link = html_entity_decode( get_pagenum_link() );
        $query_args   = array();
        $url_parts    = explode( '?', $pagenum_link );

        if ( isset( $url_parts[1] ) ) {
            wp_parse_str( $url_parts[1], $query_args );
        }

        $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
        $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

        $format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
        $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

        $links   = paginate_links( array(
            'base'     => $pagenum_link,
            'format'   => $format,
            'total'    => $GLOBALS['wp_query']->max_num_pages,
            'current'  => $paged,
            'mid_size' => 1,
            'add_args' => array_map( 'urlencode', $query_args ),
            'prev_text' => __( '&larr; Trước', 'justwrite' ),
            'next_text' => __( 'Sau &rarr;', 'justwrite' ),
        ) );

        if ( $links ) :

            ?>
            <nav class="posts-pagination clearfix" role="navigation">
                <div class="paging-wrap">
                    <?php echo $links; ?>
                </div><!-- END .paging-wrap -->
            </nav><!-- .posts-pagination -->
            <?php
        endif;

    }

}
?>