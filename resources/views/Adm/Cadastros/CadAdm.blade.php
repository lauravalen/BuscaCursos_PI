@include('includes.headerAdm')

<main>
    <section class="login">

        <div class="div-tituloLogin">
            <h1>Cadastrar Administrador</h1>
        </div>

        <div class="div-forms">
            <form action="{{ route('cadastroAdm.store') }}" method="POST" class="formulario-login">
                @csrf

                <div class="div-input">
                    <p class="labelCad">Nome:</p>
                    <input type="text" name="ADM_STR_NOME" maxlength="80" required class="entrada-login">
                </div>

                 <div class="div-input">
                    <p class="labelCad">Email:</p>
                    <input type="email" name="ADM_STR_EMAIL" maxlength="80" required class="entrada-login">
                </div>

                <div class="div-input">
                    <p class="labelCad">CPF:</p>
                    <input type="text" name="ADM_STR_CPF" maxlength="11" required class="entrada-login">
                </div>

                <div class="div-input">
                    <p class="labelCad">Senha:</p>
                    <input type="password" name="ADM_STR_SENHA" maxlength="20" required class="entrada-login">
                </div>

               <div class="div-input">
                    <p class="labelCad">Confirmar Senha: </p>
                    <input type="password" name="senha_confirmacao" required maxlength="80" class="entrada-login">
                </div>

                <input type="hidden" name="ADM_STR_DATAINSERCAO" value="{{ now() }}">

                <button type="submit" class="botao-login">Cadastrar</button>
            </form>
        </div>
    </section>
</main>

@include('includes.footer')
