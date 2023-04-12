<?
class wwwHome_Controller extends GGoRok
{
	
	function home()
	{
		
		echo $this->Load->View('www/header.tpl',array(
			'title' => 'IDJBox.com',
			'metaK' => 'IDJBox',
			'metaD' => 'IdjBox'
		));
		
		if($this->login->isLogin())
		{
			$Data_Home = array();
			echo $this->Load->View('www/home.tpl',$Data_Home);
		}
		else
		{
			$Data_Login = array();
			
			$Data_Login['LoginToken'] = $_SESSION['LoginToken'] = md5(uniqid(mt_rand(), true));
			echo $this->Load->View('www/login.tpl',$Data_Login);
		}
		
		echo $this->Load->View('www/footer.tpl');
	
	}
	function refreshPage()
	{
		$output['ack'] = 'error';
		
		
		$output['html_tab'] = '';
		
		if(!isset($_POST['tab']) || $_POST['tab'] == 1)
		{
			$output['ack'] = 'success';
			$output['tab_id'] = 1;
			$All_Files = $this->db->QRY("
				SELECT
					*
				FROM
					idj_file
				WHERE
					customers_id = '".$this->db->escape($this->login->_customerID)."' 
			");
			
			
			if(sizeof($All_Files) > 0)
			{
				foreach($All_Files as $All_Files_F)
				{
					$output['html_tab'] .= '<div class="Tab_MusicList_One noSelect" id="mID_'.$All_Files_F['file_id'].'"><span>'.$All_Files_F['file_name'].'</span><div class="MusicFile_Menu"><div class="MusicFile_Menu_Delete"></div></div></div>';
				}
			}
			else
			{
				$output['html_tab'] = '<div class="noList_Right">No music found</div>';	
			}
			
		}
		else if($_POST['tab'] == 2)
		{
			$output['ack'] = 'success';
			$output['tab_id'] = 2;
			$Favorite_Files = $this->db->QRY("
				SELECT
					*
				FROM
					idj_file
				WHERE
					customers_id = '".$this->db->escape($this->login->_customerID)."'
				ORDER BY
					played DESC
			");
			
			
			
			if(sizeof($Favorite_Files) > 0)
			{
				foreach($Favorite_Files as $Favorite_Files_F)
				{
					$output['html_tab'] .= '<div class="Tab_MusicList_One noSelect" id="mID_'.$Favorite_Files_F['file_id'].'"><span>'.$Favorite_Files_F['file_name'].'</span><div class="MusicFile_Menu"><div class="MusicFile_Menu_Delete"></div></div></div>';
				}
			}
			else
			{
				$output['html_tab'] = '<div class="noList_Right">No music found</div>';	
			}
			
		}
		else if($_POST['tab'] == 3)
		{
			$output['ack'] = 'success';
			$output['tab_id'] = 3;
			$Recent_Files = $this->db->QRY("
				SELECT
					*
				FROM
					idj_file
				WHERE
					customers_id = '".$this->db->escape($this->login->_customerID)."'
				ORDER BY
					file_id DESC
			");
			
			
			
			if(sizeof($Recent_Files) > 0)
			{
				foreach($Recent_Files as $Recent_Files_F)
				{
					$output['html_tab'] .= '<div class="Tab_MusicList_One noSelect" id="mID_'.$Recent_Files_F['file_id'].'"><span>'.$Recent_Files_F['file_name'].'</span><div class="MusicFile_Menu"><div class="MusicFile_Menu_Delete"></div></div></div>';
				}
			}
			else
			{
				$output['html_tab'] = '<div class="noList_Right">No music found</div>';	
			}
		}
			
		
		
		if(isset($_POST['album']))
		{
			$output['Music_List'] = '';
			$output['Arts_List'] = '';
			$output['Music_Play_Current'] = '';
			$Music_List = $this->db->QRY("
				SELECT
					f.file_id,
					f.file_name,
					f.info_title,
					f2c.f2c_id,
					f2c.last_played
				FROM
					idj_file f,
					idj_file_to_cat f2c
				WHERE
					f2c.album_id = '".$this->db->escape($_POST['album'])."' AND
					f2c.file_id = f.file_id AND
					f.customers_id = '".$this->db->escape($this->login->_customerID)."'
				ORDER BY
					f2c.sort ASC
			");
			
			$this->db->QRY("UPDATE idj_album SET last_selected = 0 WHERE customers_id = '".$this->db->escape($this->login->_customerID)."'");
			$this->db->QRY("UPDATE idj_album SET last_selected = 1 WHERE customers_id = '".$this->db->escape($this->login->_customerID)."' AND album_id = '".$this->db->escape($_POST['album'])."'");
			
			
			foreach($Music_List as $Music_List_F)
			{
				$output['Music_List'] .= '<div id="mID_Play_'.$Music_List_F['f2c_id'].'" class="'.($Music_List_F['last_played'] == 1 ? 'MusicList_PlayingNow ':'').'MusicList_Player_One">
														<div class="Sort_PlayList_Btn"></div>
														<div class="MusicList_Name"><span>'.(!is_null($Music_List_F['info_title']) && $Music_List_F['info_title'] != "" ? strip_tags($Music_List_F['info_title']) : strip_tags($Music_List_F['file_name'])).'</span></div>
														<div class="MusicList_Menu">
															<div class="MusicList_Menu_Delete"></div>
														</div>
													</div>';
				
				$FileInfo = $this->getExtention($Music_List_F['file_name']);
				$FilePath = __DocumentPath__._MusicVault_.'/'.$this->login->_customerID.'/'.$Music_List_F['file_id'].($FileInfo['Ext'] != "" ? ".".$FileInfo['Ext']:"");
				
				if(is_file($FilePath))
				{
					$ThisMusicInfo = $getID3->analyze($FilePath);
					getid3_lib::CopyTagsToComments($ThisMusicInfo);
				}

				
				$Album_Art_File_Path = __DocumentPath__._MusicVault_.'/'.$this->login->_customerID.'/'.$Music_List_F['file_id'].'.png';
				$Art_imgSRC = (is_file($Album_Art_File_Path) ? '/ArtWork/'.$Music_List_F['file_id'].'.png' : '/img/noArtImg.gif');
				$output['Arts_List'] .= '<div class="artImg_Container" id="artID_Play_'.$Music_List_F['f2c_id'].'"><img class="artImg_notPlaying" src="/img/artwork-not-playing-bg.png" /><img class="AlbumArt_One" width="45" src="'.$Art_imgSRC.'" /></div>';
				
				
			}
			if($output['Arts_List'] != "")
				$output['Arts_Size'] = sizeof($Music_List);
			$output['Music_Play_Current'] = $this->musicNextPrev($_POST['album'],"Current");
			
			
		}
		
		$Album_All = $this->db->QRY("
			SELECT
				album_id,
				album_name,
				album_sort,
				last_selected
			FROM
				idj_album
			WHERE
				customers_id = '".$this->db->escape($this->login->_customerID)."'
		");
		
		
		foreach($Album_All AS $Album_All_F)
		{
			if($Album_All_F['last_selected'] == 1)
				$output['Album_Last'] = $Album_All_F['album_id'];
		}
		
		return $output;
	
	}
	
	private function getExtention($Filename)
	{
		$F = explode('.',$Filename);
		$Output_F['FileName'] = '';
	
		if(sizeof($F) > 1)
			$Output_F['Ext'] = $F[sizeof($F) - 1];
		else
			$Output_F['Ext'] = null;
			
		foreach($F as $F_Key => $F_F)
		{
			$Output_F['FileName'] .= $F_F;
			
			if(sizeof($F) - 1 > $F_Key)
				break;
			
			
		}
		
		
		
		return $Output_F;
	}
	
	private function uploadMusic()
	{
		$output['ack'] = "success";
		$output['error_msg'] = '';
		
		
		foreach ($_FILES['uploadMusic_INP']['name'] as $UploadKey => $Upload)
		{
			$Process_Waveform = true;
			$AudioInfo = $getID3->analyze($_FILES['uploadMusic_INP']["tmp_name"][$UploadKey]);
			getid3_lib::CopyTagsToComments($AudioInfo);
			
			
			$Inserted_ID = $db->QRY("
				INSERT INTO
					idj_file
					(
						customers_id,
						file_name,
						info_bitrate,
						info_artist,
						info_title,
						info_playtime
					)
					VALUES
					(
						'".$db->escape($this->login->_customerID)."',
						'".$db->escape($Upload)."',
						".(!empty($AudioInfo['audio']['bitrate']) ? "'".$db->escape(round($AudioInfo['audio']['bitrate'] / 1000))."'" : 'NULL').",
						".(!empty($AudioInfo['comments_html']['artist']) ? "'".$db->escape(implode('<br>', $AudioInfo['comments_html']['artist']))."'" : 'NULL' ).",
						".(!empty($AudioInfo['comments_html']['title']) ? "'".$db->escape(implode('<br>', $AudioInfo['comments_html']['title']))."'" : 'NULL' ).",
						".(!empty($AudioInfo['playtime_string']) ? "'".$db->escape($AudioInfo['playtime_string'])."'" : 'NULL' )."
					)
			", true);
			
			
			if(isset($_POST['Album']) && is_numeric($_POST['Album']))
			{
				$db->QRY("
					INSERT INTO
						idj_file_to_cat
						(
							album_id,
							customers_id,
							file_id,
							sort,
							last_played
						)
					SELECT
					
						'".$db->escape($_POST['Album'])."',
						'".$db->escape($this->login->_customerID)."',
						'".$Inserted_ID."',
						IFNULL(max(sort),0) + 10,
						0
					FROM
						idj_file_to_cat
					WHERE
						album_id = '".$db->escape($_POST['Album'])."' AND
						customers_id = '".$db->escape($this->login->_customerID)."'
					LIMIT
						1

				");
			}
			
			$F_Info = $this->getExtention($Upload);
			
			if(!is_null($F_Info['Ext']))
			{
				$New_File_Name = $Inserted_ID.'.'.$F_Info['Ext'];
			}
			else
			{
				$New_File_Name = $Inserted_ID;
			}
			$MusicFolder = __DocumentPath__. '__Music_Vault__/'. $this->login->_customerID;
			if(!is_dir($MusicFolder))
				mkdir($MusicFolder);
			
			
			if(isset($AudioInfo['comments']['picture'][0]))
			{
				$Img_Mime = $AudioInfo['comments']['picture'][0]['image_mime'];
				imagepng(imagecreatefromstring($AudioInfo['comments']['picture'][0]['data']),$MusicFolder.'/'.$Inserted_ID.'.png');
			}
			
			move_uploaded_file($_FILES['uploadMusic_INP']["tmp_name"][$UploadKey],__DocumentPath__. '__Music_Vault__/'. $this->login->_customerID . '/' . $New_File_Name);
				
			$File = __DocumentPath__._MusicVault_.'/'.$this->login->_customerID.'/'.$New_File_Name;
			
			//Wma Should be changed into MP3 or OGG 
			if($_FILES['uploadMusic_INP']['type'][$UploadKey] == 'audio/x-ms-wma')
			{
				if($waveform->wmaToMp3($File, __DocumentPath__._MusicVault_.'/'.$this->login->_customerID.'/'.$Inserted_ID.'.mp3'))
				{
					unlink($File);
					$File = __DocumentPath__._MusicVault_.'/'.$this->login->_customerID.'/'.$Inserted_ID.'.mp3';
					
					//Now change file extenstion to mp3 from wma
					$db->QRY("
						UPDATE
							idj_file
						SET
							file_name = '".$db->escape($F_Info['FileName'].'.mp3')."'
						WHERE
							file_id = '".$Inserted_ID."'");
					
				}
				else
				{
					$output['ack'] = 'error';
					$output['error_msg'] .= 'There was some problem while converting wma to playable audio format('.$Upload.')';
					$Process_Waveform = false;
					
				}
			}
			
				
			if($Process_Waveform)
			{
				$Size['Width'] = 420;
				$Size['Height'] = 25;
				$waveform->createWaveForm_PNG($File,$Size,__DocumentPath__. '__Music_Vault__/'. $this->login->_customerID . '/' . $Inserted_ID.'_wf.png');
			}
			
		}
		
		//echo $_FILES["uploadMusic_INP"]["name"];
		return $output;
	}
	
	private function updateList_Play()
	{
		global $login, $db;
		$output['ack'] = 'error';
		
		if(isset($_POST['Order']) && isset($_POST['album']))
		{
			$output['ack'] = 'success';
			$NewOrder = json_decode($_POST['Order']);
			$Sort_Incre = 0;
			foreach($NewOrder as $NewOrder_F)
			{
				
				if(preg_match('/NewAdded_/',$NewOrder_F))
				{
					$db->QRY("
						INSERT INTO
							idj_file_to_cat
							(
								album_id,
								customers_id,
								file_id,
								sort
							)
							VALUES
							(
								'".$db->escape($_POST['album'])."',
								'".$db->escape($this->login->_customerID)."',
								'".$db->escape(preg_replace("/NewAdded_/","",$NewOrder_F))."',
								'".$Sort_Incre."'
							)
					");
					
				}
				else
				{
					$db->QRY("
						UPDATE
							idj_file_to_cat
						SET
							sort = ".$Sort_Incre."
						WHERE
							customers_id = '".$db->escape($this->login->_customerID)."' AND
							f2c_id = '".$db->escape($NewOrder_F)."'
					");
				}	
				
				$Sort_Incre = $Sort_Incre + 10;
			}
			
			
		}
		return $output;
		
	}
	
	function musicNextPrev($Album, $Menu = "Next", $Json = false ,$Count = false)
	{
		global $login, $db;
		$Music_To_Play= '';
		$File['ID'] = '';
		$File['OriginalName'] = '';
		
		if($Json)
		{
			$output['ack'] = 'success';
			$output['Music_Play_Current']['mID'] = '';
			$output['Music_Play_Current']['mExt'] = '';
			$output['f2c_ID'] = '';
		}
		
		/*
		 * $Menu
		 * - Next
		 * - Current
		 * - Prev
		*/
		
		$Album_MusicList = $db->QRY("
			SELECT
				f.file_id,
				f.file_name,
				f2c.f2c_id,
				f2c.last_played
			FROM
				idj_file f,
				idj_file_to_cat f2c
			WHERE
				f2c.album_id = '".$db->escape($Album)."' AND
				f2c.file_id = f.file_id AND
				f.customers_id = '".$db->escape($this->login->_customerID)."'
			ORDER BY
				f2c.sort ASC
		");
		
		if(sizeof($Album_MusicList) > 0)
		{
			foreach($Album_MusicList as $K => $Album_MusicList_F)
			{
				
				if($Album_MusicList_F['last_played'] == 1)
				{
					if($Menu == 'Next' && isset($Album_MusicList[$K + 1])	)
					{
						$index = $K + 1;
						
						break;
					}
					else if($Menu == 'Current')
					{
						$index = $K;
						break;
					}
					else if($Menu == 'Prev')
					{
						if(isset($Album_MusicList[$K - 1]))
						{
							$index = $K - 1;
						}
						else
						{
							$index = sizeof($Album_MusicList) - 1;
						}
						
						break;
					}
				}
				
			}
			
			
			
			
			//[Tim] This code can solve the issue when the last played music column hits the end of the track by forcing assigning the first track as last played.
			if(isset($index))
			{
				$File['ID'] = $Album_MusicList[$index]['file_id'];
				$File['OriginalName'] = $Album_MusicList[$index]['file_name'];
				$File['f2c_ID'] = $Album_MusicList[$index]['f2c_id'];
			}
			else
			{
				$File['ID'] = $Album_MusicList[0]['file_id'];
				$File['OriginalName'] = $Album_MusicList[0]['file_name'];
				$File['f2c_ID'] = $Album_MusicList[0]['f2c_id'];
			}
		
			$F_Info = $this->getExtention($File['OriginalName']);
			$Music_To_Play['mID'] = $File['ID'];
			$Music_To_Play['mExt'] = (!is_null($F_Info['Ext']) ? '.'.$F_Info['Ext']:"");
			
			
			
			$db->QRY("
				UPDATE
					idj_file_to_cat
				SET
					last_played = 0
				WHERE
					album_id = ".$db->escape($Album)."
			");
			
			$db->QRY("
				UPDATE
					idj_file_to_cat
				SET
					last_played = 1
				WHERE
					album_id = ".$db->escape($Album)." AND
					f2c_id = ".$File['f2c_ID']."
			");
			
			if($Json)
			{
				$output['Music_Play_Current']['mID'] = $Music_To_Play['mID'];
				$output['Music_Play_Current']['mExt'] = $Music_To_Play['mExt'];
				$output['f2c_ID'] = $File['f2c_ID'];
			}
			
			if($Count)
				$db->QRY("
					UPDATE
						idj_file
					SET
						played = played + 1
					WHERE
						customers_id = '".$db->escape($this->login->_customerID)."' AND
						file_id = '".$db->escape($File['ID'])."'
				");
		}
		
		
		return ($Json ? $output : $Music_To_Play);
	}
	
}


?>