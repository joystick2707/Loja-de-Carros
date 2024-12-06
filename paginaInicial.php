<?php
include "conexao.php";

$query = "SELECT carros.id, name, modelo, cor, descricao, preco, imagem FROM `carros` join brands on brands.id = carros.marca";
$result = $conn->query($query);

$query_compra = "INSERT INTO carrinho(nome, preco) VALUES (/*INFORMAÇÕES DOS VALORES*/)";

if ($result->num_rows > 0) {
    $carros = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $carros = [];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Carros</title>
    <link href="https://bootswatch.com/5/zephyr/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="src/style/index.css">
    <link rel="icon" href="/img/perfil/car.png">
</head>
<body>
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

<main class="main-pagina-compras">
    <div class="row row-cols-1 row-cols-md-3 g-4" style="gap: 0%;">
        <?php foreach ($carros as $carro): ?>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <img class="card-img-top" src="img/perfil/<?= basename($carro['imagem']) ?>" alt="foto do carro">
                        <h5 class="card-title"><?= $carro['name'] ?></h5>
                        <h5 class="card-text"><?= $carro['modelo'] ?></h5>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#carroModal"
                                data-id="<?= $carro['id'] ?>" data-nome="<?= $carro['name'] ?>"
                                data-descricao="<?= $carro['descricao'] ?>"
                                data-preco="<?= $carro['preco'] ?>"
                                data-imagem="img/perfil/<?= basename($carro['imagem']) ?>">Saiba Mais</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<div class="modal fade" id="carroModal" tabindex="-1" aria-labelledby="carroModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="carroModalLabel">Detalhes do Carro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <img id="modalImagem" src="" alt="Imagem do Carro" class="img-fluid">
                <h5 id="modalNome"></h5>
                <p id="modalDescricao"></p>
                <p><strong>Preço:</strong> R$ <span id="modalPreco"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning">Editar</button>
                <button type="button" class="btn btn-primary">Comprar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const modal = document.getElementById('carroModal');
    modal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const nome = button.getAttribute('data-nome');
        const descricao = button.getAttribute('data-descricao');
        const preco = button.getAttribute('data-preco');
        const imagem = button.getAttribute('data-imagem');

        const modalNome = document.getElementById('modalNome');
        const modalDescricao = document.getElementById('modalDescricao');
        const modalPreco = document.getElementById('modalPreco');
        const modalImagem = document.getElementById('modalImagem');

        modalNome.textContent = nome;
        modalDescricao.textContent = descricao;
        modalPreco.textContent = preco;
        modalImagem.src = imagem;
    });
</script>
</body>
</html>
