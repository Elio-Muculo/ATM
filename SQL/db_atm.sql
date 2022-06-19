-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Maio-2022 às 12:49
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_atm`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `credelec`
--

CREATE TABLE `credelec` (
  `id` int(11) NOT NULL,
  `codigo_recarga` varchar(20) DEFAULT NULL,
  `data_compra` datetime DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `credelec`
--

INSERT INTO `credelec` (`id`, `codigo_recarga`, `data_compra`, `id_cliente`) VALUES
(1, '1071\n6961\n3003\n18392', '2022-05-13 14:55:26', 1),
(2, '4975\n6516\n9518\n50456', '2022-05-13 14:56:05', 1),
(3, '6232\n0651\n4100\n43790', '2022-05-13 14:57:25', 1),
(4, '0220\n4578\n0139\n54104', '2022-05-14 01:14:41', 1);

--
-- Acionadores `credelec`
--
DELIMITER $$
CREATE TRIGGER `recarga_credelec` AFTER INSERT ON `credelec` FOR EACH ROW INSERT into movimento (movimento, data_movimento) VALUES ("compra credelec", NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `credito`
--

CREATE TABLE `credito` (
  `id` int(11) NOT NULL,
  `recarga` varchar(20) DEFAULT NULL,
  `data_recarga` datetime DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `credito`
--

INSERT INTO `credito` (`id`, `recarga`, `data_recarga`, `id_cliente`) VALUES
(1, '3306\n8761\n8793\n32777', '2022-05-13 00:00:00', 1),
(2, '1883\n9893\n1308\n11826', '2022-05-13 15:08:09', 1),
(3, '8495\n5299\n3206\n29447', '2022-05-14 01:17:59', 1),
(10, 'recarga', '2022-05-14 20:08:26', 1),
(11, 'recarga', '2022-05-14 20:09:39', 1),
(12, 'credelec', '2022-05-14 20:19:18', 1),
(13, 'levantamento', '2022-05-14 20:57:36', 1),
(14, 'levantamento', '2022-05-14 20:57:57', 1),
(15, 'recarga', '2022-05-14 21:03:38', 1),
(16, 'credelec', '2022-05-14 21:29:52', 1),
(17, 'recarga', '2022-05-14 21:37:13', 1),
(18, 'recarga', '2022-05-14 21:37:49', 1),
(19, 'levantamento', '2022-05-14 21:49:51', 1),
(20, 'levantamento', '2022-05-17 12:28:34', 1),
(21, 'levantamento', '2022-05-17 12:28:48', 1),
(22, 'levantamento', '2022-05-17 17:30:26', 1),
(23, 'recarga', '2022-05-17 23:14:14', 1),
(24, 'recarga', '2022-05-18 15:58:39', 1),
(25, 'recarga', '2022-05-18 21:38:28', 1),
(26, 'recarga', '2022-05-18 21:52:33', 1),
(27, 'recarga', '2022-05-18 22:06:35', 1),
(28, 'recarga', '2022-05-18 22:07:06', 1),
(29, 'recarga', '2022-05-18 22:08:49', 1),
(41, 'recarga', '2022-05-18 22:09:48', 1),
(42, 'recarga', '2022-05-18 22:50:56', 1),
(43, 'recarga', '2022-05-18 23:28:08', 1),
(44, 'credelec', '2022-05-18 23:53:42', 1),
(45, 'credelec', '2022-05-18 23:55:30', 1),
(46, 'levantamento', '2022-05-19 00:31:40', 1),
(47, 'levantamento', '2022-05-19 00:33:10', 1),
(48, 'levantamento', '2022-05-19 09:09:59', 12),
(49, 'levantamento', '2022-05-19 13:51:23', 12),
(50, 'recarga', '2022-05-20 07:56:01', 12),
(51, 'credelec', '2022-05-20 11:47:10', 12),
(52, 'recarga', '2022-05-20 11:48:04', 12),
(53, 'levantamento', '2022-05-20 11:48:35', 12),
(54, 'levantamento', '2022-05-20 12:36:20', 1),
(55, 'levantamento', '2022-05-20 12:36:29', 1),
(56, 'recarga', '2022-05-20 12:36:58', 1),
(57, 'levantamento', '2022-05-20 12:37:31', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `levantamento`
--

CREATE TABLE `levantamento` (
  `id` int(11) NOT NULL,
  `valor` double DEFAULT NULL,
  `data_levantamento` date DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `movimento`
--

CREATE TABLE `movimento` (
  `id` int(11) NOT NULL,
  `tipo_operacao` varchar(100) NOT NULL,
  `valor` int(100) NOT NULL,
  `data_movimento` datetime NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `movimento`
--

INSERT INTO `movimento` (`id`, `tipo_operacao`, `valor`, `data_movimento`, `id_cliente`) VALUES
(1, 'recarga', 50, '2022-05-14 20:08:26', 1),
(2, 'recarga', 200, '2022-05-14 20:09:39', 1),
(3, 'credelec', 652, '2022-05-14 20:19:18', 1),
(4, 'levantamento', 210, '2022-05-14 20:57:36', 1),
(5, 'levantamento', 360, '2022-05-14 20:57:57', 1),
(6, 'recarga', 200, '2022-05-14 21:03:38', 1),
(7, 'credelec', 1010, '2022-05-14 21:29:52', 1),
(8, 'recarga', 210, '2022-05-14 21:37:13', 1),
(9, 'recarga', 210, '2022-05-14 21:37:49', 1),
(10, 'levantamento', 210, '2022-05-14 21:49:51', 1),
(11, 'levantamento', 110, '2022-05-17 12:28:34', 1),
(12, 'levantamento', 560, '2022-05-17 12:28:48', 1),
(13, 'levantamento', 210, '2022-05-17 17:30:26', 1),
(14, 'recarga', 30, '2022-05-17 23:14:14', 1),
(15, 'recarga', 20, '2022-05-18 15:58:39', 1),
(16, 'recarga', 30, '2022-05-18 21:38:28', 1),
(19, 'recarga', 110, '2022-05-18 21:52:33', 1),
(24, 'recarga', 20, '2022-05-18 22:06:35', 1),
(25, 'recarga', 20, '2022-05-18 22:07:06', 1),
(26, 'recarga', 30, '2022-05-18 22:08:49', 1),
(27, 'recarga', 110, '2022-05-18 22:09:48', 1),
(28, 'recarga', 200, '2022-05-18 22:50:56', 1),
(29, 'recarga', 200, '2022-05-18 23:28:08', 1),
(30, 'credelec', 200, '2022-05-18 23:53:42', 1),
(31, 'credelec', 250, '2022-05-18 23:55:30', 1),
(32, 'levantamento', 380, '2022-05-19 00:31:40', 1),
(33, 'levantamento', 100, '2022-05-19 00:33:10', 1),
(34, 'levantamento', 2000, '2022-05-19 09:09:59', 12),
(35, 'levantamento', 109, '2022-05-19 13:51:23', 12),
(36, 'recarga', 50, '2022-05-20 07:56:01', 12),
(37, 'credelec', 120, '2022-05-20 11:47:10', 12),
(38, 'recarga', 20, '2022-05-20 11:48:04', 12),
(39, 'levantamento', 100, '2022-05-20 11:48:35', 12),
(40, 'levantamento', 100, '2022-05-20 12:36:20', 1),
(41, 'levantamento', 40, '2022-05-20 12:36:29', 1),
(42, 'recarga', 20, '2022-05-20 12:36:58', 1),
(43, 'levantamento', 100, '2022-05-20 12:37:31', 1);

--
-- Acionadores `movimento`
--
DELIMITER $$
CREATE TRIGGER `credito_trigger` AFTER INSERT ON `movimento` FOR EACH ROW INSERT into 
credito (recarga, data_recarga, id_cliente) SELECT tipo_operacao, data_movimento, id_cliente FROM movimento ORDER BY id DESC LIMIT 1
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `saldo`
--

CREATE TABLE `saldo` (
  `id` int(11) NOT NULL,
  `saldo` varchar(100) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `saldo`
--

INSERT INTO `saldo` (`id`, `saldo`, `id_cliente`) VALUES
(3, '4590', 1),
(4, '10000', 17),
(5, '7541', 12),
(6, '10000', 18),
(7, '10000', 19),
(8, '10000', 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `numero_conta` int(11) NOT NULL,
  `user` varchar(100) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT 1,
  `tentativas` int(11) NOT NULL DEFAULT 0,
  `data_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `numero_conta`, `user`, `senha`, `estado`, `tentativas`, `data_login`) VALUES
