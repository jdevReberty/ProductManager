<?php 
namespace app\controllers;

use app\auth\SessionControl;
use app\models\Usuarios;
use app\services\Request;
use Exception;

class LoginController extends Controller{


    private $sessionActive;

    public function __construct()
    {
        $this->sessionActive = SessionControl::checkSession();
    }

    public function index() {
        $base_url = SessionControl::getBaseUrl();
        return self::view("auth/login", 
            [
                "base_url" => $base_url,
                "sessionActive" => $this->sessionActive
            ]
        );
    }

    public function login(Request $request) {
        $login = $request->get("login");
        $senha = hash("sha256", $request->get("password"));
        $session = new SessionControl();
        $base_url = SessionControl::getBaseUrl();

        try {
            $usuarios = new Usuarios();
            $getUsuarios = $usuarios->getUsuarios($login, $login);
            if($getUsuarios == 400) {
                throw new Exception("Nenhum Usuário encontrado");
            }
            $usuario = $getUsuarios[0];
            if($usuario->senha != $senha) {
                throw new Exception("Senha incorreta");
            }
            $session->startSession($usuario, "usuario");

            header("Location: {$base_url}/");

        } catch (Exception $e) {
            header("Location: {$base_url}/login?message={$e->getMessage()}");
        }
    }

    public function logout() {
        $session = new SessionControl();
        $base_url = SessionControl::getBaseUrl();

        $session->closeSession();
        header("Location: {$base_url}/");
    }

    public function create() {
        $session = new SessionControl();
        $base_url = SessionControl::getBaseUrl();
        return self::view("auth/cadastro", 
            [
                "base_url" => $base_url,
                "sessionActive" => $this->sessionActive
            ]
        );
    }
    public function store(Request $request) {
        $usuarios = new Usuarios();
        $session = new SessionControl();
        $base_url = SessionControl::getBaseUrl();

        try {
            $sendRequest = $usuarios->create($request);
            if($sendRequest->status == 200) {
                $usuario = $sendRequest->data;
                $session->startSession($usuario, "usuario");
                header("Location: {$base_url}/");
            } else {
                throw new Exception($sendRequest->data);
            }
        } catch (Exception $e) {
            header("Location: {$base_url}/cadastrar?message={$e->getMessage()}");
        }
    }
}