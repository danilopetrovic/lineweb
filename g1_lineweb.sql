-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2017 at 07:07 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `g1_lineweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `galerije`
--

CREATE TABLE `galerije` (
  `id` int(3) UNSIGNED NOT NULL,
  `nazivGalerije` varchar(250) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `galerije`
--

INSERT INTO `galerije` (`id`, `nazivGalerije`, `autor`, `datum`) VALUES
(3, 'Letovanje 2017', 'bbosko', '2017-03-25 16:47:27'),
(4, 'Letovanje 2016', 'bbosko', '2017-03-25 16:50:39'),
(5, 'Poseta manastirima srbije 26 Mart 2017 god............', 'bbosko', '2017-03-25 23:13:41'),
(6, 'Ovo je neki test cisto da vidim kako ce izgledati kada ima puno reci....!!!!!!', 'bbosko', '2017-03-25 23:17:45'),
(7, 'Jos neka galerija', 'bbosko', '2017-03-25 23:29:11'),
(8, 'AAA', 'bbosko', '2017-03-25 23:29:15'),
(9, 'galerijaaaaa', 'bbosko', '2017-03-25 23:29:19');

-- --------------------------------------------------------

--
-- Table structure for table `galerijeslike`
--

CREATE TABLE `galerijeslike` (
  `id` int(3) UNSIGNED NOT NULL,
  `idGalerije` int(3) NOT NULL,
  `slika` varchar(100) NOT NULL,
  `komentar` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `galerijeslike`
--

INSERT INTO `galerijeslike` (`id`, `idGalerije`, `slika`, `komentar`) VALUES
(3, 4, 'bbosko_2017.03.25-19.02.20_1.jpg', ''),
(4, 4, 'bbosko_2017.03.25-19.02.20_2.jpg', ''),
(5, 3, 'bbosko_2017.03.25-19.04.18_1.jpg', ''),
(6, 3, 'bbosko_2017.03.25-19.04.18_2.jpg', ''),
(7, 4, 'bbosko_2017.03.25-19.04.41_1.jpg', 'ovo je neka slika'),
(8, 4, 'bbosko_2017.03.25-19.04.41_2.jpg', 'darth vader'),
(9, 3, 'bbosko_2017.03.25-19.14.33_1.jpg', 'aaaaaa'),
(10, 3, 'bbosko_2017.03.25-19.14.33_2.jpg', 'bbbbb'),
(11, 4, 'bbosko_2017.03.26-3.20.09_1.jpg', 'neki komentarcic'),
(12, 4, 'bbosko_2017.03.26-3.20.09_2.gif', 'ajkula haker'),
(13, 7, 'bbosko_2017.03.27-23.11.22_1.jpg', 'oziljci od kompa'),
(14, 7, 'bbosko_2017.03.27-23.11.22_2.jpg', 'neki ludacki smajli....'),
(15, 9, 'bbosko_2017.03.27-23.11.44_1.jpg', 'slicica'),
(16, 9, 'bbosko_2017.03.27-23.11.44_2.jpg', ''),
(17, 4, 'bbosko_2017.03.27-23.12.54_1.jpg', ''),
(18, 4, 'bbosko_2017.03.27-23.12.54_2.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `kategorije`
--

CREATE TABLE `kategorije` (
  `id` int(2) UNSIGNED NOT NULL,
  `naziv` varchar(20) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategorije`
--

INSERT INTO `kategorije` (`id`, `naziv`, `last_update`) VALUES
(1, 'IT', '2017-04-19 23:07:48'),
(2, 'Sport', '2017-04-19 23:07:48'),
(3, 'Politika', '2017-04-19 23:07:48'),
(4, 'Zabava', '2017-04-19 23:07:48'),
(5, 'Hronika', '2017-04-19 23:08:13');

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

