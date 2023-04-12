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
	
	.SplineGraph{width:100%;height:700px;margin-bottom:10px;}
	
	
</style>

<script src="/Core/JS/Highstocks/js/highstock.js"></script>
<script type="text/javascript" src="/Core/JS/datePicker/moment.min.js"></script>
<script type="text/javascript" src="/Core/JS/datePicker/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="/Core/JS/datePicker/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="/Core/JS/datePicker/daterangepicker.css" />


<script type="text/javascript">
	$(document).ready(function(){
		createCharts.init();
	});
	
	var createCharts = new function(){
		this.init = function()
		{
			var Data;
			
			dateRange();
			
			
			drawChart({
				'DateFrom':dataFactorySend(365*10),
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
				startDate: dataFactorySend(365*10),
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
						
						
						var TotalSales_Data = [];
						var TotalSalesWalkIn_Data = [];
						var TotalSalesInt_Data = [];
						
						TotalSales_Data[0] = 
						{
							name: 'Total',
							data: JSON.parse(res.TotalSales)
						};
						
						TotalSalesWalkIn_Data[0] = 
						{
							name: 'Total',
							data: JSON.parse(res.TotalSalesWalkIn)
							
						};
						
						TotalSalesInt_Data[0] = 
						{
							name: 'Total',
							data: JSON.parse(res.TotalSalesInt)
							
						};
						
						
						
						
						
						
						
						createDateRangeSaleGraph('SaleTotal_Graph','Total Sales (Walk in + Internet)',TotalSales_Data);
						createDateRangeSaleGraph('SaleTotalWalkIn_Graph','Sales : Walk-In',TotalSalesWalkIn_Data);
						createDateRangeSaleGraph('SaleTotalInt_Graph','Sales : Internet',TotalSalesInt_Data);
						
					}
					else if(res.error_msg != undefined && res.error_msg != "")
						showSideMSGBox(res.error_msg,'msgBox_One_2');
				}
			});
			
			
		};
		
		var createDateRangeSaleGraph = function(Obj, Title, Data){
			
			
			Highcharts.stockChart(Obj, {
				chart:
				{
					type: 'areaspline',
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
				
				yAxis: {
						
					min: 0 // this sets minimum values of y to 0
				},
			
				series: Data,
				
				rangeSelector: {
        selected: 100
    },
				
				annotations: [{
					labelOptions: {
						 backgroundColor: 'rgba(255,255,255,0.5)',
						 verticalAlign: 'top',
						 y: 15
					}
				}]
			});
		
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
		
	};
	
</script>

<h2 id="PG_Title">
	<div><i class="fa fa-folder-o"></i> Sales Flow Reports <span id="DateRangeTop"></span></div>
	
	<div id="LoadingPage"><i class="fa fa-gear fa-spin"></i> <u>Retrieving data</u> from POS Server...</div>
</h2>
<div class="w100">Note : This report is including refund amount as well. (Example : Total $1000 = Sale $900 + Refund $100 )</div>
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
	</div>
	<div class="w100 hidePrint" id="topSummaryBlock" data-targetprintid="0">
		
		<div id="SaleTotal_Graph" class="SplineGraph"></div>
		<div id="SaleTotalWalkIn_Graph" class="SplineGraph"></div>
		<div id="SaleTotalInt_Graph" class="SplineGraph"></div>
		
		
	</div>
	
	
	
	
	
	
	
	
	
</div>