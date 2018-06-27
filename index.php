<?php

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require_once 'composer/vendor/autoload.php';
    require_once 'clases/AccesoDatos.php';
    require_once 'clases/apis/usuarioApi.php';
    require_once 'clases/apis/vehiculoApi.php';
    require_once 'clases/apis/viajeApi.php';

    $config['displayErrorDetails'] = true;
    $config['addContentLengthHeader'] = false;

    $app = new \Slim\App(["settings" => $config]);


    $app->add(function ($req, $res, $next){
		$response = $next($req, $res);
		return $response
			->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
	});

	
	
	//***************************  VIAJES ******************************
    $app->group('/viaje', function () {

        $this->get('/traer[/]',       \ViajeApi::class . ':TraerTodos');
        $this->get('/traer-vista[/]', \ViajeApi::class . ':TraerVista');
        $this->get('/traer-uno/{id}', \ViajeApi::class . ':TraerUno');
        $this->post('/update',         \ViajeApi::class . ':Update');
		
 
    });	
	
	
	//***************************  USUARIOS ******************************
	$app->group('/usuario', function () {

        $this->post('/login[/]'    , \usuarioApi::class . ':Login');
        $this->get ('/restoreDB[/]', \usuarioApi::class . ':restoreDB');
    });

	
	//***************************  VEHICULOS ******************************
    $app->group('/vehiculo', function () {

        $this->get('/traer[/]', \VehiculoApi::class . ':TraerTodos');
        $this->get('/traer-uno/{id}', \VehiculoApi::class . ':TraerUno');
		$this->get('/traer-vista[/]', \VehiculoApi::class . ':TraerVista');
        $this->get('/traer-con-params/{comodidades}', \VehiculoApi::class . ':TraerConParams');
        $this->post('/insertar[/]', \VehiculoApi::class . ':Insertar');
        $this->post('/guardar-imagen[/]', \VehiculoApi::class . ':GuardarImg');
    });


	
	
	
	
	
	$app->run();