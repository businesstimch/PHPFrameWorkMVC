<?php
class Controllers extends GGoRok
{
	var $URL_Arr = array();
	public $output = array(
		'Want_Type' => "",
		'Want_FolderPath' => "",
		'Want_File' => "",
	);
	
	private $ReservedURL = array(
		"jsPage",
		"cssPage",
		"jsDynamic",
		"global"
	);
	
	function getRequestArray($URL = null)
	{
		$URL = (is_null($URL) ? $_SERVER['REQUEST_URI'] : $URL);
		
		# Extract only URL Path
		$URL = explode('?',$URL);
		
		if(sizeof($URL) > 0)
		{
			$URL[0] = preg_replace("/^\//", "" , $URL[0]);
			$URL[0] = preg_replace("/\/$/", "" , $URL[0]); # ex_ http://gr.burugo.com/cssPage/home/ => cssPage/home
			$URL_Arr = explode('/',$URL[0]); # ex_ cssPage/home => Array (0 => 'cssPage', 1 => 'home')
		}
		return $URL_Arr;
		
	}
	function Start()
	{
		$URL = $_SERVER['REQUEST_URI'];
		
		$CustomURL = $this->_CustomURL->getCustom_URL($URL);
		if(is_array($CustomURL) && _SubDomain_ == $CustomURL[2])
		{
			$Only_URL = $CustomURL[1];
			$this->URL_Arr = $this->getRequestArray($Only_URL);
		}
		else
		{
			$Only_URL = explode('?',$URL)[0];
			$this->URL_Arr = $this->getRequestArray($URL);
		}
		
		
		# If Ends with Slash(/)
		if(preg_match("/\/$/",$Only_URL))
		{
			$Controller_Path = $Only_URL;
			$Controller_File = 'home';
		}
		else
		{
			$Controller_Path = '';
			$Controller_File = $this->URL_Arr[sizeof($this->URL_Arr) - 1];
			foreach($this->URL_Arr AS $K => $URL_Arr_F)
			{
				if((sizeof($this->URL_Arr) - 1) > $K)
				{
					$Controller_Path .= '/'.$URL_Arr_F;
				}
			}
		}
		
		
		$isGlobalRequest = false;
		if(preg_match('/^\/global\//',$Controller_Path))
		{
			$isGlobalRequest = true;
			$Controller_Path = preg_replace('/^\/global\//','/',$Controller_Path);
		}
		
		$Controller_LocalPath = ($isGlobalRequest ? "":_SubDomain_).preg_replace("/\/$/","",$Controller_Path).'/'.$Controller_File;
		
		$Controller_Path = __FrontendPath__.'App/Controller/'.$Controller_LocalPath.'_controller.php';
		
		if(is_file($Controller_Path))
		{
			require_once($Controller_Path);
			
			$Controller_ClassName = preg_replace('/-/','',preg_replace('/\//','',$Controller_LocalPath)).'_controller';
			$this->Class_Temp = new $Controller_ClassName;
			
			if(isset($this->Class_Temp->_isAdminPage))
			{
				
				if($this->Class_Temp->admin->isAdminUser())
				{
					$displayAdminPage = true;
				}
				else
				{
					$displayAdminPage = false;
				}
			}
			
			if(isset($_GET['ajaxProcess']))
			{
				$output['ack'] = 'error';
				
				if(isset($_POST['menu']) && $_POST['menu'] != "")
				{
					$Menu = $_POST['menu'];
				}
				else if(isset($_GET['menu']) && $_GET['menu'] != "")
				{
					$Menu = $_GET['menu'];
				}
				
				if(isset($Menu))
				{
					if(method_exists($this->Class_Temp,$Menu))
					{
						$reflection = new ReflectionMethod($this->Class_Temp, $Menu);
						if ($reflection->isPublic())
						{
							//header("Access-Control-Allow-Origin: *");
							$output = $this->Class_Temp->{$Menu}();
						}
						 
						
					}
				}
				echo json_encode($output,JSON_UNESCAPED_UNICODE);
			}
			else if(method_exists($this->Class_Temp,'home'))
			{
				if(isset($displayAdminPage) && !$displayAdminPage)
				{
					header('Location: /login?Redirect='.preg_replace('/home$/','',preg_replace('/^'._SubDomain_.'/','',$Controller_LocalPath)));
				}
				else 
					$this->Class_Temp->home();
					
			}
			else
			{
				header("HTTP/1.0 404 Not Found");
				echo $this->Load->View("404.tpl");
			}
		}
		else
		{
			header("HTTP/1.0 404 Not Found");
			echo $this->Load->View("404.tpl");
		}
		
		/*
		$ControllerFilePath_To_Load = __FrontendPath__.'App/Controller/'._SubDomain_.'/'.$Requested_Controller.'_controller.php';
		if(is_file($ControllerFilePath_To_Load))
		{
			echo '<br />yes';
		}
		*/
		
		//echo print_r($URL_Arr);
		
		
	}
	
	function CSS()
	{
		
	}
	function JS()
	{
		
	}
	
	
}

?>