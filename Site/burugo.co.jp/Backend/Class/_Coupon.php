<?
class _Coupon
{
	function get_Coupons($StoreID, $All = true)
	{
		global $db, $login;
		$Coupon = $db->QRY("
			SELECT
				*,
				DATE_FORMAT(coupon_starts,'%m/%d/%Y') as coupon_starts,
				DATE_FORMAT(coupon_ends,'%m/%d/%Y') as coupon_ends
			FROM
				b_store_ceo_coupon
			WHERE
				store_id = '".$db->escape($StoreID)."'
			ORDER BY
				coupon_id DESC
		");
		
		return $Coupon;
		
	}
	
}
?>