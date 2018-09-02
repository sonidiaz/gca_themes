$ = jQuery.noConflict();
$w = $(window);


const App = {
	videoResize: function(){
		var ratio = 640/360,
		global_height = 0;

		var rize__ = function(){
		window.onresize = function () {
				//t && clearTimeout(t);
				var $video_loop = $('.cont-full-video');
				width = window.innerWidth;
				height = window.innerHeight;
				
				if ($('.player')) {
						//t = setTimeout(function(){
						var w = width,
							h = height,
							rw,
							rh;

						if (w/ratio < h) {
							rw = Math.ceil(h*ratio);
							rh = h;
						} else {
							rh = Math.ceil(w/ratio);
							rw = w;
						}

						$video_loop[0].style.width = rw+'px';
						$video_loop[0].style.height = rh+'px';

						$video_loop.css({marginTop: (-rh/2)+'px', marginLeft: (-rw/2)+'px'});
						//}, 200);
					}
			};
			document.getElementsByClassName('cont-video-player')[0].classList.add('show');

			window.onresize(); 
		}
		rize__();
	},
	tabDestacados: function(){
		var $gcaTabdestacados = document.getElementById('gca-tab-destacados');
		var $mainNav = $gcaTabdestacados.querySelectorAll('.et_pb_row');
		var $navDestacados = document.getElementById('gca-nav-destacados');
		var $itemNavDestacados = $navDestacados.querySelectorAll('.et_pb_column');
		var contMainTemp = [];
		var contMain = [];
		
		$mainNav.forEach(function(e){
				contMainTemp.push(e)
				contMain = contMainTemp.slice(1);
				
		});
		var getShowItem = function(id){
			$gcaTabdestacados.children[1].classList.remove('active')
			$gcaTabdestacados.children[2].classList.remove('active')
			$gcaTabdestacados.children[3].classList.remove('active')
			$gcaTabdestacados.children[4].classList.remove('active')
			
		
			$gcaTabdestacados.children[id].classList.add('active');
		}


		$itemNavDestacados.forEach(function(itemNav,i){
			var navButton = itemNav.children[0].children[0];
			var setdataButon = navButton.setAttribute('data-id', i+1);
			var getdataButon = navButton.getAttribute('data-id');

			navButton.setAttribute('href','javascript:void(0);');
			
			itemNav.addEventListener('click', function(e){
				var _id = e.target.getAttribute('data-id');
				getShowItem(_id)
			})
			
		});
		$gcaTabdestacados.children[1].classList.add('active');
		
	},
	filter: function(){
		const $jsBotonFilter = document.querySelectorAll('.js-filter-boton');
		const $btnFilerSwitch = document.querySelectorAll('.btn-filter-academy');
		const getDataFilter = function(data){
			const $itemPostGca = document.querySelectorAll('.item-post-gca');
			const $activePost = document.querySelectorAll('.'+data);
			
			if(data == 'all'){
				$('.item-post-gca').fadeIn();
				return;
			}
			const transitionAnimate = new Promise(function(resolve, reject) {
				let endAnimate = false;
				
				$itemPostGca.forEach(function(itemPost, i){
					$('.item-post-gca').fadeOut();
						if((i + 1) == $itemPostGca.length){
							endAnimate = true;
						}
					});
					if(endAnimate) {
						resolve(true);
					} else {
						reject(false);
					}
				});
			transitionAnimate.then(function(resultado) {
				if(resultado){
					setTimeout(function(){
						$activePost.forEach(function(d,index){
							$('.item-post-gca.' + data).fadeIn();
						});
					}, 500);
				}
				});

		}
		$jsBotonFilter.forEach(function(link, i){
			link.addEventListener('click', function(e){
				let data = e.target.getAttribute('href');
				data = data.split('#')[1]
				getDataFilter(data);
			});
		});

		const SwitchDataItem = function(data){
			const $listItem = document.querySelector('.list-item');
			if(data == 'grid'){
				$listItem.classList.add('list-in-grid');
			}else{
				$listItem.classList.remove('list-in-grid');
			}
		}

		$btnFilerSwitch.forEach(function(el){
			console.log(el)
			el.addEventListener('click', function(e){
				let $this = this,
					$data = $this.getAttribute('data-filter');
					SwitchDataItem($data);
			});
		})
	},
	showHideComment: function(){
		const $jsShowHideComment = document.getElementsByClassName('js-showHideComment');
		const $commentWwrap = document.getElementById('comment-wrap');
		$jsShowHideComment[0].addEventListener('click', (e) => {
			hundletoggleComment(e.target);
		})
		hundletoggleComment = (e) =>{
			$commentWwrap.classList.toggle('comment-active');
		}
	},
	events:function(){
		
	},
	init: function(){

		}
}




