var upd_photos = new Array;
var moved_block = "";
var move_to = "";
var move_to_last = "";
var move_photo_to="";
var bgcolor = "";
var do_move_ph = false;
var resize_block_flag=false;
var edit_block_id=0;
function startMoveBlock(block, parent_block_id)
{
     edit_block_id = parent_block_id;
	document.onselectstart = returnfalse;
document.ondragstart = returnfalse;
	if (moved_block=="")
{
moved_block = block;
bgcolor = get_id(moved_block).style.backgroundColor;
get_id(moved_block).style.backgroundColor='#cbffd4';
move_to = "";
if (do_move_ph)
{
	get_id(moved_block).parentNode.style.cursor="move";
}
else
{
	get_id(moved_block).parentNode.style.cursor="move";
}

//get_id(moved_block).parentNode.style.border = '1px solid #ff0000';
}
else
{
	//get_id(moved_block).parentNode.style.border = '0px solid #000000';
	get_id(moved_block).parentNode.style.cursor="";
get_id(moved_block).style.backgroundColor=bgcolor;
moved_block = "";
move_to = "";
move_photo_to = "";
}
}


function stopMoveBlock()
{

//alert(moved_block + ' '+block + ' '+move_to)
	if (moved_block!="" && move_to!=moved_block)
{

get_id(moved_block).style.backgroundColor=bgcolor;
moved_block = "";
move_to = "";
move_photo_to = "";
do_move_ph = false;
}

}
function returnfalse() {
return false;
}

window.document.onmouseup= function ()
{
		resize_block_flag = false;
if (moved_block!="")
{
startMoveBlock(moved_block);
}
do_move_ph = false;
}

window.document.onscroll = function()
{
if (getBodyScrollTop()==0)
{
get_id('quick_panel').style.position='relative';	}
	else
	{	get_id('quick_panel').style.position='fixed';
	}
}
window.document.onmousemove= function ()
{

	if (move_to==moved_block)
		{
			move_to_last = "";
		}
		if (do_move_ph && move_photo_to!="" && move_photo_to!=moved_block)
			{
				move_to = move_photo_to;
			}

		if (move_to!="" && moved_block!="" && move_to!=move_to_last && move_to!=moved_block)
		{
		//alert(move_to + " " + moved_block);
		move_to_last = move_to;
		//switch_save_btn();

				document.onselectstart = returnfalse;
		document.ondragstart = returnfalse;
	//	alert(move_to + ' ' + moved_block);

		//document.getElementById(move_to).parentNode.insertAfter("Првиет!");
		//	document.getElementById(move_to).parentNode.insertBefore(get_id(move_block), document.getElementById(move_to).parentNode.nextSibling);
                                var move_to_parent = document.getElementById(moved_block).parentNode;
                        var clone_node =   document.getElementById(move_to).cloneNode(true);

		document.getElementById(move_to).parentNode.replaceChild(document.getElementById(moved_block),document.getElementById(move_to));
		move_to_parent.appendChild(clone_node);

		var change_pos = get_id('pos_' +move_to).value;
		 get_id('pos_' +move_to).value = get_id('pos_' +moved_block).value;
		 get_id('pos_' +moved_block).value = change_pos;
		 	// Включаем кнопки
		 	if (do_move_ph)
		 	{
		 	get_id('save_block_btn_top_' + edit_block_id).style.display='';
    		get_id('save_block_btn_bottom_' + edit_block_id).style.display='';
			}
			else
			{
			get_id('save_all_top').style.display='';
       	   get_id('save_all_bottom').style.display='';				}
		}

}

function save_block_positions(url)
{
var inputs=document.getElementsByTagName("input");
   var params = "";
for (i=0;  i<inputs.length; i++) {
			if (inputs[i].name.search('block_pos') != -1)
			{
		params = params+"&" + inputs[i].name + "=" + inputs[i].value;			}
	}
	document.location.href=url + "?quick_edit=save_block_pos" + params;	}
