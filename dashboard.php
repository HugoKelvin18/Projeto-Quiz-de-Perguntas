<?php
session_start();
// Verifica se o nome do usuário está na sessão
require_once 'session_check.php';

// Conexão com o banco de dados
include 'db.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./estilo-dashboard.css">

</head>

<body>
    <div class="container">
        <div class="instrucao">
            <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario']); ?>.</h1>
            <div class="mensagem-instrucao">
                <h2>Desafio do saber!</h2>
                <p>Prepare-se para uma experiência divertida e desafiadora! Em Desafio do Saber, você terá que testar seus conhecimentos gerais! Só os mais rápidos e espertos conseguem chegar ao topo!</p>
            </div>
            <div class="como-jogar">
                <h3>Como Jogar:</h3>
                <ul>
                    <li>Será um jogo de 10 perguntas!</li>
                    <li>Cada resposta correta te aproxima da vitória e de prêmios incríveis!</li>
                    <li>Não tenha medo de errar, o importante é se divertir e aprender!</li>
                </ul>
            </div>
            <div class="ganhos-especiais">
                <h4>Ganhos Especiais:</h4>
                <ol>
                    <li>Acima de 90%: Bombom!</li>
                    <li>Acima de 70%: Pirulito!</li>
                    <li>Acima de 50%: Bala!</li>
                    <li>Abaixo de 50%: Tente outra vez!</li>
                </ol>
            </div>
        </div>

        <div class="container-controle">
            <button class="comecar-jogo botao" onclick="window.location.href='jogo.php'">Iniciar o Jogo!</button>
        </div>
    </div>
</body>

</html>