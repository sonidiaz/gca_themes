<?php
/*
Template Name: Layout Academy
*/

get_header();

?>


<?php

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() ); ?>

<div id="main-content">

<?php if ( ! $is_page_builder_used ) : ?>

		
	<div class="container">
		<div id="content-area" class="row">
			<div id="left-area-gca" class="col-md-7 no-padding-left">
            
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('main-video-detail'); ?>>

				<?php if ( ! $is_page_builder_used ) : ?>

					<div class="et_main_title ">
						<h1 class="entry-title style-h1-gca"><?php the_title(); ?></h1>
						<!-- <span class="et_project_categories"><?php echo get_the_term_list( get_the_ID(), 'project_category', '', ', ' ); ?></span> -->
					</div>
				<?php endif; ?>
				<?php

						$_terms = get_terms( array('project_category') );
						$termToRelation = '';
						$terms3 = get_the_terms( $post->ID , array( 'project_category') );

						$globalPostId = $post->ID; 
						
						// init counter
						$i = 1;
						foreach ( $terms3 as $term ) {
							if($i == 1){
								$termToRelation = $term->slug;
							}
							$term_link = get_term_link( $term, array( 'project_category') );
							if( is_wp_error( $term_link ) )
							continue;
							// echo $term->name;
							//  Add comma (except after the last theme)
						
							// Increment counter
							$i++;
						}
						
						?>
					<div class="entry-content">
					<?php
						$urlVimeo = 'https://player.vimeo.com/video/'; 
						$urlVideoGca =  get_post_meta( get_the_ID(), 'input-metabox-video', true ); 
						
					?>
					<div class="con-video-player">
					<iframe src=<?php echo $urlVimeo.$urlVideoGca ?> width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
					</div>
					<?php
						the_content();

						if ( ! $is_page_builder_used )
							wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
					</div> <!-- .entry-content -->
					
				<?php if ( ! $is_page_builder_used ) : ?>

					<?php 
						if ( in_array( $page_layout, array( 'et_full_width_page', 'et_no_sidebar' ) ) ) {
							et_pb_portfolio_meta_box(); 
						} 
					?>
						
							

				<?php endif; ?>

				<?php if ( ! $is_page_builder_used || ( $is_page_builder_used && 'on' === $show_navigation ) ) : ?>
					
					<!-- <div class="nav-single clearfix">
						<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . et_get_safe_localization( _x( '&larr;', 'Previous post link', 'Divi' ) ) . '</span> %title' ); ?></span>
						<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . et_get_safe_localization( _x( '&rarr;', 'Next post link', 'Divi' ) ) . '</span>' ); ?></span>
					</div> -->

				<?php endif; ?>

				</article> <!-- .et_pb_post -->

				
				<?php endwhile; ?>
                
<?php endif; ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if ( ! $is_page_builder_used ) : ?>
                    
					<!-- <h1 class="main_title"><?php the_title(); ?></h1> -->
				<?php
					$thumb = '';

					$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

					$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
					$classtext = 'et_featured_image';
					$titletext = get_the_title();
					$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
					$thumb = $thumbnail["thumb"];

					if ( 'on' === et_get_option( 'divi_page_thumbnails', 'false' ) && '' !== $thumb )
						print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height );
				?>

				<?php endif; ?>

					<div class="entry-content">
					<?php

						if ( ! $is_page_builder_used )
							wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
					</div> <!-- .entry-content -->

				<?php
					if ( ! $is_page_builder_used && comments_open() && 'on' === et_get_option( 'divi_show_pagescomments', 'false' ) ) comments_template( '', true );
				?>

				</article> <!-- .et_pb_post -->

			<?php endwhile; ?>

<?php if ( ! $is_page_builder_used ) : ?>

			</div> <!-- #left-area -->
            
			<div class="col-md-4 offset-md-1 no-padding-right">

                <ul class="menu-categorias-gca">
					<li><h4 class="colorLateralTituloCategory">Categories</h4></li>
                <?php
					
					$terms = get_terms( array(
						'taxonomy' => 'project_category',
					) );
                   
					foreach($terms as $term) {
						echo "<li><p><a class='' href='".get_bloginfo( 'url' ) . '/project_category/'.$term->slug."'>" . $term->name ."</a></p></li>";
						// echo "<li><p><a href='#". $term->slug . "' class='js-filter-boton'>" . $term->name ."</a></p></li>";
					  }
                    ?>
				</ul>
				<ul class="menu-categorias-gca gca-tags">
					<li><h4 class="colorLateralTituloTag">Tags</h4></li>
                <?php
					
					$terms = get_terms( array(
						'taxonomy' => 'project_tag',
						'hide_empty' => false,
					) );

					$term_link_tag = get_the_terms( $post->ID, 'project_tag' );
					
					$termData = [];
					if(!empty($terms)){
						$__Data = array_push($termData, $terms);
					}
					
					
					foreach($terms as $term) {
						echo "<li class='gca-nuve-tag'><p><a class='' href='".get_bloginfo( 'url' ) . '/project_tag/'.$term->slug."'>" . $term->name ."</a></p></li>";
					}

				
                    ?>
                </ul>
            </div>
           
		</div> <!-- #content-area -->
	</div> <!-- .container -->
	<?php
		$currentID = get_the_ID();
		
		$args = array(
		'posts_per_page' => 3,
		'post_type' => 'project',
		'order' => 'rand',
		'tax_query' => array(
			array(
			'taxonomy' => 'project_category',
			'field'    => 'slug',
			'terms'    => $termToRelation,
			'post__not_in' => array($currentID),
			)
		),
		);
		$query = new WP_Query( $args );
		
		 
		
		?>
		<div class="container info-related-gca">
			<h4 class="text-center colorLateralTituloCategory">Related videos</h4>
			<div class="row">
				<?php while($query->have_posts()): $query->the_post(); ?>
				<div class="col-md-4">
					<a href=<?php permalink_link($post->id)?> class="link-related-videos">
						<?php
							echo get_the_post_thumbnail( $post->ID);
							
						?>

					</a>
					<?php 
						the_title('<h2>', '</h2>');
					?>

				</div>
				<?php
				endwhile; wp_reset_postdata();
				?>
			</div>
		</div>
<?php endif; ?>

</div> <!-- #main-content -->

<?php

get_footer();
