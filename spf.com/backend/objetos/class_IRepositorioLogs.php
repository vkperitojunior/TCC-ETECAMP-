<?php
// Começo do php

// Incluindo link para conexão com banco de dados
include_once 'backend/conexao/script/conexao.php';
// Incluindo link para conexão com a classe logs
require_once 'backend/classes/class_logs.php';

include "extensions/PHPMailer/PHPMailer-master/src/PHPMailer.php";
include "extensions/PHPMailer/PHPMailer-master/src/Exception.php";
include "extensions/PHPMailer/PHPMailer-master/src/SMTP.php";

    // incluindo a função de envio de email
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


// aqui criamos a interface com as funções Logs dentro
interface IRepositorioLogs {
    public function cadastrarLogs($Log);
    public function obterIPDoUsuario();
    public function pesquisarLogs($usuario_id, $usuario_email, $data_log, $hora_log, $sessao_log);
    public function enviarEmailLog($sessao_log);
    public function listarTodosLogs();
    public function gerar_csv();
    public function id_correto();
    public function gerar_xls();
    public function BACUKP_DATABASES( $dbHost, $dbUser, $dbPass, $db);
}

// aqui implementamos a classe com suas funções em uma interface para poder trabalhar com elas
class RepositorioLogsMYSQL implements IRepositorioLogs {

// ------------------------------------------------- Criando conexão com banco de dados
private $conexao;

// constroi uma variavel de conexão
    public function __construct()
    {

        // pegando a senha do banco de dados e a transformando em variavel
        $senha='';

        // passa os parametros de conexão
        $this->conexao = new ConexaoSQL("localhost","root","$senha","bd_logs_spf");
        if ($this->conexao->conectar() == false){
            // se der erro na copnexão, retorna um erro
            echo "Erro" .mysqli_connect_error();
        }
    }
    

    
    public function gerar_xls()
{
// Inclua o arquivo da biblioteca SimpleXLSXGen
require_once 'extensions\simplexlsxgen\src\SimpleXLSXGen.php';

// Pasta onde os arquivos Excel serão salvos
$pasta_destino = 'frontend/public/xlsx/'; // Caminho relativo da pasta
$nome_arquivo = 'logs.xlsx'; // Nome do arquivo Excel

// Verifica se a pasta existe, se não, cria a pasta
if (!is_dir($pasta_destino)) {
    mkdir($pasta_destino, 0777, true); // Cria a pasta com permissões
}

// Caminho completo do arquivo
$caminho_arquivo = $pasta_destino . $nome_arquivo;

// Selecionando tudo da tabela referenciada
$sql = "SELECT * FROM logs";

// Faz a conexão e executa a query
$retorno = $this->conexao->executarQuery($sql);

// Cria um array para armazenar os dados do Excel
$dados = [];
$dados[] = ['Id', 'Título', 'Descrição', 'Sessão', 'Geolocalização', 'Hora', 'Data', 'Usuário']; // Cabeçalhos

// Verifica se a query retornou dados
if ($retorno->num_rows > 0) {
    // Adiciona os dados da tabela ao array
    while ($row = $retorno->fetch_assoc()) {
        $dados[] = [
            $row["id_log"],
            $row["titulo_log"],
            $row["descricao_log"],
            $row["sessao_log"],
            $row["geolocalizacao_log"],
            $row["hora_log"],
            $row["data_log"],
            $row["usuario_log"]
        ];
    }
} else {
    echo "0 resultados nas tabelas";
}

// Gera o arquivo Excel
$xlsx = Shuchkin\SimpleXLSXGen::fromArray($dados);
$xlsx->saveAs($caminho_arquivo);

// Exibe uma mensagem de sucesso ou redireciona
echo "Arquivo Excel gerado com sucesso em: $caminho_arquivo";
echo "<script>window.location.href='../administrativo'</script>";


}
// ---------------------------------------------- Criando a função de cadastro de Logs

    public function obterIPDoUsuario() {
        // Verifica se o IP do usuário está disponível diretamente
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            // IP fornecido por um proxy ou um cliente
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // IP fornecido por um cabeçalho X-Forwarded-For
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            // IP direto do servidor
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        // Limpa e retorna o IP
        return filter_var($ip, FILTER_VALIDATE_IP);
    }



