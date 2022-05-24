<footer>
<div class="container">
        <?php 
        wp_nav_menu( 
            array(
            'theme_location' => 'footer-menu',
            'menu_class' => 'footer-menu'
            )
            );
        ?>
</div>
<h6>2022 © Iwo Rutka</h6>
</footer>
<?php wp_footer(  );?>
</body>
</html>