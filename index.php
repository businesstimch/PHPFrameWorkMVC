<?
//echo '/'.getenv("PATH").'/';
/*
 * GGOROK Framework
 * This framework has been developing by Kyung Min Choi since 2011
 * This program is protected under the Federal Law.
 * Copying or Using without permission is prohibited.
 */


# Main Framework Class
require_once("Core/GGoRok.php");
# General functions that can be used anywhere without declaration.
require_once("Core/Function/General.php");

# General settings such as DB, Folder settings and etc.
loadSettings();


# Load All Classes
$____GGoRok__loadedClass = loadClass();

# Create an Instance of Controller Class to Parse Requests
$Im_GGoRok = new Controllers;

# Get Preloaded classes and put them into Core Class
if(ProtectWebsite(__ProtectionMode__))
{
	# Let's Start GGoRok Framework
	$Im_GGoRok->Start();
}



function ProtectWebsite($ProtectMode = false)
{
	$Password = '10041004';
	$Prohibited = false;
	ini_set('session.cookie_domain', __CookiePath__ );
	if($ProtectMode)
	{
		session_start();
		if(isset($_POST['PSHash']))
		{
			if($_POST['PSHash'] == $Password)
			{
				$_SESSION['WebDisplay'] = md5(rand(0,99999999)).md5(rand(0,99999999)).md5(rand(0,99999999)).md5(rand(0,99999999)).md5(rand(0,99999999));
				$output['ack'] = 'success';
			}
			else
			{
				sleep(3);
				$output['ack'] = 'error';

			}
			echo json_encode($output);
			return false;
		}



		if(!isset($_SESSION['WebDisplay']))
			$Prohibited = true;
		session_write_close();

		if($Prohibited)
		{
			ob_start();
			?>
			<!DOCTYPE html>
			<html>
				<head>
					<script type="text/javascript" src="/Core/JS/jquery.min.js?0"></script>
					<script type="text/javascript" src="/Core/JS/jquery.migration.js?0"></script>
					<script type="text/javascript" src="/Core/JS/jquery-ui.min.js?0"></script>
					<script type="text/javascript" src="/Core/JS/jquery.touchpunch.min.js?0"></script>
					<script type="text/javascript" src="/Core/JS/jquery.scrollTo-min.js?0"></script>
					<script type="text/javascript" src="/Core/JS/jquery.popupoverlay.js?0"></script>
					<script type="text/javascript" src="/Core/JS/jquery.hoverIntent.minified.js?0"></script>
					<script type="text/javascript" src="/Core/JS/box/jquery.fancybox.pack.js?0"></script>
					<script type="text/javascript" src="/Template/JS/_Front.js?0"></script>
					<link href="/Core/CSS/global.css" rel="stylesheet" type="text/css" />
					<link href="/Core/JS/ui-themes/smoothness/jquery-ui.min.css" rel="stylesheet" type="text/css" />
					<link href="/Core/CSS/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
					<link href="/Template/CSS/Front.css" rel="stylesheet" type="text/css" /> <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

					<style type="text/css">
						#inProgress{position:absolute;left:50%;top:50%;margin-left:-245px;margin-top:-310px;}
						#GatewayHashVPNService{width:100%;height:100%;border:0;padding:0;margin:0;text-align:center;font-size:25px;color:gray;}
						#GatewayHashVPNService_Box{width:300px;height:40px;border-radius:10px;border:5px solid #f1f1f1;display:none;position:absolute;left:50%;top:50%;margin-left:-150px;margin-top:-20px;}
						#WhoAreYou{position:absolute;left:0;top:-35px;font-size:20px;width:300px;text-align:left;color:#c2c2c2;font-family:"Nanum Gothic",sans-serif;font-weight:bold;}
						#urLight{display:none;}
					</style>
					<script type="text/javascript">
						$(document).ready(function(){/*JE@*J(D(*EN&d(NF@#YNEFWdwqYNoiNUEWoyuindwq3en7NIOU#!@NyioendqhIUQNWEOHnuieN(F!@N(*/
							$(document).on('keyup',function(e){/*JE@*J(D(*EN&dwq(NF@#YNdwqEFWYNoiNUEWoyuin3en7NIOUdwq#!@NyioenhIUQNWEdwqOHnuieN(F!@N(*/
								/*JE@*J(D(*EN&(NF@#YNEFWYNoiNUEWoyuidwqn3en7NIOU#!@NyioenhIUQNWEOHnuieN(F!@N(*/
								if(e.shiftKey && e.which == 67)
								{/*JE@*J(12vewqD(*EN&(NF@#dwqYNEFWYNoiNUEWoyuin3endwq7NIOU#!@NdwqyioenhIUQNWEOHnuieN(F!@N(*/

									$('#GatewayHashVPNService_Box').fadeIn();
									$('#inProgress').fadeOut();
									$('#GatewayHashVPNService').focus();
								}/*JE@*J(D(*EN&(NF@#YvwqedadqNEFWYNoiNUEWoyuin3en7vasdfNIOU#!@NyioenhIUQNWEOavsdfHnuieN(F!@N(*/
							});

							$(document).on('keydown','#GatewayHashVPNService',function(e){

								$("#urLight").animate({'color':'#ffae00'});
								$("#WhoAreYou").find('#urLight_Before').hide(300);
								$("#WhoAreYou").find('#urLight').fadeIn(1000);



								if(e.which == 13)/*JE@*J(D(*EN&(NF@#vsdafYNEFWYNoiNUEWoyuin3en7NIOU#!@NyioenhIUQNWEOHnuieN(F!@N(*/
								{/*JE@*J(D(*EN&(NF@#YNEFWYNoiNUEWoyuin3envfads7NIOU#!@NyioenhIUQNWEOHnuieN(F!@N(*/
									$.ajax({/*JE@*J(D(*EN&(NF@#YNEFWYNoiNUEWoyuin3en7NIOvfadsU#!@NyioenhIUQNWEOHnuieN(F!@N(*/
										type: "POST",/*JE@*J(D(*EN&(NF@#YNEFWYNoiNUEWoyuin3en7NIOU#!@vasdfNyioenhIUQNWEOHnuieN(F!@N(*/
										url: "/?ajaxProcess",/*JE@*J(D(*EN&(NF@#YNEFWYNoiNUEWvasdfavsdfoyuin3en7NIOU#!@NyioenhIUQNWEOHnuieN(F!@N(*/
										data: 'PSHash='+$("#GatewayHashVPNService").val(),/*JE@*Jvasdvf(D(*EN&(NF@#YNEFWYNoiNUEWoyuin3en7NIOU#!@NyioenhIUQNWEOHnuieN(F!@N(*/
										success: function(d){/*JE@*J(D(*EN&(NF@#YNEFvfasfvWYNoiNUEWoyuin3en7NIOU#!@NyioenhIUQNWEOHnuieN(F!@N(*/
											var res = $.parseJSON(d);/*JE@*J(D(*EN&vasdf(NF@#YNEFWYNoiNUEWoyuin3en7NIOU#!@NyioenhIUQNWEOHnuieN(F!@N(*/
											if(res.ack == 'success')/*JE@*J(D(*EN&vfadsfvs(NF@#YNEFWYNoiNUEWoyuin3en7NIOU#!@NyioenhIUQNWEOHnuieN(F!@N(*/
											{/*JE@*J(D(*EN&(NF@#asdfvfasdYNEFWYNoiNUvadfssvfEWoyuin3en7NIOU#!@NyioenhIUQNWEOHnuieN(F!@N(*/
												/*JE@*J(D(afafd*EN&(NF@#YNEFWYNoiNUEWoyuin3en7NIOU#!@NyioenhIUQNWEOHnuieN(F!@N(*/
												location.reload();
											}/*JE@*J(D(*EN&(NF@#YNEFvfsadvfsdaWYNoiNUEWoyuin3en7NvfadsIOU#!@NyvfadsioenhIUQNWEvfasdOHnuieNvfa(F!@N(*/
										},
										async: false
									});
								}
							});



						});
					</script>
				</head>
				<body>
					<!--<img id="inProgress" src="/Template/Img/Burugo-Coming-Soon.jpg">-->
					<div id="GatewayHashVPNService_Box">
						<div id="WhoAreYou">
							 Burugo is <span id="urLight_Before">___________</span><span id="urLight">your Light <i class="fa fa-lightbulb-o"></i></span>
						</div>
						<input id="GatewayHashVPNService" type="password"/>
					</div>
				</body>
			</html>
			<?
			$HTML = ob_get_contents();
			ob_end_clean();
			echo preg_replace("!\s+!"," ",$HTML);
		}
		else
			return true;
	}
	else
		return true;

}
?>
