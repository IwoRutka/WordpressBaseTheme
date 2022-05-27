<?php if (have_posts(  )): while( have_posts(  )): the_post(  );?>
    <div class="card mb-3">
        <div class="card-body">
            <h1><?php the_title( );?></h1>
            <?php the_excerpt( );?>
            <a href="<?php the_permalink();?>" class="btn btn-success">Czytaj wiecej</a>
        </div>
    </div>
<?php endwhile; else: endif;?>