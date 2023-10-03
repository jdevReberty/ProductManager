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
    <a class="btn btn-sm-primary" href="<?php echo "{$base_url}/login" ?>">Login</a>
<?php $this->stop() ?>

<!-- /* -------------------------------- conteudo -------------------------------- */ -->
<main class="row d-flex justify-content-center">
    <div class="card col-6">
        <form action="/login/cadastrar" method="post">
            <header>
                <h2>Formulário de Cadastro</h2>
            </header>
            <main class="d-flex flex-column">
                <div class="mb-3">
                  <label for="nome" class="form-label">Nome Completo</label>
                  <input type="text" class="form-control" id="nome" name="nome" placeholder="" required/>
                </div>
                <div class="mb-3">
                  <label for="usuario" class="form-label">Usuário</label>
                  <input type="text" class="form-control" id="usuario" name="usuario" placeholder="" required/>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">E-mail</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="nome@exemplo.com" required/>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Senha</label>
                  <input type="password" class="form-control" id="password" name="password" required/>
                </div>
                <div class="mb-3">
                  <label for="tipo" class="form-label">Nível de acesso</label>
                  <select type="tipo" class="form-select" id="tipo" name="tipo" required>
                    <option value="" selected disabled>Selecione um nível de acesso</option>
                    <option value="comum">Comum</option>
                    <option value="admin">Administrador</option>
                  </select>
                </div>
                <div class="d-flex mb-3 justify-content-end">
                    <button class="btn btn-primary" type="submit">Cadastrar</button>
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

