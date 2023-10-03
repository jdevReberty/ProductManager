<?php 

namespace app\auth;

class SessionControl {

    static function checkSession() {
        session_start();
        $sessionActive = (session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE) && isset($_SESSION['usuario']);
        if (!$sessionActive){
            return 400; // não há sessão
        } else {
            return 200; // sessão ativa
        }
    }

    public function getUsuario() : object|null{
        // session_start();
        if(!isset($_SESSION['usuario'])) {
            return null;
        } else {
            return $_SESSION['usuario'];
        }
    }

    public function startSession(object $content, string $index) {
        session_start();
        $this->setSession($content, $index);
    }

    public function setSession(object $content, string $index) {
        session_start();
        $_SESSION[$index] = $content;
    }

    public function claseSession() : bool|string {
        try {
            session_start();
            session_destroy();
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public static function getBaseUrl() {
        $url = parse_url($_SERVER["HTTP_HOST"]);
        $uri = parse_url($_SERVER["REQUEST_URI"])['path'];
        
        if(!isset($url['port'])) {
            $uri = explode("/public", $uri);
            $base_url = $uri[0]."/public";
        } else {
            $base_url = "http://{$url['host']}:{$url['port']}";
        }
        return $base_url;
    }
}