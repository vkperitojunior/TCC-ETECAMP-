<?php
// Começo do php

// Incluindo link para conexão com banco de dados
include_once 'backend/conexao/script/conexao.php';
// Incluindo link para conexão com a classe usuários
// include_once __DIR__.'../classes/class_Noticias.php';
require_once 'backend/classes/class_Noticias.php';

// aqui criamos a interface com as funções Noticias dentro
interface IRepositorioNoticias {
    public function cadastrarNoticia($Noticia);
    public function alterarNoticia($Noticia);
    public function listarTodasNoticias();
    public function listarTodas_crud();
    public function listarTodasFiltro($ano);
    public function buscarNoticia($id_not);
    public function removerNoticias($id_not);
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
class RepositorioNoticiaMYSQL implements IRepositorioNoticias {

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

        // ------------------------------------------------- Criando a função de listar todos os Noticias

        public function listarTodasFiltro($ano){
            
        // criando o comando para buscar todos os Noticias
        $sql = "SELECT *
        FROM noticias
        WHERE YEAR(data_not) = '$ano'";
    
        // solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os Noticias
        $retorno = $this->conexao->executarQuery($sql);
    
        return $retorno;
        }


    public function gerar_xls()
{
// Inclua o arquivo da biblioteca SimpleXLSXGen
require_once 'extensions\simplexlsxgen\src\SimpleXLSXGen.php';

// Pasta onde os arquivos Excel serão salvos
$pasta_destino = 'frontend/public/xlsx/'; // Caminho relativo da pasta
$nome_arquivo = 'noticias.xlsx'; // Nome do arquivo Excel

// Verifica se a pasta existe, se não, cria a pasta
if (!is_dir($pasta_destino)) {
    mkdir($pasta_destino, 0777, true); // Cria a pasta com permissões
}

// Caminho completo do arquivo
$caminho_arquivo = $pasta_destino . $nome_arquivo;

// Selecionando tudo da tabela referenciada
$sql = "SELECT * FROM noticias";

// Faz a conexão e executa a query
$retorno = $this->conexao->executarQuery($sql);

// Cria um array para armazenar os dados do Excel
$dados = [];
$dados[] = ['Id', 'Título', 'Descrição', 'Data', 'Foto', 'Status']; // Cabeçalhos

// Verifica se a query retornou dados
if ($retorno->num_rows > 0) {
    // Adiciona os dados da tabela ao array
    while ($row = $retorno->fetch_assoc()) {
        $dados[] = [
            $row["id_not"],
            $row["titulo_not"],
            $row["descricao_not"],
            $row["data_not"],
            $row["foto_not"],
            $row["status_not"]
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
echo "<script>window.location.href='../tabelas/4'</script>";


}

    public function verificaFoto($foto)
    {
        $fotoRecebida = explode(".", $foto['name']); // receba a foto e separa pelo "."
        $tamanhoArquivo = 2097152; // Tamanho máximo permitido
        $pastaFotoDestino = "frontend/public/imagens/imagens_noticias/";
        if ($foto['error'] == 0){
            $extensao = $fotoRecebida['1'];
            if(in_array($extensao, array('jpg', 'jpeg', 'gif', 'png'))) {
                if ($foto['size'] > $tamanhoArquivo) {
                    $mensagem = "Arquivo Enviado é muito Grande";
                    $_SESSION['mensagem'] = $mensagem;
                } else {
                    $novoNome = md5(time()). "." . $extensao;
                    echo $_FILES['fotonot']['tmp_name'];
                    echo "<br>";
                    echo $foto['tmp_name'];
                    $enviou = move_uploaded_file($_FILES['fotonot']['tmp_name'], $pastaFotoDestino . $novoNome);
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
    $sql = "UPDATE noticias SET status_not = '$status' WHERE id_not = '$id'";

    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../../../tabelas/4'</script>";

}
    
// ---------------------------------------------- Criando a função de cadastro de Noticia
    public function cadastrarNoticia($Noticia)
    {

        // requisitando o id_not do Noticia
        $id_not = $Noticia->getId_not();
        // requisitando o Titulo do Noticia
        $titulo = $Noticia->getTitulo_not();
        // requisitando o descricao do Noticia
        $descricao = $Noticia->getDescricao_not();
        // requisitando a data_not do Noticia
        $data_not = $Noticia->getData_not();
        // requisitando a foto_not do Noticia
        $foto_not = $Noticia->getFoto_not();
        // requisitando a status_not do Noticia
        $status_not = $Noticia->getStatus_not();
                        // requisitando a status_pdfavaliativo do Arq_avaliativo
                        $id_ult_atz = $Noticia->getUlt_us_atz();

        // criando o comando de inserção de Noticia no banco de dados
        $sql = "INSERT INTO noticias (id_not,titulo_not,descricao_not,data_not,foto_not,status_not, ult_us_atz)
         VALUES ('$id_not','$titulo','$descricao','$data_not','$foto_not','$status_not','$id_ult_atz')";
        
        // solicitando a conexão com banco de dados e enviando o coamndo para inserir
        $this->conexao->executarQuery($sql);

        
        // voltando para a página de inicial
        echo "<script>window.location.href='../tabelas/4'</script>";

    }

// ------------------------------------------------- Criando a função de alterar Noticia

    public function alterarNoticia($Noticia)
    {
    
     // requisitando o id_not do Noticia
     $id_not = $Noticia->getId_not();
     // requisitando o Titulo do Noticia
     $Titulo = $Noticia->getTitulo_not();
     // requisitando o descricao do Noticia
     $descricao = $Noticia->getDescricao_not();
     // requisitando a data_not do Noticia
     $data_not = $Noticia->getData_not();
     // requisitando a foto_not do Noticia
     $foto_not = $Noticia->getFoto_not();
     // requisitando a status_not do Noticia
     $status_not = $Noticia->getStatus_not();
     // requisitando o status inicial do Noticia
     $status_not = 0;
                     // requisitando a status_pdfavaliativo do Arq_avaliativo
                     $id_ult_atz = $Noticia->getUlt_us_atz();
    
    //  criando o comando para alterar o Noticia
   $sql = "UPDATE noticias SET titulo_not = '$Titulo', descricao_not = '$descricao', data_not = '$data_not', foto_not = '$foto_not', status_not = '$status_not', ult_us_atz = '$id_ult_atz'  WHERE id_not = '$id_not'";

    // solicitando a conexão com banco de dados e enviando o coamndo para alterar o registro anterior
    $this->conexao->executarQuery($sql);

            // voltando para a página de inicial
            echo "<script>window.location.href='../tabelas/4'</script>";

    }

// ------------------------------------------------- Criando a função de listar todos os Noticias

    public function listarTodasNoticias()
    {
        
    // criando o comando para buscar todos os Noticias
    $sql = "SELECT * FROM noticias WHERE status_not = 1";

    // solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os Noticias
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;
    }


    // ------------------------------------------------- Criando a função de listar todos os Noticias

    public function listarTodas_crud()
    {
        
    // criando o comando para buscar todos os Noticias
    $sql = "SELECT * FROM noticias";

    // solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os Noticias
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;
    }


// ------------------------------------------------- Criando a função que busca as informações do Noticia para o restante do site

    public function buscarNoticia($id_not)
    {
                
    // criando o comando para buscar o Noticia especifico
    $sql = "SELECT * FROM noticias WHERE id_not = '$id_not' AND status_not = 1";

    // solicitando a conexão com banco de dados e enviando o comando para buscar um Noticia especifico
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;
    }

// ------------------------------------------------- Criando a função que busca o ultimo tema registrado

public function buscarUltimaNoticia()
{
            
// criando o comando para buscar o Tema especifico
$sql = "SELECT * FROM noticias WHERE status_not = '1' ORDER BY id_not DESC limit 1";

// solicitando a conexão com banco de dados e enviando o comando para buscar um Tema especifico
$retorno = $this->conexao->executarQuery($sql);

return $retorno;
}

// ------------------------------------------------- Criando a função que remove o Noticia se assim for solicitado

    public function removerNoticias($id_not)
    {

        // comando de exclusão do banco de dados
        $sql = "DELETE FROM noticias
        WHERE id_not = '$id_not'";

        // faz um conexão e executa o comando de remover
        $this->conexao->executarQuery($sql);

        // voltando para a página de inicial
        echo "<script>window.location.href='../../tabelas/4'</script>";
    }

// ------------------------------------------------- Criando a função que remove todos os arquivos

public function remover_todos()
{

    // comando de exclusão do banco de dados
    $sql = "DELETE FROM noticias";

    // faz um conexão e executa o comando de remover todos
    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/4'</script>";
}


// ------------------------------------------------- Criando a função que ativa todos os registros

public function ativar_registros()
{

    // comando de exclusão do banco de dados
    $sql = "UPDATE noticias SET status_not = 1;";

    // faz um conexão e executa o comando de ativar
    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/4'</script>";
}


// ------------------------------------------------- Criando a função que desativa todos os registros

public function desativar_registros ()
{

    // comando de exclusão do banco de dados
    $sql = "UPDATE noticias SET status_not = 0;";

    // faz um conexão e executa o comando de desativar
    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/4'</script>";
}

// ------------------------------------------------- Criando a função para gerar csv de todos os dados

public function gerar_csv ()
{

    // Pasta onde os arquivos CSV serão salvos
$pasta_destino = 'frontend/public/csv/'; // Caminho relativo da pasta
$nome_arquivo = 'noticias.csv';

// Verifica se a pasta existe, se não, cria a pasta
if (!is_dir($pasta_destino)) {
    mkdir($pasta_destino, 0777, true); // Cria a pasta com permissões
}

// Caminho completo do arquivo
$caminho_arquivo = $pasta_destino . $nome_arquivo;
    
    // selecionando tudo da tabela referenciada
    $sql = "SELECT * FROM noticias";

    // faz um conexão e executa o comando de desativar
    $retorno = $this->conexao->executarQuery($sql);

    // cria uma array para os dados do csv
    $array_de_dados = array();

    // verifica se dentro da pesquisa ouve algum dado, se sim continua
    if ($retorno -> num_rows > 0) {

        // output data of each row
        while($row = $retorno->fetch_assoc()) {
            
        
        $array_de_dados[] = array(


            'Id' => $row["id_not"], 
            'Titulo' => $row["titulo_not"], 
            'Descricao' => $row["descricao_not"],
            'Data' => $row["data_not"], 
            'Foto' => $row["foto_not"], 
            'Status' => $row["status_not"]

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
echo "<script>window.location.href='../tabelas/4'</script>";
}

// ------------------------------------------------- Criando a função que procura qual id esta disponivel para uso

public function id_correto()
{
        // criando o comando selecionar o maior id existente
        $sql = "SELECT MAX(id_not) as maior_id FROM noticias";

        // executando a solicitação
        $retorno = $this->conexao->executarQuery($sql);
    
        $id_correto = $retorno + 1;

        return $id_correto;
}

}
 
// ------------------------------------------------ Criar na classe pois assim não é preciso criar em todas as scripts.

    $repositorioNoticias = new RepositorioNoticiaMYSQL(); 

    // Fim do php
?>