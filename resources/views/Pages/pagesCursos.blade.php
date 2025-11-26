@include('includes.header')


<div class="search-container">
    <div class="div-search">
       <form action="{{ route('cursos.index') }}" method="GET" autocomplete="off">
            <input type="text" name="busca" id="barraDeBusca"
                placeholder="    DIGITE SUA BUSCA" value="{{ request('busca') }}">
            <div id="sugestoes" class="sugestoes-container"></div>
        </form>
    </div>
</div>

<div class="conteudo-principal">
    <!--FILTROS -->
    <div class="div_filtros">
        <form action="{{ route('cursos.filtrar') }}" method="GET" id="formFiltros">

            <div class="filtros-header">
                <h1>FILTROS</h1>
                <a href="{{ route('cursos.index') }}" class="btn-limpar">limpar</a>
            </div>

            <div class="div_select">

                <h2>Área do curso</h2>

                @foreach ($categorias as $categoria)
                    <label>
                        <input 
                            type="checkbox" 
                            name="categoria[]" 
                            value="{{ $categoria->CAT_INT_ID }}"
                            {{ in_array($categoria->CAT_INT_ID, request('categoria', [])) ? 'checked' : '' }}
                        >
                        {{ $categoria->CAT_STR_DESC }}
                    </label><br>
                @endforeach

            </div>

            <div class="div_select">

                <h2>Certificação</h2>
                <label>
                    <input type="checkbox" name="certificacao[]" value="com">
                    Com certificado
                </label><br>
                <label>
                    <input type="checkbox" name="certificacao[]" value="sem">
                    Sem certificado
                </label><br>

            </div>

            <div class="div_select">

                <h2>Tempo de curso</h2>
                <label>
                    <input type="checkbox" name="duracao[]" value="0-6">
                    6h ou menos
                </label><br>
                <label>
                    <input type="checkbox" name="duracao[]" value="6-12">
                    6h a 12h
                </label><br>
                <label>
                    <input type="checkbox" name="duracao[]" value="12-24">
                    12h a 24h
                </label><br>
                <label>
                    <input type="checkbox" name="duracao[]" value="24-60">
                    24h a 60h
                </label><br>
                <label>
                    <input type="checkbox" name="duracao[]" value="60-999">
                    60h+
                </label><br>

            </div>

            <div class="div_select">

                <h2>Avaliação</h2>
                <label>
                    <input type="checkbox" name="avaliacao" value="1">
                    ★
                </label><br>
                <label>
                    <input type="checkbox" name="avaliacao" value="2">
                    ★★
                </label><br>
                <label>
                    <input type="checkbox" name="avaliacao" value="3">
                    ★★★
                </label><br>
                <label>
                    <input type="checkbox" name="avaliacao" value="4">
                    ★★★★
                </label><br>
                <label>
                    <input type="checkbox" name="avaliacao" value="5">
                    ★★★★★
                </label><br>
            
            </div>

            <button type="submit" class="bt-aplicar-filtro">Aplicar Filtro</button>
        </forms>
    </div>

    <!--Cursos -->
    <div class="div-todos-cursos">
        <main>
            <h1>todos os cursos</h1>

            <div class="div-cursos">
            @forelse($cursos as $curso)
                    <div class="card_curso"
                        data-categoria="{{ strtolower($curso->areaCategoria->categoria->CAT_STR_DESC) }}"
                        data-certificacao="{{ strtolower($curso->CUR_STR_CERTIFICACAO) }}"
                        data-duracao="{{ intval($curso->CUR_FLO_QUANTHORA) }}"
                    >
                    <div class="image_curso">
                        <div class="rating">
                            @if(Session::has('usuario'))
                                @php
                                    $favorito = \App\Models\ModelFavorito::where('CUR_INT_ID', $curso->CUR_INT_ID)
                                        ->where('USU_INT_ID', Session::get('usuario')->USU_INT_ID)
                                        ->where('FAV_INT_ATIVO', 1)
                                        ->first();
                                @endphp

                                <form action="{{ route('favoritos.toggle', $curso->CUR_INT_ID) }}" method="POST" id="form-favorito-{{ $curso->CUR_INT_ID }}">
                                    @csrf
                                    <input
                                        type="checkbox"
                                        name="favorito"
                                        id="star1-{{ $curso->CUR_INT_ID }}"
                                        value="1"
                                        onchange="document.getElementById('form-favorito-{{ $curso->CUR_INT_ID }}').submit();"
                                        {{ $favorito ? 'checked' : '' }}
                                    >
                                    <label for="star1-{{ $curso->CUR_INT_ID }}"></label>
                                </form>
                            @else
                                <div onclick="alert('Você precisa estar logado para favoritar um curso!')">
                                    <input value="1" name="rating" id="star1-guest" type="checkbox">
                                    <label for="star1-guest"></label>
                                </div>
                            @endif
                        </div>

                        <img src="../assets/images/img-curso-tecnologia.png"
                            alt="imagem do curso {{ $curso->CUR_STR_TITULO }}">
                    </div>

                    <h3>{{ $curso->CUR_STR_TITULO }}</h3>
                    <p class="descricao">{{ $curso->CUR_STR_DESC }}</p>

                    <div class="info-curso">
                        <div class="botoes">
                            <a href="{{ $curso->CUR_STR_URL }}" target="_blank">Ir para curso</a>
                        </div>
                        <!-- <a href="#" class="avaliacao">(4,2)★★★★☆</a> -->
                        <a href="#" 
                        class="avaliacao" 
                        data-id="{{ $curso->CUR_INT_ID }}"
                        data-titulo="{{ $curso->CUR_STR_TITULO }}"
                        data-descricao="{{ $curso->CUR_STR_DESC }}"
                        >
                            Mais detalhes
                        </a>
                    </div>
                </div>

                @empty
                <div class="div-cursos">
                    <p>Nenhum curso encontrado</p>
                </div>            
            @endforelse
            </div>
               


             <div class="div-pag">
                @if ($cursos->onFirstPage())
                    <span class="pag disabled"><<</span>
                @else
                    <a class="pag" href="{{ $cursos->previousPageUrl() }}"><<</a>
                @endif

                <p>Página {{ $cursos->currentPage() }} de {{ $cursos->lastPage() }}</p>

                @if ($cursos->hasMorePages())
                    <a class="pag" href="{{ $cursos->nextPageUrl() }}">>></a>
                @else
                    <span class="pag disabled">>></span>
                @endif
            </div>

        </main>
    </div>

    <!-- MODAL -->
    <div id="modalCurso" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>

        <h2 id="modalTitulo"></h2>

        <!-- ⭐ AVALIAÇÃO MÉDIA -->
        <div class="linha-modal">
            <!-- <p id="modalAvaliacaoMedia"></p>  -->
            <!-- <p id="modalPlataforma"></p> -->
        </div>

        <p id="modalDescricao"></p>
        <hr>

        <!-- ⭐ FEEDBACK DO USUÁRIO LOGADO -->
        <div class="modal-user-comentario">
            <h3>Deixe seu comentário</h3>

            <form id="formFeedback">
                <!-- Avaliação dada pelo usuário -->
                <div class="rating-user">
                    <label>Sua avaliação:</label>
                    <div id="estrelasUsuario">
                        <!-- aqui você coloca os inputs de estrela -->
                    </div>
                </div>

                <input type="hidden" id="cursoIdFeedback" name="curso_id">

                <textarea name="feedback" id="feedbackTexto"
                    placeholder="Digite aqui..."
                    required></textarea>

                <button type="submit">Enviar</button>
            </form>
        </div>

        <hr>

        <!-- ⭐ AVALIAÇÕES DOS OUTROS USUÁRIOS -->
        <div class="modal-comentarios">
            <h3>Avaliações</h3>

            <div id="listaFeedbacks">
                <!-- Os comentários serão inseridos aqui via JS -->
            </div>
        </div>

    </div>
</div>


</div>
@include('includes.footer')