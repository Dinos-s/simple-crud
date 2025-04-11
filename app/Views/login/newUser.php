<?php
    if (isset($this->data['form'])) {
        $valorForm = $this->data['form'];
    }

    if (isset($this->data['form'][0])) {
        $valorForm = $this->data['form'][0];
    }
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h2 class="card-title text-center">Cadastro de Usuário</h2>
                </div>
                <div class="card-body">
                    <span id="msg" class="d-block text-center">
                        <?php 
                            if (isset($_SESSION['msg'])) {
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                            }
                        ?>
                    </span>

                    <form action="" method="post" id="form-new-user">
                        
                        <div class="mb-3">
                            <label>Nome:</label>
                            <?php 
                                $nome = "";
                                if (isset($valorForm['nome'])) {
                                    $nome = $valorForm['nome'];
                                }
                            ?>

                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome completo" value="<?php echo $nome;?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>E-mail:</label>
                            <?php 
                                $email = "";
                                if (isset($valorForm['email'])) {
                                    $email = $valorForm['email'];
                                }
                            ?>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>

                                <input type="email" class="form-control" id="email" name="email" placeholder="Digite o email válido" value="<?php echo $email;?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Senha:</label>
                            <?php 
                                $password = "";
                                if (isset($valorForm['password'])) {
                                    $password = $valorForm['password'];
                                }
                            ?>
                            
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-key"></i></span>

                                <input type="password" class="form-control" id="password" name="password" placeholder="Digite a senha" value="<?php echo $password;?>" onkeyup="forceSenha()" required>
                            </div>
                        </div>

                        <div class="mb-0">
                            <label>Confirmar Senha:</label>

                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-key"></i></span>

                                <input type="password" class="form-control" name="confirmPass" id="confirmPass" placeholder="Confirme sua senha" required onkeyup="compareSenhas()">
                            </div>
                            
                            <span id="msgConfirmPass"><br></span>
                            <span id="msgViewStrength"></span>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" name="NewUser" value="Cadastrar"><i class="fa-solid fa-plus"></i> Cadastrar</button>
                        </div>
                    </form>

                    <div class="text-center mt-3 signup-link small text-muted">
                        <a href="<?= URL; ?>">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





