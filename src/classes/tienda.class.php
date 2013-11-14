<?php

class tienda
{
	private $idtienda;
	private $nombre;
	private $logo;
	private $piso;
	private $ubiTienda;
	

	function __construct()
	{
		if(func_num_args()==5)
		{
			$this->idtienda = func_get_arg(0);
			$this->nombre = func_get_arg(1);
			$this->logo = func_get_arg(2);
			$this->piso = func_get_arg(3);
			$this->ubiTienda= func_get_arg(4);
			
		}
		

	}

	public function setidtienda($value)
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
	
	public function setpiso($value)
	{
		$this->piso = $value;
	}
	
	public function setubiTienda($value)
	{
		$this->ubiTienda = $value;
	}

	
	######################GET#####################

	public function getidtienda()
	{
	return $this->idtienda;
	}

	public function getnombre()
	{
	return $this->nombre;
	}

	public function getlogo()
	{
	return $this->logo;
	}
	
	public function getpiso()
	{
		return $this->piso;
	}
	
	public function getubiTienda()
	{
		return $this->ubiTienda;
	}
	
}

?>