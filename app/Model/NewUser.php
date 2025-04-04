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
         * Retorna um "FALSE" quando algum campo está vazio;
        */
        public function create(array $data = null):void {
            $this->data = $data;

            $campoVazio = new \App\Model\helpers\ValEmptyField();
            $campoVazio->valField($this->data);
            if ($campoVazio->getResult()) {
                $this->add();
            } else {
                $this->result = false;
            }
        }

        /** 
         * Cadastrar usuário no banco de dados;
         * Retorna TRUE quando cadastrar o usuário com sucesso;
         * Retorna FALSE quando não cadastrar o usuário;d
        */
        private function add():void {
            $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);

            $createUser = new \App\Model\helpers\Create();
            $createUser->exeCreate("users", $this->data);

            if ($createUser->getResult()) {
                $_SESSION['msg'] = "<p style='color: green;'>Usuário cadastrado com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não cadastrado com sucesso!</p>";
                $this->result = false;
            }
        }
    }
?>