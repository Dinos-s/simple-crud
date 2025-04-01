<?php 
    namespace App\Model\helpers;

    use PDO, PDOException;

    abstract class Conn {
        private string $host = HOST;
        private string $user = USER;
        private string $pass = PASS;
        private string $dbname = DBNAME;
        private int|string $port = PORT; 

        private object $connect;

        /**
         * Realiza conexão com o banco de dados;
         * Se a conexão não for realizada corretamente, uma mensagem de erro é aprensetada;
        */
        protected function connectBD():object {
            try {
                // Conexão com o banco de dados;
                $this->connect = new PDO("mysql:host={$this->host};port={$this->port};dbname={$this->dbname}", $this->user, $this->pass);

                return $this->connect;
            } catch (PDOException $err) {
                die("Erro - 001: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
            }
        }
    }
?>