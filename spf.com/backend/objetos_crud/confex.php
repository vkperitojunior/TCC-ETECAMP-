<?php 
// começo do php do head

// link qe vai para o protetor
include_once 'backend/conexao/script/protect.php';

include_once 'autoload.php';

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


$id_pesquisa = isset($id) ? $id : null;

// echo $id_pesquisa;

$id_filtro = isset($id2) ? $id2 : null;

// echo $id_filtro;

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
<html lang="pt=br">
<head>
    <!-- começo do cabecalho do backend -->

    <!-- definições de responsividade -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- titulo da página -->
    <title>confirmar_excluir</title>

    <?php
    // pesquisa da logo e colocação da mesma
    $dados_logo = $repositorioLogo->buscarLogo(1);
    while($registro_logo = $dados_logo->fetch_object()){
    if(!isset($id_filtro)){
    ?>
    <!-- icone do website -->
    <link rel="icon" href="../../../frontend/public/imagens/logo/<?php echo $registro_logo->arquivo_lg ?>" alt="Logo">
    <?php
    }
    }   
    ?>


  


    <!-- Arquivos de css do bootstrap -->
    <link href="../../frontend/public/bootstrap/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- fim dos arquivos de bootstrap -->


    <!-- fim do cabecalho do backend -->
</head>

<!-- começo do body do html -->
<body style="background-color: lightgray;">

<!-- Começando um container para que seja possivel identificar onde começa a página -->
<div class="container-fluid bg-dark-50">

<!-- Aqui esta o navbar de nosso site, onde as informações sempre serão iguais em todas as páginas -->
<ul class="nav border border-rounded border-dark center bg-dark text-white rounded mt-2">


<!-- ------------------------------------------------------------------------------------- COMEÇO DO NAVBAR ---------------------------------------------------------------------------------------------- -->

<li class="nav-item p-2 mt-4" id="topo">

<?php
    // pesquisa da logo e colocação da mesma
    $dados_logo = $repositorioLogo->buscarLogo(1);
    while($registro_logo = $dados_logo->fetch_object()){
        ?>


    <!-- icone do website -->
    <a class="navbar-brand " href="#">
      <img src="../../frontend/public/imagens/logo/<?php echo $registro_logo->arquivo_lg?>" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
    </a>

    <?php
    }
        ?>



</li>

<li class="nav-item p-2 mt-2" id="topo">
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
        echo " <p style=\"color: green;\"> Avaliador </p> ";

    
        // verifica se ele esta dentro dos parametros e mostra seu nome e cargo de acordo com o correto
        }elseif($funcao_usuario == 1){

        echo " <p> Nome: $nome_usuario </p>";
        echo " <p style=\"color: red;\"> Administrador </p> ";

        }

 
    }

    // fim do php
    ?>

    <br>

    <!-- fim do li da parte de administração -->
    </li>

    <li class="nav-item p-2" id="topo">
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


        echo "<a class=\"nav-link text-white\" href=\"../logout\">Logout</a>";
        echo "<a class=\"nav-link text-white\" href=\"../alt_perf\">Alterar perfil</a>";

    
        // verifica se ele esta dentro dos parametros e mostra seu nome e cargo de acordo com o correto
        }elseif($funcao_usuario == 1){

        echo "<a class=\"nav-link text-white\" href=\"../logout\">Logout</a>";
        echo "<a class=\"nav-link text-white\" href=\"../alt_perf\">Alterar perfil</a>";

        }

    }
 

    // fim do php
    ?>

    <br>

    <!-- fim do li da parte de administração -->
    </li>

<br>
        <!-- link para a pagina da home -->
        <li class="nav-item  mt-4">
    <a class="nav-link text-white" href="../">Home</a>
    </li>
<!-- link para a página do sobre -->
    <li class="nav-item  mt-4">
        <a class="nav-link text-white " href="../sobre">Sobre</a>
    </li>
<!-- link para a página dos historicos -->
    <li class="nav-item  mt-4">
        <a class="nav-link text-white " href="../historicos">Históricos</a>
    </li>
<!-- link para a página das regras -->
<li class="nav-item  mt-4">
        <a class="nav-link text-white " href="../regras">Regras</a>
    </li>
<!-- link para a página das gincanas -->
    <li class="nav-item  mt-4">
        <a class="nav-link text-white " href="../gincanas">Gincanas</a>
    </li>
<!-- link para a pagina das pontuações -->
    <li class="nav-item  mt-4">
        <a class="nav-link text-white " href="../pontuacoes">Pontuaçoes</a>
    </li>
<!-- link para a página das noticias -->
    <li class="nav-item  mt-4">
        <a class="nav-link text-white " href="../noticias">Noticias</a>
    </li>
<!-- link para a pagina das fotos -->
    <li class="nav-item  mt-4">
        <a class="nav-link text-white " href="../fotos">Fotos</a>
    </li>
