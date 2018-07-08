<?php

require_once "AccesoDatos.php";

class vehiculo
{

	public $idVehiculo;
	public $idEmpleado;
	public $modelo;
	public $anio;
 	public $color;
 	public $estado;
 	public $dominio;
 	public $cantPuertas;
 	public $utilitario;
 	public $aireAcondicionado;


	

 	 public static function TraerTodos() 
	 {	
	 	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	 	$consulta =$objetoAccesoDato->RetornarConsulta("select * from tbVehiculos");
	 	$consulta->execute();
	 	$arrVehiculos= $consulta->fetchAll(PDO::FETCH_CLASS, "vehiculo");	
		return $arrVehiculos;					
	 }

  	 public static function TraerConParams($cantPuertas,$utilitario,$aireAcondicionado) 
	 {	
	 	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	 	$consulta =$objetoAccesoDato->RetornarConsulta("call spGetVehiculosConComodidades (:cantPuertas , :utilitario ,:aireAcondicionado )");
	 	$consulta->bindValue(':cantPuertas',$cantPuertas, PDO::PARAM_STR);
	 	$consulta->bindValue(':utilitario',$utilitario, PDO::PARAM_STR);
	 	$consulta->bindValue(':aireAcondicionado',$aireAcondicionado, PDO::PARAM_STR);
		$consulta->execute();
	 	$arrVehiculos= $consulta->fetchAll(PDO::FETCH_CLASS, "vehiculo");	
		return $arrVehiculos;					
	 }

	public static function TraerVista()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from viewListaVehiculos");

		$consulta->execute();					 
		
