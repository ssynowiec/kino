CREATE TABLE Klienci (
  idKlienta INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  login VARCHAR(25)  NULL  ,
  imie VARCHAR(45)  NOT NULL  ,
  nazwisko VARCHAR(45)  NOT NULL  ,
  mail VARCHAR(45)  NOT NULL  ,
  adres VARCHAR(45)  NOT NULL  ,
  kod_pocztowy VARCHAR(6)  NOT NULL  ,
  miejscowosc VARCHAR(45)  NOT NULL  ,
  nr_telefonu VARCHAR(12)  NOT NULL  ,
  pass VARCHAR(45)  NULL    ,
PRIMARY KEY(idKlienta));



CREATE TABLE Pracownicy (
  idPracownika INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  login VARCHAR(20)  NOT NULL  ,
  imie VARCHAR(45)  NOT NULL  ,
  nazwisko VARCHAR(45)  NOT NULL  ,
  pass VARCHAR(255)  NOT NULL    ,
PRIMARY KEY(idPracownika));



CREATE TABLE Sale (
  nr_sali INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  pojemnosc INTEGER UNSIGNED  NOT NULL    ,
PRIMARY KEY(nr_sali));



CREATE TABLE Bilety (
  idBiletu INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  typ VARCHAR(20)  NOT NULL  ,
  cena FLOAT  NOT NULL    ,
PRIMARY KEY(idBiletu));



CREATE TABLE Gatunki (
  idGatunku INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  nazwa VARCHAR(45)  NOT NULL  ,
  kat_wiek INTEGER UNSIGNED  NULL    ,
PRIMARY KEY(idGatunku));



CREATE TABLE Filmy (
  idFilmu INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  Gatunki_idGatunku INTEGER UNSIGNED  NOT NULL  ,
  tytul VARCHAR(255)  NOT NULL  ,
  producent VARCHAR(255)  NULL  ,
  rezyser VARCHAR(255)  NULL  ,
  czas_trwania TIME  NULL  ,
  plakat VARCHAR(255)  NULL    ,
PRIMARY KEY(idFilmu)  ,
INDEX Filmy_FKIndex1(Gatunki_idGatunku),
  FOREIGN KEY(Gatunki_idGatunku)
    REFERENCES Gatunki(idGatunku)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION);



CREATE TABLE Seanse (
  idSeansu INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  Filmy_idFilmu INTEGER UNSIGNED  NOT NULL  ,
  Sale_nr_sali INTEGER UNSIGNED  NOT NULL  ,
  date DATE  NULL  ,
  time TIME  NULL    ,
PRIMARY KEY(idSeansu)  ,
INDEX Seanse_FKIndex1(Sale_nr_sali)  ,
INDEX Seanse_FKIndex2(Filmy_idFilmu),
  FOREIGN KEY(Sale_nr_sali)
    REFERENCES Sale(nr_sali)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(Filmy_idFilmu)
    REFERENCES Filmy(idFilmu)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION);



CREATE TABLE Rezerwacje (
  idRezerwacje INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  Klienci_idKlienta INTEGER UNSIGNED  NOT NULL  ,
  Seanse_idSeansu INTEGER UNSIGNED  NOT NULL  ,
  Bilety_idBiletu INTEGER UNSIGNED  NOT NULL  ,
  miejsce INTEGER UNSIGNED  NOT NULL  ,
  rzad INTEGER UNSIGNED  NOT NULL    ,
PRIMARY KEY(idRezerwacje)  ,
INDEX Rezerwacje_FKIndex1(Bilety_idBiletu)  ,
INDEX Rezerwacje_FKIndex2(Seanse_idSeansu)  ,
INDEX Rezerwacje_FKIndex3(Klienci_idKlienta),
  FOREIGN KEY(Bilety_idBiletu)
    REFERENCES Bilety(idBiletu)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(Seanse_idSeansu)
    REFERENCES Seanse(idSeansu)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(Klienci_idKlienta)
    REFERENCES Klienci(idKlienta)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION);