CREATE TABLE `komentari` (
  `id` int(4) UNSIGNED NOT NULL,
  `idVesti` int(3) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `tekst` text NOT NULL,
  `volime` int(3) NOT NULL DEFAULT '0',
  `nevolime` int(3) NOT NULL DEFAULT '0',
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`id`, `idVesti`, `autor`, `tekst`, `volime`, `nevolime`, `datum`) VALUES
(1, 72, 'Danilo', 'Prvi komentar 3ci pokusaj', 0, 0, '2017-02-27 21:37:43'),
(2, 72, 'Danilo', 'ajde jos komentara...', 0, 0, '2017-02-27 21:37:59'),
(3, 66, 'bbosko', 'komentar bla bla', 0, 0, '2017-02-27 21:38:17'),
(4, 67, 'luda ajkula', 'ajkula grize monitor od muke...', 0, 0, '2017-02-27 21:38:31'),
(5, 72, 'Danilo', 'drugi komentar ajde ajde ....', 0, 0, '2017-02-27 21:47:52'),
(6, 72, 'aaaaa', 'aaaaaa', 0, 0, '2017-02-27 21:50:21'),
(7, 67, 'fasd', 'asdf', 0, 0, '2017-03-05 21:51:48'),
(8, 76, 'ja ', 'neki novi komentar....', 0, 0, '2017-06-08 20:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(2) UNSIGNED NOT NULL,
  `korime` varchar(25) NOT NULL,
  `lozinka` varchar(256) NOT NULL,
  `ime` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `korime`, `lozinka`, `ime`, `status`) VALUES
(1, 'bbosko', 'c94885c644bc17599d3ae815af40db16d62aa17bdfff092e003b580e11573d31', 'Бошко Богојевић', 'Administrator'),
(2, 'danilo', 'e31ebe2fdd7cff7b9b7bb401ef942fae541890e874e3a6c458e1cb70974cdaea', 'Danilo Petrovic', 'Korisnik'),
(19, 'urednik', 'a571ee86a2275e38ec9ebbb43564048205bcc6ecf3c23b08d47dc9c759b701f4', 'Novi Korisnik', 'Urednik');

-- --------------------------------------------------------

--
-- Table structure for table `lineweb`
--

