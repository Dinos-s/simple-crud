<?php 
    session_start();
    ob_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Simples MVC</title>
</head>
<body>
    <h1>Testes de Redirocionamento</h1>
    <?php 
        //Carregar o Composer
        require './vendor/autoload.php';

        //Instanciar a classe ConfigController, responsável em tratar a URL
        $home = new Core\ConfigController();

        //Instanciar o método para carregar a página/controller
        $home->loadPage();
    ?>
</body>
</html>