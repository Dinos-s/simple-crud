<a href="<?= URL; ?>logout/index">Sair</a><br>

<?php
   // var_dump($_SESSION);
   echo "VIEW - Página Dashboard!<br>";
   echo $this->data . " " . $_SESSION['user_nome'] . "!<br>";
?>