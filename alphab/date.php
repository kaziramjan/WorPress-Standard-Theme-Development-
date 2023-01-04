<?php get_header(); ?>
<body <?php body_class(); ?>>
<?php get_template_part("hero"); ?>
<div class="posts text-center">
    <h1>
        Post In: 
        <?php
        $day = esc_html(get_query_var("day"));
        $month = esc_html(get_query_var("monthnum"));
        $year = esc_html(get_query_var("year"));
            if(is_month()){
                $dateobj = DateTime::createFromFormat("!m", $month);
                echo $dateobj->format("F");
            }else if(is_year()){
                echo get_query_var("year");
            }else if(is_day()){
                printf("%s/%s/%s", $day, $month, $year);
                // echo $day,"/".$month."/".$year;
            }
        ?>
    </h1>
    <?php 
    while(have_posts()){
        the_post();
        ?>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php
        }
        ?>
    <div class="container post-pagination">
        <div class="row">
            <div class="col-md-4"> 

            </div>
            <div class="col-md-8"> 
                <?php
                the_posts_pagination(array(
                    "screen_reader_text"=>' ',
                    "prev_text" => "New Posts",
                    "next_text" => "Old Posts",
                ));
                ?>
                
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>