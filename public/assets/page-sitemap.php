<?php
/*
Template Name: Sitemap
*/
?>

<?php get_header(); ?>

    <main>
		<section class="pt-3 pt-xl-3 mt-2 mt-lg-3 mb-80">
			<?php 
            // var_dump($post_type);

            $args = array(
                'public'   => true,
                '_builtin' => false
            );
            $output = 'names'; // или objects
            $operator = 'and'; // 'and' или 'or'
            
            $taxonomies = get_taxonomies( $args, $output, $operator );
            
            echo '<pre>';
            var_dump($taxonomies);
            echo '</pre>';
            
            $term = get_term_by();
            $term_name = $term->name;


            foreach( get_post_types( array('public' => true) ) as $post_type ) {
                
                if ( in_array( $post_type, array('post','page','attachment') ) ) {
                    continue;
                }
                  
                $pt = get_post_type_object( $post_type );

                echo '<h2 style="color:blue;">' . $pt->labels->name . '</h2>';

                
            
                if($pt->labels->name === "Services"){
                    if($taxonomies){
                        foreach( $taxonomies as $taxonomy ){  
                            
                            
                            if($taxonomy === "service_type"){                                
                                $terms = get_terms(array(
                                    'hide_empty'  => 0,
                                    'orderby'     => 'name',
                                    'order'       => 'ASC',
                                    'taxonomy'    => 'service_type',               
                                ));
                                $terms = wp_list_filter($terms); 
                               
                                if($terms){
                                    foreach($terms as $term){

                                        
                                        ?>
                                        <a href="<?php echo $term->slug; ?>" ><?php echo $term->name; ?></a><br>
                                        <ul>

                                        <?php //service_country ?>


                                            <li></li>
                                        </ul>
                                       <?php                                      
                                    }
                                }
                            }
                        }
                    }
                }
                
                
                if($pt->labels->name === "Solutions"){
                    if($taxonomies){
                        foreach( $taxonomies as $taxonomy ){                           
                            if($taxonomy === "solution_type"){                                
                                $terms = get_terms(array(
                                    'hide_empty'  => 0,
                                    'orderby'     => 'name',
                                    'order'       => 'ASC',
                                    'taxonomy'    => 'solution_type',               
                                ));
                                $terms = wp_list_filter($terms); 
                                
                                if($terms){
                                    foreach($terms as $term){
        
                                        echo $term->name .'<br>';                                      
                                    }
                                }
                            }
                        }
                    }
                }




                if($pt->labels->name === "News"){
                    echo '<ul>';
                    query_posts('post_type=' . $post_type . '&posts_per_page=-1');
                    while( have_posts() ) {
                      the_post();
                      echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
                    }
                    echo '</ul>';
                }
                
              }
            
              echo '<pre>';
              var_dump( 0 );
              echo '</pre>';
              ?>
		</section>
	</main>

<?php get_footer(); ?>