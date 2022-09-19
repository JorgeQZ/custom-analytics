<?php
/**
 * Plugin Name: Custom Analytics
 * Description: Analytics desarrollado para el tracking de clicks y views de videos en el sitio de ExpoPyme
 * Version: 0.1
 * Author: Jorge Quezada
 * Author URI: https://akevia.com/
 **/


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
    <h2>ExpoPyme Analytics</h2>
    <p>Aquí se muestran los datos rastreados de clicks y views obtenidos en el sitio. Para las métricas se usan los siguientes parametros:

        <ol>
            <li>Los usuarios deben estar logeados en el sitio.</li>
            <li>Las views se contabilizan si se han reproducido al menos 15 minutos de contenido de un mismo video</li>
            <li>Detalles extras en desarrollo</li>
        </ol>
    </p>
    <?php
 }
