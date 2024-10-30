-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 30-Out-2024 às 17:42
-- Versão do servidor: 5.6.20-log
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tmtab`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `atletas`
--

CREATE TABLE IF NOT EXISTS `atletas` (
`id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sobrenome` varchar(255) NOT NULL,
  `genero` varchar(255) NOT NULL,
  `idade` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `evento` varchar(255) NOT NULL,
  `assoc` varchar(255) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=237 ;

--
-- Extraindo dados da tabela `atletas`
--

INSERT INTO `atletas` (`id`, `nome`, `sobrenome`, `genero`, `idade`, `categoria`, `evento`, `assoc`) VALUES
(236, 'Yasmin', 'Marasquin', 'FEMININO', 11, '25', 'JENZINHO', 'Rosa Maria - Escola Municipal Professora Rosa Maria Xavier de\r\nAraújo'),
(235, 'Patricia', 'da Rosa', 'FEMININO', 11, '25', 'JENZINHO', 'Rosa Maria - Escola Municipal Professora Rosa Maria Xavier de\r\nAraújo'),
(234, 'Laura', 'Borges', 'FEMININO', 11, '25', 'JENZINHO', 'Elsir Bernadete Gaya Muller - Escola Municipal Professora Elsir\r\nBernadete Gaya Muller'),
(233, 'Eduarda', 'da Rosa', 'FEMININO', 11, '25', 'JENZINHO', 'Rosa Maria - Escola Municipal Professora Rosa Maria Xavier de\r\nAraújo'),
(232, 'Damylle', 'Isabela', 'FEMININO', 11, '25', 'JENZINHO', 'Caic - C.e.m Profª Maria de Lourdes Couto Cabral'),
(231, 'Agatha', 'Beatriz', 'FEMININO', 11, '25', 'JENZINHO', 'Caic - C.e.m Profª Maria de Lourdes Couto Cabral'),
(230, 'Yrllan', 'Vitor', 'MASCULINO', 11, '24', 'JENZINHO', 'Caic - C.e.m Profª Maria de Lourdes Couto Cabral'),
(229, 'Yahir', 'Alexander', 'MASCULINO', 11, '24', 'JENZINHO', 'Rosa Maria - E.m. Rosa Maria Xavier de Araújo'),
(228, 'Renzo', 'Farahd', 'MASCULINO', 11, '24', 'JENZINHO', 'Caic - C.e.m Profª Maria de Lourdes Couto Cabral'),
(227, 'Pedro', 'Henrique', 'MASCULINO', 11, '24', 'JENZINHO', 'Centro Educacional Municipal Profª Leonora Schmitz'),
(226, 'Pedro', 'Godinho', 'MASCULINO', 11, '24', 'JENZINHO', 'Rosa Maria - E.m. Rosa Maria Xavier de Araújo'),
(225, 'Miguel ', 'Alexandre', 'MASCULINO', 11, '24', 'JENZINHO', ' Rosa Maria - E.m. Rosa Maria Xavier de Araújo'),
(224, 'Micael ', 'Morsch', 'MASCULINO', 11, '24', 'JENZINHO', 'Colégio Confepi - Colégio de Navegantes Ferreira Piske'),
(223, 'Lucas ', 'Katsu', 'MASCULINO', 11, '24', 'JENZINHO', 'Eni Erna Gaya - Escola Municipal Prof Eni Erna Gaya'),
(222, 'Joao ', 'Victor', 'MASCULINO', 11, '24', 'JENZINHO', 'Colégio Confepi - Colégio de Navegantes Ferreira Piske'),
(221, 'Henzo ', 'Gabriel ', 'MASCULINO', 11, '24', 'JENZINHO', 'Caic - C.e.m Profª Maria de Lourdes Couto Cabral'),
(220, 'Gustavo', 'dos Santos', 'MASCULINO', 11, '24', 'JENZINHO', 'Neusa - Escola Municipal Professora Neusa Maria Rebello Vieira'),
(219, 'Gabriel', 'Sebastiao', 'MASCULINO', 11, '24', 'JENZINHO', 'Neusa - Escola Municipal Professora Neusa Maria Rebello Vieira'),
(218, 'Davi', 'Cardoso', 'MASCULINO', 11, '24', 'JENZINHO', 'Colégio Confepi - Colégio de Navegantes Ferreira Piske'),
(217, 'Dawid ', 'Adonai', 'MASCULINO', 11, '24', 'JENZINHO', 'Elsir Bernadete Gaya Muller - Escola Municipal Professora Elsir\r\nBernadete Gaya Muller'),
(216, 'Cristian ', 'Ronaldo', 'MASCULINO', 11, '24', 'JENZINHO', 'Eni Erna Gaya - Escola Municipal Prof Eni Erna Gaya'),
(215, 'Caio ', 'Kreff', 'MASCULINO', 11, '24', 'JENZINHO', 'Elsir Bernadete Gaya Muller - Escola Municipal Professora Elsir\r\nBernadete Gaya Muller'),
(214, 'Arthur', 'Felipe', 'MASCULINO', 11, '24', 'JENZINHO', 'Centro Educacional Municipal Profª Leonora Schmitz'),
(213, 'Adryan', 'Lucca', 'MASCULINO', 11, '24', 'JENZINHO', 'Eni Erna Gaya - Escola Municipal Prof Eni Erna Gaya');

-- --------------------------------------------------------

--
-- Estrutura da tabela `calc`
--

CREATE TABLE IF NOT EXISTS `calc` (
`id` int(11) NOT NULL,
  `tab` int(11) NOT NULL,
  `tabrest` int(11) NOT NULL DEFAULT '0',
  `ats` int(11) NOT NULL,
  `ultitab` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=595 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
`id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `naipe` varchar(255) NOT NULL,
  `inscritos` int(11) NOT NULL DEFAULT '0',
  `evento` varchar(255) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `naipe`, `inscritos`, `evento`) VALUES
