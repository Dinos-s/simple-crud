<a href="<?= URL; ?>logout/index">Sair</a><br>

<?php
   // var_dump($_SESSION);
   if (isset($_SESSION['msg'])) {
      echo $_SESSION['msg'];
      unset($_SESSION['msg']);
   }

   echo "<span id='msg'></span>";

   echo "VIEW - Página Dashboard!<br>";
   echo "Bem Vindo: $_SESSION[user_nome]!<br>";
   echo"<br>";
   foreach ($this->data['listUsers'] as $user) {
      // var_dump($user);
      extract($user);
      //echo "ID: " . $user['id'] . "<br>";
      echo "ID: $id <br>";
      echo "Nome: $nome <br>";
      echo "E-mail: $email <br>";
  
      echo "<a href='" . URL . "view-users/index/$id'>Visualizar</a><br>";
      
      echo "<a href='" . URL . "user/edit/$id'>Editar</a><br>";
  
      echo "<a href='" . URL . "delete-users/index/$id' onclick='return confirm(\"Tem certeza que desaja apagar este registro?\")'>Apagar</a><br>";
      
      echo "<hr>";
   }
?>