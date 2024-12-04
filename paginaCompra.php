<?php
    include 'conexao.php';

    $sql = "SELECT * FROM carrinho";
    $result = $conn->query($sql);

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

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Página de Compra</title>
    <link href="https://bootswatch.com/5/zephyr/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="src/style/paginaCompra.css">
    <link rel="stylesheet" href="src/style/index.css">
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
</body>
</html>
