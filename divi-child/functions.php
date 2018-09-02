<?php

$taxonomy = 'project_category';
$args = array(
    'with_thumbnail' => true, // true = retrieve terms that has thumbnail, false = retrieve all terms
);
$terms = get_terms($taxonomy, $args);

function change_name_divi_project() {
    register_post_type( 'project',
        array(
            'labels' => array(
            'name' => __( 'Academy', 'divi' ),
            'singular_name' => __( 'Academy', 'divi' ),
        ),
        'has_archive' => true,
        'hierarchical' => true,
        'public' => true,
        'rewrite' => array( 'slug' => 'Academy', 'with_front' => false ),
        'supports' => array(),
    ));
}
add_action( 'init', 'change_name_divi_project' );


function pf_scripts_styles() {
	/* 	wp_register_script('chatApp', '//userlike-cdn-widgets.s3-eu-west-1.amazonaws.com/fc4b623ba3cd56e6f48b687a2d9d3c2d95791e636805bec8bf476f4767caa9e1.js',	array(), true, true ); */
			wp_register_script('bootstrap', get_stylesheet_directory_uri() . '/assets/js/plugins/bootstrap.min.js',	 array('jquery') , false);
			wp_register_script('slick', get_stylesheet_directory_uri() . '/assets/js/plugins/slick.min.js',	 array('jquery') , false);
			wp_register_script('app', get_stylesheet_directory_uri() . '/assets/js/app.js',	 array('jquery'), time() , false);
		 	wp_enqueue_script('app');
			wp_enqueue_script('bootstrap');
			wp_enqueue_script('slick');
			
			wp_localize_script(
					'app',
					'admin_url',
					array( 'ajax_url' => admin_url('admin-ajax.php'))
				);
	
	}
	
add_action( 'wp_enqueue_scripts', 'pf_scripts_styles' );


function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


// add_action( 'et_head_meta', 'addStyleNoHome' );
function addStyleNoHome(){
    echo "<link rel='pingback' href=".get_stylesheet_directory()."/>";
}


add_action( 'et_header_top', 'addPerfilTop' );
function addPerfilTop(){

	if(!is_user_logged_in()){
		
		?>
			<div class="header-login-top">
				<a href="#" class="btn btn-primary btn-md ingresar-header btn-primary-gca">Sign In</a>
				<div class="box-login-top">
					<?php
						$host =  $_SERVER['SERVER_NAME'];
						$pageLogin = '203';
						if($host == 'localhost'){
							$pageLogin = '221';
						}
						$args = array(
							'page_id' => $pageLogin
						);
						$query = new WP_Query( $args );
						while($query->have_posts()): $query->the_post();
						
							the_content();
						
						endwhile; wp_reset_postdata();
					?>
				</div>
			</div>
		<?php
		
	}else{
		?>
		<div class="box-login-top user-login-box">
					<?php
						$host =  $_SERVER['SERVER_NAME'];
						$pageLogin = '203';
						if($host == 'localhost'){
							$pageLogin = '221';
						}
						$args = array(
							'page_id' => $pageLogin
						);
						$query = new WP_Query( $args );
						while($query->have_posts()): $query->the_post();
						
							the_content();
						
						endwhile; wp_reset_postdata();
					?>
				</div>
		<?php
	}
	?>
	
	<?php
}


add_action('init', 'initTabdestacados');

function initTabdestacados(){
	if(is_home()){
		?>
			<script>
				document.addEventListener("DOMContentLoaded", function(event) {
					App.tabDestacados();
							
				});
			</script>
		<?php
	}
}


// HOOkS GCA
function slickHundleHook() {
	do_action('slickHundleHook');
}

add_action('slickHundleHook', 'showHideComment');
 
function slickInit() {
	?>
	<script>
				document.addEventListener("DOMContentLoaded", function(event) {
					$('.cont-wrapper-gca').slick({
							dots: false,
							infinite: true,
							speed: 300,
							slidesToShow: 1,
							adaptiveHeight: true
						});
							
				});
	</script>
	<?php
}

