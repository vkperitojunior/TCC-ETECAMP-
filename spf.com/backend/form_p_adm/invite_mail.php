<?php
// Começo do envio do email

// incluindo o repositorio de logs
include "backend/objetos/class_IRepositorioLogs.php";

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
                      
      // Pegando as variaveis passadas por metodo POST 
      $nome = $_POST['nome'];
      $email = $_POST['email'];
      $telefone = $_POST['telefone'];
      $mensagem = $_POST['mensagem'];
      $destino = $_POST['destino'];
      $data_envio = date('d/m/Y');
      $hora_envio = date('H:i:s');

      $SUBJECT = "Contato com administradores do website SPF";

      // Configurando como será exibido o corpo do E-mail e colocando dentro de uma variavel
      $ARQUIVO = "
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
                    <td width='500'>Nome:$nome</td>
                    </tr>
                    <tr>
                      <td width='320'>E-mail:<b>$email</b></td>
        </tr>
          <tr>
                      <td width='320'>Telefone:<b>$telefone</b></td>
                    </tr>
        <tr>
                      <td width='320'>Destino:$destino</td>
                    </tr>
                    <tr>
                      <td width='320'>Mensagem:$mensagem</td>
                    </tr>
                </td>
              </tr>
              <tr>
                <td>Este e-mail foi enviado em <b>$data_envio</b> às <b>$hora_envio</b></td>
              </tr>
            </table>
        </html>
      ";

      echo $ARQUIVO;

      // exit;
                            
                    
                            // $mail = new PHPMailer(true);
                    
                            // // Creating
                            // $mail -> isSMTP();
                            // $mail -> isHTML(true);
                            // $mail -> SMTPAuth = true;
                    
                            // // Host (gmail)
                            // $mail -> Host = "smtp.gmail.com";
                            // $mail -> SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                            // $mail -> Port = 587;
                    
                            // // My login
                            // $mail -> Username = "sysspf@gmail.com";
                            // $mail -> Password = "74108520SPF@";
                    
                            // // Mail
                            // $mail -> setFrom( $destino, "From");
                            // $mail -> addAddress($destino, "Dest");
                            // $mail -> Subject = $SUBJECT;
                            // $mail -> Body = $ARQUIVO;
                    
                            // // Send
                            // $mail -> send();


                            $Correo = new PHPMailer();
                            $Correo->IsSMTP();
                            $Correo->SMTPAuth = true;
                            $Correo->SMTPSecure = "tls";
                            $Correo->Host = "smtp.gmail.com";
                            $Correo->Port = 587;
                            $Correo->Username = "email";
                            $Correo->Password = "senha ou codigo";
                            $Correo->SetFrom('nome do remetente','identificador do rementente');
                            $Correo->FromName = "From";
                            $Correo->AddAddress("email do destinatario", "nome do destinatario");
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


    // envia o usuario para a página home para continuar sua experiencia em nosso site
    header('Location:./');

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
            $dados_log = new log($id_correto,'Enviar email a adm sucesso','O usuario enviou um email ao adm com sucesso','SENVIAR_EMAIL',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
            // executando comando de log!
            $respositorioLogs->cadastrarLogs($dados_log);

    } else {

    // caso der erro na hora do envio
    $mgm = "ERRO AO ENVIAR E-MAIL!";
    echo $mgm;

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
            $dados_log = new log($id_correto,'Enviar email a adm falha','O usuario enviou um email ao adm com falahas','FENVIAR_EMAIL',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
            // executando comando de log!
            $respositorioLogs->cadastrarLogs($dados_log);

    }

// fim do php de envio do email
?>
