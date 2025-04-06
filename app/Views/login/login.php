<h1>Área Restrita</h1>

<?php 
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
?>
<span id="msg"></span>

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
    <input type="password" name="password" id="password" placeholder="Digíte a senha" onkeyup="forceSenha()" value="<?php echo $password ?>" required>

    <button type="submit" name="Login" value="Acessar">Acessar</button>
</form>
<a href="<?php echo URL;?>user/index">Cadastrar</a>