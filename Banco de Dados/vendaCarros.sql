-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 17/12/2024 às 16:34
-- Versão do servidor: 8.0.40-0ubuntu0.24.04.1
-- Versão do PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `vendaCarros`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `brands`
--

CREATE TABLE `brands` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `brands`
--

INSERT INTO `brands` (`id`, `name`, `category`) VALUES
(1, 'Acura', 'car'),
(2, 'Agrale', 'car'),
(3, 'Alfa Romeo', 'car'),
(4, 'AM Gen', 'car'),
(5, 'Asia Motors', 'car'),
(6, 'Audi', 'car'),
(7, 'BMW', 'car'),
(8, 'BRM', 'car'),
(10, 'Cadillac', 'car'),
(11, 'CBT Jipe', 'car'),
(12, 'Chrysler', 'car'),
(13, 'Citroën', 'car'),
(14, 'Cross Lander', 'car'),
(15, 'Daewoo', 'car'),
(16, 'Daihatsu', 'car'),
(17, 'Dodge', 'car'),
(18, 'Engesa', 'car'),
(19, 'Envemo', 'car'),
(20, 'Ferrari', 'car'),
(21, 'Fiat', 'car'),
(22, 'Ford', 'car'),
(23, 'GM - Chevrolet', 'car'),
(24, 'Gurgel', 'car'),
(25, 'Honda', 'car'),
(26, 'Hyundai', 'car'),
(27, 'Isuzu', 'car'),
(28, 'Jaguar', 'car'),
(29, 'Jeep', 'car'),
(30, 'JPX', 'car'),
(31, 'Kia Motors', 'car'),
(32, 'Lada', 'car'),
(33, 'Land Rover', 'car'),
(34, 'Lexus', 'car'),
(35, 'Lotus', 'car'),
(36, 'Maserati', 'car'),
(37, 'Matra', 'car'),
(38, 'Mazda', 'car'),
(39, 'Mercedes-Benz', 'car'),
(40, 'Mercury', 'car'),
(41, 'Mitsubishi', 'car'),
(42, 'Miura', 'car'),
(43, 'Nissan', 'car'),
(44, 'Peugeot', 'car'),
(45, 'Plymouth', 'car'),
(46, 'Pontiac', 'car'),
(47, 'Porsche', 'car'),
(48, 'Renault', 'car'),
(49, 'Rover', 'car'),
(50, 'Saab', 'car'),
(51, 'Saturn', 'car'),
(52, 'Seat', 'car'),
(54, 'Subaru', 'car'),
(55, 'Suzuki', 'car'),
(56, 'Toyota', 'car'),
(57, 'Troller', 'car'),
(58, 'Volvo', 'car'),
(59, 'VW - VolksWagen', 'car'),
(60, 'ADLY', 'motorcycle'),
(61, 'AGRALE', 'motorcycle'),
(62, 'APRILIA', 'motorcycle'),
(63, 'ATALA', 'motorcycle'),
(64, 'BAJAJ', 'motorcycle'),
(65, 'BETA', 'motorcycle'),
(66, 'BIMOTA', 'motorcycle'),
(67, 'BMW', 'motorcycle'),
(68, 'BRANDY', 'motorcycle'),
(69, 'byCristo', 'motorcycle'),
(70, 'CAGIVA', 'motorcycle'),
(71, 'CALOI', 'motorcycle'),
(72, 'DAELIM', 'motorcycle'),
(73, 'DERBI', 'motorcycle'),
(74, 'DUCATI', 'motorcycle'),
(75, 'EMME', 'motorcycle'),
(76, 'GAS GAS', 'motorcycle'),
(77, 'HARLEY-DAVIDSON', 'motorcycle'),
(78, 'HARTFORD', 'motorcycle'),
(79, 'HERO', 'motorcycle'),
(80, 'HONDA', 'motorcycle'),
(81, 'HUSABERG', 'motorcycle'),
(82, 'HUSQVARNA', 'motorcycle'),
(85, 'KAWASAKI', 'motorcycle'),
(87, 'KTM', 'motorcycle'),
(89, 'LAVRALE', 'motorcycle'),
(90, 'MOTO GUZZI', 'motorcycle'),
(91, 'MV AGUSTA', 'motorcycle'),
(92, 'MVK', 'motorcycle'),
(93, 'ORCA', 'motorcycle'),
(94, 'PEUGEOT', 'motorcycle'),
(95, 'PIAGGIO', 'motorcycle'),
(96, 'SANYANG', 'motorcycle'),
(97, 'SIAMOTO', 'motorcycle'),
(98, 'SUNDOWN', 'motorcycle'),
(99, 'SUZUKI', 'motorcycle'),
(100, 'TRIUMPH', 'motorcycle'),
(101, 'YAMAHA', 'motorcycle'),
(102, 'AGRALE', 'truck'),
(103, 'CHEVROLET', 'truck'),
(104, 'FIAT', 'truck'),
(105, 'FORD', 'truck'),
(106, 'GMC', 'truck'),
(108, 'MARCOPOLO', 'truck'),
(109, 'MERCEDES-BENZ', 'truck'),
(110, 'NAVISTAR', 'truck'),
(111, 'NEOBUS', 'truck'),
(112, 'PUMA-ALFA', 'truck'),
(113, 'SAAB-SCANIA', 'truck'),
(114, 'SCANIA', 'truck'),
(115, 'VOLKSWAGEN', 'truck'),
(116, 'VOLVO', 'truck'),
(117, 'BUELL', 'motorcycle'),
(118, 'KASINSKI', 'motorcycle'),
(119, 'TRAXX', 'motorcycle'),
(120, 'Walk', 'car'),
(121, 'CICCOBUS', 'truck'),
(122, 'IVECO', 'truck'),
(123, 'Bugre', 'car'),
(125, 'SSANGYONG', 'car'),
(126, 'MIZA', 'motorcycle'),
(127, 'LOBINI', 'car'),
(128, 'FYM', 'motorcycle'),
(129, 'KAHENA', 'motorcycle'),
(130, 'BRAVA', 'motorcycle'),
(131, 'AMAZONAS', 'motorcycle'),
(132, 'FOX', 'motorcycle'),
(133, 'GREEN', 'motorcycle'),
(134, 'SHINERAY', 'motorcycle'),
(135, 'WUYANG', 'motorcycle'),
(136, 'CHANA', 'car'),
(137, 'DAYANG', 'motorcycle'),
(138, 'HAOBAO', 'motorcycle'),
(139, 'LERIVO', 'motorcycle'),
(140, 'Mahindra', 'car'),
(141, 'JIAPENG VOLCANO', 'motorcycle'),
(142, 'DAYUN', 'motorcycle'),
(143, 'GARINNI', 'motorcycle'),
(144, 'WALKBUS', 'truck'),
(145, 'DAFRA', 'motorcycle'),
(146, 'Malaguti', 'motorcycle'),
(147, 'EFFA', 'car'),
(148, 'Lon-V', 'motorcycle'),
(149, 'Fibravan', 'car'),
(150, 'BRP', 'motorcycle'),
(151, 'JONNY', 'motorcycle'),
(152, 'HAFEI', 'car'),
(153, 'GREAT WALL', 'car'),
(154, 'JINBEI', 'car'),
(155, 'BUENO', 'motorcycle'),
(156, 'MINI', 'car'),
(157, 'smart', 'car'),
(158, 'IROS', 'motorcycle'),
(159, 'LANDUM', 'motorcycle'),
(160, 'MRX', 'motorcycle'),
(161, 'Caoa Chery', 'car'),
(162, 'Benelli', 'motorcycle'),
(163, 'Wake', 'car'),
(164, 'PEGASSI', 'motorcycle'),
(165, 'TAC', 'car'),
(166, 'SINOTRUK', 'truck'),
(167, 'MG', 'car'),
(168, 'LIFAN', 'car'),
(170, 'Fyber', 'car'),
(171, 'LAMBORGHINI', 'car'),
(173, 'REGAL RAPTOR', 'motorcycle'),
(174, 'JOHNNYPAG', 'motorcycle'),
(175, 'MAGRÃO TRICICLOS', 'motorcycle'),
(176, 'TARGOS', 'motorcycle'),
(177, 'JAC', 'car'),
(178, 'LIFAN', 'motorcycle'),
(179, 'EFFA-JMC', 'truck'),
(180, 'VENTO', 'motorcycle'),
(181, 'HYUNDAI', 'truck'),
(182, 'CHANGAN', 'car'),
(183, 'SHINERAY', 'car'),
(184, 'MAN', 'truck'),
(185, 'RAM', 'car'),
(186, 'RELY', 'car'),
(187, 'TIGER', 'motorcycle'),
(188, 'JAC', 'truck'),
(189, 'ASTON MARTIN', 'car'),
(190, 'FOTON', 'car'),
(191, 'FOTON', 'truck'),
(192, 'Royal Enfield', 'motorcycle'),
(193, 'SHACMAN', 'truck'),
(194, 'MAXIBUS', 'truck'),
(195, 'Rolls-Royce', 'car'),
(196, 'MASCARELLO', 'truck'),
(197, 'DAF', 'truck'),
(198, 'RIGUETE', 'motorcycle'),
(199, 'GEELY', 'car'),
(200, 'MOTORINO', 'motorcycle'),
(201, 'MOTOCAR', 'motorcycle'),
(202, 'INDIAN', 'motorcycle'),
(203, 'HAOJUE', 'motorcycle'),
(204, 'KYMCO', 'motorcycle'),
(205, 'BEE', 'motorcycle'),
(206, 'BEPOBUS', 'truck'),
(207, 'Baby', 'car'),
(208, 'IVECO', 'car'),
(209, 'FUSCO MOTOSEGURA', 'motorcycle'),
(210, 'POLARIS', 'motorcycle'),
(211, 'Mclaren', 'car'),
(212, 'BULL', 'motorcycle'),
(214, 'HITECH ELECTRIC', 'car'),
(215, 'VOLTZ', 'motorcycle'),
(216, 'AVELLOZ', 'motorcycle'),
(236, 'CAB Motors', 'car'),
(237, 'SUPER SOCO', 'motorcycle');

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `carros`
--

