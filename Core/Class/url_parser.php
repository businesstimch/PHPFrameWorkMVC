<?
class url_parser extends GGoRok
{
	function Start($URL)
	{
		$URL = explode('?',$URL);
		$isAdmin_Page = false;
		
		if(sizeof($URL) > 0)
		{
			
			$URL[0] = preg_replace("/^\//", "" , $URL[0]);
			$URL[0] = preg_replace("/\/$/", "" , $URL[0]);
			
			$URL_Arr = explode('/',$URL[0]);
			$isAdmin_Page = ($URL_Arr[0] == __AdminPath__ ? true:false);
		}
		
		if(isset($_GET['menu']) && $_GET['menu'] == 'logout')
		{
			$login->logout();
			if($isAdmin_Page)
			{
				header( 'Location: '.__HTTPS__.'/'.__AdminPath__.'/' );
			}
			else
				header( 'Location: '.__HTTPS__ );
		}
		
		if(sizeof(array_filter($URL_Arr)) > 0) # Delete All Empty Arrays
		{
			
			$URL_Folders = "";
			$URL_Folders_TMP = "";
			$ReservedURL = array("jsPage","cssPage","jsDynamic");
			foreach($URL_Arr as $K => $URL_Arr_F)
			{
				if(sizeof($URL_Arr) - 1 > $K && !in_array($URL_Arr_F, $ReservedURL))
					$URL_Folders .= $URL_Arr_F.'/';
				
				/*To check URL if requested URL is File or Existing template folder. If there are duplicated situation, folder has higher priority.*/
				$URL_Folders_TMP .= $URL_Arr_F.'/';
			}                                               
			
			
			
			$URL_File = $URL_Arr[sizeof($URL_Arr) - 1];	
			$URL_File_Path = $URL_Folders.$URL_File;
			$URL_File_Name = explode('.',$URL_File)[0];
			
			
			if(is_dir(__FrontendPath__.$URL_File_Path))
			{
				$output['URL_File_Path'] = $URL_File_Path."/home";
			}
		}
		else
		{
			$output['URL_File_Path'] = "home";
		}
		
		$output['URL_Arr'] = $URL_Arr;
		return $output;
	}
}
?>