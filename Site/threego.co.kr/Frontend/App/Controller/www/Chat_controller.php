<?php
class wwwChat_Controller extends GGoRok
{
	protected $Encrypt_Key = '1j)(udhb1b*@7g';

	function generateChatHash($Data = null)
	{
		$output['ack'] = 'error';
		if($this->login->isLogIn())
		{
			if(is_null($Data))
				$Data = $_POST;

			if(isset($Data['cID']))
			{
				$output['ack'] = 'success';
				$output['chathash'] = $this->encryptChatHash($this->generateChatMembersID(explode(":",$Data['cID'])));
				if(isset($_POST['ChatInfo']))
				{
					$output['setting'][$output['chathash']] = $this->getChatSetting(array(
						'Chat_Members_ID' => $Data['cID']
					));
				}
			}
		}
		else
			$output['err_code'] = 1;
		return $output;
	}

	private function encryptChatHash($Chat_Members_ID)
	{
		return $this->crypt->encrypt($Chat_Members_ID,$this->Encrypt_Key);
	}
	private function decryptChatHash($ChatHash)
	{
		//echo $ChatHash;
		return $this->crypt->decrypt($ChatHash,$this->Encrypt_Key);
	}
	function RenewData()
	{
		$output['ack'] = 'error';
		if($this->login->isLogIn() && isset($_POST['args']) && isJson($_POST['args']))
		{
			$output['ack'] = 'success';
			$output['chat'] = array();

			$Model['Chat'] = $this->Load->Model('Chat');

			# Get chat-room-ids of new chats.
			$New_ChatMembers_IDs = $Model['Chat']->getChatMembersID(array(
				'Notified' => 0,
				'customers_id' => $this->login->customers_id
			));

			$openedBox_Info_Temp = json_decode($_POST['args'],TRUE);
			$openedBox_Info = array();
			foreach($openedBox_Info_Temp AS $ChatHash => $Last_ID)
			{
				$openedBox_Info[$this->decryptChatHash($ChatHash)] = $Last_ID;
			}

			foreach($openedBox_Info AS $Opened_Chat_Members_ID => $Last_ID)
			{
				if(!(in_array($Opened_Chat_Members_ID,$New_ChatMembers_IDs)))
				{
					$New_ChatMembers_IDs[] = $Opened_Chat_Members_ID;
				}

			}

			foreach($New_ChatMembers_IDs AS $New_ChatMembers_IDs_F)
			{

				$ChatBoxID = $this->encryptChatHash($New_ChatMembers_IDs_F);
				if(isset($openedBox_Info[$New_ChatMembers_IDs_F]))
				{
					$Request_Form['Last_Chat_ID'] = $openedBox_Info[$New_ChatMembers_IDs_F];
				}
				else
				{
					$Request_Form['Limit'] = 20;
					$output['setting'][$ChatBoxID] = $this->getChatSetting(array('Chat_Members_ID' => $New_ChatMembers_IDs_F));
				}

				$Request_Form['Chat_Members_ID'] = $New_ChatMembers_IDs_F;
				$ChatData = $Model['Chat']->getChat($Request_Form);

				foreach($ChatData AS $K => $ChatData_F)
				{
					# T -> 0 = Me | 1 = Opponent

					$Model['Chat']->SetNotify(array(
						'Chat_Members_ID' => $New_ChatMembers_IDs_F
					));
					$output['chat'][$ChatBoxID][$K]['T'] = ($this->login->customers_id == $ChatData_F['customers_id'] ? 0 : 1);
					$output['chat'][$ChatBoxID][$K]['M'] = $ChatData_F['Message'];
					$output['chat'][$ChatBoxID][$K]['chid'] = $ChatData_F['Chat_ID'];
					$output['chat'][$ChatBoxID][$K]['TS'] = date("h:i A",strtotime($ChatData_F['Message_SentOn']));
				}

			}




		}

		return $output;
	}

