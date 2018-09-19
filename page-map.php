<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">
  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

      <?php
      while ( have_posts() ) : the_post();

        get_template_part( 'template-parts/page/content', 'page' ); ?>

        <div id="map"></div>

        <?php 
        // the query
        $wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>-1, 'order'=>'asc')); ?>

        <?php if ( $wpb_all_query->have_posts() ) : ?>


        <script>
        function initMap() {
                
                // centered on wasatch
                //var myLatLng = {lat: 40.633573, lng: -111.705311};
                
                // center for uintas inclusion
                var myLatLng = {lat: 40.675352, lng: -111.290423};

                var map = new google.maps.Map(document.getElementById('map'), {
                  zoom: 10,
                  center: myLatLng,
                  mapTypeId: 'terrain'
                });

                         

                <!-- the loop -->
                <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>

                <?php if ( rwmb_meta( 'latitude' ) ) { ?>
          
                  //var newLatLng = {lat: 43.283793, lng: -123.234735};
                  var newLatLng = {lat: <?php echo rwmb_meta( 'latitude' ) ?>, lng: <?php echo rwmb_meta( 'longitude' ) ?>};

                  //console.log(newLatLng);

                  var marker = new google.maps.Marker({
                    position: newLatLng,
                    map: map,
                    title: '<?php the_title(); ?>, <?php echo rwmb_meta( "elevation" ) ?> ft., <?php the_date(); ?>'
                  }); 

                  marker.addListener('click', function() {
                    window.location.href = '<?php the_permalink(); ?>';
                  });         
                
                <?php } ?>

          <?php endwhile; ?>
          <!-- end of the loop -->


          <?php wp_reset_postdata(); ?>

        }
        </script>
            <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBebHs1vv32xv2jHti8cMKKE9N_OUfaqE8&callback=initMap">
            </script>
        <?php else : ?>
          <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
        <?php endif; 

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
          comments_template();
        endif;

      endwhile; // End of the loop.
      ?>

    </main><!-- #main -->
  </div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer(); 

