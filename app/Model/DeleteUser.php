<?php 
    namespace App\Model;

    class DeleteUser {
        /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
        private bool $result = false;
    
        /** @var int|string|null $id Recebe o id do registro */
        private int|string|null $id;
    
        /** @var array|null $resultBD Recebe os registros do banco de dados */
        private array|null $resultBD;

        function getResult(): bool {
            return $this->result;
        }

        /**
         * Verifica se o usuário realmente existe;
         * Se existir, exibe uma mensagem de sucesso;
         * Se não, exibe uma mensagem de erro;
        */
        public function deleteUser(int $id):void {
            $this->id = (int) $id;

            if ($this->viewUser()) {
                $deleteUser = new \App\Model\helpers\Delete();
                $deleteUser->exeDelete("users", "WHERE id =:id", "id={$this->id}");

                if ($deleteUser->getResult()) {
                    $_SESSION['msg'] = "<p style='color: green;'>Usuário apagado com sucesso!</p>";
                    $this->result = true;
                } else {
                    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não apagado com sucesso!</p>";
                    $this->result = false;
                }
            } else {
                $this->result = false;
            }
        }

        // Verifica se o usuário realmente existe;
        private function viewUser():bool {
            $viewUser = new \App\Model\helpers\Read();
            $viewUser->fullRead(
                "SELECT id, nome, email FROM users WHERE id = :id",
                "id={$this->id}"
            );

            $this->resultBD = $viewUser->getResult();
            if ($this->resultBD) {
                return true;
            } else {
                $_SESSION['msg'] = "<p style='color: #f00'>Erro: Usuário não encontrado!</p>";
                return false;
            }
        }
    }
?>