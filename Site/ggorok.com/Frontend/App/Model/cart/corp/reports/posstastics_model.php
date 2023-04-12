<?

class CartCorpReportsPosStastics_Model extends GGoRok_Model{
	
	function getChartData($Data)
	{
		return $this->db->QRY("
			SELECT
				Type,
				Amount,
				DateOn
			FROM
				gc_reports_pos_daily_total
			WHERE
				DateOn >= '".$Data['DateFrom']." 00:00:00' AND
				DateOn <= '".$Data['DateTo']." 23:59:59'
				/*AND DAYNAME( DATE( DateOn ) ) = 'Monday'*/
				
				AND (DAYNAME( DATE( DateOn ) ) != 'Saturday')
			ORDER BY
				DateOn ASC
		");
	
	}
	
	function getTotalSaleByDay($Data,$Type = 1)
	{
		
		return $this->mssql->QRY("
			SELECT
				convert(varchar(10), [Transaction].Time, 120) AS DateOn,
				SUM([Transaction].Total) AS Total
			FROM
				[Transaction]
					LEFT JOIN
						Customer WITH(NOLOCK)
					ON
						[Transaction].CustomerID = Customer.ID
					LEFT JOIN
						Cashier WITH(NOLOCK)
					ON
						[Transaction].CashierID = Cashier.ID
			
			WHERE
				[Transaction].Time > Convert(DateTime,'".$Data['RefreshedOn']."',111) AND				
				Cashier.inactive = 0
				
				".($Type == 2 ? " AND Customer.AccountNumber NOT LIKE '%400%'" : '')."
				".($Type == 3 ? " AND Customer.AccountNumber LIKE '%400%'" : '')."
				
			GROUP BY 
				convert(varchar(10), [Transaction].Time, 120)
			ORDER BY DateOn DESC
		");
	}
	
	function updateStasticsDB($Data,$Type)
	{
		$Values = array();
		if(is_array($Data))
		{
			foreach($Data AS $_F)
			{
				$Values[] = "('".$Type."','".$_F['Total']."','".$_F['DateOn']."')";
			}
		}
		
		if(sizeof($Values) > 0)
			$this->db->QRY(" 
				INSERT INTO
					gc_reports_pos_daily_total
					(
						Type,
						Amount,
						DateOn
					)
					VALUES
						".implode(',',$Values)."
						
				ON DUPLICATE KEY UPDATE
					Type = VALUES(Type),
					Amount = VALUES(Amount),
					DateOn = VALUES(DateOn)
			");
	}

}