// ///////

function commentHook() {
	do_action('commentHook');
}

add_action('commentHook', 'showHideComment');
 
function showHideComment() {
	?>
	<script>
				document.addEventListener("DOMContentLoaded", function(event) {
						App.showHideComment();
				});
	</script>
	<?php
}

// //////

function handleVideoAcademy() {
	do_action('handleVideoAcademy');
}

add_action('handleVideoAcademy', 'initVideoAcademy');
 
function initVideoAcademy() {
	?>
	<script>
				document.addEventListener("DOMContentLoaded", function(event) {
						App.videoResize();
				});
	</script>
	<?php
}

//hook when user registers
// add_action( 'user_register', 'myplugin_registration_save', 10, 1 );

// function myplugin_registration_save( $user_id ) {
//     // insert meta that user not logged in first time
//     update_user_meta($user_id, 'prefix_first_login', '1');
//     wp_redirect( get_site_url().'/mi-cuenta/?after-login=true');
//     exit;
// }

    


function redirect_to_specific_page() {
    if ( is_front_page() && is_user_logged_in() ) {

        ?>
        
            <script>
                // const loadJquery = new Promise(function(resolve, reject) {

                //     let __interval = setInterval(() => {
                        
                //         if(jQuery != undefined){
								// 						clearInterval(__interval);
								// 						resolve(true);
								// 						return;
                //         }
								// 				// ejectLoad();
                        
                        
                //     }, 1000)
                    
                // });
                // loadJquery.then(result => {
								// 		if(result){
								// 			jQuery(function(){
								// 					App.Form.init(false);
								// 			});
								// 		}
                // })
								
                
            </script>
        
        <?php

        // wp_redirect( get_site_url().'/streaming', 301 ); 
        // exit;
       
    }else{
        ?>
        
        <script>
        
						// const loadJquery = new Promise(function(resolve, reject) {

						// let __interval = setInterval(() => {
								
						// 		if(jQuery != undefined){
						// 				clearInterval(__interval);
						// 				resolve(true);
						// 				return;
						// 		}
						// }, 1000)

						// });
						// loadJquery.then(result => {
						// 	if(result){
						// 		jQuery(function(){
						// 				App.Form.init(true);
						// 		});
						// 	}
						// })
        </script>
    
    <?php
    }
}
add_action( 'et_head_meta', 'redirect_to_specific_page' );



function pf_hide_admin_bar(){
	if(is_user_logged_in()){
		$current_user = wp_get_current_user();
		if($current_user->roles[0] == 'subscriber'){
			show_admin_bar(false);
			
		}
	}
}

add_action( 'et_head_meta', 'pf_hide_admin_bar' );

add_action('get_header', 'my_filter_head');

  function my_filter_head() {
    remove_action('wp_head', '_admin_bar_bump_cb');
	}



// function admin_styles() {
//     wp_enqueue_style( 'vegasCSS', get_template_directory_uri() . '/login/css/vegas.min.css', false );
//     wp_enqueue_style( 'loginCSS', get_template_directory_uri() . '/login/css/loginStyles.css', false );
  
//     wp_enqueue_script( 'jquery' );
//     wp_enqueue_script( 'vegasJS', get_template_directory_uri() . '/login/js/vegas.min.js', array('jquery'), '1.0.0', true);
//     wp_enqueue_script( 'loginjs', get_template_directory_uri() . '/login/js/login.js', array('jquery'), '1.0.0', true);
  
  
//     wp_localize_script(
//       'loginjs',
//       'login_imagenes',
//       array(
//         "ruta_plantilla" => get_template_directory_uri()
//       )
//     );
//   }
//   add_action('login_enqueue_scripts', 'admin_styles', 10 );

// Allow subscribers to see Private posts and pages
// $subRole = get_role( 'subscriber' );
// $subRole->add_cap( 'read_private_posts' );
// $subRole->add_cap( 'read_private_pages' );

