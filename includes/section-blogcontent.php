<?php if (have_posts(  )): while( have_posts(  )): the_post(  );?>
    <b>New</b><br>
    <p><?php echo get_the_date('l d-F-Y h:i');?></p>
    <p><?php the_content( );?></p>
    <?php 
    $fname = get_the_author_meta('first_name');
    $lname = get_the_author_meta('last_name');
    ?>
    <p>autor: <?php echo $fname;?> <?php echo $lname;?></p>
        
    <?php
    $tags = get_the_tags();
    if($tags):?>
    <p>Tagi:
    <?php
    foreach($tags as $tag):?>
        <a href="<?php echo get_tag_link($tag->term_id);?>" class="badge bg-info">
        <?php echo $tag->name;?>
    </a>
    <?php endforeach; endif; ?>
        
    <?php
    $categories = get_the_category();
    if($categories):?>
        Kategoria:
    <?php
    foreach($categories as $category):?>
        <a href="<?php echo get_category_link($category->term_id);?>" class="badge bg-success">
            <?php echo $category->name;?>
        </a>
    <?php endforeach; endif?>
    </p><br>
        <?php comments_template( );?>
    <?php endwhile; else: endif;?>