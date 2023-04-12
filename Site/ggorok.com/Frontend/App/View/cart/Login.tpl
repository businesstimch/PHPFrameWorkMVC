<script type="text/javascript">
	$(document).ready(function(){
		
		Login.init();
		$("#Register_Frm").GGoRokForm({	
			'Validate' : function(){
				
				var Validation_Result = true;
				if($("#Reg_Pass_INP").val() != $("#Reg_PassCofm_INP").val())
				{
					showSideMSGBox("<i class='fa fa-user'></i> Password does not match.","msgBox_One_1");
					$("#Reg_Pass_INP,#Reg_PassCofm_INP").addClass("Warning");
					Validation_Result = false;
				}
				else if ($("#Reg_Pass_INP").val().length < 4) {
					showSideMSGBox("<i class='fa fa-user'></i> Minimum password length is 5","msgBox_One_1");
					$("#Reg_Pass_INP,#Reg_PassCofm_INP").addClass("Warning");
					Validation_Result = false;
				}
				
				return Validation_Result;
			},
			'Completed' : function(res){
				if(res.ack == 'success')
				{
					showSideMSGBox("<i class='fa fa-user'></i> <?php echo $this->_Lang_www_inc_lefttab['register_completed'];?>","msgBox_One_1");
					Login.cancelRegisterBTN();
				}
				else if (res.ack == 'error' && typeof res.error_msg != "undefined" && res.error_msg != "")
				{
					showSideMSGBox("<i class='fa fa-user'></i> "+res.error_msg,"msgBox_One_2");
				}
			}
		});
		
	});
	
	
	var Login = new function()
	{
		var self = this;
		
		this.init = function(){
			
			$(document).on(touchOrClick,"#CancelRegister_BTN",function(){
				self.cancelRegisterBTN();
			});
			$(document).on(touchOrClick,"#Register_BTN",function(){
				$("#BeforeRegister_Block").slideUp(300);
				$("#DoRegister_Block").slideDown(300);
			});
			
			$(document).on(touchOrClick,"#SignIn_BTN",function(){
				if(!$(this).hasClass("SignIn_BTN_Disabled"))
					self.submitLogin();
					
				return false;
			});
		};
		
		this.cancelRegisterBTN = function(){
			$("#BeforeRegister_Block").slideDown(300);
				$("#DoRegister_Block").slideUp(300);
		};
		this.submitLogin = function(){
			$("#SignIn_BTN").addClass("SignIn_BTN_Disabled");
			$("#SignIn_BTN").html("<i class='fa fa-circle-o-notch fa-spin'></i> Please Wait...");
			$.ajax({
				type: "POST",
				url: "/login?ajaxProcess",
				data: "menu=loginRequest&loginST="+$('#loginST').val()+"&LogInID="+$('#LogInID').val()+"&LogInPASS="+$('#LogInPASS').val()+"&loginTK="+$('#loginTK').val(),
				success: function(d){
					$("#SignIn_BTN").removeClass("SignIn_BTN_Disabled");
					$("#SignIn_BTN").html('<i class="fa fa-sign-in"></i> Sign in');
					var res = $.parseJSON(d);
					if(res.ack == 'success')
					{
						<?php if(!is_null($Redirect)) {?>
							window.location = '<?php echo $Redirect;?>';
						<?php } else {?>
							location.reload();
						<?php }?>
					}
					else
					{
						showSideMSGBox(res.error_msg,'msgBox_One_2');
						$('#loginTK').val(res.loginTK);
						$('#loginST').val(res.loginST);
					}
				}
			});
		};
		
	};

