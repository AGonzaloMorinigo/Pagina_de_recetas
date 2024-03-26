-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-02-2024 a las 20:30:57
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `recetadecocina`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

CREATE TABLE `recetas` (
  `id_r` int(11) NOT NULL,
  `nombre_r` varchar(30) DEFAULT NULL,
  `ingredientes` varchar(1000) DEFAULT NULL,
  `elaboracion` varchar(5000) DEFAULT NULL,
  `imagen` varchar(512) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `id_region` int(11) NOT NULL,
  `usuario` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`id_r`, `nombre_r`, `ingredientes`, `elaboracion`, `imagen`, `id_tipo`, `id_region`, `usuario`) VALUES
(5, 'Empanadas de pollo', '2 muslos de pollo bien deshuesados y sin piel.\r\n2 morrones rojos.\r\n2 morrones verdes.\r\n2 cebollas.\r\n1 huevo.\r\nAceite de oliva virgen extra.\r\nSal.\r\nPimienta.\r\n\r\n400 gr de harina.\r\n9 gr de levadura fresca.\r\n5 gr de sal.\r\n250 ml de agua.\r\n50 ml de aceite de oliva suave o de girasol.\r\n50 ml de aceite del sofrito anterior.', '1. Cortar las verduras en julianas.\r\n2. Freír en una sartén con aceite de oliva, y a fuego medio, los muslos de pollos cortados en dados. Cuando estén listos retirar y reservar. \r\n3. En esa misma sartén sofreír las cebollas durante 10 minutos hasta que se doren.\r\n4. Agregar los morrones, salpimienta y rehogar por otros 10 minutos más. Después, incorporar de nuevo el pollo y dar un par de vueltas a la preparación. \r\n5. Para hacer la masa de la empanada se debe formar un volcán con la harina y luego incorporar el resto de ingredientes. Trabaja hasta que obtengas una pasta que no se pegue a los dedos. Posteriormente, deja reposar durante unos 20 minutos. \r\n6. Cortar la masa en dos porciones y extender una de ellas para formar con la misma la base de la empanada. Reparte por encima el contenido de la sartén (el relleno) bien escurrido para que no se ablande la empanada durante la cocción. \r\n7. Después cubre la mezcla con la otra porción de masa y cierra los bordes. Pincha el centro de la preparación', 'OIP.jpg', 3, 1, 'gonzza'),
(6, 'Milanesas ', '6 pencas grandes de acelga\r\n1 taza de pan rallado\r\n1 taza de harina\r\n2 huevos\r\nSal y pimienta al gusto\r\nAceite para freír', 'Lava bien las pencas de acelga y retira las hebras más fibrosas.\r\nCorta las pencas en trozos más o menos del mismo tamaño y cocínalas en agua con sal durante 10 minutos. Luego, escúrrelas y déjalas enfriar.\r\nEn un plato hondo, bate los huevos con sal y pimienta.\r\nPasa cada penca por harina, luego por el huevo batido y finalmente por el pan rallado, asegurándote de que estén bien cubiertas.\r\nCalienta aceite en una sartén y fríe las milanesas de pencas hasta que estén doradas por ambos lados.\r\nRetira las milanesas y colócalas sobre papel absorbente para eliminar el exceso de aceite.\r\nSirve las milanesas de pencas calientes y disfruta de su sabor único.', '1.jpg', 1, 1, 'gonzza'),
(7, 'Bizcochuelo', '-3 huevos\r\n\r\n-1 taza de azúcar\r\n\r\n-1 taza de aceite (neutro)\r\n\r\n-2 tazas de harina 0000\r\n\r\n-1 cdita de polvo para hornear\r\n\r\n-esencia de vainilla', '1-Vamos a cascar los huevos y volcarlos en un recipiente junto con el azúcar y lo vamos a batir. Yo uso la batidora pero obvio que se puede hacer a tenedor alzado. Este paso se llama “cremar” la mezcla. Justamente, es batir hasta que aclare un poco el color y se vuelva espesa la mezcla y crezca.\r\n\r\n2- Una vez que veamos que la mezcla aclaró y creció, vamos a agregar el aceite y a seguir batiendo. La idea es que sea un aceite neutro que no aporte un sabor demasiado fuerte a la preparación.\r\n\r\n3- Agregamos unas gotitas de esencia de vainilla y seguimos batiendo y batiendo.\r\n\r\n4- Una vez que está todo unido, vamos a dejar de batir y vamos a agregar la primera taza de harina junto con la cucharadita de polvo para hornear, tamizándolos con un coladorcito.  Mezclamos, esta vez sí con una espátula y movimientos envolventes.\r\n\r\n5- Una vez que se incorporó todo bien, agregamos al segunda taza de harina y repetimos el procedimiento de mezclado.\r\n\r\nAhora viene el momento en el que nos toca evaluar cuán espesa nos quedó la mezcla (en el video se puede ver una referencia, pero igual confíen en sus criterios bizcochueleros).\r\n\r\nSi ven que les quedó muy espeso, pueden ir agregando chorritos de leche de a poquito hasta que la mezcla consiga la consistencia deseada. por el contrario, si ven que quedó muy líquido, se hace lo mismo pero con la harina.\r\n\r\n6- Una vez que la mezcla consiguió la consistencia ideal, nos queda enmantecar y enharinar un molde y volcarla adentro sin más rodeos.\r\n\r\n7- Al horno 180º por entre 40 y 50 min aproximadamente. ¡Sean pacientes! dejen el horno cerrado hasta que pasen los primeros 40 min porque sino nuestra maravillosa creación corre peligro de pincharse y no es lo que queremos.\r\n\r\n8- ¡Momento de la prueba del palito! Pasados los 40 minutos, podemos abrir el horno e introducir un palillo o cuchillo dentro del bizcochuelo, si sale seco, quiere decir que está listo y es momento de sacarlo. Sepan que antes de desmoldarlo es muy conveniente dejar que se entibie, para correr menos riesgo de que se rompa. A su vez, hay que no dejar se termine de enfriar para que el calor no lo humedezca.', 'bizcochuelojpg.jpg', 3, 1, 'Juan'),
(12, 'Taco', '° 250 grs de carne: puede ser peceto, nalga, la que más te guste\r\n° 1 cebolla morada mediana\r\n° 2 dientes de ajo\r\n° 1 chile fresco (opcional)\r\n° 1/2 pimiento o morrón rojo\r\n° 1/2 pimiento o morrón verde\r\n° Jugo de 1 lima o limón\r\n° 1 tomate mediano\r\n° Orégano\r\n° Chile seco (a gusto)\r\n° Sal y pimienta\r\n° Cilantro\r\n° Aceite neutro', '1. Cortar los morrones y la cebolla en juliana, el ajo y el chile bien bien pequeño y el tomate en cubitos. Reservar por separado.\r\n\r\n2. Cortar la carne en tiritas y en un bol salpimentar, agregar la mitad del zumo de lima o limón y dejar macerando unos 20 minutos. Si quieren, en este paso pueden hacer la magia que les guste para darle sabor a la carne: ponerle mostaza, un chorro de cerveza… Lo que ustedes quieran. La idea es que los tacos de carne queden bien sabrosos así que todo vale.\r\n \r\n3. En una sartén poner un chorro de aceite, el chile seco y el orégano y calentar unos 2 o 3 minutos. Agregar el ajo y el chile y sofreír unos minutos más.\r\n\r\n4. Agregar la carne y saltear. Después de 5 minutos, a mitad de cocción, sumar el tomate y terminar de cocinar.\r\n\r\n5. Por otro lado, saltear el resto de las verduras hasta que estén cocidas pero OJO: que estén firmes.\r\n\r\n6. Mezclar las dos preparaciones y rectificamos con sal y pimienta de ser necesario. Le agregamos el resto del zumo de lima o limón y el cilantro deshojado.', '2.jpg', 1, 1, 'Pedro ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region`
--

CREATE TABLE `region` (
  `id_region` int(11) NOT NULL,
  `pais` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `region`
--

INSERT INTO `region` (`id_region`, `pais`) VALUES
(1, 'Argentina'),
(2, 'Mexico'),
(3, 'Paraguay'),
(4, 'Venezuela'),
(6, 'España');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `id_tipo` int(11) NOT NULL,
  `nombre_t` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`id_tipo`, `nombre_t`) VALUES
(3, 'agridulce'),
(2, 'dulce'),
(1, 'salado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `pass` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `pass`) VALUES
(1, 'pibinhor', '12445'),
(9, 'pibi', '0'),
(10, 'gonza', '$2y$10$7uEMkPNpk9oQV'),
(11, 'gonzaa', '$2y$10$VaZSI2uVQ56O5PSnL9zlDe3Ewl5ojYvObG4dM8x2IbX5GrdY9LbgS'),
(12, 'pibinho', '$2y$10$ZpJAgvsYKDNa0QLreVd9QuKEGGnnSH.BjNzL.1x3f68noYVFIqo/S'),
(13, 'pibinj', '$2y$10$pDPeQMV1JVHd6WvDTzMPlOh8cBMTjtHRHjXapWIzbaQPJxmZtSGDm'),
(14, 'Luis', '$2y$10$KkDMYNKdVQlc4Nc2mwoaOevMtEccdQznHy1aFFK9OGdQO/6od/0iW'),
(15, 'Pedro', '$2y$10$JcyiLxkwDdzMUInMXiqFBe8vuy8wybw/TmmbcaDXGaP.Hr0D4CP.O'),
(16, 'pablo', '$2y$10$H9VAgU0CpQDxl63GqdxGO.SSRRNfq5z/emF27Y1pGCJMF7AlHJM.O'),
(17, 'Lucia', '$2y$10$kS9Cd6m4Na1O3MXU/tGyyee45hTIXeyz7ZTNjRDaIM5gXZNXXTmPO'),
(18, 'Alexis', '$2y$10$9AH/KMUR5pb05iMiTUSktenO9GIUxDe4On8Hi654cbX9ZSP65xaAm'),
(19, 'Maximiliano', '$2y$10$J8T3wD7mksYOUkJ29lUUDe5MX/Srdjp9msCvEpWEBaeZyOOHmAi5i'),
(20, 'tomas', '$2y$10$LpuhCM11/hxH0yHdvEJlku3XIDCTVowzUqlq49cvBLQljCTmdUlJ.'),
(21, 'Javier', '$2y$10$FzPVSTi7AxQXNuiEns8uA.3BROwRQdZVXtSwkD.XvAbCPnSofYceW'),
(22, 'juan', '$2y$10$ojwo2GLQJjOwe9ulxYflN.ZeBIs43s3CACNDYDgbONox9vkdEpaeq');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD PRIMARY KEY (`id_r`) USING BTREE,
  ADD KEY `FK_Tipo` (`id_tipo`) USING BTREE,
  ADD KEY `FK_Region` (`id_region`) USING BTREE;

--
-- Indices de la tabla `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id_region`) USING BTREE;

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id_tipo`) USING BTREE,
  ADD UNIQUE KEY `nombre_t` (`nombre_t`) USING BTREE;

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `recetas`
--
ALTER TABLE `recetas`
  MODIFY `id_r` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `region`
--
ALTER TABLE `region`
  MODIFY `id_region` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD CONSTRAINT `FK_Region` FOREIGN KEY (`id_region`) REFERENCES `region` (`id_region`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Tipo` FOREIGN KEY (`id_tipo`) REFERENCES `tipos` (`id_tipo`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
