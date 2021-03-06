<?php
require_once "AccesoDatos.php";

class viaje
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
public $idViaje        	;
public $idVehiculo      ;
public $idCliente       ;
public $domicilioOrig   ;
public $domicilioDest   ;
public $coordenadasOrig ;
public $coordenadasDest ;
public $monto		    ;
public $fechaViaje      ;
public $medioPago       ;

	
	

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
	 	$consulta =$objetoAccesoDato->RetornarConsulta("select * from tbViajes");
	 	$consulta->execute();
	 	$arrViajes= $consulta->fetchAll(PDO::FETCH_CLASS, "viaje");	
		return $arrViajes;					
	 }

	public static function TraerVista()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from viewListaViajes");

		$consulta->execute();					 
		
		$result = $consulta->fetchAll(PDO::FETCH_ASSOC);
		return $result;
		
	}
	

	public static function TraerUno($idParametro)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from tbViajes where idViaje =:id");
		$consulta->bindValue(':id', $idParametro, PDO::PARAM_INT);
		$consulta->execute();
		$objViaje= $consulta->fetchObject('viaje');
		return $objViaje;			
	}
	
	public static function TraerTodosConParams($idParametro)
	{
	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta(
			"SELECT vi.idViaje,vi.domicilioDest, CONCAT(vi.idCliente,' - ',us.apellido,',',us.nombre) as cliente, vi.fechaViaje, vi.medioPago,  vi.estado ,vi.monto
			from tbViajes vi	
			INNER JOIN tbVehiculos ve
			ON vi.idVehiculo = ve.idVehiculo
			inner join tbEmpleados em
			on ve.idEmpleado = em.idEmpleado
			inner join tbUsuarios us
			on vi.idCliente = us.idUsuario
			WHERE em.idUsuario = :id
			order by vi.idViaje desc");
		$consulta->bindValue(':id', $idParametro, PDO::PARAM_INT);
		$consulta->execute();
		$viajes= $consulta->fetchAll(PDO::FETCH_ASSOC);
		return $viajes;	
		
		
	}

	public static function Update($viaje)
	{
			
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("update tbViajes set idVehiculo = :idVehiculo, monto = :monto, estado = :estado where idViaje=:idViaje");
		$consulta->bindValue(':idVehiculo', $viaje->idVehiculo, PDO::PARAM_INT);
		$consulta->bindValue(':monto', $viaje->monto, PDO::PARAM_STR);
		$consulta->bindValue(':estado', $viaje->estado, PDO::PARAM_STR);
		$consulta->bindValue(':idViaje', $viaje->idViaje, PDO::PARAM_INT);
		
		$consulta->execute();
		return $consulta->rowCount();
		
	}
	

}