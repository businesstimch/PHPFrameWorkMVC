<!DOCTYPE html>
<html>
<head>
	
	<!--meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />-->
	<title><?php echo $title;?></title>
	<meta name="Keywords" content="<?php echo $metaK;?>" />
	<meta name="Description" content="<?php echo $metaD;?>" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<script type="text/javascript" src="<?php echo __DocumentRoot__.'Core/JS/jquery.min.js?'.__JS_Ver__;?>"></script>
	<script type="text/javascript" src="<?php echo __DocumentRoot__.'Core/JS/jquery.migration.js?'.__JS_Ver__;?>"></script>
	<script type="text/javascript" src="<?php echo __DocumentRoot__.'Core/JS/jquery-ui.min.js?'.__JS_Ver__;?>"></script>
	<script type="text/javascript" src="<?php echo __DocumentRoot__.'Core/JS/ui-localization/datepicker-ko.js?'.__JS_Ver__;?>"></script>
	<script type="text/javascript" src="<?php echo __DocumentRoot__.'Core/JS/jquery.touchpunch.min.js?'.__JS_Ver__;?>"></script>
	<script type="text/javascript" src="<?php echo __DocumentRoot__.'Core/JS/jquery.scrollTo-min.js?'.__JS_Ver__;?>"></script>
	<script type="text/javascript" src="<?php echo __DocumentRoot__.'Core/JS/jquery.popupoverlay.js?'.__JS_Ver__;?>"></script>
	<script type="text/javascript" src="<?php echo __DocumentRoot__.'Core/JS/mediaelement/mediaelement-and-player.min.js?'.__JS_Ver__;?>"></script>
	<script type="text/javascript" src="<?php echo __DocumentRoot__.'Core/JS/jquery.ggorok.js?'.__JS_Ver__;?>"></script>
	<script type="text/javascript" src="<?php echo __DocumentRoot__.'Core/JS/jquery.hoverIntent.minified.js?'.__JS_Ver__;?>"></script>
	<script type="text/javascript" src="<?php echo __DocumentRoot__.'Core/JS/box/jquery.fancybox.pack.js?'.__JS_Ver__;?>"></script>
	<script type="text/javascript" src="/Core/JS/General.js?<?php echo __JS_Ver__;?>"></script>
	<script type="text/javascript" src="/Template/JS/_Front.js?<?php echo __JS_Ver__;?>"></script>
	
	
	<link href="/Core/CSS/global.css" rel="stylesheet" type="text/css" />
	<link href="/Core/CSS/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="/Template/CSS/Front.css" rel="stylesheet" type="text/css" />
	<link href="/Template/CSS/Admin.css" rel="stylesheet" type="text/css" />
	<link href="/Core/JS/ui-themes/hotsneaks/jquery-ui.min.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">
		$(document).ready(function(){
			$(document).on(touchOrClick,".Nav_Multi",function(){
				$(this).find(".Nav_Sub_Block").slideToggle(300);
			});
		});
	</script>
