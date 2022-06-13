<?php
    $args = [
        'post_type' => 'offers',
        // 'meta_key' => 'cena',
        // 'meta_value' => '100'
        'posts_per_page' => 0
    ];

    $query = new WP_Query($args);



?>

<?php 
    if($query->have_posts() ): ?>

    <?php while($query->have_posts() ) : $query->the_post();?>
    <div class="card mb-3">
        <div class="card-body">
            <?php if(has_post_thumbnail()):?>
            <img src="<?php the_post_thumbnail_url('blog-small');?>" alt="<?php the_title();?>" class='img_fluid mb3 img-thumbnail me-4'>
            <?php endif;?>
            <h3><?php the_title();?></h3>
            <h5>Cena <?php the_field('cena');?></h5>
        </div>
    </div>
    <?php endwhile;?>
    <?php endif;?>