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
            Left column
        </div>
        <div class="col-lg-6">
            Right column
            <?php get_template_part( 'includes/section', 'content' );?>
            </div>
    </div>
</div>
</section>





<?php get_footer();?>