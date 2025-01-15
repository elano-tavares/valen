<?php

ob_start();

//session_start();

require __DIR__ . "/../vendor/autoload.php";
use CoffeeCode\Router\Router;

$route = new Router(url(), ":");

/**
 * Web Routes
 */

$route->namespace("Source\App");

$route->get("/user","Api:getUser");
$route->put("/user/name/{name}/document/{document}/email/{email}","Api:updateUser");
$route->post("/user/name/{name}/email/{email}/password/{password}","Api:createUser");
$route->get("/orientation/number/{number}","Api:getOrientation");

$route->dispatch();
/*
 * Error Redirect
 */

if ($route->error()) {
    header('Content-Type: application/json; charset=UTF-8');
    http_response_code(404);

    echo json_encode([
        "errors" => [
            "type " => "endpoint_not_found",
            "message" => "Não foi possível processar a requisição"
        ]
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

ob_end_flush(); 