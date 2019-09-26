-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Set-2019 às 12:34
-- Versão do servidor: 10.4.6-MariaDB
-- versão do PHP: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `modesto`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrador`
--

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `administrador`
--

INSERT INTO `administrador` (`id`, `login`, `senha`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `caixa`
--

CREATE TABLE `caixa` (
  `status` varchar(50) NOT NULL,
  `valor` double NOT NULL,
  `data` varchar(20) NOT NULL,
  `hora` varchar(20) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `caixa`
--

INSERT INTO `caixa` (`status`, `valor`, `data`, `hora`, `id`) VALUES
('Retirada', 20, '19/09/2019', '10:43', 2),
('Retirada', 20, '18/09/2019', '10:43', 3),
('Retirada', 20, '19/09/2019', '20:45', 4),
('Retirada', 9, '19/09/2019', '20:54', 6),
('Retirada', 5, '20/09/2019', '16:03', 8),
('Retirada', 100, '20/09/2019', '16:03', 9),
('Retirada', 50, '20/09/2019', '16:08', 10),
('Retirada', 25, '20/09/2019', '11:08', 11),
('Retirada', 20, '20/09/2019', '11:46', 13),
('Retirada', 2000, '20/09/2019', '14:08', 14),
('Retirada', 20, '20/09/2019', '15:47', 15);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `cod_barra` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `preco` double NOT NULL,
  `qtd` int(11) NOT NULL,
  `imagem` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `cod_barra`, `nome`, `marca`, `descricao`, `preco`, `qtd`, `imagem`) VALUES
(18, '', 'Caneta', 'Tilibra', 'azul', 0.25, 20, '2fce78f3bcae60233cd2453fde3d6ef3ea1c45af.jpeg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE `servico` (
  `nome` varchar(50) NOT NULL,
  `preco` float NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `servico`
--

INSERT INTO `servico` (`nome`, `preco`, `imagem`, `id`) VALUES
('Xerox', 100, '', 16),
('Impressão', 0.3, '', 17),
('Plastificação', 2.5, '', 18),
('Impressão colorida por whatssap', 1.8, '', 21);

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

CREATE TABLE `venda` (
  `id` int(11) NOT NULL,
  `valor` double NOT NULL,
  `produto` varchar(200) NOT NULL,
  `qtd` int(11) NOT NULL,
  `data` varchar(50) NOT NULL,
  `hora` varchar(50) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `venda`
--

INSERT INTO `venda` (`id`, `valor`, `produto`, `qtd`, `data`, `hora`, `tipo`) VALUES
(43, 1.5, 'Impressão', 5, '13/09/2019', '11:06', 1),
(44, 8, 'Caneta', 4, '13/09/2019', '11:07', 0),
(45, 5, 'Plastificação', 2, '14/09/2019', '10:35', 1),
(46, 12, 'Caneta', 6, '14/09/2019', '10:36', 0),
(47, 3, 'Impressão colorida', 2, '14/09/2019', '10:37', 1),
(48, 1.8, 'Impressão', 6, '19/09/2019', '07:34', 1),
(49, 100, 'Caneta', 10, '19/09/2019', '08:24', 0),
(51, 1, 'Caneta', 4, '19/09/2019', '15:50', 0),
(52, 0.3, 'Impressão', 1, '19/09/2019', '15:52', 1),
(53, 5, 'Caneta', 20, '20/09/2019', '09:27', 0),
(54, 200, 'Xerox', 2, '20/09/2019', '09:28', 1),
(55, 0.25, 'Caneta', 1, '20/09/2019', '11:07', 0),
(56, 15, 'Caneta', 60, '20/09/2019', '11:18', 0),
(57, 0, 'Impressão', 0, '20/09/2019', '14:07', 1),
(58, 2000, 'Xerox', 20, '20/09/2019', '14:08', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `caixa`
--
ALTER TABLE `caixa`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `caixa`
--
ALTER TABLE `caixa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `servico`
--
ALTER TABLE `servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
