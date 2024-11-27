<?php 
// começo do php do head

// link qe vai para a classe php com todos os links e conexões
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



// criando as pesquisas para que possa ser utilizado no corpo da pontuação

// pesquisa do tema
$dados_temas = $repositorioTemas->buscarUltimoTema();

// pesquisa das esquipes
$dados_equipes = $repositorioEquipes->listarTodasEquipes();

// pesquisa do horario e local das gincanas
$dados_gincanas = $repositorioGincanas->listarTodasGincanas();

// pesquisa das noticias
$dados_noticias = $repositorioNoticias->buscarUltimaNoticia();

// pesquisa da pontuação por dia
$dados_Ppe = $repositorioPpe->listarTodos_crud();

// pesquisa da pontuação por gincana
$dados_Ppa = $repositorioPpa->listarTodosPpa();

// pesquisa da pontuação por gincana
$dados_usuarios = $repositorioUsuarios->listarTodosUsuarios();

// Conferindo se há alguma sessão aberta, se não, abrimos a sessão e pegamos os dados
    if(!isset($_SESSION)){
        session_start();
    }

    // se haver email, tem gente logada, indo para um cabeçalho diferente
    $condicao = isset($_SESSION['email_usuario']);

/*   aqui esta o link para o banco de dados */
    include_once 'backend/conexao/script/conexao.php';

    //  Links para os repositórios de códigos das classes
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
    <title>Gincanas_spf</title>


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
    <link rel="stylesheet" href="frontend/public/css/pontuacoes.css">



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
    <li class="breadcrumb-item active" aria-current="page">Pontuações</li>
  </ol>
</nav>

<!-- aqui temos o titulo principal do wbsite -->
<h1>Pontuações</h1>

<!-- ------------------------------------------------------------------------------------- COMEÇO DAS TABELAS ---------------------------------------------------------------------------------------------- -->

<!-- titulo da primeira tabela-->
<h1>Tabela de Pontuações por Equipe</h1>

<!-- TABELA: Pontuações por dia ************************************************************************************************************************* -->
<div class="row">

<!-- foi separada uma linha só para ele -->
<div class="col-sm-12">

        <!-- aqui iniciamos a tabela -->
        <table class="table table-hover border border-dark p-5">
            

        <!-- aqui criamos o cabeçalho da tabela -->

            <!-- iniciando uma linha para o cabcalho -->
            <tr>

            <th scope="col">Id da Equipe - Nome</th>
            <th scope="col">Pontuação</th>
            <th scope="col">Ranking</th>
            <th scope="col">Observações</th>
            <th scope="col">Saiba mais</th>

            </tr>
            <!-- fechando a linha do cabecalho -->

        <!-- final do cabecalho da tabela -->

        <!-- aqui appendamos os resultados dos gráficos -->

<?php
// inicio do php de pesquisa
while($registro_Ppe = $dados_Ppe->fetch_object()){
?>
            <!-- iniciando uma linha para colocar os resultados -->
            <tr>

            <?php

            $dados_fileq = $repositorioEquipes->buscarEquipe($registro_Ppe->equipe_id);
            while($registro_fileq = $dados_fileq->fetch_object()){

            // <!-- primeiro campo: idequipe  -->
            echo "<td> $registro_Ppe->equipe_id - $registro_fileq->nome_eq</td>";

            }

            ?>


            <!-- terceiro campo: pontuação -->
            <td><?php echo $registro_Ppe->soma_pont;?></td>
            <!-- quarto campo:  ranking -->
            <td><?php echo $registro_Ppe->ranking;?></td>
            <!-- quinto campo: observações -->
            <td><?php echo $registro_Ppe->obs_pont;?></td>
            <!-- quinto campo: observações -->
             <!-- quarto campo: Consultar -->
            <td><a href="./ppa/<?php echo $registro_Ppe->equipe_id;?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-data" viewBox="0 0 16 16">
            <path d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0z"/>
            <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z"/>
            <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z"/>
            </svg></a></td>
          
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
<!-- FINAL DO TABELA DE: pontuações por dia *********************************************************************************************************** --> 

<br> 
<!-- espaçamento entre tabelas -->


<!-- ------------------------------------------------------------------------------------- COMEÇO DOS GRÁFICOS ---------------------------------------------------------------------------------------------- -->
    
<h1>Gráfico de pontuações</h1>
<!-- gráfico 1 -->
    <div class="img-grafico">
        <img src="frontend/public/imagens/graficos_nativos/grafico_pontuacao.png" alt="grafico de pontuacoes">
    </div>

<h1>Gráfico de eficiencia</h1>
<!-- gráfico 2 -->
    <div class="img-eficiencia">
        <img src="frontend/public/imagens/graficos_nativos/grafico_eficiencia.png" alt="grafico de eficiencia">
    </div>

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