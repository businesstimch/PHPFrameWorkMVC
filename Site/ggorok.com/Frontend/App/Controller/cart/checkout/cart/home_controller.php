<?
class CartCheckoutCartHome_Controller extends GGoRok
{
	function home()
	{
		echo $this->Load->View('cart/header.tpl',array(
			'title' => 'GGoRok Cart',
			'metaK' => 'GGoRok',
			'metaD' => 'GGoRok',
			'login_token' => $this->token->login_token(true),
			'Category_HTML' => $this->_Cache->get_cache('Category')['data'],
			'TopSearchCategory_HTML' => $this->_Cache->get_cache('TopSearchCategory')['data']
		));
		
		echo $this->Load->View('cart/checkout/cart.tpl');
		echo $this->Load->View('cart/footer.tpl');
	}
	
	function Cart_delItem()
	{
		$output['ack'] = 'error';
		if(isset($_POST['cuID']) && isset($_POST['cartID']))
		{
			$Argv['cuID'] = $_POST['cuID'];
			$Argv['cartID'] = $_POST['cartID'];
			$output = $this->_Cart->delItem($Argv);
		}
		else
			$output['error_msg'] = "There was an error please refresh this page and try again.";
		
		return $output;
	}
	function Cart_modItem()
	{
		$output['ack'] = 'error';
		if(isset($_POST['cuID']) && isset($_POST['cartID']) && isset($_POST['Qty']))
		{
			$Argv['cuID'] = $_POST['cuID'];
			$Argv['cartID'] = $_POST['cartID'];
			$Argv['Qty'] =$_POST['Qty'];
			$output = $this->_Cart->modItem($Argv);
			
		}
		else
			$output['error_msg'] = "There was an error please refresh this page and try again.";
		
		return $output;
	}
	function Cart_addItem()
	{
		$output['ack'] = 'error';
		
		
		
		if(isset($_POST['Cart_Qty']) && isset($_POST['Prd_ID']) && isset($_POST['Cart_Options']))
		{
			$Argv['Cart_Qty'] = $_POST['Cart_Qty'];
			$Argv['Prd_ID'] = $_POST['Prd_ID'];
			$Argv['Cart_Options'] = $_POST['Cart_Options'];
			$output = $this->_Cart->addItem($Argv);
			
		}
		else
			$output['error_msg'] = "There was an error please refresh this page and try again.";
			
		return $output;
	}
	
	function refreshPage()
	{
		$output['ack'] = 'success';
		$output['Target_Cart_Product_List'] = $this->getCartInfo()['html'];
		return $output;
	}
	
	function getCartInfo()
	{
		$CartInfo = $this->_Cart->getInfo();
		$output['html'] = '';
		
		if(isset($CartInfo['Cart_Items']) && sizeof($CartInfo['Cart_Items']) > 0)
		{
			foreach($CartInfo['Cart_Items'] as $K => $Cart_Items_F)
			{
				# Init option html variable.
				$CartInfo['Cart_Items'][$K]['Opt_Html_Tmp'] = '';
				
				#If has option
				if(sizeof($CartInfo['Cart_Opt']) > 0 && isset($CartInfo['Cart_Opt'][$Cart_Items_F['Cart_ID']]))
				{
					foreach($CartInfo['Cart_Opt'][$Cart_Items_F['Cart_ID']] AS $Opt_F)
					{
						$CartInfo['Cart_Items'][$K]['Opt_Html_Tmp'] .= '<br /><span class="CI_Opt_Name">- '.$Opt_F['Opt_Name'].'</span>';
					}
				}
			}
			
			$output['html'] = $this->Load->View('cart/checkout/cart_items_table.tpl',array(
				"CartItems" => $CartInfo['Cart_Items'],
				"Cart_Qty" => $CartInfo['Cart_Qty'],
				"Cart_Sub_Total" => "$".number_format($CartInfo['Cart_Sub_Total'],2)
			));
			
		}
		else
			$output['html'] = 'Your cart is empty, Please add items.';
		
		return $output;
	}
	
}
?>