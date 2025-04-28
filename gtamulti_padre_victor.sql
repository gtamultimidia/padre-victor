-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 28/04/2025 às 16:16
-- Versão do servidor: 5.7.23-23
-- Versão do PHP: 8.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gtamulti_padre_victor`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `login` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `senha` varchar(250) NOT NULL,
  `ativo` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `administradores`
--

INSERT INTO `administradores` (`id`, `nome`, `login`, `email`, `senha`, `ativo`) VALUES
(1, 'William Teles', 'Dougfanto', 'william@gtamultimidia.com.br', '$423537*5944*@!&2!d853d6d06b6d047aa42d6a0ac944e6a5', 1),
(2, 'Gta Multimídia', 'gta', 'webmaster@gtamultimidia.com.br', '$423537*5944*@!&2!36e2dad8c30d1d84f5c577b53415eec4', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `img` varchar(250) DEFAULT NULL,
  `titulo` varchar(200) DEFAULT NULL,
  `url` varchar(250) NOT NULL,
  `descricao` varchar(250) NOT NULL,
  `noticia` text NOT NULL,
  `keywords_google` varchar(250) NOT NULL,
  `fonte` varchar(100) DEFAULT NULL,
  `mostra_capa` varchar(1) DEFAULT 's',
  `data` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(50) DEFAULT NULL,
  `exibir_not` varchar(1) DEFAULT '',
  `ativo` int(11) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `blog`
--

INSERT INTO `blog` (`id`, `img`, `titulo`, `url`, `descricao`, `noticia`, `keywords_google`, `fonte`, `mostra_capa`, `data`, `ip`, `exibir_not`, `ativo`) VALUES
(5, 'rejuvenescer-cafe.jpg', 'Café e o seu poder de rejuvenescer', 'cafe-e-o-seu-poder-de-rejuvenescer', 'Não é de hoje que o poder rejuvenescente do café é ...', 'N&atilde;o &eacute; de hoje que o poder rejuvenescente do caf&eacute; &eacute; explorado principalmente pela ind&uacute;stria de cosm&eacute;ticos. Todo esse interesse se d&aacute; pela presen&ccedil;a de muitos componentes do grupo dos polifen&oacute;is e antioxidantes (respons&aacute;veis por atrasar o processo de envelhecimento). Al&eacute;m de ajudar na sa&uacute;de, os extratos do gr&atilde;o verde s&atilde;o os mais utilizados na produ&ccedil;&atilde;o de cremes anti-rugas.<br /><br />Caf&eacute; Padre Victor. Sua dose di&aacute;ria de sabor e sa&uacute;de.', '{\"cafe\":\"caf\\u00e9\",\"rejuvenescer\":\"rejuvenescer\",\"cosmeticos\":\"cosm\\u00e9ticos\"}', 'Café Padre Victor', 'S', '2019-04-25 03:01:50', '::1', 'S', 1),
(4, 'melhor-coador.jpg', 'Coador de Pano ou Filtro de Papel?', 'coador-de-pano-ou-filtro-de-papel', 'Além da questão nostálgica e afetiva, o aroma que fi...', 'Al&eacute;m da quest&atilde;o nost&aacute;lgica e afetiva, o aroma que fica perfumando o ambiente &eacute; uma caracter&iacute;stica comum ao m&eacute;todo do coador de pano. Isso ocorre porque o caf&eacute; fica suspenso no suporte, mantendo o cheiro caracter&iacute;stico no ambiente e se espalhando pelos c&ocirc;modos.<br />No entanto, o fator higieniza&ccedil;&atilde;o joga contra este m&eacute;todo, devido ao acumulo de res&iacute;duos que fatalmente &ldquo;contaminar&atilde;o&rdquo; o pr&oacute;ximo caf&eacute; que ali for passado.<br />Uma forma de atenuar este ponto negativo seria utilizar &aacute;gua fervida com o intuito de limpar o coador de pano.<br /><br />J&aacute; no filtro de papel, uma dica muito usada para obter um caf&eacute; de melhor qualidade &eacute; umedecer o p&oacute; com uma pequena quantia de &aacute;gua quente e aguardar cerca de 30 segundos para despejar o restante da &aacute;gua. Positivamente, o filtro de papel &eacute; de fato mais higi&ecirc;nico, no entanto, ele pode deixar um gosto de papel no caf&eacute;. <br />A dica para evitar este fato &eacute; despejar &aacute;gua quente no filtro antes de inserir o p&oacute;.<br />Apesar do filtro de papel e coador de pano apresentarem pontos negativos, ambos s&atilde;o capazes de extrair um &oacute;timo caf&eacute;.<br /><br />E voc&ecirc;, da nostalgia do coador de pano &agrave; modernidade do filtro de papel, qual a sua op&ccedil;&atilde;o favorita?<br /><br />Caf&eacute; Padre Victor. Sua dose di&aacute;ria de energia, sabor e sa&uacute;de.', '{\"coador-de-pano\":\"coador de pano\",\"filtro-de-papel\":\"filtro de papel\",\"cafe\":\"caf\\u00e9\",\"sabor\":\"sabor\"}', 'Café Padre Victor', 'S', '2019-04-25 02:59:18', '::1', 'S', 1),
(6, 'cafe-com-especiarias.jpg', 'Café com especiarias', 'cafe-com-especiarias', 'Adicionar especiarias ao café deixa tudo ainda mais saboroso. Experimente canela ou gengibre...', 'Adicionar especiarias ao caf&eacute; deixa tudo ainda mais saboroso. Experimente canela ou gengibre, que al&eacute;m de darem sabor, trazem benef&iacute;cios para a sa&uacute;de, pois s&atilde;o termog&ecirc;nicos. O gengibre pode ser ralado e acrescentado ao p&oacute; antes de filtrar o caf&eacute;.&nbsp;<br />Caf&eacute; Padre Victor, sua dose di&aacute;ria de natureza, sabor e sa&uacute;de!', '{\"cafe\":\"caf\\u00e9\",\"especiarias\":\"especiarias\",\"saboroso\":\"saboroso\",\"canela\":\"canela\",\"gengibre\":\"gengibre\",\"saude\":\"sa\\u00fade\"}', 'Café Padre Victor', 'S', '2019-07-29 14:52:10', '170.231.154.174', 'S', 1),
(7, '', 'Bolo de Café recheado', 'bolo-de-cafe-recheado', 'Que tal uma receita de Bolo de Café recheado para o café da tarde?', '<strong>Ingredientes<br /><br /></strong>\r\n<ul>\r\n<li>5 ovos<strong><br /></strong></li>\r\n<li>2 x&iacute;caras (ch&aacute;) de a&ccedil;&uacute;car</li>\r\n<li>1/3 de x&iacute;cara (ch&aacute;) de leite</li>\r\n<li>1 x&iacute;cara (ch&aacute;) de caf&eacute; coado</li>\r\n<li>1/2 x&iacute;cara (ch&aacute;) de chocolate em p&oacute;</li>\r\n<li>2 e 1/2 x&iacute;caras (ch&aacute;) de farinha de trigo</li>\r\n<li>1 colher (sopa) de fermento em p&oacute; qu&iacute;mico</li>\r\n<li>Margarina e farinha de trigo para untar e enfarinhar<br />Gr&atilde;os de caf&eacute; para decorar</li>\r\n</ul>\r\n<strong>Recheio<br /><br /></strong>\r\n<ul>\r\n<li>300g de chocolate ao leite derretido<strong><br /></strong></li>\r\n<li>1 x&iacute;cara (ch&aacute;) de Caf&eacute; Padre Victor coado</li>\r\n<li>2 colheres (sopa) de leite em p&oacute;</li>\r\n<li>1 envelope de gelatina em p&oacute; sem sabor e incolor</li>\r\n<li>1 clara em neve</li>\r\n</ul>\r\n<div style=\"text-align: justify;\"><strong>Modo de Preparo<br /><br /></strong>Bata na batedeira os ovos at&eacute; que dobrem de volume. Adicione o a&ccedil;&uacute;car, o leite, o caf&eacute;, o chocolate, a farinha e o fermento at&eacute; ficar homog&ecirc;neo.</div>\r\n<div style=\"text-align: justify;\">Despeje em uma f&ocirc;rma de 22cm de di&acirc;metro untada e enfarinhada e leve ao forno m&eacute;dio (180&ordm; C), preaquecido, por 30 minutos ou at&eacute; dourar.</div>\r\n<div style=\"text-align: justify;\">Retire, deixe esfriar e corte ao meio, na horizontal.<br /><br /></div>\r\n<div style=\"text-align: justify;\">Para o recheio, bata no liquidificador o chocolate, o caf&eacute;, o leite em p&oacute; e a gelatina preparada conforme as instru&ccedil;&otilde;es da embalagem por 1 minuto.</div>\r\n<div style=\"text-align: justify;\">Junte a clara em neve e misture delicadamente. Leve &agrave; geladeira por 30 minutos ou at&eacute; ficar levemente firme.<br /><br /></div>\r\n<div style=\"text-align: justify;\">Para a montagem, coloque uma parte do bolo em um prato, fa&ccedil;a uma camada com metade do recheio e coloque a outra parte do bolo por cima.</div>\r\n<div style=\"text-align: justify;\">Cubra todo o bolo com o recheio restante, decore com gr&atilde;os de caf&eacute; e leve &agrave; geladeira por 2 horas antes de servir.</div>\r\n<strong><br /></strong>', '{\"bolo\":\"BOLO\",\"cafe\":\"CAF\\u00c9\",\"receita\":\"RECEITA\",\"recheado\":\"RECHEADO\"}', 'Café Padre Victor', 'S', '2020-01-22 16:25:38', '170.231.152.177', 'S', 0),
(8, 'receita-bolo-de-cafe_2.jpeg', 'Bolo de Café recheado', 'bolo-de-cafe-recheado', 'Que tal uma receita de Bolo de Café recheado para o café da tarde?', '<strong>Ingredientes<br /><br /></strong>\r\n<ul>\r\n<li>5 ovos<strong><br /></strong></li>\r\n<li>2 x&iacute;caras (ch&aacute;) de a&ccedil;&uacute;car</li>\r\n<li>1/3 de x&iacute;cara (ch&aacute;) de leite</li>\r\n<li>1 x&iacute;cara (ch&aacute;) de caf&eacute; coado</li>\r\n<li>1/2 x&iacute;cara (ch&aacute;) de chocolate em p&oacute;</li>\r\n<li>2 e 1/2 x&iacute;caras (ch&aacute;) de farinha de trigo</li>\r\n<li>1 colher (sopa) de fermento em p&oacute; qu&iacute;mico</li>\r\n<li>Margarina e farinha de trigo para untar e enfarinhar<br />Gr&atilde;os de caf&eacute; para decorar</li>\r\n</ul>\r\n<strong>Recheio<br /><br /></strong>\r\n<ul>\r\n<li>300g de chocolate ao leite derretido<strong><br /></strong></li>\r\n<li>1 x&iacute;cara (ch&aacute;) de Caf&eacute; Padre Victor coado</li>\r\n<li>2 colheres (sopa) de leite em p&oacute;</li>\r\n<li>1 envelope de gelatina em p&oacute; sem sabor e incolor</li>\r\n<li>1 clara em neve</li>\r\n</ul>\r\n<div style=\"text-align: justify;\"><strong>Modo de Preparo<br /><br /></strong>Bata na batedeira os ovos at&eacute; que dobrem de volume. Adicione o a&ccedil;&uacute;car, o leite, o caf&eacute;, o chocolate, a farinha e o fermento at&eacute; ficar homog&ecirc;neo.</div>\r\n<div style=\"text-align: justify;\">Despeje em uma f&ocirc;rma de 22cm de di&acirc;metro untada e enfarinhada e leve ao forno m&eacute;dio (180&ordm; C), preaquecido, por 30 minutos ou at&eacute; dourar.</div>\r\n<div style=\"text-align: justify;\">Retire, deixe esfriar e corte ao meio, na horizontal.<br /><br /></div>\r\n<div style=\"text-align: justify;\">Para o recheio, bata no liquidificador o chocolate, o caf&eacute;, o leite em p&oacute; e a gelatina preparada conforme as instru&ccedil;&otilde;es da embalagem por 1 minuto.</div>\r\n<div style=\"text-align: justify;\">Junte a clara em neve e misture delicadamente. Leve &agrave; geladeira por 30 minutos ou at&eacute; ficar levemente firme.<br /><br /></div>\r\n<div style=\"text-align: justify;\">Para a montagem, coloque uma parte do bolo em um prato, fa&ccedil;a uma camada com metade do recheio e coloque a outra parte do bolo por cima.</div>\r\n<div style=\"text-align: justify;\">Cubra todo o bolo com o recheio restante, decore com gr&atilde;os de caf&eacute; e leve &agrave; geladeira por 2 horas antes de servir.</div>', '{\"receita\":\"RECEITA\",\"bolo\":\"BOLO\",\"cafe\":\"CAF\\u00c9\",\"recheado\":\"RECHEADO\"}', 'Café Padre Victor', 'S', '2020-01-22 16:29:43', '170.231.152.177', 'S', 1),
(9, 'Tiramisù Vegano.jpg', 'Tiramisù Vegano', 'tiramisu-vegano', 'Hoje vamos de receita especial com café no pedaço: Tiramisù Vegano, que delícia!', '<strong>Ingredientes para o Creme Branco:<br /></strong><br />\r\n<ul>\r\n<li>100g de castanha de caju crua.</li>\r\n</ul>\r\n<ul>\r\n<li>2 colheres (de sopa) de a&ccedil;&uacute;car demerara.<br /><br /></li>\r\n<li><span class=\"text_exposed_show\">4 gotas de ess&ecirc;ncia de baunilha<br />&Aacute;gua.</span></li>\r\n</ul>\r\n<br /><strong>Ingredientes para o Creme de Caf&eacute;:<br /></strong><br />\r\n<ul>\r\n<li>2 colheres (de sopa) de cacau.</li>\r\n</ul>\r\n<ul>\r\n<li>&frac12; x&iacute;cara de Caf&eacute; Padre Victor.</li>\r\n</ul>\r\n<ul>\r\n<li>100g de tofu extra firme.</li>\r\n</ul>\r\n<ul>\r\n<li>2 colheres (de sopa) de a&ccedil;&uacute;car demerara.</li>\r\n</ul>\r\n<ul>\r\n<li>50g de chocolate 70% cacau.</li>\r\n</ul>\r\n<br />\r\n<p><strong>Preparo do Creme Branco:</strong><br /><br />Bata tudo no liquidificador at&eacute; obter um creme grosso que n&atilde;o caia na colher. Leve a geladeira por 2 horas.</p>\r\n<p><strong><br />Preparo do Creme de Caf&eacute;:</strong><br /><br />Derrame o chocolate em banho-maria, depois acrescente o Caf&eacute; Padre Victor j&aacute; com a&ccedil;&uacute;car. <br /><br />Junte o cacau e o tofu, e bata tudo no liquidificar at&eacute; obter um creme firme. Leve a geladeira por 2 horas.</p>\r\n<p><strong>Montagem:</strong><br /><br />Uma camada de creme branco e outra de creme de caf&eacute;. A&iacute;, &eacute; s&oacute; decorar com gr&atilde;os de caf&eacute; e cacau em p&oacute;.</p>', '{\"tiramisu\":\"Tiramis\\u00f9\",\"vegano\":\"Vegano\",\"cafe\":\"Caf\\u00e9\",\"sobremesa\":\"Sobremesa\"}', 'Café Padre Victor', 'S', '2020-01-27 15:20:32', '170.231.152.170', 'S', 0),
(10, 'tiramisu-vegano.jpg', 'Tiramisù Vegano', 'tiramisu-vegano', 'Hoje vamos de receita especial com café no pedaço: Tiramisù Vegano, que delícia!', '<strong>Ingredientes para o Creme Branco:<br /></strong><br />\r\n<ul>\r\n<li>100g de castanha de caju crua.</li>\r\n</ul>\r\n<ul>\r\n<li>2 colheres (de sopa) de a&ccedil;&uacute;car demerara.<br /><br /></li>\r\n<li><span class=\"text_exposed_show\">4 gotas de ess&ecirc;ncia de baunilha<br />&Aacute;gua.</span></li>\r\n</ul>\r\n<br /><strong>Ingredientes para o Creme de Caf&eacute;:<br /></strong><br />\r\n<ul>\r\n<li>2 colheres (de sopa) de cacau.</li>\r\n</ul>\r\n<ul>\r\n<li>&frac12; x&iacute;cara de Caf&eacute; Padre Victor.</li>\r\n</ul>\r\n<ul>\r\n<li>100g de tofu extra firme.</li>\r\n</ul>\r\n<ul>\r\n<li>2 colheres (de sopa) de a&ccedil;&uacute;car demerara.</li>\r\n</ul>\r\n<ul>\r\n<li>50g de chocolate 70% cacau.</li>\r\n</ul>\r\n<br />\r\n<p><strong>Preparo do Creme Branco:</strong><br /><br />Bata tudo no liquidificador at&eacute; obter um creme grosso que n&atilde;o caia na colher. Leve a geladeira por 2 horas.</p>\r\n<p><strong><br />Preparo do Creme de Caf&eacute;:</strong><br /><br />Derrame o chocolate em banho-maria, depois acrescente o Caf&eacute; Padre Victor j&aacute; com a&ccedil;&uacute;car.&nbsp;<br /><br />Junte o cacau e o tofu, e bata tudo no liquidificar at&eacute; obter um creme firme. Leve a geladeira por 2 horas.</p>\r\n<p><strong>Montagem:</strong><br /><br />Uma camada de creme branco e outra de creme de caf&eacute;. A&iacute;, &eacute; s&oacute; decorar com gr&atilde;os de caf&eacute; e cacau em p&oacute;.</p>', '{\"tiramisu\":\"Tiramis\\u00f9\",\"vegano\":\"Vegano\",\"cafe\":\"Caf\\u00e9\",\"sobremesa\":\"Sobremesa\"}', 'Café Padre Victor', 'S', '2020-01-27 15:33:52', '170.231.152.170', 'S', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ebook`
--

