<?php 

function my_theme_enqueue_styles() {

    $parent_style = 'twentyseventeen-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


add_filter( 'rwmb_meta_boxes', 'fortybyforty_meta_boxes' );
function fortybyforty_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      => __( 'Location', 'fortybyforty' ),
        'post_types' => 'post',
        'fields'     => array(
            array(
                'id'   => 'latitude',
                'name' => __( 'Latitude', 'fortybyforty' ),
                'type' => 'text',
            ),
            array(
                'id'      => 'longitude',
                'name'    => __( 'Longitude', 'fortybyforty' ),
                'type'    => 'text',
            ),
            array(
                'id'      => 'elevation',
                'name'    => __( 'Elevation', 'fortybyforty' ),
                'type'    => 'text',
            ),
            array(
                'id'      => 'vertical',
                'name'    => __( 'Vertical Ascent', 'fortybyforty' ),
                'type'    => 'text',
            ),
            array(
                'id'      => 'miles',
                'name'    => __( 'Miles', 'fortybyforty' ),
                'type'    => 'text',
            ),
        ),
    );
    return $meta_boxes;
}


?>