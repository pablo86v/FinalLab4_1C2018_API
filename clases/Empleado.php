<?php
require_once "AccesoDatos.php";

class empleado
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
    public $idEmpleado   ;
    public $idUsuario    ;
    public $cuil         ;
    public $telefono     ;

	
	

//--CONSTRUCTOR
	public function __construct($dni=NULL)
	{
		// if($dni != NULL){
			// $obj = usuario::TraerUnUsuario($dni);
			
			// $this->password = $obj->password;
			// $this->usuario = $obj->usuario;
		// }
	}



 	 public static function TraerTodos() 
	 {	
	 	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	 	$consulta =$objetoAccesoDato->RetornarConsulta("select * from tbEmpleados");
	 	$consulta->execute();
	 	$arrViajes= $consulta->fetchAll(PDO::FETCH_CLASS, "empleado");	
		return $arrViajes;					
	 }

	// public static function TraerVista()
	// {
		// $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		// $consulta =$objetoAccesoDato->RetornarConsulta("select * from viewListaViajes");

		// $consulta->execute();					 
		
		// $result = $consulta->fetchAll(PDO::FETCH_ASSOC);
		// return $result;
		
	// }
	

	public static function TraerUno($idParametro)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from tbEmpleados where idEmpleado =:id");
		$consulta->bindValue(':id', $idParametro, PDO::PARAM_INT);
		$consulta->execute();
		$objViaje= $consulta->fetchObject('empleado');
		return $objViaje;			
	}
	
	public static function TraerUnoConParams($idParametro)
	{
	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta(
			"select * from tbEmpleados 
			INNER JOIN tbUsuarios
			ON tbUsuarios.idUsuario = tbEmpleados.idUsuario
			WHERE idEmpleado = :id");
		$consulta->bindValue(':id', $idParametro, PDO::PARAM_INT);
		$consulta->execute();
		$empleadoBuscado= $consulta->fetchObject('empleado');
		return $empleadoBuscado;	
		
		
	}
	

	// public static function Update($viaje)
	// {
			
		// $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		// $consulta =$objetoAccesoDato->RetornarConsulta("update tbViajes set idVehiculo = :idVehiculo where idViaje=:idViaje");
		// $consulta->bindValue(':idVehiculo', $viaje->idVehiculo, PDO::PARAM_INT);
		// $consulta->bindValue(':idViaje', $viaje->idViaje, PDO::PARAM_INT);
		
		// $consulta->execute();
		// return $consulta->rowCount();
		
	// }
	

}