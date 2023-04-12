<?php

class CreditCard extends _Extensions
{
	var $_Group = 'Payment';
	var $_Code = 'CreditCard';
	var $_Name = 'Credit Card';
	var $_Icon = '<i class="fa fa-credit-card"></i>';
	var $inExt_DB,$CCs;
	# Check if the extension is installed. Code your own checking algorithm depend on the extension.
	function __construct()
	{
		global $db;
		$this->inExt_DB = parent::isInstalled($this->_Code, $this->_Group);
		$this->CCs[] = 'cc-visa';
		$this->CCs[] = 'cc-master';
		$this->CCs[] = 'cc-amex';
		$this->CCs[] = 'cc-discover';
	}
	function _isInstalled()
	{
		global $db;
		# Describe additional uninstalling process
		
		return (sizeof($this->inExt_DB) == 1 ? true : false);
	}
	function _isActivated()
	{
		global $db;
		return (sizeof($this->inExt_DB) == 1 && $this->inExt_DB[0]['Ext_isActive'] == 1 ? true : false);
	}
	
	# Install Extension
	function _install()
	{
		global $db;
		$output['ack'] = 'error';
		if(!$this->_isInstalled())
		{
			$output = parent::install($this->_Code, $this->_Group);
			# Describe additional installing process
		}
		else
			$output['error_msg'] = 'The extension is already installed, please uninstall it if you want to reinstall.';
		return $output;
	}
	
	function __getCardType($CCNum)
	{

		$CCNum = preg_replace('/[^\d]/','',$CCNum);
		if(preg_match('/^3[47][0-9]{13}$/',$CCNum))
		{
			return 'cc-amex';
		}
		
		else if(preg_match('/^5[1-5][0-9]{14}$/',$CCNum))
		{
			return 'cc-master';
		}
		else if(preg_match('/^4[0-9]{12}(?:[0-9]{3})?$/',$CCNum))
		{
			return 'cc-visa';
		}
		
		else if(preg_match('/^(?:2131|1800|35\d{3})\d{11}$/',$CCNum))
		{
			return 'JCB';
		}
		else if(preg_match('/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/',$CCNum))
		{
			return 'Diners Club';
		}
		else if(preg_match('/^6(?:011|5[0-9][0-9])[0-9]{12}$/',$CCNum))
		{
			return 'cc-discover';
		}
		else
		{
			return 'Unknown';
		}

	}
	function _uninstall()
	{
		global $db;
		$output['ack'] = 'error';
		if($this->_isInstalled())
		{
			$output = parent::uninstall($this->_Code, $this->_Group);
			# Describe additional uninstalling process
		}
		else
			$output['error_msg'] = 'The extension is not installed yet, please refresh the page.';
		return $output;
	}
	
	function _process()
	{
		$output['ack'] = 'error';
		if(
			(isset($_POST['CC_CVV_Inp']) && $_POST['CC_CVV_Inp'] != "") &&
			(isset($_POST['CC_ExpM_Inp']) && $_POST['CC_ExpM_Inp'] != "") &&
			(isset($_POST['CC_ExpY_Inp']) && $_POST['CC_ExpY_Inp'] != "") &&
			(isset($_POST['CC_Name_Inp']) && $_POST['CC_Name_Inp'] != "") &&
			(isset($_POST['CC_Number_Inp']) && $_POST['CC_Number_Inp'] != "") &&
			(isset($_POST['CC_Billing_Street1_Inp']) && $_POST['CC_Billing_Street1_Inp'] != "") &&
			(isset($_POST['CC_Billing_Street2_Inp'])) &&
			(isset($_POST['CC_Billing_City_Inp']) && $_POST['CC_Billing_City_Inp'] != "") &&
			(isset($_POST['CC_Billing_State_Inp']) && $_POST['CC_Billing_State_Inp'] != "") &&
			(isset($_POST['CC_Billing_Zipcode_Inp']) && $_POST['CC_Billing_Zipcode_Inp'] != "")
			
		)
		{
			
			# Check if this modue is installed first
			if(sizeof($this->inExt_DB) > 0)
			{
				$AcceptingCC = array();
				$GivenCCType = $this->__getCardType($_POST['CC_Number_Inp']);
				$AcceptingCC_Arr = json_decode($this->inExt_DB[0]['Ext_Settings'],TRUE);
				foreach($AcceptingCC_Arr AS $K => $AcceptingCC_Arr_F)
				{
					if(in_array($K,$this->CCs) && $AcceptingCC_Arr_F == 1)
					{
						$AcceptingCC[] = $K;
					}
				}
				if(in_array($GivenCCType,$AcceptingCC))
				{
					$output['Paid'] = 0;
					$output['CC_Data'] = array(
						'Number' => $_POST['CC_Number_Inp'],
						'Name' => $_POST['CC_Name_Inp'],
						'ExpM' =>$_POST['CC_ExpM_Inp'],
						'ExpY' =>$_POST['CC_ExpY_Inp'],
						'CVV' =>$_POST['CC_CVV_Inp'],
						'B_S1'=>$_POST['CC_Billing_Street1_Inp'],
						'B_S2'=>$_POST['CC_Billing_Street2_Inp'],
						'B_C'=>$_POST['CC_Billing_City_Inp'],
						'B_S'=>$_POST['CC_Billing_State_Inp'],
						'B_Z'=>$_POST['CC_Billing_Zipcode_Inp']
					);
					$output['ack'] = 'success';
					
				}
				else
				{
					$output['error_msg'] = "We are sorry for inconvenience but we do not accept the credit card type, please try with different card.";
				}
			}
			else
				$output['error_msg'] = 'This payment method does not exist, please refresh this page or contact us.';
		}
		else
			$output['error_msg'] = 'Please fill up all creditcard fields.';
		
		return $output;
	}
	
