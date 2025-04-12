<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand text-white text-decoration-none" href="<?= URL; ?>dashboard/index">Crud Simples</a>

        <h2 class="text-white">Detalahes do Usuário</h2>

        <div class="d-flex align-items-center">
            <span class="navbar-text text-white me-3">
                Bem vindo, <?= $_SESSION['user_nome']; ?>!
            </span>
            
            <a href="<?= URL; ?>logout/index" class="btn btn-outline-danger">
               Sair
            </a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="fas fa-user-circle me-2"></i>
                Informações do Usuário
            </h4>
            <span class="badge bg-light text-dark">ID: <?= $this->data['viewUser'][0]['id'] ?></span>
        </div>

        <?php if ($this->data['viewUser']): ?>
            <?php $user = $this->data['viewUser'][0] ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="user-info-item mb-3">
                        <div class="info-label text-muted">Nome</div>
                            <div class="info-value fs-5">
                                <i class="fas fa-user me-2 text-primary"></i>
                                <?= $user['nome'];?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="user-info-item mb-3">
                        <div class="info-label text-muted">E-mail</div>
                            <div class="info-value fs-5">
                                <i class="fas fa-envelope me-2 text-primary"></i>
                                <?= $user['email'];?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-3 d-flex border-top gap-2 flex-wrap">
                    <a href="<?= URL ?>user/edit/<?= $user['id'] ?>" class="btn btn-warning">
                        <i class="fa-solid fa-pen-to-square"></i> Editar
                    </a>
                    <a href="<?= URL ?>user/delete/<?= $user['id'] ?>" class="btn btn-danger">
                        <i class="fa-solid fa-trash"></i> Deletar
                    </a>
                    <a href="<?= URL ?>dashboard/index" class="btn btn-secondary ms-auto">
                        <i class="fa-solid fa-arrow-left"></i> voltar
                    </a>
                </div>
            </div>
        <?php endif;?>
    </div>
</div>