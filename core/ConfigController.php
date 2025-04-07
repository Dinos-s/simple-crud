<?php 
    namespace Core;

    class ConfigController extends Config {
        private string $url;
        private array $urlArray;
        private string $urlController;
        private string $urlMetodo;
        private string $urlParam;
        private string $classLoad;
        private array $format;
        private string $urlSlugController;
        private string $urlSlugMetodo;

        // Recebendo e validando a URL;
        public function __construct() {
            $this->config();

            // Verifica se o termo 'url' existe, se não use os valores definidos;
            if (!empty(filter_input(INPUT_GET, "url", FILTER_DEFAULT))) {
                $this->url = filter_input(INPUT_GET, "url", FILTER_DEFAULT);

                //corrigi a url
                $this->clearUrl();

                $this->urlArray = explode("/", $this->url);

                if (isset($this->urlArray[0])) {
                    $this->urlController = $this->slugController($this->urlArray[0]);
                } else {
                    $this->urlController = $this->slugController(CONTROLLER);
                }

                if (isset($this->urlArray[1])) {
                    $this->urlMetodo = $this->slugMetodo($this->urlArray[1]);
                } else {
                    $this->urlMetodo = $this->slugMetodo(METODO);
                }

                if (isset($this->urlArray[2])) {
                    $this->urlParam = $this->urlArray[2];
                } else {
                    $this->urlParam = "";
                }
                
            } else {
                $this->urlController = $this->slugController(CONTROLLER_ERRO);
                $this->urlMetodo = $this->slugMetodo(METODO);
                $this->urlParam = "";
            }
        }

        /**
         * A função abaixo retira da url caracteres do padrão UTF-8, espaços em branco e etc;
         * Assim deixando a url pradronizada;
        */
        private function clearUrl():void {
            // elimina aas tags existentes;
            $this->url = strip_tags($this->url);

            // // elemina espaços em branco;
            $this->url = trim($this->url);

            // // elimina a barra '/' no final da url
            $this->url = rtrim($this->url, "/");

            // // aplicando o método utf-8, para ser eleminado;
            $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
            $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-------------------------------------------------------------------------------------------------';

            $this->url = strtr(mb_convert_encoding($this->url, 'ISO-8859-9', 'UTF-8'), mb_convert_encoding($this->format['a'], 'ISO-8859-9', 'UTF-8'), $this->format['b']);
        }

        // Corrigi a escrita da url;
        private function slugController($slugController):string {
            $this->urlSlugController = $slugController;

            // converte para maiusculo;
            $this->urlSlugController = strtolower($this->urlSlugController);

            // retira o traço e coloca um espaço em branco;
            $this->urlSlugController = str_replace("-", " ", $this->urlSlugController);

            // converte a primeira letra de cada palavra em maiúscula;
            $this->urlSlugController = ucwords($this->urlSlugController);

            // remove o espaço em branco;
            $this->urlSlugController = str_replace(" ", "", $this->urlSlugController);

            return $this->urlSlugController;
        }

        // Corrigi a escrita do método presente na url;
        private function slugMetodo($urlSlugMetodo) {
            $this->urlSlugMetodo = $this->slugController($urlSlugMetodo);

            // converte a primeira letra para minusculo;
            $this->urlSlugMetodo = lcfirst($this->urlSlugMetodo);

            return $this->urlSlugMetodo;
        }

        public function loadPage() {
            $this->classLoad = "\\App\\Controller\\".$this->urlController;

            $classePage = new $this->classLoad();
            $classePage->{$this->urlMetodo}($this->urlParam);
        }
    }
?>