<?php
    include 'conexao.php';

    // limpa o carrinho
    if (isset($_POST['finalizar_compra'])) {
        // Verifica se há itens no carrinho
        $verificaCarrinho = "SELECT COUNT(*) AS total FROM carrinho";
        $resultado = $conn->query($verificaCarrinho);

        if ($resultado) {
            $dados = $resultado->fetch_assoc();
            $totalItens = (int)$dados['total'];

            if ($totalItens > 0) {
                $sql = "DELETE FROM carrinho";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    title: 'Compra Finalizada!',
                                    text: 'Compra realizada com sucesso!',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.href = 'paginaCompra.php';
                                });
                            });
                          </script>";
                } else {
                    echo "<script>
                            Swal.fire({
                                title: 'Erro!',
                                text: 'Ocorreu um erro ao finalizar a compra.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = 'paginaCompra.php';
                            });
                          </script>";
                }
            } else {
                // Se o carrinho estiver vazio
                echo "<script>
                        Swal.fire({
                            title: 'Carrinho Vazio!',
                            text: 'Não há itens no carrinho para finalizar a compra.',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        });
                      </script>";
            }
        } else {
            echo "<script>
                    Swal.fire({
                        title: 'Erro!',
                        text: 'Não foi possível verificar o carrinho.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                  </script>";
        }
    }


// remove um item especifico do carrinho
    if (isset($_GET['id'])) {
        $idCarro = (int)$_GET['id'];
        $excluiCarrinho = "DELETE FROM carrinho WHERE id = $idCarro";
        if ($conn->query($excluiCarrinho) === TRUE) {
            echo "<script>
                    window.onload = function() {
                        Swal.fire({
                            title: 'Sucesso!',
                            text: 'Veículo removido com sucesso!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = 'paginaCompra.php';
                        });
                    }
                  </script>";
        } else {
            echo "<script>
                    Swal.fire({
                        title: 'Erro!',
                        text: 'Erro ao remover item.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'paginaCompra.php';
                    });
                  </script>";
        }
    }

    $sql = "SELECT * FROM carrinho";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $carros = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $carros = [];
    }

    $total = 0;
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="src/style/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link id="themeLink" href="https://bootswatch.com/5/united/bootstrap.min.css" rel="stylesheet">
    <link href="https://bootswatch.com/5/united/bootstrap.min.css" rel="stylesheet">
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

<main class="main-pagina-carrinho">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Carrinho de Compras</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-centered">
                <thead>
                <tr>
                    <!-- <th scope="col">Imagem</th> -->
                    <th scope="col" class="text-center">Marca</th>
                    <th scope="col" class="text-center">Preço</th>
                    <th scope="col" class="text-center">Quantidade</th>
                    <th scope="col" class="text-center">Remover</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($carros as $carro):
                    $preco = (float)$carro['preco'];
                    $quantidade = 1;

                    $totalCarro = $preco * $quantidade;
                    $total += $totalCarro;
                    ?>
                    <tr>
                        <!-- <td><img src="img/perfil/<?= $carro['imagem'] ?>" alt="<?= $carro['nome'] ?>" class="img-fluid" width="100"></td> -->
                        <td><?= $carro['nome'] ?></td>
                        <td>R$ <?= number_format($preco, 2, '.', '.') ?></td>
                        <td><?= $quantidade ?></td>
                        <td><a href="paginaCompra.php?id=<?= $carro['id'] ?>" class="btn btn-danger btn-sm">Remover</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <form method="post" action="paginaCompra.php" style="margin-left: 88%;">
            <button class="btn btn-success" type="submit" name="finalizar_compra">Finalizar Compra</button>
        </form>

    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.8/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
