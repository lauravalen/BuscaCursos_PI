@include('includes.header')


<main>

    <!--  CAMPO BUSCA */ -->

    <div class="search-container">
        <div class="div-titulo">
            <h1>BUSCA CURSOS</h1>
            <p>Facilitando sua jornada no aprendizado online</p>
        </div>

        <div class="div-search">
            <form action="{{ route('cursos.index') }}" method="GET" autocomplete="off">
                <input type="text" name="busca" id="barraDeBusca" placeholder="    DIGITE SUA BUSCA" required>
                <div id="sugestoes" class="sugestoes-container"></div>

            </form>
        </div>
    </div>

    <!--  CAMPO CATEGORIA E CURSOS */ -->
    <div class="div-curso-cat">

        <!-- categorias -->
        <div class="div-categoria">
            <ul>
                <li><a href="/Cursos">todos os cursos</a></li>

                @foreach($categorias as $categoria)
                <li>
                    <a href="{{ route('cursos.filtrar') }}?categoria[]={{ $categoria->CAT_INT_ID }}">
                        {{ strtolower($categoria->CAT_STR_DESC) }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>


        <!-- Acesso Rapido -->
        <div class="div-acesso">

            <!-- subtitulo -->

            <div class="div-subTitle">
                <h2>CURSOS ON-LINE E GRATUITOS</h2>
                <p>"Oportunidades de aprendizado gratuitas, com acesso fácil às melhores plataformas."</p>
                <hr>
            </div>

            <!-- cursos -->

            <div class="div-cursos">

                <div class="linha-curso">

                    <!-- Linha 1 -->

                    <div class="curso">
                        <a href="Pages/pagesCursos.html">
                            <h3>Recentes</h3>
                            <div class="carrossel-container">
                                <div class="carrossel">
                                    <img src="assets/images/img-recentes.jpg" alt="">
                                    <img src="assets/images/img2-recentes.png" alt="">
                                    <img src="assets/images/img3-recentes.png" alt="">
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="curso">
                        <a href="Pages/pagesCursos.html">
                            <h3>Populares</h3>
                            <div class="carrossel-container">
                                <div class="carrossel">
                                    <img src="assets/images/img3-populares.png" alt="">
                                    <img src="assets/images/img-populares.png" alt="">
                                    <img src="assets/images/img2-populares.png" alt="">
                                </div>
                            </div>
                        </a>
                        <!-- <imgsrc="assets/images/fundo_buscaCursos.jpg"alt="">-->
                    </div>
                </div>

                <!-- Linha 2 -->
                <div class="linha-curso">

                    <div class="curso">
                        <a href="Pages/pagesCursos.html">
                            <h3> essenciais</h3>
                            <img src="assets/images/essenciais.jpg" alt="">
                        </a>
                    </div>

                    <div class="curso">
                        <a href="Pages/pagesCursos.html">
                            <h3>primeiros passos</h3>
                            <img src="assets/images/primeiroPassos.png" alt="">
                        </a>
                    </div>
                </div>



            </div>



        </div>



    </div>

    <div class="div-tt-vocal">
        <!-- teste vocacional -->
        <div class="teste-vocac-index">
            <h2>Teste Vocacional</h2>
            <p>Não sabe por onde começar? Deixe que nosso teste te guie!
            <br>
            Responda algumas perguntas e encontre a carreira perfeita para seu perfil.</p>
            <img src="../assets/images/Negocios.jpg" alt="Imagem representando o teste vocacional">
        </div>
                    
            @if(Session::has('usuario'))
            <!-- Se estiver logado -->
            <input id="faca-teste" type="button" value="FAÇA O TESTE"
                onclick="location.href='/TesteVocacional'">
            @else
            <!-- Se não estiver logado -->
            <input id="faca-teste" type="button" value="FAÇA O TESTE"
                onclick="if(confirm('Você precisa fazer login para acessar o teste vocacional.\nDeseja ir para a tela de login agora?')) { location.href='/Login'; }">

            @endif
        </div>

    </div>


</main>

@include('includes.footer')