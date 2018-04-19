// JavaScript Document
page_block = "";
////////////////////////////////////// ÈÇÌÅÍÅÍÈÅ ÐÀÇÌÅÐÎÂ
var itemRes_resizeBlock = "";
function start_resize_block(itemToResize,e){
itemRes_resizeBlock = itemToResize;
page_block = getElementPosition('page_block');
if(!e) e = window.event;
resize_block_flag=true;
shift_x = e.clientX-parseInt(itemToResize.style.left);

if(e.stopPropagation) e.stopPropagation();
else e.cancelBubble = true;
if(e.preventDefault) e.preventDefault();
else e.returnValue = false;
}

function end_resize_block(){ resize_block_flag=false; }

function resizeBlock(itemToResize,e){

if(!resize_block_flag) return;
if(!e) e = window.event;
var block_s = getElementPosition(itemToResize.id);
var left_scroll = getBodyScrollLeft();

if (Math.round((e.clientX-block_s.left+left_scroll+9)*100/page_block.width)>0 && Math.round((e.clientX-block_s.left+left_scroll+9)*100/page_block.width)<=100)
{
itemToResize.style.width = Math.round((e.clientX-block_s.left+left_scroll+9)*100/page_block.width) + "%";
get_id(itemToResize.id +'_w').value=Math.round((e.clientX-block_s.left+left_scroll+9)*100/page_block.width);

block_s = getElementPosition(itemToResize.id);
	if (Math.round(e.clientX-block_s.left+left_scroll+9)<block_s.width)
		{
			get_id(itemToResize.id +'_w').value=Math.round((block_s.width*100)/page_block.width);
		}
get_id(itemToResize.id +'_w').click();
}

/*
if (parseInt(e.clientX-block_s.left+left_scroll+2)>0 && parseInt(e.clientX-block_s.left+left_scroll+2)<=page_block.width)
{
itemToResize.style.width = parseInt(e.clientX-block_s.left+left_scroll+2) + "px";

block_s = getElementPosition(itemToResize.id);

get_id(itemToResize.id +'_w').value=parseInt(block_s.width);
get_id(itemToResize.id +'_w').click();
}*/

if(e.stopPropagation) e.stopPropagation();
else e.cancelBubble = true;
if(e.preventDefault) e.preventDefault();
else e.returnValue = false;
}