jQuery.fn.FlyCenter = function () {
    this.css("position","absolute");

    this.animate({
        top: (($(window).height() - this.outerHeight()) / 2) + $(window).scrollTop() + "px",
        left:(($(window).width() - this.outerWidth()) / 2) + $(window).scrollLeft() + "px"

      }, 500 );
   return this;
}

function show_photo(block_id, photo)
{



											 get_id('full_img').style.visibility = 'hidden';
											get_id('fly_block_wait').style.visibility = 'visible';
											get_id('fly_block').style.display='';
											get_id('fly_block').style.opacity = 1;
											  get_id('fly_block').style.filter = 'alpha(opacity=100)';
											get_id('full_img').src=photos[block_id][photo];

                                                          var need_center = true;
                                                          $('#full_img').unbind('load');
											$('#full_img').bind('load',function() {

												   $('#fly_block').FlyCenter();
												get_id('fly_block_wait').style.visibility = 'hidden';
											 		show('full_img');
											 		need_center = false;
												});

		get_id('fly_block_text').innerHTML = '<div align="center">Фотография ' + photo + '/' + total_photos[block_id] +'</div>';
			if (photo!=1)
			{
				 get_id('fly_block_text').innerHTML = get_id('fly_block_text').innerHTML +"<div style='float:left;'><a href='#' onclick='show_photo("+block_id+", "+(photo*1-1)+"); return false;'>&laquo; Предыдущая</a></div>";
			}
		if (photo!=total_photos[block_id])
			{
				 get_id('fly_block_text').innerHTML = get_id('fly_block_text').innerHTML +"<div style='float:right;'><a href='#' onclick='show_photo("+block_id+", "+(photo*1+1)+"); return false;'>Следующая &raquo;</a></div>";
			}

}