(1, 8725614, 'elio Paulo Muculo', '$2y$10$7ffXwldRS.WnFtD2hgvtNOTbq0PZwshS4hxVcSWQPhtKOltjd7/oi', 1, 1, '2022-05-05 23:01:27'),
(12, 1234, 'Muculo Dark', '$2y$10$ZA.PrxdD8B.RzhT0VtqNUOL8W/OBtSQNy1GQAo6rgxmjJo65y5c.6', 0, 2, '2022-05-19 00:48:58'),
(13, 7177140, 'Muculo Dark', '$2y$10$GtQhdQqf.q6ElY4GGqyI1eupNPi62E0mom0WMThVXk37iyvyrMudi', 1, 0, '2022-05-19 09:01:21'),
(14, 6887147, 'Muculo Dark', '$2y$10$/21KgDJ.DBkrZQ5vakqV6.kYylZEEW9b6EUNUdiCfxUO5HTQZxnjK', 1, 0, '2022-05-19 09:03:32'),
(15, 9360042, 'Muculo Dark', '$2y$10$hIlqcjHcveK6fZxwME7ic.kkJlCpylqrZhwKSfjJmaB3az.BA9tEy', 1, 0, '2022-05-19 09:04:08'),
(17, 3690065, 'Muculo Dark', '$2y$10$XflvsnugovJVLIP1jGgR9.xJRg5mGwKNc1oQaZw.ZBEYPDQGYHfM.', 1, 0, '2022-05-19 09:05:39'),
(18, 8431202, 'Lucas', '$2y$10$DAfOi6mCHg5c.fVpz/KSQe7bMGtoko7/lKFdWWYWww2Ia4yBLjrpO', 1, 0, '2022-05-20 08:09:48'),
(19, 8244324, 'Lucas', '$2y$10$rp9Mtqj3zch2vilZAKT39uBIurAw5C/y8exfJ9oyqEfMRWrLy9b7e', 1, 0, '2022-05-20 08:12:32'),
(20, 4351964, 'Lucas', '$2y$10$tFjzml5llgvU1IO2vbUSkOMp52bNNffou8iQODBZPJ0jpYZFzx05a', 1, 0, '2022-05-20 08:15:10');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `credelec`
--
ALTER TABLE `credelec`
  ADD PRIMARY KEY (`id`),
  ADD KEY `credelec_ibfk_1` (`id_cliente`);

