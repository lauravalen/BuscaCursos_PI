@include('includes.headerAdm')

<main>
    <div class="div-perfil">
        <h1>Olá, {{ session('admin')->ADM_STR_NOME }}!</h1>

    </div>
    <div class="div-conteudo">
        
        <!-- CONFIGURAÇOES -->
        <div class="div-config-perfil">

                <div class="div-acao-deslog">
                    <form action="/logout" method="POST" >
                        @csrf
                        <button type="submit" class="botao-deslog">DESCONECTAR</button>
                    </form>
                </div>

                <div class="div-acao-destiv">
                    <form action="/logout" method="POST" >
                        @csrf
                        <button type="submit" class="botao-deslog">DESATIVAR CONTA</button>
                    </form>
                </div>


        </div>

    </div>
</main>



@include('includes.footer')
