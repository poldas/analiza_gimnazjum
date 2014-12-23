create database `analiza`;
use `analiza`;
CREATE TABLE `uczen` (
  `kod` varchar(10),
  `typ_miasta` varchar(7),
  `plec` varchar(2),
  `klasa` varchar(1),
  `numer` tinyint(3),
  `rodzaj_choroby` tinyint(1),
  PRIMARY KEY (`kod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
insert into uczen values('A1','miasto', 'm', 'A', 1, 1);
insert into uczen values('A2','wies', 'k', 'A', 2, 0);
insert into uczen values('A3','miasto', 'm', 'A', 3, 1);
insert into uczen values('A4','wies', 'm', 'A', 4, 0);
insert into uczen values('A5','miasto', 'k', 'A', 5, 0);
insert into uczen values('A6','wies', 'm', 'A', 6, 0);
insert into uczen values('A7','miasto', 'm', 'A', 7, 0);
insert into uczen values('A8','wies', 'm', 'A', 8, 0);
insert into uczen values('A9','miasto', 'm', 'A', 9, 0);
insert into uczen values('A10','miasto', 'k', 'A', 10, 0);
insert into uczen values('A11','miasto', 'm', 'A', 11, 1);
insert into uczen values('A12','wies', 'm', 'A', 12, 1);
insert into uczen values('A13','wies', 'k', 'A', 13, 0);
insert into uczen values('A14','miasto', 'm', 'A', 14, 1);
insert into uczen values('A15','wies', 'm', 'A', 15, 0);
insert into uczen values('A16','wies', 'm', 'A', 16, 1);
insert into uczen values('A17','miasto', 'k', 'A', 17, 1);
insert into uczen values('A18','miasto', 'm', 'A', 18, 0);
insert into uczen values('A19','wies', 'm', 'A', 19, 0);
insert into uczen values('A20','miasto', 'm', 'A', 20, 0);
insert into uczen values('A21','miasto', 'm', 'A', 21, 0);
insert into uczen values('A22','miasto', 'k', 'A', 22, 0);
insert into uczen values('A23','miasto', 'm', 'A', 23, 0);
insert into uczen values('A24','wies', 'm', 'A', 24, 0);
insert into uczen values('A25','miasto', 'k', 'A', 25, 0);
insert into uczen values('A26','miasto', 'm', 'A', 26, 1);
insert into uczen values('A27','wies', 'm', 'A', 27, 0);

CREATE TABLE `zadanie` (
  `numer_zadania` int(30),
  `max_pkt` tinyint(5),
  `podzadanie` tinyint(3),
  KEY (`numer_zadania`,`podzadanie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
insert into zadanie values(1, 1, 1);
insert into zadanie values(2, 1, 1);
insert into zadanie values(3, 1, 1);
insert into zadanie values(4, 1, 1);
insert into zadanie values(5, 1, 1);
insert into zadanie values(6, 1, 1);
insert into zadanie values(7, 1, 1);
insert into zadanie values(8, 1, 1);
insert into zadanie values(9, 1, 1);
insert into zadanie values(10, 1, 1);
insert into zadanie values(11, 1, 1);
insert into zadanie values(12, 1, 1);
insert into zadanie values(13, 1, 1);
insert into zadanie values(14, 1, 1);
insert into zadanie values(15, 1, 1);
insert into zadanie values(16, 1, 1);
insert into zadanie values(17, 1, 1);
insert into zadanie values(18, 1, 1);
insert into zadanie values(19, 1, 1);
insert into zadanie values(20, 1, 1);
insert into zadanie values(21, 2, 1);
insert into zadanie values(22, 4, 1);
insert into zadanie values(22, 1, 2);
insert into zadanie values(22, 1, 3);
insert into zadanie values(22, 2, 4);
insert into zadanie values(22, 1, 5);
insert into zadanie values(22, 1, 6);

CREATE TABLE `uczen_zadanie` (
  `kod_ucznia` varchar(10),
  `numer_zadania` int(3),
  `punkty` tinyint(5),
  `podzadanie` tinyint(3),
  KEY (`numer_zadania`, `kod_ucznia`, `podzadanie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
insert into uczen_zadanie values('A1', 1, 1, 1);
insert into uczen_zadanie values('A1', 2, 1, 1);
insert into uczen_zadanie values('A1', 3, 1, 1);
insert into uczen_zadanie values('A1', 4, 1, 1);
insert into uczen_zadanie values('A1', 5, 1, 1);
insert into uczen_zadanie values('A1', 6, 1, 1);
insert into uczen_zadanie values('A1', 7, 1, 1);
insert into uczen_zadanie values('A1', 8, 1, 1);
insert into uczen_zadanie values('A1', 9, 1, 1);
insert into uczen_zadanie values('A1', 10, 1, 1);
insert into uczen_zadanie values('A1', 11, 1, 1);
insert into uczen_zadanie values('A1', 12, 1, 1);
insert into uczen_zadanie values('A1', 13, 1, 1);
insert into uczen_zadanie values('A1', 14, 1, 1);
insert into uczen_zadanie values('A1', 15, 1, 1);
insert into uczen_zadanie values('A1', 16, 1, 1);
insert into uczen_zadanie values('A1', 17, 1, 1);
insert into uczen_zadanie values('A1', 18, 1, 1);
insert into uczen_zadanie values('A1', 19, 1, 1);
insert into uczen_zadanie values('A1', 20, 1, 1);
insert into uczen_zadanie values('A1', 21, 1, 1);
insert into uczen_zadanie values('A1', 22, 1, 1);
insert into uczen_zadanie values('A1', 22, 1, 2);
insert into uczen_zadanie values('A1', 22, 1, 3);
insert into uczen_zadanie values('A1', 22, 1, 4);
insert into uczen_zadanie values('A1', 22, 1, 5);
insert into uczen_zadanie values('A1', 22, 1, 6);



CREATE TABLE `obszar_umiejetnosc` (
  `id` int(5) unsigned,
  `obszar` varchar(3),
  `umiejetnosc` VARCHAR(5),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
insert into obszar_umiejetnosc values(1, 'I', '1.2');
insert into obszar_umiejetnosc values(2, 'I', 'p');
insert into obszar_umiejetnosc values(3, 'I', '1.7');
insert into obszar_umiejetnosc values(4, 'I', '3.2');
insert into obszar_umiejetnosc values(5, 'I', '1.11');
insert into obszar_umiejetnosc values(6, 'I', '2.10');
insert into obszar_umiejetnosc values(7, 'I', '3.3');
insert into obszar_umiejetnosc values(8, 'I', '3.9');
insert into obszar_umiejetnosc values(9, 'II', 'p');
insert into obszar_umiejetnosc values(10, 'II', '2.2');
insert into obszar_umiejetnosc values(11, 'II', '3.1');
insert into obszar_umiejetnosc values(12, 'II', '3.2');
insert into obszar_umiejetnosc values(13, 'III', '2.3');
insert into obszar_umiejetnosc values(14, 'III', '2.1');
insert into obszar_umiejetnosc values(15, 'III', '3t');
insert into obszar_umiejetnosc values(16, 'III', '3s');
insert into obszar_umiejetnosc values(17, 'III', '3st');
insert into obszar_umiejetnosc values(18, 'III', '3j');
insert into obszar_umiejetnosc values(19, 'III', '3o');
insert into obszar_umiejetnosc values(20, 'III', 'p');

CREATE TABLE `zadanie_obszar_umie` (
  `numer_zadania` int(10),
  `id_obszar_umiej` int(10),
  `podzadanie` tinyint(3),
  KEY (`numer_zadania`, `id_obszar_umiej`, `podzadanie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
insert into zadanie_obszar_umie values(1, 1, 1);
insert into zadanie_obszar_umie values(2, 2, 1);
insert into zadanie_obszar_umie values(2, 3, 1);
insert into zadanie_obszar_umie values(3, 9, 1);
insert into zadanie_obszar_umie values(3, 10, 1);
insert into zadanie_obszar_umie values(4, 9, 1);
insert into zadanie_obszar_umie values(4, 4, 1);
insert into zadanie_obszar_umie values(5, 2, 1);
insert into zadanie_obszar_umie values(5, 12, 1);
insert into zadanie_obszar_umie values(6, 9, 1);
insert into zadanie_obszar_umie values(7, 3, 1);
insert into zadanie_obszar_umie values(8, 11, 1);
insert into zadanie_obszar_umie values(8, 3, 1);
insert into zadanie_obszar_umie values(9, 2, 1);
insert into zadanie_obszar_umie values(9, 4, 1);
insert into zadanie_obszar_umie values(9, 5, 1);
insert into zadanie_obszar_umie values(10, 13, 1);
insert into zadanie_obszar_umie values(11, 2, 1);
insert into zadanie_obszar_umie values(11, 11, 1);
insert into zadanie_obszar_umie values(12, 1, 1);
insert into zadanie_obszar_umie values(13, 11, 1);
insert into zadanie_obszar_umie values(14, 2, 1);
insert into zadanie_obszar_umie values(15, 2, 1);
insert into zadanie_obszar_umie values(16, 14, 1);
insert into zadanie_obszar_umie values(16, 6, 1);
insert into zadanie_obszar_umie values(16, 7, 1);
insert into zadanie_obszar_umie values(17, 7, 1);
insert into zadanie_obszar_umie values(18, 13, 1);
insert into zadanie_obszar_umie values(19, 2, 1);
insert into zadanie_obszar_umie values(20, 2, 1);
insert into zadanie_obszar_umie values(20, 8, 1);
insert into zadanie_obszar_umie values(21, 11, 1);
insert into zadanie_obszar_umie values(22, 15, 1);
insert into zadanie_obszar_umie values(22, 16, 2);
insert into zadanie_obszar_umie values(22, 17, 3);
insert into zadanie_obszar_umie values(22, 18, 4);
insert into zadanie_obszar_umie values(22, 19, 5);
insert into zadanie_obszar_umie values(22, 20, 6);



mysql> select * from zadanie limit 1;
+---------------+---------+------------+
| numer_zadania | max_pkt | podzadanie |
+---------------+---------+------------+
|             1 |       1 |          1 |
+---------------+---------+------------+
1 row in set (0.00 sec)

mysql> select * from uczen limit 1;
+-----+------------+------+-------+-------+----------------+
| kod | typ_miasta | plec | klasa | numer | rodzaj_choroby |
+-----+------------+------+-------+-------+----------------+
| A1  | miasto     | m    | A     |     1 |              1 |
+-----+------------+------+-------+-------+----------------+
1 row in set (0.00 sec)

mysql> select * from uczen_zadanie limit 1;
+------------+---------------+--------+------------+
| kod_ucznia | numer_zadania | punkty | podzadanie |
+------------+---------------+--------+------------+
| A1         |             1 |      1 |          1 |
+------------+---------------+--------+------------+
1 row in set (0.00 sec)

mysql> select * from obszar_umiejetnosc limit 1;
+----+--------+-------------+
| id | obszar | umiejetnosc |
+----+--------+-------------+
|  1 | I      | 1.2         |
+----+--------+-------------+
1 row in set (0.00 sec)