</head>
<body>
	<div id="msgBox"></div>
	
	<header id="Top">
		<div id="ToggleMenu"><i class="fa fa-dedent"></i></div>
		<div id="Billboard"></div>
		<a href="/<?php echo __AdminPath__;?>/" id="CartLogo"></a>
		<div id="Top_Menu_R" class="floatR">
			<div id="Notifications"></div>
			<div id="TopMenu"></div>
			<a href="<?php echo __AdminPath__;?>?ajaxProcess&menu=logout" id="Logout" class="block TopButtons"><i class="fa fa-sign-out"></i> Logout</a>
		</div>
	</header>
	<div id="Navigation">
		<?php
			foreach($AdminMenu AS $_F)
			{
				
				if($_F['AM_Parent_ID'] == 0)
				{
					echo '<div class="Nav_One">';
					echo ($_F['is_DoorMenu'] == 1 ?
								'<div class="Nav_One Nav_Multi">' :
								'<a class="Nav_One" href="'.__AdminPath__.$_F['AM_URL'].'">');
					
					echo			'<div class="Nav_Name">'.$_F['AM_Icon'].'<div>'.$_F['AM_Name'].'</div></div>';
					
					$SubMenu_HTML = '';
					
					foreach($AdminMenu AS $_F2)
					{
						if($_F['AM_ID'] == $_F2['AM_Parent_ID'])
						{
							
							$SubMenu_HTML .=
											'<a href="'.__AdminPath__.$_F2['AM_URL'].'" class="Nav_Sub"><span>'.$_F2['AM_Icon'].$_F2['AM_Name'].'</span></a>';
							
						}
						
					}
					
					if($SubMenu_HTML != "")
						echo 			'<div class="Nav_Sub_Block'.($_F['isCurrent'] ? ' block':'').'">'.$SubMenu_HTML.'</div>';
						
					echo ($_F['is_DoorMenu'] == 1 ?
								'</div>' :
								'</a>');
					
					echo '</div>';
					
				}
				
			}
		?>
		
		<!--
		<div class="Nav_One">
			<a class="Nav_Name" href="<?php echo __AdminPath__;?>"><i class="fa fa-area-chart"></i><div>Dashboard</div></a>
		</div>
		<div class="Nav_One Nav_Multi">
			<div class="Nav_Name"><i class="fa fa-list-ul"></i><div>Catalog</div></div>
			<div class="Nav_Sub_Block<?php echo $OpenSubCategory_1;?>">
				<a href="<?php echo __AdminPath__;?>catalog/category/" class="Nav_Sub"><span><i class="fa fa-folder-o"></i>Category</span></a>
				<a href="<?php echo __AdminPath__;?>catalog/products/" class="Nav_Sub"><span><i class="fa fa-th-large"></i>Products</span></a>
				<a href="<?php echo __AdminPath__;?>catalog/product-options/" class="Nav_Sub"><span><i class="fa fa-archive"></i>Product Options</span></a>
				<a href="<?php echo __AdminPath__;?>catalog/manufacturers/" class="Nav_Sub"><span><i class="fa fa-cubes"></i>Manufacturers</span></a>
				<a href="<?php echo __AdminPath__;?>catalog/cache/" class="Nav_Sub"><span><i class="fa fa-flask"></i>Cache Control</span></a>
			</div>
		</div>
		<div class="Nav_One Nav_Multi">
			<div class="Nav_Name"><i class="fa fa-cart-arrow-down"></i><div>Sales</div></div>
			<div class="Nav_Sub_Block<?php echo $OpenSubCategory_2;?>">
				<a href="<?php echo __AdminPath__;?>sales/orders/" class="Nav_Sub"><span><i class="fa fa-folder-o"></i>Orders</span></a>
			</div>
		</div>
		
		<div class="Nav_One Nav_Multi">
			<div class="Nav_Name"><i class="fa fa-hand-o-up"></i><div>Customers</div></div>
			<div class="Nav_Sub_Block<?php echo $OpenSubCategory_3;?>">
				<a href="<?php echo __AdminPath__;?>manage-customers/" class="Nav_Sub"><span><i class="fa fa-user"></i>Manage Customers</span></a>
			</div>
		</div>
		<div class="Nav_One Nav_Multi">
			<div class="Nav_Name"><i class="fa fa-puzzle-piece"></i><div>Extensions</div></div>
			<div class="Nav_Sub_Block<?php echo $OpenSubCategory_4;?>">
				<a href="<?php echo __AdminPath__;?>extensions/?GroupName=Payment" class="Nav_Sub "><span><i class="fa fa-folder-o"></i>Payment</span></a>
				<a href="<?php echo __AdminPath__;?>extensions/?GroupName=Shipping" class="Nav_Sub "><span><i class="fa fa-folder-o"></i>Shipping</span></a>
			</div>
		</div>
		<div class="Nav_One Nav_Multi">
			<div class="Nav_Name"><i class="fa fa-bar-chart"></i><div>Reports</div></div>
			<div class="Nav_Sub_Block<?php echo $OpenSubCategory_5?>">
				<a href="<?php echo __AdminPath__;?>reports/sales/" class="Nav_Sub"><span><i class="fa fa-folder-o"></i>Sales</span></a>
				<a href="" class="Nav_Sub"><span><i class="fa fa-folder-o"></i>Customers</span></a>
				<a href="" class="Nav_Sub"><span><i class="fa fa-folder-o"></i>Keywords</span></a>
			</div>
		</div>
		
		<div class="Nav_One Nav_Multi">
			<div class="Nav_Name"><i class="fa fa-gear fa-spin"></i><div>Configurations</div></div>
			<div class="Nav_Sub_Block<?php echo $OpenSubCategory_6;?>">
				<a href="<?php echo __AdminPath__;?>configurations/admin-users/" class="Nav_Sub"><span><i class="fa fa-folder-o"></i>Admin Users</span></a>
				<a href="" class="Nav_Sub"><span><i class="fa fa-folder-o"></i>User Level</span></a>
				<a href="" class="Nav_Sub"><span><i class="fa fa-folder-o"></i>Stores</span></a>
			</div>
		</div>
		-->
	</div>
	<div id="Main"><?php echo $MAIN_HTML;?></div>