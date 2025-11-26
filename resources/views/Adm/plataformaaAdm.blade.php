@include('includes.headerAdm')


<main>

<div class="div-dados-numeros">
    <div class="div-numeros">
        <h3>Quantidade de Plataformas</h3>
        <p>34</p>
    </div>
    <div class="div-numeros">
        <h3>Quantidade de Platafromas desativados</h3>
        <p>5</p>

    </div>
    <!-- <div class="div-numeros">
        <h3>Quantidade de cursos favoritados</h3>
        <p>30</p>
    </div> -->
</div>

<div class="div-lista">
    <div class="div-pesquisa-Curso">
        <form action="" method="">
            <input type="search" name="" id="" placeholder="Pesquisar Plataforma...">
        </form>
        <div class="bts-acoes">
            <a href="" class="btt-ac">Filtrar</a>
            <a href="/CadPlataforma" class="btt-ac" >Adicionar</a>
            <a href="" class="btt-ac">Relatório</a>
        </div>
    </div>
    <div class="div-tabela">
        <div class="row-tabela">
            <h2>Nome da Plataforma</h2>
            <h2>Ações</h2>
        </div>        
        
        @foreach($plats as $platf)

        <div class="row-tabela">
            <h3>{{ $platf->PLA_STR_NOME }}</h3>
            <div class="bts-acoes-table">
                <a href="">Vizualizar</a>
                <a href="">Editar</a>
            </div>
        </div>
        
        @endforeach

    </div>
</div>

</main>




@include('includes.footer')
