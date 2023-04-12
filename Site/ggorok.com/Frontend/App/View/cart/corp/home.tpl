<style type="text/css">
	.TopSum_Box{background-color:#00a9ea;color:white;min-width:150px;width:24%;border-radius:3px;margin-top:20px;margin-right:20px;overflow:hidden;}
	.TopSum_Box:last-child{margin-right:0px!important;}
	.TopSum_Box .TopSum_T{width:100%;height:30px;line-height:30px;padding-left:10px;padding-right:10px;box-sizing:border-box;}
	.TopSum_Box .TopSum_D{width:100%;height:100px;background-color:#16b4f1;border-top:1px dotted white;font-size:40px;line-height:100px;text-align:center;}
	#PG_Contents{width:100%;}
	#randomBible{color:gray;width:100%;margin-top:10px;}
</style>

<h2 id="PG_Title"><i class="fa fa-folder-o"></i> Dashboard</h2>
<div id="randomBible"><?php echo $Bible;?></div>
<div id="PG_Contents">
	<div id="TopSum_Pending" class="TopSum_Box">
		<div class="TopSum_T">PENDINGS ORDERS</div>
		<div class="TopSum_D">
			<?php echo $Orders['Pending'];?><span> Orders</span>
		</div>
	</div>
	<div id="TopSum_TotalSaleToday" class="TopSum_Box">
		<div class="TopSum_T">SALES</div>
		<div class="TopSum_D">
			<?php echo $Orders['Total'];?><span> Orders</span>
		</div>
	</div>
	<div id="TopSum_TotalCustomers" class="TopSum_Box">
		<div class="TopSum_T">REGISTERED CUSTOMERS</div>
		<div class="TopSum_D">
			..
		</div>
	</div>
	<div id="TopSum_TotalCustomers" class="TopSum_Box">
		<div class="TopSum_T">VISITORS</div>
		<div class="TopSum_D">
			..
		</div>
	</div>
</div>