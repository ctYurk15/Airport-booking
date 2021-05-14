-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Час створення: Трв 14 2021 р., 12:04
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
(3, 'Аеропорт імені ДжоДжо', 2),
(4, 'Схіпгол', 6),
(5, 'Міжнародний аеропорт Дніпро', 7),
(6, 'Міжнародний аеропорт Одеса', 8),
(7, 'Міжнародний аеропорт Харків', 9),
(8, 'Міжнародний аеропорт Дубай', 10);

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
(5, 'Вроцлав', 'Польща'),
(6, 'Амстердам', 'Нідерланди'),
(7, 'Дніпро', 'Україна'),
(8, 'Одеса', 'Україна'),
(9, 'Харків', 'Україна'),
(10, 'Дубаї', 'ОАЕ');

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
(1, 'Прихисток анімешника', 1),
(2, 'Park Plaza Victoria Amsterdam', 6),
(3, 'Bartolomeo', 7),
(4, 'M1 Club Hotel', 8),
(5, 'Kharkiv Palace Hotel', 9),
(6, 'Atlantis The Palm, Dubai', 10);

-- --------------------------------------------------------

--
-- Структура таблиці `passport_request`
--

CREATE TABLE `passport_request` (
  `id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Sex` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PassID` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `BirthDate` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `InterPass` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `passport_request`
--

INSERT INTO `passport_request` (`id`, `User_id`, `Name`, `Sex`, `PassID`, `BirthDate`, `InterPass`) VALUES
(1, 6, 'jojo', 'male', '123-123', '30.08.2003', 'lll-000'),
(2, 6, 'Lev Zykol', 'Male', '', '2', '2'),
(3, 6, 'Lev Zykol', 'Male', '1', '2', '2');

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
(1, 'Boing 747', 500, 1),
(2, 'Ан-148', 80, 1),
(3, 'Ан-158', 99, 1),
(4, 'Ан-180', 175, 1),
(5, 'Bombardier Global Express', 19, 2),
(6, 'Airbus A340', 375, 2);

-- --------------------------------------------------------

--
-- Структура таблиці `receipt`
--

CREATE TABLE `receipt` (
  `id` int(11) NOT NULL,
  `ReceiptNumber` int(11) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Ticket_idTicket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `receipt`
--

INSERT INTO `receipt` (`id`, `ReceiptNumber`, `Date`, `Ticket_idTicket`) VALUES
(1, 228228228, '2021-05-05 14:20:41', 1),
(2, 2, '2021-05-10 14:59:27', 2),
(3, 3, '2021-05-10 14:59:27', 3),
(4, 4, '2021-05-10 14:59:27', 4),
(5, 6, '2021-05-10 14:59:27', 5),
(6, 7, '2021-05-10 14:59:27', 6);

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
  `Airport_idAirportTo` int(11) NOT NULL,
  `Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `reis`
--

INSERT INTO `reis` (`id`, `ReisNumber`, `ReservedCount`, `ReisTimeFrom`, `ReisTimeTo`, `Plane_id`, `Airport_idAirportFrom`, `Airport_idAirportTo`, `Price`) VALUES
(1, 1, '13', '2019-10-10 14:25:00', '2019-10-10 20:25:00', 1, 1, 2, 100),
(2, 2, '14', '2021-05-15 14:30:00', '2021-05-16 00:25:00', 2, 3, 6, 200),
(3, 3, '50', '2021-12-13 15:25:00', '2021-12-14 01:25:00', 3, 8, 7, 300),
(4, 4, '102', '2021-01-11 16:25:00', '2021-01-12 02:25:00', 4, 7, 2, 100),
(5, 5, '3', '2021-11-09 17:25:00', '2021-11-10 03:25:00', 5, 7, 4, 400),
(6, 6, '1', '2021-03-20 18:25:00', '2021-03-21 04:25:00', 6, 1, 5, 100),
(7, 7, '14', '2021-05-09 14:30:00', '2021-05-25 00:25:00', 2, 3, 6, 15);

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
(1, 1, 1, 5, 10),
(2, 2, 6, 4, 15),
(3, 3, 2, 2, 6),
(4, 4, 3, 3, 9),
(5, 5, 5, 1, 3),
(6, 6, 4, 5, 20);

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
(1, 'Люкс'),
(2, 'Комфорт'),
(3, 'Комфорт+'),
(4, 'Президентський'),
(5, 'Стандарт'),
(6, 'Бізнес');

-- --------------------------------------------------------

--
-- Структура таблиці `ticket`
--

CREATE TABLE `ticket` (
  `idTicket` int(11) NOT NULL,
  `PlaceNumber` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Reis_id1` int(11) NOT NULL,
  `User_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `ticket`
--

INSERT INTO `ticket` (`idTicket`, `PlaceNumber`, `Reis_id1`, `User_id`) VALUES
(1, '15', 1, 1),
(2, '70', 2, 1),
(3, '95', 3, 1),
(4, '143', 4, 1),
(5, '1', 5, 1),
(6, '1', 6, 1),
(10, '14', 2, 2);

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
(1, 'Пасажирський'),
(2, 'Приватний');

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
(6, 'Lev Zykol', '2021-05-08 07:45:23', NULL, '123', 'levgenetic@gmail.com'),
(7, 'name', '2021-05-09 11:10:14', NULL, 'pass', 'email'),
(8, 'Нестор Олег', '2021-05-10 11:58:32', NULL, 'testpass8', 'testuser8@gmail.com'),
(9, 'Брендак Владислав', '2021-05-10 11:58:32', NULL, 'testpass9', 'testuser9@gmail.com'),
(10, 'Замєсов Юрій', '2021-05-10 11:58:32', NULL, 'testpass10', 'testuser10@gmail.com'),
(11, 'Грицак Юрій', '2021-05-10 11:58:32', NULL, 'testpass11', 'testuser11@gmail.com'),
(12, 'Поляков Віктор', '2021-05-10 11:58:32', NULL, 'testpass12', 'testuser12@gmail.com'),
(13, 'Lev45 Zykol', '2021-05-11 09:13:56', NULL, 'qwerty', 'levgenbanetic@gmail.com'),
(14, '1 2', '2021-05-11 09:26:52', NULL, '89', '2@meta.ua'),
(15, 'Lev Zykolllll', '2021-05-11 09:32:24', NULL, '678', 'email@meta.ua');

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
-- Індекси таблиці `passport_request`
--
ALTER TABLE `passport_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_User_id` (`User_id`);

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
  ADD PRIMARY KEY (`id`,`Ticket_idTicket`),
  ADD KEY `fk_Receipt_Ticket1_idx` (`Ticket_idTicket`);

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
  ADD KEY `fk_Ticket_Reis1_idx` (`Reis_id1`),
  ADD KEY `User_id_idx` (`User_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблиці `passport_request`
--
ALTER TABLE `passport_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблиці `rooms`
--
ALTER TABLE `rooms`
  MODIFY `idrooms` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблиці `ticket`
--
ALTER TABLE `ticket`
  MODIFY `idTicket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблиці `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
-- Обмеження зовнішнього ключа таблиці `passport_request`
--
ALTER TABLE `passport_request`
  ADD CONSTRAINT `fk_User_id` FOREIGN KEY (`User_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Обмеження зовнішнього ключа таблиці `plane`
--
ALTER TABLE `plane`
  ADD CONSTRAINT `fk_Plane_Type1` FOREIGN KEY (`Type_idType`) REFERENCES `type` (`idType`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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

--
-- Обмеження зовнішнього ключа таблиці `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `User_id` FOREIGN KEY (`User_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
