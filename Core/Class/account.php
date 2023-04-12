<?
class account extends GGoRok
{
	var $customer_ID;
	
	public function __construct()
	{
		global $db;
	}
	
	
	function isDuplicatedUser($email,$sleep = true)
	{
		global $db;
		
		if($sleep)
			sleep(1);
		
		$isDuplicated = $db->QRY("
			SELECT
				customers_id
			FROM
				gc_customers
			WHERE
				customers_logon_id = '".$db->escape($email)."'
		");
		
		if(sizeof($isDuplicated) > 0)
			return true;
		else
			return false;
		
	}
	
	public function registerRequest($Data = null,$Print_ID = false)
	{
		global $db,$login,$crypt,$mail,$_Mail;
		$output['ack'] = 'error';
		$output['html'] = '';
		
		if(is_null($Data))
		{
			
			$Data['Reg_Email'] = $_POST['Reg_Email'];
			$Data['Reg_Pass'] = $_POST['Reg_Pass'];
			$Data['Reg_FName'] = $_POST['Reg_FName'];
			$Data['Reg_LName'] = $_POST['Reg_LName'];
			
		}
		// Check if the user ID is registered user
		if(isset($Data['Reg_Email']) && !$this->isDuplicatedUser($Data['Reg_Email'],false))
		{
			
			if(!verifyEmailAddress($Data['Reg_Email']))
			{
				$output['error_msg'] = 'Please provide a valid email address.';
			}
			else if(!isset($Data['Reg_Pass']) || strlen($Data['Reg_Pass']) < 5 || !(preg_match('/[0-9]/',$Data['Reg_Pass']) && preg_match('/[a-zA-Z]/',$Data['Reg_Pass'])))
			{
				$output['error_msg'] = 'Password length must be at least 6 characters(including numbers) in length.';
			}
			else if(!isset($Data['Reg_FName']) || $Data['Reg_FName'] == "")
			{
				$output['error_msg'] = 'Firstname is required field.';
			}
			else if(!isset($Data['Reg_LName']) || $Data['Reg_LName'] == "")
			{
				$output['error_msg'] = 'Lastname is required field.';
			}
			
			else
			{
				 //Register Now!
				$output['ack'] = 'success';
				
				$verificationCode = $db->escape(md5($Data['Reg_Email']).rand(100000000,999999999).'_'.rand(100000,999999999).'_'.rand(0,99999999999999));
				
				$customerID = $db->QRY("
					INSERT INTO
						gc_customers
						(
							customers_firstname,
							customers_lastname,
							customers_logon_id,
							customers_logon_ps,
							customers_ip_address,
							customers_account_created,
							customers_acocunt_available,
							customers_email_verified,
							customers_email_verification_code
						)
						VALUES
						(
							'".$db->escape($Data['Reg_FName'])."',
							'".$db->escape($Data['Reg_LName'])."',
							'".$db->escape($Data['Reg_Email'])."',
							'".$db->escape($crypt->encryptPassword($Data['Reg_Email'],$Data['Reg_Pass']))."',
							'".$db->escape($_SERVER['REMOTE_ADDR'])."',
							now(),
							1,
							1,
							'".$verificationCode."'
						)
						
				",TRUE);
				
				$MailSetting = $_Mail->Setting();
				$MailSetting['Subject'] = 'Welcome to Janilink';
				$MailSetting['Body_HTML'] = $_Mail->getTemplate('Template_WelcomeRegister_HTML',array($Data['Reg_FName'].' '.$Data['Reg_LName']));
				$MailSetting['Body_Plain'] = $_Mail->getTemplate('Template_WelcomeRegister_PLAIN',array($Data['Reg_FName'].' '.$Data['Reg_LName']));
				$MailSetting['To'] = $Data['Reg_Email'];
						
				$mail->sendGMail($MailSetting);
				
				
				if($Print_ID)
					$output['_customerID'] = $customerID;
			}
	
		}
		else
		{
			$output['error_code'] = 2;
			$output['error_msg'] = '<b>Error</b><br />- The user ID is already taken.';
		   
		}
			
		
		return $output;
	}
	
	public function changePassword($Data)
	{
		global $db,$login,$crypt;
		
		$checkCurrent = $db->QRY("
			SELECT
				customers_id
			FROM
				".DB_Table_Prefix."customers
			WHERE
				customers_logon_id = '".$db->escape($Data['Current']['Email'])."' AND
				customers_logon_ps = '".$db->escape($crypt->encryptPassword($Data['Current']['Email'],$Data['Current']['Password']))."'
				
		");
		
		if(sizeof($checkCurrent) > 0)
		{
			
			$db->QRY("
				UPDATE
					".DB_Table_Prefix."customers
				SET
					customers_logon_ps = '".$db->escape($crypt->encryptPassword($Data['Current']['Email'],$Data['New']['Password']))."'
				WHERE
					customers_logon_id = '".$db->escape($Data['Current']['Email'])."'
			");
			
			return true;
		}
		else
			return false;
		
	}
	
}




?>