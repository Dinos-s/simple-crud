<!-- <h1>Área Restrita</h1> -->

<?php 
    // if (isset($_SESSION['msg'])) {
    //     echo $_SESSION['msg'];
    //     unset($_SESSION['msg']);
    // }

    if (isset($this->data['form'])) {
        $valorForm = $this->data['form'];
    }
?>
<!-- <span id="msg"></span>

<form action="" method="post" id="form-login">

    <?php 
        $user = "";
        if (isset($valorForm['user'])) {
            $user = $valorForm['user'];
        }
    ?>
    <label>Usuário: </label>
    <input type="text" name="user" id="user" placeholder="Digíte o nome do usuário" value="<?php echo $user ?>" required>

    <?php 
        $password = "";
        if (isset($valorForm['password'])) {
            $password = $valorForm['password'];
        }
    ?>
    <label>Senha: </label>
    <input type="password" name="password" id="password" placeholder="Digíte a senha" value="<?php echo $password ?>" required>

    <button type="submit" name="Login" value="Acessar">Acessar</button>
</form>
<a href="<?php echo URL;?>user/index">Cadastrar</a> -->

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title text-center mb-0">Login</h3>
                </div>
                <div class="card-body">
                    <span id="msg" class="d-block text-center mb-3">
                    <?php 
                        if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                    ?>
                    </span>

                    <form action="" method="post" id="form-login">
                        <div class="mb-3">
                            <label for="user" class="form-label">Usuário</label>
                            <?php 
                                $user = "";
                                if (isset($valorForm['user'])) {
                                    $user = $valorForm['user'];
                                }
                            ?>
                            <input type="text" class="form-control" name="user" id="user" 
                                   placeholder="Digite o nome do usuário" 
                                   value="<?php echo $user ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <?php 
                                $password = "";
                                if (isset($valorForm['password'])) {
                                    $password = $valorForm['password'];
                                }
                            ?>
                            <input type="password" class="form-control" name="password" id="password" 
                                   placeholder="Digite a senha"
                                   value="<?php echo $password ?>" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" name="Login" value="Acessar">
                                <i class="fas fa-sign-in-alt"></i> Acessar
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-3 signup-link">
                        <a href="<?php echo URL;?>user/index">Cadastrar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>