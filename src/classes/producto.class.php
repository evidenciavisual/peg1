<?php

class producto
{
	private $idproducto;
	private $nombre;
	private $tipo;
		
	function __construct()
	{
		if(func_num_args()==3)
		{
			$this->idproducto = func_get_arg(0);
			$this->nombre = func_get_arg(1);
			$this->tipo = func_get_arg(2);
			
		}
		
	}
	
	public function setidproducto($value)
	{
		$this->idproducto = $value;
		
	}
	
	public function setnombre($value)
	{
		$this->nombre = $value;
		
	}
	
	public function settipo($value)
	{
		$this->tipo = $value;
		
	}
	
	######################GET#####################
	
	public function getidproducto()
	{
		return $this->idproducto;
		
	}
	
	public function getnombre()
	{
		return $this->nombre;
		
	}
	
	public function gettipo()
	{
		return $this->tipo;
		
	}
}

?>