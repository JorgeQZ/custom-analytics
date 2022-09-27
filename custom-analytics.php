<?php
/**
 * Plugin Name: Custom Analytics
 * Description: Analytics desarrollado para el tracking de clicks y views de videos en el sitio de ExpoPyme
 * Version: 0.1
 * Requires PHP: 7.4
 * Author: Jorge Quezada
 * Author URI: https://akevia.com/
 **/


 /**
  * Custom Post Types
  */

  include "includes/custom-videos-posttypes.php";

/**
 * Estilos y JavaScript
*/

// ADMIN
function ca_admin_style() {

    wp_enqueue_style('admin-styles', plugins_url().'/custom-analytics/admin/css/styles.css');
}
add_action('admin_enqueue_scripts', 'ca_admin_style');



/**
 * PUBLIC
 */

function wp_enqueue_scripts__youtube_api() {
    wp_enqueue_script( 'yt-player-api', 'http://www.youtube.com/iframe_api', array(), false, true );
}

add_action( 'wp_enqueue_scripts', 'wp_enqueue_scripts__youtube_api' );

function wp_footer__youtube_api() {
    if ( wp_script_is( 'yt-player-api', 'done' ) ) {
        ?>
        <script id="yt-player-api-ready"  src="<?php echo plugins_url() . '/custom-analytics/public/js/tracking-videos.js';?>"></script>
        <?php
    }
}

add_action( 'wp_footer', 'wp_footer__youtube_api', 20 );

function ca_admin_public_script() {

    wp_enqueue_script('jquery');
    // wp_enqueue_script( 'script', plugins_url() . '/custom-analytics/public/js/tracking-videos.js', array ( 'jquery' ), 1.1, true);
    wp_enqueue_style('expo-videos',plugins_url() . '/custom-analytics/public/css/expo-videos.css');
}
add_action('wp_enqueue_scripts', 'ca_admin_public_script');

/***
 * Página del Dashboard
*/
 function ca_register_setting(){
    register_setting(
        'custom-analytics-group', 'custom-analytics', 'intval'
    );

    add_action( 'admin_init', 'ca_register_setting');
 }

 function ca_capability( $capability ){
    return 'edith_other_posts';
 }
 add_filter('option_page_capability_custom-analytics-group', 'ca_capability');

 function ca_register_ca_menu_page(){
    add_menu_page(
        __('ExpoPyme Analytics', 'textdomain'), //Pagina
        'ExpoPyme Analytics', //Titulo
        'manage_options', //options
        'expopyme-analytics-admin-page', //url
        'expopyme_CA', //funcion callback
        'dashicons-chart-line', //Dashicon
        1, // orden
    );
 }

 add_action( 'admin_menu', 'ca_register_ca_menu_page' );

 function expopyme_CA(){
    ?>
    <h1>ExpoPyme Analytics</h1>
    <hr>
    <p>Aquí se muestran los datos rastreados de clicks y views obtenidos en el sitio. Para las métricas se usan los siguientes parametros:

        <ol>
            <li>Los usuarios deben estar logeados en el sitio.</li>
            <li>Las views se contabilizan si se han reproducido al menos 15 minutos de contenido de un mismo video</li>
            <li>Detalles extras en desarrollo</li>
        </ol>
    </p>
    <?php
 }
