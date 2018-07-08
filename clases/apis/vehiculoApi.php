<?php

    include_once __DIR__ . '/../Vehiculo.php';
    require_once __DIR__ . '/../AutentificadorJWT.php';

    class vehiculoApi
    {

        public static function TraerTodos($request, $response, $args){
            
            return $response->withJson(Vehiculo::TraerTodos(), 200);
        }

        public static function TraerUno($request, $response, $args){

            $id = json_decode($args['id']);

            $resultado = Vehiculo::TraerUno($id);

            if(!is_null($resultado))
                return $response->withJson($resultado, 200);
            else
                return $response->withJson("El vehiculo buscado no existe", 500);
        }

		public static function TraerConParams($request, $response, $args){
			$comodidades = explode(';',$args['comodidades']); 
			// cantPuertas;utilitario;aireAcondicionado
			
		
			
			$resultado = Vehiculo::TraerConParams($comodidades[0],$comodidades[1],$comodidades[2]);
			 if(sizeof($resultado) != 0)
                return $response->withJson($resultado, 200);
            else
                return $response->withJson("El vehiculo buscado no existe", 500);
		}
		
		public static function TraerVista($request, $response, $args){
            
            return $response->withJson(Vehiculo::TraerVista(), 200);
        }
		
		
		public static function Update ($request, $response, $args){
		
			$datosRecibidos = $request->getParsedBody();
			
			$vehiculo = new Vehiculo();
			$vehiculo->idVehiculo           = $datosRecibidos['idVehiculo'];    
			$vehiculo->idEmpleado       = $datosRecibidos['idEmpleado'];
			$vehiculo->modelo         = $datosRecibidos['modelo'];
			$vehiculo->anio     = $datosRecibidos['anio'];
			$vehiculo->color     = $datosRecibidos['color'];
			$vehiculo->dominio   = $datosRecibidos['dominio'];
			$vehiculo->cantPuertas   = $datosRecibidos['cantPuertas'];
			$vehiculo->utilitario		      = $datosRecibidos['utilitario'];
			$vehiculo->aireAcondicionado        = $datosRecibidos['aireAcondicionado'];
			$vehiculo->estado        = $datosRecibidos['estado'];

			
			 
			
			$resultado = Vehiculo::Update($vehiculo);
			
			// var_dump($resultado);
			
			if($resultado != 0)
                return $response->withJson(true, 200);
            else
                return $response->withJson("Ha ocurrido un error actualizando el vehiculo. Inténtelo nuevamente.", 500);
		}
		
		
        public static function Insertar($request, $response, $args){

            $datosRecibidos = $request->getParsedBody();

            $vehiculo = new Vehiculo();
		
            $vehiculo->idEmpleado = $datosRecibidos['idEmpleado'];
            $vehiculo->modelo = $datosRecibidos['modelo'];
            $vehiculo->anio = $datosRecibidos['anio'];
            $vehiculo->color = $datosRecibidos['color'];
            $vehiculo->dominio = $datosRecibidos['dominio'];
            $vehiculo->cantPuertas = $datosRecibidos['cantPuertas'];
            $vehiculo->utilitario = $datosRecibidos['utilitario'];
            $vehiculo->aireAcondicionado = $datosRecibidos['aireAcondicionado'];
			$vehiculo->estado = $datosRecibidos['estado'];  
			$vehiculo->foto = $datosRecibidos['foto'];  

    
            $resultado = Vehiculo::Insertar($vehiculo);
		
			// var_dump($resultado);	
	
            if(is_numeric($resultado) == true)
                return $response->withJson(true, 200);
            else
                return $response->withJson("Ha ocurrido un error insertando el vehiculo. Intentelo nuevamente.", 500);
        }

        public static function GuardarImg($request, $response, $args)
        {
            $foto = $_FILES[ 'file' ][ 'tmp_name' ];
            $rutaGuardar = "assets". DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . "vehiculos" . DIRECTORY_SEPARATOR . $_FILES[ 'file' ][ 'name' ];
            
            if(move_uploaded_file( $foto, $rutaGuardar ))
                return $response->withJson($rutaGuardar, 200);
            else
                return $response->withJson("La imagen no se pudo guardar. Intente nuevamente.", 500);
            
        }
    }
