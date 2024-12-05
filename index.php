<?php
session_start();

if (isset($_POST['start'])) {
    include 'db.php';  // Conexão com o banco de dados

    if (!empty(trim($_POST['usuario']))) {
        $usuario = (trim($_POST['usuario']));  // Obtém o nome do usuário

        //cria novo registro
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome) VALUES (:nome)");
        if ($stmt->execute([':nome' => $usuario])) {
            $_SESSION['usuario'] = $usuario; // Inicia sessão com novo usuário
            header("Location: dashboard.php");
            exit();
        } else {
            $erro = "Erro ao criar usuário. Por favor, tente novamente!";
        }
    } else {
        $erro = "Por favor, insira um nome válido para iniciar o jogo!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="./estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    if (isset($erro)) {
        echo "<div class='alert alert-danger'>$erro</div>";
    }
    ?>
    <div class="container-top">
        <div class="container-circulo">
            <div class="logo"></div>
            <div class="circulo">
                <p>Quiz de Perguntas-Projeto Interdisciplinar III-</p>
            </div>
        </div>
    </div>
    <div class="container-bottom">
        <div class="container-formulario">
            <form method="POST">
                <div class="input">
                    <input type="text" id="usuario" name="usuario" placeholder="Digite seu nome" required><br>
                </div>
                <div class="button">
                    <button type="submit" id="start" name="start">Iniciar</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const text = document.querySelector('.circulo p');
        text.innerHTML = text.innerText.split("").map(
            (char, i) =>
            `<span style="transform:rotate(${i * 7.6}deg)">${char}</span>`
        ).join(" ");
    </script>
</body>

</html>