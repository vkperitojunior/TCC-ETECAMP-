<?php

if (!class_exists('ConexaoSQL')) {

    // Criando a classe conexao com suas variáveis para conectar ao SQL
    class ConexaoSQL {
        private $host;
        private $usuario;
        private $senha;
        private $banco;
        private $conexao;

        // Construindo uma função para armazenar todos os dados de conexão
        function __construct($host, $usuario, $senha, $banco) {
            // Passando os atributos da classe para salvar todos juntos
            $this->host = $host;
            $this->usuario = $usuario;
            $this->senha = $senha;
            $this->banco = $banco;
        }

        // Criando a função de conexão final
        function conectar() {
            $this->conexao = mysqli_connect(
                // Passando as variáveis de conexão
                $this->host,
                $this->usuario,
                $this->senha,
                $this->banco
            );

            // Caso de algum erro na conexão, retorna uma variável de erro
            if ($this->conexao->connect_errno) {
                echo "Falha de Conexão MySQL: " . $this->conexao->connect_error;
                // Retorna variável booleana falsa para erro de conexão
                return false;
            } else {
                // Retorna variável booleana verdadeira para conexão bem-sucedida
                return true;
            }
        }

        // Criando o executor de comandos SQL
        function executarQuery($sql) {
            return mysqli_query($this->conexao, $sql);
        }

        // Criando uma função que obtém o número de linhas da tabela do banco de dados
        function obtemPrimeiroregistroQuery($query) {
            $linhas = $this->executarQuery($query);
        }

        // Método para obter a conexão
        function getConnection() {
            return $this->conexao;
        }
    }
}

?>
