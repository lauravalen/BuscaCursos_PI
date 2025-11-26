@include('includes.headerAdm')

<main>

    <section class="login">

        <div class="div-tituloLogin">
            <h1>Crie uma conta</h1>
        </div>

        <div class="div-forms">
            <form action="{{ url('/cadastro/salvar') }}" method="POST" class="formulario-login">
                @csrf

                <div class="div-input">
                    <p class="labelCad">Nome: </p>
                    <input type="text" name="USU_STR_NOME" required maxlength="80" class="entrada-login">
                </div>

                <div class="div-input">
                    <p class="labelCad">Email: </p>
                    <input type="email" name="USU_STR_EMAIL" required maxlength="80" class="entrada-login">
                </div>

                <div class="div-input">
                    <p class="labelCad">Estado: </p>
                    <select name="EST_INT_ID" class="entrada-login" required>
                        <option value="">Selecione</option>
                        @foreach($estados as $estado)
                            <option value="{{ $estado->EST_INT_ID }}">{{ $estado->EST_STR_UF }} - {{ $estado->EST_STR_NOME }}</option>
                         @endforeach
                    </select>
                </div>

                <div class="div-input">
                    <p class="labelCad">Cidade: </p>
                    <select name="CID_INT_ID" class="entrada-login" required>
                        <option value="">Selecione</option>
                        @foreach($cidades as $cidade)
                            <option value="{{ $cidade->CID_INT_ID }}">{{ $cidade->CID_STR_NOME }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="div-input">
                    <p class="labelCad">Gênero: </p>
                    <select name="GEN_INT_ID" class="entrada-login" required>
                        <option value="">Selecione</option>
                        @foreach($generos as $genero)
                            <option value="{{ $genero->GEN_INT_ID }}">{{ $genero->GEN_STR_DESC }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="div-input">
                    <p class="labelCad">Área de Atuação: </p>
                    <select name="AAT_INT_ID" class="entrada-login" required>
                        <option value="">Selecione</option>
                        @foreach($areas as $area)
                            <option value="{{ $area->AAT_INT_ID }}">{{ $area->AAT_STR_DESC }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="div-input">
                    <p class="labelCad">Senha: </p>
                    <input type="password" name="USU_STR_SENHA" required maxlength="80" class="entrada-login">
                </div>

                <div class="div-input">
                    <p class="labelCad">Confirmar Senha: </p>
                    <input type="password" name="senha_confirmacao" required maxlength="80" class="entrada-login">
                </div>

                <button type="submit" class="botao-login">Cadastrar</button>
            </form>
        </div>
    </section>
</main>

@include('includes.footer')
