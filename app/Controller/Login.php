<?php 
    namespace App\Controller;

    class Login {
        private array|string|null $data = [];
        private array|null $dataForm;

        public function index():void {
            var_dump('Controller de Login');

            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if (!empty($this->dataForm['Login'])) {
                $valLogin = new \App\Model\Login();
                $valLogin->login($this->dataForm);
                if ($valLogin->getresult()) {
                    $urlRedirect = URL . "dasboard/index";
                    header("Location: $urlRedirect");
                } else {
                    $this->data['form'] = $this->dataForm;
                }
            }

            $loadView = new \Core\ConfigView("Views/login/login", $this->data);
            $loadView->loadView();
        }
    }
?>