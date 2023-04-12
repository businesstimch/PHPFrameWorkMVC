<?php
class CartCorpModulesPOSStockHome_Controller extends GGoRok
{
	var $_isAdminPage = true;
	var $POS_DB, $Web_DB;
	var $StoreID;
	function __construct()
	{
		$this->POS_DB = new $this->mssql;

		if(isset($_POST['StoreID']) && ($_POST['StoreID'] == 1 || $_POST['StoreID'] == 2))
		{
			$this->StoreID = $_POST['StoreID'];

			if($this->StoreID == 1)
			{
				$this->POS_DB->connect(array(
					'DB_Name' => 'JANIRMS2DB',
					'DB_Server' => '24.99.17.15\JANIRMS2DB,1433',
					'DB_UserName' => 'sa',
					'DB_Password' => 'janilinkDaniel'
				));
			}
			else if($this->StoreID == 2)
			{
				$this->POS_DB->connect(array(
					'DB_Name' => 'JLTNDB',
					'DB_Server' => '24.11.244.163\JLTNDB,1433',
					'DB_UserName' => 'sa',
					'DB_Password' => 'Tech7World'
				));
			}
		}

	}

	function home()
	{
		$Data['title'] = 'POS Stock Management | GGoRok Cart';
		$Data['metaK'] = 'GGoRok';
		$Data['metaD'] = 'GGoRok';
		$Data['MAIN_HTML'] = $this->Load->View('cart/corp/modules/pos-stock/home.tpl',array(

		));

		$Home_Controller = $this->Load->Controller('cart/corp/home');
		echo $Home_Controller->loadHeader($Data);
	}

