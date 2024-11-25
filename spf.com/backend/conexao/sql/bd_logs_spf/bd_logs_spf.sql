-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/10/2024 às 14:44
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_logs_spf`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `logs`
--

CREATE TABLE `logs` (
  `id_log` int(11) NOT NULL,
  `titulo_log` varchar(255) NOT NULL,
  `descricao_log` varchar(255) NOT NULL,
  `sessao_log` varchar(255) NOT NULL,
  `ip_log` varchar(255) NOT NULL,
  `geolocalizacao_log` varchar(1020) NOT NULL,
  `hora_log` time NOT NULL,
  `data_log` date NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `usuario_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `logs`
--

INSERT INTO `logs` (`id_log`, `titulo_log`, `descricao_log`, `sessao_log`, `ip_log`, `geolocalizacao_log`, `hora_log`, `data_log`, `usuario_id`, `usuario_email`) VALUES
(0, 'Login no sistema', 'O usuário fez login no sistema spf com sucesso', 'LOGIN_COM_SUCESSO', '192.168.0.0', '12344432', '00:00:00', '2024-09-01', 1, '0'),
(2, 'Teste', 'Teste', 'TESTE', '192.172.0.1', '\'IP: 8.8.8.8 - Cidade: Mountain View - Região: California - País: US - Latitude: 37.4056,-122.0775 - Organização: AS15169 Google LLC\' ', '15:24:08', '2024-10-02', 2, 'codnicius@gmail.com'),
(0, 'Login no sistema', 'O usuário fez login no sistema spf com sucesso', 'LOGIN_COM_SUCESSO', '127.0.0.1', 'IP: 8.8.8.8 - Cidade: Ashburn - Região: Virginia - País: United States - Latitude: 39.03 - Longitude: -77.5 - Organização: Google Public DNS', '00:30:00', '0000-00-00', 5, 'codnicius@gmail.com'),
(0, 'Login no sistema', 'O usuário fez login no sistema spf com sucesso', 'LOGIN_COM_SUCESSO', '127.0.0.1', 'IP: 8.8.8.8 - Cidade: Ashburn - Região: Virginia - País: United States - Latitude: 39.03 - Longitude: -77.5 - Organização: Google Public DNS', '00:32:30', '2024-10-02', 5, 'codnicius@gmail.com'),
(0, 'Login no sistema', 'O usuário fez login no sistema spf com sucesso', 'LOGIN_COM_SUCESSO', '127.0.0.1', 'IP: 8.8.8.8 - Cidade: Ashburn - Região: Virginia - País: United States - Latitude: 39.03 - Longitude: -77.5 - Organização: Google Public DNS', '00:35:50', '2024-10-02', 5, 'codnicius@gmail.com'),
(0, 'Login no sistema', 'O usuário fez login no sistema spf com sucesso', 'LOGIN_COM_SUCESSO', '127.0.0.1', 'IP: 8.8.8.8 - Cidade: Ashburn - Região: Virginia - País: United States - Latitude: 39.03 - Longitude: -77.5 - Organização: Google Public DNS', '00:36:17', '2024-10-02', 5, 'codnicius@gmail.com'),
(0, 'Login no sistema', 'O usuário fez login no sistema spf com sucesso', 'LOGIN_COM_SUCESSO', '127.0.0.1', 'IP: 8.8.8.8 - Cidade: Ashburn - Região: Virginia - País: United States - Latitude: 39.03 - Longitude: -77.5 - Organização: Google Public DNS', '00:36:37', '2024-10-02', 5, 'codnicius@gmail.com'),
(0, 'Login no sistema', 'O usuário fez login no sistema spf com sucesso', 'LOGIN_COM_SUCESSO', '127.0.0.1', 'IP: 8.8.8.8 - Cidade: Ashburn - Região: Virginia - País: United States - Latitude: 39.03 - Longitude: -77.5 - Organização: Google Public DNS', '00:37:19', '2024-10-02', 5, 'codnicius@gmail.com'),
(0, 'Pesquisar logs com filtro', 'O usuario realizou um comando de pesquisar logs com filtro', 'PESQUISAR_LOGS', '::1', 'latXlog', '00:00:00', '0000-00-00', 5, 'codnicius@gmail.com'),
(0, 'Tentativa de login no sistema', 'O usuário não fez login no sistema spf, email inválido', 'LOGIN_INVALIDO', '127.0.0.1', 'IP: 8.8.8.8 - Cidade: Ashburn - Região: Virginia - País: United States - Latitude: 39.03 - Longitude: -77.5 - Organização: Google Public DNS', '09:14:16', '2024-10-02', 0, ''),
(0, 'Login no sistema', 'O usuário fez login no sistema spf com sucesso', 'LOGIN_COM_SUCESSO', '127.0.0.1', 'IP: 8.8.8.8 - Cidade: Ashburn - Região: Virginia - País: United States - Latitude: 39.03 - Longitude: -77.5 - Organização: Google Public DNS', '09:41:50', '2024-10-02', 5, 'codnicius@gmail.com'),
(0, 'Inserir Ppa', 'O usuario realizou um comando de inserir Ppa', 'CRUD_INSERIR_Ppa', '127.0.0.1', 'IP: 8.8.8.8 - Cidade: Ashburn - Região: Virginia - País: United States - Latitude: 39.03 - Longitude: -77.5 - Organização: Google Public DNS', '09:42:42', '2024-10-02', 5, 'codnicius@gmail.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
