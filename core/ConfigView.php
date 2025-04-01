<?php 
    namespace Core;

    class ConfigView {
        public function __construct(private string $nameView, private array|string|null $data){}

        public function loadView():void {
            if (file_exists('app/'. $this->nameView .'.php')) {
                include 'app/'. $this->nameView .'.php';
            } else {
                die("Erro - página não encontrada: Por favor tente novamente. Se o problema persistir, fale com o nosso administrador: " . EMAILADM);
            }
        }
    }
?>