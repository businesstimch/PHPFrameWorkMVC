<style type="text/css">
	#Home_Box{box-shadow: 6px 10px 2px #262626;font-family:Verdana;}
	#LoginReg_Box{background-color:#323232;position:relative;}
	#Login_Wrap{width:100%;height:100%;}
	#Register_Wrap{width:100%;height:100%;display:none;}
	#Login_Container{position:relative;width:300px;height:100%;margin-left:auto;margin-right:auto;float:none;}
	#AD_Box{background-color:#4fc7ff;position:relative;}
	#Logo{position:absolute;left:0;top:0;width:118px;height:59px;background-image:url('/Template/Img/Logo.png');background-repeat:no-repeat;background-position:center center;}
	.LoginRow_One{width:100%;height:33px;background-color:#e5e5e5;border-radius:2px;font-size:13px;color:#323232;position:relative;}
	#ForgotPasssword_BTN{position:absolute;top:3px;right:7px;line-height:27px;height:27px;cursor:pointer;font-size:10px;color:#777777;}
	.LoginInp_One::placeholder{font-size:11px;color:#777777;}
	.LoginRowInpBox_One{padding:3px;box-sizing:border-box;}
	.LoginRowLoginBTNBox{}
	#Home_Slogan{width:100%;height:60px;background-repeat:no-repeat;background-position:center center;margin-bottom:20px;}

	#Login_Wrap #Home_Slogan{margin-top:130px;background-image:url('/Template/Img/Home-Slogan.png');}
	#Register_Wrap #Home_Slogan{margin-top:108px;background-image:url('/Template/Img/Home-Slogan2.png');}
	.LoginInp_One{font-size:14px;padding-left:10px;padding-rightt:10px;box-sizing:border-box;background-color:#e5e5e5;}
	.LoginMargin{margin-bottom:12px;}
	#Login_BTN,#Register_BTN{margin-top:5px;cursor:pointer;}
	#Login_BTN{background-color:#48b8ec;}
	#Login_BTN:hover{background-color:#239ad1;}

	#Register_BTN{background-color:#ec4867;}
	#Register_BTN:hover{background-color:#d83554;}


	.LoginReg_BTN{text-align:center;line-height:33px;color:white;font-family:Verdana;font-size:11px;}

	.SignLogBTN_Block{position:absolute;bottom:21px;}

	#Back_BTN,#SignUp_BTN{height:28px;color:white;font-size:11px;cursor:pointer;}
	#Back_BTN:hover,#SignUp_BTN:hover{color:#48b8ec;}
	#RBB_Desc{font-size:10px;color:#8f8f8f;}
	#TermsCondition_Block{color:#8f8f8f;font-size:10px;text-align:justify;line-height:13px;}
	#TermsCondition_Block span{color:#fafafa;}
	#AD_1{background-color:#90bca0;width:100%;height:100%;background-image:url('/Template/Img/ADs/AD1-ShareMusic.png');background-repeat:no-repeat;background-position:center top;}
	@media all and (min-width: 950px) {
		#Home_Box{width:874px;height:524px;position:absolute;left:50%;top:50%;margin-left:-437px;margin-top:-262px;}
		#LoginReg_Box{width:50%;height:100%;}
		#AD_Box{width:50%;height:100%;}

	}

</style>
<script type="text/javascript">
	$(document).ready(function(){
		showMSGwindow('Welcome Back, Please Login :-)');
		_login.init();
	});

	var _login = new function(){
		this.init = function(){

			$(document).on(touchOrClick,'#SignUp_BTN',function(){
				$('#Login_Wrap').slideUp(500,'easeInSine');
				$('#Register_Wrap').slideDown(500,'easeInSine');
			});

			$(document).on(touchOrClick,'#Back_BTN',function(){
				$('#Login_Wrap').slideDown(500,'easeInSine');
				$('#Register_Wrap').slideUp(500,'easeInSine');
			});

			$(document).on('keydown','#loginPS',function(e){
				if(e.which == 13)
					submitLogin();
			});

			$(document).on('click','#Login_BTN',function(){
				submitLogin();
				return false;
			});
			$(document).on('keypress','.logInBox_INP',function(e){
				if(e.which == 13)
					submitLogin();
			});
		};
	};

	function submitLogin()
	{
		showMSGwindow('<div style="margin-right:5px;"><img  src="/Template/Img/ajax-loader-login.gif" alt="loading" /></div> <div>Loading ...</div>');
		$.ajax({
			type: "POST",
			url: "/login?ajaxProcess",
			data: "menu=loginRequest&loginST="+$('#loginST').val()+"&LogInID_INP="+$('#loginID').val()+"&LogInPASS_INP="+$('#loginPS').val()+"&loginTK="+$('#loginTK').val(),
			success: function(d){
				var res = $.parseJSON(d);
				if(res.ack == 'success')
				{
					location.reload();
				}
				else
				{
					$('#loginTK').val(res.loginTK);
					$('#loginST').val(res.loginST);

					if(typeof res.error_msg != 'undefined')
						showSideMSGBox(res.error_msg,'msgBox_One_1');

					showMSGwindow("Please try again.");
				}
			}
		});
	}

	function showMSGwindow(msg)
	{
		$('#messageWindow_Block').fadeOut(50,function(){
			$('#messageWindow_Block').html(msg);

		}).fadeIn(1000);

	}
</script>

<div id="Home_Box">
	<div id="LoginReg_Box">
		<a id="Logo" class="block" href="/"></a>
		<div id="Login_Wrap">
			<div id="Login_Container">
				<div id="Home_Slogan" class="LoginMargin"></div>
				<div class="LoginRow_One LoginRowInpBox_One LoginMargin">
					<input type="text" id="loginID" class="InpInBox LoginInp_One" placeholder="Email Address" />
				</div>
				<div class="LoginRow_One LoginRowInpBox_One LoginMargin">
					<input type="password" id="loginPS" class="InpInBox LoginInp_One" placeholder="Password" />
					<div id="ForgotPasssword_BTN">Forgot Password?</div>
				</div>
				<div id="Login_BTN" class="Glow LoginRow_One noSelect LoginMargin LoginRowLoginBTNBox LoginReg_BTN" style="margin-bottom:0px;">
					Login
				</div>
				<div class="SignLogBTN_Block w100 center">
					<span id="RBB_Desc">Don’t have an account yet?</span> <span id="SignUp_BTN">Signup Now</span>
				</div>

			</div>

		</div>

		<div id="Register_Wrap">
			<div id="Login_Container">
				<div id="Home_Slogan" class="LoginMargin"></div>
				<div class="LoginRow_One LoginRowInpBox_One LoginMargin">
					<input type="text" id="registerID" class="InpInBox LoginInp_One" placeholder="Email Address" />
				</div>
				<div class="LoginRow_One LoginRowInpBox_One LoginMargin">
					<input type="password" id="registerPS" class="InpInBox LoginInp_One" placeholder="Password" />
				</div>
				<div class="LoginRow_One LoginRowInpBox_One LoginMargin">
					<input type="password" id="registerPS_Cfm" class="InpInBox LoginInp_One" placeholder="Password Confirm" />
				</div>
				<div id="TermsCondition_Block">
					By clicking Next, you agree to our <span>Terms,</span> <span>Data Policy</span> and <span>Cookies</span> Policy. <span>Please use a valid email for verification.</span>
				</div>
				<div id="Register_BTN" class="Glow LoginRow_One noSelect LoginMargin LoginRowLoginBTNBox LoginReg_BTN" style="margin-top:15px;">
					Register
				</div>
				<div class="SignLogBTN_Block w100 center">
					<span id="RBB_Desc">You already have an account?</span> <span id="Back_BTN">Login Now</span>
				</div>

			</div>

		</div>
	</div>
	<input id="loginTK" type="hidden" value="<?php echo $loginTK;?>" />
	<input id="loginST" type="hidden" value="<?php echo $loginST;?>" />
	<div id="AD_Box">
		<div id="AD_1">

		</div>
	</div>
</div>
