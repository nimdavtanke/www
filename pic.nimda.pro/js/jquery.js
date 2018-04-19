function loadExternalHTMLPage() {
var xmlhttp;
var pagesToDisplay = ['../html/1001.html', '../html/1002.html', '../html/1003.html', '../html/1004.html', '../html/1005.html', '../html/1006.html',
'../html/1007.html', '../html/1008.html', '../html/1009.html', '../html/1010.html', '../html/1011.html', '../html/1012.html', '../html/1013.html',
'../html/1014.html', '../html/1015.html', '../html/1016.html', '../html/1017.html', '../html/1018.html', '../html/1019.html', '../html/1020.html',
'../html/1021.html', '../html/1022.html', '../html/1023.html', '../html/1024.html', '../html/1025.html', '../html/1026.html', '../html/1027.html',
'../html/1028.html', '../html/1029.html', '../html/1030.html', '../html/1031.html', '../html/1032.html', '../html/1033.html', '../html/1034.html',
'../html/1035.html', '../html/1036.html', '../html/1037.html', '../html/1038.html', '../html/1039.html', '../html/1040.html', '../html/1041.html',
'../html/1042.html', '../html/1043.html', '../html/1044.html', '../html/1045.html', '../html/1046.html', '../html/1047.html', '../html/1048.html',
'../html/1049.html', '../html/1050.html', '../html/1051.html', '../html/1052.html', '../html/1053.html', '../html/1054.html', '../html/1055.html',
'../html/1056.html', '../html/1057.html', '../html/1058.html', '../html/1059.html', '../html/1060.html', '../html/1061.html', '../html/1062.html',
'../html/1063.html', '../html/1064.html', '../html/1065.html', '../html/1066.html', '../html/1067.html', '../html/1068.html', '../html/1069.html',
'../html/1070.html', '../html/1071.html', '../html/1072.html', '../html/1073.html', '../html/1074.html', '../html/1075.html', '../html/1076.html',
'../html/1077.html', '../html/1078.html', '../html/1079.html', '../html/1080.html', '../html/1081.html', '../html/1082.html', '../html/1083.html',
'../html/1084.html', '../html/1085.html', '../html/1086.html', '../html/1087.html', '../html/1088.html', '../html/1089.html', '../html/1090.html',
'../html/1091.html', '../html/1092.html', '../html/1093.html', '../html/1094.html', '../html/1095.html', '../html/1096.html', '../html/1097.html',
'../html/1098.html', '../html/1099.html', '../html/1100.html', '../html/1101.html', '../html/1102.html', '../html/1103.html', '../html/1104.html',
'../html/1105.html', '../html/1106.html', '../html/1107.html', '../html/1108.html'];
if (window.XMLHttpRequest) {
xmlhttp = new XMLHttpRequest();
} else {
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange = function () {
if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
document.getElementById("contentArea").innerHTML = xmlhttp.responseText;
}
}
var randomnumber = Math.floor(Math.random() * pagesToDisplay.length);
xmlhttp.open("GET", pagesToDisplay[randomnumber], true);
xmlhttp.send();
}