    public function cadastrarLogs($Log)
    {

        // requisitando o id_log do Logs - gerado automatico / 
        $id_log = $Log->getId_log();
        // requisitando o titulo_log do Logs - escrita na hora /
        $titulo_log = $Log->getTitulo_log();
        // requisitando o descricao_log do Logs - escrita na hora /
        $descricao_log = $Log->getDescricao_log();
        // requisitando a sessao_log do Logs - escrita na hora /
        $sessao_log = $Log->getSessao_log();
        // requisitando a geolocalizacao_log do Logs - ip do usuario /
        $ip_log = $Log->getIp_log();
        // requisitando a geolocalizacao_log do Logs - geo do sistema /
        $geolocalizacao_log = $Log->getGeolocalizacao_log();
        // requisitando a hora_log do Logs - hora do sistema /
        $hora_log = $Log->getHora_log();
        // requisitando a melhor gincana do Logs - data do sistema /
        $data_log = $Log->getData_log();
        // requisitando a usuario_id do Logs - id ja preenchido /
        $usuario_id = $Log->getUsuario_id();
        // requisitando a usuario_email do Logs - email ja preenchido /
        $usuario_email = $Log->getUsuario_email(); 

        // echo "variavies certas";

        // criando o comando de inserção de Logs no banco de dados
        $sql = "INSERT INTO logs (id_log, titulo_log, descricao_log, sessao_log, ip_log, geolocalizacao_log, hora_log, data_log, usuario_id, usuario_email) VALUES ('$id_log','$titulo_log','$descricao_log','$sessao_log','$ip_log','$geolocalizacao_log','$hora_log','$data_log','$usuario_id','$usuario_email')";

        // solicitando a conexão com banco de dados e enviando o coamndo para inserir
        $resultado = $this->conexao->executarQuery($sql);

        // echo "log feito";
        // echo '<br>';
        // echo $resultado;
    }

// ---------------------------------------------- Criando a função de enviar emails para adm, caso houver algum log mais importante
public function enviarEmailLog($sessao_log)
{


    // Pegando as variaveis passadas por metodo POST 
$sessao_envio = $sessao_log;
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
            <td width='500'>Olá, aqui está um aviso de log -> isso somente acontece quando acontecem coisas mais sérias</td>
           </tr>
            <tr>
               <td width='500'>Registro de log na sessao:$sessao_envio</td>
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
                            $Correo->Username = "sysspf@gmail.com";
                            $Correo->Password = "mcgn zrye ksqj jbdd";
                            $Correo->SetFrom('sysspf@gmail.com','SPF');
                            $Correo->FromName = "From";
                            $Correo->AddAddress("sysspf@gmail.com", "ADM'S");
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

}

// ------------------------------------------------- Criando a função de listar todos os Logs

    public function pesquisarLogs($usuario_id, $usuario_email, $data_log, $hora_log, $sessao_log)
    {
        
    // criando o comando para buscar todos os Logs
    $sql = "SELECT * FROM logs WHERE usuario_id = '$usuario_id' OR usuario_email = '$usuario_email' 
    OR data_log = '$data_log' OR hora_log = '$hora_log' OR sessao_log LIKE '$sessao_log%' ";

    // solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os Logs
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;
    }

// ------------------------------------------------- Criando a função de listar todos os Logs

