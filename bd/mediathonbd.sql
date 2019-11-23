-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-11-2019 a las 19:58:05
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mediathonbd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE `calificacion` (
  `id_calificacion` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_noticia` int(11) NOT NULL,
  `calificacion_respuesta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `id_evento` int(11) NOT NULL,
  `evento_descripcion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `evento_fecha` date NOT NULL,
  `evento_hora` time NOT NULL,
  `evento_estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento_usuario`
--

CREATE TABLE `evento_usuario` (
  `id_evento_usuario` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `menu_name` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `menu_icon` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `menu_controller` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `menu_order` int(11) NOT NULL,
  `menu_status` tinyint(4) NOT NULL,
  `menu_show` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id_menu`, `menu_name`, `menu_icon`, `menu_controller`, `menu_order`, `menu_status`, `menu_show`) VALUES
(1, 'Login', '-', 'Login', 0, 1, 0),
(2, 'Cierre de Sesion', 'fa fa-sign-out', 'Logout', 1000, 1, 1),
(3, 'Panel de Inicio', 'fa fa-dashboard', 'Admin', 1, 1, 1),
(4, 'Roles de Usuario', 'fa fa-user-secret', 'Role', 3, 1, 1),
(5, 'Gestion Menú', 'fa fa-desktop', 'Menu', 2, 1, 1),
(11, 'Editar Datos', 'fa fa-external-link', 'Edit', 999, 1, 1),
(17, 'Gestion de Usuarios', 'fa fa-users', 'Userg', 4, 1, 1),
(18, 'Inicio', 'fa fa-', 'Index', 0, 1, 0),
(19, 'Noticias', 'fa fa-newspaper-o', 'Noticia', 5, 1, 1),
(20, 'Registrar', 'fa fa-', 'Registrar', 0, 1, 0),
(21, '<strong>EMPEZAR</strong>', 'fa fa-heart', 'Inicio', 6, 1, 1),
(22, 'Recompensas', 'fa fa-child', 'Inicio', 8, 1, 1),
(23, 'Mensajes', 'fa fa-comments', 'Mensaje', 10, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id_noticia` int(11) NOT NULL,
  `noticia_titulo` longtext COLLATE utf8_unicode_ci NOT NULL,
  `noticia_contexto` longtext COLLATE utf8_unicode_ci NOT NULL,
  `noticia_bajada` longtext COLLATE utf8_unicode_ci NOT NULL,
  `noticia_link` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `noticia_esfake` tinyint(1) DEFAULT NULL,
  `noticia_motivo` longtext COLLATE utf8_unicode_ci,
  `noticia_estado` tinyint(1) NOT NULL,
  `noticia_mostrar` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id_noticia`, `noticia_titulo`, `noticia_contexto`, `noticia_bajada`, `noticia_link`, `noticia_esfake`, `noticia_motivo`, `noticia_estado`, `noticia_mostrar`) VALUES
