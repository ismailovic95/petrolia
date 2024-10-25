/**====================================================================
 *
 *  Main Script File
 *  V. 1.0.0
 *
 *====================================================================*/
(function($) {
	"use strict";


	$.fn.waterwave = function( options ) {
        // DEFAULT OPTIONS
        var settings = $.extend({
            parent : '',
            color : '#fff',
            direction: 'down',
            background: '',
            speed: 1
        }, options );

        var waterwave = this;

        waterwave.init = function() {
            var TAU = Math.PI * 2.5;
            var density = 1;
            var speed = options.speed;
            var res = 0.005; // percentage of screen per x segment
            var outerScale = 0.05 / density;
            var inc = 0;
            var c = waterwave[0];
            var ctx = c.getContext('2d');
            var grad = ctx.createLinearGradient(0, 0, 0, c.height * 4);
            var height = options.parent.outerHeight();
            var width = options.parent.outerWidth() - 20;

            function onResize() {
                if(options.direction == 'down') {
                    waterwave.attr({
                        width: width + "px"
                    });
                }
                else {
                    waterwave.attr({
                        width: width +  "px",
                        height: height + "px"
                    });
                }
            }

            onResize();
            setTimeout(function() {
                loop();
            }, 500);
            $(window).resize(onResize);

            function loop() {
                inc -= speed;
                drawWave(options.color);
                requestAnimationFrame(loop);
            }


            function drawBG(patternCanvas, w, h) {
                var space = ctx.createPattern(patternCanvas, 'repeat');
                ctx.fillStyle = space;
                ctx.fillRect(0, 0, w, h);
            }

            function drawWave(color) {
                var w = c.offsetWidth;
                var h = c.offsetHeight;
                var cx = w * 0.5;
                var cy = h * 0.5;
                ctx.clearRect(0, 0, w, h);
                var segmentWidth = w * res;
                if(options.background != '') {
                    var image = new Image();
                    image.src = options.background;
                    image.onload = function() {
                        // create an off-screen canvas
                        var patt = document.createElement('canvas');
                        // set the resized width and height
                        patt.width = w;
                        patt.height = h;
                        patt.getContext('2d').drawImage(this, 0, - 1 * (h / 4), patt.width, patt.height);
                        // pass the resized canvas to your createPattern
                        drawBG(patt, w , h);
                    };
                }
                else {
                    ctx.fillStyle = color;
                }
                ctx.beginPath();
                ctx.moveTo(0, cy);
                for (var i = 0, endi = 1 / res; i <= endi; i++) {
                    var _y = cy + Math.sin((i + inc) * TAU * res * density) * cy * Math.sin(i * TAU * res * density * outerScale);
                    var _x = i * segmentWidth;
                    ctx.lineTo(_x, _y);
                }
                if(options.direction == 'down') {
                    ctx.lineTo(w, 0);
                    ctx.lineTo(0, 0);
                }
                else {
                    ctx.lineTo(w, h);
                    ctx.lineTo(0, h);
                }
                ctx.closePath();
                ctx.fill();
            }
        };
        waterwave.init();
        return waterwave;
    };


    /**
     * Website functionalities
     */

	$.qantumthemesMainObj = {
		/**
		 * Global function variables and main objects
		 */
		body: $("body"),
		window: $(window),
		document: $(document),
		htmlAndbody: $('html,body'),
		scrolledTop: 0, // global value of the amount of top scrolling
		oldScroll: 0,
		scroDirect: false,
		clock: false,
		headerbar: $('#evenz-headerbar'),
		stickyheader: $('[data-evenz-stickyheader]'),
		clockTimer: 130,
		clockTimerMobile: 180,

		/**
		 * ======================================================================================================================================== |
		 * 																																			|
		 * 																																			|
		 * START SITE FUNCTIONS 																													|
		 * 																																			|
		 *																																			|
		 * ======================================================================================================================================== |
		 */
		
		fn: {
			isExplorer: function(){
				return /Trident/i.test(navigator.userAgent) ;
			},
			isSafari: function(){
				return navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1;
			},
			isMobile: function(){
				return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || $.qantumthemesMainObj.window.width() < 1170 ;
			},
			isLowPerformance: function(){
				return (  navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1 ) || /Trident/i.test(navigator.userAgent) ;
			},
			areClipPathShapesSupported: function(){
				var base = 'clipPath',
					prefixes = [ 'webkit', 'moz', 'ms', 'o' ],
					properties = [ base ],
					testElement = document.createElement( 'testelement' ),
					attribute = 'polygon(50% 0%, 0% 100%, 100% 100%)';

				// Push the prefixed properties into the array of properties.
				for ( var i = 0, l = prefixes.length; i < l; i++ ) {
					var prefixedProperty = prefixes[i] + base.charAt( 0 ).toUpperCase() + base.slice( 1 ); // remember to capitalize!
					properties.push( prefixedProperty );
				}

				// Interate over the properties and see if they pass two tests.
				for ( var i = 0, l = properties.length; i < l; i++ ) {
					var property = properties[i];

					// First, they need to even support clip-path (IE <= 11 does not)...
					if ( testElement.style[property] === '' ) {

						// Second, we need to see what happens when we try to create a CSS shape...
						testElement.style[property] = attribute;
						if ( testElement.style[property] !== '' ) {
							 $("body").addClass('evenz-clip-enabled');
							 return true;
						}
					}
				}
				$("body").addClass('evenz-clip-disabled');
				return false;
			},

			/** random id when required
			====================================================================*/
			uniqId: function() {
			  return Math.round(new Date().getTime() + (Math.random() * 100));
			},

			/** Check if pics are loaded for given cotnainer
			====================================================================*/
			imagesLoaded: function (container) {
				var f = $.evenzXtendObj.fn;
				var $imgs = $(container).find('img[src!=""]');
				if (!$imgs.length) {return $.Deferred().resolve().promise();}
				var dfds = [];  
				$imgs.each(function(){
					var dfd = $.Deferred();
					dfds.push(dfd);
					var img = new Image();
					img.onload = function(){dfd.resolve();}
					img.onerror = function(){dfd.resolve();}
					img.src = this.src;
				});
				// IE - when all the images are loaded
				return $.when.apply($,dfds);
			},

			// Website tree menu			
			treeMenu: function() {

				// First check native height of grand child items 
				$( ".evenz-menu-tree li li.menu-item-has-children ul" ).each(function(i,c){
					var t = $(c);
					t.attr('data-max', t.outerHeight() );
				});

				$( ".evenz-menu-tree > li.menu-item-has-children ul" ).each(function(i,c){
					var t = $(c);
					t.attr('data-max', t.outerHeight() );
				});

				$( ".evenz-menu-tree li.menu-item-has-children" ).each(function(i,c){
					var t = $(c);
					t.find('> a').after("<a class='evenz-openthis' href='#'><i class='material-icons'>keyboard_arrow_down</i></a>");
					
					var sub = t.children('ul');
					sub.css({'opacity': 0, 'max-height': '0px' });
					
					t.on("click","> .evenz-openthis", function(e){
						e.preventDefault();
						t.toggleClass("evenz-open").promise().done(function(){
							sub = t.children('ul');
							if(t.hasClass('evenz-open')){
								t.closest('li').animate({'padding-bottom': '15px' },200);
								sub.css({ 'max-height': sub.data('max')+'px'  }).delay('400').promise().done(function(){
									sub.css({opacity: 1});
								});
							} else {
								t.closest('li').animate({'padding-bottom': '0px' },200);
								sub.css({opacity: 0}).delay('200').promise().done(function(){
									sub.css({'max-height':'0px'});
								});
							}
						});

						return false;
					});
					return;
				});
				return true;
			},
			
			/* activates
			*  Adds and removes the class "evenz-active" from the target item	
			====================================================================*/
			activates: function(){
				var t, // target
					o = $.qantumthemesMainObj,
					s = false;

				$('[data-evenz-activates]').each(function(i,c){
					var btn = $(c), s;
					btn.off("click");
					btn.on("click", function(e){
						e.preventDefault();
						$(this).toggleClass("evenz-active")
						s = $(this).attr("data-evenz-activates");
						t = $(s);
						if(!s || s === ''){
							t = $(this); }
						if( s == 'parent'){
							t = $(this).parent(); }
						if( s == 'gparent'){
							t = $(this).parent().parent(); }
						t.toggleClass("evenz-active");
						return;
					});
				});
			},

			tabs: function(){
				var t, // target
					o = $.qantumthemesMainObj,
					s = false;

				$('[data-evenz-tabs]').each(function(i,c){
					var btn = $(c).find('.evenz-tabs__menu a'), 
						s,
						tcnt = $(c).find('.evenz-tabs__content');

					tcnt.fadeOut('fast').first().fadeIn('fast');
					$(c).find('.evenz-tabs__menu li:first-child a').addClass('evenz-active');
					btn.off("click");
					btn.on("click", function(e){
						e.preventDefault();
						var t = $(this);
						$(c).find('.evenz-tabs__menu a.evenz-active').removeClass('evenz-active');
						t.addClass("evenz-active");
						s = t.attr("href");
						tcnt.fadeOut('fast').promise().done(function(){
							$(s).fadeIn('fast');
						});
						return;
					});
				});
			},

			/* switchClass
			*  toggles the class defined with "data-evenz-switch" from the target element data-evenz-target
			*  used to change state of other items (search and similar)
			====================================================================*/
			switchClass: function(){
				var t, // target
					c, // class to switch
					o = $.qantumthemesMainObj;
				o.body.off("click", "[data-evenz-switch]");
				o.body.on("click", "[data-evenz-switch]", function(e){
					e.preventDefault();
					t = $($(this).attr("data-evenz-target"));
					c = $(this).attr("data-evenz-switch");
					t.toggleClass(c);
				});
			},

			extractYoutubeId: function(url){
				if(void 0===url)return!1;
				var id=url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
				return null!==id&&id[1];
			},

			/**
			 * Fix video background Page Builder rows su ajax load
			 */
			qtVcVideobg: function(){
				var o = $.qantumthemesMainObj,
					f = o.fn,
					ytu, t, vid;
				if( !f.isMobile() && typeof( insertYoutubeVideoAsBackground ) == 'function' && typeof(vcResizeVideoBackground) == 'function' ){
					jQuery("[data-evenz-video-bg]").each(
						function(){
							t = $(this);
							var videoId = f.extractYoutubeId(t.data("evenz-video-bg"));
							insertYoutubeVideoAsBackground( t, videoId );
							vcResizeVideoBackground(t);
						}
					);
				}
			},

			/* Responsive video resize
			====================================================================*/
			YTreszr: function  (){
				jQuery("iframe").each(function(i,c){ // .youtube-player
					var t = jQuery(this);
					if(t.attr("src")){
						var href = t.attr("src");
						if(href.match("youtube.com") || href.match("vimeo.com") || href.match("vevo.com") ){
							var width = t.parent().width(),
								height = t.height();
							t.css({"width":width});
							t.height(width/16*9);
						}; 
					};
				});
			},

			/* Fix background in safari
			====================================================================*/

			ipadBgFix: function(){
				var o = $.qantumthemesMainObj,
					f = o.fn;
				if(f.isMobile() && f.isSafari()){
					o.body.addClass('evenz-safari-mobile');
				}
			},

			/* Parallax background
			====================================================================*/
			qtParallax: function(){
				if('undefined'  == typeof($.stellar) ){
					return;
				}
				var o = $.qantumthemesMainObj,
					b = o.body;
				if(o.fn.isMobile()){return;}
				b.stellar('destroy');
				$('[data-evenz-parallax]').css({'transform':'translate3d'})
				$('[data-evenz-parallax]').imagesLoaded().then(function(){
					b.stellar({
						hideDistantElements: false,
					});
				});				
			},

			/* scrolledTop: set a global parameter with the amount of top scrolling
			*	Used by themeScroll
			====================================================================*/
			scrolledTop: function(){
				var o = $.qantumthemesMainObj,
					s = window.pageYOffset || document.documentElement.scrollTop,
					d = 0;
				d = o.scrolledTop - s;
				if(d != 0){
					o.scroDirect = d;
				}
				o.scrolledTop = s;
				return s;
			},

			/* Sticky header preparation
			====================================================================*/
			stickyBarLinkPrep: function  (){

				var o 		= $.qantumthemesMainObj,
					ab = $('#wpadminbar'),
					ah = ab.outerHeight(),
					fm = $('#evenz-menu'),
					fh = fm.outerHeight(),
					cando = o.fn.areClipPathShapesSupported();
				if(false === cando)return;
				o.OTS = $("#evenz-sticky"); // Object To Stick (BAR container)
				if(o.OTS.length === 0)return;
				o.OTSc = $('#evenz-stickycon'); // Object To Stick CONTENT (internal menu)
				var OTS 	= o.OTS,
					OTSh 	=	OTS.outerHeight();
				OTS.css({'height': Math.round( OTSh )+'px'});
				OTS.closest('.evenz-vc-row-container').addClass('evenz-stickybar-parent'); // 7 may
				o.StickMeTo = 0;
				o.whenToStick = $('.evenz-stickybar-parent').position().top - OTSh;
				if( o.stickyheader.length > 0 ){
					o.whenToStick -= fh;
					o.StickMeTo += fh;
				}
				if(ab.length >= 1){
					o.whenToStick -= ah;
					o.StickMeTo += ah;
				}
				o.whenToStick = Math.floor(o.whenToStick);
				o.StickMeTo = Math.floor(o.StickMeTo);

			},
			/* Sticky header
			====================================================================*/
			stickyBarLink: function  (st){
				var o = $.qantumthemesMainObj,
					smt = o.StickMeTo,
					wts = o.whenToStick,
					cando = o.fn.areClipPathShapesSupported();
				if(o.OTS.length === 0 || false === cando)return;
				if(st >= wts ){
					o.OTS.addClass("evenz-stickme");
					o.OTSc.addClass('evenz-paper').css({ 'top': smt+'px'} );
				} else {
					o.OTSc.removeClass('evenz-paper');
					o.OTS.removeClass("evenz-stickme");
				}
			},

			/* Sticky menu
			====================================================================*/
			stickyMenu: {
				init: function(){
					$.qantumthemesMainObj.body.addClass('evenz-unscrolled');
				},
				pageScrolled: function (st, direction){

					var o = $.qantumthemesMainObj,
						c = "evenz-headerbar__sticky__s";

					if( direction === 'up'){
						o.headerbar.removeClass(c);
					} else {
						if( st > 100 ){
							o.headerbar.addClass(c);
						}
					}
					if( st > 100 ){
						o.body.removeClass('evenz-unscrolled');
						o.body.addClass('evenz-scrolled');
					} else {
						o.body.addClass('evenz-unscrolled');
						o.body.removeClass('evenz-scrolled');
					}
				}
			},
			
			/* Item menu right align: add class if item is > half
			====================================================================*/
			menuItemAlign: function(){
				var o = $.qantumthemesMainObj,
					b = o.body,
					items = b.find('#evenz-menubar > li.menu-item'),
					hw = b.width() / 2;
				if(items.length == 0){ return; }
				items.each(function(i,c){
					var t = $(c);
					if(t.offset().left > hw){
						t.addClass('evenz-iright');
					}
				});
			},

			

			/* Countdown
			====================================================================*/
			countDown: {
				cd: $(".evenz-countdown"),
				cdf: this,
				pad: function(n,size) {
					return (n < size) ? ("0" + n) : n;
				},
				doClock:function(T, item){
					var cd = item;
					if(!cd.data('evenz-date') || !cd.data('evenz-time')){
						T.remove(cd);
						return;
					}
					var days, hours, min,
						cdf = T.cdf,
						html = '',
						fieldNow = cd.data('evenz-now'),
						nowdate = new Date(fieldNow),
						curDate = new Date(),
						fieldDate = cd.data('evenz-date').split('-'),
						fieldTime = cd.data('evenz-time').split(':'),

						label_days = cd.data('evenz-days'),
						label_hours = cd.data('evenz-hours'),
						label_minutes = cd.data('evenz-minutes'),
						label_seconds = cd.data('evenz-seconds'),
						label_msec = cd.data('evenz-msec'),

						futureDate = new Date(fieldDate[0],fieldDate[1]-1,fieldDate[2], fieldTime[0], fieldTime[1]),
						sec = futureDate.getTime() / 1000 - curDate.getTime() / 1000,
						msec =  futureDate.getTime() -  curDate.getTime();
					
					if(sec<=0 || isNaN(sec)){
						T.remove(cd);
						return cd;
					}

					days = Math.floor(sec/86400);
					sec = sec%86400;
					hours = Math.floor(sec/3600);
					sec = sec%3600;
					min = Math.floor(sec/60);
					sec = Math.floor(sec%60);
					msec = Math.floor(msec%1000);

					cd.find('.d .n').text(T.pad(days,10));
					cd.find('.h .n').text(T.pad(hours,10));
					cd.find('.m .n').text(T.pad(min,10));
					cd.find('.s .n').text(T.pad(sec,10));
					cd.find('.ms .n').text(T.pad(msec,100));
				},
				showclock: function() {
					
					
				},
				remove: function(cd){
					var T = $.qantumthemesMainObj.fn.countDown;
					cd.closest('.evenz-countdown__container').remove();
					if(T.qtClockInterval){
						clearInterval(T.qtClockInterval);
					}
				},
				init: function() {
					var T = $.qantumthemesMainObj.fn.countDown,
						cd = T.cd;
					if(cd.length < 1){
						return;
					}
					cd.each(function(i,c){
						T.doClock( T, $(c) );
					});
					if(T.qtClockInterval){
						clearInterval(T.qtClockInterval);
					}
					T.qtClockInterval = setInterval(function(){
						cd.each(function(i,c){
							T.doClock( T, $(c) );
						});
					},107); // arbitrary delay for refresh to avoid js overload. 
				}
			},


			/* custom waypoints component
			====================================================================*/
			qtWaypoints: {
				items: [],
				isloaded: false,
				reinitialize: function(){
					this.prepare();
				},
				init: function(){
					var f = this;
					$.qantumthemesMainObj.window.on( "load", function(){
						setTimeout(
							function(){
								f.prepare();
							}, 
						200);
					});
				},
				prepare: function(){
					var f = this; 
					f.wh = $(window).height();
					var itemid = 0;
					$('[data-qtwaypoints]').each(function(i,c){
						var item = [];
						item['id'] = itemid;
						item['el'] = $(c);
						item['offset'] = $(c).attr('data-qtwaypoints-offset') || 50; // default 50px offset
						item['addclass'] = $(c).attr('data-qtwaypoints-addclass') || 'evenz-active';
						item['rewind'] = $(c).attr('data-qtwaypoints-rewind') || false;
						item['itemtop'] =  Math.floor( parseInt( $(c).offset().top ) + parseInt( item['offset'] ) );
						if( item['itemtop'] < f.wh ){
							item['el'].addClass( item['addclass'] );
						} 
						f.items.push(item);
						itemid++;
					});
					this.isloaded = true;
					this.update();
				},
				update: function(st){
					if( false === this.isloaded ){
						return;
					}
					var timeout = false;
					var f = this;
					var item;
					var virwportBottom;
					var itemtop;
					var el, offset, addclass, rewind;
					if(timeout){
						clearTimeout(timeout);
					}
					timeout = setTimeout(function(o){
						virwportBottom = st + f.wh;
						$.each( f.items , function(i,c){
							el = c['el'];
							c['animating'] = 1;
							offset = c['offset'];
							rewind = c['rewind'];
							addclass = c['addclass'];
							itemtop = c['itemtop'];
							if( itemtop < virwportBottom ){
								if(!el.hasClass(addclass)){
									el.addClass(addclass);
								}
							} else {
								if(rewind){
									el.removeClass(addclass);
								}
							}
							f.items[i]['animating'] = 1;
						});
					}, 30);
				}
			},

			/* Scrollspy
			====================================================================*/
			qtScrollSpy: {
				init: function(){
					function qtScrollSpyInit(){
						var o = $.qantumthemesMainObj,
							cando = o.fn.areClipPathShapesSupported(),
							b = o.body,
							intmenu = $('#evenz-sticky'),
							offset = 0,
							sh = o.stickyheader,
							adminbar = $("#wpadminbar"),
							sections = [],
							pagemiddle =  Math.floor( $(window).height() / 2 );
						o.scrollspycontainer = b.find("[data-evenz-scrollspy]");
						if(intmenu.length > 0 ){
							offset = offset + 70;
						}
						if(sh.length > 0 ){
							offset = offset + sh.find('#evenz-menu').outerHeight();
						}
						if(adminbar.length > 0 ){
							offset = offset + adminbar.outerHeight();
						}
						pagemiddle = Math.floor( pagemiddle + ( offset / 2) );
						b.attr('data-scrollspy-half',pagemiddle);
						o.scrollspycontainer.find("a[href^='#']").each(function(i,c){
							var link = $(c),
								to,
								hash = link.attr('href'),
								section = $(hash);
							if(section.length > 0){
								var top = Math.floor(section.offset().top),
									bottom = top + Math.floor(section.outerHeight()),
									middle = (top + ((bottom - top) / 2)),
									to = top - offset;
								section.attr('data-scrollspy-mid', middle);
								if(cando){ // No Edge
									link.unbind('click')
									.off('click')
									.on('click', function(e){
										e.preventDefault();
										window.scrollTo({
										  top: to,
										  left: 0,
										  behavior: 'smooth'
										});
										return false;			
									});
								}
							}
						});
					}
					var initScroll = setTimeout( qtScrollSpyInit ,600);
				},
				update: function(st){
					var o = $.qantumthemesMainObj,
						b = o.body,
						hp = Number(b.attr('data-scrollspy-half')),
						s = $('[data-scrollspy-mid]'),
						d, a = [], link,
						timeout = false,
						menu = $("#evenz-stickycon");
					s.each(function(i,c){
						var t = $(c),
						d = Math.abs( ( Number(t.attr('data-scrollspy-mid')) - st) - hp );
						a.push(
							[d,t.attr('id')]
						);
					}); 
					a.sort(function(a,b) {
						return a[0]-b[0]
					});
					if(undefined !== a[0]){
						link = a[0][1];
						if(timeout){
							clearTimeout(timeout);
						}
						timeout = setTimeout(function(o){
							menu.find('.evenz-active').removeClass('evenz-active');
							menu.find('a[href="#'+link+'"]').addClass('evenz-active');
						}, 30);
					}
				}
			},


			/* Owl
			====================================================================*/
			owlCallback: function(event) {
				// Provided by the core
				var element   = event.target;         // DOM element, in this example .owl-carousel
				var name      = event.type;           // Name of the event, in this example dragged
				var namespace = event.namespace;      // Namespace of the event, in this example owl.carousel
				var items     = event.item.count;     // Number of items
				var item      = event.item.index;     // Position of the current item
				// Provided by the navigation plugin
				var pages     = event.page.count;     // Number of pages
				var page      = event.page.index;     // Position of the current page
				var size      = event.page.size;      // Number of items per page
			},
			owlCarousel: function(){
				if(!jQuery.fn.owlCarousel) {return;}

				$('.evenz-owl-carousel').each( function(i,c){
					var T = $(c),
						idc = $(c).attr("id"),
						itemIndex,
						controllerTarget;
					T.imagesLoaded().then(function(){
						T.owlCarousel({
							loop: T.data('loop'),
							margin: T.data('gap'),
							nav: T.data('nav'),
							dots: T.data('dots'),
							navText: ['<i class="evenz-arrow evenz-arrow__l"></i>', '<i class="evenz-arrow evenz-arrow__r"></i>'],
							center: T.data('center'),
							stagePadding: T.data('stage_padding'),
							autoplay:  T.data('autoplay_timeout') > 0,
							autoplayTimeout: T.data('autoplay_timeout'),
							autoplayHoverPause: T.data('pause_on_hover'),
							responsive:{
								0:{
									items: T.data('items_mobile')
								},
								420:{
									items: T.data('items_mobile_hori')
								},
								600:{
									items: T.data('items_tablet')
								},
								1025:{
									items: T.data('items')
								}
							},
							onInitialize: function(){
								T.css({'display':'block', 'opacity':'1'});
							}
						});
					
						if( T.hasClass('evenz-multinav-main')) {
							controllerTarget = T.data('target');
							T.parent().find('.evenz-multinav__controller').find('a:first-child').addClass('current');
							T.on('changed.owl.carousel', function (e) {
								if (e.item) {
									itemIndex = T.find('.active [data-index]').data('index') + 1;
									var index = e.item.index,
										count = e.item.count;
									if (index > count) {
										index -= count;
									}
									if (index <= 0) {
										index += count;
									}
									T.parent().find('.evenz-multinav__controller .current').removeClass('current');
									T.parent().find('.evenz-multinav__controller').find('[data-multinav-controller="'+itemIndex+'"]').addClass('current');
								}
							});
						}
						T.on('click', "[data-multinav-controller]", function(e){
							e.preventDefault();
							var t = $(this),
								i = t.data("multinav-controller"),
								targ = t.data("multinav-target");
							$('#'+targ).trigger('stop.owl.autoplay', i);
							$('#'+targ).trigger('to.owl.carousel', i);
							T.parent().find('.evenz-multinav__controller .owl-item a').removeClass('current');
							t.addClass('current');
						});
					});
				});
			},

			/*Display a single map (requires related js and plugin to work)
			====================================================================*/
			displayMap: function(){
				if( 'object' !== typeof( google )){ return; }
				if( 'object' !== typeof( google.maps )){ return; }
				if( 'function' !== typeof( google.maps.Map )){ return; }
				$('[data-evenz-mapcoord]').each(function(i,c){
					var that = $(c),
						coords = that.attr('data-evenz-mapcoord').split(','),
						mapcontainer = that,
						id = that.attr('id');
					if($.qantumthemesMainObj.fn.isMobile()){
						that.height(400);
					} else {
						that.height(600);
					}
					var myLatlng = new google.maps.LatLng(coords[0], coords[1]);
					var mapOptions = {
					  zoom: 12,
					  center: myLatlng,
					};
					var themap = new google.maps.Map(document.getElementById(id),mapOptions);
					var marker = new google.maps.Marker({position: {lat: parseFloat(coords[0]), lng: parseFloat(coords[1])}, map: themap});
				});
			},

			/* Sticky sidebar
			====================================================================*/
			stickySidebar: function  (){
				if('function' === typeof( $.fn.ttgStickySidebar ) && false === $.qantumthemesMainObj.fn.isMobile()){
					$('.evenz-stickycol').each(function(i,c){
						var that = $(c),
							contSelector = '.evenz-stickycont',
							container = that.closest( contSelector ),
							randid = $.qantumthemesMainObj.fn.uniqId();
						if(!container.attr('id')){
							container.attr('id', randid);
						}
						contSelector = container.attr('id');
						that.ttgStickySidebar({
							containerSelector: contSelector,
							additionalMarginTop: 130,
							additionalMarginBottom: 20,
							updateSidebarHeight: true,
							minWidth: 678
						});
					});
				}
			},

			/**
			 * Water waves effect headers
			 */
			qtWaterwaveInit: function(){
				setTimeout(
					function(){
						$('.evenz-waterwave__canvas').each(function(i,c){
							var t = $(c);
							t.css({bottom: '-100%'});
							var wv = t.waterwave({
								parent: t.parent(),
								speed: t.data('waterwave-speed') || 1,
								color: t.data('waterwave-color') || '#ffffff',
								background:  t.data('waterwave-background') || '' // image
							}).delay(5).promise().done(function(){
								t.animate({bottom:"0%"}, 600);
							});
						});
					},
					100
				);
			},

			/* PERSPECTIVECARDS
			====================================================================*/

			
			qt3dHeader: {
				clock: false, // master clock for 3d
				items: [], // all the 3d items
				mouseX: 0,
				mouseY: 0,
				mouseXold: 0,
				mouseYold: 0,
				interval: 30,

				applyTransformation: function( element, mouseXrel, mouseYrel ){
					var speed,
						mtx,
						matrixFactor,
						distance,
						perspective = 100000;
					if( element['enabled'] ){
						// Background transformation
						if( element['low'] ){
							speed = 4;
							element['bg1'].css({"transform": "translate(" + mouseXrel * speed + "px, " + mouseYrel * speed + "px)"});
							
						} else {
							speed = 4;
							element['bg1'].css({"transform": "translate(" + mouseXrel * speed + "px, " + mouseYrel * speed + "px)"});
							// Content transformation
							speed = -4;
							matrixFactor = 0.000013;
							distance = 1.05;
							mtx = [[1, 0, 0, -mouseXrel * matrixFactor], [0, 1, 0, -mouseYrel * matrixFactor], [0, 0, 1, 1], [0, 0, 0, distance]];
							element['content'].css({"transform": "perspective("+perspective+"px) matrix3d(" + mtx.toString() + ") translate(" + mouseXrel * speed + "px, " + mouseYrel * speed + "px)"});
						}
					}
				},

				animateItems: function( mouseX, mouseY ){
					var qt3dHeader = this,
						items = qt3dHeader.items,
						element,
						ex,
						ey,
						mouseXrel,
						mouseYrel;

					$.each( qt3dHeader.items , function(i,element){
						ex = mouseX - element['w2']; // absolute post of mouse from the center of the item
						ey = mouseY - element['h2'];
						mouseXrel = (ex - element['ox']  / 2) * - 1 / 100;
						mouseYrel = (ey - element['oy']  / 2) * - 1 / 100;
						qt3dHeader.applyTransformation( element, mouseXrel, mouseYrel );
					});
				},

				setStartingPoint: function(){

					if($('.evenz-3dheader').length == 0){
						return;
					}

					
					var o = $.qantumthemesMainObj,
						f = o.fn,
						low = f.isLowPerformance(),
						qt3dHeader = this,
						ex, ey, mtx;



					qt3dHeader.items = []; // reset the array

					// ------------------------------------
					// CREATE ARRAY OF ITEMS
					// ------------------------------------
					var itemid = 0;
					
					$('.evenz-3dheader').each(function(i,c){
						var item = [], 
							el = $(c);
						item['el'] = el;
						item['content'] = el.find('.evenz-3dheader__contents');
						item['bg1'] = el.find('.evenz-3dheader__bg--1');
						item['bg2'] = el.find('.evenz-3dheader__bg--2');
						item['ox'] = el.offset().left;
						item['oy'] = el.offset().top;
						item['w2'] = el.width() / 2;
						item['h2'] = el.height() / 2;
						item['enabled'] = false;
						item['low'] = low;
						if( true === low ){
							el.animate({'opacity':1}, 1600).delay(1100).promise().done(function(){
								item['content'].animate({'opacity':1}, 800 ).delay(1700).promise().done(function(){
									item['enabled'] = true;
								});
							});
						} else {
							el.animate({'opacity':1}, 300).delay(50).promise().done(function(){
								item['content'].animate({'opacity':1}, 300 ).promise().done(function(){
									item['enabled'] = true;
								});
							});
						}
						qt3dHeader.items.push(item);
						itemid++;
					});
				},
				init: function(){
					if($('.evenz-3dheader').length == 0){
						return;
					}
					var o = $.qantumthemesMainObj,
						f = o.fn,
						qt3dHeader = this,
						ex, ey, mtx;

					
					
					// ------------------------------------
					// CREATE ARRAY OF ITEMS
					// ------------------------------------
					qt3dHeader.setStartingPoint();


					

					// ------------------------------------
					// JUST STOP IF THERE ARE NO 3D COVERS
					// ------------------------------------
					if( qt3dHeader.items.length == 0 ){
						return;
					}

					$(window).on('mousemove', function(e){
						qt3dHeader.mouseX = e.pageX;
						qt3dHeader.mouseY = e.pageY;
					});

					// ------------------------------------
					// UNIQUE MASTER CLOCK
					// ------------------------------------
					qt3dHeader.animateItems( 0, 0);

					// ------------------------------------
					// STOP HERE FOR MOBILE
					// ------------------------------------
					if(f.isMobile()){
						return;
					}
					
					if( false === qt3dHeader.clock && false === f.isLowPerformance() ){
						// delay start
						setTimeout(function(){
							qt3dHeader.clock = setInterval(
								function(){
									// animate only if there is a change in mouse position
									if( qt3dHeader.mouseXold !== qt3dHeader.mouseX || qt3dHeader.mouseXold !== qt3dHeader.mouseX ){
										qt3dHeader.animateItems( qt3dHeader.mouseX, qt3dHeader.mouseY );
										qt3dHeader.mouseXold = qt3dHeader.mouseX;
										qt3dHeader.mouseYold = qt3dHeader.mouseY;
									}
								},
								qt3dHeader.interval // time
							);
						}, 3400);
					}
				},
			},



			/**
			 * Custom styles from shortcodes
			 */
			customStylesHead: function(){
				var styles = '';
				$('[data-evenz-customstyles]').each(function(i,c){
					styles = styles + $(c).data('evenz-customstyles');
				});
				$('head').append('<style>'+styles+'<style>');
				// Also, fix viewport as if scalable will break performance and 3d
				$('[name="viewport"]').attr('content', 'width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0');
			},

			/**
			 * Close the off canvas menu
			 */
			resetOverlay: function(){
				$('.evenz-overlayopen').removeClass('evenz-overlayopen');
			},

			/**
			 * Close off canvas menu if clicking an internal link
			 */
			internalLinkClose : function(){
				$('#evenz-overlay .evenz-menu-tree a').on('click',function(e){
					var href = $(this).attr('href');
					console.log( href );
					// Since 2019 04 18 + support internal links
					var pageURL = $(location).attr("href"),
						pageURL_array = pageURL.split('#'),
						pageURL_naked = pageURL_array[0],
						href_array = href.split('#'),
						href_naked = href_array[0];

					if(href_naked === pageURL_naked) {
						$.qantumthemesMainObj.fn.resetOverlay();
						return e;
					}
				})
				
			},


			/* Theme clock: perform some actions at some interval
			====================================================================*/
			themeScroll: function(){
				var o = $.qantumthemesMainObj,
					f = o.fn,
					st, 
					os,
					timer = o.clockTimer; 
				
				if( f.isMobile() ){
					timer = o.clockTimerMobile; 
				}

				if(o.clock !== false){
					clearInterval( o.clock );
				}
				o.body.attr('data-evenz-scrolled', 0);
				o.clock = setInterval(
					function(){
						f.scrolledTop(); 
						st = o.scrolledTop;
						os = o.oldScroll;
						if( os !== st  ){
							o.oldScroll = st;
							f.stickyBarLink(st);
							o.body.attr('data-evenz-scrolled', st);
							f.qtScrollSpy.update(st);
							f.qtWaypoints.update(st);
							if(st > (os + 50) ) {
								f.stickyMenu.pageScrolled(st, 'down');
							}
							if(st < (os - 50) && st < 400 ){
								f.stickyMenu.pageScrolled(st, 'up');
							}
						}
					},timer
				);
			},



			/**====================================================================
			 *
			 *	After ajax page initialization
			 * 	Used by QT Ajax Pageloader. 
			 * 	MUST RETURN TRUE IF ALL OK.
			 * 
			 ====================================================================*/
			initializeAfterAjax: function(){
				var o = $.qantumthemesMainObj,
					f = o.fn;
				f.customStylesHead();
				f.resetOverlay();
				f.qtWaterwaveInit();
				f.countDown.init();
				f.YTreszr();
				f.switchClass();
				f.activates();
				f.ipadBgFix();
				f.qtParallax();
				f.qtVcVideobg();
				f.qtScrollSpy.init();
				f.owlCarousel();
				f.tabs();
				f.stickySidebar();
				f.displayMap();
				f.qt3dHeader.init();
				f.qtWaypoints.init();


				return true;
			},


			/* Trigger custom functions on window resize, with a delay for performance enhacement
			====================================================================*/
			windoeResized: function(){
				var rst,
					o = $.qantumthemesMainObj,
					f = o.fn,
					w = o.window,
					ww = w.width(),
					wh = w.height();
				
				$(window).on('resize', function(e) {
					clearTimeout(rst);

					rst = setTimeout(function() {
						f.owlCarousel();
						f.qtScrollSpy.init();
						f.qtWaypoints.reinitialize();
						f.menuItemAlign();
						f.qt3dHeader.setStartingPoint();
						f.qtWaterwaveInit();
						if (w.height() != wh) {
							f.stickyBarLinkPrep();
							f.themeScroll();
						}
						if (w.width() != ww){
							f.stickyBarLinkPrep();
							f.YTreszr();
						}
					}, 500);
				});
			},

			/**====================================================================
			 *
			 * 
			 *  Functions to run once on first page load
			 *  
			 *
			 ====================================================================*/
			init: function() {
				var f = $.qantumthemesMainObj.fn;
				$('html').removeClass('no-js');
				f.treeMenu();
				f.stickyBarLinkPrep();
				f.stickyMenu.init();
				f.themeScroll();
				f.initializeAfterAjax();
				f.areClipPathShapesSupported();
				f.menuItemAlign();
				f.internalLinkClose();
				f.windoeResized();// Always last
				f.qtWaypoints.reinitialize(); 
				if( f.isSafari() ){
					$('body').addClass('isSafari');
				}


			},
		}
		/**
		 * ======================================================================================================================================== |
		 * 																																			|
		 * 																																			|
		 * END SITE FUNCTIONS 																														|
		 * 																																			|
		 *																																			|
		 * ======================================================================================================================================== |
		 */
	};
	/**====================================================================
	 *
	 *	Page Ready Trigger
	 * 
	 ====================================================================*/
	jQuery(document).ready(function() {
		$.qantumthemesMainObj.fn.init();	
	});






})(jQuery);


