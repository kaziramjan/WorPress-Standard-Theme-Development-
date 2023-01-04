<?php get_header(); ?>
<body <?php body_class(); ?>>
<?php get_template_part("hero"); ?>
<div class="posts text-center">
    <?php
        while(have_posts()){
            the_post();           
    ?>
    <h1><?php echo the_title();?></h1>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2><?php _e("Testimonials","alphab"); ?></h2>
                <div class="testimonials text-center slider">
                <?php
                                    if( class_exists('Attachments')){
                                        $attachments = new Attachments('testimonials');
                                        if($attachments->exist()){
                                            while($attachment = $attachments->get()){ ?>
                                            <div>
                                                <?php echo $attachments->image('thumbnail'); ?>
                                                <h4><?php echo esc_html($attachments->field('name')); ?></h4>
                                                <p><?php echo esc_html($attachments->field('testimonial')); ?></p>
                                                <p>
                                                    <?php echo esc_html($attachments->field('position')); ?>,
                                                    <strong>
                                                    <?php echo esc_html($attachments->field('company')); ?>
                                                    </strong>
                                                </p>
                                            </div>
                                        <?php
                                            }
                                        }
                                    }
                                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12"> 
            <?php echo the_content(); ?>
            </div>
        </div>
    </div>
<?php } ?>
    
</div>
<?php get_footer(); ?>