-- phpMyAdmin SQL Dump
-- version 3.3.10
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-05-2011 a las 19:43:39
-- Versión del servidor: 5.5.11
-- Versión de PHP: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `cc51ag1_2011_1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contextos`
--

CREATE TABLE IF NOT EXISTS `contextos` (
  `id_contexto` int(255) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id_contexto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `contextos`
--

INSERT INTO `contextos` (`id_contexto`, `nombre`) VALUES
(1, 'Computer Science');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `criterios`
--

CREATE TABLE IF NOT EXISTS `criterios` (
  `id_criterio` int(255) NOT NULL AUTO_INCREMENT,
  `id_contexto` int(255) NOT NULL,
  `pregunta` text NOT NULL,
  `respuesta_1` text NOT NULL,
  `respuesta_2` text NOT NULL,
  `tamano_pack` int(11) NOT NULL,
  `costo_pack` int(11) NOT NULL,
  `costo_envio` int(11) NOT NULL,
  `bono_documento_enviado_validado` int(11) NOT NULL,
  `funcion_penalizacion_a` double NOT NULL,
  `funcion_penalizacion_b` double NOT NULL,
  `funcion_despenalizacion_a` double NOT NULL,
  `funcion_despenalizacion_b` double NOT NULL,
  `tamano_minimo_desafio` int(11) NOT NULL,
  PRIMARY KEY (`id_criterio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `criterios`
--

INSERT INTO `criterios` (`id_criterio`, `id_contexto`, `pregunta`, `respuesta_1`, `respuesta_2`, `tamano_pack`, `costo_pack`, `costo_envio`, `bono_documento_enviado_validado`, `funcion_penalizacion_a`, `funcion_penalizacion_b`, `funcion_despenalizacion_a`, `funcion_despenalizacion_b`, `tamano_minimo_desafio`) VALUES
(1, 1, '&#x00bf;Es correcta esta afirmaci&oacute;n?', 'Si', 'No', 5, 1, 1, 1, 1, 1, 1, -1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE IF NOT EXISTS `documentos` (
  `id_documento` int(255) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `autor` int(255) NOT NULL COMMENT 'se refiere a id_usuario',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `id_dominio` int(255) NOT NULL COMMENT 'se refiere a id_contexto',
  `premiado_validacion` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_documento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Volcar la base de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id_documento`, `titulo`, `texto`, `autor`, `created`, `modified`, `id_dominio`, `premiado_validacion`) VALUES
(1, 'Minimum number of moves in a Hanoi Tower', 'What is the minimum number of moves required to move a Hanoi Tower of height $4$?\\n       1) [ ] $4$\\n       2) [ ] $4*\\\\lg 4=4*2=8$\\n       3) [ ] $4!=4*3*2*1 = 24$\\n       4) [ ] $2^4 = 32$\\n       5) [X] none of the above', 2, '2011-05-02 12:08:02', '2011-05-02 12:08:02', 1, 0),
(2, 'Minimum number of moves in a Disk Pile', 'What is the minimum number of moves required to move a disk pile\\n     of height $8$?\\n       1) [X] $8$\\n       2) [ ] $8*\\\\lg 8=8*3=24$\\n       3) [ ] $2^8$\\n       4) [ ] $8!=8*7*6*5*4*3*2*1=?$\\n       5) [ ] none of the above', 2, '2011-05-02 12:08:18', '2011-05-02 12:08:18', 1, 0),
(3, 'Nodos internos', '¿Cuántos árboles binarios distintos se pueden construir con 3 nodos internos?\\n\r\n1. [ ] 1\\n2. [ ] 3\\n3. [ ] 4\\n4. [ ] 6\\n5. [X] otra', 2, '2011-05-02 12:10:58', '2011-05-02 18:33:42', 1, 0),
(4, 'Arboles Binarios, nodos internos externos', 'Si se define \\n      - $i =$ n&uacute;mero de nodos internos,\\n      - $e =$ n&uacute;mero de nodos externos, \\n      entonces se tiene que:\\n      1. [ ] $i = e$\\n      2. [X] $e = i+1$\\n      3. [ ] $i = e+1$\\n      4. [ ] $e = 2^i$\\n      5. [ ] sin relaci&oacute;n', 2, '2011-05-02 12:11:23', '2011-05-02 12:11:23', 1, 0),
(5, 'Arboles Binarios, Suma largo de caminos hacia nodo', 'Sea $n =$ n&uacute;mero de nodos internos. Se define:\\n     * $I_n =$ suma del largo de los caminos desde la ra&iacute;z a cada nodo\\n       interno (largo de caminos internos).\\n     * $E_n =$ suma del largo de los caminos desde la ra&iacute;z a cada nodo\\n       externo (largo de caminos externos).\\n    Se tiene que:\\n     1. [ ] $E_n = I_n$\\n     2. [X] $E_n = I_n+1$\\n     3. [ ] $E_n = I_n+n$\\n     4. [ ] $E_n = I_n+2n$\\n     5. [ ] sin relaci&oacute;n', 2, '2011-05-02 12:11:46', '2011-05-02 12:11:46', 1, 0),
(6, 'Heap', 'La caracter&iacute;stica que permite que un heap se pueda almacenar\\nsin punteros es que, si se utiliza la numeraci&oacute;n por niveles\\nindicada, entonces la(s) relaci&oacute;n(es) entre padres e hijos es\\n(son):\\n\\n      1. [X] Hijos del nodo $j = \\\\{2*j, 2*j+1\\\\}$\\n      2. [ ] Padre del nodo $k = \\\\lfloor k/2 \\\\rfloor$ \\n      3. [X] Hijos del nodo $j = \\\\{2*j-1, 2*j\\\\}$\\n      4. [ ] Padre del nodo $k = \\\\lfloor k/2 \\\\rfloor+1$ \\n      5. [ ] ningunos', 2, '2011-05-02 12:12:10', '2011-05-02 12:12:10', 1, 0),
(7, 'altura de un AVL', ' La altura de un AVL con $n$ elementos es  \\n      1. [ ] $\\\\log_\\\\phi(n+1)+\\\\Theta(1)$\\n      2. [ ] en $O(\\\\lg n)$\\n      3. [ ] en $\\\\Omega(\\\\lg n)$\\n      4. [X] en $\\\\Theta(\\\\lg n)$\\n      5. [ ] ningunos o mas que dos', 2, '2011-05-02 12:12:35', '2011-05-02 12:12:35', 1, 0),
(8, 'Relacion hijos/llaves en la raiz de un $B$ arboles', 'Si un nodo de un $B$ arbol tiene $d$ llaves, cu&aacute;ntos hijos\\ntiene (como m&aacute;ximo)?\\n      1. [ ] $d-1$\\n      2. [ ] $d$\\n      3. [ ] $d+1$\\n      4. [X] $2d+1$\\n      5. [ ] otra respuesta', 2, '2011-05-02 12:12:57', '2011-05-02 12:12:57', 1, 0),
(9, 'Definicion de la mediana', 'Dado un arreglo de $n$ enteros, cual es la definicion correcta\\nde la mediana?\\n      1. [ ] El promedio de las valores minima y maxima del arreglo.\\n      2. [ ] La valor en el centro del arreglo.\\n      3. [X] La valor en el centro del arreglo ordenado.\\n      4. [ ] La valor superior a $\\\\lceil(n-1)/2\\\\rceil$ valores y inferior a $\\\\lfloor(n-1)/2\\\\rfloor$ valores. \\n      5. [ ] otra respuesta.', 2, '2011-05-02 12:13:19', '2011-05-02 12:13:19', 1, 0),
(10, 'Relacion entre codificacion y busqueda', 'Cual de estas aserciones es falsa en el modelo de comparacion?\\n      1. [X] A cada algoritmo de busqueda corresponde una codificacion\\n             de enteros.\\n      2. [ ] A cada codificacion de enteros corresponde un algoritmo\\n             de busqueda.\\n      3. [ ] A algunos algoritmos de busqueda corresponde una\\n             codificacion de enteros\\n      4. [ ] A algunas codificaciones de enteros corresponde un\\n             algoritmo de busqueda.\\n      5. [ ] otra', 2, '2011-05-02 12:13:38', '2011-05-02 12:13:38', 1, 0),
(11, 'Cuanto se demora una instruccion?', 'Un CPU funciona a 4 GHz: cuanto se demora una instruccion?\\n(elija el valor mas cercano).\\n      1. [X] 1 nano segundo\\n      2. [ ] 1 micro segundo\\n      3. [ ] 1 mili segundo\\n      4. [ ] 1 centi segundo\\n      5. [ ] otra respuesta', 2, '2011-05-02 12:13:59', '2011-05-02 12:13:59', 1, 0),
(12, 'Cota Inferior para Max', 'Dado un arreglo de $n$ enteros, cuanto comparaciones entre los\\nelementos del arreglo se necesitan para calcular su valor\\nmaximal?\\n      1. [ ] $0$\\n      2. [ ] $1$\\n      3. [X] $n-1$\\n      4. [ ] $n$\\n      5. [ ] otra respuesta', 2, '2011-05-02 12:14:23', '2011-05-02 12:14:23', 1, 0),
(13, 'Definicion de un arbol de decisi&oacute;n', 'Un arbol de decision es definido como un arbol\\n      1. [ ] que modela algoritmos en el modelo de\\n             comparacion.\\n      2. [ ] binario donde cada hoja identifica una instancia.\\n      3. [ ] binario donde cada nodo prueba una caracteristica de la\\n             instancia.\\n      4. [X] un arbol de grado finito donde cada hoja indica una\\n             decision sobre la instancia.\\n      5. [ ] otra.', 2, '2011-05-02 12:14:38', '2011-05-02 12:14:38', 1, 0),
(15, 'Cota superior de (la complejidad de) Max ord', 'Dado un arreglo ordenado de $n$ enteros, en cuanto accessos al\\narreglo pueden  calcular su valor maximal?\\n      1. [ ] $0$\\n      2. [ ] $1$\\n      3. [ ] $n-1$\\n      4. [ ] $n$\\n      5. [ ] otra', 2, '2011-05-04 16:23:56', '2011-05-04 16:23:56', 1, 0),
(16, 'Cota *superior* de (la complejidad de) Min Max', 'Dado un arreglo de $n$ enteros, en cuanto comparaciones\\n(cantidad exacta, no asimptotica) entre los elementos del\\narreglo pueden calcular su valor maximal y minimal?\\n      1. [ ] $n-1$\\n      2. [X] $3n/2-2$ si $n$ es par, $3n/2 + 1/2$ si $n$ es impar.\\n      3. [ ] $(n-1)+(n-2)$\\n      4. [ ] $2(n-1)$\\n      5. [ ] otra respuesta', 2, '2011-05-04 16:24:58', '2011-05-04 16:24:58', 1, 0),
(17, 'Juego de las preguntas, $n=4$', '      Cuanta preguntas (e.g. &quot;$x&lt;4$?&quot;, &quot;x=2&quot;?)  se necesitan para\\n      adivinar un entero entre $1$ y $4 (i.e. $x\\\\in[1..4]$)?\\n      1. [ ] 1\\n      2. [ ] 2\\n      3. [X] 3\\n      4. [ ] 4\\n      5. [ ] otra', 2, '2011-05-04 16:30:11', '2011-05-04 16:30:11', 1, 0),
(18, 'Tecnicas de cotas inferiores', 'Cual(es) de las tecnicas siguentes permitten de mostrar cotas\\n      inferiores para la complejidad en promedio?\\n	1. [ ] lemma del ave\\n	2. [ ] Estrategia de Adversario\\n	3. [ ] Arbol Binario de Decision\\n	4. [X] lemma del minimax\\n	5. [ ] ningunas o mas de dos.', 2, '2011-05-04 16:40:04', '2011-05-04 16:40:04', 1, 0),
(19, 'vEB aux tree', 'El rol de $aux$ (o $summary$, como fue visto en la auxiliar) es de \\nmemorizar cuales hijos est&aacute;n vac&iacute;os.  $j\\\\in aux$ si y s&oacute;lo si\\n$T.C[j]$ es no vac&iacute;o.  Cu&aacute;l es el principal objetivo de esto?\\n      1. [ ] Optimizar Find\\n      2. [ ] Optimizar Insert\\n      3. [ ] Optimizar LookUp\\n      4. [X] Optimizar FindNext\\n      5. [ ] otra respuesta', 2, '2011-05-04 16:45:07', '2011-05-04 16:45:07', 1, 0),
(20, 'vEB queues: cantidad de hijos', 'Cuanto hijos tiene la ra&iacute;z de un vEB?\\n      1. [ ] $2$\\n      2. [ ] $B$\\n      3. [ ] $B+1$\\n      4. [ ] $\\\\sqrt{B}$\\n      4. [X] $\\\\sqrt{n}$\\n      5. [ ] otra respuesta', 2, '2011-05-04 16:46:29', '2011-05-04 16:46:29', 1, 0),
(21, 'External Sorting', 'MergeSort en su versi&oacute;n para memoria secundaria toma $\\\\Theta(n \\\\log_m n)$ accesos a memoria secundaria para ordenar $n$ p&aacute;ginas en $m$ p&aacute;ginas de memoria local', 2, '2011-05-04 16:48:01', '2011-05-04 16:48:01', 1, 0),
(22, 'Complejidad de Insertion Sort en Memoria Secundari', 'El algoritmo de =Insertion Sort=, con un $B$-arbol, permite de\\nordenar $N$ elementos en\\n\\n      1. [ ] al menos $N \\\\lg N / \\\\lg B = N \\\\log_B N$  accesos \\n      2. [X] exactamente $N \\\\lg N / \\\\lg B = N \\\\log_B N$  accesos \\n      3. [ ] al maximo $N \\\\lg N / \\\\lg B = N \\\\log_B N$  accesos \\n      4. [ ] menos que $N \\\\lg N / \\\\lg B = N \\\\log_B N$  accesos \\n      5. [ ] otra respuesta', 2, '2011-05-04 16:49:22', '2011-05-04 16:49:22', 1, 0),
(23, 'Complejidad de Heap Sort en Memoria Secundaria', 'El algoritmo de =Heap Sort=, con un vEB-cola de prioridad,\\npermite de ordenar $N$ elementos en\\n\\n      1. [ ] al menos $N \\\\lg N / \\\\lg B = N \\\\log_B N$  accesos \\n      2. [X] exactamente $N \\\\lg N / \\\\lg B = N \\\\log_B N$  accesos \\n      3. [ ] al maximo $N \\\\lg N / \\\\lg B = N \\\\log_B N$  accesos \\n      4. [ ] menos que $N \\\\lg N / \\\\lg B = N \\\\log_B N$  accesos \\n      5. [ ] otra respuesta', 2, '2011-05-04 16:50:15', '2011-05-04 16:50:15', 1, 0),
(24, 'Cota inferior de ordenamiento en memoria secundari', 'Cual de estas cotas inferiores para el problema de ordenar en\\n      memoria segundaria parece la mas razonable?\\n\\n      1. [X] $\\\\Omega( N/B \\\\frac{ \\\\lg(N/B) }{ \\\\lg(M/B) }  )$\\n      2. [ ] $\\\\Omega( n\\\\lg_m n )$      \\n      3. [ ] $\\\\Omega(N \\\\lg N / \\\\lg B)$\\n      4. [ ] $\\\\Omega(N \\\\log_B N)$\\n      5. [ ] otra respuesta', 2, '2011-05-04 16:51:14', '2011-05-04 16:51:14', 1, 0),
(25, 'Ordenar (a dentro de las) paginas', '      Cual es el costo asint&oacute;tico (en cantidad de accesos a la memoria\\n      secundaria) de ordenar cada bloque (pagina) de $B$ elementos?\\n\\n      1. [X] $n = N/B$\\n      2. [ ] $N = n\\\\times B$\\n      3. [ ] $n \\\\times B\\\\lg B$\\n      4. [ ] $N \\\\times B\\\\lg B$\\n      5. [ ] otra respuesta', 2, '2011-05-04 16:52:13', '2011-05-04 16:52:13', 1, 0),
(26, 'Cota inferior ordenamiento en memoria secundaria', 'Que significa que $t \\\\geq n \\\\log_m n$ ?\\n\\n      1. [ ] No se puede ordenar en menos que $n \\\\log_m n$ comparaciones.\\n      2. [X] No se puede ordenar en menos que $n \\\\log_m n$ accesos a la memoria secundaria.\\n      3. [ ] Se puede ordenar en menos que $n \\\\log_m n$ comparaciones.\\n      4. [ ] Se puede ordenar en menos que $n \\\\log_m n$ accesos a la memoria secundaria.\\n      5. [ ] otra respuesta', 2, '2011-05-04 16:53:31', '2011-05-04 16:53:31', 1, 0),
(27, 'Ordenamiento en Memoria Secundaria: Cota superior', 'Cual(es) de los algoritmos siguentes, en su variante adaptada a la\\nmemoria secundaria, permite(n) de ordenar $N$ elementos en\\n$O(N\\\\log_B N)$ accesos a la memoria secundaria en el peor caso?\\n\\n      1. [ ] Insertion Sort\\n      2. [ ] Merge Sort\\n      3. [ ] Heap Sort\\n      4. [X] Bubble Sort\\n      5. [ ] otra respuesta', 2, '2011-05-04 16:55:34', '2011-05-04 16:55:34', 1, 0),
(28, 'Ordenamiento en Memoria Secundaria: Cota superior', '      Cual(es) de los algoritmos siguentes, en su variante adaptada a la\\n      memoria secundaria, permite(n) de ordenar $N$ elementos en\\n      $O(n\\\\log_m n)$ accesos a la memoria secundaria en el peor caso?\\n\\n      1. [ ] Insertion Sort\\n      2. [X] Merge Sort\\n      3. [ ] Heap Sort\\n      4. [ ] Bubble Sort\\n      5. [ ] otra respuesta', 2, '2011-05-04 16:56:28', '2011-05-04 16:56:28', 1, 0),
(29, 'Torneo Orden: Cota inferior', 'El torneo internacional de Karate se tiene en una isla con\\ncapacidad por $M=20$ participantes. Una sola nave puede traer\\nlos $N=200$ participantes, que pudede transportar $B=5$\\nparticipantes al mismo tiempo. Se supone que los niveles de los\\nparticipantes corresponden a un orden total, de manera a ce que\\nse pueden ordenar completamente.\\n      - $M=20$\\n      - $N=200$\\n      - $B=5$\\n\\n      \\nCuantos viajes de la nave se necessitan en total para\\nidentificar el orden total sobre los $2M=40$ mejores participantes\\ndel torneo, en el peor caso?\\n\\n      1. [ ] $\\\\log_B N$\\n      2. [X] $N/B$\\n      3. [ ] $N\\\\log_B N$\\n      4. [ ] $N/B + N\\\\log_B N$\\n      5. [ ] otra respuesta', 2, '2011-05-04 16:59:03', '2011-05-04 16:59:03', 1, 0),
(30, 'Torneo Orden: Cota inferior', '      El torneo internacional de Karate se tiene en una isla con\\n      capacidad por $M=20$ participantes. Una sola nave puede traer\\n      los $N=200$ participantes, que pudede transportar $B=5$\\n      participantes al mismo tiempo. Se supone que los niveles de los\\n      participantes corresponden a un orden total, de manera a ce que\\n      se pueden ordenar completamente.\\n      - $M=20$\\n      - $N=200$\\n      - $B=5$\\n      :END:\\n      \\n      Cuantos viajes de la nave se necessitan en total para\\n      identificar el orden total del torneo, en el peor caso?\\n\\n      1. [ ] $\\\\log_B N$\\n      2. [ ] $N/B$\\n      3. [ ] $N\\\\log_B N$\\n      4. [ ] $N/B + N\\\\log_B N$\\n      5. [X] otra respuesta', 2, '2011-05-04 17:00:02', '2011-05-04 17:00:02', 1, 0),
(31, ' Torneo Vencedor: Cota inferior en el peor caso', '      El torneo internacional de Karate se tiene en una isla con\\n      capacidad por $M=20$ participantes. Una sola nave puede traer\\n      los $N=200$ participantes, que pudede transportar $B=5$\\n      participantes al mismo tiempo. Se supone que los niveles de los\\n      participantes corresponden a un orden total, de manera a ce que\\n      se pueden ordenar completamente.\\n      - $M=20$\\n      - $N=200$\\n      - $B=5$\\n      :END:\\n      \\n      Cuantos viajes de la nave se necessitan en total para\\n      identificar el ganador del torneo, en el peor caso?\\n      1. [ ] $\\\\log_B N$\\n      2. [X] $N/B$\\n      3. [ ] $N\\\\log_B N$\\n      4. [ ] $N/B + N\\\\log_B N$\\n      5. [ ] otra respuesta', 2, '2011-05-04 17:01:33', '2011-05-04 17:01:33', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expertos`
--

CREATE TABLE IF NOT EXISTS `expertos` (
  `id_experto` int(255) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(255) NOT NULL,
  `id_contexto` int(255) NOT NULL,
  PRIMARY KEY (`id_experto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `expertos`
--

INSERT INTO `expertos` (`id_experto`, `id_usuario`, `id_contexto`) VALUES
(1, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacion_desafios`
--

CREATE TABLE IF NOT EXISTS `informacion_desafios` (
  `id_estadisticas` int(255) NOT NULL AUTO_INCREMENT,
  `id_documento` int(255) NOT NULL,
  `id_criterio` int(255) NOT NULL,
  `total_respuestas_1_no_validado` int(255) NOT NULL,
  `total_respuestas_2_no_validado` int(255) NOT NULL,
  `respuesta_oficial_de_un_experto` tinyint(1) DEFAULT NULL,
  `total_respuestas_1_como_desafio` int(255) NOT NULL,
  `total_respuestas_2_como_desafio` int(255) NOT NULL,
  `confirmado` tinyint(1) NOT NULL,
  `preguntable` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_estadisticas`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Volcar la base de datos para la tabla `informacion_desafios`
--

INSERT INTO `informacion_desafios` (`id_estadisticas`, `id_documento`, `id_criterio`, `total_respuestas_1_no_validado`, `total_respuestas_2_no_validado`, `respuesta_oficial_de_un_experto`, `total_respuestas_1_como_desafio`, `total_respuestas_2_como_desafio`, `confirmado`, `preguntable`) VALUES
(1, 1, 1, 0, 0, 1, 8, 1, 1, 1),
(2, 2, 1, 0, 0, 1, 8, 3, 1, 1),
(3, 3, 1, 0, 0, 1, 8, 2, 1, 1),
(4, 4, 1, 0, 0, 1, 3, 0, 1, 1),
(5, 5, 1, 0, 0, 0, 3, 8, 1, 1),
(6, 6, 1, 0, 0, 1, 5, 4, 1, 1),
(7, 7, 1, 0, 0, 1, 0, 0, 1, 0),
(8, 8, 1, 0, 0, 1, 0, 0, 1, 0),
(9, 9, 1, 1, 2, NULL, 0, 0, 0, 1),
(10, 10, 1, 0, 0, 1, 0, 0, 1, 0),
(11, 11, 1, 0, 0, NULL, 0, 0, 0, 1),
(12, 12, 1, 3, 1, NULL, 0, 0, 0, 1),
(13, 13, 1, 2, 2, NULL, 0, 0, 0, 1),
(15, 15, 1, 0, 0, NULL, 0, 0, 0, 1),
(16, 16, 1, 1, 0, NULL, 0, 0, 0, 1),
(17, 17, 1, 0, 0, NULL, 0, 0, 0, 1),
(18, 18, 1, 0, 0, NULL, 0, 0, 0, 1),
(19, 19, 1, 1, 0, NULL, 0, 0, 0, 1),
(20, 20, 1, 0, 0, NULL, 0, 0, 0, 1),
(21, 21, 1, 0, 0, NULL, 0, 0, 0, 1),
(22, 22, 1, 0, 0, NULL, 0, 0, 0, 1),
(23, 23, 1, 0, 0, NULL, 0, 0, 0, 1),
(24, 24, 1, 0, 0, NULL, 0, 0, 0, 1),
(25, 25, 1, 1, 0, NULL, 0, 0, 0, 1),
(26, 26, 1, 0, 0, NULL, 0, 0, 0, 1),
(27, 27, 1, 1, 0, NULL, 0, 0, 0, 1),
(28, 28, 1, 1, 0, NULL, 0, 0, 0, 1),
(29, 29, 1, 0, 0, NULL, 0, 0, 0, 1),
(30, 30, 1, 0, 0, NULL, 0, 0, 0, 1),
(31, 31, 1, 0, 0, NULL, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `asociacion_id` int(255) NOT NULL AUTO_INCREMENT,
  `id_documento` int(255) NOT NULL,
  `tag` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`asociacion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=112 ;

--
-- Volcar la base de datos para la tabla `tags`
--

INSERT INTO `tags` (`asociacion_id`, `id_documento`, `tag`) VALUES
(1, 1, 'hanoi'),
(2, 1, 'hanoi-tower'),
(3, 1, 'torre-de-hanoi'),
(4, 1, 'min'),
(5, 1, 'moves'),
(6, 1, 'minimum'),
(7, 2, 'disk-pile'),
(8, 2, 'pila-de-discos'),
(9, 2, 'moves'),
(10, 2, 'min'),
(11, 2, 'minimum'),
(12, 3, 'arbol-binario'),
(13, 3, 'nodos'),
(14, 3, 'nodo-interno'),
(15, 3, 'catalan'),
(16, 4, 'arbol-binario'),
(17, 4, 'nodo'),
(18, 4, 'nodo-interno'),
(19, 4, 'nodo-externo'),
(20, 5, 'nodo-interno'),
(21, 5, 'nodo-externo'),
(22, 5, 'arbol-binario'),
(23, 6, 'heap'),
(24, 6, 'arreglo'),
(25, 6, 'definicion'),
(26, 6, 'padre'),
(27, 6, 'hijo'),
(28, 7, 'avl'),
(29, 7, 'altura'),
(30, 7, 'arbol-binario'),
(31, 8, 'b-tree'),
(32, 8, 'b-arbol'),
(33, 8, 'llave'),
(34, 8, 'hijo'),
(35, 9, 'mediana'),
(36, 9, ' arreglo'),
(37, 10, 'codificacion'),
(38, 10, ' busqueda'),
(39, 11, 'hardware'),
(40, 11, 'hw'),
(41, 11, 'cpu'),
(42, 12, 'cota-inferior'),
(43, 12, ' max'),
(44, 12, ' arreglo'),
(45, 12, ' comparacion'),
(46, 13, 'arbol'),
(47, 13, 'arbol-de-desicion'),
(48, 13, 'definicion'),
(50, 15, 'maximo'),
(51, 15, 'arreglo'),
(52, 15, 'comparaciones'),
(53, 16, 'arreglo'),
(54, 16, 'maximo'),
(55, 16, 'minimo'),
(56, 16, 'comparaciones'),
(57, 17, 'comparaciones'),
(58, 17, 'arreglo'),
(59, 18, 'cota-inferior'),
(60, 18, 'promedio'),
(61, 18, 'minimax'),
(62, 19, 'veb'),
(63, 19, 'tree'),
(64, 19, 'priority-queue'),
(65, 19, 'find'),
(66, 20, 'veb'),
(67, 20, 'tree'),
(68, 20, 'priority-queue'),
(69, 21, 'mergesort'),
(70, 21, 'sort'),
(71, 21, 'memoria-secundaria'),
(72, 22, 'insertionsort'),
(73, 22, 'memoria-secundaria'),
(74, 22, 'sort'),
(75, 23, 'heapsort'),
(76, 23, 'memoria-secundaria'),
(77, 23, 'veb'),
(78, 23, 'priority-queue'),
(79, 23, 'tree'),
(80, 24, 'cota-inferior'),
(81, 24, 'memoria-secundaria'),
(82, 24, 'sort'),
(83, 25, 'sort'),
(84, 25, 'memoria-secundaria'),
(85, 26, 'sort'),
(86, 26, 'memoria-secundaria'),
(87, 26, 'cota-inferior'),
(88, 27, 'sort'),
(89, 27, 'memoria-secundaria'),
(90, 27, 'cota-superior'),
(91, 27, 'insertionsort'),
(92, 27, 'mergesort'),
(93, 27, 'heapsort'),
(94, 28, 'sort'),
(95, 28, 'memoria-secundaria'),
(96, 28, 'cota-superior'),
(97, 28, 'insertionsort'),
(98, 28, 'mergesort'),
(99, 28, 'heapsort'),
(100, 29, 'torneo'),
(101, 29, 'memoria-secundaria'),
(102, 29, 'orden total'),
(103, 29, 'sort'),
(104, 30, 'cota-inferior'),
(105, 30, 'sort'),
(106, 30, 'mergesort'),
(107, 31, 'cota-inferior'),
(108, 31, 'sort'),
(109, 31, 'mergesort'),
(110, 31, 'maximo'),
(111, 31, 'max');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tamano_desafios`
--

CREATE TABLE IF NOT EXISTS `tamano_desafios` (
  `id_desafio` int(255) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(255) NOT NULL,
  `id_criterio` int(255) NOT NULL,
  `c_preguntas` int(11) NOT NULL,
  PRIMARY KEY (`id_desafio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `tamano_desafios`
--

INSERT INTO `tamano_desafios` (`id_desafio`, `id_usuario`, `id_criterio`, `c_preguntas`) VALUES
(1, 1, 1, 3),
(2, 2, 1, 3),
(3, 3, 1, 3),
(4, 4, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(255) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `apellido` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(128) NOT NULL,
  `puntos` int(11) NOT NULL DEFAULT '0',
  `es_administrador` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `email`, `nombre`, `apellido`, `password`, `salt`, `puntos`, `es_administrador`, `created`, `modified`) VALUES
(1, 'anon', 'Usuario', 'Anonimo', '', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'admin@example.com', 'Cosme', 'Fulanito', '27d72e1cd36030cf28bf8f88798a8c46f82edf19', '1293479951', 0, 1, '2011-05-02 12:06:34', '2011-05-02 12:06:34'),
(3, 'test@example.com', 'Bolainas', 'Burns', '8bb7557d9bea26a7c855abe67d24fc0f93738398', '2135602299', 0, 0, '2011-05-02 12:06:17', '2011-05-02 12:06:17'),
(4, 'expert@example.com', 'Juan Bautista', 'Sabadú Szyslak', '81cf342a0c4a0fa8de2ae8185ca845ed1e930fea', '388886542', 0, 0, '2011-05-02 12:06:51', '2011-05-04 19:22:24');
