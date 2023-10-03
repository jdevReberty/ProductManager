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
                echo "<a class='btn btn-primary' href='{$base_url}/cadastrar/produto'>Cadastrar Produto</a>";
            } 
        ?>
        <a class="btn btn-sm-primary" href="<?php echo "{$base_url}/logout" ?>">Sair</a>
    </div>
<?php $this->stop() ?>

<!-- /* -------------------------------- conteudo -------------------------------- */ -->
<main class="row d-flex justify-content-center">
    <div class="card col-6">
        <form action="/produto/cadastrar/tipo" method="post">
            <header>
                <h2>Cadastrar Tipo de Produto</h2>
            </header>
            <main class="d-flex flex-column">
                <div class="mb-3">
                  <label for="nome" class="form-label">Nome</label>
                  <input type="text" class="form-control" id="nome" name="nome" placeholder="" required/>
                </div>
                
                <div class="d-flex mb-3 justify-content-end">
                    <button class="btn btn-primary" type="submit" >Cadastrar</button>
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




