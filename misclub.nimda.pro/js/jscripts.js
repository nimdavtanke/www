// JavaScript Document
function get_id(id)
{

	return document.getElementById(id);


}

function get_val(id)
{
return get_id(id).value;
}

function get_sel(id)
{
	return get_id(id).options[get_id(id).selectedIndex].value;
}
function change_focus(id)
{
	document.getElementById(id).focus();
}
function getClientHeight()
{
  return document.compatMode=='CSS1Compat' && !window.opera?document.documentElement.clientHeight:window.innerHeight;

}
function getClientWidth()
{
  return document.compatMode=='CSS1Compat' && !window.opera?document.documentElement.clientWidth:window.innerWidth;

}
function getBodyScrollTop()
{
return self.pageYOffset || (document.documentElement && document.documentElement.scrollTop) || (document.body && document.body.scrollTop);
}
function getBodyScrollLeft()
{
return self.pageXOffset || (document.documentElement && document.documentElement.scrollLeft) || (document.body && document.body.scrollLeft);
}

function getElementPosition(elemId)
{
    var elem = document.getElementById(elemId);
	
    var w = elem.offsetWidth;
    var h = elem.offsetHeight;
	
    var l = 0;
    var t = 0;
	
    while (elem)
    {
        l += elem.offsetLeft;
        t += elem.offsetTop;
        elem = elem.offsetParent;
    }

    return {"left":l, "top":t, "width": w, "height":h};
}

function update_photo_blocks(photos_block)
{
	photos_block = document.getElementById(photos_block);
	var divs = photos_block.childNodes;
	var max_height=0;
	var max_width=0;
	for(var i=0; i<divs.length; i++)
{
 if (divs[i].id!="") 
 {
	
	 var p_block = getElementPosition(divs[i].id);
//	 alert('высота: ' +p_block.height + ' '+divs[i].id);
	 	if (max_height<p_block.height)
			{
				max_height=p_block.height;
			}
				if (max_width<p_block.width)
			{
				max_width=p_block.width;
		}
 }
 //alert(max_width +' ' + max_height);
}

for(var i=0; i<divs.length; i++)
{
 if (divs[i].id!="") 
 {
	 divs[i].style.height=max_height-10 +'px';
	 divs[i].style.width=max_width-10 +'px';
 }
}

}
