<?php
// Começo do php

// Incluindo link para conexão com banco de dados
include_once 'backend/conexao/script/conexao.php';
// Incluindo link para conexão com a classe usuários
// include_once __DIR__.'../classes/class_Img_graf.php';
require_once 'backend/classes/class_Img_graf.php';


// aqui criamos a interface com as funções Img_graf dentro
interface IRepositorioImg_graf {
    public function cadastrarimg_graf($img_graf);
    public function id_correto();
    public function verificaFoto($foto);
    public function gráfico_de_linhas();
    public function gráfico_de_barras();
    public function roundValues($value);
    public function alterarImg_graf($img_graf);

}

// aqui implementamos a classe com suas funções em uma interface para poder trabalhar com elas
class Repositorioimg_grafMYSQL implements IRepositorioImg_graf {

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

    
// ----------------------------------------------------------- funcao de gerar grafico
public function roundValues($value) {
    return round($value); // Arredonda para o número inteiro mais próximo
}

public function gráfico_de_linhas() {
    // IMPORTANTE - Vá no php.ini e faça a linha "extension=gd" ser descomentada, se não a extensão nativa gd não ira funcionar

    function roundValues($value) {
        return round($value); // Arredonda para o número inteiro mais próximo
    }

    function gerarCorAleatoria() {
        $r = rand(0, 255);
        $g = rand(0, 255);
        $b = rand(0, 255);
        return [$r, $g, $b];
    }

    function gerarCoresParaEquipes($numeroEquipes) {
        $cores = [];
        for ($i = 0; $i < $numeroEquipes; $i++) {
            $cores[] = gerarCorAleatoria();
        }
        return $cores;
    }

    require_once 'extensions/phplot/phplot.php';

    $sql = "SELECT e.nome_eq, p.pont_da_gin, p.dia_pontpa FROM equipes e INNER JOIN ppa p ON e.id_eq = p.equipe_id ORDER BY p.dia_pontpa";
    $result = $this->conexao->executarQuery($sql);

    if ($result->num_rows > 0) {
        $dados_equipes = [];
        $datas = [];

        while ($row = $result->fetch_assoc()) {
            $nome_eq = $row['nome_eq'];
            $data = $row['dia_pontpa'];
            $pontuacao = roundValues($row['pont_da_gin']); // Arredondando a pontuação

            $dados_equipes[$nome_eq][] = $pontuacao;
            if (!in_array($data, $datas)) {
                $datas[] = $data;
            }
        }

        // Formatação dos dados para o PHPlot
        $data_plot = [];
        foreach ($datas as $i => $data) {
            $linha = [$data]; // Começa com a data
            foreach ($dados_equipes as $nome_eq => $pontuacoes) {
                $linha[] = isset($pontuacoes[$i]) ? $pontuacoes[$i] : 0; // Insere a pontuação da equipe para a data correspondente
            }
            $data_plot[] = $linha;
        }

        // Criação do gráfico
        $plot = new PHPlot(1000, 600);
        $plot->SetDataValues($data_plot);

        // Configuração do gráfico
        $plot->SetPlotType('lines');
        $plot->SetTitle('Grafico de eficiencia das equipes');
        $plot->SetXTitle('Data');
        $plot->SetYTitle('Pontos por gincana');

        // Definindo as cores para cada equipe
        $cores = gerarCoresParaEquipes(count($dados_equipes));
        $plot->SetDataColors($cores);

        // Definir rótulos para o eixo X e nomes das equipes
        $plot->SetLegend(array_keys($dados_equipes));

        // Gera e salva o gráfico
        $plot->SetIsInline(true);
        $caminho = 'frontend/public/imagens/graficos_nativos/grafico_eficiencia.png';
        $plot->SetOutputFile($caminho);
        $plot->DrawGraph();

        echo "Gráfico de linhas gerado com sucesso! Salvado em: $caminho";
    } else {
        echo "Nenhum dado encontrado!";
    }
}

public function gráfico_de_barras() {

    function roundValues2($value) {
        return round($value); // Arredonda para o número inteiro mais próximo
    }

    function gerarCorAleatoria2() {
        $r = rand(0, 255);
        $g = rand(0, 255);
        $b = rand(0, 255);
        return [$r, $g, $b];
    }

    function gerarCoresParaEquipes2($numeroEquipes) {
        $cores = [];
        for ($i = 0; $i < $numeroEquipes; $i++) {
            $cores[] = gerarCorAleatoria2();
        }
        return $cores;
    }

    require_once 'extensions/phplot/phplot.php';

    $sql = "SELECT e.nome_eq, p.soma_pont FROM equipes e INNER JOIN ppe p ON e.id_eq = p.equipe_id";
    $result = $this->conexao->executarQuery($sql);

    if ($result->num_rows > 0) {
        $equipes = [];
        $pontuacoes = [];
        $data_plot = [];

        while ($row = $result->fetch_assoc()) {
            $equipes[] = $row['nome_eq'];
            $pontuacoes[] = roundValues2($row['soma_pont']); // Arredondando a pontuação
        }

        // Preparando os dados para o PHPlot
        foreach ($equipes as $i => $equipe) {
            $data_plot[] = [$equipe, $pontuacoes[$i]];
        }

        // Criação do gráfico
        $plot = new PHPlot(800, 600);
        $plot->SetDataValues($data_plot);

        // Configuração do gráfico
        $plot->SetPlotType('bars');
        $plot->SetTitle('Pontos por Equipes');
        $plot->SetXTitle('Equipes');
        $plot->SetYTitle('Pontos');

        // Definindo as cores
        $cores = gerarCoresParaEquipes2(count($equipes));
        $plot->SetDataColors($cores);

        // Gera e salva o gráfico
        $plot->SetIsInline(true);
        $caminho = 'frontend/public/imagens/graficos_nativos/grafico_pontuacao.png';
        $plot->SetOutputFile($caminho);
        $plot->DrawGraph();

        echo "Gráfico de barras gerado com sucesso! Salvado em: $caminho";
    } else {
        echo "Nenhum dado encontrado!";
    }
}

