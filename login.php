<?php
    include('conexao.php');
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            header("Location: index.php");
            exit();
        } else {
            echo "<script>
                    window.onload = function() {
                        Swal.fire({
                            title: 'Erro!',
                            text: 'Email ou senha incorretos!',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                  </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="src/style/index.css">

    <link href="https://bootswatch.com/5/zephyr/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body class="bg-dark text-light">

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4 shadow-lg" style="max-width: 400px; width: 100%;">
        <h3 class="text-center mb-4" >Login</h3>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Endereço de e-mail</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Digite seu e-mail" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Senha</label>
                <input type="password" name="senha" class="form-control" id="exampleInputPassword1" placeholder="Digite sua senha" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Lembrar de mim</label>
            </div>
            <button type="submit" class="btn btn-primary w-100" >Entrar</button>
        </form>
        <div class="text-center mt-3">
            <small>Não tem uma conta? <a href="cadastroUsuarios.php" class="text-decoration-none text-primary">Cadastre-se</a></small>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDPx8p5D9L5gb1SkOVYAtkQCiRrzF5jV6O1TgqU5PEo5+VoFq8iXQpXzX9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybU3fTtP07zvJ8f+ua7s/52bgguAsFjZfZ3Ff5zJ2p9Bz+zO2" crossorigin="anonymous"></script>
</body>
</html>
