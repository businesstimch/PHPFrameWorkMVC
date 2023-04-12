<?php
class CartWork_Controller extends GGoRok
{
	var $hoursShouldWork = 40;
	
	function home()
	{
		$Work_Data[] = array('2016/10/10 09:00','2016/10/10 18:02','');
		$Work_Data[] = array('2016/10/11 08:43','2016/10/11 18:30','');
		$Work_Data[] = array('2016/10/12 09:01','2016/10/12 19:24','');
		$Work_Data[] = array('2016/10/13 08:53','2016/10/13 18:13','');
		$Work_Data[] = array('2016/10/14 08:56','2016/10/14 18:36','');
		
		$Work_Data[] = array('2016/10/17 08:32','2016/10/17 18:49','');
		$Work_Data[] = array('2016/10/18 08:58','2016/10/18 21:20','예비군 훈련 14:00 ~ 18:00');
		$Work_Data[] = array('2016/10/19 08:51','2016/10/19 20:29','');
		$Work_Data[] = array('2016/10/20 09:10','2016/10/20 18:42','');
		$Work_Data[] = array('2016/10/21 08:50','2016/10/21 18:20','');
	
		$Work_Data[] = array('2016/10/24 08:35','2016/10/24 20:40','');
		$Work_Data[] = array('2016/10/25 08:46','2016/10/25 21:33','');
		$Work_Data[] = array('2016/10/26 20:00','2016/10/26 23:00','일본 출장가서, 3시간 업무');
		
		$Work_Data[] = array('2016/11/01 08:24','2016/11/01 20:32','');
		$Work_Data[] = array('2016/11/02 08:23','2016/11/02 18:37','');
		$Work_Data[] = array('2016/11/03 08:20','2016/11/03 22:25','');
		$Work_Data[] = array('2016/11/04 08:46','2016/11/04 19:28','');
		
		$Work_Data[] = array('2016/11/07 09:01','2016/11/07 19:20','');
		$Work_Data[] = array('2016/11/08 08:45','2016/11/08 20:23','');
		$Work_Data[] = array('2016/11/09 09:05','2016/11/09 19:59','');
		$Work_Data[] = array('2016/11/10 08:47','2016/11/10 19:04','');
		$Work_Data[] = array('2016/11/11 08:59','2016/11/11 19:26','');
		$Work_Data[] = array('2016/11/14 09:01','2016/11/14 19:23','');
		$Work_Data[] = array('2016/11/15 08:50','2016/11/15 23:48','');
		$Work_Data[] = array('2016/11/16 08:55','2016/11/16 20:20','');
		$Work_Data[] = array('2016/11/17 08:48','2016/11/17 18:18','');
		$Work_Data[] = array('2016/11/18 08:55','2016/11/18 17:50','');
		
		$Work_Data[] = array('2016/11/21 00:00','2016/11/21 00:00','일본 출장');
		$Work_Data[] = array('2016/11/22 09:14','2016/11/22 18:14','');
		$Work_Data[] = array('2016/11/23 08:11','2016/11/23 19:11','');
		$Work_Data[] = array('2016/11/24 08:58','2016/11/24 15:58','오후에 잠시 나가서 4시간 뺌');
		$Work_Data[] = array('2016/11/25 09:25','2016/11/25 19:25','');
		
		$Work_Data[] = array('2016/11/28 09:06','2016/10/28 19:28','');
		$Work_Data[] = array('2016/11/29 08:58','2016/10/29 03:59','');
		$Work_Data[] = array('2016/11/30 16:00','2016/10/30 21:01','');
		
		$Work_Data[] = array('2016/12/01 08:56','2016/12/02 01:01','');
		$Work_Data[] = array('2016/12/02 09:10','2016/12/02 22:25','');
		$Work_Data[] = array('2016/12/05 08:58','2016/12/05 20:45','');
		$Work_Data[] = array('2016/12/06 09:02','2016/12/06 18:45','');
		$Work_Data[] = array('2016/12/07 08:58','2016/12/08 02:07','');
		$Work_Data[] = array('2016/12/08 11:00','2016/12/08 20:07','');
		$Work_Data[] = array('2016/12/09 09:04','2016/12/09 18:35','');
		
		$Work_Data[] = array('2016/12/12 09:00','2016/12/12 20:31','');
		$Work_Data[] = array('2016/12/13 09:07','2016/12/13 20:51','');
		$Work_Data[] = array('2016/12/14 10:07','2016/12/14 21:19','');
		$Work_Data[] = array('2016/12/15 08:57','2016/12/15 20:38','');
		$Work_Data[] = array('2016/12/16 09:07','2016/12/17 01:31','');
		$Work_Data[] = array('2016/12/19 09:02','2016/12/19 22:40','');
		$Work_Data[] = array('2016/12/20 09:00','2016/12/20 19:31','');
		
		$Paid_Data[] = array('2016/10/31');
		$Paid_Data[] = array('2016/11/18');
		
		$Calendar = new DatePeriod(
			new DateTime($Work_Data[0][0]),
			new DateInterval('P1D'),
			new DateTime($Work_Data[sizeof($Work_Data) - 1][0])
		);
		
		$MAIN_HTML = '
			<div id="WorkTable">
				<div class="From H Col">출근시간</div>
				<div class="To H Col">퇴근시간</div>
				<div class="Hours H Col">근무시간</div>
				<div class="Memo H Col">메모</div>
		';
		foreach($Calendar AS $_K => $_F)
		{
			$hasData = false;
			$Weekend = ($_F->format('l') == 'Saturday' ? ' Saturday' : '' );
			$Weekend = ($_F->format('l') == 'Sunday' ? ' Sunday' : $Weekend );
			
			
			$dateInxStack = (isset($dateInxStack) ? $dateInxStack : $_F->format('N'));
			$totalHours = (!isset($totalHours) ? array(
				'H' => 0, 'M' => 0
			) : $totalHours);
			
			if($_F->format('N') < $dateInxStack)
			{
				
				$HTxt = round($totalHours['H']+($totalHours['M'] / 60));
				$MTxt = round($totalHours['M'] % 60);
				
				if($HTxt > $this->hoursShouldWork)
				{
					$WTxt = '( '.(round(($totalHours['H']+($totalHours['M'] / 60))) - $this->hoursShouldWork).'시간 '.$MTxt.'분 초과근무 )';
				}
				else
				{
					$WTxt = '( '.(round($totalHours['H']+($totalHours['M'] / 60)) - $this->hoursShouldWork).'시간 부족근무 )';
				}
				
				
				$MAIN_HTML .= '
					<div class="oneDate totalHours">
						윗 주 근무시간 총 : '.$HTxt.'시간 '.$MTxt.'분'.$WTxt.'
					</div>
				
				';
				$totalHours['H'] = 0;
				$totalHours['M'] = 0;
			}
			
			foreach($Work_Data AS $K => $_F2)
			{
				$D_Temp = new DateTime($_F2[0]);
				
				if($_F->format('Y/m/d') == $D_Temp->format('Y/m/d'))
				{
					$hasData = true;
					
					$Interval = date_diff(date_create($_F2[0]),date_create($_F2[1]));
					
					
					
					$MAIN_HTML .=
						'<div class="oneDate'.($_F2[0] == $_F2[1] ? ' noWork':'').$Weekend.'">'.
							'<div class="From Col">'.$_F2[0].'</div>'.
							'<div class="To Col">'.$_F2[1].'</div>'.
							'<div class="Hours Col">'.$Interval->format('%H:%I').'</div>'.
							'<div class="Memo Col">'.$_F2[2].'</div>';
					
					if(preg_match('/\:/',$Interval->format('%H:%I')))
					{
						$hoursTmp = explode(":",$Interval->format('%H:%I'));
						$totalHours['H'] += $hoursTmp[0];
						$totalHours['M'] += $hoursTmp[1];
					}
					
					foreach($Paid_Data AS $PD_F)
					{
						$D_Temp = new DateTime($PD_F[0]);
						if($D_Temp->format('Y/m/d') == $_F->format('Y/m/d'))
						{
							$MAIN_HTML .=
								'<div class="subDate">'.
									'<div class="Paid Col">Labor Paid</div>'.
								'</div>';
						}
					}
					
					$MAIN_HTML .=
						'</div>';
						
						/*
					if($_F->format('l') == 'Saturday' || $_F->format('l') == 'Sunday')
					{
						
					}
					else
					{
					
					}
					*/
					unset($Work_Data[$K]);
				}
				
				
			}
			
			$dateInxStack = $_F->format('N');
			
			if(!$hasData)
			{
				
				
				$MAIN_HTML .=
					'<div class="oneDate noWork'.$Weekend.'">'.
						'<div class="From Col">'.$_F->format('Y/m/d').'</div>';
						
				
				foreach($Paid_Data AS $PD_F)
				{
					$D_Temp = new DateTime($PD_F[0]);
					if($D_Temp->format('Y/m/d') == $_F->format('Y/m/d'))
					{
						$MAIN_HTML .=
							'<div class="subDate">'.
								'<div class="Paid Col">Labor Paid</div>'.
							'</div>';
					}
				}
				
				$MAIN_HTML .=
					'</div>';
			}
			
			
			
			
		}
		$MAIN_HTML .= '</div>';
		echo $this->Load->View('cart/work.tpl',array(
			'MAIN_HTML' => $MAIN_HTML
		));
	}
	
	
}

?>