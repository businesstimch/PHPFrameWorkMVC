<?
class GGoRok_View extends GGoRok
{
	public $title,$metaK,$metaD,$script,$css;
	
	function __construct()
	{
		
	}
	function Default_Script()
	{
		?>
		/*<script>*/
		
		var catURL = '';
	
		if(__AjaxURL__ == undefined)
		{
			var __AjaxURL__ = window.location.pathname;
		}
		/*</script>*/
		<?
	}
	
	
	function Layout_HTML($Controller)
	{
		global $_Global;
		
		if(method_exists($_Global,'Scripts'))
		{
			if(is_array($this->script))
				$this->script = array_merge($this->script,$_Global->Scripts());
			else
				$this->script = $_Global->Scripts();
		}
		
		array_unshift(
			$this->script,
			__DocumentRoot__.'Core/JS/jquery.min.js?'.__JS_Ver__,
			__DocumentRoot__.'Core/JS/jquery.migration.js?'.__JS_Ver__,
			__DocumentRoot__.'Core/JS/jquery-ui.min.js?'.__JS_Ver__,
			__DocumentRoot__.'Core/JS/jquery.touchpunch.min.js?'.__JS_Ver__,
			__DocumentRoot__.'jsDynamic/general.js?'.__JS_Ver__,
			__DocumentRoot__.'Core/JS/jquery.scrollTo-min.js?'.__JS_Ver__,
			__DocumentRoot__.'Core/JS/jquery.popupoverlay.js?'.__JS_Ver__,
			__DocumentRoot__.'Core/JS/jquery.popupoverlay.js?'.__JS_Ver__,
			__DocumentRoot__.'Core/JS/box/jquery.fancybox.pack.js?'.__JS_Ver__
		);
		
		array_unshift(
			$this->css,
			__DocumentRoot__.'Core/CSS/global.css',
			__DocumentRoot__.'Core/JS/ui-themes/smoothness/jquery-ui.min.css',
			__DocumentRoot__.'Core/CSS/font-awesome/css/font-awesome.min.css'
		
		);
		
		$Indentation = "\n\t\t\t";
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<!--<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />-->
			<?
				if(!empty($this->title)){ echo '<title>'.$this->title.'</title>';}
				if(!empty($this->metaK)){ echo '<meta name="Keywords" content="'.$this->metaK.'" />';}
				if(!empty($this->metaK)){ echo '<meta name="Description" content="'.$this->metaD.'" />';}
			
			if(method_exists($this,'css'))
				echo '<link href="'.__DocumentRoot__.'cssPage/'.$this->FilePath.'.css" rel="stylesheet" type="text/css" />';
		
			if(isset($this->script) && sizeof($this->script) > 0)
			{
				foreach($this->script AS $ScriptsFiles)
					echo (__Debug__? $Indentation : '').'<script type="text/javascript" src="'.$ScriptsFiles.'"></script>';
			}
			
			if(isset($this->css) && sizeof($this->css) > 0)
			{
				foreach($this->css AS $CSSFiles)
					echo (__Debug__? $Indentation : '').'<link href="'.$CSSFiles.'" rel="stylesheet" type="text/css" />';
			}
			
			if(class_exists('template') && !isset($_GET['ajaxProcess']))
			{
				echo $this->header();
			}
			if(method_exists($this,'script'))
				echo (__Debug__? $Indentation : '').'<script type="text/javascript" src="'.__DocumentRoot__.'jsPage/'.$this->FilePath.'.js?'.__JS_Ver__.'"></script>';
			?>
			<?if(method_exists($this,'header'))
				$this->header();
			?>
		</head>
		<body>
			<div id="msgBox"></div>
			<?
			if(method_exists($Controller,'html'))
				$Controller->html();
			else
				$this->html();
			
			?>
			
			
			<div class="tempDIV"></div>
			<?//__tag_footerCustomerSection__()?>
		</body>
		</html>
		<?
	}
	
	
}
?>