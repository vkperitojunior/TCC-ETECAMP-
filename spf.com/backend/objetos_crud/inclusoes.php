<?php 
// começo do php do head

require_once 'autoload.php';

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
require_once 'backend/objetos/class_IRepositorioImg_graf.php';

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

// Chame a função autoload para incluir as páginas
page_autoloader($pages);

// link qe vai para a classe php com todos os links e conexões
include_once 'backend/objetos/class_IRepositorioEquipes.php';

// link qe vai para o protetor
include_once 'backend/conexao/script/protect.php';

$id_include = isset($id) ? $id : null;

// echo $id_include;

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
    <title>inserir_registro</title>
    
    <?php
    // pesquisa da logo e colocação da mesma
    $dados_logo = $repositorioLogo->buscarLogo(1);
    while($registro_logo = $dados_logo->fetch_object()){
    if(!isset($id_filtro)){
    ?>
    <!-- icone do website -->
    <link rel="icon" href="../frontend/public/imagens/logo/<?php echo $registro_logo->arquivo_lg ?>" alt="Logo">
    <?php
    }
    }   
    ?>


    <!-- definições de estilo geral -->
   


    <!-- Arquivos de css do bootstrap -->
    <link href="../frontend/public/bootstrap/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet" 
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
      <img src="../frontend/public/imagens/logo/<?php echo $registro_logo->arquivo_lg?>" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
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


        echo "<a class=\"nav-link text-white\" href=\"../../logout\">Logout</a>";
        echo "<a class=\"nav-link text-white\" href=\"../../alt_perf\">Alterar perfil</a>";

    
        // verifica se ele esta dentro dos parametros e mostra seu nome e cargo de acordo com o correto
        }elseif($funcao_usuario == 1){

        echo "<a class=\"nav-link text-white\" href=\"../../logout\">Logout</a>";
        echo "<a class=\"nav-link text-white\" href=\"../../alt_perf\">Alterar perfil</a>";

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
    <a class="nav-link text-white" href="../../">Home</a>
    </li>
<!-- link para a página do sobre -->
    <li class="nav-item  mt-4">
        <a class="nav-link text-white " href="../../sobre">Sobre</a>
    </li>
<!-- link para a página dos historicos -->
    <li class="nav-item  mt-4">
        <a class="nav-link text-white " href="../../historicos">Históricos</a>
    </li>
<!-- link para a página das regras -->
<li class="nav-item  mt-4">
        <a class="nav-link text-white " href="../../regras">Regras</a>
    </li>
<!-- link para a página das gincanas -->
    <li class="nav-item  mt-4">
        <a class="nav-link text-white " href="../../gincanas">Gincanas</a>
    </li>
<!-- link para a pagina das pontuações -->
    <li class="nav-item  mt-4">
        <a class="nav-link text-white " href="../../pontuacoes">Pontuaçoes</a>
    </li>
<!-- link para a página das noticias -->
    <li class="nav-item  mt-4">
        <a class="nav-link text-white " href="../../noticias">Noticias</a>
    </li>
<!-- link para a pagina das fotos -->
    <li class="nav-item  mt-4">
        <a class="nav-link text-white " href="../../fotos">Fotos</a>
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
        echo "<a class=\"nav-link active text-white   mt-4\" href=\"../../administrativo\">Administração</a>";
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

    if($id_include == 1){
    

// <!-- Começo da caixa de incluir no css -->
echo "<div id=\"incluir\">";

    // <!-- titulo da caixa de incluir -->
    

echo "<br>";
echo "<h2>Registro pontos por equipe: </h2>";
echo "<br>";

// <!-- começo do formulário -->
echo "    <form class=\"mx-auto\" action=\"../inclusoes/12\" method=\"POST\" style=\"width: 400px;\">";

// <!-- campo do id -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputId\" name=\"id\" aria-describedby=\"idHelp\">";

// <!-- campo de Id da equipe -->
echo "<div class=\"mb-3\">";
echo "<label for=\"exampleInputEmail1\" class=\"form-label\"> Selecionar equipe </label>";
echo "<br>";
echo "<select name=\"idequipe\">";
echo "<option value=\"0\"></option>";

// Abrindo o meio de coleta dos dados
while($registro_equipe = $dados_equipes->fetch_object()){
    
echo "<option value=\"$registro_equipe->id_eq\">$registro_equipe->nome_eq</option>";

}
echo "</select>";
echo "</div>";

//  // <!-- campo de ranking -->
// echo "    <div class=\"mb-3\">";
// echo "    <label for=\"exampleInput\" class=\"form-label\">Ranking da equipe</label>";
// echo "    <input type=\"number\" class=\"form-control\" id=\"exampleInput\" name=\"ranking\" aria-describedby=\"rankingHelp\">";
// echo "    </div>";

 // <!-- campo de observacoes -->
 echo "    <div class=\"mb-3\">";
 echo "    <label for=\"exampleInput\" class=\"form-label\">Observações</label>";
 echo "    <input type=\"text\" class=\"form-control\" id=\"exampleInput\" name=\"obss\" aria-describedby=\"obsHelp\" placeholder=\"Explicações, comentarios e justificativas\">";
 echo "    </div>";
 
  // <!-- campo de status -->
  echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputStatus\" value=\"1\" name=\"status\" aria-describedby=\"statusHelp\">";

  // <!-- botão para enviar informações do formulário -->
echo "    <button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">Inserir</button>";

  // <!-- fim do formulário -->
echo "    </form>";
    
echo "    <br>";

// <!-- fim da div de formulário -->
echo "</div>";

    }elseif($id_include == 2){

        
        
// <!-- Começo da caixa de incluir no css -->
echo "<div id=\"incluir\">";

// <!-- titulo da caixa de incluir -->


echo "<br>";
echo "<h2>Registro pontos por atividade: </h2>";
echo "<br>";

// <!-- começo do formulário -->
echo "    <form class=\"mx-auto\" action=\"../inclusoes/13\"  method=\"POST\" style=\"width: 400px;\">";

// <!-- campo do id -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputId\"  name=\"id\" aria-describedby=\"idHelp\">";

// <!-- campo de Id da equipe -->
echo "<div class=\"mb-3\">";
echo "<label for=\"exampleInputEmail1\" class=\"form-label\"> Selecionar equipe </label>";
echo "<br>";
echo "<select name=\"idequipe\">";
echo "<option value=\"0\"></option>";

// Abrindo o meio de coleta dos dados
while($registro_equipe = $dados_equipes->fetch_object()){
    
echo "<option value=\"$registro_equipe->id_eq\">$registro_equipe->nome_eq</option>";

}
echo "</select>";
echo "</div>";

// <!-- campo de Id da gincana -->
echo "<div class=\"mb-3\">";
echo "<label for=\"exampleInputEmail1\" class=\"form-label\"> Selecionar gincana </label>";
echo "<br>";
echo "<select name=\"idgincana\">";
echo "<option value=\"0\"></option>";

// Abrindo o meio de coleta dos dados
while($registro_gincana = $dados_gincanas->fetch_object()){
    
echo "<option value=\"$registro_gincana->id_gin\">$registro_gincana->nome_gin </option>";

}
echo "</select>";
echo "</div>";

// <!-- campo do criterio 1 -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputIdgincana\" class=\"form-label\">Critério 1</label>";
echo "    <input type=\"number\" required class=\"form-control\" id=\"exampleInput\" name=\"crie1\" aria-describedby=\"idequipeHelp\" placeholder=\"9\">";
echo "    </div>";


// <!-- campo do criterio 2 -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputIdgincana\" class=\"form-label\">Critério 2</label>";
echo "    <input type=\"number\" required class=\"form-control\" id=\"exampleInput\" name=\"crie2\" aria-describedby=\"idequipeHelp\" placeholder=\"10\">";
echo "    </div>";


// <!-- campo do criterio 3 -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputIdgincana\" class=\"form-label\">Critério 3</label>";
echo "    <input type=\"number\" required class=\"form-control\" id=\"exampleInput\"name=\"crie3\" aria-describedby=\"idequipeHelp\" placeholder=\"8\">";
echo "    </div>";

// <!-- campo do dia da pontuação -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputPontdia\" class=\"form-label\">Dia da pontuação</label>";
echo "    <input type=\"date\" required class=\"form-control\" id=\"exampleInput\" name=\"diapontpg\" aria-describedby=\"idequipeHelp\" placeholder=\"Veja na tabela de gincanas\">";
echo "    </div>";


// <!-- campo de observacoes -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInput\" class=\"form-label\">Observações</label>";
echo "    <input type=\"text\" class=\"form-control\" id=\"exampleInput\" name=\"obss\" aria-describedby=\"obsHelp\" placeholder=\"Explicações, comentarios e justificativas\">";
echo "    </div>";

// <!-- campo de status -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputStatus\" value=\"1\" name=\"status\" aria-describedby=\"statusHelp\">";

// <!-- botão para enviar informações do formulário -->
echo "    <button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">Inserir</button>";

// <!-- fim do formulário -->
echo "    </form>";

echo "    <br>";

// <!-- fim da div de formulário -->
echo "</div>";


    }elseif($id_include == 3){

                
        
// <!-- Começo da caixa de incluir no css -->
echo "<div id=\"incluir\">";

// <!-- titulo da caixa de incluir -->


echo "<br>";
echo "<h2>Registro de equipes: </h2>";
echo "<br>";

// <!-- começo do formulário -->
echo "    <form class=\"mx-auto\" action=\"../inclusoes/14\" method=\"POST\" style=\"width: 400px;\">";

// <!-- campo do id -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputId\"  name=\"id\" aria-describedby=\"idHelp\">";

// <!-- campo de nome da equipe -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputNomeequipe\" class=\"form-label\">Nome da equipe</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" name=\"nomeequipe\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo da sala da equipe -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Sala da equipe</label>";
echo "    <input type=\"number\" required class=\"form-control\" id=\"exampleInput\" name=\"salaequipe\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo do ano desta equipe -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputPontdia\" class=\"form-label\">Ano da equipe</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" name=\"anoeq\" aria-describedby=\"idequipeHelp\" placeholder=\"2007\">";
echo "    </div>";

// <!-- campo do tema da equipe -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputDiapont\" class=\"form-label\">Tema da equipe </label>";
echo "    <input type=\"data\" required class=\"form-control\" id=\"exampleInput\" name=\"temaeq\" aria-describedby=\"diapontHelp\" >";
echo "    </div>";

// <!-- campo da cor da equipe -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInput\" class=\"form-label\">Cor da equipe </label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInputPontuacao\" name=\"coreq\" aria-describedby=\"pontuacaoHelp\" placeholder=\"De acordo com o determinado\">";
echo "    </div>";

// <!-- campo de extras -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInput\" class=\"form-label\">Extras da equipe </label>";
echo "    <input type=\"text\" class=\"form-control\" id=\"exampleInput\" name=\"extraeq\" aria-describedby=\"rankingHelp\">";
echo "    </div>";

// <!-- campo de status -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputStatus\" value=\"1\" name=\"status\" aria-describedby=\"statusHelp\">";

// <!-- botão para enviar informações do formulário -->
echo "    <button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">Inserir</button>";

// <!-- fim do formulário -->
echo "    </form>";

echo "    <br>";

// <!-- fim da div de formulário -->
echo "</div>";

    }elseif($id_include == 4){

                
// <!-- Começo da caixa de incluir no css -->
echo "<div id=\"incluir\">";

// <!-- titulo da caixa de incluir -->


echo "<br>";
echo "<h2>Registro de noticias: </h2>";
echo "<br>";

// <!-- começo do formulário -->
echo "    <form class=\"mx-auto\" action=\"../inclusoes/15\" enctype=\"multipart/form-data\" method=\"POST\" style=\"width: 400px;\">";

// <!-- campo do id da noticia -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputId\"  name=\"id\" aria-describedby=\"idHelp\">";

// <!-- campo de titulo da noticia -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputNomeequipe\" class=\"form-label\">Titulo da noticia </label>";
echo "    <input type=\"tex
t\" required class=\"form-control\" id=\"exampleInput\" name=\"titulonot\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo da descricao da noticia -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Descricao da noticia</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" name=\"descricaonot\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo da data da noticia -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputPontdia\" class=\"form-label\">Data da noticia </label>";
echo "    <input type=\"date\" required class=\"form-control\" id=\"exampleInput\" name=\"datanot\" aria-describedby=\"idequipeHelp\">";
echo "    </div>";

// <!-- campo da foto da noticia -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputDiapont\" class=\"form-label\">Foto da noticia </label>";
echo "    <input type=\"file\" required class=\"form-control\" id=\"exampleInput\" name=\"fotonot\" aria-describedby=\"diapontHelp\" >";
echo "    </div>";

// <!-- campo de status -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputStatus\" value=\"1\" name=\"status\" aria-describedby=\"statusHelp\">";

// <!-- botão para enviar informações do formulário -->
echo "    <button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">Inserir</button>";

// <!-- fim do formulário -->
echo "    </form>";

echo "    <br>";

// <!-- fim da div de formulário -->
echo "</div>";


    }elseif($id_include == 5){

        // <!-- Começo da caixa de incluir no css -->
echo "<div id=\"incluir\">";

// <!-- titulo da caixa de incluir -->


echo "<br>";
echo "<h2>Registro de fotos: </h2>";
echo "<br>";

// <!-- começo do formulário -->
echo "    <form class=\"mx-auto\" action=\"../inclusoes/16\" enctype=\"multipart/form-data\" method=\"POST\" style=\"width: 400px;\">";

// <!-- campo do id -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputId\"  name=\"id\" aria-describedby=\"idHelp\">";

// <!-- campo de titulo da foto -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputNomeequipe\" class=\"form-label\">Titulo da foto</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" name=\"titulofoto\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo de descricao da foto -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Descrição da foto</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" name=\"descricaofoto\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo do ano desta foto -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputPontdia\" class=\"form-label\">Ano da foto</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" name=\"anofoto\" aria-describedby=\"idequipeHelp\" placeholder=\"2007\">";
echo "    </div>";

// <!-- campo do arquivo da foto -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputDiapont\" class=\"form-label\">Arquivo da foto </label>";
echo "    <input type=\"file\" required class=\"form-control\" id=\"exampleInput\" name=\"arquivofoto\" aria-describedby=\"diapontHelp\" >";
echo "    </div>";

// <!-- campo de status -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputStatus\" value=\"1\" name=\"status\" aria-describedby=\"statusHelp\">";

// <!-- botão para enviar informações do formulário -->
echo "    <button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">Inserir</button>";

// <!-- fim do formulário -->
echo "    </form>";

echo "    <br>";

// <!-- fim da div de formulário -->
echo "</div>";


    }elseif($id_include == 6){

                        
        
// <!-- Começo da caixa de incluir no css -->
echo "<div id=\"incluir\">";

// <!-- titulo da caixa de incluir -->


echo "<br>";
echo "<h2>Registro de gincanas: </h2>";
echo "<br>";

// <!-- começo do formulário -->
echo "    <form class=\"mx-auto\" action=\"../inclusoes/17\" enctype=\"multipart/form-data\" method=\"POST\" style=\"width: 400px;\">";

// <!-- campo do id -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputId\"  name=\"id\" aria-describedby=\"idHelp\">";

// <!-- campo de nome da gincana -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputNomegin\" class=\"form-label\">Nome da gincana</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" name=\"nomegin\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo das regras da gincana -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Regras da gincana</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" name=\"regrasgin\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo do criterio 1 -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputIdgincana\" class=\"form-label\">Critério 1</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" name=\"crie1\" aria-describedby=\"idequipeHelp\" placeholder=\"Ritmo\">";
echo "    </div>";


// <!-- campo do criterio 2 -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputIdgincana\" class=\"form-label\">Critério 2</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" name=\"crie2\" aria-describedby=\"idequipeHelp\" placeholder=\"Musicalização\">";
echo "    </div>";


// <!-- campo do criterio 3 -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputIdgincana\" class=\"form-label\">Critério 3</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\"name=\"crie3\" aria-describedby=\"idequipeHelp\" placeholder=\"Afinação\">";
echo "    </div>";

// <!-- campo do exemplo da gincana -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputexemplogin\" class=\"form-label\">Exemplo da gincana</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" name=\"exemplogin\" aria-describedby=\"idequipeHelp\" placeholder=\"\">";
echo "    </div>";

// <!-- campo da foto da gincana -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputFotogin\" class=\"form-label\">Foto da gincana </label>";
echo "    <input type=\"file\" required class=\"form-control\" id=\"exampleInput\" name=\"fotogin\" aria-describedby=\"diapontHelp\" >";
echo "    </div>";

// <!-- campo do horario da gincana -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInput\" class=\"form-label\">Horario da gincana </label>";
echo "    <input type=\"datetime\" required class=\"form-control\" id=\"exampleInputPontuacao\" name=\"horariogin\" aria-describedby=\"pontuacaoHelp\" placeholder=\"De acordo com o determinado\">";
echo "    </div>";

// <!-- campo de local da gincana -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInput\" class=\"form-label\">Local da gicana </label>";
echo "    <input type=\"text\" class=\"form-control\" id=\"exampleInput\" name=\"localgin\" aria-describedby=\"localginHelp\">";
echo "    </div>";

// <!-- campo de status -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputStatus\" value=\"1\" name=\"status\" aria-describedby=\"statusHelp\">";

// <!-- botão para enviar informações do formulário -->
echo "    <button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">Inserir</button>";

// <!-- fim do formulário -->
echo "    </form>";

echo "    <br>";

// <!-- fim da div de formulário -->
echo "</div>";


    }elseif($id_include == 7){

        // <!-- Começo da caixa de incluir no css -->
echo "<div id=\"incluir\">";

// <!-- titulo da caixa de incluir -->


echo "<br>";
echo "<h2>Registro de pdfs de regras: </h2>";
echo "<br>";

// <!-- começo do formulário -->
echo "    <form class=\"mx-auto\" action=\"../inclusoes/18\" enctype=\"multipart/form-data\" method=\"POST\" style=\"width: 400px;\">";

// <!-- campo do id -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputId\" name=\"id\" aria-describedby=\"idHelp\">";

// <!-- campo de Id da gincana -->
echo "<div class=\"mb-3\">";
echo "<label for=\"exampleInputEmail1\" class=\"form-label\"> Selecionar gincana </label>";
echo "<br>";
echo "<select name=\"idgincana\">";
echo "<option value=\"0\"></option>";

// Abrindo o meio de coleta dos dados
while($registro_gincana = $dados_gincanas->fetch_object()){
    
echo "<option value=\"$registro_gincana->id_gin\">$registro_gincana->nome_gin </option>";

}
echo "</select>";
echo "</div>";

// <!-- campo do titulo do pdf -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputNomegin\" class=\"form-label\">Titulo do pdf</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" name=\"titulopdfregra\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo da descricao do pdf -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Descricao do pdf</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" name=\"descpdfregra\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo do arquivo do pdf -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputexemplogin\" class=\"form-label\">Arquivo do pdf </label>";
echo "    <input type=\"file\" required class=\"form-control\" id=\"exampleInput\" name=\"arquivopdfregra\" aria-describedby=\"idequipeHelp\" placeholder=\"2007\">";
echo "    </div>";

// <!-- campo de status -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputStatus\" value=\"1\" name=\"status\" aria-describedby=\"statusHelp\">";

// <!-- botão para enviar informações do formulário -->
echo "    <button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">Inserir</button>";

// <!-- fim do formulário -->
echo "    </form>";

echo "    <br>";

// <!-- fim da div de formulário -->
echo "</div>";


    }elseif($id_include == 8){

                // <!-- Começo da caixa de incluir no css -->
echo "<div id=\"incluir\">";

// <!-- titulo da caixa de incluir -->


echo "<br>";
echo "<h2>Registro de pdfs de avaliações: </h2>";
echo "<br>";

// <!-- começo do formulário -->
echo "    <form class=\"mx-auto\" action=\"../inclusoes/19\" enctype=\"multipart/form-data\" method=\"POST\" style=\"width: 400px;\">";

// <!-- campo do id -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputId\"  name=\"id\" aria-describedby=\"idHelp\">";

// <!-- campo de Id da gincana -->
echo "<div class=\"mb-3\">";
echo "<label for=\"exampleInputEmail1\" class=\"form-label\"> Selecionar gincana </label>";
echo "<br>";
echo "<select name=\"idgincana\">";
echo "<option value=\"0\"></option>";

// Abrindo o meio de coleta dos dados
while($registro_gincana = $dados_gincanas->fetch_object()){
    
echo "<option value=\"$registro_gincana->id_gin\">$registro_gincana->nome_gin </option>";

}
echo "</select>";
echo "</div>";

// <!-- campo do titulo do pdf -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputNomegin\" class=\"form-label\">Titulo do pdf</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" name=\"titulopdfavaliativo\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo da descricao do pdf -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Descricao do pdf</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" name=\"descpdfavaliativo\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo do arquivo do pdf -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputexemplogin\" class=\"form-label\">Arquivo do pdf </label>";
echo "    <input type=\"file\" required class=\"form-control\" id=\"exampleInput\" name=\"arquivopdfavaliativo\" aria-describedby=\"idequipeHelp\" placeholder=\"2007\">";
echo "    </div>";

// <!-- campo de status -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputStatus\" value=\"1\" name=\"status\" aria-describedby=\"statusHelp\">";

// <!-- botão para enviar informações do formulário -->
echo "    <button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">Inserir</button>";

// <!-- fim do formulário -->
echo "    </form>";

echo "    <br>";

// <!-- fim da div de formulário -->
echo "</div>";



    }elseif($id_include == 9){

                        // <!-- Começo da caixa de incluir no css -->
echo "<div id=\"incluir\">";

// <!-- titulo da caixa de incluir -->

// $id_hist = $repositorioHistoricos->id_correto();

echo "<br>";
echo "<h2>Registro de historicos: </h2>";
echo "<br>";

// <!-- começo do formulário -->
echo "    <form class=\"mx-auto\" action=\"../inclusoes/20\" enctype=\"multipart/form-data\" method=\"POST\" style=\"width: 400px;\">";

// <!-- campo do id -->
echo "    <input type=\"hidden\"  required class=\"form-control\" id=\"exampleInputId\"  name=\"id\" aria-describedby=\"idHelp\">";

// <!-- campo de ano do historico -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputIdgincana\" class=\"form-label\">Ano</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" name=\"anohist\" aria-describedby=\"idequipeHelp\" placeholder=\"Atual\">";
echo "    </div>";

// <!-- campo do tema do historico -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputNomegin\" class=\"form-label\">Tema do ano </label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" name=\"temahist\" aria-describedby=\"idequipeHelp\" placeholder=\"Coloque o nome\" >";
echo "    </div>";

// <!-- campo do primeiro lugar -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Primeiro lugar</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" name=\"primeirolugar\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo do segundo lugar -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Segundo lugar</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" name=\"segundolugar\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo do terceiro lugar -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Terceiro lugar</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" name=\"terceirolugar\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo da melhor gincana -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Melhor gincana</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" name=\"melhorgin\" aria-describedby=\"idequipeHelp\" placeholder=\"Coloque o nome\" >";
echo "    </div>";

// <!-- campo da foto do historico -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputexemplogin\" class=\"form-label\">Foto do ano </label>";
echo "    <input type=\"file\" required class=\"form-control\" id=\"exampleInput\" name=\"fotohist\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo de status -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputStatus\" value=\"1\" name=\"status\" aria-describedby=\"statusHelp\">";

// <!-- botão para enviar informações do formulário -->
echo "    <button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">Inserir</button>";

// <!-- fim do formulário -->
echo "    </form>";

echo "    <br>";

// <!-- fim da div de formulário -->
echo "</div>";

    }elseif($id_include == 10){

                                // <!-- Começo da caixa de incluir no css -->
echo "<div id=\"incluir\">";

// <!-- titulo da caixa de incluir -->


echo "<br>";
echo "<h2>Registro de temas: </h2>";
echo "<br>";

// <!-- começo do formulário -->
echo "    <form class=\"mx-auto\" action=\"../inclusoes/21\" method=\"POST\" style=\"width: 400px;\">";

// <!-- campo do id -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputId\"  name=\"id\" aria-describedby=\"idHelp\">";

// <!-- campo de tema -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputIdgincana\" class=\"form-label\">Tema</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" name=\"tematm\" aria-describedby=\"idequipeHelp\" placeholder=\"Veja na tabela de gincanas\">";
echo "    </div>";

// <!-- campo da motivacao do tema -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputNomegin\" class=\"form-label\">Tema do ano </label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" name=\"motivacaotm\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo do primeiro ano de uso do tema -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Primeiro ano de uso</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" name=\"primeiroano\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo de status -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputStatus\" value=\"1\" name=\"status\" aria-describedby=\"statusHelp\">";

// <!-- botão para enviar informações do formulário -->
echo "    <button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">Inserir</button>";

// <!-- fim do formulário -->
echo "    </form>";

echo "    <br>";

// <!-- fim da div de formulário -->
echo "</div>";


    }elseif($id_include == 11){

        // <!-- Começo da caixa de incluir no css -->
echo "<div id=\"incluir\">";

// <!-- titulo da caixa de incluir -->


echo "<br>";
echo "<h2>Registro de usuarios: </h2>";
echo "<br>";

// <!-- começo do formulário -->
echo "    <form class=\"mx-auto\" action=\"../inclusoes/22\" method=\"POST\"  enctype=\"multipart/form-data\" style=\"width: 400px;\">";

// <!-- campo do id -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputId\"  name=\"id\" aria-describedby=\"idHelp\">";

// <!-- campo do nome do usuario -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputIdgincana\" class=\"form-label\">Nome do usuario </label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" name=\"nomeus\" aria-describedby=\"idequipeHelp\" placeholder=\"Veja na tabela de gincanas\">";
echo "    </div>";

// <!-- campo do email do usuario  -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputNomegin\" class=\"form-label\">Email do usuario </label>";
echo "    <input type=\"email\" required class=\"form-control\" id=\"exampleInput\" name=\"emailus\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo da senha do usuario-->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Senha do usuario </label>";
echo "    <input type=\"password\" required class=\"form-control\" id=\"exampleInput\" name=\"senhaus\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo da confirmar senha do usuario-->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Confirmar senha</label>";
echo "    <input type=\"password\" required class=\"form-control\" id=\"exampleInput\" name=\"confsenha\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo da foto do usuario -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Foto do usuario </label>";
echo "    <input type=\"file\" required class=\"form-control\" id=\"exampleInput\" name=\"fotous\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo de funçao do usuario -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Função do usuario</label>";
echo "    <input type=\"number\" required class=\"form-control\" id=\"exampleInput\" name=\"funcaous\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo de funcao no evento -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">FNE</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" name=\"fne\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo de status -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputStatus\" value=\"1\" name=\"status\" aria-describedby=\"statusHelp\">";

// <!-- botão para enviar informações do formulário -->
echo "    <button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">Inserir</button>";

// <!-- fim do formulário -->
echo "    </form>";

echo "    <br>";

// <!-- fim da div de formulário -->
echo "</div>";

    }elseif($id_include == 23){

        // <!-- Começo da caixa de incluir no css -->
echo "<div id=\"incluir\">";

// <!-- titulo da caixa de incluir -->


echo "<br>";
echo "<h2>Registro de imagem para carrosel: </h2>";
echo "<br>";

// <!-- começo do formulário -->
echo "    <form class=\"mx-auto\" action=\"../inclusoes/24\" method=\"POST\"  enctype=\"multipart/form-data\" style=\"width: 400px;\">";

// <!-- campo do id -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputId\"  name=\"id_cs\" aria-describedby=\"idHelp\">";

// <!-- campo do nome do usuario -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputIdgincana\" class=\"form-label\">Titulo da imagem </label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" name=\"titulo_cs\" aria-describedby=\"idequipeHelp\" placeholder=\"\">";
echo "    </div>";

// <!-- campo do email do usuario  -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputNomegin\" class=\"form-label\">Ordem da imagem </label>";
echo "    <input type=\"number\" required class=\"form-control\" id=\"exampleInput\" name=\"ordem_cs\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo da senha do usuario-->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Arquivo da imagem </label>";
echo "    <input type=\"file\" required class=\"form-control\" id=\"exampleInput\" name=\"arquivo_cs\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo da confirmar senha do usuario-->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Data da imagem </label>";
echo "    <input type=\"date\" required class=\"form-control\" id=\"exampleInput\" name=\"data_cs\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo de status -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputStatus\" value=\"1\" name=\"status_cs\" aria-describedby=\"statusHelp\">";

// <!-- botão para enviar informações do formulário -->
echo "    <button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">Inserir</button>";

// <!-- fim do formulário -->
echo "    </form>";

echo "    <br>";

// <!-- fim da div de formulário -->
echo "</div>";

    }

    // fim das variaveis de pesquisa
    ?>

    <?php
    
    if($id_include == 12){
    
        
        //  Comçando os comandos in page
        
        if(isset($_POST['submit'])){
            // verifica se o botão de enviar foi clicado
        
                    // captura as diversas variaveis do Ppe
                    $id_pont=      $_POST['id'];
                    $equipe_id=    $_POST['idequipe'];
                        $soma_pont =  $repositorioPpa->atribuir_pontos($equipe_id);
                        echo $soma_pont;
                    $ranking=    0;
                    $obs_pont=     $_POST['obss'];
                    $status_pontpd=$_POST['status'];

                        // inicia a sessão nesta página e coleta os dados nescessários
                    if(!isset($_SESSION)){
                        session_start();
                    }

                    $id_ult_atz = $_SESSION['id_usuario'];
        
                    // colocando todas as variaveis juntas
                    $Ppe = new Ppe($id_pont, $equipe_id, $soma_pont, $ranking, $obs_pont, $status_pontpd, $id_ult_atz);
        
                    print_r($Ppe);
                    
                    // enviando para realizar o cadastro
                    $repositorioPpe->cadastrarPpe($Ppe);

            // calculando os pontos das equipes no modo do diego --------

            $repositorioPpe->pontuacaoEspecial();

            // Atualizando o ranking das equipes na tabela ppe ----------

            $repositorioEquipes->atualizarRankingEquipes();

            // Gerando os gráficos ----------------

            $repositorioImg_graf->gráfico_de_barras();

            $repositorioImg_graf->gráfico_de_linhas();

            // Carregando os graficos no banco de dados -----------

            $id_ult_atz = $_SESSION['id_usuario'];

            // $foto = 'grafico_pontuacao.png';

            // $encontrou = $repositorioImg_graf->verificaFoto($foto);

             // colocando todas as variaveis juntas
            $img_graf1 = new img_graf(1, "Gráfico de barras",'grafico_pontuacao.png', 0000-00-00, $id_ult_atz);

            $repositorioImg_graf->alterarImg_graf($img_graf1);

            $id_ult_atz = $_SESSION['id_usuario'];

            // $foto = 'grafico_eficiencia.png';

            // $encontrou = $repositorioImg_graf->verificaFoto($foto);

             // colocando todas as variaveis juntas
             $img_graf2 = new img_graf(2, "Gráfico de eficiencia",'grafico_eficiencia.png', 0000-00-00, $id_ult_atz);

             $repositorioImg_graf->alterarImg_graf($img_graf2);

                        // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/1'</script>";

                    
        
            // fim do php de envio do incluir
        }
        
               // criando o comando para log
            // █──██████────██████──█
            // █─██────██──██────██─█
            // ─███─██─██████─██─███
            // ──██────██──██────██
            // ───██████────██████

            // Definir o fuso horário
            date_default_timezone_set('America/Sao_Paulo'); // Altere conforme necessário       

            // solicitando a hora do sistema
            $hora_solicitada = date("H:i:s");    

            // Solicitando Data do sistema
            $data_solicitada = date('Y/m/d');

            // Solicitando o ip do sistema
            $ip_solicitado = '';

            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip_solicitado = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip_solicitado = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip_solicitado = $_SERVER['REMOTE_ADDR'];
            }

            // Verificar se é um endereço IPv6 localhost
            if ($ip_solicitado == '::1') {
                $ip_solicitado = '127.0.0.1'; // Forçar o IPv4 localhost
            }

            // Solicitando Geolocalização do sistema completo por meio de API
            $localização_solicitada = $repositorioLogs->getUserLocation();

            // selecionando o identificador correto para evitar erros...
            $id_correto = $repositorioLogs->id_correto();

            // Solicitando o id do usuario para salvar
            $id_solicitado = $_SESSION['id_usuario'];

            // Solicitando o email do usuario para salvar
            $email_solicitado = $_SESSION['email_usuario'];

            // echo "<br>";
            // echo $hora_solicitada;
            // echo "<br>";
            // echo $data_solicitada;
            // echo "<br>";
            // echo $ip_solicitado;
            // echo "<br>";
            // echo $localização_solicitada;
            // echo "<br>";
            // echo $id_correto;
            // echo "<br>";
            // echo $id_solicitado;
            // echo "<br>";
            // echo $email_solicitado;
            // echo "<br>";
        
                    // criando variavel com dados
                    $dados_log = new log($id_correto,'Inserir Ppe','O usuario realizou um comando de inserir Ppe','CRUD_INSERIR_Ppe',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
                    // executando comando de log!
                    $repositorioLogs->cadastrarLogs($dados_log);
        
                    // header('Location: ../administrativo');
        
        
            }elseif($id_include == 13){
        
        
        //  Comçando os comandos in page
        
        if(isset($_POST['submit'])){
        // verifica se o botão de enviar foi clicado
        
       
                // captura as diversas variaveis do Ppe
                $id_pont =     $_POST['id'];
                $equipe_id=    $_POST['idequipe'];
                $gincana_id=   $_POST['idgincana'];
                $crie1=   $_POST['crie1'];
                $crie2=   $_POST['crie2'];
                $crie3=   $_POST['crie3'];
                $dia_pont=     $_POST['diapontpg'];
                $soma_pont=     ($_POST['crie1']+$_POST['crie2']+$_POST['crie3'])/3;
                $obs_pont=     $_POST['obss'];
                $status_pontpg=$_POST['status'];

                                        // inicia a sessão nesta página e coleta os dados nescessários
                                        if(!isset($_SESSION)){
                                            session_start();
                                        }
                    
                                        $id_ult_atz = $_SESSION['id_usuario'];
        
                // colocando todas as variaveis juntas
                $Ppa = new Ppa($id_pont,$equipe_id,$gincana_id,$crie1,$crie2,$crie3, $dia_pont,$soma_pont,$obs_pont,$status_pontpg, $id_ult_atz);
                
                // enviando para realizar o cadastro
                $repositorioPpa->cadastrarPpa($Ppa);

            // Atribuindo os pontos para cada equipe
            $dados = $repositorioEquipes->listarTodas_crud();

            // Abrindo o meio de coleta dos dados
            // Abrindo o meio de coleta dos dados
            // while($registro_equipe= $dados->fetch_object()){

            //     $repositorioPpe->atz_pontos($registro_equipe->id_eq);   

            // }

            // calculando os pontos das equipes no modo do diego --------

            $repositorioPpe->pontuacaoEspecial();

            // Atualizando o ranking das equipes na tabela ppe ----------

            $repositorioEquipes->atualizarRankingEquipes();

            // Gerando os gráficos ----------------

            $repositorioImg_graf->gráfico_de_barras();

            $repositorioImg_graf->gráfico_de_linhas();

            // Carregando os graficos no banco de dados -----------

            $id_ult_atz = $_SESSION['id_usuario'];

            // $foto = 'grafico_pontuacao.png';

            // $encontrou = $repositorioImg_graf->verificaFoto($foto);

             // colocando todas as variaveis juntas
            $img_graf1 = new img_graf(1, "Gráfico de barras",'grafico_pontuacao.png', 0000-00-00, $id_ult_atz);

            $repositorioImg_graf->alterarImg_graf($img_graf1);

            $id_ult_atz = $_SESSION['id_usuario'];

            // $foto = 'grafico_eficiencia.png';

            // $encontrou = $repositorioImg_graf->verificaFoto($foto);

             // colocando todas as variaveis juntas
             $img_graf2 = new img_graf(2, "Gráfico de eficiencia",'grafico_eficiencia.png', 0000-00-00, $id_ult_atz);

             $repositorioImg_graf->alterarImg_graf($img_graf2);
        
        // voltando para a página de inicial
        echo "<script>window.location.href='../tabelas/2'</script>";

        // fim do php de envio do incluir
        }
        
               // criando o comando para log
            // █──██████────██████──█
            // █─██────██──██────██─█
            // ─███─██─██████─██─███
            // ──██────██──██────██
            // ───██████────██████

            // Definir o fuso horário
            date_default_timezone_set('America/Sao_Paulo'); // Altere conforme necessário       

            // solicitando a hora do sistema
            $hora_solicitada = date("H:i:s");    

            // Solicitando Data do sistema
            $data_solicitada = date('Y/m/d');

            // Solicitando o ip do sistema
            $ip_solicitado = '';

            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip_solicitado = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip_solicitado = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip_solicitado = $_SERVER['REMOTE_ADDR'];
            }

            // Verificar se é um endereço IPv6 localhost
            if ($ip_solicitado == '::1') {
                $ip_solicitado = '127.0.0.1'; // Forçar o IPv4 localhost
            }

            // Solicitando Geolocalização do sistema completo por meio de API
            $localização_solicitada = $repositorioLogs->getUserLocation();

            // selecionando o identificador correto para evitar erros...
            $id_correto = $repositorioLogs->id_correto();

            // Solicitando o id do usuario para salvar
            $id_solicitado = $_SESSION['id_usuario'];

            // Solicitando o email do usuario para salvar
            $email_solicitado = $_SESSION['email_usuario'];

            // echo "<br>";
            // echo $hora_solicitada;
            // echo "<br>";
            // echo $data_solicitada;
            // echo "<br>";
            // echo $ip_solicitado;
            // echo "<br>";
            // echo $localização_solicitada;
            // echo "<br>";
            // echo $id_correto;
            // echo "<br>";
            // echo $id_solicitado;
            // echo "<br>";
            // echo $email_solicitado;
            // echo "<br>";
        
                    // criando variavel com dados
                    $dados_log = new log($id_correto,'Inserir Ppa','O usuario realizou um comando de inserir Ppa','CRUD_INSERIR_Ppa',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
                    // executando comando de log!
                    $repositorioLogs->cadastrarLogs($dados_log);
        
            }elseif($id_include == 14){
        
        
        //  Comçando os comandos in page

        echo "ola mundo";

        // Conferindo se há alguma sessão aberta, se não, abrimos a sessão e pegamos os dados
        if(!isset($_SESSION)){
            session_start();
            echo "o problema era esse";
        }else{
            echo "bancop ja conectado";
    
    
        }

        if(isset($_POST['submit'])){
        // verifica se o botão de enviar foi clicado

        
                // captura as diversas variaveis do Ppe
                $id_eq    =$_POST['id'];
                $nome_eq  =$_POST['nomeequipe'];
                $sala_eq  =$_POST['salaequipe'];
                $ano_eq   =$_POST['anoeq'];
                $tema_eq  =$_POST['temaeq'];
                $cor_eq   =$_POST['coreq'];
                $extra_eq =$_POST['extraeq'];
                $status_eq=$_POST['status'];

                                        // inicia a sessão nesta página e coleta os dados nescessários
                                        if(!isset($_SESSION)){
                                            session_start();
                                        }
                    
                                        $id_ult_atz = $_SESSION['id_usuario'];
        
                // colocando todas as variaveis juntas
               $equipe = new equipes($id_eq,$nome_eq,$sala_eq,$ano_eq,$tema_eq,$cor_eq,$extra_eq,$status_eq, $id_ult_atz);

               // enviando para realizar o cadastro
                $repositorioEquipes->cadastrarEquipe($equipe);

                echo "aqui estamos e não sairemos";
        
        // fim do php de envio do incluir
        }
        
               // criando o comando para log
            // █──██████────██████──█
            // █─██────██──██────██─█
            // ─███─██─██████─██─███
            // ──██────██──██────██
            // ───██████────██████

            // Definir o fuso horário
            date_default_timezone_set('America/Sao_Paulo'); // Altere conforme necessário       

            // solicitando a hora do sistema
            $hora_solicitada = date("H:i:s");    

            // Solicitando Data do sistema
            $data_solicitada = date('Y/m/d');

            // Solicitando o ip do sistema
            $ip_solicitado = '';

            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip_solicitado = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip_solicitado = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip_solicitado = $_SERVER['REMOTE_ADDR'];
            }

            // Verificar se é um endereço IPv6 localhost
            if ($ip_solicitado == '::1') {
                $ip_solicitado = '127.0.0.1'; // Forçar o IPv4 localhost
            }

            // Solicitando Geolocalização do sistema completo por meio de API
            $localização_solicitada = $repositorioLogs->getUserLocation();

            // selecionando o identificador correto para evitar erros...
            $id_correto = $repositorioLogs->id_correto();

            // Solicitando o id do usuario para salvar
            $id_solicitado = $_SESSION['id_usuario'];

            // Solicitando o email do usuario para salvar
            $email_solicitado = $_SESSION['email_usuario'];

            // echo "<br>";
            // echo $hora_solicitada;
            // echo "<br>";
            // echo $data_solicitada;
            // echo "<br>";
            // echo $ip_solicitado;
            // echo "<br>";
            // echo $localização_solicitada;
            // echo "<br>";
            // echo $id_correto;
            // echo "<br>";
            // echo $id_solicitado;
            // echo "<br>";
            // echo $email_solicitado;
            // echo "<br>";
        
                    // criando variavel com dados
                    $dados_log = new log($id_correto,'Inserir equipe','O usuario realizou um comando de inserir equipe','CRUD_INSERIR_EQUIPE',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
                    // executando comando de log!
                    $repositorioLogs->cadastrarLogs($dados_log);
        
            }elseif($id_include == 15){
        
        
        //  Comçando os comandos in page
        
        if(isset($_POST['submit'])){
        // verifica se o botão de enviar foi clicado
        
                // captura as diversas variaveis do Ppe
                $idnot    =     $_POST['id'];
                $titulonot  =   $_POST['titulonot'];
                $descricaonot  =$_POST['descricaonot'];
                $datanot   =    $_POST['datanot'];
                // $fotonot  =     $_POST['fotonot'];
                $status   =     $_POST['status'];

                $foto = $_FILES['fotonot'];

                $encontrou = $repositorioNoticias->verificaFoto($foto);

                                        // inicia a sessão nesta página e coleta os dados nescessários
                                        if(!isset($_SESSION)){
                                            session_start();
                                        }
                    
                                        $id_ult_atz = $_SESSION['id_usuario'];
        
                // colocando todas as variaveis juntas
               $noticia = new Noticias($idnot, $titulonot, $descricaonot, $datanot, $encontrou, $status, $id_ult_atz);
        
               print_r($noticia);

               // enviando para realizar o cadastro
                $repositorioNoticias->cadastrarNoticia($noticia);
        
        // fim do php de envio do incluir
        }
        
               // criando o comando para log
            // █──██████────██████──█
            // █─██────██──██────██─█
            // ─███─██─██████─██─███
            // ──██────██──██────██
            // ───██████────██████

            // Definir o fuso horário
            date_default_timezone_set('America/Sao_Paulo'); // Altere conforme necessário       

            // solicitando a hora do sistema
            $hora_solicitada = date("H:i:s");    

            // Solicitando Data do sistema
            $data_solicitada = date('Y/m/d');

            // Solicitando o ip do sistema
            $ip_solicitado = '';

            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip_solicitado = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip_solicitado = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip_solicitado = $_SERVER['REMOTE_ADDR'];
            }

            // Verificar se é um endereço IPv6 localhost
            if ($ip_solicitado == '::1') {
                $ip_solicitado = '127.0.0.1'; // Forçar o IPv4 localhost
            }

            // Solicitando Geolocalização do sistema completo por meio de API
            $localização_solicitada = $repositorioLogs->getUserLocation();

            // selecionando o identificador correto para evitar erros...
            $id_correto = $repositorioLogs->id_correto();

            // Solicitando o id do usuario para salvar
            $id_solicitado = $_SESSION['id_usuario'];

            // Solicitando o email do usuario para salvar
            $email_solicitado = $_SESSION['email_usuario'];

            // echo "<br>";
            // echo $hora_solicitada;
            // echo "<br>";
            // echo $data_solicitada;
            // echo "<br>";
            // echo $ip_solicitado;
            // echo "<br>";
            // echo $localização_solicitada;
            // echo "<br>";
            // echo $id_correto;
            // echo "<br>";
            // echo $id_solicitado;
            // echo "<br>";
            // echo $email_solicitado;
            // echo "<br>";
        
                    // criando variavel com dados
                    $dados_log = new log($id_correto,'Inserir noticia','O usuario realizou um comando de inserir noticia','CRUD_INSERIR_NOTICIA',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
                    // executando comando de log!
                    $repositorioLogs->cadastrarLogs($dados_log);
        
            }elseif($id_include == 16){
        
        
        //  Comçando os comandos in page
        
        if(isset($_POST['submit'])){
        // verifica se o botão de enviar foi clicado
        
                // captura as diversas variaveis do Ppe
                $id_foto    =     $_POST['id'];
                $titulo_foto  =   $_POST['titulofoto'];
                $descricao_foto  =$_POST['descricaofoto'];
                $ano_foto   =     $_POST['anofoto'];
                // $arquivo_foto  =  $_POST['arquivofoto'];
                $status=          $_POST['status'];

                $foto = $_FILES['arquivofoto'];

                $encontrou = $repositorioFotos->verificaFoto($foto);

                                        // inicia a sessão nesta página e coleta os dados nescessários
                                        if(!isset($_SESSION)){
                                            session_start();
                                        }
                    
                                        $id_ult_atz = $_SESSION['id_usuario'];
        
                // colocando todas as variaveis juntas
               $foto = new Fotos($id_foto,$titulo_foto,$descricao_foto,$ano_foto,$encontrou,$status, $id_ult_atz);
        
                
               // enviando para realizar o cadastro
                $repositorioFotos->cadastrarFoto($foto);
        
        // fim do php de envio do incluir
        }
        
               // criando o comando para log
            // █──██████────██████──█
            // █─██────██──██────██─█
            // ─███─██─██████─██─███
            // ──██────██──██────██
            // ───██████────██████

            // Definir o fuso horário
            date_default_timezone_set('America/Sao_Paulo'); // Altere conforme necessário       

            // solicitando a hora do sistema
            $hora_solicitada = date("H:i:s");    

            // Solicitando Data do sistema
            $data_solicitada = date('Y/m/d');

            // Solicitando o ip do sistema
            $ip_solicitado = '';

            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip_solicitado = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip_solicitado = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip_solicitado = $_SERVER['REMOTE_ADDR'];
            }

            // Verificar se é um endereço IPv6 localhost
            if ($ip_solicitado == '::1') {
                $ip_solicitado = '127.0.0.1'; // Forçar o IPv4 localhost
            }

            // Solicitando Geolocalização do sistema completo por meio de API
            $localização_solicitada = $repositorioLogs->getUserLocation();

            // selecionando o identificador correto para evitar erros...
            $id_correto = $repositorioLogs->id_correto();

            // Solicitando o id do usuario para salvar
            $id_solicitado = $_SESSION['id_usuario'];

            // Solicitando o email do usuario para salvar
            $email_solicitado = $_SESSION['email_usuario'];

            // echo "<br>";
            // echo $hora_solicitada;
            // echo "<br>";
            // echo $data_solicitada;
            // echo "<br>";
            // echo $ip_solicitado;
            // echo "<br>";
            // echo $localização_solicitada;
            // echo "<br>";
            // echo $id_correto;
            // echo "<br>";
            // echo $id_solicitado;
            // echo "<br>";
            // echo $email_solicitado;
            // echo "<br>";
        
                    // criando variavel com dados
                    $dados_log = new log($id_correto,'Inserir foto','O usuario realizou um comando de inserir foto','CRUD_INSERIR_FOTO',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
                    // executando comando de log!
                    $repositorioLogs->cadastrarLogs($dados_log);
        
            }elseif($id_include == 17){
        
                            
        
        //  Comçando os comandos in page
        
        if(isset($_POST['submit'])){
        // verifica se o botão de enviar foi clicado
        
  
                // captura as diversas variaveis do Ppe
                $id_gin    =    $_POST['id'];
                $nome_gin  =    $_POST['nomegin'];
                $regras_gin  =  $_POST['regrasgin'];
                $crie1=   $_POST['crie1'];
                $crie2=   $_POST['crie2'];
                $crie3=   $_POST['crie3'];
                $exemplo_gin   =$_POST['exemplogin'];
                // $foto_gin  =    $_POST['fotogin'];
                $horario_gin   =$_POST['horariogin'];
                $local_gin  =   $_POST['localgin'];
                $status_gin =   $_POST['status'];

                $foto = $_FILES['fotogin'];

                $encontrou = $repositorioGincanas->verificaFoto($foto);

                                        // inicia a sessão nesta página e coleta os dados nescessários
                                        if(!isset($_SESSION)){
                                            session_start();
                                        }
                    
                                        $id_ult_atz = $_SESSION['id_usuario'];
        
                // colocando todas as variaveis juntas
               $gincana = new Gincanas($id_gin, $nome_gin, $regras_gin, $crie1,$crie2,$crie3,$exemplo_gin, $encontrou, $horario_gin, $local_gin, $status_gin, $id_ult_atz);


               // enviando para realizar o cadastro
                $repositorioGincanas->cadastrarGincana($gincana);
        
        // fim do php de envio do incluir
        }
        
               // criando o comando para log
            // █──██████────██████──█
            // █─██────██──██────██─█
            // ─███─██─██████─██─███
            // ──██────██──██────██
            // ───██████────██████

            // Definir o fuso horário
            date_default_timezone_set('America/Sao_Paulo'); // Altere conforme necessário       

            // solicitando a hora do sistema
            $hora_solicitada = date("H:i:s");    

            // Solicitando Data do sistema
            $data_solicitada = date('Y/m/d');

            // Solicitando o ip do sistema
            $ip_solicitado = '';

            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip_solicitado = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip_solicitado = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip_solicitado = $_SERVER['REMOTE_ADDR'];
            }

            // Verificar se é um endereço IPv6 localhost
            if ($ip_solicitado == '::1') {
                $ip_solicitado = '127.0.0.1'; // Forçar o IPv4 localhost
            }

            // Solicitando Geolocalização do sistema completo por meio de API
            $localização_solicitada = $repositorioLogs->getUserLocation();

            // selecionando o identificador correto para evitar erros...
            $id_correto = $repositorioLogs->id_correto();

            // Solicitando o id do usuario para salvar
            $id_solicitado = $_SESSION['id_usuario'];

            // Solicitando o email do usuario para salvar
            $email_solicitado = $_SESSION['email_usuario'];

            // echo "<br>";
            // echo $hora_solicitada;
            // echo "<br>";
            // echo $data_solicitada;
            // echo "<br>";
            // echo $ip_solicitado;
            // echo "<br>";
            // echo $localização_solicitada;
            // echo "<br>";
            // echo $id_correto;
            // echo "<br>";
            // echo $id_solicitado;
            // echo "<br>";
            // echo $email_solicitado;
            // echo "<br>";
        
                    // criando variavel com dados
                    $dados_log = new log($id_correto,'Inserir gincana','O usuario realizou um comando de inserir gincana','CRUD_INSERIR_GINCANA',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
                    // executando comando de log!
                    $repositorioLogs->cadastrarLogs($dados_log);
        
            }elseif($id_include == 18){
        
        
        //  Comçando os comandos in page
        
        if(isset($_POST['submit'])){
        // verifica se o botão de enviar foi clicado
        
                // captura as diversas variaveis do Ppe
                $id_pdfregra    =     $_POST['id'];
                $gincana_id  =        $_POST['idgincana'];
                $titulo_pdfregra  =   $_POST['titulopdfregra'];
                $desc_pdfregra   =    $_POST['descpdfregra'];
                // $arquivo_pdfregra  =  $_POST['arquivopdfregra'];
                $status_pdfregra   =  $_POST['status'];

                $pdf = $_FILES['arquivopdfregra'];

                $encontrou = $repositorioArq_regras->verificaArquivo($pdf);

                                        // inicia a sessão nesta página e coleta os dados nescessários
                                        if(!isset($_SESSION)){
                                            session_start();
                                        }
                    
                                        $id_ult_atz = $_SESSION['id_usuario'];
        
                // colocando todas as variaveis juntas
               $arqregras = new Arq_regras($id_pdfregra, $gincana_id, $titulo_pdfregra, $desc_pdfregra, $encontrou, $status_pdfregra, $id_ult_atz);
        
                

               // enviando para realizar o cadastro
                $repositorioArq_regras->cadastrarArq_regras($arqregras);
        
        // fim do php de envio do incluir
        }
        
               // criando o comando para log
            // █──██████────██████──█
            // █─██────██──██────██─█
            // ─███─██─██████─██─███
            // ──██────██──██────██
            // ───██████────██████

            // Definir o fuso horário
            date_default_timezone_set('America/Sao_Paulo'); // Altere conforme necessário       

            // solicitando a hora do sistema
            $hora_solicitada = date("H:i:s");    

            // Solicitando Data do sistema
            $data_solicitada = date('Y/m/d');

            // Solicitando o ip do sistema
            $ip_solicitado = '';

            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip_solicitado = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip_solicitado = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip_solicitado = $_SERVER['REMOTE_ADDR'];
            }

            // Verificar se é um endereço IPv6 localhost
            if ($ip_solicitado == '::1') {
                $ip_solicitado = '127.0.0.1'; // Forçar o IPv4 localhost
            }

            // Solicitando Geolocalização do sistema completo por meio de API
            $localização_solicitada = $repositorioLogs->getUserLocation();

            // selecionando o identificador correto para evitar erros...
            $id_correto = $repositorioLogs->id_correto();

            // Solicitando o id do usuario para salvar
            $id_solicitado = $_SESSION['id_usuario'];

            // Solicitando o email do usuario para salvar
            $email_solicitado = $_SESSION['email_usuario'];

            // echo "<br>";
            // echo $hora_solicitada;
            // echo "<br>";
            // echo $data_solicitada;
            // echo "<br>";
            // echo $ip_solicitado;
            // echo "<br>";
            // echo $localização_solicitada;
            // echo "<br>";
            // echo $id_correto;
            // echo "<br>";
            // echo $id_solicitado;
            // echo "<br>";
            // echo $email_solicitado;
            // echo "<br>";
        
                    // criando variavel com dados
                    $dados_log = new log($id_correto,'Inserir arquivo de regra','O usuario realizou um comando de inserir arquivo de regra','CRUD_INSERIR_ARQREGRA',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
                    // executando comando de log!
                    $repositorioLogs->cadastrarLogs($dados_log);
        
            }elseif($id_include == 19){
        
        //  Comçando os comandos in page
        
        if(isset($_POST['submit'])){
        // verifica se o botão de enviar foi clicado
        
                // captura as diversas variaveis do Ppe
                $id_pdfavaliativo    =    $_POST['id'];
                $gincana_id  =            $_POST['idgincana'];
                $titulo_pdfavaliativo  =  $_POST['titulopdfavaliativo'];
                $desc_pdfavaliativo   =   $_POST['descpdfavaliativo'];
                // $arquivo_pdfavaliativo  = $_POST['arquivopdfavaliativo'];
                $status_pdfavaliativo   = $_POST['status'];

                
                $pdf = $_FILES['arquivopdfavaliativo'];

                $encontrou = $repositorioArq_avaliativo->verificaArquivo($pdf);
                
                                        // inicia a sessão nesta página e coleta os dados nescessários
                                        if(!isset($_SESSION)){
                                            session_start();
                                        }
                    
                                        $id_ult_atz = $_SESSION['id_usuario'];
        
                // colocando todas as variaveis juntas
               $arqavaliativo = new Arq_avaliativo($id_pdfavaliativo, $gincana_id, $titulo_pdfavaliativo, $desc_pdfavaliativo, $encontrou, $status_pdfavaliativo, $id_ult_atz);

               // enviando para realizar o cadastro
                $repositorioArq_avaliativo->cadastrarArq_avaliativo($arqavaliativo);
        
        // fim do php de envio do incluir
         
        }
        
               // criando o comando para log
            // █──██████────██████──█
            // █─██────██──██────██─█
            // ─███─██─██████─██─███
            // ──██────██──██────██
            // ───██████────██████

            // Definir o fuso horário
            date_default_timezone_set('America/Sao_Paulo'); // Altere conforme necessário       

            // solicitando a hora do sistema
            $hora_solicitada = date("H:i:s");    

            // Solicitando Data do sistema
            $data_solicitada = date('Y/m/d');

            // Solicitando o ip do sistema
            $ip_solicitado = '';

            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip_solicitado = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip_solicitado = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip_solicitado = $_SERVER['REMOTE_ADDR'];
            }

            // Verificar se é um endereço IPv6 localhost
            if ($ip_solicitado == '::1') {
                $ip_solicitado = '127.0.0.1'; // Forçar o IPv4 localhost
            }

            // Solicitando Geolocalização do sistema completo por meio de API
            $localização_solicitada = $repositorioLogs->getUserLocation();

            // selecionando o identificador correto para evitar erros...
            $id_correto = $repositorioLogs->id_correto();

            // Solicitando o id do usuario para salvar
            $id_solicitado = $_SESSION['id_usuario'];

            // Solicitando o email do usuario para salvar
            $email_solicitado = $_SESSION['email_usuario'];

            // echo "<br>";
            // echo $hora_solicitada;
            // echo "<br>";
            // echo $data_solicitada;
            // echo "<br>";
            // echo $ip_solicitado;
            // echo "<br>";
            // echo $localização_solicitada;
            // echo "<br>";
            // echo $id_correto;
            // echo "<br>";
            // echo $id_solicitado;
            // echo "<br>";
            // echo $email_solicitado;
            // echo "<br>";
        
                    // criando variavel com dados
                    $dados_log = new log($id_correto,'Inserir arquivo avaliativo','O usuario realizou um comando de inserir arquivo avaliativo','CRUD_INSERIR_ARQAVALIATIVO',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
                    // executando comando de log!
                    $repositorioLogs->cadastrarLogs($dados_log);
        
            }elseif($id_include == 20){
        
        
        //  Comçando os comandos in page
        
        if(isset($_POST['submit'])){
        // verifica se o botão de enviar foi clicado
        
                // captura as diversas variaveis do Ppe
                $id_hist   =       $_POST['id'];
                $ano_hist  =       $_POST['anohist'];
                $tema_hist  =      $_POST['temahist'];
                $primeiro_lugar   =$_POST['primeirolugar'];
                $segundo_lugar  =  $_POST['segundolugar'];
                $terceiro_lugar   =$_POST['terceirolugar'];
                $melhor_gincana   =$_POST['melhorgin'];
                // $foto_hist   =     $_POST['fotohist'];
                $status_hist   =   $_POST['status'];

                $foto = $_FILES['fotohist'];

                $encontrou = $repositorioHistoricos->verificaFoto($foto);

                                        // inicia a sessão nesta página e coleta os dados nescessários
                                        if(!isset($_SESSION)){
                                            session_start();
                                        }
                    
                                        $id_ult_atz = $_SESSION['id_usuario'];
        
                // colocando todas as variaveis juntas
               $historico = new Historico($id_hist, $ano_hist, $tema_hist, $primeiro_lugar, $segundo_lugar, $terceiro_lugar, $melhor_gincana, $encontrou, $status_hist, $id_ult_atz);
     
               // enviando para realizar o cadastro
                $repositorioHistoricos->cadastrarHistorico($historico);
        
        // fim do php de envio do incluir
        
        }
        
               // criando o comando para log
            // █──██████────██████──█
            // █─██────██──██────██─█
            // ─███─██─██████─██─███
            // ──██────██──██────██
            // ───██████────██████

            // Definir o fuso horário
            date_default_timezone_set('America/Sao_Paulo'); // Altere conforme necessário       

            // solicitando a hora do sistema
            $hora_solicitada = date("H:i:s");    

            // Solicitando Data do sistema
            $data_solicitada = date('Y/m/d');

            // Solicitando o ip do sistema
            $ip_solicitado = '';

            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip_solicitado = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip_solicitado = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip_solicitado = $_SERVER['REMOTE_ADDR'];
            }

            // Verificar se é um endereço IPv6 localhost
            if ($ip_solicitado == '::1') {
                $ip_solicitado = '127.0.0.1'; // Forçar o IPv4 localhost
            }

            // Solicitando Geolocalização do sistema completo por meio de API
            $localização_solicitada = $repositorioLogs->getUserLocation();

            // selecionando o identificador correto para evitar erros...
            $id_correto = $repositorioLogs->id_correto();

            // Solicitando o id do usuario para salvar
            $id_solicitado = $_SESSION['id_usuario'];

            // Solicitando o email do usuario para salvar
            $email_solicitado = $_SESSION['email_usuario'];

            // echo "<br>";
            // echo $hora_solicitada;
            // echo "<br>";
            // echo $data_solicitada;
            // echo "<br>";
            // echo $ip_solicitado;
            // echo "<br>";
            // echo $localização_solicitada;
            // echo "<br>";
            // echo $id_correto;
            // echo "<br>";
            // echo $id_solicitado;
            // echo "<br>";
            // echo $email_solicitado;
            // echo "<br>";
        
                    // criando variavel com dados
                    $dados_log = new log($id_correto,'Inserir historico','O usuario realizou um comando de inserir historico','CRUD_INSERIR_HISTORICO',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
                    // executando comando de log!
                    $repositorioLogs->cadastrarLogs($dados_log);
        
            }elseif($id_include == 21){

        
        //  Comçando os comandos in page
        
        if(isset($_POST['submit'])){
        // verifica se o botão de enviar foi clicado
        
                // captura as diversas variaveis do Ppe
                $id_tema   =     $_POST['id'];
                $tema_tm  =      $_POST['tematm'];
                $motivacao_tm  = $_POST['motivacaotm'];
                $primeiro_ano   =$_POST['primeiroano'];
                $status_tm   =   $_POST['status'];

                                        // inicia a sessão nesta página e coleta os dados nescessários
                                        if(!isset($_SESSION)){
                                            session_start();
                                        }
                    
                                        $id_ult_atz = $_SESSION['id_usuario'];
        
                // colocando todas as variaveis juntas
               $tema = new Temas($id_tema, $tema_tm, $motivacao_tm, $primeiro_ano, $status_tm, $id_ult_atz);
        
                
               // enviando para realizar o cadastro
                $repositorioTemas->cadastrarTema($tema);
        
        // fim do php de envio do incluir
        }
        
               // criando o comando para log
            // █──██████────██████──█
            // █─██────██──██────██─█
            // ─███─██─██████─██─███
            // ──██────██──██────██
            // ───██████────██████

            // Definir o fuso horário
            date_default_timezone_set('America/Sao_Paulo'); // Altere conforme necessário       

            // solicitando a hora do sistema
            $hora_solicitada = date("H:i:s");    

            // Solicitando Data do sistema
            $data_solicitada = date('Y/m/d');

            // Solicitando o ip do sistema
            $ip_solicitado = '';

            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip_solicitado = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip_solicitado = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip_solicitado = $_SERVER['REMOTE_ADDR'];
            }

            // Verificar se é um endereço IPv6 localhost
            if ($ip_solicitado == '::1') {
                $ip_solicitado = '127.0.0.1'; // Forçar o IPv4 localhost
            }

            // Solicitando Geolocalização do sistema completo por meio de API
            $localização_solicitada = $repositorioLogs->getUserLocation();

            // selecionando o identificador correto para evitar erros...
            $id_correto = $repositorioLogs->id_correto();

            // Solicitando o id do usuario para salvar
            $id_solicitado = $_SESSION['id_usuario'];

            // Solicitando o email do usuario para salvar
            $email_solicitado = $_SESSION['email_usuario'];

            // echo "<br>";
            // echo $hora_solicitada;
            // echo "<br>";
            // echo $data_solicitada;
            // echo "<br>";
            // echo $ip_solicitado;
            // echo "<br>";
            // echo $localização_solicitada;
            // echo "<br>";
            // echo $id_correto;
            // echo "<br>";
            // echo $id_solicitado;
            // echo "<br>";
            // echo $email_solicitado;
            // echo "<br>";
        
                    // criando variavel com dados
                    $dados_log = new log($id_correto,'Inserir tema','O usuario realizou um comando de inserir tema','CRUD_INSERIR_TEMA',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
                    // executando comando de log!
                    $repositorioLogs->cadastrarLogs($dados_log);
        
            }elseif($id_include == 22){
        
        if(isset($_POST['submit'])){
        // verifica se o botão de enviar foi clicado
        
                // captura as diversas variaveis do Ppe
                $id_us   =               $_POST['id'];
                $nome_us  =              $_POST['nomeus'];
                $email_us  =             $_POST['emailus'];
                $senha_us   =            $_POST['senhaus'];
                $conf_senha   =          $_POST['confsenha'];
                // $foto_us  =              $_POST['fotous'];
                $funcao_us   =           $_POST['funcaous'];
                $funcao_no_evento   =    $_POST['fne'];
                $status_us   =           $_POST['status'];

                $foto = $_FILES['fotous'];

                $encontrou = $repositorioUsuarios->verificaFoto($foto);

                if($senha_us == $conf_senha){

                // colocando todas as variaveis juntas
                $usuario = new usuario($id_us, $nome_us, $email_us, $senha_us, $encontrou, $funcao_us, $funcao_no_evento, $status_us);
        
                
                // enviando para realizar o cadastro
                 $repositorioUsuarios->cadastrarUsuario($usuario);
         
         // fim do php de envio do incluir
         
         }
         
                     //  // criando o comando para log
         
                     // // █──██████────██████──█
                     // // █─██────██──██────██─█
                     // // ─███─██─██████─██─███
                     // // ──██────██──██────██
                     // // ───██████────██████
         
                     // // Solicitando Hora do sistema
                     // $timezone = new DateTimeZone('America/Sao_Paulo');
                     // $hora_solicitada = new DateTime('now', $timezone);    
         
                     // // Solicitando Data do sistema
                     // $data_solicitada = date('d/m/Y');
         
                     // // Solicitando Geolocalização do sistema
                     // $d = new DateTimeImmutable("2022-06-02 15:44:48 UTC");
         
                     // $timezones = [ 'America/Sao_Paulo' ];
         
                     // foreach ($timezones as $tz) {
                     //     $tzo = new DateTimeZone($tz);
         
                     //     $local = $d->setTimezone($tzo);
         
                     // }
         
                     // $geoloc_solicitada = $local;
         
                     // // coletando os dados pessoais do usuario
                     // // Conferindo se há alguma sessão aberta, se não, abrimos a sessão e pegamos os dados
                     // if(!isset($_SESSION)){
                     //     session_start();
                     // }
         
                     // $email_usuario = $_SESSION['email_usuario'];
                     // $id_usuario = $_SESSION['id_usuario'];
         
                     // // selecionando o identificador correto para evitar erros...
                     // $id_correto = $repositorioLogs->id_correto();
         
                     // criando variavel com dados
                     $dados_log = new log($id_correto,'Inserir usuario','O usuario realizou um comando de inserir usuario','CRUD_INSERIR_USUARIO',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
             
                     // // executando comando de log!
                     // $repositorioLogs->cadastrarLogs($dados_log);
                }else{
                    echo "Senhas não se conhecidem! Retorne e digite as senhas novamente!";
                    exit;
                }
        
        
            }elseif($id_include == 24){
                
        //  Comçando os comandos in page
        
        if(isset($_POST['submit'])){
            // verifica se o botão de enviar foi clicado
            
                            // captura as diversas variaveis do Ppe
                            $id_cs   =               $_POST['id_cs'];
                            $titulo_cs  =              $_POST['titulo_cs'];
                            $ordem_cs  =             $_POST['ordem_cs'];
                            // $arquivo_cs   =            $_POST['arquivo_cs'];
                            $data_cs   =          $_POST['data_cs'];
                            $status_cs   =           $_POST['status_cs'];
            
    
                            // inicia a sessão nesta página e coleta os dados nescessários
                            if(!isset($_SESSION)){
                                session_start();
                            }
        
                            $id_ult_atz = $_SESSION['id_usuario'];
    
                            $foto = $_FILES['arquivo_cs'];
            
                            $encontrou = $repositorioCarrosel->verificaFoto($foto);
            
                            // colocando todas as variaveis juntas
                            $carrosel = new Carrosel($id_cs, $titulo_cs, $ordem_cs, $encontrou, $data_cs, $status_cs, $id_ult_atz);
                    
                   // enviando para realizar o cadastro
                   $repositorioCarrosel->cadastrarCarrosel($carrosel);
            
            // fim do php de envio do incluir
            
            
                       //  // criando o comando para log
            
                       // // █──██████────██████──█
                       // // █─██────██──██────██─█
                       // // ─███─██─██████─██─███
                       // // ──██────██──██────██
                       // // ───██████────██████
            
                       // // Solicitando Hora do sistema
                       // $timezone = new DateTimeZone('America/Sao_Paulo');
                       // $hora_solicitada = new DateTime('now', $timezone);    
            
                       // // Solicitando Data do sistema
                       // $data_solicitada = date('d/m/Y');
            
                       // // Solicitando Geolocalização do sistema
                       // $d = new DateTimeImmutable("2022-06-02 15:44:48 UTC");
            
                       // $timezones = [ 'America/Sao_Paulo' ];
            
                       // foreach ($timezones as $tz) {
                       //     $tzo = new DateTimeZone($tz);
            
                       //     $local = $d->setTimezone($tzo);
            
                       // }
            
                       // $geoloc_solicitada = $local;
            
                       // // coletando os dados pessoais do usuario
                       // // Conferindo se há alguma sessão aberta, se não, abrimos a sessão e pegamos os dados
                       // if(!isset($_SESSION)){
                       //     session_start();
                       // }
            
                       // $email_usuario = $_SESSION['email_usuario'];
                       // $id_usuario = $_SESSION['id_usuario'];
            
                       // // selecionando o identificador correto para evitar erros...
                       // $id_correto = $respositorioLogs->id_correto();
            
                       // criando variavel com dados
                       $dados_log = new log($id_correto,'Alterar usuario','O usuario realizou um comando de Alterar usuario','CRUD_ALTERAR_USUARIO',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
                
                       // // executando comando de log!
                       // $respositorioLogs->cadastrarLogs($dados_log);
                        }
            }
    
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