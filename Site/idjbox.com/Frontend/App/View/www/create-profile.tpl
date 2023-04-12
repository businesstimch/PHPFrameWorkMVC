<style type="text/css">

	#IDJBoxStage{
		background-color:#595959;
		max-width:868px;
		height:844px;
		width:100%;
		float:none;
		position:relative;
		margin-top:80px;
		margin-left:auto;
		margin-right:auto;
		-webkit-box-shadow: 6px 9px 5px 0px rgba(42,42,42,1);
		-moz-box-shadow: 6px 9px 5px 0px rgba(42,42,42,1);
		box-shadow: 6px 9px 5px 0px rgba(42,42,42,1);
	}
	.generalBG{background-image:url('/Template/Img/create-profile/ProfilePG.png');}
	#IDJBoxStage_Wrap{width:100%;height:100%;}
	#CurrentBreadCrumb{width:166px;height:21px;background-position:0 -21px;margin-top:24px;}
	#CurrentBreadCrumb_Ani{width:0;height:100%;}
	#Logo{position:absolute;left:0;top:-52px;background-image:url('/Template/Img/Logo.png');height:40px;width:98px;}
	#PageTitle{background-image:url('/Template/Img/create-profile/ProfilePG.png');width:351px;height:24px;background-position:0 -42px;margin-top:40px;}
	#UploadProfilePic{border-radius:50%;width:154px;height:154px;background-color: #6b6b6b;border:6px solid #4ebdf1;margin-top:38px;cursor:pointer;}
	#UploadProfilePic_TXT{width:103px;height:20px;background-position:0 -66px;float:none;margin-left:auto;margin-right:auto;margin-top:67px;}
	#ProfilePicDesc{color:#d6d6d6;font-size:19px;text-align:center;margin-top:38px;}
	.spanPointerWhite{color:white;cursor: pointer;}
	#PF_RegInpBox{margin-top:35px;}
	#PF_RegInpBox input{margin-bottom:12px;border:0;padding:0;color:white;max-width:449px;font-size:1.4em;border-radius: 5px;width:100%;height:53px;border:5px solid white;}


	#PF_Reg_Email_INP{
		-moz-box-shadow:    inset 0 2px 2px #ba7a00;
  	-webkit-box-shadow: inset 0 2px 2px #ba7a00;
  	box-shadow:         inset 0 2px 2px #ba7a00;
		background-color: #f1a006;
	}

	#PF_Reg_ProfileName_INP{

		-moz-box-shadow:    inset 0 2px 2px #8c8b8b;
		-webkit-box-shadow: inset 0 2px 2px #8c8b8b;
		box-shadow:         inset 0 2px 2px #8c8b8b;
		background-color: #949494;
	}


	#PF_Reg_Password_INP{
		-moz-box-shadow:    inset 0 2px 2px #1f81af;
  	-webkit-box-shadow: inset 0 2px 2px #1f81af;
  	box-shadow:         inset 0 2px 2px #1f81af;
		background-color: #bebcbc;
	}

	#TermsCondition_Block{width:458px;font-size:1.25em;text-align:center;line-height:20px;color:#d6d6d6;margin-top: 15px;}
	#NextBTN{
		cursor:pointer;
		margin-top:px;border:0;padding:0;color:white;max-width:269px;font-size:16px;border-radius: 5px;width:100%;height:63px;border:5px solid white;
		background-color: #f1a006;
	}
</style>

<script type="text/javascript">
	$(document).ready(function(){
		$('#CurrentBreadCrumb_Ani').animate({
			'width' : '73px'
		},{ duration: 2000, easing: 'easeOutElastic' });
	});
</script>


<div id="IDJBoxStage">
	<div id="IDJBoxStage_Wrap">
		<a href="/" id="Logo"></a>
		<div id="CurrentBreadCrumb" class="generalBG DivCenter">
			<div id="CurrentBreadCrumb_Ani" class="generalBG"></div>
		</div>
		<div id="PageTitle" class="DivCenter"></div>
		<div id="UploadProfilePic" class="DivCenter">
			<div id="UploadProfilePic_TXT" class="generalBG"></div>
			<input type="hidden" id="UploadProfilePic_INP" />
		</div>
		<div id="ProfilePicDesc" class="w100">
			Profile Picture | <span id="UploadTxtBTN" class="spanPointerWhite">Upload</span> or Drop Your Picture
		</div>
		<div id="PF_RegInpBox" class="w100 center">

				<!--<input id="PF_Reg_Email_INP" class="center PlaceholderWhite" placeholder="Email Address (Login ID)" />-->


				<input id="PF_Reg_ProfileName_INP" class="center PlaceholderWhite" placeholder="Your Profile Name" />


				<!--<input id="PF_Reg_Password_INP" type="password" class="center PlaceholderWhite" placeholder="Your Password" />-->

		</div>

		<div class="w100 center">
			<button id="NextBTN">Next</button>
		</div>
	</div>
</div>
