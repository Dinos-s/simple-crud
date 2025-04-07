<a href="<?= URL; ?>logout/index">Sair</a><br>
<a href="<?= URL; ?>user/edit/1">Editar</a><br>
<a href="<?= URL; ?>user/list">Listagem</a><br>

<?php
   // var_dump($_SESSION);
   echo "VIEW - Página Dashboard!<br>";
   echo $this->data . " " . $_SESSION['user_nome'] . "!<br>";
?>