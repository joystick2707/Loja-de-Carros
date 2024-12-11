<?php
    include 'conexao.php';

    $sql = "SELECT * FROM carrinho";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $carros = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $carros = [];
    }

    /*
       if($result){
        echo "<script>
                    window.onload = function() {
                        Swal.fire({
                            title: 'Sucesso!',
                            text: 'Compra realizada com sucesso!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    }
                  </script>";
    }
    */
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Página de Compra</title>
    <link href="https://bootswatch.com/5/zephyr/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="src/style/paginaCompra.css">
    <link rel="stylesheet" href="src/style/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
                        <h5 class="card-title"><?= $carro['nome'] ?></h5>
                        <p class="card-text"><strong>Preço:</strong> R$ <?= $carro['preco'] ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
