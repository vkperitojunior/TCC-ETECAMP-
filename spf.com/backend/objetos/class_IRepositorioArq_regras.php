<?php
// Começo do php

// Incluindo link para conexão com banco de dados
// Incluindo link para conexão com banco de dados
include_once 'backend/conexao/script/conexao.php';
require_once 'backend/classes/class_Arq_regras.php';

// aqui criamos a interface com as funções Arq_regras dentro
interface IRepositorioArq_regras {
    public function verificaArquivo($pdf);
    public function cadastrarArq_regras($Arq_regras);
    public function alterarArq_regras($Arq_regras);
    public function listarTodosArq_regras();
    public function buscarArq_regras($id_pdfregra);
    public function removerArq_regras($id_pdfregra);
    public function remover_todos();
    public function ativar_registros();
    public function desativar_registros();
    public function gerar_csv();
    public function id_correto();
    public function alteraStatus($id,$status);
    public function gerar_xls();
}

// aqui implementamos a classe com suas funções em uma interface para poder trabalhar com elas
class RepositorioArq_regrasMYSQL implements IRepositorioArq_regras {

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
$nome_arquivo = 'arq_regras.xlsx'; // Alterado para .xlsx

// Verifica se a pasta existe, se não, cria a pasta
if (!is_dir($pasta_destino)) {
    mkdir($pasta_destino, 0777, true); // Cria a pasta com permissões
}

// Caminho completo do arquivo
$caminho_arquivo = $pasta_destino . $nome_arquivo;

// Selecionando tudo da tabela referenciada
$sql = "SELECT * FROM arq_regras";

// Faz a conexão e executa a query
$retorno = $this->conexao->executarQuery($sql);

// Define os dados da planilha, iniciando pelo cabeçalho
$dados = [
    ['ID', 'ID Gincana', 'Título', 'Descrição', 'Arquivo', 'Status'] // Cabeçalho
];

// Verifica se a query retornou dados
if ($retorno->num_rows > 0) {
    // Adiciona os dados de cada linha à planilha
    while ($row = $retorno->fetch_assoc()) {
        $dados[] = [
            $row["id_pdfregra"],
            $row["gincana_id"],
            $row["titulo_pdfregra"],
            $row["desc_pdfregra"],
            $row["arquivo_pdfregra"],
            $row["status_pdfregra"]
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
echo "<script>window.location.href='../tabelas/7'</script>";
    
    }

        
    public function verificaArquivo($pdf)
    {
        $fotoRecebida = explode(".", $pdf['name']); // receba a foto e separa pelo "."
        $tamanhoArquivo = 2097152; // Tamanho máximo permitido
        $pastaPdfDestino = "frontend/public/pdf/pdf_regras/";
        if ($pdf['error'] == 0){
            $extensao = $fotoRecebida['1'];
            if(in_array($extensao, array('pdf', 'docx'))) {
                if ($pdf['size'] > $tamanhoArquivo) {
                    $mensagem = "Arquivo Enviado é muito Grande";
                    $_SESSION['mensagem'] = $mensagem;
                } else {
                    $novoNome = md5(time()). "." . $extensao;
                    echo $_FILES['arquivopdfregra']['tmp_name'];
                    echo "<br>";
                    echo $pdf['tmp_name'];
                    $enviou = move_uploaded_file($_FILES['arquivopdfregra']['tmp_name'], $pastaPdfDestino . $novoNome);
                    if ($enviou) {
                        return ($novoNome);
                    } else {
                        return false;
                    }
                }
            } else {
                $mensagem = "Somente arquivos do tipo 'pdf', 'docx' são permitidos!!!";
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
    $sql = "UPDATE arq_regras SET status_pdfregra = '$status' WHERE id_pdfregra = '$id'";

    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../../../tabelas/7'</script>";
}
    
// ---------------------------------------------- Criando a função de cadastro de Arq_regras
    public function cadastrarArq_regras($Arq_regras)
    {

        // requisitando o id_pdfregra do Arq_regras
        $id_pdfregra = $Arq_regras->getId_pdfregra();
        // requisitando o gincana_id do Arq_regras
        $gincana_id = $Arq_regras->getGincana_id();
        // requisitando o titulo_pdfregra do Arq_regras
        $titulo_pdfregra = $Arq_regras->getTitulo_pdfregra();
        // requisitando a desc_pdfregra do Arq_regras
        $desc_pdfregra = $Arq_regras->getDesc_pdfregra();
        // requisitando a arquivo_pdfregra do Arq_regras
        $arquivo_pdfregra = $Arq_regras->getArquivo_pdfregra();
        // requisitando a status_pdfregra do Arq_regras
        $status_pdfregra = $Arq_regras->getStatus_pdfregra();
                // requisitando a status_pdfavaliativo do Arq_avaliativo
                $id_ult_atz = $Arq_regras->getUlt_us_atz();

        // criando o comando de inserção de Arq_regras no banco de dados
        $sql = "INSERT INTO arq_regras (id_pdfregra,gincana_id,titulo_pdfregra,desc_pdfregra,arquivo_pdfregra,status_pdfregra, ult_us_atz)
         VALUES ('$id_pdfregra','$gincana_id','$titulo_pdfregra','$desc_pdfregra','$arquivo_pdfregra','$status_pdfregra','$id_ult_atz')";
        
        // solicitando a conexão com banco de dados e enviando o coamndo para inserir
        $this->conexao->executarQuery($sql);

        
        // voltando para a página de inicial
        echo "<script>window.location.href='../tabelas/7'</script>";

    }

            // ------------------------------------------------- Criando a função de alterar arquivo de avaliação

            public function alterarArq_regras($Arq_regras)
            {
                
        // requisitando o id_pdfregra do Arq_regras
        $id_pdfregra = $Arq_regras->getId_pdfregra();
        // requisitando o gincana_id do Arq_regras
        $gincana_id = $Arq_regras->getGincana_id();
        // requisitando o titulo_pdfregra do Arq_regras
        $titulo_pdfregra = $Arq_regras->getTitulo_pdfregra();
        // requisitando a desc_pdfregra do Arq_regras
        $desc_pdfregra = $Arq_regras->getDesc_pdfregra();
        // requisitando a arquivo_pdfregra do Arq_regras
        $arquivo_pdfregra = $Arq_regras->getArquivo_pdfregra();
        // requisitando a status_pdfregra do Arq_regras
        $status_pdfregra = $Arq_regras->getStatus_pdfregra();
                        // requisitando a status_pdfavaliativo do Arq_avaliativo
                        $id_ult_atz = $Arq_regras->getUlt_us_atz();
            
                    //  criando o comando para alterar o Foto
           $sql = "UPDATE arq_regras SET id_pdfregra = '$id_pdfregra',gincana_id  = '$gincana_id',titulo_pdfregra  = '$titulo_pdfregra',desc_pdfregra  = '$desc_pdfregra ',arquivo_pdfregra = '$arquivo_pdfregra ',status_pdfregra  = '$status_pdfregra ', ult_us_atz = '$id_ult_atz' WHERE id_pdfregra = '$id_pdfregra'";
       
           // solicitando a conexão com banco de dados e enviando o coamndo para alterar o registro anterior
           $this->conexao->executarQuery($sql);

                   // voltando para a página de inicial
        echo "<script>window.location.href='../tabelas/7'</script>";
    
            }

// ------------------------------------------------- Criando a função de listar todos os Arq_regras

    public function listarTodosArq_regras()
    {
        
    // criando o comando para buscar todos os Arq_regras
    $sql = "SELECT * FROM arq_regras WHERE status_pdfregra='1' ";

    // solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os Arq_regras
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;

    }

// ------------------------------------------------- Criando a função de listar todos os Arq_regras

public function listarTodos_crud()
{
    
// criando o comando para buscar todos os Arq_regras
$sql = "SELECT * FROM arq_regras ";

// solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os Arq_regras
$retorno = $this->conexao->executarQuery($sql);

return $retorno;

}


// ------------------------------------------------- Criando a função que busca as informações do Arq_regras para o restante do site

    public function buscarArq_regras($id_pdfregra)
    {
                
    // criando o comando para buscar o Arq_regras especifico
    $sql = "SELECT * FROM arq_regras WHERE id_pdfregra = '$id_pdfregra' AND status_pdfregra='1'";

    // solicitando a conexão com banco de dados e enviando o comando para buscar um Arq_regras especifico
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;
    }

// ------------------------------------------------- Criando a função que remove o Arq_regras se assim for solicitado

    public function removerArq_regras($id_pdfregra)
    {

        // comando de exclusão do banco de dados
        $sql = "DELETE FROM arq_regras
        WHERE id_pdfregra = '$id_pdfregra'";

        // faz um conexão e executa o comando de remover
        $this->conexao->executarQuery($sql);

        // voltando para a página de inicial
        echo "<script>window.location.href='../../tabelas/7'</script>";
    }

// ------------------------------------------------- Criando a função que remove todos os arquivos

public function remover_todos()
{

    // comando de exclusão do banco de dados
    $sql = "DELETE FROM arq_regras";

    // faz um conexão e executa o comando de remover todos
    $this->conexao->executarQuery($sql);

        // voltando para a página de inicial
        echo "<script>window.location.href='../tabelas/7'</script>";
}


// ------------------------------------------------- Criando a função que ativa todos os registros

public function ativar_registros()
{

    // comando de exclusão do banco de dados
    $sql = "UPDATE arq_regras SET status_pdfregra = 1;";

    // faz um conexão e executa o comando de ativar
    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/7'</script>";
}


// ------------------------------------------------- Criando a função que desativa todos os registros

public function desativar_registros ()
{

    // comando de exclusão do banco de dados
    $sql = "UPDATE arq_regras SET status_pdfregra = 0;";

    // faz um conexão e executa o comando de desativar
    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/7'</script>";
}

// ------------------------------------------------- Criando a função para gerar csv de todos os dados

public function gerar_csv ()
{

    // Pasta onde os arquivos CSV serão salvos
$pasta_destino = 'frontend/public/csv/'; // Caminho relativo da pasta
$nome_arquivo = 'arq_regras.csv';

// Verifica se a pasta existe, se não, cria a pasta
if (!is_dir($pasta_destino)) {
    mkdir($pasta_destino, 0777, true); // Cria a pasta com permissões
}

// Caminho completo do arquivo
$caminho_arquivo = $pasta_destino . $nome_arquivo;
    
    // selecionando tudo da tabela referenciada
    $sql = "SELECT * FROM arq_regras";

    // faz um conexão e executa o comando de desativar
    $retorno = $this->conexao->executarQuery($sql);

    // cria uma array para os dados do csv
    $array_de_dados = array();

    // verifica se dentro da pesquisa ouve algum dado, se sim continua
    if ($retorno -> num_rows > 0) {

        // output data of each row
        while($row = $retorno->fetch_assoc()) {
            
        
        $array_de_dados[] = array(


            'id' => $row["id_pdfregra"], 
            'id gincana' => $row["gincana_id"], 
            'titulo' => $row["titulo_pdfregra"],
            'descricao' => $row["desc_pdfregra"], 
            'arquivo' => $row["arquivo_pdfregra"], 
            'status' => $row["status_pdfregra"]

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
echo "<script>window.location.href='../tabelas/7'</script>";
}

// ------------------------------------------------- Criando a função que procura qual id esta disponivel para uso

public function id_correto()
{
        // criando o comando selecionar o maior id existente
        $sql = "SELECT MAX(id_pdfregra) as maior_id FROM arq_regras";

        // executando a solicitação
        $retorno = $this->conexao->executarQuery($sql);
    
        $id_correto = $retorno + 1;

        return $id_correto;
}

}


// ------------------------------------------------ Criar na classe pois assim não é preciso criar em todas as scripts.

    $repositorioArq_regras = new RepositorioArq_regrasMYSQL(); 

    // Fim do php
?>