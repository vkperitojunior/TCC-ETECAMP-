<?php
// Começo do php

// Incluindo link para conexão com banco de dados
include_once 'backend/conexao/script/conexao.php';
// Incluindo link para conexão com a classe usuários
// include_once __DIR__.'../classes/class_Carrosel.php';
require_once 'backend/classes/class_Carrosel.php';

// aqui criamos a interface com as funções Carrosel dentro
interface IRepositorioCarrosel {
    public function cadastrarCarrosel($carrosel);
    public function alterarCarrosel($carrosel);
    public function listarTodos_crud();
    public function buscarCarrosel($id_cs);
    public function removerCarrosel($id_cs);
    public function remover_todos();
    public function ativar_registros();
    public function desativar_registros();
    public function gerar_csv();
    public function id_correto();
    public function alteraStatus($id,$status);
    public function verificaFoto($foto);
    public function gerar_xls();
}

// aqui implementamos a classe com suas funções em uma interface para poder trabalhar com elas
class RepositorioCarroselMYSQL implements IRepositorioCarrosel {

// ------------------------------------------------- Criando conexão com banco de dados
private $conexao;

// constroi uma variavel de conexão
    public function __construct()
    {

        // pegando a senha do banco de dados e a transformando em variavel
        $senha='';

        // passa os parametros de conexão
        $this->conexao = new ConexaoSQL("localhost","root","$senha","bd_spf");
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
$nome_arquivo = 'carrosel.xlsx'; // Alterado para .xlsx

// Verifica se a pasta existe, se não, cria a pasta
if (!is_dir($pasta_destino)) {
    mkdir($pasta_destino, 0777, true); // Cria a pasta com permissões
}

// Caminho completo do arquivo
$caminho_arquivo = $pasta_destino . $nome_arquivo;

// Selecionando tudo da tabela referenciada
$sql = "SELECT * FROM carrosel";

// Faz a conexão e executa a query
$retorno = $this->conexao->executarQuery($sql);

// Define os dados da planilha, iniciando pelo cabeçalho
$dados = [
    ['ID', 'Título', 'Ordem', 'Data', 'Foto', 'Status'] // Cabeçalho
];

// Verifica se a query retornou dados
if ($retorno->num_rows > 0) {
    // Adiciona os dados de cada linha à planilha
    while ($row = $retorno->fetch_assoc()) {
        $dados[] = [
            $row["id_cs"],
            $row["titulo_cs"],
            $row["ordem_cs"],
            $row["arquivo_cs"],
            $row["data_cs"],
            $row["status_cs"]
        ];
    }
} else {
    echo "0 resultados nas tabelas";
    exit;
}

// Cria o arquivo Excel no caminho definido
$xlsx = Shuchkin\SimpleXLSXGen::fromArray($dados);
$xlsx->saveAs($caminho_arquivo);

// Exibe uma mensagem de sucesso ou redireciona
echo "Arquivo Excel gerado com sucesso em: $caminho_arquivo";
echo "<script>window.location.href='../tabelas/13'</script>";

}

    public function verificaFoto($foto)
    {
        $fotoRecebida = explode(".", $foto['name']); // receba a foto e separa pelo "."
        $tamanhoArquivo = 2097152; // Tamanho máximo permitido
        $pastaFotoDestino = "frontend/public/imagens/imagens_carrosel/";
        if ($foto['error'] == 0){
            $extensao = $fotoRecebida['1'];
            if(in_array($extensao, array('jpg', 'jpeg', 'gif', 'png'))) {
                if ($foto['size'] > $tamanhoArquivo) {
                    $mensagem = "Arquivo Enviado é muito Grande";
                    $_SESSION['mensagem'] = $mensagem;
                } else {
                    $novoNome = md5(time()). "." . $extensao;
                    echo $_FILES['arquivo_cs']['tmp_name'];
                    echo "<br>";
                    echo $foto['tmp_name'];
                    $enviou = move_uploaded_file($_FILES['arquivo_cs']['tmp_name'], $pastaFotoDestino . $novoNome);
                    if ($enviou) {
                        return ($novoNome);
                    } else {
                        return false;
                    }
                }
            } else {
                $mensagem = "Somente arquivos do tipo 'jpg', 'jpeg', 'gif', 'png' são permitidos!!!";
                $_SESSION['mensagem'] = $mensagem;
            }
        } else {
            $mensagem = "Um arquivo deve ser enviado!!!!";
            $_SESSION['mensagem'] = $mensagem;
        }
    }


