<h1>Área Restrita</h1>

<form action="" method="post">

    <?php 
        $user = "";
        if (isset($valorForm['user'])) {
            $user = $valorForm['user'];
        }
    ?>
    <label>Usuário: </label>
    <input type="text" name="user" placeholder="Digíte o nome do usuário" value="<?php echo $user ?>">

    <?php 
        $password = "";
        if (isset($valorForm['password'])) {
            $password = $valorForm['password'];
        }
    ?>
    <label>Senha: </label>
    <input type="password" name="password" placeholder="Digíte a senha" value="<?php echo $password ?>">

    <button type="submit" name="Login" value="Acessar">Acessar</button>
</form>
<a href="#">Cadastrar</a>