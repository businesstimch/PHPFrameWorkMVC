<?
class calendar extends GGoRok
{
	
	var $Row_Header_Height = 3;
	
	function script()
	{
		?>
		/*<script>*/
		var oneCalendarCellSize;
		
		
		<?
	}
	function css()
	{
		?>
		/*<style>*/
		.Tim_Calendar_Tbl{width:100%;height:100%;}
		.Tim_Calendar_Tbl .Tim_C_Row_H{height:<?echo $this->Row_Header_Height;?>%;}
		.Tim_Calendar_Tbl th{border-bottom:1px solid white;}
		.Tim_Calendar_Tbl td{border-right:1px solid white;border-bottom:1px solid white;width:14%;color:gray;vertical-align:top;text-align:right;}
		.Tim_Calendar_Tbl .Tim_C_Col_Container{width:100%;height:100%;position:relative;}
		.Tim_Calendar_Tbl .Tim_C_Num{width:100%;margin-top:5px;position:relative;overflow:hidden;}
		.Tim_Calendar_Tbl .Tim_C_Num span{margin-right:5px;}
		.Tim_Calendar_Tbl .Tim_C_Col_Selected{background-color:#f4af36!important;}
		.Tim_Calendar_Tbl .Tim_C_Col_Selected *{color:white;}
		.Tim_Calendar_Tbl .Tim_C_Col_Empty{background-color:#e5e4ea!important;}
		.Tim_Calendar_Tbl .Tim_C_Today{background-color:#d5ecff;}
		
		
		<?
	}
	
	function getCalendar($Month ,$Year)
	{
		
		$Calendar_Html = '<table class="Tim_Calendar_Tbl">';
		
		$NumericDay_FirstDay = date('w',mktime(0,0,0,$Month,1,$Year));
		$DaysInMonth = date('t',mktime(0,0,0,$Month,1,$Year));
		$Today = mktime(0,0,0,date("m"),date("d"),date("Y"));
		
		$Days_Arr = array('Sun','Mon','Tues','Wed','Thu','Fri','Sat');
		$Month_Arr = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
		
		
		$Global_I = 1;
		
		
		$Calendar_Html .= '<tr class="Tim_C_Row_H">
										<th class="Tim_C_Col">'.$Days_Arr[0].'</th>
										<th class="Tim_C_Col">'.$Days_Arr[1].'</th>
										<th class="Tim_C_Col">'.$Days_Arr[2].'</th>
										<th class="Tim_C_Col">'.$Days_Arr[3].'</th>
										<th class="Tim_C_Col">'.$Days_Arr[4].'</th>
										<th class="Tim_C_Col">'.$Days_Arr[5].'</th>
										<th class="Tim_C_Col">'.$Days_Arr[6].'</th>
									</tr>
		';
		
		
		
		$Calendar_Html .= '<tr class="Tim_C_Row" style="[HeightCustom]">';
		for($i = 0;$i < $NumericDay_FirstDay;$i++)
		{
			$Calendar_Html .= '<td class="Tim_C_Col"></td>';
			$Global_I = $i;
		}
		
		$Global_I++;
		$Rows_Count = 1;
		for($i = 1;$i < $DaysInMonth + 1;$i++)
		{
			
			if($Global_I % 7 == 0)
			{
				$Calendar_Html .= '</tr><tr class="Tim_C_Row" style="[HeightCustom]">';
				$Rows_Count++;
			}
			
			$Calendar_Html .= '<td class="Tim_C_Col'.(mktime(0,0,0,$Month,$i,$Year) == $Today ? " Tim_C_Today":"").'" data-datestring="'.$Month_Arr[$Month-1].'/'.$i.'/'.$Year.'" data-date="'.$Year.'-'.str_pad($Month,2,"0",STR_PAD_LEFT).'-'.str_pad($i,2,"0",STR_PAD_LEFT).'"><div class="Tim_C_Col_Container"><div class="Tim_C_Num"><span>'.$i.'</span></div></div></td>';
			$Global_I++;
		}
		$Calendar_Html .= '</tr></table>
			<script type="text/javascript">
				$(".Tim_C_Col:empty").addClass("Tim_C_Col_Empty");
			</script>
		';
		
		$Calendar_Html = preg_replace('/\[HeightCustom\]/',"height:".number_format((100 / $Rows_Count - ($this->Row_Header_Height / $Rows_Count)),1)."%",$Calendar_Html);
		 
		return $Calendar_Html;
		
		
	}
	
	
}
?>