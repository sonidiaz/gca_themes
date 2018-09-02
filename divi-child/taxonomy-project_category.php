<?php
/*
Template Name: Layout Taxonomy
*/

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() ); ?>

<div id="main-content">

<?php if ( ! $is_page_builder_used ) : ?>
	<div class="container-gca interior-cat">
		
        <div class="row">
			<div class="container-gca heroSlider">
					<div class="row row-no-flex">
						<div class="hero-slider-gca">
							<div class="cont-wrapper-gca ">
								<div class="">
									<div class="item-hero-gca et_pb_row">
										<div class="et_pb_text_inner et_pb_text_0">
											<!-- <h2>GCA ACADEMY EVENTS</h2> -->
											<?php
											$args = array(
												'posts_per_page' => -1,
												'post_type' => 'project',
											);
											$query = new WP_Query( $args );
											while ( have_posts() ): the_post(); 
											
											$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
								
											endwhile; wp_reset_postdata();
									
											?>
										</div>	
										<div class="et_pb_module et_pb_text et_pb_text_1 et_pb_bg_layout_dark  et_pb_text_align_left">
											<div class="et_pb_text_inner et_pb_text_1">
												<h1><?php echo $term->name;; ?></h1>
											</div>
										</div>
										<!-- <div class="et_pb_module et_pb_text et_pb_text_2 et_pb_bg_layout_light  et_pb_text_align_left">
											<p class="et_pb_text_inner">
												The best tips, techniques, KOL’s and workshops selected for you. 
											</p>
										</div>
										<div class="et_pb_button_module_wrapper et_pb_button_0_wrapper et_pb_button_alignment_ et_pb_module ">
											<a class="et_pb_button et_pb_button_0 et_animated et_pb_bg_layout_light zoom btn btn-link btn-cta-hero-gca" href="#" style="animation-duration: 1000ms; animation-delay: 100ms; opacity: 0; animation-timing-function: ease-in-out; transform: scale3d(0.9, 0.9, 0.9);">See more</a>
										</div> -->
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php slickInit(); ?>
				</div>
        </div>
	</div>
	<div class="container">
		<div class="row filtro-search align-items-center">
			<div class="col-sm-2">
				<div class="row align-items-center">
					<div class="col-3">
					<button type="button" class="btn btn-sm btn-filter-academy js-switch-list-filte-column" data-toggle="button" data-filter="grid" aria-pressed="false" autocomplete="off">
						<span class="gca-filter filter-grid"></span>
					</button>
					</div>
					<div class="col-3">
						<button type="button" class="btn btn-sm btn-filter-academy js-switch-list-filter-list" data-toggle="button" data-filter="list" aria-pressed="false" autocomplete="off">
							<span class="gca-filter filter-list"></span>
						</button>
					</div>
				</div>
			</div>
			
		</div>
		<div id="content-area" class="row">
			<div id="left-area-gca" class="col-md-8 no-padding-left">
				<div class="list-item">

				<?php
                    $args = array(
                        'posts_per_page' => -1,
                        'post_type' => 'project',
                        'order' => 'rand',
                    );
                    $query = new WP_Query( $args );
					while ( have_posts() ): the_post(); 
					
					
					$terminos__ =  get_the_term_list( $post->ID, 'project_category', " ", ', ','');
					

					$getSlugTerm = wp_get_post_terms( $post->ID, 'project_category' );
					$getSlugTermTags = wp_get_post_terms( $post->ID, 'project_tag' );

					$__classSlugCat = [];
					$__classSlugTag = [];
					
					foreach( $getSlugTerm as $thisslug ) {
						$__classSlugCat[] =  $thisslug->slug . ' '; // Added a space between the slugs with . ' '
					}
					
					foreach( $getSlugTermTags as $thisslug ) {
						$__classSlugTag[] =  $thisslug->slug . ' '; // Added a space between the slugs with . ' '
						
					}
					
					// $terms = get_the_term_list( $post->ID, 'tags' );
					// $terms = strip_tags( $terms );

					?>
					
					<div class="row item-post-gca  <?php echo implode(" ",$__classSlugCat); ?> <?php echo implode(" ",$__classSlugTag); ?>">
						<div class="col-md-6">
							<?php
								echo get_the_post_thumbnail( $post->ID);
							?>
						</div>
						<div class="col-md-6">
							<?php 
								$term_name = wp_get_post_terms($post->ID, 'project_category', array("fields" => "names" ));
								$term_link = get_the_terms( $post->ID, 'project_category' );
								$index = 0;
								foreach( $term_link as $termLink ) {
									$link = get_bloginfo( 'url' ) . '/project_category/' . $termLink->slug . '/';
									?> 
										<a href=<?php echo $link;; ?> class="btn btn-primary btn-sm btn-tag-category-gca" data-toggle="a" aria-pressed="false" autocomplete="off">
												<?php
											echo $term_name[$index];
											?>
										</a>
										<?php
										$index ++;
									
								}
							?>
							<h5 class="mt-0"><?php the_title('<h2>', '</h2>'); ?></h5>
							<p>
								<?php 
									$content = get_the_content(); echo mb_strimwidth($content, 0, 100, '...');
								?>
							</p>
							<a href=<?php the_permalink($post->ID); ?> class="btn btn-primary btn-lg btn-primary-gca" data-toggle="a" aria-pressed="false" autocomplete="off">
							See Video
							</a>
						</div>
					</div>
					<?php
                    endwhile; wp_reset_postdata();
                ?>
				</div>
                
                
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
            
			<div class="col-md-4 no-padding-right">
			<ul class="menu-categorias-gca">
					<li><h4 class="colorLateralTituloCategory "> <a href="<?php echo get_bloginfo( 'url' ).'/academy'; ?>" class="js-filter-boton">Categories</a> </h4></li>
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
					
					$termData = [];
					if(!empty($terms)){
						$__Data = array_push($termData, $terms);
					}
					
					foreach($terms as $term) {
						echo "<li class='gca-nuve-tag'><p><a class='js-filter-boton' href='#". $term->slug . "'>" . $term->name ."</a></p></li>";
					}

				
                    ?>
                </ul>
            </div>
           
		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php endif; ?>

</div> <!-- #main-content -->

<?php

get_footer();