    public function verificaFoto($foto)
    {
        $fotoRecebida = explode(".", $foto['name']); // receba a foto e separa pelo "."
        $tamanhoArquivo = 2097152; // Tamanho máximo permitido
        $pastaFotoDestino = "frontend/public/imagens/imagens_img_graf/";
        if ($foto['error'] == 0){
            $extensao = $fotoRecebida['1'];
            if(in_array($extensao, array('jpg', 'jpeg', 'gif', 'png'))) {
                if ($foto['size'] > $tamanhoArquivo) {
                    $mensagem = "Arquivo Enviado é muito Grande";
                    $_SESSION['mensagem'] = $mensagem;
                } else {
                    $novoNome = md5(time()). "." . $extensao;
                    echo $_FILES['arq_graf']['tmp_name'];
                    echo "<br>";
                    echo $foto['tmp_name'];
                    $enviou = move_uploaded_file($_FILES['arq_graf']['tmp_name'], $pastaFotoDestino . $novoNome);
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
    
// ---------------------------------------------- Criando a função de cadastro de img_graf
    public function cadastrarimg_graf($img_graf)
    {

        // requisitando o id_graf do img_graf
        $id_graf = $img_graf->getid_graf();
        // requisitando o nome_graf do img_graf
        $nome_graf = $img_graf->getnome_graf();
        // requisitando o arq_graf do img_graf
        $arq_graf = $img_graf->getarq_graf();
        // requisitando a data_graf do img_graf
        $data_graf = $img_graf->getdata_graf();
        // requisitando a status_pdfavaliativo do Arq_avaliativo
        $id_ult_atz = $img_graf->getUlt_us_atz();

        // criando o comando de inserção de img_graf no banco de dados
        $sql = "INSERT INTO img_graf (id_graf,nome_graf,arq_graf,data_graf, ult_us_atz)
         VALUES ('$id_graf','$nome_graf','$arq_graf','$data_graf','$id_ult_atz')";
        
        // solicitando a conexão com banco de dados e enviando o coamndo para inserir
        $this->conexao->executarQuery($sql);
        
        // voltando para a página de inicial
        echo "<script>window.location.href='../tabelas/9'</script>";

    }

        public function alterarImg_graf($img_graf)
        {
        
        // requisitando o id_graf do img_graf
        $id_graf = $img_graf->getid_graf();
        // requisitando o nome_graf do img_graf
        $nome_graf = $img_graf->getnome_graf();
        // requisitando o arq_graf do img_graf
        $arq_graf = $img_graf->getarq_graf();
        // requisitando a data_graf do img_graf
        $data_graf = $img_graf->getdata_graf();
        // requisitando a status_pdfavaliativo do Arq_avaliativo
        $id_ult_atz = $img_graf->getUlt_us_atz();
        
        //  criando o comando para alterar o Historico
       $sql = "UPDATE img_graf  SET  nome_graf= '$nome_graf' ,arq_graf= '$arq_graf' ,data_graf= '$data_graf' , ult_us_atz = '$id_ult_atz'  WHERE id_graf = '$id_graf'";
    
        // solicitando a conexão com banco de dados e enviando o coamndo para alterar o registro anterior
        $this->conexao->executarQuery($sql);

    
        }
    

// ------------------------------------------------- Criando a função que procura qual id esta disponivel para uso

public function id_correto()
{
        // criando o comando selecionar o maior id existente
        $sql = "SELECT MAX(id_graf) as maior_id FROM img_graf";

        // executando a solicitação
        $retorno = $this->conexao->executarQuery($sql);
    
        $id_correto = $retorno + 1;

        return $id_correto;
}

}

// ------------------------------------------------ Criar na classe pois assim não é preciso criar em todas as scripts.

    $repositorioImg_graf = new Repositorioimg_grafMYSQL(); 

    // Fim do php
?>