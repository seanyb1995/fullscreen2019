<?php
/*
 * function that creates template tag function 'graduates'
 * this function queries WP database for the staff posts and uses the WP loop
 * to output some HTML for each product with a heading and link.
 * A dropdown appears allowing the front-end user to filter by the category taxonomy
*/
// add_action('wp_ajax_ddgfilter', 'digital_design_gradautes_filter_function'); // wp_ajax_{ACTION HERE}
// add_action('wp_ajax_nopriv_ddgfilter', 'digital_design_graduates_filter_function');

if ( !function_exists( 'graduates' ) ) {
  function graduates() {
      
    // if any filters are set 
        
    // else, just query all posts as normal (no filtering)
    $args = array(
      'post_type'		=> 'graduates',
      'meta_key'		=> 'digital_design_specialisation',
      'meta_value'	=> 'Front End Development'
    );
    
  $graduates = new WP_Query($args);
  if( $graduates->have_posts() ): ?>
    <?php while($graduates->have_posts()): $graduates->the_post(); ?>
      <div class="graduate">
        <h1><?php the_title(); ?></h1>
          <?php   // Get terms for post
           $terms = get_the_terms( $post->ID , 'major' );
           // Loop over each item since it's an array
           if ( $terms != null ){
           foreach( $terms as $term ) {
           // Print the name method from $term which is an OBJECT
           echo '<h3>' . $term->name .'</h3>';
           // Get rid of the other data stored in the object, since it's not needed
           unset($term);
          } } ?>
        <p>
          <?php 
                   
            $specialisation = get_field_object('digital_design_specialisation'); 
            echo $specialisation['value'];
    
          ?>
        </p>
      </div>
    <?php endwhile ?>
  <?php endif ?>
  <?php
  }
}
