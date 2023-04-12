<?php

class CartCorpCatalogProductOptionsAdd_Controller extends GGoRok
{
	var $_isAdminPage = true;
	function home()
	{
		$Data['title'] = 'Add Product Options | GGoRok Cart';
		$Data['metaK'] = 'GGoRok';
		$Data['metaD'] = 'GGoRok';
		
		$Data['MAIN_HTML'] = $this->Load->View('cart/corp/catalog/product-options/addmod-fields.tpl', array(
			'Title_Text' => 'Add Option Group Template',
			'optionGroupModAdd_HTML' => $this->optionGroupModAdd_HTML()['html'],
			'AjaxURL' => __AdminPath__.'catalog/product-options/add?ajaxProcess'
			
		));
		
		$Home_Controller = $this->Load->Controller('cart/corp/home');
		echo $Home_Controller->loadHeader($Data);
	}
	
	function saveOptionTemplate()
	{
		$output['ack'] = 'error';
		$Go = true;
		
		
		# Check : Group Name
		if(!isset($_POST["OptGrp_Name_OptINP"]) || (isset($_POST["OptGrp_Name_OptINP"]) && $_POST["OptGrp_Name_OptINP"] == ""))
		{
			$Go = false;
			$output['error_msg'] = "Option Group Name is required field.";
		}
		# Check : Option Gorup Type
		else if(!isset($_POST["OptGrp_Type_ID_OptINP"]) || (isset($_POST["OptGrp_Type_ID_OptINP"]) && !is_numeric($_POST["OptGrp_Type_ID_OptINP"])))
		{
			$Go = false;
			$output['error_msg'] = "Option Group Type is required field.";
		}
		# Check : Options
		else if(!isset($_POST['OptGrp_SubOption_OptINP']) || (isset($_POST["OptGrp_SubOption_OptINP"]) && $_POST["OptGrp_SubOption_OptINP"] == "") || sizeof(json_decode($_POST['OptGrp_SubOption_OptINP'],true)) == 0)
		{
			$Go = false;
			$output['error_msg'] = "At least one option is required.";
		}
		
		# If NO Error
		if($Go)
		{
			
			
			
			$output['ack'] = 'success';
			# Parse Option Data
			$SubOptions = json_decode($_POST['OptGrp_SubOption_OptINP'],true);
				
			if(isset($_POST['OptGrp_ID_OptINP']) && is_numeric($_POST['OptGrp_ID_OptINP']))
			{
				$OptGrp_ID = $this->db->escape($_POST['OptGrp_ID_OptINP']);
				$this->db->QRY("
					UPDATE
						gc_products_option_group
					SET
						OptGrp_Type_ID = '".$this->db->escape($_POST["OptGrp_Type_ID_OptINP"])."',
						OptGrp_Name = '".$this->db->escape($_POST["OptGrp_Name_OptINP"])."'
					WHERE
						isTemplate = 1 AND
						Store_ID = '".__StoreID__."' AND
						OptGrp_ID = '".$OptGrp_ID."'
				");
				
				
				foreach($SubOptions as $K => $SubOptions_F)
				{
					if($SubOptions_F[0] != "" && is_numeric($SubOptions_F[0]))
					{
						$SubOpt_QRY = "
							UPDATE
								gc_products_option_group_item
							SET
								Opt_Name = '".$this->db->escape($SubOptions_F[1])."',
								Opt_Price = '".$this->db->escape(floatval($SubOptions_F[2]))."',
								Opt_Operand = '".$this->db->escape($SubOptions_F[3])."'
							WHERE
								OptGrp_ID = ".$OptGrp_ID." AND
								Opt_ID = '".$this->db->escape($SubOptions_F[0])."'
						";
						# Insert Sub Options
						$this->db->QRY($SubOpt_QRY);
					}
					else
					{
						$this->db->QRY("
							INSERT INTO
								gc_products_option_group_item
								(
									Opt_Name,
									Opt_Price,
									Opt_Operand,
									OptGrp_ID
								)
								VALUES
								(
									'".$this->db->escape($SubOptions_F[1])."',
									'".$this->db->escape(floatval($SubOptions_F[2]))."',
									'".$this->db->escape($SubOptions_F[3])."',
									".$OptGrp_ID.
								")
						");
					}
					
					
				}
				
				
			}
			else
			{
				$OptGrp_ID = $this->db->QRY("
					INSERT INTO
						gc_products_option_group
						(
							OptGrp_Type_ID,
							OptGrp_Name,
							isTemplate,
							Store_ID
						)
						VALUES
						(
							'".$this->db->escape($_POST["OptGrp_Type_ID_OptINP"])."',
							'".$this->db->escape($_POST["OptGrp_Name_OptINP"])."',
							1,
							'".__StoreID__."'
						)
				",true);
				
				$SubOpt_QRY = "
					INSERT INTO
						gc_products_option_group_item
						(
							Opt_Name,
							Opt_Price,
							Opt_Operand,
							OptGrp_ID
						)
						VALUES
				";
				foreach($SubOptions as $K => $SubOptions_F)
				{
					if($SubOptions_F[0] == "")
						$SubOpt_QRY .= "( '".$this->db->escape($SubOptions_F[1])."', '".$this->db->escape(floatval($SubOptions_F[2]))."', '".$this->db->escape($SubOptions_F[3])."',".$OptGrp_ID."),";
					
					
				}
				# Insert Sub Options
				$this->db->QRY(preg_replace('/\,$/','',$SubOpt_QRY));
				
				$output['newTplID'] = $OptGrp_ID;
			}
			
			if(isset($_POST['OptionDelete_IDs']))
			{
				$OptionDelete_IDs = json_decode($_POST['OptionDelete_IDs'],true);
				
				if(isset($OptionDelete_IDs['Opt']) && is_array($OptionDelete_IDs['Opt']) && sizeof($OptionDelete_IDs['Opt']) > 0)
				{
					# Sanitize
					foreach($OptionDelete_IDs['Opt'] AS $K => $Opt_Del_F)
					{
						$OptionDelete_IDs['Opt'][$K] = $this->db->escape($Opt_Del_F);
					}
					$this->db->QRY("
						DELETE FROM
							gc_products_option_group_item
						WHERE
							Opt_ID IN (".implode(',',$OptionDelete_IDs['Opt']).")
					");
				}
			}
			
		}
		return $output;
	}
	
	
	function optionGroupModAdd_HTML($Data = null)
	{
		global $db;
		
		$OptGrp_Type_ID = (!is_null($Data) ? $Data['OptGrp_Type_ID'] : 1);
		$optionSubAdd_HTML = "";
		if(!is_null($Data) && isset($Data['OptGrp_ID']) && is_numeric($Data['OptGrp_ID']))
		{
			$SubOpt = $this->db->QRY("
				SELECT
					*
				FROM
					gc_products_option_group_item
				WHERE
					OptGrp_ID = '".$this->db->escape($Data['OptGrp_ID'])."'
			");
			
			foreach($SubOpt as $SubOpt_F)
			{
				
				$optionSubAdd_HTML .= $this->optionSubAdd_HTML($OptGrp_Type_ID, $SubOpt_F)['html'];
			}
		}
		else
			$optionSubAdd_HTML .= $this->optionSubAdd_HTML($OptGrp_Type_ID)['html'];
		
		$output['html'] = '
			<div id="PG_Contents">
				
				<div class="OPT_Line_One">
					<div class="OPT_T"><i>*</i><span>Option Group Name</span></div>
					<div class="OPT_I">
						<input type="text" id="OptGrp_Name_OptINP" data-name="Option Name" class="Ajax_INP must" value="'.(!is_null($Data) ? $Data['OptGrp_Name'] : "").'" />
					</div>
				</div>
				
				<div class="OPT_Line_One">
					<div class="OPT_T"><span>Option Group Type</span></div>
					<div class="OPT_I">
						<select id="OptGrp_Type_ID_OptINP" class="Ajax_INP">
							<option '.(!is_null($Data) && $Data['OptGrp_Type_ID'] == 1 ? 'selected="selected" ' : "").'value="1">Dropdown</option>
							<option '.(!is_null($Data) && $Data['OptGrp_Type_ID'] == 2 ? 'selected="selected" ' : "").'value="2">Radio Button</option>
							<option '.(!is_null($Data) && $Data['OptGrp_Type_ID'] == 3 ? 'selected="selected" ' : "").'value="3">Checkbox</option>
						</select>
					</div>
				</div>
				
				<div class="OPT_Line_One">
					<div class="OPT_T"><span>Options</span></div>
					<div class="OPT_I">
						<div id="OPT_SubTab_Block">
							<div class="OPT_SubTab_One" data-optionhtmltypeid="'.(!is_null($Data) ? $Data['OptGrp_Type_ID'] : '1').'">'.$optionSubAdd_HTML.'</div>
						</div>
					</div>
				</div>
				
			</div>
		';
		
		return $output;
		
	}
	
	function optionSubAdd_HTML($OptionHtmlTypeID = 1, $Data = null)
	{
		$output['ack'] = "error";
		$output['html'] = "";
		
		if(isset($_POST['OptionHtmlTypeID']) && is_numeric($_POST['OptionHtmlTypeID']))
			$OptionHtmlTypeID = $_POST['OptionHtmlTypeID'];
		
		/*
		Option Group Type -
			1 : Dropdown
			2 : Radio Button
			3 : Checkbox
		*/
		
		switch($OptionHtmlTypeID)
		{
			case (1 || 2 || 3): // Dropdown,Radio Button,Checkbox
				
				$output['ack'] = "success";
				$output['html'] .= '
					<div class="Opt_Sub_One" data-optid="'.(!is_null($Data) ? $Data['Opt_ID'] : "").'">
						<div class="Opt_Drop_1"><input class="Opt_Sub_INP" type="text" name="OS_Name" data-inpid="Ogts_Name_OptINP" value="'.(!is_null($Data) ? $Data['Opt_Name'] : "").'" placeholder="Option Name" /></div>
						<div class="Opt_Drop_2">
							<div class="BTN_PlusMinus BTN_Plus fa fa-plus'.(!is_null($Data) && $Data['Opt_Operand'] == "+" ? " BTN_PlusMinus_Selected" : "").(is_null($Data) ? " BTN_PlusMinus_Selected":"").'" data-val="+"></div>
						</div>
						<div class="Opt_Drop_3">
							<div class="BTN_PlusMinus BTN_Minus fa fa-minus'.(!is_null($Data) && $Data['Opt_Operand'] == "-" ? " BTN_PlusMinus_Selected" : "").'" data-val="-"></div>
						</div>
						<div class="Opt_Drop_4"><input class="Opt_Sub_INP" type="text" data-inpid="Ogts_Price_OptINP" value="'.(!is_null($Data) ? $Data['Opt_Price'] : "").'" placeholder="Price" /></div>
						<div class="Opt_Drop_5">
							<div class="square_button square_button_white fa fa-trash DelSubOption_BTN" data-tooltip="Delete Option"></div>
							<div class="square_button square_button_white AddSubOption_BTN" data-tooltip="Add Option Under This Row"><i class="fa fa-plus"></i></div>
							<div class="square_button square_button_white" data-tooltip="Change Order"><i class="fa fa-arrows"></i></div>
						</div>
					</div>
				';
				
			break;
		
			
		}
		
		return $output;	
	}

}

?>