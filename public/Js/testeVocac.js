document.addEventListener('DOMContentLoaded', function() {

    const perguntas = [
        { texto: 'Você gosta de resolver problemas matemáticos e lógicos?', area: 'exatas' },
        { texto: 'Você tem interesse em debates sobre sociedade e cultura?', area: 'humanas' },
        { texto: 'Você se interessa por estudos sobre seres vivos e natureza?', area: 'biologicas' },
        { texto: 'Você gosta de atividades que envolvem criatividade e expressão visual?', area: 'artes' },
        { texto: 'Você tem facilidade em se comunicar e trabalhar com pessoas?', area: 'sociais' }
    ];

    const sugestoesCarreiras = {
        exatas: 'Ciência de Dados, Engenharia, Análise de Sistemas.',
        humanas: 'História, Filosofia, Relações Internacionais.',
        biologicas: 'Medicina Veterinária, Agronomia, Biologia Marinha.',
        artes: 'Design de Moda, Arquitetura, Belas Artes.',
        sociais: 'Jornalismo, Publicidade, Recursos Humanos.'
    };

    let indice = 0;

    const respostas = new Array(perguntas.length).fill(null);

    let pontuacoes = {
        exatas: 0,
        humanas: 0,
        biologicas: 0,
        artes: 0,
        sociais: 0
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
        pontuacoes = { exatas: 0, humanas: 0, biologicas: 0, artes: 0, sociais: 0 };
 
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
        
        const caminhoImagem = '../assets/images/img-curso-TI.png';
        
        let gridHTML = `
            <div class="resultados-grid">
                <a href="#" class="curso-box">
                    <img src="${caminhoImagem}" alt="Sugestão de Curso 1">
                </a>
                <a href="#" class="curso-box">
                    <img src="${caminhoImagem}" alt="Sugestão de Curso 2">
                </a>
                <a href="#" class="curso-box">
                    <img src="${caminhoImagem}" alt="Sugestão de Curso 3">
                </a>
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