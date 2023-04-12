<?

class language extends GGoRok
{
	var $customer_ID;
	public $_general = array();
	
	public function __construct()
	{
		global $db;
		$_general = $this->general();
	
		
	}
	
	public function loadLanguage($Language_Group)
	{
		$xmlLang_File = __BackendPath__.'Cache/Language/lang_'.$Language_Group.'.xml';
		$_lang = array();
		
		if(is_file($xmlLang_File))
		{
			
			$langXML = simplexml_load_file(__BackendPath__.'Cache/Language/lang_'.$Language_Group.'.xml');
			
			foreach($langXML->children()->children() as $langXML_C1)
			{
				foreach($langXML_C1->children() as $langXML_C2)
				$_lang[$langXML_C1->getName()][$langXML_C2->getName()] = (string)$langXML_C2;
			}
			
			
		}
		return $_lang;
	}
	
	public function saveIntoDB()
	{
		global $db;
		/*
		1.en
		2.es
		3.ko
		4.jp
		5.cn
		*/
		$def = get_class_methods('language');
		$db->QRY("DELETE FROM b_burugo_language");
		$db->QRY("ALTER TABLE b_burugo_language AUTO_INCREMENT = 1");
		
		foreach($def as $def_f)
		{
			if($def_f != "__construct" && $def_f != 'saveIntoDB' && $def_f != 'loadLanguage' && $def_f != 'right_info' && $def_f != 'general_js')
			{
				
				$lang = $this->$def_f();
				echo $def_f.'<br />';
				foreach($lang AS $lang_Key => $lang_F)
				{
					
					
					$langID = ($lang_Key == 'en'?1:'').($lang_Key == 'es'?2:'').($lang_Key == 'ko'?3:'').($lang_Key == 'jp'?4:'').($lang_Key == 'cn'?5:'');
					foreach($lang[$lang_Key] as $lang_Key_2 => $lang_F_2)
					{
						
						
						$db->QRY("
							INSERT INTO
								b_burugo_language
								(
									lang_id,
									lang_group_name,
									lang_name,
									lang_contents
								)
								VALUES
								(
									'".$langID."',
									'".$db->escape($def_f,false)."',
									'".$db->escape($lang_Key_2,false)."',
									'".$db->escape($lang_F_2,false)."'
								)
							
						");
						
						
					}
						
					
					
				}
				
			}
				
		}
		
		
	}
	
	public function general()
	{
		$_lang['en']['myPage'] = '';
		
		return $_lang;
	}
	
	public function ceo_mystore()
	{
		$_lang['en']['mybusiness'] = 'My Businesses';
		$_lang['ko']['mybusiness'] = '나의 비지니스';
		
		$_lang['en']['mybusinessList'] = 'My Businesses List';
		$_lang['ko']['mybusinessList'] = '나의 비지니스 목록';
		
		$_lang['en']['registerNewBusiness'] = 'Register New Business';
		$_lang['ko']['registerNewBusiness'] = '신규 비지니스 등록';
		
		$_lang['en']['bName'] = 'Businesses Name';
		$_lang['ko']['bName'] = '비지니스명';
		
		$_lang['en']['bMenu'] = 'Menu';
		$_lang['ko']['bMenu'] = '메뉴';
		
		$_lang['en']['bStatus'] = 'Status';
		$_lang['ko']['bStatus'] = '비지니스현황';
		
		$_lang['en']['addBus_PageTitle'] = 'Register New Business';
		$_lang['ko']['addBus_PageTitle'] = '신규 비지니스 등록';
		
		$_lang['en']['addBus_BusinessName'] = 'Business Name';
		$_lang['ko']['addBus_BusinessName'] = '비지니스명/기타서비스 등록자명 혹은 서비스명';
		$_lang['en']['addBus_BusinessName_D'] = 'This is your business name. Once you save this field you will not be able to change it in the future unless you contact our store management department. So please make sure this is right business name.';
		$_lang['ko']['addBus_BusinessName_D'] = '비지니스 및 혹은 사업체 이름을 넣어주세요. 고객분들께 보다 낳고 믿음직한 서비스를 제공하기 위해 비지니스명의 잦은 변경을 가급적 제한하고 있으니 입력에 신중을 가해 주세요.';
		
		$_lang['en']['addBus_SEOFriendly'] = 'Business SEO friendly URL';
		$_lang['ko']['addBus_SEOFriendly'] = '검색엔진 최적화 주소';
		$_lang['en']['addBus_SEOFriendly_D'] = 'Example) <span style="color:#3ea8eb">http://www.burugo.com/food/3341/</span><span id="S_StoreSEOurl_Example">philly-chicken</span><br />Only <b>Alphabet</b>, <b>Number</b>, <b>dash(-)</b>.';
		$_lang['ko']['addBus_SEOFriendly_D'] = '예를들어) <span style="color:#3ea8eb">http://www.burugo.com/food/3341/</span><span id="S_StoreSEOurl_Example">philly-chicken</span><br /> <b>영어 알바뱃</b>, <b>숫자</b>, <b>대쉬(-) 만 허용 됩니다.</b>.';
		
		$_lang['en']['premium_register'] = 'Premium Register';
		$_lang['ko']['premium_register'] = '유료등록';
		
		$_lang['en']['cart'] = 'Cart Summary';
		$_lang['ko']['cart'] = '장바구니 결재정보';
		
		$_lang['en']['Payment_Summary_Will_M'] = '(Your subscription fee <b class="Payment_Summary_PriceFuture">$30.00</b> will be started and charged on '.date('01/M/Y', strtotime('next month')).')';
		$_lang['ko']['Payment_Summary_Will_M'] = '('.date('Y년 m월 1일', strtotime('next month')).'부터 <b class="Payment_Summary_PriceFuture">$30.00</b> 가 결재 됩니다.)';
		
		$_lang['en']['Payment_Summary_Will_Y'] = '(Your subscription fee <b class="Payment_Summary_PriceFuture">$300.00</b> will be started and charged on '.date('01/M/Y', strtotime('next month')).')';
		$_lang['ko']['Payment_Summary_Will_Y'] = '('.date('Y년 m월 1일', strtotime('next month')).'부터 <b class="Payment_Summary_PriceFuture">$300.00</b> 가 결재 됩니다.)';
		
		$_lang['en']['total'] = 'Total';
		$_lang['ko']['total'] = '결재 내용';
		
		$_lang['en']['free_register'] = 'Free Register';
		$_lang['ko']['free_register'] = '무료등록';
		
		$_lang['en']['addBus_PaidOrFree'] = 'Service Type : Premium or Basic Account';
		$_lang['ko']['addBus_PaidOrFree'] = '서비스 종류 : 유료 혹은 무료 계정';
		$_lang['en']['addBus_PaidOrFree_D'] = 'Please select service package for your business';
		$_lang['ko']['addBus_PaidOrFree_D'] = '서비스 계정 종류를 선택해 주세요. 유료 계정일 경우, 비지니스 사진 등록, 주소 기능, 주문/배달/예약 서비스, 우선 리스팅, 비지니스 상세설명 등록 기능, 결제시스템 등의 혜택을 누리실 수 있습니다.';
		
		$_lang['en']['addBus_Premium_Desc_T_1'] = 'Add Pictures of Business ';
		$_lang['ko']['addBus_Premium_Desc_T_1'] = '비지니스 사진 등록하기';
		$_lang['en']['addBus_Premium_Desc_D_1'] = 'You can upload up to 20 pictures describing your business. ';
		$_lang['ko']['addBus_Premium_Desc_D_1'] = '비지니스 사진을 최대 20장까지 올릴 수 있어요.';
		
		$_lang['en']['addBus_Premium_Desc_T_2'] = 'Add Address of Business';
		$_lang['ko']['addBus_Premium_Desc_T_2'] = '비지니스 주소 등록하기';
		$_lang['en']['addBus_Premium_Desc_D_2'] = 'Add address and map for your customers';
		$_lang['ko']['addBus_Premium_Desc_D_2'] = '주소와 지도를 넣을 수 있어요.';
		
		$_lang['en']['addBus_Premium_Desc_T_3'] = 'R / P / D Service';
		$_lang['ko']['addBus_Premium_Desc_T_3'] = '주문, 배달, 예약 기능';
		$_lang['en']['addBus_Premium_Desc_D_3'] = 'You can provide Reservation, Pick up, Delivery function for your customer. Beside you can make your own plan for your business by checking monthly stastics, trend tables.';
		$_lang['ko']['addBus_Premium_Desc_D_3'] = '주문, 배달, 예약 서비스를 통해 별도의 웹싸이트 구축 없이 부르고에서 필요한 서비스를 구축해 드립니다. 또한 사장님 전용 싸이트를 통해 주문 통계 및 트렌드 분석, 마케팅 전략/분석을 하실 수 있습니다.';
		
		$_lang['en']['addBus_Premium_Desc_T_4'] = 'Add Open/Close Time';
		$_lang['ko']['addBus_Premium_Desc_T_4'] = '비지니스 여는/닫는 시간';
		$_lang['en']['addBus_Premium_Desc_D_4'] = 'You can set up open/close time daily. Your customers don\'t have to call your business to check it.';
		$_lang['ko']['addBus_Premium_Desc_D_4'] = '요일별로 비지니스 영업 시간을 넣으실 수 있으며, 한눈에 손님이 사업지 영업 상황을 확인할 수 있어 불편함을 줄일 수 있습니다.';
		
		$_lang['en']['addBus_Premium_Desc_T_5'] = 'Add Detailed Description';
		$_lang['ko']['addBus_Premium_Desc_T_5'] = '비지니스 상세 설명하기';
		$_lang['en']['addBus_Premium_Desc_D_5'] = 'You can add brochures and images to help customer to understand your business. You can create beutiful description page without any program knowledge because we provice wysiwyg HTML editor for you.';
		$_lang['ko']['addBus_Premium_Desc_D_5'] = '가게 팜플렛과 기타 사진 자료를 넣을 수 있으며, 워드 같은 위지윅 방식의 에디터를 통해 프로그램 코드에 대한 지식이 없이도 화려한 비지니스 설명 페이지를 만들 수 있습니다.';
		
		$_lang['en']['addBus_Premium_Desc_T_6'] = 'High Priority Listing';
		$_lang['ko']['addBus_Premium_Desc_T_6'] = '우선 리스팅';
		$_lang['en']['addBus_Premium_Desc_D_6'] = 'Your business will be listed with higher priority than free membership businesses.';
		$_lang['ko']['addBus_Premium_Desc_D_6'] = '유효회원께서는 먼저 우선 리스팅이 되세요.';
		
		$_lang['en']['addBus_Basic_Desc_T_1'] = 'Add Pictures of Business';
		$_lang['ko']['addBus_Basic_Desc_T_1'] = '비지니스 사진 등록하기';
		$_lang['en']['addBus_Basic_Desc_D_1'] = 'You can upload one picture describing your business. ';
		$_lang['ko']['addBus_Basic_Desc_D_1'] = '한장의 비지니스 사진을 올릴 수 있어요.';
		
		$_lang['en']['addBus_AreYouOwner'] = 'Are you a business owner or a service person?';
		$_lang['ko']['addBus_AreYouOwner'] = '현재 본인이 비지니스 등록자인지, 기타 서비스 등록자 인지 선택해 주세요.';
		$_lang['en']['addBus_AreYouOwner_D'] = 'Please choose one of the following option.';
		$_lang['ko']['addBus_AreYouOwner_D'] = '아래 4가지 옵션 중 하나를 선택해 주세요.';
		
		$_lang['en']['addBus_AreYouOwner_Option1'] = 'I am a Business Owner';
		$_lang['ko']['addBus_AreYouOwner_Option1'] = '비지니스 등록자';
		
		$_lang['en']['addBus_AreYouOwner_Option2'] = 'I am a Service Person';
		$_lang['ko']['addBus_AreYouOwner_Option2'] = '배송/장보기/심부름 등록자';
		
		$_lang['en']['addBus_AreYouOwner_Option3'] = 'I am an Helper';
		$_lang['ko']['addBus_AreYouOwner_Option3'] = '헬퍼 등록자';
		
		$_lang['en']['addBus_AreYouOwner_Option4'] = 'I am a ';
		$_lang['ko']['addBus_AreYouOwner_Option4'] = '소셜 등록자';
		
		$_lang['en']['addBus_Cat1'] = 'Pick 1 : First Category';
		$_lang['ko']['addBus_Cat1'] = '선택 1 : 대분류 카테고리';
		$_lang['en']['addBus_Cat1_D'] = 'Please select a category of your business in the below list.';
		$_lang['ko']['addBus_Cat1_D'] = '현재 등록 하려는 사업체/서비스 업종에 속한 카테고리를 선택해 주세요.';
		
		$_lang['en']['addBus_Payment'] = 'Payment';
		$_lang['ko']['addBus_Payment'] = '결재';
		$_lang['en']['addBus_Payment_D'] = 'Please type your payment information.';
		$_lang['ko']['addBus_Payment_D'] = '결재정보를 입력해 주세요.';
		
		
		$_lang['en']['addBus_Cat2'] = 'Pick 2 : Second Category';
		$_lang['ko']['addBus_Cat2'] = '선택 2 : 소분류 카테고리';
		$_lang['en']['addBus_Cat2_D'] = 'Please select a sub category of your business in the below list.';
		$_lang['ko']['addBus_Cat2_D'] = '위에서 선택한 분류를 기준으로 소분류 카테고리를 선택해 주세요.';
		
		$_lang['en']['tab_01'] = 'General';
		$_lang['ko']['tab_01'] = '메인';
		
		$_lang['en']['tab_02'] = 'Category';
		$_lang['ko']['tab_02'] = '카테고리';
		
		$_lang['en']['tab_03'] = 'Item';
		$_lang['ko']['tab_03'] = '아이템';
		
		$_lang['en']['Service_01'] = 'Reservation';
		$_lang['ko']['Service_01'] = '예약서비스';
		$_lang['en']['Service_02'] = 'To Go / Pick Up';
		$_lang['ko']['Service_02'] = '투고/픽업 서비스';
		$_lang['en']['Service_03'] = 'Delivery';
		$_lang['ko']['Service_03'] = '배달/배송 서비스';
		$_lang['en']['Service_03_Own'] = 'Yes, I do have own my delivery service';
		$_lang['ko']['Service_03_Own'] = '혹시 자체 배송 서비스가 있다면';
		
		$_lang['en']['delivery_fee'] = 'Delivery Fee($) <span>- How much will you charge for delivery fee?</span>';
		$_lang['ko']['delivery_fee'] = '배송비($) <span>- 만약 자체 배송서비스가 있다면, 배송서비스시 부가되는 일회 비용</span>';
		
		$_lang['en']['optional'] = 'Optional';
		$_lang['ko']['optional'] = '선택사항';
		
		$_lang['en']['business_services'] = 'Services';
		$_lang['ko']['business_services'] = '서비스';
		$_lang['en']['business_services_desc'] = 'Please check if you want to provide the service.';
		$_lang['ko']['business_services_desc'] = '고객에게 제공하고자 하는 서비스를 선택 해주세요.';
		
		$_lang['en']['business_name'] = 'Business Name';
		$_lang['ko']['business_name'] = '비지니스명/기타 서비스 등록자의 이름 혹은 서비스명';
		$_lang['en']['business_name_desc'] = 'This is your business name. Changing this field is limited allowed please consider carefully before changing.';
		$_lang['ko']['business_name_desc'] = '부르고 리스트 화면에서 사장님의 사업체 사진 아래 나올 사업명 필드 설정 부분 입니다.<br /> 사업명은 한번 선택 후 잦은 변경이 불가능하니 참고해 주세요.';
		
		$_lang['en']['business_seofriendly'] = 'Business SEO friendly URL';
		$_lang['ko']['business_seofriendly'] = '검색엔진 최적화 주소';
		$_lang['en']['business_seofriendly_desc'] = 'Thiis is going to be your web url of your business. We provide to our customer the best SEO friendly technology to enlarge your business profit.<br />Example) http://www.burugo.com/food/3341/<span style="color:red;">Your URL</span>';
		$_lang['ko']['business_seofriendly_desc'] = '인터넷 상에 같은 종류의 비지니스가 있어도, 검색엔진(구글,네이버,야후)에 뜨는 업체와 뜨지 않는 업체 사이에서 생기는 사업적 이익의 차이점은 아주 큽니다. 검색엔진의 첫번째 리스트에 뜨는 업체는 뉴욕의 맨하탄에 있는 한 상점이라고 가정 한다면, 반대로 뜨지 않는 업체는 어느 시골의 한 골목가에 자리 잡은 업체로 비유할 수 있습니다. 부르고는 여러분에게 최적의 검색엔진 최적화를 위한 환경을 제공 합니다. 가능한 여러분이 노출되고자 하는 키워드를 이 곳에 넣어 주세요. <br /><br />오직 영어 알파벳, 숫자 혹은 대쉬(-)만 허용 됩니다.<br /><b>주소예</b>) http://www.burugo.com/food/3341/<span style="color:red;">Your URL</span>';
		
		$_lang['en']['business_images'] = 'Business Images';
		$_lang['ko']['business_images'] = '비지니스 설명 사진';
		$_lang['en']['business_images_desc'] = 'Please upload your store/business associated pictures at least one.';
		$_lang['ko']['business_images_desc'] = '비지니스와 관련된 사진(업체 내부 사진 혹은 서비스 종사자인 경우 본인의 프로필 사진 혹은 서비스 관련 사진)을 업로드 해주세요.<br /> 최소 1개 이상 최대 20개 까지 업로드 할 수 있습니다.';
		
		$_lang['en']['business_shortdesc'] = 'Short Description';
		$_lang['ko']['business_shortdesc'] = '나의 비지니스를 짧게 한마디로 표현 한다면?';
		$_lang['en']['business_shortdesc_desc'] = 'Allowed format : Text.';
		$_lang['ko']['business_shortdesc_desc'] = '사장님의 비지니스 슬로건 혹은 처음 들어온 고객이 한 눈에 어떤 비지니스인지를 알아볼 수 있는 짧교 명료한 글로 표현 해주세요.';
		
		$_lang['en']['business_longdesc'] = 'Long Description';
		$_lang['ko']['business_longdesc'] = '좀 더 자세히 설명 한다면?';
		$_lang['en']['business_longdesc_desc'] = 'Allowed format : Text.';
		$_lang['ko']['business_longdesc_desc'] = '나의 사업체에 대해 신문기사에 싣는다고 과정해 보세요. 어떤 내용이 들어가야 손님들에게 보다 효과적으로 광고를 할 수 있을까요? 필요에 따라 사진 파일을 업로드 하실 수 있습니다.';
		
		$_lang['en']['business_uploadPic'] = 'Upload Picture';
		$_lang['ko']['business_uploadPic'] = '사진 업로드';
		
		$_lang['en']['YourBusinessAddress'] = 'Your Business Location';
		$_lang['ko']['YourBusinessAddress'] = '비지니스 주소';
		
		$_lang['en']['YourBusinessAddress_Desc'] = "Burugo provides location based service. So that customer can use service around their current location conveniently. So please provide us the correct address of your business. If you have any problem while setting up your address please don't hesitate to contact us.";
		$_lang['ko']['YourBusinessAddress_Desc'] = "부르고는 위치기반 서비스 입니다. 고객분들께서 편안히 찾아볼 수 있도록 정확한 비지니스 주소를 입력해 주세요. 이 주소를 통해 지역 기반의 리스팅 서비스 및 실시간 계산기능 등이 제공되며, 기타 수 많은 서비스가 제공 되고 있으니, 반드시 정확한 주소를 기재해 주시기 바랍니다. 비지니스 주소 등록에 문제가 있거나 질문이 있으시면 부르고 콜센터에 연락해 주세요.";
		
		
		
		$_lang['en']['Country'] = 'Country';
		$_lang['ko']['Country'] = '국가';
		
		$_lang['en']['Country_Desc'] = 'Current location of your business.(Currently we only accept businesses in US).';
		$_lang['ko']['Country_Desc'] = '현재 미주 지역만 가능합니다(추후 한국, 일본, 중국, 유럽 등지로 확장 됩니다.)';
		
		$_lang['en']['ZipCode'] = 'Zip Code';
		$_lang['ko']['ZipCode'] = '우편번호(Zip Code)';
		
		$_lang['en']['State'] = 'State';
		$_lang['ko']['State'] = '주';
		
		$_lang['en']['City'] = 'City';
		$_lang['ko']['City'] = '시';
		
		$_lang['en']['StreetAddress'] = 'Street Address';
		$_lang['ko']['StreetAddress'] = '거리주소';
		
		$_lang['en']['StreetAddress2'] = 'Additional Address';
		$_lang['ko']['StreetAddress2'] = '추가주소';
		
		$_lang['en']['StreetAddress2_Desc'] = 'APT, Office Box Number';
		$_lang['ko']['StreetAddress2_Desc'] = '아파트/빌딩번호';
		
		$_lang['en']['VerifyAddress'] = 'Verify Address';
		$_lang['ko']['VerifyAddress'] = '주소확인';
		
		
		$_lang['en']['BusinessPhoneNumber'] = 'Business Phone Number';
		$_lang['ko']['BusinessPhoneNumber'] = '비지니스 연락처';
		
		$_lang['en']['BusinessPhoneNumber_Desc'] = 'This is the number that customers will use to contact you (ex : 1-770-123-1234).';
		$_lang['ko']['BusinessPhoneNumber_Desc'] = '고객분들이 전화할 수 있는 사장님의 비지니스 전화번호를 기입해 주세여.';
		
		$_lang['en']['Sunday'] = 'Sunday';
		$_lang['ko']['Sunday'] = '일요일';
		$_lang['en']['Monday'] = 'Monday';
		$_lang['ko']['Monday'] = '월요일';
		$_lang['en']['Tuesday'] = 'Tuesday';
		$_lang['ko']['Tuesday'] = '화요일';
		$_lang['en']['Wednessday'] = 'Wednessday';
		$_lang['ko']['Wednessday'] = '수요일';
		$_lang['en']['Thursday'] = 'Thursday';
		$_lang['ko']['Thursday'] = '목요일';
		$_lang['en']['Friday'] = 'Friday';
		$_lang['ko']['Friday'] = '금요일';
		$_lang['en']['Saturday'] = 'Saturday';
		$_lang['ko']['Saturday'] = '토요일';
		
		
		$_lang['en']['business_insertIntoDesc'] = 'Insert';
		$_lang['ko']['business_insertIntoDesc'] = '본문삽입';
		
		$_lang['en']['business_deleteFromDesc'] = 'Delete';
		$_lang['ko']['business_deleteFromDesc'] = '사진삭제';
		
		$_lang['en']['Category'] = 'Category';
		$_lang['ko']['Category'] = '카테고리';
		
		$_lang['en']['Category_Desc'] = 'Check categories associated with your business. Your business will be listed on categories you checked.';
		$_lang['ko']['Category_Desc'] = '현재 비지니스와 관련된 카테고리를 선택해 주세요. 비지니스와 카테고리가 연관성이 부족할시 리스팅에 제한이 생길 수 있습니다.';
		
		$_lang['en']['ItemListingStyle'] = 'Item Listing Styles';
		$_lang['ko']['ItemListingStyle'] = '아이템 목록 스타일';
		
		$_lang['en']['tax'] = 'Tax';
		$_lang['ko']['tax'] = '세금';
		$_lang['en']['tax_desc'] = 'Please specify the tax amount in &#37; for your items.';
		$_lang['ko']['tax_desc'] = '현재 세금으로 부가되는 금액을 퍼센트(&#37;)로 입력해주세요.';
		
		$_lang['en']['items'] = 'Items';
		$_lang['ko']['items'] = '아이템';
		$_lang['en']['items_desc'] = 'Add your item group first and create your own item list.';
		$_lang['ko']['items_desc'] = '아래 버튼을 통해 아이템 그룹을 먼저 생성해주세요.';
		
		$_lang['en']['items_group_add'] = 'Add New Item Group';
		$_lang['ko']['items_group_add'] = '아이템 그룹 생성';
		
		$_lang['en']['items_group_name'] = 'Item Group Name';
		$_lang['ko']['items_group_name'] = '아이템 그룹명';
		
		$_lang['en']['items_group_name_desc'] = 'This name will be listed above of your group box.';
		$_lang['ko']['items_group_name_desc'] = '하나 혹은 다수의 아이템을 그룹 짓는 그룹명으로 아이템 그룹박스 상단에 표시 됩니다.';
		
		$_lang['en']['items_group_fold'] = 'Item Group Fold';
		$_lang['ko']['items_group_fold'] = '아이템 그룹 접기';
		
		$_lang['en']['items_group_fold_desc'] = 'If you have many groups and items in one page, using this option is great idea.';
		$_lang['ko']['items_group_fold_desc'] = '아이템이 너무 많아 페이지가 한 없이 길어질 경우 간혹 고객에게 불편을 줄 수 있습니다. 이러한 경우 이 곳을 체크하면 해당 그룹은 펼침방식에서 접은방식으로 전환되며, 이어서 많은 공간을 절약할 수 있습니다.';
		
		$_lang['en']['items_list'] = 'Item List';
		$_lang['ko']['items_list'] = '아이템 리스트';
				
		$_lang['en']['items_list_desc'] = 'Start adding your items by clicking below button.';
		$_lang['ko']['items_list_desc'] = '아래 버튼을 통해 본격적으로 아이템 추가해 주세요.';
		
		$_lang['en']['createNewItem_BTN'] = 'Create New Item';
		$_lang['ko']['createNewItem_BTN'] = '아이템 추가';
		
		$_lang['en']['ItemCol_pic'] = 'Pic';
		$_lang['ko']['ItemCol_pic'] = '사진';
		
		$_lang['en']['ItemCol_name'] = 'Name';
		$_lang['ko']['ItemCol_name'] = '이름';
		
		$_lang['en']['ItemCol_sdesc'] = 'Short Description';
		$_lang['ko']['ItemCol_sdesc'] = '짧은설명';
		
		$_lang['en']['ItemCol_price'] = 'Price';
		$_lang['ko']['ItemCol_price'] = '가격';
		
		$_lang['en']['ItemCol_tax'] = 'Tax';
		$_lang['ko']['ItemCol_tax'] = '세금';
		
		$_lang['en']['ItemCol_menu'] = 'Menu';
		$_lang['ko']['ItemCol_menu'] = '메뉴';
		
		
		$_lang['en']['ItemListingStyle_Desc'] = 'Choose one of the following list.';
		$_lang['ko']['ItemListingStyle_Desc'] = '아래 두가지 아이템 스타일 중 하나를 선택해 주세요. (사장님의 비지니스에 표시 될 아이템의 리스팅 스타일을 결정할 수 있어요. 비지니스를 처음 등록 하셨고 만약 현재는 사진자료가 부족할 경우라면 \'아이템 이름\' 스타일을 선택해 주세요.)';
		
		$_lang['en']['ItemListingStyle_01'] = 'Text Only';
		$_lang['ko']['ItemListingStyle_01'] = '아이템 이름';
		
		$_lang['en']['ItemListingStyle_03'] = 'Text + Image';
		$_lang['ko']['ItemListingStyle_03'] = '아이템 이름 + 사진';
		
		$_lang['en']['ItemCol_Noitem'] = 'There is no item in this group';
		$_lang['ko']['ItemCol_Noitem'] = '현재 그룹내 아무 아이템이 없습니다';
		
		
		$_lang['en']['NextStep'] = 'Next Step';
		$_lang['ko']['NextStep'] = '다음단계';
		
		$_lang['en']['done'] = 'Done';
		$_lang['ko']['done'] = '완료';
		
		$_lang['en']['save_stay'] = 'Save Changes & Stay';
		$_lang['ko']['save_stay'] = '저장 후 남아있기';
		
		$_lang['en']['save'] = 'Save';
		$_lang['ko']['save'] = '저장';
		
		
		
		
		return $_lang;
	}
	public function burugo_address()
	{
		$_lang['en']['title'] = 'Add Delivery Address';
		$_lang['ko']['title'] = '배송주소 설정';
		
		$_lang['en']['currentAddr'] = 'Current Address';
		$_lang['ko']['currentAddr'] = '현재 저장된 주소';
		
		$_lang['en']['addNewAddr_BTN'] = 'ADD NEW DELIVERY ADDRESS';
		$_lang['ko']['addNewAddr_BTN'] = '신규 배송주소 추가';
		
		$_lang['en']['zipcode'] = 'Zip Code';
		$_lang['ko']['zipcode'] = '우편번호';
		
		$_lang['en']['states'] = 'States';
		$_lang['ko']['states'] = '주';
		
		$_lang['en']['states_dropdown_1'] = 'Select a State';
		$_lang['ko']['states_dropdown_1'] = '주를 선택해 주세요';
		
		
		
		
		
		$_lang['en']['city'] = 'City';
		$_lang['ko']['city'] = '주도시';
		
		$_lang['en']['streetaddress'] = 'Street Address';
		$_lang['ko']['streetaddress'] = '도로주소';
		
		$_lang['en']['streetaddress_addr'] = 'Additional Address';
		$_lang['ko']['streetaddress_addr'] = '추가주소';
		
		$_lang['en']['recipient_name'] = "Recipient's name";
		$_lang['ko']['recipient_name'] = '받는사람 주소';
		
		$_lang['en']['setdefault'] = 'Set Default';
		$_lang['ko']['setdefault'] = '메인주소로 설정';
		
		return $_lang;
	}
	public function burugo_order()
	{
		$_lang['en']['title'] = 'Your Orders';
		$_lang['ko']['title'] = '주문내역';
		return $_lang;
	}
	public function burugo_profile()
	{
		$_lang['en']['title'] = 'My Profile';
		$_lang['ko']['title'] = '나의 정보';
		
		$_lang['en']['picture'] = 'Picture';
		$_lang['ko']['picture'] = '사진';
		
		$_lang['en']['picture_desc'] = 'Upload/Edit your profile picture.';
		$_lang['ko']['picture_desc'] = '프로필 사진을 업로드 해주세요.';
		
		$_lang['en']['picture_uploadBTN'] = 'Upload New Profile Picture';
		$_lang['ko']['picture_uploadBTN'] = '사진 업로드';
		
		$_lang['en']['about_you'] = 'About You';
		$_lang['ko']['about_you'] = '개인정보';
		
		
		$_lang['en']['about_you_desc'] = 'Please tell us about yourself.';
		$_lang['ko']['about_you_desc'] = '주문시 필요한 간략한 신상정보를 알려주세요.';
		
		$_lang['en']['firstname'] = 'First Name';
		$_lang['ko']['firstname'] = '이름';
		
		$_lang['en']['lastname'] = 'Lasst Name';
		$_lang['ko']['lastname'] = '성';
		
		$_lang['en']['businessName'] = 'Business Name';
		$_lang['ko']['businessName'] = '회사/사업체명';

		$_lang['en']['password'] = 'Your Password';
		$_lang['ko']['password'] = '비밀번호';
		
		$_lang['en']['current_password'] = 'Current Password';
		$_lang['ko']['current_password'] = '비밀번호';
		
		$_lang['en']['new_password'] = 'New Password';
		$_lang['ko']['new_password'] = '새로운 비밀번호';
		
		$_lang['en']['new_password_confirm'] = 'Confirm New Password';
		$_lang['ko']['new_password_confirm'] = '새로운 비밀번호 재입력';
		
		
		$_lang['en']['password_desc'] = 'Do want to change current password?';
		$_lang['ko']['password_desc'] = '비밀번호 변경을 원하세요?';
		
		$_lang['en']['saveBTN'] = 'Save Changes';
		$_lang['ko']['saveBTN'] = '개인정보 저장하기';
		
		$_lang['en']['editProfile'] = 'Edit Profile';
		$_lang['ko']['editProfile'] = '프로필 수정';
		
		$_lang['en']['Myprofile_LMenu'] = 'My Profile';
		$_lang['ko']['Myprofile_LMenu'] = '나의 정보';
		
		$_lang['en']['Myprofile_Desc_LMenu'] = 'Edit your name, email, password, phone number and address';
		$_lang['ko']['Myprofile_Desc_LMenu'] = '이름, 이메일, 비밀번호, 전화번호, 주소변경 등';
		
		$_lang['en']['Settings_LMenu'] = 'Address';
		$_lang['ko']['Settings_LMenu'] = '배송주소 설정';
		
		$_lang['en']['Settings_Desc_LMenu'] = 'Set your default delivery location, Setting etc';
		$_lang['ko']['Settings_Desc_LMenu'] = '주문하시 배송될 주소 지정, 다수 주소 지정 가능';
		
		$_lang['en']['YourOrder_LMenu'] = 'Your Orders';
		$_lang['ko']['YourOrder_LMenu'] = '주문 내역';
		
		$_lang['en']['YourOrder_Desc_LMenu'] = 'Current order status and order history';
		$_lang['ko']['YourOrder_Desc_LMenu'] = '실시간 온라인 주문 조회 및 현재까지 주문 내역';
		
		
		
		return $_lang;
		
	}
	public function general_js()
	{
		$_lang = '';
		
		return $_lang;

		
	}
	public function top_menu()
	{
		
		$_lang['en']['burugoHome'] = 'Burugo Home';
		$_lang['ko']['burugoHome'] = '부르고홈 바로가기';
		
		$_lang['en']['myPage'] = 'My Page';
		$_lang['ko']['myPage'] = '마이페이지';
		
		$_lang['en']['myAcc'] = 'My Account';
		$_lang['ko']['myAcc'] = '나의계정';
		
		$_lang['en']['logout'] = 'Logout';
		$_lang['ko']['logout'] = '로그아웃';
		
		$_lang['en']['login'] = 'Log In';
		$_lang['ko']['login'] = '로그인';
		
		$_lang['en']['ceoPage'] = 'Business Management Site';
		$_lang['ko']['ceoPage'] = '비지니스 전용 싸이트';
		
		$_lang['en']['aboutUs'] = 'About Us';
		$_lang['ko']['aboutUs'] = '부르고란?';
		
		return $_lang;
	}
	
	
	
	public function ceo_menu()
	{
		
		$_lang['en']['management'] = 'Management Menu';
		$_lang['ko']['management'] = '비지니스 관리메뉴';
		
		$_lang['en']['dashboard'] = 'Dashboard';
		$_lang['ko']['dashboard'] = '나의 비지니스 현황';
		
		$_lang['en']['mybusiness'] = 'My Businesses';
		$_lang['ko']['mybusiness'] = '나의 비지니스 관리';
		
		$_lang['en']['registerNewBusiness'] = 'Register New Business';
		$_lang['ko']['registerNewBusiness'] = '신규 비지니스 등록';
		
		$_lang['en']['editProfile'] = 'Edit Profile';
		$_lang['ko']['editProfile'] = '프로필 수정';
		
		return $_lang;
	}
	
	public function order()
	{
		$_lang['en']['order_status_1'] = 'Pending Order';
		$_lang['ko']['order_status_1'] = '대기중 주문';
		$_lang['en']['order_status_desc_1'] = '';
		$_lang['ko']['order_status_desc_1'] = '';
		
		$_lang['en']['order_status_2'] = 'Order Received';
		$_lang['ko']['order_status_2'] = '주문 접수완료';
		$_lang['en']['order_status_desc_2'] = '';
		$_lang['ko']['order_status_desc_2'] = '';
		
		$_lang['en']['order_status_3'] = 'Processing Order';
		$_lang['ko']['order_status_3'] = '주문 처리중';
		$_lang['en']['order_status_desc_3'] = '';
		$_lang['ko']['order_status_desc_3'] = '';
		
		$_lang['en']['order_status_4'] = 'Out For Delivery';
		$_lang['ko']['order_status_4'] = '배송중';
		$_lang['en']['order_status_desc_4'] = '';
		$_lang['ko']['order_status_desc_4'] = '';
		
		$_lang['en']['order_status_5'] = 'Delivered';
		$_lang['ko']['order_status_5'] = '배송완료';
		$_lang['en']['order_status_desc_5'] = '';
		$_lang['ko']['order_status_desc_5'] = '';
		
		$_lang['en']['order_status_6'] = 'Order Denied';
		$_lang['ko']['order_status_6'] = '주문중지';
		$_lang['en']['order_status_desc_6'] = '';
		$_lang['ko']['order_status_desc_6'] = '';
		
		$_lang['en']['order_status_7'] = 'Order Canceled';
		$_lang['ko']['order_status_7'] = '취소완료';
		$_lang['en']['order_status_desc_7'] = '';
		$_lang['ko']['order_status_desc_7'] = '';
		
		$_lang['en']['order_status_8'] = 'Refunded';
		$_lang['ko']['order_status_8'] = '환불완료';
		$_lang['en']['order_status_desc_8'] = '';
		$_lang['ko']['order_status_desc_8'] = '';
		
		return $_lang;
		
	}
	public function burugo_home()
	{
		
		
		
		$_lang['en']['nextstep'] = 'Go to Next Step';
		$_lang['ko']['nextstep'] = '다음단계 바로가기';
		
		$_lang['en']['step_1_togo'] = 'Step 1 : To Go Order';
		$_lang['ko']['step_1_togo'] = '픽업 주문 : 1단계';
		$_lang['en']['step_2_togo'] = 'Step 2 : To Go Order';
		$_lang['ko']['step_2_togo'] = '픽업 주문 : 2단계';

		$_lang['en']['step_1_togo_desc'] = 'Pick items from below menu table and add them into cart first.';
		$_lang['ko']['step_1_togo_desc'] = '아래의 메뉴에서 원하시는 아이템을 선택하셔서 카트에 넣어주세요.';
		$_lang['en']['step_2_togo_desc'] = 'Pick the best time for picking your order and press checkout buttom.';
		$_lang['ko']['step_2_togo_desc'] = '픽업 가능한 시간을 선택하신 후 체크아웃 버튼을 눌러주세요.';
		
		$_lang['en']['step_1_delivery'] = 'Step 1 : Delivery Order';
		$_lang['ko']['step_1_delivery'] = '배달 주문 : 1단계';
		$_lang['en']['step_2_delivery'] = 'Step 2 : Delivery Order';
		$_lang['ko']['step_2_delivery'] = '배달 주문 : 2단계';

		$_lang['en']['step_1_delivery_desc'] = 'Pick items from below menu table and add them into cart first.';
		$_lang['ko']['step_1_delivery_desc'] = '아래의 메뉴에서 원하시는 아이템을 선택하셔서 카트에 넣어주세요.';
		$_lang['en']['step_2_delivery_desc'] = 'Let us know the destination address and press checkout buttom';
		$_lang['ko']['step_2_delivery_desc'] = '배달 받으실 주소를 넣어주시고 체크아웃 버튼을 눌러주세요.';

		
		
		return $_lang;
		
	}
	public function ceo_home()
	{
		$_lang['en']['scene_title_1'] = '편리한 서비스를 원하세요?';
		$_lang['ko']['scene_title_1'] = '편리한 서비스를 원하세요?';
		$_lang['en']['scene_desc_1'] = '부르고 비지니스 기능을 통해 귀사에서 홈페이지를 운영하듯이 편리한 수정,<br /> 보완 기능으로 사용할 수 있습니다.';
		$_lang['ko']['scene_desc_1'] = '부르고 비지니스 기능을 통해 귀사에서 홈페이지를 운영하듯이 편리한 수정,<br /> 보완 기능으로 사용할 수 있습니다.';
		$_lang['en']['scene_btn_1'] = 'Register Now';
		$_lang['ko']['scene_btn_1'] = '지금 가입하기';

		
		$_lang['en']['scene_title_2'] = '정확한 서비스를 원하세요?';
		$_lang['ko']['scene_title_2'] = '정확한 서비스를 원하세요?';
		$_lang['en']['scene_desc_2'] = '부르고는 비지니스 현황기능을 통해 실시간 예약/픽업/딜리버리 상태를 점검할 수 있으며<br /> 매달 리포트를 통해 통계상황을 체크하실 수 있습니다.';
		$_lang['ko']['scene_desc_2'] = '부르고는 비지니스 현황기능을 통해 실시간 예약/픽업/딜리버리 상태를 점검할 수 있으며<br /> 매달 리포트를 통해 통계상황을 체크하실 수 있습니다.';
		$_lang['en']['scene_btn_2'] = 'Register Now';
		$_lang['ko']['scene_btn_2'] = '지금 가입하기';
		
		$_lang['en']['scene_title_3'] = '빠른 서비스를 원하세요?';
		$_lang['ko']['scene_title_3'] = '빠른 서비스를 원하세요?';
		$_lang['en']['scene_desc_3'] = '부르고는 귀사의 비지니스를 부르고 명품 4가지 서비스를 통해 고객에게 빠르게<br /> 한발 더 다가설 수 있도록 하였습니다.';
		$_lang['ko']['scene_desc_3'] = '부르고는 귀사의 비지니스를 부르고 명품 4가지 서비스를 통해 고객에게 빠르게<br /> 한발 더 다가설 수 있도록 하였습니다.';
		$_lang['en']['scene_btn_3'] = 'Register Now';
		$_lang['ko']['scene_btn_3'] = '지금 가입하기';
		
		
		return $_lang;
		
	}
	
	public function ceo_dashboard()
	{
		$_lang['en']['dashboard'] = 'Dashboard';
		$_lang['ko']['dashboard'] = '비지니스 현황';
		
		$_lang['en']['orderstatus'] = 'Order Status';
		$_lang['ko']['orderstatus'] = '실시간 주문 상태';
		
		$_lang['en']['orderstatus_ordernumber'] = 'Order #';
		$_lang['ko']['orderstatus_ordernumber'] = '주문번호';
		
		$_lang['en']['orderstatus_customername'] = 'Customer Name';
		$_lang['ko']['orderstatus_customername'] = '고객이름';
		
		$_lang['en']['orderstatus_type'] = 'Type';
		$_lang['ko']['orderstatus_type'] = '주문종류';
		
		$_lang['en']['orderstatus_status'] = 'Status';
		$_lang['ko']['orderstatus_status'] = '상태';
		
		$_lang['en']['orderstatus_time'] = 'When';
		$_lang['ko']['orderstatus_time'] = '주문시간';
		
		$_lang['en']['localtime'] = 'Local Time';
		$_lang['ko']['localtime'] = '현재시간';
		
		$_lang['en']['order_type_1'] = 'Reservation';
		$_lang['ko']['order_type_1'] = '예약';
		$_lang['en']['order_type_2'] = 'Pick Up';
		$_lang['ko']['order_type_2'] = '픽업';
		$_lang['en']['order_type_3'] = 'Delivery';
		$_lang['ko']['order_type_3'] = '배달/배송';
		
		$_lang['en']['no_order_yet'] = 'No Orders Yet';
		$_lang['ko']['no_order_yet'] = '아직 들어온 주문이 없습니다';
		
		$_lang['en']['monthly_report'] = 'Monthly Report';
		$_lang['ko']['monthly_report'] = '매달 리포트';
		
		$_lang['en']['no_monthly_data_yet'] = 'No Data Yet';
		$_lang['ko']['no_monthly_data_yet'] = '데이터가 아직 없습니다';
		
		
		
		
		
		
		
		return $_lang;
	}
	public function login()
	{
		$_lang['en']['login'] = 'Log In';
		$_lang['ko']['login'] = '로그인';
		
		$_lang['en']['loading'] = 'Please wait, Loading...';
		$_lang['ko']['loading'] = '로그인 중입니다. 잠시만 기다려 주세요...';
		
		$_lang['en']['email'] = 'Email Address';
		$_lang['ko']['email'] = '이메일 주소';
		
		$_lang['en']['pass'] = 'Password';
		$_lang['ko']['pass'] = '비밀번호';
		
		$_lang['en']['register'] = 'Register';
		$_lang['ko']['register'] = '회원가입';
		
		
		$_lang['en']['passDontMatch1'] = 'Sorry, email and password do not match. Please try again.';
		$_lang['ko']['passDontMatch1'] = '이메일 혹은 비밀번호가 일치하지 않습니다. 한번 더 시도해 주세요.';
		
		$_lang['en']['passDontMatch2'] = 'Oops, Email/Password not match.';
		$_lang['ko']['passDontMatch2'] = '이메일 혹은 비밀번호가 일치하지 않습니다.';
		
		$_lang['en']['plzType'] = 'Welcome Back =)';
		$_lang['ko']['plzType'] = '로그인 정보를 입력 후 로그인 버튼을 눌러 주세요.';
		
		
		return $_lang;
	}
	public function register()
	{
		$_lang['en']['feature'] = 'Burugo Features';
		$_lang['ko']['feature'] = '부르고 회원특혜';
		$_lang['en']['feature_desc'] = 'You will get tons of benefits for your business!';
		$_lang['ko']['feature_desc'] = '부르고 회원이 되시면 누리시는 많은 특혜들을 살펴 보세요.';
		
		
		
		
		if(_SubDomain_ == 'ceo')
		{
			$_lang['en']['feature_1_h'] = '1. Fast and Convenient';
			$_lang['ko']['feature_1_h'] = '1. 빠르고 편안한 고객관리';
			$_lang['en']['feature_1_d'] = 'Realtime order/review management system';
			$_lang['ko']['feature_1_d'] = '실시간 주문관리, 판매통계 자료, 리뷰관리 등';
			$_lang['en']['feature_2_h'] = '2. Manage Simply';
			$_lang['ko']['feature_2_h'] = '2. 손쉬운 비지니스 수정/관리';
			$_lang['en']['feature_2_d'] = 'Business information, Pictures, Items, etc';
			$_lang['ko']['feature_2_d'] = '비지니스 정보, 사진, 메뉴 등';
			$_lang['en']['feature_3_h'] = '3. High Quality Customer Care';
			$_lang['ko']['feature_3_h'] = '3. 질좋고 빠른 고객서비스';
			$_lang['en']['feature_3_d'] = 'Q&A, Customer Care Center';
			$_lang['ko']['feature_3_d'] = '질문/답변, 고객관리센터';
		}
		
		
		if(_SubDomain_ == 'www')
		{
			$_lang['en']['feature_1_h'] = '1. Fast and Convenient';
			$_lang['ko']['feature_1_h'] = '1. 빠르고 정확한 예약';
			$_lang['en']['feature_1_d'] = 'Realtime order/review management system';
			$_lang['ko']['feature_1_d'] = '휴대폰과 컴퓨터로 빠르고 쉽게';
			$_lang['en']['feature_2_h'] = '2. Easy to order and confirm';
			$_lang['ko']['feature_2_h'] = '2. 손쉬운 주문과 확인';
			$_lang['en']['feature_2_d'] = 'Simple order process';
			$_lang['ko']['feature_2_d'] = '복잡하지 않고 누구나 사용가능';
			$_lang['en']['feature_3_h'] = '3. Trustable Delivery Service';
			$_lang['ko']['feature_3_h'] = '3. 믿을 수 있는 배달 서비스';
			$_lang['en']['feature_3_d'] = 'Nice and Fast delivery service';
			$_lang['ko']['feature_3_d'] = '배달 전직원 백그라운드 조사, 친절한 고객 서비스';
		}
		
		$_lang['en']['feature_join_h'] = 'Join Burugo Today!!';
		$_lang['ko']['feature_join_h'] = '지금 바로 부르고에 가입하세요!!';
		$_lang['en']['feature_join_d'] = 'We Gurantee That You Will Never Regret.';
		$_lang['ko']['feature_join_d'] = '부르고 회원 가입과 동시에 모든걸 누릴 수 있습니다.';
		
		$_lang['en']['CapH_1'] = 'Burugo Registration';
		$_lang['ko']['CapH_1'] = '부르고 회원가입';
		$_lang['en']['CapD_1'] = 'Before you become an owner a business in Burugo please give us some information about you.';
		$_lang['ko']['CapD_1'] = '부르고 회원이 되기전 기본적인 고객정보를 기입해 주세요.';
		
		$_lang['en']['Field_H_1'] = 'Your Login Information';
		$_lang['ko']['Field_H_1'] = '기본 로그인 정보';
		
		$_lang['en']['Field_Login'] = 'Login ID (Email Address)';
		$_lang['ko']['Field_Login'] = '로그인 아이디 (이메일 주소)';
		
		$_lang['en']['Field_Pass'] = 'Password';
		$_lang['ko']['Field_Pass'] = '비밀번호';
		
		$_lang['en']['Field_PassC'] = 'Confirm Password';
		$_lang['ko']['Field_PassC'] = '비밀번호 재확인';
		
		$_lang['en']['Field_H_2'] = 'About You';
		$_lang['ko']['Field_H_2'] = '가입자 기본 정보';
		
		$_lang['en']['Field_FName'] = 'First Name';
		$_lang['ko']['Field_FName'] = '이름';
		
		
		$_lang['en']['Field_LName'] = 'Last Name';
		$_lang['ko']['Field_LName'] = '성';
		
		$_lang['en']['Field_BName'] = 'Business Name';
		$_lang['ko']['Field_BName'] = '사업체명/대행서비스 이름';
		
		$_lang['en']['Field_HowHear'] = 'How did you hear of us?';
		$_lang['ko']['Field_HowHear'] = '부르고에 가입하는 계기는?';
		
		$_lang['en']['Field_HowHear_0'] = 'Please Select ...';
		$_lang['ko']['Field_HowHear_0'] = '선택해 주세요 ...';
		
		$_lang['en']['Field_HowHear_1'] = 'From TV Advertisement';
		$_lang['ko']['Field_HowHear_1'] = 'TV 광고를 통해서';
		
		$_lang['en']['Field_HowHear_2'] = 'From Search Engine AD';
		$_lang['ko']['Field_HowHear_2'] = '검색엔진 광고를 통해서';
		
		$_lang['en']['Field_HowHear_3'] = 'From Search Engine(Google, Yahoo, Bing, etc))';
		$_lang['ko']['Field_HowHear_3'] = '검색엔진을 통해서(네이버, 구글, 야후, 기타)';
		
		$_lang['en']['Field_HowHear_4'] = 'From FOOD Magazines';
		$_lang['ko']['Field_HowHear_4'] = '음식관련 잡지를 통해서';
		
		$_lang['en']['Field_HowHear_5'] = 'From Friends';
		$_lang['ko']['Field_HowHear_5'] = '친구를 통해서';
		
		$_lang['en']['Field_HowHear_6'] = 'From Colleagues';
		$_lang['ko']['Field_HowHear_6'] = '직장동료를 통해서';
		
		$_lang['en']['Field_HowHear_7'] = "I don't know, I came from Mars";
		$_lang['ko']['Field_HowHear_7'] = '몰라요. 전 혜성에서 온 사람입니다.';
		
		
		$_lang['en']['Field_Captcha'] = 'Enter the code below';
		$_lang['ko']['Field_Captcha'] = '아래 알파벳을 입력해 주세요.';
		
		$_lang['en']['Field_SendEmail'] = 'We will send you a confirmation email, please make sure that it is valid address.';
		$_lang['ko']['Field_SendEmail'] = '이메일 주소 확인을 위해, 가입인증 메일을 보내오니, 실제 사용중이신 이메일을 넣어 주세요.';
		
		$_lang['en']['Field_AgreeAll'] = 'By creating an account, you are agreeing that you have read and agree <a href="">Privacy Policy</a> and <a href="">Burugo User Agreement</a>.';
		$_lang['ko']['Field_AgreeAll'] = '고객 가입과 동시에 위 약관에 동의 합니다.';
		
		$_lang['en']['termsAndCondition'] = "
			<h2>Privacy Agreement</h2>
			<p>burugo, Inc. ('burugo') collects certain information through its websites and mobile sites, located at www.burugo.com. Your privacy is important to us and this Privacy Policy lays out our policies and procedures surrounding the collection and handling of such information. This Privacy Policy applies only to the Services. It does not apply to any restaurant sites, other third party services linked to burugo Services or offline activities related to burugo services.</p>
			<h3>1. Information burugo Collects</h3>
				<p>burugo may collect the following information from users of our Services: first name, last name, street address, city, state, zip code, cross streets, phone number, e-mail address, Services-specific display name, GPS location, electronic signature and credit card information (collectively, 'Personally Identifiable Information' or 'PII'). burugo is not intended for use by children under the age of 13 and burugo does not knowingly collect PII from children under the age of 13. Use of Sites services requires that you register and/or create an account ('Account'). In addition to the PII set forth above, burugo may collect information regarding Account holders' past burugo orders, favorite restaurants, customer service inquiries, service/restaurant reviews and certain social networking preferences relating to the Sites (e.g. pages or entities you like, recommend or follow).</p>
				
				<p>In addition, burugo may collect information regarding burugo account holders' current and past burugo orders, gratuity amounts, favorite restaurants, customer service inquiries, service/restaurant reviews and certain social networking preferences.</p>
				
				<p>burugo also uses web analytics software to track and analyze traffic for its Services in connection with burugo's advertising and promotion of burugo services. burugo also aggregates certain information collected by the Applications including, but not limited to, certain order data, gratuity information, delivery locations, delivery driver mileage, and delivery driver location. burugo may publish these statistics or share them with third parties without including PII.</p>
				
				<p>burugo may collect additional PII in connection with The Daily Grub blog submissions including professional title, business/personal website, social networking handle/username and the author's photograph.
			
			<h3>2. burugo's Use Of Collected Information</h3>
				burugo uses PII to create users' burugo accounts, to communicate with users (directly and through restaurants and delivery drivers) about burugo services, to offer users additional services, promotions and special offers and to charge for purchases and gratuities made through us. Users may opt to allow us to store certain PII used to create users' burugo accounts, including, but not limited to, credit card information. burugo uses certain stored PII to customize future order processing for you. You may request that burugo cease storing certain PII at any time, but you might not be able to take advantage of certain customized features. Users may affirmatively opt-out of receiving promotional communications from burugo by visiting http://www.burugo.com and providing burugo with their e-mail address via the opt-out link. burugo may also use PII to enforce burugo terms of use and service.
				
				burugo uses PII submitted by authors of The Daily Grub blog content by publishing that information on The Daily Grub, and as otherwise agreed by burugo and submitting author. By submitting PII to burugo in connection with Daily Grub blog content, the author agrees to burugo's publication of that PII, and any other PII.
				
				burugo uses cookies to remember users on the Sites and to enhance users' experience on the Sites. For example, when users with burugo accounts return to the Sites, cookies identify those users and allow the Sites to provide certain user-specific information such as burugo account information, past orders, favorite restaurants and user restaurant reviews.
				
				burugo does not sell the information it collects through the Services to third parties. burugo shares collected PII to third-party vendors and service providers with whom burugo works to provide application programming interfaces ('APIs') and other functions for the Services in connection with the delivery of burugo services. In addition, burugo shares users' burugo order content, special order instructions, first and last name, street address, e-mail address, telephone number and gratuity amounts with restaurants where users' orders are placed and delivery drivers, to the extent necessary to process and deliver those orders. burugo may also disclose PII to third parties such as attorneys, collection agencies, tribunals or law enforcement authorities pursuant to valid requests in connection with alleged violations of burugo terms of use and service or other alleged contract violations, infringement or similar harm to persons or property. 
		
			<h3>3. burugo's Protection of PII</h3>
				<p>burugo uses reasonable security measures equal to or exceeding industry standard to protect PII from unauthorized access, destruction, use, modification and disclosure. Unfortunately, even with these measures,  burugo cannot guarantee the security of PII. By using the Services, you acknowledge and agree that burugo makes no such guarantee, and that you use the Services at your own risk.</p>
			<h3>4. Accessing and Correcting Your PII</h3>
				<p>Registered burugo account holders can access and change their own PII using the 'Edit' function on the our website. If you have questions regarding burugo's use or collection of your PII, please contact burugo's privacy officer at: burugoceo@gmail.com.</p>
			<h3>5. Privacy Policy Amendments</h3>
				<p>burugomay change this Privacy Policy at any time by posting a new version on this page or on a successor page. The new version will become effective on the posting date, which will be listed at the top of the page as the effective date.</p>
		
		<h2>Terms of Use</h2>
			<p>burugo, Inc. ('burugo') operates its website and mobile site, located at www.burugo.com. Please read the following Terms of Use carefully before using burugo. For inquiries relating to any food orders, see our Return Policy. For information on advertising or promoting your restaurant through burugo, visit burugo Sign-up Form for Restaurants. </p>
		
			<h3>1. Applicability & Acceptance of These Terms of Use</h3>
				<p>By viewing, using, accessing, browsing, or submitting any content or material on the Sites, you agree to these Terms of Use as a binding legal agreement between you and burugo, without limitation or qualification. The term 'you' or 'You' shall refer to any person or entity who views, uses, accesses, browses or submits any content or material to the Sites.</p>
		
				<p>If you do not agree to these Terms of Use, then you may not use the Sites. Burugo reserves the right to modify these Terms of Use at any time without prior notice.</p>
		
				<p>You agree that each visit you make to the Sites shall be subject to the then-current Terms of Use, and continued use of the Sites now or following modifications in these Terms of Use confirms that you have read, accepted, and agreed to be bound by such modifications.</p>
		
			<h3>User License</h3>
				<p>1. burugo grants you permission (which may be revoked at any time for any reason or no reason) to view the Sites and to download, email, share via social networking or print individual pages from the Sites in accordance with these Terms of Use and solely for your own personal, non-commercial use, provided you do not remove any trademark, copyright or other notice contained on such pages. No other use is permitted. You may not, for example, incorporate the information, content, or other material in any database, compilation, archive or cache. You may not modify, copy, distribute, re-publish, transmit, display, perform, reproduce, publish, reuse, resell, license, create derivative works from, transfer, or sell any information, content, material, software, products or services obtained from the Sites, except as specifically noted above. Except as specifically authorized by burugo,  you may not deep-link to the Sites for any purpose or access the Sites manually or with any robot, spider, web crawler, extraction software, automated process or device to scrape, copy, or monitor any portion of the Sites or any information, content, or material on the Sites. burugo reserves all of its statutory and common law rights against any person or entity who violates this paragraph. You may not link or frame to any pages of the Sites or any content contained therein, whether in whole or in part, without prior written consent from burugo. You may like or follow burugo or share links to the Sites via social networking technology referenced on the Sites. Any rights not expressly granted herein are reserved.<p>
				<p>2. User Conduct. You agree that your use of the Sites and/or services on the Sites is subject to all applicable local, state and federal laws and regulations. You also agree:</p>
					- to comply with US law and local laws or rules regarding online conduct and acceptable material;<br />
					- not to use the Sites or their services or submit content to the Sites if you are under the age of 13;<br />
					- not to use the Sites to purchase alcohol unless you and the alcohol recipient are 21 or older and present a valid photo identification(s) verifying your age at the time of alcohol delivery;<br />
					- not to access the Sites or services using a third-party's account/registration without the express consent of the account holder;<br />
					- not to use the Sites for illegal purposes;<br />
					- not to commit any acts of infringement on the Sites or with respect to content on the Sites;<br />
					- not to use the Sites to engage in commercial activities apart from sanctioned use of burugo services;<br />
					- not to copy any content, including, but not limited to restaurant menu content and third-party reviews, for republication in print or online;<br />
					- not to create restaurant reviews or blog entries for or with any commercial or other purpose or intent that does not in good faith comport with the purpose or spirit of the Sites;<br />
					- not to attempt to gain unauthorized access to other computer systems from or through the Sites;<br />
					- not to interfere with another person's use and enjoyment of the Sites or another entity's use and enjoyment of the Sites;<br />
					- not to upload or transmit viruses or other harmful, disruptive or destructive files; and/or<br />
					- not to disrupt, interfere with, or otherwise harm or violate the security of the Sites, or any services, system resources, accounts, passwords, servers or networks connected to or accessible through the Sites or affiliated or linked sites (including those of our restaurant partners).<br />
				<p>3. Harm from Commercial Use. You agree that the consequences of commercial use or re-publication of content or information from the Sites may be so serious and incalculable that monetary compensation may not be a sufficient or appropriate remedy and that burugo will be entitled to temporary and permanent injunctive relief to prohibit such use.
			<h2>3. Site Content </h3>
				<p>1. Nature of User Material. Some of the services offered by burugo on the Sites allow you and others to post, transmit, display, publish, distribute, or otherwise submit public user generated material including, but not limited to, restaurant reviews and blog entries, to the Sites (collectively, 'Submissions'). You agree not to create any Submission that: </p>
					- contains vulgar, profane, abusive, hateful, or sexually explicit language, epithets or slurs, text in poor taste, inflammatory attacks of a personal, sexual, racial or religious nature, or expressions of bigotry, racism, discrimination or hate;<br />
					- is defamatory, threatening, disparaging, inflammatory, false, misleading, deceptive, fraudulent, inaccurate, or unfair, contains gross exaggeration or unsubstantiated claims, violates the privacy rights or right of publicity of any third party, is unreasonably harmful or offensive to any individual or community, contains any actionable statement, or tends to mislead or reflect unfairly on any other person, business or entity;<br />
					- unfairly interferes with any third party's uninterrupted use and enjoyment of the Sites;<br />
					- advertises, disparages, promotes or offers to trade any goods or services in any manner that does not comport with the purpose or spirit of the Sites, including, but not limited to, negative reviews posted by competing restaurants or allegations of health code violations;<br />
					- is intended primarily to promote a cause or movement, whether political, religious or other;<br />
					- contains copyrighted content (copyrighted articles, illustrations, images, text, or other content) without the express permission of the owner of the copyrights in the content;<br />
					- constitutes, promotes or encourages illegal acts, the violation of any right of any individual or entity, the violation of any local, state, national or international law, rule, guideline or regulation, or otherwise creates liability;<br />
					- discloses any personal identifying information relating to or images of a minor without consent of a parent, guardian or educational supervisor;<br />
					- infringes any copyright, trademark, patent, trade secret, or other intellectual property right;<br />
					- contains viruses or other harmful, disruptive or destructive files;<br />
					- harms or is inappropriate for minors to view;<br />
					- links to any commercial or other website; and/or<br />
					- is not otherwise in compliance with these Terms of Use.<br />
		
				<p>2. User Representations and Warranties. Each time you provide a Submission to the Sites, you represent and warrant that you have the right to provide such Submission, which means:</p>
					- you are the author of the Submission, or<br />
					- the Submission is not protected by copyright law, or<br />
					- you have express permission from the copyright owner to use the Submission in connection with the Sites; and<br />
					- you have the right to grant burugo the license set out in these Terms of Use;<br />
					- for restaurant review Submission(s), you have had first-hand experience with the subject restaurant; and<br />
					- your use of the Sites and Submission(s) do not violate these Terms of Use.<br />
					
				<p>3. User License Grant to burugo. You grant burugo, its affiliates, and related entities a royalty-free, perpetual, irrevocable, non-exclusive right and license to use, copy, modify, display, archive, store, publish, transmit, perform, distribute, reproduce and create derivative works from all Submissions you provide to burugo in any form, media, software or technology of any kind now existing or developed in the future. Without limiting the generality of the previous sentence, you authorize burugo to include the Submissions you provide in a searchable format that may be accessed by users of the Sites. You also grant burugo and its and related entities the right to use any Personally Identifiable Information (as that term is defined in burugo's Privacy Policy) included with any Submission in connection with the use, reproduction or distribution of such Submission. You also grant burugo the right to use the Submission and any facts, ideas, concepts, know-how or techniques ('Information') contained in any Submission or communication you send to burugo for any purpose whatsoever, including but not limited to, developing, manufacturing, promoting and/or marketing products and services. You grant all rights described in this paragraph in consideration of your use of the Sites, without compensation of any sort to you. burugo does not claim ownership of Submissions.</p>
				<p>4. Disclaimer of Responsibility for Material. Submissions are not endorsed by burugo,  and do not represent the views of burugo or its parents, subsidiaries and affiliates, agents, officers or directors. You acknowledge and agree that burugo does not control all Submissions, and disclaims any responsibility for such Submissions. burugo specifically disclaims any duty, obligation, or responsibility, to review, screen, refuse to post, remove, or edit any Submissions. In addition, burugo does not represent or warrant that any other content or information accessible via the Sites is accurate, complete, reliable, current or error-free including the menus, pricing, hours of operation or parking accessibility available from its partner restaurants. Price, description, menu content, product/service availability, parking accessibility and restaurant information are subject to change without notice. Burugo assumes no responsibility or liability for any errors or omissions in the content of the Sites. While we does not charge you for using its services and does not add any additional charges (other than sales taxes and delivery) to the menu items it receives from its participating restaurants,  we offers some restaurant menus via other services. The price shown on the menu may include a markup by those services. </p>
				<p>5. Review & Removal of Material. burugo reserves the right (but disclaims any duty, obligation or responsibility) to review, screen, refuse to post, remove in their entirety, or edit (at any time and without prior notice) any Submissions that we believes, in its absolute and sole discretion, may violate Sections 2(b), 3(a), or 3(b) above. You may contact us at burugoceo@gmail.com or burugo at burugo, Inc., 2855 rolling pin lane #211, Suwanee, ga 30024 to request removal of a Submission. However, burugodisclaims any duty, obligation or responsibility to comply with such request except as specifically outlined in this paragraph. burugo also reserves the right (but disclaims any duty, obligation, or responsibility) to refuse to post, remove in their entirety, or edit (at any time and without prior notice) any Submissions on the Sites for any reason or no reason whatsoever, in its absolute and sole discretion. The Digital Millennium Copyright Act of 1998 (the 'DMCA') provides recourse for copyright owners who believe that material appearing on the Internet infringes their rights under US copyright law. If you believe in good faith that Submissions posted by the Sites infringe your copyright, you (or your agent) may send burugo a notice requesting that the Submission(s) be removed from the Site(s), or access to it be blocked. The notice must include the following information: (a) a physical or electronic signature of a person authorized to act on behalf of the owner of an exclusive right that is allegedly infringed; (b) identification of the copyrighted work claimed to have been infringed (or if multiple copyrighted works located on the Sites are covered by a single notification, a representative list of such works); (c) identification of the material that is claimed to be infringing or the subject of infringing activity, and information reasonably sufficient to allow burugo to locate the Submission(s) Sites; (d) the name, address, telephone number and email address (if available) of the complaining party; (e) a statement that the complaining party has a good faith belief that use of the Submission in the manner complained of is not authorized by the copyright owner, its agent or the law; and (f) a statement that the information in the notification is accurate and, under penalty of perjury, that the complaining party is authorized to act on behalf of the owner of an exclusive right that is allegedly infringed. If you believe in good faith that a notice of copyright infringement has been wrongly filed against you, the DMCA permits you to send us a counter-notice. Notices and counter-notices must meet the then-current statutory requirements imposed by the DMCA; see http://www.loc.gov/copyright for details. Notices and counter-notices with respect to the Sites should be sent to burugo, Inc., 2855 Rolling Pin Lane #211, Suwanee, GA 30024. burugo suggests that you consult your legal advisor before filing a notice or counter-notice. Also, be aware that there can be penalties for false claims under the DMCA. We reserve the right to terminate the account of any user who is a copyright infringer. </p>
				<p>6. Proprietary Rights. You acknowledge and agree that the Sites contain proprietary information and content that is protected by intellectual property and other laws, and may not be used except as provided in these Terms of Use without advance, written permission of burugo. All Sites design, text, graphics, interfaces, and images (and the selection and arrangements thereof), and software, hypertext markup language ('HTML'), scripts, active server pages, and other content and software used in the Sites are reserved. </p>
			<h3>4. Termination and Modifications to the Sites</h3>
				<p>burugo reserves the right, in its sole and absolute discretion, to modify, suspend, or discontinue at any time, with or without notice, the Sites and/or services offered on or through the Sites (or any part thereof), including but not limited to the Sites' features, look and feel, and functional elements and related services.</p>
			<h3>5. Indemnity</h3>
				<p>You agree to indemnify and hold burugo, its parents, subsidiaries and affiliates, agents, officers, directors, or other employees harmless from any claim, demand, or damage (whether direct, indirect, or consequential), including reasonable attorneys' fees, made by anyone in connection with your use of the Sites, with your Submissions, with any alleged infringement of intellectual property or other right of any person or entity relating to the Sites, your violation of these Terms of Use, and any other acts or omissions relating to the Sites.</p>
			<h3>6. Disclaimer of Warranties</h3>
				<p>THE INFORMATION, CONTENT, PRODUCTS, SERVICES, AND MATERIALS AVAILABLE THROUGH THE SITES (WHETHER PROVIDED BY BURUGO, YOU, OTHER USERS OR OTHER AFFILIATES/THIRD PARTIES), INCLUDING WITHOUT LIMITATION, FOOD/BEVERAGE ORDERS, SUBMISSIONS, TEXT, PHOTOS, GRAPHICS, AUDIO FILES, VIDEO, AND LINKS, ARE PROVIDED 'AS IS' AND 'AS AVAILABLE' WITHOUT WARRANTIES OF ANY KIND, EITHER EXPRESS OR IMPLIED.</p>
		
				<p>TO THE MAXIMUM EXTENT PERMITTED BY LAW, BURUGO DISCLAIMS ALL REPRESENTATIONS AND WARRANTIES, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, TITLE, NONINFRINGEMENT, FREEDOM FROM COMPUTER VIRUS, AND IMPLIED WARRANTIES ARISING FROM COURSE OF DEALING OR COURSE OF PERFORMANCE.</p>
			<h3>7. Limitation of Liability</h3>
				<p>IN NO EVENT SHALL BURUGO BE LIABLE TO YOU FOR ANY DIRECT, INDIRECT, SPECIAL, PUNITIVE, INCIDENTAL, EXEMPLARY OR CONSEQUENTIAL DAMAGES, OR ANY LOSS OR DAMAGES WHATSOEVER (EVEN IF GRUBHUB HAS BEEN PREVIOUSLY ADVISED OF THE POSSIBILITY OF SUCH DAMAGES), WHETHER IN AN ACTION UNDER CONTRACT, NEGLIGENCE, OR ANY OTHER THEORY, IN ANY MANNER ARISING OUT OF OR IN CONNECTION WITH THE USE, INABILITY TO USE, PERFORMANCE OF, OR SERVICES PROVIDED ON OR THROUGH THE SITES. BURUGO ASSUMES NO RESPONSIBILITY AND SHALL NOT BE LIABLE FOR ANY DAMAGES TO, OR VIRUSES THAT MAY INFECT, YOUR COMPUTER EQUIPMENT OR OTHER PROPERTY ON ACCOUNT OF YOUR ACCESS TO, USE OF, BROWSING OF, OR DOWNLOADING OF ANY MATERIAL FROM THE SITES. BURUGO ASSUMES NO RESPONSIBILITY OR LIABILITY IN ANY MANNER ARISING OUT OF OR IN CONNECTION WITH ANY INFORMATION, CONTENT, PRODUCTS, SERVICES, OR MATERIAL AVAILABLE ON OR THROUGH THE SITES, AS WELL AS ANY THIRD PARTY WEBSITE PAGES OR ADDITIONAL WEBSITES LINKED TO THIS SITE, FOR ANY ERROR, DEFAMATION, LIBEL, SLANDER, OMISSION, FALSEHOOD, OBSCENITY, PORNOGRAPHY, PROFANITY, DANGER, INACCURACY CONTAINED THEREIN OR HARM TO PERSON OR PROPERTY CAUSED THEREBY. THESE LIMITATIONS SHALL APPLY NOTWITHSTANDING ANY FAILURE OF ESSENTIAL PURPOSE OF ANY LIMITED REMEDY. BECAUSE SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OR LIMITATION OF LIABILITY FOR CONSEQUENTIAL OR INCIDENTAL DAMAGES, THE ABOVE LIMITATIONS MAY NOT APPLY TO YOU. IN NO EVENT SHALL BURUGO'S TOTAL LIABILITY TO YOU FOR ALL DAMAGES, LOSSES AND CAUSES OF ACTION, WHETHER IN CONTRACT, TORT (INCLUDING BUT NOT LIMITED TO, NEGLIGENCE) OR OTHERWISE, EXCEED (A) THE AMOUNT PAID BY YOU TO GRUBHUB OR A RESTAURANT AFFILIATE, IF ANY, OR (B) $100 (WHICHEVER IS LESS).</p>
		
				<p>YOU AND BURUGO AGREE THAT THE WARRANTY DISCLAIMERS AND LIMITATIONS OF LIABILITY IN THESE TERMS OF USE ARE MATERIAL, BARGAINED-FOR BASES OF THIS AGREEMENT, AND THAT THEY HAVE BEEN TAKEN INTO ACCOUNT IN DETERMINING THE CONSIDERATION TO BE GIVENBY EACH PARTY UNDER THIS AGREEMENT AND IN THE DECISION BY EACH PARTY TO ENTER INTO THIS AGREEMENT. YOU AND BURUGO AGREE THAT THE WARRANTY DISCLAIMERS AND LIMITATIONS OF LIABILITY IN THESE TERMS OF USE ARE FAIR AND REASONABLE.</p>
		
				<p>IF YOU ARE DISSATISFIED WITH THE SITE OR DO NOT AGREE TO ANY PROVISIONS OF THESE TERMS OF USE, YOUR SOLE AND EXCLUSIVE REMEDY IS TO DISCONTINUE USING THE SITE, EXCEPT AS MAY BE PROVIDED FOR IN THIS SECTION 7.</p>
			<h3>8. Your account, password, and security</h3>
				<p>Use of Sites services requires that you register and/or create an account ('Account') or use the Sites as a guest. To register and create an Account, you must select an account designation and password and provide certain personal information. In consideration of the use of the Sites' services, you agree to: (a) provide true, accurate, current and complete information about yourself as prompted by the registration form, and (b) maintain and promptly update the personal information you provide to keep it true, accurate, current and complete. If you provide any information that is untrue, inaccurate, not current or incomplete, or burugo has reasonable grounds to suspect that such information is untrue, inaccurate, not current or incomplete, burugo has the right to refuse any and all current or future use of the Sites (or any portion thereof).</p>
		
				<p>You are responsible for maintaining the confidentiality and security of your Account and password, and you are fully responsible for all activities that occur under your password or Account, and for any other actions taken in connection with the Account or password. You agree to (a) immediately notify burugo of any known or suspected unauthorized use(s) of your password or Account, or any known or suspected breach of security, including loss, theft, or unauthorized disclosure of your password or credit card information; and (b) ensure that you exit from your Account at the end of each session. burugo will not be liable for any injury, loss or damage of any kind arising from or relating to your failure to comply with (a) and (b) or for any acts or omissions by you or someone else using your Account and/or password.</p>
			<h3>9. Links</h3>
				<p>As a courtesy to you, the Sites may offer links to other websites. Some of these websites may be affiliated with burugo while others are not. burugo is not responsible for the contents of any website pages created and maintained by organizations independent of burugo. Visiting any such third-party website pages is at your own risk. burugo has no control of these third-party website pages, nor can it guarantee the accuracy, completeness, or timeliness of information in third-party website pages. Your use of such information is voluntary, and your reliance on such information should be made only after independent review. References to commercial products or services within any such third-party website pages do not constitute or imply an endorsement by burugo. By using the Sites you acknowledge that burugo is responsible neither for the availability of, nor the content located on or through any third-party website pages.</p>
			<h3>10. Trademarks</h3>
				<p>Burugo job®, burugo helper®, burugo friend®, burugo social®, Etreebus®, burugo.com Powered By burugo™ (word and design) are burugo’s trademarks. Such trademarks and other marks, logos, and names of burugo or the Sites, used on or in connection with the Sites may not be used in connection with any product or service that is not under burugo's ownership or control. Furthermore, such trademarks may not be used in any manner that is likely to cause confusion among customers or in any manner that disparages or discredits burugo. All other trademarks not owned by burugo (or its affiliates) that appear on the Sites are the property of their respective owners, who may or may not be affiliated with, connected to, or sponsored by burugo or its affiliates.</p>
			<h3>11. Consideration</h3>
				<p>You acknowledge that these Terms of Use are supported by reasonable and valuable consideration, the receipt and adequacy of which are hereby acknowledged. Without limiting the foregoing, you acknowledge that such consideration includes, without limitation, your use of the Sites and receipt or use of data, content, products and/or services through the Sites, the possibility of our review, use or display of your Submission(s), and the possibility of publicity and promotion from our review, use or display of your user-generated content.</p>
			<h3>12. Jurisdiction, Applicable Law, and Limitations</h3>
				<p>This Site is created and controlled by burugo in the State of Georgia, U.S.A. You agree that these Terms of Use will be governed by and construed in accordance with the laws of the United States of America and the State of Georgia, without regard to its conflicts of law provisions. Use of the Sites is unauthorized in any jurisdiction that does not give effect to all provisions of these Terms of Use. GrubHub makes no claims or assurances that the Sites are appropriate or may be downloaded outside of the United States. You agree that all legal proceedings arising out of or in connection with these Terms of Use, or services available on or through the Sites must be filed in a federal or state court located in Atlanta, Georgia, within one year of the time in which the events giving rise to such claim began, or your claim will be forever waived and barred. You expressly submit to the exclusive jurisdiction of said courts and consent to extraterritorial service of process.</p>
			<h3>General</h3>
				<p>1. Enforceability. If any portion of these Terms of Use is found to be void, invalid or otherwise unenforceable, then that portion shall be deemed to be superseded by a valid, enforceable provision that matches the intent of the original provision as closely as possible. The remainder of these Terms of Use shall continue to be enforceable and valid according to terms contained herein.</p>
				<p>2. Entire Agreement. Except as expressly provided in a particular 'Legal & Privacy' posting or other notice on particular pages of the Sites, these Terms of Use, which hereby incorporate by reference the terms of burugo's Privacy Policy, constitute the entire agreement between you and burugo, superseding all prior agreements regarding the Sites.</p>
				<p>3. No Waiver. The failure of burugo to exercise or enforce any right or provision of the Terms of Use shall not constitute a waiver of said right or provision. Neither party hereto shall be deemed to be in default of any provision of the Terms of Use or for failure in performance resulting from acts or events beyond the reasonable control of such party and arising without its fault or negligence, including, but not be limited to, acts of God, civil or military authority, interruption of electric or telecommunication services, civil disturbances, acts of war or terrorists, strikes, fires, floods or other catastrophes.</p>
				<p>4. Headings & Construction. The section titles in the Terms of Use are for your convenience only and carry no contractual or legal effect whatsoever. The language in these Terms of Use shall be interpreted in accordance with its fair meaning and shall not be strictly interpreted for or against either party.</p>
				<p>5. Contact burugo. For purposes of providing notice of cancellation or termination, contact us at webmaster@burugo.com or burugo at burugo, Inc., 2855 Rolling Pin Lane #211, Suwanee, GA 30024</p>
		
		<p>Copyright © 2013 burugo, Inc. All Rights Reserved.</p>
		
		<h2>burugo Sign-Up Form for Restaurants</h2>
			<p>Select one (1) burugo service package for the restaurant listed on the burugo sign-up form ('Restaurant'). 'Order' shall mean the dollar amount of the food and beverage subtotal, including delivery fee, if any, for each online Restaurant order placed using burugo. For telephone orders, the fee charged shall be equal to Restaurant's average fee per online order. In addition to service package amount, Restaurant agrees to pay all credit card processing fees associated with Order</p>
			<p>Restaurant, as defined above, by and through the undersigned authorized agent, agrees as follows:</p>
			<p>1. Either Party may terminate this Agreement for any reason upon notice to the other party. </p>
			<p>2. The term of this Agreement shall begin when the restaurant is 'live' on burugo Website and terminate on the effective date of any termination.</p>
			<p>3. Party owing payments shall remit remaining payments to the other Party within 30 days following the term of this Agreement.</p>
			<p>4. burugo shall be an independent contractor of Restaurant during the term of this Agreement.</p>
			<p>5. Burugo shall provide certain services to Restaurant consistent with burugo’s business practices and at burugo's sole discretion including advertising, sales and revenue collection (the 'Services').</p>
			<p>6. Restaurant shall provide notice to all Restaurant staff that telephone conversations with burugo made in connection with the Services or this Agreement may be recorded.</p>
			<p>7. During the term of the Agreement, Restaurant shall make all payments due and owing to burugo.</p>
			<p>8. Restaurant must provide an accurate copy of its current in-store Restaurant menu ('Menu') within a reasonable time before the Agreement term begins.</p>
			<p>9. Restaurant must notify burugo in writing of any changes to the Menu at least seven (7) business days before such changes go into effect.</p>
			<p>10. burugo shall compute any sales, use, privilege, gross receipts, restaurant, excise or other tax due in connection with the sale of food or drink (and delivery fee, if applicable) by my Restaurant through burugo('Sales Tax'). burugo shall collect Sales Tax on behalf of Restaurant. Burugo shall be responsible for (a) verifying that the collected, tendered Sales Tax amount is correct, (b) filing all required Sales Tax returns and associated forms and (c) remitting all required Sales Tax to the appropriate taxing authorities.</p>
			<p>11. Compliance with any applicable laws, taxes or tariffs related to internet electronic commerce; delivery service and parking accessibility, if any; compliance with appropriate health codes with respect to preparation of food and beverages; and all matters concerning quality and condition of the food and beverages.</p>
			<p>12. burugo does not warrant that the functions of burugo Website will meet Restaurant expectations of website traffic or resulting business or that the operation of burugo Website will be uninterrupted and/or error-free. Restaurant shall be responsible for all Losses associated with occasional downtime of burugo Website due to line interruptions and/or other instances beyond burugo's control.</p>
			<p>13. This Agreement will be governed by and construed in accordance with the laws of the State of Georgia, without giving effect to the conflict of law principles thereof. All disputes related to this Agreement will be submitted to the exclusive jurisdiction and venue of state or federal courts located in Atlanta, Georgia, which the parties agree is the most appropriate and convenient for the resolution of disputes related to this Agreement.</p>
			<p>14. burugo's Terms of Use, which are subject to change, are incorporated herein by reference and Restaurant agrees to be bound by said terms.</p>
			<p>15. Restaurant grants burugoan unlimited license, solely for the purposes expressly set forth in this Agreement, to use any information or content related to the Restaurant ('Restaurant Content'), in connection with the Services, offered or displayed through any form of media.</p>
			<p>16. Restaurant will indemnify, defend and hold harmless burugo, its business units, and each of burugo's respective officers, directors, shareholders, employees, representatives, successors and assigns, from and against all Losses, to the extent such Losses are related to: (a) any development, operation or maintenance of the burugo Website done at Restaurant's direction or request; (b) any claim that Restaurant Content provided by Restaurant infringes or misappropriates any third party's copyright, U.S. patent, trademark or other proprietary right; or (c) the breach of any representation, or warranty made by Restaurant in this Agreement.</p>
			<p>17. This Agreement may be executed in counterparts, in hard copy or electronically, each of which will be deemed an original, but both of which together will constitute one and the same instrument.</p>
			<p>18. The following terms and conditions shall apply to Restaurants engaging  burugo to create Custom Websites</p>
			<p>19. In addition to the Services, Restaurant authorizes burugo to secure a domain name for Restaurant to develop and/or improve and provide web page maintenance for Restaurant for advertising purposes ('the Project'). Restaurant agrees to pay burugo a fee of $30.00 per month plus applicable credit card processing fees for each order originating from the Project web page.</p>
			<p>20. Restaurant warrants that Restaurant owns all content submitted by Restaurant to burugo in connection with the Project, or that Restaurant has secured all necessary rights from the owner to use all such content. Restaurant further warrants that no content submitted will contain anything that may violate burugo's Terms of Use or otherwise interfere with, abuse or compromise, the function of any hosting service or burugo services.</p>
			<p>21. Burugo shall own all intellectual property rights associated with the finished assembled Project website, web pages and associated content created by burugo. This content includes, but is not limited to the design, photos, graphics, source code, work-up files, text, and any program(s) specifically designed for or purchased on behalf of Restaurant in connection with the Project.</p>
			<p>22. Restaurant will indemnify, defend and hold harmless burugo, its business units, and each of burugo's respective officers, directors, shareholders, employees, representatives, successors and assigns, from and against all Losses, to the extent such Losses are related to: (a) the development, operation, maintenance of the Project website done at Restaurant's direction or request; (b) any claim that content provided by Restaurant infringes or misappropriates any third party's copyright, U.S. patent, trademark or other proprietary right; or (c) any claim that the Project website and content displayed therein is defective, inaccurate or causes injury to any third party. burugo does not warrant that the functions of the Project website, will meet Restaurant's expectations of site traffic or resulting business or that the operation of the Project web pages will be uninterrupted and/or error-free. Restaurant will not hold burugo responsible for occasional downtime of the Project website due to line interruptions and/or other instances beyond burugo’s control.</p>
		
		<p>This Agreement, including any future Agreement modifications, constitutes the entire agreement of the Parties hereto with respect to the subject matter hereof and supersedes any and all prior agreement, written and oral, with respect thereto. Restaurant agrees that acceptance of any Services shall be subject to the then-current Agreement terms, and continued acceptance of the Services following Agreement modifications confirms that Restaurant has read, accepted, and agreed to be bound by such modifications. All Agreement modifications shall be posted at www.burugo.com and shall be effective immediately upon posting.</p>
		<p>The undersigned hereby agrees to the terms, conditions and stipulations of this Agreement as an authorized agent of the Restaurant.</p>
		
		
		
		
		
		
		<h2>burugo.com CUSTOM WEBSITE SIGN UP FORM</h2>
		<p>Restaurant, as defined above, by and through the undersigned authorized agent, agrees as follows:</p>
		<p>1. Either Party may terminate this Agreement for any reason upon notice to the other party.</p>
		<p>2. burugo shall be an independent contractor of Restaurant during the term of this Agreement.</p>
		<p>3. burugo shall provide certain services to Restaurant consistent with burugo's business practices and at burugo's sole discretion including web page maintenance as more particularly described below ('Services').</p>
		<p>4. Restaurant authorizes burugo to secure a domain name for Restaurant to develop and/or improve and provide web page maintenance for Restaurant for advertising purposes ('the Project').</p>
		<p>5. Restaurant agrees to pay burugo a fee of $30.00 per month plus applicable credit card processing fees for each orders originating from the Project web page.</p>
		<p>6. Restaurant warrants that Restaurant owns all content submitted by Restaurant to burugo in connection with the Project, or that Restaurant has secured all necessary rights from the owner to use all such content. Restaurant further warrants that no content submitted will contain anything that may violate burugo's Terms of Use or otherwise interfere with, abuse or compromise, the function of any hosting service or burugo services.</p>
		<p>7. burugo shall own all intellectual property rights associated with the finished assembled Project website, web pages and associated content created by burugo. This content includes, but is not limited to the design, photos, graphics, source code, work-up files, text, and any program(s) specifically designed for or purchased on behalf of Restaurant in connection with the Project.</p>
		<p>8. Restaurant will indemnify, defend and hold harmless burugo, its business units, and each of burugo's respective officers, directors, shareholders, employees, representatives, successors and assigns, from and against all Losses, to the extent such Losses are related to: (a) the development, operation, maintenance of the Project website done at Restaurant's direction or request; (b) any claim that content provided by Restaurant infringes or misappropriates any third party's copyright, U.S. patent, trademark or other proprietary right; or (c) any claim that the Project website and content displayed therein is defective, inaccurate or causes injury to any third party.</p>
		<p>burugo does not warrant that the functions of the Project website, will meet Restaurant's expectations of site traffic or resulting business or that the operation of the Project web pages will be uninterrupted and/or error-free. Restaurant will not hold burugo responsible for occasional downtime of the Project website due to line interruptions and/or other instances beyond burugo's control.</p>
		
		<p>This Agreement, including any future Agreement modifications, constitutes the entire agreement of the Parties hereto with respect to the subject matter hereof and supersedes any and all prior agreement, written and oral, with respect thereto. Restaurant agrees that acceptance of any Services shall be subject to the then-current Agreement terms, and continued acceptance of the Services following Agreement modifications confirms that Restaurant has read, accepted, and agreed to be bound by such modifications. All Agreement modifications shall be posted at www.burugo.com and shall be effective immediately upon posting.</p>
		
		<p>burugo shall also provide notice of all Agreement modifications via e-mail sent to Restaurant e-mail address provided by Restaurant to burugo. Restaurant shall have a ten (10) day grace period following posting of any Agreement modification to cancel the Agreement in accordance with the Agreement terms ('Grace Period'). The most recent Agreement modification shall not apply to any Restaurant that cancels the Agreement during the Grace Period. The undersigned hereby agrees to the terms, conditions and stipulations of this Agreement as an authorized agent of the Restaurant.</p>
		";
		
		$_lang['ko']['termsAndCondition'] = "
			<h2>(주)부르고 개인정보 취급방침 </h2>


			<p>(주)부르고(이하 '회사'라고 함)는 통신비밀보호법, 전기통신사업법, 정보통신망 이용촉진 및 정보보호 등에 관한 법률, 개인정보 보호법, 통신비밀보호법, 
			전기통신사업법 등 정보통신서비스제공자가 준수하여야 할 관련 법령상의 개인정보보호 규정을 준수하며, 관련 법령에 의거한 개인정보취급방침을 정하여 
			이용자 권익 보호에 최선을 다하고 있습니다. 회사의 개인정보취급방침은 다음과 같은 내용을 담고 있습니다.</p>
			
			
			1. 수집하는 개인정보의 항목 및 수집방법<br />
			2. 개인정보의 수집 및 이용목적<br />
			3. 개인정보 제공<br />
			4. 개인정보의 취급위탁<br />
			5. 개인정보의 보유 및 이용기간<br />
			6. 개인정보 파기절차 및 방법<br />
			7. 이용자 및 법정대리인의 권리와 그 행사방법<br />
			8. 개인정보 자동 수집 장치의 설치/운영 및 거부에 관한 사항<br />
			9. 개인정보의 보호 대책<br />
			10. 개인정보관리책임자 및 담당자의 연락처<br />
			11. 기타<br />
			12. 고지의 의무<br />
			
			
			<h3>1. 수집하는 개인정보의 항목 및 수집방법</h3>
			
			   가. 수집하는 개인정보의 항목<br />
				   첫째, 회사는 회원(또는 서비스) 가입, 원활한 고객상담, 각종 서비스의 제공 등을 위해 아래와 같은 최소한의 개인정보를 필수항목으로 수집하고 있습니다.<br />
						<회원가입><br />
						- 성명, 생년월일, 이메일, 거주지, 휴대폰 번호, 아이디, 비밀번호<br />
						<비지니스 업소등록><br />
						- 비지니스 업소명, 지역, 업소전화번호, 사장님 성함, 휴대폰번호, 사업자등록증, 프랜차이즈,영업시간, 카드결제여부, 배달여부, 배달가능지역, 휴무일, 업소소개글<br />
			
			   나. 개인정보 수집방법<br />
			   회사는 다음과 같은 방법으로 개인정보를 수집합니다.<br />
			   - 홈페이지,팩스, 전화 <br />
			
			
			<h3>2. 개인정보의 수집 및 이용목적</h3>
			
			   가. 서비스 제공에 관한 계약 이행 및 서비스 제공 본인인증, 서비스 제공<br />
			
			   나. 회원관리<br />
				   회원제 서비스 이용 및 제한적 본인 확인제에 따른 본인확인, 개인식별, 불량회원의 부정 이용방지와 비인가 사용방지, 가입의사 확인, 가입 및 가입횟수 제한, 
				   만14세 미만 아동 개인정보 수집 시 법정 대리인 동의여부 확인, 추후 법정 대리인 본인확인, 분쟁 조정을 위한 기록보존, 불만처리 등 민원처리, 고지사항 전달<br />
			
			   다. 신규 서비스 개발 및 마케팅광고에의 활용<br />
				   신규 서비스 개발 및 맞춤 서비스 제공, 통계학적 특성에 따른 서비스 제공 및 광고, 서비스의 유효성 확인, 이벤트 및 광고성 정보 제공 및 참여기회 제공,  접속빈도 파악, 회원의 서비스이용에 대한 통계<br />
			
			
			<h3>3. 개인정보 제공</h3>
			<p>회사는 이용자들의 개인정보를 '2. 개인정보의 수집목적 및 이용목적'에서 고지한 범위내에서 사용하며, 이용자의 사전 동의 없이는 동 범위를 초과하여 이용하거나 
			원칙적으로 이용자의 개인정보를 외부에 공개하지 않습니다. 다만, 아래의 경우에는 예외로 합니다.</p>
			
			   가. 이용자들이 사전에 공개에 동의한 경우<br />
			
			   나. 법령의 규정에 의거하거나, 수사 목적으로 법령에 정해진 절차와 방법에 따라 수사기관의 요구가 있는 경우<br />
			 
			
			<h3>4. 회사는 고객에 대하여 보다 더 질 높은 서비스 제공을 위해 </h3>
			
			   가. 이용자들이 사전에 공개에 동의한 경우 제공하고 있습니다.<br />
			
			
			<h3>5. 개인정보의 보유 및 이용기간</h3>
			이용자의 개인정보는 원칙적으로 개인정보의 수집 및 이용목적이 달성되면 지체 없이 파기합니다. 단, 다음의 정보에 대해서는 아래의 이유로 명시한 기간 동안 보존합니다.<br />
			
			   가. 회사 내부 방침에 의한 정보보유 사유<br />
				   - 부정이용기록 <br />
					 보존 이유 : 부정 이용 방지 <br />
					 보존 기간 : 1년 <br />
			
			   <비지니스 전용사이트><br />
				   - 사장님 탈퇴기록 <br />
					 보존 이유 : 민원처리 등 <br />
					 보존 기간 : 30일 <br />
			
			   나. 관련법령에 의한 정보보유 사유<br />
				   <p>상법, 전자상거래 등에서의 소비자보호에 관한 법률 등 관계법령의 규정에 의하여 보존할 필요가 있는 경우 회사는 관계법령에서 정한 
				   일정한 기간 동안 회원정보를 보관합니다. 이 경우 회사는 보관하는 정보를 그 보관의 목적으로만 이용하며 보존기간은 아래의 예시와 같습니다.</p>
				   - 본인확인에 관한 기록 <br />
					 보존 이유 : 정보통신망 이용촉진 및 정보보호 등에 관한 법률 <br />
					 보존 기간 : 6개월 <br />
				   - 표시/광고에 관한 기록 <br />
					 보존 이유 : 정보통신망 이용촉진 및 정보보호 등에 관한 법률 <br />
					 보존 기간 : 6개월 <br />
				   - 웹사이트 방문에 관한 기록 <br />
					 보존 이유 : 통신비밀보호법 <br />
					 보존 기간 : 3개월 <br />
			
			
			<h3>6. 개인정보 파기절차 및 방법</h3>
			<p>이용자의 개인정보는 원칙적으로 개인정보의 수집 및 이용목적이 달성되면 지체 없이 파기합니다. 회사의 개인정보 파기절차 및 방법은 다음과 같습니다.</p>
			
			   가. 파기절차<br />
				   - 이용자가 회원가입 등을 위해 입력한 정보는 목적이 달성된 후 별도의 DB로 옮겨져(종이의 경 우 별도의 서류함) 내부 방침 및 기타 관련 법령에 의한 정보보호 사유에 따라(보유 및 이용기간 참조)일정 기간 저장된 후 파기됩니다. <br />
				   -  개인정보는 법률에 의한 경우가 아니고서는 보유되는 이외의 다른 목적으로 이용되지 않습니다. <br />
			
			   나. 파기방법<br />
				   - 종이에 출력된 개인정보는 분쇄기로 분쇄하거나 소각을 통하여 파기합니다. <br />
				   - 전자적 파일 형태로 저장된 개인정보는 기록을 재생할 수 없는 기술적 방법을 사용하여 삭제합니다. <br />
			
			
			<h3>7. 이용자 및 법정대리인의 권리와 그 행사방법</h3>
			   - 이용자 및 법정대리인은 언제든지 등록되어 있는 자신 혹은 당해 만 14세 미만 아동의 개인정보를 조회, 수정 또는 가입해지를 요청할 수 있습니다. <br />
			   - 이용자 혹은 만 14세 미만 아동의 개인정보에 대한 조회, 수정 또는 가입해지를 위해서 개인정보 관리책임자 혹은 개인정보 관리담당자에게 서면, 전화 또는 이메일로 연락하시면 지체 없이 조치하겠습니다. <br />
			   - 이용자가 개인정보의 오류에 대한 정정을 요청하신 경우에는 정정을 완료하기 전까지 당해 개인정보를 이용 또는 제공하지 않습니다. 또한 잘못된 개인정보를 제3 자에게 이미 제공한 경우에는 정정 처리결과를 제3자에게 지체 없이 통지하여 정정이 이루어지도록 하겠습니다. <br />
			   - 회사는 이용자 혹은 법정 대리인의 요청에 의해 해지 또는 삭제된 개인정보는 '5. 개인정보의 보유 및 이용기간'에 명시된 바에 따라 처리하고 그 외의 용도로 열람 또는 이용할 수 없도록 처리하고 있습니다. <br />
			
			
			<h3>8. 개인정보 자동 수집 장치의 설치/운영 및 거부에 관한 사항</h3>
			
			   가. 쿠키란<br />
				  - 회사는 개인화되고 맞춤화된 서비스를 제공하기 위해서 이용자의 정보를 저장하고 수시로 불러오는 ‘쿠키(cookie)’를 사용합니다. <br />
				  - 쿠키는 웹사이트를 운영하는데 이용되는 서버가 이용자의 브라우저에게 보내는 아주 작은 텍스트 파일로 이용자 컴퓨터의 하드디스크에 저장됩니다. <br />
					이후 이용자가 웹 사이트에 방문할 경우 웹 사이트 서버는 이용자의 하드 디스크에 저장되어 있는 쿠키의 내용을 읽어 이용자의 환경설정을 유지하고 맞춤화된 서비스를 제공하기 위해 이용됩니다.<br />
				  - 쿠키는 개인을 식별하는 정보를 자동적/능동적으로 수집하지 않으며, 이용자는 언제든지 이러한 쿠키의 저장을 거부하거나 삭제할 수 있습니다.<br />
			
			   나. 쿠키의 사용 목적<br />
			   이용자들이 방문한 회사의 각 서비스와 웹 사이트들에 대한 방문 및 이용형태, 인기 검색어, 이용자 규모 등을 파악하여 이용자에게 광고를 포함한 최적화된 맞춤형 정보를 제공을 위해 사용합니다.<br />
			
			   다. 쿠키의 설치/운영 및 거부<br />
				  - 이용자는 쿠키 설치에 대한 선택권을 가지고 있습니다. 따라서 이용자는 웹브라우저에서 선택을 설정함으로써 모든 쿠키를 허용하거나, 쿠키가 저장될 때마다 확인을 거치거나, 아니면 모든 쿠키의 저장을 거부할 수도 있습니다. <br />
				  - 다만, 쿠키의 저장을 거부할 경우에는 로그인이 필요한 회사의 일부 서비스는 이용에 어려움이 있을 수 있습니다. <br />
				  - 쿠키 설치 허용 여부를 지정하는 방법(Internet Explorer의 경우) 은 다음과 같습니다.<br />
					① [도구] 메뉴에서 [인터넷 옵션]을 선택합니다. <br />
					② [개인정보 탭]을 클릭합니다. <br />
					③ [개인정보취급 수준]을 설정하시면 됩니다. <br />
			
			
			<h3>9. 개인정보의 보호 대책</h3>
			<p>회사는 이용자들의 개인정보를 취급함에 있어 개인정보가 분실, 도난, 누출, 변조 또는 훼손되지 않도록 안전성 확보를 위하여 다음과 같은 대책을 강구하고 있습니다.</p>
			
			   가. 비밀번호 암호화<br />
			   회원 비밀번호는 암호화되어 저장 및 관리되고 있어 본인만이 알고 있으며, 개인정보의 확인 및 변경도 비밀번호를 알고 있는 본인에 의해서만 가능합니다.<br />
			
			   나. 해킹 등에 대비한 대책<br />
			   <p>회사는 해킹이나 컴퓨터 바이러스 등에 의해 회원의 개인정보가 유출되거나 훼손되는 것을 막기 위해 최선을 다하고 있습니다.
			   개인정보의 훼손에 대비해서 자료를 수시로 백업하고 있고, 최신 백신프로그램을 이용하여 이용자들의 개인정보나 자료가 누출되거나 손상되지 않도록 방지하고 있으며, 
			   암호화통신 등을 통하여 네트워크상에서 개인정보를 안전하게 전송할 수 있도록 하고 있습니다. 그리고 침입차단시스템을 이용하여 외부로부터의 무단 접근을 통제하고 
			   있으며, 기타 시스템적으로 보안성을 확보하기 위한 가능한 모든 기술적 장치를 갖추려 노력하고 있습니다.</p>
			
			   다. 취급 직원의 최소화 및 교육<br />
			   <p>회사의 개인정보관련 취급 직원은 담당자에 한정시키고 있고 이를 위한 별도의 비밀번호를 부여하여 정기적으로 갱신하고 있으며, 담당자에 대한 수시 교육을 통하여 개인정보취급방침의 준수를 항상 강조하고 있습니다.</p>
			
			   라. 개인정보보호전담기구의 운영<br />
			   <p>사내 개인정보보호전담기구 등을 통하여 개인정보취급방침의 이행사항 및 담당자의 준수여부를 확인하여 문제가 발견될 경우 즉시 수정하고 바로 잡을 수 있도록 노력하고 있습니다. 단, 이용자 본인의 부주의나 인터넷상의 문제로 ID, 비밀번호, 주민등록번호, 소셜시큐리티번호 등 개인정보가 유출되어 발생한 문제에 대해 회사는  일체의 책임을 지지 않습니다.</p>
			
			
			<h3>10. 개인정보관리책임자 및 담당자의 연락처</h3>
			귀하께서는 회사의 서비스를 이용하시며 발생하는 모든 개인정보보호 관련 민원을 개인정보관리책임자 혹은 담당부서로 신고하실 수 있습니다. 회사는 이용자들의 신고사항에 대해 신속하게 충분한 답변을 드릴 것입니다.<br />
			
				개인정보 관리 책임자<br />
				이 름  박찬호<br />
				전 화  678-308-8833<br />
				직 위 사장<br />
				메 일  ceo@burugo.com<br />
			
			기타 개인정보침해에 대한 신고나 상담이 필요하신 경우에는 아래 기관에 문의하시기 바랍니다.<br />
			
			
			<h3>11. 기타</h3>
			<p>회사의 인터넷 서비스에 링크되어 있는 웹사이트들이 개인정보를 수집하는 행위에 대해서는 본 '개인정보취급방침'이 적용되지 않음을 알려 드립니다.</p>
			
			
			<h3>12. 고지의 의무</h3>
			<p>현 개인정보취급방침 내용 추가, 삭제 및 수정이 있을 시에는 개정 최소 7일전부터 홈페이지의 '공지사항'을 통해 고지할 것입니다.
			다만, 개인정보의 수집 및 활용, 제3자 제공 등과 같이 이용자 권리의 중요한 변경이 있을 경우에는 최소 30일 전에 고지합니다.</p>
			
			
			
			
			- 공고일자 : 2013년11월 7일<br />
			- 시행일자 : 2013년 11월7일<br />
		";
		$_lang['en']['yesimready'] = "Yes, I'm Ready!";
		$_lang['ko']['yesimready'] = '회원가입';
		
		
		return $_lang;
	}
	
	
	
}




?>