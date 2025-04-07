<h1>Editr Usuário</h1>

<?php 
    if (isset($this->data['form'])) {
        $valorForm = $this->data['form'];
    }

    if (isset($this->data['form'][0])) {
        $valorForm = $this->data['form'][0];
    }

    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
?>
<span id="msg"></span>

<form action="" method="post">
    <?php
        $id = "";
        if (isset($valorForm['id'])) {
            $id = $valorForm['id'];
        }
    ?>
    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

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

    <button type="submit" name="EditUser" value="Editar">Editar</button>
</form>