	function __make_order($Order_ID, $Data)
	{
		global $db;
		
		$output['ack'] = 'success';
		$db->QRY("
			UPDATE
				gc_orders
			SET
				Orders_Ext_Payment_Summary = '".json_encode($Data['CC_Data'])."',
				Orders_Paid = 0
			WHERE
				Orders_ID ='".$Order_ID."'
		");
		
		return $output;
	}
	function _script()
	{
		ob_start();
		?>
		<!--CreditCard Extension-->
		<script type="text/javascript">
			$(document).ready(function(){
				
			});
			function process_payment()
			{
				var output = {};
				
				output['ack'] = true;
				output['args'] = '&Payment_Code=<?echo $this->_Code;?>';
				
				$('.CC_Submit').each(function(){
					if($(this).hasClass("CC_Must_Inp") && $(this).val() == "")
					{
						output['ack'] = false;
						output['error_msg'] = 'There was an error while we were processing payment or please check and try again.<br />';
						return false;
					}
					output['args'] += "&"+$(this).attr('id')+"="+encodeURIComponent($(this).val());
				});
				
				
				return output;
			}
			function verifyCC() {
				
			}
		</script>
		<?
		$Script = ob_get_clean();
		return $Script;
	}
	function __checkout_html()
	{
		if(sizeof($this->inExt_DB) > 0)
		{
			$CC = (isJson($this->inExt_DB[0]['Ext_Settings']) ? json_decode($this->inExt_DB[0]['Ext_Settings'],TRUE) : null);
			$CC_Html = '';
			if(is_array($CC))
			{
				
				if($CC['cc-visa'] == 1)
					$CC_Html .= '<i class="fa fa-cc-visa"></i>';
				if($CC['cc-master'] == 1)
					$CC_Html .= '<i class="fa fa-cc-mastercard"></i>';
				if($CC['cc-amex'] == 1)
					$CC_Html .= '<i class="fa fa-cc-amex"></i>';
				if($CC['cc-discover'] == 1)
					$CC_Html .= '<i class="fa fa-cc-discover"></i>';
				
			}
			
		}
		return '
			<style>
				.WeAccept{font-size:40px;height:40px;}
				.WeAccept i{margin-right:10px;}
			</style>
			<div class="ChkFields">
				<div class="ChkField_T">Credit Card We Accept</div>
				<div class="ChkField_F WeAccept">'.$CC_Html.'</div>
				
				<div class="ChkField_T">Card Number</div>
				<div class="ChkField_F"><input id="CC_Number_Inp" class="CC_Submit CC_Must_Inp one" type="text" value="4111111111111111" /></div>
				
				<div class="ChkField_T">Name on Card</div>
				<div class="ChkField_F"><input id="CC_Name_Inp" class="CC_Submit CC_Must_Inp one" type="text" value="Kim Eun Hee" /></div>
				
				<div class="ChkField_T">Expire Date</div>
				<div class="ChkField_F"><input id="CC_ExpM_Inp" class="CC_Submit CC_Must_Inp two" placeholder="Month(Ex : 06)" type="text" value="06" /><input id="CC_ExpY_Inp" class="CC_Submit CC_Must_Inp two" placeholder="Year(Ex : 2020)" type="text" value="2018" /></div>
				
				<div class="ChkField_T">Security Code (CVV)</div>
				<div class="ChkField_F"><input  id="CC_CVV_Inp"class="CC_Submit CC_Must_Inp one" type="text" value="334" /></div>
				
				<div class="ChkBlock_T" style="margin-top:20px;"><i class="fa fa-credit-card"></i> Billing Address</div>
				
				<div class="ChkField_T">Street Address</div>
				<div class="ChkField_F"><input id="CC_Billing_Street1_Inp" value="3505 Dogwood Hollow LN" class="CC_Submit CC_Must_Inp one" type="text" /></div>
				
				<div class="ChkField_T">Street Address 2 (Optional)</div>
				<div class="ChkField_F"><input id="CC_Billing_Street2_Inp" class="CC_Submit one" type="text" /></div>
				
				<div class="ChkField_T">City</div>
				<div class="ChkField_F"><input id="CC_Billing_City_Inp" value="Lawrenceville" class="CC_Submit CC_Must_Inp one" type="text" /></div>
				
				<div class="ChkField_T">State</div>
				<div class="ChkField_F">
					<select id="CC_Billing_State_Inp" class="one CC_Submit CC_Must_Inp">
						<option value="">- Select State -</option>
						<option value="AL">Alabama</option>
						<option value="AK">Alaska</option>
						<option value="AZ">Arizona</option>
						<option value="AR">Arkansas</option>
						<option value="CA">California</option>
						<option value="CO">Colorado</option>
						<option value="CT">Connecticut</option>
						<option value="DE">Delaware</option>
						<option value="FL">Florida</option>
						<option value="GA" selected="selected">Georgia</option>
						<option value="HI">Hawaii</option>
						<option value="ID">Idaho</option>
						<option value="IL">Illinois</option>
						<option value="IN">Indiana</option>
						<option value="IA">Iowa</option>
						<option value="KS">Kansas</option>
						<option value="KY">Kentucky</option>
						<option value="LA">Louisiana</option>
						<option value="ME">Maine</option>
						<option value="MD">Maryland</option>
						<option value="MA">Massachusetts</option>
						<option value="MI">Michigan</option>
						<option value="MN">Minnesota</option>
						<option value="MS">Mississippi</option>
						<option value="MO">Missouri</option>
						<option value="MT">Montana</option>
						<option value="NE">Nebraska</option>
						<option value="NV">Nevada</option>
						<option value="NH">New Hampshire</option>
						<option value="NJ">New Jersey</option>
						<option value="NM">New Mexico</option>
						<option value="NY">New York</option>
						<option value="NC">North Carolina</option>
						<option value="ND">North Dakota</option>
						<option value="OH">Ohio</option>
						<option value="OK">Oklahoma</option>
						<option value="OR">Oregon</option>
						<option value="PA">Pennsylvania</option>
						<option value="RI">Rhode Island</option>
						<option value="SC">South Carolina</option>
						<option value="SD">South Dakota</option>
						<option value="TN">Tennessee</option>
						<option value="TX">Texas</option>
						<option value="UT">Utah</option>
						<option value="VT">Vermont</option>
						<option value="VA">Virginia</option>
						<option value="WA">Washington</option>
						<option value="WV">West Virginia</option>
						<option value="WI">Wisconsin</option>
						<option value="WY">Wyoming</option>
					</select>
				</div>
				
				<div class="ChkField_T">Zipcode</div>
				<div class="ChkField_F"><input id="CC_Billing_Zipcode_Inp" value="30043" class="CC_Submit CC_Must_Inp one" type="text" /></div>
				
			</div>
		';
	}
	
	function _front_orderInfo($Order)
	{
		global $db, $_Extensions;
		$output['ack'] = 'error';
		$output['html'] = '';
		$P = json_decode($Order['Orders_Ext_Payment_Summary'],TRUE);
		
		$output['html'] .= '
			<div class="T1_Line_One">
				<div class="T1_I">
					'.$this->_Icon.' '.$this->_Name.'
				</div>
			</div>
			<div class="T1_Line_One">
				<div class="T1_T"><span>Payment Information</span></div>
				<div class="T1_I">
					<b>Card Number</b> : '.substr($P['Number'], 0, 4) . str_repeat("x", strlen($P['Number']) - 8) . substr($P['Number'], -4).'<br />
					<b>Name on Card</b> : '.$P['Name'].'<br />
					<b>Expiration Date </b> : '.$P['ExpM'].'/'.$P['ExpY'].'<br />
					<b>CVV </b> : '.substr($P['CVV'], 0, 1) . str_repeat("x", strlen($P['CVV']) - 1).'<br />
					
					
				</div>
			</div>
		';
		
		
		
		
		return $output;
	}
	
	function _admin_orderInfo($Order)
	{
		global $db, $_Extensions;
		$output['ack'] = 'error';
		$output['html'] = '';
		$P = json_decode($Order['Orders_Ext_Payment_Summary'],TRUE);
		
		$output['html'] .= '
			<div class="T1_Line_One">
				<div class="T1_T"><span>Payment Method</span></div>
				<div class="T1_I">
					'.$this->_Icon.' '.$this->_Name.'
				</div>
			</div>
			<div class="T1_Line_One">
				<div class="T1_T"><span>Payment Information</span></div>
				<div class="T1_I">
					<b>Card Number</b> : '.$P['Number'].'<br />
					<b>Name on Card</b> : '.$P['Name'].'<br />
					<b>Expiration Date </b> : '.$P['ExpM'].'/'.$P['ExpY'].'<br />
					<b>CVV </b> : '.$P['CVV'].'<br />
					
					
				</div>
			</div>
		';
		
		
		
		
		return $output;
	}
	function _setting_html()
	{
		global $db, $_Extensions;
		if(sizeof($this->inExt_DB) > 0)
		{
			
			$Data[0] = $this->inExt_DB[0]['Ext_isActive'];
			$Data[1] = (isJson($this->inExt_DB[0]['Ext_Settings']) ? json_decode($this->inExt_DB[0]['Ext_Settings'],TRUE) : null);
		}
		
		return '
			<div class="Ext_Setting_One">
				<div class="Ext_Setting_T">Activate this extension?</div>
				<div class="Ext_Setting_D">
					<div class="Ext_Setting_Check">
						<i class="fa fa-plug"></i> Use<br />
						'.$_Extensions->create_CheckBox('','Activate','De-Activate','activate',1,$Data[0]).'
					</div>
				</div>
				<div class="Ext_Setting_T">What type of creadit card will be accepted?</div>
				<div class="Ext_Setting_D">
					<div class="Ext_Setting_Check">
						<i class="fa fa-cc-visa"></i> Visa<br />
						'.$_Extensions->create_CheckBox('','Activate','De-Activate','cc-visa',1,(isset($Data[1]['cc-visa']) ? $Data[1]['cc-visa'] : '')).'
					</div>
					<div class="Ext_Setting_Check">
						<i class="fa fa-cc-mastercard"></i> Master Card<br />
						'.$_Extensions->create_CheckBox('','Activate','De-Activate','cc-master',1,(isset($Data[1]['cc-master']) ? $Data[1]['cc-master'] : '')).'
					</div>
					<div class="Ext_Setting_Check">
						<i class="fa fa-cc-amex"></i> Amex<br />
						'.$_Extensions->create_CheckBox('','Activate','De-Activate','cc-amex',1,(isset($Data[1]['cc-amex']) ? $Data[1]['cc-amex'] : '')).'
					</div>
					<div class="Ext_Setting_Check">
						<i class="fa fa-cc-discover"></i> Discover<br />
						'.$_Extensions->create_CheckBox('','Activate','De-Activate','cc-discover',1,(isset($Data[1]['cc-discover']) ? $Data[1]['cc-discover'] : '')).'
					</div>
					
				</div>
				<div class="Ext_Setting_Btns">
					<button class="Ext_Setting_Save_Btn">Save</button>
				</div>
			</div>
		';
	}
	
	function _setting_save($Data = null)
	{
		global $db;
		$output['ack'] = 'error';
		if(!is_null($Data))
		{
			$D = json_decode($Data,TRUE);
			
			if(isset($D['activate']) && isset($D['cc-visa']) && isset($D['cc-master']) && isset($D['cc-amex']) && isset($D['cc-discover']))
			{
				$D_Temp = $D;
				unset($D_Temp['activate']);
				$D_Temp = json_encode($D_Temp);
				$db->QRY("
					UPDATE
						gc_extensions
					SET
						Ext_isActive = '".($D['activate'] == 1?1:0)."',
						Ext_Settings = '".$db->escape($D_Temp)."'
					WHERE
						Store_ID = ".__StoreID__." AND
						Ext_Group = '".$this->_Group."' AND
						Ext_Code = '".$this->_Code."'
				");
				$output['ack'] = 'success';
				
			}
			
			
		}
		return $output;
	}
	
	

}
?>