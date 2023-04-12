<?

class _Pagination extends GGoRok
{
	
	function paging_color_hash($v_curr_page=1, $v_total_count=0, $v_per_page = 20, $color = '#a6a6a6', $b_color='#1', $show_total=false)
	{
		$previous_btn = true;
		$next_btn = true;
		$first_btn = true;
		$last_btn = true;

		$cur_page = $v_curr_page;
		if($v_total_count > 0)
			$no_of_paginations = ceil($v_total_count/$v_per_page);
		else
			$no_of_paginations = 0;
		
		$start_loop=1;
		$end_loop=1;
		$msg='';
		
		if ($cur_page >= 10)
		{
			$start_loop = $cur_page - 5;
			
			if ($no_of_paginations > $cur_page + 5)
				$end_loop = $cur_page + 5;
			else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 9)
			{
				$start_loop = $no_of_paginations - 9;
				$end_loop = $no_of_paginations;
			}
			else
			{
				$end_loop = $no_of_paginations;
			}
		}
		else
		{
			$start_loop = 1;
			if ($no_of_paginations > 10)
				$end_loop = 10;
			else
				$end_loop = $no_of_paginations;
		}
		
		$msg .= "<div class='pagination'><ul>";
		
		// FOR ENABLING THE FIRST BUTTON
		if ($first_btn && $cur_page > 1)
		{
			$msg .= "<a href='#pg=1' class='active' id='1'>First</a>";
		}
		else if ($first_btn)
		{
			$msg .= "<a href='#pg=1' class='inactive' id='1'>First</a>";
		}
		
		// FOR ENABLING THE PREVIOUS BUTTON
		if ($previous_btn && $cur_page > 1)
		{
			$pre = $cur_page - 1;
			$msg .= "<a href='#pg=$pre' class='active' id='$pre'>Prev</a>";
		}
		else if ($previous_btn)
		{
			//$msg .= "<li class='inactive'>Prev</li>";
			$msg .= "<a href='#' class='inactive' id=''>Prev</a>";
		}
		
		for ($i = $start_loop; $i <= $end_loop; $i++)
		{
			if ($cur_page == $i)
				$msg .= "<a href='#pg=$i' style='color:$color;background-color:$b_color;' class='active' id='$i'>{$i}</a>";
			else
				$msg .= "<a href='#pg=$i' class='active' id='$i'>{$i}</a>";
				
		}
		
		// TO ENABLE THE NEXT BUTTON
		if ($next_btn && $cur_page < $no_of_paginations)
		{
			$nex = $cur_page + 1;
			$msg .= "<a href='#pg=$nex' class='active' id='$nex'>Next</a>";
		}
		else if ($next_btn)
		{
			//$msg .= "<li class='inactive'>Next</li>";
			//$msg .= "<a href='#' class='inactive' id='$nex'>Next</a>";
			$msg .= "<a href='#' class='inactive' id=''>Next</a>";
		}
		
		// TO ENABLE THE END BUTTON
		if ($last_btn && $cur_page < $no_of_paginations)
		{
			$msg .= "<a href='#pg=$no_of_paginations' class='active' id='$no_of_paginations'>Last</a>";
		}
		else if ($last_btn)
		{
			$msg .= "<a href='#pg=$no_of_paginations' class='inactive' id='$no_of_paginations'>Last</a>";
		}
		
