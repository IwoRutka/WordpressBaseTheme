<?php get_header();?>

<section class="page-wrap">
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <?php if(has_post_thumbnail()):?>
            <img src="<?php the_post_thumbnail_url('blog-small');?>" alt="<?php the_title();?>" class='img_fluid mb3 img-thumbnail me-4'>
            <?php endif;?>
            <br>
            <br>

        </div>
        <div class="col-lg-6">

            <ul>
                <li>
                <?php
                    $field = get_field_object('cena');
                ?>
                <p><?php echo $field['label']; ?> <?php echo $field['value']; ?></p>
                </li>
                <li>
                <?php
                    $field = get_field_object('cecha_1');
                ?>
                <p><?php echo $field['label']; ?> <?php echo $field['value']; ?></p>
                </li>
                <li>
                    Cecha 2: <?php echo the_field('cecha_2') ?>
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
            <?php wp_link_pages();?>
        </div>
    </div>
    <div>
        <h1><?php the_title( );?></h1>
        <?php get_template_part( 'includes/section', 'content' );?>
    </div>
    </div>
</section>
<?php get_footer();?>