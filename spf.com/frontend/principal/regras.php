<?php 
// começo do php do head

    // link qe vai para a classe php com todos os links e conexões
    include_once 'backend/conexao/script/conexao.php';
    require_once 'autoload.php';


    require_once 'backend/objetos/class_IRepositorioArq_avaliativo.php';
    require_once 'backend/objetos/class_IRepositorioArq_regras.php';
    require_once 'backend/objetos/class_IRepositorioEquipes.php';
    require_once 'backend/objetos/class_IRepositorioFotos.php';
    require_once 'backend/objetos/class_IRepositorioGincanas.php';
    require_once 'backend/objetos/class_IRepositorioHistorico.php';
    require_once 'backend/objetos/class_IRepositorioLogs.php';
    require_once 'backend/objetos/class_IRepositorioNoticias.php';
    require_once 'backend/objetos/class_IRepositorioPpa.php';
    require_once 'backend/objetos/class_IRepositorioPpe.php';
    require_once 'backend/objetos/class_IRepositorioTemas.php';
    require_once 'backend/objetos/class_IRepositorioUsuarios.php';
    require_once 'backend/objetos/class_IRepositorioLogo.php';
    require_once 'backend/objetos/class_IRepositorioCarrosel.php';

    page_autoloader(['class_IRepositorioArq_regras', 'class_IRepositorioArq_avaliativo']);
    $repositorioArq_regras = new RepositorioArq_regrasMYSQL(); 
    $repositorioArq_avaliativo = new RepositorioArq_avaliativoMYSQL(); 
        
    // pesquisa de arquivos de regras de gincanas
    $dados_arqregras = $repositorioArq_regras->listarTodosArq_regras();

    // pesquisa de arquivos de regras de avaliação
    $dados_arqavaliativo = $repositorioArq_avaliativo->listarTodosArq_avaliativo();

    // Conferindo se há alguma sessão aberta, se não, abrimos a sessão e pegamos os dados
    if(!isset($_SESSION)){
        session_start();
    }

    // se haver email, tem gente logada, indo para um cabeçalho diferente
    $condicao = isset($_SESSION['email_usuario']);

/*   aqui fazemos a seguranaça do site, onde se uma sesão estiver iniciada, se o usuario não esta logado, não foi aceito ou não possui cargo, o mesmo é barrado e volta ao login! */
    if($condicao == false){


    }else{

        if($_SESSION['status_usuario']==0){
            die("Você ainda não foi aprovado, entre em contato com o adm e peça para ser aprovado.<p><a href=\"backend/login/loginspf.php\">Voltar para o login<a></p>");
        }
        if($_SESSION['funcao_usuario']<0 && $_SESSION['funcao_usuario']>1){
            die("Você não possui cargo para acessar esta parte do sistema, entre em contato com um administrador.<p><a href=\"backend/login/loginspf.php\">Voltar para o login<a></p>");
        }

    }

// fim do php do head
?>

<!-- começo do html -->
<!DOCTYPE html>
<!-- definindo a linguagem da página como portugues -->
<html lang="pt-br">
<head>
    <!-- começo do cabecalho do backend -->

    <!-- definições de responsividade -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- titulo da página home do website -->
    <title>Regras_spf</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />

    <?php
    // pesquisa da logo e colocação da mesma
    $dados_logo = $repositorioLogo->buscarLogo(1);
    while($registro_logo = $dados_logo->fetch_object()){
        ?>

    <!-- icone do website -->
    <link rel="icon" href="frontend/public/imagens/logo/<?php echo $registro_logo->arquivo_lg?>" alt="Logo">

    <?php
    }
        ?>


    <!-- definições de estilo geral -->
    <link rel="stylesheet" href="frontend/public/css/geral.css">
    <!-- definições de estilo especificas -->
    <link rel="stylesheet" href="frontend/public/css/regras.css">


    


    <!-- fim do cabecalho do backend -->
</head>

<!-- começo do body do html -->
<body>

<!-- CHAMADA para função de tradutor em libras -->
<div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
      <div class="vw-plugin-top-wrapper"></div>
    </div>
  </div>
<!-- diretorio usado pelo tradutor de libras durante a tradução -> podeser personalizado -->
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
  </script>

<!-- Começando um container para que seja possivel identificar onde começa a página -->
<div class="container-fluid">

<!-- Aqui esta o navbar de nosso site, onde as informações sempre serão iguais em todas as páginas -->
    <a href="./" id="topo"></a>


