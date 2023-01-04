<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header-logo text-center">
                    <?php
                    if(current_theme_supports("custom-logo")){
                         the_custom_logo();
                    } else{

                    }
                    ?>
                </div>
                <h3 class="tagline">
                    <?php bloginfo("description"); ?>
                </h3>
                <h1 class="align-self-center display-1 text-center heading">
                    <a href="<?php echo site_url(); ?>"><?php bloginfo("name"); ?></a>
                </h1>
            </div>
            <div class="col-md-12">
                <div class="navigation">
                    <?php
                    wp_nav_menu( array(
                        'theme_location'    => 'top-menu',
                        'menu_id'   => 'top-menu',
                        'menu_class'    => 'list-inline text-center',

                    ) );
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container text-center">
        <div class="row">
            <div class="col-md-12">
                <?php
                if(is_search()){
                    ?>
                    <h3><?php _e("You searched for: ", "alphab"); the_search_query(); ?></h3>
                    <?php
                }
                echo get_search_form();
                ?>
            </div>
        </div>
    </div>
</div>