<?php 
// começo do php do head


// link qe vai para a classe php com todos os links e conexões
include_once 'backend/conexao/script/conexao.php';
require_once 'autoload.php';

// require_once 'backend/objetos/class_IRepositorioArq_avaliativo.php';
//   backend/objetos/class_IRepositorioArq_avaliativo.php
// require_once 'backend/objetos/class_IRepositorioArq_regras.php';
// require_once 'backend/objetos/class_IRepositorioEquipes.php';
// require_once 'backend/objetos/class_IRepositorioFotos.php';
// require_once 'backend/objetos/class_IRepositorioGincanas.php';
// require_once 'backend/objetos/class_IRepositorioHistorico.php';
// require_once 'backend/objetos/class_IRepositorioLogs.php';
// require_once 'backend/objetos/class_IRepositorioNoticias.php';
// require_once 'backend/objetos/class_IRepositorioPpa.php';
// require_once 'backend/objetos/class_IRepositorioPpe.php';
// require_once 'backend/objetos/class_IRepositorioTemas.php';
// require_once 'backend/objetos/class_IRepositorioUsuarios.php';


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

// // Chame a função autoload para incluir as páginas
page_autoloader($pages);

// criando as pesquisas para que possa ser utilizado no corpo da home
$repositorioArq_avaliativo = new RepositorioArq_avaliativoMYSQL(); 
$repositorioArq_regras = new RepositorioArq_regrasMYSQL(); 
$repositorioTemas = new RepositorioTemasMYSQL(); 
$respositorioFotos = new RepositorioFotoMYSQL(); 
$repositorioEquipes = new RepositorioEquipeMYSQL(); 
$repositorioGincanas = new RepositorioGincanaMYSQL(); 
$repositorioHistoricos = new RepositorioHistoricoMYSQL(); 
$repositorioLogs = new RepositorioLogsMYSQL(); 
$repositorioNoticias = new RepositorioNoticiaMYSQL(); 
$repositorioPpe = new RepositorioPpeMYSQL(); 
$repositorioPpa = new RepositorioPpaMYSQL();
$repositorioUsuarios = new RepositorioUsuarioMYSQL();    

// link qe vai para o protetor
include_once 'backend/conexao/script/protect.php';

// criando as pesquisas para que possa ser utilizado no corpo da home

// pesquisa da pontuação por gincana
$dados_logs = $repositorioLogs->listarTodosLogs();

// pesquisa da pontuação por gincana
$dados_usuarios = $repositorioUsuarios->listarTodosUsuarios();

