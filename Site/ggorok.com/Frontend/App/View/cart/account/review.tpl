<style type="text/css">
	#ratingBox{width:600px;margin-left:auto;margin-right:auto;font-family:arial,san-serif;margin-top:30px;float:none;}
	#ratingBox .RLogo{height:84px;width:100%;text-align:left;padding-left:13px;}
	#ratingBox .ItemBox{background-color:#f4f4f4;padding-left:13px;}
	#ratingBox .IB_Top{height:56px;line-height:56px;font-size:22px;color:#404040;}
	#ratingBox .IB_StarBox{height:132px;width:100%;background-image:url('/Template/Img/Email-Template/RatingBoard.jpg');position:relative;}
	#ratingBox .IB_StarOne{cursor:pointer;top:49px;width:64px;height:61px;background-image:url('/Template/Img/Email-Template/RatinStar.png');position:absolute;background-position:-64px 0;}
	#ratingBox .ID_StarOne_1{left:31px;}
	#ratingBox .ID_StarOne_2{left:103px;}
	#ratingBox .ID_StarOne_3{left:175px;}
	#ratingBox .ID_StarOne_4{left:247px;}
	#ratingBox .ID_StarOne_5{left:319px;}
	#ratingBox .IB_Rating_One{}
	#ratingBox .IBR_ReviewBox{width:572px;margin-top:10px;}
	#ratingBox .IBR_ReviewBox textarea{width:100%;height:100px;padding:0;marin:0;border:0;resize:vertical;padding:10px;box-sizing:border-box;font-size:14px;}
	#ratingBox .IBR_Image{width:156px;}
	#ratingBox .IBR_Image img{border:3px solid #5b6063;}
	#ratingBox .IBR_Box{width:416px;}
	#ratingBox .IBR_BoxDesc{height:59px;width:100%;font-size:14px;padding-left:10px;line-height:20px;}
	#ratingBox .IBR_SubmitBox{width:100%;margin-top:10px;text-align:center;display:none;}
	
	#ratingBox .IBR_SubmitBox input{width:200px;border:1px solid #bbbbbb;border-radius:5px;line-height:40px;font-size:18px;cursor:pointer;background-color:#10a8ff;color:white;}
	#ratingBox .IBR_SubmitBox input:hover{background-color:#59c2ff;}
	#ratingBox .IBR_BottomInfo{font-size:13px;color:#666666;padding-top:17px;padding-bottom:17px;}
	#ratingBox .IBR_OptOut{width:100%;text-align:center;font-size:14px;color:#666666;padding-top:16px;font-size:15px;}
	#ratingBox .IBR_HR{width:580px;margin:0 auto;border-bottom:1px solid #bbbbbb;margin-top:15px;}
	#ratingBox .IBR_Bottom{width:100%;text-align:center;font-size:14px;color:#666666;padding-top:16px;line-height:20px;margin-bottom:50px;}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		ItemRating.init();
		
		
	});
	
	var ItemRating = new function(){
		
		
		this.init = function(){
			$(document).on(touchOrClick,'.IB_StarOne',function(){
				var selectedStarID = $(this).data('starid');
				StarMouseEventChk_Handler(selectedStarID,$(this));
				$(this).parents('.IB_Rating_One').find('.IBR_SubmitBox').slideDown(100);
				
			});
			
			$(document).on(touchOrClick,'.IBR_Submit_Inp',function(){
				
			});
		};
		
		var StarMouseEventChk_Handler = function(selectedStarID,Obj){
			Obj.parents('.IB_Star').find('.IB_StarOne').each(function(){
				if($(this).data('starid') <= selectedStarID)
					$(this).css('background-position','0 0');
				else
					$(this).css('background-position','-64px 0');
			});
		};
		
		
	};
</script>
<div id="ratingBox">

	<div class="RLogo">
		<a href="https://www.janilink.com"><img src="http://cart.ggorok.com/Template/Img/Email-Template/Janilink-Logo.jpg" /></a>
	</div>
	
	<div class="ItemBox">
		
		<div class="IB_Top">
			How did this item meet your expectation?
		</div>
		
		<div class="IB_Rating_One">
			<div class="IBR_Image"><img src="https://www.janilink.com/img/p/M/mulitifunction1new2-Kit.jpg"></div>
			<div class="IBR_Box">
				<div class="w100">
					<div class="IBR_BoxDesc">
						<span style="font-size:17px;">Natural Bottle 3t2 OZ</span><br />
						Your opinion is very important to us
					</div>
					<div class="IB_StarBox">
						<div class="IB_Star">
							<div data-starid="1" class="IB_StarOne ID_StarOne_1"></div>
							<div data-starid="2" class="IB_StarOne ID_StarOne_2"></div>
							<div data-starid="3" class="IB_StarOne ID_StarOne_3"></div>
							<div data-starid="4" class="IB_StarOne ID_StarOne_4"></div>
							<div data-starid="5" class="IB_StarOne ID_StarOne_5"></div>
						</div>
						
						
							
					</div>
				</div>
			</div>
			<div class="IBR_ReviewBox">
				<textarea placeholder="Review about this item..."></textarea>
			</div>
			<div class="IBR_SubmitBox">
				<input class="IBR_Submit_Inp" type="button" class="Glow" value="Save & Submit" />
			</div>
			
		</div>
		<div class="IBR_BottomInfo">
			We provide customer reviews to help you make the best purchasing decision and to share your experience with us.
		</div>
		
	</div>
	
	
	<div class="IBR_OptOut">
		If you would rather not receive future e-mail of this kind from us, please out-out <a href="" style="color:#1950db;text-decoration:none;">here</a>.
	</div>

	

	<div class="IBR_HR"></div>

	<div class="IBR_Bottom">
		Thank you for your business, please contact us if you need any assistance at<br />
		toll free 1-888 - 234 - 2255 | https://www,janilink.com
	</div>
	
</div>