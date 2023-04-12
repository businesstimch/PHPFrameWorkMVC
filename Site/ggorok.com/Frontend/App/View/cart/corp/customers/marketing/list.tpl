<?php


foreach($OrderList AS $_F)
{?>
	<div class="List_One List_Contents hand Glow" data-oid="<?php echo $_F['orders_id'];?>" data-ready="<?php echo ($_F['review_email_sent'] == 0 && $_F['review_email_sent'] == 0 ? 1 : 0)?>">
		<div class="LC_ID List_Col center"><?php echo $_F['orders_id'];?></div>
		<div class="LC_CustomerName List_Col"><?php echo $_F['customers_name'];?></div>
		<div class="LC_Email List_Col"><?php echo $_F['customers_email_address'];?></div>
		
		<div class="LC_Clicked List_Col center <?php echo ($_F['Clicked'] ? 'ActivatedColor' : '');?>"><i class="fa fa-check-circle"></i></div>
		<div class="LC_GotReview List_Col center <?php echo ($_F['GotReview'] ? 'ActivatedColor' : '');?>"><i class="fa fa-check-circle"></i></div>
		<div class="LC_OptIn List_Col center <?php echo ($_F['review_email_opt_in'] ? 'ActivatedColor' : '');?>"><i class="fa fa-check-circle"></i></div>
		<div class="LC_Sent List_Col center <?php echo ($_F['review_email_sent'] ? 'ActivatedColor' : '');?>"><i class="fa fa-check-circle"></i></div>
		<div class="LC_Status List_Col center"><?php echo $_F['orders_status_name'];?></div>
		<div class="LC_DayAgo List_Col center"><?php echo $_F['DateAgo'];?> day<?php echo ($_F['DateAgo'] > 1 ? 's':'');?> ago</div>
	</div>
<?}


if(sizeof($OrderList) == 0)
	echo '<div class="List_One List_Contents hand Glow" style="text-align:center;">No Data</div>';

?>

<div class="Pagination">
	<?php
	
	foreach($Pagination AS $_K => $_F )
	{
		
		echo '<a '.($_F ? '' : 'href="?'.preg_replace('/ajaxProcess\=\&/','',addGetURL(array('PG' => $_K)))).'" class="PG_One'.($_F ? ' PG_Current' : '').'">'.$_K.'</a>';
	}
		
	
	?>
</div>