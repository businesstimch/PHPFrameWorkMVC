<?
class WWWPull_Controller extends GGoRok
{
	
	function pull()
	{
		
		
		$output['ack'] = 'error';
		if($this->login->isLogIn())
		{
			$output['ack'] = 'success';
			$Notification = $this->Load->Controller('www/Notification');
			
			$output['ack'] = 'success';
			$New_Notification = false;
			$Max_Loop_Checking = mt_rand(2,5);
			$Current_Loop_Checking = 0;
			
			$output['Pull']['Msg'] = 0;
			$Current_TimeStamp = time();
			
			while(!$New_Notification)
			{
				session_write_close();
				
				
				# Check Notification
				$NewNoti = $Notification->Get(array(
					'customers_id' => $this->login->customers_id
				));
				if(sizeof($NewNoti) > 0)
				{
					
					foreach($NewNoti AS $K => $NewNoti_F)
					{
						$Notifi_Data = array();
						$Notification->Notified(array(
							'customers_id' => $this->login->customers_id,
							'CreatedOn' => $NewNoti_F['CreatedOn']
						));
						
						$output['ntf'][] = array(
							'nT' => $NewNoti_F['Notification_Type']
						);
					}
					break;
				}
				
				
				if($Max_Loop_Checking < $Current_Loop_Checking)
					break;
				
				$Current_Loop_Checking++;
				usleep(mt_rand(4000000,5000000)); # This should be the first line because of timestamp. At least 1 or more seconds is needed to check the time difference.
			}
			
		}
		
		return $output;
	}
}



?>