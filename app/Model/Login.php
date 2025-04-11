<?php 
    namespace App\Model;

    class Login {

        /** @var array|null $data Recebe as informações do formulário;*/
        private array|null $data;

        /** @var array|null $resultBD Recebe os dados do banco*/
        private array|null $resultBD;

        /** @var bool $result Recebe true quando a execução for bem sucedida, ou falso quando houver erro;*/
        private bool $result;

        function getResult():bool {
            return $this->result;
        }

        /**
         * Recebe os valores do formulário;
         * Recupera as informações do usuário no banco de dados;
         * Quando encontrar o usuário no banco de dados instanciar o método "valPassword" para validar a senha ;
         * Retorna FALSE quando não encontrar usuário no banco de dados;
        */
        public function login(array $data = null):void {
            $this->data = $data;

            $viewUser = new \App\Model\helpers\Read();
            $viewUser->fullRead(
                "SELECT id, nome, email, password FROM users WHERE email =:email", 
                "email={$this->data['user']}"
            );
            $this->resultBD = $viewUser->getResult();
            if ($this->resultBD) {
                $this->valPassword();
            } else {
                $_SESSION['msg'] = "<p class='alert alert-danger'>Erro: Usuário ou a senha incorreta!</p>";
                $this->result = false;
            }
        }

        /**
         * Compara a senha enviado pelo usuário com a senha que está salva no banco de dados;
         * Retorna TRUE quando os dados estão corretos e salva as informações do usuário na sessão;
         * Retorna FALSE quando a senha está incorreta;
        */
        private function valPassword():void {
            if (password_verify($this->data['password'], $this->resultBD[0]['password'])) {
                $_SESSION['user_id'] = $this->resultBD[0]['id'];
                $_SESSION['user_nome'] = $this->resultBD[0]['nome'];
                $_SESSION['user_email'] = $this->resultBD[0]['email'];
            $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert alert-danger'>Erro: Usuário ou a senha incorreta!</p>";
                $this->result = false;
            }
        }
    }
?>