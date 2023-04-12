<style tyle="css/text">
	#PG_Menu{float:right;}
	#PG_Contents{width:100%;margin-top:10px;padding-bottom:50px;}
	
	.LC_ID{width:100px;}
	.LC_CustomerName{width:180px;}
	.LC_Email{width:300px;}
	.LC_Clicked{width:100px;color:gray;}
	.LC_GotReview{width:100px;color:gray;}
	.LC_Status{width:150px;}
	.LC_OptIn{width:100px;color:gray;}
	.LC_Sent{width:100px;color:gray;}
	
	.LC_Ready{width:100px;color:gray;}
	.LC_DayAgo{width:150px;}
	.ActivatedColor{color:#309df1!important;}
	
	.List_Contents .LC_Clicked,
	.List_Contents .LC_GotReview,
	.List_Contents .LC_Ready,
	.List_Contents .LC_OptIn,
	.List_Contents .LC_Sent
	{font-size:20px;}
	#TopFilters{width:100%;}
	#TopFilters .TF_One{padding-left:30px;padding-right:30px;line-height:40px;border-radius:5px;border:1px solid gray;margin-right:10px;cursor:pointer;}
	#TopFilters .TF_One:hover{background-color:#f3f3f3;}
	#TopFilters .TF_Selected{background-color:#309df1!important;border:1px solid #1288e2!important;color:white!important;}
	#DateRange_INP{line-height:38px;width:230px;border-radius:5px;text-align:center;border:1px solid gray;margin-right:10px;}
	#Loader{line-height:50px;margin-left:30px;color:gray;}
</style>
<script type="text/javascript" src="/Core/JS/datePicker/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="/Core/JS/datePicker/bootstrap.css" />
<script type="text/javascript" src="/Core/JS/datePicker/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="/Core/JS/datePicker/daterangepicker.css" />
<script type="text/javascript">
	$(document).ready(function(){
		MarketingAction.init();
		
	});
	var MarketingAction = new function()
	{
		var self = this;
		var Args_Filter = 'Ready';
		this.init = function(){
			$('#DateRange_INP').daterangepicker({
				locale: {
					format: 'MM/DD/YYYY',
					maxDate: moment(),
				},
				startDate : moment().subtract(29, 'days')
			});
			
			$('#DateRange_INP').on('apply.daterangepicker', function(ev, picker) {
				self.loadList();
			});
			
			$(document).on(touchOrClick,'.TF_One',function(){
				Args_Filter = $(this).data('value');
				self.loadList();
			});
			
			$(document).on(touchOrClick,'#Refresh_BTN',function(){
				self.loadList();
				showSideMSGBox('Refreshed successfully','msgBox_One_1');
			});
			
			$(document).on(touchOrClick,'#SendAll_BTN',function(){
				
				if($('.List_One[data-ready=1]').length > 0)
					timconfirm('Confirm','Do you want to send review email to all listed customers?',function(){
						
						self.sendMail();
						Billboard.show({
							'Msg' : '<i class="fa fa-gear fa-spin" style="color:#ffefcd;"></i> Sending (<b id="sentCurrent">0</b> / '+($('.List_One[data-ready=1]').length)+') | <u>Stop</u>',
							'Speed' : 500
						});
	
					});
				else
					showSideMSGBox('No email to send','msgBox_One_2');
			});
			
			
			self.loadList();
		};
		
		this.sendMail = function(){
			var min = 0.00001;
			var max = 0.00001;
			
			var Delay = Math.floor(Math.random() * (max - min)) + min;
			var Obj = $('.List_One[data-ready=1]:first');
			
			if(Obj != "undefined")
			{
				
				
				$.ajax({
					type: "POST",
					url: "?ajaxProcess",
					data: "menu=sendEmailByOrder&oID=",
					success: function(d){
						
						var res = $.parseJSON(d);
						if(res.ack == 'success')
						{
							Obj.find('.LC_Sent').addClass('ActivatedColor');
							Obj.attr('data-ready',0);
							
							setTimeout(function(){
								self.sendMail();
							},(Delay * 1000));
							
						}
						else if(typeof res.error_msg != "undefined")
						{
							showSideMSGBox(res.error_msg,'msgBox_One_2');
						}
					}
				});
				
				
			}
			else
				showSideMSGBox('Sent successfully.','msgBox_One_1');
				
		};
		
		this.loadList = function(){
			$('.TF_One').removeClass('TF_Selected');
			$('.TF_One[data-value='+Args_Filter+']').addClass('TF_Selected');
			
			$.ajax({
				type: "POST",
				url: "?ajaxProcess",
				data: "menu=loadList&Filter="+Args_Filter+"&PG=<?php echo $PG;?>&OrderFrom="+$('#DateRange_INP').data('daterangepicker').startDate.format('YYYY-MM-DD')+"&OrderTo="+$('#DateRange_INP').data('daterangepicker').endDate.format('YYYY-MM-DD'),
				success: function(d){
					
					var res = $.parseJSON(d);
					if(res.ack == 'success')
					{
						$('#listTable').html(res.html);
					}
					else if(typeof res.error_msg != "undefined")
					{
						showSideMSGBox(res.error_msg,'msgBox_One_2');
					}
				}
			});
		};
	};
</script>
<link href="<?php echo __DocumentRoot__;?>Template/CSS/Admin.css" rel="stylesheet" type="text/css" />
<div id="PG_Menu">
	<div id="Refresh_BTN" class="button button_gray" data-tooltip="Refresh"><i class="fa fa-rotate-left"></i></div>
	<div id="SendAll_BTN" class="button button_blue" data-tooltip="Send All"><i class="fa fa-paper-plane"></i></div>
</div>
<h2 id="PG_Title"><i class="fa fa-envelope-open-o"></i> Email Marketing</h2>
<div id="PG_Contents">
	<div id="TopFilters" class="noSelect">
		<div><input id="DateRange_INP" type="text" name="daterange" /></div>
		<input type="button" data-value="All" class="TF_One Glow block button" id="TF_All_BTN" value="All" />
		<input type="button" data-value="Ready" class="TF_One Glow block button" id="TF_Ready_BTN" value="Ready to send" />
		<input type="button" data-value="Sent" class="TF_One Glow block button" id="TF_Sent_BTN" value="Sent" />
	</div>
	<div class="GGoRok_Table_1 noSelect">
		<div class="List_One List_Header">
			<div class="LC_ID List_Col center">Order ID</div>
			<div class="LC_CustomerName List_Col">Customer Name</div>
			<div class="LC_Email List_Col">Email</div>
			<div class="LC_Clicked List_Col center">Clicked</div>
			<div class="LC_GotReview List_Col List_Col center">Reviewed</div>
			<div class="LC_OptIn List_Col center">Opt-In</div>
			<div class="LC_Sent List_Col center">Sent</div>
			<div class="LC_Status List_Col center">Order Status</div>
			<div class="LC_DayAgo List_Col center">Last Modified</div>
		</div>
		<div id="listTable" class="w100">
			<div id="Loader">
				<i class="fa fa fa-spinner fa-spin"></i> Loading ...
			</div>
		</div>
		
	</div>
	
	
</div>