<?php
class CartAttendanceHome_Controller extends GGoRok
{
	private $BranchID = 1;
	
	function home()
	{
		
		echo $this->Load->View('cart/header_blank.tpl',array(
			'title' => 'GGoRok Cart',
			'metaK' => '',
			'metaD' => '',
			'login_token' => $this->token->login_token(true)
		));
		
		$Employees = $this->db->QRY("
			SELECT
				*
			FROM
				gc_employees E
					LEFT JOIN
						gc_customers C
					ON
						C.customers_id = E.customers_id
			WHERE
				employee_branchee_id = ".$this->BranchID." AND
				employee_status = 1
				
		");

		echo $this->Load->View('cart/attendance/home.tpl', array(
			'Employees' => $Employees
		));
		echo $this->Load->View('cart/footer_blank.tpl');
	}
}

?>