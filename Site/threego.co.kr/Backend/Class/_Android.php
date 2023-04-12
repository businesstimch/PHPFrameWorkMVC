<?
class _Android extends GGoRok
{
    function get_AppDevice($customerID, $appType='ceo')
    {
        
        $str_where = '';
        
        $str_sql = "
                SELECT
                    device_type, device_message_id
                FROM app_device
                WHERE device_customers_id = '".$this->db->escape($customerID)."'
                ";
        if($appType == 'ceo')
            $str_where = " AND app_type = '".$this->db->escape($appType)."' ";
        else
            $str_where = " AND app_type != 'ceo' ";
        $ret = $this->db->QRY($str_sql.$str_where);
        return $ret;
    }
    
    function send_AppMessage($customerID, $msg_title, $msg_body, $app_type='ceo')
    {
        $result = 'TEST';
        //return $result;
    
        if($customerID > 0)
        {
            $appList = $this->get_AppDevice($customerID, $app_type);
            
            if(sizeof($appList) > 0)
            {
                $gcmIDs = array();	// Google Cloud Message IDs
                $apnIDs = array();	// Apple Push Notification IDs
            
                foreach($appList as $app_F)
                {
                    if($app_F['device_type'] == 'android')
                    {
                        $gcmIDs[] = $app_F['device_message_id'];
                    }
                    else if ($row['device_type'] == 'ios')
                    {
                        $apnIDs[] = $app_F['device_message_id'];
                    }
                }
                
                //$message = array('title'=>'New Order','message'=>'hello','msgcnt'=>1,'soundname'=>'burugo.mp3');
                $message = array('title'=>$msg_title,'message'=>$msg_body);
                if (sizeof($gcmIDs) > 0)
                {		
                    $ret = $this->send_android_notification($gcmIDs, $message);
                    //$result = $ret['success'];
                    if($ret['success'] > 0)
                        $result = 'success1';
                    else
                        $result = 'error1';
                    
                }
                if (sizeof($apnIDs) > 0)
                {
                    //Send Apple Push Notification here
                }
                
            }
            else
                $result = 'No app list';
            
        }
        else
            $result = 'no customer ID';
        return $result;
    
    }
    
    function Push($registatoin_ids, $message)
    {	
		  // Set POST variables
		  $url = 'https://android.googleapis.com/gcm/send';
		 
		  $headers = array(
			  'Authorization: key=AIzaSyDitAEGOU55axAw9P1WFO0WTWLHJP5tcOI',
			  'Content-Type: application/json'
		  );
		  
		  $fields = array(
			  'registration_ids' => $registatoin_ids,
			  'data' => $message
		  );
		  
		  // Open connection
		  $ch = curl_init();
		  
		  // Set the url, number of POST vars, POST data
		  curl_setopt($ch, CURLOPT_URL, $url);
		  
		  curl_setopt($ch, CURLOPT_POST, true);
		  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		  
		  // Disabling SSL Certificate support temporarly
		  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		  
		  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		  
		  // Execute post
		  $result = curl_exec($ch);
		  if ($result === FALSE) {
			  die('Curl failed: ' . curl_error($ch));
		  }
		  
		  // Close connection
		  curl_close($ch);
		  echo $result;
    }


}
?>