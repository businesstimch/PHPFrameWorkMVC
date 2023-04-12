<style type="text/css">
	#POS_Login_Block{width:50%;height:100%;margin-left:auto;margin-right:auto;float:none;}
	
	#POS_LoginInp_Block{width:100%;margin-top:10%;margin-bottom:10%;height:5%;}
	#LoginDial_Block{width:80%;height:75%;margin-left:auto;margin-right:auto;float:none;}
	#Dial_LoginBox_Display{width:100%;height:100%;font-size:10em;text-align:center;color:#747474;display:none;position:relative;}
	.Dial_Wrap{width:21%;margin-left:3%;margin-bottom:3%;display:inline-block;position:relative;}
	.Dial_Wrap:before{display: block;margin-top: 100%;content: "";}
	.Dial_Wrap .Dial
	{
		position:absolute;
		left:0;
		right:0;
		top:0;
		bottom:0;
		border-radius:50%;
		cursor:grab;
		text-align:center;
		border-top:1px solid gray;
		border-right:1px solid gray;
		color:gray;
		/*
		behavior: url(PIE.htc);
		http://css3pie.com/
		*/
	}
	
	#LoginDial_Block .Dial:active{background-color:#e4e4e4;}
	#Dial_LoginBox{display:none;}
	.Circle_Wrap{width:6%;margin-left:2%;display:inline-block;position:relative;}
	.Circle_Wrap:first-child{margin-left:30%}
	.Circle_Wrap:before{display: block;margin-top: 100%;content: "";}
	.Circle_Fill, .Circle_Border{border:3px solid #747474;border-radius:50%;position:absolute;top:0;left:0;right:0;bottom:0;border-top:1px solid gray;border-right:1px solid gray;}
	.Circle_Fill{background-color:#747474;}
	/*
	@media screen and (max-width:600px)
	{
		#LoginDial_Block,#POS_LoginInp_Block{width:100%}
	
	}
	
	@media screen and (min-width:601px)
	{
		#POS_LoginInp_Block{width:50%;margin-right:5%}
		#Dial_LoginBox{max-width:300px;min-height:50px;line-height:50px;}
		#LoginDial_Block{width:40%}
		#Dial_LoginBox{position:absolute;left:50%;top:50%;}
		
		
		
		
		
	}
</style>