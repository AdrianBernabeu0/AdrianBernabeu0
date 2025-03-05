#!/bin/bash

apt-get update

    DBHOST=localhost
    DBPASS=12345678 
    DBNAME=BDGrup5

sudo debconf-set-selections <<< "mysql-server mysql-server/root_password password $DBPASS"
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $DBPASS"

apt-get install -y mysql-server
    mysql -u root -p$DBPASS -e "CREATE USER 'Admin' IDENTIFIED BY 'admin';"
    mysql -u root -p$DBPASS -e "GRANT ALL PRIVILEGES ON *.* TO 'Admin';"
    mysql -u root -p$DBPASS -e "CREATE DATABASE $DBNAME;"
    mysql -u root -p$DBPASS -e "USE $DBNAME; CREATE TABLE Presentacions (ID_Presentacio INT AUTO_INCREMENT, titol VARCHAR(30) NOT NULL, descripcio TEXT,previsualizable ENUM('S','N'), pin VARCHAR(4), url VARCHAR(30),PRIMARY KEY (ID_Presentacio));"
    mysql -u root -p$DBPASS -e "USE $DBNAME; CREATE TABLE Preguntes (ID_Pregunta INT AUTO_INCREMENT, pregunta TEXT NOT NULL, resposta_correcte VARCHAR(255) NOT NULL, associada ENUM('S','N'), PRIMARY KEY (ID_Pregunta));"
    mysql -u root -p$DBPASS -e "USE $DBNAME; CREATE TABLE Diapositives (ID_Diapositiva INT AUTO_INCREMENT, titol VARCHAR(30) NOT NULL, contingut TEXT,Presentacio_ID INT, estil VARCHAR(30),tipus VARCHAR(30),posicio SMALLINT, pregunta_id INT,PRIMARY KEY (ID_Diapositiva),CONSTRAINT Presentacion_FK foreign key Diapositives(Presentacio_ID) REFERENCES Presentacions(ID_Presentacio), CONSTRAINT Pregunta_FK FOREIGN KEY Diapositives(pregunta_id) REFERENCES Preguntes(ID_Pregunta));"
    mysql -u root -p$DBPASS -e "USE $DBNAME; CREATE TABLE Opcions (ID_Opcio INT AUTO_INCREMENT, pregunta_id INT, opcio VARCHAR(255) NOT NULL, PRIMARY KEY (ID_Opcio), CONSTRAINT Preguntes_FK FOREIGN KEY Opcions(pregunta_id) REFERENCES Preguntes(ID_Pregunta));"
    
sed -i 's/127.0.0.1/0.0.0.0/g'  /etc/mysql/mysql.conf.d/mysqld.cnf
service mysql restart