// Conferindo se há alguma sessão aberta, se não, abrimos a sessão e pegamos os dados
    if(!isset($_SESSION)){
        session_start();

                // captura as diversas variaveis do usuario
                $id_usuario =$_SESSION['id_usuario'];
                $nome_usuario=$_SESSION['nome_usuario'];
                $email_usuario=$_SESSION['email_usuario'];
                $funcao_usuario=$_SESSION['funcao_usuario'];
                $status_usuario=$_SESSION['status_usuario'];
                $foto_usuario=$_SESSION['foto_usuario'];
                $funcao_usuario=$_SESSION['funcao_usuario'];
    
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

    <!-- titulo da página home do website -->
    <title>logs_spf</title>

    <!-- icone do website -->
    <link rel="icon" href="">


    <!-- definições de estilo geral -->
    <link rel="stylesheet" href="frontend/public/css/home.css">
    <!-- definições de estilo especificas -->
    <link rel="stylesheet" href="">


    <!-- Arquivos de css do bootstrap -->
    <link href="frontend/public/bootstrap/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- fim dos arquivos de bootstrap -->


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
<!-- diretorio usado pelo tradutor de libras durante a tradução->podeser personalizado -->
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
  </script>

<!-- Começando um container para que seja possivel identificar onde começa a página -->
    <div class="container-fluid">

<!-- Aqui esta o navbar de nosso site, onde as informações sempre serão iguais em todas as páginas --

<!-- botão para voltar para a página de adm -->
<button><a href="./administrativo">    
<!-- icone de voltar -->
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
</svg> 
Voltar
</a></button>

<br>
    
<!-- ------------------------------------------------------------------------------------- COMEÇO DO MEIO ---------------------------------------------------------------------------------------------- -->

        <!-- começo do formulário de pesquisa -->
        <form class="mx-auto" action="./logsY" method="POST" style="width: 400px;">

        <!-- campo de email -->
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">email do usuario</label>
        <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="use @">
        </div>
        <!-- campo de id -->
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">id do usuario</label>
        <input type="number" class="form-control" id="exampleInputid" name="id" aria-describedby="idHelp" placeholder="Apenas 1 numero">
        </div>
        <!-- campo de data -->
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">data do ocorrido</label>
        <input type="data" class="form-control" id="exampleInputData" name="data" aria-describedby="dataHelp">
        </div>
        <!-- campo de hora -->
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Hora do ocorrido</label>
        <input type="time" class="form-control" id="exampleInputhora" name="hora" aria-describedby="horaHelp">
        </div>
        <!-- campo de sessão -->
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Sessão</label>
        <select name="sessao">
        <option value="LOGIN_COM_SUCE">LOGIN_COM_SUCESSO</option>
        <option value="LOGIN_INVA">LOGIN_INVALIDO</option>
        <option value="CAPTCHA_INVA">CAPTCHA_INVALIDO</option>
        <option value="INSERIR_US">INSERIR_USUARIO</option>
        <option value="CRUD_INSERIR">CRUD_INSERIR</option>
        <option value="CRUD_EXCLUIR_OP">CRUD_EXCLUIR</option>
        <option value="CRUD_PESQUISAR">CRUD_PESQUISAR</option>
        <option value="CRUD_ALTERAR">CRUD_ALTERAR</option>
        <option value="CRUD_GERARCSV">GERAR_CSV</option>
        <option value="CRUD_REMOVERTODOS">REMOVER_TODOS</option>
        <option value="CRUD_ATIVARTODOS">ATIVAR_TODOS</option>
        <option value="CRUD_DESATIVARTODOS">DESATIVAR_TODOS</option>
        <option value="ALTERAR_PERFIL">ALTERAR_PERFIL</option>
        <option value="FALTERAR_PERFIL">FALTERAR_PERFIL</option>
        <option value="PESQUISA_">PESQUISAR_LOGS</option>
        <option value="SENVIAR_EM">SENVIAR_EMAIL</option>
        <option value="FENVIAR_EM">FENVIAR_EMAIL</option>
        </select>
        </div>
        <!-- botão para enviar informações do formulário -->
        <button type="submit" name="searche_submit" class="btn btn-primary">
        <!-- colocando um icone de pesquisa junto do botão -->
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
        </svg>
        Pesquisar 
        </button>


        <br>

        <!-- começo do formulário de pesquisa geral -->
        <form class="mx-auto" action="#" method="POST" style="width: 400px;">

        <br>

        <!-- botão para enviar informações do formulário -->
        <button type="submit" name="searche_all" class="btn btn-primary">

        <!-- colocando um icone de pesquisa junto do botão -->
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
        </svg>
        Pesquisar todos os registros
        </button>

        <br>
        <br>

        <!-- Começo dos botões de ativar registros, desativar registros,excluir todos, gerar csv -->
        <div class="d-grid gap-2\">

        <button class="btn btn-primary" type="button"> <a href="./csvs/13"> Gerar CSV</a> </button>

        <br>

        <button class="btn btn-primary" type="button"> <a href="./xls/13"> Gerar Excel</a> </button>

        <br>

        </div>
        <!-- fim dos botões -->

        <!-- fim do formulário -->
        </form>
        <!-- fim dos botões -->

        <!-- espaço entre o formulário de pesquisa e as tabelas de dados -->
        <br>

        <!-- começo do php para exibir tabela de logs de acordo com a pesquisa do usuario -->
        <?php

        if(isset($_POST['searche_all'])){

        // <!-- titulo da primeira tabela-->
        echo "<h1> Tabela de Logs Geral </h1>";

        // mostrando a quantidade de linhas 
        echo "<h2> Quantidade de linhas: $dados_logs->num_rows </h2>";

        echo "<div class=\"row\">";

        // <!-- foi separada uma linha só para ele -->
        echo "<div class=\"col-sm-12\">";

        // <!-- aqui iniciamos a tabela -->
        echo "<table class=\"table table-hover border border-dark p-3\">";

        // <!-- aqui criamos o cabeçalho da tabela -->
        // echo "<thead>";
            // <!-- iniciando uma linha para o cabcalho -->
            echo "<tr>";

          echo "<th scope=\"col\">ID</th>";        
          echo "<th scope=\"col\">Titulo</th>";
          echo "<th scope=\"col\">Descrição</th>";
          echo "<th scope=\"col\">Data</th>";
          echo "<th scope=\"col\">Hora</th>";
          echo "<th scope=\"col\">Id do usuario</th>";
          echo "<th scope=\"col\">Email do usuario</th>";
          echo "<th scope=\"col\">Geolocalização</th>";
          echo "</tr>";

            // <!-- fechando a linha do cabecalho -->
        // echo "</thead>";
        // <!-- final do cabecalho da tabela -->

        // <!-- aqui appendamos os resultados dos gráficos -->
        // echo "<tbody>";

        // inicio da pesquisa
        while($registro_logs = $dados_logs->fetch_object()){

            // iniciando uma linha para colocar os resultados
            echo "<tr>";

            // <!-- zero campo: id_log  -->
            echo "<td> $registro_logs->id_log;</td>";
            // <!-- primeiro campo: titulo_log  -->
            echo "<td> $registro_logs->titulo_log;</td>";
            // <!-- segundo campo: descricao_log  -->
            echo "<td> $registro_logs->descricao_log;</td>";
            // <!-- terceiro campo: data_log -->
            echo "<td> $registro_logs->data_log;</td>";
            // <!-- quarto campo: hora_log  -->
            echo "<td> $registro_logs->hora_log;</td>";
            // <!-- quinto campo: id_usuario -->
            echo "<td> $registro_logs->usuario_id;</td>";
            // <!-- sexto campo: email_usuario -->
            echo "<td> $registro_logs->usuario_email;</td>";
            // <!-- setimo campo: geolocalizacao_log -->
            echo "<td> $registro_logs->geolocalizacao_log;</td>";
          
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

            // criando variavel com dados
            $dados_log = new log($id_correto,'Pesquisar logs gerais','O usuario realizou um comando de pesquisar logs no geral','PESQUISAR_LOGS',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
        
            // executando comando de log!
            $repositorioLogs->cadastrarLogs($dados_log);

        }elseif(isset($_POST['searche_submit']) ){

            $retorno_pesquisa = $repositorioLogs->pesquisarLogs($_POST['id'],$_POST['email'],$_POST['data'],$_POST['hora'],$_POST['sessao']);

            // <!-- titulo da primeira tabela-->
        echo "<h1> Tabela de Logs Geral </h1>";
                
        // mostrando a quantidade de linhas 
        echo "<h2> Quantidade de linhas: $dados_logs->num_rows </h2>";

        echo "<div class=\"row\">";

        // <!-- foi separada uma linha só para ele -->
        echo "<div class=\"col-sm-12\">";

        // <!-- aqui iniciamos a tabela -->
        echo "<table class=\"table table-hover border border-dark p-3\">";

        // <!-- aqui criamos o cabeçalho da tabela -->
        // echo "<thead>";
            // <!-- iniciando uma linha para o cabcalho -->
            echo "<tr>";

          echo "<th scope=\"col\">ID</th>";        
          echo "<th scope=\"col\">Titulo</th>";
          echo "<th scope=\"col\">Descrição</th>";
          echo "<th scope=\"col\">Data</th>";
          echo "<th scope=\"col\">Hora</th>";
          echo "<th scope=\"col\">Id do usuario</th>";
          echo "<th scope=\"col\">Email do usuario</th>";
          echo "<th scope=\"col\">Geolocalização</th>";
          echo "</tr>";

            // <!-- fechando a linha do cabecalho -->
        // echo "</thead>";
        // <!-- final do cabecalho da tabela -->

        // <!-- aqui appendamos os resultados dos gráficos -->
        // echo "<tbody>";

        // inicio da pesquisa
        while($registro_logs = $retorno_pesquisa->fetch_object()){

            // iniciando uma linha para colocar os resultados
            echo "<tr>";

            // <!-- zero campo: id_log  -->
            echo "<td> $registro_logs->id_log;</td>";
            // <!-- primeiro campo: titulo_log  -->
            echo "<td> $registro_logs->titulo_log;</td>";
            // <!-- segundo campo: descricao_log  -->
            echo "<td> $registro_logs->descricao_log;</td>";
            // <!-- terceiro campo: data_log -->
            echo "<td> $registro_logs->data_log;</td>";
            // <!-- quarto campo: hora_log  -->
            echo "<td> $registro_logs->hora_log;</td>";
            // <!-- quinto campo: id_usuario -->
            echo "<td> $registro_logs->usuario_id;</td>";
            // <!-- sexto campo: email_usuario -->
            echo "<td> $registro_logs->usuario_email;</td>";
            // <!-- setimo campo: geolocalizacao_log -->
            echo "<td> $registro_logs->geolocalizacao_log;</td>";
          
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

            
            $dados_log = new log($id_correto,'Pesquisar logs com filtro','O usuario realizou um comando de pesquisar logs com filtro','PESQUISAR_LOGS',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 

            // executando comando de log!
            $repositorioLogs->cadastrarLogs($dados_log);

        }else{
            echo "Pesquisa ainda não realizada";
        }

        ?>
        <!-- fim do php -->

        <br>


<!-- ------------------------------------------------------------------------------------- COMEÇO DO RODAPÉ ---------------------------------------------------------------------------------------------- -->

<div class="card">
    <div class="card-header">
      <!-- Indicação de copyright -->
        Copyright @Sistema Paulo Freire - 2024
    </div>
    <div class="card-body">

    <!-- informações da escola dona -->
    <h5 class="card-title">ETEC de Campo Limpo Paulista - Endereço: R. João Julião Moreira, s/n - Botujuru, Campo Limpo Paulista - SP, 13238-470</h5>
    <p class="card-text">Telefone: (11) 4812-2966</p>

    <!-- botão de voltar ao topo -->
    <a href="#topo" class="btn btn-primary">Voltar ao topo</a>

    <!-- espaço para o botão de entrar em contato -->
    <br>
    <br>

    <a href="./sendemail" class="btn btn-primary">Entrar em contato com email</a>

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