<?php if (have_posts(  )): while( have_posts(  )): the_post(  );?>
    <div class="card mb-3">
        <div class="card-body d-flex justify-content-center align-items-center">
           
            <?php if(has_post_thumbnail()):?>
                <img src="<?php the_post_thumbnail_url('blog-small');?>" alt="<?php the_title();?>" class='img_fluid mb3 img-thumbnail me-4'>
            <?php endif;?>
            <div class="blog-content">
            <h1><?php the_title( );?></h1>
            <?php the_excerpt( );?>
            <a href="<?php the_permalink();?>" class="btn btn-success">Czytaj wiecej</a>
            </div>
        </div>
    </div>
<?php endwhile; else: ?>

    <h2>Brak wyników dla ' <?php echo get_search_query();?> '</h2>

    <?php endif;?>