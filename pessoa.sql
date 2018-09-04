-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 04-Set-2018 às 03:39
-- Versão do servidor: 10.0.34-MariaDB-0ubuntu0.16.04.1
-- PHP Version: 7.1.19-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gt4w`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `nome` text NOT NULL,
  `cpf` text NOT NULL,
  `dataNascimento` date DEFAULT NULL,
  `peso` int(11) DEFAULT NULL,
  `uf` text,
  `dataModificacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`nome`, `cpf`, `dataNascimento`, `peso`, `uf`, `dataModificacao`) VALUES
('maria', '210.254.960-78', '2018-09-12', 3, 'Roraima', '2018-09-04 03:36:52'),
('gu', '861.674.080-50', '2018-09-20', 0, 'Pernambuco', '2018-09-04 03:36:33'),
('gfff', '341.291.160-70', '2018-09-28', 0, 'Amapá', '2018-09-04 03:34:54');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
