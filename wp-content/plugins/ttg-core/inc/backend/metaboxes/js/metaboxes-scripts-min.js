jQuery(function(d){function _(e){e.click(function(){var e,t;if(void 0===e){e=wp.media.frames.file_frame=wp.media({frame:"post",state:"insert",multiple:!1});var a=d(this).attr("rel");formfield=d(this).siblings(".meta_box_upload_image"),preview=d(this).siblings(".meta_box_preview_image"),e.on("insert",function(){json=e.state().get("selection").first().toJSON(),imgurl=json.url,id=json.id,preview.attr("src",imgurl),formfield.val(id)}),e.open()}else e.open()})}function m(e){e.click(function(){var e=d(this).parent().siblings(".meta_box_default_image").text();return d(this).parent().siblings(".meta_box_upload_image").val(""),d(this).parent().siblings(".meta_box_preview_image").attr("src",e),!1})}function l(e,t){if(e)return new RegExp("("+t.join("|").replace(/\./g,"\\.")+")$").test(e)}function u(e){e.click(function(){var a,e;if(void 0===a){a=wp.media.frames.file_frame=wp.media({frame:"post",state:"insert",multiple:!1});var t=d(this).attr("rel"),o=d(this).siblings(".meta_box_upload_file_new"),i=d(this).closest(".qw_repeatable_row").find("[id$=_track_title]"),n=d(this).closest(".qw_repeatable_row").find("[id$=_artist_name]");a.on("insert",function(){if(rawdata=a.state().get("selection"),json=a.state().get("selection").first().toJSON(),fileurl=json.url,id=json.id,o.val(fileurl),l(fileurl,[".mp3"])){var e=json.title,t=json.meta.artist;e&&i&&i.val(e),t&&n&&n.val(t)}}),a.open()}else a.open()})}function f(e){e.click(function(){return d(this).parent().siblings(".meta_box_upload_file_new").val(""),!1})}function e(){d(".qw-conditional-fields").each(function(){var e="";d(this).find("option:selected").each(function(){d(this).attr("data-tohide")&&(d.toHideArray=d(this).attr("data-tohide").split("[+]"),0<d.toHideArray.length&&d.each(d.toHideArray,function(e,t){d(t).closest(".metabox-controlfield").not("qw-hidden")&&d(t).closest(".metabox-controlfield").addClass("qw-hidden")})),d(this).attr("data-toreveal")&&(d.toRevealArray=d(this).attr("data-toreveal").split("[+]"),0<d.toRevealArray.length&&d.each(d.toRevealArray,function(e,t){d(t).closest(".metabox-controlfield").removeClass("qw-hidden")}))})})}function t(){function e(e){for(var t=[],a=0;a<e.length;a++)t.push(e[a].val)}_(d(".meta_box_upload_image_button")),u(d(".meta_box_upload_file_new_button")),m(d(".meta_box_clear_image_button")),f(d(".meta_box_clear_file_button")),d(".meta_box_clear_file_button").click(function(){return d(this).parent().siblings(".meta_box_upload_file").val(""),d(this).parent().siblings(".meta_box_filename").text(""),d(this).parent().siblings(".meta_box_file").removeClass("checked"),!1}),d(".meta_box_repeatable_remove").live("click",function(){return d(this).closest("tr").remove(),!1}),d(".meta_box_repeatable tbody").sortable({opacity:.6,revert:!0,cursor:"move",handle:".hndle"}),d(".sort_list").sortable({connectWith:".sort_list",opacity:.6,revert:!0,cursor:"move",cancel:".post_drop_sort_area_name",items:"li:not(.post_drop_sort_area_name)",update:function(e,t){var a=d(this).sortable("toArray"),o=d(this).attr("id");d(".store-"+o).val(a)}}),d(".sort_list").disableSelection(),d.prototype.chosen&&d(".chosen").chosen({allow_single_deselect:!0})}d(document).ready(function(){d("form").attr("novalidate","novalidate")}),jQuery(document).ready(function(e){e(".meta_box_color").wpColorPicker()}),e(),d(".qw-conditional-fields").change(function(){e()}),t(),d(".meta_box_repeatable_add").live("click",function(e){e.preventDefault();var t=d(this).closest(".meta_box_repeatable").find("tbody tr:last-child"),a=t.clone();a.find("select.chosen").removeAttr("style","").removeAttr("id","").removeClass("chzn-done").data("chosen",null).next().remove(),a.find("input.regular-text, textarea, select, .meta_box_upload_file ").val(""),a.find("input[type=checkbox], input[type=radio]").attr("checked",!1),a.find("span.meta_box_filename").html("");var o=a.find(".meta_box_upload_file_button"),i=a.find(".meta_box_upload_image_button"),n=a.find(".meta_box_clear_image_button");a.find("img.meta_box_preview_image").attr("src","");var l=a.find(".meta_box_upload_file_new_button"),r=a.find(".meta_box_upload_file_new_button"),s=a.find(".meta_box_clear_file_button");_(i),u(r),m(n),f(n),t.after(a),a.find("input, textarea, select").attr("name",function(e,t){if(void 0!==t)return t.replace(/(\d+)/,function(e,t){return Number(t)+1})});var c=[];return d("input.repeatable_id:text").each(function(){c.push(d(this).val())}),a.find("input.repeatable_id").val(Number(Math.max.apply(Math,c))+1),d.prototype.chosen&&a.find("select.chosen").chosen({allow_single_deselect:!0}),!1}),d("a.qw-iconreference-open").click(function(e){e.preventDefault(),d("body").addClass("qwModalFormOpen"),d("#qwModalForm").height(d(window).height()),d.iconTarget=d(this).attr("data-target"),d("#adminmenuwrap").css({"z-index":"10"})}),d("#qw-closemodal").on("click",function(e){d("body").removeClass("qwModalFormOpen"),d("#adminmenuwrap").css({"z-index":"1000"})}),d("#qwiconsMarket").on("click",".btn",function(e){e.preventDefault();var t=d(this).attr("data-icon"),a;null!=d.iconTarget&&("tinymce"!==d.iconTarget?(d("#"+d.iconTarget).val(t),d("#theIcon"+d.iconTarget).removeClass().addClass(t+" bigicon")):tinymce.activeEditor.execCommand("mceInsertContent",!1,'[qticon class="'+t+'" size="s|m|l|xl|xxl"]'),d("body").removeClass("qwModalFormOpen"),d("#adminmenuwrap").css({"z-index":"1000"}))}),d(".qw_hider").click(function(e,t){var a=d(this);d(".qw_hiddenable").addClass("qw-hide").promise().done(function(){d(".qw_hiddenable .qw_hider").addClass("dashicons-hidden").removeClass("dashicons-visibility"),a.closest(".qw_hiddenable").removeClass("qw-hide"),a.removeClass("dashicons-hidden").addClass("dashicons-visibility")})}),d(".geocodefunction").click(function(e,t){var a,i=d(this).attr("data-target"),o=d("#address-"+i).attr("value"),n=d("#results-"+i),l=new google.maps.Geocoder,r=d("#map-"+i);l.geocode({address:o},function(e,t){if(t===google.maps.GeocoderStatus.OK){r.height("180px");var a=new google.maps.Map(document.getElementById("map-"+i),{zoom:10,center:{lat:e[0].geometry.location.lat(),lng:e[0].geometry.location.lng()}});a.setCenter(e[0].geometry.location);var o=new google.maps.Marker({map:a,position:e[0].geometry.location}),e=e[0].geometry.location.lat()+","+e[0].geometry.location.lng();n.html(""),d("#"+i).attr("value",e)}else n.html("Geocode was not successful for the following reason: "+t)})}),d(".qt-tabs .qt-tabnav a").click(function(e){e.preventDefault();var t=d(this),a=t.attr("href");t.closest(".qt-tabs").find(".qt-tab.active").removeClass("active"),d(a).addClass("active")})});