document.addEventListener('DOMContentLoaded', function() {

    const perguntas = [
    // ÁREA: EXATAS
    // { texto: 'Analisar tabelas e gráficos para extrair informações precisas me parece um desafio estimulante.', area: 'exatas' },
    // { texto: 'Gosto de resolver problemas que exigem uma única resposta precisa e lógica.', area: 'exatas' },
    // { texto: 'Sou bom em planejar e construir sistemas complexos, como códigos ou projetos de engenharia.', area: 'exatas' },
    // { texto: 'A tecnologia e o funcionamento interno de máquinas me fascinam.', area: 'exatas' },
    // { texto: 'Tenho facilidade em lidar com fórmulas e conceitos matemáticos abstratos.', area: 'exatas' },
    // { texto: 'Prefiro trabalhos onde as regras e os processos são claros e previsíveis.', area: 'exatas' },
    // { texto: 'Meu raciocínio é mais rápido quando o problema pode ser decomposto em etapas lógicas.', area: 'exatas' },

    // // ÁREA: HUMANAS
    // { texto: 'Consigo entender facilmente as motivações e os sentimentos das outras pessoas.', area: 'humanas' },
    // { texto: 'Gosto de ler sobre história, filosofia e as complexidades da sociedade.', area: 'humanas' },
    // { texto: 'Argumentar e defender meu ponto de vista em debates me dá energia.', area: 'humanas' },
    // { texto: 'Preocupo-me ativamente com questões de justiça social e direitos humanos.', area: 'humanas' },
    // { texto: 'Tenho habilidade em me expressar claramente, tanto na escrita quanto na fala.', area: 'humanas' },
    // { texto: 'Acredito que a análise crítica de textos e ideias é mais importante que cálculos.', area: 'humanas' },
    // { texto: 'Sinto-me recompensado ao ensinar ou aconselhar outras pessoas.', area: 'humanas' },

    // // ÁREA: BIOLÓGICAS
    // { texto: 'Tenho curiosidade sobre o funcionamento do corpo humano e dos seres vivos.', area: 'biologicas' },
    // { texto: 'Prefiro atividades que me permitam trabalhar com a natureza ou em um ambiente de pesquisa científica.', area: 'biologicas' },
    // { texto: 'A conservação do meio ambiente é uma causa pela qual eu lutaria ativamente.', area: 'biologicas' },
    // { texto: 'Gosto de seguir protocolos e procedimentos rigorosos em laboratório.', area: 'biologicas' },
    // { texto: 'A ideia de estudar doenças, curas ou a genética me atrai muito.', area: 'biologicas' },
    // { texto: 'Sinto-me à vontade usando microscópios e ferramentas de análise biológica.', area: 'biologicas' },
    // { texto: 'A anatomia e os processos naturais são assuntos que estudo por prazer.', area: 'biologicas' },

    // // ÁREA: ARTES
    // { texto: 'Meu método preferido de expressão é através de formas visuais, música ou performance.', area: 'artes' },
    // { texto: 'Valorizo muito a estética e a beleza em tudo que me proponho a fazer.', area: 'artes' },
    // { texto: 'Tenho uma imaginação fértil e prefiro criar algo novo a analisar o existente.', area: 'artes' },
    // { texto: 'A ideia de trabalhar com design, moda ou decoração é excitante.', area: 'artes' },
    // { texto: 'Sinto-me desmotivado por tarefas que não permitem minha criatividade livremente.', area: 'artes' },
    // { texto: 'Sou bom em usar cores, texturas e sons para transmitir uma emoção ou mensagem.', area: 'artes' },
    // { texto: 'Gosto de visitar museus, galerias de arte ou assistir a apresentações culturais.', area: 'artes' },

    // ÁREA: SOCIAIS
    // { texto: 'Tenho facilidade em liderar e motivar grupos de pessoas para um objetivo comum.', area: 'sociais' },
    // { texto: 'Fazer networking e manter uma vasta rede de contatos é natural para mim.', area: 'sociais' },
    // { texto: 'Gosto de atuar como mediador em conflitos ou organizar eventos sociais/profissionais.', area: 'sociais' },
    // { texto: 'Consigo vender uma ideia, produto ou serviço de forma persuasiva.', area: 'sociais' },
    // { texto: 'Prefiro estar em contato constante com o público do que trabalhar isoladamente.', area: 'sociais' },
    { texto: 'A gestão de projetos e o gerenciamento de equipes me atraem mais do que a execução técnica.', area: 'sociais' },
    { texto: 'Sou muito habilidoso em negociação e em encontrar soluções que satisfaçam a todos.', area: 'sociais' }
];

perguntas.sort(() => Math.random() - 0.5);

    const sugestoesCarreiras = {
        exatas: 'Ciência de Dados, Engenharia, Análise de Sistemas.',
        humanas: 'História, Filosofia, Relações Internacionais.',
        biologicas: 'Medicina Veterinária, Agronomia, Biologia Marinha.',
        artes: 'Design de Moda, Arquitetura, Artes Cênicas.',
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