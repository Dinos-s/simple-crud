<?php 
    namespace App\Model;

    class Login {
        private array|null $data;
        private array|null $resultBD;
        private bool $result;

        function getresult():bool {
            return $this->result;
        }

        public function login(array $data = null):void {
            $this->data = $data;
            var_dump("Model do login");
        }
    }
?>