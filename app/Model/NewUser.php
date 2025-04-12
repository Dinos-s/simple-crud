<?php 
    namespace App\Model;

    // Cadastro de um novo usuário;
    class NewUser {
        /** @var array|null Recebe as informações do formulário; */
        private array|null $data;

        /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro; */
        private bool $result;

        function getResult():bool {
            return $this->result;
        }

        /**
         * Recebe os valore do formulário;
         * Instancia o  helper "AdmsValEmptyField" para verificar se todos os campos estão preenchidos;
         * Caso tudo esteja preenchida corretamente, instancia o método "add", para inserir os dados;
         * Instancia o "valInput", para verificar se os campos estão preenchidos corretamente;
         * Retorna um "FALSE" quando algum campo está vazio;
        */
        public function create(array $data = null):void {
            $this->data = $data;

            $campoVazio = new \App\Model\helpers\ValEmptyField();
            $campoVazio->valField($this->data);
            if ($campoVazio->getResult()) {
                $this->valInput();
            } else {
                $this->result = false;
            }
        }

        /**
         * Instanciar o helper "validatePassword" para validar a senha;
         * Retrorna um FALSE em caso de error;
        */
        private function valInput():void {
            $valPass = new \App\Model\helpers\ValPassword();
            $valPass->validatePassword($this->data['password']);

            if ($valPass->getResult()) {
                $this->add();
            } else {
                $this->result = false;
            }
        }

        /** '
         * Cadastrar usuário no banco de dados;
         * Retorna TRUE quando cadastrar o usuário com sucesso;
         * Retorna FALSE quando não cadastrar o usuário;d
        */
        private function add():void {
            $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);

            $createUser = new \App\Model\helpers\Create();
            $createUser->exeCreate("users", $this->data);

            if ($createUser->getResult()) {
                $_SESSION['msg'] = "<p class='alert alert-success'>Usuário cadastrado com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert alert-danger'>Erro: Usuário não cadastrado com sucesso!</p>";
                $this->result = false;
            }
        }
    }
?>