		$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b>,   TOTAL ".$v_total_count."</span>";
		if($show_total)
		{
			//$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/><input type='button' id='go_btn' class='go_button' value='Go'/>";
			//$msg = $msg . "</ul>" . $goto . $total_string . "</div>";  // Content for pagination
			$msg = $msg . "</ul>" . $total_string . "</div>";  // Content for pagination
		}
		$msg = $msg . "</ul> </div>";  // Content for pagination
		return $msg;
		
	}
	
	
	function paging_hash($v_curr_page=1, $v_total_count=0, $v_per_page = 20, $show_total=false)
	{
		$previous_btn = true;
		$next_btn = true;
		$first_btn = true;
		$last_btn = true;

		$cur_page = $v_curr_page;
		if($v_total_count > 0)
			$no_of_paginations = ceil($v_total_count/$v_per_page);
		else
			$no_of_paginations = 0;
		
		$start_loop=1;
		$end_loop=1;
		$msg='';
		
		if ($cur_page >= 10)
		{
			$start_loop = $cur_page - 5;
			
			if ($no_of_paginations > $cur_page + 5)
				$end_loop = $cur_page + 5;
			else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 9)
			{
				$start_loop = $no_of_paginations - 9;
				$end_loop = $no_of_paginations;
			}
			else
			{
				$end_loop = $no_of_paginations;
			}
		}
		else
		{
			$start_loop = 1;
			if ($no_of_paginations > 10)
				$end_loop = 10;
			else
				$end_loop = $no_of_paginations;
		}
		
		$msg .= "<div class='pagination'><ul>";
		
		// FOR ENABLING THE FIRST BUTTON
		if ($first_btn && $cur_page > 1)
		{
			$msg .= "<a href='#pg=1' class='active' id='1'>First</a>";
		}
		else if ($first_btn)
		{
			$msg .= "<a href='#pg=1' class='inactive' id='1'>First</a>";
		}
		
		// FOR ENABLING THE PREVIOUS BUTTON
		if ($previous_btn && $cur_page > 1)
		{
			$pre = $cur_page - 1;
			$msg .= "<a href='#pg=$pre' class='active' id='$pre'>Prev</a>";
		}
		else if ($previous_btn)
		{
			//$msg .= "<li class='inactive'>Prev</li>";
			$msg .= "<a href='#' class='inactive' id=''>Prev</a>";
		}
		
		for ($i = $start_loop; $i <= $end_loop; $i++)
		{
			if ($cur_page == $i)
				$msg .= "<a href='#pg=$i' style='color:#fff;background-color:#da3a3a;' class='active' id='$i'>{$i}</a>";
			else
				$msg .= "<a href='#pg=$i' class='active' id='$i'>{$i}</a>";
				
		}
		
		// TO ENABLE THE NEXT BUTTON
		if ($next_btn && $cur_page < $no_of_paginations)
		{
			$nex = $cur_page + 1;
			$msg .= "<a href='#pg=$nex' class='active' id='$nex'>Next</a>";
		}
		else if ($next_btn)
		{
			//$msg .= "<li class='inactive'>Next</li>";
			//$msg .= "<a href='#' class='inactive' id='$nex'>Next</a>";
			$msg .= "<a href='#' class='inactive' id=''>Next</a>";
		}
		
		// TO ENABLE THE END BUTTON
		if ($last_btn && $cur_page < $no_of_paginations)
		{
			$msg .= "<a href='#pg=$no_of_paginations' class='active' id='$no_of_paginations'>Last</a>";
		}
		else if ($last_btn)
		{
			$msg .= "<a href='#pg=$no_of_paginations' class='inactive' id='$no_of_paginations'>Last</a>";
		}
		
		$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b>,   TOTAL ".$v_total_count."</span>";
		if($show_total)
		{
			//$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/><input type='button' id='go_btn' class='go_button' value='Go'/>";
			//$msg = $msg . "</ul>" . $goto . $total_string . "</div>";  // Content for pagination
			$msg = $msg . "</ul>" . $total_string . "</div>";  // Content for pagination
		}
		$msg = $msg . "</ul> </div>";  // Content for pagination
		return $msg;
		
	}
	
	function pagination_hash($v_curr_page=1, $v_total_page=0, $v_per_page = 20, $show_total=false)
	{
		$previous_btn = true;
		$next_btn = true;
		$first_btn = true;
		$last_btn = true;

		$cur_page = $v_curr_page;
		$no_of_paginations = $v_total_page;
		$start_loop=1;
		$end_loop=1;
		$msg='';
		
		if ($cur_page >= 10)
		{
			$start_loop = $cur_page - 5;
			
			if ($no_of_paginations > $cur_page + 5)
				$end_loop = $cur_page + 5;
			else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 9)
			{
				$start_loop = $no_of_paginations - 9;
				$end_loop = $no_of_paginations;
			}
			else
			{
				$end_loop = $no_of_paginations;
			}
		}
		else
		{
			$start_loop = 1;
			if ($no_of_paginations > 10)
				$end_loop = 10;
			else
				$end_loop = $no_of_paginations;
		}
		
		$msg .= "<div class='pagination'><ul>";
		
		// FOR ENABLING THE FIRST BUTTON
		if ($first_btn && $cur_page > 1)
		{
			$msg .= "<a href='#pg=1' class='active' id='1'>First</a>";
		}
		else if ($first_btn)
		{
			$msg .= "<a href='#pg=1' class='inactive' id='1'>First</a>";
		}
		
		// FOR ENABLING THE PREVIOUS BUTTON
		if ($previous_btn && $cur_page > 1)
		{
			$pre = $cur_page - 1;
			$msg .= "<a href='#pg=$pre' class='active' id='$pre'>Prev</a>";
		}
		else if ($previous_btn)
		{
			//$msg .= "<li class='inactive'>Prev</li>";
			$msg .= "<a href='#' class='inactive' id=''>Prev</a>";
		}
		
		for ($i = $start_loop; $i <= $end_loop; $i++)
		{
			if ($cur_page == $i)
				$msg .= "<a href='#pg=$i' style='color:#fff;background-color:#da3a3a;' class='active' id='$i'>{$i}</a>";
			else
				$msg .= "<a href='#pg=$i' class='active' id='$i'>{$i}</a>";
				
		}
		
		// TO ENABLE THE NEXT BUTTON
		if ($next_btn && $cur_page < $no_of_paginations)
		{
			$nex = $cur_page + 1;
			$msg .= "<a href='#pg=$nex' class='active' id='$nex'>Next</a>";
		}
		else if ($next_btn)
		{
			//$msg .= "<li class='inactive'>Next</li>";
			//$msg .= "<a href='#' class='inactive' id='$nex'>Next</a>";
			$msg .= "<a href='#' class='inactive' id=''>Next</a>";
		}
		
		// TO ENABLE THE END BUTTON
		if ($last_btn && $cur_page < $no_of_paginations)
		{
			$msg .= "<a href='#pg=$no_of_paginations' class='active' id='$no_of_paginations'>Last</a>";
		}
		else if ($last_btn)
		{
			$msg .= "<a href='#pg=$no_of_paginations' class='inactive' id='$no_of_paginations'>Last</a>";
		}
		
		$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
		if($show_total)
		{
			//$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/><input type='button' id='go_btn' class='go_button' value='Go'/>";
			//$msg = $msg . "</ul>" . $goto . $total_string . "</div>";  // Content for pagination
			$msg = $msg . "</ul>" . $total_string . "</div>";  // Content for pagination
		}
		$msg = $msg . "</ul> </div>";  // Content for pagination
		return $msg;
		
	}
	
    function pagination($v_curr_page=1, $v_total_page=0, $v_per_page = 20)
	{
		$previous_btn = true;
		$next_btn = true;
		$first_btn = true;
		$last_btn = true;

		$cur_page = $v_curr_page;
		$no_of_paginations = $v_total_page;
		$start_loop=1;
		$end_loop=1;
		$msg='';
		
		if ($cur_page >= 7)
		{
			$start_loop = $cur_page - 3;
			
			if ($no_of_paginations > $cur_page + 3)
				$end_loop = $cur_page + 3;
			else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6)
			{
				$start_loop = $no_of_paginations - 6;
				$end_loop = $no_of_paginations;
			}
			else
			{
				$end_loop = $no_of_paginations;
			}
		}
		else
		{
			$start_loop = 1;
			if ($no_of_paginations > 7)
				$end_loop = 7;
			else
				$end_loop = $no_of_paginations;
		}
		
		$msg .= "<div class='pagination'><ul>";
		
		// FOR ENABLING THE FIRST BUTTON
		if ($first_btn && $cur_page > 1)
		{
			
			$msg .= "<li p='1' class='active'>First</li>";
		}
		else if ($first_btn)
		{
			$msg .= "<li p='1' class='inactive'>First</li>";
		}
		
		// FOR ENABLING THE PREVIOUS BUTTON
		if ($previous_btn && $cur_page > 1)
		{
			$pre = $cur_page - 1;
			$msg .= "<li p='$pre' class='active'>Prev</li>";
		}
		else if ($previous_btn)
		{
			$msg .= "<li class='inactive'>Prev</li>";
		}
		
		for ($i = $start_loop; $i <= $end_loop; $i++)
		{
			if ($cur_page == $i)
				$msg .= "<li p='$i' style='color:#fff000;background-color:#da3a3a;' class='active'>{$i}</li>";
			else
				$msg .= "<li p='$i' class='active'>{$i}</li>";
		}
		
		// TO ENABLE THE NEXT BUTTON
		if ($next_btn && $cur_page < $no_of_paginations)
		{
			$nex = $cur_page + 1;
			$msg .= "<li p='$nex' class='active'>Next</li>";
		}
		else if ($next_btn)
		{
			$msg .= "<li class='inactive'>Next</li>";
		}
		
		// TO ENABLE THE END BUTTON
		if ($last_btn && $cur_page < $no_of_paginations)
		{
			$msg .= "<li p='$no_of_paginations' class='active'>Last</li>";
		}
		else if ($last_btn)
		{
			$msg .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
		}
		//$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/><input type='button' id='go_btn' class='go_button' value='Go'/>";
		$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
		//$msg = $msg . "</ul>" . $goto . $total_string . "</div>";  // Content for pagination
		$msg = $msg . "</ul>" . $total_string . "</div>";  // Content for pagination
		return $msg;
		
	}
	
    
}  
?>