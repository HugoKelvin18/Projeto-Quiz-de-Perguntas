<?php
session_start();
// Verifica se o nome do usuário está na sessão
require_once 'session_check.php';

// Conexão com o banco de dados
require_once 'db.php';

// Carregar perguntas na sessão (somente se ainda não existirem)
if (!isset($_SESSION['questoes'])) {
    $_SESSION['questoes'] = [
        ["pergunta" => "O que é, o que é: quanto mais você tira, maior ele fica?", "resposta" => [["texto" => "Um balão", "correta" => false], ["texto" => "Uma mochila", "correta" => false], ["texto" => "Um buraco", "correta" => true], ["texto" => "Um copo", "correta" => false]]],
        ["pergunta" => "O que tem cabeça, tem dente, tem barba, mas não é gente?", "resposta" => [["texto" => "Uma cebola", "correta" => true], ["texto" => "Alho", "correta" => false], ["texto" => "Um porco", "correta" => false], ["texto" => "Um peixe", "correta" => false]]],
        ["pergunta" => "O que é, o que é: você quebra, mas não machuca?", "resposta" => [["texto" => "Um prato", "correta" => false], ["texto" => "Um ovo", "correta" => true], ["texto" => "Uma janela", "correta" => false], ["texto" => "Uma promessa", "correta" => false]]],
        ["pergunta" => "O que é, o que é: tem um olho, mas não vê nada?", "resposta" => [["texto" => "Um tornado", "correta" => true], ["texto" => "Uma árvore", "correta" => false], ["texto" => "A agulha", "correta" => false], ["texto" => "Uma faca", "correta" => false]]],
        ["pergunta" => "O que é, o que é: tem uma perna só e uma barriga bem redonda, mas mesmo assim anda?", "resposta" => [["texto" => "Um boneco de neve", "correta" => false], ["texto" => "Um pião", "correta" => false], ["texto" => "Um saco de batatas", "correta" => true], ["texto" => "Uma bola", "correta" => false]]],
        ["pergunta" => "O que é, o que é: tem chave, mas nunca abre nenhuma porta?", "resposta" => [["texto" => "Um piano", "correta" => true], ["texto" => "Uma guitarra", "correta" => false], ["texto" => "Um computador", "correta" => false], ["texto" => "Um cofre", "correta" => false]]],
        ["pergunta" => "O que é, o que é: você pode pegar e colocar em um copo, mas nunca vai conseguir ver?", "resposta" => [["texto" => "Luz", "correta" => false], ["texto" => "Água", "correta" => false], ["texto" => "Sombra", "correta" => true], ["texto" => "Pensamento", "correta" => false]]],
        ["pergunta" => "O que é, o que é: tem 5 letras, mas se você tirar 2, fica com 4?", "resposta" => [["texto" => "Água", "correta" => false], ["texto" => "Anel", "correta" => false], ["texto" => "Relógio", "correta" => false], ["texto" => "Peixe", "correta" => true]]],
        ["pergunta" => "O que é, o que é: quanto mais você pega, mais fica para trás?", "resposta" => [["texto" => "A areia", "correta" => false], ["texto" => "O caminho", "correta" => true], ["texto" => "O tempo", "correta" => false], ["texto" => "O vento", "correta" => false]]],
        ["pergunta" => "O que é, o que é: quanto mais você escurece, mais brilha?", "resposta" => [["texto" => "Uma estrela", "correta" => true], ["texto" => "O sol", "correta" => false], ["texto" => "O fogo", "correta" => false], ["texto" => "A lua", "correta" => false]]],
        [
            "pergunta" => "O que é, o que é: quanto mais você tira, mais cresce?",
            "resposta" => [
                ["texto" => "A montanha", "correta" => false],
                ["texto" => "O dinheiro", "correta" => false],
                ["texto" => "A raiz", "correta" => false],
                ["texto" => "O buraco", "correta" => true]
            ]
        ],
        [

            "pergunta" => "O que é, o que é: tem pés, mas não caminha?",
            "resposta" => [
                ["texto" => "Uma cadeira", "correta" => false],
                ["texto" => "Uma cama", "correta" => true],
                ["texto" => "Um sofá", "correta" => false],
                ["texto" => "Uma mesa", "correta" => false]
            ]
        ],
        [
            "pergunta" => "O que é, o que é: passa diante do sol, mas não faz sombra?",
            "resposta" => [
                ["texto" => "O vento", "correta" => true],
                ["texto" => "Uma nuvem", "correta" => false],
                ["texto" => "A chuva", "correta" => false],
                ["texto" => "O pensamento", "correta" => false]
            ]
        ],
        [
            "pergunta" => "O que é, o que é: sobe, mas nunca desce?",
            "resposta" => [
                ["texto" => "O balão", "correta" => false],
                ["texto" => "O elevador", "correta" => false],
                ["texto" => "A fumaça", "correta" => false],
                ["texto" => "A idade", "correta" => true]
            ]
        ],
        [
            "pergunta" => "O que é, o que é: pertence a você, mas é usado mais pelos outros?",
            "resposta" => [
                ["texto" => "Seu tempo", "correta" => false],
                ["texto" => "Sua voz", "correta" => false],
                ["texto" => "Seu nome", "correta" => true],
                ["texto" => "Seu chapéu", "correta" => false]
            ]
        ],
        [
            "pergunta" => "O que é, o que é: quanto mais seca, mais molhada fica?",
            "resposta" => [
                ["texto" => "A esponja", "correta" => false],
                ["texto" => "A toalha", "correta" => true],
                ["texto" => "O chão", "correta" => false],
                ["texto" => "A chuva", "correta" => false]
            ]
        ],
        [
            "pergunta" => "O que é, o que é: quanto mais você corre, mais fica para trás?",
            "resposta" => [
                ["texto" => "O rastro", "correta" => true],
                ["texto" => "A sombra", "correta" => false],
                ["texto" => "O tempo", "correta" => false],
                ["texto" => "A poeira", "correta" => false]
            ]
        ],
        [
            "pergunta" => "O que é, o que é: todo mundo tem, mas ninguém pode perder?",
            "resposta" => [
                ["texto" => "O controle", "correta" => false],
                ["texto" => "A paciência", "correta" => false],
                ["texto" => "O nome", "correta" => true],
                ["texto" => "A esperança", "correta" => false]
            ]
        ],
        [
            "pergunta" => "O que é, o que é: enche uma casa, mas não ocupa espaço?",
            "resposta" => [
                ["texto" => "O calor", "correta" => false],
                ["texto" => "O ar", "correta" => false],
                ["texto" => "A música", "correta" => false],
                ["texto" => "A luz", "correta" => true]
            ]
        ],
        [
            "pergunta" => "O que é, o que é: anda sem pernas e assobia sem boca?",
            "resposta" => [
                ["texto" => "O vento", "correta" => true],
                ["texto" => "O trem", "correta" => false],
                ["texto" => "A cobra", "correta" => false],
                ["texto" => "O motor", "correta" => false]
            ]
        ],
        [
            "pergunta" => "O que é, o que é: cai em pé e corre deitado?",
            "resposta" => [
                ["texto" => "O vento", "correta" => false],
                ["texto" => "A chuva", "correta" => true],
                ["texto" => "A folha", "correta" => false],
                ["texto" => "A água", "correta" => false]
            ]
        ],

        [

            "pergunta" => "O que é, o que é: tem cabeça, tem dente, mas nunca come nem é gente?",
            "resposta" => [
                ["texto" => "O prego", "correta" => false],
                ["texto" => "O peixe", "correta" => false],
                ["texto" => "O alho", "correta" => true],
                ["texto" => "A escova", "correta" => false]
            ]
        ],
        [
            "pergunta" => "O que é, o que é: sempre sobe e nunca desce, mas não é idade?",
            "resposta" => [
                ["texto" => "A fumaça", "correta" => true],
                ["texto" => "O preço", "correta" => false],
                ["texto" => "O sol", "correta" => false],
                ["texto" => "O balão", "correta" => false]
            ]
        ],
        [
            "pergunta" => "O que é, o que é: vive no mar, mas não nada, e tem casa, mas não é gente?",
            "resposta" => [
                ["texto" => "O peixe", "correta" => false],
                ["texto" => "A ostra", "correta" => true],
                ["texto" => "O caranguejo", "correta" => false],
                ["texto" => "O cavalo-marinho", "correta" => false]
            ]
        ],
        [
            "pergunta" => "O que é, o que é: quanto mais você tira, maior ele fica?",
            "resposta" => [
                ["texto" => "O bolo", "correta" => false],
                ["texto" => "O poço", "correta" => false],
                ["texto" => "A montanha", "correta" => false],
                ["texto" => "O buraco", "correta" => true]
            ]
        ],
        [
            "pergunta" => "O que é, o que é: não tem boca, mas vive a falar; não tem ouvidos, mas vive a escutar?",
            "resposta" => [
                ["texto" => "O rádio", "correta" => true],
                ["texto" => "O telefone", "correta" => false],
                ["texto" => "O eco", "correta" => false],
                ["texto" => "A TV", "correta" => false]
            ]
        ],
        [
            "pergunta" => "O que é, o que é: tem asas, mas não voa?",
            "resposta" => [
                ["texto" => "A galinha", "correta" => false],
                ["texto" => "O ventilador", "correta" => true],
                ["texto" => "O avião de papel", "correta" => false],
                ["texto" => "O chapéu de festa", "correta" => false]
            ]
        ],
        [
            "pergunta" => "O que é, o que é: não tem olhos, mas consegue ver o futuro?",
            "resposta" => [
                ["texto" => "A bola de cristal", "correta" => false],
                ["texto" => "O relógio", "correta" => false],
                ["texto" => "O calendário", "correta" => true],
                ["texto" => "O horóscopo", "correta" => false]
            ]
        ],
        [
            "pergunta" => "O que é, o que é: tem tronco, mas não é corpo; tem folha, mas não é livro?",
            "resposta" => [
                ["texto" => "A árvore", "correta" => true],
                ["texto" => "O papel", "correta" => false],
                ["texto" => "A revista", "correta" => false],
                ["texto" => "A cadeira", "correta" => false]
            ]
        ],
        [
            "pergunta" => "O que é, o que é: fica no meio do ovo?",
            "resposta" => [
                ["texto" => "A gema", "correta" => false],
                ["texto" => "O espaço", "correta" => false],
                ["texto" => "A clara", "correta" => false],
                ["texto" => "A letra V", "correta" => true]
            ]
        ],
        [
            "pergunta" => "O que é, o que é: corre sem pernas, fala sem boca, e ouve sem ouvidos?",
            "resposta" => [
                ["texto" => "O eco", "correta" => false],
                ["texto" => "O vento", "correta" => false],
                ["texto" => "O rio", "correta" => true],
                ["texto" => "O pensamento", "correta" => false]
            ]
        ],
        [

            "pergunta" => "O que é, o que é: pode encher uma sala, mas não ocupa espaço?",
            "resposta" => [
                ["texto" => "O ar", "correta" => false],
                ["texto" => "A luz", "correta" => true],
                ["texto" => "O eco", "correta" => false],
                ["texto" => "O som", "correta" => false]
            ]
        ],
        [
            "pergunta" => "O que é, o que é: está sempre no final, mas também no começo?",
            "resposta" => [
                ["texto" => "A letra O", "correta" => true],
                ["texto" => "O ponto final", "correta" => false],
                ["texto" => "O infinito", "correta" => false],
                ["texto" => "A vida", "correta" => false]
            ]
        ],
        [
            "pergunta" => "O que é, o que é: quanto mais seca, mais molhada fica?",
            "resposta" => [
                ["texto" => "O chão", "correta" => false],
                ["texto" => "A esponja", "correta" => false],
                ["texto" => "A toalha", "correta" => true],
                ["texto" => "O papel", "correta" => false]
            ]
        ],
        [
            "pergunta" => "O que é, o que é: tem quatro patas, mas nunca anda?",
            "resposta" => [
                ["texto" => "O banco", "correta" => false],
                ["texto" => "A mesa", "correta" => true],
                ["texto" => "O sofá", "correta" => false],
                ["texto" => "O tigre", "correta" => false]
            ]
        ],
        [
            "pergunta" => "O que é, o que é: quanto mais você tira, mais fica para trás?",
            "resposta" => [
                ["texto" => "As pegadas", "correta" => true],
                ["texto" => "A estrada", "correta" => false],
                ["texto" => "O tempo", "correta" => false],
                ["texto" => "A areia", "correta" => false]
            ]
        ],
        [
            "pergunta" => "O que é, o que é: tem dentes, mas não morde?",
            "resposta" => [
                ["texto" => "A serra", "correta" => false],
                ["texto" => "O garfo", "correta" => false],
                ["texto" => "O pente", "correta" => true],
                ["texto" => "O zíper", "correta" => false]
            ]
        ],
        [
            "pergunta" => "O que é, o que é: quanto mais você tira, mais sujo fica?",
            "resposta" => [
                ["texto" => "A roupa", "correta" => false],
                ["texto" => "O chão", "correta" => true],
                ["texto" => "O pó", "correta" => false],
                ["texto" => "A lousa", "correta" => false]
            ]
        ],
        [
            "pergunta" => "O que é, o que é: pode voar sem asas, cair sem se machucar e correr sem pernas?",
            "resposta" => [
                ["texto" => "O vento", "correta" => false],
                ["texto" => "A sombra", "correta" => false],
                ["texto" => "A nuvem", "correta" => false],
                ["texto" => "O tempo", "correta" => true]
            ]
        ],
        [
            "pergunta" => "O que é, o que é: entra na água e não se molha?",
            "resposta" => [
                ["texto" => "A sombra", "correta" => true],
                ["texto" => "O gelo", "correta" => false],
                ["texto" => "O barco", "correta" => false],
                ["texto" => "O ar", "correta" => false]
            ]
        ],
        [
            "pergunta" => "O que é, o que é: faz você abrir a boca, mas não é comida?",
            "resposta" => [
                ["texto" => "O dentista", "correta" => false],
                ["texto" => "O vento", "correta" => false],
                ["texto" => "O bocejo", "correta" => true],
                ["texto" => "A música", "correta" => false]
            ]
        ]
    ];
    // Selecionar aleatoriamente 10 questões
    shuffle($_SESSION['questoes']);  // Embaralha as questões
    $_SESSION['questoes'] = array_slice($_SESSION['questoes'], 0, 10);  // Pega as 10 primeiras questões
}