	private function getChatSetting($Data)
	{
		$MembersID_arr = explode(':',$Data['Chat_Members_ID']);
		$Model['Business'] = $this->Load->Model('Business');
		$Model['Customer'] = $this->Load->Model('Customer');
		$output['Box']['N'] = NULL;
		$output['Box']['I'] = NULL;
		foreach($MembersID_arr AS $Key => $MembersID_arr_F)
		{
			$MembersID_Devided_Arr = explode("-",$MembersID_arr_F);

			if($this->login->customers_id != $MembersID_Devided_Arr[0])
			{
				$I = null;
				$N = null;

				# Business? Then get the business's info
				if(sizeof($MembersID_Devided_Arr) > 1)
				{

					$Result = $Model['Business']->getStore(array('Store_ID' => $MembersID_Devided_Arr[1]));
					if(sizeof($Result['B']) > 0)
					{
						$I = $MembersID_Devided_Arr[0].'/B/'.$MembersID_Devided_Arr[1].'/MainImg/'.$Result['B'][0]['MainImage'];
						$N = $Result['B'][0]['Store_Name'];
					}
				}
				# Not business? Then get customer's info
				else
				{

					$Result = $Model['Customer']->getCustomerByID(array('customers_id' => $MembersID_Devided_Arr[0]));
					if(sizeof($Result) > 0)
					{
						$I = null;
						$N = $Result[0]['customers_fullname'];
					}
				}

				$output['C'][$this->encryptChatHash($this->generateChatMembersID($MembersID_arr))]['I'] = $I;
				$output['C'][$this->encryptChatHash($this->generateChatMembersID($MembersID_arr))]['N'] = $N;
			}


		}

		if(!isset($output['C']))
		{
			# Me
			$output['Box']['N'] = '';
			$output['Box']['I'] = '';
		}
		else if(sizeof($output['C']) == 1)
		{
			# Only one opponent
			foreach($output['C'] AS $V)
			{
				$output['Box']['N'] = $V['N'];
				$output['Box']['I'] = $V['I'];
			}
		}
		else if(sizeof($output) > 2)
		{
			# Group
			$output['Box']['N'] = '';
			$output['Box']['I'] = '';
		}
		if(isset($OP))
			$output['OP'] = $OP;

		return $output;
	}

	private function generateChatMembersID($_D = array())
	{
		$hasMyID_Already = false;

		# For chat_members_id like customers-businessID
		foreach($_D AS $_D_F)
		{
			$_T = explode('-',$_D_F);
			if($_T[0] == $this->login->customers_id)
				$hasMyID_Already = true;
		}

		if(!$hasMyID_Already)
			$_D[] = $this->login->customers_id;

		$_D = array_unique($_D);

		asort($_D);
		return implode(':',$_D);
	}

	function Send($_D = null)
	{
		$output['ack'] = 'error';
		$Go = true;

		if($this->login->isLogIn())
		{

			if(isset($_D))
			{
				// Go
			}
			else if(isset($_POST['args']) && isJson($_POST['args']))
			{

				$_D_tmp = json_decode($_POST['args'],true);
				if(
					( isset($_D_tmp['chathash']) ) &&
					( isset($_D_tmp['M']) && ($_D_tmp['M'] != "") )
				)
				{
					$ChatMembersID = $this->decryptChatHash($_D_tmp['chathash']);

					$target_customers_ids = explode(":",$ChatMembersID); # For Group Chat

					$_D['Chat_Members_ID'] = $ChatMembersID;
					$_D['customers_id'] = $this->login->customers_id;
					$_D['Message'] = $_D_tmp['M'];
				}
				else
					$Go = false;
			}
			else
			{

				$Go = false;
			}


			if($Go)
			{
				$Model['Chat'] = $this->Load->Model('Chat');
				$Controller['Notification'] = $this->Load->Controller('www/Notification');

				# For Group Chat : Multiple notification
				foreach($target_customers_ids AS $target_customers_ids_F)
				{
					$target_customers_ids_F = explode('-',$target_customers_ids_F)[0];

					if($target_customers_ids_F != $this->login->customers_id)
						$Controller['Notification']->Push(array(
							'customers_id' => $target_customers_ids_F,
							'Notification_Type' => 1 /* Chat */
						));
				}

				$output['chid'] = $Model['Chat']->Send($_D);
				$output['T'] = date("h:i A");
				$output['ack'] = 'success';
			}
		}
		return $output;
	}
}

?>
