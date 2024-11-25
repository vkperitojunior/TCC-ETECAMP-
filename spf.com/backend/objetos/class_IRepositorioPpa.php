<?php
// Começo do php

// Incluindo link para conexão com banco de dados
include_once 'backend/conexao/script/conexao.php';
// Incluindo link para conexão com a classe usuários
// include_once __DIR__.'../classes/class_ppa.php';
require_once 'backend/classes/class_ppa.php';

// aqui criamos a interface com as funções ppa dentro
interface IRepositorioppa {
    public function cadastrarppa($ppa);
    public function alterarppa($ppa);
    public function listarTodosppa();
    public function listarTodos_crud();
    public function buscarppa($id_pontpa);
    public function buscarppaeq($id_pontpa);
    public function removerppa($id_pontpa);
    public function remover_todos();
    public function ativar_registros();
    public function desativar_registros();
    public function gerar_csv();
    public function id_correto();
    public function alteraStatus($id,$status);
    public function gerar_xls();
    public function atribuir_pontos($id_eq);
}

// aqui implementamos a classe com suas funções em uma interface para poder trabalhar com elas
class RepositorioppaMYSQL implements IRepositorioppa {

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

// -------------------------------------------------------------- funcao de gerar excel

    public function gerar_xls()
{

// Inclua o arquivo da biblioteca SimpleXLSXGen
require_once 'extensions\simplexlsxgen\src\SimpleXLSXGen.php';

// Pasta onde os arquivos Excel serão salvos
$pasta_destino = 'frontend/public/xlsx/'; // Caminho relativo da pasta
$nome_arquivo = 'ppa.xlsx'; // Nome do arquivo Excel

// Verifica se a pasta existe, se não, cria a pasta
if (!is_dir($pasta_destino)) {
    mkdir($pasta_destino, 0777, true); // Cria a pasta com permissões
}

// Caminho completo do arquivo
$caminho_arquivo = $pasta_destino . $nome_arquivo;

// Selecionando tudo da tabela referenciada
$sql = "SELECT * FROM ppa";

// Faz a conexão e executa a query
$retorno = $this->conexao->executarQuery($sql);

// Cria uma array para armazenar os dados do Excel
$dados = [];
$dados[] = ['Id', 'Equipe', 'Gincana', 'Criterio 1','Criterio 2', 'Criterio 3','Dia', 'Pontuação', 'Observação', 'Status']; // Cabeçalhos

// Verifica se a query retornou dados
if ($retorno->num_rows > 0) {
    // Adiciona os dados da tabela ao array
    while ($row = $retorno->fetch_assoc()) {
        $dados[] = [
            $row["id_pontpa"],
            $row["equipe_pontpa"],
            $row["gincana_pontpa"],
            $row["crie_1"],
            $row["crie_2"],
            $row["crie_3"],
            $row["dia_pontpa"],
            $row["pont_da_gin"],
            $row["ranking_pa"],
            $row["obs_pontpa"],
            $row["status_pontpa"]
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
echo "<script>window.location.href='../tabelas/2'</script>";

}

        // --------------------------------------------- Criando a função de mudar o status

public function alteraStatus($id,$status)
{
    $sql = "UPDATE ppa SET status_pontpa = '$status' WHERE id_pontpa = '$id'";

    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../../../tabelas/2'</script>";

}
    
// ---------------------------------------------- Criando a função de cadastro de ppa
    public function cadastrarppa($ppa)
    {

        // requisitando o id_pontpa do ppa
        $id_pontpa = $ppa->getId_pontpa();
        // requisitando o equipe_id do ppa
        $equipe_id = $ppa->getEquipe_id();
        // requisitando o gincana_id do ppa
        $gincana_id = $ppa->getGincana_id();
        // requisitando o crie1 do ppa
        $crie1 = $ppa->getCrie_1();
        // requisitando o crie2 do ppa
        $crie2 = $ppa->getCrie_2();
        // requisitando o crie3 do ppa
        $crie3 = $ppa->getCrie_3();
        // requisitando a dia_pontpa do ppa
        $dia_pontpa = $ppa->getDia_pontpa();
        // requisitando a pont_da_gin do ppa
        $pont_da_gin = $ppa->getPont_da_gin();
        // requisitando a obersavção do ppa
        $obs_pontpa = $ppa->getObs_pontpa();
        // requisitando a status do ppa
        $status_pontpa = $ppa->getStatus_pontpa();;
                        // requisitando a status_pdfavaliativo do Arq_avaliativo
                        $id_ult_atz = $ppa->getUlt_us_atz();

        // criando o comando de inserção de ppa no banco de dados
        $sql = "INSERT INTO ppa (id_pontpa,equipe_id,gincana_id,crie_1, crie_2, crie_3,dia_pontpa,pont_da_gin,obs_pontpa,status_pontpa, ult_us_atz)
         VALUES ('$id_pontpa','$equipe_id','$gincana_id','$crie1','$crie2','$crie3','$dia_pontpa','$pont_da_gin','$obs_pontpa','$status_pontpa','$id_ult_atz')";
        
        // solicitando a conexão com banco de dados e enviando o coamndo para inserir
        $this->conexao->executarQuery($sql);


    }

// ------------------------------------------------- Criando a função de alterar ppa

    public function alterarppa($ppa)
    {
    

    // requisitando o id_pontpa do ppa
    $id_pontpa = $ppa->getId_pontpa();
    // requisitando o equipe_id do ppa
    $equipe_id = $ppa->getEquipe_id();
    // requisitando o gincana_id do ppa
    $gincana_id = $ppa->getGincana_id();
    // requisitando o crie1 do ppa
    $crie1 = $ppa->getCrie_1();
    // requisitando o crie2 do ppa
    $crie2 = $ppa->getCrie_2();
    // requisitando o crie3 do ppa
    $crie3 = $ppa->getCrie_3();
    // requisitando a dia_pontpa do ppa
    $dia_pontpa = $ppa->getDia_pontpa();
    // requisitando a pont_da_gin do ppa
    $pont_da_gin = $ppa->getPont_da_gin();
    // requisitando a obersavção do ppa
    $obs_pontpa = $ppa->getObs_pontpa();
    // requisitando a status do ppa
    $status_pontpa = 0;
                    // requisitando a status_pdfavaliativo do Arq_avaliativo
                    $id_ult_atz = $ppa->getUlt_us_atz();
    
    //  criando o comando para alterar o ppa
   $sql = "UPDATE ppa  SET  equipe_id = '$equipe_id', gincana_id = '$gincana_id',crie_1 = '$crie1', crie_2 = '$crie2', crie_3 = '$crie3', dia_pontpa = '$dia_pontpa', pont_da_gin = '$pont_da_gin', obs_pontpa = '$obs_pontpa', status_pontpa = '$status_pontpa', ult_us_atz = '$id_ult_atz'  WHERE id_pontpa = '$id_pontpa'";

    // solicitando a conexão com banco de dados e enviando o coamndo para alterar o registro anterior
    $this->conexao->executarQuery($sql);


    }

// ------------------------------------------------- Criando a função de listar todos os ppa

    public function listarTodosppa()
    {
        
    // criando o comando para buscar todos os ppa
    $sql = "SELECT * FROM ppa  WHERE status_pontpa = '1' ORDER BY gincana_id ";

    // solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os ppa
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;
    }

    // ------------------------------------------------- Criando a função de listar todos os ppa

    public function listarTodos_crud()
    {
        
    // criando o comando para buscar todos os ppa
    $sql = "SELECT * FROM ppa ORDER BY gincana_id ";

    // solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os ppa
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;
    }

// ------------------------------------------------- Criando a função que busca as informações do ppa para o restante do site

    public function buscarppa($id_pontpa)
    {
                
    // criando o comando para buscar o ppa especifico
    $sql = "SELECT * FROM ppa WHERE id_pontpa = '$id_pontpa'";

    // solicitando a conexão com banco de dados e enviando o comando para buscar um ppa especifico
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;
    }

    // ------------------------------------------------- Criando a função que busca as informações do ppa para o restante do site

    public function buscarppaeq($id_eq)
    {
                
    // criando o comando para buscar o ppa especifico
    $sql = "SELECT * FROM ppa WHERE equipe_id = '$id_eq'";

    // solicitando a conexão com banco de dados e enviando o comando para buscar um ppa especifico
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;
    }

// ------------------------------------------------- Criando a função que remove o ppa se assim for solicitado

    public function removerppa($id_pontpa)
    {

        // comando de exclusão do banco de dados
        $sql = "DELETE FROM ppa
        WHERE id_pontpa = '$id_pontpa'";

        // faz um conexão e executa o comando de remover
        $this->conexao->executarQuery($sql);

    }

// ------------------------------------------------- Criando a função que remove todos os arquivos

public function remover_todos()
{

    // comando de exclusão do banco de dados
    $sql = "DELETE FROM ppa";

    // faz um conexão e executa o comando de remover todos
    $this->conexao->executarQuery($sql);

}


// ------------------------------------------------- Criando a função que ativa todos os registros

public function ativar_registros()
{

    // comando de exclusão do banco de dados
    $sql = "UPDATE ppa SET status_pontpa = 1;";

    // faz um conexão e executa o comando de ativar
    $this->conexao->executarQuery($sql);

}


// ------------------------------------------------- Criando a função que desativa todos os registros

public function desativar_registros ()
{

    // comando de exclusão do banco de dados
    $sql = "UPDATE ppa SET status_pontpa = 0;";

    // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/2'</script>";

    // faz um conexão e executa o comando de desativar
    $this->conexao->executarQuery($sql);

}

// ------------------------------------------------- Criando a função para gerar csv de todos os dados

public function gerar_csv ()
{

    // Pasta onde os arquivos CSV serão salvos
$pasta_destino = 'frontend/public/csv/'; // Caminho relativo da pasta
$nome_arquivo = 'ppa.csv';

// Verifica se a pasta existe, se não, cria a pasta
if (!is_dir($pasta_destino)) {
    mkdir($pasta_destino, 0777, true); // Cria a pasta com permissões
}

// Caminho completo do arquivo
$caminho_arquivo = $pasta_destino . $nome_arquivo;
    
    // selecionando tudo da tabela referenciada
    $sql = "SELECT * FROM ppa";

    // faz um conexão e executa o comando de desativar
    $retorno = $this->conexao->executarQuery($sql);

    // cria uma array para os dados do csv
    $array_de_dados = array();

    // verifica se dentro da pesquisa ouve algum dado, se sim continua
    if ($retorno -> num_rows > 0) {

        // output data of each row
        while($row = $retorno->fetch_assoc()) {
            
        
        $array_de_dados[] = array(


            'id' => $row["id_pontpa"], 
            'Equipe' => $row["equipe_pontpa"], 
            'Gincana' => $row["gincana_pontpa"], 
            'Criterio1' => $row["crie_1"], 
            'Criterio2' => $row["crie_2"], 
            'Criterio3' => $row["crie_3"], 
            'Dia' => $row["dia_pontpa"],
            'Pontuação' => $row["pont_da_gin"], 
            'Observacao' => $row["obs_pontpa"],
            'Status' => $row["status_pontpa"]

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
echo "<script>window.location.href='../tabelas/2'</script>";
}

// ------------------------------------------------- Criando a função que procura qual id esta disponivel para uso

public function id_correto()
{
        // criando o comando selecionar o maior id existente
        $sql = "SELECT MAX(id_pontpa) as maior_id FROM ppa";

        // executando a solicitação
        $retorno = $this->conexao->executarQuery($sql);
    
        $id_correto = $retorno + 1;

        return $id_correto;
}

// ------------------------------------------------- Criando a função que soma os pontos de todas as atividades e atribui a uma equipe

public function atribuir_pontos($id_eq)
{

    // Defina a consulta SQL
    $query =     "SELECT AVG(pont_da_gin) AS media_pontuacao
    FROM ppa
    WHERE equipe_id = '$id_eq';";

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

}

// ------------------------------------------------ Criar na classe pois assim não é preciso criar em todas as scripts.

    $repositorioPpa = new RepositorioppaMYSQL(); 

    // Fim do php
?>