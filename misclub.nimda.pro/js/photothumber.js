// JavaScript Document
// ïåðåòàñêèâàíèå
var flag=false;
var shift_x;
var shift_y;

var div_img = "";
var div_cutter = "";
var mouse_move_action ="";
function cut_frame_ini()
{
div_img = getElementPosition("photo_div");
get_id('cut_div').style.left = div_img.left + "px";
get_id('cut_div').style.top = div_img.top + "px";
	get_id('img_obj_cutter').style.marginTop=0 + "px";
		get_id('img_obj_cutter').style.marginLeft=0 + "px";
get_id('img_obj').style.opacity = 0.5;
  get_id('img_obj').style.filter = 'alpha(opacity=' + 50 + ')';
}

function start_drag(itemToMove,e){
mouse_move_action = "drag";
div_cutter = getElementPosition("cut_div");
div_img = getElementPosition("photo_div");
if(!e) e = window.event;
flag=true;
shift_x = e.clientX-parseInt(itemToMove.style.left);
shift_y = e.clientY-parseInt(itemToMove.style.top);

if(e.stopPropagation) e.stopPropagation();
else e.cancelBubble = true;
if(e.preventDefault) e.preventDefault();
else e.returnValue = false;
}

function end_drag(){ flag=false; }

function dragIt(itemToMove,e){
if(!flag) return;
if(!e) e = window.event;

if (((e.clientX-shift_x)>=div_img.left) && (e.clientX-shift_x-10)<=(div_img.left+div_img.width-div_cutter.width))
{
itemToMove.style.left = (e.clientX-shift_x) + "px";
get_id('img_obj_cutter').style.marginLeft=-(e.clientX-shift_x)+div_img.left-1 + "px";
}
else
{
	if ((e.clientX-shift_x)<div_img.left)
		{
		itemToMove.style.left = div_img.left + "px";
get_id('img_obj_cutter').style.marginLeft=-1 + "px";
		}
		if ((e.clientX-shift_x-10)>(div_img.left+div_img.width-div_cutter.width))
		{
		itemToMove.style.left = div_img.left+div_img.width-div_cutter.width+10 + "px";
get_id('img_obj_cutter').style.marginLeft=-(div_img.left+div_img.width-div_cutter.width+10)-1 + "px";
		}
}

if (((e.clientY-shift_y)>=div_img.top) && (e.clientY-shift_y-10)<=(div_img.top+div_img.height-div_cutter.height))
{
itemToMove.style.top = (e.clientY-shift_y) + "px";
get_id('img_obj_cutter').style.marginTop=-(e.clientY-shift_y)+div_img.top-1 + "px";
}
else
{
	if ((e.clientY-shift_y)<div_img.top)
		{
		itemToMove.style.top = div_img.top + "px";
		get_id('img_obj_cutter').style.marginTop=-1 + "px";
		}
	if ((e.clientY-shift_y-10)>(div_img.top+div_img.height-div_cutter.height))
		{
		itemToMove.style.top = div_img.top+div_img.height-div_cutter.height+10 + "px";
		get_id('img_obj_cutter').style.marginTop=-(div_img.height-div_cutter.height)-11 + "px";
		}
}
var pos = getElementPosition("cut_div");
var pos_img = getElementPosition("img_obj");
get_id('pos_x').value=parseInt(pos.left-pos_img.left);
get_id('pos_y').value=parseInt(pos.top-pos_img.top);
				
if(e.stopPropagation) e.stopPropagation();
else e.cancelBubble = true;
if(e.preventDefault) e.preventDefault();
else e.returnValue = false;
}

////////////////////////////////////// ÈÇÌÅÍÅÍÈÅ ÐÀÇÌÅÐÎÂ
var itemRes = "";
function start_resize(itemToResize,e){
itemRes = itemToResize;
if (itemToResize.id=="img_obj")
{
cut_frame_ini();
}
div_cutter = getElementPosition("cut_div");
div_img = getElementPosition("img_obj");
mouse_move_action = "resize";
if(!e) e = window.event;
flag=true;
shift_x = e.clientX-parseInt(itemToResize.style.left);
shift_y = e.clientY-parseInt(itemToResize.style.top);

if(e.stopPropagation) e.stopPropagation();
else e.cancelBubble = true;
if(e.preventDefault) e.preventDefault();
else e.returnValue = false;
}

function end_resize(){ flag=false; }

function resizeIt(itemToResize,e){

if(!flag) return;
if(!e) e = window.event;
if (itemToResize.id=="img_obj")
{
	div_img = getElementPosition("img_obj");
	var img_ratio = div_img.width/div_img.height;
if ((e.clientX-10>= parseInt(div_cutter.width)+3) && ((e.clientX)/img_ratio> parseInt(div_cutter.height)+3))
{
itemToResize.style.width = (e.clientX-5) + "px";
get_id('img_obj_cutter').style.width = (e.clientX-5) + "px";
var full_img = getElementPosition("img_obj");
if (document.getElementById('full_w'))
			{
				get_id('full_w').value=parseInt(itemToResize.style.width);
				get_id('full_h').value=parseInt(full_img.height);
			}
}

}
else
{
div_img = getElementPosition("img_obj");
div_cutter = getElementPosition("cut_div");

var top_scroll = getBodyScrollTop();
var left_scroll = getBodyScrollLeft();
		if ((((e.clientX+left_scroll)-6)<= div_img.width-3) &&((e.clientX-parseInt(get_id('cut_div').style.left)+left_scroll)-6)>0)
		{
		itemToResize.style.width = (e.clientX-parseInt(get_id('cut_div').style.left))-6+left_scroll + "px";
		}
		
		if ((e.clientY-6-div_img.top+top_scroll<= div_img.height-3) && ((e.clientY-div_cutter.top)+top_scroll-6)>0)
		{
		itemToResize.style.height = e.clientY-div_cutter.top+top_scroll-6 + "px";
		}
		if (document.getElementById('thumb_w'))
			{
				get_id('thumb_w').value=parseInt(itemToResize.style.width);
				get_id('thumb_h').value=parseInt(itemToResize.style.height);
			}
}

if(e.stopPropagation) e.stopPropagation();
else e.cancelBubble = true;
if(e.preventDefault) e.preventDefault();
else e.returnValue = false;
}
document.onmousemove = function ()
{
	if (mouse_move_action=="resize")
		{
		resizeIt(itemRes,event);
		}
		if (mouse_move_action=="drag")
		{
		dragIt(document.getElementById('cut_div'),event);
		}
}