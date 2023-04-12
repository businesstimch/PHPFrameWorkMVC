<?

define('__ProtectionMode__',false);
define('DB_Table_Prefix','idj_');
define('MYSQL_DB_SERVER','127.0.0.1');
define('MYSQL_DB_SERVER_USERNAME','DB ID');
define('MYSQL_DB_SERVER_PASSWORD','DB Password');
define('MYSQL_DB_NAME','idjbox.com');
define('__AdminPath__','corp');
define('__Cookie_LoginName__','Rhr@oR#wjdQh#');
define('__Cookie_Key__','IdjBox#$$!1');
define('__JS_Ver__',0);
define('__HTTPwww__',__SSL__.'www.'.__domain__);
define('__HTTPceo__',__SSL__.'ceo.'.__domain__);
define('__HTTPhelper__',__SSL__.'helper.'.__domain__);
define('__HTTPfriend__',__SSL__.'friend.'.__domain__);
define('__HTTPnews__',__SSL__.'news.'.__domain__);
define('__HTTPSceo__',__HTTPS__.'ceo.'.__domain__);
define('_MusicVault_','__Music_Vault__');

define('__HOME__', (__USE_SSL__ ? 'https':'http' ).'://www.'.__domain__.($_SERVER['SERVER_PORT'] != 80 ? ':'.$_SERVER['SERVER_PORT'] : ''));

define('__DebugIP__','14.138.42.34');
//define('__Debug__',($_SERVER['REMOTE_ADDR'] == __DebugIP__? TRUE : FALSE));
define('__Debug__',TRUE);



if(isset($_GET['ajaxProcess']) && !isset($_POST['menu']))
{
	if(isset($_GET['langSetting']) && isset($_POST['langID']) && is_numeric($_POST['langID']))
	{
		setcookie('langID',$_POST['langID'],null,__DocumentRoot__,'.'.__domain__);
		echo json_encode(array('ack'=>'success'));
		exit();
	}
	else if(!isset($_COOKIE['langID']))
	{
		setcookie('langID',1,null,__DocumentRoot__,'.'.__domain__);
		exit();
	}
}

# Language Settings : Default is English which is '1'
if(isset($_COOKIE['langID']))
{
	if($_COOKIE['langID'] == 1)
		$lang = 'Korean';

	else if($_COOKIE['langID'] == 2)
		$lang = 'English';

	else if($_COOKIE['langID'] == 3)
		$lang = 'Japanese';

	else if($_COOKIE['langID'] == 4)
		$lang = 'Chinese';
	else
		$lang = 'Korean';

	define('__langID__',$_COOKIE['langID']);
}
else
{
	if(preg_match('/co\.jp/',$_SERVER['HTTP_HOST']))
	{
		$lang = 'Japanese';
		define('__langID__',3);
		setcookie('langID',3,null,__DocumentRoot__,'.'.__domain__);
	}
	else
	{
		$lang = 'Korean';
		define('__langID__',1);
		setcookie('langID',1,null,__DocumentRoot__,'.'.__domain__);
	}
}
define('__lang_Name__',$lang);

if(isset($_COOKIE['lat']) && isset($_COOKIE['lng']))
{
	define('__lng__',$_COOKIE['lng']);
	define('__lat__',$_COOKIE['lat']);
}

if(isset($_COOKIE['loc_city']) && isset($_COOKIE['loc_state']))
{
	define('__loc_city__',$_COOKIE['loc_city']);
	define('__loc_state__',$_COOKIE['loc_state']);
}


?>
