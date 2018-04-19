// JavaScript Document
// JavaScript Document
Function.prototype.createDelegate = function(obj, args, appendArgs){
	var method = this;
	return function() {
	    var callArgs = args || arguments;
	    if (appendArgs === true) {
	        callArgs = Array.prototype.slice.call(arguments, 0);
	        callArgs = callArgs.concat(args);
        } else if (typeof appendArgs == 'number') {
			callArgs = Array.prototype.slice.call(arguments, 0);
			var applyArgs = [appendArgs, 0].concat(args);
			Array.prototype.splice.apply(callArgs, applyArgs);
	    }
		return method.apply(obj || window, callArgs);
    };
};
var MakeRequest = function () {
	this.transport = (function () {
		try {
			if (window.ActiveXObject) {
				var AXOs = ['Msxml2.XMLHTTP', 'Microsoft.XMLHTTP'];
				for (var i = 0; i < AXOs.length; i++) {
					try { return ActiveXObject(AXOs[i]) } catch (e) {}
				}
			}
			if (window.XMLHttpRequest) return new XMLHttpRequest();		} catch (e) {
			alert('ÎØÈÁÊÀ! Íåâîçìîæíî ñîçäàòü îáúåêò HTTPRequest.');
			return null;
		}
	} ());
	if (!this.transport)
	{
		this.transport = new ActiveXObject('Microsoft.XMLHTTP');
	}
	this.place = arguments[0] ? document.getElementById(arguments[0]) : null;
	this.place.innerHTML = "<img src='../images/webcms/wait.gif' align='center'>";
	this.ResponseHandler = function () {
		if (4 == this.transport.readyState) {
			if (this.place) {
				if (200 == this.transport.status) {
					this.place.innerHTML = this.transport.responseText;
						var scripts=document.getElementsByTagName("script");
				 for (var i = 0; i < scripts.length; i++)
	 						  {
						if (scripts[i].id == "do_it")
						{
						eval(scripts[i].innerHTML);
						scripts[i].id = "";
						}
								}
				} else alert('ÎØÈÁÊÀ! Íåâåðíûé îòâåò ñåðâåðà.');
			} else alert('ÎØÈÁÊÀ! Îòñóòñòâóåò êîíòåéíåð äëÿ çàïðîøåííûõ äàííûõ.');
			//document.getElementById('wait').innerHTML = '';
			//this.transport.onreadystatechange = null;
		}
	}
	try {this.transport.onreadystatechange = this.ResponseHandler.createDelegate(this); } catch (e) {}
 var url = arguments[1] + arguments[2];
	this.transport.open('GET', url, true);

this.transport.send(null);
};

function ajax_menu_form(menu_id,cat_id)
	{
		var param = "?action=edit_form&menu_id="+menu_id +"&cat_id=" + cat_id;
		new MakeRequest('div_'+menu_id, 'menu_items_actions.php', param);
	}

	/////// ÐÀÇÂÎÐÀ×ÈÂÀÍÅ È ÑÂÎÐÀ×ÈÂÀÍÈÅ ÐÀÇÄÅËÎÂ ÌÅÍÞ

	function show_sub (id)
{
	var param = "?action=show_sub&id="+id;
	new MakeRequest('div_ajax', 'menu_items_actions.php', param);
}

function hide_sub (id)
{
	var param = "?action=hide_sub&id="+id;
	new MakeRequest('div_ajax', 'menu_items_actions.php', param);
}


// QUIK-EDIT
function edit_text_block(id)
{
 	var param = "?action=edit_text_block&id=" + id;
	new MakeRequest('edit_'+id, 'admin/ajax.php', param);
}