<?php
// começo do php do head

// Inclui a página de carregamento
// include 'backend/loading/carregamento.php'; 

// // Simula um tempo de processamento
// sleep(2); // Isso representaria um processamento em PHP

// link qe vai para a classe php com todos os links e conexões


require_once 'autoload.php';
include_once 'backend/conexao/script/conexao.php';

// Nomes das páginas a serem incluídas
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

// Chame a função autoload para incluir as páginas
// page_autoloader($pages);

// link qe vai para o protetor
include_once 'backend/conexao/script/protect.php';

// link qe vai para o contador de tempo de login
include_once 'backend/conexao/script/expire.php';

// criando as pesquisas gerais para utilização nas tabelas gerais

// $dados_carrosel = $repositorioCarrosel->();
// pesquisa do tema
$dados_temas = $repositorioTemas->listarTodos_crud();

// pesquisa das esquipes
$dados_equipes = $repositorioEquipes->listarTodas_crud();

// pesquisa do horario e local das gincanas
$dados_gincanas = $repositorioGincanas->listarTodas_crud();

// pesquisa das noticias
$dados_noticias = $repositorioNoticias->listarTodas_crud();

// pesquisa da pontuação por dia
$dados_Ppe = $repositorioPpe->listarTodos_crud();

// pesquisa da pontuação por gincana
$dados_Ppa = $repositorioPpa->listarTodos_crud();

// pesquisa da pontuação por gincana
$dados_usuarios = $repositorioUsuarios->listarTodos_crud();

// pesquisa de arquivos de regras de gincanas
$dados_historicos = $repositorioHistoricos->listarTodos_crud();

// pesquisa de arquivos de fotos
$dados_fotos = $repositorioFotos->listarTodas_crud();

// pesquisa de arquivos de regras de gincanas
$dados_arqregras = $repositorioArq_regras->listarTodos_crud();

// pesquisa de arquivos de regras de avaliação
$dados_arqavaliativo = $repositorioArq_avaliativo->listarTodos_crud();

// pesquisa do carrosel
$dados_carrosel = $repositorioCarrosel->listarTodos_crud();

$id_filtro = isset($id) ? $id : null;

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
<html lang="pt-br">
<head>
    <!-- começo do cabecalho do backend -->

    <!-- definições de responsividade -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- titulo da página home do website -->
    <title>Administraçao_spf</title>


    
    <?php
    // pesquisa da logo e colocação da mesma
    $dados_logo = $repositorioLogo->buscarLogo(1);
    while($registro_logo = $dados_logo->fetch_object()){
        if(!isset($id_filtro)){
        ?>


    <!-- icone do website -->
    <link rel="icon" href="./frontend/public/imagens/logo/<?php echo $registro_logo->arquivo_lg?>" alt="Logo">

    <?php
        }else{
            ?>
    <!-- icone do website -->
    <link rel="icon" href="../frontend/public/imagens/logo/<?php echo $registro_logo->arquivo_lg?>" alt="Logo">

<?php
        }
    }
        ?>


<?php
    if(!isset($id_filtro)){
        ?>

    <!-- definições de estilo geral -->
    
    <!-- definições de estilo especificas -->
    

    <!-- links para as tabelas administradas -->


    <!-- Arquivos de css do bootstrap -->
    <link href="frontend/public/bootstrap/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- fim dos arquivos de bootstrap -->

    <?php
    }else{
        ?>


    

    <!-- links para as tabelas administradas -->


    <!-- Arquivos de css do bootstrap -->
    <link href="../frontend/public/bootstrap/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- fim dos arquivos de bootstrap -->
<?php
    }
        ?>
    <!-- fim do cabecalho do backend -->
</head>

<!-- começo do body do html -->
<body style="background-color: lightgray;">

<!-- CHAMADA para função de tradutor em libras -->
<div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
      <div class="vw-plugin-top-wrapper"></div>
    </div>
  </div>
<!-- diretorio usado pelo tradutor de libras durante a tradução->podeser personalizado -->
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
  </script>



<!-- Começando um container para que seja possivel identificar onde começa a página -->
    <div class="container-fluid bg-dark-50">

<!-- Aqui esta o navbar de nosso site, onde as informações sempre serão iguais em todas as páginas -->
<ul class="nav border border-rounded border-dark center bg-dark text-white rounded">


<!-- ------------------------------------------------------------------------------------- COMEÇO DO NAVBAR ---------------------------------------------------------------------------------------------- -->

<li class="nav-item p-2 mt-4" id="topo">

