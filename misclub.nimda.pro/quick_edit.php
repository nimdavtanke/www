<?
if (!isset($_SESSION['quick_edit_mode'])) $_SESSION['quick_edit_mode']=false;

if (isset($_GET['quick_edit']) and $_GET['quick_edit']=="add_block")
{
       $pos = 0;
	$q = "SELECT position FROM page_blocks WHERE menu_id='$m_id' ORDER BY position DESC LIMIT 0,1";
	$pos = mysql_fetch_assoc(doquery($q));
	$pos = $pos['position']+1;
	if (!isset($_GET['block_sub_type']))
	{
	$block_sub_type="0";
	}
	else
	{
	$block_sub_type=$_GET['block_sub_type'];
	}

		$q = "INSERT INTO page_blocks SET menu_id='$m_id', block_type='$_GET[block_type]',block_sub_type='$block_sub_type', position='$pos'";
		doquery($q);	}

if (isset($_GET['quick_edit']) and $_GET['quick_edit']=="delete_block")
{
if (!isset($_GET['block_id']) or $_GET['block_id']=="")
		{
		$error = "�� ������ ���� ��� ��������!";
		}
		else
		{
				$q = "SELECT block_type FROM page_blocks WHERE id='$_GET[block_id]'";
				$block = mysql_fetch_assoc(doquery($q));
				// ���� ������������, ������� �����
					if ($block['block_type']=="1")
						{
						$q = "SELECT * FROM photos WHERE block_id='$_GET[block_id]'";
							$do = doquery($q);
								while ($photo = mysql_fetch_assoc($do))
									{
									unlink("photogallery/thumbs/$photo[photo].jpg");
									unlink("photogallery/originals/$photo[photo].jpg");
									unlink("photogallery/photos/$photo[photo].jpg");
										$q = "DELETE FROM photos WHERE id='$photo[id]'";
										doquery($q);
									}
						}
						$q = "DELETE FROM page_blocks WHERE id='$_GET[block_id]'";
										doquery($q);
										update_date_edit($m_id);
		}	}

  if (isset($_GET['quick_edit']) and $_GET['quick_edit']=="save_block_pos")
{

	foreach ($_GET['block_pos'] as $block_id => $new_pos)
		{
		$q = "UPDATE page_blocks SET position='$new_pos' WHERE id='$block_id'";
		doquery($q);
		}
		update_date_edit($m_id);
  }
if (isset($_GET['quick_edit']) and $_GET['quick_edit']=="switch_off")
{
$_SESSION['quick_edit_mode'] = false;	}
if (isset($_GET['quick_edit']) and $_GET['quick_edit']=="switch_on")
{
$_SESSION['quick_edit_mode'] = true;
	}


  if($options['is_open']=="0")
		{
		$closed_site = "<div align='center'><strong>��������!</strong> ���� ������ ��� �������������!</div>";
		}
          else
          {
           $closed_site = "";
          	}
                  if ($_SESSION['quick_edit_mode'])
                  	{
                  	$mode = "����� ��������������";
                  	$switch = "<a href=\"$clear_uri?quick_edit=switch_off\"><img src='images/webcms/switch_r.gif' border='0' align='absmiddle'/></a>";                  		}
                  		else
                  		{
                  		$mode = "����� ���������";
                      $switch = "<a href=\"$clear_uri?quick_edit=switch_on\"><img src='images/webcms/switch_l.gif' border='0' align='absmiddle'/></a>";                  			}
  echo "<div id='quick_panel' style='width:100%; z-index:99999; min-height:55px; border-bottom:1px solid #cccccc; background-color:#ffffff;' align='center'><div style='padding:5px;'>
  <div align='left' style='font-size:11px;'>������� ��������: <strong>$page[name]</strong>, ID: <strong>$m_id</strong><br />
  <strong>���������� ��������:</strong> �� ���� $page_counter[today] ($page_counter[yesterday]), �� ������ $page_counter[week] ($page_counter[last_week]), �� ����� $page_counter[month] ($page_counter[last_month])<br />
  <strong>���������� �����:</strong> �� ���� $counter_views[today] ($counter_views[yesterday]), �� ������ $counter_views[week] ($counter_views[last_week]), �� ����� $counter_views[month] ($counter_views[last_month])<br />
  <strong>����������� �������:</strong> $counter_visitors[today]  </div>
  $closed_site<div style='position:absolute; right:8px; top:5px; font-size:11px; font-weight:bold;'>$mode<br />
  <a href=\"$clear_uri?quick_edit=switch_off\"><img src='images/webcms/view.gif' border='0' align='absmiddle'></a> $switch <a href=\"$clear_uri?quick_edit=switch_on\"><img src='images/webcms/ico_edit.gif' border='0' align='absmiddle'></a><div style='font-size:11px; font-weight:normal;'><a href='/admin/' target=\"_blank\">������ ����������</a> | <a href='/admin/admin_login.php?action=logout'>�����</a></div></div><div style='clear:both;'></div></div></div>";

?>