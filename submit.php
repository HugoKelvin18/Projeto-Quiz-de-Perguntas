<?php
session_start();
// Verifica se o nome do usuário está na sessão
require_once 'session_check.php';

// Conexão com o banco de dados
require_once 'db.php';

// Verifica se o nome do usuário existe na sessão
$usuario = $_SESSION['usuario'] ?? null;
if (!$usuario) {
    die("Erro: Usuário não autenticado.");
}

// Obtém os valores enviados via POST
$totalCorreta = isset($_POST['totalCorreta']) ? filter_var($_POST['totalCorreta'], FILTER_VALIDATE_INT) : 0; // Inicializa $totalCorreta
$avaliacao = isset($_POST['avaliacao']) ? filter_var($_POST['avaliacao'], FILTER_VALIDATE_INT) : null; // Avaliação (se disponível)

try {
    // Verifica o ID do usuário
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE nome = :nome");
    $stmt->execute([':nome' => $usuario]);
    $usuarioId = $stmt->fetchColumn();

    if (!$usuarioId) {
        die("Erro: Usuário não encontrado!");
    }

    // Verifica se já existe um jogo pendente para o usuário
    $stmt = $pdo->prepare("SELECT id FROM jogos WHERE usuario_id = :usuario_id AND status = 'pendente' LIMIT 1");
    $stmt->execute([':usuario_id' => $usuarioId]);
    $jogoExistente = $stmt->fetchColumn();

    if ($jogoExistente) {
        die("Erro: já existe um jogo pendente para este usuário.");
    }

    // Cria um novo registro de jogo
    $stmt = $pdo->prepare("INSERT INTO jogos (usuario_id, acertos, jogado_em, status) VALUES (:usuario_id, :acertos, NOW(), 'finalizado')");
    $stmt->execute([
        ':usuario_id' => $usuarioId,
        ':acertos' => $totalCorreta
    ]);
    $jogoId = $pdo->lastInsertId();

    // Inserção da avaliação
    if ($avaliacao !== null && $avaliacao >= 1 && $avaliacao <= 5) {
        $stmt = $pdo->prepare("INSERT INTO avaliacoes (usuario_id, jogo_id, nota, avaliado_em) VALUES (:usuario_id, :jogo_id, :nota, NOW())");
        $stmt->execute([
            ':usuario_id' => $usuarioId,
            ':jogo_id' => $jogoId,
            ':nota' => $avaliacao
        ]);

        // Retorna resposta via JSON
        header('Content-Type: application/json');
        echo json_encode(['mensagem' => 'Obrigado pela sua avaliação!']);
        exit;
    } else if ($avaliacao !== null) {
        throw new Exception("Avaliação inválida.");
    }
} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode(['mensagem' => 'Erro ao salvar a avaliação: ' . $e->getMessage()]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Resultado do Jogo</title>
    <link rel="stylesheet" href="./estilo-submit.css">
</head>

<body>
    <div class="mensagem-avaliacao" id="mensagemAvaliacao"></div>
    <div class="container">
        <div class="mensagem-resultado">
            <h2>Resultado do Jogo</h2>
            <p>Você acertou: <span id="totalCorreta"><?= htmlspecialchars($totalCorreta ?? 0) ?></span> de 10 perguntas.</p>
            <div id="mensagemFinal"></div>
        </div>
        <div class="container-avaliacao">
            <div class="textoAvaliacao">
                <p>Deixe sua avaliação:</p>
            </div>
            <div class="avaliacao">
                <form method="POST" action="submit.php">
                    <span class="star-icon" data-valor="1">&#9734;</span>
                    <span class="star-icon" data-valor="2">&#9734;</span>
                    <span class="star-icon" data-valor="3">&#9734;</span>
                    <span class="star-icon" data-valor="4">&#9734;</span>
                    <span class="star-icon" data-valor="5">&#9734;</span>

                    <input type="hidden" id="avaliacao" name="avaliacao">
                    <input type="hidden" name="totalCorreta" value="<?= htmlspecialchars($totalCorreta) ?>">
                    <button class="botao-final" id="botaoEnviarAvaliacao" disabled>Enviar Avaliação</button>
                </form>
            </div>
        </div>
        <div class="container-botaoFinal">
            <form action="jogo.php">
                <button class="botao-final" type="submit">Reiniciar</button>
            </form>
            <form action="logout.php">
                <button class="botao-final" type="submit">Sair</button>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const mensagemFinal = document.getElementById("mensagemFinal");
            const totalCorretaInput = document.getElementById("totalCorreta");
            const containerAvaliacao = document.querySelector(".container-avaliacao");
            const containerBotaoFinal = document.querySelector(".container-botaoFinal");
            const estrelas = document.querySelectorAll(".star-icon");
            const botaoEnviar = document.getElementById("botaoEnviarAvaliacao");
            const inputAvaliacao = document.getElementById("avaliacao"); // Campo oculto
            const formAvaliacao = document.querySelector(".container-avaliacao form");
            const mensagemAvaliacao = document.getElementById("mensagemAvaliacao");

            const totalCorreta = <?= json_encode($totalCorreta) ?> || 0; // Obtém os acertos
            const totalQuestoes = 10; // Total de questões do quiz
            const porcentagemAcertos = Math.floor((totalCorreta / totalQuestoes) * 100);

            let mensagem;
            if (porcentagemAcertos >= 90) {
                mensagem = "Parabéns, você ganhou um bombom!";
            } else if (porcentagemAcertos >= 70) {
                mensagem = "Muito bom! Você ganhou um pirulito!";
            } else if (porcentagemAcertos >= 50) {
                mensagem = "Bom trabalho! Você ganhou uma bala!";
            } else {
                mensagem = "Não desanime! Tente novamente!";
            }
            document.getElementById('mensagemFinal').textContent = mensagem;
            // Exibe a mensagem com os acertos e o prêmio
            mensagemFinal.textContent = mensagem;
            mensagemFinal.style.display = "block"; // Certifique-se que está visível

            estrelas.forEach((estrela, index) => {
                estrela.addEventListener("click", () => {
                    const valor = index + 1; // Valor baseado no índice (1 a 5)
                    inputAvaliacao.value = valor; // Preenche o campo oculto

                    // Atualiza visualmente as estrelas
                    estrelas.forEach((e, i) => {
                        e.innerHTML = i < valor ? "&#9733;" : "&#9734;";
                    });

                    botaoEnviar.disabled = false; // Habilita o botão de envio
                });
            });

            formAvaliacao.addEventListener("submit", async (evento) => {
                evento.preventDefault(); // Evita o comportamento padrão de recarregar a página

                if (!inputAvaliacao.value) {
                    mensagemAvaliacao.textContent = "Por favor, selecione uma avaliação antes de enviar.";
                    mensagemAvaliacao.className = "mensagem-avaliacao error";
                    return;
                }
                try {
                    // Envia os dados via AJAX
                    const response = await fetch("submit.php", {
                        method: "POST",
                        body: new FormData(formAvaliacao),
                    });
                    if (response.ok) {
                        const data = await response.json();
                        mensagemAvaliacao.textContent = data.mensagem;
                        mensagemAvaliacao.className = "mensagem-avaliacao success";

                        // Esconde o container de avaliação e exibe os botões
                        containerAvaliacao.classList.add("hidden");
                        containerBotaoFinal.classList.add("visible");

                        setTimeout(() => {
                            mensagemAvaliacao.style.display = "none";
                        }, 2000);
                    } else {
                        mensagemAvaliacao.textContent = "Erro ao salvar a avaliação. Por favor, tente novamente.";
                        mensagemAvaliacao.className = "mensagem-avaliacao error";
                    }
                } catch (erro) {
                    mensagemAvaliacao.textContent = "Erro ao salvar a avaliação. Por favor, tente novamente.";
                    mensagemAvaliacao.className = "mensagem-avaliacao error";
                }
            });
        });
    </script>
</body>

</html>