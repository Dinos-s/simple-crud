<?php 
    namespace App\Controller;

    class NewUser {
        /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
        private array|string|null $data = [];

        /** @var array $dataForm Recebe os dados do formulario */
        private array|null $dataForm;

        /**
         * Instancia a clase responsável em carregar a view e com seus dados;
         * Quando o usuário submeter o fomulário de inscrição, chama o helper de cadastro de usuários e o redireciona para o login;
        */
        public function index():void {
            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if (!empty($this->dataForm['NewUser'])) {
                unset($this->dataForm['NewUser']);
                $createUser = new \App\Model\NewUser();
                $createUser->create($this->dataForm);
                if ($createUser->getResult()) {
                    $urlRedirect = URL;
                    header("Location: $urlRedirect");
                } else {
                    $this->data['form'] = $this->dataForm;
                    $this->viewNewUser();
                }
            } else {
                $this->viewNewUser();
            }
        }

        /**
         * Instancia a classe responsável em carregar e enviar os dados para View.
        */
        private function viewNewUser():void {
            $loadView = new \Core\ConfigView("Views/login/newUser", $this->data);
            $loadView->loadView();
        }
    }
?>