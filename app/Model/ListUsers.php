<?php 
    namespace App\Model;

    class ListUsers {
        private bool $result;
        private array|null $resultBD;

        /**
         * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
         */
        function getResult(): bool
        {
            return $this->result;
        }

        /**
         * @return bool Retorna os registros do BD
         */
        function getResultBD(): array|null
        {
            return $this->resultBD;
        }

        public function listUsers() {
            $listUsers = new \App\Model\helpers\Read();
            $listUsers->fullRead(
                "SELECT id, nome, email FROM users"
            );

            $this->resultBD = $listUsers->getResult();        
            if($this->resultBD){
                $this->result = true;
            }else{
                $_SESSION['msg'] = "<p style='color: #f00'>Erro: Nenhum usuário encontrado!</p>";
                $this->result = false;
            }
        }
    }
?>