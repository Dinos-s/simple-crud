<h1>Detalhes do usuário:</h1>

<?php 
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
        
    echo "<a href='" . URL . "user/edit/$id'>Editar</a><br>";

    echo "<a href='" . URL . "user/delete/$id' onclick='return confirm(\"Tem certeza que desaja apagar este registro?\")'>Apagar</a><br>";

    if ($this->data['viewUser']) {
        // var_dump($user);
        extract($this->data['viewUser'][0]);
        //echo "ID: " . $user['id'] . "<br>";
        echo "ID: $id <br>";
        echo "Nome: $nome <br>";
        echo "E-mail: $email <br>";
        
        echo "<hr>";
    }
?>