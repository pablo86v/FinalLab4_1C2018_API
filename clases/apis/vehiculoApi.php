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

            if(sizeof($resultado) != 0)
                return $response->withJson($resultado, 200);
            else
                return $response->withJson("El vehículo buscado no existe", 500);
        }

		public static function TraerConComodidades($request, $response, $args){
			$comodidades = explode(';',$args['comodidades']); 
			// cantPuertas;utilitario;aireAcondicionado
			
		
			
			$resultado = Vehiculo::TraerConComodidades($comodidades[0],$comodidades[1],$comodidades[2]);
			 if(sizeof($resultado) != 0)
                return $response->withJson($resultado, 200);
            else
                return $response->withJson("El vehiculo buscado no existe", 500);
		}
		
		public static function TraerVista($request, $response, $args){
            
            return $response->withJson(Vehiculo::TraerVista(), 200);
        }
		
		
        public static function Insertar($request, $response, $args){

            $datosRecibidos = $request->getParsedBody();

            $vehiculo = new Vehiculo();
            $vehiculo->marca = $datosRecibidos['marca'];
            $vehiculo->modelo = $datosRecibidos['modelo'];
            $vehiculo->anio = $datosRecibidos['anio'];
            $vehiculo->color = $datosRecibidos['color'];
            $vehiculo->dominio = $datosRecibidos['dominio'];
            $vehiculo->foto = $datosRecibidos['foto'];  
            $vehiculo->cantPuertas = $datosRecibidos['puertas'];
            $vehiculo->utilitario = $datosRecibidos['utilitario'];
            $vehiculo->aireAcondicionado = $datosRecibidos['aireAcond'];

            // var_dump($vehiculo);
    
            $resultado = Vehiculo::Insertar($vehiculo);
    
            if(is_numeric($resultado) == true)
                return $response->withJson(true, 200);
            else
                return $response->withJson("Ha ocurrido un error insertando el vehículo. Inténtelo nuevamente.", 500);
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
