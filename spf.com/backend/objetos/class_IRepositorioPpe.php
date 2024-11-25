<?php
// Começo do php

// Incluindo link para conexão com banco de dados
include_once 'backend/conexao/script/conexao.php';
// Incluindo link para conexão com a classe usuários
// include_once __DIR__.'../classes/class_ppe.php';
require_once 'backend/classes/class_ppe.php';

// aqui criamos a interface com as funções ppe dentro
interface IRepositorioppe {
    public function cadastrarppe($ppe);
    public function alterarppe($ppe);
    public function listarTodosppe();
    public function listarTodos_crud();
    public function buscarppe($id_pont);
    public function removerppe($id_pont);
    public function remover_todos();
    public function ativar_registros();
    public function desativar_registros();
    public function gerar_csv();
    public function id_correto();
    public function alteraStatus($id,$status);
    public function gerar_xls();
    public function atribuir_pontos($id_eq);
    public function atz_pontos($id_eq);
    public function pontuacaoEspecial();
}

// aqui implementamos a classe com suas funções em uma interface para poder trabalhar com elas
class RepositorioppeMYSQL implements IRepositorioppe {

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

// -------------------------------------------------- funcao de gerar excel

    
    public function gerar_xls()
{
// Inclua o arquivo da biblioteca SimpleXLSXGen
require_once 'extensions\simplexlsxgen\src\SimpleXLSXGen.php';

// Pasta onde os arquivos Excel serão salvos
$pasta_destino = 'frontend/public/xlsx/'; // Caminho relativo da pasta
$nome_arquivo = 'ppe.xlsx'; // Nome do arquivo Excel

// Verifica se a pasta existe, se não, cria a pasta
if (!is_dir($pasta_destino)) {
    mkdir($pasta_destino, 0777, true); // Cria a pasta com permissões
}

// Caminho completo do arquivo
$caminho_arquivo = $pasta_destino . $nome_arquivo;

// Selecionando tudo da tabela referenciada
$sql = "SELECT * FROM ppe";

// Faz a conexão e executa a query
$retorno = $this->conexao->executarQuery($sql);

// Cria uma array para armazenar os dados do Excel
$dados = [];
$dados[] = ['Id', 'Equipe', 'Pontuação', 'Ranking', 'Observação', 'Status']; // Cabeçalhos

// Verifica se a query retornou dados
if ($retorno->num_rows > 0) {
    // Adiciona os dados da tabela ao array
    while ($row = $retorno->fetch_assoc()) {
        $dados[] = [
            $row["id_pont"],
            $row["equipe_id"],
            $row["soma_pont"],
            $row["ranking"],
            $row["obs_pont"],
            $row["status_pontpe"]
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
echo "<script>window.location.href='../tabelas/1'</script>";

}
    
// ---------------------------------------------- Criando a função de cadastro de ppe
    public function cadastrarppe($ppe)
    {

        // requisitando o id_pont do ppe
        $id_pont = $ppe->getId_pont();
        // requisitando o equipe_id do ppe
        $equipe_id = $ppe->getEquipe_id();
        // requisitando a soma_pont do ppe
        $soma_pont = $ppe->getsoma_pont();
        // requisitando a ranking do ppe
        $ranking = $ppe->getRanking();
        // requisitando a obs_pont do ppe
        $obs_pont = $ppe->getObs_pont();
        // requisitando o status inicial do ppe
        $status_pontpe = $ppe->getStatus_pontpe();
                        // requisitando a status_pefavaliativo do Arq_avaliativo
                        $id_ult_atz = $ppe->getUlt_us_atz();

        // criando o comando de inserção de ppe no banco de dados
        $sql = "INSERT INTO ppe (id_pont,equipe_id,soma_pont,ranking,obs_pont,status_pontpe, ult_us_atz)
         VALUES ('$id_pont','$equipe_id','$soma_pont','$ranking','$obs_pont','$status_pontpe','$id_ult_atz')";
        
        // solicitando a conexão com banco de dados e enviando o coamndo para inserir
        $this->conexao->executarQuery($sql);

        
        // voltando para a página de inicial
        // echo "<script>window.location.href='../tabelas/1'</script>";

    }

        // --------------------------------------------- Criando a função de mudar o status

public function alteraStatus($id,$status)
{
    $sql = "UpeATE ppe SET status_pontpe = '$status' WHERE id_pont = '$id'";

    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../../../tabelas/1'</script>";

}

// ------------------------------------------------- Criando a função de alterar ppe

    public function alterarppe($ppe)
    {
    

    // requisitando o id_pont do ppe
    $id_pont = $ppe->getId_pont();
    // requisitando o equipe_id do ppe
    $equipe_id = $ppe->getEquipe_id();
    // requisitando a soma_pont do ppe
    $soma_pont = $ppe->getsoma_pont();
    // requisitando a ranking do ppe
    $ranking = $ppe->getRanking();
    // requisitando a obs_pont do ppe
    $obs_pont = $ppe->getObs_pont();
    // requisitando o status inicial do ppe
    $status_pontpe = $ppe->getStatus_pontpe();
                    // requisitando a status_pefavaliativo do Arq_avaliativo
                    $id_ult_atz = $ppe->getUlt_us_atz();
    
    //  criando o comando para alterar o ppe
   $sql = "Update ppe SET equipe_id = '$equipe_id',soma_pont = '$soma_pont',ranking = '$ranking',obs_pont = '$obs_pont',status_pontpe = '$status_pontpe', ult_us_atz = '$id_ult_atz'  WHERE id_pont = '$id_pont'";

    // solicitando a conexão com banco de dados e enviando o coamndo para alterar o registro anterior
    $this->conexao->executarQuery($sql);

            // voltando para a página de inicial
            // echo "<script>window.location.href='../tabelas/1'</script>";

    }

// ------------------------------------------------- Criando a função de listar todos os ppe

    public function listarTodosppe()
    {
        
    // criando o comando para buscar todos os ppe
    // $sql = "SELECT * FROM ppe WHERE status_pontpe = 1 ORDER BY dia_pont DESC AND soma_pont DESC";
    $sql = "SELECT * FROM ppe WHERE status_pontpe = 1 ORDER BY ranking DESC";

    // solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os ppe
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;
    }

    // ------------------------------------------------- Criando a função de listar todos os ppe

    public function listarTodos_crud()
    {
        
    // criando o comando para buscar todos os ppe
    // $sql = "SELECT * FROM ppe WHERE status_pontpe = 1 ORDER BY dia_pont DESC AND soma_pont DESC";
    $sql = "SELECT * FROM ppe ORDER BY ranking ASC";

    // solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os ppe
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;
    }

// ------------------------------------------------- Criando a função que busca as informações do ppe para o restante do site

    public function buscarppe($id_pont)
    {
                
    // criando o comando para buscar o ppe especifico
    $sql = "SELECT * FROM ppe WHERE id_pont = '$id_pont' AND status_pontpe = 1";

    // solicitando a conexão com banco de dados e enviando o comando para buscar um ppe especifico
     $retorno = $this->conexao->executarQuery($sql);

     return $retorno;
    }

// ------------------------------------------------- Criando a função que remove o ppe se assim for solicitado

    public function removerppe($id_pont)
    {

        // comando de exclusão do banco de dados
        $sql = "DELETE FROM ppe
        WHERE id_pont = '$id_pont'";

        // faz um conexão e executa o comando de remover
        $this->conexao->executarQuery($sql);

    }

// ------------------------------------------------- Criando a função que remove todos os arquivos

public function remover_todos()
{

    // comando de exclusão do banco de dados
    $sql = "DELETE FROM ppe";

    // faz um conexão e executa o comando de remover todos
    $this->conexao->executarQuery($sql);

}


// ------------------------------------------------- Criando a função que ativa todos os registros

public function ativar_registros()
{

    // comando de exclusão do banco de dados
    $sql = "UpeATE ppe SET status_pontpe = 1";

    // faz um conexão e executa o comando de ativar
    $this->conexao->executarQuery($sql);

}


// ------------------------------------------------- Criando a função que desativa todos os registros

public function desativar_registros ()
{

    // comando de exclusão do banco de dados
    $sql = "UpeATE ppe SET status_pontpe = 0";

    // faz um conexão e executa o comando de desativar
    $this->conexao->executarQuery($sql);

}

// ------------------------------------------------- Criando a função para gerar csv de todos os dados

public function gerar_csv ()
{

    // Pasta onde os arquivos CSV serão salvos
$pasta_destino = 'frontend/public/csv/'; // Caminho relativo da pasta
$nome_arquivo = 'ppe.csv';

// Verifica se a pasta existe, se não, cria a pasta
if (!is_dir($pasta_destino)) {
    mkdir($pasta_destino, 0777, true); // Cria a pasta com permissões
}

// Caminho completo do arquivo
$caminho_arquivo = $pasta_destino . $nome_arquivo;
    
    // selecionando tudo da tabela referenciada
    $sql = "SELECT * FROM ppe";

    // faz um conexão e executa o comando de desativar
    $retorno = $this->conexao->executarQuery($sql);

    // cria uma array para os dados do csv
    $array_de_dados = array();

    // verifica se dentro da pesquisa ouve algum dado, se sim continua
    if ($retorno -> num_rows > 0) {

        // output data of each row
        while($row = $retorno->fetch_assoc()) {
            
        
        $array_de_dados[] = array(


            'id' => $row["id_pont"], 
            'Equipe' => $row["equipe_id"], 
            'Pontuação' => $row["soma_pont"], 
            'Ranking' => $row["ranking"], 
            'Observacao' => $row["obs_pont"],
            'Status' => $row["status_pontpe"]

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
echo "<script>window.location.href='../tabelas/1'</script>";
}

// ------------------------------------------------- Criando a função que procura qual id esta disponivel para uso

public function id_correto()
{

    // Defina a consulta SQL
    $query = "SELECT COUNT(id_pont) AS total FROM ppe";

    // Executa a consulta SQL
    $result = $this->conexao->executarQuery($query);

    // Verifica se a consulta foi bem-sucedida
    if ($result) {
        // Obtém o número total de registros
        $row = $result->fetch_assoc();
        $count = isset($row['total']) ? (int)$row['total'] : 0;

        // Agora você pode realizar a operação aritmética
        $newCount = $count + 1;
        echo "Novo valor: " . $newCount;
        
        // Libere o resultado
        $result->free();
    } else {
        // Se a consulta falhar, exibe uma mensagem de erro
        echo "Erro na consulta: ";
}
}

// ------------------------------------------------- Criando a função que soma os pontos de todas as atividades e atribui a uma equipe

public function atribuir_pontos($id_eq)
{

    // Defina a consulta SQL
    $query =     "SELECT AVG(pont_da_gin) AS media_pontuacao
    FROM ppa
    WHERE equipe_id = '$id_eq' AND status_pontpa = 1 ";

    // Executa a consulta SQL
    $resultado = $this->conexao->executarQuery($query);

    // Verifica se há resultados
    if ($resultado->num_rows > 0) {
        while ($linha = $resultado->fetch_object()) {
            // Acessa os dados usando o alias
            return $linha->media_pontuacao;
        }
    }
        
    if($resultado->num_rows <= 0) {
        $retorno = 0;
            return $retorno;
    }


}


public function atz_pontos($id_eq) {

    // Consulta para calcular a média do campo 'pontuacao' da tabela 'x' onde 'id_eq' é o que foi definido
    $query = "SELECT AVG(pont_da_gin) AS media_pontuacao FROM ppa WHERE equipe_id = '$id_eq' AND status_pontpa = 1";
    
    // Executa a consulta SQL para calcular a média
    $resultado = $this->conexao->executarQuery($query);

    // Verifica se a consulta retornou algum valor
    if ($resultado && $row = $resultado->fetch_assoc()) {
        // Obtém o valor da média da pontuação
        $media_pontuacao = $row['media_pontuacao'];
        
        // Verifica se a média foi calculada corretamente
        if ($media_pontuacao !== null) {
            // Atualiza a tabela 'y' com a média calculada
            $sql = "UPDATE ppe SET soma_pont = '$media_pontuacao' WHERE equipe_id = '$id_eq'";
            
            // Executa o comando de atualização
            if ($this->conexao->executarQuery($sql)) {
                echo "Pontuação atualizada com sucesso para a equipe ID: $id_eq.";
            } else {
                echo "Erro ao atualizar a pontuação para a equipe ID: $id_eq.";
            }
        } else {
            echo "Não foi possível calcular a média de pontuação.";
        }
    } else {
        echo "Erro ao obter a média de pontuação.";
    }
}

public function pontuacaoEspecial()
{
 
    $sqllimpeza = "UPDATE ppe SET soma_pont = 0";
    $resultGincanas = $this->conexao->executarQuery($sqllimpeza);


    // Consulta para pegar todos os IDs de gincanas
    $sqlGincanas = "SELECT id_gin FROM gincanas";
    $resultGincanas = $this->conexao->executarQuery($sqlGincanas);

    // Loop por cada gincana
    while ($gincana = mysqli_fetch_assoc($resultGincanas)) {
        $idGincana = $gincana['id_gin'];

        // Array para armazenar as médias de pontuação de cada equipe na gincana atual
        $mediasPontuacao = [];
        $rankingEquipes = [];

        // Consulta para pegar todos os IDs de equipes
        $sqlEquipes = "SELECT id_eq FROM equipes";
        $resultEquipes = $this->conexao->executarQuery($sqlEquipes);

        while ($equipe = mysqli_fetch_assoc($resultEquipes)) {
            $idEquipe = $equipe['id_eq'];

            // Consulta para calcular a média das atividades da equipe na tabela ppa, filtrando pela gincana
            $sqlMediaPontuacao = "SELECT AVG(pont_da_gin) as media_pontuacao FROM ppa WHERE equipe_id = '$idEquipe' AND gincana_id = '$idGincana'";
            $resultMedia = $this->conexao->executarQuery($sqlMediaPontuacao);
            $media = mysqli_fetch_assoc($resultMedia)['media_pontuacao'];

            // Guardar a média de pontuação da equipe
            $mediasPontuacao[$idEquipe] = $media;
        }

        // Ordenar as equipes pelo ranking (média de pontuação) em ordem decrescente
        arsort($mediasPontuacao);

        // Definir a pontuação baseada no ranking
        $pontuacaoRanking = 12; // Começa com 12 pontos para o 1º lugar
        foreach ($mediasPontuacao as $idEquipe => $media) {
            $rankingEquipes[$idEquipe] = $pontuacaoRanking;
            $pontuacaoRanking = max(1, $pontuacaoRanking - 1); // Evita pontuação negativa
        }

        // Atualizar a tabela ppe com as novas pontuações para cada equipe da gincana
        foreach ($rankingEquipes as $idEquipe => $pontosGanhados) {
            // Buscar pontuação antiga da equipe
            $sqlPontuacaoAntiga = "SELECT soma_pont FROM ppe WHERE equipe_id = '$idEquipe'";
            $resultPontuacao = $this->conexao->executarQuery($sqlPontuacaoAntiga);
            $pontuacaoAntiga = mysqli_fetch_assoc($resultPontuacao)['soma_pont'];

            // Somar pontos ganhos com a pontuação antiga
            $novaPontuacao = $pontuacaoAntiga + $pontosGanhados;

            // Atualizar a nova pontuação no banco de dados
            $sqlAtualizarPontuacao = "UPDATE ppe SET soma_pont = '$novaPontuacao' WHERE equipe_id = '$idEquipe'";
            $this->conexao->executarQuery($sqlAtualizarPontuacao);
        }
    }
}

}

// ------------------------------------------------ Criar na classe pois assim não é preciso criar em todas as scripts.

    $repositorioPpe = new RepositorioppeMYSQL(); 

    // Fim do php
?>