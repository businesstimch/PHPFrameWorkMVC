<?
class _HTMLs extends GGoRok
{
	function www_Left_Tab($PG = "Home")
	{
		?>
		<div id="Left_Tab">
			<a href="<?echo __DocumentRoot__;?>" id="Left_Tab_Logo"></a>
			<div class="LTab_One" id="LTab_1"><i class="fa fa-user"></i><br />로그인</div>
			<a href="<?echo __DocumentRoot__;?>" class="LTab_One LTab_Scroll Glow <?php echo ($PG == 'Home'? "Activated":"");?>"><i class="fa fa-search"></i><br />검색</a>
			<a href="<?echo __DocumentRoot__;?>Map/" class="LTab_One LTab_Scroll Glow <?php echo ($PG == 'Map'? "Activated":"");?>"><i class="fa fa-street-view"></i><br />내주변</a>
			<a href="<?echo __DocumentRoot__;?>Favorite/" class="LTab_One LTab_Scroll Glow <?php echo ($PG == 'Favorite'? "Activated":"");?>"><i class="fa fa-star"></i><br />즐겨찾기</a>
			<a href="<?echo __DocumentRoot__;?>Setting/" class="LTab_One LTab_Scroll Glow <?php echo ($PG == 'Setting'? "Activated":"");?>"><i class="fa fa-gear"></i><br />설정</a>
		</div>
		<?
	}
	function __tag_frontwebsite_footer__()
    {
		//<a class="hoverU" href="">Tour</a><br />
		
		$this->_lang = $this->languageloadLanguage('footer_menu');
		
        $html = '
				
		<div class="w100" id="footer">
			<div class="outline">
				
				<div id="footer_WhatisBurugo">
					<b>What is <span>Burugo</span>?</b><br /><br />
					<img src="/Template/Img/delete/preparing-what-is-burugo.png" />
				</div>
				<div class="footerLink">
					<div class="footerLink_Capt">Services</div>
					
					<a href="http://www.'.__domain__.'">Burugo</a>
					<a href="http://helper.'.__domain__.'">Burugo Helper</a>
					<a href="http://job.'.__domain__.'">Burugo Job</a>
					<a href="http://friend.'.__domain__.'">Burugo Friend</a>
					<a href="http://social.'.__domain__.'">Burugo Social</a>
					<a class="footerLink_Pict_A" href="/b/130/yesburugocall-center/"><img alt="Yes Burugo Call Center" src="/Template/Img/burugo-call-center.gif" /></a>
					<!--
					<a href="">'.$this->_lang[_lang_]['home'].'</a>  -
					<a href="'.__HTTPceo__.'">'.$this->_lang[_lang_]['merchantHome'].'</a> -
					<a href="">'.$this->_lang[_lang_]['myAcc'].'</a>  -
					<a href="/contact-us/">'.$this->_lang[_lang_]['contactUs'].'</a>  -
					<a href="/login/'.($this->login->isLogIn()?'?ajaxProcess&menu=logout':'').'">	'.($this->login->isLogIn()?$this->_lang[_lang_]['logout']:$this->_lang[_lang_]['login']).'</a>
					-->
				</div>
				<div class="footerLink">
					<div class="footerLink_Capt">Service</div>
					
					<a href="/register/">Register</a>
					<a href="/login/">Login</a>
					<a href="/login/">Forgot Password</a>
					<a href="/contact-us/">Contact Us</a>
					<a href="http://ceo.burugo.com/">Burugo CEO</a>
					<a class="footerLink_Pict_A" href="http://helper.burugo.com/"><img alt="May I Help You?" src="/Template/Img/helper-service-add-right.gif" /></a>
				</div>
				<div id="copyright">'.$this->_lang[_lang_]['copyright'].'</div>
			</div>
			
		</div>
        ';
		return $html;
    }
	
	function __tag_frontwebsite_topMenu__()
	{
		return '
			<div class="outline" id="topMenu_Block">
				<div class="inline">
					
				</div>
			</div>
		';
		
	}
	
