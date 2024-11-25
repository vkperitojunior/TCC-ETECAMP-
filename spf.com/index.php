<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir o arquivo do AltoRouter (verifique o caminho correto)
require './extensions/AltoRouter/AltoRouter-master/AltoRouter.php';

// Criar uma instância do AltoRouter
$router = new AltoRouter();

// Defina o caminho base para as rotas (deixe vazio se estiver na raiz do servidor)
$router->setBasePath('/spf.com');

// Definir rotas
$router->map('GET', '/', function() {
    include './frontend/principal/home.php';
});

$router->map('GET', '/gincanas', function() {
    include './frontend/principal/gincanas.php';
});

$router->map('GET|POST', '/fotos', function() {
    include './frontend/principal/fotos.php';
});

$router->map('GET', '/sobre', function() {
    include './frontend/principal/sobre.php';
});

$router->map('GET', '/historicos', function() {
    include './frontend/principal/historicos.php';
});

$router->map('GET', '/sendemail', function() {
    include __DIR__ . './backend/form_p_adm/form_contato.php';
});

$router->map('POST', '/invitemail', function() {
    include './backend/form_p_adm/invite_mail.php';
});

$router->map('GET|POST', '/noticias', function() {
    include './frontend/principal/noticias.php';
});

$router->map('GET', '/pontuacoes', function() {
    include './frontend/principal/pontuacoes.php';
});

$router->map('GET', '/regras', function() {
    include './frontend/principal/regras.php';
});

$router->map('GET', '/login', function() {
    include './backend/login/loginspf.php';
});

$router->map('POST|GET', '/aut', function() {
    include __DIR__ . './backend/login/aut.php';
});

$router->map('GET|POST', '/autenticator/[i:id]', function($id) {
    include __DIR__ . './backend/login/aut.php';
});

$router->map('POST', '/verify', function() {
    include __DIR__ . './backend/login/Function_verificalogin.php';
});

$router->map('GET', '/administrativo', function() {
    include './frontend/administrativo/administracaospf.php';
});

$router->map('POST|GET', '/alt_perf', function() {
    include __DIR__ . './backend/perfil_usuarios/alterar_perfil.php';
});

$router->map('GET|POST', '/conf_alt_perf', function() {
    include __DIR__ . './backend/perfil_usuarios/confalterar.php';
});

$router->map('GET', '/logout', function() {
    include __DIR__ . './backend/conexao/script/logout.php';
});

$router->map('GET|POST', '/tabelas/[i:id]', function($id) {
    include __DIR__ . './frontend/administrativo/administracaospf.php';
});


$router->map('GET|POST', '/correction/[i:id]', function($id) {
    include __DIR__ . './backend/login/loginspf.php';
});

$router->map('GET', '/protect', function() {
    include __DIR__ . './backend/conexao/script/protect.php';
});

$router->map('GET|POST', '/logsY', function() {
    include __DIR__ . './backend/LOGS/pag_de_logs.php';
});

$router->map('POST|GET', '/logsK', function() {
    include __DIR__ . './backend/LOGS/pag_de_logs.php';
});

$router->map('POST', '/tabelas_logs', function() {
    include __DIR__ . './backend/LOGS/pag_de_logs.php';
});

$router->map('POST', '/conexao', function() {
    include 'backend/conexao/script/conexao.php';
});

$router->map('GET', '/logs_repo', function() {
    include 'backend/objetos/class_IRepositorioLogs.php';
});

$router->map('POST', '/autoload', function() {
    include 'autoload.php';
});

// Rota com parâmetros dinâmicos para os objetos de crud's
$router->map('GET|POST', '/[a:action]/[i:id]', function($action, $id) {


    // if($action == 'tabelas'){
    // // backend/objetos_crud/inclusoes.php
    // $file ="./frontend/administrativo/{$action}.php";
    // }else{
    // backend/objetos_crud/inclusoes.php
    $file = "backend/objetos_crud/{$action}.php";
    // }


    if (file_exists($file)) {
        include $file;
    } else {
        header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        echo 'Arquivo não encontrado.';
    }

});

$router->map('GET|POST', '/[a:action]/[i:id]/[i:id2]', function($action, $id, $id2) {
    // Define o caminho do arquivo com base na ação
    $file = "backend/objetos_crud/{$action}.php";

    // Verifica se o arquivo existe e o inclui
    if (file_exists($file)) {
        include $file;
    } else {
        header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        echo 'Arquivo não encontrado.';
    }
});

$router->map('GET|POST', '/[a:action]/[i:id]/[i:id2]/[i:id3]', function($action, $id, $id2, $id3) {
    // Define o caminho do arquivo com base na ação
    $file = "backend/objetos_crud/{$action}.php";

    // Verifica se o arquivo existe e o inclui
    if (file_exists($file)) {
        include $file;
    } else {
        header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        echo 'Arquivo não encontrado.';
    }
});

