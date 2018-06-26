<?php

require_once "AccesoDatos.php";

class usuario
{

	public $idUsuario;
	public $nombre;
	public $apellido;
	public $dni;
 	public $usuario;
 	public $password;
 	public $domicilio;
 	public $tipoUsuario;


 	public static function Login($usuario, $password) 
	{	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from tbUsuarios where usuario = :usuario AND password = :password");
		$consulta->bindValue(':usuario', $usuario, PDO::PARAM_STR);
		$consulta->bindValue(':password', $password, PDO::PARAM_STR);
		$consulta->execute();
		$usuarioBuscado= $consulta->fetchObject('usuario');
		return $usuarioBuscado;						
	}


	// public static function Traer($idParametro) 
	// {	
	// 	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	// 	$consulta =$objetoAccesoDato->RetornarConsulta("select * from usuario where id =:id");
	// 	$consulta->bindValue(':id', $idParametro, PDO::PARAM_INT);
	// 	$consulta->execute();
	// 	$usuarioBuscado= $consulta->fetchObject('usuario');
	// 	return $usuarioBuscado;						
	// }

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

	// public static function Insertar($usuario)
	// {
	// 	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	// 	$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuario (cuit, password, telefono, email, tipo) values(:cuit, :password, :telefono, :email, :tipo)");
	// 	$consulta->bindValue(':cuit',$usuario->cuit, PDO::PARAM_STR);
	// 	$consulta->bindValue(':password',$usuario->password, PDO::PARAM_STR);
	// 	$consulta->bindValue(':telefono', $usuario->telefono, PDO::PARAM_INT);
	// 	$consulta->bindValue(':email', $usuario->email, PDO::PARAM_STR);
	// 	$consulta->bindValue(':tipo', $usuario->tipo, PDO::PARAM_STR);
	// 	$consulta->execute();

	// 	return $objetoAccesoDato->RetornarUltimoIdInsertado();
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