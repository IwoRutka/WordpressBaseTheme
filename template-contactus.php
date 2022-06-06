<?php
/*
Template Name: Contect Us
*/
?>
<?php get_header();?>
<section class="page-wrap">
<div class="container">
    <h1><?php the_title( );?></h1>
    <div class="row">
        <div class="col-lg-6">

            <ul>
                <li>
                    Adres: <?php echo the_field('adres') ?>
                </li>
                <li>
                    Telefon: <?php echo the_field('telefon') ?>
                </li>
                <li>
                    Email: <?php echo the_field('email') ?>
                </li>                
                <li>
                    <?php echo the_field('infododatkowe') ?>
                </li><br>
                <li>
                <?php 
                    $image = get_field('image');
                    if( !empty( $image ) ): ?>
                        <a href="<?php echo esc_url($image['url']); ?>" class="mfp-image image-link">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="img-fluid" />
                        </a>
                        <?php endif; ?>
                </li>
            </ul>
            <?php get_template_part( 'includes/section', 'content' );?>
        </div>
        <div class="col-lg-6">
            <?php if(has_post_thumbnail()):?>
            <img src="<?php the_post_thumbnail_url('blog-small');?>" alt="<?php the_title();?>" class='img_fluid mb3 img-thumbnail me-4'>
            <?php endif;?>
            <br>
            <br>
            <?php echo apply_shortcodes( '[contact-form-7 id="78" title="Contact form 1"]' ); ?>
        </div>
    </div>
</div>
</section>





<?php get_footer();?>