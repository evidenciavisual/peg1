<?php
	class usuario
	{
	private $id_usuario;
	private $nomComUsuario;
	private $nomUsuario;
	private $mailUsuario;
	private $passUsuario;
	private $privilegioUsuario;
	private $nodo;

		function __construct()
		{
			if(func_num_args()==7)
			{
				$this->id_usuario = func_get_arg(0);
				$this->nomComUsuario = func_get_arg(1);
				$this->nomUsuario = func_get_arg(2);
				$this->mailUsuario = func_get_arg(3);
				$this->passUsuario = func_get_arg(4);
				$this->privilegioUsuario = func_get_arg(5);
				$this->nodo = func_get_arg(6);
			}else{
				if(func_num_args()==6)
				{
					$this->id_usuario = func_get_arg(0);
					$this->nomComUsuario = func_get_arg(1);
					$this->nomUsuario = func_get_arg(2);
					$this->mailUsuario = func_get_arg(3);
					$this->passUsuario = func_get_arg(4);
					$this->privilegioUsuario = func_get_arg(5);
				}
				else 
				{
					if(func_num_args()==5){
						$this->id_usuario = func_get_arg(0);
						$this->nomComUsuario = func_get_arg(1);
						$this->nomUsuario = func_get_arg(2);
						$this->mailUsuario = func_get_arg(3);
						$this->privilegioUsuario = func_get_arg(4);
					}
					else{
						$this->id_usuario=null;
						$this->nomComUsuario=null;
						$this->nomUsuario=null;
						$this->mailUsuario=null;
						$this->passUsuario=null;
						$this->privilegioUsuario=null;
					}
				}
			}			
		}
		//Funciones SET
		
		function setidUsuario($value)
		{
			$this->id_usuario = $value;
		}
		function setnomComUsuario($value)
		{
			$this->nomComUsuario = $value;
		}
		function setnomUsuario($value)
		{
			$this->nomUsuario = $value;
		}
		function setmailUsuario($value)
		{
			$this->mailUsuario = $value;
		}
		function setpassUsuario($value)
		{
			$this->passUsuario = $value;
		}
		function setPrivilegio($value)
		{
			$this->privilegioUsuario = $value;
		}
		function setNodo($value)
		{
			$this->nodo = $value;
		}
		
		// Funciones GET. 
						
		public function getIdUsuario()
		{
			return $this->id_usuario;
		}
		public function getnomComUsuario()
		{
			return $this->nomComUsuario;
		}
		public function getnomUsuario()
		{
			return $this->nomUsuario;
		}
		public function getmailUsuario()
		{
			return $this->mailUsuario;
		}/*
		public function getPassword()
		{
			return $this->passUsuario;
		}*/
		public function getPrivilegio()
		{
			return $this->privilegioUsuario;
		}
		public function getNodo()
		{
			return $this->nodo;
		}
	}
?>