<?php

function add_stylesheets() {
   wp_enqueue_style( 'style', get_stylesheet_uri() );
   if(is_page(6)){
     wp_enqueue_style( 'ab', get_stylesheet_directory_uri()."/css/about.css" );
   }
   wp_enqueue_style('bootstrap-css' , get_stylesheet_directory_uri()."/inc/bootstrap/css/bootstrap.css");
   wp_enqueue_script('bootstrap-js' , get_stylesheet_directory_uri()."/inc/bootstrap/js/bootstrap.js"); 
}

add_action( 'wp_enqueue_scripts', 'add_stylesheets' );

register_nav_menus( array(
    'primary'   => __( 'Primary Menu', 'site1' ),
    'secondary' => __( 'Secondary Menu', 'site1' )
) );


 remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
 remove_action( 'wp_head', 'wp_oembed_add_host_js' );

 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'wp_print_styles', 'print_emoji_styles' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' );
 
 class MyNav extends Walker_Nav_Menu{
	 
	function start_lvl( &$output, $depth = 0, $args = null ){
	  $indent = str_repeat("\t", $depth);
      $submenu = ($depth >= 0) ? 'dropdown-menu' : '';
	  //$output .= "\n$indent<ul class =\"dropdown-menu $submenu depth-$depth\">\n";	 //отступ для вложенного меню. 
	  $output .= "\n$indent<ul class =\"". $submenu ."\">\n";
    }

    function start_el( &$output, $item, $depth = 0, $args = NULL, $id = 0 ){
      
	  $indent = ($depth) ? str_repeat("\t", $depth) : '';
	  $li_attributes = '';
	  $class_names = '';
	  
	  //$classes = empty($item->classes) ? array() : (array)$item->classes;
	  $classes[] = 'nav-item';
      if(($this->has_children)){
		$classes[] = 'dropdown';
	  }
	  else{
		'не пашет';
	  }		
	  //$classes[] = ($args->has_children) ? ' dropdown' : 'не сработало';
	  //$classes[] = ($item->current || $item->current_item_anchestor) ? 'active' : '';
	  //$classes[] = 'menu-item-' . $item->ID;
	  
	  //print_r($classes);
	  
	  //print_r($args);
	  
	  /*if( $depth && $args->has_children ){
		  $classes[] = 'nav-item dropdown';
	  }*/

      $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args ) );
	  
	  //echo $class_names;
	  //$class_names = 'nav-item'; 
      $class_names = ' class="' . esc_attr($class_names) . '"';
	  

      $id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
      $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';	  
	  
	  $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';
	  
	  /*$attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
	  $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
	  $attributes .= !empty($item->xfn) ? 'rel="' . esc_attr($item->xfn) . '"' : '';
      $atttibutes .= !empty($item->url) ? 'href="' . esc_attr($item->url) . '"' : '';*/
	  
	  	$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr($item->target) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr($item->url) . '"' : '';

      $attributes .=($this->has_children) ? ' class="dropdown-toggle" data-toggle="dropdown"' : ' class="nav-link"';
	  
	  //echo $attributes;

      $item_output = $args->before;
      $item_output .= '<a' . $attributes . ' data-bs-toggle="dropdown">';
      $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
	  //$item_output .= ($depth == 0 && $this->has_children) ? ' <b class="carret"></b></a>' : '</a>';
	  $item_output .= $args->after;

      $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	  
    }
/*
    function end_el(){

    {

    function end_lvl(){
		
    }
*/		
}	 

?>