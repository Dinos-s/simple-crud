<?php 
    if (isset($this->data['form'])) {
        $valorForm = $this->data['form'];
    }

    if (isset($this->data['form'][0])) {
        $valorForm = $this->data['form'][0];
    }
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand text-decoration-none" href="<?= URL; ?>dashboard/index">Crud Simples</a>

        <h2 class="text-white">Editar Usuário</h2>

        <div class="d-flex align-items-center">
            <span class="navbar-text text-white me-3">
                Bem vindo, <?php echo $_SESSION['user_nome']; ?>!
            </span>
            
            <a href="<?php echo URL; ?>logout/index" class="btn btn-outline-danger">
               Sair
            </a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <span id="msg" class="d-block text-center mb-3">
                        <?php 
                            if (isset($_SESSION['msg'])) {
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                            }
                        ?>
                    </span>

                    <form action="" method="post" id="form-edit-user">
                        <?php
                            $id = "";
                            if (isset($valorForm['id'])) {
                                $id = $valorForm['id'];
                            }
                        ?>
                        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

                        <div class="mb-3">
                            <?php 
                                $nome = "";
                                if (isset($valorForm['nome'])) {
                                    $nome = $valorForm['nome'];
                                }
                            ?>
                            <label>Nome:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome completo" value="<?php echo $nome;?>" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <?php 
                                $email = "";
                                if (isset($valorForm['email'])) {
                                    $email = $valorForm['email'];
                                }
                            ?>
                            <label>E-mail:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Digite o email válido" value="<?php echo $email;?>" required>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" name="EditUser" value="Editar">Editar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>