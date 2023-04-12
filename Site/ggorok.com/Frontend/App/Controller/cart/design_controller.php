<?
class CartDesign_Controller extends GGoRok
{
	function home()
	{
		if(isset($_GET['F']))
		{
			if($_GET['F'] == 1)
			{
				$FileName = '500PSI.jpg';
			}
			else if($_GET['F'] == 2)
			{
				$FileName = '250PSI.jpg';
			}
			else if($_GET['F'] == 3)
			{
				$FileName = '170PSI.jpg';
			}
			else if($_GET['F'] == 4)
			{
				$FileName = '170PSI-NoHeater.jpg';
			}
			echo '
			<!DOCTYPE html>
				<html>
				<head>
					
					<meta http-equiv="cache-control" content="max-age=0" />
					<meta http-equiv="cache-control" content="no-cache" />
					<meta http-equiv="expires" content="0" />
					<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
					<meta http-equiv="pragma" content="no-cache" />
					
	
				</head>
				<body style="background-color:#2c2c2c;">
					<div style="width:100%;text-align:center;">
						<img src="/Template/Img/delete/'.$FileName.'?'.rand(0,999999).'" style="width:760px" />
					</div>
				</html>
			';
		}
		
		
	}
}