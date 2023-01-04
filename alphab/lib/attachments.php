<?php 
define( 'ATTACHMENTS_SETTINGS_SCREEN', false ); // disable the Settings screen
add_filter( 'attachments_default_instance', '__return_false' ); // disable the default instance


function alphab_attachments($attachments){
    $fields = array (
        array(
            'name'  => 'title',
            'type'  => 'text',
            'label' => __('Title', 'alphab'),
        ),
        // array(
        //     'name'  => 'caption',
        //     'type'  => 'wysiwyg',
        //     'label' => __('Caption', 'alphab'),
        // ),
    );

    $args = array(
        'label'         => 'Featured Slider',
        'post_type'     => array('post'),
        'filetype'      => array('image'),
        'note'          => 'Add Slider Image',
        'button_text'   => __('Attach Files', 'alphab'),
        'fields'        => $fields,
    );

    $attachments->register('slider', $args);
}
add_action( 'attachments_register', 'alphab_attachments' );


function alphab_testimonial_attachments($attachments){
    $fields = array (
        array(
            'name'  => 'name',
            'type'  => 'text',
            'label' => __('Name', 'alphab'),
        ),
        array(
            'name'  => 'position',
            'type'  => 'text',
            'label' => __('Position', 'alphab'),
        ),
        array(
            'name'  => 'company',
            'type'  => 'text',
            'label' => __('Company', 'alphab'),
        ),
        array(
            'name'  => 'testimonial',
            'type'  => 'textarea',
            'label' => __('Testimonail', 'alphab'),
        ),
    );

    $args = array(
        'label'         => 'Testimonials',
        'post_type'     => array('page'),
        'filetype'      => array('image'),
        'note'          => 'Add Testimonials',
        'button_text'   => __('Attach Files', 'alphab'),
        'fields'        => $fields,
    );

    $attachments->register('testimonials', $args);
}
add_action( 'attachments_register', 'alphab_testimonial_attachments' );