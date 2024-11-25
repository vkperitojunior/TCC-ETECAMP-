<?php
// Começo do php

// Incluindo link para conexão com banco de dados
include_once 'backend/conexao/script/conexao.php';
// Incluindo link para conexão com a classe usuários
// include_once __DIR__.'../classes/class_Gincanas.php';
require_once 'backend/classes/class_Gincanas.php';

// aqui criamos a interface com as funções Gincanas dentro
interface IRepositorioGincanas {
    public function cadastrarGincana($Gincana);
    public function alterarGincana($Gincana);
    public function listarTodasGincanas();
    public function listarTodas_crud();
    public function buscarGincana($id_gin);
    public function buscarHoraLocalGincana( );
    public function removerGincana($id_gin );
    public function remover_todos();
    public function ativar_registros();
    public function desativar_registros();
    public function gerar_csv();
    public function id_correto();
    public function alteraStatus($id,$status);
    public function verificaFoto($foto);
    public function gerar_xls();
    public function listarTodas_data($data);

}

// aqui implementamos a classe com suas funções em uma interface para poder trabalhar com elas
class RepositorioGincanaMYSQL implements IRepositorioGincanas {

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
$nome_arquivo = 'gincanas.xlsx'; // Nome do arquivo Excel

// Verifica se a pasta existe, se não, cria a pasta
if (!is_dir($pasta_destino)) {
    mkdir($pasta_destino, 0777, true); // Cria a pasta com permissões
}

// Caminho completo do arquivo
$caminho_arquivo = $pasta_destino . $nome_arquivo;

// Selecionando tudo da tabela referenciada
$sql = "SELECT * FROM gincanas";

// Faz a conexão e executa a query
$retorno = $this->conexao->executarQuery($sql);

// Cria um array para armazenar os dados do Excel
$dados = [];
$dados[] = ['Id', 'Nome', 'Regras', 'Exemplo', 'Foto', 'Horário', 'Local', 'Status']; // Cabeçalhos

// Verifica se a query retornou dados
if ($retorno->num_rows > 0) {
    // Adiciona os dados da tabela ao array
    while ($row = $retorno->fetch_assoc()) {
        $dados[] = [
            $row["id_gin"],
            $row["nome_gin"],
            $row["regras_gin"],
            $row["exemplo_gin"],
            $row["foto_gin"],
            $row["horario_gin"],
            $row["local_gin"],
            $row["status_gin"]
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
echo "<script>window.location.href='../tabelas/6'</script>";

}

    public function verificaFoto($foto)
    {
        $fotoRecebida = explode(".", $foto['name']); // receba a foto e separa pelo "."
        $tamanhoArquivo = 2097152; // Tamanho máximo permitido
        $pastaFotoDestino = "frontend/public/imagens/imagens_gincanas/";
        if ($foto['error'] == 0){
            $extensao = $fotoRecebida['1'];
            if(in_array($extensao, array('jpg', 'jpeg', 'gif', 'png'))) {
                if ($foto['size'] > $tamanhoArquivo) {
                    $mensagem = "Arquivo Enviado é muito Grande";
                    $_SESSION['mensagem'] = $mensagem;
                } else {
                    $novoNome = md5(time()). "." . $extensao;
                    echo $_FILES['fotogin']['tmp_name'];
                    echo "<br>";
                    echo $foto['tmp_name'];
                    $enviou = move_uploaded_file($_FILES['fotogin']['tmp_name'], $pastaFotoDestino . $novoNome);
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
    $sql = "UPDATE gincanas SET status_gin = '$status' WHERE id_gin = '$id'";

    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../../../tabelas/6'</script>";

}
    
// ---------------------------------------------- Criando a função de cadastro de Gincana
    public function cadastrarGincana($Gincana)
    {

        // requisitando o id_gin  do Gincana
        $id_gin  = $Gincana->getId_gin();
        // requisitando o nome_gin  do Gincana
        $nome_gin  = $Gincana->getNome_gin();
        // requisitando o regras_gin  do Gincana
        $regras_gin  = $Gincana->getRegras_gin();
                // requisitando o crie1 do ppa
                $crie1 = $Gincana->getCrie_1();
                // requisitando o crie2 do ppa
                $crie2 = $Gincana->getCrie_2();
                // requisitando o crie3 do ppa
                $crie3 = $Gincana->getCrie_3();
        // requisitando a exemplo_gin  do Gincana
        $exemplo_gin  = $Gincana->getExemplo_gin();
        // requisitando a foto_gin  do Gincana
        $foto_gin  = $Gincana->getFoto_gin();
        // requisitando a horario_gin  do Gincana
        $horario_gin  = $Gincana->getHorario_gin();
        // requisitando o local_gin  inicial do Gincana
        $local_gin  = $Gincana->getLocal_gin();
        // requisitando o status_gin  inicial do Gincana
        $status_gin  = $Gincana->getStatus_gin();
        // requisitando a status_pdfavaliativo do Arq_avaliativo
        $id_ult_atz = $Gincana->getUlt_us_atz();

        // criando o comando de inserção de Gincana no banco de dados
        $sql = "INSERT INTO gincanas (id_gin ,nome_gin ,regras_gin, crie_1, crie_2, crie_3,exemplo_gin ,foto_gin ,horario_gin ,local_gin, status_gin, ult_us_atz)
         VALUES ('$id_gin ','$nome_gin ','$regras_gin ','$crie1','$crie2','$crie3','$exemplo_gin','$foto_gin ','$horario_gin ','$local_gin ','$status_gin','$id_ult_atz')";
        
        // solicitando a conexão com banco de dados e enviando o coamndo para inserir
        $this->conexao->executarQuery($sql);

        
        // voltando para a página de inicial
        echo "<script>window.location.href='../tabelas/6'</script>";

    }

// ------------------------------------------------- Criando a função de alterar Gincana

    public function alterarGincana($Gincana)
    {
    
        // requisitando o id_gin  do Gincana
        $id_gin  = $Gincana->getId_gin();
        // requisitando o nome_gin  do Gincana
        $nome_gin  = $Gincana->getNome_gin();
        // requisitando o regras_gin  do Gincana
        $regras_gin  = $Gincana->getRegras_gin();
                        // requisitando o crie1 do ppa
                        $crie1 = $Gincana->getCrie_1();
                        // requisitando o crie2 do ppa
                        $crie2 = $Gincana->getCrie_2();
                        // requisitando o crie3 do ppa
                        $crie3 = $Gincana->getCrie_3();
        // requisitando a exemplo_gin  do Gincana
        $exemplo_gin  = $Gincana->getExemplo_gin();
        // requisitando a foto_gin  do Gincana
        $foto_gin  = $Gincana->getFoto_gin();
        // requisitando a horario_gin  do Gincana
        $horario_gin  = $Gincana->getHorario_gin();
        // requisitando o local_gin  inicial do Gincana
        $local_gin  = $Gincana->getLocal_gin();
        // requisitando o status_gin  inicial do Gincana
        $status_gin  = $Gincana->getStatus_gin();
                        // requisitando a status_pdfavaliativo do Arq_avaliativo
                        $id_ult_atz = $Gincana->getUlt_us_atz();
    
    //  criando o comando para alterar o Gincana
   $sql = "UPDATE gincanas SET nome_gin  = '$nome_gin ',regras_gin  = '$regras_gin ',crie_1 = '$crie1', crie_2 = '$crie2', crie_3 = '$crie3',exemplo_gin  = '$exemplo_gin',foto_gin  = '$foto_gin ',horario_gin  = '$horario_gin ',local_gin  = '$local_gin ',status_gin = '$status_gin', ult_us_atz = '$id_ult_atz'  WHERE id_gin  = '$id_gin '";

    // solicitando a conexão com banco de dados e enviando o coamndo para alterar o registro anterior
    $this->conexao->executarQuery($sql);

            // voltando para a página de inicial
            echo "<script>window.location.href='../tabelas/6'</script>";

    }

// ------------------------------------------------- Criando a função de listar todos os Gincanas

    public function listarTodasGincanas()
    {
        
    // criando o comando para buscar todos os Gincanas
    $sql = "SELECT * FROM gincanas WHERE status_gin = '1'";

    // solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os Gincanas
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;

    }

    // ------------------------------------------------- Criando a função de listar todos os Gincanas

    public function listarTodas_crud()
    {
        
    // criando o comando para buscar todos os Gincanas
    $sql = "SELECT * FROM gincanas";

    // solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os Gincanas
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;

    }

        // ------------------------------------------------- Criando a função de listar todos os Gincanas para avaliação de acordo com a data

        public function listarTodas_data($data)
        {
            
        // criando o comando para buscar todos os Gincanas
        $sql = "SELECT * FROM gincanas where DATE(horario_gin) = '$data'";
    
        // solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os Gincanas
        $retorno = $this->conexao->executarQuery($sql);
    
        return $retorno;
    
        }


// ------------------------------------------------- Criando a função que busca as informações do Gincana para o restante do site

    public function buscarGincana($id_gin)
    {
                
    // criando o comando para buscar o Gincana especifico
    $sql = "SELECT * FROM gincanas WHERE id_gin  = '$id_gin '";

    // solicitando a conexão com banco de dados e enviando o comando para buscar um Gincana especifico
    $retorno = $this->conexao->executarQuery($sql);
    
    return $retorno;
    }

// ------------------------------------------------- Criando a função que busca o local e horario de cada gincana

public function buscarHoraLocalGincana()
{
            
// criando o comando para buscar o Gincana especifico
$sql = "SELECT local_gin, horario_gin FROM gincanas WHERE status_gin = '1'";

// solicitando a conexão com banco de dados e enviando o comando para buscar um Gincana especifico
$retorno = $this->conexao->executarQuery($sql);

return $retorno;
}


// ------------------------------------------------- Criando a função que remove o Gincana se assim for solicitado

    public function removerGincana($id_gin )
    {

        // comando de exclusão do banco de dados
        $sql = "DELETE FROM gincanas
        WHERE id_gin  = '$id_gin '";

        // faz um conexão e executa o comando de remover
        $this->conexao->executarQuery($sql);

        // voltando para a página de inicial
        echo "<script>window.location.href='../../tabelas/6'</script>";
    }

// ------------------------------------------------- Criando a função que remove todos os arquivos

public function remover_todos()
{

    // comando de exclusão do banco de dados
    $sql = "DELETE FROM gincanas";

    // faz um conexão e executa o comando de remover todos
    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/6'</script>";

}


// ------------------------------------------------- Criando a função que ativa todos os registros

public function ativar_registros()
{

    // comando de exclusão do banco de dados
    $sql = "UPDATE gincanas SET status_gin = 1;";

    // faz um conexão e executa o comando de ativar
    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/6'</script>";
}


// ------------------------------------------------- Criando a função que desativa todos os registros

public function desativar_registros ()
{

    // comando de exclusão do banco de dados
    $sql = "UPDATE gincanas SET status_gin = 0;";

    // faz um conexão e executa o comando de desativar
    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/6'</script>";
}

// ------------------------------------------------- Criando a função para gerar csv de todos os dados

public function gerar_csv ()
{

    // Pasta onde os arquivos CSV serão salvos
$pasta_destino = 'frontend/public/csv/'; // Caminho relativo da pasta
$nome_arquivo = 'gincanas.csv';

// Verifica se a pasta existe, se não, cria a pasta
if (!is_dir($pasta_destino)) {
    mkdir($pasta_destino, 0777, true); // Cria a pasta com permissões
}

// Caminho completo do arquivo
$caminho_arquivo = $pasta_destino . $nome_arquivo;

    // selecionando tudo da tabela referenciada
    $sql = "SELECT * FROM gincanas";

    // faz um conexão e executa o comando de desativar
    $retorno = $this->conexao->executarQuery($sql);

    // cria uma array para os dados do csv
    $array_de_dados = array();

    // verifica se dentro da pesquisa ouve algum dado, se sim continua
    if ($retorno -> num_rows > 0) {

        // output data of each row
        while($row = $retorno->fetch_assoc()) {
            
        
        $array_de_dados[] = array(


            'id' => $row["id_gin"], 
            'Nome' => $row["nome_gin"], 
            'Regras' => $row["regras_gin"],
            'Exemplo' => $row["exemplo_gin"], 
            'Foto' => $row["foto_gin"], 
            'Horario' => $row["horario_gin"],
            'Local' => $row["local_gin"],
            'Status' => $row["status_gin"]

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
echo "<script>window.location.href='../tabelas/6'</script>";
}

// ------------------------------------------------- Criando a função que procura qual id esta disponivel para uso

public function id_correto()
{
        // criando o comando selecionar o maior id existente
        $sql = "SELECT MAX(id_gin) as maior_id FROM gincanas";

        // executando a solicitação
        $retorno = $this->conexao->executarQuery($sql);
    
        $id_correto = $retorno + 1;

        return $id_correto;
}

}

// ------------------------------------------------ Criar na classe pois assim não é preciso criar em todas as scripts.

    $repositorioGincanas = new RepositorioGincanaMYSQL(); 

    // Fim do php
?>