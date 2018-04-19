jQuery.jQueryRandom = 0;
jQuery.extend(jQuery.expr[":"],
{
random: function(a, i, m, r) {
if (i == 0) {
jQuery.jQueryRandom = Math.floor(Math.random() * r.length);
};
return i == jQuery.jQueryRandom;
}
});
$(function() {
$('#slideshow img').not(':random').hide();
setInterval(function(){
$('#slideshow img:visible').fadeOut('slow')
.siblings('img:random').fadeIn('slow')
.end().appendTo('#slideshow');},
5000);
});
