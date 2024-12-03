<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['editaNome'];
    $email = $_POST['editaEmail'];
    $senha = $_POST['editaSenha'];
    $tipoUsuario = $_POST['tipoUsuario'];

    // Verifica se todos os campos foram preenchidos
    if (!empty($nome) && !empty($email) && !empty($senha) && !empty($tipoUsuario)) {

        // Prepara a consulta para atualizar o usuário
        $stmt = $conn->prepare("UPDATE usuario SET email = ?, senha = ?, tipoUsuario = ? WHERE nome = ?");

        $stmt->bind_param("ssss", $email, $senha, $tipoUsuario, $nome);

        // Executa a consulta
        $result = $stmt->execute();

        // Exibe a mensagem de sucesso ou erro
        if ($result) {
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
        } else {
            echo "<script>
                    window.onload = function() {
                        Swal.fire({
                            title: 'Erro!',
                            text: 'Falha ao atualizar usuário!',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                  </script>";
        }

        // Fecha a consulta
        $stmt->close();
    } else {
        echo "<script>
                window.onload = function() {
                    Swal.fire({
                        title: 'Erro!',
                        text: 'Todos os campos devem ser preenchidos!',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
              </script>";
    }
}

// Recuperando usuários da tabela `usuario`
$sqlUser = "SELECT nome FROM usuario";
$resultUser = $conn->query($sqlUser);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Usuários</title>
    <link rel="stylesheet" href="src/style/cadastroVeiculos.css">
    <link href="https://bootswatch.com/5/zephyr/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="src/style/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.8/dist/sweetalert2.min.css">
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
                            <li><a class="dropdown-item" href="editaVeiculo.php">Editar</a></li>
                            <li><a class="dropdown-item" href="cadastroCarros.php">Cadastrar</a></li>
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

<main class="container mt-5">
    <h3 class="titulo_editaVeiculo">Edição de Usuários</h3>
    <form action="editaUsuario.php" method="POST">
        <div class="mb-3">
            <label for="marca" class="form-label">Usuários</label>
            <select class="form-select" id="marca" name="editaNome" required>
                <option value="">Selecione o usuário</option>
                <?php
                if ($resultUser->num_rows > 0) {
                    while ($row = $resultUser->fetch_assoc()) {
                        echo "<option value='" . $row['nome'] . "'>" . $row['nome'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Nenhum usuário cadastrado</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="editaEmail" placeholder="Digite o novo email" required>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" name="editaSenha" placeholder="Digite a nova senha" required>
        </div>
        <div class="mb-3">
            <label for="tipoUsuario" class="form-label">Tipo de Usuário</label>
            <select class="form-select" id="tipoUsuario" name="tipoUsuario" required>
                <option value="">Selecione o Tipo de Usuário</option>
                <option value="ADM">ADM</option>
                <option value="Padrão">Padrão</option>
            </select>
        </div>
        <button type="submit" class="btn btn-outline-success" style="width: 25%; margin-left: 35%; margin-top: 1%;">Atualizar Usuário</button>
    </form>
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.8/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