--
-- Índices para tabela `credito`
--
ALTER TABLE `credito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `credito_ibfk_1` (`id_cliente`);

--
-- Índices para tabela `levantamento`
--
ALTER TABLE `levantamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Índices para tabela `movimento`
--
ALTER TABLE `movimento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Índices para tabela `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `credelec`
--
ALTER TABLE `credelec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `credito`
--
ALTER TABLE `credito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de tabela `levantamento`
--
ALTER TABLE `levantamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `movimento`
--
ALTER TABLE `movimento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de tabela `saldo`
--
ALTER TABLE `saldo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `credelec`
--
ALTER TABLE `credelec`
  ADD CONSTRAINT `credelec_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `usuario` (`id`);

--
-- Limitadores para a tabela `credito`
--
ALTER TABLE `credito`
  ADD CONSTRAINT `credito_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `usuario` (`id`);

--
-- Limitadores para a tabela `levantamento`
--
ALTER TABLE `levantamento`
  ADD CONSTRAINT `levantamento_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `usuario` (`id`);

--
-- Limitadores para a tabela `movimento`
--
ALTER TABLE `movimento`
  ADD CONSTRAINT `movimento_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `usuario` (`id`);

--
-- Limitadores para a tabela `saldo`
--
ALTER TABLE `saldo`
  ADD CONSTRAINT `saldo_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
