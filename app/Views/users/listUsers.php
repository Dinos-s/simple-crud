<!-- <h1>Lista de Usuários:</h1> -->

<!-- <?php 
    // if (isset($_SESSION['msg'])) {
    //     echo $_SESSION['msg'];
    //     unset($_SESSION['msg']);
    // }
?> -->
<!-- <span id="msg"></span> -->

<!-- <?php 
    // foreach ($this->data['listUsers'] as $user) {
    //    // var_dump($user);
    //    extract($user);
    //    //echo "ID: " . $user['id'] . "<br>";
    //    echo "ID: $id <br>";
    //    echo "Nome: $nome <br>";
    //    echo "E-mail: $email <br>";
   
    //    echo "<a href='" . URL . "users/view/$id'>Visualizar</a><br>";
       
    //    echo "<a href='" . URL . "user/edit/$id'>Editar</a><br>";
   
    //    echo "<a href='" . URL . "user/delete/$id' onclick='return confirm(\"Tem certeza que desaja apagar este registro?\")'>Apagar</a><br>";
       
    //    echo "<hr>";
    // }
?> -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand text-white text-decoration-none" href="<?= URL; ?>dashboard/index">Crud Simples</a>

        <h2 class="text-white">Lista de Usuários</h2>

        <div class="d-flex align-items-center">
            <span class="navbar-text text-white me-3">
                Bem vindo, <?php echo $_SESSION['user_nome']; ?>!
            </span>
            
            <a href="<?php echo URL; ?>logout/index" class="btn btn-outline-danger">
               Sair
            </a>
        </div>
    </div>
</nav>

<div class="container mt-5">
   <div class="card shadow">
      <div class="card-header d-flex justify-content-between align-items-center">
         <h5 class="mb-0">Usuários Cadastrados</h5>
         <span class="badge bg-primary">Total: <?php echo $this->data['countUsers']; ?></span>
      </div>
      <div class="card-body">
         <span id="msg" class="d-block text-center mb-3">
            <?php 
               if (isset($_SESSION['msg'])) {
                  echo $_SESSION['msg'];
                  unset($_SESSION['msg']);
               }
            ?>
         </span>

         <div class="table-responsive">
            <table class="table table-striped table-hover">
               <thead>
                  <tr>
                     <th scope="col"><strong>#</strong></th>
                     <th scope="col">Nome</th>
                     <th scope="col">E-mail</th>
                     <th scope="col" class="text-end">Ações</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ($this->data['listUsers'] as $key => $user) : extract($user)?>
                  <tr>
                     <td><?= $id ?></td>
                     <td><?= $nome ?></td>
                     <td><?= $email ?></td>
                     <td class="text-end">
                        <div class="btn-group">
                           <a href="<?= URL . "user/view/{$id}"?>" class="btn btn-sm btn-info"><i class="fa-solid fa-eye"></i></a>
                           <a href="<?= URL . "user/edit/{$id}"?>" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                           <a href="<?= URL . "user/delete/{$id}"?>" class="btn btn-sm btn-danger" onclick='return confirm("Tem certeza que desaja apagar este registro?")'><i class="fa-solid fa-trash"></i></a>
                        </div>
                     </td>
                  </tr>
                  <?php endforeach;?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>