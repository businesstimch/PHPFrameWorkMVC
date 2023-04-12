<style type="text/css">
	
	.API_One{width:500px;font-family: 'Nanum Barun Gothic', sans-serif;margin-left:20px;margin-top:20px;border:1px dotted gray;padding:20px;border-radius:30px;}
	.API_One .API_Name{width:100%;font-size:15px;margin-bottom:30px;}
	.API_One .API_Desc{}
	.API_One .API_URL{width:100%;font-size:15px;}
	.API_One .API_Parameter{width:100%;font-size:15px;}
	.API_One .API_Return{width:100%;font-size:15px;}
	
	.API_One .API_Box{padding:20px;background-color:#f3f3f3;border-radius:10px;margin-top:10px;margin-bottom:10px;box-sizing:border-box;line-height:30px;}
	.API_One .API_SubName{width:100%;ox-sizing:border-box;margin-top:10px;}
</style>


<div class="API_One">
	<div class="API_Name">회원가입 요청</div>
	<div>
		
		
	</div>
	<div class="API_SubName">요청주소</div>
	<div class="API_URL API_Box">/API?ajaxProcess</div>
	<div class="API_SubName">파라미터</div>
	<div class="API_Parameter API_Box">
		menu = registerBy_PhoneNumber<br />
		PhoneNumber = 숫자만 추출함
	</div>
	<div class="API_SubName">반환값</div>
	<div class="API_Return API_Box">
		reg_code = 4개숫자<br />
		ack = error | success
	</div>
</div>