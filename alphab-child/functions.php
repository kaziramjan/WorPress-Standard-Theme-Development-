<?php
function alphab_child_assets(){
	wp_enqueue_style("parent-style", get_parent_theme_file_uri("/style.css"),array("maxcdn"));
}
add_action("wp_enqueue_scripts","alphab_child_assets");

function alphab_child_assets_dequeue(){
	wp_dequeue_style("alphab-style");
	wp_deregister_style("alphab-style");
	wp_enqueue_style("alphab-style", get_theme_file_uri("/assets/css/alphab.css"));
}
add_action("wp_enqueue_scripts","alphab_child_assets_dequeue",14);

function alphab_child_assets_dequeue_maxcdn_bootstrap(){
		wp_dequeue_style("maxcdn");
	wp_deregister_style("maxcdn");
	wp_enqueue_style("maxcdn", "//cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css");
}
add_action("wp_enqueue_scripts","alphab_child_assets_dequeue_maxcdn_bootstrap",11);