    public function listarTodosLogs()
    {
        
    // criando o comando para buscar todos os Logs
    $sql = "SELECT * FROM logs";

    // solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os Logs
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;
    }

// ------------------------------------------------- Criando a função para gerar csv de todos os dados

public function gerar_csv ()
{

    // Pasta onde os arquivos CSV serão salvos
$pasta_destino = 'frontend/public/csv/'; // Caminho relativo da pasta
$nome_arquivo = 'logs.csv';

// Verifica se a pasta existe, se não, cria a pasta
if (!is_dir($pasta_destino)) {
    mkdir($pasta_destino, 0777, true); // Cria a pasta com permissões
}

// Caminho completo do arquivo
$caminho_arquivo = $pasta_destino . $nome_arquivo;

    // selecionando tudo da tabela referenciada
    $sql = "SELECT * FROM logs";

    // faz um conexão e executa o comando de desativar
    $retorno = $this->conexao->executarQuery($sql);

    // cria uma array para os dados do csv
    $array_de_dados = array();

    // verifica se dentro da pesquisa ouve algum dado, se sim continua
    if ($retorno -> num_rows > 0) {

        // output data of each row
        while($row = $retorno->fetch_assoc()) {
            
        
        $array_de_dados[] = array(


            'Id' => $row["id_log"], 
            'Titulo' => $row["titulo_log"], 
            'Descricao' => $row["descricao_log"],
            'Sessao' => $row["sessao_log"], 
            'Geolocalizacao' => $row["geolocalizacao_log"], 
            'Hora' => $row["hora_log"],
            'Data' => $row["data_log"], 
            'Usuario' => $row["usuario_log"], 

            );

        }
        // senão tiver linhas, mostra uma mensagem dizendo sem linhas
    } else {
        echo "0 resultados nas tabelas";
    }

// Abre ou cria o arquivo CSV no caminho definido
$arquivo = fopen($caminho_arquivo, 'w');

// Define o separador
$separador = ';';

// Popula os dados no arquivo CSV
foreach ($array_de_dados as $linhas) {
    fputcsv($arquivo, $linhas, $separador);
}

// Fecha o arquivo
fclose($arquivo);

// Exibe uma mensagem de sucesso ou redireciona
echo "Arquivo CSV gerado com sucesso em: $caminho_arquivo";
echo "<script>window.location.href='../administrativo'</script>";
}

// ------------------------------------------------- Criando a função que procura qual id esta disponivel para uso

public function id_correto()
{

        // Defina a consulta SQL
        $query = "SELECT COUNT(id_log) AS total FROM logs";

        // Executa a consulta SQL
        $result = $this->conexao->executarQuery($query);

        // Verifica se a consulta foi bem-sucedida
        if ($result) {
            // Obtém o número total de registros
            $row = $result->fetch_assoc();
            $count = isset($row['total']) ? (int)$row['total'] : 0;

            // Agora você pode realizar a operação aritmética
            $newCount = $count + 1;
            // echo "Novo valor: " . $newCount;
            
            // Libere o resultado
            $result->free();
        } else {
            // Se a consulta falhar, exibe uma mensagem de erro
            echo "Erro na consulta: ";
}
}

public function getUserLocation() {
    // Obter o IP do usuário
    $ip = '';
    
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    // Caso o IP seja localhost (::1), forçar para um IP público (ex: Google DNS)
    if ($ip == '::1' || $ip == '127.0.0.1') {
        $ip = '8.8.8.8'; // IP do Google DNS para testes
    }

    // Fazer a requisição à API IP-API
    $url = "http://ip-api.com/json/{$ip}";
    $locationData = file_get_contents($url);
    
    // Decodificar o JSON retornado pela API
    $location = json_decode($locationData, true);

    // Retornar uma string contendo os dados concatenados
    return "IP: {$location['query']} - Cidade: {$location['city']} - Região: {$location['regionName']} - País: {$location['country']} - Latitude: {$location['lat']} - Longitude: {$location['lon']} - Organização: {$location['org']}";
}

// ------------------------- FUNCAO DE BACKUP DO BANCO DE DADOS

public function BACUKP_DATABASES( $dbHost, $dbUser, $dbPass, $db)
{

    $host = $dbHost;
    $user = $dbUser;
    $pass = $dbPass;
    $dbname = $db;
    $port = 3306;
    
    try{
        //Conexão com a porta
        //$conn = new PDO("mysql:host=$host;port=$port;dbname=" . $dbname, $user, $pass);
    
        //Conexão sem a porta
        $conn = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);
        //echo "Conexão com banco de dados realizado com sucesso!";
    }catch(PDOException $err){
        echo "Erro: Conexão com banco de dados não realizado com sucesso. Erro gerado " . $err->getMessage();
    }

// Receber as tabelas exportadas
$tabelas_exportadas = "";

// QUERY para recuperar as tabelas do banco de dados
$query_listar_tabelas = "SHOW TABLES";

// Preparar a QUERY
$result_listar_tabelas = $conn->prepare($query_listar_tabelas);

// Executar a QUERY
$result_listar_tabelas->execute();

// Verificar se encontrou alguma tabela no banco de dados
if(($result_listar_tabelas) and ($result_listar_tabelas->rowCount() != 0)) {

    // Criar o nome do arquivo de backup
    $nome_arquivo = "frontend/public/sql/backups_bancos/db_spfn_backup_" . date('Y-m-m-h-i-s') . ".sql";

    // Abrir o arquivo somente para escrita, coloca o ponteiro no final do arquivo. Se o arquivo não existir, tenta criar.
    $arquivo = fopen($nome_arquivo, 'a');

    // Criar o laço de repetição para ler as tabelas
    while ($row_tabela = $result_listar_tabelas->fetch(PDO::FETCH_NUM)) {
        //var_dump($row_tabela);

        // Criar a QUERY exclui tabela
        //$instrucao_sql = "DROP TABLE IF EXISTS `{$row_tabela[0]}`;\n";

        // Escrever instrução SQL no arquivo
        //fwrite($arquivo, $instrucao_sql);

        // Recuperar o nome das colunas da tabela
        $query_nome_colunas = "SHOW COLUMNS FROM {$row_tabela[0]}";

        // Preparar a QUERY
        $result_nome_colunas = $conn->prepare($query_nome_colunas);

        // Executar a QUERY
        $result_nome_colunas->execute();

        // Verificar se encontrou alguma coluna para a tabela
        if(($result_nome_colunas) and ($result_nome_colunas->rowCount() != 0)) {

            // Criar a QUERY criar tabela
            $instrucao_sql = "CREATE TABLE IF NOT EXISTS `{$row_tabela[0]}` (\n";

            // Variável para receber a coluna que é chave primaria
            $chave_primaria = "";

            // Ler as colunas da tabela
            while ($row_nome_coluna = $result_nome_colunas->fetch(PDO::FETCH_ASSOC)){
                //var_dump($row_nome_coluna);

                // Extrair o array de dados para imprimir através do nome da chave no array
                extract($row_nome_coluna);

                // Acrescentar o nome da coluna
                $instrucao_sql .= "`$Field` ";

                // Acrescentar o nome da coluna
                $instrucao_sql .= "$Type ";

                // Acessa o if quando tem valor default
                if($Default != null){
                    $instrucao_sql .= "DEFAULT $Default ";
                }else{
                    // Acrescentar se a coluna é nula
                    $instrucao_sql .= ($Null == "YES" ? "DEFAULT NULL " : "NOT NULL ");
                }

                // Acrescentar se a coluna é autoincrementa
                $instrucao_sql .= ($Extra == "auto_increment" ? "AUTO_INCREMENT,\n" : ",\n");

                // Acrescentar a coluna que é chave primaria
                $chave_primaria = ($Key == "PRI" ? "PRIMARY KEY (`$Field`)" :  $chave_primaria);

            }

            // Atribuir a chave primaria
            $instrucao_sql .= $chave_primaria;

            // QUERY para recuperar as configurações da tabela
            $query_conf_tabela = "SHOW TABLE STATUS WHERE Name = '{$row_tabela[0]}'";

            // Preparar a QUERY
            $result_conf_tabela = $conn->prepare($query_conf_tabela);

            // Executar a QUERY
            $result_conf_tabela->execute();

            // Ler as configurações da tabela
            $row_conf_tabela = $result_conf_tabela->fetch(PDO::FETCH_ASSOC);
            //var_dump($row_conf_tabela);

            // Extrair o array de dados para imprimir através do nome da chave no array
            extract($row_conf_tabela);

            // Finalizar a QUERY criar tabela
            $instrucao_sql .= "\n) ENGINE=$Engine AUTO_INCREMENT=$Auto_increment DEFAULT CHARSET=utf8mb4 COLLATE=$Collation; \n\n";

            // Escrever instrução SQL no arquivo
            fwrite($arquivo, $instrucao_sql);

            // Recebe as tabelas exportadas
            $tabelas_exportadas .= "{$row_tabela[0]}, ";

            // Recuperar os registros da tabela
            $query_registros = "SELECT * FROM {$row_tabela[0]}";

            // Preparar a QUERY
            $result_registros = $conn->prepare($query_registros);

            // Executar a QUERY
            $result_registros->execute();

            // Verificar se encontrou algum registro no banco de dados
            if(($result_registros) and ($result_registros->rowCount() != 0)){

                // Criar a instrução SQL inserir registro no banco de dados
                $instrucao_sql = "INSERT INTO `$row_tabela[0]` VALUES \n";

                // Escrever instrução SQL no arquivo
                fwrite($arquivo, $instrucao_sql);

                // Quantidade de registros retornado do banco de dados
                $qtd_registros = $result_registros->rowCount();

                // Quantidade de registros impresso
                $qtd_registros_impressos = 1;

                // Criar o laço de repetição para ler os registros
                while($row_registro = $result_registros->fetch(PDO::FETCH_ASSOC)){
                    //var_dump($row_registro);

                    // Inicio dos dados do registro
                    $instrucao_sql = "(";

                    // Quantidade de colunas
                    $qtd_colunas = count($row_registro);

                    // Quantidade de colunas impressa
                    $qtd_colunas_impressas = 1;

                    // Laço de repetição para ler os valores das colunas
                    foreach($row_registro as $chave => $valor){

                        // Adicionar barra antes dos caracteres (', ", \)
                        $valor = addslashes($valor);

                        // Substituir todas as ocorrências da string \n pela \\n
                        $valor = str_replace("\n", "\\n", $valor);

                        // Acessa o IF quando a coluna possui valor
                        if(!empty($valor)){
                            // Atribuir o valor da coluna e verificar se deve colocar a vírgula
                            $instrucao_sql .= '"' . $valor . '"' . ($qtd_colunas_impressas >= $qtd_colunas ? "" : ",");
                        } else {
                            // Atribuir o valor NULL na coluna e verificar se deve colocar a vírgula
                            $instrucao_sql .= 'NULL' . ($qtd_colunas_impressas >= $qtd_colunas ? "" : ",");
                        }

                        // Incrementa mais 1 para a variável de controle das colunas impressas, utilizada para verificar se deve colocar a vírgula
                        $qtd_colunas_impressas = $qtd_colunas_impressas + 1;
                    }

                    // Fim dos dados do registro
                    $instrucao_sql .= ")" . ($qtd_registros_impressos >= $qtd_registros ? ";\n\n" : ",\n");

                    // Incrementa mais 1 para a variável de controle dos registros impressos, utilizada para verificar se deve colocar a vírgula
                    $qtd_registros_impressos = $qtd_registros_impressos + 1;

                    // Escrever instrução SQL no arquivo
                    fwrite($arquivo, $instrucao_sql);
                }

            } else {
                // Imprimir o erro quando não encontrar nenhum registro
                echo "<p style='color: #f00;'>Erro: Nenhum registro encontrado na tabela {$row_tabela[0]}!</p>";
            }

        } else {

            // Imprimir o erro quando não encontrar nenhuma coluna para tabela
            echo "<p style='color: #f00;'>Erro: Nenhuma coluna para a tabela {$row_tabela[0]} encontrada!</p>";
        }
    }

    // Retirar a última vírgula
    $tabelas_exportadas = rtrim($tabelas_exportadas, ", ");

    // Imprimir mensagem de sucesso
	echo "<p style='color: green;'>-> Exportado as tabelas $tabelas_exportadas!</p>";

} else {
    // Imprimir o erro quando não encontrar nenhuma tabela
    echo "<p style='color: #f00;'>Erro: Nenhuma tabela encontrada!</p>";
}

}
}

// ------------------------------------------------ Criar na classe pois assim não é preciso criar em todas as scripts.

    $repositorioLogs = new RepositorioLogsMYSQL(); 

    // Fim do php
?>