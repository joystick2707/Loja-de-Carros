<?php
include "conexao.php";
$sqlInfo = "SELECT id, nome FROM usuario";
$nomeResult = $conn->query($sqlInfo);

if (!$nomeResult) {
    die("Erro na consulta SQL: " . $conn->error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['excluiUsuario'];

    if (!empty($id)) {
        $sql = "DELETE FROM usuario WHERE id = '$id'";
        $result = $conn->query($sql);

        if ($result) {
            $message = [
                'title' => 'Sucesso!',
                'text' => 'Usuário deletado com sucesso!',
                'icon' => 'success',
                'button' => 'OK'
            ];
        } else {
            $message = [
                'title' => 'Erro!',
                'text' => 'Falha ao deletar usuário',
                'icon' => 'error',
                'button' => 'Tentar Novamente'
            ];
        }
    } else {
        $message = [
            'title' => 'Erro!',
            'text' => 'Por favor, selecione um usuário para excluir.',
            'icon' => 'error',
            'button' => 'OK'
        ];
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exclusão de Usuários</title>
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
    <h3 class="titulo_removeVeiculo">Exclusão de Usuários</h3>
    <form action="removeUsuarios.php" method="POST">
        <div class="mb-3">
            <label for="marca" class="form-label">Usuários</label>
            <select class="form-select" id="marca" name="excluiUsuario" required>
                <option value="">Selecione o usuário</option>
                <?php
                if ($nomeResult->num_rows > 0) {
                    while ($row = $nomeResult->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Nenhum usuário cadastrado</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-outline-danger" style="width: 25%; margin-left: 35%; margin-top: 1%;">Remover Usuário</button>
    </form>
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.8/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?php if (isset($message)): ?>
    <script>
        window.onload = function() {
            Swal.fire({
                title: '<?php echo $message['title']; ?>',
                text: '<?php echo $message['text']; ?>',
                icon: '<?php echo $message['icon']; ?>',
                confirmButtonText: '<?php echo $message['button']; ?>'
            });
        }
    </script>
<?php endif; ?>

</body>
</html>
