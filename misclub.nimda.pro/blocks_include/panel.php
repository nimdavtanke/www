<?
$panel = "";
$_SESSION['hide_panel'] = false;
	if (!isset($_SESSION['hide_panel']) or !$_SESSION['hide_panel']){
         $panel = "<div class=\"panel\"><div class=\"close_panel\">&times;</div><ul class=\"btns\">
         <li><div class=\"comment\" onclick=\"location.href='/preyskurant/parikmaHerskie_uslugi/#strijka'\"><div class=\"padding\">Стрижки горячими<br />ножницами</div></div>
         <a href=\"/preyskurant/parikmaHerskie_uslugi/#strijka\" style=\"color:#ffffff;\"><img src=\"/images/design/ico_1.png\" border=\"0\"></a></li>
         <li class=\"divider\"></li>
           <li><div class=\"comment\" onclick=\"location.href='/preyskurant/parikmaHerskie_uslugi/#ukladka'\"><div class=\"padding_one\">Укладка</div></div>
         <a href=\"/preyskurant/parikmaHerskie_uslugi/#ukladka\" style=\"color:#ffffff;\"><img src=\"/images/design/ico_2.png\" border=\"0\"></a></li>
         <li class=\"divider\"></li>

         <li><div class=\"comment\" onclick=\"location.href='/preyskurant/parikmaHerskie_uslugi/#loreal'\"><div class=\"padding_one\">Окрашивание L'OREAL</div></div>
         <a href=\"/preyskurant/parikmaHerskie_uslugi/#loreal\" style=\"color:#ffffff;\"><img src=\"/images/design/ico_3.png\" border=\"0\"></a></li>
         <li class=\"divider\"></li>
          <li><div class=\"comment\" onclick=\"location.href='/preyskurant/parikmaHerskie_uslugi/#matrix'\"><div class=\"padding_one\">Окрашивание Matrix</div></div>
         <a href=\"/preyskurant/parikmaHerskie_uslugi/#matrix\" style=\"color:#ffffff;\"><img src=\"/images/design/ico_4.png\" border=\"0\"></a></li>
         <li class=\"divider\"></li>
          <li><div class=\"comment\" onclick=\"location.href='/preyskurant/parikmaHerskie_uslugi/#estel'\"><div class=\"padding_one\">Окрашивание Estel</div></div>
         <a href=\"/preyskurant/parikmaHerskie_uslugi/#estel\" style=\"color:#ffffff;\"><img src=\"/images/design/ico_5.png\" border=\"0\"></a></li>
         <li class=\"divider\"></li>
          <li><div class=\"comment\" onclick=\"location.href='/preyskurant/parikmaHerskie_uslugi/#melirovanie'\"><div class=\"padding_one\">Мелирование</div></div>
         <a href=\"/preyskurant/parikmaHerskie_uslugi/#melirovanie\" style=\"color:#ffffff;\"><img src=\"/images/design/ico_6.png\" border=\"0\"></a></li>
         <li class=\"divider\"></li>
          <li><div class=\"comment\" onclick=\"location.href='/preyskurant/parikmaHerskie_uslugi/#zavivka'\"><div class=\"padding_one\">Химическая завивка</div></div>
         <a href=\"/preyskurant/parikmaHerskie_uslugi/#zavivka\" style=\"color:#ffffff;\"><img src=\"/images/design/ico_7.png\" border=\"0\"></a></li>
         <li class=\"divider\"></li>

          <li><div class=\"comment\" onclick=\"location.href='/preyskurant/parikmaHerskie_uslugi/#spa'\"><div class=\"padding_one\">SPA-ритуалы</div></div>
         <a href=\"/preyskurant/parikmaHerskie_uslugi/#spa\" style=\"color:#ffffff;\"><img src=\"/images/design/ico_8.png\" border=\"0\"></a></li>
         <li class=\"divider\"></li>
          <li><div class=\"comment\" onclick=\"location.href='/preyskurant/parikmaHerskie_uslugi/#uhod'\"><div class=\"padding_one\">Уходы</div></div>
         <a href=\"/preyskurant/parikmaHerskie_uslugi/#uhod\" style=\"color:#ffffff;\"><img src=\"/images/design/ico_9.png\" border=\"0\"></a></li>
         <li class=\"divider\"></li>
        </ul></div>";
	}
	if ($m_id!=39){
	$panel="";
	}
?>