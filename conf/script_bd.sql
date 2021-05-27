CREATE DATABASE estacionamento;

USE estacionamento;

CREATE TABLE carro(
	id integer AUTO_INCREMENT NOT NULL,
	placa varchar(8) NOT NULL,
    modeloCar varchar(45) NOT NULL,
    marcaCar varchar(45),
    hrsCompradas integer NOT NULL,
    hrsEntrada datetime NOT NULL,
    dinheiro double,
    PRIMARY KEY (id));