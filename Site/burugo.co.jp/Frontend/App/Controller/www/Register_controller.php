<?

class wwwRegister_Controller extends GGoRok
{
	protected $minimum_PasswordLength = 5;
	
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
				(	!isset($_POST['Reg_FullName_INP']) || $_POST['Reg_FullName_INP'] == ""	)
			)
			{
				//Error
				$output['error_msg'] = '필수항목이 빠져 있습니다. 작성 후 다시 시도해 주세요.';
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
						b_customers
						(
							customers_fullname,
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
							'".$this->db->escape($_POST['Reg_FullName_INP'])."',
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
					<html>
						<head>
							<title>Welcome To Burugo</title>
						</head>
						<body>
						
						<table style="width:100%;">
							<tr>
								<td style="text-align:center;"><img src="http://www.burugo.com/img/mail/welcome-to-burugo-ko.gif" /></td>
							</tr>
							<tr>
								<td style="text-align:center;padding-top:14;padding-bottom:34px;">
									<a href="http://www.burugo.com/register/#auth&authCode='.$verificationCode.'"><img src="http://www.burugo.com/img/mail/welcome-to-burugo-btn-ko.gif" /></a><br /><br />
									If the button does not work,<br />please click below link to complete authentication.<br />
									<a href="http://www.burugo.com/register/#auth&authCode='.$verificationCode.'">Click Here To Authenticate.</a>
								</td>
							</tr>
							</table>
						</body>
					</html>
				';
				//$this->mail->sendMail('info@burugo.com',$_POST['Reg_EmailAddr_INP'],$Mail_Subject,$Mail_headers,$Mail_Message);
				
				
			}
			
		}
		else
			$output['error_msg'] = '이미 등록중인 아이디(이메일) 이거나, 잘못된 형식의 이메일 입니다.';
		
		
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
				b_customers
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