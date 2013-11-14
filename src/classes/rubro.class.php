<?php
class rubro
{
	private $idrubro;
	private $nombre;
	private $logo;
	
	function __construct()
	{
		if(func_num_args()==3)
		{
			$this->idrubro = func_get_arg(0);
			$this->nombre = func_get_arg(1);
			$this->logo = func_get_arg(2);
				
		}
	
	
	}
	
	public function setidrubro($value)
	{
		$this->idtienda = $value;
	}
	
	public function setnombre($value)
	{
		$this->nombre = $value;
	}
	
	public function setlogo($value)
	{
		$this->logo = $value;
	}
	
	
	######################GET#####################
	
	public function getidrubro()
	{
		return $this->idrubro;
	}
	
	public function getnombre()
	{
		return $this->nombre;
	}
	
	public function getlogo()
	{
		return $this->logo;
	}
	
		
}