<?php
// Começo do php

// Incluindo link para conexão com banco de dados
include_once 'backend/conexao/script/conexao.php';
// Incluindo link para conexão com a classe usuários
// include_once __DIR__."../classes/class_Equipes.php";
require_once 'backend/classes/class_Equipes.php';

// aqui criamos a interface com as funções Equipes dentro
interface IRepositorioEquipes {
    public function cadastrarEquipe($Equipe);
    public function alterarEquipe($Equipe);
    public function listarTodasEquipes();
    public function listarTodas_crud();
    public function buscarEquipe($id_eq);
    public function removerEquipe($id_eq);
    public function remover_todos();
    public function ativar_registros();
    public function desativar_registros();
    public function gerar_csv();
    public function id_correto();
    public function alteraStatus($id,$status);
    public function gerar_xls();
    public function atualizarRankingEquipes() ;
}

// aqui implementamos a classe com suas funções em uma interface para poder trabalhar com elas
class RepositorioEquipeMYSQL implements IRepositorioEquipes {

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

function atualizarRankingEquipes() {
    // Consulta SQL para obter as equipes ordenadas pela pontuação (maior para menor)
    $sql = "SELECT equipe_id, soma_pont FROM ppe ORDER BY soma_pont DESC";
    $result = $this->conexao->executarQuery($sql);

    if ($result->num_rows > 0) {
        $rank = 1; // Inicializa a variável de ranking

        // Percorre os resultados e atualiza o ranking
        while ($row = $result->fetch_assoc()) {
            $id = $row['equipe_id']; // Obtém o ID da equipe

            // Atualiza o campo 'ranking' com o valor atual do rank
            $sqlUpdate = "UPDATE ppe SET ranking = '$rank' WHERE equipe_id = '$id'";
            $this->conexao->executarQuery($sqlUpdate);

            // Incrementa o ranking para a próxima equipe
            $rank++;
        }

    } else {
        echo "Nenhuma equipe encontrada para atualizar.";
    }
}

