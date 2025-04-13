<?php 
    namespace Core;

    // Configurações básicas no site
    abstract class Config {
        protected function config():void {
            define('URL', 'http://localhost/simple_crud/'); //--> Se estiver usando docker, utilize apenas 'http://localhost/';

            define('CONTROLLER', 'Login');
            define('METODO', 'index');
            define('CONTROLLER_ERRO', 'Login');
            
            define('EMAILADM', 'gabriel@gmail.com');

            /** 
             * Variáveis de conexão com o banco de dados;
             * Mude para se adaptar ao seu projeto, caso nescessário;
            */
            define('HOST', 'localhost'); //--> Mude para 'db' para acessar o banco via docker;
            define('USER', 'root');
            define('PASS', '0000');
            define('DBNAME', 'crudSimple');
            define('PORT', 3306);
        }
    }
?>