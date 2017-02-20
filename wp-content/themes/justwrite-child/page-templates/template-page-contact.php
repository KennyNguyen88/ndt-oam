<?php
/* ------------------------------------------------------------------------- *
 *  Full width page template
 *	___________________________________________________
 *
 *	Template name: Contact Page
/* ------------------------------------------------------------------------- */

// Custom Post Classes
$classes = array(
    'single-template-1',
	'page-template-full',
    'clearfix'
);

get_header(); ?>

<section class="container<?php ac_mini_disabled() ?> clearfix" style="border-top: 0px;">
        
    <div class="wrap-template-1 page-full-width clearfix">
        
        <section class="content-wrap clearfix" role="main">
            
            <section class="posts-wrap single-style-template-1 clearfix">
            
            <?php
                while ( have_posts() ) : the_post();
            ?>	
            
                <article id="page-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
                    <div class="post-content">
                        
                        <div class="single-content" style="border-top: 0px;">
                            <div class="builder">
                                <div class="col sixcol">
                                    <?php the_content(); ?>
                                </div>
                                <div id="contact-info" class="col sixcol last" style="text-align: center">
                                    <div class="col sixcol"><i class="fa fa-envelope fa-2x"></i><br/>trolycobap@gmail.com</div>
                                    <div class="col sixcol last"><i class="fa fa-mobile fa-2x"></i><br/>01698404430<br/>A.Trung</div>
                                    <div class="col sixcol"><i class="fa fa-mobile fa-2x"></i><br/>0938265340<br/>A.Hoàng</div>
                                    <div class="col sixcol last"><i class="fa fa-mobile fa-2x"></i><br/>0984462007<br/>A.Long</div>

<!--                                    <ul style="list-style: none; margin-left: 30px">-->
<!--                                        <li><i class="fa fa-envelope"></i> trolycobap@gmail.com</li>-->
<!--                                        <li><i class="fa fa-phone"></i> 01698404430 – A.Trung</li>-->
<!--                                        <li><i class="fa fa-phone"></i> 0938265340 – A.Hoàng</li>-->
<!--                                        <li><i class="fa fa-phone"></i> 0984462007 – A.Long</li>-->
<!--                                    </ul>-->
                                </div>
                            </div>

                        </div><!-- END .single-content -->
                    
                    </div>
                </article>
                
            <?php endwhile;	?>
            
            </section><!-- END .posts-wrap -->
            
        </section><!-- END .content-wrap -->
        
    </div><!-- END .wrap-template-1 -->
    
</section><!-- END .container -->
    
<?php get_footer(); ?>