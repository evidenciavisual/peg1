<?php

class nodo
{
	private $idnodo;
	private $idcambiadorPiso;
	private $ubicacionX;
	private $ubicacionY;
	private $piso;
	private $vecino1;
	private $vecino2;
	private $vecino3;
	private $vecino4;
	private $coordenadaReal;
	
	function __construct()
	{
		if(func_num_args()==10)
		{
			$this->idnodo = func_get_arg(0);
			$this->idcambiadorPiso = func_get_arg(1);
			$this->ubicacionX = func_get_arg(2);
			$this->ubicacionY = func_get_arg(3);
			$this->piso = func_get_arg(4);
			$this->vecino1 = func_get_arg(5);
			$this->vecino2 = func_get_arg(6);
			$this->vecino3 = func_get_arg(7);
			$this->vecino4 = func_get_arg(8);
			$this->coordenadaReal = func_get_arg(9);
		}
		
	}
	
	public function setidnodo($value)
	{
		$this->idnodo = $value;
		
	}
	
	public function setidcambiadorPiso($value)
	{
		$this->idcambiadorPiso = $value;	
	}
	
	public function setubicacionX($value)
	{
		$this->ubicacionX = $value;	
	}
	
	public function setubicacionY($value)
	{
		$this->ubicacionY = $value;	
	}
	
	public function setpiso($value)
	{
		$this->piso = $value;
	}
	
	public function setvecino1($value)
	{
		$this->vecino1 = $value;	
	}
	
	public function setvecino2($value)
	{
		$this->vecino2 = $value;	
	}
	
	public function setvecino3($value)
	{
		$this->vecino3 = $value;	
	}
	
	public function setvecino4($value)
	{
		$this->vecino4 = $value;	
	}
	
	public function setcoordenadaReal($value)
	{
		$this->coordenadaReal = $value;
	}
	
	######################GET#####################
	
	public function getidnodo()
	{
		return $this->idnodo;
	}
	
	public function getidcambiadorPiso()
	{
		return $this->idcambiadorPiso;
	}
	
	public function getubicacionX()
	{
		return $this->ubicacionX;
	}
	
	public function getubicacionY()
	{
		return $this->ubicacionY;
	}
	
	public function getpiso()
	{
		return $this->piso;
	}
	
	public function getvecino1()
	{
		return $this->vecino1;
	}
	
	public function getvecino2()
	{
		return $this->vecino2;
	}
	
	public function getvecino3()
	{
		return $this->vecino3;
	}
	
	public function getvecino4()
	{
		return $this->vecino4;
	}
	
	public function getcoordenadaReal()
	{
		return $this->coordenadaReal;
	}
}

?>