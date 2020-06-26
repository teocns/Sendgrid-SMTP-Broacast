-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 26, 2020 alle 07:55
-- Versione del server: 10.4.11-MariaDB
-- Versione PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `broadcaster`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `broadcasts`
--

CREATE TABLE `broadcasts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `creation_timestamp` int(11) NOT NULL,
  `email_template_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `broadcasts`
--

INSERT INTO `broadcasts` (`id`, `user_id`, `creation_timestamp`, `email_template_id`) VALUES
(1, 1, 1593149519, 1),
(2, 1, 1593149853, 1),
(3, 1, 1593149875, 1),
(6, 1, 1593150041, 1),
(7, 1, 1593150060, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `broadcasts_email_tags`
--

CREATE TABLE `broadcasts_email_tags` (
  `broadcast_id` int(11) NOT NULL,
  `email_tags_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `broadcasts_email_tags`
--

INSERT INTO `broadcasts_email_tags` (`broadcast_id`, `email_tags_id`) VALUES
(6, 1),
(6, 3),
(6, 4),
(6, 5),
(6, 6),
(6, 7),
(6, 11),
(7, 1),
(7, 3),
(7, 4),
(7, 5),
(7, 6),
(7, 7),
(7, 11);

-- --------------------------------------------------------

--
-- Struttura della tabella `email_tags`
--

CREATE TABLE `email_tags` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `email_tags`
--

INSERT INTO `email_tags` (`id`, `user_id`, `tag`, `email`, `phone`) VALUES
(1, 1, 'cars', 'carsasdascxzxcz@gmail.com', '+3910293049'),
(2, 1, 'school', 'schooldasddsadsa@gmail.com', '+3910293049'),
(3, 1, 'bike', 'arthuraxton@gmail.com', '+3910293049'),
(4, 1, 'bike', 'blalblablalbalb0qw0@gmail.com', '+3910293049'),
(5, 1, 'cities', 'mrkgmaster@gmail.com', '+3910293049'),
(6, 1, 'cities', 'johndoedss919238@gmail.com', '+3910293049'),
(7, 1, 'landscapes', 'afsidfii213o210o@gmail.com', '+3910293049'),
(8, 1, 'trump', 'fas9duiwiwejsdfj@gmail.com', '+3910293049'),
(9, 1, 'putin', 'adsoiu9i210ie@gmail.com', '+3910293049'),
(10, 1, 'test', 'asd98fu901203o120o@gmail.com', '+3910293049'),
(11, 1, 'coool', 'das90fis0docspoco@gmail.com', '+3910293049');

-- --------------------------------------------------------

--
-- Struttura della tabella `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(11) NOT NULL,
  `html` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `email_templates`
--

INSERT INTO `email_templates` (`id`, `html`, `name`, `user_id`) VALUES
(1, 'This is the email text', 'Test template', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`) VALUES
(1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `broadcasts`
--
ALTER TABLE `broadcasts`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `email_tags`
--
ALTER TABLE `email_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `broadcasts`
--
ALTER TABLE `broadcasts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `email_tags`
--
ALTER TABLE `email_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
