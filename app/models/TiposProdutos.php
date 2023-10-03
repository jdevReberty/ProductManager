<?php
namespace app\models;

use app\models\Model;
use Exception;

class TiposProdutos extends Model {
    public function __construct()
    {
        parent::__construct();
    }

    public function getTiposProdutos(string $nome = null) {
        $tipos_produtos = [];
        $sql = ($nome == null ? "SELECT * FROM tipos_produtos" : "SELECT * FROM tipos_produtos WHERE nome = '{$nome}'");
        $query = $this->connection->query($sql);
        
        if ($query->num_rows > 0) {
            $count = 0;
            while($item = $query->fetch_assoc()) {
                $tipos_produtos[$count++] = (object)$item;           
            }
            return $tipos_produtos;
        } else {
            return 400;
        }
    }

    public function create(object $data) : object|string {
        try {
            $sql = "INSERT INTO tipos_produtos (nome)
                VALUES ('{$data->get('nome')}')";
            $query = $this->connection->query($sql);
            if(!$query) {
                throw new Exception("Error".$query." ".$this->connection->error);
            }

            return (object)["status" => 200, "data" => $this->getTiposProdutos($data->get('nome'))[0]];
             
        } catch (\Exception $e) {
            return (object)["status" => 400, "data" => $e->getMessage()];
        }
    }
}