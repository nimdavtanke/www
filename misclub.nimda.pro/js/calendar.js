// JavaScript Document
function getDay(day,mon,year){
 var days = new Array("7","1","2","3","4","5","6");
 day=parseInt(day); //если день двухсимвольный и <10 
 mon=parseInt(mon); //если месяц двухсимвольный и <10 
 var a=parseInt((14-mon)/12);
 var y=year-a;
 var m=mon+12*a-2;
 var d=(7000+parseInt(day+y+parseInt(y/4)-parseInt(y/100)+parseInt(y/400)+(31*m)/12))%7;
 return days[d];
}

var selected_day ="";
var selected_month ="";
var selected_year ="";
function select_date(date,input_date,div_calendar)
{
var months = new Array("Декабрь","Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь");
date = date.split(".");
if (date[1]*1==12) 
{
	date[1]=0;
	date[2]=date[2]*1+1;
}
//alert(date);
var day = getDay(1,date[1],date[2]);
//alert(day);
var prev_month = new Date(date[2],date[1]*1-1,1);
prev_month = "1."+prev_month.getMonth()+"."+prev_month.getFullYear();

var next_month = new Date(date[2],date[1]*1+1,1);
next_month = "1."+next_month.getMonth()+"."+next_month.getFullYear();

var prev_year = new Date(date[2]*1-1,date[1]*1,1);
prev_year = "1."+prev_year.getMonth()+"."+prev_year.getFullYear();

var next_year = new Date(date[2]*1+1,date[1]*1,1);
next_year = "1."+next_year.getMonth()+"."+next_year.getFullYear();

var year=date[2];
var month_sel=date[1];
if (date[1]==0) 
{
	year=date[2]*1-1;
	month_sel = 12;
}
var cal_list = "<table border=0 cellspacing=0 cellpadding=0 align=\"center\"><tr><td bgcolor=\"#cccccc\"><table border=0 cellspacing=1 cellpadding=3 align=\"center\"><tr><td colspan=7 class=\"calendar_header\"><table border=0 cellpadding=0 cellspacing=0 width='100%'><tr><td align=\"center\"> <a onclick=\"select_date('"+prev_year+"','"+input_date+"','"+div_calendar+"')\">&laquo;</a></td><td align=\"center\"><a onclick=\"select_date('"+prev_month+"','"+input_date+"','"+div_calendar+"')\">&laquo;</a></td><td align=\"center\">"+(months[date[1]*1])+" "+year+"</td><td align=\"center\"><a onclick=\"select_date('"+next_month+"','"+input_date+"','"+div_calendar+"')\">&raquo;</a></td><td align=\"center\"><a onclick=\"select_date('"+next_year+"','"+input_date+"','"+div_calendar+"')\">&raquo;</a></td></tr></table></td></tr><tr><td bgcolor=\"#FFFFFF\">Пн</td><td bgcolor=\"#FFFFFF\">Вт</td><td bgcolor=\"#FFFFFF\">Ср</td><td bgcolor=\"#FFFFFF\">Чт</td><td bgcolor=\"#FFFFFF\">Пт</td><td bgcolor=\"#FFFFFF\">Сб</td><td bgcolor=\"#FFFFFF\">Вс</td></tr>";
cal_list += "<tr>";
var cols=0;
	for (i=1;i<day;i++)
		{
		cal_list += "<td>&nbsp</td>";
		cols++;
		}
	var days = 1;
	var dayCount = new Date(date[2], date[1]*1, 0).getDate();
		while(days<=dayCount)
			{
			if (selected_month == month_sel && selected_year == year && selected_day==days)
			{
				
					cal_list += "<td bgcolor=\"#e0f8ff\" align=\"center\" onmouseover=\"this.style.backgroundColor='#f1f1f1';\" onmouseout=\"this.style.backgroundColor='#e0f8ff';\" onclick=\"get_id('"+input_date+"').value='"+date[0]+"."+month_sel+"."+year+"'; get_id('"+div_calendar+"').style.visibility='hidden';\" style=\"cursor:pointer; color:#FF0000; font-weight:bold;\">"+days+"</td>";
			}
			else
			{
			cal_list += "<td bgcolor=\"#FFFFFF\" align=\"center\" onmouseover=\"this.style.backgroundColor='#f1f1f1';\" onmouseout=\"this.style.backgroundColor='#ffffff';\" onclick=\"get_id('"+input_date+"').value='"+days+"."+month_sel+"."+year+"'; get_id('"+div_calendar+"').style.visibility='hidden';\" style=\"cursor:pointer;\">"+days+"</td>";
			}
			cols++;
			if (cols==7)
				{
					cal_list += "</tr><tr>";
					cols++;
					cols=0;
				}
				days++;
			}
			if (cols>0)
				{
		while (cols<7)
			{
			cal_list += "<td>&nbsp</td>";
		cols++;
			}
				}
			cal_list += "</tr></table>";
		//	alert(cal_list);
		document.getElementById(div_calendar).innerHTML=cal_list;
}

function set_date(pole, div_calendar)
{
if (get_id(div_calendar).style.visibility=='visible')
	{
		get_id(div_calendar).style.visibility='hidden';
	}
	else
	{
	date = get_id(pole).value.split(".");

	selected_day =date[0]; 
	selected_month =date[1]; 
	selected_year =date[2];
	select_date(selected_day+"."+selected_month+"."+selected_year, pole,div_calendar);
	get_id(div_calendar).style.visibility='visible';
	}
}