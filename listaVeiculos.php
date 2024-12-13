<?php
    include 'conexao.php';

    $idExcluir = isset($_POST['id_excluir']) ? $_POST['id_excluir'] : null;
    $idEditar = isset($_POST['idEditar']) ? $_POST['idEditar'] : null;
    $marca = isset($_POST['marca']) ? $_POST['marca'] : null;
    $modelo = isset($_POST['modelo']) ? $_POST['modelo'] : null;
    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : null;
    $cor = isset($_POST['cor']) ? $_POST['cor'] : null;
    $preco = isset($_POST['preco']) ? $_POST['preco'] : null;

    $sqlListagem = "SELECT carros.id, brands.name as marca, modelo, descricao, cor, preco 
                    FROM carros 
                    JOIN brands ON brands.id = carros.marca";
    $resultado = $conn->query($sqlListagem);

    if ($idEditar && $marca && $modelo && $descricao && $cor && $preco) {
        $sqlEditar = "UPDATE carros SET marca = '$marca', modelo = '$modelo', preco = '$preco',
                      descricao = '$descricao', cor = '$cor' WHERE id = '$idEditar'";
        $resultadoEditar = $conn->query($sqlEditar);

        echo "<script>
                    window.onload = function() {
                        Swal.fire({
                            title: 'Sucesso!',
                            text: 'Veículo atualizado com sucesso!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    }
                  </script>";
    }

    if ($idExcluir) {
        $sqlRemover = "DELETE FROM carros WHERE id = '$idExcluir'";
        $resultado_excluir = $conn->query($sqlRemover);
        echo "<script>
                    window.onload = function() {
                        Swal.fire({
                            title: 'Sucesso!',
                            text: 'Veículo excluído com sucesso!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    }
                  </script>";
    }

    $sql = "SELECT id, name FROM brands";
    $result = $conn->query($sql);

    $carroEditar = null;
    if ($idEditar) {
        $sqlCarro = "SELECT * FROM carros WHERE id = '$idEditar'";
        $carroEditar = $conn->query($sqlCarro)->fetch_assoc();
    }

    $termoPesquisa= isset($_POST['pesquisa']) ? $_POST['pesquisa'] : '';

    if($conn) {
        $stmt = $conn->prepare("SELECT carros.id, brands.name as marca, modelo, descricao, cor, preco 
                        FROM carros 
                        JOIN brands ON brands.id = carros.marca
                        WHERE carros.id LIKE ? OR brands.name LIKE ? OR modelo LIKE ? OR cor LIKE ? OR preco LIKE ?");
        $termoPesquisa = "%" . $termoPesquisa . "%";
        $stmt->bind_param('sssss', $termoPesquisa, $termoPesquisa, $termoPesquisa, $termoPesquisa, $termoPesquisa);
        $stmt->execute();
        $resultado = $stmt->get_result();
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Veículos</title>
    <link href="https://bootswatch.com/5/united/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="src/style/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.8/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
                            <li><a class="dropdown-item" href="listaVeiculos.php">Listar</a></li>
                            <li><a class="dropdown-item" href="paginaCompra.php">Carrinho</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="dropdownMenuLink1">
                            Usuário
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                            <li><a class="dropdown-item" href="listaUsuarios.php">Listar</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex" role="search" method="POST">
                    <input class="form-control me-2" type="search" name="pesquisa" placeholder="Buscar" aria-label="Search" style="margin-left:10px">
                    <button type="submit" style="border: none; background: none"><i class="fa-solid fa-magnifying-glass fa-rotate-90" style="color: #74C0FC; margin-top: 2px"></i></button>
                </form>
                <a class="btn btn-outline-danger" href="login.php">Sair</a>
            </div>
        </div>
    </nav>
</header>
<body>
<div class="container">
    <h1 class="my-4 text-center">Lista de Carros</h1>

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
                <th>Ações</th>
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
                echo "<td class='d-flex justify-content-start'>";
                echo "<button class='btn btn-warning btn-editar me-2' data-id='" . $row['id'] .
                    "' data-marca='" . $row['marca'] .
                    "' data-modelo='" . $row['modelo'] .
                    "' data-descricao='" . $row['descricao'] .
                    "' data-cor='" . $row['cor'] .
                    "' data-preco='" . $row['preco'] .
                    "'>Editar</button>";
                echo "<button class='btn btn-danger btn-excluir' data-id='" . $row['id'] . "'>Excluir</button>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="alert alert-warning">Não há carros registrados!</p>
    <?php endif; ?>
</div>

<!-- Modal de Edição -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-lg">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title text-primary" id="modalEditarLabel">Editar Veículo</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="listaVeiculos.php" method="POST">
                    <input type="hidden" id="idEditar" name="idEditar">

                    <div class="mb-3">
                        <label for="marcaEditar" class="form-label">Marca</label>
                        <select class="form-select" id="marcaEditar" name="marca" required>
                            <option value="">Selecione a marca</option>
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="editarModelo" class="form-label fw-bold text-muted">Modelo</label>
                        <input type="text" class="form-control border-0 rounded-3 shadow-sm" id="editarModelo" name="modelo" required>
                    </div>

                    <div class="mb-3">
                        <label for="editaDescricao" class="form-label fw-bold text-muted">Descrição</label>
                        <input type="text" class="form-control border-0 rounded-3 shadow-sm" id="editaDescricao" name="descricao" required>
                    </div>

                    <div class="mb-3">
                        <label for="corEditar" class="form-label fw-bold text-muted">Cor</label>
                        <input type="text" class="form-control border-0 rounded-3 shadow-sm" id="corEditar" name="cor">
                    </div>

                    <div class="mb-3">
                        <label for="editaPreco" class="form-label fw-bold text-muted">Preço</label>
                        <input type="text" class="form-control border-0 rounded-3 shadow-sm" id="editaPreco" name="preco">
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-3 shadow-sm">Salvar alterações</button>
                    </div>
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
                <h5 class="modal-title" id="modalExcluirLabel">Excluir Carro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza de que deseja excluir este carro?</p>
            </div>
            <div class="modal-footer">
                <form action="listaVeiculos.php" method="POST">
                    <input type="hidden" id="idExcluir" name="id_excluir">
                    <button type="submit" class="btn btn-danger">Sim, excluir</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.8/dist/sweetalert2.all.min.js"></script>
<script>
    const modalExcluir = new bootstrap.Modal(document.getElementById('modalExcluir'));
    const modalEditar = new bootstrap.Modal(document.getElementById('modalEditar'));

    document.querySelectorAll('.btn-editar').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const marca = this.getAttribute('data-marca');
            const modelo = this.getAttribute('data-modelo');
            const descricao = this.getAttribute('data-descricao');
            const cor = this.getAttribute('data-cor');
            const preco = this.getAttribute('data-preco');

            document.getElementById('idEditar').value = id;
            document.getElementById('editarModelo').value = modelo;
            document.getElementById('editaDescricao').value = descricao;
            document.getElementById('corEditar').value = cor;
            document.getElementById('editaPreco').value = preco;

            const marcaSelect = document.getElementById('marcaEditar');
            marcaSelect.value = marca;

            modalEditar.show();
        });
    });

    document.querySelectorAll('.btn-excluir').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            document.getElementById('idExcluir').value = id;
            modalExcluir.show();
        });
    });
</script>
</body>
</html>
