document.addEventListener('DOMContentLoaded', function() {

    const perguntas = [
        { texto: 'enunciado 1', area: 'area 1' },
        { texto: 'enunciado 2', area: 'area 2' },
        { texto: 'enunciado 3', area: 'area 3' }
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
            enunciadoEl.textContent = '(' + (indice + 1) + '/' + perguntas.length + ') ' + perguntas[indice].texto;
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
        
        if (carreiraSugestao) {
            carreiraSugestao.textContent = 'Sua área de maior afinidade é ' + areaVencedora.toUpperCase() + '! Sugestões de carreira: ' + sugestao;
        }

        if (areaQuestaoDiv) areaQuestaoDiv.style.display = 'none';
        if (resultadoDiv) resultadoDiv.style.display = 'block';
    }

    function proximaQuestao() {
        const selecionado = document.querySelector('input[name="opcao"]:checked');
        
        if (!selecionado) {
            alert('Por favor, selecione uma opção para continuar.');
            return; 
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