CREATE TABLE `lineweb` (
  `id` int(3) NOT NULL,
  `naslov` varchar(100) NOT NULL,
  `sadrzaj` text NOT NULL,
  `datum` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `autor` varchar(50) NOT NULL,
  `slika` varchar(100) DEFAULT NULL,
  `obrisan` int(1) NOT NULL DEFAULT '0',
  `id_kategorije` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lineweb`
--

INSERT INTO `lineweb` (`id`, `naslov`, `sadrzaj`, `datum`, `autor`, `slika`, `obrisan`, `id_kategorije`) VALUES
(1, 'Voz &quot;&#039;&amp; na dve &scaron;{ine', 'ima tu neki воз на 2 шine &#039;.++\r\n&#039; namerno kucam ovakve karaktere i radi!!!', '2017-02-06 11:22:40', 'Danilo', '1.jpg', 0, 1),
(2, 'Miki Oslep&#039;o', 'xxxxxxxxxxxxxx', '2017-02-06 14:22:40', 'Danilo Petrovic', 'danilo_2017.05.29-15.15.12.jpg', 0, 2),
(3, 'Treći naslov (трећи наслов)', 'Ово је трећи садржај и иде ћирилицом....\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2017-02-06 17:22:40', 'Danilo Petrovic', '', 0, 3),
(4, 'Nesto iz inserta', 'Neki sadrzaj iz Insert upita', '2017-02-19 16:02:59', 'Danilo Petrovic', NULL, 0, 1),
(5, 'Promenjeni naslov iz update upita', 'Promenjeni nasov iz UPDATE upita!', '2017-02-19 16:04:32', 'Danilo Petrovic', NULL, 0, 2),
(9, 'Naslov sa HTML stranice', 'Konacno sadrzaj iz HTML-a, Konacno sadrzaj iz HTML-a, Konacno sadrzaj iz HTML-a, Konacno sadrzaj iz HTML-a, Konacno sadrzaj iz HTML-a, Konacno sadrzaj iz HTML-a, Konacno sadrzaj iz HTML-a, Konacno sadrzaj iz HTML-a, Konacno sadrzaj iz HTML-a, Konacno sadrzaj iz HTML-a, Konacno sadrzaj iz HTML-a, Konacno sadrzaj iz HTML-a, Konacno sadrzaj iz HTML-a, Konacno sadrzaj iz HTML-a, Konacno sadrzaj iz HTML-a, Konacno sadrzaj iz HTML-a, Konacno sadrzaj iz HTML-a, Konacno sadrzaj iz HTML-a, Konacno sadrzaj iz HTML-a, Konacno sadrzaj iz HTML-a, Konacno sadrzaj iz HTML-a, Konacno sadrzaj iz HTML-a, Konacno sadrzaj iz HTML-a, ', '2017-02-19 21:09:54', 'HTML Danilo', '2.jpg', 0, 1),
(12, 'zmaj danilo', 'zmaj danilo je uspeo da odradi neku novu stvar!', '2017-02-20 22:21:02', 'Danilo Petrovic', 'danilo_2017.02.27-17.02.23.jpg', 0, 3),
(59, 'Naslov sa stranice zajedno sa slikom', 'sadrzaj sa slikom', '2017-02-24 20:06:53', 'Бошко Богојевић', NULL, 0, 1),
(62, 'Sa stranice zajedno sa slikom drugi pokusaj', 'sadrzaj sa slikom drugi pokusaj', '2017-02-24 20:13:55', 'Бошко Богојевић', 'bbosko_2017.02.24-20.13.55.jpg', 0, 1),
(63, 'Jos 1 naslov sa slikom iz forme', 'Sadrzaj sa slikom iz forme ....', '2017-02-24 20:17:59', 'Бошко Богојевић', 'bbosko_2017.02.24-20.17.59.jpg', 0, 3),
(65, 'Bio je ruzan naslov', 'Nije bilo normalnog sadrzaja...', '2017-02-24 20:46:29', 'Бошко Богојевић', 'bbosko_2017.02.24-20.46.29.gif', 0, 4),
(66, 'afgqerfds', 'gaqegfdvvq4egtrf', '2017-02-24 20:58:42', 'Бошко Богојевић', 'bbosko_2017.02.24-20.58.42.gif', 0, 3),
(67, 'NOVI NASLO SA IZMENOM IZ FORME', 'ajkula za kompom!!!! normalan sadrzaj sa normalnom slikom izmena iz forme... UPDATE u bazi....', '2017-02-27 14:42:56', 'Бошко Богојевић', 'bbosko_2017.02.27-16.42.32.gif', 0, 3),
(72, 'danilo naslov 3ci put izmena', 'danilo sadrzaj', '2017-02-27 16:55:24', 'Danilo Petrovic', 'danilo_2017.02.27-17.12.18.jpg', 0, 1),
(73, 'Miki Oslep&#039;o', 'xxxxxxxxxxxxxx', '2017-04-20 02:09:55', 'Danilo Petrovic', 'danilo_2017.04.20-2.09.55.jpg', 0, 2),
(74, 'paprika', 'paprika', '2017-04-20 02:48:48', 'Danilo Petrovic', 'bbosko_2017.06.11-18.14.09.gif', 0, 1),
(75, 'Nova Proba &#039; bla bla ', 'Tekst posle izmenjene baze..!!! nesto novo **', '2017-05-29 15:12:01', 'Danilo Petrovic', 'danilo_2017.05.29-13.12.01.jpg', 0, 1),
(76, 'Voz &quot;&#039;&amp; na dve &scaron;{ine', 'ima tu neki воз на 2 шine &#039;.++\r\n&#039; namerno kucam ovakve karaktere i radi!!!', '2017-05-29 16:21:36', 'Danilo Petrovic', 'danilo_2017.05.29-14.21.36.jpg', 0, 1),
(77, 'Lorem ipsum proba sadrzaja....', 'INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) VALUES (7, &#039;Prvi post koji je trebao da postoji :)&#039;, &#039;Danilo Petrovic&#039;, now(), &#039;slika2.png&#039;, &#039; What is Lorem Ipsum? Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Why do we use it? It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#039;Content here, content here&#039;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#039;lorem ipsum&#039; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). Where does it come from? Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham. &#039;, &#039;nesto, prvi post, bootstrap&#039;, &#039;4&#039;, &#039;Waiting&#039;)', '2017-06-17 22:24:06', 'Бошко Богојевић', 'bbosko_2017.06.17-20.24.06.png', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `galerije`
--
ALTER TABLE `galerije`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nazivGalerije_UNIQUE` (`nazivGalerije`);

--
-- Indexes for table `galerijeslike`
--
ALTER TABLE `galerijeslike`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategorije`
--
ALTER TABLE `kategorije`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentari`
--
ALTER TABLE `komentari`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_komentari_idlineweb_idx` (`idVesti`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korime_UNIQUE` (`korime`);

--
-- Indexes for table `lineweb`
--
ALTER TABLE `lineweb`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `galerije`
--
ALTER TABLE `galerije`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `galerijeslike`
--
ALTER TABLE `galerijeslike`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `kategorije`
--
ALTER TABLE `kategorije`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `komentari`
--
ALTER TABLE `komentari`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `lineweb`
--
ALTER TABLE `lineweb`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentari`
--
ALTER TABLE `komentari`
  ADD CONSTRAINT `fk_idvesti_idlineweb` FOREIGN KEY (`idVesti`) REFERENCES `lineweb` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