<!-- ------------------------------------------------------------------------------------- COMEÇO DO NAVBAR ---------------------------------------------------------------------------------------------- -->


    <header class="header">

        <a href="#" class="logo">Logo</a>

        <i class='bx bx-menu' id="menu-icon"></i>
    <!-- começo do li e php do mostrador do usuario-->
    <?php

    // caso não tenha sessão iniciada, mostra o login
    if($condicao == false){
        
    // caso tenha sessão iniciada parte para escrever os cargos do usuario
    }else{

        // captura as diversas variaveis do usuario
        $id_usuario =$_SESSION['id_usuario'];
        $nome_usuario=$_SESSION['nome_usuario'];
        $email_usuario=$_SESSION['email_usuario'];
        $funcao_usuario=$_SESSION['funcao_usuario'];
        $status_usuario=$_SESSION['status_usuario'];
        $foto_usuario=$_SESSION['foto_usuario'];
        $funcao_usuario=$_SESSION['funcao_usuario'];

        // verifica se ele esta dentro dos parametros e mostra seu nome e cargo de acordo com o correto
        if($funcao_usuario == 0){


            echo " <p> Nome: $nome_usuario </p>";
            echo " <p> Cargo:  Avaliador </p> ";
            echo "<a class=\"nav-link\" href=\"./logout\">Logout</a>";
            echo "<a class=\"nav-link\" href=\"./alt_perf\">Alterar perfil</a>";
    
        
            // verifica se ele esta dentro dos parametros e mostra seu nome e cargo de acordo com o correto
            }elseif($funcao_usuario == 1){
    
            echo " <p> Nome: $nome_usuario </p>";
            echo " <p> Cargo:  Administrador </p> ";
            echo "<a class=\"nav-link\" href=\"./logout\">Logout</a>";
            echo "<a class=\"nav-link\" href=\"./alt_perf\">Alterar perfil</a>";
    
            }
        }
    // fim do php
    ?>

    <!-- fim do li da parte de administração -->
    </li>

        <!-- link para a pagina da home -->
        <nav class="navbar">

<!-- link para a página do sobre -->

            <a href="./">Home</a>

            <a href="./sobre">Sobre</a>

            <!-- link para a página dos historicos -->

            <a href="./historicos">Históricos</a>

            <!-- link para a página das regras -->

            <!-- link para a página das gincanas -->

            <a href="./gincanas">Gincanas</a>

            <!-- link para a pagina das pontuações -->

            <a href="./pontuacoes">Pontuações</a>

            <!-- link para a página das noticias -->

            <a href="./noticias">Notícias</a>

            <!-- link para a pagina das fotos -->

            <a href="./fotos">Fotos</a>

<!-- link para administradores a depender do caso -->


    <!-- começo do php -->
    <?php

    // caso não tenha sessão iniciada, mostra o login
    if($condicao == false){
        echo "<a href=\"./login\">Login para Jurados</a>";
    // caso tenha sessão iniciada parte para checar a funcao
    }else{
        // captura a variavel do usuario
        $funcao_usuario=$_SESSION['funcao_usuario'];

        // verifica se ele esta dentro dos parametros e mostra o botao
        if($funcao_usuario == 0 || $funcao_usuario == 1){
    
        echo "<li class=\"nav-item\">";
        echo "<a class=\"nav-link\" href=\"./administrativo\">Administração</a>";
        echo "</li>";
    
        // se não estiver dentro dos parametros, desliga o site e pede pelo login
        }else{
        die("Você não possui cargo para acessar esta parte do sistema, entre em contato com um administrador.<p><a href=\"backend/login/loginspf.php\">Voltar para o login<a></p>");
        }
    }

    // fim do php
    ?>

    <!-- fim do li da parte de administração -->
    
            <img src="frontend/public/imagens/geral/lua.png" id="icon" alt="Dark Mode">

            </nav>
    </header>


<!-- ------------------------------------------------------------------------------------- COMEÇO DO MEIO ---------------------------------------------------------------------------------------------- -->

<!-- aqui temos o breadcumb do website para termos melhor controle do usuario -->
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="./">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Regras</li>
  </ol>
</nav>

<!-- aqui temos o titulo principal do wbsite -->
<h1>Regras</h1>

<!-- ------------------------------------------------------------------------------------- COMEÇO DAS TABELAS COM ARQUIVOS ---------------------------------------------------------------------------------------------- -->

<!-- aqui temos o titulo da primeira tabela -->
<h2>Tabela de arquivos de regras de gincanas</h2>

<!-- TABELA: Arquivos de regras de gincanas ************************************************************************************************************************* -->
<div class="row">

<!-- foi separada uma linha só para ele -->
<div class="col-sm-12">

        <!-- aqui iniciamos a tabela -->
        <table class="table table-hover border border-dark p-5">

        <!-- aqui criamos o cabeçalho da tabela -->

            <!-- iniciando uma linha para o cabcalho -->
            <tr>

            <th scope="col">Titulo</th>
            <th scope="col">Descrição</th>
            <th scope="col">Arquivo</th>

            </tr>
            <!-- fechando a linha do cabecalho -->

        <!-- final do cabecalho da tabela -->

        <!-- aqui appendamos os resultados dos gráficos -->