CREATE TABLE `ebook` (
  `id` int(11) NOT NULL,
  `nome` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `empresa` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cargo` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cod_verificacao` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enviado` int(1) DEFAULT '0',
  `ativo` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `ebook`
--

INSERT INTO `ebook` (`id`, `nome`, `email`, `telefone`, `empresa`, `cargo`, `cod_verificacao`, `enviado`, `ativo`) VALUES
(4, NULL, 'willmbc84@gmail.com', NULL, NULL, NULL, '2a1fb507dcc3ffc9a7ad27a72d882684', 0, 0),
(5, NULL, 'contato@inovamarketing.net', NULL, NULL, NULL, '3e75da75bd4640272bbcaa3c4a555d89', 1, 1),
(6, NULL, 'tiaotomaz110@gmail.com', NULL, NULL, NULL, '218deb6fcce7ad84182e2b68dc5e3824', 0, 0),
(7, NULL, 'ednamariacardosopinto54@gmail.com', NULL, NULL, NULL, '1149ae8769a9ea2c3c2285b51025dca3', 0, 0),
(8, NULL, 'chramos16@gmail.com', NULL, NULL, NULL, '3ffde4d37f050799c50570eaad03d6d8', 1, 1),
(9, NULL, 'josinarciszo@hotmail.com', NULL, NULL, NULL, 'b94a8e9bcd1d3f2dca431136c0fc5d26', 0, 0),
(10, NULL, 'wellingtonmoraisjr@hotmail.com', NULL, NULL, NULL, '4c741743e3d351a88bad1414281a6535', 0, 0),
(11, NULL, 'tamyjf@hotmail.com', NULL, NULL, NULL, 'e0c0c9606976b75424e83fd89e987ddd', 1, 1),
(12, NULL, 'solangemaria.dasilvateixeira@gmsil.com', NULL, NULL, NULL, '6b1fdf45cf0891d4076f6bdf6d68d2f2', 0, 0),
(13, NULL, 'fjbaltazar@uol.com.br', NULL, NULL, NULL, '7d29012ed729428dae78cd7a52885476', 1, 1),
(14, NULL, 'fd.sanchez@uol.com.br', NULL, NULL, NULL, 'aa913e07040f21bafeb7e0a7af6fbd69', 1, 1),
(15, NULL, 'molinamartinez@uol.com.br', NULL, NULL, NULL, '0686578a6d02b5bfb93bbe8ccb1b57e0', 1, 1),
(16, NULL, 'wesleysouzassp@gmail.com', NULL, NULL, NULL, '207424c0cc477697600660cb9883b8d4', 1, 1),
(17, NULL, 'elisanitto@outlook.com', NULL, NULL, NULL, 'fe3928562c43157ed74e77a508d20781', 0, 0),
(18, NULL, 'sylmara@outlook.com', NULL, NULL, NULL, '4715e936c24788fc54feeacaf0442a7c', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `linhas`
--

CREATE TABLE `linhas` (
  `id` int(11) NOT NULL,
  `linha` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  `ativo` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `linhas`
--

INSERT INTO `linhas` (`id`, `linha`, `url`, `ativo`) VALUES
(1, 'Padre Victor', 'padre-victor', 1),
(2, 'Sorriso', 'sorriso', 1),
(3, 'Mirand\' Ouro', 'mirand-ouro', 1),
(4, 'Marca Própria', 'marca-propria', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `linha` int(11) NOT NULL,
  `texto` text NOT NULL,
  `imagem` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  `ordem` int(11) DEFAULT '0',
  `data_postagem` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ativo` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `titulo`, `linha`, `texto`, `imagem`, `url`, `ordem`, `data_postagem`, `ativo`) VALUES
