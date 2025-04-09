<?php 
    namespace App\Model;

    class ViewUser {
        /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
        private bool $result = false;

        /** @var array|null $resultBD Recebe os registros do banco de dados */
        private array|null $resultBD;

        /** @var int|string|null $id Recebe o id do registro */
        private int|string|null $id;

        /**
         * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
        */
        function getResult(): bool
        {
            return $this->result;
        }

        /**
         * @return bool Retorna os detalhes do registro
        */
        function getResultBd(): array|null
        {
            return $this->resultBD;
        }

        /**
         * Verifica se o usuário realmente no banco de dados;
         * Caso exista, retorna um true;
         * Caso não, retorna um false e uma mensagem de erro;
        */
        public function viewUser(int $id):void {
            $this->id = $id;

            $viewUser = new \App\Model\helpers\Read();
            $viewUser->fullRead(
                "SELECT id, nome, email FROM users WHERE id=:id",
                "id={$this->id}"
            );

            $this->resultBD = $viewUser->getResult();
            if ($this->resultBD) {
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert alert-danger;'>Erro: Usuário não encontrado!</p>";
                $this->result = false;
            }
        }
    }
?>