-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Jun-2022 às 15:33
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mvc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `access_area`
--

CREATE TABLE `access_area` (
  `id` int(11) NOT NULL,
  `access` varchar(20) NOT NULL,
  `uri` varchar(20) NOT NULL,
  `admin` smallint(6) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `access_area`
--

INSERT INTO `access_area` (`id`, `access`, `uri`, `admin`, `created`, `updated`) VALUES
(1, 'Dados da Empresa', 'dados-empresa', 2, '2022-05-11 20:14:15', '2022-05-11 15:14:15'),
(2, 'Identidade do Site', 'identidade-site', 2, '2022-05-11 20:14:15', '2022-05-11 15:14:15'),
(3, 'Área de Acesso', 'area-de-acesso', 1, '2022-05-11 20:14:15', '2022-05-11 15:14:15'),
(4, 'Usuários', 'usuarios', 1, '2022-05-11 20:14:15', '2022-05-11 15:14:15'),
(5, 'Banner', 'banner', 2, '2022-05-11 15:18:15', '2022-05-11 15:18:15'),
(6, 'Depoimentos', 'depoimentos', 1, '2022-05-16 12:16:42', '2022-05-16 12:16:42'),
(19, 'Perfil', 'perfil', 1, '2022-05-19 11:52:36', '2022-05-19 11:52:36'),
(20, 'Contato', 'contato', 1, '2022-05-26 11:25:32', '2022-05-26 11:25:32'),
(25, 'Banners', 'banners', 1, '2022-05-27 10:44:24', '2022-05-27 10:44:24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `address`
--

INSERT INTO `address` (`id`, `address`, `cep`, `state`, `created`, `updated`) VALUES
(1, 'Exemple Address', '00000-000', 'Rio de Janeiro', '2022-05-06 10:52:15', '2022-05-06 10:52:15'),
(2, 'Exemple Address', '00000-000', 'Rio de Janeiro', '2022-05-06 10:54:35', '2022-05-06 10:54:35'),
(3, 'Exemple Address', '00000-000', 'Rio de Janeiro', '2022-05-06 10:59:28', '2022-05-06 10:59:28'),
(4, 'Exemple Address', '00000-000', 'Rio de Janeiro', '2022-05-06 11:04:42', '2022-05-06 11:04:42'),
(5, 'Exemple Address', '00000-000', 'Rio de Janeiro', '2022-05-06 11:05:16', '2022-05-06 11:05:16'),
(6, 'Exemple Address', '00000-000', 'Rio de Janeiro', '2022-05-06 15:59:25', '2022-05-06 15:59:25'),
(7, 'Exemple Address', '00000-000', 'Rio de Janeiro', '2022-05-06 17:24:57', '2022-05-06 17:24:57'),
(8, 'Exemple Address', '00000-000', 'Rio de Janeiro', '2022-05-11 15:14:15', '2022-05-11 15:14:15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `link_target` float NOT NULL DEFAULT 0,
  `active` float NOT NULL DEFAULT 1,
  `banner_desktop` varchar(255) DEFAULT NULL,
  `banner_mobile` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `banners`
--

INSERT INTO `banners` (`id`, `title`, `link`, `link_target`, `active`, `banner_desktop`, `banner_mobile`) VALUES
(2, 'teste', '', 0, 0, '20220527194500.jpg', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_one` varchar(255) DEFAULT NULL,
  `phone_two` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `api_wpp` text DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `contact`
--

INSERT INTO `contact` (`id`, `email`, `phone_one`, `phone_two`, `whatsapp`, `api_wpp`, `created`, `updated`) VALUES
(1, 'exemple@mail.com.br', '00000-0000', '00000-0000', '00000-0000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere ipsa ut deserunt porro sunt, distinctio id sint necessitatibus ea nesciunt odio, quasi impedit inventore nobis explicabo corrupti rerum omnis sit!', '2022-05-06 10:52:15', '2022-05-06 10:52:15'),
(2, 'exemple@mail.com.br', '00000-0000', '00000-0000', '00000-0000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere ipsa ut deserunt porro sunt, distinctio id sint necessitatibus ea nesciunt odio, quasi impedit inventore nobis explicabo corrupti rerum omnis sit!', '2022-05-06 10:54:35', '2022-05-06 10:54:35'),
(3, 'exemple@mail.com.br', '00000-0000', '00000-0000', '00000-0000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere ipsa ut deserunt porro sunt, distinctio id sint necessitatibus ea nesciunt odio, quasi impedit inventore nobis explicabo corrupti rerum omnis sit!', '2022-05-06 10:59:28', '2022-05-06 10:59:28'),
(4, 'exemple@mail.com.br', '00000-0000', '00000-0000', '00000-0000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere ipsa ut deserunt porro sunt, distinctio id sint necessitatibus ea nesciunt odio, quasi impedit inventore nobis explicabo corrupti rerum omnis sit!', '2022-05-06 11:04:42', '2022-05-06 11:04:42'),
(5, 'exemple@mail.com.br', '00000-0000', '00000-0000', '00000-0000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere ipsa ut deserunt porro sunt, distinctio id sint necessitatibus ea nesciunt odio, quasi impedit inventore nobis explicabo corrupti rerum omnis sit!', '2022-05-06 11:05:16', '2022-05-06 11:05:16'),
(6, 'exemple@mail.com.br', '00000-0000', '00000-0000', '00000-0000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere ipsa ut deserunt porro sunt, distinctio id sint necessitatibus ea nesciunt odio, quasi impedit inventore nobis explicabo corrupti rerum omnis sit!', '2022-05-06 15:59:25', '2022-05-06 15:59:25'),
(7, 'exemple@mail.com.br', '00000-0000', '00000-0000', '00000-0000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere ipsa ut deserunt porro sunt, distinctio id sint necessitatibus ea nesciunt odio, quasi impedit inventore nobis explicabo corrupti rerum omnis sit!', '2022-05-06 17:24:57', '2022-05-06 17:24:57'),
(8, 'exemple@mail.com.br', '00000-0000', '00000-0000', '00000-0000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere ipsa ut deserunt porro sunt, distinctio id sint necessitatibus ea nesciunt odio, quasi impedit inventore nobis explicabo corrupti rerum omnis sit!', '2022-05-11 15:14:15', '2022-05-11 15:14:15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `depoimentos`
--

CREATE TABLE `depoimentos` (
  `id` int(11) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `depoimento` text DEFAULT NULL,
  `data` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `depoimentos`
--

INSERT INTO `depoimentos` (`id`, `autor`, `depoimento`, `data`) VALUES
(24, 'Teste', '123', '2022-05-16 15:30:48');

-- --------------------------------------------------------

--
-- Estrutura da tabela `emails_contact`
--

CREATE TABLE `emails_contact` (
  `id` int(11) NOT NULL,
  `emails` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `emails_contact`
--

INSERT INTO `emails_contact` (`id`, `emails`) VALUES
(1, 'exemple@mail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `historic`
--

CREATE TABLE `historic` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `historic`
--

INSERT INTO `historic` (`id`, `created`, `user_id`, `action`) VALUES
(1, '2022-05-16 21:55:34', 1, 'Inseriu uma nova Área de Acesso: Testezao'),
(2, '2022-05-16 21:58:38', 1, 'Excluiu uma Área de Acesso: Testezao'),
(3, '2022-05-16 21:59:11', 1, 'Excluiu uma Área de Acesso: testee'),
(4, '2022-05-16 22:02:30', 1, 'Atualizou uma Área de Acesso: Teste - Teste'),
(5, '2022-05-16 22:02:57', 1, 'Atualizou uma Área de Acesso: Testes'),
(6, '2022-05-16 22:41:50', 1, 'Excluiu uma Área de Acesso: Testes'),
(7, '2022-05-19 16:52:36', 1, 'Inseriu uma nova Área de Acesso: Perfil'),
(8, '2022-05-26 16:25:32', 1, 'Inseriu uma nova Área de Acesso: Contato'),
(9, '2022-05-26 21:06:58', 1, 'Atualizou emails de contato de: Contato'),
(10, '2022-05-26 17:12:32', 1, 'Atualizou emails de contato de: Contato'),
(11, '2022-05-27 10:23:58', 1, 'Atualizou seu perfil.'),
(12, '2022-05-27 10:24:13', 1, 'Atualizou seu perfil.'),
(13, '2022-05-27 10:44:24', 1, 'Inseriu uma nova Área de Acesso: Banners');

-- --------------------------------------------------------

--
-- Estrutura da tabela `identity`
--

CREATE TABLE `identity` (
  `id` int(11) NOT NULL,
  `title_site` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `logo_primary` varchar(20) DEFAULT NULL,
  `logo_secondary` varchar(20) DEFAULT NULL,
  `logo_footer` varchar(20) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `identity`
--

INSERT INTO `identity` (`id`, `title_site`, `description`, `logo_primary`, `logo_secondary`, `logo_footer`, `created`, `updated`) VALUES
(1, 'Modificação', 'Teste de descrição', '20220512213254.jpg', '20220504170136.jpeg', '20220504170124.jpg', '2022-05-03 15:44:32', '2022-05-03 15:44:32'),
(2, 'Exemple name', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt maxime id maiores in quidem optio nam itaque saepe. Est odit totam quidem! Recusandae fugit aliquam accusantium numquam assumenda cupiditate ipsa!', 'logo-primary.webp', 'logo-secondary.webp', 'logo-footer.webp', '2022-05-04 15:44:44', '2022-05-04 15:44:44'),
(3, 'Exemple name', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt maxime id maiores in quidem optio nam itaque saepe. Est odit totam quidem! Recusandae fugit aliquam accusantium numquam assumenda cupiditate ipsa!', 'logo-primary.webp', 'logo-secondary.webp', 'logo-footer.webp', '2022-05-04 17:11:12', '2022-05-04 17:11:12'),
(4, 'Exemple name', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt maxime id maiores in quidem optio nam itaque saepe. Est odit totam quidem! Recusandae fugit aliquam accusantium numquam assumenda cupiditate ipsa!', 'logo-primary.webp', 'logo-secondary.webp', 'logo-footer.webp', '2022-05-04 17:36:36', '2022-05-04 17:36:36'),
(5, 'Exemple name', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt maxime id maiores in quidem optio nam itaque saepe. Est odit totam quidem! Recusandae fugit aliquam accusantium numquam assumenda cupiditate ipsa!', 'logo-primary.webp', 'logo-secondary.webp', 'logo-footer.webp', '2022-05-06 10:52:15', '2022-05-06 10:52:15'),
(6, 'Exemple name', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt maxime id maiores in quidem optio nam itaque saepe. Est odit totam quidem! Recusandae fugit aliquam accusantium numquam assumenda cupiditate ipsa!', 'logo-primary.webp', 'logo-secondary.webp', 'logo-footer.webp', '2022-05-06 10:54:35', '2022-05-06 10:54:35'),
(7, 'Exemple name', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt maxime id maiores in quidem optio nam itaque saepe. Est odit totam quidem! Recusandae fugit aliquam accusantium numquam assumenda cupiditate ipsa!', 'logo-primary.webp', 'logo-secondary.webp', 'logo-footer.webp', '2022-05-06 10:59:28', '2022-05-06 10:59:28'),
(8, 'Exemple name', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt maxime id maiores in quidem optio nam itaque saepe. Est odit totam quidem! Recusandae fugit aliquam accusantium numquam assumenda cupiditate ipsa!', 'logo-primary.webp', 'logo-secondary.webp', 'logo-footer.webp', '2022-05-06 11:04:42', '2022-05-06 11:04:42'),
(9, 'Exemple name', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt maxime id maiores in quidem optio nam itaque saepe. Est odit totam quidem! Recusandae fugit aliquam accusantium numquam assumenda cupiditate ipsa!', 'logo-primary.webp', 'logo-secondary.webp', 'logo-footer.webp', '2022-05-06 11:05:16', '2022-05-06 11:05:16'),
(10, 'Exemple name', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt maxime id maiores in quidem optio nam itaque saepe. Est odit totam quidem! Recusandae fugit aliquam accusantium numquam assumenda cupiditate ipsa!', 'logo-primary.webp', 'logo-secondary.webp', 'logo-footer.webp', '2022-05-06 15:59:25', '2022-05-06 15:59:25'),
(11, 'Exemple name', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt maxime id maiores in quidem optio nam itaque saepe. Est odit totam quidem! Recusandae fugit aliquam accusantium numquam assumenda cupiditate ipsa!', 'logo-primary.webp', 'logo-secondary.webp', 'logo-footer.webp', '2022-05-06 17:24:57', '2022-05-06 17:24:57'),
(12, 'Exemple name', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt maxime id maiores in quidem optio nam itaque saepe. Est odit totam quidem! Recusandae fugit aliquam accusantium numquam assumenda cupiditate ipsa!', 'logo-primary.webp', 'logo-secondary.webp', 'logo-footer.webp', '2022-05-11 15:14:15', '2022-05-11 15:14:15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `phinxlog`
--

CREATE TABLE `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `phinxlog`
--

INSERT INTO `phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20220429172329, 'UsersTable', '2022-05-03 23:42:35', '2022-05-03 23:42:35', 0),
(20220503170905, 'IdentityCreate', '2022-05-03 23:43:38', '2022-05-03 23:43:38', 0),
(20220504183524, 'CompanyAddressCreate', '2022-05-06 18:52:03', '2022-05-06 18:52:03', 0),
(20220504200418, 'CompanyContactCreate', '2022-05-06 18:52:03', '2022-05-06 18:52:03', 0),
(20220504203242, 'CompanySocialCreate', '2022-05-06 18:54:33', '2022-05-06 18:54:33', 0),
(20220506135715, 'UsersCreate', '2022-05-06 19:04:06', '2022-05-06 19:04:06', 0),
(20220506184327, 'AccessAreaCreate', '2022-05-07 01:24:29', '2022-05-07 01:24:29', 0),
(20220511175318, 'AccessAreaAlter', '2022-05-11 22:57:15', '2022-05-11 22:57:15', 0),
(20220511181240, 'AccessAreaCreate', '2022-05-11 23:14:03', '2022-05-11 23:14:03', 0),
(20220512204019, 'AccessAreaAddColumns', '2022-05-13 01:43:36', '2022-05-13 01:43:36', 0),
(20220516183044, 'Historic', '2022-05-16 23:44:11', '2022-05-16 23:44:11', 0),
(20220526174042, 'EmailsContact', '2022-05-26 22:47:55', '2022-05-26 22:47:55', 0),
(20220527144301, 'Banners', '2022-05-27 19:55:31', '2022-05-27 19:55:31', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `social`
--

CREATE TABLE `social` (
  `id` int(11) NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `social`
--

INSERT INTO `social` (`id`, `facebook`, `instagram`, `youtube`, `linkedin`, `created`, `updated`) VALUES
(1, 'https://', 'https://', 'https://', 'https://', '2022-05-06 10:54:35', '2022-05-06 10:54:35'),
(2, 'https://', 'https://', 'https://', 'https://', '2022-05-06 10:59:28', '2022-05-06 10:59:28'),
(3, 'https://', 'https://', 'https://', 'https://', '2022-05-06 11:04:42', '2022-05-06 11:04:42'),
(4, 'https://', 'https://', 'https://', 'https://', '2022-05-06 11:05:16', '2022-05-06 11:05:16'),
(5, 'https://', 'https://', 'https://', 'https://', '2022-05-06 15:59:25', '2022-05-06 15:59:25'),
(6, 'https://', 'https://', 'https://', 'https://', '2022-05-06 17:24:57', '2022-05-06 17:24:57'),
(7, 'https://', 'https://', 'https://', 'https://', '2022-05-11 15:14:15', '2022-05-11 15:14:15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `permission` varchar(5) NOT NULL COMMENT '1:insert, 2:update, 3:delete | 1-2-3',
  `access_area` varchar(10) NOT NULL,
  `admin` smallint(6) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `blocked` tinyint(1) DEFAULT 0,
  `quantity_blocked` varchar(3) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `permission`, `access_area`, `admin`, `created`, `updated`, `blocked`, `quantity_blocked`) VALUES
(1, 'Danilo C', '$2y$10$VkcHTiWJW6R1Doiw.YcQyemQ6IUU6Oj.CTZDjFzuaKrqegagUhXBy', 'danilo@taticaweb.com.br', '1-2-3', '0', 3, '2022-05-06 16:05:16', NULL, 0, '1');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `access_area`
--
ALTER TABLE `access_area`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `access` (`access`);

--
-- Índices para tabela `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `depoimentos`
--
ALTER TABLE `depoimentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `emails_contact`
--
ALTER TABLE `emails_contact`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `historic`
--
ALTER TABLE `historic`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `identity`
--
ALTER TABLE `identity`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `phinxlog`
--
ALTER TABLE `phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Índices para tabela `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `access_area`
--
ALTER TABLE `access_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `depoimentos`
--
ALTER TABLE `depoimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `emails_contact`
--
ALTER TABLE `emails_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `historic`
--
ALTER TABLE `historic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `identity`
--
ALTER TABLE `identity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `social`
--
ALTER TABLE `social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
