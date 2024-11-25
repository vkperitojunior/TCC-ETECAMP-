<?php
// Começo do php

// Incluindo link para conexão com banco de dados
include_once 'backend/conexao/script/conexao.php';
// Incluindo link para conexão com a classe usuários
require_once 'backend/classes/class_Fotos.php';

// aqui criamos a interface com as funções Fotos dentro
interface IRepositorioFotos {
    public function cadastrarFoto($Foto);
    public function alterarFoto($Foto);
    public function listarTodasFotos();
    public function listarTodasAno($ano);
    public function listarTodas_crud();
    public function buscarFoto($id_foto);
    public function removerFoto($id_foto);
    public function remover_todos();
    public function ativar_registros();
    public function desativar_registros();
    public function gerar_csv();
    public function id_correto();
    public function alteraStatus($id,$status);
    public function verificaFoto2($foto);
    public function verificaFoto($foto);
    public function gerar_xls();
}

// aqui implementamos a classe com suas funções em uma interface para poder trabalhar com elas
class RepositorioFotoMYSQL implements IRepositorioFotos {

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
$nome_arquivo = 'fotos.xlsx'; // Nome do arquivo Excel

// Verifica se a pasta existe, se não, cria a pasta
if (!is_dir($pasta_destino)) {
    mkdir($pasta_destino, 0777, true); // Cria a pasta com permissões
}

// Caminho completo do arquivo
$caminho_arquivo = $pasta_destino . $nome_arquivo;

// Selecionando tudo da tabela referenciada
$sql = "SELECT * FROM fotos";

// Faz a conexão e executa a query
$retorno = $this->conexao->executarQuery($sql);

// Cria um array para armazenar os dados do Excel
$dados = [];
$dados[] = ['Id', 'Título', 'Descrição', 'Ano', 'Arquivo', 'Status']; // Cabeçalhos

// Verifica se a query retornou dados
if ($retorno->num_rows > 0) {
    // Adiciona os dados da tabela ao array
    while ($row = $retorno->fetch_assoc()) {
        $dados[] = [
            $row["id_foto"],
            $row["titulo_foto"],
            $row["descricao_foto"],
            $row["ano_foto"],
            $row["arquivo_foto"],
            $row["status_foto"]
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
echo "<script>window.location.href='../tabelas/5'</script>";
        
        }

        public function verificaFoto($foto)
        {
            $fotoRecebida = explode(".", $foto['name']); // receba a foto e separa pelo "."
            $tamanhoArquivo = 2097152; // Tamanho máximo permitido
            $pastaFotoDestino = "frontend/public/imagens/imagens_fotos/";
            if ($foto['error'] == 0){
                $extensao = $fotoRecebida['1'];
                if(in_array($extensao, array('jpg', 'jpeg', 'gif', 'png'))) {
                    if ($foto['size'] > $tamanhoArquivo) {
                        $mensagem = "Arquivo Enviado é muito Grande";
                        $_SESSION['mensagem'] = $mensagem;
                    } else {
                        $novoNome = md5(time()). "." . $extensao;
                        echo $_FILES['arquivofoto']['tmp_name'];
                        echo "<br>";
                        echo $foto['tmp_name'];
                        $enviou = move_uploaded_file($_FILES['arquivofoto']['tmp_name'], $pastaFotoDestino . $novoNome);
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

        public function verificaFoto2($foto)
        {
            $fotoRecebida = explode(".", $foto['name']); // separa pelo "."
            $tamanhoArquivo = 2097152; // Tamanho máximo permitido (2MB)
            $pastaFotoDestino = "frontend/public/imagens/imagens_fotos/";
        
            if ($foto['error'] == 0) {
                $extensao = strtolower(end($fotoRecebida));
                if (in_array($extensao, ['jpg', 'jpeg', 'gif', 'png'])) {
                    if ($foto['size'] > $tamanhoArquivo) {
                        echo "Arquivo {$foto['name']} é muito grande!<br>";
                    } else {
                        $novoNome = md5(time() . rand()) . "." . $extensao;
                        $caminhoCompleto = $pastaFotoDestino . $novoNome;
        
                        // Move a imagem para a pasta de destino
                        if (move_uploaded_file($foto['tmp_name'], $caminhoCompleto)) {
                            return $novoNome;
                        } else {
                            return false;
                        }
                    }
                } else {
                    echo "Somente arquivos do tipo 'jpg', 'jpeg', 'gif', 'png' são permitidos!<br>";
                }
            } else {
                echo "Erro ao enviar o arquivo {$foto['name']}!<br>";
            }
        
            return false;
        }


            // --------------------------------------------- Criando a função de mudar o status

public function alteraStatus($id,$status)
{
    $sql = "UPDATE fotos SET status_foto = '$status' WHERE id_foto = '$id'";

    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../../../tabelas/5'</script>";

}
    
// ---------------------------------------------- Criando a função de cadastro de Foto
    public function cadastrarFoto($Foto)
    {

    // requisitando o id_foto do Foto
    $id_foto = $Foto->getId_foto();
    // requisitando o titulo_foto do Foto
    $titulo_foto = $Foto->getTitulo_foto();
    // requisitando o descricao_foto do Foto
    $descricao_foto = $Foto->getDescricao_foto();
    // requisitando a ano_foto do Foto
    $ano_foto = $Foto->getAno_foto();
    // requisitando a foto do Foto
    $arquivo_foto = $Foto->getArquivo_foto();
    // requisitando a status_foto do Foto
    $status_foto = $Foto->getStatus_foto();
                    // requisitando a status_pdfavaliativo do Arq_avaliativo
                    $id_ult_atz = $Foto->getUlt_us_atz();

    // criando o comando de inserção de Foto no banco de dados
    $sql = "INSERT INTO fotos (id_foto,titulo_foto,descricao_foto,ano_foto,arquivo_foto,status_foto, ult_us_atz)
        VALUES ('$id_foto','$titulo_foto','$descricao_foto','$ano_foto','$arquivo_foto','$status_foto','$id_ult_atz')";
    
    // solicitando a conexão com banco de dados e enviando o coamndo para inserir
    $this->conexao->executarQuery($sql);
    
    // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/5'</script>";
    }

    // ------------------------------------------------- Criando a função de alterar Foto

    public function alterarFoto($Foto)
    {
    
    // requisitando o id_foto do Foto
    $id_foto = $Foto->getId_foto();
    // requisitando o titulo_foto do Foto
    $titulo_foto = $Foto->getTitulo_foto();
    // requisitando o descricao_foto do Foto
    $descricao_foto = $Foto->getDescricao_foto();
    // requisitando a ano_foto do Foto
    $ano_foto = $Foto->getAno_foto();
    // requisitando a foto do Foto
    $arquivo_foto = $Foto->getArquivo_foto();
    // requisitando a status_foto do Foto
    $status_foto = $Foto->getStatus_foto();
                    // requisitando a status_pdfavaliativo do Arq_avaliativo
                    $id_ult_atz = $Foto->getUlt_us_atz();
    
    //  criando o comando para alterar o Foto
   $sql = "UPDATE Fotos SET id_foto = '$id_foto',titulo_foto  = '$titulo_foto ',descricao_foto  = '$descricao_foto',ano_foto  = '$ano_foto ',arquivo_foto  = '$arquivo_foto ',status_foto  = '$status_foto', ult_us_atz = '$id_ult_atz'  WHERE id_foto = '$id_foto'";

    // solicitando a conexão com banco de dados e enviando o coamndo para alterar o registro anterior
    $this->conexao->executarQuery($sql);

            // voltando para a página de inicial
            echo "<script>window.location.href='../tabelas/5'</script>";

    }

// ------------------------------------------------- Criando a função de listar todos os Fotos

    public function listarTodasFotos()
    {
        
    // criando o comando para buscar todos os Fotos
    $sql = "SELECT * FROM fotos WHERE status_foto = '1'";

    // solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os Fotos
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;
    }

    // ------------------------------------------------- Criando a função de listar todos os Fotos por ano

    public function listarTodasAno($ano)
    {
        
    // criando o comando para buscar todos os Fotos
    $sql = "SELECT * FROM fotos WHERE ano_foto = '$ano'";

    // solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os Fotos
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;
    }

    // ------------------------------------------------- Criando a função de listar todos os Fotos

    public function listarTodas_crud()
    {
        
    // criando o comando para buscar todos os Fotos
    $sql = "SELECT * FROM fotos";

    // solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os Fotos
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;
    }

// ------------------------------------------------- Criando a função que busca as informações do Foto para o restante do site

    public function buscarFoto($id_foto)
    {
                
    // criando o comando para buscar o Foto especifico
    $sql = "SELECT * FROM fotos WHERE id_foto = '$id_foto' AND status_foto = '1'";

    // solicitando a conexão com banco de dados e enviando o comando para buscar um Foto especifico
    $retorno = $this->conexao->executarQuery($sql);

    return $retorno;
    }

// ------------------------------------------------- Criando a função que remove o Foto se assim for solicitado

    public function removerFoto($id_foto)
    {

        // comando de exclusão do banco de dados
        $sql = "DELETE FROM fotos
        WHERE id_foto = '$id_foto'";

        // faz um conexão e executa o comando de remover
        $this->conexao->executarQuery($sql);

        // voltando para a página de inicial
        echo "<script>window.location.href='../../tabelas/5'</script>";
    }

// ------------------------------------------------- Criando a função que remove todos os arquivos

public function remover_todos()
{

    // comando de exclusão do banco de dados
    $sql = "DELETE FROM fotos";

    // faz um conexão e executa o comando de remover todos
    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/5'</script>";
}


// ------------------------------------------------- Criando a função que ativa todos os registros

public function ativar_registros()
{

    // comando de exclusão do banco de dados
    $sql = "UPDATE fotos SET status_foto = 1;";

    // faz um conexão e executa o comando de ativar
    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/5'</script>";
}


// ------------------------------------------------- Criando a função que desativa todos os registros

public function desativar_registros ()
{

    // comando de exclusão do banco de dados
    $sql = "UPDATE fotos SET status_foto = 0;";

    // faz um conexão e executa o comando de desativar
    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/5'</script>";
}

// ------------------------------------------------- Criando a função para gerar csv de todos os dados

public function gerar_csv ()
{

    // Pasta onde os arquivos CSV serão salvos
$pasta_destino = 'frontend/public/csv/'; // Caminho relativo da pasta
$nome_arquivo = 'fotos.csv';

// Verifica se a pasta existe, se não, cria a pasta
if (!is_dir($pasta_destino)) {
    mkdir($pasta_destino, 0777, true); // Cria a pasta com permissões
}

// Caminho completo do arquivo
$caminho_arquivo = $pasta_destino . $nome_arquivo;
    
    // selecionando tudo da tabela referenciada
    $sql = "SELECT * FROM fotos";

    // faz um conexão e executa o comando de desativar
    $retorno = $this->conexao->executarQuery($sql);

    // cria uma array para os dados do csv
    $array_de_dados = array();

    // verifica se dentro da pesquisa ouve algum dado, se sim continua
    if ($retorno -> num_rows > 0) {

        // output data of each row
        while($row = $retorno->fetch_assoc()) {
            
        
        $array_de_dados[] = array(


            'Id' => $row["id_foto"], 
            'Titulo' => $row["titulo_foto"], 
            'Descricao' => $row["descricao_foto"],
            'Ano' => $row["ano_foto"], 
            'Arquivo' => $row["arquivo_foto"], 
            'Status' => $row["status_foto"]

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
echo "<script>window.location.href='../tabelas/5'</script>";
}

// ------------------------------------------------- Criando a função que procura qual id esta disponivel para uso

public function id_correto()
{
        // criando o comando selecionar o maior id existente
        $sql = "SELECT MAX(id_foto) as maior_id FROM fotos";

        // executando a solicitação
        $retorno = $this->conexao->executarQuery($sql);
    
        $id_correto = $retorno + 1;

        return $id_correto;
}

}

// ------------------------------------------------ Criar na classe pois assim não é preciso criar em todas as scripts.

    $repositorioFotos = new RepositorioFotoMYSQL(); 

    // Fim do php
?>