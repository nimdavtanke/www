<?
//echo "$m_id " . get_userip() . "<br />";
	// Получаем последний визит на странице
	$q = "SELECT * FROM counter_hits WHERE page_id='$m_id'";
	$do = doquery($q);
    	if (mysql_num_rows($do)==0)
    		{
    		// Страница никогда не посещалась
    		$q = "INSERT INTO counter_hits SET page_id='$m_id', today='1', yesterday='0', week='1', month='1', last_visit=NOW()";
    		doquery($q);    			}
    			else
    			{
                  $page_counter = mysql_fetch_assoc($do);
            			//если последний визит вчера
            		if (strtotime(date("d-m-Y"))-strtotime($page_counter['last_visit'])==86400)
            		{
                   $q = "UPDATE counter_hits SET  yesterday=today, today=1, week=week+1, month=month+1, last_visit=NOW() WHERE page_id='$m_id'";
            			}
            			// Прошло больше суток с последнего посещения
            			elseif(strtotime(date("d-m-Y"))-strtotime($page_counter['last_visit'])>86400)
            			        {            			  $q = "UPDATE counter_hits SET today=1, yesterday=0, week=week+1, month=month+1, last_visit=NOW() WHERE page_id='$m_id'";
            			        	}
            			else
            			{
            	$q = "UPDATE counter_hits SET today=today+1, week=week+1, month=month+1, last_visit=NOW() WHERE page_id='$m_id'";
            			}

               doquery($q);
            				$counter_d = explode("-",$page_counter['last_visit']);
            			// Прошел месяц последнего визита
            			        	if (date("m")!=$counter_d[1])
                						{
                             		  $q = "UPDATE counter_hits SET last_month=month, month=1 WHERE page_id='$m_id'";
                             	  doquery($q);

                						}
                						// прошла ли неделя
                						if (date("W",strtotime($page_counter['last_visit']))!=date("W"))
                							{
                                             $q = "UPDATE counter_hits SET last_week=week, week=1 WHERE page_id='$m_id'";
                                             doquery($q);                								}

    				}

    				$q = "SELECT * FROM counter_hits WHERE page_id='$m_id'";
				$do = doquery($q);
       		$page_counter = mysql_fetch_assoc($do);
       			// Просмотров всего
                  $q = "SELECT SUM(today) as today, SUM(yesterday) as yesterday, SUM(month) as month, SUM(last_month) as last_month, SUM(week) as week, SUM(last_week) as last_week FROM counter_hits";
                  $do = doquery($q);
       			  $counter_views = mysql_fetch_assoc($do);

			// Посетители
			$ip = get_userip();
			$q = "SELECT * FROM counter_hosts WHERE date='".date("Y-m-d")."'";
				$do = doquery($q);

					if (mysql_num_rows($do)==0)
						{
						// Сегодня посетителей не было

						$visitor[$ip] = array("referrer"=>$_SERVER['HTTP_REFERER'], "pages"=>array("$m_id"));
						$serialized = serialize($visitor);
      							$q = "INSERT INTO counter_hosts SET date=NOW(), counter='1', visitors='$serialized'";
      							doquery($q);							}
							else
							{
							$counter_info = mysql_fetch_assoc($do);
        							// Проверяем был ли юзер
        							$visitors = unserialize($counter_info['visitors']);
               							if (!isset($visitors[$ip]))
               								{
                                             $visitors[$ip] = array("referrer"=>$_SERVER['HTTP_REFERER'], "pages"=>array("$m_id"));
                                             $serialized = serialize($visitors);
                                             $q = "UPDATE counter_hosts SET counter=counter+1, visitors='$serialized'";
                                             doquery($q);               								}								}
                           $q = "SELECT counter as today FROM counter_hosts WHERE date='".date("Y-m-d")."'";
							$do = doquery($q);
								$counter_visitors = mysql_fetch_assoc($do);

?>