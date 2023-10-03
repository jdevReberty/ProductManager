<?php
namespace app\models;

use app\models\Model;
use Exception;

class Produtos extends Model {
    public function __construct()
    {
        parent::__construct();
    }

    public function getProdutos(string $nome = null) : array|int {
        $produtos = [];
        $sql = "SELECT po.*, tp.nome as nomeTipoProduto FROM produtos po INNER JOIN tipos_produtos tp ON po.tipo_id = tp.id";
        $query = $this->connection->query($sql);
        if ($query->num_rows > 0) {
            $count = 0;
            while($item = $query->fetch_assoc()) {
                $produtos[$count++] = (object)$item;           
            }
            return $produtos;
        } else {
            return 400;
        }
    }

    public function create(object $data) : object|string {
        try {
            $sql = "INSERT INTO produtos (nome, descricao, preco, tipo_id)
                VALUES ('{$data->get('nome')}', '{$data->get('descricao')}', '{$data->get('preco')}', '{$data->get('tipo_id')}')";
            $query = $this->connection->query($sql);
            if(!$query) {
                throw new Exception("Error".$query." ".$this->connection->error);
            }

            return (object)["status" => 200, "data" => $this->getProdutos($data->get('nome'))[0]];
             
        } catch (\Exception $e) {
            return (object)["status" => 400, "data" => $e->getMessage()];
        }
    }
}
