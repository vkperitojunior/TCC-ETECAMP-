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
$repositorioCarrosel = new RepositorioCarroselMYSQL(); 
$repositorioLogo = new RepositorioLogoMYSQL();
$repositorioCarrosel = new RepositorioCarroselMYSQL(); 


// pesquisa do tema
$dados_carrosel = $repositorioCarrosel->listarTodos_crud();

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
    <title>Home_spf</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />

    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">


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
    <link rel="stylesheet" href="frontend/public/css/home.css">

   

    




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



<!-- Overlay e popup para cookies-->


<!-- <div class="overlay" id="overlay"></div> -->

<!-- Popup -->
<!-- <div class="popup" id="popup">
    <p>Bem-vindo! um pequeno aviso...</p>
    <p>Este site coleta cokies para sua segurança!</p>
    <a href="frontend/public/pdf/cookies/cookies demo.pdf" download="cookies_spf">  
                Baixe o documento
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0"/>
                </svg>
     </a>
    <br>
    <button class="close" id="closePopup"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
</svg></button>
</div>

<script>

// Função para definir um cookie
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

// Função para obter um cookie
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

// Função para verificar se o popup já foi exibido
function checkPopup() {
    var popupExibido = getCookie("popup_exibido");
    if (!popupExibido) {
        // Se o cookie não existir, exibe o popup e define o cookie
        showPopup();
        setCookie("popup_exibido", "true", 1); // Define o cookie por 1 dia
    }
}

// Função para mostrar o popup
function showPopup() {
    document.getElementById('overlay').style.display = 'block';
    document.getElementById('popup').style.display = 'block';
}

// Função para fechar o popup
function closePopup() {
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('popup').style.display = 'none';
}

// Mostra o popup automaticamente se necessário quando a página é carregada
window.onload = function() {
    checkPopup();
}

// Fecha o popup quando o botão de fechar é clicado
document.getElementById('closePopup').addEventListener('click', function() {
    closePopup();
});
</script> -->



<!-- ------------------------------------------------------------------------------------- COMEÇO DO TITULO, LOGO E CARROSEL ---------------------------------------------------------------------------------------------- -->


   

    <section class="cabecalho" id="cabecalho">
        <div class="cabecalho-content">
            <h1> Seja Bem Vindo(a) ao <span> Sistema Paulo Freire <span> </h1>
            <p>O sistema Paulo Freire é um site criado de alunos para alunos, sua proposta é otimizar a experiência durante a semana Paulo Freire. No site você pode encontrar informações importantes sobre a PF, visualizar fotos na galeria, ficar informado caso algum acontecimento importante ocorra além de acompanhar o ranking de maneira atualizada e dinâmica. Sendo assim você consegue encontrar todas as informações importantes em apenas um lugar de maneira simples e prática</p>
            <a href="./sobre" class="btn">Saiba Mais</a>
        </div>

        <div class="cabecalho-img">
            <img src="frontend/public/imagens/imagens_home/Paulo Freire 1 Light Mode.png" id="img-light-mode" alt="Paulo Freire Art">
        </div>
       
    </section>

    



<!-- aqui faremos um carrosel de imagens -->

<div class="carousel">
    <div class="slides">
        <img src="frontend/public/imagens/geral/Semana_Paulo_Freire_2024_img12.jpg" alt="Imagem 1">
        <img src="frontend/public/imagens/geral/Semana_Paulo_Freire_2024_img11.jpg" alt="Imagem 2">
        <img src="frontend/public/imagens/geral/Semana_Paulo_Freire_2024_img9.jpg" alt="Imagem 3">
    </div>
    <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
    <button class="next" onclick="moveSlide(1)">&#10095;</button>
</div>


<!-- ------------------------------------------------------------------------------------- COMEÇO DO TEMA ATUAL E ULTIMA NOTICIA ---------------------------------------------------------------------------------------------- -->

<!-- aqui iremos chamar e mostrar o tema atual da paulo friere -->
  <section class="tema" id="tema">
    <?php
    // abrindo o php de pesquisa
    while($registro_temas=$dados_temas->fetch_object()){
    ?>
    <div class="tema-container">

        <div class="tema-box">
        <i class='bx bx-bulb'></i>
        <h3>Tema do Ano:  </h3>
        <p><?php echo $registro_temas->tema_tm; ?></p>
        

    </div>
    
    </section>
<?php
// fechando o php de pesquisa
 }
 ?>
</div>
<!-- aqui finaliza a chamada para tema atual da paulo freire -->



<!-- aqui iremos chamar e mostrar a ultima noticia lançada no sistema -->
<section class="noticia" id="noticia">
<?php
// abrindo o php de pesquisa
 while($registro_noticias=$dados_noticias->fetch_object()){
?>
    <div class="noticia-container">

        <div class="noticia-box">
            <i class='bx bx-news'></i>
            <h3>Última Notícia: </h3>

            <h3><?php echo $registro_noticias->titulo_not; ?></h3>
   
            <p><?php echo $registro_noticias->descricao_not; ?></p>
  
            <p><?php echo $registro_noticias->data_not; ?></p>


        </div>
            <!-- mostrando o resultado -->
      
      

  </div>

<?php
// fechando o php de pesquisa
 }
 ?>
    </section>
<!-- aqui finaliza a chamada para a ultima noticia-->

<!-- ------------------------------------------------------------------------------------- COMEÇO DOS GRAFICOS E TABELAS ---------------------------------------------------------------------------------------------- -->

<br> 
<!-- espaçamento entre tabelas -->

<!-- titulo da primeira tabela-->
<h2>Tabela de Pontuações por equipe</h2>

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
            
        
        <!-- aqui finalizamos o appender -->

        </table>
        <!-- final da tabela criada pelo bootstrap -->
