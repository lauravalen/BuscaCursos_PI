@include('includes.header')

<main>
    <div class="div-perfil">
        <h1>Olá, {{ session('usuario')->USU_STR_NOME }}!</h1>

        <div class="div-menuPerfil">
            <div class="div-catePerfil ativo" data-section="favoritos">
                <h3>Favoritos</h3>
                <hr>
            </div>
            <div class="div-catePerfil" data-section="recentes">
                <h3>Recentes</h3>
                <hr>
            </div>
            <div class="div-catePerfil" data-section="configuracoes">
                <h3>Configurações</h3>
                <hr>
            </div>
        </div>
    </div>
    <div class="div-conteudo">
        <!-- FAVORITOS -->
        <div id="favoritos" class="conteudo ativo">
            @forelse($favoritos as $favorito)
            <div class="div-cursos-perfil">
                <div class="card_curso-perfil" data-categoria="dados">
                    <div class="image_curso">
                        <div class="rating-perfil">
                            <form action="{{ route('favoritos.toggle', $favorito->curso->CUR_INT_ID) }}" method="POST">
                                @csrf
                                <input
                                    type="checkbox"
                                    name="favorito"
                                    id="star{{ $favorito->curso->CUR_INT_ID }}"
                                    value="1"
                                    {{ $favorito->FAV_INT_ATIVO ? 'checked' : '' }}
                                    onchange="this.form.submit()">
                                <label for="star{{ $favorito->curso->CUR_INT_ID }}"></label>
                            </form>
                        </div>

                        @php
                        // pega o nome CERTINHO da categoria
                        $categoria = strtolower($curso->areaCategoria->categoria->CAT_STR_DESC);

                        // remove espaços e acentos se quiser
                        $categoria = \Illuminate\Support\Str::slug($categoria, '-');

                        // caminhos
                        $pathImagem = public_path("assets/images/{$categoria}.png");
                        $imgUrl = asset("assets/images/{$categoria}.png");

                        $defaultImg = asset("assets/images/img-curso-TI.png");
                        @endphp

                        <img
                            src="{{ file_exists($pathImagem) ? $imgUrl : $defaultImg }}"
                            alt="Imagem do curso {{ $curso->CUR_STR_TITULO }}">

                    </div>
                </div>

                <h3>{{ $favorito->curso->CUR_STR_TITULO }}</h3>
                <p class="descricao">{{ $favorito->curso->CUR_STR_DESC }}</p>

                <div class="info-curso">
                    <div class="botoes">
                        <a href="{{ $favorito->curso->CUR_STR_URL }}" target="_blank">Ir para curso</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <p style="text-align: center;">Nenhum curso favoritado ainda.</p>
        @endforelse


    </div>

    <!-- recentes -->
    <div id="recentes" class="conteudo">

        @forelse($recentes as $curso)
        <div class="div-cursos-perfil">
            <div class="card_curso-perfil">
                <div class="image_curso">

                    @php
                    // pega o nome CERTINHO da categoria
                    $categoria = strtolower($curso->areaCategoria->categoria->CAT_STR_DESC);

                    // remove espaços e acentos se quiser
                    $categoria = \Illuminate\Support\Str::slug($categoria, '-');

                    // caminhos
                    $pathImagem = public_path("assets/images/{$categoria}.png");
                    $imgUrl = asset("assets/images/{$categoria}.png");

                    $defaultImg = asset("assets/images/img-curso-TI.png");
                    @endphp

                    <img
                        src="{{ file_exists($pathImagem) ? $imgUrl : $defaultImg }}"
                        alt="Imagem do curso {{ $curso->CUR_STR_TITULO }}">

                </div>

                <h3>{{ $curso->CUR_STR_TITULO }}</h3>
                <p class="descricao">{{ $curso->CUR_STR_DESC }}</p>

                <div class="info-curso">
                    <div class="botoes">
                        <a href="{{ route('curso.acessar', $curso->CUR_INT_ID) }}" target="_blank">
                            Ir para curso
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <p style="text-align: center;">nenhum curso foi acessado.</p>
        @endforelse

    </div>

    </div>

    <!-- CONFIGURAÇOES -->
    <div class="div-config-perfil">
        <div id="configuracoes" class="conteudo">

            <div class="div-acao">
                <form action="/TesteVocacional" method="GET">
                    @csrf
                    <button type="submit" class="botao-deslog">TESTE VOCACIONAL</button>
                </form>
            </div>

            <div class="div-acao">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="botao-deslog">EDITAR PERFIL</button>
                </form>
            </div>

            <div class="div-acao">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="botao-deslog">ACESSIBILIDADE</button>
                </form>
            </div>
            <div class="div-acao">
                <form action="/faq" method="GET">
                    @csrf
                    <button type="submit" class="botao-deslog">DUVIDAS?</button>
                </form>
            </div>

            <div class="div-acao-deslog">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="botao-deslog">DESCONECTAR</button>
                </form>
            </div>

            <div class="div-acao-destiv">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="botao-deslog">DESATIVAR CONTA</button>
                </form>
            </div>

        </div>

    </div>

    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const botoes = document.querySelectorAll('.div-catePerfil');
        const conteudos = document.querySelectorAll('.conteudo');

        botoes.forEach(botao => {
            botao.addEventListener('click', () => {
                // Remove 'ativo' de todos os botões e conteúdos
                botoes.forEach(b => b.classList.remove('ativo'));
                conteudos.forEach(c => c.classList.remove('ativo'));

                // Ativa o botão e o conteúdo correspondente
                botao.classList.add('ativo');
                const sectionId = botao.getAttribute('data-section');
                document.getElementById(sectionId).classList.add('ativo');
            });
        });
    });
</script>

@include('includes.footer')