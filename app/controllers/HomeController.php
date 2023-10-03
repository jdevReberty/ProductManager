<?php
namespace app\controllers;

use app\auth\SessionControl;
use app\controllers\Controller;
use app\models\Produtos;
use app\services\Request;

class HomeController extends Controller{

    private $sessionActive;

    public function __construct()
    {
        $this->sessionActive = SessionControl::checkSession();
    }

    public function index(Request $request) {
        $session = new SessionControl();
        $usuario = $session->getUsuario();
        $base_url = SessionControl::getBaseUrl();

        $produtos = new Produtos();
        $produtos = $produtos->getProdutos();

        return self::view("pages/home", 
            [
                "sessionActive" => $this->sessionActive,
                "session" => $session, 
                "usuario" => $usuario,
                "base_url" => $base_url,
                "produtos" => $produtos
            ]
        );
    }
}