(17, 'Achocolatado ', 1, '<p>P&oacute; achocolatado para preparo de bebidas com mais energia e sabor em sua vida.</p>', 'achocolatado.png', 'achocolatado', 0, '2019-04-18 15:00:00', 0),
(18, 'Café com Leite', 1, '<p>Mistura para preparo de Caf&eacute; com Leite, indispens&aacute;vel nas manh&atilde;s de quem adora este tipo de bebida e gosta de facilidade no preparo de um caf&eacute;.</p>', 'cafe-com-leite.png', 'cafe-com-leite', 0, '2019-04-18 15:00:00', 1),
(19, 'Café da Manhã', 1, '<p>Uma combina&ccedil;&atilde;o perfeita de gr&atilde;os, um ponto de torra adequado e a propor&ccedil;&atilde;o ideal de cafe&iacute;na, tornar o PADRE VICTOR CAF&Eacute; DA MANH&Atilde; um produto estimulante, energ&eacute;tico e com um aroma delicioso.</p>', 'cafe-da-manha.png', 'cafe-da-manha', 0, '2019-04-18 15:00:00', 1),
(20, 'Café Espresso Gourmet', 1, '<p>Um caf&eacute; especial, elaborado com gr&atilde;os especiais, 100% ar&aacute;bica, produzidos no Sul de Minas.</p>', 'espresso-gourmet.png', 'cafe-espresso-gourmet', 0, '2019-04-18 15:00:00', 1),
(21, 'Café Noite', 1, '<p>Teor de cafe&iacute;na moderado, controle do ponto de torra e suavidade na bebida, tornam o CAF&Eacute; PADRE VICTOR NOITE um produto leve e ideal para voc&ecirc; relaxar.</p>', 'cafe-noite.png', 'cafe-noite', 0, '2019-04-18 15:00:00', 1),
(22, 'Cappuccino Light', 1, '<p>Bebida de sabor requintado de baixas calorias que voc&ecirc; prepara em poucos segundos.</p>', 'cappuccino-light.png', 'cappuccino-light', 0, '2019-04-18 15:00:00', 1),
(23, 'Cappuccino Tradicional', 1, '<p>Bebida de sabor requintado que voc&ecirc; prepara em poucos segundos.</p>', 'cappuccino.png', 'cappuccino-tradicional', 0, '2019-04-18 15:00:00', 1),
(24, 'Chocolate em Pó (Solúvel) ', 1, '<p>P&oacute; sol&uacute;vel de chocolate para preparo de receitas deliciosas, personalizadas e com qualidade.</p>', 'chocolate-po.png', 'chocolate-em-po-soluvel', 0, '2019-04-18 15:00:00', 0),
(25, 'Coador de Café', 1, '<p>Coadores de caf&eacute; nos tamanhos grande (103) e m&eacute;dio (102).</p>', 'coadores.png', 'coador-de-cafe', 0, '2019-04-18 15:00:00', 1),
(26, 'Café Extra Forte', 1, '<p>Ponto de torra mais acentuado, para pessoas que apreciam um caf&eacute; mais forte e encorpado.</p>', 'extra-forte.png', 'cafe-extra-forte', 0, '2019-04-18 15:00:00', 1),
(27, 'Filtro de Papel', 1, '<p>Filtros de caf&eacute; nos tamanhos grande (103) e m&eacute;dio (102).</p>', 'filtros.png', 'filtro-de-papel', 0, '2019-04-18 15:00:00', 0),
(28, 'Instantâneo (Morango)', 1, '<p>P&oacute; para preparo de bebida instant&acirc;nea com sabor de morango.</p>', 'instant-morango.png', 'instantaneo-morango', 0, '2019-04-18 15:00:00', 0),
(29, 'Café Solúvel', 1, '<p>Com preparo r&aacute;pido e sabor inigual&aacute;vel, o caf&eacute; sol&uacute;vel Padre Victor n&atilde;o deixa a desejar para pessoas que n&atilde;o dispensam um bom caf&eacute; em suas vidas.</p>', 'soluvel.png', 'cafe-soluvel', 0, '2019-04-18 15:00:00', 0),
(30, 'Café Superior', 1, '<p>Um caf&eacute; especial, elaborado com gr&atilde;os superiores, 100% ar&aacute;bica, produzidos no Sul de Minas.</p>', 'superior.png', 'cafe-superior', 0, '2019-04-18 15:00:00', 1),
(31, 'Café Tradicional', 1, '<p>Ponto de torra m&eacute;dio, para pessoas que apreciam o tradicional sabor do caf&eacute;.</p>', 'tradicional.png', 'cafe-tradicional', 0, '2019-04-18 15:00:00', 1),
(32, 'Ocasiões Especiais', 1, '<p>O ponto de torra deste caf&eacute; &eacute; controlado, visando manter todas as caracter&iacute;sticas de um excelente caf&eacute;, feito para voc&ecirc; apreciar em ocasi&otilde;es especiais com a fam&iacute;lia e amigos.</p>', 'ocasioes.png', 'ocasioes-especiais', 0, '2019-04-18 15:00:00', 1),
(33, 'Achocolatado Sorriso ', 2, '<p>Um achocolatado produzido no ponto ideal, para voc&ecirc; aproveitar toda sua energia, se exercitar, praticar esportes e espalhar sorrisos por a&iacute;!</p>', 'achocolatado-sorriso.png', 'achocolatado-sorriso', 0, '2019-04-18 15:00:00', 1),
(34, 'Café Sorriso (Forte)', 2, '<p>Com um sabor forte, aroma encorpado e simplicidade no preparo, este produto &eacute; essencial nas manh&atilde;s de aficcionados por caf&eacute;.</p>', 'sorriso-forte.png', 'cafe-sorriso-forte', 0, '2019-04-18 15:00:00', 1),
(35, 'Café Sorriso (Premium)', 2, '<p>Gr&atilde;os com torra espec&iacute;fica para um excelente caf&eacute; espresso.</p>', 'sorriso-premium.png', 'cafe-sorriso-premium', 0, '2019-04-18 15:00:00', 1),
(36, 'Café Sorriso Edição Especial', 2, '<p>Produto produzido para data especiais.</p>', 'cafe-sorriso.png', 'cafe-sorriso-edicao-especial', 0, '2019-04-18 15:00:00', 1),
(37, 'Café Mirand\'Ouro Espresso', 3, '<p>Com qualidade inigual&aacute;vel, know-how acumulado durante mais de 100 anos e sabor sofisticado, o Mirand\'Ouro &eacute; um blend que re&uacute;ne os melhores gr&atilde;os produzidos nas fazendas da fam&iacute;lia Miranda, na regi&atilde;o de Tr&ecirc;s Pontas, com tradi&ccedil;&atilde;o na produ&ccedil;&atilde;o do Sul de Minas.</p>', 'mirandouro-expresso.png', 'cafe-mirand-ouro-espresso', 0, '2019-04-18 15:00:00', 1),
(38, 'Café Mirand\'Ouro Filtro', 3, '<p>Com personalidade marcante, este blend de caf&eacute; torrado e mo&iacute;do, obtido de gr&atilde;os 100% ar&aacute;bica, cultivados das fazendas da fam&iacute;lia Miranda no Sul de Minas, regi&atilde;o reconhecida internacionalmente pela produ&ccedil;&atilde;o de caf&eacute;s de qualidade, &eacute; refinado e inigual&aacute;vel. Sua torra m&eacute;dia evidencia seu aroma intenso e sabor adocicado.</p>', 'mirandouro-filtro.png', 'cafe-mirand-ouro-filtro', 0, '2019-04-18 15:00:00', 1),
(39, 'Café Aroma do Vale', 4, '<p>Sabor mais acentuado, para pessoas que apreciam um caf&eacute; mais forte e encorpado.</p>', 'aromadovale.png', 'cafe-aroma-do-vale', 0, '2019-04-18 15:00:00', 1),
(40, 'Café Girobom', 4, '<p>Recebe uma torra&ccedil;&atilde;o m&eacute;dia, sabor marcante, para pessoas que apreciam o tradicional sabor do caf&eacute;.</p>', 'girobom.png', 'cafe-girobom', 0, '2019-04-18 15:00:00', 1),
(41, 'Café Asccom', 4, '<p>Caf&eacute; de qualidade, arom&aacute;tico e saboroso, atende o gosto daqueles que apreciam um caf&eacute; mais tradicional.</p>', 'asccon.png', 'cafe-asccom', 0, '2019-04-18 15:00:00', 1),
(42, 'Café Nutri Shopping (Forte)', 4, '<p>Caf&eacute; de sabor forte e marcante, para pessoas que apreciam um caf&eacute; com sabor mais acentuado.</p>', 'nutri-shopping.png', 'cafe-nutri-shopping-forte', 0, '2019-04-18 15:00:00', 1),
(43, 'Café Purita (Extraforte)', 4, '<p>Um caf&eacute; de sabor mais acentuado, ponto de torra forte, feito para que gosta de um caf&eacute; mais encorpado.</p>', 'purita.png', 'cafe-purita-extraforte', 0, '2019-04-18 15:00:00', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `receitas`
--

CREATE TABLE `receitas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `resumo` varchar(250) NOT NULL,
  `receita` text NOT NULL,
  `imagem` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  `data_postagem` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ativo` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `receitas`
--

INSERT INTO `receitas` (`id`, `titulo`, `resumo`, `receita`, `imagem`, `url`, `data_postagem`, `ativo`) VALUES
(10, 'Batatas Gratinadas com Café', 'Receita deliciosa com café!', '<p><strong>Ingredientes:</strong></p>\r\n<p>- 1 kg de batatas cozidas em 1 colher (ch&aacute;) de margarina e sal</p>\r\n<p>- 100g de mozzarela cortada em cubos</p>\r\n<p>- 100g de presunto cortado em cubos</p>\r\n<p>- 1 cebola picada</p>\r\n<p>- 1 tomate picado</p>\r\n<p>- 1 peito de frango cozido e cortado em cubos ou desfiado</p>\r\n<p>- 1 lata de creme de leite</p>\r\n<p>- 1/3 x&iacute;cara de caf&eacute;</p>\r\n<p>- 150g de queijo ralado</p>\r\n<p>- Sal, or&eacute;gano, cheiro verde &agrave; gosto</p>\r\n<p>- 50g de azeitonas</p>\r\n<p>- 1/2 lata de milho verde</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Modo de preparo:</strong></p>\r\n<p>Coloque em um refrat&aacute;rio uma camada de batata e em outro misture o queijo, o presunto, o frango, a cebola, o tomate e os temperos.</p>\r\n<p>Em uma vasilha misture o caf&eacute;, o queijo e o creme de leite.</p>\r\n<p>Fa&ccedil;a camadas alternadas com a batata, o queijo, e por &uacute;ltimo o creme de leite.</p>\r\n<p>Leve ao forno para gratinar.</p>', 'batatas-gratinadas-com-cafe.jpg', 'batatas-gratinadas-com-cafe', '2019-04-18 14:00:00', 1),
(11, 'Milkshake de Café', 'Receita deliciosa com café!', '<p><strong>Ingredientes:</strong></p>\r\n<p>- 1 x&iacute;cara de caf&eacute; Padre Victor pronto</p>\r\n<p>- 3 bolas de sorvete de creme, bem mole</p>\r\n<p>- 3 colheres de leite condensado</p>\r\n<p>- Chantilly a gosto</p>\r\n<p>- Uma pitada de chocolate em p&oacute; ou raspas de chocolate meio amargo.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Modo de preparo:</strong></p>\r\n<p>Bata o caf&eacute;, o sorvete e o leite condensado no liquidificador.</p>\r\n<p>Logo ap&oacute;s, sirva em ta&ccedil;as bonitas, decorando com o chantily e raspas de chocolate.</p>\r\n<p>&nbsp;</p>\r\n<p>Fonte: http://tudogostoso.uol.com.br/</p>', 'milkshake-de-cafe.jpg', 'milkshake-de-cafe', '2019-04-18 14:00:00', 1),
(12, 'Torta de Chocolate com Café', 'Receita deliciosa com café!', '<p><strong>Ingredientes:</strong></p>\r\n<p>- 4 x&iacute;caras (ch&aacute;) de a&ccedil;&uacute;car</p>\r\n<p>- 4 x&iacute;caras (ch&aacute;) de farinha de trigo</p>\r\n<p>- 4 colheres (sopa) de fermento em p&oacute;</p>\r\n<p>- 12 colheres (sopa) de chocolate em p&oacute;</p>\r\n<p>- 4 ovos inteiros</p>\r\n<p>- 1 colher (sopa) de caf&eacute; sol&uacute;vel</p>\r\n<p>- 500 g de margarina</p>\r\n<p>- 700 ml de leite</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Cobertura:</strong></p>\r\n<p>- 1 lata de leite condensado</p>\r\n<p>- A mesma medida (lata) de leite integral</p>\r\n<p>- 4 colheres (sopa) de chocolate em p&oacute;</p>\r\n<p>- 1 colher (sopa) de margarina</p>\r\n<p>- 1 colher (sopa) de caf&eacute; sol&uacute;vel</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Modo de preparo:</strong></p>\r\n<p>- Misture o a&ccedil;&uacute;car, a farinha de trigo, o fermento e o chocolate</p>\r\n<p>- Reserve</p>\r\n<p>- Junte a margarina com o leite e leve ao fogo para ferver</p>\r\n<p>- Acrescente o caf&eacute;</p>\r\n<p>- Reserve</p>\r\n<p>- Acrescente os ovos inteiros, a massa de trigo e misture bem</p>\r\n<p>- Aos poucos, despeje o leite quente, batendo com a batedeira</p>\r\n<p>- Em seguida, passe toda a massa por uma peneira e divida em 2 formas untadas e enfarinhadas</p>\r\n<p>- Asse em forno brando por cerca de 40 minutos cada</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Cobertura:</strong></p>\r\n<p>- Misture todos os ingredientes e leve ao fogo, mexendo sempre</p>\r\n<p>- Quando come&ccedil;ar a engrossar, retire do fogo, bata com a batedeira, leve &agrave; geladeira por 30 minutos</p>\r\n<p>- Use como recheio e cobertura</p>\r\n<p>- Decore a seu gosto</p>\r\n<p>&nbsp;</p>\r\n<p>Fonte: http://tudogostoso.uol.com.br/</p>\r\n<p>&nbsp;</p>', 'torta-de-chocolate-com-cafe.jpg', 'torta-de-chocolate-com-cafe', '2019-04-18 14:00:00', 1),
(13, 'Pudim de Café com Calda Caramelizada', 'Receita deliciosa com café!', '<p><strong>Ingredientes:</strong></p>\r\n<p><strong>Pudim:</strong></p>\r\n<p>- 1 lata de leite condensado</p>\r\n<p>- A mesma medida de caf&eacute; coado bem forte</p>\r\n<p>- 3 ovos</p>\r\n<p>- Gr&atilde;os de caf&eacute; para decorar</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Caramelo:</strong></p>\r\n<p>- 2 x&iacute;caras de a&ccedil;&uacute;car</p>\r\n<p>- 1 x&iacute;cara de &aacute;gua&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Modo de preparo:</strong></p>\r\n<p>Bata todos os ingredientes do pudim no liquidificador por dois minutos.</p>\r\n<p>Caramelize uma forma met&aacute;lica para pudim (com buraco no meio) com o a&ccedil;&uacute;car e a &aacute;gua.</p>\r\n<p>Despeje a mistura do pudim na forma caramelizada e leve para assar em banho-maria por 45 minutos em forno a 180&ordm;C.</p>\r\n<p>Deixe esfriar, desenforme, decore com gr&atilde;os de caf&eacute; e sirva.</p>\r\n<p>Acompanha muito bem um expresso curto.</p>\r\n<p>&nbsp;</p>\r\n<p>Fonte: http://comida.ig.com.br/</p>\r\n<p>&nbsp;</p>', 'pudim-de-cafe-com-calda-caramelizada.jpg', 'pudim-de-cafe-com-calda-caramelizada', '2019-04-18 14:00:00', 1),
(14, 'Café com Creme de Laranja', 'Receita deliciosa com café!', '<p><strong>Ingredientes:</strong></p>\r\n<p>- 2/3 x&iacute;cara (ch&aacute;) de creme de leite fresco</p>\r\n<p>- 1/2 colher (ch&aacute;) de raspas de casca de laranja</p>\r\n<p>- 1 colher (sopa) de a&ccedil;&uacute;car</p>\r\n<p>- 1 x&iacute;cara (ch&aacute;) de caf&eacute; preparado quente</p>\r\n<p>- 1 colher (ch&aacute;) de raspas de chocolate meio amargo</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Modo de preparo:</strong></p>\r\n<p>Na batedeira, bata o creme de leite com as raspas de laranja e o a&ccedil;&uacute;car at&eacute; engrossar ligeiramente.</p>\r\n<p>Depois coloque metade do creme nas ta&ccedil;as e bata o restante do creme at&eacute; obter picos firmes.</p>\r\n<p>Acrescente &agrave;s ta&ccedil;as, o caf&eacute; preparado e o chocolate e finalize com o restante do creme batido em picos firmes, decorando com chocolate em p&oacute;.</p>\r\n<p>&nbsp;</p>\r\n<p>Fonte: http://receitashoje.com.br/</p>\r\n<p>&nbsp;</p>', 'cafe-com-creme-de-laranja.jpg', 'cafe-com-creme-de-laranja', '2019-04-18 14:00:00', 1),
(15, 'Bala de Café', 'Receita deliciosa com café!', '<p><strong>Ingredientes:</strong></p>\r\n<p>- 1 x&iacute;cara (ch&aacute;) de caf&eacute; pronto bem forte</p>\r\n<p>- 1 x&iacute;cara (ch&aacute;) de leite</p>\r\n<p>- 3 x&iacute;caras (ch&aacute;) de a&ccedil;&uacute;car</p>\r\n<p>- 1/2 x&iacute;cara (ch&aacute;) de mel</p>\r\n<p>- 1 gema</p>\r\n<p>- 1 colher (sopa) de farinha de trigo</p>\r\n<p>- Manteiga para untar</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Modo de preparo:</strong></p>\r\n<p>Misture em uma tigela o caf&eacute;, o leite, o a&ccedil;&uacute;car, o mel, a gema ligeiramente batida e a farinha peneirada.</p>\r\n<p>Mexa vigorosamente com uma colher de pau e transfira para uma panela.</p>\r\n<p>Leve ao fogo m&eacute;dio.</p>\r\n<p>Cozinhe sem parar de mexer com uma colher de pau at&eacute; ficar no ponto de fio grosso.</p>\r\n<p>Despeje sobre um m&aacute;rmore untado e deixe amornar um pouco.</p>\r\n<p>Com um cortador de biscoito, corte o caramelo formado e espere as balas esfriarem completamente.</p>\r\n<p>Embrulhe-as em papel pr&oacute;prio para bala ou guarde-as em um vidro fechado por at&eacute; uma semana.</p>\r\n<p>&nbsp;</p>\r\n<p>Dica: n&atilde;o deixe esfriar demais para cortar a bala. Espere apenas amornar um pouco ou ela pode ficar mais dura.</p>\r\n<p>&nbsp;</p>\r\n<p>Fonte: http://mdemulher.abril.com.br/</p>\r\n<p>&nbsp;</p>', 'bala-de-cafe.jpg', 'bala-de-cafe', '2019-04-18 14:00:00', 1),
(16, 'Mousse de Café', 'Receita deliciosa com café!', '<p><strong>Ingredientes:</strong></p>\r\n<p>- 2 colheres (sopa) de cafe sol&uacute;vel, dilu&iacute;do em 1/2 x&iacute;cara de &aacute;gua morna</p>\r\n<p>- 6 colheres (sopa) de a&ccedil;&uacute;car</p>\r\n<p>- 4 gotas de ess&ecirc;ncia de caf&eacute; ou de baunilha</p>\r\n<p>- 300 g de chocolate meio amargo</p>\r\n<p>- 1 lata de creme de leite sem soro</p>\r\n<p>- 4 claras em neve em ponto bem firme</p>\r\n<p>- Raspas de chocolates para enfeitar (opcional)&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Modo de preparo:</strong></p>\r\n<p>Derreta o chocolate em banho-maria.</p>\r\n<p>Depois de derretido, acrescente o caf&eacute; sol&uacute;vel, j&aacute; dissolvido em &aacute;gua e as gotas da ess&ecirc;ncia de sua prefer&ecirc;ncia.</p>\r\n<p>Em outra vasilha misture bem o creme de leite sem soro com o a&ccedil;&uacute;car e em seguida jogue esta mistura no chocolate derretido e mexa sem parar, at&eacute; que fique homog&ecirc;neo.</p>\r\n<p>Acrescente as claras em neve delicadamente, at&eacute; que estas se incorporem totalmente aos outros ingredientes.</p>\r\n<p>Salpique raspas de chocolate se quiser e depois deixe na geladeira de 2 a 3 horas.</p>\r\n<p>&nbsp;</p>\r\n<p>Informa&ccedil;&atilde;es Adicionais:</p>\r\n<p>Pode-se usar chocolate ao leite no lugar do chocolate meio amargo ou misturar os dois tipos, o que far&aacute; a receita ficar mais doce.</p>\r\n<p>Use o creme de leite gelado, fica mais f&aacute;cil separar o soro.</p>\r\n<p>Voc&ecirc; pode colocar a mousse em pequenas ta&ccedil;as ou em uma vasilha maior.</p>\r\n<p>Para decorar eu costumo usar alguns bombons com recheio crocante mo&iacute;dos.</p>\r\n<p>&nbsp;</p>\r\n<p>Fonte: http://tudogostoso.uol.com.br/</p>\r\n<p>&nbsp;</p>', 'mousse-de-cafe.jpg', 'mousse-de-cafe', '2019-04-18 14:00:00', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ebook`
--
ALTER TABLE `ebook`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `linhas`
--
ALTER TABLE `linhas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `receitas`
--
ALTER TABLE `receitas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `ebook`
--
ALTER TABLE `ebook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `linhas`
--
ALTER TABLE `linhas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de tabela `receitas`
--
ALTER TABLE `receitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