$usuario = $_SESSION['usuario']; // Nome do usuário da sessão

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz de Perguntas</title>
    <link rel="stylesheet" href="./estilo-jogo.css">
</head>

<body>
    <!-- O campo de input oculto para passar as questões para o JavaScript -->
    <input type="hidden" id="questoesJson" value='<?php echo  htmlspecialchars(json_encode($_SESSION['questoes']), ENT_QUOTES, 'UTF-8'); ?>'>

    <div class="container">
        <div class="container-questao">
            <h2 class="questao"></h2>
        </div>
        <div class="container-respostas"></div>
        <div class="container-controles">
            <button class="proxima-pergunta hide">Próxima Pergunta</button>
            <form action="submit.php" method="POST">
                <button type="submit" class="finalizar hide">Finalizar</button>
                <input type="hidden" name="totalCorreta" id="totalCorreta">
            </form>
        </div>
    </div>
    <!-- JavaScript no final para garantir que os elementos HTML já estão carregados -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const questoes = JSON.parse(document.getElementById("questoesJson").value);
            let currentQuestaoIndex = 0;
            let totalCorreta = 0;
            let jogoFinalizado = false;

            const $containerQuestao = document.querySelector(".container-questao .questao");
            const $containerRespostas = document.querySelector(".container-respostas");
            const $proximaPerguntaBotao = document.querySelector(".proxima-pergunta");
            const $finalizarJogoBotao = document.querySelector(".finalizar");

            // Inicia o jogo
            function iniciarJogo() {
                currentQuestaoIndex = 0;
                totalCorreta = 0;
                jogoFinalizado = false;
                exibirPergunta();
            }

            // Exibe a pergunta atual e suas opções de resposta
            function exibirPergunta() {
                $containerRespostas.innerHTML = ''; // Limpa respostas anteriores
                $proximaPerguntaBotao.classList.add('hide');
                $finalizarJogoBotao.classList.add('hide');

                const questaoAtual = questoes[currentQuestaoIndex];
                $containerQuestao.textContent = questaoAtual.pergunta;

                questaoAtual.resposta.forEach(resposta => {
                    const botaoResposta = document.createElement("button");
                    botaoResposta.classList.add("resposta", "botao");
                    botaoResposta.textContent = resposta.texto;
                    botaoResposta.dataset.correta = resposta.correta;
                    botaoResposta.addEventListener('click', selecionarResposta);
                    $containerRespostas.appendChild(botaoResposta);
                });
            }

            // Lida com a seleção de uma resposta
            function selecionarResposta(evento) {
                if (jogoFinalizado) return;

                const respostaSelecionada = evento.target;
                const correta = respostaSelecionada.dataset.correta === "true";

                // Incrementa total de corretas se a resposta estiver correta
                if (correta) {
                    totalCorreta++;
                }

                // Marca todas as respostas como corretas ou incorretas
                Array.from($containerRespostas.children).forEach(botao => {
                    botao.classList.add(botao.dataset.correta === "true" ? "correta" : "incorreta");
                    botao.disabled = true; // Desativa os botões
                });

                // Atualiza o campo oculto com o total de acertos
                document.getElementById("totalCorreta").value = totalCorreta;

                // Exibe botão de próxima pergunta ou finalizar
                if (currentQuestaoIndex >= questoes.length - 1) {
                    $finalizarJogoBotao.classList.remove('hide');
                } else {
                    $proximaPerguntaBotao.classList.remove('hide');
                }
            }

            // Exibe a próxima pergunta
            $proximaPerguntaBotao.addEventListener('click', () => {
                currentQuestaoIndex++;
                exibirPergunta();
            });

            // Inicia o jogo na primeira pergunta
            iniciarJogo();
        });
    </script>

</body>

</html>