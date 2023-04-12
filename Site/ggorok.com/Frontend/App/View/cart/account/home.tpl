<style type="text/css">
	#RightContainer{
		width: 100%;
		border: 1px solid #e3e3e3;
		border-radius: 5px;
		min-height: 300px;
	}
	.PG_SubTitle{color:gray;font-weight:bold;margin-bottom:5px;width:100%;}
	
	#RC_Contents{
		width:100%;
		padding: 0 20px 20px 20px;box-sizing:border-box;
	}
	.TopSum_Box {
		background-color: #00a9ea;
		color: white;
		min-width: 150px;
		width: 353px;
		border-radius: 3px;
		margin-right: 20px;
		overflow: hidden;
	}
	
	.TopSum_Box .TopSum_T {
		width: 100%;
		height: 30px;
		line-height: 30px;
		padding-left: 10px;
		padding-right: 10px;
		box-sizing: border-box;
	}
	
	.TopSum_Box .TopSum_D {
		width: 100%;
		height: 100px;
		background-color: #16b4f1;
		border-top: 1px dotted white;
		font-size: 40px;
		line-height: 100px;
		text-align: center;
	}
	#TopOrderSum_Container{margin-bottom:20px;}
	#TopSum_Total{margin-right:0!important;}
	#orderList_Container{width:100%;border:1px solid #e3e3e3;border-radius:5px;min-height:200px;margin-bottom:20px;}
	.noOrder_MSG{width:100%;text-align:center;color:gray;line-height:200px;}
	.oneDetil_Menu{width:353px;line-height:40px;border-radius:3px;border:1px solid #e3e3e3;text-align:center;margin-bottom:10px;background-color:#f7f7f7;cursor:pointer;}
	.oneDetil_Menu:hover{background-color:#ececec;font-weight:bold;}
	.oM_1{margin-right:16px;}
</style>

<script type="text/javascript">
	
	
</script>

<div id="RightContainer" class="w100">
	<div class="PG_Title">My Account</div>
	
	<div id="RC_Contents">
		
		<div class="PG_SubTitle">Your Orders</div>
		
		<div class="w100" id="TopOrderSum_Container">
			<div id="TopSum_Processing" class="TopSum_Box">
				<div class="TopSum_T">ORDERS PROCESSING</div>
				<div class="TopSum_D">
					2<span> Orders</span>
				</div>
			</div>
			
			<div id="TopSum_Total" class="TopSum_Box">
				<div class="TopSum_T">TOTAL ORDERS</div>
				<div class="TopSum_D">
					12<span> Orders</span>
				</div>
			</div>
		</div>
		
		<div class="PG_SubTitle">Order List</div>
		<div id="orderList_Container">
			<div class="noOrder_MSG">Orders Not Found</div>
		</div>
		
		<div class="PG_SubTitle">Account Details</div>
		<div class="w100">
			<a class="oneDetil_Menu oM_1 Glow Block" href="/account/profile">
				<i class="fa fa-address-card-o" aria-hidden="true"></i> Edit My Profile
			</a>
			<div class="oneDetil_Menu oM_2 Glow">
				<i class="fa fa-key" aria-hidden="true"></i> Change Password
			</div>
			<div class="oneDetil_Menu oM_1 Glow">
				<i class="fa fa-envelope-open-o" aria-hidden="true"></i> Delivery Address Book
			</div>
			<div class="oneDetil_Menu oM_2 Glow">
				<i class="fa fa-times-circle-o" aria-hidden="true"></i> Cancel My Account
			</div>
			
		</div>
	</div>
	
</div>