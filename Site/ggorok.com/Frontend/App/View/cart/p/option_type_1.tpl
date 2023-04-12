<div class="P_Opt PInfo_One" data-ismandatory="<?php echo $Opt_F['isMandatory'];?>">
	
	
	<div class="PInfo_Name">
		<?php echo ($Opt_F['isMandatory'] == 1 ? '<span class="Opt_Must">*</span>':"").$Opt_F['OptGrp_Name'];?> :
	</div>
	<div class="PInfo_Value">
		<div class="P_OptField">
			<div class="OptStyl_1 OptField_One noSelect">
				<div class="Opt_Selected" data-selectedoptid="">
					<div class="Opt_Selected_Name"><span>- Select an Option -</span></div>
					<div class="Opt_Selected_Arrow fa fa-caret-down"></div>
				</div>
				<div class="Opt_Lists">
					<div data-optid="" class="Opt_Select_One Opt_Select_Selected"><span>- Select an Option -</span></div>
					<?php echo $OptionElement_HTML;?>
				</div>
			</div>
		</div>
	</div>
	
	
</div>








<?php

/*
if($Opt_F['OptGrp_Type_ID'] == 1)
{
	$Opt_HTML = '<div data-optid="" class="Opt_Select_One Opt_Select_Selected">'.$OptionDefault_Msg.'</div>';
	foreach($OptData as $OptData_F)
	{
		$Opt_HTML .= '<div data-optid="'.$OptData_F['Opt_ID'].'" data-operand="'.$OptData_F['Opt_Operand'].'" data-price="'.$OptData_F['Opt_Price'].'" class="Opt_Select_One">'.$OptData_F['Opt_Name'].($OptData_F['Opt_Price'] > 0 ? ' ('.$OptData_F['Opt_Operand'].'$'.''.number_format($OptData_F['Opt_Price'],2).')' : "").'</div>';
	}
	$Opt_HTML = '
		<div class="P_OptName">'.($Opt_F['isMandatory'] == 1 ? '<span class="Opt_Must">*</span>':"").'Option : <b>'.$Opt_F['OptGrp_Name'].'</b></div>
		<div class="P_OptField">
			<div class="OptStyl_1 OptField_One noSelect">
				<div class="Opt_Selected" data-selectedoptid="">
					<div class="Opt_Selected_Name">'.$OptionDefault_Msg.'</div>
					<div class="Opt_Selected_Arrow fa fa-caret-down"></div>
				</div>
				<div class="Opt_Lists">'.$Opt_HTML.'</div>
			</div>
		</div>
	';
}
$Opt_HTML = '<div class="P_Opt" data-ismandatory="'.$Opt_F['isMandatory'].'">'.$Opt_HTML.'</div>';
*/
?>