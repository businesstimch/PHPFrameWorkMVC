<?
class _Cache extends GGoRok
{
	var $_Cache;
	var $_CachePath;
	function __construct()
	{
		$this->_Cache['Category'] ='Top-Category.cache';
		$this->_Cache['TopSearchCategory'] ='TopSearch-Category.cache';
		
		$this->_CachePath = __BackendPath__.'Cache/';
	}
	function Generate($What = 'All')
	{

		$output['ack'] = 'error';
		if($What == 'Category' || $What == 'All')
		{
			$Temp[] = $this->generateLeftCategory();
			
		}
		
		if($What == 'TopSearchCategory' || $What == 'All')
		{
			$Temp[] = $this->generateTopSearchCategory();
		}
		
		
		# Write Cache
		if(isset($Temp))
		{
			foreach($Temp AS $_F)
			{
				$this->write_cache($_F['CacheName'], $_F['Data'])['ack'];
			}
			$output['ack'] = 'success';
		}
		
		return $output;
	}
	
	function generateTopSearchCategory()
	{
		$output['CacheName'] = $this->_Cache['TopSearchCategory'];
		$output['Data'] = '';
		$Cat = $this->db->QRY("
			SELECT
				Cat_ID,
				Cat_Name,
				Cat_SEO_URL,
				Cat_Parent_ID
			FROM
				gc_category
			WHERE
				Store_ID = '".__StoreID__."' AND
				Cat_isActive = 1 AND
				Cat_Parent_ID = 0
			ORDER BY
				Cat_Sort ASC
		");
		foreach($Cat as $K => $Cat_F)
		{
			$output['Data'] .= '<div class="SCL_One" data-catid="'.$Cat_F['Cat_ID'].'">'.$Cat_F['Cat_Name'].'</div>';
		}
		return $output;
	}
	function generateLeftCategory()
	{
		$output['CacheName'] = $this->_Cache['Category'];
		$output['Data'] = '';
		$output['Data'] .= '<div id="Top_Category" class="noSelect">';
		
		$Cat = $this->db->QRY("
			SELECT
				Cat_ID,
				Cat_Name,
				Cat_SEO_URL,
				Cat_Parent_ID
			FROM
				gc_category
			WHERE
				Store_ID = '".__StoreID__."' AND
				Cat_isActive = 1 
			ORDER BY
				Cat_Sort ASC
		");
		
		$Cat_tmp = $Cat;
		foreach($Cat as $K => $Cat_F)
		{
			# Get Highest Categories List : Looping 1
			if($Cat_F['Cat_Parent_ID'] == 0)
			{
				
				
				# Collect Data ::
				$SubCategory_Arr = array();
				$SubCategory_HTML = "";
				
				# First Children : Looping 2
				foreach($Cat_tmp AS $K2 => $Cat_tmp_F)
				{
					if($Cat_tmp_F['Cat_Parent_ID'] == $Cat_F['Cat_ID'])
					{
						
						
						$SubCategory_Arr[] = '<a class="TC_Sub_Par block" href="/c/'.$Cat_tmp_F['Cat_SEO_URL'].'/">'.$Cat_tmp_F['Cat_Name'].' ('.$this->_Category->getTotalPrd_InCat($Cat_tmp_F['Cat_ID']).') </a>';
						
						# Second Children : Looping 3
						foreach($Cat_tmp AS $K3 => $Cat_tmp_2_F)
						{
							if($Cat_tmp_2_F['Cat_Parent_ID'] == $Cat_tmp_F['Cat_ID'])
							{
								$SubCategory_Arr[] = '<a class="TC_Sub_Chil block" href="/c/'.$Cat_tmp_2_F['Cat_SEO_URL'].'/">'.$Cat_tmp_2_F['Cat_Name'].' ('.$this->_Category->getTotalPrd_InCat($Cat_tmp_2_F['Cat_ID']).')</a>';
								unset($Cat_tmp[$K3]);
							}
						}
						
						unset($Cat_tmp[$K2]);
					}
				}
				# Collect Data ;;
				
				# Print Data :: 
				if(sizeof($SubCategory_Arr) > 0)
				{
					
					
					foreach($SubCategory_Arr as $K => $SubCategory_Arr_F)
					{
						
						$SubCategory_HTML .= $SubCategory_Arr_F;
						
					}
					
				}
				
				unset($Cat_tmp[$K]);
				$output['Data'] .= '
					<div class="Top_Category_One">
						<a class="TC_Title" href="/c/'.$Cat_F['Cat_SEO_URL'].'/">'.$Cat_F['Cat_Name'].($SubCategory_HTML != "" ? '<i class="fa fa-chevron-right"></i>' : '').'</a>
						'.($SubCategory_HTML != ""? '<div class="TC_Sub">'.$SubCategory_HTML.'</div>':"").'
					</div>
				';
				# Print Data ;;
			}
		}
		
		/* Finish Later : Tim
		$Cat_AZ = $this->db->QRY("
			SELECT
				Cat_ID,
				Cat_Name,
				Cat_SEO_URL,
				Cat_Parent_ID
			FROM
				gc_category
			WHERE
				Store_ID = '".__StoreID__."' AND
				Cat_Parent_ID = 0 AND
				Cat_isActive = 1
			ORDER BY
				Cat_Name ASC
		");
		$Cat_AZ_Arr = array();
		$Cat_AZ_Html = "";
		foreach($Cat_AZ AS $Cat_AZ_F)
		{
			$Cat_AZ_Arr[] = '<a class="TC_Sub_Chil block" href="/c/'.$Cat_AZ_F['Cat_SEO_URL'].'/">'.$Cat_AZ_F['Cat_Name'].'</a>';
		}
		
		if(sizeof($Cat_AZ_Arr) > 0)
		{
			
			$BreakPoint = ceil(sizeof($Cat_AZ_Arr) / 3);
			$BreakPoint_Open = false;
			
			
			foreach($Cat_AZ_Arr as $K => $Cat_AZ_Arr_F)
			{
				
				if($K > 0 && $K % $BreakPoint == 0 && $K != 0)
				{
			
					$Cat_AZ_Html .= '</div></td><td><div class="TC_Sub_Wrapper">';
				}
				
				$Cat_AZ_Html .= $Cat_AZ_Arr_F;
				
			}
			$Cat_AZ_Html = ($Cat_AZ_Html != "" ? '<table><tr><td><div class="TC_Sub_Wrapper">'.$Cat_AZ_Arr_F.'</div></td></tr></table>' : "");
		}
		$output['Data'] .= '
			<div class="Top_Category_One">
				<a class="TC_Title" href="">Sort by A-Z</a>
				<div class="TC_Sub">
				'.$Cat_AZ_Html.'
				</div>
			</div>
		';
		*/
		
		$output['Data'] .= '
		</div>';
		
		return $output;
	}
	
	function write_cache($CacheName, $Data)
	{
		$F = fopen($this->_CachePath.$CacheName, "w") or die("Unable to open file!");
		fwrite($F, $Data);
		fclose($F);
		$output['ack'] = 'success';
		return $output;
	}
	
	function get_cache($CacheKey)
	{
		$output['ack'] = 'error';
		if(isset($this->_Cache[$CacheKey]) && is_file($this->_CachePath.$this->_Cache[$CacheKey]))
		{
			$output['ack'] = 'success';
			$output['data'] = file_get_contents($this->_CachePath.$this->_Cache[$CacheKey]);
		}
		return $output;
	}
}

?>