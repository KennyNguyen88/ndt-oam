<?php
/* ------------------------------------------------------------------------- *
 *  Full width page template
 *	___________________________________________________
 *
 *	Template name: About Page
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
                        <?php the_title( '<h2 class="title">', '</h2>' ); ?>
                        <div class="single-content">
                            <div class="builder">
                                <div class="col sixcol">
                                    <p>﻿Chúng tôi, một nhóm thanh niên hoạt động trong nhiều lĩnh vực, mong muốn tìm đến gym để cải thiện sức khỏe, đã từng vất vả loay hoay chạy khắp nơi hay dạo quanh các diễn đàn để tìm thông tin phòng tập, để rồi nhiều lần ngậm ngùi vì "Hình ảnh chỉ mang tính chất minh họa..."</p>
                                    <p>Nhận biết được khó khăn cũng như nhu cầu ngày càng lớn về việc tìm được 1 địa chỉ phòng gym ưng ý để tham gia tập luyện, Website chúng tôi ra đời nhằm giúp mọi người có cái nhìn khái quát cũng như tìm hiểu thông tin của các trung tâm một cách đơn giản, nhanh chóng và chính xác nhất. Chúng tôi không cung cấp cho các bạn thông tin thực đơn dinh dưỡng hay quy trình tập nhưng sẽ cam đoan mang đến cho các bạn nguồn thông tin chính xác về các trung tâm gym, thể dục mà ở đó bạn sẽ tiếp cận được với mục tiêu khỏe hình thức, đẹp tâm hồn.</p>
                                </div>
                                <div class="col sixcol last">
                                    <img src="<?php echo get_stylesheet_directory_uri().'/about_1.jpg'?>" alt=""/>
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