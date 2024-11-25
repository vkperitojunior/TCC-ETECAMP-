-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/10/2024 às 05:15
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
-- Banco de dados: `bd_spf`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `arq_avaliacao`
--

CREATE TABLE `arq_avaliacao` (
  `id_pdfavaliativo` int(11) NOT NULL,
  `gincana_id` int(11) DEFAULT NULL,
  `titulo_pdfavaliativo` varchar(200) DEFAULT NULL,
  `desc_pdfavaliativo` varchar(1000) DEFAULT NULL,
  `arquivo_pdfavaliativo` varchar(255) DEFAULT NULL,
  `status_pdfavaliativo` int(11) NOT NULL,
  `ult_us_atz` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `arq_avaliacao`
--

INSERT INTO `arq_avaliacao` (`id_pdfavaliativo`, `gincana_id`, `titulo_pdfavaliativo`, `desc_pdfavaliativo`, `arquivo_pdfavaliativo`, `status_pdfavaliativo`, `ult_us_atz`) VALUES
(1, 4, 'Arquivo de regras de avaliação da dança', 'Orientações e definições acerca das regras de avaliação da dança ', '4dceb7bda610a40e56e6cafc57e92a82.pdf ', 1, 5),
(3, 3, 'Arquivo de regras de avaliação do teatro', 'Orientações e definições acerca das regras de avaliação do teatro', '46c7ea5c007db5079f05c564f097b073.pdf ', 1, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `arq_regras`
--

CREATE TABLE `arq_regras` (
  `id_pdfregra` int(11) NOT NULL,
  `gincana_id` int(11) DEFAULT NULL,
  `titulo_pdfregra` varchar(200) DEFAULT NULL,
  `desc_pdfregra` varchar(1000) DEFAULT NULL,
  `arquivo_pdfregra` varchar(255) DEFAULT NULL,
  `status_pdfregra` int(11) NOT NULL,
  `ult_us_atz` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `arq_regras`
--

INSERT INTO `arq_regras` (`id_pdfregra`, `gincana_id`, `titulo_pdfregra`, `desc_pdfregra`, `arquivo_pdfregra`, `status_pdfregra`, `ult_us_atz`) VALUES
(2, 4, 'Arquivo de regra 1', 'Arquivo de regras de dança', 'x', 1, NULL),
(3, 4, 'Arquivo de regra 2', 'Arquivo de regras de teatro', 'x', 1, NULL),
(4, 6, 'Arquivo de regra 3', 'Arquivo de regras do fifa', 'x', 1, 5),
(5, 6, 'Arquivo de regra geral', 'Arquivo de regra para consulta de todas as atividades', 'de8e66375b032911d54698a3c9c6f1bd.pdf', 1, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrosel`
--

CREATE TABLE `carrosel` (
  `id_cs` int(11) NOT NULL,
  `titulo_cs` varchar(255) NOT NULL,
  `ordem_cs` int(11) NOT NULL,
  `arquivo_cs` varchar(255) NOT NULL,
  `data_cs` date NOT NULL,
  `status_cs` int(11) NOT NULL,
  `ult_us_atz` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `carrosel`
--

INSERT INTO `carrosel` (`id_cs`, `titulo_cs`, `ordem_cs`, `arquivo_cs`, `data_cs`, `status_cs`, `ult_us_atz`) VALUES
(4, 'Spf', 1, '01c44f31fba3456dbe5fe58b80cf9048.jpg', '2024-10-20', 1, 1),
(5, 'Spf', 2, '0c3032df499913f40b44b4cd48c27dde.jpg', '2024-10-31', 1, 1),
(6, 'Spf', 3, '23daec8693b53c5b4a88082e3152f8fd.jpg', '2024-10-31', 1, 1),
(7, 'Spf', 4, 'b007231234ad267c0b0bfda835e41ecd.jpg', '2024-11-07', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `equipes`
--

CREATE TABLE `equipes` (
  `id_eq` int(11) NOT NULL,
  `nome_eq` varchar(100) DEFAULT NULL,
  `sala_eq` varchar(30) DEFAULT NULL,
  `ano_eq` int(11) DEFAULT NULL,
  `tema_eq` varchar(200) DEFAULT NULL,
  `cor_eq` varchar(200) NOT NULL,
  `extra_eq` varchar(3000) NOT NULL,
  `status_eq` int(11) NOT NULL,
  `ult_us_atz` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `equipes`
--

INSERT INTO `equipes` (`id_eq`, `nome_eq`, `sala_eq`, `ano_eq`, `tema_eq`, `cor_eq`, `extra_eq`, `status_eq`, `ult_us_atz`) VALUES
(63, 'Terceirao Fantastico - 3 AI', '3 ', 2024, 'Anos 80 ', 'Preto e ciano', 'Ultimo ano de participação', 1, 1),
(64, 'Thugs - 2 AI', '2 ', 2024, 'Anos 30 ', 'Roxo e preto', 'Nenhum', 1, 1),
(65, 'The murderers - 1 AI', '5 ', 2024, 'Anos 70 ', 'Laranja e preto', 'Nenhum', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `fotos`
--

CREATE TABLE `fotos` (
  `id_foto` int(11) NOT NULL,
  `titulo_foto` varchar(200) DEFAULT NULL,
  `descricao_foto` varchar(1000) DEFAULT NULL,
  `ano_foto` year(4) DEFAULT NULL,
  `arquivo_foto` varchar(255) DEFAULT NULL,
  `status_foto` int(11) NOT NULL,
  `ult_us_atz` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `fotos`
--

INSERT INTO `fotos` (`id_foto`, `titulo_foto`, `descricao_foto`, `ano_foto`, `arquivo_foto`, `status_foto`, `ult_us_atz`) VALUES
(9, 'Semana_Paulo_Freire_2024_img1.jpg', 'Semana Paulo Freire 2024', '2024', '71fba8ab660286e458c01ed9735ecba6.jpg', 1, 1),
(10, 'Semana_Paulo_Freire_2024_img2.jpg', 'Semana Paulo Freire 2024', '2024', 'fc116cd00964bbd3012ef4fc5414f833.jpg', 1, 1),
(11, 'Semana_Paulo_Freire_2024_img3.jpg', 'Semana Paulo Freire 2024', '2024', '8d60cf80b38f5c281ca5d1922368e164.jpg', 1, 1),
(12, 'Semana_Paulo_Freire_2024_img4.jpg', 'Semana Paulo Freire 2024', '2024', '50856bbefd62372f12f082c3b9c28bc6.jpg', 1, 1),
(13, 'Semana_Paulo_Freire_2024_img5.jpg', 'Semana Paulo Freire 2024', '2024', 'a53682b7b18e43495c56acedf47e2f52.jpg', 1, 1),
(14, 'Semana_Paulo_Freire_2024_img6.jpg', 'Semana Paulo Freire 2024', '2024', 'e407cc02f2b6ca05c5061ab044c8caca.jpg', 1, 1),
(15, 'Semana_Paulo_Freire_2024_img7.jpg', 'Semana Paulo Freire 2024', '2024', '5582055d83aa8ae99a6edc9e62aba87a.jpg', 1, 1),
(16, 'Semana_Paulo_Freire_2024_img8.jpg', 'Semana Paulo Freire 2024', '2024', '1309ac99d4b16db986f0550580f83fac.jpg', 1, 1),
(17, 'Semana_Paulo_Freire_2024_img9.jpg', 'Semana Paulo Freire 2024', '2024', 'b3e53102def94107dc3892e9ec03f4a9.jpg', 1, 1),
(18, 'Semana_Paulo_Freire_2024_img10.jpg', 'Semana Paulo Freire 2024', '2024', '9e0d811f18cfedcecbf7a5fec3aa9d9e.jpg', 1, 1),
(19, 'Semana_Paulo_Freire_2024_img11.jpg', 'Semana Paulo Freire 2024', '2024', '5451e3d19f2c079ae1642d12f17c1f17.jpg', 1, 1),
(20, 'Semana_Paulo_Freire_2024_img12.jpg', 'Semana Paulo Freire 2024', '2024', '1c62b3c61e5552289388ee678bd00d52.jpg', 1, 1),
(21, 'Semana_Paulo_Freire_2024_img13.jpg', 'Semana Paulo Freire 2024', '2024', 'c0c66ec9e94eabe0783663904993d00c.jpg', 1, 1),
(22, 'Semana_Paulo_Freire_2024_img14.jpg', 'Semana Paulo Freire 2024', '2024', 'a531ac4b2c896003ef8138900b868206.jpg', 1, 1),
(23, 'Semana_Paulo_Freire_2024_img15.jpg', 'Semana Paulo Freire 2024', '2024', '662c5729f5b5ad4e1814905f94477aba.jpg', 1, 1),
(24, 'Semana_Paulo_Freire_2024_img16.jpg', 'Semana Paulo Freire 2024', '2024', '08e9a3a05f5cef178749ca868f3034de.jpg', 1, 1),
(25, 'Semana_Paulo_Freire_2024_img17.jpg', 'Semana Paulo Freire 2024', '2024', 'c436e009784a3da4043114da459dc130.jpg', 1, 1),
(26, 'Semana_Paulo_Freire_2024_img18.jpg', 'Semana Paulo Freire 2024', '2024', '4739ad278f6e0d5bc23dd95bdf92318b.jpg', 1, 1),
(27, 'Semana_Paulo_Freire_2024_img19.jpg', 'Semana Paulo Freire 2024', '2024', '8073ea180a0cc3fef28bea684c881244.jpg', 1, 1),
(28, 'Semana_Paulo_Freire_2024_img20.jpg', 'Semana Paulo Freire 2024', '2024', 'ec17461dcfdb73904f6f7ae8b9c28a72.jpg', 1, 1),
(29, 'Semana_Paulo_Freire_2024_img21.jpg', 'Semana Paulo Freire 2024', '2024', 'ac6f4ad4012edc8186ae154bed97bffb.jpg', 1, 1),
(30, 'Semana_Paulo_Freire_2024_img22.jpg', 'Semana Paulo Freire 2024', '2024', '9351cc7dcf915ed8d4afe8976e1f0607.jpg', 1, 1),
(31, 'Semana_Paulo_Freire_2024_img23.jpg', 'Semana Paulo Freire 2024', '2024', 'ea2178c014935c31e6db3c7d84dc6533.jpg', 1, 1),
(32, 'Semana_Paulo_Freire_2024_img24.jpg', 'Semana Paulo Freire 2024', '2024', '38727df8d3ea825f0f15eb10d4745ad1.jpg', 1, 1),
(33, 'Semana_Paulo_Freire_2024_img25.jpg', 'Semana Paulo Freire 2024', '2024', '7af8842eb7077211c1ddaace48188a97.jpg', 1, 1),
(34, 'Semana_Paulo_Freire_2024_img26.jpg', 'Semana Paulo Freire 2024', '2024', '88eb30d8e1c71eeecfc323b909ed264c.jpg', 1, 1),
(35, 'Semana_Paulo_Freire_2024_img27.jpg', 'Semana Paulo Freire 2024', '2024', 'c426383397bb24d8db5959b172cb098b.jpg', 1, 1),
(36, 'Semana_Paulo_Freire_2024_img28.jpg', 'Semana Paulo Freire 2024', '2024', 'f28545b03f8ae80cde0c1d4d84875896.jpg', 1, 1),
(37, 'Semana_Paulo_Freire_2024_img29.jpg', 'Semana Paulo Freire 2024', '2024', 'ffd7fd46dfdaf1e2ad22fff745321c0f.jpg', 1, 1),
(38, 'Semana_Paulo_Freire_2024_img30.jpg', 'Semana Paulo Freire 2024', '2024', 'aa5bb87c616d42a0a4b93d06f66aa5bc.jpg', 1, 1),
(39, 'Semana_Paulo_Freire_2024_img31.jpg', 'Semana Paulo Freire 2024', '2024', '33cfbf822bf4de04742b465ac37e652e.jpg', 1, 1),
(40, 'Semana_Paulo_Freire_2024_img32.jpg', 'Semana Paulo Freire 2024', '2024', '4475a125832f5a2f21c20bc94a31994a.jpg', 1, 1),
(41, 'Semana_Paulo_Freire_2024_img33.jpg', 'Semana Paulo Freire 2024', '2024', '43478bf4a374f0e9f9605a8a46bc5764.jpg', 1, 1),
(42, 'Semana_Paulo_Freire_2024_img34.jpg', 'Semana Paulo Freire 2024', '2024', 'b039f1e96d844626089be34344b3bd32.jpg', 1, 1),
(43, 'Semana_Paulo_Freire_2024_img35.jpg', 'Semana Paulo Freire 2024', '2024', '8f790a894292e706de3c6743866aab43.jpg', 1, 1),
(44, 'Semana_Paulo_Freire_2024_img36.jpg', 'Semana Paulo Freire 2024', '2024', 'd962d123fc3153ad1888e9212d18d130.jpg', 1, 1),
(45, 'Semana_Paulo_Freire_2024_img37.jpg', 'Semana Paulo Freire 2024', '2024', '1f49cce897f8ea056ada096e00d6717f.jpg', 1, 1),
(46, 'Semana_Paulo_Freire_2024_img38.jpg', 'Semana Paulo Freire 2024', '2024', 'fb2c803105120a90cfdaaacd9a119f43.jpg', 1, 1),
(47, 'Semana_Paulo_Freire_2024_img39.jpg', 'Semana Paulo Freire 2024', '2024', 'c5abf767e38834c7f76dbf68432ac04d.jpg', 1, 1),
(48, 'Semana_Paulo_Freire_2024_img40.jpg', 'Semana Paulo Freire 2024', '2024', 'e459cdf2fef590fc586303421de9fd29.jpg', 1, 1),
(49, 'Semana_Paulo_Freire_2024_img41.jpg', 'Semana Paulo Freire 2024', '2024', 'fa4239bfdc5bc4fbfadb77f0ffc2a6a1.jpg', 1, 1),
(50, 'Semana_Paulo_Freire_2024_img42.jpg', 'Semana Paulo Freire 2024', '2024', '372aab24e8c680f902e3b811ff7d4ea4.jpg', 1, 1),
(51, 'Semana_Paulo_Freire_2024_img43.jpg', 'Semana Paulo Freire 2024', '2024', '0b0d4fa6f248574ffdccdbe7462bcbee.jpg', 1, 1),
(52, 'Semana_Paulo_Freire_2024_img44.jpg', 'Semana Paulo Freire 2024', '2024', '983b622be5527f49f1fd7d5d7f1932ff.jpg', 1, 1),
(53, 'Semana_Paulo_Freire_2024_img45.jpg', 'Semana Paulo Freire 2024', '2024', '8eeffd8f2d9511c4aa848f617f24d768.jpg', 1, 1),
(54, 'Semana_Paulo_Freire_2024_img46.jpg', 'Semana Paulo Freire 2024', '2024', 'a726b17a83a086e339359d059972e03e.jpg', 1, 1),
(55, 'Semana_Paulo_Freire_2024_img47.jpg', 'Semana Paulo Freire 2024', '2024', '3e1cf5db021f8314d5c97e3ea40b45dc.jpg', 1, 1),
(56, 'Semana_Paulo_Freire_2024_img48.jpg', 'Semana Paulo Freire 2024', '2024', 'a98570e286c427f75e04c8101dd8b079.jpg', 1, 1),
(57, 'Semana_Paulo_Freire_2024_img49.jpg', 'Semana Paulo Freire 2024', '2024', 'b07c64d05a3e0e9e6f39235072e31ba3.jpg', 1, 1),
(58, 'Semana_Paulo_Freire_2024_img50.jpg', 'Semana Paulo Freire 2024', '2024', '5d302b45981be8c36cd456f2739943dd.jpg', 1, 1),
(59, 'Semana_Paulo_Freire_2024_img51.jpg', 'Semana Paulo Freire 2024', '2024', 'd2db14978629d3cbe981fb99223ee771.jpg', 1, 1),
(60, 'Semana_Paulo_Freire_2024_img52.jpg', 'Semana Paulo Freire 2024', '2024', 'dcb02ccfcd482674d37f9a5eaf6dd5ce.jpg', 1, 1),
(61, 'Semana_Paulo_Freire_2024_img53.jpg', 'Semana Paulo Freire 2024', '2024', 'b17655b2e51119cdfa1fe6a1f9eda690.jpg', 1, 1),
(62, 'Semana_Paulo_Freire_2024_img54.jpg', 'Semana Paulo Freire 2024', '2024', 'ee91c96a9b3152f6fd7b48cdf812d054.jpg', 1, 1),
(63, 'Semana_Paulo_Freire_2024_img55.jpg', 'Semana Paulo Freire 2024', '2024', 'e239854b83a309f328a1be63d5fd2a1f.jpg', 1, 1),
(64, 'Semana_Paulo_Freire_2024_img56.jpg', 'Semana Paulo Freire 2024', '2024', 'b4a7e58cce783bcb2852905dfe9c1c0d.jpg', 1, 1),
(65, 'Semana_Paulo_Freire_2024_img57.jpg', 'Semana Paulo Freire 2024', '2024', '6035574c2881ffbe521f632eabcb5b4f.jpg', 1, 1),
(66, 'Semana_Paulo_Freire_2024_img58.jpg', 'Semana Paulo Freire 2024', '2024', 'f6b2d70239708c88a8ca6124e7ced601.jpg', 1, 1),
(67, 'Semana_Paulo_Freire_2024_img59.jpg', 'Semana Paulo Freire 2024', '2024', '7cf7d95281f2af664210fa1fd4fe88bf.jpg', 1, 1),
(68, 'Semana_Paulo_Freire_2024_img60.jpg', 'Semana Paulo Freire 2024', '2024', 'caa27e57fcf73695567ffe4de44b75be.jpg', 1, 1),
(69, 'Semana_Paulo_Freire_2024_img61.jpg', 'Semana Paulo Freire 2024', '2024', '79666f254e7078490cc6431fa9b89d72.jpg', 1, 1),
(70, 'Semana_Paulo_Freire_2024_img62.jpg', 'Semana Paulo Freire 2024', '2024', '46fbd7bcb61c93b47b228bdbfb43cb5d.jpg', 1, 1),
(71, 'Semana_Paulo_Freire_2024_img63.jpg', 'Semana Paulo Freire 2024', '2024', '879b6b1a4a2837e5257ce0623f74c871.jpg', 1, 1),
(72, 'Semana_Paulo_Freire_2024_img64.jpg', 'Semana Paulo Freire 2024', '2024', 'a60a1947ee9c1e23f525096867031831.jpg', 1, 1),
(73, 'Semana_Paulo_Freire_2024_img65.jpg', 'Semana Paulo Freire 2024', '2024', '8a10376b8a6b345707e3cc2205d64ad4.jpg', 1, 1),
(74, 'Semana_Paulo_Freire_2024_img66.jpg', 'Semana Paulo Freire 2024', '2024', 'bef065276382e04f65165894583f8367.jpg', 1, 1),
(75, 'Semana_Paulo_Freire_2024_img67.jpg', 'Semana Paulo Freire 2024', '2024', '8e0a56a64e433eeddf05f18c47e68975.jpg', 1, 1),
(76, 'Semana_Paulo_Freire_2024_img68.jpg', 'Semana Paulo Freire 2024', '2024', 'f41d3982ffd31bfb05693431dd8ef541.jpg', 1, 1),
(77, 'Semana_Paulo_Freire_2024_img69.jpg', 'Semana Paulo Freire 2024', '2024', '21e46ed4e2a54745e380383df272147d.jpg', 1, 1),
(78, 'Semana_Paulo_Freire_2024_img70.jpg', 'Semana Paulo Freire 2024', '2024', 'ebac70f2870d11b0983baaf4ea6a1ee8.jpg', 1, 1),
(79, 'Semana_Paulo_Freire_2024_img71.jpg', 'Semana Paulo Freire 2024', '2024', 'd229521202e533d2867337f37cb71fce.jpg', 1, 1),
(80, 'Semana_Paulo_Freire_2024_img72.jpg', 'Semana Paulo Freire 2024', '2024', 'b6cc3eb148c34acc1f75d50c869e2564.jpg', 1, 1),
(81, 'Semana_Paulo_Freire_2024_img73.jpg', 'Semana Paulo Freire 2024', '2024', '9f703b7b00344c50182ed4246d96828e.jpg', 1, 1),
(82, 'Semana_Paulo_Freire_2024_img74.jpg', 'Semana Paulo Freire 2024', '2024', '8172472f7e712972cf1291c7160e3c3a.jpg', 1, 1),
(83, 'Semana_Paulo_Freire_2024_img75.jpg', 'Semana Paulo Freire 2024', '2024', '5523c979b28e51bc2942c1ff85088c59.jpg', 1, 1),
(84, 'Semana_Paulo_Freire_2024_img76.jpg', 'Semana Paulo Freire 2024', '2024', '7bd8515b1d2a37ba367c1e80fcd25497.jpg', 1, 1),
(85, 'Semana_Paulo_Freire_2024_img77.jpg', 'Semana Paulo Freire 2024', '2024', 'b6a5e44cee70764f5a2742f521b0fb7d.jpg', 1, 1),
(86, 'Semana_Paulo_Freire_2024_img78.jpg', 'Semana Paulo Freire 2024', '2024', 'ee78ea3d00d8e3e91cbe49dd628fb7e2.jpg', 1, 1),
(87, 'Semana_Paulo_Freire_2024_img79.jpg', 'Semana Paulo Freire 2024', '2024', '8d956d13986987c47a0d4efe6bc39ab5.jpg', 1, 1),
(88, 'Semana_Paulo_Freire_2024_img80.jpg', 'Semana Paulo Freire 2024', '2024', '7eaf9b9b57b83dfeecd460113e3b08b6.jpg', 1, 1),
(89, 'Semana_Paulo_Freire_2024_img81.jpg', 'Semana Paulo Freire 2024', '2024', 'e0c2a6b7bd6c7be53dec4212ec1310e2.jpg', 1, 1),
(90, 'Semana_Paulo_Freire_2024_img82.jpg', 'Semana Paulo Freire 2024', '2024', 'd6fd7173b96d3af1744b2ed9e0fb6b1e.jpg', 1, 1),
(91, 'Semana_Paulo_Freire_2024_img83.jpg', 'Semana Paulo Freire 2024', '2024', '14881eb4943ed651198fcc1dd9978da6.jpg', 1, 1),
(92, 'Semana_Paulo_Freire_2024_img84.jpg', 'Semana Paulo Freire 2024', '2024', '5954ca7ad7d2bb9236138b0246246555.jpg', 1, 1),
(93, 'Semana_Paulo_Freire_2024_img85.jpg', 'Semana Paulo Freire 2024', '2024', '4efad54bdc245ea4f5938bb5597ac107.jpg', 1, 1),
(94, 'Semana_Paulo_Freire_2024_img86.jpg', 'Semana Paulo Freire 2024', '2024', '777694b448592e021a278cf11101e7e2.jpg', 1, 1),
(95, 'Semana_Paulo_Freire_2024_img87.jpg', 'Semana Paulo Freire 2024', '2024', 'ce14beab9e33da6ede14998f308d991a.jpg', 1, 1),
(96, 'Semana_Paulo_Freire_2024_img88.jpg', 'Semana Paulo Freire 2024', '2024', '296b852225514e3af78844a70fc9d938.jpg', 1, 1),
(97, 'Semana_Paulo_Freire_2024_img89.jpg', 'Semana Paulo Freire 2024', '2024', '5b7d0394d4888520652e464b69912f9c.jpg', 1, 1),
(98, 'Semana_Paulo_Freire_2024_img90.jpg', 'Semana Paulo Freire 2024', '2024', '4f06a15c4d91a73c90261e341a131d3a.jpg', 1, 1),
(99, 'Semana_Paulo_Freire_2024_img91.jpg', 'Semana Paulo Freire 2024', '2024', '93b12ec4e92da23520a81918a23bdc60.jpg', 1, 1),
(100, 'Semana_Paulo_Freire_2024_img92.jpg', 'Semana Paulo Freire 2024', '2024', '78d9a88c318164df4689a41bb3a9c043.jpg', 1, 1),
(101, 'Semana_Paulo_Freire_2024_img93.jpg', 'Semana Paulo Freire 2024', '2024', '219ba2352e53f8cd3ea97737c457f30f.jpg', 1, 1),
(102, 'Semana_Paulo_Freire_2024_img94.jpg', 'Semana Paulo Freire 2024', '2024', '582901edb75b5fc27ce8fc04c178756b.jpg', 1, 1),
(103, 'Semana_Paulo_Freire_2024_img95.jpg', 'Semana Paulo Freire 2024', '2024', '8843e72eb5a8d9de27536625d3329847.jpg', 1, 1),
(104, 'Semana_Paulo_Freire_2024_img96.jpg', 'Semana Paulo Freire 2024', '2024', '12c1bec35923a5c8f47841519418c23c.jpg', 1, 1),
(105, 'Semana_Paulo_Freire_2024_img97.jpg', 'Semana Paulo Freire 2024', '2024', '13b9f0229d35f49abb9b65319a0b1ab2.jpg', 1, 1),
(106, 'Semana_Paulo_Freire_2024_img98.jpg', 'Semana Paulo Freire 2024', '2024', '158c1c106a5a3fa8cc686cd931e6a5bd.jpg', 1, 1),
(107, 'Semana_Paulo_Freire_2024_img99.jpg', 'Semana Paulo Freire 2024', '2024', '9e3939457c0df4ba92354342973370de.jpg', 1, 1),
(108, 'Semana_Paulo_Freire_2024_img100.jpg', 'Semana Paulo Freire 2024', '2024', '5f71158e5661eb08faf07b11f885dc6a.jpg', 1, 1),
(109, 'Semana_Paulo_Freire_2024_img101.jpg', 'Semana Paulo Freire 2024', '2024', '7f7dc5baae710ca174c67f2fd7bb9e72.jpg', 1, 1),
(110, 'Semana_Paulo_Freire_2024_img102.jpg', 'Semana Paulo Freire 2024', '2024', '3b5ed9e476a88e1519eea039fe95e7bf.jpg', 1, 1),
(111, 'Semana_Paulo_Freire_2024_img103.jpg', 'Semana Paulo Freire 2024', '2024', '32c344b7e82e0e8c28e553c2f362d0b4.jpg', 1, 1),
(112, 'Semana_Paulo_Freire_2024_img104.jpg', 'Semana Paulo Freire 2024', '2024', '9cf7a84e8916c7d01b7b64e2be42a6d4.jpg', 1, 1),
(113, 'Semana_Paulo_Freire_2024_img105.jpg', 'Semana Paulo Freire 2024', '2024', 'bc3ed2b06ca016f6a529735d09361348.jpg', 1, 1),
(114, 'Semana_Paulo_Freire_2024_img106.jpg', 'Semana Paulo Freire 2024', '2024', 'b4d136447ed026d726f9c0cdd3cefac3.jpg', 1, 1),
(115, 'Semana_Paulo_Freire_2024_img107.jpg', 'Semana Paulo Freire 2024', '2024', 'a08684a861583361a411cdb33f10cddc.jpg', 1, 1),
(116, 'Semana_Paulo_Freire_2024_img108.jpg', 'Semana Paulo Freire 2024', '2024', 'c1e2f819d0527f50b717399ecd3bd7bf.jpg', 1, 1),
(117, 'Semana_Paulo_Freire_2024_img109.jpg', 'Semana Paulo Freire 2024', '2024', '76b0379aeadf752a1d2bc5dc8d23895b.jpg', 1, 1),
(118, 'Semana_Paulo_Freire_2024_img110.jpg', 'Semana Paulo Freire 2024', '2024', 'e9101b85c1a179797218a6230b0724a0.jpg', 1, 1),
(119, 'Semana_Paulo_Freire_2024_img111.jpg', 'Semana Paulo Freire 2024', '2024', 'db40020722342d92908962b5aebb877d.jpg', 1, 1),
(120, 'Semana_Paulo_Freire_2024_img112.jpg', 'Semana Paulo Freire 2024', '2024', '1efd83e8cb49a3c97805d2fa967dc3cb.jpg', 1, 1),
(121, 'Semana_Paulo_Freire_2024_img113.jpg', 'Semana Paulo Freire 2024', '2024', '8f6cc581d4de15b71462f65db496d056.jpg', 1, 1),
(122, 'Semana_Paulo_Freire_2024_img114.jpg', 'Semana Paulo Freire 2024', '2024', '38a5b7e7836a932822ba049d797a1b8b.jpg', 1, 1),
(123, 'Semana_Paulo_Freire_2024_img115.jpg', 'Semana Paulo Freire 2024', '2024', '4f5c0fd8676ded5a64f352854c27ee44.jpg', 1, 1),
(124, 'Semana_Paulo_Freire_2024_img116.jpg', 'Semana Paulo Freire 2024', '2024', 'c6ae2da08ad57d74c5fc94cf3b481dd5.jpg', 1, 1),
(125, 'Semana_Paulo_Freire_2024_img117.jpg', 'Semana Paulo Freire 2024', '2024', '8707c1a8914b507d3880d350ee4bfc36.jpg', 1, 1),
(126, 'Semana_Paulo_Freire_2024_Noite_img1.jpg', 'Semana Paulo Freire Noite 2024', '2024', '135fa03e89d58d797e3368119a253c81.jpg', 1, 1),
(127, 'Semana_Paulo_Freire_2024_Noite_img2.jpg', 'Semana Paulo Freire Noite 2024', '2024', '4207bb13bb9cbea84dedb497332f6d21.jpg', 1, 1),
(128, 'Semana_Paulo_Freire_2024_Noite_img3.jpg', 'Semana Paulo Freire Noite 2024', '2024', '91beadcd966efd5ea01bc87217585189.jpg', 1, 1),
(129, 'Semana_Paulo_Freire_2024_Noite_img4.jpg', 'Semana Paulo Freire Noite 2024', '2024', '4105d72cb59f4d2870712dd63f945951.jpg', 1, 1),
(130, 'Semana_Paulo_Freire_2024_Noite_img5.jpg', 'Semana Paulo Freire Noite 2024', '2024', '86e78c545e9fb82ce83250eac548cab7.jpg', 1, 1),
(131, 'Semana_Paulo_Freire_2024_Noite_img6.jpg', 'Semana Paulo Freire Noite 2024', '2024', '1899f570fd1d610a87c2ea781fcb19a6.jpg', 1, 1),
(132, 'Semana_Paulo_Freire_2024_Noite_img7.jpg', 'Semana Paulo Freire Noite 2024', '2024', 'aa1459e3636e32875bf4ca9194f6c6c4.jpg', 1, 1),
(133, 'Semana_Paulo_Freire_2024_Noite_img8.jpg', 'Semana Paulo Freire Noite 2024', '2024', '59a7c71c3e8379d509b635cae96aaf6e.jpg', 1, 1),
(134, 'Semana_Paulo_Freire_2024_Noite_img9.jpg', 'Semana Paulo Freire Noite 2024', '2024', 'c59493db97550b7cedb3e8d81a75a5dd.jpg', 1, 1),
(135, 'Semana_Paulo_Freire_2024_Noite_img10.jpg', 'Semana Paulo Freire Noite 2024', '2024', 'fcb9b36f8386455a4be6d9cb4786aef0.jpg', 1, 1),
(136, 'Semana_Paulo_Freire_2024_Noite_img11.jpg', 'Semana Paulo Freire Noite 2024', '2024', 'fdbb08475418c531cee45506237b5d6d.jpg', 1, 1),
(137, 'Semana_Paulo_Freire_2024_Noite_img12.jpg', 'Semana Paulo Freire Noite 2024', '2024', '914d4db9dfcf2e853194de2c9b2f82e0.jpg', 1, 1),
(138, 'Semana_Paulo_Freire_2024_Noite_img13.jpg', 'Semana Paulo Freire Noite 2024', '2024', '564e0dd8e675d820e1063de32e02d340.jpg', 1, 1),
(139, 'Semana_Paulo_Freire_2024_Noite_img14.jpg', 'Semana Paulo Freire Noite 2024', '2024', 'ceecb746a8ddeeb1221d7903ebeef479.jpg', 1, 1),
(140, 'Semana_Paulo_Freire_2024_Noite_img15.jpg', 'Semana Paulo Freire Noite 2024', '2024', '75a5c53f4dae81fc220716f1c65057ec.jpg', 1, 1),
(141, 'Semana_Paulo_Freire_2024_Noite_img16.jpg', 'Semana Paulo Freire Noite 2024', '2024', '0953bffd67fe7a08b73fb4f19340b64e.jpg', 1, 1),
(142, 'Semana_Paulo_Freire_2024_Noite_img17.jpg', 'Semana Paulo Freire Noite 2024', '2024', 'a21df3725f31bddf1155d752c333f17b.jpg', 1, 1),
(143, 'Semana_Paulo_Freire_2024_Noite_img18.jpg', 'Semana Paulo Freire Noite 2024', '2024', 'b4d330d5690888207514c4aa2bdad264.jpg', 1, 1),
(144, 'Semana_Paulo_Freire_2024_Noite_img19.jpg', 'Semana Paulo Freire Noite 2024', '2024', 'c94806cb413454168367d279afee2416.jpg', 1, 1),
(145, 'Semana_Paulo_Freire_2024_Noite_img20.jpg', 'Semana Paulo Freire Noite 2024', '2024', '0e2d2c941b57806620b5d71fe7883aa2.jpg', 1, 1),
(146, 'Semana_Paulo_Freire_2024_Noite_img21.jpg', 'Semana Paulo Freire Noite 2024', '2024', 'ac445bfddd38966bf146e0a166343a6d.jpg', 1, 1),
(147, 'Semana_Paulo_Freire_2024_Noite_img22.jpg', 'Semana Paulo Freire Noite 2024', '2024', '0f8f365a85f005ad5241c4161dbde2b0.jpg', 1, 1),
(148, 'Semana_Paulo_Freire_2024_Noite_img23.jpg', 'Semana Paulo Freire Noite 2024', '2024', '49c92cb6492501b64ddd5be38ba9ae3c.jpg', 1, 1),
(149, 'Semana_Paulo_Freire_2024_Noite_img24.jpg', 'Semana Paulo Freire Noite 2024', '2024', '3abec200617045376a6e94d59cccee65.jpg', 1, 1),
(150, 'Semana_Paulo_Freire_2024_Noite_img25.jpg', 'Semana Paulo Freire Noite 2024', '2024', 'fe6be4679a1948d297fcf63ef4cc4495.jpg', 1, 1),
(151, 'Semana_Paulo_Freire_2024_Noite_img26.jpg', 'Semana Paulo Freire Noite 2024', '2024', 'acde91d479f92b1099d19933c407c2fc.jpg', 1, 1),
(152, 'Semana_Paulo_Freire_2024_Noite_img27.jpg', 'Semana Paulo Freire Noite 2024', '2024', '3eb8ab79ce18f452767e79e1073754a1.jpg', 1, 1),
(153, 'Semana_Paulo_Freire_2024_Noite_img28.jpg', 'Semana Paulo Freire Noite 2024', '2024', '8863e62ffbae7865ce0c1e00995466e1.jpg', 1, 1),
(154, 'Semana_Paulo_Freire_2024_Noite_img29.jpg', 'Semana Paulo Freire Noite 2024', '2024', 'db09d9dbe95a18af5fcc56c11e959626.jpg', 1, 1),
(155, 'Semana_Paulo_Freire_2024_Noite_img30.jpg', 'Semana Paulo Freire Noite 2024', '2024', '5d0c07196b02471b93953e53bfc8c022.jpg', 1, 1),
(156, 'Semana_Paulo_Freire_2024_Noite_img31.jpg', 'Semana Paulo Freire Noite 2024', '2024', '862b8e5c7eb044910e8b8228397e399e.jpg', 1, 1),
(157, 'Semana_Paulo_Freire_2024_Noite_img32.jpg', 'Semana Paulo Freire Noite 2024', '2024', '4bb43b4f8116b5f3e4934ddc217d5bae.jpg', 1, 1),
(158, 'Semana_Paulo_Freire_2024_Noite_img33.jpg', 'Semana Paulo Freire Noite 2024', '2024', 'f77b18407dc234b8a4691ee347a62229.jpg', 1, 1),
(159, 'Semana_Paulo_Freire_2024_Noite_img34.jpg', 'Semana Paulo Freire Noite 2024', '2024', '9060a2762a2c07dd7a480da3be84ecdf.jpg', 1, 1),
(160, 'Semana_Paulo_Freire_2024_Noite_img35.jpg', 'Semana Paulo Freire Noite 2024', '2024', '529c78dd3c5201f394c34645e31e9692.jpg', 1, 1),
(161, 'Semana_Paulo_Freire_2024_Noite_img36.jpg', 'Semana Paulo Freire Noite 2024', '2024', 'b77441fa2c0188f0cc1021972abbedbe.jpg', 1, 1),
(162, 'Semana_Paulo_Freire_2024_Noite_img37.jpg', 'Semana Paulo Freire Noite 2024', '2024', '6073a400a7641367d12e59ab11dfb736.jpg', 1, 1),
(163, 'Semana_Paulo_Freire_2024_Noite_img38.jpg', 'Semana Paulo Freire Noite 2024', '2024', '428f0061685291cc04af17cd2f985fd5.jpg', 1, 1),
(164, 'Semana_Paulo_Freire_2024_Noite_img39.jpg', 'Semana Paulo Freire Noite 2024', '2024', '6bca2457a4e94a692ceaea0e9b73b3a0.jpg', 1, 1),
(165, 'Semana_Paulo_Freire_2024_Noite_img40.jpg', 'Semana Paulo Freire Noite 2024', '2024', '6365f3efe0c4c597cdb9d2ab91339eec.jpg', 1, 1),
(166, 'Semana_Paulo_Freire_2024_Noite_img41.jpg', 'Semana Paulo Freire Noite 2024', '2024', 'b9bdbc7f246eddc24dc2d1d699e1bf0e.jpg', 1, 1),
(167, 'Semana_Paulo_Freire_2024_Noite_img42.jpg', 'Semana Paulo Freire Noite 2024', '2024', '947bf8f1b6a85274c2610fd62ca62509.jpg', 1, 1),
(168, 'Semana_Paulo_Freire_2024_Noite_img43.jpg', 'Semana Paulo Freire Noite 2024', '2024', 'cb38e132d6b2755a9806db1e2090e603.jpg', 1, 1),
(169, 'Semana_Paulo_Freire_2024_Noite_img44.jpg', 'Semana Paulo Freire Noite 2024', '2024', 'bb74531ca251aa772aed03f92bf90b1a.jpg', 1, 1),
(170, 'Semana_Paulo_Freire_2024_Noite_img45.jpg', 'Semana Paulo Freire Noite 2024', '2024', 'f7488054e1f1341c76091e7214466769.jpg', 1, 1),
(171, 'Semana_Paulo_Freire_2024_Noite_img46.jpg', 'Semana Paulo Freire Noite 2024', '2024', '907cb420928f11e950c475cc9decd0ee.jpg', 1, 1),
(172, 'Semana_Paulo_Freire_2024_Noite_img47.jpg', 'Semana Paulo Freire Noite 2024', '2024', '9c614cd161757c42249382d821a7dc71.jpg', 1, 1),
(173, 'Semana_Paulo_Freire_2024_Noite_img48.jpg', 'Semana Paulo Freire Noite 2024', '2024', 'f3c5a59fdc22abb69227be06a782dfca.jpg', 1, 1),
(174, 'Semana_Paulo_Freire_2024_Noite_img49.jpg', 'Semana Paulo Freire Noite 2024', '2024', 'b5ebbafe9fc22b5580647a732e9064ce.jpg', 1, 1),
(175, 'Semana_Paulo_Freire_2024_Noite_img50.jpg', 'Semana Paulo Freire Noite 2024', '2024', 'b13db63968a82e3383ea05117c3ec050.jpg', 1, 1),
(176, 'Semana_Paulo_Freire_2024_Noite_img51.jpg', 'Semana Paulo Freire Noite 2024', '2024', '3b95a61aad3e650eddb39b2509d3e18d.jpg', 1, 1),
(177, 'Semana_Paulo_Freire_2024_Noite_img52.jpg', 'Semana Paulo Freire Noite 2024', '2024', 'd71086c278a12db1b7a84756094e6fa2.jpg', 1, 1),
(178, 'Semana_Paulo_Freire_2024_Noite_img53.jpg', 'Semana Paulo Freire Noite 2024', '2024', 'f6ec57e5c16a36becb18509ecf5fa2d9.jpg', 1, 1),
(179, 'Semana_Paulo_Freire_2024_Noite_img54.jpg', 'Semana Paulo Freire Noite 2024', '2024', '9d676e391b5d23ed08841288de439802.jpg', 1, 1),
(180, 'Semana_Paulo_Freire_2024_Noite_img55.jpg', 'Semana Paulo Freire Noite 2024', '2024', '8c57f604224d00f78bb9d3463469cdd8.jpg', 1, 1),
(181, 'Semana_Paulo_Freire_2024_Noite_img56.jpg', 'Semana Paulo Freire Noite 2024', '2024', '330a22c33fcaabaed8cc261119ba7e46.jpg', 1, 1),
(182, 'Semana_Paulo_Freire_2024_Noite_img57.jpg', 'Semana Paulo Freire Noite 2024', '2024', '4224441e8802c1e034b00fab728753b7.jpg', 1, 1),
(183, 'Semana_Paulo_Freire_2024_Noite_img58.jpg', 'Semana Paulo Freire Noite 2024', '2024', 'a0b828cd25ca3886a48f2099896e14d1.jpg', 1, 1),
(184, 'Semana_Paulo_Freire_2024_Noite_img59.jpg', 'Semana Paulo Freire Noite 2024', '2024', 'cef01d93eb97e35f819e1e084d6de0a2.jpg', 1, 1),
(185, 'Semana_Paulo_Freire_2024_Noite_img60.jpg', 'Semana Paulo Freire Noite 2024', '2024', '0f5d084f85a850a99fcb08bde2d245fa.jpg', 1, 1),
(186, 'Semana_Paulo_Freire_2024_Noite_img61.jpg', 'Semana Paulo Freire Noite 2024', '2024', 'a9ceb59baf5a045069466e4ebd44f3d5.jpg', 1, 1),
(187, 'Semana_Paulo_Freire_2024_Noite_img62.jpg', 'Semana Paulo Freire Noite 2024', '2024', 'be8fccb0159c84ba6a71a0c8454e133d.jpg', 1, 1),
(188, 'Semana Paulo Freire 2024', 'Semana Paulo Freire', '2024', '', 1, 1),
(189, 'Semana Paulo Freire 2024', 'Semana Paulo Freire', '2023', '96df034ff002c166464962d4fcefe229.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `gincanas`
--

CREATE TABLE `gincanas` (
  `id_gin` int(11) NOT NULL,
  `nome_gin` varchar(150) DEFAULT NULL,
  `regras_gin` varchar(2000) DEFAULT NULL,
  `crie_1` varchar(250) NOT NULL,
  `crie_2` varchar(250) NOT NULL,
  `crie_3` varchar(250) NOT NULL,
  `exemplo_gin` varchar(2000) DEFAULT NULL,
  `foto_gin` varchar(255) DEFAULT NULL,
  `horario_gin` datetime DEFAULT NULL,
  `local_gin` varchar(300) NOT NULL,
  `status_gin` int(11) NOT NULL,
  `ult_us_atz` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `gincanas`
--

INSERT INTO `gincanas` (`id_gin`, `nome_gin`, `regras_gin`, `crie_1`, `crie_2`, `crie_3`, `exemplo_gin`, `foto_gin`, `horario_gin`, `local_gin`, `status_gin`, `ult_us_atz`) VALUES
(3, 'Dança Temática                 ', 'Dança temática corresponde a um tipo de dança que apresenta um tema especifico.                 ', 'Passe', '', '', 'Brinque através de passos e jogadas ritmicas', ' ', '2024-09-30 12:19:31', 'Refeitorio                ', 0, 1),
(4, 'Teatro         ', 'Teatro é um termo de origem grega que designa simultaneamente o conjunto de peças dramáticas para apresentação em público e o edifício onde são apresentadas essas peças         ', 'Criatividade', '', '', 'Use mascaras, cores, roupas e fantasias para não limitar a imginação', ' ', '2024-10-01 07:17:14', 'Auditório         ', 0, 1),
(6, 'Fifa        ', 'Dynâmic! As questões sobre as regras do FIFA podem variar de acordo com a edição e a modalidade de jogo, vou fornecer um resumo geral. As regras básicas do FIFA incluem a duração do jogo, que é de 90 minutos divididos em dois tempos, exceptuando a Copa do Mundo e outras competições. Além disso, o objetivo é marcar mais gols do que o time adversário, e as equipes devem respeitar as leis do jogo e as regras de ética.        ', 'Passe', '', '', '2005', ' ', '2024-10-01 17:23:52', 'Laboratório 24        ', 0, 1),
(11, 'Dança  ', 'A gincana de dança em um evento artístico é uma competição amigável que busca promover a expressão corporal, a criatividade e a interação entre os participantes. Ela pode envolver diferentes estilos de dança, desde coreografias ensaiadas até improvisações, dependendo do objetivo da gincana e das habilidades dos concorrentes. As regras variam de acordo com o evento, mas, em geral, seguem alguns critérios fundamentais que ajudam a avaliar o desempenho dos participantes. ', 'Criatividade', 'Harmonia', 'Expressão Artística', 'Em uma gincana de dança, os participantes são divididos em equipes ou competem individualmente, e cada um tem que apresentar uma coreografia de acordo com as regras estabelecidas. Um exemplo simples dessa dinâmica seria uma competição em que cada grupo recebe uma música surpresa e tem 15 minutos para criar uma coreografia baseada nela.', '2edf8622f126ba794b981d0a9304fbf2.jpg ', '0000-00-00 00:00:00', 'Quadra da Escola ', 1, 1),
(12, 'Música ', 'Em uma gincana de música, os participantes podem competir em equipes ou individualmente, demonstrando suas habilidades musicais de forma criativa e colaborativa. O objetivo é testar a capacidade de improvisação, interpretação e a coesão musical dos competidores. Durante a gincana, as equipes têm um tempo determinado para ensaiar e, em seguida, se apresentam aos jurados. Cada apresentação é avaliada com base nos critérios acima. Ao final, a equipe ou participante que mais se destacar no conjunto de criatividade, harmonia e performance será declarada vencedora, mostrando que a música é uma arte que vai além da técnica, envolvendo também emoção e inovação. ', 'Criatividade', 'Harmonia', 'Performance', 'Um exemplo simples de como essa gincana pode funcionar é pedir aos grupos para criar uma apresentação musical utilizando instrumentos e/ou voz com base em uma melodia ou tema sorteado.', '1bac16e1b5810f7a236adcc35eec03e2.jpg ', '0000-00-00 00:00:00', 'Estacionamento ', 1, 1),
(13, 'Grito de Guerra ', 'A gincana de grito de guerra é uma competição em que grupos ou equipes precisam criar e apresentar um grito de guerra original, mostrando união, entusiasmo e criatividade. Esse tipo de gincana é comum em eventos esportivos, escolares ou festivos, sendo uma maneira de incentivar o espírito de equipe e o engajamento dos participantes. ', 'Criatividade', 'Entusiasmo', 'Sincronia ', 'Cada equipe recebe um tempo de 10 minutos para criar seu grito de guerra. Durante a apresentação, os jurados avaliam a energia do grupo, o impacto do grito, a criatividade das palavras e se todos estão participando de maneira harmônica. A equipe que demonstrar maior união, criatividade e entusiasmo será a vencedora da gincana, mostrando que um bom grito de guerra é aquele que une todos em uma só voz.', 'e3c2bdf9aca75ff57ae818b6092a0afd.jpg ', '0000-00-00 00:00:00', 'Estacionamento ', 1, 1),
(14, 'Ilustração  ', 'A gincana de ilustração é uma atividade que desafia os participantes a criarem desenhos ou ilustrações com base em um tema proposto. O objetivo é estimular a criatividade, o talento artístico e a capacidade de transmitir ideias por meio de um desenho. ', 'Criatividade', 'Composição ', 'Técnica', 'Em uma gincana de ilustração, os participantes recebem um tema como \"Natureza e Sustentabilidade\". Eles têm 30 minutos para criar uma ilustração que represente sua visão do tema.', 'dc62d43a05c7356937d7cb96297a34db.jpg ', '0000-00-00 00:00:00', 'Estacionamento ', 1, 1),
(15, 'Bandeira ', 'A gincana de bandeira é uma atividade que desafia as equipes a criarem uma bandeira que represente sua identidade ou o tema do evento. O objetivo é testar a capacidade criativa dos participantes em traduzir conceitos e ideias em símbolos visuais, utilizando cores, formas e elementos gráficos. A atividade geralmente envolve tanto a parte criativa quanto o trabalho em equipe, já que os grupos precisam colaborar para desenvolver uma bandeira única. ', 'Simbolismo', 'Design', 'Originalidade ', 'Na gincana de bandeira, cada equipe recebe material como tecido, tintas e pincéis, e tem 45 minutos para criar sua bandeira. O tema pode ser \"União e Amizade\", e os grupos devem ilustrar esses conceitos de maneira criativa.', '3eb41f28fb2b499a437b04ae625004d5.jpg ', '0000-00-00 00:00:00', 'Estacionamento ', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `historico`
--

CREATE TABLE `historico` (
  `id_hist` int(11) NOT NULL,
  `ano_hist` year(4) DEFAULT NULL,
  `tema_hist` varchar(200) NOT NULL,
  `primeiro_lugar` varchar(200) DEFAULT NULL,
  `segundo_lugar` varchar(200) DEFAULT NULL,
  `terceiro_lugar` varchar(200) DEFAULT NULL,
  `melhor_gincana` varchar(200) NOT NULL,
  `foto_hist` varchar(255) DEFAULT NULL,
  `status_hist` int(11) NOT NULL,
  `ult_us_atz` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `historico`
--

INSERT INTO `historico` (`id_hist`, `ano_hist`, `tema_hist`, `primeiro_lugar`, `segundo_lugar`, `terceiro_lugar`, `melhor_gincana`, `foto_hist`, `status_hist`, `ult_us_atz`) VALUES
(3, '2024', 'Décadas', '2°Adm', '3ºAdm', '3°A', 'No ano de 2024, a gincana de dança trouxe uma competição emocionante, reunindo diversas salas em apresentações vibrantes. A sala do 2º ADM se destacou ao conquistar o primeiro lugar.', '73d04b638b5a16e81673d3d55abb2116.jpg', 1, 1),
(4, '2023', 'Festivais', '1ºAdm', '3°A', '3ºAi', 'Em 2023, a gincana de música foi um grande sucesso, reunindo diversas turmas em performances emocionantes. A turma do 1º ADM se destacou ao conquistar o primeiro lugar com uma apresentação envolvente.', '078e4a161510ea922f68e4689d6318a3.jpg', 1, 1),
(5, '2022', 'Disney', '3ºA', '3ºAi', '1ºAdm', 'Em 2022, a gincana de teatro encantou a todos com performances memoráveis e cheias de emoção. A sala do 3º A foi a grande campeã, apresentando uma peça criativa e bem ensaiada.', '890761194da35e1b550177aa5b807b9e.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `img_graf`
--

CREATE TABLE `img_graf` (
  `id_graf` int(11) NOT NULL,
  `nome_graf` varchar(500) NOT NULL,
  `arq_graf` varchar(255) NOT NULL,
  `data_graf` date NOT NULL DEFAULT current_timestamp(),
  `ult_us_atz` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `img_graf`
--

INSERT INTO `img_graf` (`id_graf`, `nome_graf`, `arq_graf`, `data_graf`, `ult_us_atz`) VALUES
(1, 'Gráfico de barras', 'grafico_pontuacao.png', '0000-00-00', 5),
(2, 'Gráfico de eficiencia', 'grafico_eficiencia.png', '0000-00-00', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `logo`
--

CREATE TABLE `logo` (
  `id_lg` int(11) NOT NULL,
  `titulo_lg` varchar(255) NOT NULL,
  `ano_lg` year(4) NOT NULL,
  `arquivo_lg` varchar(255) NOT NULL,
  `ult_us_atz` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `logo`
--

INSERT INTO `logo` (`id_lg`, `titulo_lg`, `ano_lg`, `arquivo_lg`, `ult_us_atz`) VALUES
(1, 'Logo original', '2024', 'a2b39209002f1fa7bbb5d479c1fed676.jpeg', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `noticias`
--

CREATE TABLE `noticias` (
  `id_not` int(11) NOT NULL,
  `titulo_not` varchar(150) DEFAULT NULL,
  `descricao_not` varchar(2000) DEFAULT NULL,
  `data_not` date DEFAULT NULL,
  `foto_not` varchar(255) DEFAULT NULL,
  `status_not` int(11) NOT NULL,
  `ult_us_atz` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `noticias`
--

INSERT INTO `noticias` (`id_not`, `titulo_not`, `descricao_not`, `data_not`, `foto_not`, `status_not`, `ult_us_atz`) VALUES
(6, 'Site em Desenvolvimento', 'Estamos dedicados a aprimorar o Sistema Paulo Freire, que tem como objetivo organizar e divulgar informações sobre as gincanas. Neste momento, o site encontra-se em fase de desenvolvimento, e nossa equipe técnica está empenhada em corrigir erros e otimizar a usabilidade. Agradecemos a compreensão de todos os usuários e ressaltamos que nosso compromisso é entregar uma plataforma eficiente e informativa. Fiquem atentos para futuras atualizações sobre o progresso do site!', '2024-02-19', '8e852885efc9f550ed46db7d5c99a053.png', 1, 1),
(7, 'Versão Final Pronta', 'É com grande satisfação que anunciamos que a versão final do Sistema Paulo Freire está pronta para ser apresentada ao público. Após um cuidadoso processo de desenvolvimento, que incluiu a implementação de funcionalidades relevantes e melhorias de design, estamos confiantes de que a plataforma atenderá às necessidades de todos os participantes das gincanas. Agradecemos a todos os envolvidos no processo e esperamos que todos desfrutem da experiência que o sistema proporcionará.', '2024-10-19', 'ba8338fee627528112220b8907f3f4b6.png', 1, 1),
(8, ' Lançamento na Próxima Semana Paulo Freire', 'Temos o prazer de informar que o lançamento oficial do Sistema Paulo Freire ocorrerá na próxima semana, durante o evento em homenagem a Paulo Freire. Este lançamento marcará um passo significativo na organização das gincanas, permitindo que alunos e professores acessem informações de forma rápida e eficiente. Convidamos todos a participar da celebração e a conhecer a nova plataforma, que promete facilitar a comunicação e a divulgação dos eventos. Fiquem atentos para mais detalhes sobre a programação do evento!', '2025-07-11', '0be6ea7f525955258f609b6221c625d8.png', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ppa`
--

CREATE TABLE `ppa` (
  `id_pontpa` int(11) NOT NULL,
  `equipe_id` int(11) DEFAULT NULL,
  `gincana_id` int(11) DEFAULT NULL,
  `crie_1` decimal(10,2) NOT NULL,
  `crie_2` decimal(10,2) NOT NULL,
  `crie_3` decimal(10,2) NOT NULL,
  `dia_pontpa` date DEFAULT NULL,
  `pont_da_gin` decimal(10,2) DEFAULT NULL,
  `obs_pontpa` varchar(3000) DEFAULT NULL,
  `status_pontpa` int(11) NOT NULL,
  `ult_us_atz` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ppa`
--

INSERT INTO `ppa` (`id_pontpa`, `equipe_id`, `gincana_id`, `crie_1`, `crie_2`, `crie_3`, `dia_pontpa`, `pont_da_gin`, `obs_pontpa`, `status_pontpa`, `ult_us_atz`) VALUES
(9, 63, 3, 8.00, 10.00, 9.00, '2024-09-27', 9.00, 'Muito bom', 1, 5),
(10, 64, 3, 5.00, 5.00, 5.00, '2024-09-27', 5.00, '', 1, 5),
(11, 65, 4, 7.00, 8.00, 9.00, '2024-09-26', 8.00, 'nenhuma', 1, 5),
(12, 63, 4, 5.00, 10.00, 8.00, '2024-09-26', 7.67, '', 1, 5),
(13, 65, 3, 8.00, 8.00, 8.00, '2024-09-26', 8.00, '', 1, 5),
(14, 64, 3, 2.00, 3.00, 8.00, '2024-09-27', 4.33, '', 1, 5),
(15, 63, 6, 3.00, 9.00, 5.00, '2024-09-12', 5.67, 'Torcida fez muito barulho', 1, 5),
(16, 64, 6, 5.00, 8.00, 8.00, '2024-09-06', 7.00, 'Quase foram expulsos por chororo', 1, 5),
(17, 64, 6, 5.00, 8.00, 8.00, '2024-09-06', 7.00, 'Quase foram expulsos por chororo', 1, 5),
(18, 64, 6, 5.00, 8.00, 8.00, '2024-09-06', 7.00, 'Quase foram expulsos por chororo', 1, 5),
(19, 64, 6, 5.00, 8.00, 8.00, '2024-09-06', 7.00, 'Quase foram expulsos por chororo', 1, 5),
(20, 65, 4, 3.00, 4.00, 8.00, '2024-09-04', 5.00, '', 1, 5),
(21, 64, 3, 8.00, 9.00, 8.00, '2024-09-30', 8.33, '', 1, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ppe`
--

CREATE TABLE `ppe` (
  `id_pont` int(11) NOT NULL,
  `equipe_id` int(11) DEFAULT NULL,
  `soma_pont` decimal(10,2) DEFAULT NULL,
  `ranking` int(11) NOT NULL,
  `obs_pont` varchar(3000) DEFAULT NULL,
  `status_pontpe` int(11) NOT NULL,
  `ult_us_atz` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ppe`
--

INSERT INTO `ppe` (`id_pont`, `equipe_id`, `soma_pont`, `ranking`, `obs_pont`, `status_pontpe`, `ult_us_atz`) VALUES
(11, 63, 35.00, 1, 'Nenhuma por momento', 1, 5),
(13, 65, 32.00, 2, 'Nenhuma por momento', 1, 5),
(14, 64, 32.00, 3, 'Nenhuma por momento', 1, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `temas`
--

CREATE TABLE `temas` (
  `id_tema` int(11) NOT NULL,
  `tema_tm` varchar(200) NOT NULL,
  `motivacao_tm` text NOT NULL,
  `primeiro_ano` date NOT NULL,
  `status_tm` int(11) NOT NULL DEFAULT 0,
  `ult_us_atz` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `temas`
--

INSERT INTO `temas` (`id_tema`, `tema_tm`, `motivacao_tm`, `primeiro_ano`, `status_tm`, `ult_us_atz`) VALUES
(3, 'Culturas', '2024 ', '0000-00-00', 1, NULL),
(4, 'Disney ', '2022 ', '0000-00-00', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_us` int(11) NOT NULL,
  `nome_us` varchar(150) DEFAULT NULL,
  `email_us` varchar(150) DEFAULT NULL,
  `senha_us` varchar(2000) DEFAULT NULL,
  `foto_us` varchar(255) DEFAULT NULL,
  `funcao_us` int(11) NOT NULL,
  `funcao_no_evento` varchar(400) NOT NULL,
  `status_us` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_us`, `nome_us`, `email_us`, `senha_us`, `foto_us`, `funcao_us`, `funcao_no_evento`, `status_us`) VALUES
(1, 'Vinicius Kum', 'email@gmail.com', 'caeff9c3da8db7e343d2f9e75a86c2750b2875ee7568688e567da0dc2db9417606ca3875b406cb38e5e98280f50bbf012fe6ea7e1a101e6bc559acd1a363c6aed3a8793aa86ebbdfd7271980a9fbf7258ae04b72b8333ef3', 'IMG_20231208_133001196_BURST000_COVER (1).jpg', 1, 'Administrador', 1),
(2, 'Adélia Lucia Ferreira Lourenço', 'adelialflourenco@gmail.com', 'caeff9c3da8db7e343d2f9e75a86c2750b2875ee7568688e567da0dc2db9417606ca3875b406cb38e5e98280f50bbf012fe6ea7e1a101e6bc559acd1a363c6aed3a8793aa86ebbdfd7271980a9fbf7258ae04b72b8333ef3', 'IMG_20231208_133001196_BURST000_COVER.jpg', 0, 'avaliador', 1),
(3, 'André Santos', 'andre@gmail.com', 'caeff9c3da8db7e343d2f9e75a86c2750b2875ee7568688e567da0dc2db9417606ca3875b406cb38e5e98280f50bbf012fe6ea7e1a101e6bc559acd1a363c6aed3a8793aa86ebbdfd7271980a9fbf7258ae04b72b8333ef3', 'logo dos seca bic.png', 1, 'Organizador da coleta', 1),
(4, 'Rosália', 'rosa@gmail.com', 'caeff9c3da8db7e343d2f9e75a86c2750b2875ee7568688e567da0dc2db9417606ca3875b406cb38e5e98280f50bbf012fe6ea7e1a101e6bc559acd1a363c6aed3a8793aa86ebbdfd7271980a9fbf7258ae04b72b8333ef3', 'caneta com fundo.png', 1, 'Administrador', 1),
(5, 'KUM', 'codnicius@gmail.com', 'caeff9c3da8db7e343d2f9e75a86c2750b2875ee7568688e567da0dc2db9417606ca3875b406cb38e5e98280f50bbf012fe6ea7e1a101e6bc559acd1a363c6aed3a8793aa86ebbdfd7271980a9fbf7258ae04b72b8333ef3', '', 1, 'Administrador', 1),
(7, 'Marcelo Macrino dos Santos', 'marcelo@gmail.com', 'caeff9c3da8db7e343d2f9e75a86c2750b2875ee7568688e567da0dc2db9417606ca3875b406cb38e5e98280f50bbf012fe6ea7e1a101e6bc559acd1a363c6aed3a8793aa86ebbdfd7271980a9fbf7258ae04b72b8333ef3', '', 1, 'Organizador do fifa', 1),
(8, 'Marcos Abdala', 'marcosabdala65@gmail.com', 'caeff9c3da8db7e343d2f9e75a86c2750b2875ee7568688e567da0dc2db9417606ca3875b406cb38e5e98280f50bbf012fe6ea7e1a101e6bc559acd1a363c6aed3a8793aa86ebbdfd7271980a9fbf7258ae04b72b8333ef3', '0db072fbc292cd023832a3ce7cac4b11.png', 0, 'Organizador da dança', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `arq_avaliacao`
--
ALTER TABLE `arq_avaliacao`
  ADD PRIMARY KEY (`id_pdfavaliativo`),
  ADD KEY `gincana_id` (`gincana_id`),
  ADD KEY `ult_us_atz` (`ult_us_atz`);

--
-- Índices de tabela `arq_regras`
--
ALTER TABLE `arq_regras`
  ADD PRIMARY KEY (`id_pdfregra`),
  ADD KEY `gincana_id` (`gincana_id`),
  ADD KEY `ult_us_atz` (`ult_us_atz`);

--
-- Índices de tabela `carrosel`
--
ALTER TABLE `carrosel`
  ADD PRIMARY KEY (`id_cs`),
  ADD KEY `ult_us_atz` (`ult_us_atz`);

--
-- Índices de tabela `equipes`
--
ALTER TABLE `equipes`
  ADD PRIMARY KEY (`id_eq`),
  ADD KEY `ult_us_atz` (`ult_us_atz`);

--
-- Índices de tabela `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `ult_us_atz` (`ult_us_atz`);

--
-- Índices de tabela `gincanas`
--
ALTER TABLE `gincanas`
  ADD PRIMARY KEY (`id_gin`),
  ADD KEY `ult_us_atz` (`ult_us_atz`);

--
-- Índices de tabela `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id_hist`),
  ADD KEY `ult_us_atz` (`ult_us_atz`);

--
-- Índices de tabela `img_graf`
--
ALTER TABLE `img_graf`
  ADD PRIMARY KEY (`id_graf`),
  ADD KEY `ult_us_atz` (`ult_us_atz`);

--
-- Índices de tabela `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`id_lg`),
  ADD KEY `ult_us_atz` (`ult_us_atz`);

--
-- Índices de tabela `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id_not`),
  ADD KEY `ult_us_atz` (`ult_us_atz`);

--
-- Índices de tabela `ppa`
--
ALTER TABLE `ppa`
  ADD PRIMARY KEY (`id_pontpa`),
  ADD KEY `equipe_id` (`equipe_id`),
  ADD KEY `gincana_id` (`gincana_id`),
  ADD KEY `ult_us_atz` (`ult_us_atz`);

--
-- Índices de tabela `ppe`
--
ALTER TABLE `ppe`
  ADD PRIMARY KEY (`id_pont`),
  ADD KEY `equipe_id` (`equipe_id`),
  ADD KEY `ult_us_atz` (`ult_us_atz`);

--
-- Índices de tabela `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`id_tema`),
  ADD KEY `ult_us_atz` (`ult_us_atz`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_us`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `arq_avaliacao`
--
ALTER TABLE `arq_avaliacao`
  MODIFY `id_pdfavaliativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `arq_regras`
--
ALTER TABLE `arq_regras`
  MODIFY `id_pdfregra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `carrosel`
--
ALTER TABLE `carrosel`
  MODIFY `id_cs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `equipes`
--
ALTER TABLE `equipes`
  MODIFY `id_eq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de tabela `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT de tabela `gincanas`
--
ALTER TABLE `gincanas`
  MODIFY `id_gin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `historico`
--
ALTER TABLE `historico`
  MODIFY `id_hist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `img_graf`
--
ALTER TABLE `img_graf`
  MODIFY `id_graf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `logo`
--
ALTER TABLE `logo`
  MODIFY `id_lg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id_not` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `ppa`
--
ALTER TABLE `ppa`
  MODIFY `id_pontpa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `ppe`
--
ALTER TABLE `ppe`
  MODIFY `id_pont` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `temas`
--
ALTER TABLE `temas`
  MODIFY `id_tema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_us` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `arq_avaliacao`
--
ALTER TABLE `arq_avaliacao`
  ADD CONSTRAINT `arq_avaliacao_ibfk_1` FOREIGN KEY (`gincana_id`) REFERENCES `gincanas` (`id_gin`),
  ADD CONSTRAINT `arq_avaliacao_ibfk_2` FOREIGN KEY (`ult_us_atz`) REFERENCES `usuarios` (`id_us`);

--
-- Restrições para tabelas `arq_regras`
--
ALTER TABLE `arq_regras`
  ADD CONSTRAINT `arq_regras_ibfk_1` FOREIGN KEY (`gincana_id`) REFERENCES `gincanas` (`id_gin`),
  ADD CONSTRAINT `arq_regras_ibfk_2` FOREIGN KEY (`ult_us_atz`) REFERENCES `usuarios` (`id_us`),
  ADD CONSTRAINT `arq_regras_ibfk_3` FOREIGN KEY (`ult_us_atz`) REFERENCES `usuarios` (`id_us`);

--
-- Restrições para tabelas `carrosel`
--
ALTER TABLE `carrosel`
  ADD CONSTRAINT `carrosel_ibfk_1` FOREIGN KEY (`ult_us_atz`) REFERENCES `usuarios` (`id_us`);

--
-- Restrições para tabelas `equipes`
--
ALTER TABLE `equipes`
  ADD CONSTRAINT `equipes_ibfk_1` FOREIGN KEY (`ult_us_atz`) REFERENCES `usuarios` (`id_us`);

--
-- Restrições para tabelas `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `fotos_ibfk_1` FOREIGN KEY (`ult_us_atz`) REFERENCES `usuarios` (`id_us`);

--
-- Restrições para tabelas `gincanas`
--
ALTER TABLE `gincanas`
  ADD CONSTRAINT `gincanas_ibfk_1` FOREIGN KEY (`ult_us_atz`) REFERENCES `usuarios` (`id_us`);

--
-- Restrições para tabelas `historico`
--
ALTER TABLE `historico`
  ADD CONSTRAINT `historico_ibfk_1` FOREIGN KEY (`ult_us_atz`) REFERENCES `usuarios` (`id_us`);

--
-- Restrições para tabelas `img_graf`
--
ALTER TABLE `img_graf`
  ADD CONSTRAINT `img_graf_ibfk_1` FOREIGN KEY (`ult_us_atz`) REFERENCES `usuarios` (`id_us`);

--
-- Restrições para tabelas `logo`
--
ALTER TABLE `logo`
  ADD CONSTRAINT `logo_ibfk_1` FOREIGN KEY (`ult_us_atz`) REFERENCES `usuarios` (`id_us`);

--
-- Restrições para tabelas `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`ult_us_atz`) REFERENCES `usuarios` (`id_us`);

--
-- Restrições para tabelas `ppa`
--
ALTER TABLE `ppa`
  ADD CONSTRAINT `ppa_ibfk_1` FOREIGN KEY (`equipe_id`) REFERENCES `equipes` (`id_eq`),
  ADD CONSTRAINT `ppa_ibfk_2` FOREIGN KEY (`gincana_id`) REFERENCES `gincanas` (`id_gin`),
  ADD CONSTRAINT `ppa_ibfk_3` FOREIGN KEY (`ult_us_atz`) REFERENCES `usuarios` (`id_us`);

--
-- Restrições para tabelas `ppe`
--
ALTER TABLE `ppe`
  ADD CONSTRAINT `ppe_ibfk_1` FOREIGN KEY (`equipe_id`) REFERENCES `equipes` (`id_eq`),
  ADD CONSTRAINT `ppe_ibfk_2` FOREIGN KEY (`ult_us_atz`) REFERENCES `usuarios` (`id_us`);

--
-- Restrições para tabelas `temas`
--
ALTER TABLE `temas`
  ADD CONSTRAINT `ult_us_atz` FOREIGN KEY (`ult_us_atz`) REFERENCES `usuarios` (`id_us`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
