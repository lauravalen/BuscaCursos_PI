@include('includes.headerAdm')

<main>
    <div class="div-perfil">
        <h1>Olá, {{ session('admin')->ADM_STR_NOME }}!</h1>

    </div>
    <div class="div-conteudo">

         <div class="div-menuPerfil">
            <div class="div-catePerfil Adm ativo" data-section="cadastrar">
                <h3>Cadastrar Curso</h3>
                <hr>
            </div>
            <div class="div-catePerfil Plataforma Adm" data-section="administrar-plataforma">
                <h3>Administrar Plataforma</h3>
                <hr>
            </div>
            <div class="div-catePerfil Cursos Adm" data-section="administrar-cursos">
                <h3>Administrar Cursos</h3>
                <hr>
            </div>
            <div class="div-catePerfil Usuarios Adm" data-section="administrar-usuarios">
                <h3>Administrar Usuários</h3>
                <hr>
            </div>
            <div class="div-catePerfil" data-section="configuracoes">
                <h3>Configurações</h3>
                <hr>
            </div>
        </div>
    </div>
    <div class="div-conteudo">

        <!--CADASTRAR CURSO -->
        <div id="administrar-plataforma" class="conteudo">
            <h2>Administrar Plataforma</h2>
            <form action="/CadCurso" method="POST">
                @csrf
                <button type="submit" class="botao-deslog">Administrar Plataforma</button>
            </form>
        </div>

        <!-- ADMINISTRAR PLATAFORMA -->
         <div id="administrar-plataforma" class="conteudo">
            <h2>Administrar Plataforma</h2>
            <form action="/PlataformaAdm" method="GET">
                @csrf
                <button type="submit" class="botao-deslog">Administrar Plataforma</button>
            </form>
        </div>

        <!-- ADMINISTRAR CURSOS -->
        <div id="administrar-cursos" class="conteudo">
            <h2>Administrar Cursos</h2>
            <form action="{{route(name: 'curso.indexadm') }}" method="GET">
                @csrf
                <button type="submit" class="botao-deslog">Administrar Cursoso</button>
            </form>
        </div>

        <!-- ADMINISTRAR USUÁRIOS -->
        <div id="administrar-usuarios" class="conteudo"> 
            <h2>Administrar Usuários</h2>
            <form action="/UserAdm" method="GET">
                @csrf
                <button type="submit" class="botao-deslog">Administrar Usuários</button>
            </form>
        </div>


        </div>
        <!-- CONFIGURAÇOES -->
        <div class="div-config-perfil">
            <div id="configuracoes" class="conteudo">
                <div class="div-acao">
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="botao-deslog">EDITAR PERFIL</button>
                    </form>
                </div>

                <div class="div-acao">
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="botao-deslog">ACESSIBILIDADE</button>
                    </form>
                </div>
                
                <div class="div-acao">
                    <form action="/faq" method="GET" >
                        @csrf
                        <button type="submit" class="botao-deslog">DUVIDAS?</button>
                    </form>
                </div>

        
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
