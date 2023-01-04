<?php 
add_action( 'cmb2_init', 'alphab_add_image_info_metabox' );
function alphab_add_image_info_metabox() {


			$prefix = '_alphab_';
			$cmb = new_cmb2_box( array(
				'id'           => $prefix . 'image_information',
				'title'        => __( 'Image Information', 'alphab' ),
				'object_types' => array( 'post' ),
				'context'      => 'normal',
				'priority'     => 'default',
			) );

			$cmb->add_field( array(
				'name' => __( 'Camera Model', 'alphab' ),
				'id' => $prefix . 'camera_model',
				'type' => 'text',
				'default' => 'canon',
			) );

			$cmb->add_field( array(
				'name' => __( 'Location', 'alphab' ),
				'id' => $prefix . 'location',
				'type' => 'text',
			) );

			$cmb->add_field( array(
				'name' => __( 'Date', 'alphab' ),
				'id' => $prefix . 'date',
				'type' => 'text_date',
			) );

			$cmb->add_field( array(
				'name' => __( 'Licensed', 'alphab' ),
				'id' => $prefix . 'licensed',
				'type' => 'checkbox',
			) );

			$cmb->add_field( array(
				'name' => __( 'License Information', 'alphab' ),
				'id' => $prefix . 'license_info',
				'type' => 'textarea',
				'attributes' => array(
					'data-conditional-id' => $prefix . 'licensed',
				),
			) );

}
