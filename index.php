<?php

    require_once __DIR__.'/vendor/autoload.php';

    use Symfony\Component\HttpFoundation\JsonResponse;

    Propel::init("modules/Propel/build/conf/propel-conf.php");
    set_include_path("modules/Propel/build/classes" . PATH_SEPARATOR . get_include_path());

    $app = new Silex\Application();

    $app->register(new Silex\Provider\ServiceControllerServiceProvider());

    $app['debug'] = true;

    $app['controller'] = $app->share(function() use ($app) {
        return new Mods\Controller($app);
    });

    // Default requests
    $app->get('/', "controller:homePage");


    // GET request
    $app->get('/get/{id}', "controller:get");
    $app->get('/get', "controller:getAll");


    $app->error(function (\Exception $e, $code) {
        switch ($code) {
            case 404:
                $response = array("statusCode" => "404", "error" => "HTTP 404", "message" => "Requested page does not exist");
                break;
            case 204:
                $response = array("statusCode" => "204", "error" => "HTTP 204", "message" => "No content for this request");
                break;
            case 403:
                $response = array("statusCode" => "403", "error" => "HTTP 403", "message" => "Forbidden access");
                break;
            case 401:
                $response = array("statusCode" => "401", "error" => "HTTP 401", "message" => "Access denied");
                break;
            case 500:
                $response = array("statusCode" => "500", "error" => "HTTP 500", "message" => "Internal server error");
                break;
            default:
                $response = array("statusCode" => "default", "error" => "Silex error", "message" => "An error accured<br /><br /><pre>" . $e . "</pre>");
        }

        return new JsonResponse($response);
    });

    $app->run();

?>
