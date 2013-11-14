<?php

class marca
{
	private $idmarca;
	private $nombre;
	
		
	function __construct()
	{
		if(func_num_args()==2)
		{
			$this->idmarca = func_get_arg(0);
			$this->nombre = func_get_arg(1);
	
			
		}
		
	}
	
	public function setidmarca($value)
	{
		$this->idmarca = $value;
		
	}
	
	public function setnombre($value)
	{
		$this->nombre = $value;
		
	}
	
	
	######################GET#####################
	
	public function getidmarca()
	{
		return $this->idmarca;
		
	}
	
	public function getnombre()
	{
		return $this->nombre;
		
	}
	
	
}

?>