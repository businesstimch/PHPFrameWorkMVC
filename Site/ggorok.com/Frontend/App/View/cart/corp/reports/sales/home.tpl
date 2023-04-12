<!--

Year : 기간 차이가 1년 이하일 때
Week : 기간 차이가 7일 이하일 때
-->



<style type="text/css">
	#PG_Title{margin-top:0;margin-bottom:20px;position:relative;position:relative;}
	#PG_Menu{float:right;}
	
	
	
	#PG_Contents{width:100%;padding-bottom:50px;}
	
	.Report_Name{font-size:15px;}
	.ItemSales_Header{border-radius:10px 10px 0 0;}
	.DateRange_BTN{background-color:#bedaf4;border:1px solid #719cc5;color:#265a8c;}
	.DR_Selected{background-color:#1662ab;color:white;border:1px dotted #0d3e6e;}
	
	#LoadingPage{
		position:fixed;left:50%;top:10px;width:330px;margin-left:-165px;height:50px;line-height:50px;text-align:center;
		font-size:15px;color:gray;display:none;border:1px dotted black;background-color:#3a6fa2;color:white;border-radius:10px;z-index:100;}
	
	#DateSelect{width:100%;margin-bottom:20px;border-bottom:1px dotted #c8c8c8;padding-bottom:15px;}
	#DateSelect input[type="text"]{border:1px solid #bbbbbb;}
	
	.Report_Name{width:100%;}
	.Report_Data{background-color:#f1f1f1;}
	.IS_Name{padding-left:10px;padding-right:10px;}
	.bigTextinTable{width:100%;height:100px;line-height:100px;text-align:center;border-bottom:1px solid #737373;}
	#InternetItemSales_Table{width:100%;clear:left;margin-top:20px;min-width:950px;}
	#InternetItemSales_Table .Report_Data{width:100%;}
	#InternetItemSales_Table .ItemSales_Header{background-color:#3f81da;color:white;}
	#InternetItemSales_Table .ItemSales_Row{background-color:#f1f1f1;}
	#InternetItemSales_Table .ItemSales_One{width:100%;border-bottom:1px solid #a8a8a8;}
	#InternetItemSales_Table .IS_Dept{width:200px;}
	#InternetItemSales_Table .IS_Name{width:300px;}
	#InternetItemSales_Table .IS_SKU{width:150px;}
	#InternetItemSales_Table .IS_Qty{width:60px;}
	#InternetItemSales_Table .IS_Price{width:100px;}
	#InternetItemSales_Table .IS_Total{width:100px;}
	#InternetItemSales_Table .IS_Profit{width:100px;}
	#InternetItemSales_Table .IS_Col{text-align:center;border-right:1px solid white;min-height:30px;line-height:30px;}
	
	#GoogleAdWords_Table{width:100%;clear:left;margin-top:20px;min-width:950px;}
	#GoogleAdWords_Table .Report_Data{width:100%;}
	#GoogleAdWords_Table .TB_Header{background-color:#373737;color:white;}
	#GoogleAdWords_Table .ItemSales_Row{background-color:#f1f1f1;}
	#GoogleAdWords_Table .ItemSales_One{width:100%;border-bottom:1px solid #a8a8a8;}
	#GoogleAdWords_Table .IS_Name{width:300px;}
	#GoogleAdWords_Table .IS_SKU{width:200px;}
	#GoogleAdWords_Table .IS_Cost{width:73px;}
	#GoogleAdWords_Table .IS_Clicks{width:57px;}
	#GoogleAdWords_Table .IS_Impressions{width:100px;}
	#GoogleAdWords_Table .IS_SoldQTY{width:40px;}
	#GoogleAdWords_Table .IS_ClickThrough{width:79px;}
	#GoogleAdWords_Table .IS_TotalSold{width:79px;}
	#GoogleAdWords_Table .ItemSales_Profitable{background-color:#cddfff;}
	#GoogleAdWords_Table .ItemSales_NonProfitable{background-color:#ffcdcd;}
	#GoogleAdWords_Table .ItemSales_Reg{background-color:#e3e3e3;}
	#GoogleAdWords_Table .ItemSales_Asm{background-color:#c3c3c3;}
	
	#GoogleAdWords_Table .IS_Profit{width:71px;}
	#GoogleAdWords_Table .IS_ItemType{width:81px;}
	#GoogleAdWords_Table .IS_ReferSKU{width:140px;}
	#GoogleAdWords_Table .NoRecordInPOS{background-color:#8e8e8e;}
	#GoogleAdWords_Table .IS_Col{text-align:center;border-right:1px solid white;min-height:30px;height:30px;line-height:30px;overflow:hidden;}
	
	#ItemSearch_INP{
		width: 100%;
		height: 32px;
		line-height: 32px;
		margin: 0 0 0 10px;
		padding: 0;
		padding-left: 10px;
		padding-right: 10px;
		box-sizing: border-box;
		border-radius: 5px;
	}
	#SalePeriod_Graph{width:100%;margin-top:10px;border-radius:10px;overflow:hidden;height:400px;}
	#AdWordsTSV_Fle{display:none;}
	#DateSelect input,
	.TopButton{cursor:pointer;border:1px solid #gray;line-height:40px;padding-top:0;padding-bottom:0;padding-left:15px;padding-right:15px;text-align:center;font-size:15px;border-radius:5px;margin-left:10px;}
	#requestChartDateRange_INP{width:200px;}
	#UploadAdwordsTSV_BTN{border:1px solid #bbbbbb;background-color:#4193e3;color:white;}
	#UploadAdwordsTSV_BTN .uploadingFile{display:none;}
	#ItemSearch_INP{width:150px;}
	
	
	#TotalSalePIE_Wrap{width:260px;}
	
	#TotalSalePIE{width:100%;height:260px;background-color:#f1f1f1;border-radius:10px;overflow:hidden;margin-right:10px;}
	.OTR_Title{width:100%;line-height:20px;}
	
	.oneTopReport{margin-right:10px;width:260px;}
	.oneTopReport .oneReport_Title{width:100%;font-size:15px;font-weight:bold;margin-bottom:5px;}
	.oneTopReport .OTR_Title{width:100%;}
	.oneTopReport .OTR_Desc{width:100%;height:260px;border-radius:10px;background-color:#f4f4f4;}
	#DateRangeTop{font-size:15px;}
	
	
	.saleSummaryTable{line-height:30px;}
	.saleSummaryTable .ssT_ReportContainer{height:300px;border-radius:10px;background-color:#f1f1f1;}
	.saleSummaryTable .ssT_R_Left_H{width:180px;margin-top:30px;border-top:1px solid #c6c6c6;}
	.saleSummaryTable .ssT_R_Left_H_Title{width:100%;height:30px;border-bottom:1px solid #c6c6c6;}
	.saleSummaryTable .ssT_R_Left_Icn{width:30px;height:30px;text-align:center;margin-left:5px;}
	.saleSummaryTable .ssT_ReportOne{width:130px;}
	.saleSummaryTable .sstR_Title{width:100%;text-align:center;border-bottom:1px solid #c6c6c6;border-left:1px solid #c6c6c6;}
	.saleSummaryTable .sstR_Result{width:100%;border-left:1px solid #c6c6c6;}
	.saleSummaryTable .sstR_One{width:100%;height:30px;border-bottom:1px solid #c6c6c6;}
	.saleSummaryTable .sstR_One span{padding-left:10px;}
	.saleSummaryTable .sstR_Status{float:right;margin-right:5px;}
	.saleSummaryTable .fa-sort-up{color:blue;}
	.saleSummaryTable .fa-sort-down{color:red;}
	
	#summary_Current{background-color:#e5e5e5;}
	#Report_Tab{margin-top:10px;width:100%;}
	#Report_Tab .RPT_Tab_Top{width:100%;border-bottom:1px solid #a1a1a1;}
	#Report_Tab .RPT_Title_One{padding-left:20px;padding-right:20px;line-height:30px;height:30px;border-radius:10px 10px 0 0;border-bottom:0;margin-right:10px;background-color:#6e6e6e;color:white;border-left:1px solid #373737;border-left:1px solid #373737;border-top:1px solid #373737;cursor:pointer;}
	#Report_Tab .RPT_Title_Select{background-color:#3d3d3d!important;}
	#Report_Tab .RPT_Contents_One{width:100%;display:none;}
	.PrintSetting_BTN{
		cursor: pointer;
		border: 1px solid #gray;
		line-height: 40px;
		padding-top: 0;
		padding-bottom: 0;
		padding-left: 15px;
		padding-right: 15px;
		text-align: center;
		font-size: 15px;
		border-radius: 5px;
		margin-right: 10px;
		margin-top:20px;
	}
	
	.PrintSetting_On{background-color:#25a2e2;color:white;}
	.PrintSetting_Off{background-color:#565656;color:gray;}
	
	.dateDisplay{font-weight:bold;color:#1662ab;}
	#Report_Tab .RPT_Contents_Selected{display:block!important;}
	@media print {
		#Top,
		#PG_Menu,
		#Navigation,
		.RPT_Tab_Top,
		#DateSelect{display:none;}
		
		#Main{width:100%;left:0;position:relative;}
		#TotalSalePIE_Container{width:260px!important;}
		.oneTopReport{width:150px;}
		.oneTopReport *{font-size:12px;}
		.RPT_Contents_One{display:block!important;}
		.saleSummaryTable .ssT_ReportOne{width:100px;}
	}
	
	
</style>

<script src="/Core/JS/Highstocks/js/highstock.js"></script>

<script type="text/javascript" src="/Core/JS/datePicker/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="/Core/JS/datePicker/bootstrap.css" />
 
<script type="text/javascript" src="/Core/JS/datePicker/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="/Core/JS/datePicker/daterangepicker.css" />


<script type="text/javascript">
	$(document).ready(function(){
		createCharts.init();
		uploadTSV.init();
		reportTab.init();
		console.log("<?php echo $TimeNow;?>");
		printFunction.init();
	});
	
	var printFunction = new function(){
		this.init = function(){
			$(document).on(touchOrClick,"#Print_BTN",function(){
				window.print();
			});
			
			$(document).on(touchOrClick,".PrintSetting_BTN",function(){
				PrintPower($(this));
			});
			
		};
		
		var PrintPower = function(Obj){
			if(Obj.hasClass('PrintSetting_Off'))
			{
				Obj.removeClass('PrintSetting_Off');
				Obj.addClass('PrintSetting_On');
				$("[data-targetprintid="+Obj.data('printid')+"]").removeClass('hidePrint');
			}
			else
			{
				Obj.removeClass('PrintSetting_On');
				Obj.addClass('PrintSetting_Off');
				$("[data-targetprintid="+Obj.data('printid')+"]").addClass('hidePrint');
			}
		}
	};
	var reportTab = new function(){
		this.init = function(){
			
			
			
			$(".RPT_Contents_One[data-tabid="+$(".RPT_Title_Select").data('tabid')+"]").show();
			
			$(document).on(touchOrClick,".RPT_Title_One",function(){
				$(".RPT_Title_One").removeClass('RPT_Title_Select');
				$(this).addClass('RPT_Title_Select');
				var targetTab = $(".RPT_Contents_One[data-tabid="+$(this).data('tabid')+"]");
				
					$(".RPT_Contents_One").hide();
					targetTab.show();
				
				
			});
		};
	};
	
	var uploadTSV = new function(){
		this.init = function(){
			
			$(document).on(touchOrClick,"#UploadAdwordsTSV_BTN",function(){
				$("#AdWordsTSV_Fle").click();
			});
			
			$(document).on("change","#AdWordsTSV_Fle",function(){
			
				var Argv = new FormData();
				if(this.files && this.files[0])
				{
					
					var File = $(this)[0];
					File = File.files[0];
					
					Argv.append('TSVFile',File);
					Argv.append('menu','UploadTSV_File');
					
					$("#UploadingIcon").addClass('fa-spin');
					$("#UploadAdwordsTSV_BTN").css('background-color','#e03535');
					
					$.ajax({
						type: "POST",
						url: "?ajaxProcess",
						data: Argv,
						processData: false,
						contentType: false,
						xhr: function() {
							myXhr = $.ajaxSettings.xhr();
							return myXhr;
						},
						success: function(d){
							$("#UploadAdwordsTSV_BTN").css('background-color','#309df1');
							$("#UploadingIcon").removeClass('fa-spin');
							$("#AdWordsTSV_Fle").val("");
							var res = $.parseJSON(d);
							if(res.ack == 'success')
							{
								showSideMSGBox('<i class="fa fa-save"></i> Updated Successfully!','msgBox_One_1');
							}
							else if(res.error_msg != undefined && res.error_msg != "")
								showSideMSGBox(res.error_msg,'msgBox_One_2');
						}
					});
					
					
				}
			});
			
		};
		
	};
	var createCharts = new function(){
		this.init = function()
		{
			var Data;
			
			dateRange();
			drawChart({
				'DateFrom':dataFactorySend(0),
				'DateTo':dataFactorySend(0)
			});
			
			
			
		};
		
		Number.prototype.formatMoney = function(c, d, t){
			var n = this, 
				c = isNaN(c = Math.abs(c)) ? 2 : c, 
				d = d == undefined ? "." : d, 
				t = t == undefined ? "," : t, 
				s = n < 0 ? "-" : "", 
				i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))), 
				j = (j = i.length) > 3 ? j % 3 : 0;
			return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
		};
		
		var dateRange = function(){
			
			var todayDate = new Date(
				<?php echo $AtlantaTime->format('Y');?>,
				<?php echo $AtlantaTime->format('m') - 1;?>,
				<?php echo $AtlantaTime->format('d');?>,
				<?php echo $AtlantaTime->format('H');?>,
				<?php echo $AtlantaTime->format('i');?>,
				<?php echo $AtlantaTime->format('s');?>
			);
			
			$('input[name="daterange"]').daterangepicker({
				locale: {
					format: 'YYYY/MM/DD'
				},
				maxDate: todayDate,
				startDate: dataFactorySend(0),
				endDate: dataFactorySend(0)
			});
			
			$('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
				drawChart({
					'DateFrom' : picker.startDate.format('YYYY/MM/DD'),
					'DateTo' : picker.endDate.format('YYYY/MM/DD')	
				});

			});
			
			$(document).on(touchOrClick,".DateRange_BTN",function(){
				$(".DateRange_BTN").removeClass("DR_Selected");
				$(this).addClass("DR_Selected");
				var Ago = $(this).data('ago');
				
				var Go = true;
				
				if(Ago > 30)
				{
					Go = false;
					timconfirm('Notice','This may take some time.',function(){
						setDateAndGo(Ago);
					});
				}
				
				if(Go)
					setDateAndGo(Ago);
				
			});
			
			
		};
		
		var setDateAndGo = function(Ago){
			$('#requestChartDateRange_INP').data('daterangepicker').setStartDate(dataFactorySend(Ago));
			$('#requestChartDateRange_INP').data('daterangepicker').setEndDate(dataFactorySend((Ago == 1 ? Ago : 0 )));
			drawChart({
				'DateFrom':dataFactorySend(Ago),
				'DateTo':dataFactorySend((Ago == 1 ? Ago : 0 ))
			});
		};
		
		var dataFactory = function(Ago){
			var dateObj = new Date();
			if(Ago > 0)
			{
				dateObj.setDate(dateObj.getDate() - Ago);
			}
			dateTXT =
				(dateObj.getMonth() + 1) + "/" +
				(('0' + dateObj.getDate()).slice(-2) ) +
				"/"+dateObj.getFullYear();
			return dateTXT;
		};
		
		var dataFactorySend = function(Ago){
			var dateObj = new Date(
				<?php echo $AtlantaTime->format('Y');?>,
				<?php echo $AtlantaTime->format('m') - 1;?>,
				<?php echo $AtlantaTime->format('d');?>,
				<?php echo $AtlantaTime->format('H');?>,
				<?php echo $AtlantaTime->format('i');?>,
				<?php echo $AtlantaTime->format('s');?>
			);
			
			if(Ago > 0)
			{
				dateObj.setDate(dateObj.getDate() - Ago);
			}
			
			dateTXT =
				dateObj.getFullYear() + "/" +
				('0' + (dateObj.getMonth()+1)).slice(-2) + "/" +
				(('0' + dateObj.getDate()).slice(-2));
				
			return dateTXT;
		};
		
		var AgoDateFactory = function(givenDate, Year, Month, Day) {
			var dateObj = new Date(givenDate);
			
			dateObj = new Date((dateObj.getFullYear() + Year),(dateObj.getMonth() + Month),(dateObj.getDate() + Day));
			
			return dateObj;
		};
		
		var getDiffDate = function(From, To){
			return Math.round(Math.abs((From.getTime() - To.getTime())/(86400000)));
		};
		
		var drawChart = function(Data){
			$('#LoadingPage').fadeIn(1000);
			$("#DateRangeTop").html("(" + $('#requestChartDateRange_INP').data('daterangepicker').startDate.format('MM/DD/YYYY') + " ~ " + $('#requestChartDateRange_INP').data('daterangepicker').endDate.format('MM/DD/YYYY') + ")");
			$.ajax({
				type: "POST",
				url: "?ajaxProcess",
				data: "menu=getChartData&DateFrom="+Data['DateFrom']+"&DateTo="+Data['DateTo']+"&SKU="+$("#ItemSearch_INP").val(),
				success: function(d){
					
					var res = $.parseJSON(d);
					$('#LoadingPage').fadeOut(1000);
					if(res.ack == 'success')
					{
						
						$("#LastYear_Period").html((res.Y.From == res.Y.To ? res.Y.From : res.Y.From + " ~ " +res.Y.To ));
						$("#LastMonth_Period").html((res.M.From == res.M.To ? res.M.From : res.M.From + " ~ " +res.M.To ));
						$("#LastWeek_Period").html((res.W.From == res.W.To ? res.W.From : res.W.From + " ~ " +res.W.To ));
						
						TotalSaleSummary(res);
						if(res.Total_WalkIn != "undefined" && res.Total_Internet != "undefined")
						{
							
							createTotalSalesPIE(
								"Total : $"+parseFloat(res.Current.Total).formatMoney(2),
								[{
									name: 'Walk-in Customer',
									y: parseFloat(res.Current.Total_WalkIn)
								},{
									name: 'Internet',
									y: parseFloat(res.Current.Total_Internet),
									sliced: true,
									selected: true
								}]
							);
							
						}
						
						AdWordsTable(res.Adwords,'AdWordsTable');
						
						itemSalesTable(res.Items.ITN,'InternetItemSales');
						itemSalesTable(res.Items.WLK,'WalkingItemSales');
						
						var createDateRangeSaleGraph_Data = [];
						createDateRangeSaleGraph_Data[0] = 
						{
							name: 'Walk-In',
							data: JSON.parse(res.Date_Sales_Walking_Total)
							
						};
						
						createDateRangeSaleGraph_Data[1] = 
						{
							name: 'Internet',
							data: JSON.parse(res.Date_Sales_Internet_Total)
							
						};
						
						createDateRangeSaleGraph_Data[2] = 
						{
							name: 'Total',
							data: JSON.parse(res.Date_Sales_Total)
							
						};
						
							
							
							
						createDateRangeSaleGraph('Sales Graph',createDateRangeSaleGraph_Data);
						
					}
					else if(res.error_msg != undefined && res.error_msg != "")
						showSideMSGBox(res.error_msg,'msgBox_One_2');
				}
			});
			
			
		};
		
		var createDateRangeSaleGraph = function(Title, Data){
			
			
			Highcharts.stockChart('SalePeriod_Graph', {
				chart:
				{
					backgroundColor:'#f1f1f1'
				},
				
				rangeSelector: {
					selected: 1
				},
				credits: {
					enabled: false
				},
				title:{
					text : Title
				},
				
			
				series: Data
			});
		
		};
		
		var AdWordsTable = function(Data,Target)
		{
			var HTML = "";
			
			if(Data.length > 0)
			{
				for(var k in Data)
				{
					if(typeof Data[k] === "object")
					{
						HTML +=
							'<div class="ItemSales_One ItemSales_Row'+(Data[k]['Description'] == null ? ' NoRecordInPOS' : '')+'"'+(Data[k]['Description'] == null ? ' data-tooltip="Record does not exist in POS"' : '')+'>'+
								'<div class="IS_Name IS_Col"><a href="http://www.janilink.com/product_info.php?products_id='+Data[k]['Prd_ID']+'">'+Data[k]['Description']+'</a></div>'+
								'<div class="IS_SKU IS_Col">'+Data[k]['SKU']+'</div>'+
								'<div class="IS_Cost IS_Col">$'+parseFloat(Data[k]['Cost']).formatMoney(2)+'</div>'+
								'<div class="IS_Clicks IS_Col">'+Data[k]['Clicks']+'</div>'+
								'<div class="IS_Impressions IS_Col">'+Data[k]['Impressions']+'</div>'+
								'<div class="IS_SoldQTY IS_Col">'+Data[k]['SoldQTY']+'</div>'+
								'<div class="IS_ClickThrough IS_Col">'+Data[k]['ClickThrough']+'</div>'+
								'<div class="IS_TotalSold IS_Col">$'+parseFloat(Data[k]['Total']).formatMoney(2)+'</div>'+
								'<div class="IS_Profit IS_Col'+(Data[k]['Profitable'] == 1 ? (parseFloat(Data[k]['Profit']) > 0 ? ' ItemSales_Profitable' : '') : ' ItemSales_NonProfitable' )+'">$'+parseFloat(Data[k]['Profit']).formatMoney(2)+'</div>'+
								'<div class="IS_ItemType IS_Col'+(Data[k]['ItemType'] == 1 ? " ItemSales_Reg" : " ItemSales_Asm" )+'">'+(Data[k]['ItemType'] == 1 ? "REG" : "ASM" )+'</div>'+
								'<div class="IS_ReferSKU IS_Col">'+(Data[k]['ItemLookupCode_Single'] == null ? '' : Data[k]['ItemLookupCode_Single'])+'</div>'+
								
							'</div>'
						;
					}
				}
			}
			else
			{
				HTML = '<div class="bigTextinTable">No Data</div>';
			}
			
			
			
			$(".Report_Data[data-name='"+Target+"']").html(HTML);
		};
		var itemSalesTable = function(Data,Target){
			
			
			var HTML = "";
			if(Data.length > 0)
			{
				for(var k in Data)
				{
					if(typeof Data[k] === "object")
					{
						HTML +=
							'<div class="ItemSales_One ItemSales_Row">'+
								/*'<div class="IS_Dept IS_Col">'+(Data[k]['Dept'] == null ? "" :Data[k]['Dept'])+'</div>'+*/
								'<div class="IS_Name IS_Col">'+Data[k]['ItemName']+'</div>'+
								'<div class="IS_SKU IS_Col">'+Data[k]['SKU']+'</div>'+
								'<div class="IS_Qty IS_Col">'+Data[k]['QTY']+'</div>'+
								'<div class="IS_Price IS_Col">$'+parseFloat(Data[k]['Price']).formatMoney(2)+'</div>'+
								'<div class="IS_Total IS_Col">$'+parseFloat(Data[k]['Total']).formatMoney(2)+'</div>'+
								'<div class="IS_Profit IS_Col">$'+parseFloat(Data[k]['Profit']).formatMoney(2)+'</div>'+
							'</div>'
						;
					}
				}
			}
			else
			{
				
				HTML = '<div class="bigTextinTable">No Data</div>';

			}
			

			$(".Report_Data[data-name='"+Target+"']").html(HTML);
			
			
		};
		var TotalSaleSummary = function(Data){
			
			var saleUp = '<i class="fa fa-sort-up"></i>';
			var saleDown = '<i class="fa fa-sort-down"></i>';
			
			if(Data.hasOwnProperty('LastD'))
			{
				
				$("#summary_Yesterday .sstR_Total .sstR_Amt").html("$"+parseFloat(Data.LastD.Total).formatMoney(2));
				$("#summary_Yesterday .sstR_WalkIn .sstR_Amt").html("$"+parseFloat(Data.LastD.Total_WalkIn).formatMoney(2));
				$("#summary_Yesterday .sstR_Internet .sstR_Amt").html("$"+parseFloat(Data.LastD.Total_Internet).formatMoney(2));
				$("#summary_Yesterday .sstR_TotalProfit .sstR_Amt").html("$"+parseFloat(Data.LastD.Profit).formatMoney(2));
				$("#summary_Yesterday .sstR_AD .sstR_Amt").html("$"+parseFloat(Data.LastD.AdWords_Total).formatMoney(2));
				$("#summary_Yesterday .sstR_Customers .sstR_Amt").html(Data.LastD.Total_Customers);
				//$("#summary_Yesterday .sstR_OldNewW .sstR_Amt").html(Data.Visitor_LastD.Walk + " (" + Data.Visitor_LastD.Walk_New + "/" + Data.Visitor_LastD.Walk_Old + ")");
				
				$("#summary_Yesterday .sstR_Total .sstR_Status").html( (Data.LastD.Total > Data.Current.Total ? saleUp : saleDown) );
				$("#summary_Yesterday .sstR_WalkIn .sstR_Status").html( (Data.LastD.Total_WalkIn > Data.Current.Total_WalkIn ? saleUp : saleDown) );
				$("#summary_Yesterday .sstR_Internet .sstR_Status").html( (Data.LastD.Total_Internet > Data.Current.Total_Internet ? saleUp : saleDown) );
				$("#summary_Yesterday .sstR_TotalProfit .sstR_Status").html( (Data.LastD.Profit > Data.Current.Profit ? saleUp : saleDown) );
				$("#summary_Yesterday .sstR_AD .sstR_Status").html( (Data.LastD.AdWords_Total > Data.Current.AdWords_Total ? saleUp : saleDown) );
				
				
			}
			else
			{
				$("#summary_Yesterday .sstR_Total .sstR_Amt").html("Not Available");
				$("#summary_Yesterday .sstR_WalkIn .sstR_Amt").html("Not Available");
				$("#summary_Yesterday .sstR_Internet .sstR_Amt").html("Not Available");
				$("#summary_Yesterday .sstR_TotalProfit .sstR_Amt").html("Not Available");
				$("#summary_Yesterday .sstR_AD .sstR_Amt").html("Not Available");
				$("#summary_Yesterday .sstR_Customers .sstR_Amt").html("Not Available");
				
				$("#summary_Yesterday .sstR_Total .sstR_Status").html("");
				$("#summary_Yesterday .sstR_WalkIn .sstR_Status").html("");
				$("#summary_Yesterday .sstR_Internet .sstR_Status").html("");
				$("#summary_Yesterday .sstR_TotalProfit .sstR_Status").html("");
				$("#summary_Yesterday .sstR_AD .sstR_Status").html("");
			}
			
			
			$("#summary_Current .sstR_Total .sstR_Amt").html("$"+parseFloat(Data.Current.Total).formatMoney(2));
			$("#summary_Current .sstR_WalkIn .sstR_Amt").html("$"+parseFloat(Data.Current.Total_WalkIn).formatMoney(2));
			$("#summary_Current .sstR_Internet .sstR_Amt").html("$"+parseFloat(Data.Current.Total_Internet).formatMoney(2));
			$("#summary_Current .sstR_TotalProfit .sstR_Amt").html("$"+parseFloat(Data.Current.Profit).formatMoney(2));
			$("#summary_Current .sstR_AD .sstR_Amt").html("$"+parseFloat(Data.Current.AdWords_Total).formatMoney(2));
			$("#summary_Current .sstR_Customers .sstR_Amt").html(Data.Current.Total_Customers);
			$("#summary_Current .sstR_OldNewW .sstR_Amt").html(Data.Visitor_Current.Walk + " (" + Data.Visitor_Current.Walk_New + "/" + Data.Visitor_Current.Walk_Old + ")");
			$("#summary_Current .sstR_OldNewI .sstR_Amt").html(Data.Visitor_Current.Internet + " (" + Data.Visitor_Current.Internet_New + "/" + Data.Visitor_Current.Internet_Old + ")");
			
			$("#summary_LastYear .sstR_Total .sstR_Amt").html("$"+parseFloat(Data.LastY.Total).formatMoney(2));
			$("#summary_LastYear .sstR_WalkIn .sstR_Amt").html("$"+parseFloat(Data.LastY.Total_WalkIn).formatMoney(2));
			$("#summary_LastYear .sstR_Internet .sstR_Amt").html("$"+parseFloat(Data.LastY.Total_Internet).formatMoney(2));
			$("#summary_LastYear .sstR_TotalProfit .sstR_Amt").html("$"+parseFloat(Data.LastY.Profit).formatMoney(2));
			$("#summary_LastYear .sstR_AD .sstR_Amt").html("$"+parseFloat(Data.LastY.AdWords_Total).formatMoney(2));
			$("#summary_LastYear .sstR_Customers .sstR_Amt").html(Data.LastY.Total_Customers);
			$("#summary_LastYear .sstR_Total .sstR_Status").html( (Data.LastY.Total > Data.Total ? saleUp : saleDown) );
			$("#summary_LastYear .sstR_WalkIn .sstR_Status").html( (Data.LastY.Total_WalkIn > Data.Total_WalkIn ? saleUp : saleDown) );
			$("#summary_LastYear .sstR_Internet .sstR_Status").html( (Data.LastY.Total_Internet > Data.Total_Internet ? saleUp : saleDown) );
			$("#summary_LastYear .sstR_TotalProfit .sstR_Status").html( (Data.LastY.Profit > Data.Profit ? saleUp : saleDown) );
			$("#summary_LastYear .sstR_AD .sstR_Status").html( (Data.LastY.AdWords_Total > Data.AdWords_Total ? saleUp : saleDown) );
			$("#summary_LastYear .sstR_Customers .sstR_Status").html( (Data.LastY.Total_Customers > Data.Current.Total_Customers ? saleUp : saleDown) );
			$("#summary_LastYear .sstR_OldNewW .sstR_Amt").html(Data.Visitor_LastY.Walk + " (" + Data.Visitor_LastY.Walk_New + "/" + Data.Visitor_LastY.Walk_Old + ")");
			$("#summary_LastYear .sstR_OldNewI .sstR_Amt").html(Data.Visitor_LastY.Internet + " (" + Data.Visitor_LastY.Internet_New + "/" + Data.Visitor_LastY.Internet_Old + ")");
			
			$("#summary_LastMonth .sstR_Total .sstR_Amt").html("$"+parseFloat(Data.LastM.Total).formatMoney(2));
			$("#summary_LastMonth .sstR_WalkIn .sstR_Amt").html("$"+parseFloat(Data.LastM.Total_WalkIn).formatMoney(2));
			$("#summary_LastMonth .sstR_Internet .sstR_Amt").html("$"+parseFloat(Data.LastM.Total_Internet).formatMoney(2));
			$("#summary_LastMonth .sstR_TotalProfit .sstR_Amt").html("$"+parseFloat(Data.LastM.Profit).formatMoney(2));
			$("#summary_LastMonth .sstR_AD .sstR_Amt").html("$"+parseFloat(Data.LastM.AdWords_Total).formatMoney(2));
			$("#summary_LastMonth .sstR_Customers .sstR_Amt").html(Data.LastM.Total_Customers);
			$("#summary_LastMonth .sstR_Total .sstR_Status").html( (Data.LastM.Total > Data.Total ? saleUp : saleDown) );
			$("#summary_LastMonth .sstR_WalkIn .sstR_Status").html( (Data.LastM.Total_WalkIn > Data.Total_WalkIn ? saleUp : saleDown) );
			$("#summary_LastMonth .sstR_Internet .sstR_Status").html( (Data.LastM.Total_Internet > Data.Total_Internet ? saleUp : saleDown) );
			$("#summary_LastMonth .sstR_TotalProfit .sstR_Status").html( (Data.LastM.Profit > Data.Profit ? saleUp : saleDown) );
			$("#summary_LastMonth .sstR_AD .sstR_Status").html( (Data.LastM.AdWords_Total > Data.AdWords_Total ? saleUp : saleDown) );
			$("#summary_LastMonth .sstR_Customers .sstR_Status").html( (Data.LastM.Total_Customers > Data.Current.Total_Customers ? saleUp : saleDown) );
			$("#summary_LastMonth .sstR_OldNewW .sstR_Amt").html(Data.Visitor_LastM.Walk + " (" + Data.Visitor_LastM.Walk_New + "/" + Data.Visitor_LastM.Walk_Old + ")");
			$("#summary_LastMonth .sstR_OldNewI .sstR_Amt").html(Data.Visitor_LastM.Internet + " (" + Data.Visitor_LastM.Internet_New + "/" + Data.Visitor_LastM.Internet_Old + ")");
			
			$("#summary_LastWeek .sstR_Total .sstR_Amt").html("$"+parseFloat(Data.LastW.Total).formatMoney(2));
			$("#summary_LastWeek .sstR_WalkIn .sstR_Amt").html("$"+parseFloat(Data.LastW.Total_WalkIn).formatMoney(2));
			$("#summary_LastWeek .sstR_Internet .sstR_Amt").html("$"+parseFloat(Data.LastW.Total_Internet).formatMoney(2));
			$("#summary_LastWeek .sstR_TotalProfit .sstR_Amt").html("$"+parseFloat(Data.LastW.Profit).formatMoney(2));
			$("#summary_LastWeek .sstR_AD .sstR_Amt").html("$"+parseFloat(Data.LastW.AdWords_Total).formatMoney(2));
			$("#summary_LastWeek .sstR_Customers .sstR_Amt").html(Data.LastW.Total_Customers);
			$("#summary_LastWeek .sstR_Total .sstR_Status").html( (Data.LastW.Total > Data.Total ? saleUp : saleDown) );
			$("#summary_LastWeek .sstR_WalkIn .sstR_Status").html( (Data.LastW.Total_WalkIn > Data.Total_WalkIn ? saleUp : saleDown) );
			$("#summary_LastWeek .sstR_Internet .sstR_Status").html( (Data.LastW.Total_Internet > Data.Total_Internet ? saleUp : saleDown) );
			$("#summary_LastWeek .sstR_TotalProfit .sstR_Status").html( (Data.LastW.Profit > Data.Profit ? saleUp : saleDown) );
			$("#summary_LastWeek .sstR_AD .sstR_Status").html( (Data.LastW.AdWords_Total > Data.AdWords_Total ? saleUp : saleDown) );
			$("#summary_LastWeek .sstR_Customers .sstR_Status").html( (Data.LastW.Total_Customers > Data.Current.Total_Customers ? saleUp : saleDown) );
			$("#summary_LastWeek .sstR_OldNewW .sstR_Amt").html(Data.Visitor_LastW.Walk + " (" + Data.Visitor_LastW.Walk_New + "/" + Data.Visitor_LastW.Walk_Old + ")");
			$("#summary_LastWeek .sstR_OldNewI .sstR_Amt").html(Data.Visitor_LastW.Internet + " (" + Data.Visitor_LastW.Internet_New + "/" + Data.Visitor_LastW.Internet_Old + ")");
		};
		
		var createTotalSalesPIE = function(Title,Data){
			
			
			
			Highcharts.chart('TotalSalePIE', {
				chart:
				{
					plotBackgroundColor: null,
					backgroundColor:'#f1f1f1',
					plotBorderWidth: null,
					plotShadow: false,
					type: 'pie'
				},
				
				title: {
					text: Title
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				credits: {
					enabled: false
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: false
						},
						showInLegend: true
					}
				},
				series: [{
					name: 'Sales',
					colorByPoint: true,
					data: Data
				}]
			});
		};
	};
</script>

<h2 id="PG_Title">
	<div><i class="fa fa-folder-o"></i> Sales Report <span id="DateRangeTop"></span></div>
	
	<div id="LoadingPage"><i class="fa fa-gear fa-spin"></i> <u>Retrieving data</u> from POS Server...</div>
</h2>
<div id="PG_Menu">
	
	<div id="Print_BTN" data-tooltip="Print this page" class="Glow button button_white"><i id="UploadingIcon" class="fa fa-print"></i></div>
	<div id="UploadAdwordsTSV_BTN" data-tooltip="Upload AdWords .TSV File" class="Glow button button_blue"><i id="UploadingIcon" class="fa fa-cloud-upload"></i></div>
	<input type="file" name="AdWordsTSV_Fle" id="AdWordsTSV_Fle" />
	<div id="ItemSearchBox">
		<input type="text" id="ItemSearch_INP" placeholder="Insert SKU" />
	</div>
	<div class="button button_white" data-tooltip="Search" id="Search_Product"><i class="fa fa-search"></i></div>
	
</div>

<div id="PG_Contents">
	<div id="DateSelect">
		<div><input id="requestChartDateRange_INP" type="text" name="daterange" /></div>
		<div class="TopButton DateRange_BTN DR_Selected" data-ago="0">Today</div>
		<div class="TopButton DateRange_BTN" data-ago="1">Last Day</div>
		<div class="TopButton DateRange_BTN" data-ago="7">Past 7 Days</div>
		<div class="TopButton DateRange_BTN" data-ago="30">1 Month</div>
		<div class="TopButton DateRange_BTN" data-ago="90">3 Months</div>
		<div class="TopButton DateRange_BTN" data-ago="365">This Year</div>
		<div class="TopButton DateRange_BTN" data-ago="1095">3 Years</div>
		
	</div>
	<div class="w100 hidePrint" id="topSummaryBlock" data-targetprintid="0">
		<div class="oneTopReport" id="TotalSalePIE_Container">
			<div class="OTR_Title">
				Total Sales
			</div>
			<div id="TotalSalePIE" class="OTR_Desc"></div>
		</div>
		
		<div class="saleSummaryTable">
			<div class="OTR_Title">
				Sales Comparison
			</div>
			<div class="ssT_ReportContainer">
				<div class="ssT_R_Left_H">
					<div class="ssT_R_Left_H_Title">
						<div class="ssT_R_Left_Icn"><i class="fa fa-trophy"></i></div>
						<div>Total</div>
					</div>
					<div class="ssT_R_Left_H_Title">
						<div class="ssT_R_Left_Icn"><i class="fa fa-blind"></i></div>
						<div>Walk-In</div>
					</div>
					<div class="ssT_R_Left_H_Title">
						<div class="ssT_R_Left_Icn"><i class="fa fa-tty"></i></div>
						<div>Internet</div>
					</div>
					<div class="ssT_R_Left_H_Title">
						<div class="ssT_R_Left_Icn"><i class="fa fa-money"></i></div>
						<div>Profit</div>
					</div>
					<div class="ssT_R_Left_H_Title">
						<div class="ssT_R_Left_Icn"><i class="fa fa-google"></i></div>
						<div>AD</div>
					</div>
					<div class="ssT_R_Left_H_Title">
						<div class="ssT_R_Left_Icn"><i class="fa fa-users"></i></div>
						<div>Orders</div>
					</div>
					<div class="ssT_R_Left_H_Title">
						<div class="ssT_R_Left_Icn"><i class="fa fa-users"></i></div>
						<div>Walk-In (New/Old)</div>
					</div>
					<div class="ssT_R_Left_H_Title">
						<div class="ssT_R_Left_Icn"><i class="fa fa-users"></i></div>
						<div>Internet (New/Old)</div>
					</div>
				</div>
			
				<div class="ssT_ReportOne" id="summary_Current">
					<div class="sstR_Title">Target Date</div>
					<div class="sstR_Result">
						<div class="sstR_Total sstR_One">
							<span class="sstR_Amt"></span>
						</div>
						<div class="sstR_WalkIn sstR_One">
							<span class="sstR_Amt"></span>
						</div>
						<div class="sstR_Internet sstR_One">
							<span class="sstR_Amt"></span>
						</div>
						<div class="sstR_TotalProfit sstR_One">
							<span class="sstR_Amt"></span>
						</div>
						<div class="sstR_AD sstR_One">
							<span class="sstR_Amt"></span>
						</div>
						<div class="sstR_Customers sstR_One">
							<span class="sstR_Amt"></span>
						</div>
						<div class="sstR_OldNewW sstR_One">
							<span class="sstR_Amt"></span>
						</div>
						<div class="sstR_OldNewI sstR_One">
							<span class="sstR_Amt"></span>
						</div>
						
					</div>
				</div>
				
				<div class="ssT_ReportOne" id="summary_Yesterday">
					<div class="sstR_Title">Last Day</div>
					<div class="sstR_Result">
						<div class="sstR_Total sstR_One">
							<span class="sstR_Amt"></span>
							<span class="sstR_Status"></span>
						</div>
						<div class="sstR_WalkIn sstR_One">
							<span class="sstR_Amt"></span>
							<span class="sstR_Status"></span>
						</div>
						<div class="sstR_Internet sstR_One">
							<span class="sstR_Amt"></span>
							<span class="sstR_Status"></span>
						</div>
						<div class="sstR_TotalProfit sstR_One">
							<span class="sstR_Amt"></span>
							<span class="sstR_Status"></span>
						</div>
						<div class="sstR_AD sstR_One">
							<span class="sstR_Amt"></span>
							<span class="sstR_Status"></span>
						</div>
						<div class="sstR_Customers sstR_One">
							<span class="sstR_Amt"></span>
							<span class="sstR_Status"></span>
						</div>
						<div class="sstR_OldNewW sstR_One">
							<span class="sstR_Amt"></span>
						</div>
						<div class="sstR_OldNewI sstR_One">
							<span class="sstR_Amt"></span>
						</div>
					</div>
				</div>
				
				<div class="ssT_ReportOne" id="summary_LastWeek">
					<div class="sstR_Title">Last Week</div>
					<div class="sstR_Result">
						<div class="sstR_Total sstR_One">
							<span class="sstR_Amt"></span>
							<span class="sstR_Status"></span>
						</div>
						<div class="sstR_WalkIn sstR_One">
							<span class="sstR_Amt"></span>
							<span class="sstR_Status"></span>
						</div>
						<div class="sstR_Internet sstR_One">
							<span class="sstR_Amt"></span>
							<span class="sstR_Status"></span>
						</div>
						<div class="sstR_TotalProfit sstR_One">
							<span class="sstR_Amt"></span>
							<span class="sstR_Status"></span>
						</div>
						<div class="sstR_AD sstR_One">
							<span class="sstR_Amt"></span>
							<span class="sstR_Status"></span>
						</div>
						<div class="sstR_Customers sstR_One">
							<span class="sstR_Amt"></span>
							<span class="sstR_Status"></span>
						</div>
						<div class="sstR_OldNewW sstR_One">
							<span class="sstR_Amt"></span>
						</div>
						<div class="sstR_OldNewI sstR_One">
							<span class="sstR_Amt"></span>
						</div>
					</div>
				</div>
				
				<div class="ssT_ReportOne" id="summary_LastMonth">
					<div class="sstR_Title">Last Month</div>
					<div class="sstR_Result">
						<div class="sstR_Total sstR_One">
							<span class="sstR_Amt"></span>
							<span class="sstR_Status"></span>
						</div>
						<div class="sstR_WalkIn sstR_One">
							<span class="sstR_Amt"></span>
							<span class="sstR_Status"></span>
						</div>
						<div class="sstR_Internet sstR_One">
							<span class="sstR_Amt"></span>
							<span class="sstR_Status"></span>
						</div>
						<div class="sstR_TotalProfit sstR_One">
							<span class="sstR_Amt"></span>
							<span class="sstR_Status"></span>
						</div>
						<div class="sstR_AD sstR_One">
							<span class="sstR_Amt"></span>
							<span class="sstR_Status"></span>
						</div>
						<div class="sstR_Customers sstR_One">
							<span class="sstR_Amt"></span>
							<span class="sstR_Status"></span>
						</div>
						<div class="sstR_OldNewW sstR_One">
							<span class="sstR_Amt"></span>
						</div>
						<div class="sstR_OldNewI sstR_One">
							<span class="sstR_Amt"></span>
						</div>
					</div>
				</div>
				
				<div class="ssT_ReportOne" id="summary_LastYear">
					<div class="sstR_Title">Last Year</div>
					<div class="sstR_Result" style="border-right:0px;">
						<div class="sstR_Total sstR_One">
							<span class="sstR_Amt"></span>
							<span class="sstR_Status"></span>
						</div>
						<div class="sstR_WalkIn sstR_One">
							<span class="sstR_Amt"></span>
							<span class="sstR_Status"></span>
						</div>
						<div class="sstR_Internet sstR_One">
							<span class="sstR_Amt"></span>
							<span class="sstR_Status"></span>
						</div>
						<div class="sstR_TotalProfit sstR_One">
							<span class="sstR_Amt"></span>
							<span class="sstR_Status"></span>
						</div>
						<div class="sstR_AD sstR_One">
							<span class="sstR_Amt"></span>
							<span class="sstR_Status"></span>
						</div>
						<div class="sstR_Customers sstR_One">
							<span class="sstR_Amt"></span>
							<span class="sstR_Status"></span>
						</div>
						<div class="sstR_OldNewW sstR_One">
							<span class="sstR_Amt"></span>
						</div>
						<div class="sstR_OldNewI sstR_One">
							<span class="sstR_Amt"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	
	<div id="Report_Tab">
		<div class="RPT_Tab_Top">
			
			<div class="RPT_Title_One RPT_Title_Select" data-tabid="0">Advertisement ( Google AdWords )</div>
			<div class="RPT_Title_One" data-tabid="1">Internet</div>
			<div class="RPT_Title_One" data-tabid="2">Walk-In</div>
			<div class="RPT_Title_One" data-tabid="3">Charts</div>
			<div class="RPT_Title_One" data-tabid="4">Print Setting</div>
		</div>
		<div class="w100" data-targetprintid="1">
			<div class="RPT_Contents_One" data-tabid="0" >
				<div id="GoogleAdWords_Table">
					<div class="Report_Name" style="display:none;color:white;">We had started collecting Google Adwords data from <b><?php echo $dataFrom;?></b> to <b><?php echo $dataTo;?></b>). Previous data is not available. Therefore please keep in mind this when you change report date range.</div>
					<div class="ItemSales_One TB_Header">
						<div class="IS_Name IS_Col">Item Name</div>
						<div class="IS_SKU IS_Col">SKU</div>
						<div class="IS_Cost IS_Col">AD Cost</div>
						<div class="IS_Clicks IS_Col">Clicks</div>
						<div class="IS_Impressions IS_Col">Impressions</div>
						<div class="IS_SoldQTY IS_Col">QTY</div>
						<div class="IS_ClickThrough IS_Col">Click Rate</div>
						<div class="IS_TotalSold IS_Col">Total Sold</div>
						<div class="IS_Profit IS_Col">Profit</div>
						<div class="IS_ItemType IS_Col">Item Type</div>
						<div class="IS_ReferSKU IS_Col">Refer SKU</div>
						
						
					</div>
					<div class="Report_Data" data-name="AdWordsTable">
						
					</div>
				</div>
			</div>
		</div>
		<div class="w100" data-targetprintid="2">
			<div class="RPT_Contents_One" data-tabid="1" data-targetprintid="2">
				<div id="InternetItemSales_Table">
					<div class="Report_Name">Items Sold : <b>Internet</b> (Sort by Total Price)</div>
					<div class="ItemSales_One ItemSales_Header">
						<div class="IS_Name IS_Col">Item Name</div>
						<div class="IS_SKU IS_Col">SKU</div>
						<div class="IS_Qty IS_Col">Qty</div>
						<div class="IS_Price IS_Col">Price</div>
						<div class="IS_Total IS_Col">Total</div>
						<div class="IS_Profit IS_Col">Profit</div>
					</div>
					<div class="Report_Data" data-name="InternetItemSales">
						
					</div>
				</div>
				
			</div>
		</div>
		<div class="w100" data-targetprintid="3">
			<div class="RPT_Contents_One" data-tabid="2" data-targetprintid="3">
				<div id="InternetItemSales_Table">
					<div class="Report_Name">Items Sold : <b>Walk-in Customer</b> (Sort by Total Price)</div>
					<div class="ItemSales_One ItemSales_Header">
						<div class="IS_Name IS_Col">Item Name</div>
						<div class="IS_SKU IS_Col">SKU</div>
						<div class="IS_Qty IS_Col">Qty</div>
						<div class="IS_Price IS_Col">Price</div>
						<div class="IS_Total IS_Col">Total</div>
						<div class="IS_Profit IS_Col">Profit</div>
					</div>
					<div class="Report_Data" data-name="WalkingItemSales">
						
					</div>
				</div>
			</div>
		</div>
		<div class="w100" data-targetprintid="3">
			<div class="RPT_Contents_One" data-tabid="3" data-targetprintid="4">
				<div id="SalePeriod_Graph"></div>
			</div>
		</div>
		
		<div class="RPT_Contents_One hidePrint" data-tabid="4">
			<div class="w100">
				<div>
					<div class="PrintSetting_BTN Glow PrintSetting_Off" data-printid="0">Print Total</div>
					<div class="PrintSetting_BTN Glow PrintSetting_On" data-printid="1">Print Google Advertisement</div>
					<div class="PrintSetting_BTN Glow PrintSetting_On" data-printid="2">Print Internet Sales</div>
					<div class="PrintSetting_BTN Glow PrintSetting_On" data-printid="3">Print Walk-In Sales</div>
					<div class="PrintSetting_BTN Glow PrintSetting_On" data-printid="4">Print Charts</div>
				</div>
			</div>
		</div>
		
		
	</div>
	
	
	
	
	
	
	
</div>