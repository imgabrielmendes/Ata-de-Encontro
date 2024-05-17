-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Maio-2024 às 19:20
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `atareu`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `assunto`
--

CREATE TABLE `assunto` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `data_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tema` varchar(255) NOT NULL,
  `data_solicitada` datetime DEFAULT NULL,
  `objetivo` varchar(25) NOT NULL,
  `hora_inicial` time DEFAULT NULL,
  `hora_termino` time DEFAULT NULL,
  `tempo_estimado` int(10) DEFAULT NULL,
  `local` varchar(25) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `assunto`
--

INSERT INTO `assunto` (`id`, `data_registro`, `tema`, `data_solicitada`, `objetivo`, `hora_inicial`, `hora_termino`, `tempo_estimado`, `local`, `status`) VALUES
(631, '2024-05-17 11:43:34', 'Teste final de T.I', '2024-05-17 11:00:00', 'Reunião', '11:00:00', '12:00:00', NULL, 'Unidade de Terapia Intens', 'FECHADA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ata_has_fac`
--

CREATE TABLE `ata_has_fac` (
  `id` int(11) NOT NULL,
  `id_ata` int(11) DEFAULT NULL,
  `facilitadores` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `ata_has_fac`
--

INSERT INTO `ata_has_fac` (`id`, `id_ata`, `facilitadores`) VALUES
(172, 631, 6),
(173, 631, 14);

-- --------------------------------------------------------

--
-- Estrutura da tabela `deliberacoes`
--

CREATE TABLE `deliberacoes` (
  `id` int(11) NOT NULL COMMENT 'PRIMARY KEY',
  `id_ata` int(11) NOT NULL,
  `deliberadores` int(11) DEFAULT NULL,
  `deliberacoes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `deliberacoes`
--

INSERT INTO `deliberacoes` (`id`, `id_ata`, `deliberadores`, `deliberacoes`) VALUES
(527, 631, 6, 'Faça aquilo'),
(528, 631, 13, 'Faça aquilo'),
(529, 631, 6, 'fgdgfdgfdgfd'),
(530, 631, 9, 'sfdfsdfdfsdfsd'),
(531, 631, 15, 'sdfsfsdfdsfsd'),
(532, 631, 6, 'dsfdfsdfsdfsdfs'),
(533, 631, 6, 'adsadsadsadsadsa'),
(534, 631, 6, 'adsadsadsadsadsa'),
(535, 631, 13, 'adsadsadsadsadsa'),
(536, 631, 15, 'fghfghfghgfhgf'),
(537, 631, 11, 'fghfghfghgfhgf'),
(538, 631, 15, 'fdsfdsfsdfsdfsdf'),
(539, 631, 15, 'fghfhfhfghfghgfhg'),
(540, 631, 13, 'fghfhfhfghfghgfhg'),
(541, 631, 15, 'fdsffsdfdsfsdfsd'),
(542, 631, 15, 'dfsfsdfdsfsdfsdfsd'),
(543, 631, 6, 'gdfdgfgfgfdgfd'),
(544, 631, 6, 'fdsfdsfsdfsdfsd'),
(545, 631, 6, 'adfdsfsdfsdfsdfsd'),
(546, 631, 15, 'dadsadsadas'),
(547, 631, 6, 'sdfdsfsdfdsfds'),
(548, 631, 15, 'ffghfghfghfghfghfg'),
(549, 631, 15, 'fjhjghjghjghjhg'),
(550, 631, 6, 'sfsdsdfsfsdfsd'),
(551, 631, 6, 'fdsfsdfdsfsds'),
(552, 631, 15, 'fdgdgfdgfdgdfg'),
(553, 631, 6, 'dasdasasdsadsa'),
(554, 631, 13, 'gdfgfdgdgfd'),
(555, 631, 6, 'dsadsadsadasdsa'),
(556, 631, 6, 'dsadsadsadasdsa'),
(557, 631, 6, 'dsadsadsadasdsa'),
(558, 631, 6, 'dsadsadsadasdsa'),
(559, 631, 15, 'dggfdgfdgfdgfdgfd'),
(560, 631, 15, 'adsadasdsadsa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `facilitadores`
--

CREATE TABLE `facilitadores` (
  `id` int(25) NOT NULL,
  `matricula` int(10) DEFAULT NULL,
  `nome_facilitador` varchar(50) NOT NULL,
  `email_facilitador` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `facilitadores`
--

INSERT INTO `facilitadores` (`id`, `matricula`, `nome_facilitador`, `email_facilitador`) VALUES
(3, 1234, 'Leonard B.', 'joao@example.com'),
(4, 5678, 'João Thiago', 'maria@example.com'),
(5, 9012, 'Pedro Santos', 'pedro@example.com'),
(6, 3456, 'Ana Souza', 'ana@example.com'),
(7, 7890, 'Lucas Pereira', 'lucas@example.com'),
(8, 2345, 'Juliana Lima', 'juliana@example.com'),
(9, 6789, 'Fernanda Costa', 'fernanda@example.com'),
(10, 8901, 'Marcos Vieira', 'marcos@example.com'),
(11, 4321, 'Carla Martins', 'carla@example.com'),
(12, 9876, 'Rodrigo Almeida', 'rodrigo@example.com'),
(13, 6543, 'Camila Santos', 'camila@example.com'),
(14, 3210, 'Gustavo Oliveira', 'gustavo@example.com'),
(15, 8765, 'Amanda Silva', 'amanda@example.com'),
(16, 1098, 'Felipe Rodrigues', 'felipe@example.com'),
(17, 5432, 'Laura Costa', 'laura@example.com'),
(21, 6617, 'Gabriel Gomes Mendes de Souza', 'ggomesmendes2004@gmail.com'),
(22, 6617, 'Gomes Mendes', 'ggomesmendes2004@gmail.com'),
(23, 1141, 'GAGOGAGO', 'ggomesmendes2004@gmail.com'),
(24, 4334, 'Gabriel Gomes Mendes de Souza', 'ggomesmendes2004@gmail.com'),
(25, 4, 'Gabriel Gomes Mendes de Souza', 'ggomesmendes2004@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `locais`
--

CREATE TABLE `locais` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `locais` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `locais`
--

INSERT INTO `locais` (`id`, `locais`) VALUES
(4, 'Ala 1 - Clínica Médica'),
(5, 'Ala 2 - Cirurgia Geral'),
(6, 'Ala 3 - Pediatria'),
(7, 'Unidade de Terapia Intensiva (UTI)'),
(8, 'Centro Cirúrgico'),
(9, 'Laboratório de Análises Clínicas'),
(10, 'Sala de Emergência'),
(11, 'Unidade de Radiologia'),
(12, 'Sala de Fisioterapia'),
(13, 'Ambulatório de Especialidades');

-- --------------------------------------------------------

--
-- Estrutura da tabela `participantes`
--

CREATE TABLE `participantes` (
  `id` int(11) NOT NULL COMMENT 'PRIMARY KEY',
  `id_ata` int(11) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `participantes` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `participantes`
--

INSERT INTO `participantes` (`id`, `id_ata`, `data_registro`, `participantes`) VALUES
(324, 631, '2024-05-17 11:43:04', 13),
(325, 631, '2024-05-17 11:43:04', 11),
(326, 631, '2024-05-17 11:43:04', 24),
(327, 631, '2024-05-17 14:01:37', 13),
(328, 631, '2024-05-17 14:01:37', 16);

-- --------------------------------------------------------

--
-- Estrutura da tabela `textoprinc`
--

CREATE TABLE `textoprinc` (
  `id` int(11) NOT NULL,
  `id_ata` int(11) NOT NULL,
  `texto_princ` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `textoprinc`
--

INSERT INTO `textoprinc` (`id`, `id_ata`, `texto_princ`) VALUES
(34, 631, 'AIN'),
(35, 631, 'fsfsdfsdfdsfsd'),
(36, 631, 'dasdsadasdasdsadsa');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `assunto`
--
ALTER TABLE `assunto`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ata_has_fac`
--
ALTER TABLE `ata_has_fac`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ata` (`id_ata`);

--
-- Índices para tabela `deliberacoes`
--
ALTER TABLE `deliberacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ata` (`id_ata`);

--
-- Índices para tabela `facilitadores`
--
ALTER TABLE `facilitadores`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `locais`
--
ALTER TABLE `locais`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `participantes`
--
ALTER TABLE `participantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ata` (`id_ata`);

--
-- Índices para tabela `textoprinc`
--
ALTER TABLE `textoprinc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ata` (`id_ata`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `assunto`
--
ALTER TABLE `assunto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=632;

--
-- AUTO_INCREMENT de tabela `ata_has_fac`
--
ALTER TABLE `ata_has_fac`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT de tabela `deliberacoes`
--
ALTER TABLE `deliberacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY KEY', AUTO_INCREMENT=561;

--
-- AUTO_INCREMENT de tabela `facilitadores`
--
ALTER TABLE `facilitadores`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `locais`
--
ALTER TABLE `locais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `participantes`
--
ALTER TABLE `participantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY KEY', AUTO_INCREMENT=329;

--
-- AUTO_INCREMENT de tabela `textoprinc`
--
ALTER TABLE `textoprinc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `ata_has_fac`
--
ALTER TABLE `ata_has_fac`
  ADD CONSTRAINT `ata_has_fac_ibfk_1` FOREIGN KEY (`id_ata`) REFERENCES `assunto` (`id`);

--
-- Limitadores para a tabela `deliberacoes`
--
ALTER TABLE `deliberacoes`
  ADD CONSTRAINT `deliberacoes_ibfk_1` FOREIGN KEY (`id_ata`) REFERENCES `assunto` (`id`);

--
-- Limitadores para a tabela `participantes`
--
ALTER TABLE `participantes`
  ADD CONSTRAINT `participantes_ibfk_1` FOREIGN KEY (`id_ata`) REFERENCES `assunto` (`id`);

--
-- Limitadores para a tabela `textoprinc`
--
ALTER TABLE `textoprinc`
  ADD CONSTRAINT `textoprinc_ibfk_1` FOREIGN KEY (`id_ata`) REFERENCES `assunto` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
