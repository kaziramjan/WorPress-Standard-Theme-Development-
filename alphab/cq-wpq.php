<?php
/**
 * Template Name: WP Query
 */
?>
<?php get_header(); ?>
<body <?php body_class(); ?>>
<?php get_template_part("hero"); ?>
<div class="posts text-center">
    <?php
    $paged = get_query_var("paged")?get_query_var("paged"):1; 
    $posts_per_page = 2;
    $post_ids = array(6,9,8);
    $_p = new WP_Query( array(
        'posts_per_page'    => $posts_per_page,
        'post__in' => $post_ids,
        'orderby' =>'post__in',
        'paged' => $paged
    ));
    while($_p-> have_posts()){
        $_p->the_post();
    ?>
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php 
        }
        wp_reset_query();
    ?>
    <div class="container post-pagination">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-8"> 
                <?php
                    echo paginate_links(array(
                        'total' => $_p->max_num_pages,
                        'current'   => $paged,
                        // 'prev_next' => false,
                        'prev_text' => __('Old Posts', 'alphab'),
                        'next_text' => __('New Posts', 'alphab'),

                    ));
                ?>
                
            </div>
        </div>
    </div>

</div>
<?php get_footer(); ?>