<?php
    // pesquisa da logo e colocação da mesma
    $dados_logo = $repositorioLogo->buscarLogo(1);
    while($registro_logo = $dados_logo->fetch_object()){
        if(!isset($id_filtro)){
        ?>


    <!-- icone do website -->
    <a class="navbar-brand " href="#">
      <img src="./frontend/public/imagens/logo/<?php echo $registro_logo->arquivo_lg?>" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
    </a>

    <?php
        }else{
            ?>
    <!-- icone do website -->
    <a class="navbar-brand" href="#">
      <img src="../frontend/public/imagens/logo/<?php echo $registro_logo->arquivo_lg?>" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
    </a>

<?php
        }
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

if(!isset($id_filtro)){
       // verifica se ele esta dentro dos parametros e mostra seu nome e cargo de acordo com o correto
       if($funcao_usuario == 0){


        echo " <p> Nome: $nome_usuario </p>";
        echo " <p style=\"color: green;\"> Avaliador </p> ";

    
        // verifica se ele esta dentro dos parametros e mostra seu nome e cargo de acordo com o correto
        }elseif($funcao_usuario == 1){

        echo " <p> Nome: $nome_usuario </p>";
        echo " <p style=\"color: red;\"> Administrador </p> ";

        }

}else{
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

if(!isset($id_filtro)){
       // verifica se ele esta dentro dos parametros e mostra seu nome e cargo de acordo com o correto
       if($funcao_usuario == 0){


        echo "<a class=\"nav-link text-white\" href=\"./logout\">Logout</a>";
        echo "<a class=\"nav-link text-white\" href=\"./alt_perf\">Alterar perfil</a>";

    
        // verifica se ele esta dentro dos parametros e mostra seu nome e cargo de acordo com o correto
        }elseif($funcao_usuario == 1){

        echo "<a class=\"nav-link text-white\" href=\"./logout\">Logout</a>";
        echo "<a class=\"nav-link text-white\" href=\"./alt_perf\">Alterar perfil</a>";

        }

}else{
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

 
    }

    // fim do php
    ?>

    <br>

    <!-- fim do li da parte de administração -->
    </li>

    <?php

if(!isset($id_filtro)){

?>
<br>
        <!-- link para a pagina da home -->
        <li class="nav-item  mt-4">
    <a class="nav-link text-white" href="./">Home</a>
    </li>
<!-- link para a página do sobre -->
    <li class="nav-item  mt-4">
        <a class="nav-link text-white " href="./sobre">Sobre</a>
    </li>
<!-- link para a página dos historicos -->
    <li class="nav-item  mt-4">
        <a class="nav-link text-white " href="./historicos">Históricos</a>
    </li>
<!-- link para a página das regras -->
<li class="nav-item  mt-4">
        <a class="nav-link text-white " href="./regras">Regras</a>
    </li>
<!-- link para a página das gincanas -->
    <li class="nav-item  mt-4">
        <a class="nav-link text-white " href="./gincanas">Gincanas</a>
    </li>
<!-- link para a pagina das pontuações -->
    <li class="nav-item  mt-4">
        <a class="nav-link text-white " href="./pontuacoes">Pontuaçoes</a>
    </li>
<!-- link para a página das noticias -->
    <li class="nav-item  mt-4">
        <a class="nav-link text-white " href="./noticias">Noticias</a>
    </li>
<!-- link para a pagina das fotos -->
    <li class="nav-item  mt-4">
        <a class="nav-link text-white " href="./fotos">Fotos</a>
    </li>
<!-- link para administradores a depender do caso -->

<?php
}else{

    ?>
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

    <?php

}
?>

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


            if(!isset($id_filtro)){
    
        echo "<li class=\"nav-item\">";
        echo "<a class=\"nav-link active text-white   mt-4\" href=\"./administrativo\">Administração</a>";
        echo "</li>";

            }else{

                echo "<li class=\"nav-item\">";
                echo "<a class=\"nav-link active text-white   mt-4\" href=\"../administrativo\">Administração</a>";
                echo "</li>";

            }
    
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


<!-- ------------------------------------------------------------------------------------- COMEÇO DO MEIO ---------------------------------------------------------------------------------------------- -->

<br>

<!-- aqui temos o breadcumb do website para termos melhor controle do usuario -->
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="./">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Administração</li>
  </ol>
</nav>

<?php

// echo $funcao_usuario;

if(!isset($id_filtro)){

// Construindo uma barra de navegação para navegar entre as tabelas do website

// <!-- Começo dos botões de ativar registros, desativar registros,excluir todos, gerar csv -->
echo "<div class=\"d-grid gap-2\">";

$data_painel = date('d-m-Y'); // Data de hoje
$dataHoje = date('Y-m-d'); // Data de hoje
echo "<h1 style=\"text-align: center;padding: 5px; border: 2px solid white; border-radius: 10px;color: white;background-color: #212529;\"> A data de hoje é: $data_painel <h1>";

$dados_avaliacao_diaria = $repositorioGincanas->listarTodas_data($dataHoje);

while($registro_aval_diaria = $dados_avaliacao_diaria->fetch_object()){

    echo "<div class=\"row \">";
    echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"./avaliacoes/$registro_aval_diaria->id_gin\"; > 
    Avaliar $registro_aval_diaria->nome_gin - $registro_aval_diaria->horario_gin - $registro_aval_diaria->local_gin

    <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-bar-chart-steps\" viewBox=\"0 0 16 16\">
    <path d=\"M.5 0a.5.5 0 0 1 .5.5v15a.5.5 0 0 1-1 0V.5A.5.5 0 0 1 .5 0M2 1.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1-.5-.5zm2 4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zm2 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-6a.5.5 0 0 1-.5-.5zm2 4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5z\"/>
    </svg>
    
    </a> </button>";
    echo "</div>";

}

echo "<br>";



echo "<div class=\"row \">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"./tabelas/2\"; > 
Pontos por atividade
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-book\" viewBox=\"0 0 16 16\">
  <path d=\"M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783\"/>
</svg>
</a> </button>";
echo "</div>";

echo "<div class=\"row justify-content-center\">";

echo "<div class=\"col-5 m-2\">";

if ($_SESSION['funcao_usuario']==1) {
    # se for adm
    echo "<div class=\"row m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"./tabelas/1\"; > 
Pontos por equipe
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-percent\" viewBox=\"0 0 16 16\">
  <path d=\"M13.442 2.558a.625.625 0 0 1 0 .884l-10 10a.625.625 0 1 1-.884-.884l10-10a.625.625 0 0 1 .884 0M4.5 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5m7 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5\"/>
</svg>
</a> </button>";
echo "</div>";

echo "<div class=\"row m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"./tabelas/3\"; > 
Equipes 
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-people-fill\" viewBox=\"0 0 16 16\">
  <path d=\"M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5\"/>
</svg>
</a> </button>";
echo "</div>";

echo "<div class=\"row m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"./tabelas/4\"; > 
Noticias
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-chat-left-text-fill\" viewBox=\"0 0 16 16\">
  <path d=\"M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1z\"/>
</svg>
</a> </button>";
echo "</div>";

echo "<div class=\"row m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"./tabelas/5\"; > 
Galeria de fotos
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-file-earmark-image\" viewBox=\"0 0 16 16\">
  <path d=\"M6.502 7a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3\"/>
  <path d=\"M14 14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zM4 1a1 1 0 0 0-1 1v10l2.224-2.224a.5.5 0 0 1 .61-.075L8 11l2.157-3.02a.5.5 0 0 1 .76-.063L13 10V4.5h-2A1.5 1.5 0 0 1 9.5 3V1z\"/>
</svg>
</a> </button>";
echo "</div>";

echo "<div class=\"row m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"./tabelas/6\"; > 
Gincanas
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-compass-fill\" viewBox=\"0 0 16 16\">
  <path d=\"M15.5 8.516a7.5 7.5 0 1 1-9.462-7.24A1 1 0 0 1 7 0h2a1 1 0 0 1 .962 1.276 7.5 7.5 0 0 1 5.538 7.24m-3.61-3.905L6.94 7.439 4.11 12.39l4.95-2.828 2.828-4.95z\"/>
</svg>
</a> </button>";
echo "</div>";

echo "<div class=\"row m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"./tabelas/7\"; > 
Arquivos de regras
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-envelope-arrow-down-fill\" viewBox=\"0 0 16 16\">
  <path d=\"M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zm.192 8.159 6.57-4.027L8 9.586l1.239-.757.367.225A4.49 4.49 0 0 0 8 12.5c0 .526.09 1.03.256 1.5H2a2 2 0 0 1-1.808-1.144M16 4.697v4.974A4.5 4.5 0 0 0 12.5 8a4.5 4.5 0 0 0-1.965.45l-.338-.207z\"/>
  <path d=\"M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.354-1.646a.5.5 0 0 1-.722-.016l-1.149-1.25a.5.5 0 1 1 .737-.676l.28.305V11a.5.5 0 0 1 1 0v1.793l.396-.397a.5.5 0 0 1 .708.708z\"/>
</svg>
</a> </button>";
echo "</div>";

echo "<div class=\"row m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"./tabelas/8\"; > 
Arquivos de avaliação
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-envelope-arrow-down-fill\" viewBox=\"0 0 16 16\">
  <path d=\"M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zm.192 8.159 6.57-4.027L8 9.586l1.239-.757.367.225A4.49 4.49 0 0 0 8 12.5c0 .526.09 1.03.256 1.5H2a2 2 0 0 1-1.808-1.144M16 4.697v4.974A4.5 4.5 0 0 0 12.5 8a4.5 4.5 0 0 0-1.965.45l-.338-.207z\"/>
  <path d=\"M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.354-1.646a.5.5 0 0 1-.722-.016l-1.149-1.25a.5.5 0 1 1 .737-.676l.28.305V11a.5.5 0 0 1 1 0v1.793l.396-.397a.5.5 0 0 1 .708.708z\"/>
</svg>
</a> </button>";
echo "</div>";

echo "</div>";

echo "<div class=\"col-5 m-2\">";

echo "<div class=\"row m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"./tabelas/9\"; > 
Historico
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-luggage-fill\" viewBox=\"0 0 16 16\">
  <path d=\"M2 1.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V5h.5A1.5 1.5 0 0 1 8 6.5V7H7v-.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .5.5H4v1H2.5v.25a.75.75 0 0 1-1.5 0v-.335A1.5 1.5 0 0 1 0 13.5v-7A1.5 1.5 0 0 1 1.5 5H2zM3 5h2V2H3z\"/>
  <path d=\"M2.5 7a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0v-5a.5.5 0 0 1 .5-.5m10 1v-.5A1.5 1.5 0 0 0 11 6h-1a1.5 1.5 0 0 0-1.5 1.5V8H8v8h5V8zM10 7h1a.5.5 0 0 1 .5.5V8h-2v-.5A.5.5 0 0 1 10 7M5 9.5A1.5 1.5 0 0 1 6.5 8H7v8h-.5A1.5 1.5 0 0 1 5 14.5zm9 6.5V8h.5A1.5 1.5 0 0 1 16 9.5v5a1.5 1.5 0 0 1-1.5 1.5z\"/>
</svg>
</a> </button>";
echo "</div>";

echo "<div class=\"row m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"./tabelas/10\"; > 
Temas
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-moon-stars-fill\" viewBox=\"0 0 16 16\">
  <path d=\"M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278\"/>
  <path d=\"M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.73 1.73 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.73 1.73 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.73 1.73 0 0 0 1.097-1.097zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.16 1.16 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.16 1.16 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732z\"/>
</svg>
</a> </button>";
echo "</div>";

echo "<div class=\"row m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"./tabelas/11\"; > 
Usuarios
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-person-badge\" viewBox=\"0 0 16 16\">
  <path d=\"M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0\"/>
  <path d=\"M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492z\"/>
</svg>
</a> </button>";
echo "</div>";

echo "<div class=\"row m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"./tabelas/12\"; > 
LOGS
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-exclamation-octagon-fill\" viewBox=\"0 0 16 16\">
  <path d=\"M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2\"/>
</svg>
</a> </button>";
echo "</div>";

echo "<div class=\"row m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"./tabelas/13\"; > 
Administração de carrosel
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-file-earmark-image\" viewBox=\"0 0 16 16\">
  <path d=\"M6.502 7a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3\"/>
  <path d=\"M14 14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zM4 1a1 1 0 0 0-1 1v10l2.224-2.224a.5.5 0 0 1 .61-.075L8 11l2.157-3.02a.5.5 0 0 1 .76-.063L13 10V4.5h-2A1.5 1.5 0 0 1 9.5 3V1z\"/>
</svg>
</a> </button>";
echo "</div>";

echo "<div class=\"row m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"./tabelas/14\"; > 
Alterar logo
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-globe\" viewBox=\"0 0 16 16\">
  <path d=\"M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m7.5-6.923c-.67.204-1.335.82-1.887 1.855A8 8 0 0 0 5.145 4H7.5zM4.09 4a9.3 9.3 0 0 1 .64-1.539 7 7 0 0 1 .597-.933A7.03 7.03 0 0 0 2.255 4zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a7 7 0 0 0-.656 2.5zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5zM8.5 5v2.5h2.99a12.5 12.5 0 0 0-.337-2.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5zM5.145 12q.208.58.468 1.068c.552 1.035 1.218 1.65 1.887 1.855V12zm.182 2.472a7 7 0 0 1-.597-.933A9.3 9.3 0 0 1 4.09 12H2.255a7 7 0 0 0 3.072 2.472M3.82 11a13.7 13.7 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5zm6.853 3.472A7 7 0 0 0 13.745 12H11.91a9.3 9.3 0 0 1-.64 1.539 7 7 0 0 1-.597.933M8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855q.26-.487.468-1.068zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.7 13.7 0 0 1-.312 2.5m2.802-3.5a7 7 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7 7 0 0 0-3.072-2.472c.218.284.418.598.597.933M10.855 4a8 8 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4z\"/>
</svg>
</a> </button>";
echo "</div>";

echo "<div class=\"row m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"./tabelas/15\"; > 
Realizar Backup
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-database-gear\" viewBox=\"0 0 16 16\">
  <path d=\"M12.096 6.223A5 5 0 0 0 13 5.698V7c0 .289-.213.654-.753 1.007a4.5 4.5 0 0 1 1.753.25V4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.5 4.5 0 0 1-.813-.927Q8.378 15 8 15c-1.464 0-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13h.027a4.6 4.6 0 0 1 0-1H8c-1.464 0-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10q.393 0 .774-.024a4.5 4.5 0 0 1 1.102-1.132C9.298 8.944 8.666 9 8 9c-1.464 0-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777M3 4c0-.374.356-.875 1.318-1.313C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4\"/>
  <path d=\"M11.886 9.46c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0\"/>
</svg>
</a> </button>";
echo "</div>";

echo "</div>";
echo "</div>";

}

}else{


// Construindo uma barra de navegação para navegar entre as tabelas do website

// <!-- Começo dos botões de ativar registros, desativar registros,excluir todos, gerar csv -->
echo "<div class=\"d-grid gap-2\">";

$data_painel = date('d-m-Y'); // Data de hoje
$dataHoje = date('Y-m-d'); // Data de hoje
echo "<h1 style=\"text-align: center;padding: 5px; border: 2px solid white; border-radius: 10px;color: white;background-color: #212529;\"> A data de hoje é: $data_painel <h1>";

$dados_avaliacao_diaria = $repositorioGincanas->listarTodas_data($dataHoje);

while($registro_aval_diaria = $dados_avaliacao_diaria->fetch_object()){

    echo "<div class=\"row \">";
    echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../avaliacoes/$registro_aval_diaria->id_gin\"; > 
    Avaliar $registro_aval_diaria->nome_gin - $registro_aval_diaria->horario_gin - $registro_aval_diaria->local_gin

    <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-bar-chart-steps\" viewBox=\"0 0 16 16\">
    <path d=\"M.5 0a.5.5 0 0 1 .5.5v15a.5.5 0 0 1-1 0V.5A.5.5 0 0 1 .5 0M2 1.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1-.5-.5zm2 4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zm2 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-6a.5.5 0 0 1-.5-.5zm2 4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5z\"/>
    </svg>
    
    </a> </button>";
    echo "</div>";

}

echo "<br>";



echo "<div class=\"row\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../tabelas/2\"; > 
Pontos por atividade
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-book\" viewBox=\"0 0 16 16\">
  <path d=\"M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783\"/>
</svg>
</a> </button>";
echo "</div>";


echo "<div class=\"row justify-content-center\">";

echo "<div class=\"col-5 m-3\">";

if ($_SESSION['funcao_usuario']==1) {
    # se for adm
    echo "<div class=\"row m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../tabelas/1\"; > 
Pontos por equipe
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-percent\" viewBox=\"0 0 16 16\">
  <path d=\"M13.442 2.558a.625.625 0 0 1 0 .884l-10 10a.625.625 0 1 1-.884-.884l10-10a.625.625 0 0 1 .884 0M4.5 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5m7 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5\"/>
</svg>
</a> </button>";
echo "</div>";

echo "<div class=\"row  m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../tabelas/3\"; > 
Equipes 
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-people-fill\" viewBox=\"0 0 16 16\">
  <path d=\"M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5\"/>
</svg>
</a> </button>";
echo "</div>";

echo "<div class=\"row m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../tabelas/4\"; > 
Noticias
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-chat-left-text-fill\" viewBox=\"0 0 16 16\">
  <path d=\"M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1z\"/>
</svg>
</a> </button>";
echo "</div>";

echo "<div class=\"row m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../tabelas/5\"; > 
Galeria de fotos
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-file-earmark-image\" viewBox=\"0 0 16 16\">
  <path d=\"M6.502 7a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3\"/>
  <path d=\"M14 14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zM4 1a1 1 0 0 0-1 1v10l2.224-2.224a.5.5 0 0 1 .61-.075L8 11l2.157-3.02a.5.5 0 0 1 .76-.063L13 10V4.5h-2A1.5 1.5 0 0 1 9.5 3V1z\"/>
</svg>
</a> </button>";
echo "</div>";

echo "<div class=\"row m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../tabelas/6\"; > 
Gincanas
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-compass-fill\" viewBox=\"0 0 16 16\">
  <path d=\"M15.5 8.516a7.5 7.5 0 1 1-9.462-7.24A1 1 0 0 1 7 0h2a1 1 0 0 1 .962 1.276 7.5 7.5 0 0 1 5.538 7.24m-3.61-3.905L6.94 7.439 4.11 12.39l4.95-2.828 2.828-4.95z\"/>
</svg>
</a> </button>";
echo "</div>";

echo "<div class=\"row m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../tabelas/7\"; > 
Arquivos de regras
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-envelope-arrow-down-fill\" viewBox=\"0 0 16 16\">
  <path d=\"M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zm.192 8.159 6.57-4.027L8 9.586l1.239-.757.367.225A4.49 4.49 0 0 0 8 12.5c0 .526.09 1.03.256 1.5H2a2 2 0 0 1-1.808-1.144M16 4.697v4.974A4.5 4.5 0 0 0 12.5 8a4.5 4.5 0 0 0-1.965.45l-.338-.207z\"/>
  <path d=\"M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.354-1.646a.5.5 0 0 1-.722-.016l-1.149-1.25a.5.5 0 1 1 .737-.676l.28.305V11a.5.5 0 0 1 1 0v1.793l.396-.397a.5.5 0 0 1 .708.708z\"/>
</svg>
</a> </button>";
echo "</div>";

echo "<div class=\"row m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../tabelas/8\"; > 
Arquivos de avaliação
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-envelope-arrow-down-fill\" viewBox=\"0 0 16 16\">
  <path d=\"M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zm.192 8.159 6.57-4.027L8 9.586l1.239-.757.367.225A4.49 4.49 0 0 0 8 12.5c0 .526.09 1.03.256 1.5H2a2 2 0 0 1-1.808-1.144M16 4.697v4.974A4.5 4.5 0 0 0 12.5 8a4.5 4.5 0 0 0-1.965.45l-.338-.207z\"/>
  <path d=\"M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.354-1.646a.5.5 0 0 1-.722-.016l-1.149-1.25a.5.5 0 1 1 .737-.676l.28.305V11a.5.5 0 0 1 1 0v1.793l.396-.397a.5.5 0 0 1 .708.708z\"/>
</svg>
</a> </button>";
echo "</div>";

echo "</div>";

echo "<div class=\"col-5 m-3\">";

echo "<div class=\"row m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../tabelas/9\"; > 
Historico
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-luggage-fill\" viewBox=\"0 0 16 16\">
  <path d=\"M2 1.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V5h.5A1.5 1.5 0 0 1 8 6.5V7H7v-.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .5.5H4v1H2.5v.25a.75.75 0 0 1-1.5 0v-.335A1.5 1.5 0 0 1 0 13.5v-7A1.5 1.5 0 0 1 1.5 5H2zM3 5h2V2H3z\"/>
  <path d=\"M2.5 7a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0v-5a.5.5 0 0 1 .5-.5m10 1v-.5A1.5 1.5 0 0 0 11 6h-1a1.5 1.5 0 0 0-1.5 1.5V8H8v8h5V8zM10 7h1a.5.5 0 0 1 .5.5V8h-2v-.5A.5.5 0 0 1 10 7M5 9.5A1.5 1.5 0 0 1 6.5 8H7v8h-.5A1.5 1.5 0 0 1 5 14.5zm9 6.5V8h.5A1.5 1.5 0 0 1 16 9.5v5a1.5 1.5 0 0 1-1.5 1.5z\"/>
</svg>
</a> </button>";
echo "</div>";

echo "<div class=\"row m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../tabelas/10\"; > 
Temas
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-moon-stars-fill\" viewBox=\"0 0 16 16\">
  <path d=\"M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278\"/>
  <path d=\"M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.73 1.73 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.73 1.73 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.73 1.73 0 0 0 1.097-1.097zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.16 1.16 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.16 1.16 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732z\"/>
</svg>
</a> </button>";
echo "</div>";

echo "<div class=\"row m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../tabelas/11\"; > 
Usuarios
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-person-badge\" viewBox=\"0 0 16 16\">
  <path d=\"M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0\"/>
  <path d=\"M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492z\"/>
</svg>
</a> </button>";
echo "</div>";

echo "<div class=\"row m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../tabelas/12\"; > 
LOGS
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-exclamation-octagon-fill\" viewBox=\"0 0 16 16\">
  <path d=\"M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2\"/>
</svg>
</a> </button>";
echo "</div>";

echo "<div class=\"row m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../tabelas/13\"; > 
Administração de carrosel
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-file-earmark-image\" viewBox=\"0 0 16 16\">
  <path d=\"M6.502 7a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3\"/>
  <path d=\"M14 14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zM4 1a1 1 0 0 0-1 1v10l2.224-2.224a.5.5 0 0 1 .61-.075L8 11l2.157-3.02a.5.5 0 0 1 .76-.063L13 10V4.5h-2A1.5 1.5 0 0 1 9.5 3V1z\"/>
</svg>
</a> </button>";
echo "</div>";

echo "<div class=\"row m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../tabelas/14\"; > 
Alterar logo
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-globe\" viewBox=\"0 0 16 16\">
  <path d=\"M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m7.5-6.923c-.67.204-1.335.82-1.887 1.855A8 8 0 0 0 5.145 4H7.5zM4.09 4a9.3 9.3 0 0 1 .64-1.539 7 7 0 0 1 .597-.933A7.03 7.03 0 0 0 2.255 4zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a7 7 0 0 0-.656 2.5zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5zM8.5 5v2.5h2.99a12.5 12.5 0 0 0-.337-2.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5zM5.145 12q.208.58.468 1.068c.552 1.035 1.218 1.65 1.887 1.855V12zm.182 2.472a7 7 0 0 1-.597-.933A9.3 9.3 0 0 1 4.09 12H2.255a7 7 0 0 0 3.072 2.472M3.82 11a13.7 13.7 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5zm6.853 3.472A7 7 0 0 0 13.745 12H11.91a9.3 9.3 0 0 1-.64 1.539 7 7 0 0 1-.597.933M8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855q.26-.487.468-1.068zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.7 13.7 0 0 1-.312 2.5m2.802-3.5a7 7 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7 7 0 0 0-3.072-2.472c.218.284.418.598.597.933M10.855 4a8 8 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4z\"/>
</svg>
</a> </button>";
echo "</div>";

echo "<div class=\"row m-1\">";
echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../tabelas/15\"; > 
Realizar Backup
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-database-gear\" viewBox=\"0 0 16 16\">
  <path d=\"M12.096 6.223A5 5 0 0 0 13 5.698V7c0 .289-.213.654-.753 1.007a4.5 4.5 0 0 1 1.753.25V4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.5 4.5 0 0 1-.813-.927Q8.378 15 8 15c-1.464 0-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13h.027a4.6 4.6 0 0 1 0-1H8c-1.464 0-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10q.393 0 .774-.024a4.5 4.5 0 0 1 1.102-1.132C9.298 8.944 8.666 9 8 9c-1.464 0-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777M3 4c0-.374.356-.875 1.318-1.313C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4\"/>
  <path d=\"M11.886 9.46c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0\"/>
</svg>
</a> </button>";
echo "</div>";

echo "</div>";
echo "</div>";

}

}

echo "</div>";
// <!-- fim dos botões -->

?>
<!--  fim da barra de navegação -->

<?php
// inicio do php Geral

if(isset($id_filtro)){

echo "<br>"; 
// <!-- espaçamento entre tabelas -->

// verificando se o usuario pode ver esta tabela
if($id_filtro == 1 && $funcao_usuario == 1 || $funcao_usuario == 0){

// <!-- TABELA: Pontuações por dia ************************************************************************************************************************* -->

// echo "<!-- botão para voltar para a página ao topo-->
echo "<button class=\"text-white rounded border border-2 border-white bg-dark\" ><a href=\"#topo\">";
// <!-- icone de voltar -->
echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">
<path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8\"/>
</svg>";
echo "Voltar";
echo "</a></button>";

echo "<br>";
echo "<br>";

// <!-- titulo da primeira tabela-->
echo "<h1 class=\"Ppes\" style=\"color: white; border: 2px solid white;padding: 2px;text-align: center;background-color: #212529; border-radius: 10px;\"> Tabela de Pontuações por equipe</h1>";

// mostrando a quantidade de linhas 
echo "<div class=\"row\">";
echo "<div class=\"col-3\">";
echo "<h2> Quantidade de linhas:</h2>";
echo "</div>";
echo "<div class=\"col-1\">";
echo "<h2 style=\"color: red;\">$dados_Ppe->num_rows </h2>";
echo "</div>";
echo "</div>";
echo "<br>";


// <!-- Começo dos botões de ativar registros, desativar registros,excluir todos, gerar csv -->
echo "<div class=\"d-grid gap-2\">";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../inclusoes/1\"; > Inserir Registro</a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../csvs/1\"; > Gerar CSV  </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../xls/1\"; > Gerar Excel  </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../confat/1\"; > Ativar Todos </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../confdt/1\"; > Desativar Todos </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../conflimp/1\"; > Remover Todos </a> </button>";

echo "<br>";

echo "</div>";
// <!-- fim dos botões -->


echo "<div class=\"row\">";

// <!-- foi separada uma linha só para ele -->
echo "<div class=\"col-sm-12 \">";

        // <!-- aqui iniciamos a tabela -->
        echo "<table class=\"table table-secondary table-striped table-hover border border-2 rounded border-dark p-1\">";

        // <!-- aqui criamos o cabeçalho da tabela -->
        // echo "<thead>";
            // <!-- iniciando uma linha para o cabcalho -->
            echo "<tr>";

          echo "<th scope=\"col\">Id</th>";        
          echo "<th scope=\"col\">Id da equipe - Nome</th>";
          echo "<th scope=\"col\">Pontuação Somatória</th>";
          echo "<th scope=\"col\">Ranking</th>";
          echo "<th scope=\"col\">Status</th>";
          echo "<th scope=\"col\">Consultar</th>";
          echo "<th scope=\"col\">Alterar</th>";
          echo "<th scope=\"col\">Deletar</th>";
          echo "</tr>";

            // <!-- fechando a linha do cabecalho -->
        // echo "</thead>";
        // <!-- final do cabecalho da tabela -->

        // <!-- aqui appendamos os resultados dos gráficos -->
        // echo "<tbody>";

        // inicio da pesquisa
        while($registro_Ppe = $dados_Ppe->fetch_object()){

            // iniciando uma linha para colocar os resultados
            echo "<tr>";

            // <!-- zero campo: id_pont  -->
            echo "<td> $registro_Ppe->id_pont</td>";

            $dados_fileq = $repositorioEquipes->buscarEquipe($registro_Ppe->equipe_id);
                 // inicio da pesquisa
        while($registro_equipes = $dados_fileq->fetch_object()){

            // <!-- primeiro campo: idequipe  -->
            echo "<td> $registro_Ppe->equipe_id - $registro_equipes->nome_eq</td>";


        }

            // <!-- terceiro campo: pontuação -->
            echo "<td> $registro_Ppe->soma_pont</td>";

            echo "<td> $registro_Ppe->ranking</td>";
            // <!-- terceiro campo: status -->
            echo "<td>";
                                    if ($registro_Ppe->status_pontpe == 1) {
                                        echo "<a class=\"text-success\" href=\"../atualizaStatus/$registro_Ppe->id_pont/1/0\">Ativado</a>";

                                    } else {

                                        echo "<a class=\"text-dark\" href=\"../atualizaStatus/$registro_Ppe->id_pont/1/1\">Desativado</a>";
                                    }
            echo "</td>";
            // <!-- quarto campo: Consultar -->
            echo "<td><a href=\"../pesquisadores/1/$registro_Ppe->id_pont\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-search\" viewBox=\"0 0 16 16\">
            <path d=\"M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z\"/>
            </svg></a></td>";
            // <!-- quinto campo: Alterar -->
            echo "<td><a href=\"../alteracoes/1/$registro_Ppe->id_pont\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-pen\" viewBox=\"0 0 16 16\">
            <path d=\"m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z\"/>
            </svg></a></td>";
            // <!-- sexto campo: Excluir -->
            echo "<td><a href=\"../confex/1/$registro_Ppe->id_pont\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-trash-fill\" viewBox=\"0 0 16 16\">
            <path d=\"M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z\"/>
            </svg></a></td>";
          
            echo "</tr>";
            // <!-- fechando a linha de colocar os resultados -->

        }
        // final da pesquisa
            
        // echo "</tbody>";
        // <!-- aqui finalizamos o appender -->

        echo "</table>";
        // <!-- final da tabela criada pelo bootstrap -->

echo "</div>";
echo "</div>";


// <!-- FINAL DO TABELA DE: pontuações por dia *********************************************************************************************************** --> 
};

echo "<br>"; 
// <!-- espaçamento entre tabelas -->

// verificando se o usuario pode ver esta tabela
if($id_filtro == 2 && $funcao_usuario == 1 || $funcao_usuario == 0){

// <!-- TABELA: Pontuações por Gincana ************************************************************************************************************************* -->

// echo "<!-- botão para voltar para a página ao topo-->
echo "<button class=\"text-white rounded border border-2 border-white bg-dark\" ><a href=\"#topo\">";
// <!-- icone de voltar -->
echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">
<path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8\"/>
</svg>";
echo "Voltar";
echo "</a></button>";

echo "<br>";
echo "<br>";

// <!-- titulo da primeira tabela-->
echo "<h1 class=\"Ppas\" style=\"color: white; border: 2px solid white;padding: 2px;text-align: center;background-color: #212529; border-radius: 10px;\"> Tabela de Pontuações por atividade</h1>";

// mostrando a quantidade de linhas 
echo "<div class=\"row\">";
echo "<div class=\"col-3\">";
echo "<h2> Quantidade de linhas:</h2>";
echo "</div>";
echo "<div class=\"col-1\">";
echo "<h2 style=\"color: red;\">$dados_Ppa->num_rows </h2>";
echo "</div>";
echo "</div>";
echo "<br>";

// <!-- Começo dos botões de ativar registros, desativar registros,excluir todos, gerar csv -->
echo "<div class=\"d-grid gap-2\">";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../inclusoes/2\"; > Inserir Registro</a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../csvs/2\"; > Gerar CSV  </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../xls/2\"; > Gerar Excel  </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../confat/2\"; > Ativar Todos </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../confdt/2\"; >  Desativar Todos </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../conflimp/2\"; > Remover Todos </a> </button>";

echo "<br>";

echo "</div>";
// <!-- fim dos botões -->

echo "<div class=\"row\">";

// <!-- foi separada uma linha só para ele -->
echo "<div class=\"col-sm-12\">";

        // <!-- aqui iniciamos a tabela -->
        echo "<table class=\"table table-secondary table-striped table-hover border border-2 rounded border-dark p-1\">";

        // <!-- aqui criamos o cabeçalho da tabela -->
        // echo "<thead>";
            // <!-- iniciando uma linha para o cabcalho -->
            echo "<tr>";

            
          echo "<th scope=\"col\">Id</th>";
          echo "<th scope=\"col\">Id da Equipe - Nome</th>";
          echo "<th scope=\"col\">Id da Gincana - Nome</th>";
          echo "<th scope=\"col\">Criterio 1 - Pontos</th>";
          echo "<th scope=\"col\">Criterio 2 - Pontos</th>";
          echo "<th scope=\"col\">Criterio 3 - Pontos</th>";
          echo "<th scope=\"col\">Dia da pontuação</th>";
          echo "<th scope=\"col\">Pontuação Final</th>";
          echo "<th scope=\"col\">Status</th>";
          echo "<th scope=\"col\">Consultar</th>";
          echo "<th scope=\"col\">Alterar</th>";
          echo "<th scope=\"col\">Deletar</th>";
          echo "</tr>";

            // <!-- fechando a linha do cabecalho -->
        // echo "</thead>";
        // <!-- final do cabecalho da tabela -->

        // <!-- aqui appendamos os resultados dos gráficos -->
        // echo "<tbody>";

        // inicio da pesquisa
        while($registro_Ppa = $dados_Ppa->fetch_object()){

            // iniciando uma linha para colocar os resultados
            echo "<tr>";

            // <!-- zero campo: id_pont  -->
            echo "<td> $registro_Ppa->id_pontpa</td>";

            $dados_fileq = $repositorioEquipes->buscarEquipe($registro_Ppa->equipe_id);
            while($registro_fileq = $dados_fileq->fetch_object()){

            // <!-- primeiro campo: idequipe  -->
            echo "<td> $registro_Ppa->equipe_id - $registro_fileq->nome_eq</td>";

            }

            $dados_filgin = $repositorioGincanas->buscarGincana($registro_Ppa->gincana_id);
            while($registro_filgin = $dados_filgin->fetch_object()){

            // <!-- segundo campo: idgincana -->
            echo "<td> $registro_Ppa->gincana_id - $registro_filgin->nome_gin</td>";
            // <!-- segundo campo: idgincana -->
            echo "<td> $registro_filgin->crie_1 - $registro_Ppa->crie_1</td>";
            // <!-- segundo campo: idgincana -->
            echo "<td> $registro_filgin->crie_2 - $registro_Ppa->crie_2</td>";
            // <!-- segundo campo: idgincana -->
            echo "<td> $registro_filgin->crie_3 -  $registro_Ppa->crie_3</td>";

            }

            // <!-- terceiro campo: diapontuação -->
            echo "<td> $registro_Ppa->dia_pontpa</td>";
            // <!-- quarto campo: pontuação -->
            echo "<td> $registro_Ppa->pont_da_gin</td>";
            // <!-- quarto campo: status -->
            echo "<td>";
                                    if ($registro_Ppa->status_pontpa == 1) {
                                        echo "<a class=\"text-success\" href=\"../atualizaStatus/$registro_Ppa->id_pontpa/2/0\">Ativado</a>";

                                    } else {

                                        echo "<a class=\"text-dark\" href=\"../atualizaStatus/$registro_Ppa->id_pontpa/2/1\">Desativado</a>";
                                    }
            echo "</td>";
            // <!-- quinto campo: Consultar -->
            echo "<td><a href=\"../pesquisadores/2/$registro_Ppa->id_pontpa\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-search\" viewBox=\"0 0 16 16\">
            <path d=\"M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z\"/>
            </svg></a></td>";
            // <!-- sexto campo: Alterar -->
            echo "<td><a href=\"../alteracoes/2/$registro_Ppa->id_pontpa\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-pen\" viewBox=\"0 0 16 16\">
            <path d=\"m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z\"/>
            </svg></a></td>";
            // <!-- setimo campo: Excluir -->
            echo "<td><a href=\"../confex/2/$registro_Ppa->id_pontpa\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-trash-fill\" viewBox=\"0 0 16 16\">
            <path d=\"M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z\"/>
            </svg></a></td>";
          
            echo "</tr>";
            // <!-- fechando a linha de colocar os resultados -->

        }
        // final da pesquisa
            
        // echo "</tbody>";
        // <!-- aqui finalizamos o appender -->

        echo "</table>";
        // <!-- final da tabela criada pelo bootstrap -->

echo "</div>";
echo "</div>";


// <!-- FINAL DO TABELA DE: pontuações por Gincana *********************************************************************************************************** --> 
};

echo "<br>"; 
// <!-- espaçamento entre tabelas -->

// verificando se o usuario pode ver esta tabela
if( $id_filtro == 3 && $funcao_usuario == 1){

// <!-- TABELA: Equipes ************************************************************************************************************************* -->

// echo "<!-- botão para voltar para a página ao topo-->
echo "<button class=\"text-white rounded border border-2 border-white bg-dark\" ><a href=\"#topo\">";
// <!-- icone de voltar -->
echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">
<path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8\"/>
</svg>";
echo "Voltar";
echo "</a></button>";

echo "<br>";
echo "<br>";


// <!-- titulo da primeira tabela-->
echo "<h1 class=\"equipes\" style=\"color: white; border: 2px solid white;padding: 2px;text-align: center;background-color: #212529; border-radius: 10px;\"> Tabela de Equipes/Salas </h1>";

// mostrando a quantidade de linhas 
// mostrando a quantidade de linhas 
echo "<div class=\"row\">";
echo "<div class=\"col-3\">";
echo "<h2> Quantidade de linhas:</h2>";
echo "</div>";
echo "<div class=\"col-1\">";
echo "<h2 style=\"color: red;\">$dados_equipes->num_rows </h2>";
echo "</div>";
echo "</div>";
echo "<br>";

// <!-- Começo dos botões de ativar registros, desativar registros,excluir todos, gerar csv -->
echo "<div class=\"d-grid gap-2\">";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../inclusoes/3\"; > Inserir Registro</a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../csvs/3\"; > Gerar CSV  </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../xls/3\"; > Gerar Excel  </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../confat/3\"; > Ativar Todos </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../confdt/3\"; >  Desativar Todos </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../conflimp/3\"; > Remover Todos </a> </button>";

echo "<br>";

echo "</div>";
// <!-- fim dos botões -->

echo "<div class=\"row\">";

// <!-- foi separada uma linha só para ele -->
echo "<div class=\"col-sm-12\">";

        // <!-- aqui iniciamos a tabela -->
        echo "<table class=\"table table-secondary table-striped table-hover border border-2 rounded border-dark p-1\">";

        // <!-- aqui criamos o cabeçalho da tabela -->
        // echo "<thead>";
            // <!-- iniciando uma linha para o cabcalho -->
            echo "<tr>";

          echo "<th scope=\"col\">Id</th>";
          echo "<th scope=\"col\">Nome</th>";
          echo "<th scope=\"col\">Sala</th>";
          echo "<th scope=\"col\">Ano</th>";
          echo "<th scope=\"col\">Tema</th>";
          echo "<th scope=\"col\">status</th>";
          echo "<th scope=\"col\">Consultar</th>";
          echo "<th scope=\"col\">Alterar</th>";
          echo "<th scope=\"col\">Deletar</th>";
          echo "</tr>";

            // <!-- fechando a linha do cabecalho -->
        // echo "</thead>";
        // <!-- final do cabecalho da tabela -->

        // <!-- aqui appendamos os resultados dos gráficos -->
        // echo "<tbody>";

        // inicio da pesquisa
        while($registro_equipes = $dados_equipes->fetch_object()){

            // iniciando uma linha para colocar os resultados
            echo "<tr>";

            // <!-- zero campo: idequipe  -->
            echo "<td> $registro_equipes->id_eq</td>";
            // <!-- primeiro campo: nomeequipe  -->
            echo "<td> $registro_equipes->nome_eq</td>";
            // <!-- segundo campo: salaequipe -->
            echo "<td> $registro_equipes->sala_eq</td>";
            // <!-- terceiro campo: anoequipe -->
            echo "<td> $registro_equipes->ano_eq</td>";
            // <!-- quarto campo: temaequipe -->
            echo "<td> $registro_equipes->tema_eq</td>";
            // <!-- quarto campo: status -->
            echo "<td>";
                                    if ($registro_equipes->status_eq == 1) {
                                        echo "<a class=\"text-success\" href=\"../atualizaStatus/$registro_equipes->id_eq/3/0\">Ativado</a>";

                                    } else {

                                        echo "<a class=\"text-dark\" href=\"../atualizaStatus/$registro_equipes->id_eq/3/1\">Desativado</a>";
                                    }
            echo "</td>";
            // <!-- quinto campo: Consultar -->
            echo "<td><a href=\"../pesquisadores/3/$registro_equipes->id_eq\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-search\" viewBox=\"0 0 16 16\">
            <path d=\"M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z\"/>
            </svg></a></td>";
            // <!-- sexto campo: Alterar -->
            echo "<td><a href=\"../alteracoes/3/$registro_equipes->id_eq\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-pen\" viewBox=\"0 0 16 16\">
            <path d=\"m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z\"/>
            </svg></a></td>";
            // <!-- setimo campo: Excluir -->
            echo "<td><a href=\"../confex/3/$registro_equipes->id_eq\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-trash-fill\" viewBox=\"0 0 16 16\">
            <path d=\"M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z\"/>
            </svg></a></td>";
          
            echo "</tr>";
            // <!-- fechando a linha de colocar os resultados -->

        }
        // final da pesquisa
            
        // echo "</tbody>";
        // <!-- aqui finalizamos o appender -->

        echo "</table>";
        // <!-- final da tabela criada pelo bootstrap -->

echo "</div>";
echo "</div>";


// <!-- FINAL DO TABELA DE: Equipes *********************************************************************************************************** --> 
};

echo "<br>"; 
// <!-- espaçamento entre tabelas -->

// verificando se o usuario pode ver esta tabela
if($id_filtro == 4 && $funcao_usuario == 1){

// <!-- TABELA: Noticias ************************************************************************************************************************* -->

// echo "<!-- botão para voltar para a página ao topo-->
echo "<button class=\"text-white rounded border border-2 border-white bg-dark\" ><a href=\"#topo\">";
// <!-- icone de voltar -->
echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">
<path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8\"/>
</svg>";
echo "Voltar";
echo "</a></button>";

echo "<br>";
echo "<br>";

// <!-- titulo da primeira tabela-->
echo "<h1 class=\"noticias\" style=\"color: white; border: 2px solid white;padding: 2px;text-align: center;background-color: #212529; border-radius: 10px;\"> Tabela de Noticias </h1>";

// mostrando a quantidade de linhas 
// mostrando a quantidade de linhas 
echo "<div class=\"row\">";
echo "<div class=\"col-3\">";
echo "<h2> Quantidade de linhas:</h2>";
echo "</div>";
echo "<div class=\"col-1\">";
echo "<h2 style=\"color: red;\">$dados_noticias->num_rows </h2>";
echo "</div>";
echo "</div>";
echo "<br>";

// <!-- Começo dos botões de ativar registros, desativar registros,excluir todos, gerar csv -->
echo "<div class=\"d-grid gap-2\">";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../inclusoes/4\"; > Inserir Registro</a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../csvs/4\"; > Gerar CSV  </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../xls/4\"; > Gerar Excel  </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"><a href=\"../confat/4\"; > Ativar Todos </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../confdt/4\"; >  Desativar Todos </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../conflimp/4\"; > Remover Todos </a> </button>";

echo "<br>";

echo "</div>";
// <!-- fim dos botões -->

echo "<div class=\"row\">";

// <!-- foi separada uma linha só para ele -->
echo "<div class=\"col-sm-12\">";

        // <!-- aqui iniciamos a tabela -->
        echo "<table class=\"table table-secondary table-striped table-hover border border-2 rounded border-dark p-1\">";

        // <!-- aqui criamos o cabeçalho da tabela -->
        // echo "<thead>";
            // <!-- iniciando uma linha para o cabcalho -->
            echo "<tr>";

          echo "<th scope=\"col\">Id</th>";
          echo "<th scope=\"col\">Titulo</th>";
          echo "<th scope=\"col\">Descricao</th>";
          echo "<th scope=\"col\">Data</th>";
          echo "<th scope=\"col\">Status</th>";
          echo "<th scope=\"col\">Consultar</th>";
          echo "<th scope=\"col\">Alterar</th>";
          echo "<th scope=\"col\">Deletar</th>";
          echo "</tr>";

            // <!-- fechando a linha do cabecalho -->
        // echo "</thead>";
        // <!-- final do cabecalho da tabela -->

        // <!-- aqui appendamos os resultados dos gráficos -->
        // echo "<tbody>";

        // inicio da pesquisa
        while($registro_noticias = $dados_noticias->fetch_object()){

            // iniciando uma linha para colocar os resultados
            echo "<tr>";

            // <!-- zero campo: idnoticia  -->
            echo "<td> $registro_noticias->id_not</td>";
            // <!-- primeiro campo: titulonoticia  -->
            echo "<td> $registro_noticias->titulo_not</td>";
            // <!-- segundo campo: descricaonoticia -->
            echo "<td> $registro_noticias->descricao_not</td>";
            // <!-- terceiro campo: datanoticia -->
            echo "<td> $registro_noticias->data_not</td>";
            // <!-- terceiro campo: status -->
            echo "<td>";
                                    if ($registro_noticias->status_not == 1) {
                                        echo "<a class=\"text-success\" href=\"../atualizaStatus/$registro_noticias->id_not/4/0\">Ativado</a>";

                                    } else {

                                        echo "<a class=\"text-dark\" href=\"../atualizaStatus/$registro_noticias->id_not/4/1\">Desativado</a>";
                                    }
            echo "</td>";
            // <!-- quarto campo: Consultar -->
            echo "<td><a href=\"../pesquisadores/4/$registro_noticias->id_not\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-search\" viewBox=\"0 0 16 16\">
            <path d=\"M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z\"/>
            </svg></a></td>";
            // <!-- quinto campo: Alterar -->
            echo "<td><a href=\"../alteracoes/4/$registro_noticias->id_not\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-pen\" viewBox=\"0 0 16 16\">
            <path d=\"m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z\"/>
            </svg></a></td>";
            // <!-- sexto campo: Excluir -->
            echo "<td><a href=\"../confex/4/$registro_noticias->id_not\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-trash-fill\" viewBox=\"0 0 16 16\">
            <path d=\"M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z\"/>
            </svg></a></td>";
          
            echo "</tr>";
            // <!-- fechando a linha de colocar os resultados -->

        }
        // final da pesquisa
            
        // echo "</tbody>";
        // <!-- aqui finalizamos o appender -->

        echo "</table>";
        // <!-- final da tabela criada pelo bootstrap -->

echo "</div>";
echo "</div>";


// <!-- FINAL DO TABELA DE: Noticias *********************************************************************************************************** --> 
};

echo "<br>"; 
// <!-- espaçamento entre tabelas -->

// verificando se o usuario pode ver esta tabela
if($id_filtro == 5 && $funcao_usuario == 1){

// <!-- TABELA: Fotos ************************************************************************************************************************* -->

// echo "<!-- botão para voltar para a página ao topo-->
echo "<button class=\"text-white rounded border border-2 border-white bg-dark\" ><a href=\"#topo\">";
// <!-- icone de voltar -->
echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">
<path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8\"/>
</svg>";
echo "Voltar";
echo "</a></button>";

echo "<br>";
echo "<br>";


// <!-- titulo da primeira tabela-->
echo "<h1 class=\"fotos\" style=\"color: white; border: 2px solid white;padding: 2px;text-align: center;background-color: #212529; border-radius: 10px;\"> Tabela da galeria de fotos </h1>";

// mostrando a quantidade de linhas 
// mostrando a quantidade de linhas 
echo "<div class=\"row\">";
echo "<div class=\"col-3\">";
echo "<h2> Quantidade de linhas:</h2>";
echo "</div>";
echo "<div class=\"col-1\">";
echo "<h2 style=\"color: red;\">$dados_fotos->num_rows </h2>";
echo "</div>";
echo "</div>";
echo "<br>";

// <!-- Começo dos botões de ativar registros, desativar registros,excluir todos, gerar csv -->
echo "<div class=\"d-grid gap-2\">";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../inclusoes/5\"; > Inserir Registro</a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../imagens_diversas/0\"; > Inserir diversas imagens </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../csvs/5\"; > Gerar CSV  </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../xls/5\"; > Gerar Excel  </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../confat/5\"; > Ativar Todos </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../confdt/5\"; >  Desativar Todos </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../conflimp/5\"; > Remover Todos </a> </button>";

echo "<br>";

echo "</div>";
// <!-- fim dos botões -->

echo "<div class=\"row\">";

// <!-- foi separada uma linha só para ele -->
echo "<div class=\"col-sm-12\">";

        // <!-- aqui iniciamos a tabela -->
        echo "<table class=\"table table-secondary table-striped table-hover border border-2 rounded border-dark p-1\">";

        // <!-- aqui criamos o cabeçalho da tabela -->
        // echo "<thead>";
            // <!-- iniciando uma linha para o cabcalho -->
            echo "<tr>";

          echo "<th scope=\"col\">Id</th>";
          echo "<th scope=\"col\">Titulo</th>";
          echo "<th scope=\"col\">Descricao</th>";
          echo "<th scope=\"col\">Data</th>";
          echo "<th scope=\"col\">Consultar</th>";
          echo "<th scope=\"col\">Alterar</th>";
          echo "<th scope=\"col\">Deletar</th>";
          echo "</tr>";

            // <!-- fechando a linha do cabecalho -->
        // echo "</thead>";
        // <!-- final do cabecalho da tabela -->

        // <!-- aqui appendamos os resultados dos gráficos -->
        // echo "<tbody>";

        // inicio da pesquisa
        while($registro_foto = $dados_fotos->fetch_object()){

            // iniciando uma linha para colocar os resultados
            echo "<tr>";

            // <!-- zero campo: idfoto  -->
            echo "<td> $registro_foto->id_foto</td>";
            // <!-- primeiro campo: titulofoto  -->
            echo "<td> $registro_foto->titulo_foto</td>";
            // <!-- segundo campo: descricaofoto -->
            echo "<td> $registro_foto->descricao_foto</td>";
            // <!-- terceiro campo: datafoto -->
            echo "<td> $registro_foto->ano_foto</td>";
            // <!-- terceiro campo: status -->
            echo "<td>";
                                    if ($registro_foto->status_foto == 1) {
                                        echo "<a class=\"text-success\" href=\"../atualizaStatus/$registro_foto->id_foto/5/0\">Ativado</a>";

                                    } else {

                                        echo "<a class=\"text-dark\" href=\"../atualizaStatus/$registro_foto->id_foto/5/1\">Desativado</a>";
                                    }
            echo "</td>";
            // <!-- quarto campo: Consultar -->
            echo "<td><a href=\"../pesquisadores/5/$registro_foto->id_foto\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-search\" viewBox=\"0 0 16 16\">
            <path d=\"M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z\"/>
            </svg></a></td>";
            // <!-- quinto campo: Alterar -->
            echo "<td><a href=\"../alteracoes/5/$registro_foto->id_foto\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-pen\" viewBox=\"0 0 16 16\">
            <path d=\"m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z\"/>
            </svg></a></td>";
            // <!-- sexto campo: Excluir -->
            echo "<td><a href=\"../confex/5/$registro_foto->id_foto\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-trash-fill\" viewBox=\"0 0 16 16\">
            <path d=\"M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z\"/>
            </svg></a></td>";
          
            echo "</tr>";
            // <!-- fechando a linha de colocar os resultados -->

        }
        // final da pesquisa
            
        // echo "</tbody>";
        // <!-- aqui finalizamos o appender -->

        echo "</table>";
        // <!-- final da tabela criada pelo bootstrap -->

echo "</div>";
echo "</div>";


// <!-- FINAL DO TABELA DE: Fotos *********************************************************************************************************** --> 
};

echo "<br>"; 
// <!-- espaçamento entre tabelas -->

// verificando se o usuario pode ver esta tabela
if( $id_filtro == 6 && $funcao_usuario == 1){

// <!-- TABELA: Gincanas ************************************************************************************************************************* -->

// echo "<!-- botão para voltar para a página ao topo-->
echo "<button class=\"text-white rounded border border-2 border-white bg-dark\" ><a href=\"#topo\">";
// <!-- icone de voltar -->
echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">
<path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8\"/>
</svg>";
echo "Voltar";
echo "</a></button>";

echo "<br>";
echo "<br>";


// <!-- titulo da primeira tabela-->
echo "<h1 class=\"regras\" style=\"color: white; border: 2px solid white;padding: 2px;text-align: center;background-color: #212529; border-radius: 10px;\"> Tabela de Gincanas </h1>";

// mostrando a quantidade de linhas 
// mostrando a quantidade de linhas 
echo "<div class=\"row\">";
echo "<div class=\"col-3\">";
echo "<h2> Quantidade de linhas:</h2>";
echo "</div>";
echo "<div class=\"col-1\">";
echo "<h2 style=\"color: red;\">$dados_gincanas->num_rows </h2>";
echo "</div>";
echo "</div>";
echo "<br>";

// <!-- Começo dos botões de ativar registros, desativar registros,excluir todos, gerar csv -->
echo "<div class=\"d-grid gap-2\">";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../inclusoes/6\"; > Inserir Registro</a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../csvs/6\"; > Gerar CSV  </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../xls/6\"; > Gerar Excel  </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../confat/6\"; > Ativar Todos </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../confdt/6\"; >  Desativar Todos </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../conflimp/6\"; > Remover Todos </a> </button>";

echo "<br>";

echo "</div>";
// <!-- fim dos botões -->

echo "<div class=\"row\">";

// <!-- foi separada uma linha só para ele -->
echo "<div class=\"col-sm-12\">";

        // <!-- aqui iniciamos a tabela -->
        echo "<table class=\"table table-secondary table-striped table-hover border border-2 rounded border-dark p-1\">";
        // <!-- aqui criamos o cabeçalho da tabela -->
        // echo "<thead>";
            // <!-- iniciando uma linha para o cabcalho -->
            echo "<tr>";

          echo "<th scope=\"col\">Id</th>";
          echo "<th scope=\"col\">Nome</th>";
          echo "<th scope=\"col\">Horario</th>";
          echo "<th scope=\"col\">Local</th>";
          echo "<th scope=\"col\">Status</th>";
          echo "<th scope=\"col\">Consultar</th>";
          echo "<th scope=\"col\">Alterar</th>";
          echo "<th scope=\"col\">Deletar</th>";
          echo "</tr>";

            // <!-- fechando a linha do cabecalho -->
        // echo "</thead>";
        // <!-- final do cabecalho da tabela -->

        // <!-- aqui appendamos os resultados dos gráficos -->
        // echo "<tbody>";

        // inicio da pesquisa
        while($registro_gincanas = $dados_gincanas->fetch_object()){

            // iniciando uma linha para colocar os resultados
            echo "<tr>";

            // <!-- primeiro campo: nomeequipe  -->
            echo "<td> $registro_gincanas->id_gin</td>";
            // <!-- segundo campo: salaequipe -->
            echo "<td> $registro_gincanas->nome_gin</td>";
            // <!-- terceiro campo: anoequipe -->
            echo "<td> $registro_gincanas->horario_gin</td>";
            // <!-- quarto campo: temaequipe -->
            echo "<td> $registro_gincanas->local_gin</td>";
            // <!-- quarto campo: status -->
            echo "<td>";
                                    if ($registro_gincanas->status_gin == 1) {
                                        echo "<a class=\"text-success\" href=\"../atualizaStatus/$registro_gincanas->id_gin/6/0\">Ativado</a>";

                                    } else {

                                        echo "<a class=\"text-dark\" href=\"../atualizaStatus/$registro_gincanas->id_gin/6/1\">Desativado</a>";
                                    }
            echo "</td>";
            // <!-- quinto campo: Consultar -->
            echo "<td><a href=\"../pesquisadores/6/$registro_gincanas->id_gin\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-search\" viewBox=\"0 0 16 16\">
            <path d=\"M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z\"/>
            </svg></a></td>";
            // <!-- sexto campo: Alterar -->
            echo "<td><a href=\"../alteracoes/6/$registro_gincanas->id_gin\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-pen\" viewBox=\"0 0 16 16\">
            <path d=\"m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z\"/>
            </svg></a></td>";
            // <!-- setimo campo: Excluir -->
            echo "<td><a href=\"../confex/6/$registro_gincanas->id_gin\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-trash-fill\" viewBox=\"0 0 16 16\">
            <path d=\"M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z\"/>
            </svg></a></td>";
          
            echo "</tr>";
            // <!-- fechando a linha de colocar os resultados -->

        }
        // final da pesquisa
            
        // echo "</tbody>";
        // <!-- aqui finalizamos o appender -->

        echo "</table>";
        // <!-- final da tabela criada pelo bootstrap -->

echo "</div>";
echo "</div>";


// <!-- FINAL DO TABELA DE: Gincanas *********************************************************************************************************** --> 
};

echo "<br>"; 
// <!-- espaçamento entre tabelas -->

// verificando se o usuario pode ver esta tabela
if( $id_filtro == 7 && $funcao_usuario == 1){

// <!-- TABELA: Pdfs de regras ************************************************************************************************************************* -->

// echo "<!-- botão para voltar para a página ao topo-->
echo "<button class=\"text-white rounded border border-2 border-white bg-dark\" ><a href=\"#topo\">";
// <!-- icone de voltar -->
echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">
<path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8\"/>
</svg>";
echo "Voltar";
echo "</a></button>";

echo "<br>";
echo "<br>";


// <!-- titulo da primeira tabela-->
echo "<h1 class=\"arq_regras\" style=\"color: white; border: 2px solid white;padding: 2px;text-align: center;background-color: #212529; border-radius: 10px;\"> Tabela de Arquivos de Regras </h1>";

// mostrando a quantidade de linhas 
// mostrando a quantidade de linhas 
echo "<div class=\"row\">";
echo "<div class=\"col-3\">";
echo "<h2> Quantidade de linhas:</h2>";
echo "</div>";
echo "<div class=\"col-1\">";
echo "<h2 style=\"color: red;\">$dados_arqregras->num_rows </h2>";
echo "</div>";
echo "</div>";
echo "<br>";

// <!-- Começo dos botões de ativar registros, desativar registros,excluir todos, gerar csv -->
echo "<div class=\"d-grid gap-2\">";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../inclusoes/7\"; > Inserir Registro</a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../csvs/7\"; > Gerar CSV  </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../xls/7\"; > Gerar Excel  </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../confat/7\"; >Ativar Todos </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../confdt/7\"; >  Desativar Todos </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../conflimp/7\"; > Remover Todos </a> </button>";

echo "<br>";

echo "</div>";
// <!-- fim dos botões -->

echo "<div class=\"row\">";

// <!-- foi separada uma linha só para ele -->
echo "<div class=\"col-sm-12\">";

        // <!-- aqui iniciamos a tabela -->
        echo "<table class=\"table table-secondary table-striped table-hover border border-2 rounded border-dark p-1\">";

        // <!-- aqui criamos o cabeçalho da tabela -->
        // echo "<thead>";
            // <!-- iniciando uma linha para o cabcalho -->
            echo "<tr>";

          echo "<th scope=\"col\">Id do arquivo</th>";       
          echo "<th scope=\"col\">Id da gincana - Nome</th>";
          echo "<th scope=\"col\">Titulo</th>";
          echo "<th scope=\"col\">Arquivo</th>";
          echo "<th scope=\"col\">Status</th>";
          echo "<th scope=\"col\">Consultar</th>";
          echo "<th scope=\"col\">Alterar</th>";
          echo "<th scope=\"col\">Deletar</th>";
          echo "<th scope=\"col\">Download</th>";
          echo "</tr>";

            // <!-- fechando a linha do cabecalho -->
        // echo "</thead>";
        // <!-- final do cabecalho da tabela -->

        // <!-- aqui appendamos os resultados dos gráficos -->
        // echo "<tbody>";

        // inicio da pesquisa
        while($registro_arq_regras = $dados_arqregras->fetch_object()){

            // iniciando uma linha para colocar os resultados
            echo "<tr>";

            // <!-- zero campo: id do arquivo  -->
            echo "<td> $registro_arq_regras->id_pdfregra</td>";

            
            $dados_filgin = $repositorioGincanas->buscarGincana($registro_arq_regras->gincana_id);
            while($registro_filgin = $dados_filgin->fetch_object()){


            // <!-- primeiro campo: id da gincana  -->
            echo "<td> $registro_arq_regras->gincana_id - $registro_filgin->nome_gin</td>";

            }

            // <!-- segundo campo: titulo -->
            echo "<td> $registro_arq_regras->titulo_pdfregra</td>";
            // <!-- segundo campo: status -->
            echo "<td>";
                                    if ($registro_arq_regras->status_pdfregra == 1) {
                                        echo "<a class=\"text-success\" href=\"../atualizaStatus/$registro_arq_regras->id_pdfregra/7/0\">Ativado</a>";

                                    } else {

                                        echo "<a class=\"text-dark\" href=\"../atualizaStatus/$registro_arq_regras->id_pdfregra/7/1\">Desativado</a>";
                                    }
            echo "</td>";
            // <!-- terceiro campo: arquivo -->
            echo "<td> $registro_arq_regras->arquivo_pdfregra</td>";
            // <!-- quarto campo: Consultar -->
            echo "<td><a href=\"../pesquisadores/7/$registro_arq_regras->id_pdfregra\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-search\" viewBox=\"0 0 16 16\">
            <path d=\"M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z\"/>
            </svg></a></td>";
            // <!-- quinto campo: Alterar -->
            echo "<td><a href=\"../alteracoes/7/$registro_arq_regras->id_pdfregra\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-pen\" viewBox=\"0 0 16 16\">
            <path d=\"m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z\"/>
            </svg></a></td>";
            // <!-- sexta campo: Excluir -->
            echo "<td><a href=\"../confex/7/$registro_arq_regras->id_pdfregra\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-trash-fill\" viewBox=\"0 0 16 16\">
            <path d=\"M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z\"/>
            </svg></a></td>";
            // <!-- setimo campo: Download -->
            echo  "            <td><a href=\"frontend/public/pdf/pdf_regras/<?php echo $registro_arq_regras->arquivo_pdfregra;?>\" download=\"arquivo_regra_spf\" >  
                <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-file-earmark-arrow-down-fill\" viewBox=\"0 0 16 16\">
                <path d=\"M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0\"/>
                </svg>
            </a></td>";
            echo "</tr>";
            // <!-- fechando a linha de colocar os resultados -->

        }
        // final da pesquisa
            
        // echo "</tbody>";
        // <!-- aqui finalizamos o appender -->

        echo "</table>";
        // <!-- final da tabela criada pelo bootstrap -->

echo "</div>";
echo "</div>";


// <!-- FINAL DO TABELA DE: Pdfs de regras de avaliação *********************************************************************************************************** --> 
};

echo "<br>"; 
// <!-- espaçamento entre tabelas -->

// verificando se o usuario pode ver esta tabela
if($id_filtro == 8 && $funcao_usuario == 1){

// <!-- TABELA: Pdfs de regras de avaliação ************************************************************************************************************************* -->

// echo "<!-- botão para voltar para a página ao topo-->
echo "<button class=\"text-white rounded border border-2 border-white bg-dark\" ><a href=\"#topo\">";
// <!-- icone de voltar -->
echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">
<path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8\"/>
</svg>";
echo "Voltar";
echo "</a></button>";

echo "<br>";
echo "<br>";


// <!-- titulo da primeira tabela-->
echo "<h1 class=\"arq_avaliativos\" style=\"color: white; border: 2px solid white;padding: 2px;text-align: center;background-color: #212529; border-radius: 10px;\"> Tabela de Arquivos de Regras de Avaliação </h1>";

// mostrando a quantidade de linhas 
// mostrando a quantidade de linhas 
echo "<div class=\"row\">";
echo "<div class=\"col-3\">";
echo "<h2> Quantidade de linhas:</h2>";
echo "</div>";
echo "<div class=\"col-1\">";
echo "<h2 style=\"color: red;\">$dados_arqavaliativo->num_rows </h2>";
echo "</div>";
echo "</div>";
echo "<br>";

// <!-- Começo dos botões de ativar registros, desativar registros,excluir todos, gerar csv -->
echo "<div class=\"d-grid gap-2\">";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../inclusoes/8\"; > Inserir Registro</a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../csvs/8\"; > Gerar CSV  </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../xls/8\"; > Gerar Excel  </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../confat/8\"; > Ativar Todos </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../confdt/8\"; >  Desativar Todos </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../conflimp/8\"; > Remover Todos </a> </button>";

echo "<br>";

echo "</div>";
// <!-- fim dos botões -->

echo "<div class=\"row\">";

// <!-- foi separada uma linha só para ele -->
echo "<div class=\"col-sm-12\">";

        // <!-- aqui iniciamos a tabela -->
        echo "<table class=\"table table-secondary table-striped table-hover border border-2 rounded border-dark p-1\">";

        // <!-- aqui criamos o cabeçalho da tabela -->
        // echo "<thead>";
            // <!-- iniciando uma linha para o cabcalho -->
            echo "<tr>";

          echo "<th scope=\"col\">Id do arquivo</th>";       
          echo "<th scope=\"col\">Id da gincana - Nome</th>";
          echo "<th scope=\"col\">Titulo</th>";
          echo "<th scope=\"col\">Arquivo</th>";
          echo "<th scope=\"col\">Status</th>";
          echo "<th scope=\"col\">Consultar</th>";
          echo "<th scope=\"col\">Alterar</th>";
          echo "<th scope=\"col\">Deletar</th>";
          echo "<th scope=\"col\">Download</th>";
          echo "</tr>";

            // <!-- fechando a linha do cabecalho -->
        // echo "</thead>";
        // <!-- final do cabecalho da tabela -->

        // <!-- aqui appendamos os resultados dos gráficos -->
        // echo "<tbody>";

        // inicio da pesquisa
        while($registro_arq_avaliativo = $dados_arqavaliativo->fetch_object()){

            // iniciando uma linha para colocar os resultados
            echo "<tr>";

            // <!-- zero campo: id da gincana  -->
            echo "<td> $registro_arq_avaliativo->id_pdfavaliativo</td>";

            $dados_filgin = $repositorioGincanas->buscarGincana($registro_arq_avaliativo->gincana_id);
            while($registro_filgin = $dados_filgin->fetch_object()){


            // <!-- primeiro campo: id da gincana  -->
            echo "<td> $registro_arq_avaliativo->gincana_id - $registro_filgin->nome_gin</td>";

            }
            // <!-- segundo campo: titulo -->
            echo "<td> $registro_arq_avaliativo->titulo_pdfavaliativo</td>";
            // <!-- terceiro campo: arquivo -->
            echo "<td> $registro_arq_avaliativo->arquivo_pdfavaliativo</td>";
            // <!-- terceiro campo: status -->
            echo "<td>";
                                    if ($registro_arq_avaliativo->status_pdfavaliativo == 1) {
                                        echo "<a class=\"text-success\" href=\"../atualizaStatus/$registro_arq_avaliativo->id_pdfavaliativo/8/0\">Ativado</a>";

                                    } else {

                                        echo "<a class=\"text-dark\" href=\"../atualizaStatus/$registro_arq_avaliativo->id_pdfavaliativo/8/1\">Desativado</a>";
                                    }
            echo "</td>";
            // <!-- quarto campo: Consultar -->
            echo "<td><a href=\"../pesquisadores/8/$registro_arq_avaliativo->id_pdfavaliativo\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-search\" viewBox=\"0 0 16 16\">
            <path d=\"M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z\"/>
            </svg></a></td>";
            // <!-- quinto campo: Alterar -->
            echo "<td><a href=\"../alteracoes/8/$registro_arq_avaliativo->id_pdfavaliativo\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-pen\" viewBox=\"0 0 16 16\">
            <path d=\"m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z\"/>
            </svg></a></td>";
            // <!-- sexta campo: Excluir -->
            echo "<td><a href=\"../confex/8/$registro_arq_avaliativo->id_pdfavaliativo\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-trash-fill\" viewBox=\"0 0 16 16\">
            <path d=\"M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z\"/>
            </svg></a></td>";
            // <!-- setimo campo: Download -->
            echo  "            <td><a href=\"frontend/public/pdf/pdf_regras/<?php echo $registro_arq_avaliativo->arquivo_pdfavaliativo;?>\" download=\"arquivo_avaliativo_spf\" >  
                <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-file-earmark-arrow-down-fill\" viewBox=\"0 0 16 16\">
                <path d=\"M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0\"/>
                </svg>
            </a></td>";
          
            echo "</tr>";
            // <!-- fechando a linha de colocar os resultados -->

        }
        // final da pesquisa
            
        // echo "</tbody>";
        // <!-- aqui finalizamos o appender -->

        echo "</table>";
        // <!-- final da tabela criada pelo bootstrap -->

echo "</div>";
echo "</div>";


// <!-- FINAL DO TABELA DE: Pdfs de regras de avalaiação *********************************************************************************************************** --> 
};

echo "<br>"; 
// <!-- espaçamento entre tabelas -->

// verificando se o usuario pode ver esta tabela
if( $id_filtro == 9 && $funcao_usuario == 1){

// <!-- TABELA: Históricos ************************************************************************************************************************* -->

// echo "<!-- botão para voltar para a página ao topo-->
echo "<button class=\"text-white rounded border border-2 border-white bg-dark\" ><a href=\"#topo\">";
// <!-- icone de voltar -->
echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">
<path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8\"/>
</svg>";
echo "Voltar";
echo "</a></button>";

echo "<br>";
echo "<br>";


// <!-- titulo da primeira tabela-->
echo "<h1 class=\"historicos\" style=\"color: white; border: 2px solid white;padding: 2px;text-align: center;background-color: #212529; border-radius: 10px;\"> Tabela de Históricos </h1>";

// mostrando a quantidade de linhas 
// mostrando a quantidade de linhas 
echo "<div class=\"row\">";
echo "<div class=\"col-3\">";
echo "<h2> Quantidade de linhas:</h2>";
echo "</div>";
echo "<div class=\"col-1\">";
echo "<h2 style=\"color: red;\">$dados_historicos->num_rows </h2>";
echo "</div>";
echo "</div>";
echo "<br>";

// <!-- Começo dos botões de ativar registros, desativar registros,excluir todos, gerar csv -->
echo "<div class=\"d-grid gap-2\">";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../inclusoes/9\"; > Inserir Registro</a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../csvs/9\"; > Gerar CSV  </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../xls/9\"; > Gerar Excel  </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../confat/9\"; > Ativar Todos </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../confdt/9\"; >  Desativar Todos </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../conflimp/9\"; > Remover Todos </a> </button>";

echo "<br>";

echo "</div>";
// <!-- fim dos botões -->

echo "<div class=\"row\">";

// <!-- foi separada uma linha só para ele -->
echo "<div class=\"col-sm-12\">";

echo "<table class=\"table table-secondary table-striped table-hover border border-2 rounded border-dark p-1\">";
        // <!-- aqui criamos o cabeçalho da tabela -->
        // echo "<thead>";
            // <!-- iniciando uma linha para o cabcalho -->
            echo "<tr>";

          echo "<th scope=\"col\">id</th>";
          echo "<th scope=\"col\">Ano</th>";
          echo "<th scope=\"col\">Tema</th>";
          echo "<th scope=\"col\">Melhor Gincana</th>";
          echo "<th scope=\"col\">Status</th>";
          echo "<th scope=\"col\">Consultar</th>";
          echo "<th scope=\"col\">Alterar</th>";
          echo "<th scope=\"col\">Deletar</th>";
          echo "</tr>";

            // <!-- fechando a linha do cabecalho -->
        // echo "</thead>";
        // <!-- final do cabecalho da tabela -->

        // <!-- aqui appendamos os resultados dos gráficos -->
        // echo "<tbody>";

        // inicio da pesquisa
        while($registro_historicos = $dados_historicos->fetch_object()){

            // iniciando uma linha para colocar os resultados
            echo "<tr>";

            // <!-- zero campo: id do historico  -->
            echo "<td> $registro_historicos->id_hist</td>";
            // <!-- primeiro campo: ano  -->
            echo "<td> $registro_historicos->ano_hist</td>";
            // <!-- segundo campo: tema -->
            echo "<td> $registro_historicos->tema_hist</td>";
            // <!-- terceiro campo: melhor_gincana -->
            echo "<td> $registro_historicos->melhor_gincana</td>";
            // <!-- terceiro campo: status -->
            echo "<td>";
                                    if ($registro_historicos->status_hist == 1) {
                                        echo "<a class=\"text-success\" href=\"../atualizaStatus/$registro_historicos->id_hist/9/0\">Ativado</a>";

                                    } else {

                                        echo "<a class=\"text-dark\" href=\"../atualizaStatus/$registro_historicos->id_hist/9/1\">Desativado</a>";
                                    }
            echo "</td>";
            // <!-- quarto campo: Consultar -->
            echo "<td><a href=\"../pesquisadores/9/$registro_historicos->id_hist\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-search\" viewBox=\"0 0 16 16\">
            <path d=\"M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z\"/>
            </svg></a></td>";
            // <!-- quinto campo: Alterar -->
            echo "<td><a href=\"../alteracoes/9/$registro_historicos->id_hist\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-pen\" viewBox=\"0 0 16 16\">
            <path d=\"m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z\"/>
            </svg></a></td>";
            // <!-- sexta campo: Excluir -->
            echo "<td><a href=\"../confex/9/$registro_historicos->id_hist\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-trash-fill\" viewBox=\"0 0 16 16\">
            <path d=\"M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z\"/>
            </svg></a></td>";
          
            echo "</tr>";
            // <!-- fechando a linha de colocar os resultados -->

        }
        // final da pesquisa
            
        // echo "</tbody>";
        // <!-- aqui finalizamos o appender -->

        echo "</table>";
        // <!-- final da tabela criada pelo bootstrap -->

echo "</div>";
echo "</div>";


// <!-- FINAL DO TABELA DE: Historicos *********************************************************************************************************** --> 
};

echo "<br>"; 
// <!-- espaçamento entre tabelas -->

// verificando se o usuario pode ver esta tabela
if( $id_filtro == 10 && $funcao_usuario == 1){

// <!-- TABELA: Temas ************************************************************************************************************************* -->

// echo "<!-- botão para voltar para a página ao topo-->
echo "<button class=\"text-white rounded border border-2 border-white bg-dark\" ><a href=\"#topo\">";
// <!-- icone de voltar -->
echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">
<path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8\"/>
</svg>";
echo "Voltar";
echo "</a></button>";

echo "<br>";
echo "<br>";

// <!-- titulo da primeira tabela-->
echo "<h1 class=\"temas\" style=\"color: white; border: 2px solid white;padding: 2px;text-align: center;background-color: #212529; border-radius: 10px;\"> Tabela de Temas </h1>";

// mostrando a quantidade de linhas 
// mostrando a quantidade de linhas 
echo "<div class=\"row\">";
echo "<div class=\"col-3\">";
echo "<h2> Quantidade de linhas:</h2>";
echo "</div>";
echo "<div class=\"col-1\">";
echo "<h2 style=\"color: red;\">$dados_temas->num_rows </h2>";
echo "</div>";
echo "</div>";
echo "<br>";

// <!-- Começo dos botões de ativar registros, desativar registros,excluir todos, gerar csv -->
echo "<div class=\"d-grid gap-2\">";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../inclusoes/10\"; > Inserir Registro</a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../csvs/10\"; > Gerar CSV  </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../xls/10\"; > Gerar Excel  </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../confat/10\"; > Ativar Todos </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../confdt/10\"; >  Desativar Todos </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../conflimp/10\"; > Remover Todos </a> </button>";

echo "<br>";

echo "</div>";
// <!-- fim dos botões -->

echo "<div class=\"row\">";

// <!-- foi separada uma linha só para ele -->
echo "<div class=\"col-sm-12\">";

        // <!-- aqui iniciamos a tabela -->
        echo "<table class=\"table table-secondary table-striped table-hover border border-2 rounded border-dark p-1\">";

        // <!-- aqui criamos o cabeçalho da tabela -->
        // echo "<thead>";
            // <!-- iniciando uma linha para o cabcalho -->
            echo "<tr>";

          echo "<th scope=\"col\">Id do tema</th>";
          echo "<th scope=\"col\">Tema</th>";
          echo "<th scope=\"col\">Primeiro Uso</th>";
          echo "<th scope=\"col\">Status</th>";
          echo "<th scope=\"col\">Consultar</th>";
          echo "<th scope=\"col\">Alterar</th>";
          echo "<th scope=\"col\">Deletar</th>";
          echo "</tr>";

            // <!-- fechando a linha do cabecalho -->
        // echo "</thead>";
        // <!-- final do cabecalho da tabela -->

        // <!-- aqui appendamos os resultados dos gráficos -->
        // echo "<tbody>";

        // inicio da pesquisa
        while($registro_temas = $dados_temas->fetch_object()){

            // iniciando uma linha para colocar os resultados
            echo "<tr>";

            // <!-- primeiro campo: id do tema  -->
            echo "<td> $registro_temas->id_tema</td>";
            // <!-- segundo campo: tema -->
            echo "<td> $registro_temas->tema_tm</td>";
            // <!-- terceiro campo: primeirouso -->
            echo "<td> $registro_temas->primeiro_ano</td>";
            // <!-- terceiro campo: status -->
            echo "<td>";
                                    if ($registro_temas->status_tm == 1) {
                                        echo "<a class=\"text-success\" href=\"../atualizaStatus/$registro_temas->id_tema/10/0\">Ativado</a>";

                                    } else {

                                        echo "<a class=\"text-dark\" href=\"../atualizaStatus/$registro_temas->id_tema/10/1\">Desativado</a>";
                                    }
            echo "</td>";
            // <!-- quarto campo: Consultar -->
            echo "<td><a href=\"../pesquisadores/10/$registro_temas->id_tema\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-search\" viewBox=\"0 0 16 16\">
            <path d=\"M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z\"/>
            </svg></a></td>";
            // <!-- quinto campo: Alterar -->
            echo "<td><a href=\"../alteracoes/10/$registro_temas->id_tema\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-pen\" viewBox=\"0 0 16 16\">
            <path d=\"m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z\"/>
            </svg></a></td>";
            // <!-- sexta campo: Excluir -->
            echo "<td><a href=\"../confex/10/$registro_temas->id_tema\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-trash-fill\" viewBox=\"0 0 16 16\">
            <path d=\"M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z\"/>
            </svg></a></td>";
          
            echo "</tr>";
            // <!-- fechando a linha de colocar os resultados -->

        }
        // final da pesquisa
            
        // echo "</tbody>";
        // <!-- aqui finalizamos o appender -->

        echo "</table>";
        // <!-- final da tabela criada pelo bootstrap -->

echo "</div>";
echo "</div>";


// <!-- FINAL DO TABELA DE: Temas *********************************************************************************************************** --> 
};


echo "<br>"; 
// <!-- espaçamento entre tabelas -->

// verificando se o usuario pode ver esta tabela
if($id_filtro == 11 && $funcao_usuario == 1){

// <!-- TABELA: Usuarios ************************************************************************************************************************* -->

// echo "<!-- botão para voltar para a página ao topo-->
echo "<button class=\"text-white rounded border border-2 border-white bg-dark\" ><a href=\"#topo\">";
// <!-- icone de voltar -->
echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">
<path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8\"/>
</svg>";
echo "Voltar";
echo "</a></button>";

echo "<br>";
echo "<br>";

// <!-- titulo da primeira tabela-->
echo "<h1 class=\"usuarios\" style=\"color: white; border: 2px solid white;padding: 2px;text-align: center;background-color: #212529; border-radius: 10px;\"> Tabela de Usuarios </h1>";

// mostrando a quantidade de linhas 
// mostrando a quantidade de linhas 
echo "<div class=\"row\">";
echo "<div class=\"col-3\">";
echo "<h2> Quantidade de linhas:</h2>";
echo "</div>";
echo "<div class=\"col-1\">";
echo "<h2 style=\"color: red;\">$dados_usuarios->num_rows </h2>";
echo "</div>";
echo "</div>";
echo "<br>";

// <!-- Começo dos botões de ativar registros, desativar registros,excluir todos, gerar csv -->
echo "<div class=\"d-grid gap-2\">";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../inclusoes/11\"; > Inserir Registro</a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../csvs/11\"; > Gerar CSV  </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../xls/11\"; > Gerar Excel  </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../confat/11\"; > Ativar Todos </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../confdt/11\"; >  Desativar Todos </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../conflimp/11\"; > Remover Todos </a> </button>";

echo "<br>";

echo "</div>";
// <!-- fim dos botões -->

echo "<div class=\"row\">";

// <!-- foi separada uma linha só para ele -->
echo "<div class=\"col-sm-12\">";

        // <!-- aqui iniciamos a tabela -->
        echo "<table class=\"table table-secondary table-striped table-hover border border-2 rounded border-dark p-1\">";

        // <!-- aqui criamos o cabeçalho da tabela -->
        // echo "<thead>";
            // <!-- iniciando uma linha para o cabcalho -->
            echo "<tr>";

          echo "<th scope=\"col\">Id do usuario</th>";
          echo "<th scope=\"col\">Nome</th>";
          echo "<th scope=\"col\">Email</th>";
          echo "<th scope=\"col\">Função</th>";
          echo "<th scope=\"col\">Função no evento</th>";
          echo "<th scope=\"col\">Status</th>";
          echo "<th scope=\"col\">Consultar</th>";
          echo "<th scope=\"col\">Alterar</th>";
          echo "<th scope=\"col\">Deletar</th>";
          echo "</tr>";

            // <!-- fechando a linha do cabecalho -->
        // echo "</thead>";
        // <!-- final do cabecalho da tabela -->

        // <!-- aqui appendamos os resultados dos gráficos -->
        // echo "<tbody>";

        // inicio da pesquisa
        while($registro_usuarios = $dados_usuarios->fetch_object()){

            // iniciando uma linha para colocar os resultados
            echo "<tr>";

            // <!-- primeiro campo: id do usuario  -->
            echo "<td> $registro_usuarios->id_us</td>";
            // <!-- segundo campo: nome -->
            echo "<td> $registro_usuarios->nome_us</td>";
            // <!-- terceiro campo: email -->
            echo "<td> $registro_usuarios->email_us</td>";
            // <!-- quarto campo: funcao -->
            echo "<td>";
            if ($registro_usuarios->funcao_us == 1) {
               echo  "<a class=\"text-success\" href=\"atualizaTipo/$registro_usuarios->id_us/0\">Administrador(a)</a>";
            } else {
                echo "<a class=\"text-dark\" href=\"atualizaTipo/$registro_usuarios->id_us/1\">Avaliador(a)</a>";
            }
            echo "</td>";
            // <!-- quinto campo: funcao no evento -->
            echo "<td> $registro_usuarios->funcao_no_evento</td>";
            // <!-- quinto campo: status -->
            echo "<td>";
                                    if ($registro_usuarios->status_us == 1) {
                                        echo "<a class=\"text-success\" href=\"../atualizaStatus/$registro_usuarios->id_us/11/0\">Ativado</a>";

                                    } else {

                                        echo "<a class=\"text-dark\" href=\"../atualizaStatus/$registro_usuarios->id_us/11/1\">Desativado</a>";
                                    }
            echo "</td>";
            // <!-- sexto campo: Consultar -->
            echo "<td><a href=\"../pesquisadores/11/$registro_usuarios->id_us\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-search\" viewBox=\"0 0 16 16\">
            <path d=\"M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z\"/>
            </svg></a></td>";
            // <!-- setimo campo: Alterar -->
            echo "<td><a href=\"../alteracoes/11/$registro_usuarios->id_us\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-pen\" viewBox=\"0 0 16 16\">
            <path d=\"m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z\"/>
            </svg></a></td>";
            // <!-- oitavo campo: Excluir -->
            echo "<td><a href=\"../confex/11/$registro_usuarios->id_us\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-trash-fill\" viewBox=\"0 0 16 16\">
            <path d=\"M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z\"/>
            </svg></a></td>";
          
            echo "</tr>";
            // <!-- fechando a linha de colocar os resultados -->

        }
        // final da pesquisa
            
        // echo "</tbody>";
        // <!-- aqui finalizamos o appender -->

        echo "</table>";
        // <!-- final da tabela criada pelo bootstrap -->

echo "</div>";
echo "</div>";


// <!-- FINAL DO TABELA DE: Usuarios *********************************************************************************************************** --> 
};

// verificando se o usuario pode ver esta tabela
if( $id_filtro == 12 && $funcao_usuario == 1){

    // <!-- FINAL DO REDIREIONAMENTO DE: Logs ************************************************************************************************************************* -->
    
// Código PHP
// Suponha que você tenha lógica para decidir para onde redirecionar

// Defina o URL de destino
$redirectUrl = '../logsY';

// Gera a resposta HTML com a meta tag para redirecionamento
echo '<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="0;url=' . htmlspecialchars($redirectUrl) . '">
    <title>Redirecionando...</title>
</head>
<body>
    <p>Você está sendo redirecionado. Caso não seja redirecionado automaticamente, <a href="' . htmlspecialchars($redirectUrl) . '">clique aqui</a>.</p>
</body>
</html>';

    
    // <!-- FINAL DO REDIREIONAMENTO DE: Logs *********************************************************************************************************** --> 
    };

    if( $id_filtro == 13 && $funcao_usuario == 1){

  
// <!-- TABELA: Usuarios ************************************************************************************************************************* -->

// echo "<!-- botão para voltar para a página ao topo-->
echo "<button class=\"text-white rounded border border-2 border-white bg-dark\" ><a href=\"#topo\">";
// <!-- icone de voltar -->
echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">
<path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8\"/>
</svg>";
echo "Voltar";
echo "</a></button>";

echo "<br>";
echo "<br>";

// <!-- titulo da primeira tabela-->
echo "<h1 class=\"usuarios\" style=\"color: white; border: 2px solid white;padding: 2px;text-align: center;background-color: #212529; border-radius: 10px;\"> Tabela de Carrosel </h1>";

// mostrando a quantidade de linhas 
// mostrando a quantidade de linhas 
echo "<div class=\"row\">";
echo "<div class=\"col-3\">";
echo "<h2> Quantidade de linhas:</h2>";
echo "</div>";
echo "<div class=\"col-1\">";
echo "<h2 style=\"color: red;\">$dados_carrosel->num_rows </h2>";
echo "</div>";
echo "</div>";
echo "<br>";

// <!-- Começo dos botões de ativar registros, desativar registros,excluir todos, gerar csv -->
echo "<div class=\"d-grid gap-2\">";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../inclusoes/23\"; > Inserir Registro</a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../csvs/12\"; > Gerar CSV  </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../xls/12\"; > Gerar Excel  </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../confat/12\"; > Ativar Todos </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../confdt/12\"; >  Desativar Todos </a> </button>";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../conflimp/12\"; > Remover Todos </a> </button>";

echo "<br>";

echo "</div>";
// <!-- fim dos botões -->

echo "<div class=\"row\">";

// <!-- foi separada uma linha só para ele -->
echo "<div class=\"col-sm-12\">";

        // <!-- aqui iniciamos a tabela -->
        echo "<table class=\"table table-secondary table-striped table-hover border border-2 rounded border-dark p-1\">";

        // <!-- aqui criamos o cabeçalho da tabela -->
        // echo "<thead>";
            // <!-- iniciando uma linha para o cabcalho -->
            echo "<tr>";

          echo "<th scope=\"col\">Id</th>";
          echo "<th scope=\"col\">Titulo</th>";
          echo "<th scope=\"col\">Ordem</th>";
          echo "<th scope=\"col\">Arquivo</th>";
          echo "<th scope=\"col\">Data</th>";
          echo "<th scope=\"col\">Status</th>";
          echo "<th scope=\"col\">Consultar</th>";
          echo "<th scope=\"col\">Alterar</th>";
          echo "<th scope=\"col\">Deletar</th>";
          echo "</tr>";

            // <!-- fechando a linha do cabecalho -->
        // echo "</thead>";
        // <!-- final do cabecalho da tabela -->

        // <!-- aqui appendamos os resultados dos gráficos -->
        // echo "<tbody>";

        // inicio da pesquisa
        while($registro_carrosel = $dados_carrosel->fetch_object()){

            // iniciando uma linha para colocar os resultados
            echo "<tr>";

            // <!-- primeiro campo: id do usuario  -->
            echo "<td> $registro_carrosel->id_cs</td>";
            // <!-- segundo campo: nome -->
            echo "<td> $registro_carrosel->titulo_cs</td>";
            // <!-- terceiro campo: email -->
            echo "<td> $registro_carrosel->ordem_cs</td>";
            // <!-- quarto campo: funcao -->
            echo "<td> $registro_carrosel->arquivo_cs</td>";
            // <!-- quinto campo: funcao no evento -->
            echo "<td> $registro_carrosel->data_cs</td>";
            // <!-- quinto campo: status -->
            echo "<td>";
                                    if ($registro_carrosel->status_cs == 1) {
                                        echo "<a class=\"text-success\" href=\"../atualizaStatus/$registro_carrosel->id_cs/12/0\">Ativado</a>";

                                    } else {

                                        echo "<a class=\"text-dark\" href=\"../atualizaStatus/$registro_carrosel->id_cs/12/1\">Desativado</a>";
                                    }
            echo "</td>";
            // <!-- sexto campo: Consultar -->
            echo "<td><a href=\"../pesquisadores/12/$registro_carrosel->id_cs\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-search\" viewBox=\"0 0 16 16\">
            <path d=\"M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z\"/>
            </svg></a></td>";
            // <!-- setimo campo: Alterar -->
            echo "<td><a href=\"../alteracoes/24/$registro_carrosel->id_cs\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-pen\" viewBox=\"0 0 16 16\">
            <path d=\"m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z\"/>
            </svg></a></td>";
            // <!-- oitavo campo: Excluir -->
            echo "<td><a href=\"../confex/12/$registro_carrosel->id_cs\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-trash-fill\" viewBox=\"0 0 16 16\">
            <path d=\"M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z\"/>
            </svg></a></td>";
          
            echo "</tr>";
            // <!-- fechando a linha de colocar os resultados -->

        }
        // final da pesquisa
            
        // echo "</tbody>";
        // <!-- aqui finalizamos o appender -->

        echo "</table>";
        // <!-- final da tabela criada pelo bootstrap -->

echo "</div>";
echo "</div>";


// <!-- FINAL DO TABELA DE: Usuarios *********************************************************************************************************** --> 
};

        if( $id_filtro == 14 && $funcao_usuario == 1){

// <!-- TABELA: Usuarios ************************************************************************************************************************* -->

// echo "<!-- botão para voltar para a página ao topo-->
echo "<button class=\"text-white rounded border border-2 border-white bg-dark\" ><a href=\"#topo\">";
// <!-- icone de voltar -->
echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">
<path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8\"/>
</svg>";
echo "Voltar";
echo "</a></button>";

echo "<br>";
echo "<br>";

// <!-- titulo da primeira tabela-->
echo "<h1 class=\"Logo\"> Alterar Logo </h1>";

// <!-- Começo dos botões de ativar registros, desativar registros,excluir todos, gerar csv -->
echo "<div class=\"d-grid gap-2\">";

echo "  <button class=\"btn btn-dark\" type=\"button\"> <a href=\"../alteracoes/25/1\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-pen\" viewBox=\"0 0 16 16\">
            <path d=\"m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z\"/>
            </svg></a> </button>";

echo "</div>";
// <!-- fim dos botões -->

        }
        // final da pesquisa

echo "</div>";
echo "</div>";


if( $id_filtro == 15 && $funcao_usuario == 1){

    error_reporting(0);

    echo "<p>Exportando o banco de dados SFP normal: </p>";
    $repositorioLogs->BACUKP_DATABASES('localhost','root','','bd_spf');

    echo "<br>";

    echo "<p>Exportando o banco de dados de LOGS do SPF: </p>";
    $repositorioLogs->BACUKP_DATABASES('localhost', 'root','','bd_logs_spf');



            }
            // final da pesquisa
    
        }
    // chave fechando o isset botão confirma

        // <!-- final do php Geral-->
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

    <?php
    if(!isset($id_filtro)){
        ?>

    <a href="./sendemail" class="btn btn-dark">Entrar em contato com os administradores</a>

        <?php
    }else{
        ?>
    <a href="../sendemail" class="btn btn-dark">Entrar em contato com os administradores</a>
<?php
    }
        ?>

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