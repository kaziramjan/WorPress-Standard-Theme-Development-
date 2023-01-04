<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                &copy; LWHH - All Rights Reserved
                <div class="footermenu">
                    <?php
                        wp_nav_menu( array(
                            'theme_location'    => 'footer-menu',
                            'menu_id'   => 'footermenucontainer',
                            'menu_class'    => 'list-inline text-right',
                        ) );
                    ?>
                </div>
            </div>

        </div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>