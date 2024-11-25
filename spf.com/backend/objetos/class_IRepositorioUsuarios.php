<?php
// Começo do php

// Incluindo link para conexão com banco de dados
include_once 'backend/conexao/script/conexao.php';
// Incluindo link para conexão com a classe usuários
require_once 'backend/classes/class_Usuarios.php';




// aqui criamos a interface com as funções usuarios dentro
interface IRepositorioUsuarios {
    public function cadastrarUsuario($usuario);
    public function alterarUsuario($usuario);
    public function listarTodosUsuarios();
    public function listarTodos_crud();
    public function verificaemail_us($email_us);
    public function verificaLogin($email_us, $senha_us);
    public function buscarUsuario($id_us);
    public function buscarUsuariologin($id_us);
    public function removerUsuario($id_us);
    public function remover_todos();
    public function ativar_registros();
    public function desativar_registros();
    public function gerar_csv();
    public function id_correto();
    public function alteraStatus($id,$status);
    public function alteraTipo($id,$tipo);
    public function verificaFoto($foto);
    public function verifica_email($email_us);
    public function gerar_xls();
    public function alterarUsuariotoken($usuario);

}

// aqui implementamos a classe com suas funções em uma interface para poder trabalhar com elas
class RepositorioUsuarioMYSQL implements IRepositorioUsuarios {

// ------------------------------------------------- Criando conexão com banco de dados
private $conexao;

// constroi uma variavel de conexão
    public function __construct()
    {

        // pegando a senha do banco de dados e a transformando em variavel
        $senha='';

        // passa os parametros de conexão
        $this->conexao = new conexaoSQL("localhost","root","$senha","bd_spf");
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
$nome_arquivo = 'usuarios.xlsx';

// Verifica se a pasta existe, se não, cria a pasta
if (!is_dir($pasta_destino)) {
    mkdir($pasta_destino, 0777, true); // Cria a pasta com permissões
}

// Caminho completo do arquivo
$caminho_arquivo = $pasta_destino . $nome_arquivo;

// Selecionando tudo da tabela referenciada
$sql = "SELECT * FROM usuarios";

// Faz a conexão e executa a query
$retorno = $this->conexao->executarQuery($sql);

// Define um array para armazenar os dados da planilha
$dados = [];

// Define o cabeçalho da planilha
$dados[] = ['ID', 'Nome', 'Email', 'Senha', 'Foto', 'Função no Sistema', 'Função no Evento', 'Status'];

// Verifica se a query retornou dados
if ($retorno->num_rows > 0) {

    // Adiciona os dados de cada linha ao array
    while ($row = $retorno->fetch_assoc()) {
        $dados[] = [
            $row['id_us'], 
            $row['nome_us'], 
            $row['email_us'], 
            $row['senha_us'], 
            $row['foto_us'], 
            $row['funcao_us'], 
            $row['funcao_no_evento'], 
            $row['status_us']
        ];
    }
} else {
    echo "0 resultados nas tabelas";
}

// Gera o arquivo XLSX a partir dos dados
$xlsx = Shuchkin\SimpleXLSXGen::fromArray($dados);

// Salva o arquivo XLSX no caminho definido
$xlsx->saveAs($caminho_arquivo);

// Exibe uma mensagem de sucesso ou redireciona
echo "Arquivo Excel gerado com sucesso em: $caminho_arquivo";
echo "<script>window.location.href='../tabelas/11'</script>";

}

