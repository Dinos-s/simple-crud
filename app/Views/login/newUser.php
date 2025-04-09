<h1>Cadastro de Usuário</h1>

<?php 
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
?>
<span id="msg"></span>

<form action="" method="post" id="form-new-user">
    <?php 
        $nome = "";
        if (isset($valorForm['nome'])) {
            $nome = $valorForm['nome'];
        }
    ?>
    <label>Nome:</label>
    <input type="text" id="nome" name="nome" placeholder="Digite o nome completo" value="<?php echo $nome;?>" required>

    <?php 
        $email = "";
        if (isset($valorForm['email'])) {
            $email = $valorForm['email'];
        }
    ?>
    <label>E-mail:</label>
    <input type="email" id="email" name="email" placeholder="Digite o email válido" value="<?php echo $email;?>" required>

    <?php 
        $password = "";
        if (isset($valorForm['password'])) {
            $password = $valorForm['password'];
        }
    ?>
    <label>Senha:</label>
    <input type="password" id="password" name="password" placeholder="Digite a senha" value="<?php echo $password;?>" onkeyup="forceSenha()" required>

    <label>Confirmar Senha:</label>
    <input type="password" name="confirmPass" id="confirmPass" placeholder="Confirme sua senha" required onkeyup="compareSenhas()">
    <span id="msgConfirmPass"><br></span>
    <span id="msgViewStrength"></span>

    <button type="submit" name="NewUser" value="Cadastrar">Cadastrar</button>
</form>
<a href="<?= URL; ?>">Login</a>