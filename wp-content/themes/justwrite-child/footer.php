<?php
/* ------------------------------------------------------------------------- *
 *	Footer template					
/* ------------------------------------------------------------------------- */

//  Variables
$disable_credit		= get_theme_mod( 'ac_disable_credit', false );
$credit_link 		= 'http://www.acosmin.com/';
$the_wp_link		= 'http://wordpress.org/';
$copyright_text 	= get_theme_mod( 'ac_footer_copyright_text', 'Copyright 2013 JUSTWRITE. All rights reserved.' );
$logo_text			= get_theme_mod( 'ac_footer_logo_text', 'JustWrite' );
?>
		<?php 
		do_action( 'ac_action_footer_widgets_before' ); // Before footer widgets action 
		
		if ( ! get_theme_mod( 'ac_disable_widgetized_footer', false ) ) { // In case we want to hide this area ?>
        <section class="container footer-widgets builder<?php ac_mini_disabled() ?> clearfix">
        	<?php do_action( 'ac_action_footer_widgets_inside_top' ); // Footer widgets inside top action ?>
            <div class="col threecol fw-1 clearfix">
				<?php 
                if ( is_active_sidebar( 'footer-area-1' ) ) {
                    dynamic_sidebar( 'footer-area-1' );
                } else { 
                    ac_return_inactive_widgets( 'footer-area-1' ); 
                } ?>
            </div><!-- footer - area #1 -->
            
            <div class="col threecol fw-2 clearfix">
				<?php 
                if ( is_active_sidebar( 'footer-area-2' ) ) {
                    dynamic_sidebar( 'footer-area-2' );
                } else { 
                     ac_return_inactive_widgets( 'footer-area-2' ); 
                } ?> 
            </div><!-- footer - area #2 -->
            
            <div class="cleardiv"></div>
            
            <div class="col threecol fw-3 clearfix">
				<?php 
                if ( is_active_sidebar( 'footer-area-3' ) ) {
                    dynamic_sidebar( 'footer-area-3' );
                } else { 
                    ac_return_inactive_widgets( 'footer-area-3' );
                } ?>
            </div><!-- footer - area #3 -->
            
            <div class="col threecol fw-4 clearfix last">
				<?php 
                if ( is_active_sidebar( 'footer-area-4' ) ) {
                    dynamic_sidebar( 'footer-area-4' );
                } else { 
					ac_return_inactive_widgets( 'footer-area-4' );
                } ?> 
            </div><!-- footer - area #4 -->
            <?php do_action( 'ac_action_footer_widgets_inside_bot' ); // Footer widgets inside bottom action ?>
        </section><!-- END .container .footer-widgets .builder -->
        <?php } // ac_disable_widgetized_footer ?>

        <?php do_action( 'ac_action_footer_main_before' ); // Before footer main action ?>
        

    	<?php do_action( 'ac_action_wrap_main_inside_bot' ); // Main .wrap class inside bottom ?>
    </div><!-- END .wrap -->
    
    <?php 
		do_action( 'ac_action_body_end' ); // <body> end action
		
		// WP Footer
		wp_footer();
	?>
    
</body>
</html>