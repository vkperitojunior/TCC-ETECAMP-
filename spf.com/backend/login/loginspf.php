    <!-- Começo dos links de bd e objetos -->
    <?php  
    $confirmacao = isset($id) ? $id : null;

    echo $confirmacao;
    
    ?>
    <!-- Fim dos links de bd e obejetos -->


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

    <!-- Começo do HTML -->
    <!DOCTYPE php>
    <!-- definicção de trabalho em portugues -->
    <html lang="pt-br">


    <!-- começo do cabeçalho do html -->
        <head>
            <!-- titulo do página-->
            <title>Login SPF</title>

            <!-- Definicioes de reponsividade  -->
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">


            <?php

            if(!isset($confirmacao)){
                          // <!-- definicção da logo do website -->
            echo "<link rel=\"icon\" href=\"frontend/public/imagens/geral/\">";
            // <!-- definições de estilo geral -->
            echo "<link rel=\"stylesheet\" href=\"frontend/public/css/geral.css\">";
            // <!-- definições de estilo especificas -->
                        echo "<link rel=\"stylesheet\" href=\"frontend/public/css/login.css\">";
          // <!-- fim dos arquivos de bootstrap -->
            }else{
                          // <!-- definicção da logo do website -->
            echo "<link rel=\"icon\" href=\"frontend/public/imagens/geral/\">";
            // <!-- definições de estilo geral -->
            echo "<link rel=\"stylesheet\" href=\"frontend/public/css/geral.css\">";
            // <!-- definições de estilo especificas -->
                          echo "<link rel=\"stylesheet\" href=\"frontend/public/css/login.css\">";
                                     // <!-- Arquivos de css do bootstrap -->

            }

            ?>



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
    <div class="main-login">
        <div class="left-login">
            <h1>Login de Administradores e Avaliadores</h1>
            <img src="frontend/public/imagens/geral/Paulo Freire.png" class="left-login-image" alt="Paulo Freire">
        </div>   

        <?php
        if (!isset($confirmacao)) {
            // Começo do formulário
            echo "<form class=\"mx-auto\" action=\"./correction/1\" method=\"POST\">";
            echo "<div class=\"right-login\">";
            echo "<div class=\"card-login\">";
            echo "<h1>LOGIN</h1>";
            
            // Campo de email
            echo "<div class=\"textfield\">";
            echo "<label for=\"email\">Email</label>";
            echo "<input type=\"email\" name=\"email\" class=\"form-control\" placeholder=\"Digite seu Email\" id=\"exampleInputEmail1\" aria-describedby=\"emailHelp\">";
            echo "</div>";
            
          
            
            // Botão de login
            echo "<button type=\"submit\" class=\"btn-login\">Login</button>";
            // Botão de voltar
            echo "<div class=\"back-button\">";
            echo "<li class=\"list-group-item\">";
            echo "<a class=\"card-link\" href=\"./\">";
            echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">";
            echo "<path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z\"/>";
            echo "</svg> Voltar";
            echo "</a>";
            echo "</li>";
            echo "</div>"; 
            
            echo "</div>"; 
            echo "</div>"; 
            echo "</form>"; 
            


}else{

  $email=$_POST['email'];  
  $resposta=$repositorioUsuarios->verifica_email($email);

  $linhas = $resposta->num_rows;

  if($linhas  == 0){

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
            $dados_log = new log($id_correto,'Tentativa de login no sistema','O usuário não fez login no sistema spf, email inválido','LOGIN_INVALIDO',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  0, ''); 
            
            // executando comando de log!
            $repositorioLogs->cadastrarLogs($dados_log);

            // exit;

    // <!-- começo do formulário -->
    echo "<form class=\"mx-auto\" action=\"../correction/1\" method=\"POST\">";
    echo "<div class=\"right-login\">";
    echo "<div class=\"card-login\">";
    echo "<h1>LOGIN</h1>";
    echo "<div class=\"textfield\">";
    echo "<label for=\"email\">Email</label>";
    echo "<input type=\"email\" class=\"form-control\" id=\"exampleInputEmail1\" name=\"email\" aria-describedby=\"emailHelp\" placeholder=\"Digite seu Email\">";
    echo "<div id=\"emailHelp\" class=\"form-text\">";
    echo "<p style=\"color:red;\">Email não encontrado, digite um email correto</p>";
    echo "<li class=\"list-group-item\">";
    echo "<a class=\"card-link\" href=\"./\">";
    echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">";
    echo "<path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z\"/>";
    echo "</svg> Voltar";
    echo "</a>";
    echo "</li>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "<button type=\"submit\" class=\"btn-login\">Próximo</button>";
    echo "</div>"; // Fecha card-login
    echo "</div>"; // Fecha right-login
    echo "</form>"; // Fim do formulário
} else {
    $dados = $repositorioUsuarios->buscarUsuariologin($email);
    while ($registro_filus = $dados->fetch_object()) {
        // Redireciona para a página inicial
        echo "<script>window.location.href='../autenticator/$registro_filus->id_us'</script>";
    }
}
}
?>
<br>
</div> <!-- Fim da div de formulário -->
</div>




        </body>
        <!-- fim do corpo do html -->

        <!-- fim aa linguagem html -->
    </html>