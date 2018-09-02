<?php
/*
Template Name: Layout Academy
*/
get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<div id="main-content">

<?php if ( ! $is_page_builder_used ) : ?>

	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">

<?php endif; ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if ( ! $is_page_builder_used ) : ?>

					<h1 class="entry-title main_title"><?php the_title(); ?></h1>
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
						the_content();
                        
						if ( ! $is_page_builder_used )
                        wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
                        ?>
                        <div class="container gca-list-item">
                            <div class="row filtro-search align-items-center">
								<button type="button" class="btn btn-sm btn-filter-academy js-switch-list-filter-grid" data-toggle="button" data-filter="grid" aria-pressed="false" autocomplete="off">
									<span class="gca-filter filter-grid"></span>
								</button>
								<button type="button" class="btn btn-sm btn-filter-academy js-switch-list-filter-list" data-toggle="button" data-filter="list" aria-pressed="false" autocomplete="off">
									<span class="gca-filter filter-list"></span>
								</button>
                                <!-- <div class="col-sm-4 offset-md-6">
                                        <input type="text" class="form-control" placeholder="Search Course" aria-label="Recipient's username" aria-describedby="basic-addon2">		
                                </div> -->
                            </div>
                            <div id="content-area" class="row">
                                <div id="left-area-gca" class="col-md-8 no-padding-left">
									<div class="list-item">

										<?php
											$args = array(
												'posts_per_page' => -1,
												'post_type' => 'project',
											);
											$query = new WP_Query( $args );
											while($query->have_posts()): $query->the_post();
											
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
															$content = get_the_content(); 
															echo mb_strimwidth($content, 0, 50, '...');
															
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
										</div> <!-- .entry-content -->
									</div>
									<div class="col-md-4 no-padding-right">
										<ul class="menu-categorias-gca">
											<li><h4 class="colorLateralTituloCategory"> <a href="#all" class="js-filter-boton titulo-sidebar-cat"> Categories</a></h4></li>
										<?php
											
											$terms = get_terms( array(
												'taxonomy' => 'project_category',
											) );
											
											foreach($terms as $term) {
												echo "<li><p><a href='#". $term->slug . "' class='js-filter-boton'>" . $term->name ."</a></p></li>";
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
				<?php
					if ( ! $is_page_builder_used && comments_open() && 'on' === et_get_option( 'divi_show_pagescomments', 'false' ) ) comments_template( '', true );
				?>

				</article> <!-- .et_pb_post -->

			<?php endwhile; ?>

			<?php if ( ! $is_page_builder_used ) : ?>

			</div> <!-- #left-area -->

			
		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php endif; ?>

</div> <!-- #main-content -->

<?php

get_footer();
