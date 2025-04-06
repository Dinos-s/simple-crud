<?php 
    namespace App\Model\helpers;

    use PDOException;

    class Update extends Conn {
        private string $table;
        private string|null $terms;
        private array $data;
        private array $value = [];
        private string|null|bool $result;
        private object $update;
        private string $query;
        private object $conn;

        function getResult():bool {
            return $this->result;
        }

        /**
         * Recebe os valores para montar a QUERY;
        * Converte a parseString de string para array;
        * @param string $table Recebe o nome da tabela do banco de dados;
        * @param string $terms Recebe os links da QUERY, ex: sts_situation_id =:sts_situation_id;
        * @param string $parseString Recebe o valores que devem ser subtituidos no link, ex: sts_situation_id=1;
        */
        public function exeUpdate(string $table, array $data, string|null $terms = null, string|null $parseString = null):void {
            $this->table = $table;
            $this->data = $data;
            $this->terms = $terms;

            parse_str($parseString, $this->value);

            $this->exeReplaceValues();
        }

        /**
         * Cria-se a query para inserir os valores que fora, informados no formulário;
         * Dentro do foreach, intera o array $data para que na query receba isso 'nome_campo=:nome_campo';
         * E informa a query os valores corretos;
        */
        private function exeReplaceValues():void {
            foreach($this->data as $key => $value) {
                $values[] = $key . "=:" . $key;
            }
            $values = implode(', ', $values);

            $this->query = "UPDATE {$this->table} SET {$values} {$this->terms}";

            $this->exeInstruction();
        }

        /**
         * Executa a QUERY; 
         * Quando executa a query com sucesso retorna o array de dados, senão retorna null;
        */
        private function exeInstruction() {
            $this->connection();
            try {
                $this->update->execute(array_merge($this->data, $this->value));
                $this->result = true;
            } catch (PDOException $err) {
                $this->result = null;
            }
        }

        /**
         * Obtem a conexão com o banco de dados da classe pai "Conn".
         * Prepara uma instrução para execução e retorna um objeto de instrução.
         * 
         * @return void
         */
        private function connection(): void
        {
            $this->conn = $this->connectBD();
            $this->update = $this->conn->prepare($this->query);
        }
    }
?>