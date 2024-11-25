<?php
// Começo do php

// Incluindo link para conexão com banco de dados
include_once 'backend/conexao/script/conexao.php';
// Incluindo link para conexão com a classe usuários
// include_once __DIR__.'../classes/class_logo.php';
require_once 'backend/classes/class_Logo.php';

// aqui criamos a interface com as funções logo dentro
interface IRepositorioLogo {
    public function alterarLogo($logo);
    public function verificaFoto($foto);
    public function buscarLogo($id_lg);
}

// aqui implementamos a classe com suas funções em uma interface para poder trabalhar com elas
class RepositorioLogoMYSQL implements IRepositorioLogo {

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
    


// ------------------------------------------------- Criando a função de alterar logo

    public function alterarLogo($logo)
    {
    

    // requisitando o id_lg do logo
    $id_lg = $logo->getid_lg();
    // requisitando o titulo_lg do logo
    $titulo_lg = $logo->gettitulo_lg();
    // requisitando o ano_lg do logo
    $ano_lg = $logo->getano_lg();
    // requisitando a arquivo_lg do logo
    $arquivo_lg = $logo->getarquivo_lg();
    // requisitando a status_pdfavaliativo do Arq_avaliativo
    $id_ult_atz = $logo->getUlt_us_atz();
    
    //  criando o comando para alterar o logo
   $sql = "UPDATE logo SET titulo_lg = '$titulo_lg',ano_lg = '$ano_lg',arquivo_lg = '$arquivo_lg', ult_us_atz = '$id_ult_atz'  WHERE id_lg = '$id_lg'";

    // solicitando a conexão com banco de dados e enviando o coamndo para alterar o registro anterior
    $this->conexao->executarQuery($sql);

            // voltando para a página de inicial
            echo "<script>window.location.href='../tabelas/14'</script>";

    }

    
    public function verificaFoto($foto)
    {
        $fotoRecebida = explode(".", $foto['name']); // receba a foto e separa pelo "."
        $tamanhoArquivo = 2097152; // Tamanho máximo permitido
        $pastaFotoDestino = "frontend/public/imagens/logo/";
        if ($foto['error'] == 0){
            $extensao = $fotoRecebida['1'];
            if(in_array($extensao, array('jpg', 'jpeg', 'gif', 'png'))) {
                if ($foto['size'] > $tamanhoArquivo) {
                    $mensagem = "Arquivo Enviado é muito Grande";
                    $_SESSION['mensagem'] = $mensagem;
                } else {
                    $novoNome = md5(time()). "." . $extensao;
                    echo $_FILES['arquivo_lg']['tmp_name'];
                    echo "<br>";
                    echo $foto['tmp_name'];
                    $enviou = move_uploaded_file($_FILES['arquivo_lg']['tmp_name'], $pastaFotoDestino . $novoNome);
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


    public function buscarLogo($id_lg)
    {
                
    // criando o comando para buscar o Noticia especifico
    $sql = "SELECT * FROM logo WHERE id_lg = '$id_lg'";
    
    // solicitando a conexão com banco de dados e enviando o comando para buscar um Noticia especifico
    $retorno = $this->conexao->executarQuery($sql);
    
    return $retorno;
    }

}



// ------------------------------------------------ Criar na classe pois assim não é preciso criar em todas as scripts.

    $repositorioLogo = new RepositorioLogoMYSQL(); 

    // Fim do php
    ?>