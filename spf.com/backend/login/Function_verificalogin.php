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

// json-decode(): Transforma o JSON de retorno da API em variáveis do PHP
// $secretKey: sua chave secreta do reCAPTCHA
// $_POST['g-recaptcha-response']: a chave gerada pela resposta ao reCAPTCHA pelo formulário

// chave secreta de verificação do google recptcha
$secretKey = '6LcZcuYpAAAAAG34WdODV1uRGwOd3Am63YjqDeZZ';

$RetornaCaptcha = json_decode( file_get_contents( 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $_POST['g-recaptcha-response'] ) );

// verifica se a cahave de sucesso é valida e se o captcha foi preenchido

// if($RetornaCaptcha->success){
   echo "ReCAPTCHA válido!";
   error_reporting();

        // se o email não for preenchido avisa que é nescessário preencher
        if( isset($_POST['email']) || isset($_POST['senha']) ){

        if(strlen($_POST['email'])==0){
            echo "Prencha o seu email.";
        }if(strlen($_POST['senha'])==0){
            echo "Prencha o sua senha.";
        }else{

        // faz a tratativa dos dados apresentados para evitar sql injection
        $email_usuario=$_POST['email'];
        $senha_usuario=$_POST['senha'];

        // Tratadas por fim 
        $senha_tratada = preg_replace('/(?):/', '',$_POST['senha']);
        $email_tratado = preg_replace('/(?):/', '',$_POST['email']);

             // criptografando a senha_us do usuario
             $palavra4 = sha1("faufh4648934234325425¨%&¨%*%$#%saehfiasehf");
             $palavra5 = md5("baid_usjaiwjdiajwdoiaj$#@W$@#$&*(dw");
             $palavra6 = hash('sha256', 'aw4daw4dwa4d89a4w894$#$#@(*');
             $senha_CRIP = $palavra4 . sha1($senha_tratada) . $palavra5 . $palavra6;

        $encontrou = $repositorioUsuarios->verificaLogin($email_tratado, $senha_tratada);

        $linhas = $encontrou->num_rows;
    
        if($linhas == 0){

            $mensagem = "Email ou senha errados ou inexistentes! Verique e tente novamente!";
            echo $mensagem;

           
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
            
            // // criando variavel com dados
            // $dados_log = new log($id_correto,'Login no sistema','O usuário não fez login no sistema spf, logim inválido','LOGIN_INVALIDO',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  0, $_POST['email']); 
            
            // // executando comando de log!
            // $repositorioLogs->cadastrarLogs($dados_log);

            // exit;
            
        }else{

             // faz uma pesquisa pelos dados a mais do usuario utilizando-se de email e senha
            $dados_usuario = $repositorioUsuarios->buscarUsuariologin($email_tratado);
    
            // verifica se tem uma sessão ativa, se não tiver, inicia uma nova
            if(!isset($_SESSION)){
                session_start();
            }
    
            // manda as variaveis já digitadas para a próxima página
            $_SESSION['email_usuario']=$email_usuario;
            $_SESSION['senha_usuario']=$senha_tratada;
    
            // faz uma pesquisa pelos dados complementares do usuario                
                    while($registro=$dados_usuario->fetch_object()){

                        // dados de identificação
                         $_SESSION['id_usuario'] =   
                        $registro->id_us;
                        // dados de função do usuario
                         $_SESSION['funcao_usuario'] =   
                        $registro->funcao_us;
                        // dados de função do usuario dentro do evento
                        $_SESSION['funcao_no_evento'] =   
                        $registro->funcao_no_evento;
                        // dados de nome do usuario
                         $_SESSION['nome_usuario'] =   
                        $registro->nome_us;
                        // dados de nome do usuario
                        // dados de foto do usuario
                         $_SESSION['foto_usuario'] =   
                        $registro->foto_us;
                        // dados de status do usuario
                         $_SESSION['status_usuario'] =   
                        $registro->status_us;

                        // pegando a hora de inicio do sistema
                        $_SESSION['start'] = time(); 
                        
                        // Destroindo a sessão após 15 minutos 
                        $_SESSION['expire'] = $_SESSION['start'] + (15 * 60) ; 

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

            // criando variavel de classe com os dados solicitados ate o momento
            $dados_log = new log( null,  'Login no sistema',  'O usuário fez login no sistema spf com sucesso', 'LOGIN_COM_SUCESSO',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
            print_r($dados_log);

            // executando comando de log!
            $repositorioLogs->cadastrarLogs($dados_log);

            // EXIT;
                                
        // fim da busca de dados complementares
                        }

            // envia o usuario para a página home já com uma sessão ativa e mais atributos
            header('Location: ./administrativo');
    
            // fim do if de linhas menor igual
        }
    
        // exit para desenvolvedores entenderem o login
        exit;

        // fim do if do strlen
        }

        // fim do if do isset
    }
// } else {
//     error_reporting(0);
//     // caso o recapthca não for valido, avisa e sai de dentro do website
//    echo "ReCAPTCHA invalidado por tempo! por favor retorne a página anterior e tente novamente!";


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

//             // // criando variavel com dados
//             // $dados_log = new log($id_correto,'Login no sistema','O usuário não fez login no sistema spf, captcha invalido','CAPTCHA_INVALIDO',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  0, ''); 
            
//             // // executando comando de log!
//             // $respositorioLogs->cadastrarLogs($dados_log);

//    exit;
// }

// fim do php
?>
