<h1>Cadasstro de Usuário</h1>

<form action="" method="post">
    <?php 
        $nome = "";
        if (isset($valorForm['nome'])) {
            $nome = $valorForm['nome'];
        }
    ?>
    <label>Nome:</label>
    <input type="text" name="nome" placeholder="Digite o nome completo" value="<?php echo $name;?>" required>

    <?php 
        $email = "";
        if (isset($valorForm['email'])) {
            $email = $valorForm['email'];
        }
    ?>
    <label>E-mail:</label>
    <input type="email" name="email" placeholder="Digite o email válido" value="<?php echo $email;?>" required>

    <?php 
        $password = "";
        if (isset($valorForm['password'])) {
            $password = $valorForm['password'];
        }
    ?>
    <label>Senha:</label>
    <input type="text" name="password" placeholder="Digite a senha" value="<?php echo $password;?>" required>

    <button type="submit" name="NewUser" value="Cadastrar">Cadastrar</button>
</form>
<a href="<?= URL ?> login/index">Login</a>