<?php 
    namespace App\Controller;

    class User {
        /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
        private array|string|null $data = [];

        /** @var array $dataForm Recebe os dados do formulario */
        private array|null $dataForm;

        /** @var int|string|null $id Recebe o id do registro */
        private int|string|null $id;

        /**
         * Instancia a clase responsável em carregar a view e com seus dados;
         * Quando o usuário submeter o fomulário de inscrição, chama o helper de cadastro de usuários e o redireciona para o login;
        */
        public function index():void {
            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if (!empty($this->dataForm['NewUser'])) {
                unset($this->dataForm['NewUser'], $this->dataForm['confirmPass']);
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

        //Instancia a classe responsável em carregar e enviar os dados para View.
        private function viewNewUser():void {
            $loadView = new \Core\ConfigView("Views/login/newUser", $this->data);
            $loadView->loadView();
        }

        // Visualização dos detalhes de usuário;
        /**
         * Pega o id do usuário;
         * Instancia o model 'ViewUser', para verificar se o usuário existe;
        */
        public function view(int|string|null $id = null):void {
            if (!empty($id)) {
                $this->id = (int) $id;

                $viewUser = new \App\Model\ViewUser();
                $viewUser->viewUser($this->id);
                if ($viewUser->getResult()) {
                    $this->data['viewUser'] = $viewUser->getResultBD();
                    $this->viewDetailsUser();
                } else {
                    $urlRedirect = URL . "dashboard/index";
                    header("Location: $urlRedirect");
                }

            } else {
                $_SESSION['msg'] = "<p sclass='alert alert-danger;'>Erro: Usuário não encontrado!</p>";
                $urlRedirect = URL . "dashboard/index";
                header("Location: $urlRedirect");
            }
        }

        private function viewDetailsUser() {
            $loadView = new \Core\ConfigView("Views/users/viewUser", $this->data);
            $loadView->loadView();
        }
        // Listagem de usuários;
        /**
         * Instancia a classe responsável para listar os usuários cadastrados no banco;
         * Se tiver dados, eviamos a listagem para view;
         * Se não, coloca um array vazio;
        */
        // public function list() {
        //     $listUsers = new \App\Model\ListUsers();
        //     $listUsers->listUsers();
        //     if ($listUsers->getResult()) {
        //         $this->data['listUsers'] = $listUsers->getResultBD();
        //     }else{
        //         $this->data['listUsers'] = [];
        //     }

        //     $loadView = new \Core\ConfigView("Views/users/listUsers", $this->data);
        //     $loadView->loadView();
        // }

        // Edição de usuário;
        /**
         * Instancia a classe responsável em carregar e enviar os dados para View;
         * Verifica se o id e o dataform foi preenchida com sucesso;
         * Caso seja verdadeiro chama o viewEditUser e carrega a view;
         * Se não, redireciona o usuário para página dashboard;
         * Sem o id e o dataform, não estiverem presentes, edita o usuário;
        */
        public function edit(int|string|null $id = null):void {
            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if ((!empty($id)) and (empty($this->dataForm['EditUser']))) {
                $this->id = (int) $id;
                $viewUser = new \App\Model\EditUser();
                $viewUser->viewUser($this->id);
                if ($viewUser->getResult()) {
                    $this->data['form'] = $viewUser->getResultBD();
                    $this->viewEditUser();
                } else {
                    $urlRedirect = URL . "dashboard/index";
                    header("Location: $urlRedirect");
                }
            } else {
                $this->editUser();
            }
        }

        //Instancia a classe responsável em carregar e enviar os dados para View;
        private function viewEditUser() {
            $loadView = new \Core\ConfigView("Views/users/editUsers", $this->data);
            $loadView->loadView();
        }

        /**
         * Aqui trata-se o edit do usuário para ser editado;
         * Tendo sucesso redireciona o usuário para dashboard;
         * Se tiver algo errado, recarega a página;
        */
        private function editUser() {
            if (!empty($this->dataForm['EditUser'])) {
                unset($this->dataForm['EditUser']);
                $editUser = new \App\Model\EditUser();
                $editUser->update($this->dataForm);
                if ($editUser->getResult()) {
                    // $urlRedirect = URL . "user/viewUser/" . $this->dataForm['id'];
                    $urlRedirect = URL . "dashboard/index";
                    header("Location: $urlRedirect");
                } else {
                    $this->data['form'] = $this->dataForm;
                    $this->viewEditUser();
                }
            } else {
                $_SESSION['msg'] = "<p class='alert alert-danger;'>Erro: Usuário não encontrado!</p>";
                $urlRedirect = URL . "dashboard/index";
                header("Location: $urlRedirect");
            }
        }

        // Deletar usuário;
        /**
         * Instancia método que deleta um usuário;
         * Pega o id do usuário qu deseja se deletar;
         * Verifica se a varariavel $id não está vazia;
         * Caso seja diferente de vazia, deleteamos o usuário;
         * Caso não seja,  retorna um erro;
        */
        public function delete(int|string|null $id = null):void {
            if (!empty($id)) {
                $this->id = (int) $id;
                $deleteUser = new \App\Model\DeleteUser();
                $deleteUser->deleteUser($this->id);
            } else {
                $_SESSION['msg'] = "<p class='alert alert-danger;'>Erro: Necessário selecionar um usuário!</p>";
            }
            $urlRedirect = URL . "dashboard/index";
            header("Location: $urlRedirect");
        }
    }
?>