<!-- link para administradores a depender do caso -->


<li class="nav-item">
    <!-- começo do php -->
    <?php

    // caso não tenha sessão iniciada, mostra o login
    if($condicao == false){
        echo "<li class=\"nav-item\">";
        echo "<a class=\"nav-link text-white\" href=\"../login\">Login para administradores</a>";
        echo "</li>";
    // caso tenha sessão iniciada parte para checar a funcao
    }else{
        // captura a variavel do usuario
        $funcao_usuario=$_SESSION['funcao_usuario'];

        // verifica se ele esta dentro dos parametros e mostra o botao
        if($funcao_usuario == 0 || $funcao_usuario == 1){

    
        echo "<li class=\"nav-item\">";
        echo "<a class=\"nav-link active text-white   mt-4\" href=\"../administrativo\">Administração</a>";
        echo "</li>";

    
        // se não estiver dentro dos parametros, desliga o site e pede pelo login
        }else{
        die("Você não possui cargo para acessar esta parte do sistema, entre em contato com um administrador.<p><a href=\"../login\">Voltar para o login<a></p>");
        }
    }

    // fim do php
    ?>

    <!-- fim do li da parte de administração -->
    </li>

    <!-- fim da lista de navbar -->
    </ul>

    <br>




<!-- ------------------------------------------------------------------------------------- COMEÇO DO MEIO ---------------------------------------------------------------------------------------------- -->

    <?php
    // começo das variaveis de pesquisa

    if($id_pesquisa == 1){

// Começando colocando as colunas para alinhar o quadro ao meio
echo "<div class=\"container text-center mb-2 mb-2\">";
echo "<div class=\"row align-items-center\">";
echo "<div class=\"col\">";
// coluna vazia
echo "</div>";
echo "<div class=\"col\">";

// aqui fica o espaço onde preencheremos o card com informações da pesquisa

// pesquisa da pontuação por dia
$dados_Ppe = $repositorioPpe->buscarPpe($id_filtro);

// Abrindo o meio de coleta dos dados
while($registro_Ppe = $dados_Ppe->fetch_object()){
    
        // <!-- abrindo a coluna -->
        echo "<div class=\"col\">";
            
        
        // <!-- CARD: Ppe ************************************************************************************************************************* -->
        echo "<div class=\"card\" style=\"width: 18rem;\">";
        echo "<div class=\"card-body\">";
        echo "<h5 class=\"card-title\"> Pesquisa por dados de pontuação por equipe </h5>";
        echo "</div>";
        echo "<ul class=\"list-group list-group-flush\">";
        echo "    <li class=\"list-group-item\">Id: $registro_Ppe->id_pont</li>";
        echo "    <li class=\"list-group-item\">Id da equipe: $registro_Ppe->equipe_id</li>";
        echo "    <li class=\"list-group-item\">Pontuação: $registro_Ppe->soma_pont</li>";
        echo "    <li class=\"list-group-item\">Ranking: $registro_Ppe->ranking</li>";
        echo "    <li class=\"list-group-item\">Observações: $registro_Ppe->obs_pont</li>";
        echo "    <li class=\"list-group-item\">Status: $registro_Ppe->status_pontpe</li>";
        
        echo "    <li class=\"list-group-item\"><a class=\"card-link\" href=\"../../tabelas/1\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">
        <path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z\"/>
        </svg> Voltar </li>";

        echo "    <li class=\"list-group-item\"> <a class=\"card-link\" href=\"../../exclusoes/1/$id_filtro\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-right\" viewBox=\"0 0 16 16\">
        <path fill-rule=\"evenodd\" d=\"M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z\"/>
        </svg> Excluir </a></li>";

        echo "</ul>";
        echo "</div>";
        // <!-- FINAL DO CARD DE: Ppe *********************************************************************************************************** --> 
    
    
        echo "</div>";
        // <!-- fechando a coluna -->

    }


echo "</div>";
echo "<div class=\"col\">";
// coluna vazia
echo "</div>";
echo "</div>";
echo "</div>";

    }elseif($id_pesquisa == 2){

        // Começando colocando as colunas para alinhar o quadro ao meio
echo "<div class=\"container text-center mb-2 mb-2\">";
echo "<div class=\"row align-items-center\">";
echo "<div class=\"col\">";
// coluna vazia
echo "</div>";
echo "<div class=\"col\">";

// aqui fica o espaço onde preencheremos o card com informações da pesquisa

// pesquisa da pontuação por gincana
$dados_Ppa = $repositorioPpa->buscarPpa($id_filtro);

// Abrindo o meio de coleta dos dados
while($registro_Ppa = $dados_Ppa->fetch_object()){
    
        // <!-- abrindo a coluna -->
        echo "<div class=\"col\">";
            
        
        // <!-- CARD: Ppa ************************************************************************************************************************* -->
        echo "<div class=\"card\" style=\"width: 18rem;\">";
        echo "<div class=\"card-body\">";
        echo "<h5 class=\"card-title\"> Pesquisa por dados de pontuação por equipe </h5>";
        echo "</div>";
        echo "<ul class=\"list-group list-group-flush\">";
        echo "    <li class=\"list-group-item\">Id: $registro_Ppa->id_pontpa</li>";
        echo "    <li class=\"list-group-item\">Id da equipe: $registro_Ppa->equipe_id</li>";
        echo "    <li class=\"list-group-item\">Id da gincana: $registro_Ppa->gincana_id</li>";
        echo "    <li class=\"list-group-item\">Dia: $registro_Ppa->dia_pontpa</li>";
        echo "    <li class=\"list-group-item\">Pontuação: $registro_Ppa->pont_da_gin</li>";
        echo "    <li class=\"list-group-item\">Observações: $registro_Ppa->obs_pontpa</li>";
        echo "    <li class=\"list-group-item\">Status: $registro_Ppa->status_pontpa</li>";
        
        echo "    <li class=\"list-group-item\"><a class=\"card-link\" href=\"../../tabelas/2\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">
        <path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z\"/>
        </svg> Voltar </li>";

        echo "    <li class=\"list-group-item\"> <a class=\"card-link\" href=\"../../exclusoes/2/$id_filtro\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-right\" viewBox=\"0 0 16 16\">
        <path fill-rule=\"evenodd\" d=\"M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z\"/>
        </svg> Excluir </a></li>";

        echo "</ul>";
        echo "</div>";
        // <!-- FINAL DO CARD DE: Ppa *********************************************************************************************************** --> 
    
    
        echo "</div>";
        // <!-- fechando a coluna -->

    }


echo "</div>";
echo "<div class=\"col\">";
// coluna vazia
echo "</div>";
echo "</div>";
echo "</div>";

    }elseif($id_pesquisa == 3){

                // Começando colocando as colunas para alinhar o quadro ao meio
echo "<div class=\"container text-center mb-2\">";
echo "<div class=\"row align-items-center\">";
echo "<div class=\"col\">";
// coluna vazia
echo "</div>";
echo "<div class=\"col\">";

// aqui fica o espaço onde preencheremos o card com informações da pesquisa

// pesquisa da equipe
$dados_equipe = $repositorioEquipes->buscarEquipe($id_filtro);

// Abrindo o meio de coleta dos dados
while($registro_equipes = $dados_equipe->fetch_object()){
    
        // <!-- abrindo a coluna -->
        echo "<div class=\"col\">";
            
        
        // <!-- CARD: EQUIPES ************************************************************************************************************************* -->
        echo "<div class=\"card\" style=\"width: 18rem;\">";
        echo "<div class=\"card-body\">";
        echo "<h5 class=\"card-title\"> Pesquisa por equipe </h5>";
        echo "</div>";
        echo "<ul class=\"list-group list-group-flush\">";
        echo "    <li class=\"list-group-item\">Id: $registro_equipes->id_eq</li>";
        echo "    <li class=\"list-group-item\">Nome: $registro_equipes->nome_eq</li>";
        echo "    <li class=\"list-group-item\">Sala: $registro_equipes->sala_eq</li>";
        echo "    <li class=\"list-group-item\">Ano: $registro_equipes->ano_eq</li>";
        echo "    <li class=\"list-group-item\">Tema: $registro_equipes->tema_eq</li>";
        echo "    <li class=\"list-group-item\">Cor: $registro_equipes->cor_eq</li>";
        echo "    <li class=\"list-group-item\">Extra: $registro_equipes->extra_eq</li>";
        echo "    <li class=\"list-group-item\">Status: $registro_equipes->status_eq</li>";
        
        echo "    <li class=\"list-group-item\"><a class=\"card-link\" href=\"../../tabelas/3\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">
        <path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z\"/>
        </svg> Voltar </li>";

        echo "    <li class=\"list-group-item\"> <a class=\"card-link\" href=\"../../exclusoes/3/$id_filtro\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-right\" viewBox=\"0 0 16 16\">
        <path fill-rule=\"evenodd\" d=\"M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z\"/>
        </svg> Excluir </a></li>";

        echo "</ul>";
        echo "</div>";
        // <!-- FINAL DO CARD DE: EQUIPES *********************************************************************************************************** --> 
    
    
        echo "</div>";
        // <!-- fechando a coluna -->

    }


echo "</div>";
echo "<div class=\"col\">";
// coluna vazia
echo "</div>";
echo "</div>";
echo "</div>";

    }elseif($id_pesquisa == 4){

        
                // Começando colocando as colunas para alinhar o quadro ao meio
echo "<div class=\"container text-center mb-2\">";
echo "<div class=\"row align-items-center\">";
echo "<div class=\"col\">";
// coluna vazia
echo "</div>";
echo "<div class=\"col\">";

// aqui fica o espaço onde preencheremos o card com informações da pesquisa

// pesquisa das noticias
$dados_noticias = $repositorioNoticias->buscarNoticia($id_filtro);

// Abrindo o meio de coleta dos dados
while($registro_noticias = $dados_noticias->fetch_object()){
    
        // <!-- abrindo a coluna -->
        echo "<div class=\"col\">";
            
        
        // <!-- CARD: NOTICIAS ************************************************************************************************************************* -->
        echo "<div class=\"card\" style=\"width: 18rem;\">";
        echo "<div class=\"card-body\">";
        echo "<h5 class=\"card-title\"> Pesquisa por noticia </h5>";
        echo "</div>";
        echo "<ul class=\"list-group list-group-flush\">";
        echo "    <li class=\"list-group-item\"> Id: $registro_noticias->id_not</li>";
        echo "    <li class=\"list-group-item\"> Titulo: $registro_noticias->titulo_not</li>";
        echo "    <li class=\"list-group-item\"> Descricao: $registro_noticias->descricao_not</li>";
        echo "    <li class=\"list-group-item\"> Data: $registro_noticias->data_not</li>";
        echo "    <li class=\"list-group-item\"> Foto: $registro_noticias->foto_not</li>";
        echo "    <li class=\"list-group-item\"> Status: $registro_noticias->status_not</li>";
        
        echo "    <li class=\"list-group-item\"><a class=\"card-link\" href=\"../../tabelas/4\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">
        <path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z\"/>
        </svg> Voltar </li>";

        echo "    <li class=\"list-group-item\"> <a class=\"card-link\" href=\"../../exclusoes/4/$id_filtro\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-right\" viewBox=\"0 0 16 16\">
        <path fill-rule=\"evenodd\" d=\"M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z\"/>
        </svg> Excluir </a></li>";

        echo "</ul>";
        echo "</div>";
        // <!-- FINAL DO CARD DE: NOTICIAS *********************************************************************************************************** --> 
    
    
        echo "</div>";
        // <!-- fechando a coluna -->

    }


echo "</div>";
echo "<div class=\"col\">";
// coluna vazia
echo "</div>";
echo "</div>";
echo "</div>";

    }elseif($id_pesquisa == 5){

                        // Começando colocando as colunas para alinhar o quadro ao meio
echo "<div class=\"container text-center mb-2\">";
echo "<div class=\"row align-items-center\">";
echo "<div class=\"col\">";
// coluna vazia
echo "</div>";
echo "<div class=\"col\">";

// aqui fica o espaço onde preencheremos o card com informações da pesquisa

// pesquisa das fotos
$dados_fotos = $repositorioFotos->buscarFoto($id_filtro);

// Abrindo o meio de coleta dos dados
while($registro_fotos = $dados_fotos->fetch_object()){
    
        // <!-- abrindo a coluna -->
        echo "<div class=\"col\">";
            
        
        // <!-- CARD: FOTOS ************************************************************************************************************************* -->
        echo "<div class=\"card\" style=\"width: 18rem;\">";
        echo "<div class=\"card-body\">";
        echo "<h5 class=\"card-title\"> Pesquisa por foto </h5>";
        echo "</div>";
        echo "<ul class=\"list-group list-group-flush\">";
        echo "    <li class=\"list-group-item\">Id: $registro_fotos->id_foto</li>";
        echo "    <li class=\"list-group-item\">Titulo: $registro_fotos->titulo_foto</li>";
        echo "    <li class=\"list-group-item\">Descricao: $registro_fotos->descricao_foto</li>";
        echo "    <li class=\"list-group-item\">Ano: $registro_fotos->ano_foto</li>";
        echo "    <li class=\"list-group-item\">Arquivo: $registro_fotos->arquivo_foto</li>";
        echo "    <li class=\"list-group-item\">Status: $registro_fotos->status_foto</li>";
        
        echo "    <li class=\"list-group-item\"><a class=\"card-link\" href=\"../../tabelas/5\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">
        <path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z\"/>
        </svg> Voltar </li>";

        echo "    <li class=\"list-group-item\"> <a class=\"card-link\" href=\"../../exclusoes/5/$id_filtro\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-right\" viewBox=\"0 0 16 16\">
        <path fill-rule=\"evenodd\" d=\"M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z\"/>
        </svg> Excluir </a></li>";

        echo "</ul>";
        echo "</div>";
        // <!-- FINAL DO CARD DE: FOTOS *********************************************************************************************************** --> 
    
    
        echo "</div>";
        // <!-- fechando a coluna -->

    }


echo "</div>";
echo "<div class=\"col\">";
// coluna vazia
echo "</div>";
echo "</div>";
echo "</div>";

    }elseif($id_pesquisa == 6){

// Começando colocando as colunas para alinhar o quadro ao meio
echo "<div class=\"container text-center mb-2\">";
echo "<div class=\"row align-items-center\">";
echo "<div class=\"col\">";
// coluna vazia
echo "</div>";
echo "<div class=\"col\">";

// aqui fica o espaço onde preencheremos o card com informações da pesquisa

// pesquisa das gincanas
$dados_gincanas = $repositorioGincanas->buscarGincana($id_filtro);

// Abrindo o meio de coleta dos dados
while($registros_gincanas = $dados_gincanas->fetch_object()){
    
        // <!-- abrindo a coluna -->
        echo "<div class=\"col\">";
            
        
        // <!-- CARD: GINCANAS ************************************************************************************************************************* -->
        echo "<div class=\"card\" style=\"width: 18rem;\">";
        echo "<div class=\"card-body\">";
        echo "<h5 class=\"card-title\"> Pesquisa por gincana </h5>";
        echo "</div>";
        echo "<ul class=\"list-group list-group-flush\">";
        echo "    <li class=\"list-group-item\">Id: $registros_gincanas->id_gin</li>";
        echo "    <li class=\"list-group-item\">Nome da gincana: $registros_gincanas->nome_gin</li>";
        echo "    <li class=\"list-group-item\">Regras: $registros_gincanas->regras_gin</li>";
        echo "    <li class=\"list-group-item\">Exemplo: $registros_gincanas->exemplo_gin</li>";
        echo "    <li class=\"list-group-item\">Foto: $registros_gincanas->foto_gin</li>";
        echo "    <li class=\"list-group-item\">Horário: $registros_gincanas->horario_gin</li>";
        echo "    <li class=\"list-group-item\">Local: $registros_gincanas->local_gin</li>";
        echo "    <li class=\"list-group-item\">Status: $registros_gincanas->status_gin</li>";
        
        echo "    <li class=\"list-group-item\"><a class=\"card-link\" href=\"../../tabelas/6\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">
        <path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z\"/>
        </svg> Voltar </li>";

        echo "    <li class=\"list-group-item\"> <a class=\"card-link\" href=\"../../exclusoes/6/$id_filtro\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-right\" viewBox=\"0 0 16 16\">
        <path fill-rule=\"evenodd\" d=\"M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z\"/>
        </svg> Excluir </a></li>";

        echo "</ul>";
        echo "</div>";
        // <!-- FINAL DO CARD DE: GINCANAS *********************************************************************************************************** --> 
    
    
        echo "</div>";
        // <!-- fechando a coluna -->

    }


echo "</div>";
echo "<div class=\"col\">";
// coluna vazia
echo "</div>";
echo "</div>";
echo "</div>";

    }elseif($id_pesquisa == 7){

// Começando colocando as colunas para alinhar o quadro ao meio
echo "<div class=\"container text-center mb-2\">";
echo "<div class=\"row align-items-center\">";
echo "<div class=\"col\">";
// coluna vazia
echo "</div>";
echo "<div class=\"col\">";

// aqui fica o espaço onde preencheremos o card com informações da pesquisa

// pesquisa das arquivo de regra
$dados_arqregras = $repositorioArq_regras->buscarArq_regras($id_filtro);

// Abrindo o meio de coleta dos dados
while($registro_arqregras = $dados_arqregras->fetch_object()){
    
        // <!-- abrindo a coluna -->
        echo "<div class=\"col\">";
            
        
        // <!-- CARD: ARQREGRAS ************************************************************************************************************************* -->
        echo "<div class=\"card\" style=\"width: 18rem;\">";
        echo "<div class=\"card-body\">";
        echo "<h5 class=\"card-title\"> Pesquisa por arquivo de regra </h5>";
        echo "</div>";
        echo "<ul class=\"list-group list-group-flush\">";
        echo "    <li class=\"list-group-item\">Id: $registro_arqregras->id_pefregra</li>";
        echo "    <li class=\"list-group-item\">Id da gincana: $registro_arqregras->gincana_id</li>";
        echo "    <li class=\"list-group-item\">Titulo: $registro_arqregras->titulo_pefregra</li>";
        echo "    <li class=\"list-group-item\">Descricao: $registro_arqregras->desc_pefregra</li>";
        echo "    <li class=\"list-group-item\">Arquivo: $registro_arqregras->arquivo_pefregra</li>";
        echo "    <li class=\"list-group-item\">Status: $registro_arqregras->status_pefregra</li>";
        
        echo "    <li class=\"list-group-item\"><a class=\"card-link\" href=\"../../tabelas/7\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">
        <path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z\"/>
        </svg> Voltar </li>";

        echo "    <li class=\"list-group-item\"> <a class=\"card-link\" href=\"../../exclusoes/7/$id_filtro\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-right\" viewBox=\"0 0 16 16\">
        <path fill-rule=\"evenodd\" d=\"M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z\"/>
        </svg> Excluir </a></li>";

        echo "</ul>";
        echo "</div>";
        // <!-- FINAL DO CARD DE: ARQREGRAS *********************************************************************************************************** --> 
    
    
        echo "</div>";
        // <!-- fechando a coluna -->

    }


echo "</div>";
echo "<div class=\"col\">";
// coluna vazia
echo "</div>";
echo "</div>";
echo "</div>";


    }elseif($id_pesquisa == 8){

// Começando colocando as colunas para alinhar o quadro ao meio
echo "<div class=\"container text-center mb-2\">";
echo "<div class=\"row align-items-center\">";
echo "<div class=\"col\">";
// coluna vazia
echo "</div>";
echo "<div class=\"col\">";

// aqui fica o espaço onde preencheremos o card com informações da pesquisa

// pesquisa das arquivo de avaliativo
$dados_arqavaliativo = $repositorioArq_avaliativo->buscarArq_avaliativo($id_filtro);

// Abrindo o meio de coleta dos dados
while($registro_arqavaliativo = $dados_arqavaliativo->fetch_object()){
    
        // <!-- abrindo a coluna -->
        echo "<div class=\"col\">";
            
        
        // <!-- CARD: ARQAVALIATIVO ************************************************************************************************************************* -->
        echo "<div class=\"card\" style=\"width: 18rem;\">";
        echo "<div class=\"card-body\">";
        echo "<h5 class=\"card-title\"> Pesquisa por arquivo de avaliacao </h5>";
        echo "</div>";
        echo "<ul class=\"list-group list-group-flush\">";
        echo "    <li class=\"list-group-item\"> Id: $registro_arqavaliativo->id_pefavaliativo</li>";
        echo "    <li class=\"list-group-item\"> Id da gincana: $registro_arqavaliativo->gincana_id</li>";
        echo "    <li class=\"list-group-item\"> Titulo: $registro_arqavaliativo->titulo_pefavaliativo</li>";
        echo "    <li class=\"list-group-item\"> Descricao: $registro_arqavaliativo->desc_pefavaliativo</li>";
        echo "    <li class=\"list-group-item\"> Arquivo: $registro_arqavaliativo->arquivo_pefavaliativo</li>";
        echo "    <li class=\"list-group-item\"> Status: $registro_arqavaliativo->status_pefavaliativo</li>";
        
        echo "    <li class=\"list-group-item\"><a class=\"card-link\" href=\"../../tabelas/8\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">
        <path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z\"/>
        </svg> Voltar </li>";

        echo "    <li class=\"list-group-item\"> <a class=\"card-link\" href=\"../../exclusoes/8/;\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-right\" viewBox=\"0 0 16 16\">
        <path fill-rule=\"evenodd\" d=\"M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z\"/>
        </svg> Excluir </a></li>";

        echo "</ul>";
        echo "</div>";
        // <!-- FINAL DO CARD DE: ARQAVALIATIVO *********************************************************************************************************** --> 
    
    
        echo "</div>";
        // <!-- fechando a coluna -->

    }


echo "</div>";
echo "<div class=\"col\">";
// coluna vazia
echo "</div>";
echo "</div>";
echo "</div>";

    }elseif($id_pesquisa == 9){

// Começando colocando as colunas para alinhar o quadro ao meio
echo "<div class=\"container text-center mb-2\">";
echo "<div class=\"row align-items-center\">";
echo "<div class=\"col\">";
// coluna vazia
echo "</div>";
echo "<div class=\"col\">";

// aqui fica o espaço onde preencheremos o card com informações da pesquisa

// pesquisa das arquivo de historico
$dados_historico = $repositorioHistoricos->buscarHistorico($id_filtro);

// Abrindo o meio de coleta dos dados
while($registro_historico = $dados_historico->fetch_object()){
    
        // <!-- abrindo a coluna -->
        echo "<div class=\"col\">";
            
        
        // <!-- CARD: HISTORICO ************************************************************************************************************************* -->
        echo "<div class=\"card\" style=\"width: 18rem;\">";
        echo "<div class=\"card-body\">";
        echo "<h5 class=\"card-title\"> Pesquisa por historico </h5>";
        echo "</div>";
        echo "<ul class=\"list-group list-group-flush\">";
        echo "    <li class=\"list-group-item\"> $registro_historico->id_hist</li>";
        echo "    <li class=\"list-group-item\"> $registro_historico->ano_hist</li>";
        echo "    <li class=\"list-group-item\"> $registro_historico->tema_hist</li>";
        echo "    <li class=\"list-group-item\"> $registro_historico->primeiro_lugar</li>";
        echo "    <li class=\"list-group-item\"> $registro_historico->segundo_lugar</li>";
        echo "    <li class=\"list-group-item\"> $registro_historico->terceiro_lugar</li>";
        echo "    <li class=\"list-group-item\"> $registro_historico->melhor_gincana</li>";
        echo "    <li class=\"list-group-item\"> $registro_historico->foto_hist</li>";
        echo "    <li class=\"list-group-item\"> $registro_historico->status_hist</li>";
        
        echo "    <li class=\"list-group-item\"><a class=\"card-link\" href=\"../../tabelas/9\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">
        <path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z\"/>
        </svg> Voltar </li>";

        echo "    <li class=\"list-group-item\"> <a class=\"card-link\" href=\"../../exclusoes/9/$id_filtro\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-right\" viewBox=\"0 0 16 16\">
        <path fill-rule=\"evenodd\" d=\"M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z\"/>
        </svg> Excluir </a></li>";

        echo "</ul>";
        echo "</div>";
        // <!-- FINAL DO CARD DE: HISTORICO *********************************************************************************************************** --> 
    
    
        echo "</div>";
        // <!-- fechando a coluna -->

    }


echo "</div>";
echo "<div class=\"col\">";
// coluna vazia
echo "</div>";
echo "</div>";
echo "</div>";

    }elseif($id_pesquisa == 10){

        // Começando colocando as colunas para alinhar o quadro ao meio
echo "<div class=\"container text-center mb-2\">";
echo "<div class=\"row align-items-center\">";
echo "<div class=\"col\">";
// coluna vazia
echo "</div>";
echo "<div class=\"col\">";

// aqui fica o espaço onde preencheremos o card com informações da pesquisa

// pesquisa do tema
$dados_tema = $repositorioTemas->buscarTema($id_filtro);

// Abrindo o meio de coleta dos dados
while($registro_temas = $dados_tema->fetch_object()){
    
        // <!-- abrindo a coluna -->
        echo "<div class=\"col\">";
            
        
        // <!-- CARD: TEMA ************************************************************************************************************************* -->
        echo "<div class=\"card\" style=\"width: 18rem;\">";
        echo "<div class=\"card-body\">";
        echo "<h5 class=\"card-title\"> Pesquisa por tema </h5>";
        echo "</div>";
        echo "<ul class=\"list-group list-group-flush\">";
        echo "    <li class=\"list-group-item\"> $registro_temas->id_tema</li>";
        echo "    <li class=\"list-group-item\"> $registro_temas->tema_tm</li>";
        echo "    <li class=\"list-group-item\"> $registro_temas->motivacao_tm</li>";
        echo "    <li class=\"list-group-item\"> $registro_temas->primeiro_ano</li>";
        echo "    <li class=\"list-group-item\"> $registro_temas->status_tm</li>";
        
        echo "    <li class=\"list-group-item\"><a class=\"card-link\" href=\"../../tabelas/10\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">
        <path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z\"/>
        </svg> Voltar </li>";

        echo "    <li class=\"list-group-item\"> <a class=\"card-link\" href=\"../../exclusoes/10/$id_filtro\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-right\" viewBox=\"0 0 16 16\">
        <path fill-rule=\"evenodd\" d=\"M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z\"/>
        </svg> Excluir </a></li>";

        echo "</ul>";
        echo "</div>";
        // <!-- FINAL DO CARD DE: TEMA *********************************************************************************************************** --> 
    
    
        echo "</div>";
        // <!-- fechando a coluna -->

    }


echo "</div>";
echo "<div class=\"col\">";
// coluna vazia
echo "</div>";
echo "</div>";
echo "</div>";

    }elseif($id_pesquisa == 11){

        // Começando colocando as colunas para alinhar o quadro ao meio
        echo "<div class=\"container text-center mb-2\">";
        echo "<div class=\"row align-items-center\">";
        echo "<div class=\"col\">";
        // coluna vazia
        echo "</div>";
        echo "<div class=\"col\">";
        
        // aqui fica o espaço onde preencheremos o card com informações da pesquisa
        
        // pesquisa do usuario
        $dados_usuario = $repositorioUsuarios->buscarUsuario($id_filtro);
        
        // Abrindo o meio de coleta dos dados
        while($registro_usuario = $dados_usuario->fetch_object()){
            
                // <!-- abrindo a coluna -->
                echo "<div class=\"col\">";
                    
                
                // <!-- CARD: USUARIO ************************************************************************************************************************* -->
                echo "<div class=\"card\" style=\"width: 18rem;\">";
                echo "<div class=\"card-body\">";
                echo "<h5 class=\"card-title\"> Pesquisa por usuario </h5>";
                echo "</div>";
                echo "<ul class=\"list-group list-group-flush\">";
                echo "    <li class=\"list-group-item\"> $registro_usuario->id_us</li>";
                echo "    <li class=\"list-group-item\"> $registro_usuario->nome_us</li>";
                echo "    <li class=\"list-group-item\"> $registro_usuario->email_us</li>";
                echo "    <li class=\"list-group-item\"> $registro_usuario->senha_us</li>";
                echo "    <li class=\"list-group-item\"> $registro_usuario->foto_us</li>";
                echo "    <li class=\"list-group-item\"> $registro_usuario->funcao_us</li>";
                echo "    <li class=\"list-group-item\"> $registro_usuario->funcao_no_evento</li>";
                echo "    <li class=\"list-group-item\"> $registro_usuario->status_us</li>";

                echo "    <li class=\"list-group-item\"><a class=\"card-link\" href=\"../../tabelas/11\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">
                <path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z\"/>
                </svg> Voltar </li>";

                echo "    <li class=\"list-group-item\"> <a class=\"card-link\" href=\"../../exclusoes/11/$id_filtro\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-right\" viewBox=\"0 0 16 16\">
                <path fill-rule=\"evenodd\" d=\"M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z\"/>
                </svg> Excluir </a></li>";

                echo "</ul>";
                echo "</div>";
                // <!-- FINAL DO CARD DE: USUARIO *********************************************************************************************************** --> 
            
            
                echo "</div>";
                // <!-- fechando a coluna -->
        
            }
        
        
        echo "</div>";
        echo "<div class=\"col\">";
        // coluna vazia
        echo "</div>";
        echo "</div>";
        echo "</div>";

    }elseif($id_pesquisa == 12){

        // Começando colocando as colunas para alinhar o quadro ao meio
        echo "<div class=\"container text-center mb-2\">";
        echo "<div class=\"row align-items-center\">";
        echo "<div class=\"col\">";
        // coluna vazia
        echo "</div>";
        echo "<div class=\"col\">";
        
        // aqui fica o espaço onde preencheremos o card com informações da pesquisa
        
        // pesquisa do usuario
        $dados_carrosel = $repositorioCarrosel->buscarCarrosel($id_filtro);
        
        // Abrindo o meio de coleta dos dados
        while($registro_carrosel = $dados_carrosel->fetch_object()){
            
                // <!-- abrindo a coluna -->
                echo "<div class=\"col\">";
                    
                
                // <!-- CARD: USUARIO ************************************************************************************************************************* -->
                echo "<div class=\"card\" style=\"width: 18rem;\">";
                echo "<div class=\"card-body\">";
                echo "<h5 class=\"card-title\"> Pesquisa por imagem do carrosel </h5>";
                echo "</div>";
                echo "<ul class=\"list-group list-group-flush\">";
                echo "    <li class=\"list-group-item\"> $registro_carrosel->id_cs</li>";
                echo "    <li class=\"list-group-item\"> $registro_carrosel->titulo_cs</li>";
                echo "    <li class=\"list-group-item\"> $registro_carrosel->ordem_cs</li>";
                echo "    <li class=\"list-group-item\"> $registro_carrosel->arquivo_cs</li>";
                echo "    <li class=\"list-group-item\"> $registro_carrosel->data_cs</li>";
                echo "    <li class=\"list-group-item\"> $registro_carrosel->status_cs</li>";
                echo "    <li class=\"list-group-item\"> $registro_carrosel->ult_us_atz</li>";

                echo "    <li class=\"list-group-item\"><a class=\"card-link\" href=\"../../tabelas/13\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">
                <path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z\"/>
                </svg> Voltar </li>";

                echo "    <li class=\"list-group-item\"> <a class=\"card-link\" href=\"../../exclusoes/12/$id_filtro\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-right\" viewBox=\"0 0 16 16\">
                <path fill-rule=\"evenodd\" d=\"M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z\"/>
                </svg> Excluir </a></li>";

                echo "</ul>";
                echo "</div>";
                // <!-- FINAL DO CARD DE: USUARIO *********************************************************************************************************** --> 
            
            
                echo "</div>";
                // <!-- fechando a coluna -->
        
            }
        
        
        echo "</div>";
        echo "<div class=\"col\">";
        // coluna vazia
        echo "</div>";
        echo "</div>";
        echo "</div>";

    }

    // fim das variaveis de pesquisa
    ?>


<!-- ------------------------------------------------------------------------------------- COMEÇO DO RODAPÉ ---------------------------------------------------------------------------------------------- -->

<div class="card bg-dark text-white">
    <div class="card-header bg-dark text-white">
      <!-- Indicação de copyright -->
        Copyright @Sistema Paulo Freire - 2024
    </div>
    <div class="card-body">

    <!-- informações da escola dona -->
    <h5 class="card-title">ETEC de Campo Limpo Paulista - Endereço: R. João Julião Moreira, s/n - Botujuru, Campo Limpo Paulista - SP, 13238-470</h5>
    <p class="card-text">Telefone: (11) 4812-2966</p>

    <!-- botão de voltar ao topo -->
    <a href="#topo" class="btn btn-dark">Voltar ao topo</a>


    <a href="../sendemail" class="btn btn-dark">Entrar em contato com os administradores</a>

    </div>
    </div>

    <!-- fim da div do container full -->
    </div>
    

    <!-- // link para o arquivo de javascript do (BOOTSTRAP) -->
    </script>
        <script src="frontend/public/bootstrap/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
    </script>

    <!-- fim do body do html -->
</body>

    <!-- fim do html em si -->
</html>