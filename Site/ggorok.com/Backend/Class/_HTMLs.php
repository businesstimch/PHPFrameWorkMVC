<?
loadClass('_Cache');
class _HTMLs extends GGoRok
{
	function __Front_Header_Template($Cat = null)
	{
		
		if(is_null($Cat))
			$Cat = $this->db->QRY("
				SELECT
					Cat_ID,
					Cat_Name,
					Cat_SEO_URL,
					Cat_Parent_ID
				FROM
					gc_category
				WHERE
					Store_ID = '".__StoreID__."'
				ORDER BY
					Cat_Sort ASC
			");
		$login_token = $this->token->login_token(true);
		?>
		<header>
			<div id="Top_Head">
				<div id="Top_Notice">
					If you experience any technical difficulty, please call <b>770-216-9977</b> for immediate service.
				</div>
				<div id="Top_MainBlock">
					<div id="TM_GreenBG">
						<img id="Front_Logo" src="/Template/Img/Janitorial-Supply-Logo-Janilink.png" />
						<div id="Flag_Language">
							<div id="FL_Eng" data-tooltip="English : Anthony"></div>
							<div id="FL_Spa" data-tooltip="Español : Llamar Camilo"></div>
							<div id="FL_Kor" data-tooltip="한국말 서비스 : 다니엘 ( 404-642-7640 )"></div>
						</div>
						
						<div id="TM_Links">
							<a href="">Recommended Cleaning Businesses</a><br />
							<a href="">Franchise Opportunities</a>
						</div>
					</div>
					<div id="TM_Menus">
						<a href="">HOME</a>
						<a href="">HELP & INFO</a>
						<a href="">WEEKLY SPECIAL</a>
						<a href="">MY ACCOUNT</a>
						<a href="">CONTACT US</a>
						<a href="">LOGIN</a>
						<a href="">MY CART</a>
						<a href="">CHECKOUT</a>
					</div>
				</div>
				<a class="block" id="Res_Logo" href="<?echo __HTTPS__;?>"><img src="/Template/Img/logo.png" /></a>
				<div id="Top_Head_Menu_1" class="Top_Head_Menu noSelect">
					
					<div class="Top_Head_Menu_C">
					<?
						if($this->login->isLogIn())
						{
							echo '
								<div id="LoggedIn_Block" class="Login_Block">
									<a id="SignOut_BTN" href="?menu=logout" class="Glow block SignInOut_BTN"><i class="fa fa-sign-out "></i> Sign out</a>
								</div>
							';
						}
						else
						{
							echo '
								<div id="LoginRequest_Block" class="Login_Block">
									<form action="#" method="post">
										<input id="loginID" type="text" placeholder="Email" />
										<input id="loginPS" type="password" placeholder="Password" />
										<input type="hidden" name="loginTK" id="loginTK" value="'.$login_token['loginTK'].'" />
										<input type="hidden" name="loginST" id="loginST" value="'.$login_token['loginST'].'" />
										<p><span id="forgotPS_Btn">Forgot Password?</span><span id="Register_Btn">Register</span></p>
										<button id="SignIn_BTN" type="submit" class="Glow SignInOut_BTN"><i class="fa fa-sign-in"></i> Sign in</button>
									</form>
								</div>
								<div id="Register_Block" class="Login_Block">
									<input id="Reg_FirstName_Inp" class="Register_Inp" type="text" placeholder="First Name" />
									<input id="Reg_LastName_Inp" class="Register_Inp" type="text" placeholder="Last Name" />
									<input id="Reg_Email_Inp" class="Register_Inp" type="text" placeholder="Email Address" />
									<p class="center">(Minium Password Length is 6)</p>
									<input id="Reg_Pass_Inp" class="Register_Inp" type="password" placeholder="Password" />
									<input id="Reg_PassConfirm_Inp" class="Register_Inp" type="password" placeholder="Confirm Password" />
									<button id="SendRegister_BTN" class="Glow SignInOut_BTN"><i class="fa fa-star"></i> Register</button>
									<button id="CancelRegister_BTN" class="Glow SignInOut_BTN"><i class="fa fa-ban"></i> Cancel</button>
								</div>
							';
						}
						?>
					</div>
					
				</div>
				
			</div>
			<div id="Top_SearchBlock">
				
				<div class="TS_Col2">
					<div id="Search_Category" class="noSelect Glow">
						<div id="Search_Category_Selected"  data-selectedid="0">
							<div id="SCS_T"><span>All Categories</span></div>
							<div id="SCS_I"><i class="fa fa-angle-down"></i></div>
						</div>
						<div id="Search_Category_List">
							<div id="SCL_Border"></div>
							<div class="SCL_One" data-catid="0">All Categories</div>
						<?
							
							foreach($Cat AS $Cat_F)
							{
								if($Cat_F['Cat_Parent_ID'] == 0)
									echo '<div class="SCL_One" data-catid="'.$Cat_F['Cat_ID'].'">'.$Cat_F['Cat_Name'].'</div>';
							}
						?>
						</div>
						
					</div>
				</div>
				<div class="TS_Col3">
					<div id="Search_Field_Block">
						<input id="Search_Field_Inp" type="text" placeholder="Type Keywords Here..." />
					</div>
					
				</div>
				<div class="TS_Col4">
					<div id="Search_Btn">
						Search
					</div>
				</div>
				<div class="TS_Col5">
					<div id="Cart_Block">
						<div id="Cart_ItemQty">
							<span id="Cart_ItemQty_Num">(<? echo $this->_Cart->getInfo()['Cart_Qty'];?> ITEM : $)</span>
						</div>
					</div>
				</div>
				
			</div>
			
		</header>
		<?
	}
	function __Admin_Template()
	{
		
		# Parsing URLs
		$URL = explode('?',$_SERVER['REQUEST_URI']);
		if(sizeof($URL) > 0)
		{
			$URL[0] = preg_replace("/^\//", "" , $URL[0]);
			$URL[0] = preg_replace("/\/$/", "" , $URL[0]);
			$URL_Arr = explode('/',$URL[0]);
		}
		
		
		if(sizeof(array_filter($URL_Arr)) > 0)
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
				$URL_File_Path = $URL_File_Path."/home";
			}
		}
		else
		{
			$URL_File_Path = "home";
		}
		