        // --------------------------------------------- Criando a função de mudar o status

public function alteraStatus($id,$status)
{
    $sql = "UPDATE carrosel SET status_cs = '$status' WHERE id_cs = '$id'";

    $this->conexao->executarQuery($sql);


    // voltando para a página de inicial
    echo "<script>window.location.href='../../../tabelas/13'</script>";

}
    
// ---------------------------------------------- Criando a função de cadastro de Carrosel
    public function cadastrarCarrosel($Carrosel)
    {

        // requisitando o id_cs do Carrosel
        $id_cs = $Carrosel->getid_cs();
        // requisitando o Titulo do Carrosel
        $titulo = $Carrosel->gettitulo_cs();
        // requisitando o ordem_cs do Carrosel
        $ordem_cs = $Carrosel->getordem_cs();
        // requisitando a arquivo_cs do Carrosel
        $arquivo_cs = $Carrosel->getarquivo_cs();
        // requisitando a data_cs do Carrosel
        $data_cs = $Carrosel->getdata_cs();
        // requisitando a status_cs do Carrosel
        $status_cs = $Carrosel->getstatus_cs();
        // requisitando a status_pdfavaliativo do Arq_avaliativo
        $id_ult_atz = $Carrosel->getUlt_us_atz();

        // criando o comando de inserção de Carrosel no banco de dados
        $sql = "INSERT INTO carrosel (id_cs,titulo_cs,ordem_cs,arquivo_cs,data_cs,status_cs, ult_us_atz)
         VALUES ('$id_cs','$titulo','$ordem_cs','$arquivo_cs','$data_cs','$status_cs','$id_ult_atz')";
        
        // solicitando a conexão com banco de dados e enviando o coamndo para inserir
        $this->conexao->executarQuery($sql);

        
        // voltando para a página de inicial
        echo "<script>window.location.href='../tabelas/13'</script>";

    }

// ------------------------------------------------- Criando a função de alterar Carrosel

    public function alterarCarrosel($Carrosel)
    {
    
     // requisitando o id_cs do Carrosel
     $id_cs = $Carrosel->getid_cs();
     // requisitando o Titulo do Carrosel
     $Titulo = $Carrosel->gettitulo_cs();
     // requisitando o ordem_cs do Carrosel
     $ordem_cs = $Carrosel->getordem_cs();
     // requisitando a arquivo_cs do Carrosel
     $arquivo_cs = $Carrosel->getarquivo_cs();
     // requisitando a data_cs do Carrosel
     $data_cs = $Carrosel->getdata_cs();
     // requisitando a status_cs do Carrosel
     $status_cs = $Carrosel->getstatus_cs();
     // requisitando o status inicial do Carrosel
     $status_cs = 0;
                     // requisitando a status_pdfavaliativo do Arq_avaliativo
                     $id_ult_atz = $Carrosel->getUlt_us_atz();
    
    //  criando o comando para alterar o Carrosel
   $sql = "UPDATE carrosel SET titulo_cs = '$Titulo', ordem_cs = '$ordem_cs', arquivo_cs = '$arquivo_cs', data_cs = '$data_cs', status_cs = '$status_cs', ult_us_atz = '$id_ult_atz'  WHERE id_cs = '$id_cs'";

    // solicitando a conexão com banco de dados e enviando o coamndo para alterar o registro anterior
    $this->conexao->executarQuery($sql);

            // voltando para a página de inicial
            echo "<script>window.location.href='../tabelas/13'</script>";

    }

// ------------------------------------------------- Criando a função de listar todos os Carrosel

    public function listarTodasCarrosel()
    {
        
    // criando o comando para buscar todos os Carrosel
    $sql = "SELECT * FROM carrosel WHERE status_cs = 1";

    // solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os Carrosel
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;
    }


    // ------------------------------------------------- Criando a função de listar todos os Carrosel

    public function listarTodos_crud()
    {

    // criando o comando para buscar todos os Carrosel
    $sql = "SELECT * FROM carrosel ORDER BY ordem_cs ASC";

    // solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os Carrosel
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;
    }


// ------------------------------------------------- Criando a função que busca as informações do Carrosel para o restante do site

