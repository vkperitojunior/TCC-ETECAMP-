<?php
// Começo do php

// Incluindo link para conexão com banco de dados
// include_once 'backend/conexao/script/conexao.php';
// Incluindo link para conexão com a classe temas
// Incluindo link para conexão com banco de dados
include_once 'backend/conexao/script/conexao.php';
require_once 'backend/classes/class_Temas.php';

// aqui criamos a interface com as funções Temas dentro
interface IRepositorioTemas {
    public function cadastrarTema($Tema);
    public function alterarTema($Tema);
    public function listarTodosTemas();
    public function listarTodos_crud();
    public function buscarTema($id_tema);
    public function buscarUltimoTema();
    public function removerTema($id_tema);
    public function remover_todos();
    public function ativar_registros();
    public function desativar_registros();
    public function gerar_csv();
    public function id_correto();
    public function alteraStatus($id,$status);
    public function gerar_xls();
}

// aqui implementamos a classe com suas funções em uma interface para poder trabalhar com elas
class RepositorioTemasMYSQL implements IRepositorioTemas {

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
$nome_arquivo = 'temas.xlsx'; // Nome do arquivo Excel

// Verifica se a pasta existe, se não, cria a pasta
if (!is_dir($pasta_destino)) {
    mkdir($pasta_destino, 0777, true); // Cria a pasta com permissões
}

// Caminho completo do arquivo
$caminho_arquivo = $pasta_destino . $nome_arquivo;

// Selecionando tudo da tabela referenciada
$sql = "SELECT * FROM temas";

// Faz a conexão e executa a query
$retorno = $this->conexao->executarQuery($sql);

// Cria uma array para armazenar os dados do Excel
$dados = [];
$dados[] = ['Id', 'Tema', 'Motivação', 'Primeiro Ano de Uso', 'Status']; // Cabeçalhos

// Verifica se a query retornou dados
if ($retorno->num_rows > 0) {
    // Output data de cada linha
    while ($row = $retorno->fetch_assoc()) {
        $dados[] = [
            $row["id_tema"],
            $row["tema_tm"],
            $row["motivacao_tm"],
            $row["primeiro_ano"],
            $row["status_tm"]
        ];
    }
} else {
    echo "0 resultados nas tabelas";
}

// Cria o arquivo Excel usando o SimpleXLSXGen
$xlsx = Shuchkin\SimpleXLSXGen::fromArray($dados);
$xlsx->saveAs($caminho_arquivo); // Salva o arquivo no caminho especificado

// Exibe uma mensagem de sucesso ou redireciona
echo "Arquivo Excel gerado com sucesso em: $caminho_arquivo";
echo "<script>window.location.href='../tabelas/10'</script>";


}

    // --------------------------------------------- Criando a função de mudar o status

public function alteraStatus($id,$status)
{
    $sql = "UPDATE temas SET status_tm = '$status' WHERE id_tema = '$id'";

    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../../../tabelas/10'</script>";

}
    
// ---------------------------------------------- Criando a função de cadastro de Tema
    public function cadastrarTema($Tema)
    {

        // requisitando o id_tema do Tema
        $id_tema = $Tema->getid_tema();
        // requisitando o tema_tm do Tema
        $tema_tm = $Tema->gettema_tm();
        // requisitando o motivacao_tm  do Tema
        $motivacao_tm  = $Tema->getmotivacao_tm();
        // requisitando a primeiro_ano  do Tema
        $primeiro_ano  = $Tema->getprimeiro_ano();
        // requisitando a status_tm  do Tema
        $status_tm  = $Tema->getstatus_tm();
                        // requisitando a status_pdfavaliativo do Arq_avaliativo
                        $id_ult_atz = $Tema->getUlt_us_atz();

        // criando o comando de inserção de Tema no banco de dados
        $sql = "INSERT INTO temas (id_tema,tema_tm,motivacao_tm ,primeiro_ano ,status_tm, ult_us_atz)
         VALUES ('$id_tema','$tema_tm','$motivacao_tm ','$primeiro_ano','$status_tm ','$id_ult_atz')";
        
        // solicitando a conexão com banco de dados e enviando o coamndo para inserir
        $this->conexao->executarQuery($sql);

        
        // voltando para a página de inicial
        echo "<script>window.location.href='../tabelas/10'</script>";

    }

// ------------------------------------------------- Criando a função de alterar Tema

    public function alterarTema($Tema)
    {
    
     // requisitando o id_tema do Tema
     $id_tema = $Tema->getid_tema();
     // requisitando o tema_tm do Tema
     $tema_tm = $Tema->gettema_tm();
     // requisitando o motivacao_tm  do Tema
     $motivacao_tm  = $Tema->getmotivacao_tm();
     // requisitando a primeiro_ano  do Tema
     $primeiro_ano  = $Tema->getprimeiro_ano();
     // requisitando a status_tm  do Tema
     $status_tm  = $Tema->getstatus_tm();
                     // requisitando a status_pdfavaliativo do Arq_avaliativo
                     $id_ult_atz = $Tema->getUlt_us_atz();
    
    //  criando o comando para alterar o Tema
   $sql = "UPDATE temas SET tema_tm = '$tema_tm',motivacao_tm  = '$motivacao_tm ',primeiro_ano  = '$primeiro_ano',status_tm  = '$status_tm ', ult_us_atz = '$id_ult_atz'  WHERE id_tema = '$id_tema'";

    // solicitando a conexão com banco de dados e enviando o coamndo para alterar o registro anterior
    $this->conexao->executarQuery($sql);

            // voltando para a página de inicial
            echo "<script>window.location.href='../tabelas/10'</script>";

    }

