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
require_once 'backend/objetos/class_IRepositorioImg_graf.php';

$dados_temas = $repositorioTemas->listarTodos_crud();

// pesquisa das esquipes
$dados_equipes = $repositorioEquipes->listarTodas_crud();

// pesquisa do horario e local das gincanas
$dados_gin = $repositorioGincanas->listarTodas_crud();

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
    <title>alterar_registro</title>

    <?php
    // pesquisa da logo e colocação da mesma
    $dados_logo = $repositorioLogo->buscarLogo(1);
    while($registro_logo = $dados_logo->fetch_object()){
    if(!isset($id_filtro)){
    ?>
    <!-- icone do website -->
    <link rel="icon" href="../../frontend/public/imagens/logo/<?php echo $registro_logo->arquivo_lg ?>" alt="Logo">
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

    if($id_pesquisa == 1){

        
        // pesquisa do tema
        $dados = $repositorioPpe->buscarPpe($id_filtro);
        
        // Abrindo o meio de coleta dos dados
        while($registro_Ppe= $dados->fetch_object()){
            

// <!-- Começo da caixa de incluir no css -->
echo "<div id=\"incluir\">";

    // <!-- titulo da caixa de incluir -->
    

echo "<br>";
echo "<h2>Alterar Ppe: </h2>";
echo "<br>";

// <!-- começo do formulário -->
echo "    <form class=\"mx-auto\" action=\"../../alteracoes/13\" method=\"POST\" style=\"width: 400px;\">";

// <!-- campo do id -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputId\" value=\"$registro_Ppe->id_pont\" name=\"id\" aria-describedby=\"idHelp\">";

// <!-- campo de Id da equipe -->
echo "<div class=\"mb-3\">";
echo "<label for=\"exampleInputEmail1\" class=\"form-label\"> Selecionar equipe </label>";
echo "<br>";
echo "<select name=\"idequipe\">";
$dados_fileq = $repositorioEquipes->buscarEquipe($registro_Ppe->equipe_id);

while($registro_equipe = $dados_fileq->fetch_object()){
    
    echo "<option value=\"$registro_equipe->id_eq\">$registro_equipe->nome_eq</option>";
    
    }

// Abrindo o meio de coleta dos dados
while($registro_equipe = $dados_equipes->fetch_object()){
    
echo "<option value=\"$registro_equipe->id_eq\">$registro_equipe->nome_eq</option>";

}
echo "</select>";
echo "</div>";

//  // <!-- campo de ranking -->
// echo "    <div class=\"mb-3\">";
// echo "    <label for=\"exampleInput\" class=\"form-label\">Ranking da equipe</label>";
// echo "    <input type=\"text\" class=\"form-control\" id=\"exampleInput\" value=\"$registro_Ppe->ranking\" name=\"ranking\" aria-describedby=\"rankingHelp\">";
// echo "    </div>";

 // <!-- campo de observacoes -->
 echo "    <div class=\"mb-3\">";
 echo "    <label for=\"exampleInput\" class=\"form-label\">Observações</label>";
 echo "    <input type=\"text\" class=\"form-control\" id=\"exampleInput\" value=\"$registro_Ppe->obs_pont\" name=\"obss\" aria-describedby=\"obsHelp\" placeholder=\"Explicações, comentarios e justificativas\">";
 echo "    </div>";
 
  // <!-- campo de status -->
  echo "    <input type=\"hidden\" required class=\"form-control\" value=\"$registro_Ppe->status_pontpe\" id=\"exampleInputStatus\" name=\"status\" aria-describedby=\"statusHelp\">";

  // <!-- botão para enviar informações do formulário -->
echo "    <button type=\"submit\"  name=\"submit\"  class=\"btn btn-primary\">Alterar</button>";

        }

  // <!-- fim do formulário -->
echo "    </form>";
    
echo "    <br>";

// <!-- fim da div de formulário -->
echo "</div>";


    }elseif($id_pesquisa == 2){

        
        
// <!-- Começo da caixa de incluir no css -->
echo "<div id=\"incluir\">";

// <!-- titulo da caixa de incluir -->

// pesquisa do tema
$dados = $repositorioPpa->buscarPpa($id_filtro);

// Abrindo o meio de coleta dos dados
while($registro_Ppa= $dados->fetch_object()){


echo "<br>";
echo "<h2>Alterar Ppa:</h2>";
echo "<br>";

// <!-- começo do formulário -->
echo "    <form class=\"mx-auto\" action=\"../../alteracoes/14\" method=\"POST\" style=\"width: 400px;\">";

// <!-- campo do id -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputId\" value=\"$registro_Ppa->id_pontpa\" name=\"id\" aria-describedby=\"idHelp\">";

// <!-- campo de Id da equipe -->
echo "<div class=\"mb-3\">";
echo "<label for=\"exampleInputEmail1\" class=\"form-label\"> Selecionar equipe </label>";
echo "<br>";
echo "<select name=\"idequipe\">";

$dados_eq = $repositorioEquipes->buscarEquipe($registro_Ppa->equipe_id);
// Abrindo o meio de coleta dos dados
while($registro_equipe1 = $dados_eq->fetch_object()){
    
    echo "<option value=\"$registro_equipe1->id_eq\">$registro_equipe1->nome_eq</option>";
    
    }

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

$dados_gincanas = $repositorioGincanas->buscarGincana($registro_Ppa->gincana_id);
while($registro_gincana = $dados_gincanas->fetch_object()){

    echo "<option value=\"$registro_gincana->id_gin\">$registro_gincana->nome_gin</option>";

}

// Abrindo o meio de coleta dos dados
while($registro_gincana = $dados_gin->fetch_object()){
    
echo "<option value=\"$registro_gincana->id_gin\">$registro_gincana->nome_gin </option>";

}
echo "</select>";
echo "</div>";

$dados_gincanas = $repositorioGincanas->buscarGincana($registro_Ppa->gincana_id);
while($registro_gincana = $dados_gincanas->fetch_object()){

// <!-- campo do criterio 1 -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputIdgincana\" class=\"form-label\">$registro_gincana->crie_1</label>";
echo "    <input type=\"number\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_Ppa->crie_1\" name=\"crie1\" aria-describedby=\"idequipeHelp\" placeholder=\"10\">";
echo "    </div>";


// <!-- campo do criterio 1 -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputIdgincana\" class=\"form-label\">$registro_gincana->crie_2</label>";
echo "    <input type=\"number\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_Ppa->crie_2\" name=\"crie2\" aria-describedby=\"idequipeHelp\" placeholder=\"4\">";
echo "    </div>";


// <!-- campo do criterio 1 -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputIdgincana\" class=\"form-label\">$registro_gincana->crie_3</label>";
echo "    <input type=\"number\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_Ppa->crie_3\" name=\"crie3\" aria-describedby=\"idequipeHelp\" placeholder=\"10\">";
echo "    </div>";

}

// <!-- campo do dia da pontuação -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputPontdia\" class=\"form-label\">Dia da pontuação</label>";
echo "    <input type=\"data\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_Ppa->dia_pontpa\" name=\"diapontpg\" aria-describedby=\"idequipeHelp\" placeholder=\"Veja na tabela de gincanas\">";
echo "    </div>";

// <!-- campo de observacoes -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInput\" class=\"form-label\">Observações</label>";
echo "    <input type=\"text\" class=\"form-control\" id=\"exampleInput\" value=\"$registro_Ppa->obs_pontpa\" name=\"obss\" aria-describedby=\"obsHelp\" placeholder=\"Explicações, comentarios e justificativas\">";
echo "    </div>";

// <!-- campo de status -->
echo "    <input type=\"hidden\" required class=\"form-control\" value=\"$registro_Ppa->status_pontpa\" id=\"exampleInputStatus\" name=\"status\" aria-describedby=\"statusHelp\">";

// <!-- botão para enviar informações do formulário -->
echo "    <button type=\"submit\"  name=\"submit\"  class=\"btn btn-primary\">Alterar</button>";

}

// <!-- fim do formulário -->
echo "    </form>";

echo "    <br>";

// <!-- fim da div de formulário -->
echo "</div>";


    }elseif($id_pesquisa == 3){

                
        
// <!-- Começo da caixa de incluir no css -->
echo "<div id=\"incluir\">";

// <!-- titulo da caixa de incluir -->


// pesquisa do tema
$dados = $repositorioEquipes->buscarEquipe($id_filtro);

// Abrindo o meio de coleta dos dados
while($registro_equipe= $dados->fetch_object()){

echo "<br>";
echo "<h2>Alterar equipe: </h2>";
echo "<br>";

// <!-- começo do formulário -->
echo "    <form class=\"mx-auto\" action=\"../../alteracoes/15\" method=\"POST\" style=\"width: 400px;\">";

// <!-- campo do id -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputId\" value=\"$registro_equipe->id_eq\" name=\"id\" aria-describedby=\"idHelp\">";

// <!-- campo de nome da equipe -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputNomeequipe\" class=\"form-label\">Nome da equipe</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_equipe->nome_eq\" name=\"nomeequipe\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo da sala da equipe -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Sala da equipe</label>";
echo "    <input type=\"number\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_equipe->sala_eq\" name=\"salaequipe\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo do ano desta equipe -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputPontdia\" class=\"form-label\">Ano da equipe</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_equipe->ano_eq\" name=\"anoeq\" aria-describedby=\"idequipeHelp\" placeholder=\"2007\">";
echo "    </div>";

// <!-- campo do tema da equipe -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputDiapont\" class=\"form-label\">Tema da equipe </label>";
echo "    <input type=\"data\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_equipe->tema_eq\" name=\"temaeq\" aria-describedby=\"diapontHelp\" >";
echo "    </div>";

// <!-- campo da cor da equipe -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInput\" class=\"form-label\">Cor da equipe </label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInputPontuacao\" value=\"$registro_equipe->cor_eq\" name=\"coreq\" aria-describedby=\"pontuacaoHelp\" placeholder=\"De acordo com o determinado\">";
echo "    </div>";

// <!-- campo de extras -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInput\" class=\"form-label\">Extras da equipe </label>";
echo "    <input type=\"text\" class=\"form-control\" id=\"exampleInput\" name=\"extraeq\" value=\"$registro_equipe->extra_eq\" aria-describedby=\"rankingHelp\">";
echo "    </div>";

// <!-- campo de status -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputStatus\" value=\"$registro_equipe->status_eq\" name=\"status\" aria-describedby=\"statusHelp\">";

// <!-- botão para enviar informações do formulário -->
echo "    <button type=\"submit\"  name=\"submit\"  class=\"btn btn-primary\">Alterar</button>";

}

// <!-- fim do formulário -->
echo "    </form>";

echo "    <br>";

// <!-- fim da div de formulário -->
echo "</div>";

    }elseif($id_pesquisa == 4){

                
// <!-- Começo da caixa de incluir no css -->
echo "<div id=\"incluir\">";

// <!-- titulo da caixa de incluir -->

// pesquisa do tema
$dados = $repositorioNoticias->buscarNoticia($id_filtro);

// Abrindo o meio de coleta dos dados
while($registro_noticias= $dados->fetch_object()){

echo "<br>";
echo "<h2>Alterar noticia: </h2>";
echo "<br>";

// <!-- começo do formulário -->
echo "    <form class=\"mx-auto\" action=\"../../alteracoes/16\" enctype=\"multipart/form-data\" method=\"POST\" style=\"width: 400px;\">";

// <!-- campo do id da noticia -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputId\" value=\"$registro_noticias->id_not\" name=\"id\" aria-describedby=\"idHelp\">";

// <!-- campo de titulo da noticia -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputNomeequipe\" class=\"form-label\">Titulo da noticia </label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_noticias->titulo_not\" name=\"titulonot\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo da descricao da noticia -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Descricao da noticia</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_noticias->descricao_not\" name=\"descricaonot\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo da data da noticia -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputPontdia\" class=\"form-label\">Data da noticia </label>";
echo "    <input type=\"date\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_noticias->data_not\" name=\"datanot\" aria-describedby=\"idequipeHelp\">";
echo "    </div>";

// <!-- campo da foto da noticia -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputDiapont\" class=\"form-label\">Foto da noticia </label>";
echo "    <input type=\"file\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_noticias->foto_not\" name=\"fotonot\" aria-describedby=\"diapontHelp\" >";
echo "    </div>";

// <!-- campo de status -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputStatus\" value=\"$registro_noticias->status_not\" name=\"status\" aria-describedby=\"statusHelp\">";

// <!-- botão para enviar informações do formulário -->
echo "    <button type=\"submit\"  name=\"submit\"  class=\"btn btn-primary\">Alterar</button>";

}

// <!-- fim do formulário -->
echo "    </form>";

echo "    <br>";

// <!-- fim da div de formulário -->
echo "</div>";

    }elseif($id_pesquisa == 5){

        // <!-- Começo da caixa de incluir no css -->
echo "<div id=\"incluir\">";

// <!-- titulo da caixa de incluir -->

// pesquisa do tema
$dados = $repositorioFotos->buscarFoto($id_filtro);

// Abrindo o meio de coleta dos dados
while($registro_fotos= $dados->fetch_object()){

echo "<br>";
echo "<h2>Alterar foto: </h2>";
echo "<br>";

// <!-- começo do formulário -->
echo "    <form class=\"mx-auto\" action=\"../../alteracoes/17\" method=\"POST\"  enctype=\"multipart/form-data\" style=\"width: 400px;\">";

// <!-- campo do id -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputId\" value=\"$registro_fotos->id_foto\" name=\"id\" aria-describedby=\"idHelp\">";

// <!-- campo de titulo da foto -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputNomeequipe\" class=\"form-label\">Titulo da foto</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_fotos->titulo_foto\" name=\"titulofoto\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo de descricao da foto -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Descrição da foto</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_fotos->descricao_foto\" name=\"descricaofoto\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo do ano desta foto -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputPontdia\" class=\"form-label\">Ano da foto</label>";
echo "    <input type=\"year\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_fotos->ano_foto\" name=\"anofoto\" aria-describedby=\"idequipeHelp\" placeholder=\"2007\">";
echo "    </div>";

// <!-- campo do arquivo da foto -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputDiapont\" class=\"form-label\">Arquivo da foto </label>";
echo "    <input type=\"file\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_fotos->arquivo_foto\" name=\"arquivofoto\" aria-describedby=\"diapontHelp\" >";
echo "    </div>";

// <!-- campo de status -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputStatus\" value=\"$registro_fotos->status_foto\" name=\"status\" aria-describedby=\"statusHelp\">";

// <!-- botão para enviar informações do formulário -->
echo "    <button type=\"submit\"  name=\"submit\"  class=\"btn btn-primary\">Alterar</button>";

// <!-- fim do formulário -->
echo "    </form>";

}

echo "    <br>";

// <!-- fim da div de formulário -->
echo "</div>";

    }elseif($id_pesquisa == 6){

                        
        
// <!-- Começo da caixa de incluir no css -->
echo "<div id=\"incluir\">";

// <!-- titulo da caixa de incluir -->

// pesquisa do tema
$dados = $repositorioGincanas->buscarGincana($id_filtro);

// Abrindo o meio de coleta dos dados
while($registro_gincanas= $dados->fetch_object()){

echo "<br>";
echo "<h2>Alterar gincana </h2>";
echo "<br>";

// <!-- começo do formulário -->
echo "    <form class=\"mx-auto\" action=\"../../alteracoes/18\" method=\"POST\" enctype=\"multipart/form-data\" style=\"width: 400px;\">";

// <!-- campo do id -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputId\" value=\"$registro_gincanas->id_gin\" name=\"id\" aria-describedby=\"idHelp\">";

// <!-- campo de nome da gincana -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputNomegin\" class=\"form-label\">Nome da gincana</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_gincanas->nome_gin\"  name=\"nomegin\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo das regras da gincana -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Regras da gincana</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_gincanas->regras_gin\"  name=\"regrasgin\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";


// <!-- campo do primeiro criterio da gincana -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Criterio 1</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_gincanas->crie_1\"  name=\"crie1\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo do segundo criterio da gincana -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Criterio 2</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_gincanas->crie_2\"  name=\"crie1\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo do terceiro criterio da gincana -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Criterio 3</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_gincanas->crie_3\"  name=\"crie1\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";


// <!-- campo do exemplo da gincana -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputexemplogin\" class=\"form-label\">Exemplo da gincana</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_gincanas->exemplo_gin\"  name=\"exemplogin\" aria-describedby=\"idequipeHelp\" placeholder=\"2007\">";
echo "    </div>";

// <!-- campo da foto da gincana -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputFotogin\" class=\"form-label\">Foto da gincana </label>";
echo "    <input type=\"file\" class=\"form-control\" id=\"exampleInput\" value=\"$registro_gincanas->foto_gin\"  name=\"fotogin\" aria-describedby=\"diapontHelp\" >";
echo "    </div>";

// <!-- campo do horario da gincana -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInput\" class=\"form-label\">Horario da gincana </label>";
echo "    <input type=\"datetime\" required class=\"form-control\" id=\"exampleInputPontuacao\" value=\"$registro_gincanas->horario_gin\"  name=\"horariogin\" aria-describedby=\"pontuacaoHelp\" placeholder=\"De acordo com o determinado\">";
echo "    </div>";

// <!-- campo de local da gincana -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInput\" class=\"form-label\">Local da gicana </label>";
echo "    <input type=\"text\" class=\"form-control\" id=\"exampleInput\" name=\"localgin\" value=\"$registro_gincanas->local_gin\"  aria-describedby=\"localginHelp\">";
echo "    </div>";

// <!-- campo de status -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputStatus\" value=\"$registro_gincanas->status_gin\"  name=\"status\" aria-describedby=\"statusHelp\">";

// <!-- botão para enviar informações do formulário -->
echo "    <button type=\"submit\"  name=\"submit\"  class=\"btn btn-primary\">Alterar</button>";

// <!-- fim do formulário -->
echo "    </form>";

}

echo "    <br>";

// <!-- fim da div de formulário -->
echo "</div>";

    }elseif($id_pesquisa == 7){

        // <!-- Começo da caixa de incluir no css -->
echo "<div id=\"incluir\">";

// <!-- titulo da caixa de incluir -->

// pesquisa do tema
$dados = $repositorioArq_regras->buscarArq_regras($id_filtro);

// Abrindo o meio de coleta dos dados
while($registro_arqregras= $dados->fetch_object()){

echo "<br>";
echo "<h2>Alterar arquivo de regras </h2>";
echo "<br>";

// <!-- começo do formulário -->
echo "    <form class=\"mx-auto\" action=\"../../alteracoes/19\" enctype=\"multipart/form-data\" method=\"POST\" style=\"width: 400px;\">";

// <!-- campo do id -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputId\" value=\"$registro_arqregras->id_pdfregra\"  name=\"id\" aria-describedby=\"idHelp\">";

// <!-- campo de Id da gincana -->
echo "<div class=\"mb-3\">";
echo "<label for=\"exampleInputEmail1\" class=\"form-label\"> Selecionar gincana </label>";
echo "<br>";
echo "<select name=\"idgincana\">";
echo "<option value=\"$registro_arqregras->gincana_id\">Se quiser manter a mesma</option>";

$dados_ginfil = $repositorioGincanas->listarTodas_crud();
// Abrindo o meio de coleta dos dados
while($registro_gincana = $dados_ginfil->fetch_object()){
    
echo "<option value=\"$registro_gincana->id_gin\">$registro_gincana->nome_gin </option>";

};
echo "</select>";
echo "</div>";

// <!-- campo do titulo do pdf -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputNomegin\" class=\"form-label\">Titulo do pdf</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_arqregras->titulo_pdfregra\" name=\"titulopdfregra\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo da descricao do pdf -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Descricao do pdf</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_arqregras->desc_pdfregra\" name=\"descpdfregra\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo do arquivo do pdf -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputexemplogin\" class=\"form-label\">Arquivo do pdf </label>";
echo "    <input type=\"file\"  class=\"form-control\" id=\"exampleInput\" value=\"$registro_arqregras->arquivo_pdfregra\" name=\"arquivopdfregra\" aria-describedby=\"idequipeHelp\" placeholder=\"2007\">";
echo "    </div>";

// <!-- campo de status -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputStatus\" value=\"$registro_arqregras->status_pdfregra\" name=\"status\" aria-describedby=\"statusHelp\">";

// <!-- botão para enviar informações do formulário -->
echo "    <button type=\"submit\"  name=\"submit\"  class=\"btn btn-primary\">Alterar</button>";

// <!-- fim do formulário -->
echo "    </form>";

}

echo "    <br>";

// <!-- fim da div de formulário -->
echo "</div>";

    }elseif($id_pesquisa == 8){

                // <!-- Começo da caixa de incluir no css -->
echo "<div id=\"incluir\">";

// <!-- titulo da caixa de incluir -->

// pesquisa do tema
$dados = $repositorioArq_avaliativo->buscarArq_avaliativo($id_filtro);

// Abrindo o meio de coleta dos dados
while($registro_arqavaliativo = $dados->fetch_object()){


echo "<br>";
echo "<h2>Alterar arquivo de avaliacao </h2>";
echo "<br>";

// <!-- começo do formulário -->
echo "    <form class=\"mx-auto\" action=\"../../alteracoes/20\" enctype=\"multipart/form-data\" method=\"POST\" style=\"width: 400px;\">";

// <!-- campo do id -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputId\" value=\"$registro_arqavaliativo->id_pdfavaliativo\" name=\"id\" aria-describedby=\"idHelp\">";

// <!-- campo de Id da gincana -->
echo "<div class=\"mb-3\">";
echo "<label for=\"exampleInputEmail1\" class=\"form-label\"> Selecionar gincana </label>";
echo "<br>";
echo "<select name=\"idgincana\">";
echo "<option value=\"$registro_arqavaliativo->gincana_id\">Se quiser manter a mesma</option>";


$dados_ginfil = $repositorioGincanas->listarTodas_crud();
// Abrindo o meio de coleta dos dados
while($registro_gincana = $dados_ginfil->fetch_object()){
    
echo "<option value=\"$registro_gincana->id_gin\">$registro_gincana->nome_gin </option>";

}
echo "</select>";
echo "</div>";

// <!-- campo do titulo do pdf -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputNomegin\" class=\"form-label\">Titulo do pdf</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_arqavaliativo->titulo_pdfavaliativo\" name=\"titulopdfavaliativo\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo da descricao do pdf -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Descricao do pdf</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_arqavaliativo->desc_pdfavaliativo\" name=\"descpdfavaliativo\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo do arquivo do pdf -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputexemplogin\" class=\"form-label\">Arquivo do pdf </label>";
echo "    <input type=\"file\"  class=\"form-control\" id=\"exampleInput\" value=\"$registro_arqavaliativo->arquivo_pdfavaliativo\" name=\"arquivopdfavaliativo\" aria-describedby=\"idequipeHelp\" placeholder=\"2007\">";
echo "    </div>";

// <!-- campo de status -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputStatus\" value=\"$registro_arqavaliativo->status_pdfavaliativo\" name=\"status\" aria-describedby=\"statusHelp\">";

// <!-- botão para enviar informações do formulário -->
echo "    <button type=\"submit\"  name=\"submit\"  class=\"btn btn-primary\">Alterar</button>";

// <!-- fim do formulário -->
echo "    </form>";

}

echo "    <br>";

// <!-- fim da div de formulário -->
echo "</div>";

    }elseif($id_pesquisa == 9){

                        // <!-- Começo da caixa de incluir no css -->
echo "<div id=\"incluir\">";

// <!-- titulo da caixa de incluir -->

// pesquisa do tema
$dados = $repositorioHistoricos->buscarHistorico($id_filtro);

// Abrindo o meio de coleta dos dados
while($registro_historico = $dados->fetch_object()){

echo "<br>";
echo "<h2>Alterar historico: </h2>";
echo "<br>";

// <!-- começo do formulário -->
echo "    <form class=\"mx-auto\" action=\"../../alteracoes/21\" method=\"POST\" enctype=\"multipart/form-data\" style=\"width: 400px;\">";

// <!-- campo do id -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputId\" value=\"$registro_historico->id_hist\" name=\"id\" aria-describedby=\"idHelp\">";

// <!-- campo de ano do historico -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputIdgincana\" class=\"form-label\">ano</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_historico->ano_hist\" name=\"anohist\" aria-describedby=\"idequipeHelp\" placeholder=\"Veja na tabela de gincanas\">";
echo "    </div>";

// <!-- campo do tema do historico -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputNomegin\" class=\"form-label\">Tema do ano </label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_historico->tema_hist\" name=\"temahist\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo do primeiro lugar -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Primeiro lugar</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_historico->primeiro_lugar\" name=\"primeirolugar\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo do segundo lugar -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Segundo lugar</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\"  value=\"$registro_historico->segundo_lugar\" name=\"segundolugar\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo do terceiro lugar -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Terceiro lugar</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_historico->terceiro_lugar\" name=\"terceirolugar\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo da melhor gincana -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Melhor gincana</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\"  value=\"$registro_historico->melhor_gincana\" name=\"melhorgin\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo da foto do historico -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputexemplogin\" class=\"form-label\">Foto do ano </label>";
echo "    <input type=\"file\"  class=\"form-control\" id=\"exampleInput\" value=\"$registro_historico->foto_hist\" name=\"fotohist\" aria-describedby=\"idequipeHelp\" placeholder=\"2007\">";
echo "    </div>";

// <!-- campo de status -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputStatus\" value=\"$registro_historico->status_hist\" name=\"status\" aria-describedby=\"statusHelp\">";

// <!-- botão para enviar informações do formulário -->
echo "    <button type=\"submit\"  name=\"submit\"  class=\"btn btn-primary\">Alterar</button>";

// <!-- fim do formulário -->
echo "    </form>";

}

echo "    <br>";

// <!-- fim da div de formulário -->
echo "</div>";


    }elseif($id_pesquisa == 10){

                                // <!-- Começo da caixa de incluir no css -->
echo "<div id=\"incluir\">";

// <!-- titulo da caixa de incluir -->

// pesquisa do tema
$dados = $repositorioTemas->buscarTema($id_filtro);

// Abrindo o meio de coleta dos dados
while($registro_temas = $dados->fetch_object()){

echo "<br>";
echo "<h2>Alterar tema: </h2>";
echo "<br>";

// <!-- começo do formulário -->
echo "    <form class=\"mx-auto\" action=\"../../alteracoes/22\" method=\"POST\" style=\"width: 400px;\">";

// <!-- campo do id -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputId\" value=\"$registro_temas->id_tema\" name=\"id\" aria-describedby=\"idHelp\">";

// <!-- campo de tema -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputIdgincana\" class=\"form-label\">Tema</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\"  value=\"$registro_temas->tema_tm\" name=\"tematm\" aria-describedby=\"idequipeHelp\" placeholder=\"Veja na tabela de gincanas\">";
echo "    </div>";

// <!-- campo da motivacao do tema -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputNomegin\" class=\"form-label\">Tema do ano </label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_temas->motivacao_tm\" name=\"motivacaotm\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo do primeiro ano de uso do tema -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Primeiro ano de uso</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_temas->primeiro_ano\" name=\"primeiroano\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo de status -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputStatus\" value=\"$registro_temas->status_tm\" name=\"status\" aria-describedby=\"statusHelp\">";

// <!-- botão para enviar informações do formulário -->
echo "    <button type=\"submit\"  name=\"submit\"  class=\"btn btn-primary\">Alterar</button>";

// <!-- fim do formulário -->
echo "    </form>";

}

echo "    <br>";

// <!-- fim da div de formulário -->
echo "</div>";


    }elseif($id_pesquisa == 11){

     // <!-- Começo da caixa de incluir no css -->
echo "<div id=\"incluir\">";

// <!-- titulo da caixa de incluir -->

// pesquisa do tema
$dados = $repositorioUsuarios->buscarUsuario($id_filtro);

// Abrindo o meio de coleta dos dados
while($registro_usuario = $dados->fetch_object()){

echo "<br>";
echo "<h2>Alterar usuario: </h2>";
echo "<br>";

// <!-- começo do formulário -->
echo "    <form class=\"mx-auto\" action=\"../../alteracoes/23\" method=\"POST\" enctype=\"multipart/form-data\" style=\"width: 400px;\">";

// <!-- campo do id -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputId\" value=\"$registro_usuario->id_us\" name=\"id\" aria-describedby=\"idHelp\">";

// <!-- campo do nome do usuario -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputIdgincana\" class=\"form-label\">Nome do usuario </label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_usuario->nome_us\" name=\"nomeus\" aria-describedby=\"idequipeHelp\" placeholder=\"Veja na tabela de gincanas\">";
echo "    </div>";

// <!-- campo do email do usuario  -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputNomegin\" class=\"form-label\">Email do usuario </label>";
echo "    <input type=\"email\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_usuario->email_us\" name=\"emailus\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// inicia a sessão nesta página e coleta os dados nescessários
if(!isset($_SESSION)){
    session_start();
}

$senha = $_SESSION['senha_usuario'];

// <!-- campo da senha do usuario-->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Senha do usuario </label>";
echo "    <input type=\"password\" required class=\"form-control\" id=\"exampleInput\" value=\"$senha\" name=\"senhaus\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo de confirmar senha do usuario-->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Confirmar senha: </label>";
echo "    <input type=\"password\" required class=\"form-control\" id=\"exampleInput\" value=\"$senha\" name=\"confsenha\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo da foto do usuario -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Foto do usuario </label>";
echo "    <input type=\"file\" class=\"form-control\" id=\"exampleInput\"  value=\"$registro_usuario->foto_us\"name=\"fotous\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo de funçao do usuario -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Função do usuario</label>";
echo "    <input type=\"number\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_usuario->funcao_us\"  name=\"funcaous\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo de funcao no evento -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">FNE</label>";
echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_usuario->funcao_no_evento\" name=\"fne\" aria-describedby=\"idequipeHelp\" >";
echo "    </div>";

// <!-- campo de status -->
echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputStatus\" value=\"$registro_usuario->status_us\" name=\"status\" aria-describedby=\"statusHelp\">";

// <!-- botão para enviar informações do formulário -->
echo "    <button type=\"submit\"  name=\"submit\"  class=\"btn btn-primary\">Alterar</button>";

// <!-- fim do formulário -->
echo "    </form>";

}

echo "    <br>";

// <!-- fim da div de formulário -->
echo "</div>";



    }elseif($id_pesquisa == 24){

        // <!-- Começo da caixa de incluir no css -->
   echo "<div id=\"incluir\">";
   
   // <!-- titulo da caixa de incluir -->
   
   // pesquisa do tema
   $dados = $repositorioCarrosel->buscarCarrosel($id_filtro);
   
   // Abrindo o meio de coleta dos dados
   while($registro_carrosel = $dados->fetch_object()){
   
   echo "<br>";
   echo "<h2>Alterar usuario: </h2>";
   echo "<br>";
   
   // <!-- começo do formulário -->
   echo "    <form class=\"mx-auto\" action=\"../../alteracoes/26\" method=\"POST\" enctype=\"multipart/form-data\" style=\"width: 400px;\">";
   
   // <!-- campo do id -->
   echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputId\" value=\"$registro_carrosel->id_cs\" name=\"id_cs\" aria-describedby=\"idHelp\">";
   
   // <!-- campo do nome do usuario -->
   echo "    <div class=\"mb-3\">";
   echo "    <label for=\"exampleInputIdgincana\" class=\"form-label\">Titulo do imagem: </label>";
   echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_carrosel->titulo_cs\" name=\"titulo_cs\" aria-describedby=\"idequipeHelp\" placeholder=\"Veja na tabela de gincanas\">";
   echo "    </div>";
   
   // <!-- campo do email do usuario  -->
   echo "    <div class=\"mb-3\">";
   echo "    <label for=\"exampleInputNomegin\" class=\"form-label\">Ordem da imagem: </label>";
   echo "    <input type=\"number\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_carrosel->ordem_cs\" name=\"ordem_cs\" aria-describedby=\"idequipeHelp\" >";
   echo "    </div>";
   
   // <!-- campo da senha do usuario-->
   echo "    <div class=\"mb-3\">";
   echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Arquivo da imagem: </label>";
   echo "    <input type=\"file\"  class=\"form-control\" id=\"exampleInput\" value=\"$registro_carrosel->arquivo_cs\" name=\"arquivo_cs\" aria-describedby=\"idequipeHelp\" >";
   echo "    </div>";
   
   // <!-- campo de confirmar senha do usuario-->
   echo "    <div class=\"mb-3\">";
   echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Data da imagem: </label>";
   echo "    <input type=\"date\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_carrosel->data_cs\" name=\"data_cs\" aria-describedby=\"idequipeHelp\" >";
   echo "    </div>";
   
   // <!-- campo de status -->
   echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputStatus\" value=\"$registro_carrosel->status_cs\" name=\"status\" aria-describedby=\"statusHelp\">";
   
   // <!-- botão para enviar informações do formulário -->
   echo "    <button type=\"submit\"  name=\"submit\"  class=\"btn btn-primary\">Alterar</button>";
   
   // <!-- fim do formulário -->
   echo "    </form>";
   
   }
   
   echo "    <br>";
   
   // <!-- fim da div de formulário -->
   echo "</div>";
   
   
   
       }elseif($id_pesquisa == 25){

        // <!-- Começo da caixa de incluir no css -->
   echo "<div id=\"incluir\">";
   
   // <!-- titulo da caixa de incluir -->
   
   // pesquisa do tema
   $dados = $repositorioLogo->buscarLogo($id_filtro);
   
   // Abrindo o meio de coleta dos dados
   while($registro_logo = $dados->fetch_object()){
   
   echo "<br>";
   echo "<h2>Alterar Logo: </h2>";
   echo "<br>";
   
   // <!-- começo do formulário -->
   echo "    <form class=\"mx-auto\" action=\"../../alteracoes/27\" method=\"POST\" enctype=\"multipart/form-data\" style=\"width: 400px;\">";
   
   // <!-- campo do id -->
   echo "    <input type=\"hidden\" required class=\"form-control\" id=\"exampleInputId\" value=\"$registro_logo->id_lg\" name=\"id_lg\" aria-describedby=\"idHelp\">";
   
   // <!-- campo do nome do usuario -->
   echo "    <div class=\"mb-3\">";
   echo "    <label for=\"exampleInputIdgincana\" class=\"form-label\">Titulo da logo </label>";
   echo "    <input type=\"text\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_logo->titulo_lg\" name=\"titulo_lg\" aria-describedby=\"idequipeHelp\" placeholder=\"Veja na tabela de gincanas\">";
   echo "    </div>";
   
   // <!-- campo do email do usuario  -->
   echo "    <div class=\"mb-3\">";
   echo "    <label for=\"exampleInputNomegin\" class=\"form-label\">Ano da logo </label>";
   echo "    <input type=\"year\" required class=\"form-control\" id=\"exampleInput\" value=\"$registro_logo->ano_lg\" name=\"ano_lg\" aria-describedby=\"idequipeHelp\" >";
   echo "    </div>";
   
   
   // <!-- campo da senha do usuario-->
   echo "    <div class=\"mb-3\">";
   echo "    <label for=\"exampleInputSalaequipe\" class=\"form-label\">Arquivo da logo </label>";
   echo "    <input type=\"file\" class=\"form-control\" id=\"exampleInput\" value=\"$registro_logo->arquivo_lg\" name=\"arquivo_lg\" aria-describedby=\"idequipeHelp\" >";
   echo "    </div>";
   
   
   // <!-- botão para enviar informações do formulário -->
   echo "    <button type=\"submit\"  name=\"submit\"  class=\"btn btn-primary\">Alterar</button>";
   
   // <!-- fim do formulário -->
   echo "    </form>";
   
   }
   
   echo "    <br>";
   
   // <!-- fim da div de formulário -->
   echo "</div>";
   
   
   
       }

    // fim das variaveis de pesquisa
    ?>


<?php
// começo das variaveis de pesquisa

    if($id_pesquisa == 13){

//  Comçando os comandos in page

if(isset($_POST['submit'])){
    // verifica se o botão de enviar foi clicado

        
                    // captura as diversas variaveis do Ppe
                    $id_pont=      $_POST['id'];
                    $equipe_id=    $_POST['idequipe'];
                    $soma_pont =  $repositorioPpa->atribuir_pontos($equipe_id);
                    echo $soma_pont;
                    $ranking=   0;
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
            $repositorioPpe->alterarPpe($Ppe);

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
            $dados_log = new log($id_correto,'Alterar Ppe','O usuario realizou um comando de Alterar Ppe','CRUD_ALTERAR_Ppe',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
            // executando comando de log!
            $respositorioLogs->cadastrarLogs($dados_log);


    }elseif($id_pesquisa == 14){

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
        $repositorioPpa->alterarPpa($Ppa);

            // Atribuindo os pontos para cada equipe
            $dados = $repositorioEquipes->listarTodas_crud();

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
            $dados_log = new log($id_correto,'Alterar Ppa','O usuario realizou um comando de Alterar Ppa','CRUD_ALTERAR_Ppa',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
            // executando comando de log!
            $respositorioLogs->cadastrarLogs($dados_log);
    }elseif($id_pesquisa == 15){

//  Comçando os comandos in page

echo "aqui estamos";

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

        print_r($equipe);

        // enviando para realizar o cadastro
        $repositorioEquipes->alterarEquipe($equipe);

        echo "aqui ficaremos";

        
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
            $dados_log = new log($id_correto,'Alterar equipe','O usuario realizou um comando de Alterar equipe','CRUD_ALTERAR_EQUIPE',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
            // executando comando de log!
            $respositorioLogs->cadastrarLogs($dados_log);
            
    }elseif($id_pesquisa == 16){

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
        $repositorioNoticias->alterarNoticia($noticia);

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
            $dados_log = new log($id_correto,'Alterar noticia','O usuario realizou um comando de Alterar noticia','CRUD_ALTERAR_NOTICIA',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
            // executando comando de log!
            $respositorioLogs->cadastrarLogs($dados_log);
    }elseif($id_pesquisa == 17){

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
        $repositorioFotos->alterarFoto($foto);

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
            $dados_log = new log($id_correto,'Alterar foto','O usuario realizou um comando de Alterar foto','CRUD_ALTERAR_FOTO',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
            // executando comando de log!
            $respositorioLogs->cadastrarLogs($dados_log);
    }elseif($id_pesquisa == 18){

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
        $repositorioGincanas->alterarGincana($gincana);



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
            $dados_log = new log($id_correto,'Alterar gincana','O usuario realizou um comando de Alterar gincana','CRUD_ALTERAR_GINCANA',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
            // executando comando de log!
            $respositorioLogs->cadastrarLogs($dados_log);

    }elseif($id_pesquisa == 19){


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
        $repositorioArq_regras->alterarArq_regras($arqregras);

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
            $dados_log = new log($id_correto,'Alterar arquivo de regra','O usuario realizou um comando de Alterar arquivo de regra','CRUD_ALTERAR_ARQREGRA',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
            // executando comando de log!
            $respositorioLogs->cadastrarLogs($dados_log);

    }elseif($id_pesquisa == 20){

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
        $repositorioArq_avaliativo->alterarArq_avaliativo($arqavaliativo);

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
            $dados_log = new log($id_correto,'Alterar arquivo avaliativo','O usuario realizou um comando de Alterar arquivo avaliativo','CRUD_ALTERAR_ARQAVALIATIVO',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
            // executando comando de log!
            $respositorioLogs->cadastrarLogs($dados_log);

    }elseif($id_pesquisa == 21){

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
        $repositorioHistoricos->alterarHistorico($historico);

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
            $dados_log = new log($id_correto,'Alterar historico','O usuario realizou um comando de Alterar historico','CRUD_ALTERAR_HISTORICO',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
            // executando comando de log!
            $respositorioLogs->cadastrarLogs($dados_log);

    }elseif($id_pesquisa == 22){


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
        $repositorioTemas->alterarTema($tema);

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
            $dados_log = new log($id_correto,'Alterar tema','O usuario realizou um comando de Alterar tema','CRUD_ALTERAR_TEMA',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
            // executando comando de log!
            $respositorioLogs->cadastrarLogs($dados_log);

    }elseif($id_pesquisa == 23){

//  Comçando os comandos in page

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
       $repositorioUsuarios->alterarUsuario($usuario);

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
           // $dados_log = new log($id_correto,'Alterar usuario','O usuario realizou um comando de Alterar usuario','CRUD_ALTERAR_USUARIO',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
           // // executando comando de log!
           // $respositorioLogs->cadastrarLogs($dados_log);
        }else{
            echo "Senhas não se conhecidem! Retorne e digite as senhas novamente!";
            exit;
        }
}

    }elseif($id_pesquisa == 26){

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
               $repositorioCarrosel->alterarCarrosel($carrosel);
        
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
                   // $dados_log = new log($id_correto,'Alterar usuario','O usuario realizou um comando de Alterar usuario','CRUD_ALTERAR_USUARIO',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
                    
                   // // executando comando de log!
                   // $respositorioLogs->cadastrarLogs($dados_log);
        }
        
            }elseif($id_pesquisa == 27){

                //  Comçando os comandos in page
                
                if(isset($_POST['submit'])){
                // verifica se o botão de enviar foi clicado
                
                                // captura as diversas variaveis do Ppe
                                $id_lg   =               $_POST['id_lg'];
                                $titulo_lg  =              $_POST['titulo_lg'];
                                $ano_lg  =             $_POST['ano_lg'];
                                // $arquivo_lg   =            $_POST['arquivo_lg'];
                
                                $foto = $_FILES['arquivo_lg'];
                
                                $encontrou = $repositorioLogo->verificaFoto($foto);

                                                                        // inicia a sessão nesta página e coleta os dados nescessários
                                                                        if(!isset($_SESSION)){
                                                                            session_start();
                                                                        }
                                                    
                                                                        $id_ult_atz = $_SESSION['id_usuario'];
                
                                // colocando todas as variaveis juntas
                                $logo = new Logo($id_lg, $titulo_lg, $ano_lg, $encontrou, $id_ult_atz);
                        

                       // enviando para realizar o cadastro
                       $repositorioLogo->alterarLogo(logo: $logo);
                
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
                           // $dados_log = new log($id_correto,'Alterar usuario','O usuario realizou um comando de Alterar usuario','CRUD_ALTERAR_USUARIO',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
                            
                           // // executando comando de log!
                           // $respositorioLogs->cadastrarLogs($dados_log);
                }
                
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