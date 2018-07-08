<?php

    include_once __DIR__ . '/../Empleado.php';
    require_once __DIR__ . '/../AutentificadorJWT.php';

    class EmpleadoApi
    {

        public static function TraerTodos($request, $response, $args){
            
            return $response->withJson(Empleado::TraerTodos(), 200);
        }

        public static function TraerUno($request, $response, $args){

            $id = json_decode($args['id']);

            $resultado = Empleado::TraerUno($id);

            if(!is_null($resultado))
                return $response->withJson($resultado, 200);
            else
                return $response->withJson("El empleado buscado no existe", 500);
        }

		public static function TraerUnoConParams($request, $response, $args){

            $id = json_decode($args['id']);

            $resultado = Empleado::TraerUnoConParams($id);

            if(!is_null($resultado))
                return $response->withJson($resultado, 200);
            else
                return $response->withJson("El empleado buscado no existe", 500);
        }
		
		
		
		public static function TraerVista($request, $response, $args){
            
            return $response->withJson(Empleado::TraerVista(), 200);
        }
		
		
		public static function Update ($request, $response, $args){
		
			$datosRecibidos = $request->getParsedBody();
			
			$viaje = new Viaje();
			$viaje->idViaje           = $datosRecibidos['idViaje'];    
			$viaje->idVehiculo        = $datosRecibidos['idVehiculo'];
			$viaje->idCliente         = $datosRecibidos['idCliente'];
			$viaje->domicilioOrig     = $datosRecibidos['domicilioOrig'];
			$viaje->domicilioDest     = $datosRecibidos['domicilioDest'];
			$viaje->coordenadasOrig   = $datosRecibidos['coordenadasOrig'];
			$viaje->coordenadasDest   = $datosRecibidos['coordenadasDest'];
			$viaje->monto		      = $datosRecibidos['monto'];
			$viaje->fechaViaje        = $datosRecibidos['fechaViaje'];
			$viaje->medioPago         = $datosRecibidos['medioPago'];

			
			// var_dump($viaje);
			
			$resultado = Empleado::Update($viaje);
			
			if($resultado != 0)
                return $response->withJson(true, 200);
            else
                return $response->withJson("Ha ocurrido un error actualizando el viaje. Inténtelo nuevamente.", 500);
		}
		
		
		
        // public static function Insertar($request, $response, $args){

            // $datosRecibidos = $request->getParsedBody();

            // $viaje = new Viaje();
            // $viaje->marca = $datosRecibidos['marca'];
            // $viaje->modelo = $datosRecibidos['modelo'];
            // $viaje->anio = $datosRecibidos['anio'];
            // $viaje->color = $datosRecibidos['color'];
            // $viaje->dominio = $datosRecibidos['dominio'];
            // $viaje->foto = $datosRecibidos['foto'];  
            // $viaje->cantPuertas = $datosRecibidos['puertas'];
            // $viaje->utilitario = $datosRecibidos['utilitario'];
            // $viaje->aireAcondicionado = $datosRecibidos['aireAcond'];

            // var_dump($viaje);
    
            // $resultado = Empleado::Insertar($viaje);
    
            // if(is_numeric($resultado) == true)
                // return $response->withJson(true, 200);
            // else
                // return $response->withJson("Ha ocurrido un error insertando el vehículo. Inténtelo nuevamente.", 500);
        // }

        // public static function GuardarImg($request, $response, $args)
        // {
            // $foto = $_FILES[ 'file' ][ 'tmp_name' ];
            // $rutaGuardar = "assets". DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . "Viajes" . DIRECTORY_SEPARATOR . $_FILES[ 'file' ][ 'name' ];
            
            // if(move_uploaded_file( $foto, $rutaGuardar ))
                // return $response->withJson($rutaGuardar, 200);
            // else
                // return $response->withJson("La imagen no se pudo guardar. Intente nuevamente.", 500);
            
        // }
		
		
    }