    public function gerar_xls()
{

// Inclua o arquivo da biblioteca SimpleXLSXGen
require_once 'extensions\simplexlsxgen\src\SimpleXLSXGen.php';

// Pasta onde os arquivos Excel serão salvos
$pasta_destino = 'frontend/public/xlsx/'; // Caminho relativo da pasta
$nome_arquivo = 'equipes.xlsx'; // Nome do arquivo Excel

// Verifica se a pasta existe, se não, cria a pasta
if (!is_dir($pasta_destino)) {
    mkdir($pasta_destino, 0777, true); // Cria a pasta com permissões
}

// Caminho completo do arquivo
$caminho_arquivo = $pasta_destino . $nome_arquivo;

// Selecionando tudo da tabela referenciada
$sql = "SELECT * FROM equipes";

// Faz a conexão e executa a query
$retorno = $this->conexao->executarQuery($sql);

// Cria um array para armazenar os dados do Excel
$dados = [];
$dados[] = ['ID', 'Nome da Equipe', 'Sala da Equipe', 'Ano', 'Tema', 'Status']; // Cabeçalhos

// Verifica se a query retornou dados
if ($retorno->num_rows > 0) {
    // Adiciona os dados da tabela ao array
    while ($row = $retorno->fetch_assoc()) {
        $dados[] = [
            $row["id_eq"],
            $row["nome_eq"],
            $row["sala_eq"],
            $row["ano_eq"],
            $row["tema_eq"],
            $row["status_eq"]
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
echo "<script>window.location.href='../tabelas/3'</script>";


}

        // --------------------------------------------- Criando a função de mudar o status

public function alteraStatus($id,$status)
{
    $sql = "UPDATE equipes SET status_eq = '$status' WHERE id_eq = '$id'";

    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../../../tabelas/3'</script>";

}
    
// ---------------------------------------------- Criando a função de cadastro de Equipe
    public function cadastrarEquipe($Equipe)
    {

        // requisitando o id_eq do Equipe
        $id_eq = $Equipe->getId_eq();
        // requisitando o nome_eq do Equipe
        $nome_eq = $Equipe->getNome_eq();
        // requisitando o sala_eq  do Equipe
        $sala_eq  = $Equipe->getSala_eq();
        // requisitando a ano_eq  do Equipe
        $ano_eq  = $Equipe->getAno_eq();
        // requisitando a tema_eq  do Equipe
        $tema_eq  = $Equipe->getTema_eq();
        // requisitando a cor_eq  do Equipe
        $cor_eq  = $Equipe->getCor_eq();
        // requisitando a extra_eq  do Equipe
        $extra_eq  = $Equipe->getExtra_eq();
        // requisitando a status_eq  do Equipe
        $status_eq  = 0;
                        // requisitando a status_pdfavaliativo do Arq_avaliativo
                        $id_ult_atz = $Equipe->getUlt_us_atz();

        // criando o comando de inserção de Equipe no banco de dados
        $sql = "INSERT INTO equipes (id_eq,nome_eq,sala_eq ,ano_eq ,tema_eq, cor_eq, extra_eq, status_eq, ult_us_atz)
         VALUES ('$id_eq','$nome_eq','$sala_eq ','$ano_eq','$tema_eq ', '$cor_eq', '$extra_eq', '$status_eq ','$id_ult_atz')";
        
        // solicitando a conexão com banco de dados e enviando o coamndo para inserir
        $this->conexao->executarQuery($sql);

        // voltando para a página de inicial
        echo "<script>window.location.href='../tabelas/3'</script>";

    }

// ------------------------------------------------- Criando a função de alterar Equipe

    public function alterarEquipe($Equipe)
    {
    
     // requisitando o id_eq do Equipe
     $id_eq = $Equipe->getId_eq();
     // requisitando o nome_eq do Equipe
     $nome_eq = $Equipe->getNome_eq();
     // requisitando o sala_eq  do Equipe
     $sala_eq  = $Equipe->getSala_eq();
     // requisitando a ano_eq  do Equipe
     $ano_eq  = $Equipe->getAno_eq();
     // requisitando a tema_eq  do Equipe
     $tema_eq  = $Equipe->getTema_eq();
    // requisitando a cor_eq  do Equipe
    $cor_eq  = $Equipe->getCor_eq();
    // requisitando a extra_eq  do Equipe
    $extra_eq  = $Equipe->getExtra_eq();
     // requisitando a status_eq  do Equipe
     $status_eq  = $Equipe->getStatus_eq();
                     // requisitando a status_pdfavaliativo do Arq_avaliativo
                     $id_ult_atz = $Equipe->getUlt_us_atz();
    
    //  criando o comando para alterar o Equipe
   $sql = "UPDATE equipes SET nome_eq = '$nome_eq',sala_eq = '$sala_eq',ano_eq = '$ano_eq',tema_eq = '$tema_eq',cor_eq = '$cor_eq',extra_eq  = '$extra_eq',status_eq  = '$status_eq', ult_us_atz = '$id_ult_atz'  WHERE id_eq = '$id_eq'";

    // solicitando a conexão com banco de dados e enviando o coamndo para alterar o registro anterior
    $retorno = $this->conexao->executarQuery($sql);

            // voltando para a página de inicial
            echo "<script>window.location.href='../tabelas/3'</script>";

    }

// ------------------------------------------------- Criando a função de listar todos os Equipes

    public function listarTodasEquipes()
    {
        
    // criando o comando para buscar todos os Equipes
    $sql = "SELECT * FROM equipes WHERE status_eq = '1'";

    // solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os Equipes
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;

    }

    
// ------------------------------------------------- Criando a função de listar todos os Equipes

public function listarTodas_crud()
{
    
// criando o comando para buscar todos os Equipes
$sql = "SELECT * FROM equipes";

// solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os Equipes
$retorno = $this->conexao->executarQuery($sql);

return $retorno;

}


// ------------------------------------------------- Criando a função que busca as informações do Equipe para o restante do site

    public function buscarEquipe($id_eq)
    {
                
    // criando o comando para buscar o Equipe especifico
    $sql = "SELECT * FROM equipes WHERE id_eq = '$id_eq' AND status_eq = '1'";

    // solicitando a conexão com banco de dados e enviando o comando para buscar um Equipe especifico
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;
    }

// ------------------------------------------------- Criando a função que remove o Equipe se assim for solicitado

    public function removerEquipe($id_eq)
    {

        // comando de exclusão do banco de dados
        $sql = "DELETE FROM equipes
        WHERE id_eq = '$id_eq'";

        // faz um conexão e executa o comando de remover
         $this->conexao->executarQuery($sql);

         // voltando para a página de inicial
         echo "<script>window.location.href='../../tabelas/3'</script>";
    }

    // ------------------------------------------------- Criando a função que remove todos os arquivos

public function remover_todos()
{

    // comando de exclusão do banco de dados
    $sql = "DELETE FROM equipes";

    // faz um conexão e executa o comando de remover todos
    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/3'</script>";
}


// ------------------------------------------------- Criando a função que ativa todos os registros

public function ativar_registros()
{

    // comando de exclusão do banco de dados
    $sql = "UPDATE equipes SET status_eq = 1;";

    // faz um conexão e executa o comando de ativar
    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/3'</script>";
}


// ------------------------------------------------- Criando a função que desativa todos os registros

public function desativar_registros ()
{

    // comando de exclusão do banco de dados
    $sql = "UPDATE equipes SET status_eq = 0;";

    // faz um conexão e executa o comando de desativar
    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/3'</script>";
}

// ------------------------------------------------- Criando a função para gerar csv de todos os dados

public function gerar_csv ()
{

    // Pasta onde os arquivos CSV serão salvos
$pasta_destino = 'frontend/public/csv/'; // Caminho relativo da pasta
$nome_arquivo = 'equipes.csv';

// Verifica se a pasta existe, se não, cria a pasta
if (!is_dir($pasta_destino)) {
    mkdir($pasta_destino, 0777, true); // Cria a pasta com permissões
}

// Caminho completo do arquivo
$caminho_arquivo = $pasta_destino . $nome_arquivo;
    
    // selecionando tudo da tabela referenciada
    $sql = "SELECT * FROM equipes";

    // faz um conexão e executa o comando de desativar
    $retorno = $this->conexao->executarQuery($sql);

    // cria uma array para os dados do csv
    $array_de_dados = array();

    // verifica se dentro da pesquisa ouve algum dado, se sim continua
    if ($retorno -> num_rows > 0) {

        // output data of each row
        while($row = $retorno->fetch_assoc()) {
            
        
        $array_de_dados[] = array(


            'id' => $row["id_eq"], 
            'Nome da Equipe' => $row["nome_eq"], 
            'Sala da equipe' => $row["sala_eq"],
            'ano' => $row["ano_eq"], 
            'tema' => $row["tema_eq"], 
            'status' => $row["status_eq"]

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
echo "<script>window.location.href='../tabelas/3'</script>";
}

// ------------------------------------------------- Criando a função que procura qual id esta disponivel para uso

public function id_correto()
{
        // criando o comando selecionar o maior id existente
        $sql = "SELECT MAX(id_eq) as maior_id FROM equipes";

        // executando a solicitação
        $retorno = $this->conexao->executarQuery($sql);
    
        $id_correto = $retorno + 1;

        return $id_correto;
}

}

// ------------------------------------------------ Criar na classe pois assim não é preciso criar em todas as scripts.

    $repositorioEquipes = new RepositorioEquipeMYSQL(); 

    // Fim do php
?>