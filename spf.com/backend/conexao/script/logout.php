    <!-- Começo do php -->
    <?php

    // incluindo o link para o banco de dados
    include("conexao.php");

    // inicia a sessão nessa página e colea dos dados
    if(!isset($_SESSION)){
        session_start();
    }

    // pega a mesma sessão que iniciou e quebra ela de uma vez por todas
    session_destroy();

    // te manda para a página home para se quiser olhar o site ainda
    header("location: ./");
    
    ?>  
    <!-- fim do php -->