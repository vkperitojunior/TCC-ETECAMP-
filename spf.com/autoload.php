<?php
// INICIO DO PHP

function page_autoloader($pages) {
    // Base directory para as páginas
    $base_dir = 'backend/objetos/';
    
    foreach ($pages as $page) {
        // Substitua pontos por barras, se houver, e adicione .php
        // $file = $base_dir . str_replace('.', '/', $page) . '.php';
        $file = $base_dir . $page. '.php';
        // echo "Página: " . $file . "<br>";
        
        // Se o arquivo existir, inclua-o
        if (file_exists($file)) {
            require_once($file);
        } else {
            echo "Página não encontrada: " . $page . "<br><br>";
        }
    }
}

// FIM DO PHP
?>