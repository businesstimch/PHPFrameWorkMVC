<?
class wwwFavorite_controller extends GGoRok
{
	
	function home()
	{
		$Data['title'] = '즐겨찾기 | 부르고';
		$Data['metaK'] = '즐겨찾기';
		$Data['metaD'] = '즐겨찾기';
		
		echo $this->Load->View('www/header.tpl',$Data);
		echo $this->Load->View('www/Favorite.tpl');
		echo $this->Load->View('www/footer.tpl');
	}
	
	
}