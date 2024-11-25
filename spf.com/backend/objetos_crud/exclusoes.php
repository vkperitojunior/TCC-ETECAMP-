<?php
    // começo das exclusões

    // link qe vai para o protetor
    include_once 'backend/conexao/script/protect.php';
    
    include_once 'autoload.php';

    require_once 'backend/objetos/class_IRepositorioArq_avaliativo.php';
    require_once 'backend/objetos/class_IRepositorioArq_regras.php';
    require_once 'backend/objetos/class_IRepositorioEquipes.php';
    require_once 'backend/objetos/class_IRepositorioFotos.php';
    require_once 'backend/objetos/class_IRepositorioGincanas.php';
    require_once 'backend/objetos/class_IRepositorioHistorico.php';
    require_once 'backend/objetos/class_IRepositorioLogs.php';
    require_once 'backend/objetos/class_IRepositorioNoticias.php';
    require_once 'backend/objetos/class_IRepositorioPpa.php';
    require_once 'backend/objetos/class_IRepositorioPpe.php';
    require_once 'backend/objetos/class_IRepositorioTemas.php';
    require_once 'backend/objetos/class_IRepositorioUsuarios.php';
    require_once 'backend/objetos/class_IRepositorioLogo.php';
    require_once 'backend/objetos/class_IRepositorioCarrosel.php';
    require_once 'backend/objetos/class_IRepositorioImg_graf.php';


    $id_pesquisa = isset($id) ? $id : null;

    echo $id_pesquisa;

    $id_filtro = isset($id2) ? $id2 : null;

    echo $id_filtro;

    if($id_pesquisa == 1){

        $repositorioPpe->removerPpe($id_filtro);

                    // Atribuindo os pontos para cada equipe
                    $dados = $repositorioEquipes->listarTodas_crud();
                    // Abrindo o meio de coleta dos dados
            // Abrindo o meio de coleta dos dados
            // while($registro_equipe= $dados->fetch_object()){

            //     $repositorioPpe->atz_pontos($registro_equipe->id_eq);   

            // }

            // calculando os pontos das equipes no modo do diego --------

            $repositorioPpe->pontuacaoEspecial();

            // Atualizando o ranking das equipes na tabela ppe ----------

            $repositorioEquipes->atualizarRankingEquipes();

            // Gerando os gráficos ----------------

            $repositorioImg_graf->gráfico_de_barras();

            $repositorioImg_graf->gráfico_de_linhas();

            // Carregando os graficos no banco de dados -----------

            $id_ult_atz = $_SESSION['id_usuario'];

            // $foto = 'grafico_pontuacao.png';

            // $encontrou = $repositorioImg_graf->verificaFoto($foto);

             // colocando todas as variaveis juntas
            $img_graf1 = new img_graf(1, "Gráfico de barras",'grafico_pontuacao.png', 0000-00-00, $id_ult_atz);

            $repositorioImg_graf->alterarImg_graf($img_graf1);

            $id_ult_atz = $_SESSION['id_usuario'];

            // $foto = 'grafico_eficiencia.png';

            // $encontrou = $repositorioImg_graf->verificaFoto($foto);

             // colocando todas as variaveis juntas
             $img_graf2 = new img_graf(2, "Gráfico de eficiencia",'grafico_eficiencia.png', 0000-00-00, $id_ult_atz);

             $repositorioImg_graf->alterarImg_graf($img_graf2);

                                // voltando para a página de inicial
    echo "<script>window.location.href='../../tabelas/1'</script>";

            // criando o comando para log

            // Solicitando Hora do sistema
            $timezone = new DateTimeZone('America/Sao_Paulo');
            $hora_solicitada = new DateTime('now', $timezone);    

            // Solicitando Data do sistema
            $data_solicitada = date('d/m/Y');

            // Solicitando Geolocalização do sistema
            $d = new DateTimeImmutable("2022-06-02 15:44:48 UTC");

            $timezones = [ 'America/Sao_Paulo' ];

            foreach ($timezones as $tz) {
                $tzo = new DateTimeZone($tz);

                $local = $d->setTimezone($tzo);

            }

            $geoloc_solicitada = $local;

            // coletando os dados pessoais do usuario
            // Conferindo se há alguma sessão aberta, se não, abrimos a sessão e pegamos os dados
            if(!isset($_SESSION)){
                session_start();
            }

            $email_usuario = $_SESSION['email_usuario'];
            $id_usuario = $_SESSION['id_usuario'];

            // selecionando o identificador correto para evitar erros...
            $id_correto = $respositorioLogs->id_correto();

            // criando variavel com dados
            $dados_log = new log($id_correto,'Excluir Ppe','O usuário excluiu uma Ppe','CRUD_EXCLUIR_OP_Ppe',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
            // executando comando de log!
            $respositorioLogs->cadastrarLogs($dados_log);
        

    }elseif($id_pesquisa == 2){

        $repositorioPpa->removerPpa($id_filtro);

                    // Atribuindo os pontos para cada equipe
                    $dados = $repositorioEquipes->listarTodas_crud();
                    // Abrindo o meio de coleta dos dados
            // Abrindo o meio de coleta dos dados
            // while($registro_equipe= $dados->fetch_object()){

            //     $repositorioPpe->atz_pontos($registro_equipe->id_eq);   

            // }

            // calculando os pontos das equipes no modo do diego --------

            $repositorioPpe->pontuacaoEspecial();

            // Atualizando o ranking das equipes na tabela ppe ----------

            $repositorioEquipes->atualizarRankingEquipes();

            // Gerando os gráficos ----------------

            $repositorioImg_graf->gráfico_de_barras();

            $repositorioImg_graf->gráfico_de_linhas();

            // Carregando os graficos no banco de dados -----------

            $id_ult_atz = $_SESSION['id_usuario'];

            // $foto = 'grafico_pontuacao.png';

            // $encontrou = $repositorioImg_graf->verificaFoto($foto);

             // colocando todas as variaveis juntas
            $img_graf1 = new img_graf(1, "Gráfico de barras",'grafico_pontuacao.png', 0000-00-00, $id_ult_atz);

            $repositorioImg_graf->alterarImg_graf($img_graf1);

            $id_ult_atz = $_SESSION['id_usuario'];

            // $foto = 'grafico_eficiencia.png';

            // $encontrou = $repositorioImg_graf->verificaFoto($foto);

             // colocando todas as variaveis juntas
             $img_graf2 = new img_graf(2, "Gráfico de eficiencia",'grafico_eficiencia.png', 0000-00-00, $id_ult_atz);

             $repositorioImg_graf->alterarImg_graf($img_graf2);
                                // voltando para a página de inicial
    echo "<script>window.location.href='../../tabelas/2'</script>";

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
            $dados_log = new log($id_correto,'Excluir Ppa','O usuário excluiu uma Ppa','CRUD_EXCLUIR_OP_Ppa',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
            // executando comando de log!
            $respositorioLogs->cadastrarLogs($dados_log);

    }elseif($id_pesquisa == 3){

        $repositorioEquipes->removerEquipe($id_filtro);

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
            $dados_log = new log($id_correto,'Excluir Equipe','O usuário excluiu uma equipe','CRUD_EXCLUIR_OP_EQUIPE',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
            // executando comando de log!
            $respositorioLogs->cadastrarLogs($dados_log);

    }elseif($id_pesquisa == 4){

        $repositorioNoticias->removerNoticias($id_filtro);

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
            $dados_log = new log($id_correto,'Excluir Noticia','O usuário excluiu uma noticia','CRUD_EXCLUIR_OP_NOTICIA',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
            // executando comando de log!
            $respositorioLogs->cadastrarLogs($dados_log);

    }elseif($id_pesquisa == 5){

        $repositorioFotos->removerFoto($id_filtro);

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
            $dados_log = new log($id_correto,'Excluir Foto','O usuário excluiu uma foto','CRUD_EXCLUIR_OP_FOTO',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
            // executando comando de log!
            $respositorioLogs->cadastrarLogs($dados_log);

    }elseif($id_pesquisa == 6){

        $repositorioGincanas->removerGincana($id_filtro);

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
            $dados_log = new log($id_correto,'Excluir Gincana','O usuário excluiu uma gincana','CRUD_EXCLUIR_OP_GINCANA',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
            // executando comando de log!
            $respositorioLogs->cadastrarLogs($dados_log);

    }elseif($id_pesquisa == 7){

        $repositorioArq_regras->removerArq_regras($id_filtro);

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
            $dados_log = new log($id_correto,'Excluir arquivo de regras','O usuário excluiu um arquivo de regras','CRUD_EXCLUIR_OP_ARQREGRAS',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
            // executando comando de log!
            $respositorioLogs->cadastrarLogs($dados_log);

    }elseif($id_pesquisa == 8){

        $repositorioArq_avaliativo->removerArq_avaliativo($id_filtro);

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
            $dados_log = new log($id_correto,'Excluir arquivo de avaliação','O usuário excluiu um arquivo de avaliação','CRUD_EXCLUIR_OP_ARQAVALIATIVO',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
            // executando comando de log!
            $respositorioLogs->cadastrarLogs($dados_log);

    }elseif($id_pesquisa == 9){

        $repositorioHistoricos->removerHistorico($id_filtro);

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
            $dados_log = new log($id_correto,'Excluir Historico','O usuário excluiu um historico','CRUD_EXCLUIR_OP_HISTORICO',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
            // executando comando de log!
            $respositorioLogs->cadastrarLogs($dados_log);

    }elseif($id_pesquisa == 10){

        $repositorioTemas->removerTema($id_filtro);

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
            $dados_log = new log($id_correto,'Excluir Tema','O usuário excluiu um tema','CRUD_EXCLUIR_OP_TEMA',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
            // executando comando de log!
            $respositorioLogs->cadastrarLogs($dados_log);

    }elseif($id_pesquisa == 11){

        $repositorioUsuarios->removerUsuario($id_filtro);
        
            // criando o comando para log

            // █──██████────██████──█
            // █─██────██──██────██─█
            // ─███─██─██████─██─███
            // ──██────██──██────██
            // ───██████────██████

            // Solicitando Hora do sistema
            $timezone = new DateTimeZone('America/Sao_Paulo');
            $hora_solicitada = new DateTime('now', $timezone);    

            // Solicitando Data do sistema
            $data_solicitada = date('d/m/Y');

            // Solicitando Geolocalização do sistema
            $d = new DateTimeImmutable("2022-06-02 15:44:48 UTC");

            $timezones = [ 'America/Sao_Paulo' ];

            foreach ($timezones as $tz) {
                $tzo = new DateTimeZone($tz);

                $local = $d->setTimezone($tzo);

            }

            $geoloc_solicitada = $local;

            // coletando os dados pessoais do usuario
            // Conferindo se há alguma sessão aberta, se não, abrimos a sessão e pegamos os dados
            if(!isset($_SESSION)){
                session_start();
            }

            $email_usuario = $_SESSION['email_usuario'];
            $id_usuario = $_SESSION['id_usuario'];

            // selecionando o identificador correto para evitar erros...
            $id_correto = $respositorioLogs->id_correto();

            // criando variavel com dados
            $dados_log = new log($id_correto,'Excluir Usuario','O usuário excluiu um usuario','CRUD_EXCLUIR_OP_USUARIO',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
            // executando comando de log!
            $respositorioLogs->cadastrarLogs($dados_log);

    }
    elseif($id_pesquisa == 12){

        $repositorioCarrosel->removerCarrosel($id_filtro);
        
            // criando o comando para log

            // █──██████────██████──█
            // █─██────██──██────██─█
            // ─███─██─██████─██─███
            // ──██────██──██────██
            // ───██████────██████

            // Solicitando Hora do sistema
            $timezone = new DateTimeZone('America/Sao_Paulo');
            $hora_solicitada = new DateTime('now', $timezone);    

            // Solicitando Data do sistema
            $data_solicitada = date('d/m/Y');

            // Solicitando Geolocalização do sistema
            $d = new DateTimeImmutable("2022-06-02 15:44:48 UTC");

            $timezones = [ 'America/Sao_Paulo' ];

            foreach ($timezones as $tz) {
                $tzo = new DateTimeZone($tz);

                $local = $d->setTimezone($tzo);

            }

            $geoloc_solicitada = $local;

            // coletando os dados pessoais do usuario
            // Conferindo se há alguma sessão aberta, se não, abrimos a sessão e pegamos os dados
            if(!isset($_SESSION)){
                session_start();
            }

            $email_usuario = $_SESSION['email_usuario'];
            $id_usuario = $_SESSION['id_usuario'];

            // selecionando o identificador correto para evitar erros...
            $id_correto = $respositorioLogs->id_correto();

            // criando variavel com dados
            $dados_log = new log($id_correto,'Excluir Usuario','O usuário excluiu um usuario','CRUD_EXCLUIR_OP_USUARIO',  $ip_solicitado,  $localização_solicitada, $hora_solicitada,  $data_solicitada,  $id_solicitado, $email_solicitado); 
            
            // executando comando de log!
            $respositorioLogs->cadastrarLogs($dados_log);

    }

    // fim das exclusões
    ?>