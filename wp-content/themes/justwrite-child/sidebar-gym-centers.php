<?php
/* ------------------------------------------------------------------------- *
 *	This sidebar appears only in single view (gym centers)
/* ------------------------------------------------------------------------- */
?>

<section class="sidebar clearfix">
    <?php
    // Posts sidebar inside top action
    do_action( 'ac_action_gym-centers_sidebar_inside_top' );

    // Widgetized posts sidebar
    if ( is_active_sidebar( 'gym-centers-sidebar' ) ) {
        dynamic_sidebar( 'gym-centers-sidebar' );
    } else {
        ac_return_inactive_widgets( 'sidebars' );
    }

    // Posts sidebar inside bottom action
    do_action( 'ac_action_gym-centers_sidebar_inside_bot' );
    ?><!-- END Sidebar Widgets -->
</section><!-- END .sidebar -->