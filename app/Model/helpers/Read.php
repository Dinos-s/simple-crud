<?php 
    namespace App\Model\helpers;

    use PDO, PDOException;

    // Classe Genérica para selecionar um registro no banco de dados;
    class Read extends Conn {

        /** @var string $select Recebe o QUERY */
        private string $select;

        /** @var array $values Recebe os valores que deve ser atribuidos nos link da QUERY com bindValue */
        private array $values = [];

        /** @var array $result Recebe os registros do banco de dados e retorna para a Models */
        private array|null $result;

        /** @var object $query Recebe a QUERY preparada */
        private object $query;

        /** @var object $conn Recebe a conexao com BD */
        private object $conn;

        // Retorna um array de dados;
        function getResult():array|null {
            return $this->result;
        }

        /**
         * Recebe os valores para montar a QUERY;
         * Converte o parseSting de string para array; 
         * @param string $query Recebe a QUERY da Model;
         * @param string $parseString Recebe o valores que devem ser subtituidos no link, ex: sts_situation_id=1;
        */
        public function fullRead(string $query, string|null $parseString = null):void {
            $this->select = $query;
            if (!empty($parseString)) {
                parse_str($parseString, $this->values);
            }
            $this->exeInstruction();
        }

        /**
         * Execute a QUERY;
         * Ao executar a query com sucesso, retorna o array de dados, senão retorna null;
        */
        private function exeInstruction():void {
            $this->connection();
            try {
                $this->exeParameter();
                $this->query->execute();
                $this->result = $this->query->fetchAll();
            } catch (PDOException $err) {
                $this->result = null;
            }
        }

        /**
         * Obtem a conexão com o banco de dados, pela classe pai "Conn";
         * Prepara a instrução para a excução e retorna um objeto de instrução;
        */
        private function connection():void {
            $this->conn = $this->connectBD();
            $this->query = $this->conn->prepare($this->select);
            $this->query->setFetchMode(PDO::FETCH_ASSOC);
        }

        /**
         * Substitui os link da QUERY pelo valores utilizando o bindValue;
        */
        private function exeParameter():void {
            if ($this->values) {
                foreach ($this->values as $link => $value) {
                    if (($link == 'limit') or ($link == 'offset') or ($link == 'id')) {
                        $value = (int) $value;
                    }

                    $this->query->bindValue(":{$link}", $value, (is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR));
                }
            }
        }
    }
?>