<?php
// Começo do php

// Incluindo link para conexão com banco de dados
include_once 'backend/conexao/script/conexao.php';
// Incluindo link para conexão com a classe usuários
// include_once __DIR__.'../classes/class_Historicos.php';
require_once 'backend/classes/class_Historicos.php';


// aqui criamos a interface com as funções Historicos dentro
interface IRepositorioHistoricos {
    public function cadastrarHistorico($Historico);
    public function alterarHistorico($Historico);
    public function listarTodosHistoricos();
    public function listarTodos_crud();
    public function buscarHistorico($id_hist);
    public function removerHistorico($id_hist);
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
class RepositorioHistoricoMYSQL implements IRepositorioHistoricos {

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
$nome_arquivo = 'historicos.xlsx'; // Nome do arquivo Excel

// Verifica se a pasta existe, se não, cria a pasta
if (!is_dir($pasta_destino)) {
    mkdir($pasta_destino, 0777, true); // Cria a pasta com permissões
}

// Caminho completo do arquivo
$caminho_arquivo = $pasta_destino . $nome_arquivo;

// Selecionando tudo da tabela referenciada
$sql = "SELECT * FROM historico";

// Faz a conexão e executa a query
$retorno = $this->conexao->executarQuery($sql);

// Cria um array para armazenar os dados do Excel
$dados = [];
$dados[] = ['Id', 'Ano', 'Tema', 'Primeiro Lugar', 'Segundo Lugar', 'Terceiro Lugar', 'Melhor Gincana', 'Foto do Ano', 'Status']; // Cabeçalhos

// Verifica se a query retornou dados
if ($retorno->num_rows > 0) {
    // Adiciona os dados da tabela ao array
    while ($row = $retorno->fetch_assoc()) {
        $dados[] = [
            $row["id_hist"],
            $row["ano_hist"],
            $row["tema_hist"],
            $row["primeiro_lugar"],
            $row["segundo_lugar"],
            $row["terceiro_lugar"],
            $row["melhor_gincana"],
            $row["foto_hist"],
            $row["status_hist"]
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
echo "<script>window.location.href='../tabelas/9'</script>";


}

    public function verificaFoto($foto)
    {
        $fotoRecebida = explode(".", $foto['name']); // receba a foto e separa pelo "."
        $tamanhoArquivo = 2097152; // Tamanho máximo permitido
        $pastaFotoDestino = "frontend/public/imagens/imagens_historicos/";
        if ($foto['error'] == 0){
            $extensao = $fotoRecebida['1'];
            if(in_array($extensao, array('jpg', 'jpeg', 'gif', 'png'))) {
                if ($foto['size'] > $tamanhoArquivo) {
                    $mensagem = "Arquivo Enviado é muito Grande";
                    $_SESSION['mensagem'] = $mensagem;
                } else {
                    $novoNome = md5(time()). "." . $extensao;
                    echo $_FILES['fotohist']['tmp_name'];
                    echo "<br>";
                    echo $foto['tmp_name'];
                    $enviou = move_uploaded_file($_FILES['fotohist']['tmp_name'], $pastaFotoDestino . $novoNome);
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
    $sql = "UPDATE historico SET status_hist = '$status' WHERE id_hist = '$id'";

    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../../../tabelas/9'</script>";

}
    
// ---------------------------------------------- Criando a função de cadastro de Historico
    public function cadastrarHistorico($Historico)
    {

        // requisitando o id_hist do Historico
        $id_hist = $Historico->getId_hist();
        // requisitando o ano_hist do Historico
        $ano_hist = $Historico->getAno_hist();
        // requisitando o tema_hist do Historico
        $tema_hist = $Historico->getTema_hist();
        // requisitando a primeiro_lugar do Historico
        $primeiro_lugar = $Historico->getPrimeiro_lugar();
        // requisitando a segundo_lugar do Historico
        $segundo_lugar = $Historico->getSegundo_lugar();
        // requisitando a terceiro_lugar do Historico
        $terceiro_lugar = $Historico->getTerceiro_lugar();
        // requisitando a melhor gincana do Historico
        $melhor_gincana = $Historico->getMelhorGincana();
        // requisitando a terceiro_lugar do Historico
        $foto_hist = $Historico->getFoto_hist();
        // requisitando a terceiro_lugar do Historico
        $status_hist = $Historico->getStatus_hist();
                        // requisitando a status_pdfavaliativo do Arq_avaliativo
                        $id_ult_atz = $Historico->getUlt_us_atz();

        // criando o comando de inserção de Historico no banco de dados
        $sql = "INSERT INTO historico (id_hist,ano_hist,tema_hist,primeiro_lugar,segundo_lugar,terceiro_lugar,melhor_gincana,foto_hist,status_hist, ult_us_atz)
         VALUES ('$id_hist','$ano_hist','$tema_hist','$primeiro_lugar','$segundo_lugar','$terceiro_lugar','$melhor_gincana','$foto_hist','$status_hist','$id_ult_atz')";
        
        // solicitando a conexão com banco de dados e enviando o coamndo para inserir
        $this->conexao->executarQuery($sql);
        
        // voltando para a página de inicial
        echo "<script>window.location.href='../tabelas/9'</script>";
    }

// ------------------------------------------------- Criando a função de alterar Historico

    public function alterarHistorico($Historico)
    {
    
    // requisitando o id_hist do Historico
    $id_hist = $Historico->getId_hist();
    // requisitando o ano_hist do Historico
    $ano_hist = $Historico->getAno_hist();
    // requisitando o tema_hist do Historico
    $tema_hist = $Historico->getTema_hist();
    // requisitando a primeiro_lugar do Historico
    $primeiro_lugar = $Historico->getPrimeiro_lugar();
    // requisitando a segundo_lugar do Historico
    $segundo_lugar = $Historico->getSegundo_lugar();
    // requisitando a terceiro_lugar do Historico
    $terceiro_lugar = $Historico->getTerceiro_lugar();
    // requisitando a melhor gincana do Historico
    $melhor_gincana = $Historico->getMelhorGincana();
    // requisitando a terceiro_lugar do Historico
    $foto_hist = $Historico->getFoto_hist();
    // requisitando a terceiro_lugar do Historico
    $status_hist = $Historico->getStatus_hist();
                    // requisitando a status_pdfavaliativo do Arq_avaliativo
                    $id_ult_atz = $Historico->getUlt_us_atz();
    
    //  criando o comando para alterar o Historico
   $sql = "UPDATE historico  SET  ano_hist = '$ano_hist', tema_hist = '$tema_hist', primeiro_lugar = '$primeiro_lugar', segundo_lugar = '$segundo_lugar', terceiro_lugar = '$terceiro_lugar', melhor_gincana = '$melhor_gincana', foto_hist = '$foto_hist', status_hist = '$status_hist', ult_us_atz = '$id_ult_atz'  WHERE id_hist = '$id_hist'";

    // solicitando a conexão com banco de dados e enviando o coamndo para alterar o registro anterior
    $this->conexao->executarQuery($sql);

            // voltando para a página de inicial
            echo "<script>window.location.href='../tabelas/9'</script>";

    }

// ------------------------------------------------- Criando a função de listar todos os Historicos

    public function listarTodosHistoricos()
    {
        
    // criando o comando para buscar todos os Historicos
    $sql = "SELECT * FROM historico WHERE status_hist = '1'";

    // solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os Historicos
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;
    }


    // ------------------------------------------------- Criando a função de listar todos os Historicos

    public function listarTodos_crud()
    {
        
    // criando o comando para buscar todos os Historicos
    $sql = "SELECT * FROM historico";

    // solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os Historicos
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;
    }


// ------------------------------------------------- Criando a função que busca as informações do Historico para o restante do site

    public function buscarHistorico($id_hist)
    {
                
    // criando o comando para buscar o Historico especifico
    $sql = "SELECT * FROM historico WHERE id_hist = '$id_hist' AND status_hist = '1'";

    // solicitando a conexão com banco de dados e enviando o comando para buscar um Historico especifico
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;
    }

// ------------------------------------------------- Criando a função que remove o Historico se assim for solicitado

    public function removerHistorico($id_hist)
    {

        // comando de exclusão do banco de dados
        $sql = "DELETE FROM historico
        WHERE id_hist = '$id_hist'";

        // faz um conexão e executa o comando de remover
        $this->conexao->executarQuery($sql);

        // voltando para a página de inicial
        echo "<script>window.location.href='../../tabelas/9'</script>";
    }

// ------------------------------------------------- Criando a função que remove todos os arquivos

public function remover_todos()
{

    // comando de exclusão do banco de dados
    $sql = "DELETE FROM historico";

    // faz um conexão e executa o comando de remover todos
    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../../tabelas/9'</script>";
}


// ------------------------------------------------- Criando a função que ativa todos os registros

public function ativar_registros()
{

    // comando de exclusão do banco de dados
    $sql = "UPDATE historicos SET status_hist = 1;";

    // faz um conexão e executa o comando de ativar
    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/9'</script>";
}


// ------------------------------------------------- Criando a função que desativa todos os registros

public function desativar_registros ()
{

    // comando de exclusão do banco de dados
    $sql = "UPDATE historico SET status_hist = 0;";

    // faz um conexão e executa o comando de desativar
    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/9'</script>";
}

// ------------------------------------------------- Criando a função para gerar csv de todos os dados

public function gerar_csv ()
{

    // Pasta onde os arquivos CSV serão salvos
$pasta_destino = 'frontend/public/csv/'; // Caminho relativo da pasta
$nome_arquivo = 'historicos    public function gerar_xls();.csv';

// Verifica se a pasta existe, se não, cria a pasta
if (!is_dir($pasta_destino)) {
    mkdir($pasta_destino, 0777, true); // Cria a pasta com permissões
}

// Caminho completo do arquivo
$caminho_arquivo = $pasta_destino . $nome_arquivo;
    
    // selecionando tudo da tabela referenciada
    $sql = "SELECT * FROM historico";

    // faz um conexão e executa o comando de desativar
    $retorno = $this->conexao->executarQuery($sql);

    // cria uma array para os dados do csv
    $array_de_dados = array();

    // verifica se dentro da pesquisa ouve algum dado, se sim continua
    if ($retorno -> num_rows > 0) {

        // output data of each row
        while($row = $retorno->fetch_assoc()) {
            
        
        $array_de_dados[] = array(


            'Id' => $row["id_hist"], 
            'Ano' => $row["ano_hist"], 
            'Tema' => $row["tema_hist"],
            'Primeiro Lugar' => $row["primeiro_lugar"], 
            'Segundo Lugar' => $row["segundo_lugar"], 
            'Tereiro Lugar' => $row["terceiro_lugar"],
            'Melhor Gincana' => $row["melhor_gincana"], 
            'Foto do ano' => $row["foto_hist"], 
            'status' => $row["status_hist"],

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
echo "<script>window.location.href='../tabelas/9'</script>";
}

// ------------------------------------------------- Criando a função que procura qual id esta disponivel para uso

public function id_correto()
{
        // criando o comando selecionar o maior id existente
        $sql = "SELECT MAX(id_hist) as maior_id FROM historico";

        // executando a solicitação
        $retorno = $this->conexao->executarQuery($sql);
    
        $id_correto = $retorno + 1;

        return $id_correto;
}

}

// ------------------------------------------------ Criar na classe pois assim não é preciso criar em todas as scripts.

    $repositorioHistoricos = new RepositorioHistoricoMYSQL(); 

    // Fim do php
?>