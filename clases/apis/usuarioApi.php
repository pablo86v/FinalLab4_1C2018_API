<?php

    include_once __DIR__ . '/../Usuario.php';
    require_once __DIR__ . '/../AutentificadorJWT.php';

    class usuarioApi
    {

        public static function Login($request, $response, $args)
        {
            $datosRecibidos = $request->getParsedBody();
            $usuario = $datosRecibidos['usuario'];
            $password = $datosRecibidos['password'];

            $usuarioBuscado = usuario::Login($usuario, $password);

            if($usuarioBuscado != false)
            {
                $token = AutentificadorJWT::CrearToken($usuarioBuscado);
                return $response->withJson(['token' => $token], 200);
            }   
            else
            {
                return $response->withJson('Usuario inexistente', 404);
            }
            var_dump($usuarioBuscado);
                  
        }


        public static function restoreDB($request, $response, $args)
        {
 
			$resultado = Usuario::restoreDB();

			if($resultado != false)
                return $response->withJson(true, 200);
            else
                return $response->withJson("Ha ocurrido un error restaurando la base. Inténtelo nuevamente.", 500);
                  
        }

		
    }
