<?php
if ( ( is_single() || is_page() ) && in_array( get_post_meta( get_queried_object_id(), '_et_pb_page_layout', true ), array( 'et_full_width_page', 'et_no_sidebar' ) ) ) {
	return;
}

if ( is_active_sidebar( 'sidebar-gca' ) ) : ?>
	<div id="sidebar">
		<?php dynamic_sidebar( 'sidebar-gca' ); ?>
	</div> <!-- end #sidebar -->
<?php
endif;
