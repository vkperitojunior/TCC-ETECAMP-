<?php 
// começo do php do head

$id = isset($id) ? $id : null;

// echo $id;

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

        
        
// <!-- Começo da caixa de incluir no css -->
echo "<div id=\"incluir\">";

// <!-- titulo da caixa de incluir -->


echo "<br>";
echo "<h2>Registro pontos por atividade: </h2>";
echo "<br>";

// <!-- começo do formulário -->
echo "    <form class=\"mx-auto\" action=\"../avaliacoes/13\"  method=\"POST\" style=\"width: 400px;\">";

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
$dados_filgin = $repositorioGincanas->buscarGincana($id);

// Abrindo o meio de coleta dos dados
while($registro_gincana = $dados_filgin->fetch_object()){
    
echo "<option value=\"$registro_gincana->id_gin\">$registro_gincana->nome_gin </option>";


echo "</select>";
echo "</div>";

// <!-- campo do criterio 1 -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputIdgincana\" class=\"form-label\">$registro_gincana->crie_1</label>";
echo "    <input type=\"number\" required class=\"form-control\" id=\"exampleInput\" name=\"crie1\" aria-describedby=\"idequipeHelp\" placeholder=\"9\">";
echo "    </div>";


// <!-- campo do criterio 2 -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputIdgincana\" class=\"form-label\">$registro_gincana->crie_2</label>";
echo "    <input type=\"number\" required class=\"form-control\" id=\"exampleInput\" name=\"crie2\" aria-describedby=\"idequipeHelp\" placeholder=\"10\">";
echo "    </div>";


// <!-- campo do criterio 3 -->
echo "    <div class=\"mb-3\">";
echo "    <label for=\"exampleInputIdgincana\" class=\"form-label\">$registro_gincana->crie_3</label>";
echo "    <input type=\"number\" required class=\"form-control\" id=\"exampleInput\"name=\"crie3\" aria-describedby=\"idequipeHelp\" placeholder=\"8\">";
echo "    </div>";

}

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

    // fim das variaveis de pesquisa
    ?>

    <?php
    
    if($id_include == 13){
        
        
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
            $dados_log = new log($id_correto,'Inserir pontuacao diaria','O usuario realizou um comando de inserir pontuacao diaria','AVALIADOCAO_DIARIA',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
            // executando comando de log!
            $repositorioLogs->cadastrarLogs($dados_log);
        
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