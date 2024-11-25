</html>

<!-- Começo dos links de bd e objetos -->
<?php
    // chama o repositório de códigos para logs
include 'backend/objetos/class_IRepositorioLogs.php';
// $repositorioLogs = new RepositorioLogsMYSQL();
// chama o repositório de códigos para usuarioS

// link qe vai para a classe php com todos os links e conexões
include_once 'backend/conexao/script/conexao.php';
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
?>
<!-- Fim dos links de bd e obejetos -->



<?php
        $id = isset($id) ? $id : null;

        echo $id;

        $dados=$repositorioUsuarios->buscarUsuario($id);



?>


<!-- Começo do HTML -->
<!DOCTYPE php>
<!-- definicção de trabalho em portugues -->
<html lang="pt-br">


<!-- começo do cabeçalho do html -->

<head>
    <!-- titulo do página-->
    <title>loginspf</title>

            <!-- Definicioes de reponsividade  -->
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">



            <!-- definições de estilo geral -->
            <link rel="stylesheet" href="../frontend/public/css/geral.css">
            <!-- definições de estilo especificas -->
            <link rel="stylesheet" href="../frontend/public/css/login.css">


    <!-- Começo do link para API do recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- Fim do link para API do recapthca -->

</head>
<!-- fim do cabeçalho do html -->

<!-- começo do corpo do html -->

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

    <!-- TITULO DO WEBSITE -->

    <!-- Começo da caixa de login no css -->
    <div id="loginbox">

        <div class="main-login">
            <div class="left-login">
                <h1>Login de Administradores e Avaliadores</h1>
                <img src="../frontend/public/imagens/geral/Paulo Freire.png" class="left-login-image" alt="Paulo Freire">
            </div>   

        <!-- começo do formulário -->

        
            
        <form class="mx-auto" action="../verify" method="POST" >
            <!-- campo de email -->
                <?php
            while($registro_filus = $dados->fetch_object()){
                ?>
                <div class="right-login">
                    <div class="card-login">
                            <h1>LOGIN</h1>
                            
                            <div class="textfield mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                    aria-describedby="emailHelp" placeholder="Digite seu Email" value="<?php echo $registro_filus->email_us; ?>">
                            </div>
                    
                <?php
            }
            ?>
            
            <!-- campo da senha -->

           
                <div class="textfield mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="exampleInputSenha" name="senha"
                        aria-describedby="senhaHelp" placeholder="use ao minimo 1aA@">
                </div>
                <!-- Parte onde é inserido o formulário do recaptcha -->
                <!-- <div class="g-recaptcha" data-sitekey="6LcZcuYpAAAAAEERHEIfbgD12BcOcctkpCLIi3Tq"></div> -->
                <!-- botão para enviar informações do formulário -->
                <button type="submit" class="btn-login">Login</button>
                <!-- titulo de pedido de cadastro caso você não tiver -->
                 
                    </div>
                </div>
            </div>
        </div>
           
           

    <!-- // Link para o arquivo de logs -->

</body>
<!-- fim do corpo do html -->

<!-- fim aa linguagem html -->

</html>