	function searchSupplier($Data = null)
	{
		$output['ack'] = 'error';
		if(isset($_POST['Name']) && $_POST['Name'] != "" && is_null($Data))
		{
			$Data = $_POST;
		}

		if(isset($Data['Name']) && $Data['Name'] != "")
		{
			$output['ack'] = 'success';
			$output['html'] = '';
			$List = $this->POS_DB->QRY("
				SELECT
					ID,
					SupplierName
				FROM
					Supplier
				WHERE
					SupplierName LIKE '".$this->db->escape($Data['Name'])."%'
				ORDER BY
					SupplierName ASC
			");

			foreach($List AS $_F)
			{
				$output['html'] .= '<div data-spid="'.$_F['ID'].'" class="SP_One noSelect"><span>'.$_F['SupplierName'].'</span></div>';
			}

		}

		return $output;
	}

  function getData($Data = array())
  {
		$output['ack'] = 'success';
		$output['ItemList_HTML'] = '';

		if(sizeof($Data) == 0)
			$Data = $_POST;

		if(isset($Data['Mode']) && ($Data['Mode'] == 'All' || ($Data['Mode'] == 'Supplier') && isset($Data['SupplierIDs']) ))
		{

			if($Data['Mode'] == 'Supplier')
			{
				$SuppliderIDs_Arr = json_decode($Data['SupplierIDs']);
				if(sizeof($SuppliderIDs_Arr) > 0)
				{
					foreach($SuppliderIDs_Arr AS $_F)
					{
						if(is_numeric($_F))
							$SuppliderIDs[] = $_F;
					}

					$ItemIDs_Arr = $this->POS_DB->QRY("
						SELECT
							ID
						FROM
							Item
						WHERE
							SupplierID IN (".implode(',',$SuppliderIDs).")
					");
					foreach($ItemIDs_Arr AS $_F)
					{
						$ItemIDs[] = $_F['ID'];
					}

				}

				if(!isset($ItemIDs) || sizeof($ItemIDs) == 0)
				{
					$output['ack'] = 'error';
					$output['error_msg'] = 'The Supplier(s) has does items, otherwise please contact the administrator.';
					return $output;
				}

				$ItemList = $this->getItemSQL_SpecificItemID(array(
					'ItemIDs' => ($Data['Mode'] == 'Supplier' ? $ItemIDs : true)
				));

			}

			else
			{

				$ItemList = $this->getItemsSQL(array(
					'onlyNeedOrder' => ($Data['Mode'] == 'Supplier' ? false : true),
					'Mode' => $Data['Mode'],
					'ItemIDs' => ($Data['Mode'] == 'Supplier' ? $ItemIDs : true)
				));

			}

			$List = $this->DataFactory_Family($ItemList);

			$_i = 0;
			foreach($List['ItemList'] AS $_K => $_F)
			{
				$output['ItemList_HTML'] .= '<div class="IH_ROW_GROUP IH_ROW_Color_'.($_i % 2).'" data-soldtotal="0">';
				$output['ItemList_HTML'] .= $this->Load->View('cart/corp/modules/pos-stock/list.tpl',array(
					'ItemList' => $_F
				));
				$output['ItemList_HTML'] .= '</div>';
				$_i++;

			}

			$ParentsList = $this->getItemSQL_SpecificItemID(array(
				'Mode' => $Data['Mode'],
				'ItemIDs' => $List['ParentsIDs'],
				'onlyNeedOrder' => false
			));

			$output['ItemList_HTML'] .= '<div class="IH_ROW_PARENTGROUP">';
			foreach($ParentsList AS $_K => $_F)
			{

				$output['ItemList_HTML'] .= $this->Load->View('cart/corp/modules/pos-stock/list.tpl',array(
					'ItemList' => $_F
				));

			}
			$output['ItemList_HTML'] .= '</div>';

			$ChildrenList = $this->getItemSQL_SpecificItemID(array(
				'Mode' => $Data['Mode'],
				'ItemIDs' => $List['ChildrenIDs'],
				'onlyNeedOrder' => false
			));

			$output['ItemList_HTML'] .= '<div class="IH_ROW_CHILDRENGROUP">';
			foreach($ChildrenList AS $_K => $_F)
			{

				$output['ItemList_HTML'] .= $this->Load->View('cart/corp/modules/pos-stock/list.tpl',array(
					'ItemList' => $_F
				));

			}
			$output['ItemList_HTML'] .= '</div>';
			$output['ItemList_HTML'] = ($output['ItemList_HTML'] != '' ? $output['ItemList_HTML'] : '<div id="PIC_MSG">No Data</div>');

		}

		return $output;

	}
	public function updateQty($Data = array())
	{
		$output['ack'] = 'error';
		$Data = $this->getPost($Data);

		if(isset($Data['Qty']) && $Data['Qty'] > 0 && isset($Data['StoreID']) && isset($Data['ItemID']))
		{
			$output['ack'] = 'success';
			$this->db->QRY("
				UPDATE
					gc_modules_pos_stock_cart
				SET
					Qty = '".$Data['Qty']."'
				WHERE
					StoreID = '".$this->db->escape($Data['StoreID'])."' AND
					customers_id = '".$this->db->escape($this->login->customers_id)."' AND
					ItemID = '".$this->db->escape($Data['ItemID'])."'
			");
		}
		return $output;

	}

	public function makePurchaseOrder($Data = array())
	{

		$output['ack'] = 'error';
		$Data = $this->getPost($Data);

		if(isset($Data['StoreID']) && isset($Data['SupplierID']))
		{

			$Cart = $this->db->QRY("
				SELECT
					*
				FROM
					gc_modules_pos_stock_cart
				WHERE
					StoreID = '".$this->db->escape($Data['StoreID'])."' AND
					customers_id = '".$this->db->escape($this->login->customers_id)."' AND
					SupplierID = '".$this->db->escape($Data['SupplierID'])."'
			");

			if(sizeof($Cart) > 0)
			{
				$output['ack'] = 'success';


				$this->POS_DB->QRY("
					INSERT INTO
						PurchaseOrder
						(
							LastUpdated,
							StoreID,
							Status,
							DateCreated,
							RequiredDate,
							SupplierID,
							ExchangeRate,
							IsPlaced,
							[To]
						)
						SELECT

							getdate(),
							1,
							0,
							getdate(),
							getdate(),
							'".$this->db->escape($Data['SupplierID'])."',
							1,
							0,
							(
								SELECT

									SupplierName + CHAR(13)+CHAR(10) +
									Address1 + CHAR(13)+CHAR(10) +
									Address2 + CHAR(13)+CHAR(10) +
									City + ',' + State + ' ' + Zip + CHAR(13) + CHAR(10) +
									'Phone: ' + PhoneNumber + CHAR(13) + CHAR(10) +
									'Fax: ' + FaxNumber + CHAR(13) + CHAR(10) +
									'Contact: ' + ContactName

									AS [To]
								FROM
									Supplier
								WHERE
									ID = '".$this->db->escape($Data['SupplierID'])."'
							)

				");

				$PurchaseOrderID = $this->POS_DB->QRY("select @@IDENTITY as POID");

				if(sizeof($PurchaseOrderID) > 0)
				{
					foreach($Cart AS $_F)
					{
						$Item = $this->POS_DB->QRY("
							SELECT
								*
							FROM
								Item
							WHERE
								ID = '".$this->db->escape($_F['ItemID'])."'
						");

						if(sizeof($Item) > 0)
						{
							$this->POS_DB->QRY("
								INSERT INTO
									PurchaseOrderEntry
									(
										ItemDescription,
										LastUpdated,
										QuantityReceivedToDate,
										StoreID,
										PurchaseOrderID,
										QuantityOrdered,
										ItemID,
										Price,
										LastReceivedDate,
										OrderNumber
									)
									SELECT
										'".$this->db->escape($Item[0]['Description'])."',
										getdate(),
										0,
										1, /*Atlanta, Nashville*/
										'".$this->db->escape($PurchaseOrderID[0]['POID'])."',
										'".$this->db->escape($_F['Qty'])."',
										'".$this->db->escape($_F['ItemID'])."',
										'".$this->db->escape($Item[0]['Cost'])."',
										getdate(),
										(
											SELECT
												ReorderNumber
											FROM
												SupplierList
											WHERE
												ItemID = '".$this->db->escape($_F['ItemID'])."' AND
												SupplierID = '".$this->db->escape($Data['SupplierID'])."'
										)

							");

							$this->deleteCart($Data);
						}
					}
				}

				//

			}
		}


		return $output;
	}

	public function deleteCart($Data = array())
	{
		$output['ack'] = 'error';
		$Data = $this->getPost($Data);

		if(isset($Data['StoreID']) && isset($Data['SupplierID']))
		{
			$output['ack'] = 'success';
			$this->db->QRY("
				DELETE FROM
					gc_modules_pos_stock_cart
				WHERE
					StoreID = '".$this->db->escape($Data['StoreID'])."' AND
					customers_id = '".$this->db->escape($this->login->customers_id)."' AND
					SupplierID = '".$this->db->escape($Data['SupplierID'])."'
			");
		}
		return $output;

	}
	public function deleteItemInCart($Data = array())
	{
		$output['ack'] = 'error';
		$Data = $this->getPost($Data);

		if(isset($Data['StoreID']) && isset($Data['ItemID']))
		{
			$output['ack'] = 'success';
			$this->db->QRY("
				DELETE FROM
					gc_modules_pos_stock_cart
				WHERE
					StoreID = '".$this->db->escape($Data['StoreID'])."' AND
					customers_id = '".$this->db->escape($this->login->customers_id)."' AND
					ItemID = '".$this->db->escape($Data['ItemID'])."'
			");
		}
		return $output;

	}

	private function getPost($Data)
	{
		if(sizeof($Data) == 0)
		{
			return $_POST;
		}
		else
			return $Data;
	}

	public function getCart($Data = array())
	{
		$output['ack'] = 'success';
		$output['HTML'] = '';

		$Data = $this->getPost($Data);

		$SupplierIDs_Qry = $this->db->QRY("
			SELECT
				SupplierID
			FROM
				gc_modules_pos_stock_cart
			WHERE
				StoreID = '".$Data['StoreID']."' AND
				customers_id = '".$this->db->escape($this->login->customers_id)."'
			GROUP BY
				SupplierID

		");

		$SupplierIDs = array();
		foreach($SupplierIDs_Qry AS $_F)
		{
			$SupplierIDs[] = $_F['SupplierID'];
		}

		$SupplierInfo = $this->POS_DB->QRY("
			SELECT
				*
			FROM
				Supplier
			WHERE
				ID in (".implode(',',$SupplierIDs).")
		");

		$ItemsInCart_QRY = $this->db->QRY("
			SELECT
				*
			FROM
				gc_modules_pos_stock_cart
			WHERE
				StoreID = '".$Data['StoreID']."' AND
				customers_id = '".$this->db->escape($this->login->customers_id)."'
			ORDER BY
				UpdatedOn ASC
		");

		$ItemIDs = array();
		foreach($ItemsInCart_QRY AS $_F)
		{
			$ItemIDs[] = $_F['ItemID'];
		}


		$ItemInfo_POS = $this->POS_DB->QRY("
			SELECT
				*
			FROM
				Item
			WHERE
				ID in (".implode(',',$ItemIDs).")
		");


		$ItemInfos = array();
		foreach($ItemInfo_POS AS $_F)
		{
			$ItemInfos[$_F['ID']] = $_F;
		}

		foreach($SupplierInfo AS $_F)
		{
			$Item = array();
			$Summary['Cost_Total'] = 0;
			$Summary['Price_Total'] = 0;
			$Summary['Qty_Total'] = 0;
			$Summary['ItemQty'] = 0;
			foreach($ItemsInCart_QRY AS $_K => $_F2)
			{
				if($_F['ID'] == $_F2['SupplierID'])
				{
					if(isset($ItemInfos[$_F2['ItemID']]))
					{
						$tmp_f = $ItemInfos[$_F2['ItemID']];
						$_F2 = array_merge($_F2, array(
							'ItemLookupCode' => $tmp_f['ItemLookupCode'],
							'Description' => $tmp_f['Description'],
							'Price' => $tmp_f['Price'],
							'Cost' => $tmp_f['Cost']
						));
						$Summary['Cost_Total'] += $tmp_f['Cost'] * $_F2['Qty'];
						$Summary['Price_Total'] += $tmp_f['Price'] * $_F2['Qty'];
						$Summary['Qty_Total'] += $_F2['Qty'];
						$Summary['ItemQty'] += $_F2['Qty'];
					}
					//echo print_r($_F2);
					$Item[] = $_F2;
					unset($ItemsInCart_QRY[$_K]);
				}

			}

			$Summary['Cost_Total'] = number_format($Summary['Cost_Total'],2);
			$Summary['Price_Total'] = number_format($Summary['Price_Total'],2);

			$output['HTML'] .= $this->Load->View('cart/corp/modules/pos-stock/cart.tpl',array(
				"Supplier" => $_F,
				"Item" => $Item,
				"Summary" => $Summary
			));
		}

		return $output;
	}
	private function DataFactory_Family($ItemList)
	{
		#Filtered Item List (Removed Parents & Child)
		$output['ItemList'] = array();

		$output['ParentsIDs'] = array();
		$output['ParentsList'] = array();

		$output['ChildrenIDs'] = array();
		$output['ChildrenList'] = array();

		$ParentsList = array();


		# Build up data : [Parents IDs], Array[ItemLookupCode]
		foreach($ItemList AS $_K => $_F)
		{
			if($_F['ParentItem'] != 0)
				$output['ParentsIDs'][] = $_F['ParentItem'];

			$output['ItemList'][$_F['ItemLookupCode']] = $_F;
		}

		$output['ParentsList'] = $this->findAllParents($output['ParentsIDs']);
		foreach($output['ParentsList'] AS $_F)
		{
			$output['ParentsIDs'][] = $_F['ID'];
		}

		# Filter Parent : Remove all parents in List
		foreach($output['ParentsList'] AS $_K => $_F)
		{
			if(isset($output['ItemList'][$_F['ItemLookupCode']]))
			{
				unset($output['ItemList'][$_F['ItemLookupCode']]);
			}

		}

		# Get Item IDs removed all Parents
		$ItemListIDs_TMP = array();
		foreach($output['ItemList'] AS $_F)
		{
			$ItemListIDs_TMP[] = $_F['ItemID'];
		}

		$output['ChildrenList'] = $this->findAllChildren($ItemListIDs_TMP);
		foreach($output['ChildrenList'] AS $_K => $_F)
		{
			$output['ChildrenIDs'][] = $_F['ID'];

			# Filter Children : Remove all Children in List
			if(isset($output['ItemList'][$_F['ItemLookupCode']]))
			{
				unset($output['ItemList'][$_F['ItemLookupCode']]);
			}
		}
		return $output;
	}

	function findAllParents($ParentItem,$LoopCount = 0)
	{
		$ItemOutput = array();
		$ParentItem_Found = array();

		$Item = $this->POS_DB->QRY("
			SELECT
				Item.ItemLookupCode,
				Item.ParentItem,
				Item.ID
			FROM
				Item
			WHERE
				Item.ID IN (".implode(',',$ParentItem).")
		");

		foreach($Item AS $Item_F)
		{
			if($Item_F['ParentItem'] != 0)
				$ParentItem_Found[] = $Item_F['ParentItem'];

			$ItemOutput[] = $Item_F;
		}

		if(sizeof($ParentItem_Found) > 0 && $LoopCount < 100)
		{
			$this->findAllParents($ParentItem_Found,$LoopCount + 1);
		}

		return $ItemOutput;
	}

	function findAllChildren($ItemID)
	{
		$ItemOutput = array();
		$ItemID_Found = array();

		$Item = $this->POS_DB->QRY("
			SELECT
				Item.ItemLookupCode,
				Item.ParentItem,
				Item.ID
			FROM
				Item
			WHERE
				Item.ParentItem IN (".implode(',',$ItemID).")
		");


		foreach($Item AS $Item_F)
		{
			$ItemID_Found[] = $Item_F['ID'];
			$ItemOutput[] = $Item_F;
		}
		if(sizeof($ItemID_Found) > 0)
		{
			$this->findAllChildren($ItemID_Found);
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
				(isset($ItemSKU) && sizeof($ItemSKU) > 0 ? " (ItemClass.ItemLookupCode = '".implode("' OR ItemClass.ItemLookupCode = '",$ItemSKU)."')" : "")
			."
			ORDER BY
				ItemClass.ID
		");
	}

	function getItemSQL_SpecificItemID($Data = array())
	{

		return $this->POS_DB->QRY("
			SELECT
				CASE WHEN Od.ItemID IS NOT NULL THEN 1 ELSE 0 END AS Ordered,
				Supplier.SupplierName,
				I.SupplierID,
				I.ItemLookupCode,
				I.ID AS ItemID,
				I.Quantity,
				I.ParentItem,
				I.ParentQuantity,
				I.Description,
				I.DateCreated,
				I.Cost,
				I.Price,
				ISNULL(M6.Quantity,0) AS M6,
				ISNULL(M5.Quantity,0) AS M5,
				ISNULL(M4.Quantity,0) AS M4,
				ISNULL(M3.Quantity,0) AS M3,
				ISNULL(M2.Quantity,0) AS M2,
				ISNULL(M1.Quantity,0) AS M1,
				CEILING((ISNULL(M6.Quantity,0) + ISNULL(M5.Quantity,0) + ISNULL(M4.Quantity,0)) + ISNULL(M3.Quantity,0) + ISNULL(M2.Quantity,0) + ISNULL(M1.Quantity,0) / 6) AS New_RP
			FROM
				Item I
					LEFT JOIN
						[Supplier]
					ON
						I.SupplierID = Supplier.ID
					LEFT JOIN
					(
						SELECT
							SUM(Quantity) AS Quantity,
							TE.ItemID
						FROM
							TransactionEntry TE
						WHERE
							TE.TransactionTime >= DATEADD(month, -6, GETDATE()) AND
							TE.TransactionTime < DATEADD(month, -5, GETDATE())
						GROUP BY
							TE.ItemID
					) AS M6
					ON
						I.ID = M6.ItemID

					LEFT JOIN
					(
						SELECT
							SUM(Quantity) AS Quantity,
							TE.ItemID
						FROM
							TransactionEntry TE
						WHERE
							TE.TransactionTime >= DATEADD(month, -5, GETDATE()) AND
							TE.TransactionTime < DATEADD(month, -4, GETDATE())
						GROUP BY
							TE.ItemID
					) AS M5
					ON
						I.ID = M5.ItemID

					LEFT JOIN
					(
						SELECT
							SUM(Quantity) AS Quantity,
							TE.ItemID
						FROM
							TransactionEntry TE
						WHERE
							TE.TransactionTime >= DATEADD(month, -4, GETDATE()) AND
							TE.TransactionTime < DATEADD(month, -3, GETDATE())
						GROUP BY
							TE.ItemID
					) AS M4
					ON
						I.ID = M4.ItemID

					LEFT JOIN
					(
						SELECT
							SUM(Quantity) AS Quantity,
							TE.ItemID
						FROM
							TransactionEntry TE
						WHERE
							TE.TransactionTime >= DATEADD(month, -3, GETDATE()) AND
							TE.TransactionTime < DATEADD(month, -2, GETDATE())
						GROUP BY
							TE.ItemID
					) AS M3
					ON
						I.ID = M3.ItemID

					LEFT JOIN
					(
						SELECT
							SUM(Quantity) AS Quantity,
							TE.ItemID
						FROM
							TransactionEntry TE
						WHERE
							TE.TransactionTime >= DATEADD(month, -2, GETDATE()) AND
							TE.TransactionTime < DATEADD(month, -1, GETDATE())
						GROUP BY
							TE.ItemID
					) AS M2
					ON
						I.ID = M2.ItemID

					LEFT JOIN
					(
						SELECT
							SUM(Quantity) AS Quantity,
							TE.ItemID
						FROM
							TransactionEntry TE
						WHERE
							TE.TransactionTime >= DATEADD(month, -1, GETDATE()) AND
							TE.TransactionTime < DATEADD(month, 0, GETDATE())
						GROUP BY
							TE.ItemID
					) AS M1
					ON
						I.ID = M1.ItemID


						LEFT JOIN
						(
							SELECT
								OE1.ItemID
							FROM
								[PurchaseOrder] O1
									LEFT JOIN
										PurchaseOrderEntry OE1
									ON
										OE1.PurchaseOrderID = O1.ID
							WHERE
								Status = 0 AND
								DateCreated >= DATEADD(month, -1, GETDATE()) AND
								DateCreated < DATEADD(month, 0, GETDATE())
							GROUP BY
								OE1.ItemID
						)
						Od on
							Od.ItemID = I.ID


			WHERE
				I.ID IN (".implode(',',$Data['ItemIDs']).")
		");
	}

	public function addToCart($Data = array())
	{
		$output['ack'] = 'success';

		if(sizeof($Data) == 0)
		{
			$Data = $_POST;
		}



		if(isset($Data['Qty']) && is_numeric($Data['Qty']) && isset($Data['ItemID']) && isset($Data['SupplierID']))
		{
			if($Data['SupplierID'] == 0)
			{
				$output['ack'] = 'error';
				$output['error_msg'] = 'This item has no supplier.';
			}

			$Item = $this->getItemInfo($Data['ItemID']);
			if(sizeof($Item) > 0)
			{
				$this->db->QRY("
					INSERT INTO
						gc_modules_pos_stock_cart
						(
							customers_id,
							ItemID,
							SupplierID,
							Qty,
							StoreID
						)
						VALUES
						(
							'".$this->db->escape($this->login->customers_id)."',
							'".$this->db->escape($Data['ItemID'])."',
							'".$this->db->escape($Data['SupplierID'])."',
							'".$this->db->escape($Data['Qty'])."',
							'".$this->db->escape($Data['StoreID'])."'
						)
						ON DUPLICATE KEY UPDATE
							Qty = Qty + '".$this->db->escape($Data['Qty'])."'
				");
			}
			else
			{
				$output['ack'] = 'error';
				$output['error_msg'] = 'Item does not exist in POS system.';
			}

		}
		else
		{
			$output['ack'] = 'error';
			$output['error_msg'] = 'Unkown Error';
		}


		return $output;
	}

	private function checkIfItemInCart()
	{
		return (sizeof($this->db->QRY("

		")) > 0 ? true : false);
	}
	private function getItemInfo($ItemID)
	{
		return $this->POS_DB->QRY("
			SELECT
				*
			FROM
				Item
			WHERE
				ID = '".$this->db->escape($ItemID)."'");

	}
	function getItemsSQL($Data = array())
	{


		return $this->POS_DB->QRY("
			SELECT
				CASE WHEN Od.ItemID IS NOT NULL THEN 1 ELSE 0 END AS Ordered,
				Supplier.SupplierName,
				Item.SupplierID,
				Item.ItemLookupCode,
				Item.ID AS ItemID,
				Item.Quantity,
				Item.ParentItem,
				Item.ParentQuantity,
				Item.Description,
				Item.DateCreated,
				Item.Cost,
				Item.Price,
				M1.SQ AS M1,
				M2.SQ AS M2,
				M3.SQ AS M3,
				M4.SQ AS M4,
				M5.SQ AS M5,
				M6.SQ AS M6,
				AddedMonthAgo.M_Ago,
				New_.RP AS New_RP
			FROM

				(
					SELECT
						TE_Sub.ItemID,
						(
							SELECT
								SUM(Quantity)
							FROM
								TransactionEntry TE
							WHERE
								TE.TransactionTime >= DATEADD(month, -6, GETDATE()) AND
								TE.TransactionTime < DATEADD(month, -5, GETDATE()) AND
								TE_Sub.ItemID = TE.ItemID

						) AS M6,
						(
							SELECT
								SUM(Quantity)
							FROM
								TransactionEntry TE
							WHERE
								TE.TransactionTime >= DATEADD(month, -5, GETDATE()) AND
								TE.TransactionTime < DATEADD(month, -4, GETDATE()) AND
								TE_Sub.ItemID = TE.ItemID

						) AS M5,
						(
							SELECT
								SUM(Quantity)
							FROM
								TransactionEntry TE
							WHERE
								TE.TransactionTime >= DATEADD(month, -4, GETDATE()) AND
								TE.TransactionTime < DATEADD(month, -3, GETDATE()) AND
								TE_Sub.ItemID = TE.ItemID

						) AS M4,
						(
							SELECT
								SUM(Quantity)
							FROM
								TransactionEntry TE
							WHERE
								TE.TransactionTime >= DATEADD(month, -3, GETDATE()) AND
								TE.TransactionTime < DATEADD(month, -2, GETDATE()) AND
								TE_Sub.ItemID = TE.ItemID

						) AS M3,
						(
							SELECT
								SUM(Quantity)
							FROM
								TransactionEntry TE
							WHERE
								TE.TransactionTime >= DATEADD(month, -2, GETDATE()) AND
								TE.TransactionTime < DATEADD(month, 1, GETDATE()) AND
								TE_Sub.ItemID = TE.ItemID

						) AS M2,
						(
							SELECT
								SUM(Quantity)
							FROM
								TransactionEntry TE
							WHERE
								TE.TransactionTime >= DATEADD(month, -1, GETDATE()) AND
								TE.TransactionTime < DATEADD(month, 0, GETDATE()) AND
								TE_Sub.ItemID = TE.ItemID

						) AS M1


					FROM
						(
							SELECT
								*
							FROM
								TransactionEntry TE
							WHERE
								TE.TransactionTime >= DATEADD(month, -6, GETDATE()) AND
								TE.TransactionTime < DATEADD(month, 0, GETDATE())
								".(isset($Data['ParentsIDs']) && sizeof($Data['ParentsIDs']) > 0 ? 'AND TE.ItemID IN ('.implode(',',$Data['ParentsIDs']).')' : '' )."
								".(isset($Data['ItemIDs']) && is_array($Data['ItemIDs']) && sizeof($Data['ItemIDs']) > 0 ? 'AND TE.ItemID IN ('.implode(',',$Data['ItemIDs']).')' : '' )."
						) AS TE_Sub

					GROUP BY
						TE_Sub.ItemID
				) AS Trans

				LEFT JOIN
				(
					SELECT
						OE1.ItemID
					FROM
						[PurchaseOrder] O1
							LEFT JOIN
								PurchaseOrderEntry OE1
							ON
								OE1.PurchaseOrderID = O1.ID
					WHERE
						Status = 0 AND
						DateCreated >= DATEADD(month, -6, GETDATE()) AND
						DateCreated < DATEADD(month, 0, GETDATE())
					GROUP BY
						OE1.ItemID
				)
				Od on
					Od.ItemID = Item.ID

				LEFT JOIN
					Item
				ON
					Item.ID = Trans.ItemID

				LEFT JOIN
					[Supplier]
				ON
					Item.SupplierID = Supplier.ID

				CROSS APPLY (SELECT (DATEDIFF(DAY, Item.DateCreated, DATEADD(month, 0, GETDATE())) / 30) AS M_Ago) AS AddedMonthAgo
				CROSS APPLY (SELECT ISNULL(Trans.M1,0) AS SQ) AS M1
				CROSS APPLY (SELECT ISNULL(Trans.M2,0) AS SQ) AS M2
				CROSS APPLY (SELECT ISNULL(Trans.M3,0) AS SQ) AS M3
				CROSS APPLY (SELECT ISNULL(Trans.M4,0) AS SQ) AS M4
				CROSS APPLY (SELECT ISNULL(Trans.M5,0) AS SQ) AS M5
				CROSS APPLY (SELECT ISNULL(Trans.M6,0) AS SQ) AS M6
				CROSS APPLY (SELECT
					CASE
						WHEN
							AddedMonthAgo.M_Ago > 6
						THEN
							CEILING((M1.SQ + M2.SQ + M3.SQ + M4.SQ + M5.SQ + M6.SQ) / 6)
						WHEN
							AddedMonthAgo.M_Ago = 5
						THEN
							CEILING((M2.SQ + M3.SQ + M4.SQ + M5.SQ + M6.SQ) / 5)
						WHEN
							AddedMonthAgo.M_Ago = 4
						THEN
							CEILING((M3.SQ + M4.SQ + M5.SQ + M6.SQ) / 4)
						WHEN
							AddedMonthAgo.M_Ago = 3
						THEN
							CEILING((M4.SQ + M5.SQ + M6.SQ) / 3)
						WHEN
							AddedMonthAgo.M_Ago = 2
						THEN
							CEILING((M5.SQ + M6.SQ) / 2)
						WHEN
							AddedMonthAgo.M_Ago = 1
						THEN
							M6.SQ

					END AS
						RP

				) AS New_

				WHERE
					Item.DoNotOrder = 0
					".($Data['onlyNeedOrder'] ? 'AND New_.RP >= Item.Quantity' : '' )."

				ORDER BY
					Supplier.SupplierName ASC	,
					Item.ItemLookupCode ASC

		");


	}

}

?>
