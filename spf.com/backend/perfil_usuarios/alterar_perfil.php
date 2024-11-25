<?php 
// começo do php do head

// link qe vai para a classe php com todos os links e conexões
require_once 'autoload.php';


// link qe vai para o protetor
include_once 'backend/conexao/script/protect.php';

// carregando as páginas nescessárias
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
<html lang="pt=br">
<head>
    <!-- começo do cabecalho do backend -->

    <!-- definições de responsividade -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- titulo da página -->
    <title>alterar_perfil_spf</title>

    <?php
    // pesquisa da logo e colocação da mesma
    $dados_logo = $repositorioLogo->buscarLogo(1);
    while($registro_logo = $dados_logo->fetch_object()){
    if(!isset($id_filtro)){
    ?>
    <!-- icone do website -->
    <link rel="icon" href="./frontend/public/imagens/logo/<?php echo $registro_logo->arquivo_lg ?>" alt="Logo">
    <?php
    }
    }   
    ?>

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
<body style="background-color: lightgray;">

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
      <img src="./frontend/public/imagens/logo/<?php echo $registro_logo->arquivo_lg?>" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
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
        $funcao_no_evento=$_SESSION['funcao_no_evento'];

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
        $funcao_no_evento=$_SESSION['funcao_no_evento'];

       // verifica se ele esta dentro dos parametros e mostra seu nome e cargo de acordo com o correto
       if($funcao_usuario == 0){


        echo "<a class=\"nav-link text-white\" href=\"./logout\">Logout</a>";
        echo "<a class=\"nav-link text-white\" href=\"./alt_perf\">Alterar perfil</a>";

    
        // verifica se ele esta dentro dos parametros e mostra seu nome e cargo de acordo com o correto
        }elseif($funcao_usuario == 1){

        echo "<a class=\"nav-link text-white\" href=\"./logout\">Logout</a>";
        echo "<a class=\"nav-link text-white\" href=\"./alt_perf\">Alterar perfil</a>";

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


<li class="nav-item">
    <!-- começo do php -->
    <?php

    // caso não tenha sessão iniciada, mostra o login
    if($condicao == false){
        echo "<li class=\"nav-item\">";
        echo "<a class=\"nav-link text-white\" href=\"./login\">Login para administradores</a>";
        echo "</li>";
    // caso tenha sessão iniciada parte para checar a funcao
    }else{
        // captura a variavel do usuario
        $funcao_usuario=$_SESSION['funcao_usuario'];

        // verifica se ele esta dentro dos parametros e mostra o botao
        if($funcao_usuario == 0 || $funcao_usuario == 1){

    
        echo "<li class=\"nav-item\">";
        echo "<a class=\"nav-link active text-white   mt-4\" href=\"./administrativo\">Administração</a>";
        echo "</li>";

    
        // se não estiver dentro dos parametros, desliga o site e pede pelo login
        }else{
        die("Você não possui cargo para acessar esta parte do sistema, entre em contato com um administrador.<p><a href=\"./login\">Voltar para o login<a></p>");
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

<!-- Começo da caixa de login no css -->
<div id="loginbox">

<!-- titulo da caixa de login -->

<br>
<h2>Informações do seu perfil: </h2>
<br>

    <!-- começo do formulário -->
    <form class="mx-auto" action="./alt_perf" method="POST" style="width: 400px;">
    <!-- campo de id -->
    <div class="mb-3">
    <input type="hidden" required class="form-control" id="exampleInputId" value="<?php echo $id_usuario; ?>" name="id" aria-describedby="idHelp">
    </div>
    <!-- campo de nome -->
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nome</label>
    <input type="text" required class="form-control" id="exampleInputEmail1" value="<?php echo $nome_usuario; ?>" name="nome" aria-describedby="nomeHelp" >
    </div>
    <!-- campo de email -->
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email</label>
    <input type="email" required class="form-control" id="exampleInputEmail1"  value="<?php echo $email_usuario; ?>" name="email" aria-describedby="emailHelp" ">
    </div>
    <!-- campo de senha -->
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Senha</label>
    <input type="password" class="form-control" id="exampleInputPassword"  value="<?php echo $senha_usuario; ?>" name="senha" aria-describedby="senhaHelp">
    </div>
    <div id="emailHelp" class="form-text">Mude a senha padrão recebida sempre, use Letra A a, Numero 1 2 e Caracteres Especiais # @</div>
    <!-- campo de foto -->
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Foto</label>
    <input type="file" class="form-control" id="exampleInputImage" value="<?php echo $foto_usuario; ?>" name="foto" aria-describedby="imagemHelp">
    </div>
    <!-- campo de funcao -->
    <div class="mb-3">
    <input type="hidden" required class="form-control" id="exampleInputFuncao" value="<?php echo $funcao_usuario; ?>" name="funcao" aria-describedby="funcaoHelp">
    </div>
    <!-- campo de funcao_no_evento -->
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Função no evento</label>
    <input type="fne" required class="form-control" id="exampleInputFne" value="<?php echo $funcao_no_evento; ?>" name="fne" aria-describedby="fneHelp">
    <div id="mensagemHelp" class="form-text">Não use textos grandes.</div>
    </div>
    <!-- campo de status -->
    <div class="mb-3">
    <input type="hidden" required class="form-control" id="exampleInputStatus" value="<?php echo $status_usuario; ?>" name="status" aria-describedby="statusHelp">
    </div>
    <!-- botão para enviar informações do formulário -->
    <button type="submit" name="submit" class="btn btn-primary">Alterar</button>

    <!-- fim do formulário -->
    </form>
    
    <br>

<!-- fim da div de formulário -->
</div>

<!-- ------------------------------------------------------------------------------------- Gerando o código de confirmação ---------------------------------------------------------------------------------------------- -->

<!-- começo do código de confirmação -->
<?php

// error_reporting(0);

include "extensions/PHPMailer/PHPMailer-master/src/PHPMailer.php";
include "extensions/PHPMailer/PHPMailer-master/src/Exception.php";
include "extensions/PHPMailer/PHPMailer-master/src/SMTP.php";

    // incluindo a função de envio de email
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    if(isset($_POST['submit'])){

    // Conferindo se há alguma sessão aberta, se não, abrimos a sessão e pegamos os dados
    if(!isset($_SESSION)){
        session_start();
    }

    // Capturando as informações e guardando-as

                            // dados de identificação
                            $_SESSION['id_alterar'] = $_POST['id'];
                            // dados de função do usuario
                             $_SESSION['funcao_alterar'] = $_POST['funcao'];
                            // dados de função do usuario dentro do evento
                            $_SESSION['fne_alterar'] = $_POST['fne'];
                            // dados de nome do usuario
                             $_SESSION['nome_alterar'] = $_POST['nome'];
                            // dados de email do usuario
                            $_SESSION['email_alterar'] = $_POST['email'];
                            // dados da senha do usuario
                            $_SESSION['senha_alterar'] = $_POST['senha'];
                            // dados de foto do usuario
                             $_SESSION['foto_alterar'] = $_POST['foto'];
                            // dados de status do usuario
                             $_SESSION['status_alterar'] = $_POST['status'];

    // Construindo o código de confirmação

                            // código de copnfirmação aleatório
                            $token = rand(100000, 999999);

                            $_SESSION['token'] = $token;

                            // Salvando a data e hora que aconteceu essa solicitação
                            $data_envio = date('d/m/Y');
                            $hora_envio = date('H:i:s');
                            
    // Configurando como será exibido o corpo do E-mail e colocando dentro de uma variavel

                            $NAME = $_POST['nome'];
                            $EMAIL = $_POST['email'];
                            $SUBJECT = "SPF - Redefinicao de usuario";
                            $ARQUIVO =  "
                            <style type='text/css'>
                            body {
                            margin:0px;
                            font-family:Verdane;
                            font-size:12px;
                            color: #666666;
                            }
                            a{
                            color: #666666;
                            text-decoration: none;
                            }
                            a:hover {
                            color: #FF0000;
                            text-decoration: none;
                            }
                            </style>
                            <html>
                                <table width='510' border='1' cellpadding='1' cellspacing='1' bgcolor='#CCCCCC'>
                                        <tr>
                                    <td>
                                        <tr>
                                    <td width='500'>Tentativa de alterar usuario sendo realizada</td>
                                        </tr>
                                        <tr>
                                    <td width='320'>Código: <b>$token</b></td>
                                        </tr>
                                    </td>
                                        </tr>
                                        <tr>
                                        <td>Este e-mail foi enviado em <b>$data_envio</b> às <b>$hora_envio</b></td>
                                        </tr>
                                </table>
                            </html>
                            ";
                            
                    
        //                     $mail = new PHPMailer(true);
                    
        //                     // Creating
        //                     $mail -> isSMTP();
        //                     $mail -> isHTML(true);
        //                     $mail -> SMTPAuth = true;
                    
        //                     // Host (gmail)
        //                     $mail -> Host = "smtp.gmail.com";
        //                     $mail -> SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        //                     $mail -> Port = 587;
                    
        //                     // My login
        //                     $mail -> Username = "";
        //                     $mail -> Password = "";
                    
        //                     // Mail
        //                     $mail -> setFrom("", "");
        //                     $mail -> addAddress($EMAIL, $NAME);
        //                     $mail -> Subject = $SUBJECT;
        //                     $mail -> Body = $MESSAGE;
                    
        //                     // Send
        //                     $mail -> send();

        // // envia o usuario para a página de confirmação do código
        // header('Location: ./conf_alt_perf');

        $Correo = new PHPMailer();
        $Correo->IsSMTP();
        $Correo->SMTPAuth = true;
        $Correo->SMTPSecure = "tls";
        $Correo->Host = "smtp.gmail.com";
        $Correo->Port = 587;
        $Correo->Username = "email";
        $Correo->Password = "senha ou codigo";
        $Correo->SetFrom('nome do remetente','identificador do remetente');
        $Correo->FromName = "From";
        $Correo->AddAddress($EMAIL, $NAME);
        $Correo->Subject = $SUBJECT;
        $Correo->Body = $ARQUIVO;
        $Correo->IsHTML (true);
        if (!$Correo->Send())
        {
          echo "Error: $Correo->ErrorInfo";
        }
        else
        {
          echo "Message Sent!";
        }

    // voltando para a página de inicial
    echo "<script>window.location.href='./conf_alt_perf'</script>";

};
    

?>
<!-- fim do código de confirmação -->

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


    <a href="./sendemail" class="btn btn-dark">Entrar em contato com os administradores</a>

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