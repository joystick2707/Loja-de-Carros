<?php
    include "conexao.php";

    $query = "SELECT carros.id, name, modelo, cor, descricao, preco, imagem FROM `carros` join brands on brands.id = carros.marca";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $carros = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $carros = [];
    }

    $searchTerm = isset($_POST['search']) ? $_POST['search'] : '';

    if ($conn) {
        $stmt = $conn->prepare("SELECT * FROM carros WHERE  marca LIKE ? OR modelo LIKE ?");
        $searchTerm = "%" . $searchTerm . "%";
        $stmt->bind_param('ss', $searchTerm, $searchTerm, );
        $stmt->execute();
        $result = $stmt->get_result();
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Página Inicial</title>
    <link id="themeLink" href="https://bootswatch.com/5/united/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="src/style/index.css">
    <link rel="icon" href="/img/perfil/car.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>
<header class="header">
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
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
                <div class="carrinho-container">
                    <a class="carrinho" href="paginaCompra.php">Carrinho</a>
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>

                <form class="d-flex" role="search" method="POST">
                    <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search" style="margin-left:10px">
                    <button type="submit" style="border: none; background: none"><i class="fa-solid fa-magnifying-glass fa-rotate-90" style="color: #74C0FC; margin-top: 2px"></i></button>
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
                        <h3 class="card-title"><?= $carro['name'] ?></h3>
                        <h3 class="card-text"><?= $carro['modelo'] ?></h3>
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
    <div class="modal-dialog modal-wide modal-dialog-centered">
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
                <a href="listaVeiculos.php" class="btn btn-warning">Editar</a>
                <div class="modal-footer">
                    <form method="POST" action="carrinho.php">
                        <input type="hidden" name="nome" id="hiddenNome">
                        <input type="hidden" name="preco" id="hiddenPreco">
                        <button type="submit" class="btn btn-success">Adicionar ao Carrinho</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .modal-wide {
        max-width: 50%;
    }

    .modal-wide .modal-content {
        width: 100%;
    }

    @media (max-width: 768px) {
        .modal-wide {
            max-width: 95%;
        }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const modal = document.getElementById('carroModal');
    modal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const nome = button.getAttribute('data-nome');
        const modelo = button.getAttribute('data-modelo')
        const descricao = button.getAttribute('data-descricao');
        const preco = button.getAttribute('data-preco');
        const imagem = button.getAttribute('data-imagem');

        const modalNome = document.getElementById('modalNome');
        const modalDescricao = document.getElementById('modalDescricao');
        const modalPreco = document.getElementById('modalPreco');
        const modalImagem = document.getElementById('modalImagem');

        const hiddenNome = document.getElementById('hiddenNome');
        const hiddenPreco = document.getElementById('hiddenPreco');

        modalNome.textContent = nome;
        modalDescricao.textContent = descricao;
        modalPreco.textContent = preco;
        modalImagem.src = imagem;

        hiddenNome.value = nome;
        hiddenPreco.value = preco;
    });
</script>

</body>
</html>
