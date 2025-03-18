create database projet;
use projet;
DROP TABLE IF EXISTS users;

CREATE TABLE IF NOT EXISTS users (
  id INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  prenom VARCHAR(256) NOT NULL DEFAULT '',
  nom VARCHAR(256) NOT NULL DEFAULT '',
  pseudo VARCHAR(256) NOT NULL DEFAULT '', 
  mail VARCHAR(256) NOT NULL DEFAULT '',
  photo VARCHAR(256) NOT NULL DEFAULT 'icon.png',
  abonnes INT(16) NOT NULL DEFAULT 0,
  suivis INT(16) NOT NULL DEFAULT 0,
  naissance DATE,
  password CHAR(70) NOT NULL DEFAULT '', 
  isAdmin BOOLEAN NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO users (prenom, nom, pseudo, mail, naissance, password) VALUES ('Juddy','Andraos','juddyandraos','andraos.juddy@gmail.com','2004-04-14','$2y$10$SzN2FhQ4A.RbE630coS5W.oID5TZ3xSNqO.1ji2MXuC7KLE6NWJKC');
INSERT INTO users (prenom, nom, pseudo, mail, naissance, password) VALUES ('Maroun','Gebrayel','maroungebrayel','maroun.gebrayel@gmail.com','2004-09-09','$2y$10$SzN2FhQ4A.RbE630coS5W.oID5TZ3xSNqO.1ji2MXuC7KLE6NWJKC');
UPDATE users SET isAdmin=true WHERE pseudo='juddyandraos';
UPDATE users SET isAdmin=true WHERE pseudo='maroungebrayel';