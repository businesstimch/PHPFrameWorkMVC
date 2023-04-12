<?php

class Load extends GGoRok
{
	function Controller($_CallPath = null)
	{
		
		# Divide URL between /Folder/File beween Parameters
		//$Controller->parseURL();
		
		//$Controller->output['Want_Type']
		
		$Path = __FrontendPath__.'App/Controller/'.$_CallPath.'_controller.php';
		if(is_file($Path))
		{
			require($Path);
			$ClassName = preg_replace('/-/','',preg_replace('/\//','',$_CallPath)).'_controller';
			$Class_Temp = new $ClassName;
			return $Class_Temp;
		}
		else
			trigger_error("Can't find Controller : ".$_CallPath, E_USER_NOTICE);
		
		
		
		
	}
	
	function Model($_CallPath = null)
	{
		$Path = __FrontendPath__.'App/Model/'.$_CallPath.'_model.php';
		
		if(is_file($Path))
		{
			require_once($Path);
			$ClassName = preg_replace('/\//','',$_CallPath).'_model';
			$Class_Temp = new $ClassName;
			return $Class_Temp;
		}
		else
			trigger_error("Can't find Model : ".$_CallPath, E_USER_NOTICE);
	}
	
	function View($_CallPath_AAAAAAAAAAAAAAAAAAAA = null, $Data_AAAAAAAAAAAAAAAAAAAA = array() /*To prevent duplication*/)
	{
		
		if(is_file(__FrontendPath__.'App/View/'.$_CallPath_AAAAAAAAAAAAAAAAAAAA))
		{
			ob_start();
			if(is_array($Data_AAAAAAAAAAAAAAAAAAAA))
				foreach($Data_AAAAAAAAAAAAAAAAAAAA AS $Key_AAAAAAAAAAAAAAAAAAAA => $Data_AAAAAAAAAAAAAAAAAAAA_F)
				{
					$$Key_AAAAAAAAAAAAAAAAAAAA = $Data_AAAAAAAAAAAAAAAAAAAA_F;
				}
			
			require(__FrontendPath__.'App/View/'.$_CallPath_AAAAAAAAAAAAAAAAAAAA);
			
			$output = ob_get_contents();
			ob_end_clean();
			
			if(!__Debug__)
			{
				
				$output = preg_replace("!\s+!"," ",$output);
			}
				
			return $output;
		}
		else
			echo trigger_error("Can't find View file. : ".$_CallPath_AAAAAAAAAAAAAAAAAAAA);
	}
	
	function View2($_CallPath_AAAAAAAAAAAAAAAAAAAA = null, $Data_AAAAAAAAAAAAAAAAAAAA = array() /*To prevent duplication*/)
	{
		//require_once(__DocumentPath__."Core/Module/simple_html_dom.php");
		
		if(is_file(__FrontendPath__.'App/View/'.$_CallPath_AAAAAAAAAAAAAAAAAAAA))
		{
			ob_start();
			foreach($Data_AAAAAAAAAAAAAAAAAAAA AS $Key_AAAAAAAAAAAAAAAAAAAA => $Data_AAAAAAAAAAAAAAAAAAAA_F)
			{
				$$Key_AAAAAAAAAAAAAAAAAAAA = $Data_AAAAAAAAAAAAAAAAAAAA_F;
			}
			
			require(__FrontendPath__.'App/View/'.$_CallPath_AAAAAAAAAAAAAAAAAAAA);
			$output = ob_get_contents();
			ob_end_clean();
			/*
			
			
			$Dom = str_get_html($output);
			foreach($Dom->find('script') as $Script_F)
			{
				echo $Script_F;
			}
			*/
			
			//
			preg_match_all('/<script(?![^>])*>(.*?)<\/script>/is',$output,$output_arr);
			$output = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is','',$output);
			echo print_r($output_arr);
			
			
			if(!__Debug__)
			{
				//$output = preg_replace("/\n/","",$output);
				$output = preg_replace("/\t/","",$output);
			}
				
			//return $output;
		}
		else
			echo trigger_error("Can't find View file. : ".$_CallPath_AAAAAAAAAAAAAAAAAAAA);
	}
	
	function Language($_CallPath = null)
	{
		$Path = __FrontendPath__.'App/Language/'.__lang_Name__.'/'.$_CallPath.'.php';
		
		if(is_file($Path))
		{
			$_ = array();
			require($Path);
			
			return $_;
		}
		else
			trigger_error("Can't find the Language : ".$_CallPath, E_USER_NOTICE);
		
	}
}


?>