		$CurrentCategory = preg_replace("/^\//","",__AjaxURL__);
		$CurrentCategory = preg_replace("/\/$/","",$CurrentCategory);
		
		$CurrentCategory = explode("/",$CurrentCategory);
		$CSS = 'style="display:block;"';
		if(sizeof($CurrentCategory) > 1)
		{
			$CurrentCategory = $CurrentCategory[1];
		}
		else
			$CurrentCategory = "";
			
		return '
			<header id="Top">
				<div id="ToggleMenu"><i class="fa fa-dedent"></i></div>
				<a href="/'.__AdminPath__.'/" id="CartLogo"></a>
				<div id="Top_Menu_R" class="floatR">
					<div id="Notifications"></div>
					<div id="TopMenu"></div>
					<a href="/corp/?ajaxProcess&menu=logout" id="Logout" class="block TopButtons"><i class="fa fa-sign-out"></i> Logout</a>
				</div>
			</header>
			<div id="Navigation">
				<div class="Nav_One">
					<a href="/'.__AdminPath__.'/" class="Nav_Name"><i class="fa fa-area-chart"></i><div>Dashboard</div></a>
				</div>
				<div class="Nav_One Nav_Multi">
					<div href="" class="Nav_Name"><i class="fa fa-list-ul"></i><div>Catalog</div></div>
					<div class="Nav_Sub_Block" '.($CurrentCategory == "catalog" ? $CSS : "").'>
						<a href="/'.__AdminPath__.'/catalog/category/" class="Nav_Sub"><span><i class="fa fa-folder-o"></i>Category</span></a>
						<a href="/'.__AdminPath__.'/catalog/products/" class="Nav_Sub"><span><i class="fa fa-th-large"></i>Products</span></a>
						<a href="/'.__AdminPath__.'/catalog/product-options/" class="Nav_Sub"><span><i class="fa fa-archive"></i>Product Options</span></a>
						<a href="/'.__AdminPath__.'/catalog/manufacturers/" class="Nav_Sub"><span><i class="fa fa-cubes"></i>Manufacturers</span></a>
						<a href="/'.__AdminPath__.'/catalog/cache/" class="Nav_Sub"><span><i class="fa fa-flask"></i>Cache Control</span></a>
					</div>
				</div>
				<div class="Nav_One Nav_Multi">
					<div class="Nav_Name"><i class="fa fa-cart-arrow-down"></i><div>Sales</div></div>
					<div class="Nav_Sub_Block" '.($CurrentCategory == "sales" ? $CSS : "").'>
						<a href="/'.__AdminPath__.'/sales/orders/" class="Nav_Sub"><span><i class="fa fa-folder-o"></i>Orders</span></a>
					</div>
				</div>
				
				<div class="Nav_One Nav_Multi">
					<div class="Nav_Name"><i class="fa fa-hand-o-up"></i><div>Customers</div></div>
					<div class="Nav_Sub_Block" '.($CurrentCategory == "customers" ? $CSS : "").'>
						<a href="/'.__AdminPath__.'/manage-customers/" class="Nav_Sub"><span><i class="fa fa-user"></i>Manage Customers</span></a>
					</div>
				</div>
				<div class="Nav_One Nav_Multi">
					<div class="Nav_Name"><i class="fa fa-puzzle-piece"></i><div>Extensions</div></div>
					<div class="Nav_Sub_Block" '.($CurrentCategory == "extensions" ? $CSS : "").'>
						<a href="/'.__AdminPath__.'/extensions/#GroupName=Payment" class="Nav_Sub "><span><i class="fa fa-folder-o"></i>Payment</span></a>
						<a href="/'.__AdminPath__.'/extensions/#GroupName=Shipping" class="Nav_Sub "><span><i class="fa fa-folder-o"></i>Shipping</span></a>
					</div>
				</div>
				<div class="Nav_One Nav_Multi">
					<div class="Nav_Name"><i class="fa fa-bar-chart"></i><div>Reports</div></div>
					<div class="Nav_Sub_Block" '.($CurrentCategory == "reports" ? $CSS : "").'>
						<a href="" class="Nav_Sub"><span><i class="fa fa-folder-o"></i>Sales</span></a>
						<a href="" class="Nav_Sub"><span><i class="fa fa-folder-o"></i>Customers</span></a>
						<a href="" class="Nav_Sub"><span><i class="fa fa-folder-o"></i>Keywords</span></a>
					</div>
				</div>
				
				<div class="Nav_One Nav_Multi">
					<div class="Nav_Name"><i class="fa fa-gear fa-spin"></i><div>Configurations</div></div>
					<div class="Nav_Sub_Block" '.($CurrentCategory == "configurations" ? $CSS : "").'>
						<a href="/'.__AdminPath__.'/configurations/admin-users/" class="Nav_Sub"><span><i class="fa fa-folder-o"></i>Admin Users</span></a>
						<a href="" class="Nav_Sub"><span><i class="fa fa-folder-o"></i>User Level</span></a>
						<a href="" class="Nav_Sub"><span><i class="fa fa-folder-o"></i>Stores</span></a>
					</div>
				</div>
				
			</div>
			<div id="Main"></div>
		';
	}
}
?>