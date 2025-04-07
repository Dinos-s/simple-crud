<?php 
    namespace App\Model\helpers;

    use PDOException;

    // Classe genérica para deletar um registro do banco;
    class Delete extends Conn {
        private string $table;
        private string|null $terms;
        private array $value = [];
        private string|null|bool $result;
        private object $delete;
        private string $query;
        private object $conn;

        function getResult(): string|null|bool
        {
            return $this->result;
        }

        /**
         * Recebe os valores para montar a QUERY;
         * Converte a parseString de string para array;
         * @param string $table Recebe o nome da tabela do banco de dados;
         * @param string $terms Recebe os links da QUERY, ex: sts_situation_id =:sts_situation_id;
         * @param string $parseString Recebe o valores que devem ser subtituidos no link, ex: sts_situation_id=1;
        */
        public function exeDelete(string $table, string|null $terms = null, string|null $parseString = null): void {
            $this->table = $table;
            $this->terms = $terms;

            parse_str($parseString, $this->value);

            $this->query = "DELETE FROM {$this->table} {$this->terms}";

            $this->exeInstruction();
        }

        /**
         * Executa a QUERY; 
         * Quando executa a query com sucesso retorna o array de dados, senão retorna null;
        */
        private function exeInstruction(): void {
            
            $this->connection();
            try {
                $this->delete->execute($this->value);
                $this->result = true;
            } catch (PDOException $err) {
                $this->result = false;
            }
        }

        /**
         * Obtem a conexão com o banco de dados da classe pai "Conn".
         * Prepara uma instrução para execução e retorna um objeto de instrução.
         * 
         * @return void
         */
        private function connection(): void {
            $this->conn = $this->connectBD();
            $this->delete = $this->conn->prepare($this->query);
        }
    }
?>