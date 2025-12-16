@include('includes.header')

        <main class="main-formulario">
            <div class="div-esquerda">
                <h1>Apoie o projeto</h1>
                <p>Nosso motor de busca procura dar visibilidade à plataformas de ensino que não são favorecidas pelos sites de busca convencionais,
                por esse motivos precisamos da contibuição de nossos usuários para arrecadar conhecimento sobre plataformas desconhecidas pelo público geral e alimentar nosso banco de dados.</p>
                <p>Aqui você pode deixar suas sugestões de cursos para agregar nosso site e contribuir para seu crescimento.</p>
            </div>
            <div class="div-direita">
                <h1>Formulário de envio</h1>

                <div id="feedback-apoio" class="mensagem-oculta"></div>

                <form id="formApoio" class="formulario" autocomplete="on">
                    <label for="nome">Nome: </label><br>
                        <input id="nomeApoio" type="text" class="entrada" autocomplete="name"><br>
                
                    <label for="email">E-mail: </label><br>
                        <input id="emailApoio" type="email" class="entrada" autocomplete="email"><br>

                    <label for="mensagem">Mensagem: </label><br>
                        <textarea id="mensagem" maxlength="1000" rows="5" cols="25" placeholder="Insira sua mensagem aqui"></textarea><br>

                <!-- <input type="reset" value="Limpar" class="botao"> -->
                <input type="submit" value="Enviar" class="botao">
            </form>

            </div>
            
        </main>

   @include('includes.footer')