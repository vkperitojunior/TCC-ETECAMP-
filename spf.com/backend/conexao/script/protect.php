    <!-- Inicio do php -->
    <?php

    // link para o arquivo do banco de dados
    include("conexao.php");

    // inicia a sessão nesta página e coleta os dados nescessários
    if(!isset($_SESSION)){
        session_start();
    }

    // verifica se o usuario pode entrar em tal página, se não, quebra a sessão e pede para o mesmo logar
    if(!isset($_SESSION['funcao_usuario'])){
        if(isset($id_filtro)){
            die("Voce não pode acessar esta página sem estar logado e ter permissão.<p><a href=\"../../login\">Logar<a></p>");
        }else{
            die("Voce não pode acessar esta página sem estar logado e ter permissão.<p><a href=\"./login\">Logar<a></p>");
        }

        if($_SESSION['status_usuario'] < 1){
            die("Usuario desativado, por favor entre em contato com o adm.<p><a href=\"../login\">Logar<a></p>");
        }
    }

    ?>  
    <!-- fim do php -->