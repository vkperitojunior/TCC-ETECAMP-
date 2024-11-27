<?php
// começo do php do head

   // link qe vai para a classe php com todos os links e conexões
//    include_once '/backend/Link_RepPes.php';
include_once 'backend/conexao/script/conexao.php';
    require_once 'autoload.php';
    $pages = [
        'class_IRepositorioArq_avaliativo',
        'class_IRepositorioArq_regras',
        'class_IRepositorioEquipes',
        'class_IRepositorioFotos',
        'class_IRepositorioGincanas',
        'class_IRepositorioHistorico',
        'class_IRepositorioLogs',
        'class_IRepositorioNoticias',
        'class_IRepositorioPpa',
        'class_IRepositorioPpe',
        'class_IRepositorioTemas',
        'class_IRepositorioUsuarios'
    ];



    page_autoloader(['class_IRepositorioFotos']);
    $repositorioFotos = new RepositorioFotoMYSQL(); 


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


    // // Chame a função autoload para incluir as páginas




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
    <title>Fotos_spf</title>

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
    <link rel="stylesheet" href="frontend/public/css/fotos.css">





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

            <a href="./regras">Regras</a>

            <!-- link para a página das gincanas -->

            <a href="./gincanas">Gincanas</a>

            <!-- link para a pagina das pontuações -->

            <a href="./pontuacoes">Pontuações</a>

            <!-- link para a página das noticias -->

            <a href="./noticias">Notícias</a>


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
    <li class="breadcrumb-item active" aria-current="page">Fotos</li>
  </ol>
</nav>

<?php

// <!-- Começo dos botões de tornar a página um pdf -->
    echo "<div class=\"d-grid gap-2 custom-btn-container\">";
    echo "  <button class=\"btn btn-primary custom-btn\" type=\"button\"> <a href=\"./pdf/2\"; > Gerar PDF</a> </button>";
    echo "</div>";
// <!-- fim dos botões -->
?>

<!-- aqui temos o titulo principal do wbsite -->
<h1>Fotos</h1>

<br>

<!-- começo do formulário de pesquisa geral -->
<form class="mx-auto" action="./fotos" method="POST">

<!-- campo de data -->
<!-- <div class="mb-3">
    <label for="exampleInputAno" class="form-label">Ano de pesquisa: </label>
    <input type="search" class="search-input" id="exampleInputData" name="ano_foto" aria-describedby="dataHelp" placeholder="Procure o ano da imagem">
</div> -->

        <div class="search">
            <span class="material-symbols-outlined">search</span>
            <input type="search-input" type="submit" type="search" id="examplaInputData" name="ano_foto" aria-describedby="dataHelp" placeholder="Procure o ano da foto">
        </div>

<!-- botão para enviar informações do formulário -->

    <button id="teste" type="submit" name="pesquisar" class="btn btn-primary">
    <!-- colocando um icone de pesquisa junto do botão -->



</button>

<!-- botão para enviar informações do formulário -->
<button type="submit" name="pesquisarGeral" class="btn btn-primary">
<!-- colocando um icone de pesquisa junto do botão -->
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
</svg>
Pesquisar Geral
</button> 

<!-- fim do formulário -->
</form>

<!-- espaço entre o formulário de pesquisa e as tabelas de dados -->
<br>



<!-- ------------------------------------------------------------------------------------- COMEÇO DAS FOTOS ---------------------------------------------------------------------------------------------- -->

<!-- definindo uma linha que só suporta duas colunas por vez -->


<?php

if(!isset($_POST['pesquisar']) || isset($_POST['pesquisarGeral'])){

    // pesquisa de arquivos de fotos
    $dados_de_fotos = $repositorioFotos->listarTodasFotos();

    ?>

    <!-- abrindo a coluna -->

    <div class="container">
        <h2 class="title">
            Galeria
        </h2>

        <section>

        

        <!-- // abrindo a div inicial de collum -->
        <!-- <div class="column"> -->

    <?php
    // inicio do php de pesquisa geral
    while($registro_fotos = $dados_de_fotos->fetch_object()){

        ?>
                        <!-- // Exibir a imagem -->

                       
            <div>
                <img src="frontend/public/imagens/imagens_fotos/<?php echo $registro_fotos->arquivo_foto ?>" alt="Imagem">
                <!-- <a href="frontend/public/imagens/imagens_fotos/<?php echo $registro_fotos->arquivo_foto ?>" download="<?php echo $registro_fotos->titulo_foto ?>_<?php echo $registro_fotos->ano_foto ?>" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-download-fill" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 0a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 4.095 0 5.555 0 7.318 0 9.366 1.708 11 3.781 11H7.5V5.5a.5.5 0 0 1 1 0V11h4.188C14.502 11 16 9.57 16 7.773c0-1.636-1.242-2.969-2.834-3.194C12.923 1.999 10.69 0 8 0m-.354 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V11h-1v3.293l-2.146-2.147a.5.5 0 0 0-.708.708z"/></svg></a> -->
            </div>

        

        <?php

        
    }
    ?>
        
        <!-- //fechando a primeira div de wrapper -->
            
        </section>

    <?php
    // <!-- final do php de pesquisa -->


}else{
       // pesquisa de arquivos de fotos
   $dados_de_fotos = $repositorioFotos->listarTodasAno($_POST['ano_foto']);


   ?>

   <!-- abrindo a coluna -->


       <h2 class="title">
           Galeria
       </h2>

       <section>

      

   <?php
   // inicio do php de pesquisa geral
   while($registro_fotos = $dados_de_fotos->fetch_object()){

    ?>
                <!-- // Exibir a imagem -->

                
                <div class="image-container">
                    <img src="frontend/public/imagens/imagens_fotos/<?php echo $registro_fotos->arquivo_foto ?>" alt="Foto" class="imagem-noticia">

                    <!-- <a href="frontend/public/imagens/imagens_fotos/<?php echo $registro_fotos->arquivo_foto ?>" download="<?php echo $registro_fotos->titulo_foto ?>_<?php echo $registro_fotos->ano_foto ?>" class="download-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-cloud-download-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 0a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 4.095 0 5.555 0 7.318 0 9.366 1.708 11 3.781 11H7.5V5.5a.5.5 0 0 1 1 0V11h4.188C14.502 11 16 9.57 16 7.773c0-1.636-1.242-2.969-2.834-3.194C12.923 1.999 10.69 0 8 0m-.354 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V11h-1v3.293l-2.146-2.147a.5.5 0 0 0-.708.708z"/>
                        </svg>
                    </a> -->
                </div>
            

                <?php

   }
   ?>

</section>
       
       <!-- //fechando a primeira div de wrapper -->
           
       
   
   <?php
   // <!-- final do php de pesquisa -->
}

?>




<br>
<br>

<!-- fechando a linha que só suporta duas colunas por vez -->

    
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