<?php
    include 'conexao.php';

    $idExcluir = isset($_POST['id_excluir']) ? $_POST['id_excluir'] : null;
    $idEditar = isset($_POST['idEditar']) ? $_POST['idEditar'] : null;
    $novoNome = isset($_POST['nome']) ? $_POST['nome'] : null;
    $novoEmail = isset($_POST['email']) ? $_POST['email'] : null;
    $tipoUsuario = isset($_POST['tipoUsuario']) ? $_POST['tipoUsuario'] : null;
    $senha = isset($_POST['senha']) ? $_POST['senha'] : null;
    $confirmaSenha = isset($_POST['confirmaSenha']) ? $_POST['confirmaSenha'] : null;

    $searchTerm = isset($_POST['search']) ? $_POST['search'] : '';

    if ($conn) {
        $stmt = $conn->prepare("SELECT * FROM usuario WHERE id LIKE ? OR nome LIKE ? OR email LIKE ? OR tipoUsuario LIKE ?");
        $searchTerm = "%" . $searchTerm . "%";
        $stmt->bind_param('ssss', $searchTerm, $searchTerm, $searchTerm, $searchTerm);
        $stmt->execute();
        $resultado = $stmt->get_result();
    }

    if ($idEditar && $novoNome && $novoEmail && $tipoUsuario) {
        $sql_edita = "UPDATE usuario SET nome = '$novoNome', email = '$novoEmail', tipoUsuario = '$tipoUsuario' WHERE id = '$idEditar'";
        $resultado_edita = $conn->query($sql_edita);
        echo "<script>
                        window.onload = function() {
                            Swal.fire({
                                title: 'Sucesso!',
                                text: 'Usuário atualizado com sucesso!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        }
                      </script>";
    }
    if ($idExcluir) {
        $sql_excluir = "DELETE FROM usuario WHERE id = '$idExcluir'";
        $resultado_excluir = $conn->query($sql_excluir);
        echo "<script>
                        window.onload = function() {
                            Swal.fire({
                                title: 'Sucesso!',
                                text: 'Usuário excluído com sucesso!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        }
                      </script>";
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Usuários</title>
    <link href="https://bootswatch.com/5/united/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="src/style/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.8/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<header class="header">
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="paginaInicial.php">
                <img class="logo" src="img/perfil/car.png" alt="Logo do carro" style="max-height: 40px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="paginaInicial.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Carros
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="cadastroCarros.php">Cadastrar</a></li>
                            <li><a class="dropdown-item" href="listaVeiculos.php">Listar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Usuário
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="listaUsuarios.php">Listar</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="carrinho-container">
                    <a class="carrinho" href="paginaCompra.php">Carrinho</a>
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <form class="d-flex align-items-center" role="search" method="POST" action="listaUsuarios.php">
                    <input class="form-control me-2" type="search" name="search" placeholder="Buscar" aria-label="Buscar">
                    <button type="submit" style="border: none; background: none"><i class="fa-solid fa-magnifying-glass fa-rotate-90" style="color: #74C0FC; margin-top: 2px"></i></button>
                </form>
                <a class="btn btn-outline-danger ms-2" href="login.php">Sair</a>
            </div>
        </div>
    </nav>

</header>

<body>
<div class="container">
    <h1 class="my-4 text-center">Lista de Usuários</h1>
    <?php if ($resultado->num_rows > 0): ?>
    <table class="table table-striped table-hover table-bordered shadow-sm">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Tipo de Usuário</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['tipoUsuario'] . "</td>";
            echo "<td>";
            echo "<button class='btn btn-warning btn-editar' data-id='" . $row['id'] . "' data-nome='" . $row['nome'] . "' data-email='" . $row['email'] . "'data-tipo-usuario='" . $row['tipoUsuario'] . "'>Editar</button>";
            echo "<button class='btn btn-danger btn-excluir' data-id='" . $row['id'] . "'>Excluir</button>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
        <?php else: ?>
            <p class="alert alert-warning">Não há usuários registrados com esse nome/email.</p>
        <?php endif; ?>
</div>

<!-- Modal de Edição -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel">Editar Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="listaUsuarios.php" method="POST">
                    <input type="hidden" id="idEditar" name="idEditar">
                    <div class="mb-3">
                        <label for="nomeEditar" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nomeEditar" name="nome" required>
                    </div>

                    <div class="mb-3">
                        <label for="emailEditar" class="form-label">Email</label>
                        <input type="email" class="form-control" id="emailEditar" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="tipoUsuarioEditar" class="form-label">Tipo de Usuário</label>
                        <select class="form-select" id="tipoUsuarioEditar" name="tipoUsuario" required>
                            <option value="Padrão">Padrão</option>
                            <option value="ADM">ADM</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar alterações</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Exclusão -->
<div class="modal fade" id="modalExcluir" tabindex="-1" aria-labelledby="modalExcluirLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalExcluirLabel">Excluir Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-4">Tem certeza de que deseja excluir este usuário? Esta ação não pode ser desfeita.</p>
                <form action="listaUsuarios.php" method="POST">
                    <input type="hidden" id="idExcluir" name="id_excluir">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-danger me-2">Sim, excluir</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script>
    document.querySelectorAll('.btn-editar').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const nome = this.getAttribute('data-nome');
            const email = this.getAttribute('data-email');

            document.getElementById('idEditar').value = id;
            document.getElementById('nomeEditar').value = nome;
            document.getElementById('emailEditar').value = email;

            new bootstrap.Modal(document.getElementById('modalEditar')).show();
        });
    });

    document.querySelectorAll('.btn-excluir').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            document.getElementById('idExcluir').value = id;
            new bootstrap.Modal(document.getElementById('modalExcluir')).show();
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.8/dist/sweetalert2.all.min.js"></script>
</body>
</html>
