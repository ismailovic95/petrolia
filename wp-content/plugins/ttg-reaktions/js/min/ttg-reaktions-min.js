!function($){"use strict";$.qtWebsiteObj={},$.qtWebsiteObj.body=$("body"),$.fn.ttgReaktionsLoveitAjax=function(){var t,a;$.qtWebsiteObj.body.on("click","a.ttg_reaktions-link",function(n){return n.preventDefault(),a=$(this),t=a.data("post_id"),$.ajax({type:"post",url:ajax_var.url,data:"action=post-like&nonce="+ajax_var.nonce+"&post_like=&post_id="+t,success:function(t){"already"!=t&&(a.addClass("ttg-reaktions-btn-disabled"),a.find(".count").text(t))}}),!1})},$.fn.ttgRatingCounterAjax=function(){var t,a,n,e,o,i;$.qtWebsiteObj.viewCounterAjax=$(".ttg-reactions-viewconuterajax"),0!=$.qtWebsiteObj.viewCounterAjax&&$.qtWebsiteObj.body.on("change","input[name='ttg-reaktions-star']",function(t){t.preventDefault();var a=$(this),n=a.closest("form"),e=n.attr("data-postid"),r=a.attr("value"),s="action=ttg_rating_submit&nonce="+ajax_var.nonce+"&ttg_rating_submit="+r+"&post_id="+e,u=ajax_var.url,d,c,g,j,f,p,v,l;$.ajax({type:"post",url:u,data:s,success:function(t){return o=$(".ttg-Ratings-Amount"),f=$(".ttg-Ratings-Avg"),v=$(".ttg-Ratings-Feedback"),j=o.attr("data-novote"),d=t.split("|avg="),i=o.attr("data-single"),p=o.attr("data-before"),l=v.attr("data-thanks"),"novote"===t?void v.html(j):(g=d[0],c=d[1],g>1&&(i=o.attr("data-multi")),f.html(parseFloat(c).toFixed(2)),v.html(l),void o.html(p+" "+g+" "+i))},error:function(t){}})})},$.fn.ttgViewCounterAjax=function(){$.qtWebsiteObj.viewCounterAjax=$(".ttg-reactions-viewconuterajax");var t,a,n,e;if(0!=$.qtWebsiteObj.viewCounterAjax.length){var o=$.qtWebsiteObj.viewCounterAjax.attr("data-id"),i="action=ttg_post_views&nonce="+ajax_var.nonce+"&ttg_post_views=&post_id="+o,r=ajax_var.url;$.ajax({type:"post",url:r,data:i,success:function(t){n=$(".ttg-Reaktions-Views-Amount"),e=n.attr("data-single"),t>1&&(e=n.attr("data-multi")),n.html(t+" "+e)},error:function(t){}})}},$.fn.ttgReaktionPopupwindow=function(){"undefined"!=typeof $.fn.popupwindow&&$.fn.popupwindow()},$(document).ready(function(){$.fn.ttgReaktionPopupwindow(),$.fn.ttgReaktionsLoveitAjax(),$.fn.ttgViewCounterAjax(),$.fn.ttgRatingCounterAjax()})}(jQuery);