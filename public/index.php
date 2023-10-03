<?php

use app\auth\SessionControl;

require "../vendor/autoload.php";
require "../routes/router.php";

try {
    $url = parse_url($_SERVER["HTTP_HOST"]);
    $uri = parse_url($_SERVER["REQUEST_URI"])['path'];

    if(!isset($url['port'])) {
        $uri = explode("/public", $uri);
        $uri = $uri[1];
    } 
    $request = $_SERVER["REQUEST_METHOD"];

    if(!isset($routes[$request])) {
        throw new Exception("A rota não existe");
    }

    if(!array_key_exists($uri, $routes[$request])) {
        throw new Exception("a rota não existe");
    }

    $controller = $routes[$request][$uri];
    $controller();
} catch (Exception $e) {
    $e->getMessage();
}