		$result = $consulta->fetchAll(PDO::FETCH_ASSOC);
		return $result;
		
	}
	
	public static function Update($vehiculo)
	{
			
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("update tbVehiculos set estado = :estado where idVehiculo=:idVehiculo");
		$consulta->bindValue(':idVehiculo', $vehiculo->idVehiculo, PDO::PARAM_INT);
		$consulta->bindValue(':estado', $vehiculo->estado, PDO::PARAM_STR);
		
		$consulta->execute();
		return $consulta->rowCount();
		
	}
	 
	public static function Insertar($vehiculo)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into tbVehiculos (idEmpleado, modelo, anio, color, dominio, cantPuertas, utilitario, aireAcondicionado,estado,foto) values(:idEmpleado, :modelo, :anio, :color, :dominio, :cantPuertas, :utilitario, :aireAcondicionado,:estado,:foto)");
		
		$consulta->bindValue(':idEmpleado',$vehiculo->idEmpleado, PDO::PARAM_INT);
		$consulta->bindValue(':modelo',$vehiculo->modelo, PDO::PARAM_STR);
		$consulta->bindValue(':anio', $vehiculo->anio, PDO::PARAM_STR);
		$consulta->bindValue(':color', $vehiculo->color, PDO::PARAM_STR);
		$consulta->bindValue(':dominio', $vehiculo->dominio, PDO::PARAM_STR);
		$consulta->bindValue(':cantPuertas', $vehiculo->cantPuertas, PDO::PARAM_STR);
		$consulta->bindValue(':utilitario', $vehiculo->utilitario, PDO::PARAM_STR);
		$consulta->bindValue(':aireAcondicionado', $vehiculo->aireAcondicionado, PDO::PARAM_STR);
		$consulta->bindValue(':estado', $vehiculo->estado, PDO::PARAM_STR);
		$consulta->bindValue(':foto', $vehiculo->foto, PDO::PARAM_STR);

	
		$consulta->execute();
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}


	public static function TraerUno($idParametro) 
	{	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from tbVehiculos where idVehiculo =:id");
		$consulta->bindValue(':id', $idParametro, PDO::PARAM_INT);
		$consulta->execute();
		$vehiculoBuscado= $consulta->fetchObject('vehiculo');
		return $vehiculoBuscado;						
	}

	// public static function TraerPorCUIT($cuit) 
	// {	
	// 	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	// 	$consulta =$objetoAccesoDato->RetornarConsulta("select email, telefono from usuario where cuit =:cuit");
	// 	$consulta->bindValue(':cuit', $cuit, PDO::PARAM_INT);
	// 	$consulta->execute();
	// 	$usuarioBuscado= $consulta->fetchObject('usuario');
	// 	return $usuarioBuscado;						
	// }


	// public static function ValidarCuitRepetido($cuitParametro)
	// {
	// 	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	// 	$consulta =$objetoAccesoDato->RetornarConsulta("SELECT COUNT(*) FROM usuario WHERE cuit = :cuit");
	// 	$consulta->bindValue(':cuit', $cuitParametro, PDO::PARAM_INT);
	// 	$consulta->execute();			
	// 	$arrCantRepeticiones = $consulta->fetchAll();	
	// 	return $arrCantRepeticiones;
	// }

	// public static function EditarEmail($idParametro, $emailParametro)
	// {
	// 	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		
	// 	$consulta =$objetoAccesoDato->RetornarConsulta("UPDATE usuario set email = :email WHERE id=:id");
	// 	$consulta->bindValue(':id', $idParametro, PDO::PARAM_INT);
	// 	$consulta->bindValue(':email', $emailParametro, PDO::PARAM_STR);
	// 	$consulta->execute();
	// 	return $consulta->rowCount();
	// }

	// public static function EditarTelefono($idParametro, $telefonoParam)
	// {
	// 	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		
	// 	$consulta =$objetoAccesoDato->RetornarConsulta("UPDATE usuario set telefono = :telefono WHERE id=:id");
	// 	$consulta->bindValue(':id', $idParametro, PDO::PARAM_INT);
	// 	$consulta->bindValue(':telefono', $telefonoParam, PDO::PARAM_INT);
	// 	$consulta->execute();
	// 	return $consulta->rowCount();
	// }

	// //EL USUARIO CAMBIA EL PASSWORD VOLUNTARIAMENTE
	// public static function EditarPasswordVoluntario($idParametro, $passwordNuevo, $passwordViejo)
	// {
	// 	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		
	// 	$consulta =$objetoAccesoDato->RetornarConsulta("UPDATE usuario set password = :passwordNuevo WHERE id=:id AND password = :passwordViejo");
	// 	$consulta->bindValue(':id',$idParametro, PDO::PARAM_INT);
	// 	$consulta->bindValue(':passwordNuevo', $passwordNuevo, PDO::PARAM_STR);
	// 	$consulta->bindValue(':passwordViejo', $passwordViejo, PDO::PARAM_STR);
	// 	$consulta->execute();
	// 	return $consulta->rowCount();
	// }

	// //EL SISTEMA CAMBIA EL PASSWORD POR PERDIDA
	// public static function EditarPasswordPerdida($cuit, $email, $passwordNuevo)
	// {
	// 	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		
	// 	$consulta =$objetoAccesoDato->RetornarConsulta("UPDATE usuario set password = :passwordNuevo WHERE cuit=:cuit AND email = :email");
	// 	$consulta->bindValue(':cuit',$cuit, PDO::PARAM_INT);
	// 	$consulta->bindValue(':email', $email, PDO::PARAM_STR);
	// 	$consulta->bindValue(':passwordNuevo', $passwordNuevo, PDO::PARAM_STR);
	// 	$consulta->execute();
	// 	return $consulta->rowCount();
	// }

	

	// public static function Login($cuit, $password) 
	// {	
	// 	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	// 	$consulta =$objetoAccesoDato->RetornarConsulta("select * from usuario where cuit = :cuit AND password = :password");
	// 	$consulta->bindValue(':cuit', $cuit, PDO::PARAM_STR);
	// 	$consulta->bindValue(':password', $password, PDO::PARAM_STR);
	// 	$consulta->execute();
	// 	$usuarioBuscado= $consulta->fetchObject('usuario');
	// 	return $usuarioBuscado;						
	// }

	// public static function Activar($cuit)
	// {
	// 		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			
	// 		$consulta =$objetoAccesoDato->RetornarConsulta("UPDATE usuario set activa = 'true' WHERE cuit=:cuit");
	// 		$consulta->bindValue(':cuit',$cuit, PDO::PARAM_INT);
	// 		$consulta->execute();
	// 		return $consulta->rowCount();
	// }

}