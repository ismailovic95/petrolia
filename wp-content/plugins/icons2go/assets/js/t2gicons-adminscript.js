// Admin Scripts for QantumThemes Functions
// Framework import
// @codekit-prepend "../framework-materialize/js/initial.js";
// @codekit-prepend "../framework-materialize/js/global.js";
// @codekit-prepend "../framework-materialize/js/velocity.min.js";
// @codekit-prepend "../framework-materialize/js/jquery.easing.1.3.js";
// @codekit-prepend "../framework-materialize/js/waves.js";

// @codekit-prepend "../framework-materialize/js/forms.js";

// @codekit-prepend "../framework-materialize/js/dropdown.js";
// @codekit-prepend "../framework-materialize/js/transitions.js";
// @codekit-prepend "../framework-materialize/js/pushpin.js";
// @codekit-prepend "../framework-materialize/js/scrollspy.js";

(function($) {
	"use strict";

	$.t2giconsObj = {};
	$.t2giconsObj.body = $("body");
	$.t2giconsObj.htmlAndbody = $('html,body');
	
	var theclass,thetype,  totalClasses = '', 
		classPrefix = "t2gicon-",
		classNameContainer = $("#t2gicons_classname"),
		previewContainer = $("#t2gicons_preview_icon"),
		shortcodeContent = $("#t2gicons_shortcodecontent"),
		previewIcon = $("#t2gicons_preview_icon i"),
		baseclasses = previewContainer.attr("data-t2gicons-baseclasses");

	$.t2giconsObj.body.on("click", "#t2gicons-closemodal", function(e){
		e.preventDefault();
		$("#t2gicons-modalform").toggleClass("open");
		if($("#t2gicons-modalform").hasClass("open")){
			$.fn.t2gIconsPushpin();
			jQuery(".t2gicons-tab:first-of-type a.t2gicons-iconselector:first-of-type").click();
		}
	});

	$.t2giconsObj.body.on("click", "#t2gicons-openmodal", function(e){
		e.preventDefault();
		$.t2giconsObj.htmlAndbody.animate({scrollTop:0}, 800).promise().done(function(){
			$("#t2gicons-modalform").toggleClass("open");
			if($("#t2gicons-modalform").hasClass("open")){
				$.fn.t2gIconsPushpin();
				jQuery(".t2gicons-tab:first-of-type a.t2gicons-iconselector:first-of-type").click();
			}
		});
	});

	$.t2giconsObj.body.on("click","#t2gicons-iconsmarket a.btn",function(e){
		e.preventDefault();
		var that = $(this);
		theclass = that.attr("data-icontype");
		thetype = that.attr("data-type");
		$("#t2gicons-iconsmarket a.btn.selected").removeClass("selected");
		that.addClass("selected");
		previewContainer.attr("data-icontype",theclass);
		previewContainer.attr("data-type",thetype);
		classNameContainer.text(theclass);
		$.fn.t2gIconsUpdatePreview();
	});

	/**
	 * Switch tabs
	 */
	$.t2giconsObj.body.on( "change", "#t2gicons_switch_set" , function(i,c){
		var tab = $("#t2gicons_switch_set").val();
		$(".t2gicons-tab.active").removeClass("active");
		$(tab).addClass("active");
	});

	/**
	 * Attributes switches
	 */
	var IconAttributes =["icontype", "size", "fontsize", "bgcolor", "color", "shape", "align", "link", "target", "icontype"];
	$.each(IconAttributes, function(i,v){
		$.t2giconsObj.body.on( "change", "#t2gicons_input_"+v , function(i,c){
			previewContainer.attr("data-"+v, $("#t2gicons_input_"+v).val());
			$.fn.t2gIconsUpdatePreview();
		});
	});

	/**
	 * Update icon attributes
	 * ========================================================================================
	 */
	var shortcodeString, icontype;
	$.fn.t2gIconsUpdatePreview = function(){
		previewIcon.removeAttr("class");
		totalClasses = '';
		$.each(IconAttributes, function(i,v){
			if(v !== "link" && v !== "target" && v !== "icontype"){
				totalClasses +=  classPrefix + v + '-' + previewContainer.attr( "data-" + v ) + ' ';
			}
		});
		icontype = previewContainer.attr( "data-icontype" );
		totalClasses +=  previewContainer.attr( "data-icontype" ) + ' ';
		previewIcon.addClass("t2gicons-icon " + totalClasses);
		// Update the shortcode
		shortcodeString = '';
		$.each(IconAttributes, function(i,v){
			shortcodeString +=  v + '=' + '"' +  previewContainer.attr( "data-" + v ) + '" ';
		});
		// for visual composer
		shortcodeString += ' ' +   previewContainer.attr( "data-type" ) + '="'+previewContainer.attr( "data-icontype" )  + '" ';
		shortcodeContent.text("[t2gicons "+shortcodeString + "]");
	}

	/**
	 * Link
	 * ========================================================================================
	 */
	var url_validate = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
	$.t2giconsObj.body.on( "keyup", "#t2gicons_input_link" , function(){
		var link =  $("#t2gicons_input_link").val();
		$("#t2gicons_preview_icon_link_text").text( link );
		$("#t2gicons_preview_icon_link").attr( "href", link );
		if(!url_validate.test(link)){
			$("#t2gicons_preview_icon_link_text").removeClass("t2gicons-valid");
			$("#t2gicons_preview_icon_link_text").addClass("t2gicons-invalid");
		} else {
			$("#t2gicons_preview_icon_link_text").removeClass("t2gicons-invalid");
			$("#t2gicons_preview_icon_link_text").addClass("t2gicons-valid");
		}
		previewContainer.attr("data-link", link);
	});

	/**
	 * Target
	 * ========================================================================================
	 */
	$.t2giconsObj.body.on( "change", "#t2gicons_input_target_blank, #t2gicons_input_target_top" , function(i,c){
		var target = $(this).val();
		$("#t2gicons_preview_icon_link").attr( "target", target );
		previewContainer.attr("data-target", target);
		$.fn.t2gIconsUpdatePreview();
	});

	/**
	 * Deactivation btn show
	 * ========================================================================================
	 */
	$.t2giconsObj.body.on( "change", ".t2gicons-confirmdeactivate" , function(i,c){
		var that = $(this),
			target = that.attr("data-target"),
			checked =  this.checked;
		if(checked) {
			$("#"+target).removeClass("t2gicons-hidden");
		} else {
			$("#"+target).addClass("t2gicons-hidden");
		}
	});

	/**
	 * Search
	 * ========================================================================================
	 */
	$.t2giconsObj.body.on( "keyup", "#t2gicons_search" , function(){
		var aim =  $("#t2gicons_search").val();
		if(aim !== ''){
			$(".t2gicons-iconset").find("a").not("[data-classtag*='"+aim+"']").hide();
		} else {
			$(".t2gicons-iconset a").show();
		}
		
	});

	/**
	 * Add shortcode
	 * ========================================================================================
	 */
	$.t2giconsObj.body.on( "click", "#t2gicons_addicons" , function(e){
		e.preventDefault();
		if("undefined" === typeof(tinymce)){
			alert("Insert function is only for backedn editor or frontend Visual Composer");
			return;
		}
		tinymce.activeEditor.execCommand('mceInsertContent', false, shortcodeContent.text() );
		$("#t2gicons-modalform").removeClass("open");
	});

	/**====================================================================
	 *
	 * 
	 *  Pushpin (uses materializecss library) 
	 *  
	 * 
	 ====================================================================*/
	$.fn.t2gIconsPushpin = function() {
		if(typeof($.fn.pushpin) !== "undefined"){
			if ($(window).width() > 1280 && $('.t2gicons-pushpin').length > 0) {
				$('.t2gicons-pushpin').css({
					"width": $('.t2gicons-pushpin').width()
				});					
				$('.t2gicons-pushpin').pushpin({
					top: $('.t2gicons-pushpin-container').offset().top,
				});
			}
		}
	};

	/**====================================================================
	 *
	 * 
	 *  Pushpin (uses materializecss library) 
	 *  
	 * 
	 ====================================================================*/
	$.fn.t2gIconsPushpinAdmin = function() {
		if(typeof($.fn.pushpin) !== "undefined"){

			
			if ($(window).width() > 1280 && $('.t2gicons-pushpin-container-admin').length > 0) {
				var topStop = $('#t2gicons-pushpin-admin-bottom').offset().top - $('.t2gicons-pushpin-admin').outerHeight();
				$('.t2gicons-pushpin-admin').css({
					"width": $('.t2gicons-pushpin-admin').width()
				});
				$('.t2gicons-pushpin-admin').pushpin({
					top: $('.t2gicons-pushpin-container-admin').offset().top,
					offset: 30,
					bottom:  topStop,
				});
			}
		}
	};
	$.fn.t2gIconsPushpinAdmin();



	/**====================================================================
	 *
	 * 
	 *  Icons bookmarking 
	 *  
	 * 
	 ====================================================================*/
	var t2gIconsSetArray = [];
	$.t2giconsObj.body.on("click","a.qt-bookmarkicon", function(e){
		e.preventDefault();
		var that = $(this),
			set = that.attr("data-set"),
			setname = that.attr("data-setname");
		if(that.attr("data-active") !== "1"){
			var setarray = new Array();
			setarray[set] = setname;
			t2gIconsSetArray.push( setarray );
			that.attr("data-active", "1").addClass("active selected");

			$("#t2gicons-link-"+set+" .bookmarked").removeClass("t2gicons-hidden");
		} else {
			var index = t2gIconsSetArray.indexOf(set);
			if (index > -1) {
			    t2gIconsSetArray.splice(index, 1);
			}
			that.attr("data-active", "0").removeClass("active selected");
			if(that.parent().find("a.active").length === 0){
				$("#t2gicons-link-"+set+" .bookmarked").addClass("t2gicons-hidden");
			}
		}
		$.fn.t2gIconsUpdateArrayset(t2gIconsSetArray);
	});

	/**====================================================================
	 *
	 * 
	 *	15. Smooth scrolling
	 *	
	 * 
	 ====================================================================*/
	$.fn.qtSmoothScroll = function(){
		var topscroll;
		$.t2giconsObj.body.off("click",'a.t2gicons-smoothscroll');
		$.t2giconsObj.body.on("click",'a.t2gicons-smoothscroll', function(e){     
			e.preventDefault();
			topscroll = $(this.hash).offset().top - 250;
			$.t2giconsObj.htmlAndbody.animate({scrollTop:topscroll}, 800);
		});
	}
	$.fn.qtSmoothScroll();


	/**
	 * Hide/show unactive sets
	 */
	$.t2giconsObj.body.on("click", "[data-t2gicons-displaytarget]", function(e){
		e.preventDefault();
		var that =$(this),
			target = that.attr("data-t2gicons-displaytarget");
		$("#"+target).toggleClass("t2gicons-hidden");
	})

	$.fn.t2gIconsUpdateArrayset = function(arraySet) {
		/* Functions to come */
		return true;
	}


	$('.scrollspy').scrollSpy();

	/**
	 * Form select
	 * ========================================================================================
	 */
	$('.t2gicons-selectfield').material_select();

})(jQuery);