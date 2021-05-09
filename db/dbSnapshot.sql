CREATE TABLE IF NOT EXISTS `Type` (
  `idType` INT NOT NULL,
  `Name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idType`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Plane`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Plane` (
  `id` INT NOT NULL,
  `Name` VARCHAR(45) NOT NULL,
  `Count` INT NOT NULL,
  `Type_idType` INT NOT NULL,
  PRIMARY KEY (`id`, `Type_idType`),
  INDEX `fk_Plane_Type1_idx` (`Type_idType` ASC) ,
  CONSTRAINT `fk_Plane_Type1`
    FOREIGN KEY (`Type_idType`)
    REFERENCES `Type` (`idType`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `City`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `City` (
  `id` INT NOT NULL,
  `Name` VARCHAR(45) NOT NULL,
  `Country` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Airport`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Airport` (
  `idAirport` INT NOT NULL,
  `Name` VARCHAR(45) NOT NULL,
  `City_id` INT NOT NULL,
  PRIMARY KEY (`idAirport`, `City_id`),
  INDEX `fk_Airport_City1_idx` (`City_id` ASC) ,
  CONSTRAINT `fk_Airport_City1`
    FOREIGN KEY (`City_id`)
    REFERENCES `City` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Reis`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Reis` (
  `id` INT NOT NULL,
  `ReisNumber` INT NOT NULL,
  `ReservedCount` VARCHAR(45) NOT NULL DEFAULT 0,
  `ReisTimeFrom` DATETIME NOT NULL,
  `ReisTimeTo` DATETIME NOT NULL,
  `Available` VARCHAR(45) NOT NULL,
  `Plane_id` INT NOT NULL,
  `Airport_idAirportFrom` INT NOT NULL,
  `Airport_City_idFrom` INT NOT NULL,
  `Airport_idAirportTo` INT NOT NULL,
  `Airport_City_idTo` INT NOT NULL,
  PRIMARY KEY (`id`, `Plane_id`, `Airport_idAirportFrom`, `Airport_City_idFrom`, `Airport_idAirportTo`, `Airport_City_idTo`),
  INDEX `fk_Reis_Plane1_idx` (`Plane_id` ASC) ,
  INDEX `fk_Reis_Airport1_idx` (`Airport_idAirportFrom` ASC, `Airport_City_idFrom` ASC) ,
  INDEX `fk_Reis_Airport2_idx` (`Airport_idAirportTo` ASC, `Airport_City_idTo` ASC) ,
  CONSTRAINT `fk_Reis_Plane1`
    FOREIGN KEY (`Plane_id`)
    REFERENCES `Plane` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Reis_Airport1`
    FOREIGN KEY (`Airport_idAirportFrom` , `Airport_City_idFrom`)
    REFERENCES `Airport` (`idAirport` , `City_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Reis_Airport2`
    FOREIGN KEY (`Airport_idAirportTo` , `Airport_City_idTo`)
    REFERENCES `Airport` (`idAirport` , `City_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `User` (
  `id` INT NOT NULL,
  `Name` VARCHAR(45) NOT NULL,
  `RegitrationDate` DATE NOT NULL,
  `PassId` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Ticket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Ticket` (
  `idTicket` INT NOT NULL,
  `Price` INT NOT NULL,
  `PlaceNumber` VARCHAR(10) NOT NULL,
  `Reis_id1` INT NOT NULL,
  `Reis_Plane_id` INT NOT NULL,
  PRIMARY KEY (`idTicket`, `Reis_id1`, `Reis_Plane_id`),
  INDEX `fk_Ticket_Reis1_idx` (`Reis_id1` ASC, `Reis_Plane_id` ASC) ,
  CONSTRAINT `fk_Ticket_Reis1`
    FOREIGN KEY (`Reis_id1` , `Reis_Plane_id`)
    REFERENCES `Reis` (`id` , `Plane_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Receipt`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Receipt` (
  `id` INT NOT NULL,
  `ReceiptNumber` INT NOT NULL,
  `Date` DATETIME NOT NULL,
  `Ticket_idTicket` INT NOT NULL,
  `Ticket_Reis_id1` INT NOT NULL,
  `Ticket_Reis_Plane_id` INT NOT NULL,
  `User_id` INT NOT NULL,
  PRIMARY KEY (`id`, `Ticket_idTicket`, `Ticket_Reis_id1`, `Ticket_Reis_Plane_id`, `User_id`),
  INDEX `fk_Receipt_Ticket1_idx` (`Ticket_idTicket` ASC, `Ticket_Reis_id1` ASC, `Ticket_Reis_Plane_id` ASC) ,
  INDEX `fk_Receipt_User1_idx` (`User_id` ASC) ,
  CONSTRAINT `fk_Receipt_Ticket1`
    FOREIGN KEY (`Ticket_idTicket` , `Ticket_Reis_id1` , `Ticket_Reis_Plane_id`)
    REFERENCES `Ticket` (`idTicket` , `Reis_id1` , `Reis_Plane_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Receipt_User1`
    FOREIGN KEY (`User_id`)
    REFERENCES `User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Hotel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Hotel` (
  `id` INT NOT NULL,
  `Name` VARCHAR(45) NOT NULL,
  `City_id` INT NOT NULL,
  PRIMARY KEY (`id`, `City_id`),
  INDEX `fk_Hotel_City1_idx` (`City_id` ASC) ,
  CONSTRAINT `fk_Hotel_City1`
    FOREIGN KEY (`City_id`)
    REFERENCES `City` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Roomtype`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Roomtype` (
  `idRoomtype` INT NOT NULL,
  `Name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idRoomtype`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rooms`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rooms` (
  `idrooms` INT NOT NULL AUTO_INCREMENT,
  `Hotel_id` INT NOT NULL,
  `Roomtype_idRoomtype` INT NOT NULL,
  `CountRooms` INT NOT NULL,
  `CountUsers` INT NOT NULL,
  PRIMARY KEY (`idrooms`, `Hotel_id`, `Roomtype_idRoomtype`),
  INDEX `fk_rooms_Hotel1_idx` (`Hotel_id` ASC) ,
  INDEX `fk_rooms_Roomtype1_idx` (`Roomtype_idRoomtype` ASC) ,
  CONSTRAINT `fk_rooms_Hotel1`
    FOREIGN KEY (`Hotel_id`)
    REFERENCES `Hotel` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rooms_Roomtype1`
    FOREIGN KEY (`Roomtype_idRoomtype`)
    REFERENCES `Roomtype` (`idRoomtype`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rooms_has_User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rooms_has_User` (
  `rooms_idrooms` INT NOT NULL,
  `rooms_Hotel_id` INT NOT NULL,
  `User_id` INT NOT NULL,
  PRIMARY KEY (`rooms_idrooms`, `rooms_Hotel_id`, `User_id`),
  INDEX `fk_rooms_has_User_User1_idx` (`User_id` ASC) ,
  INDEX `fk_rooms_has_User_rooms1_idx` (`rooms_idrooms` ASC, `rooms_Hotel_id` ASC) ,
  CONSTRAINT `fk_rooms_has_User_rooms1`
    FOREIGN KEY (`rooms_idrooms` , `rooms_Hotel_id`)
    REFERENCES `rooms` (`idrooms` , `Hotel_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rooms_has_User_User1`
    FOREIGN KEY (`User_id`)
    REFERENCES `User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;