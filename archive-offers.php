<?php get_header();?>

<section class="page-wrap">
<div class="container">

<section class="row">
    <div class="col-lg-3">
        <?php if(is_active_sidebar('offers-sidebar')):?>
            <?php dynamic_sidebar('offers-sidebar');?>
        <?php endif;?>
    </div>
    <div class="col-lg-9">

    <?php get_template_part( 'includes/section', 'offer' );?>

    <?php
    global $wp_query;
        
    $big = 999999999; // need an unlikely integer
    $translated = __( 'Page', 'mytextdomain' ); // Supply translatable string
        
    echo paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages,
                'before_page_number' => '<span class="screen-reader-text">'.$translated.' </span>'
    ) );
    ?>
</div>
</section>
</div>

</section>
<?php get_footer();?>