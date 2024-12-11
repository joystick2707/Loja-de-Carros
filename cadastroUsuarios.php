<?php
    include 'conexao.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $confirmaSenha = $_POST['confirmaSenha'];

        $sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0){
            echo "<script>
                        window.onload = function() {
                            Swal.fire({
                                title: 'Erro!',
                                text: 'Esse usuário já existe, por favor tente outro email!',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                      </script>";
        } else {
            if ($senha == $confirmaSenha) {
                $stmt = $conn->prepare("INSERT INTO usuario (nome, email, senha, tipoUsuario) VALUES (?, ?, ?, 'Padrão')");
                $stmt->bind_param("sss", $nome, $email, $senha);
                $stmt->execute();

                echo "<script>
                        window.onload = function() {
                            Swal.fire({
                                title: 'Sucesso!',
                                text: 'Usuário cadastrado com sucesso!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'login.php'; // Redireciona após confirmação do alerta
                                }
                            });
                        }
                      </script>";
            } else {
                echo "<script>
                        window.onload = function() {
                            Swal.fire({
                                title: 'Erro!',
                                text: 'Senhas Diferentes!',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                      </script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="src/style/index.css">
    <link href="https://bootswatch.com/5/zephyr/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.8/dist/sweetalert2.min.css">


</head>
<body class="bg-dark text-light">

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4 shadow-lg" style="max-width: 500px; width: 100%;">
        <h3 class="text-center mb-4">Cadastro</h3>
        <form action="cadastro.php" method="POST">
            <div class="mb-3">
                <label for="inputNome" class="form-label">Nome Completo</label>
                <input type="text" class="form-control" id="inputNome" placeholder="Digite seu nome completo" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="inputEmail" class="form-label">Endereço de E-mail</label>
                <input type="email" class="form-control" id="inputEmail" placeholder="Digite seu e-mail" name="email" required>
            </div>
            <div class="mb-3">
                <label for="inputSenha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="inputSenha" placeholder="Digite sua senha" name="senha" required>
            </div>
            <div class="mb-3">
                <label for="inputConfirmarSenha" class="form-label">Confirmar Senha</label>
                <input type="password" class="form-control" id="inputConfirmarSenha" placeholder="Confirme sua senha" name="confirmaSenha" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                <label class="form-check-label" for="exampleCheck1">Eu concordo com os termos de serviço.</label>
            </div>
            <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
        </form>
        <div class="text-center mt-3">
            <small>Já tem uma conta? <a href="login.php" class="text-decoration-none text-primary">Faça login</a></small>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.8/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybU3fTtP07zvJ8f+ua7s/52bgguAsFjZfZ3Ff5zJ2p9Bz+zO2" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDPx8p5D9L5gb1SkOVYAtkQCiRrzF5jV6O1TgqU5PEo5+VoFq8iXQpXzX9r" crossorigin="anonymous"></script>
</body>
</html>
