    <?php 
        $this->layout('app'); 
        include "includes/checkSession.php";
    ?>

    <?php $this->start('navbar') ?>
        <p class="mx-2 mt-1">Bem vindo <?php echo ucwords($usuario->nome) ?></p>
        
        <div>
            <?php 
                if($usuario->tipo == "admin") {
                    echo "<a class='btn btn-primary' href='{$base_url}/cadastrar/produto'>Cadastrar Produtos</a>";
                } 
            ?>
            <a class="btn btn-sm-primary" href="<?php echo "{$base_url}/logout" ?>">Sair</a>
        </div>
    <?php $this->stop() ?>
    
    <div>
        <header class="mb-3">
            <h2>Tabela de Produtos</h2>
        </header>
        <main class="card">
            <?php 
                if($produtos == 400) {
                    echo "
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Preço</th>
                                    <th>Tipo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan='5' class='text-center'>Não há produtos cadastrados</td>
                                </tr>
                            </tbody>
                        </table>";
                    // echo "<h2>Não há produtos cadastrados</h2>";
                } else {
                    echo "<table class='table'>";
                    echo "
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Preço</th>
                                <th>Tipo</th>
                            </tr>
                        </thead>
                    ";
                    echo "<tbody>";
                        foreach($produtos as $key => $produto) {
                            $preco = number_format($produto->preco, 2, ',', '.');
                            $count = $key+1;
                            echo "<tr>
                                <th>{$count}</th>
                                <td>{$produto->nome}</td>
                                <td>{$produto->descricao}</td>
                                <td>R$ {$preco}</td>
                                <td>{$produto->nomeTipoProduto}</td>
                            </tr>";
                        }
                    echo "</tbody>
                    </table>";
                }
                // if($usuario->tipo == "comum") {

                // }
            ?>
        </main>
    </div>




