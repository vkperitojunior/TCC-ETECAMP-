 <?php
// iniciando o php para o verificador de tempo de sessão

// inicia a sessão nessa página e colea dos dados
if(!isset($_SESSION)){
    session_start();
}

// pegando o horário atual
 $now = time();
      
// checando se o tempo ja expirou
 if($now > $_SESSION['expire']) {

    // destruindo a sessão
     session_destroy();
    
     //  avisando ao usuario o que aconteceu
     echo "<p align='center'>Tempo limite de login excedido!";
    
     //  mandano o usuario para o inicio
     header("Location: ./");  
 }

 ?>
 <!-- fim do php para o verificador de tempo de sessão  -->