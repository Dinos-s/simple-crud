<?php 
    namespace App\Controller;

    // Controller de logout do sistema;
    class Logout {
        // Destrói as sessões iniciadas pelo o usuário;
        public function index() {
            unset($_SESSION['user_id'], $_SESSION['user_nome'], $_SESSION['user_email']);
            $_SESSION['msg'] = "<p class='alert alert-success'>Logout realizado com sucesso!</p>";
            $urlRedirect = URL;
            header("Location: $urlRedirect");
        }
    }
?>