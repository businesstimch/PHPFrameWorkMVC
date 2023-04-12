<?

class CartCorpReportsNewOld_Model extends GGoRok_Model{
	
	function getChartData($Data)
	{
		return $this->db->QRY("
			SELECT
				Visitor_Date,
				Internet_Old,
				Internet_New,
				Walk_Old,
				Walk_New
			FROM
				gc_reports_pos_daily_visitor
			WHERE
				Visitor_Date >= '".$Data['DateFrom']."' AND
				Visitor_Date <= '".$Data['DateTo']."'
				/*AND DAYNAME( DATE( Visitor_Date ) ) = 'Monday'*/
				
				AND (DAYNAME( DATE( Visitor_Date ) ) != 'Saturday')
			ORDER BY
				Visitor_Date ASC
		");
	
	}
	
	function getVisitorByDay($Data)
	{
		
		return $this->mssql->QRY("
			SELECT
				SUM(CASE WHEN Customer.AccountNumber LIKE '%400%' THEN 1 ELSE 0 END) as Internet,
				SUM(CASE WHEN Customer.AccountNumber NOT LIKE '%400%' THEN 1 ELSE 0 END) as Walk,
				SUM(
					CASE WHEN
						Customer.AccountNumber
					LIKE '%400%' AND
					CONVERT(VARCHAR(10), [Customer].AccountOpened, 120) = CONVERT(VARCHAR(10), [Transaction].Time, 120)
						THEN 1 ELSE 0 END
				) as Internet_New,

				SUM(
					CASE WHEN
						Customer.AccountNumber
					LIKE '%400%' AND
					CONVERT(VARCHAR(10), [Customer].AccountOpened, 120) != CONVERT(VARCHAR(10), [Transaction].Time, 120)
					THEN 1 ELSE 0 END
				) as Internet_Old,

				SUM(
					CASE WHEN
						Customer.AccountNumber
					NOT LIKE '%400%' AND
					CONVERT(VARCHAR(10), [Customer].AccountOpened, 120) != CONVERT(VARCHAR(10), [Transaction].Time, 120)
						THEN 1 ELSE 0 END
				) as Walk_Old,
				
				SUM(
					CASE WHEN
						Customer.AccountNumber
					NOT LIKE '%400%' AND
					CONVERT(VARCHAR(10), [Customer].AccountOpened, 120) = CONVERT(VARCHAR(10), [Transaction].Time, 120)
						THEN 1 ELSE 0 END
				) as Walk_New,
				
				CONVERT(VARCHAR(10), [Transaction].Time, 120) AS Visitor_Date

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
				[Transaction].Time > Convert(DateTime,'".$Data['RefreshedOn']." 00:00:00',111) AND
				Cashier.inactive = 0
			GROUP BY

				CONVERT(VARCHAR(10), [Transaction].Time, 120)
				
			
		");
	}
	
	
	function updateNewOldDB($Data)
	{
		$Values = array();
		if(is_array($Data))
		{
			foreach($Data AS $_F)
			{
				$Values[] = "('".$_F['Visitor_Date']."','".$_F['Internet_Old']."','".$_F['Internet_New']."','".$_F['Walk_Old']."','".$_F['Walk_New']."')";
			}
		}
		
		if(sizeof($Values) > 0)
			$this->db->QRY(" 
				INSERT INTO
					gc_reports_pos_daily_visitor
					(
						Visitor_Date,
						Internet_Old,
						Internet_New,
						Walk_Old,
						Walk_New
					)
					VALUES
						".implode(',',$Values)."
						
				ON DUPLICATE KEY UPDATE
					Internet_Old = VALUES(Internet_Old),
					Internet_New = VALUES(Internet_New),
					Walk_Old = VALUES(Walk_Old),
					Walk_New = VALUES(Walk_New)
			");
	}
	
}

?>