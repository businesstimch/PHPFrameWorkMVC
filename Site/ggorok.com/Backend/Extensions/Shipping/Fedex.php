<?php
require_once('library/fedex-common.php');
loadClass('crypt');
class Fedex extends _Extensions
{
	var $_Group = 'Shipping';
	var $_Code = 'Fedex';
	var $_Name = 'Fedex';
	var $_Icon = '<i class="fa fa-truck"></i>';
	var $_EncryptSalt = 'DqSqI@(I901';
	var $inExt_DB;
	var $FedexAcc_Info;
	# Check if the extension is installed. Code your own checking algorithm depend on the extension.
	function __construct()
	{
		$this->inExt_DB = parent::isInstalled($this->_Code, $this->_Group);
		
		$this->FedexAcc_Info['key'] = 'vySzOeDtNnpSNZln'; 
		$this->FedexAcc_Info['password'] ='1oK2KoNGgD3RAZiHj5Qk3AZbD'; 
		$this->FedexAcc_Info['shipaccount'] = '248016477';
		$this->FedexAcc_Info['billaccount'] = '248016477'; 
		$this->FedexAcc_Info['freightaccount'] = '6PdOvA8sm8KWP0Gf';  
		$this->FedexAcc_Info['meter'] ='107882239';
		
	}
	function _isInstalled()
	{
		# Describe additional uninstalling process
		
		return (sizeof($this->inExt_DB) == 1 ? true : false);
	}
	function _isActivated()
	{
		return (sizeof($this->inExt_DB) == 1 && $this->inExt_DB[0]['Ext_isActive'] == 1 ? true : false);
	}
	
	# Install Extension
	function _install()
	{
		$output['ack'] = 'error';
		if(!$this->_isInstalled())
		{
			$output = parent::install($this->_Code, $this->_Group);
			# Code additional installing process ::
			if($output['ack'] == 'success')
			{
				
			}
			
			# Code additional installing process ;;
		}
		else
			$output['error_msg'] = 'The extension is already installed, please uninstall it if you want to reinstall.';
		return $output;
	}
	
