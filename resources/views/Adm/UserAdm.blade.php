@include('includes.headerAdm')

<main>

<div class="div-dados-numeros">
    <div class="div-numeros">
        <h3>Quantidade Total de Usuarios</h3>
        <p>12</p>
    </div>
    <div class="div-numeros">
        <h3>Quantidade de Usuarios desativados</h3>
        <p>4</p>

    </div>
</div>

<div class="div-lista">
    <div class="div-pesquisa-Curso">
        <form action="" method="">
            <input type="search" name="" id="" placeholder="Pesquisar Plataforma...">
        </form>
        <div class="bts-acoes">
            <a href="/CadAdm" class="btt-ac" >+ ADM</a>
            <a href="/CadUser" class="btt-ac" >+ User</a>
        </div>
    </div>
    <div class="div-tabela">
        <div class="row-tabela">
            <h2>Nome dos Usuarios</h2>
            <h2>Email dos Usuarios</h2>
            <h2>Ações</h2>
        </div>
        @foreach($users as $user)

        <div class="row-tabela" style="background-color: {{ $user->USU_INT_SITUACAO == 0 ? '#fa9aa2ce' : '#b1b0b0' }};">
            <h3>{{ $user->USU_STR_NOME }}</h3>
            <h3>{{$user->USU_STR_EMAIL}}</h3>

            <div class="bts-acoes-table" >
                @if($user->USU_INT_SITUACAO == 1)
                <a href="{{ route('user.desativarUser', $user->USU_INT_ID) }}" style="color: red;">Desativar</a> 
                @else
                    <span style="color: black;">Usuario desativado</span>
                @endif
            </div>
        </div>
        @endforeach

        <div class="div-pag">
                @if ($users->onFirstPage())
                    <span class="pag disabled"><<</span>
                @else
                    <a class="pag" href="{{ $users->previousPageUrl() }}"><<</a>
                @endif

                <p>Página {{ $users->currentPage() }} de {{ $users->lastPage() }}</p>

                @if ($users->hasMorePages())
                    <a class="pag" href="{{ $users->nextPageUrl() }}">>></a>
                @else
                    <span class="pag disabled">>></span>
                @endif
            </div>
        </div>
    </div>
</div>


</main>

@include('includes.footer')