// ------------------------------------------------- Criando a função de listar todos os Temas

    public function listarTodosTemas()
    {
        
    // criando o comando para buscar todos os Temas
    $sql = "SELECT * FROM temas WHERE status_tm = '1'";

    // solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os Temas
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;
    }

    // ------------------------------------------------- Criando a função de listar todos os Temas

    public function listarTodos_crud()
    {
        
    // criando o comando para buscar todos os Temas
    $sql = "SELECT * FROM temas";

    // solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os Temas
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;
    }


// ------------------------------------------------- Criando a função que busca as informações do Tema para o restante do site

    public function buscarTema($id_tema)
    {
                
    // criando o comando para buscar o Tema especifico
    $sql = "SELECT * FROM temas WHERE id_tema = '$id_tema' AND status_tm = '1'";

    // solicitando a conexão com banco de dados e enviando o comando para buscar um Tema especifico
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;
    }

    // ------------------------------------------------- Criando a função que busca o ultimo tema registrado

    public function buscarUltimoTema()
    {
                
    // criando o comando para buscar o Tema especifico
    $sql = "SELECT * FROM temas WHERE status_tm = '1' ORDER BY id_tema DESC limit 1";

    // solicitando a conexão com banco de dados e enviando o comando para buscar um Tema especifico
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;
    }



// ------------------------------------------------- Criando a função que remove o Tema se assim for solicitado

    public function removerTema($id_tema)
    {

        // comando de exclusão do banco de dados
        $sql = "DELETE FROM temas
        WHERE id_tema = '$id_tema'";

        // faz um conexão e executa o comando de remover
        $this->conexao->executarQuery($sql);

        // voltando para a página de inicial
        echo "<script>window.location.href='../../tabelas/10'</script>";
    }

// ------------------------------------------------- Criando a função que remove todos os arquivos

public function remover_todos()
{

    // comando de exclusão do banco de dados
    $sql = "DELETE FROM temas";

    // faz um conexão e executa o comando de remover todos
    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/10'</script>";
}


// ------------------------------------------------- Criando a função que ativa todos os registros

public function ativar_registros()
{

    // comando de exclusão do banco de dados
    $sql = "UPDATE temas SET status_tm = 1;";

    // faz um conexão e executa o comando de ativar
    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/10'</script>";
}


// ------------------------------------------------- Criando a função que desativa todos os registros

public function desativar_registros ()
{

    // comando de exclusão do banco de dados
    $sql = "UPDATE temas SET status_tm = 0;";

    // faz um conexão e executa o comando de desativar
    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/10'</script>";
}

// ------------------------------------------------- Criando a função para gerar csv de todos os dados

public function gerar_csv ()
{

    // Pasta onde os arquivos CSV serão salvos
$pasta_destino = 'frontend/public/csv/'; // Caminho relativo da pasta
$nome_arquivo = 'temas.csv';

// Verifica se a pasta existe, se não, cria a pasta
if (!is_dir($pasta_destino)) {
    mkdir($pasta_destino, 0777, true); // Cria a pasta com permissões
}

// Caminho completo do arquivo
$caminho_arquivo = $pasta_destino . $nome_arquivo;
    
    // selecionando tudo da tabela referenciada
    $sql = "SELECT * FROM temas";

    // faz um conexão e executa o comando de desativar
    $retorno = $this->conexao->executarQuery($sql);

    // cria uma array para os dados do csv
    $array_de_dados = array();

    // verifica se dentro da pesquisa ouve algum dado, se sim continua
    if ($retorno -> num_rows > 0) {

        // output data of each row
        while($row = $retorno->fetch_assoc()) {
            
        
        $array_de_dados[] = array(


            'Id' => $row["id_tema"], 
            'Tema' => $row["tema_tm"], 
            'Motivacao' => $row["motivacao_tm"],
            'Primeiro Ano de Uso' => $row["primeiro_ano"], 
            'Status' => $row["status_tm"]

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
echo "<script>window.location.href='../tabelas/10'</script>";
}

// ------------------------------------------------- Criando a função que procura qual id esta disponivel para uso

public function id_correto()
{
        // criando o comando selecionar o maior id existente
        $sql = "SELECT MAX(id_tema) as maior_id FROM temas";

        // executando a solicitação
        $retorno = $this->conexao->executarQuery($sql);
    
        $id_correto = $retorno + 1;

        return $id_correto;
}
}


// ------------------------------------------------ Criar na classe pois assim não é preciso criar em todas as scripts.

$repositorioTemas = new RepositorioTemasMYSQL(); 

    
// Fim do php
?>