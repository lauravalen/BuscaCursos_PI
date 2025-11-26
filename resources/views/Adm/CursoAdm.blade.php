@include('includes.headerAdm')

<main>

<div class="div-dados-numeros">
    <div class="div-numeros">
        <h3>Quantidade de cursos</h3>
        <p>22</p>
    </div>
    <div class="div-numeros">
        <h3>Quantidade de cursos desativados</h3>
        <p>34</p>

    </div>
    <div class="div-numeros">
        <h3>Quantidade de cursos favoritados</h3>
        <p>26</p>
    </div>
</div>

<div class="div-lista">
    <div class="div-pesquisa-Curso">
        <form action="" method="">
            <input type="search" name="" id="" placeholder="Pesquisar Curso...">
        </form>
        <div class="bts-acoes">
            <a href="" class="btt-ac">Filtro</a>
            <a href="/CadCurso" class="btt-ac" >Criar</a>
            <a href="" class="btt-ac">Relatorio</a>
        </div>
    </div>
    <div class="div-tabela">
        <div class="row-tabela">
            <h2>Nome do Curso</h2>
            <h2>Ações</h2>
        </div>
        @forelse ($cursos as $curso)

         <div class="row-tabela">
            <h3>{{ $curso->CUR_STR_TITULO}}</h3>
            <div class="bts-acoes-table">
                <a href="{{ route('curso.edit', $curso->CUR_INT_ID) }}">Editar</a>
            </div>
        </div>
        @empty
        <div class="row-tabela">
            <h3>Nenhum curso encontrado.</h3>
        </div>
    @endforelse
    </div>
</div>


</main>




@include('includes.footer')
