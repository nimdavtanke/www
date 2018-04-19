// JavaScript Document

var upd_photos = new Array;
var move_block = "";
var move_to = "";
var move_to_last = "";
var move_photo_to="";
var bgcolor = "";
var do_move_ph = false;
var resize_block_flag=false;


window.onload = function()
{
	if (document.getElementById('img_show_hide_frame'))
	{
	if(top.document.getElementById('fset').cols=='0,*'){get_id('img_show_hide_frame').src='../images/webcms/show_panel.gif';} else {get_id('img_show_hide_frame').src='../images/webcms/hide_panel.gif';}
	}
	get_id('admin_content').style.display='inline';
	get_id('div_wait').style.display='none';
		if (upd_photos.length!=0)
			{

				for(i=0;i<upd_photos.length;i++)
					{
						update_photo_blocks(upd_photos[i]);

					}
			}
}

function admin_unload()
{
get_id('admin_content').style.display='none';
	get_id('div_wait').style.display='';
}

function startMoveBlock(block)
{
	document.onselectstart = returnfalse;
document.ondragstart = returnfalse;
	if (move_block=="")
{
move_block = block;
bgcolor = get_id(move_block).style.backgroundColor;
get_id(move_block).style.backgroundColor='#cbffd4';
move_to = "";
if (do_move_ph)
{
	get_id(move_block).parentNode.style.cursor="move";
}
else
{
	get_id(move_block).parentNode.style.cursor="move";
}

//get_id(move_block).parentNode.style.border = '1px solid #ff0000';
}
else
{
	//get_id(move_block).parentNode.style.border = '0px solid #000000';
	get_id(move_block).parentNode.style.cursor="";
get_id(move_block).style.backgroundColor=bgcolor;
move_block = "";
move_to = "";
move_photo_to = "";
}
}


