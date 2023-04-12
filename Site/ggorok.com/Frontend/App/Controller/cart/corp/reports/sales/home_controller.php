<?php
class CartCorpReportsSalesHome_Controller extends GGoRok
{
	var $localTime;
	var $Old_DB;
	function __construct()
	{
		$this->localTime = $this->localTime();
		//echo $this->localTime->format('Y-m-d, H:i:s');

		$this->mssql->connect(array(
			'DB_Name' => 'JANIRMS2DB',
			'DB_Server' => '24.99.17.15\JANIRMS2DB,1433',
			'DB_UserName' => 'sa',
			'DB_Password' => 'janilinkDaniel'
		));

		$this->Old_DB = new $this->db;
		$this->Old_DB->connect(array(
			'DB_Name' => 'janilink_new',
			'DB_Server' => '76.74.252.180',
			'DB_UserName' => 'remote',
			'DB_Password' => 'MJaCall@MQNb^!%'
		));


	}
	function home()
	{

		$Data['title'] = 'Sales Report | GGoRok Cart';
		$Data['metaK'] = 'GGoRok';
		$Data['metaD'] = 'GGoRok';
		$Data['CurrentCategory'] = '';
		$minMaxAdWords = $this->db->QRY("
			SELECT
				min(DateOn) as dataFrom,
				max(DateOn) as dataTo
			FROM
				gc_reports_pos_Items_adwords
		");
		$this->syncDBwithPOS();

		$Data['MAIN_HTML'] = $this->Load->View('cart/corp/reports/sales/home.tpl', array(
			'dataFrom' => (sizeof($minMaxAdWords) > 0 ? $minMaxAdWords[0]['dataFrom'] : '--'),
			'dataTo' => (sizeof($minMaxAdWords) > 0 ? $minMaxAdWords[0]['dataTo'] : '--'),
			'AtlantaTime' => $this->localTime,
			'TimeNow'=> $this->localTime->format('Y-m-d, H:i:s')
		));

		$Home_Controller = $this->Load->Controller('cart/corp/home');


		echo $Home_Controller->loadHeader($Data);

	}
	private function localTime()
	{
		$LocalNow = new DateTime("now", new DateTimeZone('America/New_York'));
		$LocalNow->setTimestamp(time());
		return $LocalNow;
	}
	function syncDBwithPOS()
	{
		$DBrefreshedOn = $this->db->QRY("
			SELECT
				*
			FROM
				gc_reports_pos_refreshed
		");

		foreach($DBrefreshedOn AS $_F)
		{
			$RefreshOn[$_F['RefreshType']] = $_F['RefreshedOn'];
		}

		$this->db->QRY("UPDATE gc_reports_pos_refreshed SET RefreshedOn = '".$this->localTime->format('Y-m-d, H:i:s')."' WHERE RefreshType = 'Items'");
		$Items = $this->mssql->QRY("
			SELECT
				ID,
				Description,
				ItemLookupCode,
				DepartmentID,
				CategoryID,
				ExtendedDescription
			FROM
				Item
			WHERE
				LastUpdated >= Convert(DateTime,'".$RefreshOn['Items']."',111)
		");


		foreach($Items AS $Items_F)
		{
			$this->db->QRY("
				INSERT INTO
					gc_reports_pos_Items
					(
						ItemID,
						ItemLookupCode,
						DeprartmentID,
						CategoryID,
						Description
					)
					VALUES
					(
						'".$this->db->escape($Items_F['ID'])."',
						'".$this->db->escape($Items_F['ItemLookupCode'])."',
						'".$this->db->escape($Items_F['DepartmentID'])."',
						'".$this->db->escape($Items_F['CategoryID'])."',
						'".$this->db->escape($Items_F['Description'].($Items_F['ExtendedDescription'] != ""? " ".$Items_F['ExtendedDescription'] : "" ))."'
					)
					ON DUPLICATE KEY UPDATE
						ItemID = ItemID,
						ItemLookupCode = '".$this->db->escape($Items_F['ItemLookupCode'])."',
						DeprartmentID = '".$this->db->escape($Items_F['DepartmentID'])."',
						CategoryID = '".$this->db->escape($Items_F['CategoryID'])."',
						Description = '".$this->db->escape($Items_F['Description'].($Items_F['ExtendedDescription'] != ""? " ".$Items_F['ExtendedDescription'] : "" ))."'
			");

		}

		$this->db->QRY("UPDATE gc_reports_pos_refreshed SET RefreshedOn = '".$this->localTime->format('Y-m-d, H:i:s')."' WHERE RefreshType = 'Transactions'");

		$Transactions = $this->_Model_cart_corp_reports_sales->getTransaction($RefreshOn);

		foreach($Transactions AS $_F)
		{
			$this->db->QRY("
				INSERT INTO
					gc_reports_pos_transactions
					(
						TransactionID,
						ItemID,
						QTY_Sold,
						Total,
						Cost,
						Profit,
						Price,
						SoldOn,
						isInternet
					)
					VALUES
					(
						'".$this->db->escape($_F['TransactionNumber'])."',
						'".$this->db->escape($_F['ItemID'])."',
						'".$this->db->escape($_F['Quantity17'])."',
						'".$this->db->escape(round($_F['Total'],2))."',
						'".$this->db->escape(round($_F['Cost'],2))."',
						'".$this->db->escape(round($_F['Profit'],2))."',
						'".$this->db->escape(round($_F['Price18'],2))."',
						'".$this->db->escape($_F['Time'])."',
						'".(preg_match('/400/',$_F['AccountNumber']) ? 1 : 0)."'
					)
					ON DUPLICATE KEY UPDATE
						TransactionID = TransactionID,
						ItemID = '".$this->db->escape($_F['ItemID'])."',
						QTY_Sold = '".$this->db->escape($_F['Quantity17'])."',
						Total = '".$this->db->escape(round($_F['Total'],2))."',
						Cost = '".$this->db->escape(round($_F['Cost'],2))."',
						Profit = '".$this->db->escape(round($_F['Profit'],2))."',
						Price = '".$this->db->escape(round($_F['Price18'],2))."',
						SoldOn = '".$this->db->escape($_F['Time'])."',
						isInternet = '".(preg_match('/400/',$_F['AccountNumber']) ? 1 : 0)."'
			");

		}

		$ItemClassComponent = $this->mssql->QRY("
			SELECT
				ID,
				ItemClassID,
				ItemID,
				Quantity,
				Price
			FROM
				ItemClassComponent
			WHERE
				LastUpdated >= Convert(DateTime,'".$RefreshOn['ItemsAssembly']."',111)
			ORDER BY
				ID ASC
		");



		foreach($ItemClassComponent AS $ItemsC_F)
		{

			$this->db->QRY("
				INSERT INTO
					gc_reports_pos_assembly_components
					(
						ID,
						ItemClassID,
						ItemID,
						Quantity,
						Price
					)
					VALUES
					(
						'".$this->db->escape($ItemsC_F['ID'])."',
						'100000".$this->db->escape($ItemsC_F['ItemClassID'])."',
						'".$this->db->escape($ItemsC_F['ItemID'])."',
						'".$this->db->escape($ItemsC_F['Quantity'])."',
						'".$this->db->escape($ItemsC_F['Price'])."'
					)
					ON DUPLICATE KEY UPDATE
						ID = ID,
						ItemClassID = '".$this->db->escape($ItemsC_F['ItemClassID'])."',
						ItemID = '".$this->db->escape($ItemsC_F['ItemID'])."',
						Quantity = '".$this->db->escape($ItemsC_F['Quantity'])."',
						Price = '".$this->db->escape($ItemsC_F['Price'])."'
			");

		}


		/*Assembly Item table in POS doesn't have last updated time stamp. We have to update regular time basis, not everyday. */
		$needUpdateAssembly = $this->db->QRY("
			SELECT
				*
			FROM
				gc_reports_pos_refreshed
			WHERE
				RefreshType = 'ItemsAssembly' AND
				RefreshedOn <= (NOW() - INTERVAL 1 DAY)
		");

		if(sizeof($needUpdateAssembly) > 0)
		{
			//$this->db->QRY("UPDATE gc_reports_pos_refreshed SET RefreshedOn = '".$this->localTime->format('Y-m-d, H:i:s')."' WHERE RefreshType = 'ItemsAssembly'");
			/*All Assembly Items*/
			$ItemClass = $this->mssql->QRY("
				SELECT
					ID,
					Description,
					ItemLookupCode,
					DepartmentID,
					CategoryID,
					Description
				FROM
					ItemClass
				ORDER BY
					ID ASC
			");

			foreach($ItemClass AS $Items_F)
			{

				$MostExpensiveItemInAssemblyItem = $this->db->QRY("
					SELECT
						PI.ItemLookupCode
					FROM
						gc_reports_pos_assembly_components PAC
							LEFT JOIN
								gc_reports_pos_Items PI
							ON
								PAC.ItemID = PI.ItemID
					WHERE
						PAC.ItemClassID = '".$Items_F['ID']."'
					ORDER BY
						PAC.Price DESC
					LIMIT
						1
				");

				$this->db->QRY("
					INSERT INTO
						gc_reports_pos_Items
						(
							ItemID,
							ItemLookupCode,
							DeprartmentID,
							CategoryID,
							Description,
							ItemType,
							ItemLookupCode_Single
						)
						VALUES
						(
							'100000".$this->db->escape($Items_F['ID'])."',
							'".$this->db->escape($Items_F['ItemLookupCode'])."',
							'".$this->db->escape($Items_F['DepartmentID'])."',
							'".$this->db->escape($Items_F['CategoryID'])."',
							'".$this->db->escape($Items_F['Description'].($Items_F['Description'] != ""? " ".$Items_F['Description'] : "" ))."',
							2,
							'".(sizeof($MostExpensiveItemInAssemblyItem) > 0 ? $this->db->escape($MostExpensiveItemInAssemblyItem[0]['ItemLookupCode']) : '')."'
						)
						ON DUPLICATE KEY UPDATE
							ItemID = ItemID,
							ItemLookupCode = '".$this->db->escape($Items_F['ItemLookupCode'])."',
							DeprartmentID = '".$this->db->escape($Items_F['DepartmentID'])."',
							CategoryID = '".$this->db->escape($Items_F['CategoryID'])."',
							Description = '".$this->db->escape($Items_F['Description'].($Items_F['Description'] != ""? " ".$Items_F['Description'] : "" ))."',
							ItemType = 2,
							ItemLookupCode_Single = ".(sizeof($MostExpensiveItemInAssemblyItem) > 0 ? "'".$this->db->escape($MostExpensiveItemInAssemblyItem[0]['ItemLookupCode'])."'" : 'ItemLookupCode_Single')."
				");

			}
		}





	}

	function customSyncTransaction($From = null, $To = null)
	{

		$Transactions = $this->mssql->QRY("
			SELECT
				[Transaction].TransactionNumber,
				Item.ID as ItemID,
				Item.ItemLookupCode,
				Item.Quantity,
				convert(varchar(10), [Transaction].Time, 101) as SoldDateTXT,
				TransactionEntry.Quantity as Quantity17,
				TransactionEntry.Price as Price18,
				TransactionEntry.Price * TransactionEntry.Quantity AS Total,
				convert(varchar(23), [Transaction].Time, 121) as Time,
				TransactionEntry.Cost,
				TransactionEntry.Price - TransactionEntry.Cost AS Profit,
				CASE WHEN
					TransactionEntry.Price <> 0
				THEN
					((TransactionEntry.Price - TransactionEntry.Cost) / TransactionEntry.Price) ELSE 0 END AS ProfitMargin,
					ReasonCodeDiscount.Description as Description25,
					ReasonCodeTaxChange.Description as Description26,
					ReasonCodeReturn.Description as Description27,

				Customer.AccountNumber

					FROM
						TransactionEntry
					INNER JOIN
						[Transaction] WITH(NOLOCK)
					ON
						TransactionEntry.TransactionNumber = [Transaction].TransactionNumber and
						TransactionEntry.ItemType <> 9
					INNER JOIN
						Batch WITH(NOLOCK)
					ON
						[Transaction].BatchNumber = Batch.BatchNumber
					LEFT JOIN
						Item WITH(NOLOCK)
					ON
						TransactionEntry.ItemID = Item.ID
					LEFT JOIN
						Department WITH(NOLOCK)
					ON
						Item.DepartmentID = Department.ID
					LEFT JOIN
						Category WITH(NOLOCK)
					ON
						Item.CategoryID = Category.ID
					LEFT JOIN
						Supplier WITH(NOLOCK)
					ON
						Item.SupplierID = Supplier.ID
					LEFT JOIN
						ReasonCode AS ReasonCodeDiscount WITH(NOLOCK)
					ON
						TransactionEntry.DiscountReasonCodeID = ReasonCodeDiscount.ID
					LEFT JOIN
						ReasonCode AS ReasonCodeTaxChange WITH(NOLOCK)
					ON
						TransactionEntry.TaxChangeReasonCodeID = ReasonCodeTaxChange.ID
					LEFT JOIN
						ReasonCode AS ReasonCodeReturn WITH(NOLOCK)
					ON
						TransactionEntry.ReturnReasonCodeID = ReasonCodeReturn.ID
					LEFT JOIN
						Register WITH(NOLOCK)
					ON
						Batch.RegisterID = Register.ID
					LEFT JOIN
						Customer WITH(NOLOCK)
					ON
						[Transaction].CustomerID = Customer.ID
					LEFT JOIN
						Cashier WITH(NOLOCK)
					ON
						[Transaction].CashierID = Cashier.ID
					LEFT JOIN
						QuantityDiscount WITH(NOLOCK)
					ON
						TransactionEntry.QuantityDiscountID = QuantityDiscount.ID

				WHERE
					[Transaction].Time >= Convert(DateTime,'".$From." 00:00:00',111) AND
					Cashier.inactive = 0
				ORDER BY
					Total DESC

		");


		foreach($Transactions AS $_F)
		{
			$this->db->QRY("
				INSERT INTO
					gc_reports_pos_transactions
					(
						TransactionID,
						ItemID,
						QTY_Sold,
						Total,
						Cost,
						Profit,
						Price,
						SoldOn,
						isInternet
					)
					VALUES
					(
						'".$this->db->escape($_F['TransactionNumber'])."',
						'".$this->db->escape($_F['ItemID'])."',
						'".$this->db->escape($_F['Quantity17'])."',
						'".$this->db->escape(round($_F['Total'],2))."',
						'".$this->db->escape(round($_F['Cost'],2))."',
						'".$this->db->escape(round($_F['Profit'],2))."',
						'".$this->db->escape(round($_F['Price18'],2))."',
						'".$this->db->escape($_F['Time'])."',
						'".(preg_match('/400/',$_F['AccountNumber']) ? 1 : 0)."'
					)
					ON DUPLICATE KEY UPDATE
						TransactionID = TransactionID,
						ItemID = '".$this->db->escape($_F['ItemID'])."',
						QTY_Sold = '".$this->db->escape($_F['Quantity17'])."',
						Total = '".$this->db->escape(round($_F['Total'],2))."',
						Cost = '".$this->db->escape(round($_F['Cost'],2))."',
						Profit = '".$this->db->escape(round($_F['Profit'],2))."',
						Price = '".$this->db->escape(round($_F['Price18'],2))."',
						SoldOn = '".$this->db->escape($_F['Time'])."',
						isInternet = '".(preg_match('/400/',$_F['AccountNumber']) ? 1 : 0)."'
			");

		}
	}

	function UploadTSV_File()
	{
		$output['ack'] = 'error';
		if(isset($_FILES["TSVFile"]))
		{
			$UploadPath = __UploadPath__.'temp/';

			$Extention = pathinfo(basename($_FILES["TSVFile"]["name"]), PATHINFO_EXTENSION);

			if(strtolower($Extention) != 'tsv')
			{
				$output['error_msg'] = 'Please upload .tsv file.';
			}
			else
			{
				if(!is_dir($UploadPath))
					mkdir($UploadPath,0775,true);



				move_uploaded_file($_FILES["TSVFile"]["tmp_name"], $UploadPath.$_FILES["TSVFile"]["name"]);

				$TSVFileToProcess = $this->parse_tsv->Load($_FILES["TSVFile"]["name"],$UploadPath);

				foreach($TSVFileToProcess AS $_F)
				{
					if(isset($_F[1]) && $_F[0] != "" && is_numeric($_F[0]))
					{
						$PrdIDsInReport[] = $_F[0];
					}
				}

				$PrdIDsInReport = array_unique($PrdIDsInReport);
				$ItemSKUinWeb = array();
				if(sizeof($PrdIDsInReport) > 0)
				{
					$Jani = $this->Old_DB->QRY("
						SELECT
							P.products_id,
							P.products_model
						FROM
							products P
						WHERE
							P.products_id IN (".implode(',',$PrdIDsInReport).")
					");


					foreach($Jani AS $_F)
					{
						$ItemSKUinWeb[$_F['products_id']] = $_F['products_model'];
					}
				}

				foreach($TSVFileToProcess AS $_F)
				{
					if(isset($_F[1]) && $_F[0] != "")
					{
						$Date = date('Y-m-d',strtotime(preg_replace('/"/','',$_F[1])));
						$this->db->QRY("
							INSERT INTO
								gc_reports_pos_Items_adwords
								(
									Prd_ID,
									SKU,
									DateOn,
									Clicks,
									Cost,
									Impressions
								)
								VALUES
								(
									'".$this->db->escape($_F[0])."',
									'".$this->db->escape((isset($ItemSKUinWeb[$_F[0]]) ? $ItemSKUinWeb[$_F[0]] : NULL))."',
									'".$this->db->escape($Date)."',
									'".$this->db->escape(preg_replace("/[^\.0-9]/","",$_F[2]))."',
									'".preg_replace('/\$/','',$this->db->escape(preg_replace("/[^\.0-9]/","",$_F[3])))."',
									'".$this->db->escape(preg_replace("/[^\.0-9]/","",$_F[4]))."'
								)

								ON DUPLICATE KEY UPDATE
									CostID = CostID,
									Clicks = '".$this->db->escape(preg_replace("/[^\.0-9]/","",$_F[2]))."',
									Cost = '".preg_replace('/\$/','',$this->db->escape(preg_replace("/[^\.0-9]/","",$_F[3])))."',
									Impressions = '".$this->db->escape(preg_replace("/[^\.0-9]/","",$_F[4]))."'
						");
					}

				}


				unlink($UploadPath.$_FILES["TSVFile"]["name"]);
				$output['ack'] = 'success';
			}
		}


		return $output;
	}
	function validateDate($Args)
	{
		$Date = explode('/',$Args);
		if(sizeof($Date) == 3)
		{
			if(
				(is_numeric($Date[0]) &&
				is_numeric($Date[1]) &&
				is_numeric($Date[2]))
			)
			{
				return true;
			}
		}

		return false;
	}

	function getChartData($Data = null)
	{
		$output['ack'] = 'error';

		if(isset($_POST['DateFrom']) && isset($_POST['DateTo']) && !isset($Data['DateFrom']) && !isset($Data['DateTo']))
		{
			$Data['DateFrom'] = $_POST['DateFrom'];
			$Data['DateTo'] = $_POST['DateTo'];
		}
		else
		{
			$Data['DateFrom'] = date('Y/m/d');
			$Data['DateTo'] = date('Y/m/d');
		}


		if($this->validateDate($Data['DateFrom']) && $this->validateDate($Data['DateTo']))
		{

			$output['ack'] = 'success';

			# If you want look up data by SKU
			if(isset($_POST['SKU']) && !isset($Data['SKU']))
			$Data['SKU'] = $_POST['SKU'];

			# Get available date range from database
			$TransactionDataAvail = $this->db->QRY("
				SELECT
					max(PT.SoldOn) as maxSoldOn,
					min(PT.SoldOn) as minSoldOn
				FROM
					gc_reports_pos_transactions PT
			");


			# Make date object to create year/month/week date range
			$DR_From = new DateTime($Data['DateFrom']);
			$DR_To = new DateTime($Data['DateTo']);

			# Get days difference between To and From date
			$Date_Diff = $DR_From->diff($DR_To);

			# Calculate last year range
			$output['Y']['From'] = date("Y/m/d",strtotime('-1 year',strtotime($Data['DateFrom'])));
			$output['Y']['To'] = date("Y/m/d",strtotime('-1 year',strtotime($Data['DateTo'])));

			# Calculate last month range
			if($Date_Diff->m > 0)
			{

				if(date('d',strtotime($Data['DateFrom'])) <= date('d',strtotime($Data['DateTo'])))
				{

					$TempDate_From = strtotime('-'.($Date_Diff->m + 1).' month',strtotime($Data['DateFrom']));
					$TempDate_To = strtotime('-'.($Date_Diff->m + 1).' month',strtotime($Data['DateTo']));
				}
				else
				{
					$TempDate_From = strtotime('-'.($Date_Diff->m).' month',strtotime($Data['DateFrom']));
					$TempDate_To = strtotime('-'.($Date_Diff->m).' month',strtotime($Data['DateTo']));
				}

			}
			else
			{
				$TempDate_From = strtotime('-1 month',strtotime($Data['DateFrom']));
				$TempDate_To = strtotime('-1 month',strtotime($Data['DateTo']));
			}

			$output['M']['From'] = date("Y/m/d",$TempDate_From);
			$output['M']['To'] = date("Y/m/d",$TempDate_To);

			# Calculate last week range
			$TempDate_To = strtotime('last week',strtotime($Data['DateFrom']));
			$output['W']['From'] = date("Y/m/d",strtotime('-'.$Date_Diff->days.' day',$TempDate_To));
			$output['W']['To'] = date("Y/m/d",$TempDate_To);

			if($Data['DateFrom'] == $Data['DateTo'])
			{

				$output['YST']['From'] = date("Y/m/d",strtotime('-1 day',strtotime($Data['DateFrom'])));
				$output['YST']['To'] = $output['YST']['From'];
				$Total_Yesterday = $this->getCustomTotal($output['YST']['From'],$output['YST']['To'], $Data);
				$output['LastD'] = $Total_Yesterday[0];
			}


			$Total_LastYear = $this->getCustomTotal($output['Y']['From'],$output['Y']['To'], $Data);
			$Total_LastMonth = $this->getCustomTotal($output['M']['From'],$output['M']['To'], $Data);
			$Total_LastWeek = $this->getCustomTotal($output['W']['From'],$output['W']['To'], $Data);
			$Total_Current = $this->getCustomTotal($Data['DateFrom'],$Data['DateTo'], $Data);

			$output['Current'] = $Total_Current[0];
			$output['LastY'] = $Total_LastYear[0];
			$output['LastM'] = $Total_LastMonth[0];
			$output['LastW'] = $Total_LastWeek[0];

			$output['Visitor_Current'] = $this->_Model_cart_corp_reports_sales->getVisitorInfo(array(
				'DateFrom' => $Data['DateFrom'],
				'DateTo' => $Data['DateTo']
			))[0];

			$output['Visitor_LastY'] = $this->_Model_cart_corp_reports_sales->getVisitorInfo(array(
				'DateFrom' => $output['Y']['From'],
				'DateTo' => $output['Y']['To']
			))[0];

			$output['Visitor_LastM'] = $this->_Model_cart_corp_reports_sales->getVisitorInfo(array(
				'DateFrom' => $output['M']['From'],
				'DateTo' => $output['M']['To']
			))[0];

			$output['Visitor_LastW'] = $this->_Model_cart_corp_reports_sales->getVisitorInfo(array(
				'DateFrom' => $output['W']['From'],
				'DateTo' => $output['W']['To']
			))[0];



			$Total = $this->db->QRY("
				SELECT
					*,
					QTY_Sold * Profit as Profit,
					DATE_FORMAT(T.SoldOn, '%Y-%m-%d') as SoldDateTXT
				FROM
					gc_reports_pos_Items I,
					gc_reports_pos_transactions T
				WHERE
					I.ItemID = T.ItemID AND
					T.SoldOn >= '".$Data['DateFrom']." 00:00:00' AND
					T.SoldOn <= '".$Data['DateTo']." 23:59:59'
				ORDER BY
					T.Total DESC
			");


			$output['Total_Internet'] = 0;
			$output['Total_WalkIn'] = 0;
			$output['Profit'] = 0;
			$output['Items'] = array();

			$output['Items']['ITN'] = array();
			$output['Items']['WLK'] = array();

			$output['Adwords'] = $this->db->QRY("
				SELECT
					I.Description,
					IA.Prd_ID,
					SUM(IA.Clicks) as Clicks,
					SUM(Cost) as Cost,
					SUM(Impressions) as Impressions,
					UPPER(IA.SKU) as SKU,
					UPPER(ItemLookupCode_Single) as ItemLookupCode_Single,
					I.ItemType
				FROM
					gc_reports_pos_Items_adwords IA
						LEFT JOIN
							gc_reports_pos_Items I
						ON
							UPPER(IA.SKU) = UPPER(I.ItemLookupCode)
				WHERE
					IA.DateOn >= '".$this->db->escape($Data['DateFrom'])."' AND
					IA.DateOn <= '".$this->db->escape($Data['DateTo'])."'
				GROUP BY
					IA.Prd_ID
				ORDER BY
					Cost DESC
			");
			/*
			$Tmp = array();
			foreach($output['Adwords'] AS $K => $_F)
			{
				if(!isset($Tmp[$_F['Prd_ID']]))
					$Tmp[$_F['Prd_ID']] = $_F;

				$Tmp[$_F['Prd_ID']]['Cost'] += $_F['Cost'];
				$Tmp[$_F['Prd_ID']]['Impressions'] += $_F['Impressions'];
				$Tmp[$_F['Prd_ID']]['Clicks'] += $_F['Clicks'];


			}

			$output['Adwords'] = $Tmp;
			*/
			foreach($Total AS $Total_F)
			{
				$isInternet = ($Total_F['isInternet'] == 1 ? TRUE : FALSE);
				$saleType = ($isInternet ? "ITN" : "WLK");;

				// Internet Total Amount
				if($isInternet)
				{
					//echo '['.$output['Total_Internet'].'+'.$Total_F['Total'].']';
					$output['Total_Internet'] = $output['Total_Internet'] + $Total_F['Total'];
				}
				else
				// Walking Total Amount
					$output['Total_WalkIn'] = $output['Total_WalkIn'] + $Total_F['Total'];


				// Total Profit
				$output['Profit'] = $output['Profit'] + $Total_F['Profit'];

				// Item Sold Table
				if(!isset($output['Items'][$saleType][$Total_F['ItemID']]))
				{
					$output['Items'][$saleType][$Total_F['ItemID']]['QTY'] = 0;
					$output['Items'][$saleType][$Total_F['ItemID']]['Total'] = 0;
					$output['Items'][$saleType][$Total_F['ItemID']]['Profit'] = 0;
				}



				$Tmp_Total = round($output['Items'][$saleType][$Total_F['ItemID']]['Total'] + $Total_F['Total'],2);

				// To take care of returned items
				if($Total_F['Profit'] == 0)
				{
					/*
					if($Total_F['ItemLookupCode'] == '725311-MYTE')
						echo '['.$output['Items'][$saleType][$Total_F['ItemID']]['Profit'].'/'.$Total_F['Cost'].']';
						*/
					$Tmp_Profit = round(($output['Items'][$saleType][$Total_F['ItemID']]['Profit']) - $Total_F['Cost'],2);
				}
				else
					$Tmp_Profit = round(($output['Items'][$saleType][$Total_F['ItemID']]['Profit']) + $Total_F['Profit'],2);



				$output['Items'][$saleType][$Total_F['ItemID']] = array(
					"Dept" => $Total_F['DeprartmentID'],
					"ItemName" => ucfirst(strtolower($Total_F['Description'])),
					"SKU" => $Total_F['ItemLookupCode'],
					"QTY" => $Total_F['QTY_Sold'] + $output['Items'][$saleType][$Total_F['ItemID']]['QTY'],
					"Price" => round($Total_F['Price'],2),
					"Total" => $Tmp_Total,
					"Cost" => round($Total_F['Cost'],2),
					"Profit" => $Tmp_Profit
				);


				$TimeStamp = strtotime($Total_F['SoldDateTXT'])."000";

				# Total Day by Day Sales
				if(!isset($PeriodSale['Date_Sales_Total'][$TimeStamp]))
					$PeriodSale['Date_Sales_Total'][$TimeStamp] = 0;

				$PeriodSale['Date_Sales_Total'][$TimeStamp] = $Total_F['Total'] + $PeriodSale['Date_Sales_Total'][$TimeStamp];


				# Walk-in Customer & Internet Total Day by Day Sales
				if($isInternet)
				{
					if(!isset($PeriodSale['Date_Sales_Internet_Total'][$TimeStamp]))
						$PeriodSale['Date_Sales_Internet_Total'][$TimeStamp] = 0;

					$PeriodSale['Date_Sales_Internet_Total'][$TimeStamp] = $Total_F['Total'] + $PeriodSale['Date_Sales_Internet_Total'][$TimeStamp];
				}
				else
				{
					if(!isset($PeriodSale['Date_Sales_Walking_Total'][$TimeStamp]))
						$PeriodSale['Date_Sales_Walking_Total'][$TimeStamp] = 0;

					$PeriodSale['Date_Sales_Walking_Total'][$TimeStamp] = $Total_F['Total'] + $PeriodSale['Date_Sales_Walking_Total'][$TimeStamp];
				}


			}
			$output['Total'] = $output['Total_Internet'] + $output['Total_WalkIn'];

			usort($output['Items']['ITN'], function($a, $b) {
				return $a['Total'] - $b['Total'];
			});

			usort($output['Items']['WLK'], function($a, $b) {
				return $a['Total'] - $b['Total'];
			});

			$output['Items']['ITN'] = array_reverse($output['Items']['ITN']);
			$output['Items']['WLK'] = array_reverse($output['Items']['WLK']);
			$output['AdWords_Total'] = 0;
			foreach($output['Adwords'] AS $K => $_F)
			{
				$output['AdWords_Total'] += $_F['Cost'];

				$output['Adwords'][$K]['Total'] = 0;
				$output['Adwords'][$K]['Profit'] = 0;
				$output['Adwords'][$K]['SoldQTY'] = 0;
				$output['Adwords'][$K]['ItemType'] = $_F['ItemType'];

				foreach($output['Items']['ITN'] AS $_F2)
				{
					if($_F['SKU'] == $_F2['SKU'] || ($_F['ItemLookupCode_Single'] != "" && $_F['ItemLookupCode_Single'] == $_F2['SKU']))
					{

						$output['Adwords'][$K]['Total'] = $_F2['Total'];
						$output['Adwords'][$K]['Profit'] = $_F2['Profit'];
						$output['Adwords'][$K]['SoldQTY'] = $_F2['QTY'];

					}
				}

				$output['Adwords'][$K]['Profit'] = $output['Adwords'][$K]['Profit'] - $_F['Cost'];
				$output['Adwords'][$K]['Profitable'] = ($output['Adwords'][$K]['Profit'] >= 0 ? 1 : 0);
				$output['Adwords'][$K]['ClickThrough'] = round(($_F['Clicks'] > 0 ? $_F['Impressions'] / $_F['Clicks'] : ($_F['Impressions'] > 0 ? $_F['Impressions'] : 0)));
			}



			# Walk-in Period
			if(isset($PeriodSale['Date_Sales_Walking_Total']))
			{
				foreach($PeriodSale['Date_Sales_Walking_Total'] AS $K => $P_D)
				{
					$output['Date_Sales_Walking_Total'][] = array($K,$P_D);
				}

				usort($output['Date_Sales_Walking_Total'], function($a, $b) {
					return $a[0] - $b[0];
				});
			}

			$output['Date_Sales_Walking_Total'] = json_encode((isset($output['Date_Sales_Walking_Total']) ? $output['Date_Sales_Walking_Total'] : array()));


			# Internet Period
			if(isset($PeriodSale['Date_Sales_Internet_Total']))
			{
				foreach($PeriodSale['Date_Sales_Internet_Total'] AS $K => $P_D)
				{
					$output['Date_Sales_Internet_Total'][] = array($K,$P_D);
				}

				usort($output['Date_Sales_Internet_Total'], function($a, $b) {
					return $a[0] - $b[0];
				});
			}

			$output['Date_Sales_Internet_Total'] = json_encode((isset($output['Date_Sales_Internet_Total']) ? $output['Date_Sales_Internet_Total'] : array()));

			# Total Period
			if(isset($PeriodSale['Date_Sales_Total']))
			{
				foreach($PeriodSale['Date_Sales_Total'] AS $K => $P_D)
				{
					$output['Date_Sales_Total'][] = array($K,$P_D);
				}

				usort($output['Date_Sales_Total'], function($a, $b) {
					return $a[0] - $b[0];
				});
			}


			$output['Date_Sales_Total'] = json_encode((isset($output['Date_Sales_Total']) ? $output['Date_Sales_Total'] : array()));


		}

		return $output;

	}

	private function getCustomTotal($From, $To, $Data = null)
	{


		return $this->db->QRY("
			SELECT
				COUNT(DISTINCT TransactionID) as Total_Customers,
				IF(sum(PT.Profit * PT.QTY_Sold) is NULL, 0,sum(PT.Profit * PT.QTY_Sold)) as Profit,
				IF(sum(PT.Total) is NULL,0,sum(PT.Total)) as Total,
				IF(sum(IF(PT.isInternet = 1,PT.Total,0)) is NULL, 0, sum(IF(PT.isInternet = 1,PT.Total,0))) as Total_Internet,
				IF(sum(IF(PT.isInternet = 1,0,PT.Total)) is NULL, 0, sum(IF(PT.isInternet = 1,0,PT.Total))) as Total_WalkIn,
				(
					SELECT
						IF(SUM(Cost) is null,0,SUM(Cost))
					FROM
						gc_reports_pos_Items_adwords IA
					WHERE
						IA.DateOn >= '".$From." 00:00:00' AND
						IA.DateOn <= '".$To." 23:59:59'
				) AS AdWords_Total
			FROM
				gc_reports_pos_transactions PT,
				gc_reports_pos_Items PI
			WHERE
				PT.SoldOn >= '".$From." 00:00:00' AND
				PT.SoldOn <= '".$To." 23:59:59' AND
				PT.ItemID = PI.ItemID
				".(isset($Data['SKU']) && $Data['SKU'] != "" ? "AND PI.ItemLookupCode = '".$Data['SKU']."'" : '')."
		");



	}




}
?>
