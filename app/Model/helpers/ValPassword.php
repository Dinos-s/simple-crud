<?php 
    namespace App\Model\helpers;

    // Classe genérica para validar a senha;
    class ValPassword {
        /** @var string $password Recebe a senha que deve ser validada */
        private string $password;

        /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
        private bool $result;

        /**
         * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
        */
        function getResult(): bool
        {
            return $this->result;
        }


        /**
         * Verificar se a senha possui aspas simples " ' ", retorna erro;
         * Verificar se a senha possui espaço em branco " ", retorna erro;
         * Instancia o método para validar a quantidade de caracteres a senha possui;
        */
        public function validatePassword(string $password): void {
            $this->password = $password;

            if (stristr($this->password, "'")) {
                $this->result = false;
            } else {
                if (stristr($this->password, " ")) {
                    $this->result = false;
                } else {
                    $this->valExtensPassword();
                }
            }
        }

        /**
         * Verifica se a senha possui menos de 6 de caracteres, retorna um erro;
         * Instancia o método para validar os caracteres que a senha possui;
        */
        private function valExtensPassword(): void
        {
            if (strlen($this->password) < 6) {
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: A senha deve ter no mínimo 6 caracteres!</p>";
                $this->result = false;
            } else {
                $this->valValuePassword();
            }
        }

        // Verifca se a senha possui letras e números na senha;
        private function valValuePassword(): void
        {
            if(preg_match('/^(?=.*[0-9])(?=.*[a-zA-Z])[a-zA-Z0-9-@#$%;*]{6,}$/', $this->password)){
                $this->result = true;
            }else{
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: A senha deve ter letras e números!</p>";
                $this->result = false;
            }
        }
    }
?>