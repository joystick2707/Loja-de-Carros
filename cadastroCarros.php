<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $descricao = $_POST["descricao"];
    $cor = $_POST["cor"];
    $preco = $_POST["preco"];
    $imagem = $_POST["imagem"];

    $sql = "SELECT * FROM carros WHERE marca = '$marca'";
    $result = $conn->query($sql);

    // Definindo o caminho para a pasta de imagens
    $caminho = $_SERVER['DOCUMENT_ROOT'] . '/img/perfil/';
    $imagem_temp = $_FILES['imagem']['tmp_name'];

    // Verificando se o arquivo foi enviado
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        // Verificando a extensão do arquivo
        $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        if (!in_array(strtolower($ext), ['png', 'jpg', 'jpeg'])) {
            echo 'Extensão de imagem não permitida! Apenas PNG, JPG e JPEG são aceitos.';
            exit();
        }

        // Gerando um nome único para o arquivo
        $nome_imagem = uniqid() . '.' . $ext;
        $imagem = '../img/perfil/' . $nome_imagem;  // Caminho relativo da imagem

        // Movendo a imagem para o diretório de perfil
        if (move_uploaded_file($imagem_temp, $caminho . $nome_imagem)) {
            // A imagem foi movida com sucesso
        } else {
            echo 'Erro ao fazer upload da imagem!';
            exit();
        }
    } else {
        echo 'Erro ao enviar a imagem.';
        exit();
    }

    if (!empty($marca) && !empty($descricao) && !empty($cor) && !empty($preco) && !empty($modelo)) {
        $stmt = $conn->prepare("INSERT INTO carros (marca,modelo, descricao, cor, preco, imagem) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $marca,$modelo, $descricao, $cor, $preco, $imagem);
        $stmt->execute();

        echo "<script>
                    window.onload = function() {
                        Swal.fire({
                            title: 'Sucesso!',
                            text: 'Veículo cadastrado com sucesso!',
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
                            text: 'Por favor, preencha todos os campos!',
                            icon: 'error',
                            confirmButtonText: 'Tentar Novamente'
                        });
                    }
                  </script>";
    }
}

$sql = "SELECT id, name FROM brands";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Veículos</title>
    <link href="https://bootswatch.com/5/zephyr/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="src/style/index.css">
    <link rel="stylesheet" href="src/style/cadastroVeiculos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.8/dist/sweetalert2.min.css">
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

<main class="container mt-5">
    <h3 class="titulo">Cadastro de Veículos</h3>
    <form action="cadastroCarros.php" method="POST" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group">
                <label for="marca" class="form-label">Marca</label>
                <select class="form-select" id="marca" name="marca" required>
                    <option value="">Selecione a marca</option>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Nenhuma marca cadastrada</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Digite o modelo do carro" required>
            </div>
            <div class="form-group">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Digite a descrição do veículo" required>
            </div>
            <div class="form-group">
                <label for="cor" class="form-label">Cor</label>
                <input type="text" class="form-control" id="cor" name="cor" placeholder="Digite a cor do veículo" required>
            </div>
            <div class="form-group">
                <label for="preco" class="form-label">Preço</label>
                <input type="text" class="form-control" id="preco" name="preco" placeholder="Digite o preço do veículo" required>
            </div>
            <div class="form-group">
                <label for="imagem" class="form-label">Imagem</label>
                <input type="file" class="form-control" id="imagem" name="imagem" required>
            </div>
        </div>

        <button type="submit" class="btn btn-outline-success">Cadastrar Veículo</button>
    </form>
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.8/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
