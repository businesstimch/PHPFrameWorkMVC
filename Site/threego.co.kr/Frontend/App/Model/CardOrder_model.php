<?php
class CardOrder_model extends GGoRok {
	function makeReservation($Data)
	{
		return $this->db->QRY("
			INSERT INTO
				".DB_Table_Prefix."card_order_reservation
				(
					customers_id,
					Card_Type,
					OReserv_Time,
					OReserv_Personnel
				)
				VALUES
				(
					'".$this->db->escape($Data['customers_id'])."',
					'".$this->db->escape($Data['Card_Type'])."',
					'".$this->db->escape($Data['OReserv_Time'])."',
					'".$this->db->escape($Data['OReserv_Personnel'])."'
				)
		",TRUE);
	}
}
?>