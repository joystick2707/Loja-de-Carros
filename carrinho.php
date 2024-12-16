<?php
include "conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
    $preco = isset($_POST['preco']) ? $_POST['preco'] : null;

    if ($nome && $preco ) {
        $query_compra = "INSERT INTO carrinho (nome, preco) VALUES (?, ?)";
        $stmt = $conn->prepare($query_compra);

        if ($stmt) {
            $stmt->bind_param("sd", $nome, $preco);

            if ($stmt->execute()) {
                echo "<script>
                    alert('Carrinho cadastrado com sucesso!');
                  </script>";
                header("Location: paginaInicial.php");
                exit();
            } else {
                echo "Erro ao adicionar o carro ao carrinho: " . $stmt->error;
            }
        } else {
            echo "Erro ao preparar a consulta: " . $conn->error;
        }
    } else {
        echo "Dados insuficientes para adicionar ao carrinho.";
    }
} else {
    echo "Método inválido. Use POST para adicionar ao carrinho.";
}
?>
