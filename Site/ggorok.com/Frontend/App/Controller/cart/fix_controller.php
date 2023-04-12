<?php
class CartFix_Controller extends GGoRok
{
	
	var $Jani_DB;
	function __construct()
	{
		$this->Jani_DB = $this->Jani_DB();
	}
	function home()
	{
		ini_set('memory_limit', '1024M');
		$P = $this->db->QRY('
			SELECT
				*
			FROM
				gc_products_to_categories g2c,
				gc_products p
			WHERE
				p.`Prd_ID` = g2c.`Prd_ID` AND
				(
					g2c.`Cat_ID` IN (211,1272,1349,1350,1351,1266)
				)
				AND
				(
					p.`Prd_ID` NOT IN (
						3130,
						3326,
						4478,
						4836,
						14477,
						14479,
						14481,
						14483,
						14525,
						14547,
						14974,
						14984,
						15010,
						15167,
						15306,
						15354,
						15355,
						15423,
						15433,
						16040,
						16041,
						16056,
						16233,
						16234,
						16245,
						16247,
						16377,
						16430
					)
				)
			ORDER BY
				g2c.`Prd_Sort`
		');
		
		foreach($P AS $P_F)
		{
			/*
			$this->Jani_DB->QRY('
				INSERT INTO
					products
					(
						products_id,
						keyword,
						products_quantity,
						products_model,
						products_price,
						products_weight,
						products_status
					)
					VALUES
					(
						"'.($this->db->escape($P_F['Prd_ID'])).'",
						"'.($this->db->escape($P_F['Prd_Meta_Key'])).'",
						"'.($this->db->escape($P_F['Prd_Qty'])).'",
						"'.($this->db->escape($P_F['Prd_SKU'])).'",
						"'.($this->db->escape($P_F['Prd_Price'])).'",
						"'.($this->db->escape($P_F['Prd_Weight'])).'",
						"'.($this->db->escape($P_F['Prd_isActive'])).'"
					)
			');
			
			
			$this->Jani_DB->QRY('
				INSERT INTO
					products_description
					(
						products_id,
						language_id,
						products_name,
						products_description,
						products_head_title_tag,
						products_head_desc_tag,
						products_head_keywords_tag,
						short_desc
					)
					VALUES
					(
						"'.($this->db->escape($P_F['Prd_ID'])).'",
						1,
						"'.($this->db->escape($P_F['Prd_Name'])).'",
						"'.($this->db->escape($P_F['Prd_Desc_Long'])).'",
						"'.($this->db->escape($P_F['Prd_Meta_Title'])).'",
						"'.($this->db->escape($P_F['Prd_Meta_Desc'])).'",
						"'.($this->db->escape($P_F['Prd_Meta_Key'])).'",
						"'.($this->db->escape($P_F['Prd_Desc_Short'])).'"
					)
			');
			
			/*
			$this->Jani_DB->QRY('
				INSERT INTO
					products_to_categories
					(
						products_id,
						categories_id,
						products_sort_order
					)
					VALUES
					(
						"'.($this->db->escape($P_F['Prd_ID'])).'",
						"'.($this->db->escape($P_F['Cat_ID'])).'",
						"'.($this->db->escape($P_F['Prd_Sort'])).'"
					)
			');
			*/
		}
		/*
		echo $this->Jani_DB->QRY('
			
		');
		*/
		
	}
	
	function Jani_DB()
	{
		$this->Jani_DB = new $this->db;
		$this->Jani_DB->connect(array(
			'DB_Name' => 'janilink_new',
			'DB_Server' => 'janilink.com',
			'DB_UserName' => 'remote',
			'DB_Password' => 'MJaCall@MQNb^!%'
		));
		
		return $this->Jani_DB;
	}
/*
211
1272
1349
1350
1351
1266

*/
}

?>