document.addEventListener("DOMContentLoaded", function(event) {
		if(window.location.pathname == "/GCA-academy/" || window.location.pathname == "/gcaacademy/"){
			App.tabDestacados();
		}
		App.filter();
  });

// const App2 = {
//     events(){
//         if($w.innerWidth() > 768){
//                 window.addEventListener('scroll', this.handleScroll);
//             }else{
//                 window.removeEventListener('scroll', this.handleScroll);
           
//             }
//     },
//     handleScroll() {

//         const scrolled = window.scrollY;
//         const viewportHeight = window.innerHeight;
// 				const fullHeight = document.body.clientHeight;
				
// 				const headerHeight = $('#main-header').innerHeight();
// 				const titulosLocationHeight = $('#titulos-location').innerHeight();
// 				const heroLocationHeight = $('#hero-location').innerHeight();

// 				const contentHeight = $('.trs-container').innerHeight();
// 				const WrapperContainer = document.getElementById('nav-treatments-in-hotels');
// 				const navTreatmentsHeight = $('#nav-treatments-in-hotels').innerHeight();
// 				const separatorforSticky = document.getElementsByClassName('separador-for-stiky');
        
// 				const heightItem = App2.setHeightItem();
				 

//         if(scrolled > ( (contentHeight-heightItem) + 580 ) ){
						
// 						WrapperContainer.classList.add('sticky');
// 						separatorforSticky[0].classList.add('active');
// 					}else if(scrolled < (contentHeight+heightItem)){
						
// 						WrapperContainer.classList.remove('sticky');
// 						separatorforSticky[0].classList.remove('active');
// 				}
// 				if(scrolled > (fullHeight - contentHeight) + viewportHeight){
// 					WrapperContainer.classList.remove('sticky');
// 					separatorforSticky[0].classList.remove('active');
					
// 				}
				
// 				if(scrolled > (titulosLocationHeight + headerHeight +  heroLocationHeight)){
// 						App2.stickySidebarsLocation(true)
// 					}else if(scrolled < (contentHeight+heightItem)){
						
// 						App2.stickySidebarsLocation(false)
// 				}
				

//       },
//     setHeightItem(){ 
// 				var __total = 0;
// 				const itemsTreatments = document.querySelectorAll('.body-msg-panel');
// 				const _heightItem = 57;
// 				const countItem = itemsTreatments.length;

// 				itemsTreatments.forEach(function(el){
// 					var __data = el.clientHeight;
// 					__total = __total + __data;
// 				});
				
// 				return __total;
// 		},
// 		stickySidebarsLocation:function(fixed){
				
// 				const sidebars = document.querySelectorAll('.wrapper-main-location .et_pb_column');
// 				const sidebarLeft = sidebars[0];
// 				const mainContent = sidebars[1];
// 				const sidebarRight = sidebars[2];

// 				if(fixed){
// 					sidebarLeft.classList.add('sticky');
// 					sidebarRight.style.display = 'none';
// 					mainContent.style.marginLeft = '349px';
// 				}else{
// 					sidebarLeft.classList.remove('sticky');
// 					sidebarRight.style.display = 'block';
// 					mainContent.style.marginLeft = '0';
// 				}


// 				console.log(mainContent.style);
// 		},

//     init() {
//         App2.events();
//         App2.handleScroll()
        
//     }
// }
// const App = (function(){
    
//     const init = () => {
//         console.log('init')
//     }
//     return init;
    

// });