    public function verifica_email($email_us)
    {
        
    // criando o comando para buscar todos os usuarios
    $sql = "SELECT * FROM usuarios WHERE email_us = '$email_us'";

    // solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os usuarios
    $usuarios_encontrados = $this->conexao->executarQuery($sql);
    
    return $usuarios_encontrados;

    }

public function verificaFoto($foto)
    {
        $fotoRecebida = explode(".", $foto['name']); // receba a foto e separa pelo "."
        $tamanhoArquivo = 2097152; // Tamanho máximo permitido
        $pastaFotoDestino = "frontend/public/imagens/imagens_usuarios/";
        if ($foto['error'] == 0){
            $extensao = $fotoRecebida['1'];
            if(in_array($extensao, array('jpg', 'jpeg', 'gif', 'png'))) {
                if ($foto['size'] > $tamanhoArquivo) {
                    $mensagem = "Arquivo Enviado é muito Grande";
                    $_SESSION['mensagem'] = $mensagem;
                } else {
                    $novoNome = md5(time()). "." . $extensao;
                    echo $_FILES['fotous']['tmp_name'];
                    echo "<br>";
                    echo $foto['tmp_name'];
                    $enviou = move_uploaded_file($_FILES['fotous']['tmp_name'], $pastaFotoDestino . $novoNome);
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
    $sql = "UPDATE usuarios SET status_us = '$status' WHERE id_us = '$id'";

    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../../../tabelas/11'</script>";
}

// --------------------------------------------- Criando a função de mudar o tipo -> adm ou comum

public function alteraTipo($id,$tipo)
{
    $sql = "UPDATE usuarios SET funcao_us = '$tipo' WHERE id_us = '$id'";

    $this->conexao->executarQuery($sql);
    
    // voltando para a página de inicial
    echo "<script>window.location.href='../../tabelas/11'</script>";
}
    
// ---------------------------------------------- Criando a função de cadastro de usuario
    public function cadastrarUsuario($usuario)
    {

        // requisitando o id_us do usuario
        $id_us = $usuario->getid_us();
        // requisitando o nome do usuario
        $nome_us = $usuario->getNome_us();

        
        // requisitando o email do usuario
        $email_us = $usuario->getEmail_us();
        // // criptografando a email do usuario
        // $palavra1 = sha1("fisefjosiejf156465fefefFEFSEFSEF");
        // $palavra2 = md5("FUJIAHFEFHfuhiuh87898247UUHUI88");
        // $palavra3 = hash('sha256', 'DUHUIFHSUEF4474888DWDADsdadawdaw5498789');
        // $email_CRIP = $palavra1 . sha1($email_us) . $palavra2 . $palavra3;


        // requisitando a senha_us do usuario
        $senha_us = $usuario->getSenha_us();
        // criptografando a senha_us do usuario
        $palavra4 = sha1("faufh4648934234325425¨%&¨%*%$#%saehfiasehf");
        $palavra5 = md5("baid_usjaiwjdiajwdoiaj$#@W$@#$&*(dw");
        $palavra6 = hash('sha256', 'aw4daw4dwa4d89a4w894$#$#@(*');
        $senha_CRIP = $palavra4 . sha1($senha_us) . $palavra5 . $palavra6;


        // requisitando a foto do usuario
        $foto_us = $usuario->getFoto_us();
        // requisitando a funcao do usuario
        $funcao_us = $usuario->getFuncao_us();
        // requisitando a funcao do usuario dentro do evento
        $funcao_no_evento = $usuario->getFuncao_no_evento();
        // requisitando o status inicial do usuario
        $status_us = 0;

        // criando o comando de inserção de usuario no banco de dados
        $sql = "INSERT INTO usuarios (id_us,nome_us,email_us,senha_us,foto_us,funcao_us,funcao_no_evento,status_us)
         VALUES ('$id_us','$nome_us','$email_us','$senha_CRIP','$foto_us','$funcao_us','$funcao_no_evento','$status_us')";
        
        // solicitando a conexão com banco de dados e enviando o coamndo para inserir
        $this->conexao->executarQuery($sql);

                
        // voltando para a página de inicial
        echo "<script>window.location.href='../tabelas/11'</script>";

    }

// ------------------------------------------------- Criando a função de alterar usuario

    public function alterarUsuario($usuario)
    {
    
     // requisitando o id_us do usuario
     $id_us = $usuario->getid_us();
     // requisitando o nome do usuario
     $nome = $usuario->getNome_us();
     // requisitando o email_us do usuario
     $email_us = $usuario->getemail_us();
     // requisitando a senha_us do usuario
     $senha_us = $usuario->getSenha_us();
     
     
             // requisitando a senha_us do usuario
             $senha_us = $usuario->getSenha_us();
             // criptografando a senha_us do usuario
             $palavra4 = sha1("faufh4648934234325425¨%&¨%*%$#%saehfiasehf");
             $palavra5 = md5("baid_usjaiwjdiajwdoiaj$#@W$@#$&*(dw");
             $palavra6 = hash('sha256', 'aw4daw4dwa4d89a4w894$#$#@(*');
             $senha_CRIP = $palavra4 . sha1($senha_us) . $palavra5 . $palavra6;


     // requisitando a foto do usuario
     $foto = $usuario->getFoto_us();
     // requisitando a funcao do usuario
     $funcao = $usuario->getFuncao_us();
    // requisitando a funcao do usuario dentro do evento
    $funcao_no_evento = $usuario->getFuncao_no_evento();
     // requisitando o status inicial do usuario
     $status = 0;
    
    //  criando o comando para alterar o usuario
   $sql = "UPDATE usuarios  SET  nome_us = '$nome', email_us = '$email_us', senha_us = '$senha_CRIP', foto_us = '$foto', funcao_us = '$funcao', funcao_no_evento = '$funcao_no_evento', status_us = '$status' WHERE id_us = '$id_us'";

    // solicitando a conexão com banco de dados e enviando o coamndo para alterar o registro anterior
    $this->conexao->executarQuery($sql);

            // voltando para a página de inicial
            echo "<script>window.location.href='../tabelas/11'</script>";

    }


// ------------------------------------------------- Criando a função de alterar usuario

public function alterarUsuariotoken($usuario)
{

 // requisitando o id_us do usuario
 $id_us = $usuario->getid_us();
 // requisitando o nome do usuario
 $nome = $usuario->getNome_us();
 // requisitando o email_us do usuario
 $email_us = $usuario->getemail_us();
 // requisitando a senha_us do usuario
 $senha_us = $usuario->getSenha_us();
 
 
         // requisitando a senha_us do usuario
         $senha_us = $usuario->getSenha_us();
         // criptografando a senha_us do usuario
         $palavra4 = sha1("faufh4648934234325425¨%&¨%*%$#%saehfiasehf");
         $palavra5 = md5("baid_usjaiwjdiajwdoiaj$#@W$@#$&*(dw");
         $palavra6 = hash('sha256', 'aw4daw4dwa4d89a4w894$#$#@(*');
         $senha_CRIP = $palavra4 . sha1($senha_us) . $palavra5 . $palavra6;


 // requisitando a foto do usuario
 $foto = $usuario->getFoto_us();
 // requisitando a funcao do usuario
 $funcao = $usuario->getFuncao_us();
// requisitando a funcao do usuario dentro do evento
$funcao_no_evento = $usuario->getFuncao_no_evento();
 // requisitando o status inicial do usuario
 $status = 0;

//  criando o comando para alterar o usuario
$sql = "UPDATE usuarios  SET  nome_us = '$nome', email_us = '$email_us', senha_us = '$senha_CRIP', foto_us = '$foto', funcao_us = '$funcao', funcao_no_evento = '$funcao_no_evento', status_us = '$status' WHERE id_us = '$id_us'";

// solicitando a conexão com banco de dados e enviando o coamndo para alterar o registro anterior
$this->conexao->executarQuery($sql);

        // voltando para a página de inicial
        echo "<script>window.location.href='./tabelas/11'</script>";

}

// ------------------------------------------------- Criando a função de listar todos os usuarios

    public function listarTodosUsuarios()
    {
        
    // criando o comando para buscar todos os usuarios
    $sql = "SELECT * FROM usuarios WHERE LOWER(funcao_no_evento) NOT IN ('administrador', 'avaliador') AND status_us = '1'";

    // solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os usuarios
    $usuarios_encontrados = $this->conexao->executarQuery($sql);
    
    return $usuarios_encontrados;

    }

    // ------------------------------------------------- Criando a função de listar todos os usuarios

    public function listarTodos_crud()
    {
        
    // criando o comando para buscar todos os usuarios
    $sql = "SELECT * FROM usuarios ";

    // solicitando a conexão com banco de dados e enviando o coamndo para selecionar todos os usuarios
    $usuarios_encontrados = $this->conexao->executarQuery($sql);
    
    return $usuarios_encontrados;

    }

// --------------------------------------------------- Criando a função de verificar se o email_us ja existe no cadastro

    public function verificaemail_us($email_us){

        // printa o email_us na tela para analise do programador
        print_r('$email_us');

        // cria o comando de verificar se o email_us ja existe
        $sql = "SELECT * FROM usuarios WHERE email_us = '$email_us'" ;

        // cria uma variavel dizendo se encontrou o email_us
        $encontrou = $this->conexao->executarQuery($sql);

        // retorna o valor da variavel criada
        return $encontrou;

    }

// ------------------------------------------------- Criando a função de verificar itens para login

    public function verificaLogin($email_us, $senha_us){

        
        // printa o email_us e senha_us na tela para analise do programador
        print_r($email_us);
        print_r($senha_us);
        
             // criptografando a senha_us do usuario
             $palavra4 = sha1("faufh4648934234325425¨%&¨%*%$#%saehfiasehf");
             $palavra5 = md5("baid_usjaiwjdiajwdoiaj$#@W$@#$&*(dw");
             $palavra6 = hash('sha256', 'aw4daw4dwa4d89a4w894$#$#@(*');
             $senha_CRIP = $palavra4 . sha1($senha_us) . $palavra5 . $palavra6;

        // cria o código de verificacao de login 
        $sql = "SELECT * FROM usuarios WHERE email_us = '$email_us' AND senha_us = '$senha_CRIP'";

        // faz um conexão e executa o comando de verificar
        $encontrou = $this->conexao->executarQuery($sql);

        // retorna uma variavel 
        return $encontrou;

    }

// ------------------------------------------------- Criando a função que busca as informações do usuario para o restante do site

    public function buscarUsuario($id_us)
    {
                
    // criando o comando para buscar o usuario especifico
    $sql = "SELECT * FROM usuarios WHERE id_us = '$id_us'";

    // solicitando a conexão com banco de dados e enviando o comando para buscar um usuario especifico
    $dados_usuario = $this->conexao->executarQuery($sql);

    return $dados_usuario;

    }

    public function buscarUsuariologin($email_us)
    {
        
                
    // criando o comando para buscar o usuario especifico
    $sql = "SELECT * FROM usuarios WHERE email_us = '$email_us'";

    // solicitando a conexão com banco de dados e enviando o comando para buscar um usuario especifico
    $dados_usuario = $this->conexao->executarQuery($sql);

    return $dados_usuario;

    }

// ------------------------------------------------- Criando a função que remove o usuario se assim for solicitado

    public function removerUsuario($id_us)
    {

        // comando de exclusão do banco de dados
        $sql = "DELETE FROM usuarios 
        WHERE funcao_no_evento != 'Administrador'";

        // faz um conexão e executa o comando de remover
         $this->conexao->executarQuery($sql);
         
         echo "<script>window.location.href='../../tabelas/11'</script>";
    }

// ------------------------------------------------- Criando a função que remove todos os arquivos

public function remover_todos()
{

    // comando de exclusão do banco de dados
    $sql = "DELETE FROM usuarios";

    // faz um conexão e executa o comando de remover todos
    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/11'</script>";
}


// ------------------------------------------------- Criando a função que ativa todos os registros

public function ativar_registros()
{

    // comando de exclusão do banco de dados
    $sql = "UPDATE usuarios SET status_us = 1;";

    // faz um conexão e executa o comando de ativar
    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/11'</script>";
}


// ------------------------------------------------- Criando a função que desativa todos os registros

public function desativar_registros ()
{

    // comando de exclusão do banco de dados
    $sql = "UPDATE usuarios SET status_us = 0 ;";

    // faz um conexão e executa o comando de desativar
    $this->conexao->executarQuery($sql);

    // voltando para a página de inicial
    echo "<script>window.location.href='../tabelas/11'</script>";
}

// ------------------------------------------------- Criando a função para gerar csv de todos os dados

public function gerar_csv ()
{
// Pasta onde os arquivos CSV serão salvos
$pasta_destino = 'frontend/public/csv/'; // Caminho relativo da pasta
$nome_arquivo = 'usuarios.csv';

// Verifica se a pasta existe, se não, cria a pasta
if (!is_dir($pasta_destino)) {
    mkdir($pasta_destino, 0777, true); // Cria a pasta com permissões
}

// Caminho completo do arquivo
$caminho_arquivo = $pasta_destino . $nome_arquivo;

// Selecionando tudo da tabela referenciada
$sql = "SELECT * FROM usuarios";

// Faz a conexão e executa a query
$retorno = $this->conexao->executarQuery($sql);

// Cria um array para os dados do CSV
$array_de_dados = array();

// Verifica se a query retornou dados
if ($retorno->num_rows > 0) {

    // Output data de cada linha
    while($row = $retorno->fetch_assoc()) {
        
        $array_de_dados[] = array(
            'id' => $row["id_us"], 
            'Nome' => $row["nome_us"], 
            'Email' => $row["email_us"],
            'Senha' => $row["senha_us"], 
            'Foto' => $row["foto_us"], 
            'Funcao no sistema' => $row["funcao_us"],
            'Funcao no evento' => $row["funcao_no_evento"],
            'status' => $row["status_us"]
        );
    }
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
echo "<script>window.location.href='../tabelas/11'</script>";
}

// ------------------------------------------------- Criando a função que procura qual id esta disponivel para uso

public function id_correto()
{
        // criando o comando selecionar o maior id existente
        $sql = "SELECT MAX(id_us) as maior_id FROM usuarios";

        // executando a solicitação
        $retorno = $this->conexao->executarQuery($sql);
    
        $id_correto = $retorno + 1;

        return $id_correto;
}

}

// ------------------------------------------------ Criar na classe pois assim não é preciso criar em todas as scripts.

    $repositorioUsuarios = new RepositorioUsuarioMYSQL(); 

    // Fim do php
?>