<?php
class CartCorpModulesOpenMarketStockHome_Controller extends GGoRok
{
	var $_isAdminPage = true;
	var $POS_DB, $Web_DB;

	function __construct()
	{
		$this->POS_DB = new $this->mssql;
		$this->POS_DB->connect(array(
			'DB_Name' => 'JANIRMS2DB',
			'DB_Server' => '24.99.17.15\JANIRMS2DB,1433',
			'DB_UserName' => 'sa',
			'DB_Password' => 'janilinkDaniel'
		));

	}

	function home()
	{
		$Data['title'] = 'POS Stock Management | GGoRok Cart';
		$Data['metaK'] = 'GGoRok';
		$Data['metaD'] = 'GGoRok';
		$Data['MAIN_HTML'] = $this->Load->View('cart/corp/modules/openmarket-stock/home.tpl',array(

		));


    /*

    $AllItemOrderList_TMP = $AllItemOrderList;
    $ItemList = array();
    $ItemList_Child = array();
    ## Big Parent
    foreach($AllItemOrderList_TMP AS $_K => $_F)
    {
      if($_F['ParentItem'] == 0)
      {
        $ItemList[][0] = $_F;
        unset($AllItemOrderList_TMP[$_K]);
      }
      else
      {
        $ItemList_Child[$_K] = $_F;
      }


    }
    $ddd=0;



    ## Children Level 1

    /*
    while(sizeof($ItemList_Child) > 0 )
    {

      foreach($ItemList AS $ItemList_K => $ItemList_F)
      {
        $ParentID_In_ItemList = $ItemList[$ItemList_K][sizeof($ItemList[$ItemList_K]) - 1]['ID'];
        if(isset($ItemList_Child[$ParentID_In_ItemList]))
        {
          echo '/'.sizeof($ItemList_Child).'/<br />';
          $ItemList[$ItemList_K][sizeof($ItemList[$ItemList_K])] = $ItemList_Child[$ParentID_In_ItemList];
          unset($ItemList_Child[$ParentID_In_ItemList]);
        }
        $ddd++;
        if($ddd > 10000000)
        {
          echo $ddd;
          exit();
        }

      }


    }
    */


		//$this->NoLookupCodeInPOS();
		$Home_Controller = $this->Load->Controller('cart/corp/home');
		echo $Home_Controller->loadHeader($Data);
	}

