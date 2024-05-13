-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13/05/2024 às 03:31
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sis_controle`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

CREATE TABLE `aluno` (
  `matricula` char(10) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  `senha` varchar(20) DEFAULT NULL,
  `status_aluno` varchar(10) DEFAULT NULL,
  `telefone` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aluno`
--

INSERT INTO `aluno` (`matricula`, `nome`, `usuario`, `senha`, `status_aluno`, `telefone`) VALUES
('6786876', 'Vitin', 'vtn7', '1234', 'aluno', '983445');

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresa`
--

CREATE TABLE `empresa` (
  `cnpj` char(14) NOT NULL,
  `telefone` varchar(16) DEFAULT NULL,
  `nome_empresa` varchar(30) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `senha` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `falta`
--

CREATE TABLE `falta` (
  `data_envio` char(10) NOT NULL,
  `observacao` varchar(11) DEFAULT NULL,
  `justificativa` varchar(40) DEFAULT NULL,
  `matricula` char(10) NOT NULL,
  `id_falta` int(50) NOT NULL primary key
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `falta`
--

INSERT INTO `falta` (`data_envio`, `observacao`, `justificativa`, `matricula`, `id_falta`) VALUES
('13-05-2024', 'estava com ', '1 dia ou mais', '6786876', 7870);

-- --------------------------------------------------------

--
-- Estrutura para tabela `solicitacao`
--

CREATE TABLE `solicitacao` (
  `id` int(8) NOT NULL,
  `matricula` char(10) DEFAULT NULL,
  `pedido` varchar(20) DEFAULT NULL,
  `status_pedido` varchar(20) DEFAULT NULL,
  `descricao` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `solicitacao`
--

INSERT INTO `solicitacao` (`id`, `matricula`, `pedido`, `status_pedido`, `descricao`) VALUES
(1, '6786876', 'carta para estagio o', 'Pagamento Pendente', 'para o meu estagio');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_user` int(5) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `adm` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_user`, `senha`, `nome`, `adm`) VALUES
(6, '1234', 'Kevin', 'kevin@gmail.com');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`matricula`);

--
-- Índices de tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`cnpj`);

--
-- Índices de tabela `falta`
--
ALTER TABLE `falta`
  ADD PRIMARY KEY (`id_falta`);

--
-- Índices de tabela `solicitacao`
--
ALTER TABLE `solicitacao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`adm`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `solicitacao`
--
ALTER TABLE `solicitacao`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
