<?php 
    namespace Core;

    // Verifica se a classe existe;
    // Carrega oController;
    class CarregarPg {
        private string $urlController;
        private string $urlMetodo;
        private string $urlParam;
        private string $classLoad;
        private array $listPgPublica;
        private array $listPgPrivada;

        public function loadPage(string|null $urlController, string|null $urlMetodo, string|null $urlParam):void {
            $this->urlController = $urlController;
            $this->urlMetodo = $urlMetodo;
            $this->urlParam = $urlParam;

            $this->pgPublic();

            if (class_exists($this->classLoad)) {
                $this->loadMetodo();
            } else {
                die("Erro - ao carregar a classe: Por fovor, tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
            }
        }

        private function loadMetodo():void {
            $classLoad = new $this->classLoad();
            if (method_exists($classLoad, $this->urlMetodo)) {
                $classLoad->{$this->urlMetodo}($this->urlParam);
            } else {
                die("Erro - carregar metodo: Por favor tente novamente");
            }
        }

        /**
         * Verifica se a página é públicas;
         * Caso esteja prensente no array, ela é mostrada na tela;
         * Caso ela não esteja no array, verifica as páginas privadas;
        */
        private function pgPublic():void {
            $this->listPgPublica = [];

            if (in_array($this->urlController, $this->listPgPublica)) {
                $this->classLoad = "\\App\\Controller\\".$this->urlController;
            } else {
                $this->pgPrivada();
            }
        }

        /**
         * Verifica se as página privada;
         * Caso esteja presente no array, verifica se o login foi feito e, é mostrada na tela; 
         * Caso ela não esteja no array, é mostrado uma mensagem de erro; 
        */
        private function pgPrivada():void {
            $this->listPgPrivada = [];

            if (in_array($this->urlController, $this->listPgPrivada)) {
                $this->verifyLogin();
            } else {
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Página não encontrada!</p>";
                $urlRedirect = URL . "login/index";
                header("Location: $urlRedirect");
            }
        }

        // Verifica se o usuário está logado; 
        private function verifyLogin():void {
            if ((isset($_SESSION['user_id'])) and (isset($_SESSION['user_name'])) and (isset($_SESSION['user_email']))) {
                $this->classLoad = "\\App\\Controller\\".$this->urlController;
            } else {
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Para acessar a página realize o login!</p>";
                $urlRedirect = URL . "login/index";
                header("Location: $urlRedirect");
            }
        }
    }
?>