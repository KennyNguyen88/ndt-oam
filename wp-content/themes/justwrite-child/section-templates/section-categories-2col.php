<?php
/* -------------------------------------------------------------------------------- *
 *
 *  Categories - Two columns
 * _____________________
 *
 *  You can find the widget in: /acosmin/widgets/section-categories-2col-widget.php
 * _____________________
 * 
 *  $section_title ~ Section title
 *  $section_postsnr ~ How many posts a query has
 *  $section_category1 ~ Selected category #1
 *  $section_category2 ~ Selected category #2
 *
/* -------------------------------------------------------------------------------- */
?>

<?php 
// Check if a title is set
if ( ! empty( $section_title ) ) { ?>
<header class="section-heading sh-large twelvecol">
	<h2><?php echo esc_html( $section_title ); ?></h2>	
</header><!-- END .section-heading -->
<?php } ?>

<?php 
	// Multiply this template
	for ( $i = 1; $i < 3; $i++ ) :
	  
		// Category ID
//		$cat_name = absint( ${"section_category$i"} );
        if ($i == 1){
            $cat_name = 3;
        }
        else{
            $cat_name = 4;
        }
?>

<div class="col sixcol<?php if( $i == 2 ) { echo ' last';} ?>">
	<header class="section-col-header">
		<?php 
			// Category title
			ac_widget_cols_title( $cat_name ); 
		?>
        <?php if( $smo || $srs ) : ?>
		<ul class="section-col-nav">
			<?php if( $smo ) { ?><li><a href="<?php echo esc_url( get_category_link( $cat_name ) ); ?>" title="<?php _e( 'More articles in this category', 'justwrite' ); ?>"><?php ac_icon( 'ellipsis-h' ); ?></a></li><?php } ?>
            <?php if( $srs ) { ?><li><a href="<?php echo esc_url( get_category_feed_link( $cat_name, '') ); ?>" title="<?php _e( 'RSS Feed', 'justwrite' ); ?>"><?php ac_icon( 'rss' ); ?></a></li><?php } ?>
		</ul><?php endif; ?>
	</header><!-- END .section-col-header -->
	
	<?php if( ${"section_category$i"} != '' ) : ?>
	<div class="section-cat-wrap clearfix">
		<?php
			/* Query arguments
			------------------ */
			// Posts in category
            if ($i ==1){
                $query_args = array(
                    'posts_per_page'		=> absint( $section_postsnr ),
                    'post_status'         	=> 'publish',
//				'cat'					=> $cat_name,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'location',
                            'terms' => 'ho-chi-minh',
                            'field' => 'slug',
                            'include_children' => true
                        ),


                    ),
                    'post_type' => 'gym_center',
                    'ignore_sticky_posts'	=> 1
                );
            }
            else{
                $query_args = array(
                    'posts_per_page'		=> absint( $section_postsnr ),
                    'post_status'         	=> 'publish',
//				'cat'					=> $cat_name,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'location',
                            'terms' => 'vung-tau',
                            'field' => 'slug',
                            'include_children' => true
                        ),
                    ),
                    'post_type' => 'gym_center',
                    'ignore_sticky_posts'	=> 1
                );
            }

			
			// The Query
			$query_posts = new WP_Query( apply_filters( 'ac_widget_cats_2col_query_filter', $query_args ) );
			$count = 0;
			if( $query_posts->have_posts()) : while ( $query_posts->have_posts() ) : $query_posts->the_post(); $count++;
				if($count == 1) :
		?>
		<figure class="sc-thumbnail alignleft<?php if ( ! has_post_thumbnail() ) echo ' no-thumbnail'; ?>">
			<figcaption class="st-overlay">
				<?php do_action( 'ac_action_thumbnail_after' ); // Thumbnail action ?>
				<a href="<?php echo esc_url( get_permalink() ); ?>" rel="nofollow" class="st-overlay-link"></a>
			</figcaption>
			<?php 
				if ( has_post_thumbnail() ) : 
					the_post_thumbnail( 'ac-sidebar-featured' );
				else :
					echo '<img src="' . get_template_directory_uri() . '/images/no-thumbnail.png" alt="' . __( 'No Thumbnail', 'justwrite' ) . '" />';
				endif;
			?>
		</figure>
		
		<ul class="sc-posts alignright">
			<li class="sc-first-post">
				<?php the_title( '<h4 class="section-title st-small-2nd st-bold"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>

                <?php
                $street = get_post_meta( get_the_ID(), 'aom_street_address_gym_center', true );
                $land = get_post_meta( get_the_ID(), 'aom_land_line_gym_center', true );
                $mobile = get_post_meta( get_the_ID(), 'aom_mobile_gym_center', true );
                if (!empty($street))
                {
                    ?>
                    <div class="clearfix section-title st-small-2nd st-bold">
                        <i class="fa fa-map-marker"></i> <?php echo $street; ?>
                    </div>
                    <?php
                }
                if (!empty($land) || !empty($mobile))
                {
                    ?>
                    <div class="clearfix section-title st-small-2nd st-bold">
                        <?php if (!empty($land)) { ?> <i class="fa fa-phone"></i> <?php } echo $land;?>
                        <?php if (!empty($land) && !empty($mobile)) { echo " - " ; }?>
                        <?php if (!empty($mobile)) { ?> <i class="fa fa-mobile"></i> <?php } echo $mobile;?>

                    </div>
                    <?php
                }

                ?>

				<?php if( $sdt || $scm ) { ?>
				<div class="sc-details">
					<?php if( $sdt ) { ?><time class="s-sd" datetime="<?php echo get_the_date( 'Y-m-d' ); ?>"><?php echo get_the_date( 'M d, Y' ); ?></time><?php } ?>
					<?php if( $scm ) { ?><a href="<?php comments_link(); ?>" class="comments-number" rel="nofollow"><?php comments_number( '0 comments', '1 comment', '% comments' ); ?></a><?php } ?>
				</div>
				<?php } ?>
			</li>
			<?php else : ?>
			<li>
				<?php the_title( '<h4 class="section-title st-small"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
			</li>
			<?php endif; endwhile; else : ?>
			<ul class="sc-posts alignright no-posts"><li><h4 class="section-title st-small"><?php _e( 'This category has no posts!', 'justwrite' ); ?></h4></li>	
			<?php endif; wp_reset_postdata(); // End Query ?>
		</ul>
	</div><!-- END .section-cat-wrap -->
	<?php endif; // if cat# not selected ?>
</div><!-- END .sixcol -->

<?php endfor; ?>