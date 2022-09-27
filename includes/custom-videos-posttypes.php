<?php
/**
 * Custom Post Type
 */

add_action( 'init', 'expopyme_posttype_videos' );

function expopyme_posttype_videos(){
    $labels = array(
        'name'                => __('Videos'),
        'singular_name'       => __('Video'),
        'add_new'             => __('Agregar nuevo video'),
        'add_new_item'        => __('Agregar nuevo video'),
        'edit_item'           => __('Editar video'),
        'add_new'             => __('Agregar nuevo video'),
        'all_items'           => __('Todos los videos'),
        'view_item'           => __('Ver videos'),
        'search_items'        => __('Buscar videos'),

        'not_found'           => __('No se han encontrado posts de video.'),
		'not_found_in_trash'  => __('No se han encontrado posts de video en la papelera')
    );


    $args = array(
        'labels'            => $labels,
        'description'       => '',
        'public'            => true,
        'menu_position'     => 5,
        'menu_icon' => 'dashicons-screenoptions',
        'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt'),
        'has_archive'       => true,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'query_var'         => 'video'
      );

      register_post_type( 'video', $args);
}


function taxonomias_video() {
    register_taxonomy(
        'video_categorias',
        'video',
        array(
            'hierarchical' => true,
            'label' => 'Categoría de videos',
            'query_var' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_admin_column' => true,
            'rewrite' => array(
                'slug' => 'slug_video',
                'with_front' => false
            )
        )
    );
  }
  add_action( 'init', 'taxonomias_video');
//

?>