(24, '10 e 11 ANOS - MASC', 'MASCULINHO', 18, '17'),
(25, '10 e 11 ANOS - FEM ', 'FEMININO', 6, '17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `eliminatorias`
--

CREATE TABLE IF NOT EXISTS `eliminatorias` (
`id` int(11) NOT NULL,
  `idjogador` int(11) NOT NULL,
  `lugarg` int(11) NOT NULL,
  `numgp` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `evento` varchar(255) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=102 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

CREATE TABLE IF NOT EXISTS `eventos` (
`id` int(11) NOT NULL,
  `nome_evento` varchar(255) DEFAULT NULL,
  `inscritos` int(11) NOT NULL DEFAULT '0',
  `datainic` date DEFAULT NULL,
  `datafim` date DEFAULT NULL,
  `iniciado` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Extraindo dados da tabela `eventos`
--

INSERT INTO `eventos` (`id`, `nome_evento`, `inscritos`, `datainic`, `datafim`, `iniciado`) VALUES
(17, 'JENZINHO', 24, '2024-10-25', '2024-10-25', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupos`
--

CREATE TABLE IF NOT EXISTS `grupos` (
`id` int(11) NOT NULL,
  `numgp` int(11) NOT NULL DEFAULT '0',
  `pessoa1` varchar(255) NOT NULL,
  `pessoa2` varchar(255) NOT NULL,
  `pessoa3` varchar(255) NOT NULL,
  `pessoa4` varchar(255) NOT NULL,
  `evento` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1156 ;

--
-- Extraindo dados da tabela `grupos`
--

INSERT INTO `grupos` (`id`, `numgp`, `pessoa1`, `pessoa2`, `pessoa3`, `pessoa4`, `evento`, `categoria`, `status`) VALUES
(1155, 6, '214', '215', '216', '', 'JENZINHO', '24', 0),
(1154, 5, '223', '222', '224', '', 'JENZINHO', '24', 0),
(1153, 4, '221', '220', '213', '', 'JENZINHO', '24', 0),
(1152, 3, '227', '229', '226', '', 'JENZINHO', '24', 0),
(1151, 2, '219', '230', '218', '', 'JENZINHO', '24', 0),
(1150, 1, '228', '217', '225', '', 'JENZINHO', '24', 0),
(1149, 2, '234', '233', '236', '', 'JENZINHO', '25', 0),
(1148, 1, '235', '231', '232', '', 'JENZINHO', '25', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atletas`
--
ALTER TABLE `atletas`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calc`
--
ALTER TABLE `calc`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eliminatorias`
--
ALTER TABLE `eliminatorias`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventos`
--
ALTER TABLE `eventos`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grupos`
--
ALTER TABLE `grupos`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atletas`
--
ALTER TABLE `atletas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=237;
--
-- AUTO_INCREMENT for table `calc`
--
ALTER TABLE `calc`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=595;
--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `eliminatorias`
--
ALTER TABLE `eliminatorias`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `eventos`
--
ALTER TABLE `eventos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `grupos`
--
ALTER TABLE `grupos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1156;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
