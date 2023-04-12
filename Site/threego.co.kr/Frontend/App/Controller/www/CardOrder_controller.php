<?php

class wwwCardOrder_Controller extends GGoRok
{
	public $MaxPersonnel = 100000;
	
	public function MakeOrder($Data = null)
	{
		$output['ack'] = 'error';
		
		if(is_null($Data))
		{
			$Data = json_decode($_POST['Args'],TRUE);
			
		}
		
		if($this->login->isLogin())
		{
			$Data['customers_id'] = $this->login->customers_id;
			
			if(isset($Data['Mode']))
			{
				if(
					$Data['Mode'] == 'R' &&
					isset($Data['OReserv_Date']) &&
					isset($Data['OReserv_Time']) &&
					isset($Data['OReserv_Personnel']) &&
					(is_numeric($Data['OReserv_Personnel']) && $Data['OReserv_Personnel'] > 0 && $Data['OReserv_Personnel'] < $this->MaxPersonnel)
				)
				{
					$output['ack'] = 'success';
					$Data['OReserv_Time'] = date('Y-m-d H:i:s',strtotime($Data['OReserv_Date'].' '.$Data['OReserv_Time']));
					$output['OrderID'] = $this->_Model_CardOrder->makeReservation($Data);
					$output['success_msg'] = '
						<i class="fa fa-calendar-check-o"></i> <u>예약</u>을 완료 했습니다.<br /><br />
						예약번호 : <b style="color:#ffba00;">'.$output['OrderID'].'</b><br />
						예약날짜 : '.$Data['OReserv_Date'].'<br />
						예약시간 : '.$Data['OReserv_Time'].'<br />
						예약인원 : '.$Data['OReserv_Personnel'].'명
					';
				}
				else
					$output['error_msg'] = '불편을 드려 죄송합니다. 알 수 없는 에러가 발생 했습니다. 다시 시도 하시거나 문제가 지속될 경우 고객센터에 문의해 주시기 바랍니다.';
			}
			
		}
		else
			$output['error_msg'] = '원활한 주문처리를 위해 회원가입 혹은 로그인을 해주세요.';
		
		return $output;
	}
}

?>