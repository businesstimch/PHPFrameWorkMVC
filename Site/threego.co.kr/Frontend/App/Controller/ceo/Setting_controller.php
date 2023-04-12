<?
class ceoSetting_controller extends GGoRok
{
	function home()
	{
		
		$Data['title'] = '세팅 | 부르고';
		$Data['metaK'] = '세팅';
		$Data['metaD'] = '세팅';
		
		echo $this->Load->View('www/header.tpl',$Data);
		echo $this->Load->View('www/Setting.tpl',$Data);
		echo $this->Load->View('www/footer.tpl');
		//$this->_Android->Push(array('APA91bGTFufco5eh0s9KJwCSnxEyVErXZ4Colh2tLx-dws3Ikq-YWQoRt2tVGaQIGKmWLMP9Qhp0ZQcZhI6EyKl_8TGSG7WzHWIgViLb6TVjgAXieerrvAAqmXw2Oi4hOH0lkFido4DSo0FpglYRVpQMfL6k8t-IKQ'),array("message"=>"Test"));
	}
	
	
}
?>