	function _uninstall()
	{
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
	
	function __getEditedServiceName($Key)
	{
		$Name_Arr = array(
			/*'EUROPE_FIRST_INTERNATIONAL_PRIORITY' => '',*/
			'FEDEX_1_DAY_FREIGHT' => '1 Day Freight',
			'FEDEX_2_DAY' => '2 Day',
			'FEDEX_2_DAY_AM' => '2 Day Freight AM',
			'FEDEX_2_DAY_FREIGHT' => '2 Day Freight',
			'FEDEX_3_DAY_FREIGHT' => '3 Day Freight',
			'FEDEX_DISTANCE_DEFERRED' => 'Distance Deferred',
			'FEDEX_EXPRESS_SAVER' => 'Express Saver',
			'FEDEX_FIRST_FREIGHT' => 'First Freight',
			'FEDEX_FREIGHT_ECONOMY' => 'Freight Economy',
			'FEDEX_FREIGHT_PRIORITY' => 'Freight Priority',
			'FEDEX_GROUND' => 'Ground',
			'FEDEX_NEXT_DAY_AFTERNOON' => 'Next Day Afternoon',
			'FEDEX_NEXT_DAY_EARLY_MORNING' => 'Next Day Early Morning',
			'FEDEX_NEXT_DAY_END_OF_DAY' => 'Next Day End Of Day',
			/*'FEDEX_NEXT_DAY_FREIGHT' => 'Next Day Freight',*/
			'FEDEX_NEXT_DAY_MID_MORNING' => 'Next Day Mid Morning',
			'FIRST_OVERNIGHT' => 'First Overnight',
			'GROUND_HOME_DELIVERY' => 'Ground Home Delivery',
			/*'INTERNATIONAL_ECONOMY' => 'International Economy',
			'INTERNATIONAL_ECONOMY_FREIGHT' => 'International Economy Freight',
			'INTERNATIONAL_FIRST ' => 'International First',
			'INTERNATIONAL_PRIORITY' => 'International Priority',
			'INTERNATIONAL_PRIORITY_FREIGHT' => 'International Freight',*/
			'PRIORITY_OVERNIGHT' => 'Priority Overnight',
			/*'SAME_DAY' => 'Same Day',
			'SAME_DAY_CITY' => 'Same Day City',*/
			'SMART_POST' => 'Smart Post',
			'STANDARD_OVERNIGHT' => 'Standard Overnight'
		);
		
		return (isset($Name_Arr[$Key]) ? $Name_Arr[$Key] : 'Shipping');
	}
	function _script()
	{
		ob_start();
		?>
		<!--Fedex Extension-->
		<script type="text/javascript">
			$(document).ready(function(){
				
				
				$(document).on("change",".FedexShipQuoteSelect_Inp",function(){
					var P_S = process_shipping();
					process(P_S['args']);
					/*
					$.ajax({
						type: "POST",
						url: "/checkout/process/?ajaxProcess",
						data: "menu=process&Shipping_Code=<?echo $this->_Code;?>&Fedex_Data="+encodeURIComponent(ShippingInfo),
						success: function(d){
							
							var res = $.parseJSON(d);
							if(res.ack == 'success')
							{
								$('#Summary_Block').html(res.html);
							}
							else
							{
								showSideMSGBox(res.error_msg,'msgBox_One_2');
							}
						}
					});
					
					*/
				});
				$(document).on(touchOrClick,".FedexQuote_One",function(){
					$(this).find('input').prop("checked",true).trigger("change");
				});
				$(document).on(touchOrClick,"#Fedex_ShippingQuote_Btn",function(){
					$('#Fedex_ShippingQuote_List').html('<i class="fa fa-spinner fa-spin"></i> Loading Shipping Quote ...');
					var Argv = '';
					$('.Fedex_Submit_Inp').each(function(){
						Argv += '&'+$(this).prop('id')+'='+encodeURIComponent($(this).val());
					});
					$.ajax({
						type: "POST",
						url: "/checkout/process/?ajaxProcess",
						data: "menu=Get_SPQuote&Code=<?echo $this->_Code;?>"+Argv,
						success: function(d){
							
							var res = $.parseJSON(d);
							if(res.ack == 'success')
							{
								$('#Fedex_ShippingQuote_List').html(res.html);
							}
							else
							{
								showSideMSGBox(res.error_msg,'msgBox_One_2');
								$('#Fedex_ShippingQuote_List').html('<i class="fa fa-exclamation-triangle"></i> '+res.error_msg);
							}
						}
					});
				});
				
			});
			
			function process_shipping()
			{
				var output = {};
				
				output['ack'] = true;
				output['args'] = '';
				console.log('Process : Fedex');
				if($(".FedexShipQuoteSelect_Inp:checked").length > 0)
				{
					var ShippingInfo = $(".FedexShipQuoteSelect_Inp:checked").parents('.FedexQuote_One').data('val');
					
					output['args'] += '&Shipping_Code=<?echo $this->_Code;?>&Fedex_Data='+encodeURIComponent(ShippingInfo);
				}
				else
				{
					output['error_msg'] = 'There was an error while we were processing shipping or Please select a shipping method.<br />';
					output['ack'] = false;
				}
				
				return output;
			}
		</script>
		<?
		$Script = ob_get_clean();
		return $Script;
	}
	function __checkout_html()
	{
		return '
			<style>
				#Fedex_ShippingQuote_Btn i{margin-left:7px;}
				#Fedex_ShippingQuote_List{line-height:35px;}
				
				.FedexQuote_One{width:100%;background-color:#efefef;border-radius:5px;margin-top:10px;box-sizing:border-box;border:1px solid #e1e1e1;cursor:pointer;}
				.FedexQuote_One:hover{background-color:#e1e1e1;border:1px solid #d1d1d1;}
				
				.FedexQuote_One .FQO_Name{width:200px;box-sizing:border-box;padding-left:5px;}
				.FedexQuote_One .FQO_Price{width:100px;float:right;font-weight:bold;}
				.FedexQuote_One .FQO_Time{}
				
			</style>
			<div class="ChkSaved_List">
								
			</div>
			<div class="ChkFields">
				<div class="ChkField_T">Street Address</div>
				<div class="ChkField_F"><input id="Fedex_Street1_Inp" value="3505 Dogwood Hollow LN" class="Fedex_Submit_Inp one" id="Fedex_Street_Inp" type="text" /></div>
				
				<div class="ChkField_T">Street Address 2 (Optional)</div>
				<div class="ChkField_F"><input id="Fedex_Street2_Inp" class="Fedex_Submit_Inp one" type="text" /></div>
				
				<div class="ChkField_T">City</div>
				<div class="ChkField_F"><input id="Fedex_City_Inp" value="Lawrenceville" class="Fedex_Submit_Inp one" type="text" /></div>
				
				<div class="ChkField_T">State</div>
				<div class="ChkField_F">
					<select id="Fedex_State_Inp" class="one Fedex_Submit_Inp">
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
				<div class="ChkField_F"><input id="Fedex_Zipcode_Inp" value="30043" class="Fedex_Submit_Inp one" type="text" /></div>
				
				<div class="ChkField_T">Recipient Name</div>
				<div class="ChkField_F"><input id="Fedex_RcpNameF_Inp" class="Fedex_Submit_Inp two" placeholder="First Name" type="text" /><input id="Fedex_RcpNameL_Inp" class="Fedex_Submit_Inp two" placeholder="Last Name" type="text" /></div>
				
				<div class="w100"><button class="Button_1 Button_Blue" id="Fedex_ShippingQuote_Btn">Get Shipping Quote</button></div>
				<div id="Fedex_ShippingQuote_List"></div>
			</div>
		';
	}
	
	function __getShippingQuote($Argv = null)
	{
		
		$output['ack'] = 'error';
		
		if(
			(isset($_POST['Fedex_Street1_Inp']) && $_POST['Fedex_Street1_Inp'] != "") &&
			(isset($_POST['Fedex_Street2_Inp'])) &&
			(isset($_POST['Fedex_RcpNameF_Inp'])) &&
			(isset($_POST['Fedex_RcpNameL_Inp'])) &&
			(isset($_POST['Fedex_City_Inp']) && $_POST['Fedex_City_Inp'] != "") &&
			(isset($_POST['Fedex_Zipcode_Inp']) && $_POST['Fedex_Street1_Inp'] != "") &&
			(isset($_POST['Fedex_State_Inp']) && $_POST['Fedex_State_Inp'] != "")
		)
		{
			$Cart = $this->_Cart->getInfo();
			
			# Check if there is item in cart or Error?
			if($Cart['Cart_Qty'] > 0)
			{
				ini_set("soap.wsdl_cache_enabled", "0");
				$path_to_wsdl = __BackendPath__."Extensions/Shipping/library/RateService_v16.wsdl";
				$client = new SoapClient($path_to_wsdl, array('trace' => 1));
				$request['WebAuthenticationDetail'] = array(
					'UserCredential' => array(
						'Key' => $this->FedexAcc_Info['key'],
						'Password' => $this->FedexAcc_Info['password'],
					)
				); 
				$request['ClientDetail'] = array(
					'AccountNumber' => $this->FedexAcc_Info['shipaccount'], 
					'MeterNumber' => $this->FedexAcc_Info['meter']
				);
				$request['TransactionDetail'] = array('CustomerTransactionId' => ' *** Rate Available Services Request using PHP ***');
				$request['Version'] = array(
					'ServiceId' => 'crs', 
					'Major' => '16', 
					'Intermediate' => '0', 
					'Minor' => '0'
				);
				$request['ReturnTransitAndCommit'] = true;
				$request['RequestedShipment']['DropoffType'] = 'REGULAR_PICKUP'; // valid values REGULAR_PICKUP, REQUEST_COURIER, ...
				$request['RequestedShipment']['ShipTimestamp'] = date('c');
				// Service Type and Packaging Type are not passed in the request
				$request['RequestedShipment']['Shipper'] = array(
					'Address'=>
						array(
							'StreetLines' => array('3545 McCall Place'),
							'City' => 'Doraville',
							'StateOrProvinceCode' => 'GA',
							'PostalCode' => '30340',
							'CountryCode' => 'US'
						)
				);
				$request['RequestedShipment']['Recipient'] = array(
					'Address'=>
						array(
							'StreetLines' => array(urldecode($_POST['Fedex_Street1_Inp'])),
							'City' => urldecode($_POST['Fedex_City_Inp']),
							'StateOrProvinceCode' => urldecode($_POST['Fedex_State_Inp']),
							'PostalCode' => urldecode($_POST['Fedex_Zipcode_Inp']),
							'CountryCode' => 'US'
						)
				);
				$request['RequestedShipment']['ShippingChargesPayment'] = array(
					'PaymentType' => 'SENDER',
					'Payor' => array(
						'ResponsibleParty' => array(
							'AccountNumber' => $this->FedexAcc_Info['billaccount'],
							'Contact' => null,
							'Address' => array(
								'CountryCode' => 'US'
							)
						)
					)
				);																
				$request['RequestedShipment']['PackageCount'] = '2';
				$request['RequestedShipment']['RequestedPackageLineItems'] = array(
					'0' => array(
						'SequenceNumber' => 1,
						'GroupPackageCount' => 1,
						'Weight' => array(
							'Value' => 2.0,
							'Units' => 'LB'
						),
						'Dimensions' => array(
							'Length' => 10,
							'Width' => 10,
							'Height' => 3,
							'Units' => 'IN'
						)
					),
					'1' => array(
						'SequenceNumber' => 2,
						'GroupPackageCount' => 1,
						'Weight' => array(
							'Value' => 5.0,
							'Units' => 'LB'
						),
						'Dimensions' => array(
							'Length' => 20,
							'Width' => 20,
							'Height' => 10,
							'Units' => 'IN'
						 )
					)
				);
				
				try
				{
					
					# Send to server AND get response
					$response = $client->getRates($request);
					$output['html'] = '';
					# No Error?
					if ($response -> HighestSeverity != 'FAILURE' && $response -> HighestSeverity != 'ERROR')
					{
						$output['ack'] = 'success';
						//echo print_r($response);
						
						if(isset($response->RateReplyDetails) && is_array($response->RateReplyDetails))
						{
							
							foreach($response->RateReplyDetails as $rateReply)
							{
								$R['Name'] = $this->__getEditedServiceName($rateReply -> ServiceType);
								$R['Price'] = number_format($rateReply->RatedShipmentDetails->ShipmentRateDetail->TotalNetCharge->Amount,2,".",",");
								$R['Data'] = $this->crypt->encrypt(json_encode(array(
									'N' => $R['Name'],
									'P' => $R['Price'],
									'S1' => $_POST['Fedex_Street1_Inp'],
									'S2' => $_POST['Fedex_Street2_Inp'],
									'C' => $_POST['Fedex_City_Inp'],
									'Z' => $_POST['Fedex_Zipcode_Inp'],
									'S' => $_POST['Fedex_State_Inp'],
									'RF' => $_POST['Fedex_RcpNameF_Inp'],
									'RL' => $_POST['Fedex_RcpNameL_Inp']
								)),$this->_EncryptSalt);
								
								$output['html'] .= '
									<div class="FedexQuote_One" data-val="'.$R['Data'].'">
										<div class="FQO_Name"><input class="FedexShipQuoteSelect_Inp" name="FedexShipQuoteSelect_Inp" type="radio" /> '.$R['Name'].'</div>	
										<div class="FQO_Price">$'.$R['Price'].'</div>
										
									</div>
								';
								#<div class="FQO_Time">'.(array_key_exists('DeliveryTimestamp',$rateReply)?$rateReply->DeliveryTimestamp:$rateReply->TransitTime).'</div>
								
							}
						}
						else if(isset($response -> RateReplyDetails))
						{
							$R['Name'] = $this->__getEditedServiceName($response -> RateReplyDetails -> ServiceType);
							$R['Price'] = number_format($response -> RateReplyDetails->RatedShipmentDetails->ShipmentRateDetail->TotalNetCharge->Amount,2,".",",");
							$R['Data'] = $this->crypt->encrypt(json_encode(array(
								$R['Name'],
								$R['Price'],
								$_POST['Fedex_Street1_Inp'],
								$_POST['Fedex_City_Inp'],
								$_POST['Fedex_Zipcode_Inp'],
								$_POST['Fedex_State_Inp']
							)),$this->_EncryptSalt);
							
							$output['html'] .= '
								<div class="FedexQuote_One" data-val="'.$R['Data'].'">
									<div class="FQO_Name"><input class="FedexShipQuoteSelect_Inp" name="FedexShipQuoteSelect_Inp" type="radio" /> '.$R['Name'].'</div>
									<div class="FQO_Price">$'.$R['Price'].'</div>
									
								</div>';
							#<div>'.(array_key_exists('DeliveryTimestamp',$response -> RateReplyDetails) ? $response -> RateReplyDetails->DeliveryTimestamp : $response -> RateReplyDetails->TransitTime ).'</div>
						}
						else if($response -> HighestSeverity == 'WARNING' && isset($response->Notifications->Message))
						{
							$output['ack'] = 'error';
							$output['error_msg'] = $response->Notifications->Message;
							
						}
						
						
						
						
					}
					else
					{
						$output['error_msg'] = 'Please fill in all address fields or check address again.';
					}
					
					
				}
				catch (SoapFault $exception)
				{
					printFault($exception, $client);
				}
			}
			else
				$output['error_msg'] = 'Your cart is empty.';
		}
		else
			$output['error_msg'] = 'Please check shipping address and try again.';
		return $output;
	}
	
	
	
	function printRateReplyDetails($rateReply)
	{
		echo '<tr>';
		$serviceType = '<td>'.$rateReply -> ServiceType . '</td>';
		
		$amount = '<td>$' . number_format($rateReply->RatedShipmentDetails->ShipmentRateDetail->TotalNetCharge->Amount,2,".",",") . '</td>';
		if(array_key_exists('DeliveryTimestamp',$rateReply)){
			$deliveryDate= '<td>' . $rateReply->DeliveryTimestamp . '</td>';
		}else{
			$deliveryDate= '<td>' . $rateReply->TransitTime . '</td>';
		}
		echo $serviceType . $amount. $deliveryDate;
		echo '</tr>';
	}
	
	function _process($Data = null)
	{
		# Should return price amount
		$output['ack'] = 'error';
		
		$Decrypted = json_decode($this->crypt->decrypt($_POST['Fedex_Data'],$this->_EncryptSalt),TRUE);
		if(is_array($Decrypted))
		{
			$output['isTaxable'] = false;
			if($this->_Setting->Data['General']['TaxState'] == $Decrypted['S'])
				$output['isTaxable'] = true;
			$output['SHCost'] = $Decrypted['P'];
			$output['Fedex_Data'] = $Decrypted;
			$output['ack'] = 'success';
		}
		
		
		return $output;
	}
	function __make_order($Order_ID, $Data)
	{
		
		$output['ack'] = 'success';
		$this->db->QRY("
			UPDATE
				gc_orders
			SET
				Orders_Ext_Shipping_Summary = '".json_encode($Data['Fedex_Data'])."'
			WHERE
				Orders_ID ='".$Order_ID."'
		");
		
		return $output;
	}
	function _setting_html()
	{

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
						'.$this->_Extensions->create_CheckBox('','Activate','De-Activate','activate',1,$Data[0]).'
					</div>
				</div>
				<div class="Ext_Setting_T">What type of creadit card will be accepted?</div>
				<div class="Ext_Setting_D">
					<div class="Ext_Setting_Check">
						<i class="fa fa-cc-visa"></i> Visa<br />
						'.$this->_Extensions->create_CheckBox('','Activate','De-Activate','cc-visa',1,(isset($Data[1]['cc-visa']) ? $Data[1]['cc-visa'] : '')).'
					</div>
					<div class="Ext_Setting_Check">
						<i class="fa fa-cc-mastercard"></i> Master Card<br />
						'.$this->_Extensions->create_CheckBox('','Activate','De-Activate','cc-master',1,(isset($Data[1]['cc-master']) ? $Data[1]['cc-master'] : '')).'
					</div>
					<div class="Ext_Setting_Check">
						<i class="fa fa-cc-amex"></i> Amex<br />
						'.$this->_Extensions->create_CheckBox('','Activate','De-Activate','cc-amex',1,(isset($Data[1]['cc-amex']) ? $Data[1]['cc-amex'] : '')).'
					</div>
					<div class="Ext_Setting_Check">
						<i class="fa fa-cc-discover"></i> Discover<br />
						'.$this->_Extensions->create_CheckBox('','Activate','De-Activate','cc-discover',1,(isset($Data[1]['cc-discover']) ? $Data[1]['cc-discover'] : '')).'
					</div>
					
				</div>
				<div class="Ext_Setting_Btns">
					<button class="Ext_Setting_Save_Btn">Save</button>
				</div>
			</div>
		';
	}
	
	function _front_orderInfo($Order)
	{

		$output['ack'] = 'error';
		$output['html'] = '';
		$D = json_decode($Order['Orders_Ext_Shipping_Summary'],TRUE);
		//{"N":"Ground","P":"14.87","S1":"3505 Dogwood Hollow LN","S2":"","C":"Lawrenceville","Z":"30043","S":"GA","RF":"","RL":""}
		$output['html'] .= '
			<div class="T1_Line_One">
				<div class="T1_I">
					'.$this->_Icon.' '.$this->_Name.'
				</div>
			</div>
			<div class="T1_Line_One">
				<div class="T1_T"><span>Payment Information</span></div>
				<div class="T1_I">
					<b>Selected Shipping</b> : '.$D['N'].'<br />
					<b>Street Addr</b> : '.$D['S1'].'<br />
					<b>Street Addr 2</b> : '.$D['S2'].'<br />
					<b>City</b> : '.$D['C'].'<br />
					<b>Zipcode</b> : '.$D['Z'].'<br />
					<b>State</b> : '.$D['S'].'<br />
					<b>Recipient Name</b> : '.$D['RF'].' '.$D['RL'].'<br />
					<b>Cost</b> : $'.$D['P'].'<br />
					
					
					
				</div>
			</div>
		';
		
		return $output;
	}
	
	function _admin_orderInfo($Order)
	{
		
		$output['ack'] = 'error';
		$output['html'] = '';
		$D = json_decode($Order['Orders_Ext_Shipping_Summary'],TRUE);
		//{"N":"Ground","P":"14.87","S1":"3505 Dogwood Hollow LN","S2":"","C":"Lawrenceville","Z":"30043","S":"GA","RF":"","RL":""}
		$output['html'] .= '
			<div class="T1_Line_One">
				<div class="T1_T"><span>Shipping Method</span></div>
				<div class="T1_I">
					'.$this->_Icon.' '.$this->_Name.'
				</div>
			</div>
			<div class="T1_Line_One">
				<div class="T1_T"><span>Payment Information</span></div>
				<div class="T1_I">
					<b>Selected Shipping</b> : '.$D['N'].'<br />
					<b>Street Address</b> : '.$D['S1'].'<br />
					<b>Street Address 2</b> : '.$D['S2'].'<br />
					<b>City</b> : '.$D['C'].'<br />
					<b>Zipcode</b> : '.$D['Z'].'<br />
					<b>State</b> : '.$D['S'].'<br />
					<b>Recipient Name</b> : '.$D['RF'].' '.$D['RL'].'<br />
					<b>Cost</b> : $'.$D['P'].'<br />
					
					
					
				</div>
			</div>
		';
		
		
		
		
		return $output;
	}
	
	function _setting_save($Data = null)
	{
		$output['ack'] = 'error';
		if(!is_null($Data))
		{
			$D = json_decode($Data,TRUE);
			
			if(isset($D['activate']) && isset($D['cc-visa']) && isset($D['cc-master']) && isset($D['cc-amex']) && isset($D['cc-discover']))
			{
				
				
				$D_Temp = $D;
				unset($D_Temp['activate']);
				$D_Temp = json_encode($D_Temp);
				$this->db->QRY("
					UPDATE
						gc_extensions
					SET
						Ext_isActive = '".($D['activate'] == 1?1:0)."',
						Ext_Settings = '".$this->db->escape($D_Temp)."'
				");
				$output['ack'] = 'success';
				
			}
			
			
		}
		return $output;
	}
	
	

}
?>