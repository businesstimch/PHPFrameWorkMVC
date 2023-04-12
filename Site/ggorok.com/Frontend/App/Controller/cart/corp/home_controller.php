<?php
class CartCorpHome_Controller extends GGoRok
{
	var $_isAdminPage = true;

	function home()
	{

		$Data['title'] = 'Admin Dashboard | GGoRok Cart';
		$Data['metaK'] = 'GGoRok';
		$Data['metaD'] = 'GGoRok';
		$Data['CurrentCategory'] = '';

		$Data['MAIN_HTML'] = $this->Load->View('cart/corp/home.tpl', array(
			'Bible' => $this->_Bible->getRandomVerse(),
			'Orders' => $this->_Orders->getOrders(array(
				"Status" => 1
			))
		));

		echo $this->loadHeader($Data);

	}

	function loadHeader($Data = array())
	{

		$AdminMenu = $this->_Model_Admin_Header->getCategory();
		foreach($AdminMenu AS $_K => $_C)
		{
			$AdminMenu[$_K]['isCurrent'] = ($_C['is_DoorMenu'] == 1 && (isset($Data['CurrentCategory']) && $_C['AM_Name'] == $Data['CurrentCategory']) ? TRUE : FALSE);
		}
		$Data['AdminMenu'] = $AdminMenu;

		return $this->Load->View('cart/corp/header.tpl',$Data);
	}




}


?>
