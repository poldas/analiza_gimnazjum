CREATE DATABASE `analiza`;
USE `analiza`;
CREATE TABLE `uczen` (
  `kod`            VARCHAR(10),
  `typ_miasta`     VARCHAR(7),
  `plec`           VARCHAR(2),
  `klasa`          VARCHAR(1),
  `numer`          TINYINT(3),
  `rodzaj_choroby` TINYINT(1),
  PRIMARY KEY (`kod`)
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;
INSERT INTO uczen VALUES ('A1', 'miasto', 'm', 'A', 1, 1);
INSERT INTO uczen VALUES ('A2', 'wies', 'k', 'A', 2, 0);
INSERT INTO uczen VALUES ('A3', 'miasto', 'm', 'A', 3, 1);
INSERT INTO uczen VALUES ('A4', 'wies', 'm', 'A', 4, 0);
INSERT INTO uczen VALUES ('A5', 'miasto', 'k', 'A', 5, 0);
INSERT INTO uczen VALUES ('A6', 'wies', 'm', 'A', 6, 0);
INSERT INTO uczen VALUES ('A7', 'miasto', 'm', 'A', 7, 0);
INSERT INTO uczen VALUES ('A8', 'wies', 'm', 'A', 8, 0);
INSERT INTO uczen VALUES ('A9', 'miasto', 'm', 'A', 9, 0);
INSERT INTO uczen VALUES ('A10', 'miasto', 'k', 'A', 10, 0);
INSERT INTO uczen VALUES ('A11', 'miasto', 'm', 'A', 11, 1);
INSERT INTO uczen VALUES ('A12', 'wies', 'm', 'A', 12, 1);
INSERT INTO uczen VALUES ('A13', 'wies', 'k', 'A', 13, 0);
INSERT INTO uczen VALUES ('A14', 'miasto', 'm', 'A', 14, 1);
INSERT INTO uczen VALUES ('A15', 'wies', 'm', 'A', 15, 0);
INSERT INTO uczen VALUES ('A16', 'wies', 'm', 'A', 16, 1);
INSERT INTO uczen VALUES ('A17', 'miasto', 'k', 'A', 17, 1);
INSERT INTO uczen VALUES ('A18', 'miasto', 'm', 'A', 18, 0);
INSERT INTO uczen VALUES ('A19', 'wies', 'm', 'A', 19, 0);
INSERT INTO uczen VALUES ('A20', 'miasto', 'm', 'A', 20, 0);
INSERT INTO uczen VALUES ('A21', 'miasto', 'm', 'A', 21, 0);
INSERT INTO uczen VALUES ('A22', 'miasto', 'k', 'A', 22, 0);
INSERT INTO uczen VALUES ('A23', 'miasto', 'm', 'A', 23, 0);
INSERT INTO uczen VALUES ('A24', 'wies', 'm', 'A', 24, 0);
INSERT INTO uczen VALUES ('A25', 'miasto', 'k', 'A', 25, 0);
INSERT INTO uczen VALUES ('A26', 'miasto', 'm', 'A', 26, 1);
INSERT INTO uczen VALUES ('A27', 'wies', 'm', 'A', 27, 0);

INSERT INTO uczen VALUES ('B1', 'miasto', 'm', 'B', 1, 1);
INSERT INTO uczen VALUES ('B2', 'wies', 'k', 'B', 2, 0);
INSERT INTO uczen VALUES ('B3', 'miasto', 'm', 'B', 3, 1);

CREATE TABLE `zadanie` (
  `numer_zadania` INT(30),
  `max_pkt`       TINYINT(5),
  `podzadanie`    TINYINT(3),
  KEY (`numer_zadania`, `podzadanie`)
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;
INSERT INTO zadanie VALUES (1, 1, 1);
INSERT INTO zadanie VALUES (2, 1, 1);
INSERT INTO zadanie VALUES (3, 1, 1);
INSERT INTO zadanie VALUES (4, 1, 1);
INSERT INTO zadanie VALUES (5, 1, 1);
INSERT INTO zadanie VALUES (6, 1, 1);
INSERT INTO zadanie VALUES (7, 1, 1);
INSERT INTO zadanie VALUES (8, 1, 1);
INSERT INTO zadanie VALUES (9, 1, 1);
INSERT INTO zadanie VALUES (10, 1, 1);
INSERT INTO zadanie VALUES (11, 1, 1);
INSERT INTO zadanie VALUES (12, 1, 1);
INSERT INTO zadanie VALUES (13, 1, 1);
INSERT INTO zadanie VALUES (14, 1, 1);
INSERT INTO zadanie VALUES (15, 1, 1);
INSERT INTO zadanie VALUES (16, 1, 1);
INSERT INTO zadanie VALUES (17, 1, 1);
INSERT INTO zadanie VALUES (18, 1, 1);
INSERT INTO zadanie VALUES (19, 1, 1);
INSERT INTO zadanie VALUES (20, 1, 1);
INSERT INTO zadanie VALUES (21, 2, 1);
INSERT INTO zadanie VALUES (22, 4, 1);
INSERT INTO zadanie VALUES (22, 1, 2);
INSERT INTO zadanie VALUES (22, 1, 3);
INSERT INTO zadanie VALUES (22, 2, 4);
INSERT INTO zadanie VALUES (22, 1, 5);
INSERT INTO zadanie VALUES (22, 1, 6);

CREATE TABLE `uczen_zadanie` (
  `kod_ucznia`    VARCHAR(10),
  `numer_zadania` INT(3),
  `punkty`        TINYINT(5),
  `podzadanie`    TINYINT(3),
  KEY (`numer_zadania`, `kod_ucznia`, `podzadanie`)
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;
INSERT INTO uczen_zadanie VALUES ('A1', 1, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A1', 2, 0, 1);
INSERT INTO uczen_zadanie VALUES ('A1', 3, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A1', 4, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A1', 5, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A1', 6, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A1', 7, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A1', 8, 0, 1);
INSERT INTO uczen_zadanie VALUES ('A1', 9, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A1', 10, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A1', 11, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A1', 12, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A1', 13, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A1', 14, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A1', 15, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A1', 16, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A1', 17, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A1', 18, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A1', 19, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A1', 20, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A1', 21, 2, 1);
INSERT INTO uczen_zadanie VALUES ('A1', 22, 4, 1);
INSERT INTO uczen_zadanie VALUES ('A1', 22, 1, 2);
INSERT INTO uczen_zadanie VALUES ('A1', 22, 1, 3);
INSERT INTO uczen_zadanie VALUES ('A1', 22, 1, 4);
INSERT INTO uczen_zadanie VALUES ('A1', 22, 1, 5);
INSERT INTO uczen_zadanie VALUES ('A1', 22, 0, 6);

INSERT INTO uczen_zadanie VALUES ('A2', 1, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A2', 2, 0, 1);
INSERT INTO uczen_zadanie VALUES ('A2', 3, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A2', 4, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A2', 5, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A2', 6, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A2', 7, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A2', 8, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A2', 9, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A2', 10, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A2', 11, 0, 1);
INSERT INTO uczen_zadanie VALUES ('A2', 12, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A2', 13, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A2', 14, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A2', 15, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A2', 16, 0, 1);
INSERT INTO uczen_zadanie VALUES ('A2', 17, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A2', 18, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A2', 19, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A2', 20, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A2', 21, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A2', 22, 2, 1);
INSERT INTO uczen_zadanie VALUES ('A2', 22, 1, 2);
INSERT INTO uczen_zadanie VALUES ('A2', 22, 1, 3);
INSERT INTO uczen_zadanie VALUES ('A2', 22, 0, 4);
INSERT INTO uczen_zadanie VALUES ('A2', 22, 0, 5);
INSERT INTO uczen_zadanie VALUES ('A2', 22, 0, 6);

INSERT INTO uczen_zadanie VALUES ('A3', 1, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A3', 2, 0, 1);
INSERT INTO uczen_zadanie VALUES ('A3', 3, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A3', 4, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A3', 5, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A3', 6, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A3', 7, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A3', 8, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A3', 9, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A3', 10, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A3', 11, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A3', 12, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A3', 13, 0, 1);
INSERT INTO uczen_zadanie VALUES ('A3', 14, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A3', 15, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A3', 16, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A3', 17, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A3', 18, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A3', 19, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A3', 20, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A3', 21, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A3', 22, 3, 1);
INSERT INTO uczen_zadanie VALUES ('A3', 22, 1, 2);
INSERT INTO uczen_zadanie VALUES ('A3', 22, 1, 3);
INSERT INTO uczen_zadanie VALUES ('A3', 22, 0, 4);
INSERT INTO uczen_zadanie VALUES ('A3', 22, 1, 5);
INSERT INTO uczen_zadanie VALUES ('A3', 22, 0, 6);

INSERT INTO uczen_zadanie VALUES ('A4', 1, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A4', 2, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A4', 3, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A4', 4, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A4', 5, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A4', 6, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A4', 7, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A4', 8, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A4', 9, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A4', 10, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A4', 11, 0, 1);
INSERT INTO uczen_zadanie VALUES ('A4', 12, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A4', 13, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A4', 14, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A4', 15, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A4', 16, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A4', 17, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A4', 18, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A4', 19, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A4', 20, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A4', 21, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A4', 22, 2, 1);
INSERT INTO uczen_zadanie VALUES ('A4', 22, 1, 2);
INSERT INTO uczen_zadanie VALUES ('A4', 22, 1, 3);
INSERT INTO uczen_zadanie VALUES ('A4', 22, 2, 4);
INSERT INTO uczen_zadanie VALUES ('A4', 22, 1, 5);
INSERT INTO uczen_zadanie VALUES ('A4', 22, 0, 6);

INSERT INTO uczen_zadanie VALUES ('A5', 1, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A5', 2, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A5', 3, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A5', 4, 0, 1);
INSERT INTO uczen_zadanie VALUES ('A5', 5, 0, 1);
INSERT INTO uczen_zadanie VALUES ('A5', 6, 0, 1);
INSERT INTO uczen_zadanie VALUES ('A5', 7, 0, 1);
INSERT INTO uczen_zadanie VALUES ('A5', 8, 0, 1);
INSERT INTO uczen_zadanie VALUES ('A5', 9, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A5', 10, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A5', 11, 0, 1);
INSERT INTO uczen_zadanie VALUES ('A5', 12, 0, 1);
INSERT INTO uczen_zadanie VALUES ('A5', 13, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A5', 14, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A5', 15, 0, 1);
INSERT INTO uczen_zadanie VALUES ('A5', 16, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A5', 17, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A5', 18, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A5', 19, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A5', 20, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A5', 21, 0, 1);
INSERT INTO uczen_zadanie VALUES ('A5', 22, 1, 1);
INSERT INTO uczen_zadanie VALUES ('A5', 22, 1, 2);
INSERT INTO uczen_zadanie VALUES ('A5', 22, 1, 3);
INSERT INTO uczen_zadanie VALUES ('A5', 22, 0, 4);
INSERT INTO uczen_zadanie VALUES ('A5', 22, 0, 5);
INSERT INTO uczen_zadanie VALUES ('A5', 22, 0, 6);


INSERT INTO uczen_zadanie VALUES ('B1', 1, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B1', 2, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B1', 3, 0, 1);
INSERT INTO uczen_zadanie VALUES ('B1', 4, 0, 1);
INSERT INTO uczen_zadanie VALUES ('B1', 5, 0, 1);
INSERT INTO uczen_zadanie VALUES ('B1', 6, 0, 1);
INSERT INTO uczen_zadanie VALUES ('B1', 7, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B1', 8, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B1', 9, 0, 1);
INSERT INTO uczen_zadanie VALUES ('B1', 10, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B1', 11, 0, 1);
INSERT INTO uczen_zadanie VALUES ('B1', 12, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B1', 13, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B1', 14, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B1', 15, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B1', 16, 0, 1);
INSERT INTO uczen_zadanie VALUES ('B1', 17, 0, 1);
INSERT INTO uczen_zadanie VALUES ('B1', 18, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B1', 19, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B1', 20, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B1', 21, 2, 1);
INSERT INTO uczen_zadanie VALUES ('B1', 22, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B1', 22, 1, 2);
INSERT INTO uczen_zadanie VALUES ('B1', 22, 0, 3);
INSERT INTO uczen_zadanie VALUES ('B1', 22, 0, 4);
INSERT INTO uczen_zadanie VALUES ('B1', 22, 1, 5);
INSERT INTO uczen_zadanie VALUES ('B1', 22, 1, 6);


INSERT INTO uczen_zadanie VALUES ('B2', 1, 0, 1);
INSERT INTO uczen_zadanie VALUES ('B2', 2, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B2', 3, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B2', 4, 0, 1);
INSERT INTO uczen_zadanie VALUES ('B2', 5, 0, 1);
INSERT INTO uczen_zadanie VALUES ('B2', 6, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B2', 7, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B2', 8, 0, 1);
INSERT INTO uczen_zadanie VALUES ('B2', 9, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B2', 10, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B2', 11, 0, 1);
INSERT INTO uczen_zadanie VALUES ('B2', 12, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B2', 13, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B2', 14, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B2', 15, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B2', 16, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B2', 17, 0, 1);
INSERT INTO uczen_zadanie VALUES ('B2', 18, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B2', 19, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B2', 20, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B2', 21, 2, 1);
INSERT INTO uczen_zadanie VALUES ('B2', 22, 2, 1);
INSERT INTO uczen_zadanie VALUES ('B2', 22, 1, 2);
INSERT INTO uczen_zadanie VALUES ('B2', 22, 1, 3);
INSERT INTO uczen_zadanie VALUES ('B2', 22, 0, 4);
INSERT INTO uczen_zadanie VALUES ('B2', 22, 1, 5);
INSERT INTO uczen_zadanie VALUES ('B2', 22, 1, 6);


INSERT INTO uczen_zadanie VALUES ('B3', 1, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B3', 2, 0, 1);
INSERT INTO uczen_zadanie VALUES ('B3', 3, 0, 1);
INSERT INTO uczen_zadanie VALUES ('B3', 4, 0, 1);
INSERT INTO uczen_zadanie VALUES ('B3', 5, 0, 1);
INSERT INTO uczen_zadanie VALUES ('B3', 6, 0, 1);
INSERT INTO uczen_zadanie VALUES ('B3', 7, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B3', 8, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B3', 9, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B3', 10, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B3', 11, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B3', 12, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B3', 13, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B3', 14, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B3', 15, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B3', 16, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B3', 17, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B3', 18, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B3', 19, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B3', 20, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B3', 21, 1, 1);
INSERT INTO uczen_zadanie VALUES ('B3', 22, 3, 1);
INSERT INTO uczen_zadanie VALUES ('B3', 22, 1, 2);
INSERT INTO uczen_zadanie VALUES ('B3', 22, 1, 3);
INSERT INTO uczen_zadanie VALUES ('B3', 22, 2, 4);
INSERT INTO uczen_zadanie VALUES ('B3', 22, 1, 5);
INSERT INTO uczen_zadanie VALUES ('B3', 22, 0, 6);

CREATE TABLE `obszar_umiejetnosc` (
  `id`          INT(5) UNSIGNED,
  `obszar`      VARCHAR(3),
  `umiejetnosc` VARCHAR(5),
  PRIMARY KEY (`id`)
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;
INSERT INTO obszar_umiejetnosc VALUES (1, 'I', '1.2');
INSERT INTO obszar_umiejetnosc VALUES (2, 'I', 'p');
INSERT INTO obszar_umiejetnosc VALUES (3, 'I', '1.7');
INSERT INTO obszar_umiejetnosc VALUES (4, 'I', '3.2');
INSERT INTO obszar_umiejetnosc VALUES (5, 'I', '1.11');
INSERT INTO obszar_umiejetnosc VALUES (6, 'I', '2.10');
INSERT INTO obszar_umiejetnosc VALUES (7, 'I', '3.3');
INSERT INTO obszar_umiejetnosc VALUES (8, 'I', '3.9');
INSERT INTO obszar_umiejetnosc VALUES (9, 'II', 'p');
INSERT INTO obszar_umiejetnosc VALUES (10, 'II', '2.2');
INSERT INTO obszar_umiejetnosc VALUES (11, 'II', '3.1');
INSERT INTO obszar_umiejetnosc VALUES (12, 'II', '3.2');
INSERT INTO obszar_umiejetnosc VALUES (13, 'III', '2.3');
INSERT INTO obszar_umiejetnosc VALUES (14, 'III', '2.1');
INSERT INTO obszar_umiejetnosc VALUES (15, 'III', '3t');
INSERT INTO obszar_umiejetnosc VALUES (16, 'III', '3s');
INSERT INTO obszar_umiejetnosc VALUES (17, 'III', '3st');
INSERT INTO obszar_umiejetnosc VALUES (18, 'III', '3j');
INSERT INTO obszar_umiejetnosc VALUES (19, 'III', '3o');
INSERT INTO obszar_umiejetnosc VALUES (20, 'III', 'p');

CREATE TABLE `zadanie_obszar_umie` (
  `numer_zadania`   INT(10),
  `id_obszar_umiej` INT(10),
  `podzadanie`      TINYINT(3),
  KEY (`numer_zadania`, `id_obszar_umiej`, `podzadanie`)
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;
INSERT INTO zadanie_obszar_umie VALUES (1, 1, 1);
INSERT INTO zadanie_obszar_umie VALUES (2, 2, 1);
INSERT INTO zadanie_obszar_umie VALUES (2, 3, 1);
INSERT INTO zadanie_obszar_umie VALUES (3, 9, 1);
INSERT INTO zadanie_obszar_umie VALUES (3, 10, 1);
INSERT INTO zadanie_obszar_umie VALUES (4, 9, 1);
INSERT INTO zadanie_obszar_umie VALUES (4, 4, 1);
INSERT INTO zadanie_obszar_umie VALUES (5, 2, 1);
INSERT INTO zadanie_obszar_umie VALUES (5, 12, 1);
INSERT INTO zadanie_obszar_umie VALUES (6, 9, 1);
INSERT INTO zadanie_obszar_umie VALUES (7, 3, 1);
INSERT INTO zadanie_obszar_umie VALUES (8, 11, 1);
INSERT INTO zadanie_obszar_umie VALUES (8, 3, 1);
INSERT INTO zadanie_obszar_umie VALUES (9, 2, 1);
INSERT INTO zadanie_obszar_umie VALUES (9, 4, 1);
INSERT INTO zadanie_obszar_umie VALUES (9, 5, 1);
INSERT INTO zadanie_obszar_umie VALUES (10, 13, 1);
INSERT INTO zadanie_obszar_umie VALUES (11, 2, 1);
INSERT INTO zadanie_obszar_umie VALUES (11, 11, 1);
INSERT INTO zadanie_obszar_umie VALUES (12, 1, 1);
INSERT INTO zadanie_obszar_umie VALUES (13, 11, 1);
INSERT INTO zadanie_obszar_umie VALUES (14, 2, 1);
INSERT INTO zadanie_obszar_umie VALUES (15, 2, 1);
INSERT INTO zadanie_obszar_umie VALUES (16, 14, 1);
INSERT INTO zadanie_obszar_umie VALUES (16, 6, 1);
INSERT INTO zadanie_obszar_umie VALUES (16, 7, 1);
INSERT INTO zadanie_obszar_umie VALUES (17, 7, 1);
INSERT INTO zadanie_obszar_umie VALUES (18, 13, 1);
INSERT INTO zadanie_obszar_umie VALUES (19, 2, 1);
INSERT INTO zadanie_obszar_umie VALUES (20, 2, 1);
INSERT INTO zadanie_obszar_umie VALUES (20, 8, 1);
INSERT INTO zadanie_obszar_umie VALUES (21, 11, 1);
INSERT INTO zadanie_obszar_umie VALUES (22, 15, 1);
INSERT INTO zadanie_obszar_umie VALUES (22, 16, 2);
INSERT INTO zadanie_obszar_umie VALUES (22, 17, 3);
INSERT INTO zadanie_obszar_umie VALUES (22, 18, 4);
INSERT INTO zadanie_obszar_umie VALUES (22, 19, 5);
INSERT INTO zadanie_obszar_umie VALUES (22, 20, 6);



# średnia punktów per zadanie dla wszystkich uczniow (latwosc zadania w szkole)
SELECT
  sum(uz.punkty) / sum(z.max_pkt) AS latwosc,
  z.numer_zadania
FROM uczen_zadanie AS uz LEFT JOIN zadanie AS z ON z.numer_zadania = uz.numer_zadania
GROUP BY uz.numer_zadania ORDER BY CAST(z.numer_zadania as signed), z.numer_zadania;


# średnia punktów per zadanie dla wszystkich uczniow per klasa (latwosc zadania per klasa)
SELECT
  u.klasa,
  sum(uz.punkty) / sum(z.max_pkt) AS latwosc,
  z.numer_zadania
FROM uczen_zadanie AS uz LEFT JOIN zadanie AS z ON z.numer_zadania = uz.numer_zadania
  LEFT JOIN uczen AS u ON u.kod = uz.kod_ucznia
GROUP BY u.klasa, uz.numer_zadania ORDER BY u.klasa, CAST(z.numer_zadania as signed), z.numer_zadania;


# latwosc testu calego per klasa
SELECT
  u.klasa,
  sum(uz.punkty) / sum(z.max_pkt) AS latwosc
FROM uczen_zadanie AS uz LEFT JOIN zadanie AS z ON z.numer_zadania = uz.numer_zadania AND z.podzadanie = uz.podzadanie
  LEFT JOIN uczen AS u ON u.kod = uz.kod_ucznia
GROUP BY u.klasa;


# srednia punktow per klasa
SELECT
  u.klasa,
  sum(uz.punkty) / count(DISTINCT u.numer) AS srednia, count(DISTINCT u.numer) AS liczba_uczniow, sum(uz.punkty) AS suma_punkow
FROM uczen_zadanie AS uz LEFT JOIN zadanie AS z ON z.numer_zadania = uz.numer_zadania AND z.podzadanie = uz.podzadanie
  LEFT JOIN uczen AS u ON u.kod = uz.kod_ucznia
GROUP BY u.klasa;


# latwosc per obszar, umiejetnosc, klasa
SELECT ou.obszar, ou.umiejetnosc, u.klasa,sum(uz.punkty)/sum(z.max_pkt) AS latwosc
FROM obszar_umiejetnosc as ou LEFT JOIN zadanie_obszar_umie AS zou ON zou.id_obszar_umiej = ou.id
  LEFT JOIN uczen_zadanie AS uz ON uz.numer_zadania = zou.numer_zadania
  LEFT JOIN zadanie AS z ON z.numer_zadania = zou.numer_zadania
  LEFT JOIN uczen AS u ON u.kod = uz.kod_ucznia
  GROUP BY ou.obszar,ou.umiejetnosc, u.klasa
  ORDER BY ou.obszar, CAST(ou.umiejetnosc as signed), ou.umiejetnosc, u.klasa;


