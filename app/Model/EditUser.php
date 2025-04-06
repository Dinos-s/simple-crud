<?php 
    namespace App\Model;

    class EditUser {
        /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
        private bool $result = false;

        /** @var array|null $resultBD Recebe os registros do banco de dados */
        private array|null $resultBD;

        /** @var int|string|null $id Recebe o id do registro */
        private int|string|null $id;

        /** @var array|null $data Recebe as informações do formulário */
        private array|null $data;

        /** @var array|null $dataExitVal Recebe os campos que devem ser retirados da validação */
        private array|null $dataExitVal;

        function getResult():bool {
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
         * Verifiaca se o usário realmente existe;
         * Caso exista, retorna um true;
         * Caso não, retorna uma mensagem de erro e um false;
        */
        public function viewUser(int $id) {
            $this->id = $id;
            
            $viewUser = new \App\Model\helpers\Read();
            $viewUser->fullRead(
                "SELECT id, nome, email FROM users WHERE id =:id",
                "id={$this->id}"
            );

            $this->resultBD = $viewUser->getResult();
            if ($this->resultBD) {
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p style='color: #f00'>Erro: Usuário não encontrado!</p>";
                $this->result = false;
            }
        }

        /**
         * Aqui pega os dados que são enviados do formulário de edição e verifica se todos os campos são preencidos;
         * Se os campos forem preenchidos corretamente, chama o 'edit';
         * Se não, retorna um erro;
        */
        public function update(array $data = null):void {
            $this->data = $data;

            $campoVazio = new \App\Model\helpers\ValEmptyField();
            $campoVazio->valField($this->data);
            if ($campoVazio->getResult()) {
                $this->edit();
            } else {
                $this->result = false;
            }
        }

        /**
         * Puxa o helper de atualização na tabela e atualiza os dados;
         * Se verdadeiro, envia uma mensagem de sucesso com true;
         * Se não, evia uma mensagem de falha com false;
        */
        private function edit():void {
            $upUser = new \App\Model\helpers\Update();
            $upUser->exeUpdate("users", $this->data, "WHERE id =:id", "id={$this->data['id']}");

            if ($upUser->getResult()) {
                $_SESSION['msg'] = "<p style='color: green;'>Usuário editado com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não editado com sucesso!</p>";
                $this->result = false;
            }
        }
    }
?>