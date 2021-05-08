-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Час створення: Трв 08 2021 р., 18:35
-- Версія сервера: 10.1.44-MariaDB
-- Версія PHP: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `airport`
--

-- --------------------------------------------------------

--
-- Структура таблиці `airport`
--

CREATE TABLE `airport` (
  `idAirport` int(11) NOT NULL,
  `Name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `City_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `airport`
--

INSERT INTO `airport` (`idAirport`, `Name`, `City_id`) VALUES
(1, 'Airport1', 1),
(2, 'Airport2', 2),
(3, 'Аеропорт імені ДжоДжо', 2);

-- --------------------------------------------------------

--
-- Структура таблиці `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `Name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Country` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `city`
--

INSERT INTO `city` (`id`, `Name`, `Country`) VALUES
(1, 'Львів', 'Україна'),
(2, 'Торонто', 'Канада'),
(3, 'Київ', 'Україна'),
(4, 'Варашава', 'Польща'),
(5, 'Вроцлав', 'Польща');

-- --------------------------------------------------------

--
-- Структура таблиці `hotel`
--

CREATE TABLE `hotel` (
  `id` int(11) NOT NULL,
  `Name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `City_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `hotel`
--

INSERT INTO `hotel` (`id`, `Name`, `City_id`) VALUES
(1, 'Прихисток анімешника', 1);

-- --------------------------------------------------------

--
-- Структура таблиці `plane`
--

CREATE TABLE `plane` (
  `id` int(11) NOT NULL,
  `Name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Count` int(11) NOT NULL,
  `Type_idType` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `plane`
--

INSERT INTO `plane` (`id`, `Name`, `Count`, `Type_idType`) VALUES
(1, 'Boing 747', 500, 1);

-- --------------------------------------------------------

--
-- Структура таблиці `receipt`
--

CREATE TABLE `receipt` (
  `id` int(11) NOT NULL,
  `ReceiptNumber` int(11) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Ticket_idTicket` int(11) NOT NULL,
  `User_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `receipt`
--

INSERT INTO `receipt` (`id`, `ReceiptNumber`, `Date`, `Ticket_idTicket`, `User_id`) VALUES
(1, 228228228, '2021-05-05 14:20:41', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблиці `reis`
--

CREATE TABLE `reis` (
  `id` int(11) NOT NULL,
  `ReisNumber` int(11) NOT NULL,
  `ReservedCount` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `ReisTimeFrom` datetime NOT NULL,
  `ReisTimeTo` datetime NOT NULL,
  `Plane_id` int(11) NOT NULL,
  `Airport_idAirportFrom` int(11) NOT NULL,
  `Airport_idAirportTo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `reis`
--

INSERT INTO `reis` (`id`, `ReisNumber`, `ReservedCount`, `ReisTimeFrom`, `ReisTimeTo`, `Plane_id`, `Airport_idAirportFrom`, `Airport_idAirportTo`) VALUES
(1, 1, '13', '2019-10-10 14:25:00', '2019-10-10 20:25:00', 1, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблиці `rooms`
--

CREATE TABLE `rooms` (
  `idrooms` int(11) NOT NULL,
  `Hotel_id` int(11) NOT NULL,
  `Roomtype_idRoomtype` int(11) NOT NULL,
  `CountRooms` int(11) NOT NULL,
  `CountUsers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `rooms`
--

INSERT INTO `rooms` (`idrooms`, `Hotel_id`, `Roomtype_idRoomtype`, `CountRooms`, `CountUsers`) VALUES
(1, 1, 1, 5, 10);

-- --------------------------------------------------------

--
-- Структура таблиці `rooms_has_user`
--

CREATE TABLE `rooms_has_user` (
  `rooms_idrooms` int(11) NOT NULL,
  `rooms_Hotel_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `roomtype`
--

CREATE TABLE `roomtype` (
  `idRoomtype` int(11) NOT NULL,
  `Name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `roomtype`
--

INSERT INTO `roomtype` (`idRoomtype`, `Name`) VALUES
(1, 'Люкс');

-- --------------------------------------------------------

--
-- Структура таблиці `ticket`
--

CREATE TABLE `ticket` (
  `idTicket` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `PlaceNumber` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Reis_id1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `ticket`
--

INSERT INTO `ticket` (`idTicket`, `Price`, `PlaceNumber`, `Reis_id1`) VALUES
(1, 120, '15', 1);

-- --------------------------------------------------------

--
-- Структура таблиці `type`
--

CREATE TABLE `type` (
  `idType` int(11) NOT NULL,
  `Name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `type`
--

INSERT INTO `type` (`idType`, `Name`) VALUES
(1, 'Пасажирський');

-- --------------------------------------------------------

--
-- Структура таблиці `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `Name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RegistrationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PassId` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Password` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `user`
--

INSERT INTO `user` (`id`, `Name`, `RegistrationDate`, `PassId`, `Password`, `Email`) VALUES
(1, 'Зубенко Михайло Петрович', '2021-05-05 08:56:18', '1111111-101010', '12345', '123@gmail.com'),
(2, 'Іванов Іван Іванович', '2021-05-05 10:54:29', '1211111-101010', 'qwerty', '234@gmail.com'),
(6, 'Lev Zykol', '2021-05-08 07:45:23', NULL, '123', 'levgenetic@gmail.com');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `airport`
--
ALTER TABLE `airport`
  ADD PRIMARY KEY (`idAirport`,`City_id`),
  ADD KEY `fk_Airport_City1_idx` (`City_id`);

--
-- Індекси таблиці `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id`,`City_id`),
  ADD KEY `fk_Hotel_City1_idx` (`City_id`);

--
-- Індекси таблиці `plane`
--
ALTER TABLE `plane`
  ADD PRIMARY KEY (`id`,`Type_idType`),
  ADD KEY `fk_Plane_Type1_idx` (`Type_idType`);

--
-- Індекси таблиці `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`id`,`Ticket_idTicket`,`User_id`),
  ADD KEY `fk_Receipt_Ticket1_idx` (`Ticket_idTicket`),
  ADD KEY `fk_User_Id_idx` (`User_id`);

--
-- Індекси таблиці `reis`
--
ALTER TABLE `reis`
  ADD PRIMARY KEY (`id`,`Plane_id`,`Airport_idAirportFrom`,`Airport_idAirportTo`),
  ADD KEY `fk_Reis_Plane1_idx` (`Plane_id`),
  ADD KEY `fk_Reis_Airport1_idx` (`Airport_idAirportFrom`),
  ADD KEY `fk_Reis_Airport2_idx` (`Airport_idAirportTo`);

--
-- Індекси таблиці `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`idrooms`,`Hotel_id`,`Roomtype_idRoomtype`),
  ADD KEY `fk_rooms_Hotel1_idx` (`Hotel_id`),
  ADD KEY `fk_rooms_Roomtype1_idx` (`Roomtype_idRoomtype`);

--
-- Індекси таблиці `rooms_has_user`
--
ALTER TABLE `rooms_has_user`
  ADD PRIMARY KEY (`rooms_idrooms`,`rooms_Hotel_id`,`User_id`),
  ADD KEY `fk_rooms_has_User_rooms1_idx` (`rooms_idrooms`,`rooms_Hotel_id`),
  ADD KEY `fk_rooms_has_User_UserID_idx` (`User_id`);

--
-- Індекси таблиці `roomtype`
--
ALTER TABLE `roomtype`
  ADD PRIMARY KEY (`idRoomtype`);

--
-- Індекси таблиці `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`idTicket`,`Reis_id1`),
  ADD KEY `fk_Ticket_Reis1_idx` (`Reis_id1`);

--
-- Індекси таблиці `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`idType`);

--
-- Індекси таблиці `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Name` (`Name`),
  ADD UNIQUE KEY `PassId_UNIQUE` (`PassId`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблиці `rooms`
--
ALTER TABLE `rooms`
  MODIFY `idrooms` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблиці `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `airport`
--
ALTER TABLE `airport`
  ADD CONSTRAINT `fk_Airport_City1` FOREIGN KEY (`City_id`) REFERENCES `city` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Обмеження зовнішнього ключа таблиці `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `fk_Hotel_City1` FOREIGN KEY (`City_id`) REFERENCES `city` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Обмеження зовнішнього ключа таблиці `plane`
--
ALTER TABLE `plane`
  ADD CONSTRAINT `fk_Plane_Type1` FOREIGN KEY (`Type_idType`) REFERENCES `type` (`idType`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Обмеження зовнішнього ключа таблиці `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `fk_User_Id` FOREIGN KEY (`User_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Обмеження зовнішнього ключа таблиці `reis`
--
ALTER TABLE `reis`
  ADD CONSTRAINT `fk_Reis_Plane1` FOREIGN KEY (`Plane_id`) REFERENCES `plane` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Обмеження зовнішнього ключа таблиці `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `fk_rooms_Hotel1` FOREIGN KEY (`Hotel_id`) REFERENCES `hotel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rooms_Roomtype1` FOREIGN KEY (`Roomtype_idRoomtype`) REFERENCES `roomtype` (`idRoomtype`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Обмеження зовнішнього ключа таблиці `rooms_has_user`
--
ALTER TABLE `rooms_has_user`
  ADD CONSTRAINT `fk_rooms_has_User_UserID` FOREIGN KEY (`User_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rooms_has_User_rooms1` FOREIGN KEY (`rooms_idrooms`,`rooms_Hotel_id`) REFERENCES `rooms` (`idrooms`, `Hotel_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
