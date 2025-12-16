<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BuscaCursos </title>
    <link rel="stylesheet" href="../Css/styles.css"> 

</head>

<body>
    <div class="div_container">
       
        <!--HEADER E NAVE -->
        <header>
            <div class="div-logo">
                <a href="/">
                    <img src="../assets/images/logo_Busca.png" alt="Logo BuscaCursos">
                </a>
            </div>

            <nav>
                <ul>
                    <li><a href="/quem-somos" target="_blank">
                            <h2>QUEM SOMOS</h2>
                        </a></li>
                    <li><a href="/faq" target="_blank">
                            <h2>F.A.Q</h2>
                        </a></li>
                    <li><a href="/ApoieProjeto" target="_blank">
                            <h2>APOIE O PROJETO</h2>
                        </a></li>
                </ul>
                @if(Session::has('usuario'))

                <div class="div-login">
                        <a href="/perfil">
                            <img src="../assets/images/icone-perfil.png" alt="Icone de Perfil">
                        </a>
                </div>  
                @else

                <div class="div-login">
                    <a href="/Login">
                        <h3>LOG IN</h3>
                    </a>
                </div>               
                 @endif

            </nav>
            
        </header>