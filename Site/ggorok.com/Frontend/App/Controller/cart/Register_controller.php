<?
class CartRegister_Controller extends GGoRok
{
	function registerBy_PhoneNumber()
	{
		$output['ack'] = 'error';
		
		if(
			isset($_POST['PhoneNumber']) && is_numeric(preg_replace("/[^0-9]/","",$_POST['PhoneNumber']))
		)
		{
			$output['ack'] = 'success';
			
			$PhoneNumber = preg_replace("/[^0-9]/","",$_POST['PhoneNumber']);
			$CInfo = $this->getCustomerIDBy_PhoneNumber($PhoneNumber);
			$Reg_Code = $this->generate4digits();
			if(sizeof($CInfo) > 0)
			{
				$this->db->QRY("
					UPDATE
						".DB_Table_Prefix."customers
					SET
						customers_reg_code = '".$Reg_Code."'
					WHERE
						customers_id = '".$CInfo[0]['customers_id']."'
				");
				$output['reg_code'] = $Reg_Code;
			}
			else
			{
				$this->db->QRY("
					INSERT INTO
						".DB_Table_Prefix."customers
						(
							customers_telephone,
							customers_reg_code
						)
						VALUES
						(
							'".$this->db->escape($_POST['PhoneNumber'])."',
							'".$Reg_Code."'
						)
				");
				$output['reg_code'] = $Reg_Code;
			}
			
		}
		
		return $output;
		
	}
	
	function generate4digits()
	{
		return rand(1000,9999);
	}
	
	function getCustomerIDBy_PhoneNumber($PhoneNumber)
	{
		return $this->db->QRY("
			SELECT
				*
			FROM
				".DB_Table_Prefix."customers
			WHERE
				customers_telephone = ".$this->db->escape($PhoneNumber)."
			LIMIT
				1
		");
		
	}
	function registerRequest()
	{
		$output['ack'] = 'error';

		// Check if the user ID is registered user
		if(isset($_POST['Reg_EmailAddr_INP']) && !$this->isDuplicatedUser($_POST['Reg_EmailAddr_INP'],false))
		{
			
			if(
				(	!isset($_POST['Reg_EmailAddr_INP']) 	) ||
				(	!isset($_POST['Reg_Pass_INP']) ) ||
				
				(	(!isset($_POST['Reg_FullName_INP']) || $_POST['Reg_FullName_INP'] == "") && ( !isset($_POST['Reg_FirstName_INP']) || !isset($_POST['Reg_LastName_INP']) )	) ||
				
				(	(!isset($_POST['Reg_FirstName_INP']) || $_POST['Reg_FirstName_INP'] == "") || (!isset($_POST['Reg_LastName_INP']) || $_POST['Reg_LastName_INP'] == "") && (!isset($_POST['Reg_FullName_INP']) ))
			)
			{
				//Error
				$output['error_msg'] = 'Please fill up the all required fields.';
			}
			else if(strlen($_POST['Reg_Pass_INP']) < $this->minimum_PasswordLength || !(preg_match('/[0-9]/',$_POST['Reg_Pass_INP']) && preg_match('/[a-zA-Z]/',$_POST['Reg_Pass_INP']))	)
			{
				$output['error_msg'] = '<i class="fa fa-info-circle"></i> 비밀번호는 최소 '.$this->minimum_PasswordLength.'자 이상의 영,숫자 조합으로 해주세요.';
			}
			else if(!verifyEmailAddress($_POST['Reg_EmailAddr_INP']))
			{
				$output['error_msg'] = '이메일 형식이 맞지 않습니다.';
			}
			else
			{
				 //Register Now!
				$output['ack'] = 'success';
				
				$verificationCode = $this->db->escape(md5($_POST['Reg_EmailAddr_INP']).rand(100000000,999999999).'_'.rand(100000,999999999).'_'.rand(0,99999999999999));
				
				$this->db->QRY("
					INSERT INTO
						".DB_Table_Prefix."customers
						(
							".(isset($_POST['Reg_FullName_INP']) ? 'customers_fullname,' : 'customers_firstname, customers_lastname,')."
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
							".(isset($_POST['Reg_FullName_INP']) ? "'".$this->db->escape($_POST['Reg_FullName_INP'])."'," : "'".$this->db->escape($_POST['Reg_FirstName_INP'])."','".$this->db->escape($_POST['Reg_LastName_INP'])."',")."
							'".$this->db->escape($_POST['Reg_EmailAddr_INP'])."',
							'".$this->db->escape($this->crypt->encryptPassword($_POST['Reg_EmailAddr_INP'],$_POST['Reg_Pass_INP']))."',
							'".$this->db->escape($_SERVER['REMOTE_ADDR'])."',
							now(),
							1,
							1,
							'".$this->db->escape($verificationCode)."'
						)
						
				");
				
				
				if(_SubDomain_ == 'ceo') // This is required because, on CEO page, registering new business should be comes up after registering.
					$this->login->do_LogIn($_POST['Reg_EmailAddr_INP'],$_POST['Reg_Pass_INP'],null,true);
				
				$Mail_Subject = '[Authentication Mail] Welcome To Burugo!';
				$Mail_headers  = 'MIME-Version: 1.0' . "\r\n";
				$Mail_headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
				$Mail_headers .= 'From: Burugo.com <info@burugo.com>' . "\r\n";
				$Mail_Message = '
					
				';
				//$this->mail->sendMail('info@burugo.com',$_POST['Reg_EmailAddr_INP'],$Mail_Subject,$Mail_headers,$Mail_Message);
				
				
			}
			
		}
		else
			$output['error_msg'] = 'The email address is already in use.';
		
		
		return $output;
	}
	
	protected function isDuplicatedUser($email,$sleep = true)
	{
	
		if($sleep)
			sleep(1);
		
		$isDuplicated = $this->db->QRY("
			SELECT
				customers_id
			FROM
				".DB_Table_Prefix."customers
			WHERE
				customers_logon_id = '".$this->db->escape($email)."'
		");
		
		if(sizeof($isDuplicated) > 0)
			return true;
		else
			return false;
		
	}
}

?>