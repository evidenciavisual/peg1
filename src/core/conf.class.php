<?php
class Config{
	protected $direccion;
	protected $usuario;
	protected $password;
	protected $base;

	static $_instance;	
	
	private function __construct(){
		require_once('configuraciones.php');
		$this->usuario = $usuariobd;
		$this->direccion = $direccion;
		$this->password = $passwd;
		$this->base = $basedatos; 
	}
	
	private function __clone(){
		trigger_error('No se puede clonar.', E_USER_ERROR);	
	}
	
	public static function getInstance(){
		if (!(self::$_instance instanceof self)){
			self::$_instance=new self();
	}
	 return self::$_instance;
	}
	
	function getDireccion(){
		return $this->direccion;
	}
	
	function getUsuarioBD(){
		return $this->usuario;
	}

	function getPasswd(){
		return $this->password;
	}

	function getBD(){
		return $this->base;
	}

}
?>