	function __tag_wwwHome_right__()
	{
		
		return '
			
				<div class="rightMenu_Block">
					<a href="http://www.'.__domain__.'" class="rightMenu_Block_burugo'.(_SubDomain_ == 'home'?' rightMenu_Block_burugo_active':'').'"><span>burugo</span></a>
					<!--<a href="http://www.etreebus.com" class="rightMenu_Block_edu'.(_SubDomain_ == 'edu'?' rightMenu_Block_edu_active':'').'"><span>etreebus.com</span></a>-->
				</div>
		';
		
		
		
	}
	
	
	function __tag_frontwebsite_TopLogo__()
	{
		
		$lang = $this->languageloadLanguage('top_menu');
		$lang_Profile = $this->languageloadLanguage('burugo_profile');
		
		if(_SubDomain_ == 'www' || _SubDomain_ == 'blog')
		{
			$topColor_Class = 'topBG_www';
		}
		else if(_SubDomain_ == 'social')
		{
			$topColor_Class = 'topBG_social';
		}
		else if(_SubDomain_ == 'helper')
		{
			$topColor_Class = 'topBG_helper';
		}
		else if(_SubDomain_ == 'job')
		{
			$topColor_Class = 'topBG_job';
		}
		else if(_SubDomain_ == 'friend')
		{
			$topColor_Class = 'topBG_friend';
		}
		else if(_SubDomain_ == 'ceo')
		{
			$topColor_Class = 'topBG_ceo';
		}
	
		
		
		
		if(_SubDomain_ == 'www' || _SubDomain_ == 'social' || _SubDomain_ == 'helper' || _SubDomain_ == 'job' || _SubDomain_ == 'friend' || _SubDomain_ == 'blog')
		{
			
		
			$html = '
				<div id="TopFix_Boundary_Block" style="height:51px;">
					
					<div id="TopFix_Boundary">
						<div class="burugoTop w100 topBG '.$topColor_Class.'">
							<div class="topBlock outline">
								
								'.(_SubDomain_ == 'blog' ? '<a class="logo block" href="'.__SSL__.'www.'.__domain__.'"></a>':'<a class="logo block" href="/"></a>').'
								
								
								<form id="search_Form" action="http://www.burugo.com/s/" method="get">
									<div id="search_Block">
										<div id="searchContainer_1">
											<div class="searchContainer_Left"></div>
											<div class="searchContainer_Center"><input autocomplete="off" class="SearchBOXTop" id="SearchBOXTop_Keyword_INP" name="K" value="'.(isset($_GET['K']) && $_GET['K'] != "" ? htmlspecialchars($_GET['K']) : "" ).'" type="text" placeholder="by Keyword" /></div>
											<div class="searchContainer_Right"></div>
											<div class="autoComplete_Search" id="autoComplete_Keyword"></div>
										</div>
										
										<div id="searchContainer_2">
											<div class="searchContainer_Left"></div>
											<div class="searchContainer_Center"><input autocomplete="off" class="SearchBOXTop" id="SearchBOXTop_Address_INP" name="A" type="text" value="'.(isset($_GET['A']) && $_GET['A'] != "" ? htmlspecialchars($_GET['A']) : "" ).'" placeholder="City, State / Zip" /></div>
											<div class="searchContainer_Right"></div>
											<div class="autoComplete_Search"  id="autoComplete_Address"></div>
										</div>
										<div>
											<div id="searchBTN"></div>
										</div>
									</div>
								</form>
								<div class="topLogin_LINK">
									<a id="topHome_ICN" href="'.__HTTP__.'" class="block"></a>
									<div id="topNot_ICN"></div>
									<a id="topCEO_ICN" href="'.__HTTPceo__.'" class="block"></a>
									 '.($this->login->isLogIn() ? 
										'<a id="topLogOut_LINK" class="block" href="/login/?ajaxProcess&menu=logout"></a>'
										:
										'<a id="topLog_LINK" class="block" href="/login/"></a>
										<a id="topRegister_LINK" class="block" href="/register/"></a>'
									).'
									<div id="topSettings_ICN" class="noDrag"></div>
									<div id="topSettings_Container">
										<div class="topTriangle"></div>
										<div id="topSettings_Contents">
											<a class="topSettings_One topSettings_One_Hover block" href="/account/profile/"><span>'.$lang_Profile[_lang_]['Myprofile_LMenu'].'</span></a>
											<a class="topSettings_One topSettings_One_Hover block" href="/account/address/"><span>'.$lang_Profile[_lang_]['Settings_LMenu'].'</span></a>
											<a class="topSettings_One topSettings_One_Hover block" href="/account/orders/"><span>'.$lang_Profile[_lang_]['YourOrder_LMenu'].'</span></a>
											<div class="divider"></div>
											<div class="topSettings_One">
												<select id="Language_SLT">
													<option value="1"'.(isset($_COOKIE['langID']) && $_COOKIE['langID'] == 1?' selected="selected"':'').'>English</option>
													<option value="2"'.(isset($_COOKIE['langID']) && $_COOKIE['langID'] == 2?' selected="selected"':'').'>Español</option>
													<option value="3"'.(isset($_COOKIE['langID']) && $_COOKIE['langID'] == 3?' selected="selected"':'').'>한국어</option>
													<option value="4"'.(isset($_COOKIE['langID']) && $_COOKIE['langID'] == 4?' selected="selected"':'').'>日本語</option>
													<option value="5"'.(isset($_COOKIE['langID']) && $_COOKIE['langID'] == 5?' selected="selected"':'').'>繁體中文</option>
												</select>
											</div>
											
											<div class="divider"></div>
											<a class="topSettings_One topSettings_One_Hover block" '.($this->login->isLogIn() ? 'href="/login/?ajaxProcess&menu=logout"><span>Log Out</span>':'href="/login/"><span>Log In</span>').'</a>
											
										</div>
									</div>
								</div>
								
							</div>
						</div>
						<div class="w100 topBG_Grad"></div>
					</div>
					
				</div>
			
			';
		}
		else if(_SubDomain_ == 'ceo')
		{
			$html = '
				<div class="burugoTop w100 topBG '.$topColor_Class.'">
					<div class="topBlock outline">
						<a class="logo block" href="/"></a>
						
						<div class="topLogin_LINK" style="margin-left:586px">
							<a id="topHome_ICN" href="'.__HTTP__.'" class="block"></a>
							<div id="topNot_ICN"></div>
							<a id="topCEO_ICN" href="'.__HTTPceo__.'" class="block"></a>
							 '.($this->login->isLogIn() ? 
								'<a id="topLogOut_LINK" class="block" href="/login/?ajaxProcess&menu=logout"></a>'
								:
								'<a id="topLog_LINK" class="block" href="/login/"></a>
								<a id="topRegister_LINK" class="block" href="/register/"></a>'
							).'
							<div id="topSettings_ICN" class="noDrag"></div>
							<div id="topSettings_Container">
								<div class="topTriangle"></div>
								<div id="topSettings_Contents">
									<a class="topSettings_One topSettings_One_Hover block" href="/account/profile/"><span>'.$lang_Profile[_lang_]['Myprofile_LMenu'].'</span></a>
									<a class="topSettings_One topSettings_One_Hover block" href="/account/address/"><span>'.$lang_Profile[_lang_]['Settings_LMenu'].'</span></a>
									<a class="topSettings_One topSettings_One_Hover block" href="/account/orders/"><span>'.$lang_Profile[_lang_]['YourOrder_LMenu'].'</span></a>
									<div class="divider"></div>
									<div class="topSettings_One">
										<select id="Language_SLT">
											<option value="1"'.(isset($_COOKIE['langID']) && $_COOKIE['langID'] == 1?' selected="selected"':'').'>English</option>
											<option value="2"'.(isset($_COOKIE['langID']) && $_COOKIE['langID'] == 2?' selected="selected"':'').'>Español</option>
											<option value="3"'.(isset($_COOKIE['langID']) && $_COOKIE['langID'] == 3?' selected="selected"':'').'>한국어</option>
											<option value="4"'.(isset($_COOKIE['langID']) && $_COOKIE['langID'] == 4?' selected="selected"':'').'>日本語</option>
											<option value="5"'.(isset($_COOKIE['langID']) && $_COOKIE['langID'] == 5?' selected="selected"':'').'>繁體中文</option>
										</select>
									</div>
									
