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

        <?php 
        // the query
        $wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>-1, 'order'=>'desc')); ?>

        <?php if ( $wpb_all_query->have_posts() ) : ?>

          <table cellpadding="0" cellspacing="0" border="0">
            <thead>
              <td>Date</td>
              <td>Peak name</td>
              <td>Elevation (ft.)</td>
              <td>Elevation gain (ft.)</td>
              <td>Miles</td>
            </thead>        

            <!-- the loop -->
            <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>

              <tr>
                <td><?php the_date(); ?></td>
                <td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
                <td><?php echo rwmb_meta( "elevation" ) ?></td>
                <td><?php echo rwmb_meta( "vertical" ) ?></td>
                <td><?php echo rwmb_meta( "miles" ) ?></td>
              </tr>


            <?php endwhile; ?>
            <!-- end of the loop -->

            <?php wp_reset_postdata(); ?>              

        <?php else : ?>
          <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
        <?php endif; ?>

        </table>

        <?php
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

