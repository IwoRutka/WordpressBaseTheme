<?php get_header('home');?>

<section class="page-wrap">
<div class="container">
    <h1><?php the_title( );?></h1>
    <?php get_template_part( 'includes/section', 'content' );?>
    <?php get_search_form();?><br>
    
</div>
</section>
<?php get_footer();?>