<?php 
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;



        $NAME = $_GET['logon'];
        $EMAIL = $_GET['email'];
        $TOKEN = $_GET['token'];
        $SUBJECT = "ParaGames - Redefinicao de Senha";
        $MESSAGE = <<<END
        Olá, $NAME.
        Clique <a href="http://localhost/system/backend/php/scripts/indexRedef.php?id=$ID&token=$TOKEN">aqui</a> para redefinir sua senha.

        Equipe ParaGames.
        END;
        

        $mail = new PHPMailer(true);

        // Creating
        $mail -> isSMTP();
        $mail -> isHTML(true);
        $mail -> SMTPAuth = true;

        // Host (gmail)
        $mail -> Host = "smtp.gmail.com";
        $mail -> SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail -> Port = 587;

        // My login
        $mail -> Username = "";
        $mail -> Password = "";

        // Mail
        $mail -> setFrom("", "");
        $mail -> addAddress($EMAIL, $NAME);
        $mail -> Subject = $SUBJECT;
        $mail -> Body = $MESSAGE;

        // Send
        $mail -> send();
        header("Location: ../../../public/html/indexLogin.php?2");
?>