(1, 'Keiko Fujimori: revelaciones sobre aportes en el 2011 abren posible nueva ruta de investigación', 'Policia busca al asesino a', 'No se que va acá pes a', 'https://elcomercio.pe/politica/keiko-fujimori-revelaciones-sobre-los-aportes-a-la-campana-del-2011-abren-nueva-ruta-de-investigacion-para-la-fiscalia-noticia/', 0, 'El primer precepto, para no caer en la trampa, es no quedarnos en el titular. Por muy llamativo o sensacionalista que parezca un mensaje que recibimos en nuestro smartphone, o una publicación en el muro de una red social, puede no ser real.\n \n\nSiempre debemos comprobar el contenido de la noticia, verificar si los hechos narrados contienen datos precisos o ambigüedades, si se trata de una noticia imparcial o de un artículo de opinión, incluso si está escrito en tono sarcástico o humorístico y, lo más importante, si el origen de la noticia es de una fuente reconocida y de confianza.', 1, 1),
(2, 'Organización de VxR contrata al «Chino» para que Fito no llegue tarde de Ate a San Marcos', 'aaa', 'aaa', '1', 1, 'https://ultimanoticia.pe/organizacion-de-vxr-contrata-al-chino-para-que-fito-no-llegue-tarde-de-ate-a-san-marcos/', 1, 1),
(3, 'Convocan a marcha para que Agua Marina se presente en la final de la Libertadores', 'aaa', 'aaa', '1', 1, 'https://ultimanoticia.pe/convocan-a-marcha-para-que-agua-marina-se-presente-en-la-final-de-la-libertadores/', 1, 1),
(4, 'Noche violenta en Chile: robaron más de 200.000 dólares de un banco en medio de las protestas', 'aaa', 'aaa', 'https://elcomercio.pe/mundo/latinoamerica/protestas-en-chile-en-vivo-jornada-violenta-deja-robo-a-banco-incendios-y-ataque-a-cuarteles-fotos-noticia/', 0, 'Duda de los títulos. Las noticias falsas suelen presentar títulos llamativos escritos en letras mayúsculas y con signos de exclamación. Si un título contiene afirmaciones sorprendentes y poco creíbles, es probable que se trate de información falsa.\nObserva con atención la URL. Una URL , impostora o que imita una original puede ser una señal de advertencia que indica que se trata de una noticia falsa. Muchos sitios de noticias falsas realizan pequeños cambios en la URL de las fuentes de noticias auténticas para imitarlas. Puedes visitar el sitio para comparar la URL con las fuentes establecidas.\nInvestiga la fuente. Asegúrate de que la noticia esté escrita por una fuente de confianza respaldada por una reputación de exactitud en la información. Si la noticia proviene de una organización desconocida, verifica la sección \"Información\" para obtener más detalles.', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `optionm`
--

CREATE TABLE `optionm` (
  `id_optionm` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `optionm_name` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `optionm_function` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `optionm_show` tinyint(1) NOT NULL,
  `optionm_status` tinyint(4) NOT NULL,
  `optionm_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `optionm`
--

INSERT INTO `optionm` (`id_optionm`, `id_menu`, `optionm_name`, `optionm_function`, `optionm_show`, `optionm_status`, `optionm_order`) VALUES
(1, 1, 'Iniciar Sesion', 'index', 0, 1, 0),
(2, 2, 'Finalizar Sesion', 'singOut', 1, 1, 1),
(3, 3, 'Inicio', 'index', 1, 1, 1),
(4, 4, 'Agregar Rol', 'add', 1, 1, 1),
(5, 4, 'Ver Roles', 'all', 1, 1, 2),
(6, 4, 'Editar Rol', 'edit', 0, 1, 0),
(7, 5, 'Ver Todo', 'list', 1, 1, 2),
(8, 5, 'Iconos del Sistema', 'icons', 1, 1, 5),
(9, 5, 'Agregar Menu', 'add', 1, 1, 1),
(10, 5, 'Editar Menú', 'edit', 0, 1, 1),
(11, 5, 'Gestion Accesos Por Roles', 'role', 0, 1, 5),
(12, 5, 'Ver Opciones Menú', 'functions', 0, 1, 1),
(13, 5, 'Agregar Opción', 'addf', 0, 1, 1),
(14, 5, 'Editar Opción', 'editf', 0, 1, 1),
(15, 5, 'Ver Permisos de Opción', 'listp', 0, 1, 1),
(16, 5, 'Agregar Permiso', 'addp', 0, 1, 1),
(17, 5, 'Editar Permiso', 'editp', 0, 1, 1),
(26, 11, 'Editar Datos Personales', 'info', 1, 1, 1),
(27, 11, 'Nombre de Usuario', 'changeUser', 1, 1, 2),
(28, 11, 'Cambiar Contraseña', 'changepass', 1, 1, 3),
(35, 4, 'Gestionar Opciones', 'options', 0, 1, 3),
(51, 17, 'Ver Usuarios', 'all', 1, 1, 2),
(52, 17, 'Agregar Usuario', 'addu', 1, 1, 1),
(53, 17, 'Editar Persona', 'editpu', 0, 1, 1),
(54, 17, 'Editar Usuario', 'edituu', 0, 1, 1),
(55, 18, 'Inicio', 'index', 0, 1, 0),
(56, 19, 'Agregar Noticia', 'agregar', 1, 1, 0),
(57, 19, 'Ver Noticias', 'ver', 1, 1, 1),
(58, 19, 'Editar Noticia', 'editar', 0, 1, 0),
(59, 20, 'Registrar Docente', 'index', 0, 1, 0),
(60, 21, 'Aprender', 'aprender', 1, 1, 0),
(61, 21, 'Ver Noticia', 'ver', 0, 1, 0),
(62, 21, 'Ver Resultado', 'respuesta', 0, 1, 0),
(63, 22, 'Ver Recompensas', 'recompensas', 1, 1, 0),
(64, 23, 'Enviar Mensajes', 'mensajes', 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permit`
--

CREATE TABLE `permit` (
  `id_permit` int(11) NOT NULL,
  `id_optionm` int(11) NOT NULL,
  `permit_action` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `permit_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `permit`
--

INSERT INTO `permit` (`id_permit`, `id_optionm`, `permit_action`, `permit_status`) VALUES
(1, 1, 'singIn', 1),
(2, 2, 'singOut', 1),
(3, 4, 'save', 1),
(4, 5, 'delete', 1),
(6, 9, 'save', 1),
(7, 11, 'insertRole', 1),
(8, 11, 'deleteRole', 1),
(9, 13, 'saveOption', 1),
(10, 12, 'deleteOption', 1),
(11, 16, 'savePermit', 1),
(12, 15, 'deletePermit', 1),
(20, 26, 'save', 1),
(21, 27, 'saveNewNick', 1),
(22, 28, 'chgpass', 1),
(26, 35, 'addRelation', 1),
(27, 35, 'deleteRelation', 1),
(40, 53, 'save_edit_personu', 1),
(41, 54, 'save_edit_useru', 1),
(42, 51, 'reset_pass', 1),
(43, 51, 'change_status', 1),
(52, 3, 'openBox', 1),
(53, 52, 'new_u', 1),
(54, 56, 'guardar', 1),
(55, 59, 'registrar', 1),
(56, 61, 'enviar_respuesta', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `person`
--

CREATE TABLE `person` (
  `id_person` int(11) NOT NULL,
  `person_name` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `person_surname` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `person_dni` char(8) COLLATE utf8_spanish_ci NOT NULL,
  `person_birth` date NOT NULL,
  `person_number_phone` varchar(24) COLLATE utf8_spanish_ci DEFAULT NULL,
  `person_genre` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `person_address` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `person_city` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `person_country` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `person_created_at` datetime NOT NULL,
  `person_modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `person`
--

INSERT INTO `person` (`id_person`, `person_name`, `person_surname`, `person_dni`, `person_birth`, `person_number_phone`, `person_genre`, `person_address`, `person_city`, `person_country`, `person_created_at`, `person_modified_at`) VALUES
(1, 'César José', 'Ruiz', '72195723', '1995-09-03', '969902084', 'M', 'Calle Estado de Israel #256', 'Iquitos', 'Perú', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Kimi', 'Ruiz Reategui', '66666666', '2008-02-15', '98765432', 'M', 'Calle Estado de Israel 255', 'Iquitos', 'Perú', '2019-11-12 21:55:19', '2019-11-13 10:56:32'),
(3, 'Juanito', 'Alcachofa', '77777777', '1995-12-20', '987654321', 'M', 'Callle calle 123', 'Iquitos', 'Perú', '2019-11-23 04:56:55', '2019-11-23 04:56:55'),
(4, 'Juanito', 'Alcachofa', '98765432', '1996-12-12', '987654321', 'M', 'Calle Estado de Israel 256', 'Iquitos', 'Perú', '2019-11-23 08:04:38', '2019-11-23 08:04:38'),
(5, 'Aquiles', 'Cuento', '99999999', '2019-11-23', '986532147', 'M', 'Calle Por Ahi 235', 'Iquitos', 'Perú', '2019-11-23 13:10:04', '2019-11-23 13:10:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `role_name` varchar(32) COLLATE utf8_spanish_ci DEFAULT NULL,
  `role_description` varchar(126) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`id_role`, `role_name`, `role_description`) VALUES
(1, 'Free', 'Rol usado por los usuarios sin credenciales'),
(2, 'SuperAdmin', 'Administra Todo'),
(3, 'Admin', 'Puto el que lo lea'),
(4, 'Docente', 'Docentes que usarán la plataforma');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rolemenu`
--

CREATE TABLE `rolemenu` (
  `id_rolemenu` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rolemenu`
--

INSERT INTO `rolemenu` (`id_rolemenu`, `id_role`, `id_menu`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 3),
(4, 2, 4),
(5, 2, 5),
(11, 2, 11),
(25, 3, 2),
(26, 3, 3),
(29, 3, 11),
(35, 2, 17),
(36, 3, 4),
(37, 3, 17),
(38, 1, 2),
(39, 1, 18),
(40, 2, 18),
(41, 3, 18),
(42, 2, 19),
(43, 3, 19),
(44, 4, 2),
(45, 4, 3),
(46, 4, 11),
(47, 1, 20),
(48, 4, 21),
(49, 4, 22),
(50, 2, 23),
(51, 3, 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_person` int(11) DEFAULT NULL,
  `id_role` int(11) NOT NULL,
  `user_nickname` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_password` varchar(64) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_email` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `user_image` varchar(126) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_status` tinyint(1) DEFAULT NULL,
  `user_created_at` datetime NOT NULL,
  `user_last_login` datetime NOT NULL,
  `user_modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_user`, `id_person`, `id_role`, `user_nickname`, `user_password`, `user_email`, `user_image`, `user_status`, `user_created_at`, `user_last_login`, `user_modified_at`) VALUES
(1, 1, 2, 'cesarjose39', '$2y$10$XwgdmunCA.7/OizoRuRwG.OCRRKfg37FTfApVmG20AWOZMTJjPq4O', 'cesar.ruiz39124@gmail.com', 'media/user/1/user.jpg', 1, '2018-11-26 00:00:00', '2019-11-23 13:38:22', '2019-02-17 16:06:56'),
(2, 2, 3, 'kimi', '$2y$10$LXmtXFsh5..N6M.EGJ87OeB7RHFv.rMtjbQXi2FJ8jiujPyEA9MK2', 'kimi@gmail.com', 'media/user/1/user.jpg', 1, '2019-11-12 21:55:29', '2019-11-23 13:29:08', '2019-11-13 12:49:54'),
(3, 3, 4, 'juanito', '$2y$10$siuSGb.fTedUvJCj6XH85eTg1QxSx3OfquXO7rtRTrNEn7kKImxYm', 'a@a.com', 'media/user/1/user.jpg', 1, '2019-11-23 04:56:55', '2019-11-23 13:46:59', '2019-11-23 04:56:55'),
(4, 4, 4, 'juanito123', '$2y$10$v2OLEy6zJ8y3OCZkFV0IPOOOgwsR27xbU9YFREGhSiYHaNbEvFrKa', 'juan@juan.com', 'media/user/1/user.jpg', 1, '2019-11-23 08:04:38', '2019-11-23 08:04:45', '2019-11-23 08:04:38'),
(5, 5, 3, 'aquilescuento', '$2y$10$tqGKx1nyGi0LsEvzNTwDguzk.hYhWk1xff9w4UH6VxgRMv85LrCA2', 'aquiles@gmail.com', 'media/user/1/user.jpg', 1, '2019-11-23 13:10:04', '2019-11-23 13:10:04', '2019-11-23 13:10:04');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD PRIMARY KEY (`id_calificacion`),
  ADD KEY `id_noticia` (`id_noticia`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id_evento`);

--
-- Indices de la tabla `evento_usuario`
--
ALTER TABLE `evento_usuario`
  ADD PRIMARY KEY (`id_evento_usuario`),
  ADD KEY `id_evento` (`id_evento`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id_noticia`);

--
-- Indices de la tabla `optionm`
--
ALTER TABLE `optionm`
  ADD PRIMARY KEY (`id_optionm`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indices de la tabla `permit`
--
ALTER TABLE `permit`
  ADD PRIMARY KEY (`id_permit`),
  ADD KEY `id_optionm` (`id_optionm`);

--
-- Indices de la tabla `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id_person`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indices de la tabla `rolemenu`
--
ALTER TABLE `rolemenu`
  ADD PRIMARY KEY (`id_rolemenu`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `R_2` (`id_person`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  MODIFY `id_calificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `evento_usuario`
--
ALTER TABLE `evento_usuario`
  MODIFY `id_evento_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `optionm`
--
ALTER TABLE `optionm`
  MODIFY `id_optionm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `permit`
--
ALTER TABLE `permit`
  MODIFY `id_permit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `person`
--
ALTER TABLE `person`
  MODIFY `id_person` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rolemenu`
--
ALTER TABLE `rolemenu`
  MODIFY `id_rolemenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD CONSTRAINT `calificacion_ibfk_1` FOREIGN KEY (`id_noticia`) REFERENCES `noticias` (`id_noticia`),
  ADD CONSTRAINT `calificacion_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Filtros para la tabla `evento_usuario`
--
ALTER TABLE `evento_usuario`
  ADD CONSTRAINT `evento_usuario_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id_evento`),
  ADD CONSTRAINT `evento_usuario_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Filtros para la tabla `optionm`
--
ALTER TABLE `optionm`
  ADD CONSTRAINT `optionm_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`);

--
-- Filtros para la tabla `permit`
--
ALTER TABLE `permit`
  ADD CONSTRAINT `permit_ibfk_1` FOREIGN KEY (`id_optionm`) REFERENCES `optionm` (`id_optionm`);

--
-- Filtros para la tabla `rolemenu`
--
ALTER TABLE `rolemenu`
  ADD CONSTRAINT `rolemenu_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`),
  ADD CONSTRAINT `rolemenu_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `R_2` FOREIGN KEY (`id_person`) REFERENCES `person` (`id_person`),
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
