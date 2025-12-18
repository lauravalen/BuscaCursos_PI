@include('includes.headerAdm')

<main>

    <div class="div-dados-numeros">
        <div class="div-numeros">
            <h3>Quantidade de cursos</h3>
            <p>{{ $totalCursos }}</p>
        </div>
        <div class="div-numeros">
            <h3>Quantidade de cursos desativados</h3>
            <p>{{ $cursosDesativados }}</p>
        </div>
    </div>


    <div class="div-lista">
        <div class="div-pesquisa-Curso">
            <form action="" method="">
                <input type="search" name="" id="" placeholder="Pesquisar Curso...">
            </form>
            <div class="bts-acoes">
                <a href="/CadCurso" class="btt-ac">Criar</a>
            </div>
        </div>
        <div class="div-tabela">
            <div class="row-tabela">
                <h2>Nome do Curso</h2>
                <h2>Ações</h2>
            </div>
            @forelse ($cursos as $curso)

            <div class="row-tabela" style="background-color: {{ $curso->CUR_INT_SITUACAO == 0 ? '#fa9aa2ce' : 'transparent' }};">
                <h3>{{ $curso->CUR_STR_TITULO}}</h3>
                <div class="bts-acoes-table">
                    @if($curso->CUR_INT_SITUACAO == 1)
                    <a href="{{ route('curso.edit', $curso->CUR_INT_ID) }}">Editar</a>
                    <a href="{{ route('curso.desativar', $curso->CUR_INT_ID) }}" style="color: red;">Desativar</a>
                    <a href="#" style="color: blue;" data-bs-toggle="modal" data-bs-target="#modalCurso{{ $curso->CUR_INT_ID }}">
                        Visualizar
                    </a>
                    @else
                    <span style="color: black;">Curso desativado</span>
                    @endif
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modalCurso{{ $curso->CUR_INT_ID }}" tabindex="-1" aria-labelledby="modalLabel{{ $curso->CUR_INT_ID }}" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel{{ $curso->CUR_INT_ID }}">{{ $curso->CUR_STR_TITULO }}</h5>
                        </div>
                        <div class="modal-body">
                            <p><strong>URL:</strong> <a href="{{ $curso->CUR_STR_URL }}" target="_blank" style="color: white;">{{ $curso->CUR_STR_URL }}</a></p>
                            <p><strong>Certificação:</strong> {{ $curso->CUR_STR_CERTIFICACAO }}</p>
                            <p><strong>Quantidade de Horas:</strong> {{ $curso->CUR_FLO_QUANTHORA }}</p>
                            <p><strong>Descrição:</strong> {{ $curso->CUR_STR_DESC }}</p>
                            <p><strong>Data de Início:</strong> {{ $curso->CUR_STR_DATAINICIO }}</p>
                            <p><strong>Nível de Ensino:</strong> {{ $curso->CUR_STR_NIVELENSINO }}</p>
                            <p><strong>Data de Inserção:</strong> {{ $curso->CUR_STR_INSERCAO }}</p>
                            <p><strong>Situação:</strong> {{ $curso->CUR_INT_SITUACAO == 1 ? 'Ativo' : 'Desativado' }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: transparent;border: none;color:red;">Fechar</button>
                        </div>
                    </div>
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



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@include('includes.footer')