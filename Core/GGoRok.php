<?

abstract class GGoRok
{
	public $loadedClass;
	public $allowPOST_Function;
	
	function __get($N)
	{
		global $$N;
		
		
		if(preg_match("/^_Lang_/",$N))
		{
			$Path = preg_replace('/^_Lang_/','',$N);
			$Path = preg_replace('/_/','/',$Path);
			$this->$N = $this->Load->Language($Path);
		}
		else if(preg_match("/^_Model_/",$N))
		{
			$Path = preg_replace('/^_Model_/','',$N);
			$Path = preg_replace('/_/','/',$Path);
			$this->$N = $this->Load->Model($Path);
		}
		else if(preg_match("/^_Controller_/",$N))
		{
			
			$Path = preg_replace('/^_Controller_/','',$N);
			$Path = preg_replace('/_/','/',$Path);
			$this->$N = $this->Load->Controller($Path);
		}
		else if(isset($N))
		{
			$this->$N = $$N;
		}
		
		
		return $this->$N;
	}
	
	function __set($N,$V)
	{
		return $this->$N = $V;
	}
	
	
}

?>