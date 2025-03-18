DROP TABLE IF EXISTS themes;
DROP TABLE IF EXISTS question;
DROP TABLE IF EXISTS publication;

CREATE TABLE themes (
theme_id INT(8) NOT NULL AUTO_INCREMENT,
theme_nom VARCHAR(255) NOT NULL,
theme_description VARCHAR(255) NOT NULL,
theme_icon VARCHAR(255) NOT NULL,
PRIMARY KEY (theme_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE question (
question_id INT(8) NOT NULL AUTO_INCREMENT,
question_sujet VARCHAR(255) NOT NULL,
question_date DATETIME NOT NULL,
question_categorie INT(8) NOT NULL,
question_de INT(8) UNSIGNED NOT NULL,
PRIMARY KEY (question_id),
FOREIGN KEY (question_categorie) REFERENCES themes(theme_id) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (question_de) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE publication (
post_id INT(8) NOT NULL AUTO_INCREMENT,
post_contenu TEXT NOT NULL,
post_date DATETIME NOT NULL,
post_question INT(8) NOT NULL,
post_de INT(8) UNSIGNED NOT NULL,
PRIMARY KEY (post_id),
FOREIGN KEY (post_question) REFERENCES question(question_id) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (post_de) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO themes (theme_nom,theme_description,theme_icon)VALUES ('Histoire','','histoire.png');
INSERT INTO themes (theme_nom,theme_description,theme_icon)VALUES ('Géographie','','geographie.png');
INSERT INTO themes (theme_nom,theme_description,theme_icon)VALUES ('Français','','francais.png');
INSERT INTO themes (theme_nom,theme_description,theme_icon)VALUES ('Philosophie','','philosophie.png');
INSERT INTO themes (theme_nom,theme_description,theme_icon)VALUES ('Espagnol','','espagnol.png');
INSERT INTO themes (theme_nom,theme_description,theme_icon)VALUES ('Programmation','','programmation.png');
INSERT INTO themes (theme_nom,theme_description,theme_icon)VALUES ('Mathématiques','','mathématiques.png');
INSERT INTO themes (theme_nom,theme_description,theme_icon)VALUES ('Arabe','','arabe.png');
INSERT INTO themes (theme_nom,theme_description,theme_icon)VALUES ('Anglais','','anglais.png');
INSERT INTO themes (theme_nom,theme_description,theme_icon)VALUES ('Physique-Chimie','','physique-chimie.png');
INSERT INTO themes (theme_nom,theme_description,theme_icon)VALUES ('SVT','','svt.png');
INSERT INTO themes (theme_nom,theme_description,theme_icon)VALUES ('SES','','ses.png');
