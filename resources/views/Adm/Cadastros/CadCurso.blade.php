@include('includes.headerAdm')

<main>
    <section class="login">

        <div class="div-tituloLogin">
            <h1>Cadastrar Curso</h1>
        </div>

        <div class="div-forms">
            <form action="{{ route('curso.store') }}" method="POST" class="formulario-login">
                @csrf
                
                <div class="div-input">
                    <p class="labelCad">Título:</p>
                    <input type="text" name="CUR_STR_TITULO" maxlength="80" required class="entrada-login">
                </div>

                <div class="div-input">
                    <p class="labelCad">URL do Curso:</p>
                    <input type="url" name="CUR_STR_URL" maxlength="255" required class="entrada-login">
                </div>

                <div class="div-input">
                    <p class="labelCad">Categoria:</p>
                    <select name="ACA_INT_ID" class="entrada-login" required>
                        <option value="">Selecione</option>
                        @foreach ($areasCategorias as $area)
                            <option value="{{ $area->ACA_INT_ID }}">
                                {{ $area->categoria->CAT_STR_DESC }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="div-input">
                    <p class="labelCad">Certificação:</p>
                    <div class="div-radios">
                        <label>
                            <input type="radio" name="CUR_STR_CERTIFICACAO" value="Sim" required>
                            Sim
                        </label>
                        <br>
                        <label>
                            <input type="radio" name="CUR_STR_CERTIFICACAO" value="Não">
                            Não
                        </label>
                    </div>
                </div>


                <div class="div-input">
                    <p class="labelCad">Carga Horária:</p>
                    <input type="number" name="CUR_FLO_QUANTHORA" min="1" step="0.5" required class="entrada-login">
                </div>

                <div class="div-input">
                    <p class="labelCad">Descrição:</p>
                    <textarea name="CUR_STR_DESC" maxlength="350" required class="entrada-login"></textarea>
                </div>

                <div class="div-input">
                    <p class="labelCad">Data de Início:</p>
                    <input type="datetime-local" name="CUR_STR_DATAINICIO" required class="entrada-login">
                </div>

                <div class="div-input">
                    <p class="labelCad">Nível de Ensino:</p>
                    <select name="CUR_STR_NIVELENSINO" class="entrada-login" required>
                        <option value="iniciante">Iniciante</option>
                        <option value="intermediário">Intermediário</option>
                        <option value="avançado">Avançado</option>
                    </select>
                </div>

                <button type="submit" class="botao-login">Cadastrar</button>
            </form>
        </div>
    </section>
</main>

@include('includes.footer')
