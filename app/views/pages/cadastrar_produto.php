<?php 
    $this->layout('app'); 
    include "includes/checkSession.php";
?>

<?php 
    if($usuario->tipo != "admin") {
        header("Location: $base_url/");
    } 
?>

<?php $this->start('navbar') ?>
    <p class="mx-2 mt-1">Bem vindo <?php echo ucwords($usuario->nome) ?></p>
    <div>
        <?php 
            if($usuario->tipo == "admin") {
                echo "<a class='btn btn-primary' href='{$base_url}/cadastrar/produto/tipo'>Cadastrar Tipo Produto</a>";
            } 
        ?>
        <a class="btn btn-sm-primary" href="<?php echo "{$base_url}/logout" ?>">Sair</a>
    </div>
<?php $this->stop() ?>

<!-- /* -------------------------------- conteudo -------------------------------- */ -->
<main class="row d-flex justify-content-center">
    <div class="card col-6">
        <form action="/produto/cadastrar" method="post">
            <header>
                <h2>Cadastrar Produto</h2>
            </header>
            <main class="d-flex flex-column">
                <div class="mb-3">
                  <label for="nome" class="form-label">Nome do Produto</label>
                  <input type="text" class="form-control" id="nome" name="nome" placeholder="" required/>
                </div>
                <div class="mb-3">
                  <label for="descricao" class="form-label">Descrição</label>
                  <textarea type="text" class="form-control" id="descricao" name="descricao" placeholder="" required> </textarea>
                </div>
                <div class="mb-3">
                  <label for="preco" class="form-label">Preço</label>
                  <input type="text" class="form-control" id="preco" name="preco" placeholder="Apenas números" required/>
                </div>
                <?php
                    echo "
                    <div class='mb-3'>
                        <label for='tipo_id' class='form-label'>Tipo de Produto</label>
                        <select class='form-select' id='tipo_id' name='tipo_id' required>";

                        if($tiposProdutos == 400) {
                            echo "<option value='' selected disabled>Não há tipos de produtos cadastrados</option>";
                        } else {
                            echo "<option value='' selected disabled>Selecione um tipo de produto</option>";
                            foreach($tiposProdutos as $tipoProduto) {
                                echo "<option value='{$tipoProduto->id}'>{$tipoProduto->nome}</option>";
                            }
                        } 
                    echo "</select></div>";
                ?>
                
                <div class="d-flex mb-3 justify-content-end">
                    <button class="btn btn-primary" <?php (($tiposProdutos == 400) ?  print("disabled") :  print("type='submit'"))  ?> >Cadastrar</button>
                </div>
            </main>
        </form>
        <?php 
            if(!empty($_GET["message"])) {
                echo "
                    <div class=''>
                        <hr/>
                        <p class='text-danger'>{$_GET["message"]}</p>
                    </div> 
                ";
            } 
        ?>
    </div>
</main>