</script>
<style type="text/css">
	h1{font-size:25px;}
	
	#LP_Header{margin-top:50px;}
	#LP_Header span{color:#434343;font-size:15px;font-weight:bold;font-style:italic;}
	#LP_Header p{line-height:20px;}
	
	#DoRegister_Block{display:none;}
	#DoRegister_Block input[type=text],
	#DoRegister_Block input[type=password],
	#Login_Block input[type=text],
	#Login_Block input[type=password]{width:100%;margin:0;border:1px solid #cecece;padding:0;height:35px;padding-left:7px;padding-right:7px;box-sizing:border-box;border-radius:5px;margin-bottom:5px;}
	
	#Login_Block #Register_Block{display:none;}
	#Login_Block .Reg_attention{background-color:#ffc4c4;}
	#Login_Block .attention{background-color:#ffc4c4;}
	#Login_Block .SignIn_BTN_Disabled{background-color:#6a6a6a!important;}
	.BTN_1{font-size:14px;float:left;display:block;color:white;border:0;line-height:35px;width:100%;border-radius:5px;cursor:pointer;text-align:center;margin-top:10px;}
	#Login_Block #CancelRegister_BTN{background-color:#969696;}
	#Login_Block #CancelRegister_BTN:hover{background-color:#a9a9a9;}
	#Login_Block #SignOut_BTN{background-color:#e9615f;}
	#Login_Block #SignOut_BTN:hover{background-color:#db5250;}
	
	#Login_Block #SendRegister_BTN,
	#Login_Block #SignIn_BTN{background-color:#67d386;}
	#Login_Block #SendRegister_BTN:hover,
	#Login_Block #SignIn_BTN:hover{background-color:#57c577;}
	
	#LP_Account{width:100%;background-color:#f7f7f7;margin-top:20px;border-top:2px solid #d9d9d9;}
	
	#LP_Account .LP_Account_One{padding:20px;box-sizing:border-box;width:50%;}
	
	#LP_Account .LP_Desc_Block{width:100%;height:150px;}
	.LP_Account_One{line-height:20px;}
	.LP_Account_One .LPA_Title{font-weight:bold;font-size:15px;margin-bottom:15px;}
	.LP_Account_One .LPA_Msg{margin-bottom:15px;}
	
	#Register_BTN{background-color:#eb8c8d;}
	#Register_BTN:hover{background-color:#df7c7d;}
	
	#SendRegister_BTN{background-color:#8cbeeb;}
	#CancelRegister_BTN{background-color:#8b8b8b;}
	
	#ForgotPassword_BTN{float:right;color:#0084ff;cursor:pointer;}
</style>
<div class="outline">
	<div id="LP_Header">
		<h1>Welcome, Please Sign In</h1>
		<hr />
		<p><span>Do you want to go straight to the checkout process?</span></p><br />
		<p>Would you like to check out without creating a customer account? Please note that all of our services will not be available to customers that do not create an account. Also, you cannot view the status of your order, and each time you shop with us you will have to re-enter all of your data.</p><br />
		<p>Creating an account is easy and free. If you still wish to continue to checkout without creating an account, please click the Express Checkout button below.</p>
	</div>
	
	<div id="LP_Account">
		<div id="Register_Block" class="LP_Account_One">
			<div id="BeforeRegister_Block" class="w100">
				<div class="LP_Desc_Block">
					<p class="LPA_Title">New Customer?</p>
					<p class="LPA_Msg">I am a new customer.</p>
					By creating an account you will be able to shop faster, be up to date on the status of your orders, and keep track of the orders you have previously made.
				</div>
				<span id="Register_BTN" class="Glow BTN_1"><i class="fa fa-star"></i> Register</span>
			</div>
			<div id="DoRegister_Block" class="w100">
				
				<form id="Register_Frm" action="/Register?ajaxProcess" data-menu="registerRequest" data-callback="AJAX_Register" data-confirmtitle="Submit" data-confirm="Do you want to register?">
					<div class="w100">
						<input data-must type="text" id="Reg_FirstName_INP" class="Glow INP" placeholder="First Name" />
						<input data-must type="text" id="Reg_LastName_INP" class="Glow INP" placeholder="Last Name" />
						<input data-must type="text" id="Reg_EmailAddr_INP" class="Glow INP" placeholder="Email Address" />
						<p class="center Gray">(Minium Password Length is 6)</p>
						<input data-must type="password" id="Reg_Pass_INP" class="Glow INP" placeholder="Password" />
						<input data-must type="password" id="Reg_PassCofm_INP" class="Glow INP" placeholder="Confirm Password" />
					</div>
					<div class="w100">
						<button data-type="Submit" id="SendRegister_BTN" class="Glow BTN_1"><i class="fa fa-heart"></i> I'm READY!</button>
						<button type="button" id="CancelRegister_BTN" class="Glow BTN_1"><i class="fa fa-ban"></i> Maybe Later</button>
					</div>
				</form>
			</div>
		</div>
		<div id="Login_Block" class="LP_Account_One noSelect">
			<!--
				<div id="LoggedIn_Block" class="Login_Block">
					<a id="SignOut_BTN" href="?menu=logout" class="Glow block SignInOut_BTN"><i class="fa fa-sign-out "></i> Sign out</a>
				</div>
			-->
			<div id="LoginRequest_Block" class="Login_Block">
				<form method="post">
					<div class="LP_Desc_Block">
						<p class="LPA_Title">Already have an account?</p>
						<p class="LPA_Msg">I am a returning customer. <span id="ForgotPassword_BTN">Forgot Password?</span></p>
						
						<input id="LogInID" type="text" placeholder="Email" />
						<input id="LogInPASS" type="password" placeholder="Password" />
						<input type="hidden" name="loginTK" id="loginTK" value="<?php echo $loginTK;?>" />
						<input type="hidden" name="loginST" id="loginST" value="<?php echo $loginST;?>" />
					</div>
					<button id="SignIn_BTN" type="submit" class="Glow BTN_1"><i class="fa fa-sign-in"></i> Sign in</button>
				</form>
			</div>
		</div>
	</div>
</div>