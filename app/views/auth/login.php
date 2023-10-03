<!-- /* ----------------- Layout que será renderizado no app.php ----------------- */ -->
<?php

use app\auth\SessionControl;

 $this->layout('app') ?>

<?php 
    $base_url = SessionControl::getBaseUrl();
    if($this->e($sessionActive) == 200) {
        header("Location: {$base_url}/");
    }
?>

<!-- /* ---------------------- sessão que renderizará os css --------------------- */ -->
<?php $this->start('css') ?>
    <style>
        * {
            background-color: white;
        }
    </style>
<?php $this->stop() ?>

<!-- /* ---------------------------- sessão da navbar ---------------------------- */ -->
<?php $this->start('navbar') ?>
    <p class="mx-2 mt-1">Bem vindo</p>
    <a class="btn btn-sm-primary" href="<?php echo "{$base_url}/cadastrar" ?>">Cadastre-se</a>
<?php $this->stop() ?>

<!-- /* -------------------------------- conteudo -------------------------------- */ -->
<main class="row d-flex justify-content-center">
    <div class="card col-6">
        <form action="/login/entrar" method="post">
            <header>
                <h2>Formulário de Login</h2>
            </header>
            <main class="d-flex flex-column">
                <div class="mb-3">
                  <label for="login" class="form-label">E-mail ou usuário</label>
                  <input type="text" class="form-control" id="login" name="login" placeholder="nome@exemplo.com"/>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Senha</label>
                  <input type="password" class="form-control" id="password" name="password"/>
                </div>
                <div class="d-flex mb-3 justify-content-end">
                    <button class="btn btn-primary" type="submit">Entrar</button>
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

<!-- /* -------------------- sessão que renderizará os scripts ------------------- */ -->
<?php $this->start('script') ?>

<?php $this->stop() ?>

