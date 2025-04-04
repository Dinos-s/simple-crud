<?php 
    namespace App\Controller;

    class Dashboard {
        private array|string|null $data;

        public function index():void {
            $this->data = "Bem vindo"; // --> atributo nescessário para a inicialização da página;

            $loadView = new \Core\ConfigView("Views/dashboard/dashboard", $this->data);
            $loadView->loadView(); 
        }
    }
?>