<?php
namespace app\models;

use app\models\Model;
use Exception;

class Usuarios extends Model {
    
    public function __construct()
    {
        parent::__construct();
    }

    public function getUsuarios(string $username = null, string $email = null, string $password = null) : array|int {
        $usuarios = [];
        if($username != null || $email != null) {
            $sql = "SELECT * FROM usuarios WHERE username = '{$username}' OR email = '{$email}'";
            $query = $this->connection->query($sql);
        } else {
            $query = $this->connection->query("SELECT * FROM usuarios");
        }
        
        if ($query->num_rows > 0) {
            $count = 0;
            while($item = $query->fetch_assoc()) {
                $usuarios[$count++] = (object)$item;           
            }
            return $usuarios;
        } else {
            return 400;
        }
    }

    public function create(object $data) : object|string {
        try {
            $criptoSenha = hash('sha256', $data->get('password'));
            $sql = "INSERT INTO usuarios (nome, email, username, tipo, senha)
                VALUES ('{$data->get('nome')}', '{$data->get('email')}', '{$data->get('usuario')}', '{$data->get('tipo')}', '{$criptoSenha}')";
            $query = $this->connection->query($sql);
            if(!$query) {
                throw new Exception("Error".$query." ".$this->connection->error);
            }

            return (object)["status" => 200, "data" => $this->getUsuarios($data->get('usuario'), $data->get('email'))[0]];
             
        } catch (\Exception $e) {
            return (object)["status" => 400, "data" => $e->getMessage()];
        }
    }
}