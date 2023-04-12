
<div class="w100" style="min-height:500px;">
	<?php if(!$isLogin){?>
	<div class="w100" id="RegisterOrGuest_Block">
		<div class="w100">
			<div id="Chk_GuestReg_T">CHECKOUT AS A GUEST OR REGISTER</div>
			<div id="Chk_GuestReg_M">Register with us for future convenience or more benefits.</div>
			<div id="Chk_GuestReg_Selection" class="Tim_Selection_1 noSelect">
				<div class="Glow" data-val="1"><i class="fa fa-circle-o"></i>Checkout as Guest</div>
				<div class="Glow" data-val="0"><i class="fa fa-circle-o"></i>Checkout with Register</div>
			</div>
		</div>
	
		<div class="BlockStyle_1 AdditionalInfo_Block" id="AIB_GuestChk">
			<div class="ChkBlock_T"><i class="fa fa-info-circle"></i> Additional Information : Checkout as a Guest</div>
			<div class="ChkField_T">Your Email Address (We will send you the order information)</div>
			<div class="ChkField_F">
				<input type="text" placeholder="Email Address (Optional)" class="one" id="ChkGuest_Email_Inp" />
			</div>
		</div>
	
		<div class="BlockStyle_1 AdditionalInfo_Block" id="AIB_RegisterChk">
			<div class="ChkBlock_T"><i class="fa fa-info-circle"></i> Additional Information : Registration</div>
			<div class="ChkField_T">Your Email Address</div>
			<div class="ChkField_F">
				<input type="text" placeholder="Email Address" class="one ChkReg_Inp" id="ChkReg_Email_Inp" />
			</div>
			<div class="ChkField_T">Your Name</div>
			<div class="ChkField_F">
				<input type="text" placeholder="First Name" class="two ChkReg_Inp" id="ChkReg_FirstName_Inp" />
				<input type="text" placeholder="Last Name" class="two ChkReg_Inp" id="ChkReg_LastName_Inp" />
			</div>
			
			<div class="ChkField_T">Your Password</div>
			<div class="ChkField_F">
				<input type="password" placeholder="Password" class="two ChkReg_Inp" id="ChkReg_Password_Inp" />
				<input type="password" placeholder="Confirm Password" class="two ChkReg_Inp" id="ChkReg_PasswordConf_Inp" />
			</div>
		</div>
	</div>
	<?php }?>
	<div class="BlockStyle_2_1" id="Shipping_Block">
		<div class="ChkBlock_T"><i class="fa fa-truck"></i> Shipping Information</div>
		<div id="ExtensionsSelection_Block">
			<div id="Pymt_Method_Msg">Selected Payment Method</div>
			<?php echo $Shipping_Selection;?>
		</div>
		<div id="ExtensionsFields_Block">
			<?php echo $Shipping_Field;?>
		</div>
		
	</div>
	<div class="BlockStyle_2_2" id="Payment_Block">
		<div class="ChkBlock_T"><i class="fa fa-credit-card"></i> Payment Information</div>
		<div id="ExtensionsSelection_Block">
			<div id="Pymt_Method_Msg">Selected Payment Method</div>
			<?php echo $Payment_Selection;?>
		</div>
		<div id="ExtensionsFields_Block">
			<?php echo $Payment_Field;?>
		</div>
	</div>
	</div>
	
	
	
	
	<div class="<?php echo ($Additional_Info_Html != "" ? 'BlockStyle_2_2':'BlockStyle_1');?>">
		<div id="Summary_Block" class="w100">
			<div class="ChkBlock_T"><i class="fa fa-newspaper-o"></i> Order Summary</div>
			<?php echo $Cart_Summary;?>
		</div>
		<div class="ChkField_T">Your Comment</div>
		<div class="ChkField_F">
			<textarea id="Pymt_Comment_Inp" placeholder="Please leave us any comment about this order.."></textarea>
		</div>
	</div>
	
	<div id="Pymt_Submit_Block">
		<span id="TermCondition_Txt"><input id="termsOfSale_Chk" type="checkbox" />By placing order, you agree to our <span id="TermsAndSale">Terms of sale</span></span><br />
	
		<button id="Pymt_Submit_Btn"><i class="fa fa-lock"></i> Place Order</button>
	</div>
</div>