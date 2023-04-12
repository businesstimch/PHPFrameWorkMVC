<?php
class wwwNotification_Controller extends GGoRok
{
	
	public function Push($_D)
	{
		$Model['Notification'] = $this->Load->Model('Notification');
		$Model['Notification']->Push(array(
			'customers_id' => $_D['customers_id'],
			'Notification_Type' => $_D['Notification_Type']
		));
	}
	
	public function Get($_D)
	{
		
		$Model['Notification'] = $this->Load->Model('Notification');
		$Result = $Model['Notification']->Get(array(
			'customers_id' => $_D['customers_id']
		));
		
		return $Result;
	}
	
	public function Notified($_D)
	{
		$Model['Notification'] = $this->Load->Model('Notification');
		$Result = $Model['Notification']->Notified(array(
			'customers_id' => $_D['customers_id'],
			'CreatedOn' => $_D['CreatedOn']
		));
		
		return $Result;
	}
}

?>