$router->map('GET|POST', '/desativar', function() {
    include 'backend/objetos_crud/desativadores.php';
});

$router->map('GET|POST', '/ativar', function() {
    include 'backend/objetos_crud/ativadores.php';
});

$router->map('GET|POST', '/excluir', function() {
    include 'backend/objetos_crud/exclusoes.php';
});

$router->map('GET|POST', '/csvs', function() {
    include 'backend/objetos_crud/csvs.php';
});

$router->map('GET|POST', '/pesquisar', function() {
    include 'backend/objetos_crud/pesquisadores.php';
});

$router->map('GET|POST', '/limpar', function() {
    include 'backend/objetos_crud/limpadores.php';
});

$router->map('GET|POST', '/alterar', function() {
    include 'backend/objetos_crud/alteracoes.php';
});

$router->map('GET|POST', '/imagens_diversas/[i:id]', function($id) {
    include 'backend/objetos_crud/imagens_diversas.php';
});

// Rota específica para a página fixa 'confincluir' com um parâmetro dinâmico 'id'
// $router->map('POST', '/cincluir/[i:id]', function($id) {
//     include __DIR__ . '/backend/objetos_crud/inclusoes.php';
// });

// Rota específica para a página fixa 'confincluir' com um parâmetro dinâmico 'id'
// $router->map('POST', '/cincluir/[i:id]', function($id) {
//     $file = '/backend/objetos_crud/inclusoes.php';
    
//     if (file_exists($file)) {
//         include $file;
//     } else {
//         header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
//         echo 'Arquivo não encontrado.';
//     }
// });

// Rota específica para a página fixa 'confincluir' com um parâmetro dinâmico 'id'
// $router->map('POST', '/calterar/[i:id]', function($id) {
//     $file = __DIR__ . '/backend/objetos_crud/altercoes.php';
    
//     if (file_exists($file)) {
//         include $file;
//     } else {
//         header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
//         echo 'Arquivo não encontrado.';
//     }
// });

$router->map('GET|POST', '/confalterar', function() {
    include __DIR__ . '/backend/perfil_usuarios/confalterar.php';
});

$router->map('GET|POST', '/mailerexception', function() {
    include __DIR__ . '/extensions/PHPMailer/PHPMailer-master/src/Exception.php';
});

$router->map('GET|POST', '/mailermailer', function() {
    include __DIR__ . '/extensions/PHPMailer/PHPMailer-master/src/PHPMailer.php';
});

$router->map('GET|POST', '/mailersmtp', function() {
    include __DIR__ . '/extensions/PHPMailer/PHPMailer-master/src/SMTP.php';
});

// include __DIR__ . '/extensions/PHPMailer/PHPMailer-master/src/Exception.php';

// include __DIR__ . '/extensions/PHPMailer/PHPMailer-master/src/PHPMailer.php';

// include __DIR__ . '/extensions/PHPMailer/PHPMailer-master/src/SMTP.php';

// Rota específica para a página fixa 'atualizastatus' com um parâmetro dinâmico 'id' e numero do status
// $router->map('GET|POST', '/atzstatus/[i:id]/[i:id2]', function($id,$id2) {
//     $file =  __DIR__ .'/backend/objetos_crud/atualizaStatus.php';

//         if (file_exists($file)) {
//         include $file;
//     } else {
//         header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
//         echo 'Arquivo não encontrado.';
//     }
// });

// // Rota específica para a página fixa 'atualizatipo' com um parâmetro dinâmico 'id' e numero do status
// $router->map('GET|POST', '/atztipo/[i:id]/[i:id2]', function($id,$id2) {
//     $file =  __DIR__ .'/backend/objetos_crud/atualizaTipo.php';

//         if (file_exists($file)) {
//         include $file;
//     } else {
//         header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
//         echo 'Arquivo não encontrado.';
//     }
// });


// ----------------- começando o redirecionamento ativo com resposta

// Correspondência da rota atual
$match = $router->match();

// Verificar se a rota foi encontrada e se o alvo é uma função válida
if ($match && is_callable($match['target'])) {
    // Para depuração: exibir rota correspondida e parâmetros
    call_user_func_array($match['target'], $match['params']); // Chama a função de callback associada à rota
    
} else {
    // Rota não encontrada
    // http_response_code(404);
    
    // Para depuração: exibir informações sobre a rota não encontrada
    echo '404 - Not Found<br>';
    echo 'Rota solicitada: ' . $_SERVER['REQUEST_URI'] . '<br>';
    echo 'Rota correspondida: ';
    echo '<pre>';
    print_r($match);
    echo '</pre>';
    echo 'Roteamento: ' . print_r($router->getRoutes(), true) . '<br>';
}
?>
