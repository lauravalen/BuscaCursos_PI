@include('includes.header')

    <div class="teste-vocac">

        <h1>Teste Vocacional</h1>
        <p name="parg">Responda as perguntas abaixo para descobrir qual carreira combina mais com você!</p>

        <div id="msgTeste" class="mensagem-oculta"></div>

        <div id="area-questao">
            <h2 id="enunciados">Enunciados</h2>
            <div id="opcoes" class="opcoes-container">

                <div class="opcao-item">
                    <input type="radio" name="opcao" id="opcao1" value="1">
                    <label for="opcao1">
                    1 
                    <span>Discordo Totalmente</span>
                    </label>
                </div>

                <div class="opcao-item">
                    <input type="radio" name="opcao" id="opcao2" value="2">
                    <label for="opcao2" id="label2"> 2
                    <span>Discordo Parcialmente</span>
                </label>
                </div>

                <div class="opcao-item">
                    <input type="radio" name="opcao" id="opcao3" value="3">
                    <label for="opcao3" id="label3"> 3
                    <span>Neutro</span>
                    </label>
                </div>

                <div class="opcao-item">
                    <input type="radio" name="opcao" id="opcao4" value="4">
                    <label for="opcao4" id="label4"> 4
                    <span>Concordo Parcialmente</span>
                    </label>
                </div>

                <div class="opcao-item">
                    <input type="radio" name="opcao" id="opcao5" value="5">
                    <label for="opcao5" id="label5"> 5
                    <span>Concordo Totalmente</span>
                    </label>
                </div>

        </div>

        <br>
        <button id="proximo">Próximo</button>

        </div>

    </div>


    <div id="resultado-teste" style="display:none;">
            <h2>Resultado</h2>
            <p id="carreira-sugerida"></p>
            <button id="res-teste" onclick="location.reload()">Refazer Teste</button>
    </div>

   @include('includes.footer')