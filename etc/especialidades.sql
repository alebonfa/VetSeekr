-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 
-- Versão do Servidor: 5.5.27
-- Versão do PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `abvet`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `especialidades`
--

CREATE TABLE IF NOT EXISTS `especialidades` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) DEFAULT NULL,
  `descricao` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Extraindo dados da tabela `especialidades`
--

INSERT INTO `especialidades` (`id`, `nome`, `descricao`) VALUES
(1, 'Acupuntura Veterinária', ''),
(2, 'Anestesiologia Veterinária', ''),
(3, 'Bem-Estar e Comportamento Animal', ''),
(4, 'Clínica e Técnica Cirúrgica', ''),
(5, 'Clínica Médica de Grandes Animais', ''),
(6, 'Clínica Médica de Pequenos Animais', ''),
(7, 'Ecologia e Gestão Ambiental', ''),
(8, 'Economia Rural e Gestão do Agronegócio', ''),
(9, 'Farmacologia e Terapêutica Veterinária', ''),
(10, 'Fisiologia e Endocrinologia Veterinária', ''),
(11, 'Genética e Melhoramento Animal', ''),
(12, 'Homeopatia Veterinária', ''),
(13, 'Inspeção Higiênica, Sanitária e Tecnológica de Produtos de O', ''),
(14, 'Medicina e Produção de Animais Aquáticos', ''),
(15, 'Medicina e Produção de Animais de Laboratórios', ''),
(16, 'Medicina e Produção de Animais Silvestres', ''),
(17, 'Medicina Veterinária Intensiva', ''),
(18, 'Medicina Veterinária Legal', ''),
(19, 'Medicina Veterinária Preventiva', ''),
(20, 'Microbiologia Veterinária', ''),
(21, 'Morfologia Veterinária', ''),
(22, 'Nutrição Animal', ''),
(23, 'Parasitologia Veterinária', ''),
(24, 'Patologia Clínica Veterinária', ''),
(25, 'Patologia Veterinária', ''),
(26, 'Produção Animal', ''),
(27, 'Radiologia e Diagnóstico por Imagem Veterinária', ''),
(28, 'Reprodução Animal', ''),
(29, 'Tecnologia de Produtos de Origem Animal', ''),
(30, 'Toxicologia Veterinária', ''),
(31, 'Clínica Geral', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
