<?php 
    namespace App\Controller;

    class Login {
        /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
        private array|string|null $data = [];

        /** @var array $dataForm Recebe os dados do formulario */
        private array|null $dataForm;

        
        /**
         * Instancia a classe responsável em carregar a view, e enviar os dados para ela;
         * Os dados são enviados e validados na model "Login";
         * Caso seja verdadeiro, carega a página dashboard;
         * Caso não seja verdadeiro, recarrega o login; 
        */
        public function index():void {

            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if (!empty($this->dataForm['Login'])) {
                $valLogin = new \App\Model\Login();
                $valLogin->login($this->dataForm);
                if($valLogin->getResult()){
                    $urlRedirect = URL . "dashboard/index";
                    header("Location: $urlRedirect");
                }else{
                    $this->data['form'] = $this->dataForm;
                } 
            }

            $loadView = new \Core\ConfigView("Views/login/login", $this->data);
            $loadView->loadView();
        }
    }
?>