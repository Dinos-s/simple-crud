<?php 
    namespace App\Controller;

    class Dashboard {
        private array|string|null $data;

        public function index():void {
            // $this->data = "Bem vindo"; // --> atributo nescessário para a inicialização da página;

            $listUsers = new \App\Model\ListUsers();
            $listUsers->listUsers();
            if ($listUsers->getResult()) {
                $this->data['listUsers'] = $listUsers->getResultBD();
            } else {
                $this->data['listUsers'] = [];
            }

            $loadView = new \Core\ConfigView("Views/dashboard/dashboard", $this->data);
            $loadView->loadView(); 
        }
    }
?>