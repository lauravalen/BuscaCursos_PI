@include('includes.header')


<main>
    <section class="login">
        <div class="div-tituloLogin">
            <h1>Entrar na sua conta</h1>
        </div>

        <div id="feedback-login" class="mensagem-oculta"></div>

        <form action="/loginUser" method="POST" class="formulario-login">
            @csrf

            <label>Email:</label><br>
            <input type="email" name="email" class="entrada-login"><br>

<<<<<<< HEAD
            <div class="div-linkcad">
                 <a href="/Cadastro" class="link-cad"><p>Não possui cadastro? Clique aqui.</p></a>
            </div>
=======
            <label>Senha:</label><br>
            <input type="password" name="senha" class="entrada-login"><br>
            @if(session('erro'))
            <div class="erro-login">{{ session('erro') }}</div>
            @endif
>>>>>>> e994fbfc23d74fa7a09a7db2f4c6c0395901a37e

            <button type="submit" class="botao-login">Entrar</button>
        </form>

        <div class="div-linkcad">
            <a href="/Cadastro" class="link-cad">
                <p>Não possue cadastro?Clique aqui.</p>
            </a>
        </div>

    </section>
</main>

@include('includes.footer')