document.addEventListener('DOMContentLoaded', function () {

    const perguntas = [
    { texto: 'Você gosta de resolver problemas matemáticos e lógicos?', area: 'exatas' },
    { texto: 'Você tem interesse em debates sobre sociedade e cultura?', area: 'humanas' },
    { texto: 'Você se interessa por estudos sobre seres vivos e natureza?', area: 'biologicas' },
    { texto: 'Você gosta de atividades que envolvem criatividade e expressão visual?', area: 'artes' },
    { texto: 'Você tem facilidade em se comunicar e trabalhar com pessoas?', area: 'sociais' },
    { texto: 'Você gosta de aprender novos idiomas e explorar diferentes culturas?', area: 'linguagens' },
    { texto: 'Você se interessa por tecnologia, programação e desenvolvimento de sistemas?', area: 'exatas' },
    { texto: 'Você gosta de organizar, planejar e gerenciar projetos ou equipes?', area: 'exatas' },
    { texto: 'Você tem curiosidade sobre história, política e questões sociais?', area: 'humanas' },
    { texto: 'Você gosta de investigar fenômenos científicos e fazer experimentos?', area: 'biologicas' },
    { texto: 'Você gosta de expressar ideias através de música, teatro ou dança?', area: 'artes' },
    { texto: 'Você se interessa por comportamento humano, psicologia ou educação?', area: 'sociais' },
    { texto: 'Você gosta de resolver problemas complexos usando lógica e raciocínio?', area: 'exatas' },
    { texto: 'Você se interessa por comunicação, jornalismo ou marketing digital?', area: 'linguagens' }
];


    const sugestoesCarreiras = {
        exatas: 'Ciência de Dados, Engenharia, Análise de Sistemas.',
        humanas: 'História, Filosofia, Relações Internacionais.',
        biologicas: 'Medicina Veterinária, Agronomia, Biologia Marinha.',
        artes: 'Design de Moda, Arquitetura, Belas Artes.',
        sociais: 'Jornalismo, Publicidade, Recursos Humanos.',
        linguagens: 'Letras, Tradução, Comunicação Social.'
       };

    let indice = 0;

    const respostas = new Array(perguntas.length).fill(null);

    let pontuacoes = {
        exatas: 0,
        humanas: 0,
        biologicas: 0,
        artes: 0,
        sociais: 0,
        linguagens:0,
    };

    const enunciadoEl = document.getElementById('enunciados');
    const areaQuestaoDiv = document.getElementById('area-questao');
    const resultadoDiv = document.getElementById('resultado-teste');
    const carreiraSugestao = document.getElementById('carreira-sugerida');
    const botaoProximo = document.getElementById('proximo');

    const radios = document.querySelectorAll('input[name="opcao"]');

    function mostrarQuestao() {
        if (enunciadoEl && indice < perguntas.length) {
            enunciadoEl.innerHTML = '<span class="indicador-pergunta">(' + (indice + 1) + '/' + perguntas.length + ')</span>' + perguntas[indice].texto + '';
        }
    }

    function limparSelecao() {
        for (let i = 0; i < radios.length; i++) {
            radios[i].checked = false;
        }
    }

    function salvarRespostaAtual() {
        const selecionado = document.querySelector('input[name="opcao"]:checked');
        if (selecionado) {
            respostas[indice] = parseInt(selecionado.value);
        }
    }

    function calcularPontuacoes() {
        pontuacoes = { exatas: 0, humanas: 0, biologicas: 0, artes: 0, sociais: 0, linguagens:0 };

        for (let i = 0; i < respostas.length; i++) {
            const resposta = respostas[i];

            if (resposta !== null) {
                const area = perguntas[i].area;
                if (pontuacoes.hasOwnProperty(area)) {
                    pontuacoes[area] += resposta;
                }
            }
        }

        console.log('Pontuações Finais:', pontuacoes);
    }

    function exibirResultado() {

        const parg = document.getElementsByName("parg");
        if (parg.length > 0) {
            parg[0].style.display = "none";
        }

        if (areaQuestaoDiv) areaQuestaoDiv.style.display = 'none';

        calcularPontuacoes();

        let areaVencedora = '';
        let maxPontos = -1;

        for (const area in pontuacoes) {
            if (pontuacoes.hasOwnProperty(area)) {
                if (pontuacoes[area] > maxPontos) {
                    maxPontos = pontuacoes[area];
                    areaVencedora = area;
                }
            }
        }

        const sugestao = sugestoesCarreiras[areaVencedora] || 'Não foi possível determinar uma área.';

        let gridHTML = `
            <div class="resultados-grid" style="justify-content: center;display:flex; flex-direction: row; align-items: center;">
                <form action="/teste-vocacional/processar" method="POST" >
                    <input type="hidden" name="_token" value="${document.querySelector('meta[name=csrf-token]').content}">
                    <input type="hidden" name="area" value="${areaVencedora}">
                    <input type="hidden" name="pontuacao" value="${maxPontos}">
                    <button type="submit" class="bt-testeVc">Clique aqui</button>
                </form>
            </div>
        `;

        const htmlFinal = `
            <h2>RESULTADO</h2>
            <p id="carreira-sugerida">
                Sua área de maior afinidade é <strong>${areaVencedora.toUpperCase()}</strong>!<br>
                Sugestões de carreira: ${sugestao} <br><br>
                Confira alguns cursos que podem te interessar:
            </p>
            
            ${gridHTML}

            <button id="res-teste" onclick="location.reload()">Refazer Teste</button>
        `;

        if (resultadoDiv) {
            resultadoDiv.innerHTML = htmlFinal;
            resultadoDiv.style.display = 'flex';
        }
    }

    function proximaQuestao() {
        const selecionado = document.querySelector('input[name="opcao"]:checked');

        if (!selecionado) {
            const msgTeste = document.getElementById('msgTeste');

            if (msgTeste) {
                msgTeste.textContent = 'Por favor, selecione uma opção para continuar.';
                msgTeste.classList.add('mensagem-erro');
                msgTeste.classList.remove('mensagem-oculta');
            }
            return;
        } else {
            const msgTeste = document.getElementById('msgTeste');
            if (msgTeste) {
                msgTeste.textContent = '';
                msgTeste.classList.add('mensagem-oculta');
                msgTeste.classList.remove('mensagem-erro');
            }
        }


        salvarRespostaAtual();
        limparSelecao();

        if (indice < perguntas.length - 1) {
            indice++;
            mostrarQuestao();
        } else {
            console.log('Fim do teste. Respostas:', respostas);
            exibirResultado();
        }
    }

    if (botaoProximo) {
        botaoProximo.addEventListener('click', proximaQuestao);
    }

    mostrarQuestao();
});