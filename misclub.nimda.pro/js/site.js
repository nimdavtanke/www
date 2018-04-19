// JavaScript Document
var upd_photos = new Array;
var photo_array = new Array;
var photo_now = 0;
var total_photos = Array();
var photos = Array();
window.onload = function()
{
		if (upd_photos.length!=0)
			{

				for(i=0;i<upd_photos.length;i++)
					{
						update_photo_blocks(upd_photos[i]);

					}
			}
}

var fly_block ="";
function move_block()
{

f_block = getElementPosition(fly_block);
var move = true;
var need_pos_x = getBodyScrollTop()+ Math.ceil(getClientHeight()/2)-Math.ceil(f_block.height/2);
	if (f_block.top < need_pos_x-5)
		{
			get_id(fly_block).style.top =f_block.top+5 +'px';
		}
	else if (f_block.top > need_pos_x+5)
		{
			get_id(fly_block).style.top =f_block.top-5+'px';
		}
		else
		{
			if(typeof moveTime != 'undefined')
			{
			 clearTimeout(moveTime);
			 move = false;
			}
		}

		get_id(fly_block).style.marginLeft = - parseInt(f_block.width/2) + 'px';


		var wait_img = fly_block + "_wait";
			if (document.getElementById(wait_img))
				{
					f_block = getElementPosition(fly_block);
					w_block = getElementPosition(wait_img);
		get_id(wait_img).style.marginLeft = - parseInt(w_block.width/2) + 'px';
		get_id(wait_img).style.top =  parseInt(f_block.height/2)-parseInt(w_block.height/2)+ 'px';
				}
				if (move)
				{
			  moveTime = setTimeout("move_block()",3);
				}
}

 window.onscroll = function () {




                    }

function fly_block_center(set_fly_block)
{
	fly_block= set_fly_block;
                           move_block();
}

var opa_block = "";
function hide(block)
{
get_id('TB_overlay').style.display='none';
	opa_value =10;
	opa_block = block;
	do_hide();
}

function do_hide()
{
	 opa_value -= 2;
   var testObj = document.getElementById(opa_block);
if ((opa_value/10) >= 0) {
   myTimeout2 = setTimeout("do_hide()", 1);
   testObj.style.opacity = opa_value/10;
   testObj.style.filter = 'alpha(opacity=' + opa_value*10 + ')';
   }
   else
   {
	   testObj.style.display = "none";
      clearTimeout(myTimeout2);
   }
}
var opa_value =0;
function show(block)
{
   get_id('TB_overlay').style.display='';

      get_id(block).style.visibility = "visible";

	opa_block = block;
	opa_value = 0;
	do_show();
}

function do_show()
{
	 if ((opa_value/10) < 1)
	{
	 opa_value += 2;
   var testObj = document.getElementById(opa_block);
   myTimeout2 = setTimeout("do_show()", 100);
   testObj.style.opacity = opa_value/10;
   testObj.style.filter = 'alpha(opacity=' + opa_value*10 + ')';
	}
else
   {
      clearTimeout(myTimeout2);
   }
}


var hT = new Array;
var sT = new Array;
function SmoothShow(objId, x)
{

    var obj = document.getElementById(objId);
   op = (obj.style.opacity)?parseFloat(obj.style.opacity):parseInt(obj.style.filter)/100;
	     obj.style.display='';
   if(op < x)
   {
      clearTimeout(hT[objId]);
      op += 0.2;
      obj.style.opacity = op;
      obj.style.filter='alpha(opacity='+op*100+')';
      sT[objId]=setTimeout('SmoothShow(\''+objId+'\', '+x+')',25);
   }
}

function SmoothHide(objId, x)
{
   var obj = document.getElementById(objId);
   op = (obj.style.opacity)?parseFloat(obj.style.opacity):parseInt(obj.style.filter)/100;

   if(op > x)
   {
     clearTimeout(sT[objId]);
      op -= 0.2;
      obj.style.opacity = op;
      obj.style.filter='alpha(opacity='+op*100+')';
      hT[objId]=setTimeout('SmoothHide(\''+objId+'\', '+x+')',25);
   }

   if (op<=0.05)
   	{
		obj.style.display='none';
	}
}

$('.close_panel').click(function(){
             $(this).parent('.panel').slideUp('fast');
 		$.post('ajax.php','&action=hide_panel',function(data){

 			});
	});

$(document).ready(function(){
$('.close_panel').click(function(){
             $(this).parent('.panel').slideUp('fast');
 		$.post('ajax.php','&action=hide_panel',function(data){

 			});
	});

	$('.panel .btns li').mouseenter(function(){

            $(this).children('.comment').css('width','0px');
            $(this).children('.comment').stop().animate({'width':'229px'},500);
	});

	$('.panel .btns li').mouseleave(function(){

            $(this).children('.comment').animate({'width':'0px'},500);
	});
});