<?php 
namespace app\controllers;

use app\auth\SessionControl;
use app\controllers\Controller;
use app\models\Produtos;
use app\models\TiposProdutos;
use app\services\Request;
use Exception;

class ProdutoController extends Controller {
    private $sessionActive;

    public function __construct()
    {
        $this->sessionActive = SessionControl::checkSession();
    }
    public function index() {
        $tiposProdutos = new TiposProdutos();
        $tiposProdutos = $tiposProdutos->getTiposProdutos();

        $session = new SessionControl();
        $usuario = $session->getUsuario();

        $base_url = SessionControl::getBaseUrl();
        return self::view("pages/cadastrar_produto", 
            [
                "sessionActive" => $this->sessionActive,
                "usuario" => $usuario,
                "base_url" => $base_url,
                "tiposProdutos" => $tiposProdutos
            ]
        );
    }

    public function store(Request $request) {
        $produtos = new Produtos();
        $session = new SessionControl();
        $base_url = SessionControl::getBaseUrl();

        try {
            $sendRequest = $produtos->create($request);
            if(!$sendRequest->status == 200) {
                throw new Exception($sendRequest->data);
            } else {
                header("Location: {$base_url}/");
            }
        } catch (Exception $e) {
            header("Location: {$base_url}/cadastrar/produto?message={$e->getMessage()}");
        }
    }

    public function createTipoProduto() {

        $session = new SessionControl();
        $usuario = $session->getUsuario();

        $base_url = SessionControl::getBaseUrl();
        return self::view("pages/cadastrar_tipo_produto", 
            [
                "sessionActive" => $this->sessionActive,
                "usuario" => $usuario,
                "base_url" => $base_url,
            ]
        );
    }

    public function storeTipoProduto(Request $request) {
        $tiposProdutos = new TiposProdutos();
        $session = new SessionControl();
        $base_url = SessionControl::getBaseUrl();

        try {
            $sendRequest = $tiposProdutos->create($request);
            if(!$sendRequest->status == 200) {
                throw new Exception($sendRequest->data);
            } else {
                header("Location: {$base_url}/cadastrar/produto");
            }
        } catch (Exception $e) {
            header("Location: {$base_url}/cadastrar/produto/tipo?message={$e->getMessage()}");
        }
    }
}