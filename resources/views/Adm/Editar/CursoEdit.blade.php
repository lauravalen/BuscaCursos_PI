<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuscaCursos </title>
    <link rel="stylesheet" href="../../Css/styles.css">
    <link rel="stylesheet" href="../../Css/stylesAdm.css">

</head>

<body>
    <div class="div_container">

        <!--HEADER E NAVE -->
        <header>
            <div class="div-logo">
                <a href="/HomeAdm">
                    <img src="../../assets/images/logo_Busca.png" alt="Logo BuscaCursos">
                </a>
            </div>

            <nav>
                <ul>
                    <li><a href="/CursoAdm">
                            <h2>Cursos</h2>
                        </a></li>
                    <li><a href="/UserAdm">
                            <h2>Usuarios</h2>
                        </a></li>
                    <li><a href="/PlataformaAdm">
                            <h2>Plataformas</h2>
                        </a></li>
                </ul>

                <div class="div-login">
                    <a href="/perfil">
                        <img src="../../assets/images/icone-perfil.png" alt="Icone de Perfil">
                    </a>
                </div>

            </nav>

        </header>
        <main>
            <section class="login">

                <div class="div-tituloLogin">
                    <h1>Editar Curso</h1>
                </div>

                <div class="div-forms">
                    <form action="{{ route('curso.update', $curso->CUR_INT_ID) }}" method="POST" class="formulario-login">
                        @csrf
                        @method('PUT')

                        <div class="div-input">
                            <p class="labelCad">Título:</p>
                            <input type="text" name="CUR_STR_TITULO" maxlength="80" required class="entrada-login" value="{{ $curso->CUR_STR_TITULO }}">
                        </div>

                        <div class="div-input">
                            <p class="labelCad">URL:</p>
                            <input type="text" name="CUR_STR_URL" maxlength="200" required class="entrada-login" value="{{ $curso->CUR_STR_URL }}">
                        </div>

                        <div class="div-input">
                            <p class="labelCad">Certificação:</p>
                            <input type="text" name="CUR_STR_CERTIFICACAO" maxlength="150" class="entrada-login" value="{{ $curso->CUR_STR_CERTIFICACAO }}">
                        </div>

                        <div class="div-input">
                            <p class="labelCad">Quantidade de horas:</p>
                            <input type="number" name="CUR_FLO_QUANTHORA" step="0.1" class="entrada-login" value="{{ $curso->CUR_FLO_QUANTHORA }}">
                        </div>

                        <div class="div-input">
                            <p class="labelCad">Descrição:</p>
                            <textarea name="CUR_STR_DESC" maxlength="350" required class="entrada-login">{{ $curso->CUR_STR_DESC }}</textarea>
                        </div>

                        <div class="div-input">
                            <p class="labelCad">Data de Início:</p>
                            <input type="date" name="CUR_STR_DATAINICIO" class="entrada-login" value="{{ $curso->CUR_STR_DATAINICIO }}">
                        </div>

                        <div class="div-input">
                            <p class="labelCad">Nível de Ensino:</p>
                            <input type="text" name="CUR_STR_NIVELENSINO" maxlength="50" class="entrada-login" value="{{ $curso->CUR_STR_NIVELENSINO }}">
                        </div>

                        <div class="div-input">
                            <p class="labelCad">Data de Inserção:</p>
                            <input type="date" name="CUR_STR_INSERCAO" class="entrada-login" value="{{ $curso->CUR_STR_INSERCAO }}">
                        </div>

                        <button type="submit" class="botao-login">Editar</button>

                    </form>
                </div>
            </section>
        </main>


        <!-- FOOTER -->
        <footer>
            <div class="footer-container">

                <div class="footer-logo">
                    <a href="">
                        <img src="assets/images/logo_Busca.png" alt="Logo BuscaCursos">
                    </a>
                    <p class="footer-endereco">
                        Av. Aguia de Haia, 2.983 - Cidade A. E. Carvalho<br>
                        São Paulo/SP - CEP: 03694-000
                    </p>
                </div>

                <div class="footer-redes">
                    <h2>REDES SOCIAIS</h2>
                    <div class="footer-redes-icons">

                        <a href="../https://www.youtube.com/c/FatecZLeste" target="_blank">
                            <img src="assets/images/contatos_youtube.png" alt="YouTube">
                        </a>

                        <a href="../https://www.facebook.com/fateczl.oficial" target="_blank">
                            <img src="assets/images/contatos_facebook.png" alt="Facebook">
                        </a>

                        <a href="../https://www.instagram.com/fateczl.oficial/#" target="_blank">
                            <img src="assets/images/contatos_insta.png" alt="Instagram">
                        </a>

                        <a href="../https://www.linkedin.com/school/fateczl-oficial/posts/?feedView=all" target="_blank">
                            <img src="assets/images/contatos_linkedin.png" alt="LinkedIn">
                        </a>

                        <a href="../https://www.tiktok.com/@fateczl.oficial" target="_blank">
                            <img src="assets/images/contatos_tiktok.png" alt="TikTok">
                        </a>

                    </div>
                </div>
            </div>

            <ul>
                <li><a target="_blank" href="../Pages/TermosUso.html">Termos de Uso</a></li>
                <li><a target="_blank" href="../Pages/PolPrivacidade.html">Política de Privacidade</a></li>
            </ul>

        </footer>
    </div>

    <!-- SCRIPTS -->
    <script src="{{ asset('Js/script.js') }}"></script>
    <script src="{{ asset('Js/testeVocac.js') }}"></script>


</body>

</html>