    public function buscarCarrosel($id_cs)
    {
                
    // criando o comando para buscar o Carrosel especifico
    $sql = "SELECT * FROM carrosel WHERE id_cs = '$id_cs' AND status_cs = 1";

    // solicitando a conexão com banco de dados e enviando o comando para buscar um Carrosel especifico
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;
    }

// ------------------------------------------------- Criando a função que busca o ultimo tema registrado

public function buscarUltimaCarrosel()
{
            
// criando o comando para buscar o Tema especifico
$sql = "SELECT * FROM carrosel WHERE status_cs = '1' ORDER BY id_cs DESC limit 1";

// solicitando a conexão com banco de dados e enviando o comando para buscar um Tema especifico
$retorno = $this->conexao->executarQuery($sql);

return $retorno;
}

// ------------------------------------------------- Criando a função que remove o Carrosel se assim for solicitado

    public function removerCarrosel($id_cs)
    {

        // comando de exclusão do banco de dados
        $sql = "DELETE FROM carrosel
        WHERE id_cs = '$id_cs'";

        // faz um conexão e executa o comando de remover
        $this->conexao->executarQuery($sql);

        // voltando para a página de inicial
        echo "<script>window.location.href='../../tabelas/13'</script>";
    }

// ------------------------------------------------- Criando a função que remove todos os arquivos

public function remover_todos()
{

    // comando de exclusão do banco de dados
    $sql = "DELETE FROM carrosel";

    // faz um conexão e executa o comando de remover todos
    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/13'</script>";
}


// ------------------------------------------------- Criando a função que ativa todos os registros

public function ativar_registros()
{

    // comando de exclusão do banco de dados
    $sql = "UPDATE carrosel SET status_cs = 1;";

    // faz um conexão e executa o comando de ativar
    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/13'</script>";
}


// ------------------------------------------------- Criando a função que desativa todos os registros

public function desativar_registros ()
{

    // comando de exclusão do banco de dados
    $sql = "UPDATE carrosel SET status_cs = 0;";

    // faz um conexão e executa o comando de desativar
    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/13'</script>";
}

// ------------------------------------------------- Criando a função para gerar csv de todos os dados

public function gerar_csv ()
{

    // Pasta onde os arquivos CSV serão salvos
$pasta_destino = 'frontend/public/csv/'; // Caminho relativo da pasta
$nome_arquivo = 'carrosel.csv';

// Verifica se a pasta existe, se não, cria a pasta
if (!is_dir($pasta_destino)) {
    mkdir($pasta_destino, 0777, true); // Cria a pasta com permissões
}

// Caminho completo do arquivo
$caminho_arquivo = $pasta_destino . $nome_arquivo;

    // selecionando tudo da tabela referenciada
    $sql = "SELECT * FROM carrosel";

    // faz um conexão e executa o comando de desativar
    $retorno = $this->conexao->executarQuery($sql);

    // cria uma array para os dados do csv
    $array_de_dados = array();

    // verifica se dentro da pesquisa ouve algum dado, se sim continua
    if ($retorno -> num_rows > 0) {

        // output data of each row
        while($row = $retorno->fetch_assoc()) {
            
        
        $array_de_dados[] = array(


            'Id' => $row["id_cs"], 
            'Titulo' => $row["titulo_cs"], 
            'ordem_cs' => $row["ordem_cs"],
            'Data' => $row["arquivo_cs"], 
            'Foto' => $row["data_cs"], 
            'Status' => $row["status_cs"]

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
echo "<script>window.location.href='../tabelas/13'</script>";
}

// ------------------------------------------------- Criando a função que procura qual id esta disponivel para uso

public function id_correto()
{
        // criando o comando selecionar o maior id existente
        $sql = "SELECT MAX(id_cs) as maior_id FROM carrosel";

        // executando a solicitação
        $retorno = $this->conexao->executarQuery($sql);
    
        $id_correto = $retorno + 1;

        return $id_correto;
}

}
 
// ------------------------------------------------ Criar na classe pois assim não é preciso criar em todas as scripts.

    $repositorioCarrosel = new RepositorioCarroselMYSQL(); 

    // Fim do php
?>