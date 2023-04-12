<div id="PG_Contents">
	<div id="T1_Tab">
		<div id="T1_Tab_Menu">
			<div class="T1_Tab_One noSelect T1_Tab_Selected" data-tabid="1"><i class="fa fa-info"></i> General Information</div>
			<div class="T1_Tab_One noSelect" data-tabid="2"><i class="fa fa-money"></i> Payment</div>
			<div class="T1_Tab_One noSelect" data-tabid="3"><i class="fa fa-truck"></i> Shipping</div>
			<div class="T1_Tab_One noSelect" data-tabid="4"><i class="fa fa-forward"></i> Process Order</div>
		</div>
		
		<div class="T1_Tab_Content_One" data-tabid="1" style="display:block;">
		
			<div class="T1_Line_One">
				<div class="T1_T"><span>Checkout Type</span></div>
				<div class="T1_I">
					<?php echo $CheckoutType;?>
				</div>
			</div>
			
			<?php if($hasCustomerInfo){?>
			<div class="T1_Line_One">
				<div class="T1_T"><span>Customer Information</span></div>
				<div class="T1_I">
					<b>Name</b> : <?php echo $customerInfo['customers_firstname'].' '.$customerInfo['customers_firstname'];?><br />
					<b>Email </b> : <?php echo $customerInfo['customers_logon_id'];?><br />
					<b>Telephone</b> : <?php echo $customerInfo['customers_telephone'];?><br />
					<b>Fax</b> : <?php echo $customerInfo['customers_fax'];?>
				</div>
			</div>
			<?php }?>
			<div class="T1_Line_One">
				<div class="T1_T"><span>Ordered Products</span></div>
				<div class="T1_I">
					<?php echo $OrderedItems_HTML;?>
				</div>
			</div>
			
			<div class="T1_Line_One">
				<div class="T1_T"><span>Sub Total</span></div>
				<div class="T1_I">
					<?php echo $Orders_Subtotal;?>
				</div>
			</div>
			
			<div class="T1_Line_One">
				<div class="T1_T"><span>Shipping Cost</span></div>
				<div class="T1_I">
					<?php echo $Orders_ShippingCost;?>
				</div>
			</div>
			
			<div class="T1_Line_One">
				<div class="T1_T"><span>Tax</span></div>
				<div class="T1_I">
					<?php echo $Orders_Tax;?>
				</div>
			</div>
			
			<div class="T1_Line_One">
				<div class="T1_T"><span>Grand Total</span></div>
				<div class="T1_I">
					<?php echo $Orders_Grandtotal;?>
				</div>
			</div>
			
		</div>
		<div class="T1_Tab_Content_One" data-tabid="2">
			<?php echo $PaymentInfo;?>
		</div>
		<div class="T1_Tab_Content_One" data-tabid="3">
			<?php echo $ShipmentInfo;?>
		</div>
		<div class="T1_Tab_Content_One" data-tabid="4">
			<div class="T1_Line_One">
				<div class="T1_T"><span>Order Status</span></div>
				<div class="T1_I">
					<div class="w100"><?php echo $Order_Status_HTML;?></div>
					<div class="w100">
						<textarea id="ChangeOrderStatus_Memu_Txt" placeholder="Memo (Shipping Info, etc)"></textarea>
					</div>
					<div class="w100">
						<?php echo ($hasNotificationEmail ? '<input type="checkbox" id="NotifyCustomer_Chk" /> Notify Customer' : 'This customer didn\'t specify notification email.'  );?>
					</div>
					<div id="ChangeOrderStatus_Btn">Change Order Status</div>
				</div>
			</div>
			<div class="T1_Line_One">
				<div class="T1_T"><span>Order Status History</span></div>
				<div class="T1_I">
					<div id="OrderStatusHistory_Block" class="w100"><?php echo $Order_StatusHistory_HTML;?></div>
				</div>
			</div>
		</div>
	</div>
</div>