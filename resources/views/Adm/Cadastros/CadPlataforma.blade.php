@include('includes.headerAdm')

<main>
    <section class="login">

        <div class="div-tituloLogin">
            <h1>Cadastrar Plataforma</h1>
        </div>

        <div class="div-forms">
            <form action="{{ route('plataforma.store') }}" method="POST" class="formulario-login">
                @csrf

                <div class="div-input">
                    <p class="labelCad">Administrador Responsável:</p>
                    <select name="ADM_INT_ID" class="entrada-login" required>
                        <option value="">Selecione</option>
                        @foreach ($administradores as $adm)
                            <option value="{{ $adm->ADM_INT_ID }}">{{ $adm->ADM_STR_NOME }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="div-input">
                    <p class="labelCad">Nome da Plataforma:</p>
                    <input type="text" name="PLA_STR_NOME" maxlength="80" required class="entrada-login">
                </div>

                <div class="div-input">
                    <p class="labelCad">URL:</p>
                    <input type="url" name="PLA_STR_URL" maxlength="255" required class="entrada-login">
                </div>

                <div class="div-input">
                    <p class="labelCad">Descrição:</p>
                    <textarea name="PLA_STR_DESC" maxlength="350" required class="entrada-login"></textarea>
                </div>

                <div class="div-input">
                    <p class="labelCad">Quantidade de Cursos:</p>
                    <input type="number" name="PLA_INT_QUANTCURSO" min="0" required class="entrada-login">
                </div>

                <button type="submit" class="botao-login">Cadastrar</button>
            </form>
        </div>
    </section>
</main>

@include('includes.footer')
