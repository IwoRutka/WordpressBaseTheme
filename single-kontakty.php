<?php get_header();?>

<section class="page-wrap">
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <?php if(has_post_thumbnail()):?>
            <img src="<?php the_post_thumbnail_url('blog-large');?>" alt="<?php the_title();?>" class='img_fluid mb3 img-thumbnail me-4'>
            <?php endif;?>
        </div>
        <div class="col-lg-6">
            <h1><?php the_title( );?></h1>
            <?php get_template_part( 'includes/section', 'kontakt' );?>
            <?php wp_link_pages();?>
        </div>
    </div>
    </div>
</section>
<?php get_footer();?>