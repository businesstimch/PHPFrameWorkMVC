<?php

foreach($Employees AS $_F)
{
	echo '<div>'.
			$_F['customers_firstname'].
			$_F['customers_lastname'].
			'</div>';
}
?>