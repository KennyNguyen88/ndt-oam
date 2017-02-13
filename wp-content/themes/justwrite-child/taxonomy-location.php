<?php
/* ------------------------------------------------------------------------- *
 *	The template for displaying Location Archive pages.
/* ------------------------------------------------------------------------- */
?>

<?php get_header(); ?>

    <section class="container<?php ac_mini_disabled() ?> main-section clearfix">

        <?php //get_sidebar( 'gym-centers' ); ?>

        <div class="wrap-template-1 clearfix">

            <section class="content-wrap with-title" role="main">
                <?php
                // Archives content wrap inside top action
                do_action( 'ac_action_archives_content_wrap_inside_top' );
                ?>

                <header class="main-page-title">
                    <h1 class="page-title">
                        <?php
                            //_e( 'Gym Centers Archives: ', 'justwrite' );
                        ?>
                    <span><?php single_term_title(); ?></span> <?php ac_icon( 'angle-down' ); ?>
                    </h1>
                </header>

                <div class="posts-wrap clearfix">

                    <?php
                    if ( have_posts() ) :
                        while ( have_posts() ) :
                            the_post();
                            get_template_part( 'post-templates/content', 'index' );
                        endwhile;
                    else :
                        get_template_part( 'post-templates/content', 'no-articles' );
                    endif;
                    ?>

                </div><!-- END .posts-wrap -->

                <?php
                // Pagination
                ac_paginate();

                // Archives content wrap inside bottom action
                do_action( 'ac_action_archives_content_wrap_inside_bot' );
                ?>

            </section><!-- END .content-wrap -->

            <?php get_sidebar('gym-centers'); ?>

        </div><!-- END .wrap-template-1 -->

    </section><!-- END .container -->

<?php get_footer(); ?>