<?php
include 'conexao.php';

$idExcluir = $_POST['id_excluir'];

$sqlListagem = "SELECT * FROM carros ";
$resultado = $conn->query($sqlListagem);

$sql_excluir = "DELETE FROM carros WHERE id = '$idExcluir'";
$resultado_excluir = $conn->query($sql_excluir);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Usuários</title>
    <link href="https://bootswatch.com/5/zephyr/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="src/style/index.css">

</head>
<header class="header">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="paginaInicial.php"><img class="logo" src="img/perfil/car.png" alt="carro_logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="paginaInicial.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="dropdownMenuLink">
                            Carros
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="cadastroCarros.php">Cadastrar</a></li>
                            <li><a class="dropdown-item" href="editaVeiculo.php">Editar</a></li>
                            <li><a class="dropdown-item" href="removeVeiculo.php">Excluir</a></li>
                            <li><a class="dropdown-item" href="listaVeiculos.php">Listar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="dropdownMenuLink1">
                            Usuário
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                            <li><a class="dropdown-item" href="editaUsuario.php">Editar</a></li>
                            <li><a class="dropdown-item" href="removeUsuarios.php">Remover</a></li>
                            <li><a class="dropdown-item" href="listaUsuarios.php">Listar</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style="margin-left:10px">
                    <button class="btn btn-outline-primary" type="submit">Pesquisar</button>
                </form>
                <a class="btn btn-outline-danger" href="login.php">Sair</a>
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
                <th>Marca</th>
                <th>Modelo</th>
                <th>Descrição</th>
                <th>Cor</th>
                <th>Preço</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($row = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['marca'] . "</td>";
                echo "<td>" . $row['modelo'] . "</td>";
                echo "<td>" . $row['descricao'] . "</td>";
                echo "<td>" . $row['cor'] . "</td>";
                echo "<td>" . $row['preco'] . "</td>";
                echo "<td>";
                echo "<button class='btn btn-warning btn-editar' data-id='" . $row['id'] . "' data-marca='" . $row['marca'] . "' data-modelo='" . $row['modelo'] . "' data-descricao='" . $row['descricao'] . "'>Editar</button>";
                echo "<button class='btn btn-danger btn-excluir' data-id='" . $row['id'] . "'>Excluir</button>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="alert alert-warning">Não há usuários registrados.</p>
    <?php endif; ?>
</div>


<!-- Modal de Edição -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel">Editar Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="listaVeiculos.php" method="POST">
                    <input type="hidden" id="idEditar" name="idEditar">

                    <div class="mb-3">
                        <label for="marcaEditar" class="form-label">Marca</label>
                        <input type="text" class="form-control" id="marcaEditar" name="marca" required>
                    </div>

                    <div class="mb-3">
                        <label for="editarModelo" class="form-label">Modelo</label>
                        <input type="text" class="form-control" id="editarModelo" name="modelo" required>
                    </div>

                    <div class="mb-3">
                        <label for="editaDescricao" class="form-label">Descrição</label>
                        <input type="text" class="form-control" id="editaDescricao" name="descricao" required>
                    </div>

                    <div class="mb-3">
                        <label for="corEditar" class="form-label">Cor</label>
                        <input type="text" class="form-control" id="corEditar" name="cor">
                    </div>

                    <div class="mb-3">
                        <label for="editaPreco" class="form-label">Preço</label>
                        <input type="text" class="form-control" id="editaPreco" name="preco">
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
                <h5 class="modal-title" id="modalExcluirLabel">Excluir Veículo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-4">Tem certeza de que deseja excluir este veículo? Esta ação não pode ser desfeita.</p>
                <form action="listaVeiculos.php" method="POST">
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
</body>
</html>