									<div class="divider"></div>
									<a class="topSettings_One topSettings_One_Hover block" '.($this->login->isLogIn() ? 'href="/login/?ajaxProcess&menu=logout"><span>Log Out</span>':'href="/login/"><span>Log In</span>').'</a>
									
								</div>
							</div>
						</div>
					</div>
					
				</div>
				<div class="w100 topBG_Grad"></div>
			
			';
		}
		
		else if(_SubDomain_ == 'school')
		{
				
				if(isset($_GET['page']))
				{
					if($_GET['page'] == 'qna')
						$searchINP = 'searchINP_etree_qna';
					else if($_GET['page'] == 'tutor')
						$searchINP = 'searchINP_etree_tutor';
					else if($_GET['page'] == 'friend')
						$searchINP = 'searchINP_etree_friend';
					else if($_GET['page'] == 'social')
						$searchINP = 'searchINP_etree_social';
					else
						$searchINP = 'searchINP_etree_main';
				}
				else
					$topColor_Class = 'topBG_etree_www';
				$html = '
					<div class="etreebusTop w100 topBG '._topColor_Class_.'">
						<div class="topBlock outline">
							<a class="logo" href="/"></a>
							<div class="search_Block search_Block_Etree '.$searchINP.'">
								<div>
								<input class="searchINP" type="text" id="Search_Name" />
								</div>
								<div id="searchBTN" style="margin-top:5px;"></div>
							</div>
							<div class="topMenu">
								<a class="block" href="/dashboard/" id="MyACC_Link">'.$lang[_lang_]['myPage'].'</a>
								<div class="divider">|</div>
								<a href="/login/" class="block" id="LogOut_Link">'.$lang[_lang_]['login'].'</a>
							</div>
						</div>
						
					</div>
					<div class="w100 topBG_Grad">
							  
						 </div>
				
				';
			
			
		}
		return $html;
	}
	
	
	
	function __tag_frontwebsite_header__()
	{
		return
					'<link href="'.__DocumentRoot__.'css/frontWebsite.css" rel="stylesheet" type="text/css" />'.
					"<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css' />";
		
	}
	
	
	function __burugo_login_page__()
	{
		$lang = $this->languageloadLanguage('login');
		$LoginToken = $_SESSION['LoginToken'] = md5(uniqid(mt_rand(), true));
			
		return '
			<script type="text/javascript">
				$(document).ready(function(){
					showMSGwindow("'.$lang[_lang_]['plzType'].'");
				});
			</script>
			
			
			
			<div class="outline">
				<table class="body" cellspacing="0" cellpadding="0" padding="0">
					<tr>
						<td class="left">
							<?echo __tag_ceoHome_left__;?>
						</td>
						<td class="middle" id="middleContents">
							<form action="#" method="post">
								<div class="loginBlock">
									<div class="loginBlock_Title">'.$lang[_lang_]['login'].'</div>
									<div class="boxCap">'.$lang[_lang_]['email'].'</div>
									<div class="boxInp">
										<input class="logInBox_INP" type="text" id="loginID" name="loginID" />
									</div>
									<div class="boxCap" style="margin-top:10px;">'.$lang[_lang_]['pass'].'</div>
									<div style="margin-bottom:12px;">
										<input class="logInBox_INP" type="password" id="loginPS" name="loginPS" />
										<input type="hidden" name="loginTK" id="loginTK" value="<?echo $LoginToken;?>" />
									</div>
									
									<div id="messageWindow_Block"></div>
									
									<div class="LogINBtn_Box">
										<input class="block submitBTN loginBTN" value="'.$lang[_lang_]['login'].'" type="submit" />
										<a href="/register/" class="registerBTN submitBTN block">'.$lang[_lang_]['register'].'</a>
									</div>
									
									'./*
									<div class="boxCap forgotPassword_Block">
										<div><a rel="nofollow" href="/login/?forgotPassword">Forget password</a></div>
										<div></div>
									</div>
									*/'
								</div>
							</form>
						</td>
						<td class="right">
							<?echo __tag_wwwHome_right__;?>
						</td>
					</tr>
					
				</table>
			</div>
		';
	}
	
	function __tag_ceoWebsite_Mystore_Left()
	{
		$lang = $this->languageloadLanguage('ceo_menu');
		
		
		return '
			<div class="containerMargin_Left">
				'.($this->login->isLogIn()? 
					$this->__tag_wwwHome_LeftProfile().'
					<div class="leftLink_Block">
				':'
					<div class="leftLink_Block">
				').'
				
					<div class="oneLeftMenu">
						<div class="menuTitle menuTitle_ceo">'.$lang[_lang_]['management'].' <span>(-)</span></div>
						<div class="subMenuBlock">
							<div class="leftMenu_One"><a href="/dashboard/" class="leftMenu_ICN leftMenu_ICN_ceo Verdana">'.$lang[_lang_]['dashboard'].'</a></div>
							<div class="leftMenu_One"><a href="/mystore/" class="leftMenu_ICN leftMenu_ICN_ceo Verdana">'.$lang[_lang_]['mybusiness'].'</a></div>
							<div class="leftMenu_One"><a href="/mystore/add-store/" class="leftMenu_ICN leftMenu_ICN_ceo Verdana">'.$lang[_lang_]['registerNewBusiness'].'</a></div>
						</div>
					</div>
				</div>
			</div>
		';
	}
	
	
	

	function __tag_wwwHome_LeftProfile()
	{
		$lang = $this->languageloadLanguage('burugo_profile');
		return ($this->login->isLogIn()? '
			<div class="myProfile_Block">
				<div class="myProfile_Pic"><img src="'.($this->login->_customerInfo[0]['customers_profile_picture'] != '' ? '/Template/Img/cData/'.$this->login->_customerID.'/profilePic/thumbnail/'.$this->login->_customerInfo[0]['customers_profile_picture'] : "/Template/Img/no-profile-image.jpg").'" alt="'.$this->login->_customerInfo[0]['customers_firstname'].' '.$this->login->_customerInfo[0]['customers_lastname'].'" /></div>
				<div class="myProfile_Link">
					'.$this->login->_customerInfo[0]['customers_firstname'].' '.$this->login->_customerInfo[0]['customers_lastname'].'<br />
					<!--<a href="http://www.'.__domain__.'/account/profile/">'.$lang[_lang_]['editProfile'].'</a>-->
					<a href="http://www.'.__domain__.'/account/profile/">'.$lang[_lang_]['editProfile'].'</a>
				</div>
			</div>
			':'');
	}
	function __tag_wwwHome_account_Left()
	{
		$lang = $this->languageloadLanguage('burugo_profile');
		return '
			<div class="containerMargin_Left">
					'.$this->__tag_wwwHome_LeftProfile().'
					<div class="L_Menu_One">
						<div class="L_Menu_Icon L_Menu_Icon_General"></div>
						<div class="L_Menu">
							<div class="L_Menu_Name"><a href="/account/profile/">'.$lang[_lang_]['Myprofile_LMenu'].'</a></div>
							<div class="L_Menu_Desc">'.$lang[_lang_]['Myprofile_Desc_LMenu'].'</div>
						</div>
					</div>
					
					<div class="L_Menu_One">
						<div class="L_Menu_Icon L_Menu_Icon_General"></div>
						<div class="L_Menu">
							<div class="L_Menu_Name"><a href="/account/address/">'.$lang[_lang_]['Settings_LMenu'].'</a></div>
							<div class="L_Menu_Desc">'.$lang[_lang_]['Settings_Desc_LMenu'].'</div>
						</div>
					</div>
					
					<div class="L_Menu_One">
						<div class="L_Menu_Icon L_Menu_Icon_Order"></div>
						<div class="L_Menu">
							<div class="L_Menu_Name"><a href="/account/orders/">'.$lang[_lang_]['YourOrder_LMenu'].'</a></div>
							<div class="L_Menu_Desc">'.$lang[_lang_]['YourOrder_Desc_LMenu'].'</div>
						</div>
					</div>
				</div>
				
			</td>
		
		';
	}
	
	
	function __tag_Tree_wwwHome_left__()
	{
		
		$this->_lang = $this->languageloadLanguage('tree_left_menu');
		
		
		return '
			
				<div class="containerMargin_Left">
				'.($this->login->isLogIn()? '
					<div class="myProfile_Block">
						<div class="myProfile_Pic"><img src="/Template/Img/delete/profile-image-2.jpg" alt="Chad Park" /></div>
						<div class="myProfile_Link">
							Chad Park<br />
							<a href="/my-profile/">Edit Profile</a>
						</div>
					</div>
				':'
					<div class="myProfile_Block">
						<div class="myProfile_Pic"><img src="/Template/Img/delete/profile-image-2.jpg" alt="Chad Park" /></div>
						<div class="myProfile_Link">
							Chad Park<br />
							<a href="/my-profile/">Edit Profile</a>
						</div>
					</div>
				').'
					
					<div class="leftLink_Block">
						
						<div class="menuTitle menuTitle_www">MY PAGES</div>						
						<div class="leftMenu_One"><a class="leftMenu_ICN leftMenu_ICN_Tree_www" href="">Class History</a></div>
						<div class="leftMenu_One"><a class="leftMenu_ICN leftMenu_ICN_Tree_www" href="/qna/">My Q&A</a></div>

						
						<div class="oneLeftMenu">
							<div class="menuTitle menuTitle_Tree_www">'.$this->_lang[_lang_]['menu_capt_1'].' <span>(-)</span></div>
							<div class="subMenuBlock">
								
								<div class="leftMenu_One"><a class="leftMenu_ICN leftMenu_ICN_Tree_www" href="">'.$this->_lang[_lang_]['menu_2'].'</a></div>
								<div class="leftMenu_One"><a class="leftMenu_ICN leftMenu_ICN_Tree_www" href="">'.$this->_lang[_lang_]['menu_3'].'</a></div>
								
							</div>
						</div>
						
						<div class="oneLeftMenu">
							<div class="menuTitle menuTitle_Tree_www">'.$this->_lang[_lang_]['menu_capt_2'].' <span>(-)</span></div>
							<div class="subMenuBlock">
								<div class="leftMenu_One"><a class="leftMenu_ICN leftMenu_ICN_Tree_www" href="">'.$this->_lang[_lang_]['menu_4'].'</a></div>
								<div class="leftMenu_One"><a class="leftMenu_ICN leftMenu_ICN_Tree_www" href="">'.$this->_lang[_lang_]['menu_5'].'</a></div>
								<div class="leftMenu_One"><a class="leftMenu_ICN leftMenu_ICN_Tree_www" href="">'.$this->_lang[_lang_]['menu_6'].'</a></div>
								<div class="leftMenu_One"><a class="leftMenu_ICN leftMenu_ICN_Tree_www" href="">'.$this->_lang[_lang_]['menu_7'].'</a></div>			
								<div class="leftMenu_One"><a class="leftMenu_ICN leftMenu_ICN_Tree_www" href="">'.$this->_lang[_lang_]['menu_8'].'</a></div>
								
							</div>
						</div>
						
						<div class="oneLeftMenu">
							<div class="menuTitle menuTitle_Tree_www">'.$this->_lang[_lang_]['menu_capt_3'].' <span>(-)</span></div>
							<div class="subMenuBlock">
								<div class="leftMenu_One"><a class="leftMenu_ICN leftMenu_ICN_Tree_www" href="">'.$this->_lang[_lang_]['menu_9'].'</a></div>
								<div class="leftMenu_One"><a class="leftMenu_ICN leftMenu_ICN_Tree_www" href="">'.$this->_lang[_lang_]['menu_10'].'</a></div>
								<div class="leftMenu_One"><a class="leftMenu_ICN leftMenu_ICN_Tree_www" href="">'.$this->_lang[_lang_]['menu_11'].'</a></div>
							</div>
						</div>
						
						<div class="oneLeftMenu">
							<div class="menuTitle menuTitle_Tree_www">'.$this->_lang[_lang_]['menu_capt_4'].' <span>(-)</span></div>
							<div class="subMenuBlock">
								<div class="leftMenu_One"><a class="leftMenu_ICN leftMenu_ICN_Tree_www" href="">'.$this->_lang[_lang_]['menu_13'].'</a></div>
								<div class="leftMenu_One"><a class="leftMenu_ICN leftMenu_ICN_Tree_www" href="">'.$this->_lang[_lang_]['menu_14'].'</a></div>
								<div class="leftMenu_One"><a class="leftMenu_ICN leftMenu_ICN_Tree_www" href="/eleventh-grade/">'.$this->_lang[_lang_]['menu_15'].'</a></div>
								<div class="leftMenu_One"><a class="leftMenu_ICN leftMenu_ICN_Tree_www" href="">'.$this->_lang[_lang_]['menu_16'].'</a></div>
							</div>
						</div>
						
						<div class="oneLeftMenu" style="margin-top:15px;">
							<div class="subMenuBlock">
								<div class="leftMenu_One" style="margin-left:0px;"><a href="" class="leftMenu_ICN leftMenu_ICN_Tree_www" style="margin-left:0px;color:#0070c0;">'.$this->_lang[_lang_]['menu_17'].'</a></div>
								<div class="leftMenu_One" style="margin-left:0px;"><a href="" class="leftMenu_ICN leftMenu_ICN_Tree_www" style="margin-left:0px;color:#0070c0;">'.$this->_lang[_lang_]['menu_18'].'</a></div>
								<div class="leftMenu_One" style="margin-left:0px;"><a href="" class="leftMenu_ICN leftMenu_ICN_Tree_www" style="margin-left:0px;color:#0070c0;">'.$this->_lang[_lang_]['menu_19'].'</a></div>
							</div>
						</div>

					

						
						
						
						
						
						
					</div>
				</div>

		';
		
	}
	function __tag_Tree_wwwHome_right__()
	{
		
		
		
		return '
			
				<div class="rightMenu_Block">
					<a href="http://www.etreebus.com" class="rightMenu_Block_etree'.(isset($_GET['page']) && $_GET['page'] == 'home'?' rightMenu_Block_etree_active':'').'"><span>etreebus</span></a>
					<a href="/qna/" class="rightMenu_Block_etree_qna'.(isset($_GET['page']) && $_GET['page'] == 'qna'?' rightMenu_Block_etree_qna_active':'').'"><span>etreebus Q&A</span></a>
					<a href="/tutor/" class="rightMenu_Block_etree_tutor'.(isset($_GET['page']) && $_GET['page'] == 'tutor'?' rightMenu_Block_etree_tutor_active':'').'"><span>etreebus tutor</span></a>
					<a href="/friend/" class="rightMenu_Block_etree_friend'.(isset($_GET['page']) && $_GET['page'] == 'friend'?' rightMenu_Block_etree_friend_active':'').'"><span>etreebus mentoring</span></a>
					<a href="/social/" class="rightMenu_Block_etree_social'.(isset($_GET['page']) && $_GET['page'] == 'social'?' rightMenu_Block_etree_social_active':'').'"><span>etreebus social</span></a>
					<a href="http://www.'.__domain__.'" class="rightMenu_Block_burugo"><span>burugo.com</span></a>
					
				</div>
		';
		
	
		
	}
	function __tag_weather()
    {
        $PG_option['weather'] = true;
        return ($PG_option['weather']?'<div class="rightWeather_Block"></div>':'');
        
        
    }

	
	function __tag_ceoHome_right__()
	{
		
		return '
			
				<div class="rightMenu_Block">
					<a href="http://www.'.__domain__.'" class="rightMenu_Block_burugo"><span>burugo</span></a>
				</div>
				<a href="'.($this->login->isLogIn()? "http://ceo.".__domain__."/mystore/add-store/" : "http://ceo.".__domain__."/register/").'" class="right_banner"><img src="/Template/Img/business-service-add-'._lang_.'.gif"></a>
				
				
		';
		
	}
	
	function __cp_AdminOnly()
	{
		
		return "
			<div style='border:3px solid #f4f4f4;padding-bottom:30px;padding-top:30px;margin-left:auto;margin-right:auto;width:300px;float:none;background-color:#a4a4a4;margin-top:100px;border-radius:20px;color:#f5f5f5;font-size:20px;font-family:Georgia;text-align:center;line-height:20px;'>
				OOPs!<br /><br />
				<a style='color:#595959;' href='http://www.burugo.com/login/'>Please log in before access<br /></a>
			</div>
		
		
		";
		
		
	}
	
	
	function __tag_cpHome_LeftProfile()
	{
		$lang = $this->languageloadLanguage('burugo_profile');
		return ($this->login->isLogIn()? '
			<div id="myProfileCP_Block">
				<div id="myProfileCP_Pic"><img src="'.($this->login->_customerInfo[0]['customers_profile_picture'] != '' ? '/Template/Img/cData/'.$this->login->_customerID.'/profilePic/thumbnail/'.$this->login->_customerInfo[0]['customers_profile_picture'] : "/Template/Img/no-profile-image.jpg").'" alt="'.$this->login->_customerInfo[0]['customers_firstname'].' '.$this->login->_customerInfo[0]['customers_lastname'].'" /></div>
				<div id="myProfileCP_Link">
					'.$this->login->_customerInfo[0]['customers_firstname'].' '.$this->login->_customerInfo[0]['customers_lastname'].'<br />
					<!--<a href="http://www.'.__domain__.'/account/profile/">'.$lang[_lang_]['editProfile'].'</a>-->
					<a href="http://www.'.__domain__.'/account/profile/">'.$lang[_lang_]['editProfile'].'</a>
				</div>
			</div>
			':'');
	}
	function __tag_topMenu__()
	{

		return '
			
		';

	}
    
    
	function __tag_footerCustomerSection__()
    {
        return '
                    
        ';
    }
	
	function __tag_requestLogin__()
    {
		
		global $LoginToken;
		
		
        return
		
			'
			<script type="text/javascript">
				window.location.href  = "/login/";
			</script>'
        ;
   }
	function Top_SlidingCategory()
	{
		
		$Category = $this->db->QRY("
							SELECT
								C.category_id,
								C.category_url,
								CN.category_name
							FROM
								b_category C,
								b_category_name CN
								
							WHERE
								C.category_id = CN.category_id AND
								CN.lang_id = '".__langID__."'
						");
		$HTML = '';
		$HTML .= '
		<div id="topCategory_Block">
			<div id="topCategory_Left"><div id="topCategory_Left_bg"></div></div>
			<div id="topCategory_Cont">';
		$Cat_Count = 0;
		
		foreach($Category as $Category_F)
		{
					
			$Cat_Count++;
			$HTML .= '
						<div class="oneIcon_TopMenu"'.($Cat_Count % 6 == 0? ' style="margin-right:0px;"' : "").'>
						<a href="/c/'.$Category_F['category_url'].'/" class="oneIcon_ICN" id="oneIcon_ICN_'.$Category_F['category_id'].'"></a>
						<div class="oneIcon_NAME">'.$Category_F['category_name'].'</div>
						</div>';
		}
		$HTML .= '
			</div>
		</div>';
		
		return $HTML;
	}
	function CP_loadTopMenu($adminLevel = 10,$Page = null)
	{
		$adminLevelPage = 4;
		$html = '<a class="TopMenu_One'.($Page=='Dashboard'?' TopMenu_Selected':'').'" href="/">Dashboard</a>';
		
		if($adminLevel <= $adminLevelPage)
			$html .= '<a class="TopMenu_One'.($Page=='Orders'?' TopMenu_Selected':'').'" href="/orders/">Orders</a>';
			
		if($adminLevel <= 10)
			$html .= '<a class="TopMenu_One'.($Page=='Accounts'?' TopMenu_Selected':'').'" href="/accounts/dashboard/">Accounts</a>';
			
		if($adminLevel <= $adminLevelPage)
			$html .= '<a class="TopMenu_One'.($Page=='Payments'?' TopMenu_Selected':'').'" href="/payments/">Payments</a>';
			
		if($adminLevel <= 10)
			$html .= '<a class="TopMenu_One'.($Page=='Appearance'?' TopMenu_Selected':'').'" href="/appearance/language/">Appearance</a>';
			
		if($adminLevel <= 1)
			$html .= '<a class="TopMenu_One'.($Page=='SU'?' TopMenu_Selected':'').'" href="/superuser/backup/">SU</a>';
		
		$html .= '<a class="TopMenu_One" href="/login/?ajaxProcess&menu=logout">Logout</a>';
		
		return $html;
			
		
	}
	function CP_loadSubMenu($adminLevel = 10, $Page, $SubPage = null)
	{
		$SubMenu_HTML = '';
		
		$SubMenu['orders'][] = '<a class="One_LeftMenu" href="/orders/orders/">Orders</a>';
		$SubMenu['Appearance'][] = '
			<a class="One_LeftMenu'.($SubPage=='AddLanguage'?' LeftMenu_Selected':'').'" href="/appearance/add-language/">Add Language</a>
			<a class="One_LeftMenu'.($SubPage=='Language'?' LeftMenu_Selected':'').'" href="/appearance/language/">Language</a>
		';

		if($adminLevel <= 4)
		{
			$SubMenu['Accounts'][] = '<a class="One_LeftMenu'.($SubPage=='Dashboard'?' LeftMenu_Selected':'').'" href="/accounts/dashboard/">Dashboard</a>';
			$SubMenu['Accounts'][] = '<a class="One_LeftMenu'.($SubPage=='Stores'?' LeftMenu_Selected':'').'" href="/accounts/stores/">Stores</a>';
			$SubMenu['Accounts'][] = '<a class="One_LeftMenu'.($SubPage=='Refers'?' LeftMenu_Selected':'').'" href="/accounts/refers/">Refers</a>';
		}
		
		
		$SubMenu['Payments'][] = '<a class="One_LeftMenu'.($SubPage=='PaymentHistory'?' LeftMenu_Selected':'').'" href="/payments/history/">Payment History</a>';
		
		$SubMenu['SU'][] = '
			<a class="One_LeftMenu'.($SubPage=='Backup'?' LeftMenu_Selected':'').'" href="/payments/backup/">Server Backup</a>
			<a class="One_LeftMenu'.($SubPage=='Paycheck'?' LeftMenu_Selected':'').'" href="/superuser/paycheck/">Paycheck</a>';
		
		
		return (isset($SubMenu[$Page]) ? implode('',$SubMenu[$Page]) : '');
	}
}


?>