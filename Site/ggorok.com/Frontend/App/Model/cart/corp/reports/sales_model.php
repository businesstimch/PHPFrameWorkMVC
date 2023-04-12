<?

class CartCorpReportsSales_Model extends GGoRok_Model{
	
	function getVisitorInfo($Data)
	{
		
		return $this->mssql->QRY("
			SELECT
				SUM(CASE WHEN Customer.AccountNumber LIKE '%400%' THEN 1 ELSE 0 END) as Internet,
				SUM(CASE WHEN Customer.AccountNumber NOT LIKE '%400%' THEN 1 ELSE 0 END) as Walk,
				SUM(
					CASE WHEN
						Customer.AccountNumber
					LIKE
						'%400%' AND
						[Customer].AccountOpened > Convert(DateTime,'".$Data['DateFrom']." 00:00:00',111) AND
						[Customer].AccountOpened < Convert(DateTime,'".$Data['DateTo']." 23:00:00',111)
					THEN 1 ELSE 0 END
				) as Internet_New,
				
				SUM(
					CASE WHEN
						Customer.AccountNumber
					LIKE
						'%400%' AND
						[Customer].AccountOpened < Convert(DateTime,'".$Data['DateFrom']." 00:00:00',111) OR
						[Customer].AccountOpened > Convert(DateTime,'".$Data['DateTo']." 23:00:00',111)
					THEN 1 ELSE 0 END
				) as Internet_Old,

				SUM(
					CASE WHEN
						Customer.AccountNumber
					NOT LIKE
						'%400%' AND
						[Customer].AccountOpened > Convert(DateTime,'".$Data['DateFrom']." 00:00:00',111) AND
						[Customer].AccountOpened < Convert(DateTime,'".$Data['DateTo']." 23:00:00',111)
					THEN 1 ELSE 0 END
				) as Walk_New,
				
				SUM(
					CASE WHEN
						Customer.AccountNumber
					NOT LIKE
						'%400%' AND
						[Customer].AccountOpened < Convert(DateTime,'".$Data['DateFrom']." 00:00:00',111) OR
						[Customer].AccountOpened > Convert(DateTime,'".$Data['DateTo']." 23:00:00',111)
					THEN 1 ELSE 0 END
				) as Walk_Old

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
				[Transaction].Time > Convert(DateTime,'".$Data['DateFrom']." 00:00:00',111) AND
				[Transaction].Time < Convert(DateTime,'".$Data['DateTo']." 23:00:00',111) AND
				Cashier.inactive = 0
			
		");
	}
	function getTransaction($Data)
	{
		return $this->mssql->QRY("
			SELECT
				[Transaction].TransactionNumber,
				Item.ID as ItemID,
				Customer.AccountOpened as AccountOpened,
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
					
				CASE TransactionEntry.PriceSource
					WHEN 1 THEN 'Regular Price'
					WHEN 2 THEN (CASE WHEN TransactionEntry.QuantityDiscountID <> 0 THEN QuantityDiscount.Description ELSE 'Quantity Discount' END)
					WHEN 3 THEN 'Buydown Discount'
					WHEN 4 THEN 'Price Level Disc.'
					WHEN 5 THEN 'Sale Price'
					WHEN 6 THEN 'Disc. from Reg. Price'
					WHEN 7 THEN 'Disc. from Cur. Price'
					WHEN 8 THEN 'Cost Markup Disc.'
					WHEN 9 THEN 'Profit Margin Disc.'
					WHEN 10 THEN 'Cashier Set'
					WHEN 11 THEN 'Component'
					WHEN 12 THEN 'Price Level A Disc.'
					WHEN 13 THEN 'Price Level B Disc.'
					WHEN 14 THEN 'Price Level C Disc.'
					WHEN 15 THEN 'Disc. from Reg. Price'
					WHEN 16 THEN 'Disc. from Cur. Price'
					WHEN 17 THEN 'Cost Markup Disc.'
					WHEN 18 THEN 'Profit Margin Disc.'
				ELSE
					'Unknown' END AS PriceSource,
						
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
					[Transaction].Time > Convert(DateTime,'".$Data['Transactions']."',111) AND
					
					/*[Transaction].Time > Convert(DateTime,'2017-01-01 00:00:00',111) AND
					[Transaction].Time < Convert(DateTime,'2017-12-31 00:00:00',111) AND*/
					
					Cashier.inactive = 0
				ORDER BY
					Total DESC
				
		");
	}
}
?>