</div>
</div>
<!-- FINAL DO TABELA DE: pontuações por dia *********************************************************************************************************** --> 

<br> 
<!-- espaçamento entre tabelas -->

<!-- titulo da segunda tabela -->
<h2>Tabela de horários e locais das gincanas</h2>

<!-- TABELA: Horários e locais das gincanas ************************************************************************************************************************* -->
<div class="row">

<!-- foi separada uma linha só para ele -->
<div class="col-sm-12">

        <!-- aqui iniciamos a tabela -->
        <table class="table table-hover border border-dark  p-5">

        <!-- aqui criamos o cabeçalho da tabela -->
        
            <!-- iniciando uma linha para o cabcalho -->
            <tr>

            <th scope="col">Nome</th>
            <th scope="col">Data - Horário</th>
            <th scope="col">Local</th>

            </tr>
            <!-- fechando a linha do cabecalho -->
        
        <!-- final do cabecalho da tabela -->

        <!-- aqui appendamos os resultados dos gráficos -->
        
<?php
// inicio do php de pesquisa
while($registro_gincanas = $dados_gincanas->fetch_object()){
?>
            <!-- iniciando uma linha para colocar os resultados -->
            <tr>

            <!-- primeiro campo: Nome  -->
            <td><?php echo $registro_gincanas->nome_gin;?></td>
            <!-- segundo campo: Horario -->
            <td><?php echo $registro_gincanas->horario_gin;?></td>
            <!-- terceiro campo: local -->
            <td><?php echo $registro_gincanas->local_gin;?></td>
          
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
<!-- FINAL DO TABELA DE: horarios e locais das gincanas *********************************************************************************************************** --> 

<br> 
<!-- espaçamento entre tabelas -->

<!-- titulo da terceira tabela -->
<h2>Tabela de equipes para competição</h2>

<!-- TABELA: Equipes ************************************************************************************************************************* -->
<div class="row">

<!-- foi separada uma linha só para ele -->
<div class="col-sm-12">

        <!-- aqui iniciamos a tabela -->
        <table class="table table-hover border border-dark p-5">

        <!-- aqui criamos o cabeçalho da tabela -->
        
            <!-- iniciando uma linha para o cabcalho -->
            <tr>

            <th scope="col">Nome</th>
            <th scope="col">Sala</th>
            <th scope="col">Ano</th>
            <th scope="col">Tema</th>
            <th scope="col">Cor</th>
            <th scope="col">Extra</th>

            </tr>
            <!-- fechando a linha do cabecalho -->
        
        <!-- final do cabecalho da tabela -->

        <!-- aqui appendamos os resultados dos gráficos -->
       
<?php
// inicio do php de pesquisa
while($registro_equipes = $dados_equipes->fetch_object()){
?>
            <!-- iniciando uma linha para colocar os resultados -->
            <tr>

            <!-- primeiro campo: Nome  -->
            <td><?php echo $registro_equipes->nome_eq;?></td>
            <!-- segundo campo: Sala -->
            <td><?php echo $registro_equipes->sala_eq;?></td>
            <!-- terceiro campo: ano -->
            <td><?php echo $registro_equipes->ano_eq;?></td>
            <!-- Quarto campo: tema -->
            <td><?php echo $registro_equipes->tema_eq;?></td>
            <!-- quinto campo: Cor -->
            <td><?php echo $registro_equipes->cor_eq;?></td>
            <!-- sexto campo: Extra -->
            <td><?php echo $registro_equipes->extra_eq;?></td>
          
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
<!-- FINAL DO TABELA DE: Equipes *********************************************************************************************************** --> 

<br> 
<!-- espaçamento entre tabelas -->

<!-- titulo da quarta tabela -->
<h2>Tabela dos organizadores</h2>

<!-- TABELA: Administradores e Avaliadores ************************************************************************************************************************* -->
<div class="row">

<!-- foi separada uma linha só para ele -->
<div class="col-sm-12">

        <!-- aqui iniciamos a tabela -->
        <table class="table table-hover border border-dark  p-5">

        <!-- aqui criamos o cabeçalho da tabela -->
            <!-- iniciando uma linha para o cabcalho -->
            <tr>

            <th scope="row">Nome</th>
            <th scope="row">Email</th>
            <th scope="row">Função</th>

            </tr>
            <!-- fechando a linha do cabecalho -->
        <!-- final do cabecalho da tabela -->

        <!-- aqui appendamos os resultados dos gráficos -->
<?php
// inicio do php de pesquisa
while($registro_usuarios = $dados_usuarios->fetch_object()){
?>
            <!-- iniciando uma linha para colocar os resultados -->
            <tr >

            <!-- primeiro campo: Nome  -->
            <td><?php echo $registro_usuarios->nome_us;?></td>
            <!-- segundo campo: Email -->
            <td><?php echo $registro_usuarios->email_us;?></td>
            <!-- terceiro campo: Funcao no evento -->
            <td><?php echo $registro_usuarios->funcao_no_evento;?></td>
          
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
<!-- FINAL DO TABELA DE: Administradores e Avaliadores *********************************************************************************************************** --> 
    
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
                <li><a href="./sendemail">Entre em contato com a admistração</a></li>
            </div>
            <div class="footer-iconTop">
                <a href="#topo"><i class='bx bx-up-arrow-alt'></i></a>
            </div>
        </div>

    </footer>


    <!-- // link para o arquivo de javascript do (BOOTSTRAP) -->



    <script src="frontend/public/js/script.js"></script>
    

    <!-- fim do body do html -->
</body>

    <!-- fim do html em si -->
</html>