CREATE TABLE `carros` (
  `id` int NOT NULL,
  `marca` varchar(200) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `preco` varchar(30) NOT NULL,
  `descricao` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cor` varchar(50) NOT NULL,
  `imagem` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `carros`
--

INSERT INTO `carros` (`id`, `marca`, `modelo`, `preco`, `descricao`, `cor`, `imagem`) VALUES
(33, '4', 'Uno Quadrado', '15000', 'SUV de luxo com design moderno e distinto, tecnologia avançada e desempenho.', 'Prata', '../img/perfil/6751d0b607c14.jpg'),
(38, '6', 'A3 Sedan', '220000.00', 'Um sedan compacto premium, equipado com motor turbo, design elegante e alta tecnologia no interior.', 'Branco Glacial', '../img/perfil/67585af3131bb.png'),
(40, '6', 'Q3', '270000.00', 'SUV compacto com motor TFSI, interior espaçoso e tecnologias como painel digital Audi Virtual Cockpit.', ' Preto Mito', '../img/perfil/67585b5a6cc07.jpeg'),
(41, '6', 'A4', '3000000.00', 'Sedan médio com motor 2.0 TFSI, tração integral quattro e acabamento refinado.', ' Azul Navarra', '../img/perfil/67585b7f68be1.jpeg'),
(42, '6', 'Q5', '380000.00', 'SUV médio com foco em conforto e desempenho, equipado com tecnologia híbrida leve.', 'Cinza Manhattan', '../img/perfil/67585bac7a879.jpeg'),
(43, '6', 'A6', '500000.00', 'Sedan executivo com motor 3.0 V6 TFSI, sistema de direção semiautônomo e amplo espaço interno.', 'Prata Florete', '../img/perfil/67585be6cfc0e.jpg'),
(45, '13', 'C4 Cactus', '135000', 'SUV compacto com design robusto e opções de motorização turbo. Possui tecnologia de segurança avançada e conectividade.', 'Vermelho Aden', '../img/perfil/67607d619a4ed.jpeg'),
(46, '13', ' C5 Aircross', '260000', 'SUV premium com suspensão avançada, espaço interno generoso e acabamento de alta qualidade. Equipado com tecnologias de condução semiautônoma.', 'Azul Tijuca', '../img/perfil/67607dc7393e3.jpg'),
(47, '56', 'Corolla Cross XRE Hybrid', '170000', 'Um SUV compacto com tecnologia híbrida que combina motor a combustão e elétrico, garantindo economia de combustível e baixa emissão de poluentes. ', 'Prata', '../img/perfil/6761a6b145275.jpeg'),
(48, '22', 'Mustang Mach-E', '4000000', 'm SUV totalmente elétrico, inspirado no icônico Mustang. Oferece desempenho esportivo com aceleração impressionante e autonomia de até 500 km por carga.', 'Cinza azulado', '../img/perfil/6761a6ec2a455.jpeg'),
(49, '115', 'T-Cross 200 TSI', '135000', 'Um SUV compacto com motor turbo e excelente custo-benefício. Oferece conectividade avançada, sistema de segurança com frenagem autônoma e conforto para o dia a dia urbano.', 'Branco', '../img/perfil/6761a7205f442.png'),
(50, '20', 'Spider', '700000', 'O V8 4.5L naturalmente aspirado mais aclamado porque entrega incríveis 570 cv e 54 kgfm de torque', 'Branco', '../img/perfil/6761a78247a9d.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `tipoUsuario` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `tipoUsuario`) VALUES
(29, 'Bryan Strey', 'bryan@gmail.com', '1303', 'ADM'),
(32, 'Stefany Amorin', 'stefany@gmail.com', '159753', 'Padrão'),
(38, 'Lucas Juan', 'lucasJuan@gmail.com', '159753', 'ADM'),
(40, 'Kamila Mendes', 'kamilaMendes7854@outlook.com.br', '84268426', 'Padrão'),
(41, 'João Silva', 'joaoSilva@gmail.com', '@SenhaForte123', 'Padrão'),
(42, 'Maria Oliveira', 'maria.oliveira@gmail.com', '#Segura@2024', 'ADM'),
(43, 'Pedro Santos', 'pedro.santos@yahoo.com.br', '!Pass$word321', 'Padrão'),
(44, 'Ana Costa', 'ana.costa@yahoo.com.br', 'Costa2024*', 'Padrão'),
(45, 'Lucas Souza', 'lucas.souza@gmail.com', 'Luke1234@', 'Padrão'),
(46, 'Júlia Ferreira', 'julia.ferreira@gmail.com', '@SenhaDeTeste789', 'Padrão'),
(47, 'Felipe Lima', 'felipe.lima@gmail.com', 'Lima$ecret2024', 'Padrão'),
(48, 'Camila Ramos', 'camila.ramos@yahoo.com.br', 'Ramos@#$123', 'Padrão'),
(50, 'Rafael Martins', 'rafael.martins@gmail.com', 'SafePass2024!', 'Padrão'),
(51, 'Vanessa Rocha', 'vanessa.rocha@gmail.com', '!RochaSecure789', 'Padrão'),
(52, 'Gustavo Azevedo', 'gustavo.azevedo@outlook.com', 'Gust@vo456!', 'ADM'),
(53, 'Lara Cardoso', 'lara.cardoso@outlook.com', 'LaraC@rdoso2024', 'Padrão'),
(54, 'Diego Pereira', 'diego.pereira@gmail.com', 'Die2024@Pass!', 'ADM'),
(55, 'Patrícia Alves', 'patricia.alves@gmail.com', 'Alves1234#', 'Padrão'),
(56, 'Bruno Carvalho', 'bruno.carvalho@gmail.com', '!Carv@lho789', 'Padrão'),
(57, 'Bianca Mendes', 'bianca.mendes@gmail.com', 'Mendes@2024!', 'ADM'),
(58, 'Thiago Barros', 'thiago.barros@gmail.com', 'Thi@go#2024', 'Padrão'),
(59, 'Isabela Lopes', 'isabela.lopes@gmail.com', 'Isabela*123$', 'Padrão'),
(60, 'Renan Duarte', 'renan.duarte@gmail.com', 'RenanSecure#21', 'ADM'),
(61, 'Carolina Teixeira', 'carolina.teixeira@outlook.com', '@CaroT2024$', 'Padrão'),
(62, 'Gabriel Medeiros', 'gabrield78964@gmail.com', '159753', 'ADM'),
(63, 'Zaphir Camargo', 'zaphyr@gmail.com', '123654', 'ADM'),
(64, 'Stefano Borges', 'botgestefano@gmail.com', '142536', 'Padrão'),
(70, 'Adminsom', 'adminson@gmail.com', '123654', 'Padrão');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `carros`
--
ALTER TABLE `carros`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de tabela `carros`
--
ALTER TABLE `carros`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
