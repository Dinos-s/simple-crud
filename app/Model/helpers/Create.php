<?php 
    namespace App\Model\helpers;

    use PDOException;

    // Classe genérica para cadastro no banco;
    class Create extends Conn {
        private string $table;
        private array $data;
        private string|null $result = null;
        private object $insert;
        private string $query;
        private object $conn;

        /**
         * Retornar o status do cadastro, retorna o último id quando cadatrar com sucesso e null quando houver erro;
         */
        function getResult():string {
            return $this->result;
        }

        /**
         * Cadastra no banco de dados;
         * @param string $table Recebe o nome da tabela;
         * @param array $data Recebe os dados do formulário;
        */
        public function exeCreate(string $table, array $data):void {
            $this->table = $table;
            $this->data = $data;
            $this->exeReplaceValues();
        }

        /**
         * Cria a QUERY e, substitui o links da QUERY;
        */
        private function exeReplaceValues():void {
            $coluns = implode (', ', array_keys($this->data));
            $values = ':' . implode(', :', array_keys($this->data));
            $this->query = "INSERT INTO {$this->table} ($coluns) VALUES ($values)";
            $this->exeInstruction();
        }

        /**
         * Executa a QUERY;
         * Quando executa a query com sucesso, retorna o último id inserido, senão retorna um null;
        */
        private function exeInstruction():void {
            $this->connection();
            try {
                $this->insert->execute($this->data);
                $this->result = $this->conn->lastInsertId();
            } catch (PDOException $err) {
                $this->result = null;
            }
        }

        /**
         *  Obtém a conexão com o banco de dados da classe pai "Conn";
         * Prepara uma instrução para execução e retorna um objeto de instrução;
        */
        private function connection():void {
            $this->conn = $this->connectBD();
            $this->insert = $this->conn->prepare($this->query);
        }
    }
?>