function stopMoveBlock()
{

//alert(move_block + ' '+block + ' '+move_to)
	if (move_block!="" && move_to!=move_block)
{

get_id(move_block).style.backgroundColor=bgcolor;
move_block = "";
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
if (move_block!="")
{
startMoveBlock(move_block);
}
do_move_ph = false;
}


window.document.onmousemove= function ()
{
	if (resize_block_flag)
		{
			resizeBlock(itemRes_resizeBlock,event);
		}
	if (move_to==move_block)
		{
			move_to_last = "";
		}
		if (do_move_ph && move_photo_to!="" && move_photo_to!=move_block)
			{
				move_to = move_photo_to;
			}
if (move_to!="" && move_block!="" && move_to!=move_to_last && move_to!=move_block && get_id(move_to).parentNode==get_id(move_block).parentNode)
{
move_to_last = move_to;
switch_save_btn();
		document.onselectstart = returnfalse;
document.ondragstart = returnfalse;
var divs =  get_id(move_block).parentNode.childNodes;

var  mb_pos =0;
var  mto_pos =0;
for(var i=0; i<divs.length; i++)
{
 if (divs[i].id==move_block)
 {
 mb_pos = i;
 }
 if (divs[i].id==move_to)
 {
 mto_pos = i;
 }
 if (mb_pos!=0 && mto_pos!=0)
 {
 break;
	}
}

if (mto_pos>mb_pos)
{
document.getElementById(move_to).parentNode.insertBefore(get_id(move_block), document.getElementById(move_to).nextSibling);
//move_to = get_id(move_block).id;
}
else
{
document.getElementById(move_to).parentNode.insertBefore(get_id(move_block), document.getElementById(move_to));
//move_to = get_id(move_block).id;
}
move_to = "";
//// Меняем порядок!
var p =1;
for(var i=0; i<divs.length; i++)
{

if (divs[i].id && divs[i].id!='last_block' && divs[i].id!='')
{
var pos = 'pos_'+ divs[i].id;
	if (get_id(pos))
		{
			get_id(pos).value=p;
			if (document.getElementById('save_block_btn'))
				{
		get_id('save_block_btn').style.display='';
				}
			p=p+1;
		}
}
}
}

}


function get_enter(ev, menu)
{
	if(ev.keyCode==13)
		{
		get_id('input_name_'+menu).style.display='none'; get_id('link_name_'+menu).style.display='inline'; get_id('link_name_'+menu).innerHTML =get_id('input_name_'+menu).value;
		}
		return false;
}

function switch_save_btn()
{
		//Включаем кнопку сохранения
	if (document.getElementById('save_btn_off'))
		{
			get_id('save_btn_off').id='save_btn';
			get_id('save_btn').src='../images/webcms/ico_save.gif';
			get_id('save_btn').style.cursor='pointer';
		}
		switch_cancel_btn();
	//
}
function switch_cancel_btn()
{
		//Включаем кнопку сохранения
	if (document.getElementById('cancel_btn_off'))
		{
			get_id('cancel_btn_off').id='cancel_btn';
			get_id('cancel_btn').src='../images/webcms/ico_cancel.gif';
			get_id('cancel_btn').style.cursor='pointer';
		}
	//
}

// Выбор раздела, в который надо перенести
function show_move_to()
{
switch_cancel_btn();
	var inputs = document.menu_form.getElementsByTagName("img");
				 for (var i = 0; i < inputs.length; i++)
	 						  {
								  var id = inputs[i].id.split("_");
								  if (id[0]=="moveto")
								  	{
										inputs[i].style.display='';
									}
							  }
	/// Скрываем выбранные разделы
		 inputs = document.menu_form.getElementsByTagName("input");
				 for (var i = 0; i < inputs.length; i++)
	 						  {
								  if (inputs[i].type=="checkbox" && inputs[i].checked)
								  	{
										  var id = inputs[i].id.split("_");
										  get_id('menu_item_'+id[2]).style.display='none';
									}
							  }
}

function switch_mass_btn()
{
	//вЫключаем кнопки массового редактирования
										if (document.getElementById('move_btn'))
											{
												get_id('move_btn').id='move_btn_off';
												get_id('move_btn_off').src='../images/webcms/ico_move_off.gif';
												get_id('move_btn_off').style.cursor='';
											}
											if (document.getElementById('del_btn'))
											{
												get_id('del_btn').id='del_btn_off';
												get_id('del_btn_off').src='../images/webcms/ico_del_off.gif';
												get_id('del_btn_off').style.cursor='';
											}
	//Проверяем есть ли отмеченные пункты
					var inputs = document.menu_form.getElementsByTagName("input");
				 for (var i = 0; i < inputs.length; i++)
	 						  {
								  if (inputs[i].type=="checkbox" && inputs[i].checked)
								  	{
										//Включаем кнопки массового редактирования
										if (document.getElementById('move_btn_off'))
											{
												get_id('move_btn_off').id='move_btn';
												get_id('move_btn').src='../images/webcms/ico_move.gif';
												get_id('move_btn').style.cursor='pointer';
											}
										if (document.getElementById('del_btn_off'))
											{
												get_id('del_btn_off').id='del_btn';
												get_id('del_btn').src='../images/webcms/ico_del.gif';
												get_id('del_btn').style.cursor='pointer';
											}
											break
									}
							  }


	//
}


function check(menu,cat)
{

	// Изменяем выделенный чекбокс
if (get_id('menu_chbox_'+menu).checked)
{
get_id('menu_chbox_'+menu).checked = false;
get_id('img_chbox_'+menu).src='../images/webcms/unchecked.gif';
get_id('img_chbox_'+menu).title='Выделить';
//ucheck_parent(cat);
var parent = document.getElementById('menu_item_'+menu).parentNode.id;
while (parent!='')
{
	//Снимаем выделение с Родителей!
	var parent= parent.split("_");
	get_id('menu_chbox_'+parent[1]).checked = false;
get_id('img_chbox_'+parent[1]).src='../images/webcms/unchecked.gif';
get_id('img_chbox_'+parent[1]).title='Выделить';
parent = document.getElementById('menu_item_'+parent[1]).parentNode.id;

}

}
else
{
	get_id('menu_chbox_'+menu).checked = true;
	get_id('img_chbox_'+menu).src='../images/webcms/checked.gif';
	get_id('img_chbox_'+menu).title='Снять выделение';
}
	var subs = "sub_"+menu;
		if (document.getElementById(subs))
			{
				var inputs = document.getElementById(subs).getElementsByTagName("input");
				 for (var i = 0; i < inputs.length; i++)
	 						  {
								  if (inputs[i].type=="checkbox")
								  	{
										inputs[i].checked= get_id('menu_chbox_'+menu).checked;
										var sub_menu = inputs[i].id.split('_');
											if (get_id('menu_chbox_'+menu).checked)
													{
													get_id('img_chbox_'+sub_menu[2]).src='../images/webcms/checked.gif';
													get_id('img_chbox_'+sub_menu[2]).title='Снять выделение';
													}
													else
													{
														get_id('img_chbox_'+sub_menu[2]).src='../images/webcms/unchecked.gif';
														get_id('img_chbox_'+sub_menu[2]).title='Снять выделение';
													}
									}
							  }
			}
				switch_mass_btn();
}

/// выделение раздела
var selected_cat = "";
var selected_cat_bg = "";
var selected_menu = "";
var selected_menu_bg = "";
function select_cat(cat_id,menu)
{
	if (cat_id!="0")
		{

				if (parent.site_structure.selected_cat!="" && parent.site_structure.document.getElementById('menu_item_'+parent.site_structure.selected_cat))
					{
						parent.site_structure.document.getElementById('menu_item_'+parent.site_structure.selected_cat).style.backgroundColor=parent.site_structure.selected_cat_bg;

					}

					if (parent.site_structure.selected_menu!="" && parent.site_structure.document.getElementById('cat_menu_item_'+parent.site_structure.selected_menu))
					{

					parent.site_structure.document.getElementById('cat_menu_item_'+parent.site_structure.selected_menu).style.backgroundColor=parent.site_structure.selected_menu_bg;
					parent.site_structure.selected_menu = "";
					parent.site_structure.selected_menu_bg = "";
					}
					parent.site_structure.selected_cat = menu;
					if (parent.site_structure.document.getElementById('menu_item_'+parent.site_structure.selected_cat))
					{
					parent.site_structure.selected_cat_bg = parent.site_structure.document.getElementById('menu_item_'+parent.site_structure.selected_cat).style.backgroundColor;
					parent.site_structure.document.getElementById('menu_item_'+parent.site_structure.selected_cat).style.backgroundColor='#e1ffe6';
					}

		}
		else
		{

			if (selected_menu!="" && parent.site_structure.document.getElementById('cat_menu_item_'+selected_menu))
					{

						parent.site_structure.document.getElementById('cat_menu_item_'+selected_menu).style.backgroundColor=selected_menu_bg;

					}
						if (selected_cat!="" && parent.site_structure.document.getElementById('menu_item_'+selected_cat))
					{
					parent.site_structure.document.getElementById('menu_item_'+selected_cat).style.backgroundColor=selected_cat_bg;
					selected_cat = "";
					selected_cat_bg = "";
					}

					selected_menu = menu;
							if (parent.site_structure.document.getElementById('cat_menu_item_'+selected_menu))
					{
					selected_menu_bg = parent.site_structure.document.getElementById('cat_menu_item_'+selected_menu).style.backgroundColor;
					parent.site_structure.document.getElementById('cat_menu_item_'+selected_menu).style.backgroundColor='#e1ffe6';
					}
		}

}
// Снятие выделения с раздела
function unselect_cat()
{
	if (parent.site_structure.selected_cat!="" && parent.site_structure.document.getElementById('menu_item_'+parent.site_structure.selected_cat))
					{
						parent.site_structure.document.getElementById('menu_item_'+parent.site_structure.selected_cat).style.backgroundColor=parent.site_structure.selected_cat_bg;

					}

					if (parent.site_structure.selected_menu!="" && parent.site_structure.document.getElementById('cat_menu_item_'+parent.site_structure.selected_menu))
					{

					parent.site_structure.document.getElementById('cat_menu_item_'+parent.site_structure.selected_menu).style.backgroundColor=parent.site_structure.selected_menu_bg;
					parent.site_structure.selected_menu = "";
					parent.site_structure.selected_menu_bg = "";
					}

						if (selected_menu!="" && parent.site_structure.document.getElementById('cat_menu_item_'+selected_menu))
					{

						parent.site_structure.document.getElementById('cat_menu_item_'+selected_menu).style.backgroundColor=selected_menu_bg;

					}
						if (selected_cat!="" && parent.site_structure.document.getElementById('menu_item_'+selected_cat))
					{
					parent.site_structure.document.getElementById('menu_item_'+selected_cat).style.backgroundColor=selected_cat_bg;
					selected_cat = "";
					selected_cat_bg = "";
					}
					selected_menu="";

}

function select_all(div)
{
		var block = document.getElementById(div);
			var inputs = block.getElementsByTagName('input');
					for(var i=0; i<inputs.length; i++)
						{
							if(inputs[i].type=="checkbox")
							{

								inputs[i].checked=true;
							}
						}
}

function unselect_all(div)
{
		var block = document.getElementById(div);
			var inputs = block.getElementsByTagName('input');
					for(var i=0; i<inputs.length; i++)
						{
							if(inputs[i].type=="checkbox")
							{

								inputs[i].checked=false;
							}
						}
}

function link_list()
{
	var param = "?action=get_links_list&selected=" + get_val('input_link');
	new MakeRequest('div_link_list', 'ajax.php', param);}

function link_to_file(field) {
    window.KCFinder = {};
    window.KCFinder.callBack = function(url) {
        // Actions with url parameter here
        field.value=url;
        window.KCFinder = null;
    };
    window.open('/filemanager/browse.php?langCode=ru', 'kcfinder_single',
        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
        'resizable=1, scrollbars=0, width=1000, height=600');
}

