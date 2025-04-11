<?php
    if (isset($this->data['form'])) {
        $valorForm = $this->data['form'];
    }
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
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
                            <label class="form-label">Usuário</label>
                            <?php 
                                $user = "";
                                if (isset($valorForm['user'])) {
                                    $user = $valorForm['user'];
                                }
                            ?>
                            
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                                <input type="text" class="form-control" name="user" id="user" placeholder="Digite o email do usuário" value="<?php echo $user ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <?php 
                                $password = "";
                                if (isset($valorForm['password'])) {
                                    $password = $valorForm['password'];
                                }
                            ?>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Digite a senha" value="<?php echo $password ?>" required>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" name="Login" value="Acessar">
                                <i class="fas fa-sign-in-alt"></i> Acessar
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-3 signup-link small text-muted">
                        <a href="<?php echo URL;?>user/index">Cadastrar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>