<?php
// inicio do php de pesquisa
while($registro_arqregras = $dados_arqregras->fetch_object()){
?>
            <!-- iniciando uma linha para colocar os resultados -->
            <tr>

            <!-- primeiro campo: Titulo  -->
            <td><?php echo $registro_arqregras->titulo_pdfregra;?></td>
            <!-- segundo campo: descricao -->
            <td><?php echo $registro_arqregras->desc_pdfregra;?></td>
            <!-- terceiro campo: arquivo -->
            <td><a href="frontend/public/pdf/pdf_regras/<?php echo $registro_arqregras->arquivo_pdfregra;?>" download="arquivo_regra_spf" >  

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0"/>
                </svg>
            </a></td>
          
            </tr>
            <!-- fechando a linha de colocar os resultados -->
<?php
// <!-- final do php de pesquisa -->
}
?>
            

        <!-- aqui finalizamos o appender -->

        </table>
        <!-- final da tabela criada pelo bootstrap -->
</div>
</div>
<!-- FINAL DO TABELA DE: Arquivos de regras de gincanas *********************************************************************************************************** --> 

<!-- titulo da segunda tabela -->
<h2>Tabela de arquivos de regras de avaliação</h2>

<!-- TABELA: Arquivos de regras de avaliação ************************************************************************************************************************* -->
<div class="row">

<!-- foi separada uma linha só para ele -->
<div class="col-sm-12">

        <!-- aqui iniciamos a tabela -->
        <table class="table table-hover border border-dark p-5">

        <!-- aqui criamos o cabeçalho da tabela -->

            <!-- iniciando uma linha para o cabcalho -->
            <tr>

            <th scope="col">Titulo</th>
            <th scope="col">Descrição</th>
            <th scope="col">Arquivo</th>

            </tr>
            <!-- fechando a linha do cabecalho -->

        <!-- final do cabecalho da tabela -->

        <!-- aqui appendamos os resultados dos gráficos -->

<?php
// inicio do php de pesquisa
while($registro_arqavaliativo = $dados_arqavaliativo->fetch_object()){
?>
            <!-- iniciando uma linha para colocar os resultados -->
            <tr>

            <!-- primeiro campo: Titulo  -->
            <td><?php echo $registro_arqavaliativo->titulo_pdfavaliativo;?></td>
            <!-- segundo campo: descricao -->
            <td><?php echo $registro_arqavaliativo->desc_pdfavaliativo;?></td>
            <!-- terceiro campo: arquivo -->
            <td><a href="frontend/public/pdf/pdf_regras/<?php echo $registro_arqavaliativo->arquivo_pdfavaliativo;?>" download="arquivo_avaliativo_spf" >  

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0"/>
                </svg>
            </a></td>
          
            </tr>
            <!-- fechando a linha de colocar os resultados -->
<?php
// <!-- final do php de pesquisa -->
}
?>
            
        <!-- aqui finalizamos o appender -->

        </table>
        <!-- final da tabela criada pelo bootstrap -->
</div>
</div>
<!-- FINAL DO TABELA DE: Arquivos de regras de avaliação *********************************************************************************************************** --> 


    
<!-- ------------------------------------------------------------------------------------- COMEÇO DO RODAPÉ ---------------------------------------------------------------------------------------------- -->

<footer class="footer">

        <div class="container">
            <div class="sec aboutus">
                <h3>Sobre Nós</h3>
                <p> 
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Nemo totam veniam id, sapiente esse quibusdam pariatur explicabo sit odit,
                    placeat temporibus voluptate cumque earum maiores facilis
                    asperiores eius itaque fugit.
                </p>
                <ul class="sm">
                    <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-threads"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                </ul>
            </div>
            <div class="autores">
                <h3>Autores</h3><ul>
                    <li><a href="#">Matheus Araujo da Silva</a></li>
                    <li><a href="#">Nycollas Ferrioto Dias</a></li>
                    <li><a href="#">Vinicius Kum</a></li>
                </ul>
            </div>
            <div class="contact">
                <h3>Contato</h3>
                <li><a href="./sendemail"">Entre em contato com a admistração</a></li>
            </div>
            <div class="footer-iconTop">
                <a href="#topo"><i class='bx bx-up-arrow-alt'></i></a>
            </div>
        </div>

    </footer>


    <!-- // link para o arquivo de javascript do (BOOTSTRAP) -->

    <script>

        var icon = document.getElementById("icon");
        var img =  document.getElementById("img-light-mode");
        icon.onclick = function(){
            document.body.classList.toggle("dark-theme");
            if(document.body.classList.contains("dark-theme")){
                icon.src = "frontend/public/imagens/geral/sol.png";
                img.src = "frontend/public/imagens/imagens_home/Paulo Freire 10.png";
            }else{
                icon.src = "frontend/public/imagens/geral/lua.png";
                img.src = "frontend/public/imagens/imagens_home/Paulo Freire 11.png";
            }
        }

    </script>

    <script src="frontend/public/js/script.js"></script>
    

    <!-- fim do body do html -->
</body>

    <!-- fim do html em si -->
</html>