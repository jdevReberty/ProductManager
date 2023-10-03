<?php

use app\services\Request;

function load(string $controller, string $action) {
    $controllerNameSpace = "app\\controllers\\{$controller}";
    
    try {
        if(!class_exists($controllerNameSpace)) {
            throw new Exception("O controller {$controller} não existe");
        }
        
        $controllerInstance = new $controllerNameSpace();
    
        if(!method_exists($controllerInstance, $action)) {
            throw new Exception("O método {$action} do {$controller} não existe");
        }
        $controllerInstance->$action(new Request((object)$_REQUEST));
    
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

$routes = [
    'GET' => [
        '/' => fn() => load('HomeController', 'index'),
        '/login' => fn() => load('LoginController', 'index'),
        '/cadastrar' => fn() => load('LoginController', 'create'),
        '/logout' => fn() => load('LoginController', 'logout'),
        '/cadastrar/produto' => fn() => load('ProdutoController', 'index'),
        '/cadastrar/produto/tipo' => fn() => load('ProdutoController', 'createTipoProduto')
    ],
    'POST' => [
        '/login/cadastrar' => fn() => load('LoginController', 'store'),
        '/login/entrar' => fn() => load('LoginController', 'login'),
        '/produto/cadastrar' => fn() => load('ProdutoController', 'store'),
        '/produto/cadastrar/tipo' => fn() => load('ProdutoController', 'storeTipoProduto'),
    ]
];