	function addItem()
	{
		$output['ack'] = 'error';
		$Go = true;

		if(isset($_POST['Data']))
		{
			$Data = json_decode($_POST['Data'],true);

			if(!(isset($Data['ItemLookupCode']) && $Data['ItemLookupCode'] != ""))
			{
				$Go = false;
				$output['error_msg'] = 'Item Lookup Code is wrong or not specified.';
			}

			if(!(isset($Data['Amazon']) && is_numeric($Data['Amazon'])))
			{
				$Go = false;
				$output['error_msg'] = 'Select Open Market Type.';
			}

			if(!(isset($Data['Ebay']) && is_numeric($Data['Ebay'])))
			{
				$Go = false;
				$output['error_msg'] = 'Select Open Market Type.';
			}

			$Search_POS_Item = $this->POS_DB->QRY("
				SELECT
					Item.ItemLookupCode
				FROM
					Item
				WHERE
					Item.ItemLookupCode = '".$this->db->escape($Data['ItemLookupCode'])."'
			");

			$Search_POS_Item_Class = $this->POS_DB->QRY("
				SELECT
					ItemClass.ItemLookupCode
				FROM
					ItemClass
				WHERE
					ItemClass.ItemLookupCode = '".$this->db->escape($Data['ItemLookupCode'])."'
			");

			$Search_WebDB = $this->db->QRY("
				SELECT
					PSO.Itemlookupcode
				FROM
					gc_modules_pos_stock_openmarket PSO
				WHERE
					PSO.Itemlookupcode = '".$this->db->escape($Data['ItemLookupCode'])."'
			");


			if(sizeof($Search_POS_Item) == 0 && sizeof($Search_POS_Item_Class) == 0)
			{
				$Go = false;
				$output['error_msg'] = 'The item does not exist in the POS system.';
			}

			if(sizeof($Search_WebDB) > 0)
			{
				$Go = false;
				$output['error_msg'] = 'The item does already exist in the list.';
			}


			if($Go)
			{
				$this->db->QRY('
					INSERT INTO
						gc_modules_pos_stock_openmarket
						(
							Itemlookupcode,
							Amazon,
							Ebay,
							UPC
						)
						VALUES
						(
							"'.$this->db->escape($Data['ItemLookupCode']).'",
							"'.($Data['Amazon'] == 1 ? 1 : 0).'",
							"'.($Data['Ebay'] == 1 ? 1 : 0).'",
							"'.$this->db->escape($Data['UPC']).'"
						)

				');

				$output['ack'] = 'success';
			}
		}


		return $output;
	}
  function getData()
  {
		$output['ack'] = 'success';
		$output['ItemList_HTML'] = '';
		$ItemList_Registered = $this->db->QRY('
			SELECT
				*
			FROM
				gc_modules_pos_stock_openmarket
			ORDER BY
				Itemlookupcode
		');
		$ItemSKU = array();
		foreach($ItemList_Registered AS $_F)
		{
			$ItemSKU_Based_Arr[$_F['Itemlookupcode']] = $_F;
			$ItemSKU[] = $_F['Itemlookupcode'];
		}
		$ItemList = array();
		$ItemList_HTML = '';

		# Regular Item (Kit, Single Item)
		if(sizeof($ItemSKU) > 0)
		{
	    $ItemList = $this->getItemsSQL($ItemSKU);


			# Grouping Items
			foreach($ItemList AS $_K => $_F)
			{
				# Combine POS Data and Website DB Data
				if(isset($ItemSKU_Based_Arr[$_F['ItemLookupCode']]))
				{
					$_F = array_merge($ItemSKU_Based_Arr[$_F['ItemLookupCode']] , $_F);
				}

				# Has Parent?
				if($_F['ParentItem'] > 0)
				{
					$Parents = $this->findAllParents($_F['ParentItem']);
					$Parents_ItemList = $this->getItemsSQL($Parents);
					if(sizeof($Parents_ItemList) > 0)
					{
						$ItemList[$_K] = $Parents_ItemList;
						$ItemList[$_K][] = $_F;
					}
				}
				else
				{
					$ItemList[$_K] = array($_F);
				}
			}

			# Print Result
			foreach($ItemList AS $_K => $_F)
			{


				$ItemList_HTML .= '<div class="IH_ROW_GROUP IH_ROW_Color_'.($_K % 2).'">';

				foreach($_F AS $_F2)
				{
					$ItemList_HTML .= $this->Load->View('cart/corp/modules/openmarket-stock/list.tpl',array(
						'ItemList' => $_F2
					));

				}

				$ItemList_HTML .= '</div>';


			}



			$output['ItemList_HTML'] .= ($ItemList_HTML == '' ? '<div id="PIC_MSG">No Data</div>' : $ItemList_HTML);
		}



		# Assembly Item
		$ItemList_ASM_HTML = '';
		if(sizeof($ItemSKU) > 0)
		{


			$ItemList_ASM = $this->POS_DB->QRY("
				SELECT
					*,
					LJ1.ASM_Price,
					LJ1.ASM_COST
				FROM
					ItemClass
						LEFT OUTER JOIN
						(
							SELECT
								SUM(ItemClassComponent.Price) as ASM_Price,
								SUM(Item.Cost) as ASM_COST,
								ItemClassComponent.ItemClassID

							FROM
								ItemClassComponent
									LEFT JOIN
										Item
									ON
										ItemClassComponent.ItemID = Item.ID
									GROUP BY
										ItemClassComponent.ItemClassID
						) AS LJ1
						ON
							ItemClass.ID = LJ1.ItemClassID

				WHERE
				".
					(isset($ItemSKU) && sizeof($ItemSKU) > 0 ? " (ItemClass.ItemLookupCode = '".implode($ItemSKU,"' OR ItemClass.ItemLookupCode = '")."')" : "")
				."
				ORDER BY
					ItemClass.ID
			");



			foreach($ItemList_ASM AS $_K => $ItemList_ASM_F)
			{


				$ItemList_HTML .= '<div class="IH_ROW_GROUP IH_ROW_Color_ASM_'.($_K % 2).'">';

				$ItemList_HTML .= $this->Load->View('cart/corp/modules/pos-stock/list.tpl',array(
					'ItemList' => array(
						'PSO_ID' => $ItemSKU_Based_Arr[$ItemList_ASM_F['ItemLookupCode']]['PSO_ID'],
						'ItemLookupCode' => $ItemList_ASM_F['ItemLookupCode'],
						'Description' => $ItemList_ASM_F['Description'],
						'UPC' => $ItemSKU_Based_Arr[$ItemList_ASM_F['ItemLookupCode']]['UPC'],
						'Quantity' => 'ASM',
						'New_RP' => 'ASM',
						'Price' => $ItemList_ASM_F['ASM_Price'],
						'Cost' => $ItemList_ASM_F['ASM_COST'],
						'Amazon' => $ItemSKU_Based_Arr[$ItemList_ASM_F['ItemLookupCode']]['Amazon'],
						'Ebay' => $ItemSKU_Based_Arr[$ItemList_ASM_F['ItemLookupCode']]['Ebay'],
						'isASM' => true
					)
				));

				$AssemblyItem_List = $this->getItemLookupcode_ASM(array($ItemList_ASM_F['ItemLookupCode']));

				foreach($AssemblyItem_List AS $AssemblyItem_List_F)
				{

					$ofComponent_Item = $this->getItemsSQL(array($AssemblyItem_List_F['ItemLookupCode_CPM']));
					$ItemList_HTML .= $this->Load->View('cart/corp/modules/pos-stock/list.tpl',array(
						'ItemList' => $ofComponent_Item[0]
					));
				}

				$ItemList_HTML .= '</div>';
			}

			/*
			$ItemList_ASM = $this->getItemLookupcode_ASM($ItemSKU);



			$ItemList_ASM_Tmp = array();
			foreach($ItemList_ASM AS $_F)
			{
				$ItemList_ASM_Tmp[$_F['ItemLookupCode_ASM']][] = $_F;
				$ItemSKU_ASM[] = $_F['ItemLookupCode_CPM'];
			}

			$ItemList_ASM_CPM = $this->getItemsSQL($ItemSKU_ASM);



			foreach($ItemList_ASM_Tmp AS $_K1 => $_F1)
			{

				foreach($_F1 AS $_F2)
				{
					$_F2 = $ItemList_ASM_CPM

					$_F2 = array_merge($ItemSKU_Based_Arr[$_F['ItemLookupCode']] , $_F);

					echo $_F2['ItemLookupCode_CPM'];
					$ItemList_HTML .= $this->Load->View('cart/corp/modules/pos-stock/list.tpl',array(
						'ItemList' => $_F2
					));
				}

			}



			# Grouping Items
			foreach($ItemList_ASM AS $_K => $_F)
			{

			}


			/*
			# Print Result
			foreach($ItemList AS $_K => $_F)
			{


				$ItemList_HTML .= '<div class="IH_ROW_GROUP IH_ROW_Color_'.($_K % 2).'">';

				foreach($_F AS $_F2)
				{
					$ItemList_HTML .= $this->Load->View('cart/corp/modules/pos-stock/list.tpl',array(
						'ItemList' => $_F2
					));

				}

				$ItemList_HTML .= '</div>';


			}
			*/



		}

		$output['ItemList_HTML'] = ($ItemList_HTML != '' || $ItemList_ASM_HTML != '' ? $ItemList_HTML.$ItemList_ASM_HTML : '<div id="PIC_MSG">No Data</div>');

		return $output;



		/*
    $NeedToOrder_List = array();
    $Month = 1;
    foreach($AllItemOrderList AS $_K => $_F)
    {
      if($_F['ReorderPoint'] > 0 && ($_F['M1'] + $_F['M2'] + $_F['M3'] + $_F['M4'] + $_F['M5'] + $_F['M6'] > 0) && $_F['ParentItem'] == 0)
      {
        $_F['AddedMonthAgo'] = ($_F['AddedMonthAgo'] < 0 ? 0 : $_F['AddedMonthAgo']);
        $SoldTotal_InMonth = 0;
        $RP_BasedOnSale = 0;

        for($i = 0;$_F['AddedMonthAgo'] > $i;$i++)
        {
          if($i > 5)
            break;
          $SoldTotal_InMonth += $_F['M'.($i+1)];
        }

        if($SoldTotal_InMonth > 0)
        {
          $RP_BasedOnSale = ceil($SoldTotal_InMonth / $i);

        }
        $AllItemOrderList[$_K]['RP_BasedOnSale'] = $RP_BasedOnSale;
        $_F['RP_BasedOnSale'] = $RP_BasedOnSale;
        $NeedToOrder_List[] = $_F;

      }


    }

    foreach($NeedToOrder_List AS $_F)
    {

      echo $_F['ItemLookupCode'];
      echo '/';
      echo $_F['Description'];
      echo '/';
      echo $_F['Quantity'];
      echo '/';
      echo $_F['ReorderPoint'];
      echo '/';
      echo $_F['RP_BasedOnSale'];
      echo '/';
      echo $_F['M1'];
      echo '/';
      echo $_F['M2'];
      echo '/';
      echo $_F['M3'];
      echo '/';
      echo $_F['M4'];
      echo '/';
      echo $_F['M5'];
      echo '/';
      echo $_F['M6'];
      echo '<br />';
    }

		*/
  }

	function findAllParents($ParentItem)
	{

		$Item = $this->POS_DB->QRY("
			SELECT
				Item.ItemLookupCode,
				Item.ParentItem
			FROM
				Item
			WHERE
				Item.ID = '".$this->db->escape($ParentItem)."'
		");
		$ItemOutput = array();

		if(sizeof($Item) > 0)
		{
			$ItemOutput[] = $Item[0]['ItemLookupCode'];
			if($Item[0]['ParentItem'] > 0)
				$this->findAllParents($Item[0]['ParentItem']);
		}

		return $ItemOutput;
	}

	function getItemLookupcode_ASM($ItemSKU = array())
	{

		return $this->POS_DB->QRY("
			SELECT
				ItemClass.Description,
				ItemClass.ItemLookupCode AS ItemLookupCode_ASM,
				ItemClass.UseComponentPrice,
				ItemClassComponent.Price,
				Item.ItemLookupCode AS ItemLookupCode_CPM
			FROM
				ItemClass
					LEFT JOIN
						ItemClassComponent
					ON
						ItemClass.ID = ItemClassComponent.ItemClassID
					LEFT JOIN
						Item
					ON
						Item.ID = ItemClassComponent.ItemID

			WHERE
			".
				(isset($ItemSKU) && sizeof($ItemSKU) > 0 ? " (ItemClass.ItemLookupCode = '".implode($ItemSKU,"' OR ItemClass.ItemLookupCode = '")."')" : "")
			."
			ORDER BY
				ItemClass.ID
		");
	}

	function getItemsSQL($ItemSKU = array())
	{
		if(sizeof($ItemSKU) > 0)
		{

			return $this->POS_DB->QRY("
				SELECT
					Item.ItemLookupCode,
					Item.ID,
					Item.Quantity,
					Item.ParentItem,
					Item.ParentQuantity,
					Item.ReorderPoint,
					Item.Description,
					Item.DateCreated,
					Item.Cost,
					Item.Price,
					M_1.RP AS M1,
					M_2.RP AS M2,
					M_3.RP AS M3,
					M_4.RP AS M4,
					M_5.RP AS M5,
					M_6.RP AS M6,
					AddedMonthAgo.M_Ago,

					CASE
						WHEN
							AddedMonthAgo.M_Ago > 6
						THEN
							CEILING((M_1.RP + M_2.RP + M_3.RP + M_4.RP + M_5.RP + M_6.RP) / 6)
						WHEN
							AddedMonthAgo.M_Ago = 5
						THEN
							CEILING((M_2.RP + M_3.RP + M_4.RP + M_5.RP + M_6.RP) / 5)
						WHEN
							AddedMonthAgo.M_Ago = 4
						THEN
							CEILING((M_3.RP + M_4.RP + M_5.RP + M_6.RP) / 4)
						WHEN
							AddedMonthAgo.M_Ago = 3
						THEN
							CEILING((M_4.RP + M_5.RP + M_6.RP) / 3)
						WHEN
							AddedMonthAgo.M_Ago = 2
						THEN
							CEILING((M_5.RP + M_6.RP) / 2)
						WHEN
							AddedMonthAgo.M_Ago = 1
						THEN
							M_6.RP

					END AS
						New_RP

					FROM
						Item
							LEFT OUTER JOIN
							(
								SELECT
									SUM(TransactionEntry.Quantity) AS soldQTY,
									TransactionEntry.ItemID,
									Item.ItemLookupCode
								FROM
									TransactionEntry
										INNER JOIN
											[Transaction] WITH(NOLOCK)
										ON
											TransactionEntry.TransactionNumber = [Transaction].TransactionNumber
										LEFT JOIN
											Item WITH(NOLOCK)
										ON
											TransactionEntry.ItemID = Item.ID
								WHERE

									[Transaction].Time >= DATEADD(month, -6, GETDATE()) AND
									[Transaction].Time < DATEADD(month, -5, GETDATE())
								GROUP BY
									Item.ItemLookupCode,TransactionEntry.ItemID
							)
							AS M1
								ON Item.ItemLookupCode = M1.ItemLookupCode

							LEFT OUTER JOIN
							(
								SELECT
									SUM(TransactionEntry.Quantity) AS soldQTY,
									TransactionEntry.ItemID,
									Item.ItemLookupCode
								FROM
									TransactionEntry

										INNER JOIN
											[Transaction] WITH(NOLOCK)
										ON
											TransactionEntry.TransactionNumber = [Transaction].TransactionNumber
										LEFT JOIN
											Item WITH(NOLOCK)
										ON
											TransactionEntry.ItemID = Item.ID
								WHERE
									[Transaction].Time >= DATEADD(month, -5, GETDATE()) AND
									[Transaction].Time < DATEADD(month, -4, GETDATE())
								GROUP BY
									Item.ItemLookupCode,TransactionEntry.ItemID
							)
						AS M2
							ON Item.ItemLookupCode = M2.ItemLookupCode

						LEFT OUTER JOIN
						(
							SELECT
								SUM(TransactionEntry.Quantity) AS soldQTY,
								TransactionEntry.ItemID,
								Item.ItemLookupCode
							FROM
								TransactionEntry

								INNER JOIN
									[Transaction] WITH(NOLOCK)
								ON
									TransactionEntry.TransactionNumber = [Transaction].TransactionNumber
								LEFT JOIN
									Item WITH(NOLOCK)
								ON
									TransactionEntry.ItemID = Item.ID
							WHERE

								[Transaction].Time >= DATEADD(month, -4, GETDATE()) AND
								[Transaction].Time < DATEADD(month, -3, GETDATE())
							GROUP BY
								Item.ItemLookupCode,TransactionEntry.ItemID
						)
						AS M3
						ON Item.ItemLookupCode = M3.ItemLookupCode

						LEFT OUTER JOIN
						(
							SELECT
								SUM(TransactionEntry.Quantity) AS soldQTY,
								TransactionEntry.ItemID,
								Item.ItemLookupCode
							FROM
								TransactionEntry

							INNER JOIN
								[Transaction] WITH(NOLOCK)
							ON
								TransactionEntry.TransactionNumber = [Transaction].TransactionNumber
							LEFT JOIN
								Item WITH(NOLOCK)
							ON
								TransactionEntry.ItemID = Item.ID
							WHERE

								[Transaction].Time >= DATEADD(month, -3, GETDATE()) AND
								[Transaction].Time < DATEADD(month, -2, GETDATE())
							GROUP BY
								Item.ItemLookupCode,TransactionEntry.ItemID
						)
						AS M4
						ON Item.ItemLookupCode = M4.ItemLookupCode

						LEFT OUTER JOIN
						(
							SELECT
								SUM(TransactionEntry.Quantity) AS soldQTY,
								TransactionEntry.ItemID,
								Item.ItemLookupCode
							FROM
								TransactionEntry

									INNER JOIN
										[Transaction] WITH(NOLOCK)
									ON
										TransactionEntry.TransactionNumber = [Transaction].TransactionNumber
									LEFT JOIN
										Item WITH(NOLOCK)
									ON
										TransactionEntry.ItemID = Item.ID
									WHERE

										[Transaction].Time >= DATEADD(month, -2, GETDATE()) AND
										[Transaction].Time < DATEADD(month, -1, GETDATE())
									GROUP BY
										Item.ItemLookupCode,TransactionEntry.ItemID
						)
						AS M5
						ON Item.ItemLookupCode = M5.ItemLookupCode

						LEFT OUTER JOIN
						(
							SELECT
								SUM(TransactionEntry.Quantity) AS soldQTY,
								TransactionEntry.ItemID,
								Item.ItemLookupCode
							FROM
								TransactionEntry

								INNER JOIN
									[Transaction] WITH(NOLOCK)
								ON
									TransactionEntry.TransactionNumber = [Transaction].TransactionNumber
								LEFT JOIN
									Item WITH(NOLOCK)
								ON
									TransactionEntry.ItemID = Item.ID
							WHERE

								[Transaction].Time >= DATEADD(month, -1, GETDATE()) AND
								[Transaction].Time < DATEADD(month, 0, GETDATE())
							GROUP BY
								Item.ItemLookupCode,TransactionEntry.ItemID
						)
						AS M6
						ON Item.ItemLookupCode = M6.ItemLookupCode

						CROSS APPLY (SELECT (DATEDIFF(DAY, DateCreated, DATEADD(month, 0, GETDATE())) / 30) AS M_Ago) AS AddedMonthAgo
						CROSS APPLY (SELECT case when M1.soldQTY is null then 0 else M1.soldQTY end RP) AS M_1
						CROSS APPLY (SELECT case when M2.soldQTY is null then 0 else M2.soldQTY end RP) AS M_2
						CROSS APPLY (SELECT case when M3.soldQTY is null then 0 else M3.soldQTY end RP) AS M_3
						CROSS APPLY (SELECT case when M4.soldQTY is null then 0 else M4.soldQTY end RP) AS M_4
						CROSS APPLY (SELECT case when M5.soldQTY is null then 0 else M5.soldQTY end RP) AS M_5
						CROSS APPLY (SELECT case when M6.soldQTY is null then 0 else M6.soldQTY end RP) AS M_6

				WHERE
					/*AddedMonthAgo.M_Ago > 0*/
					".
						(isset($ItemSKU) && sizeof($ItemSKU) > 0 ? " (Item.ItemLookupCode = '".implode($ItemSKU,"' OR Item.ItemLookupCode = '")."')" : "")
					."

				ORDER BY
					Item.ItemLookupCode ASC

			");
		}
		else
		{
			return array();
		}
	}



}

?>
