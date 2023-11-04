CREATE DATABASE myDB;

USE myDB;

CREATE TABLE usuario (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(30) NOT NULL,
    sobrenome VARCHAR(30) NOT NULL,
    email VARCHAR(35) UNIQUE NOT NULL,
    senha VARCHAR(100) NOT NULL
);

CREATE TABLE cartao (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    banco VARCHAR(15) NOT NULL,
    numero VARCHAR(16) NOT NULL,
    limite DECIMAL(10,2) NOT NULL,
    limite_disponivel DECIMAL(10,2) NOT NULL, 
    usuario_id INT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuario(id) ON DELETE CASCADE
);

CREATE TABLE conta (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    banco VARCHAR(15) NOT NULL,
    numero VARCHAR(15) NOT NULL,
    saldo DECIMAL(10,2) NOT NULL,
    usuario_id INT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuario(id) ON DELETE CASCADE

);

CREATE TABLE tipo_lancamento (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(20) NOT NULL
);

INSERT INTO tipo_lancamento (nome) VALUES ('RECEITA');
INSERT INTO tipo_lancamento (nome) VALUES ('DESPESA');

CREATE TABLE fonte (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(20) NOT NULL
);

INSERT INTO fonte (nome) VALUES ('CARTAO_DE_CREDITO');
INSERT INTO fonte (nome) VALUES ('CONTA_BANCARIA');

CREATE TABLE lancamento (
    id INT PRIMARY KEY AUTO_INCREMENT,
    valor DECIMAL NOT NULL,
    tipo_id INT NOT NULL,
    usuario_id INT NOT NULL,
    fonte_id INT NOT NULL,
    cartao_conta_id INT NOT NULL,
    data_lancamento DATE NOT NULL,
    FOREIGN KEY (tipo_id) REFERENCES tipo_lancamento(id),
    FOREIGN KEY (usuario_id) REFERENCES usuario(id) ON DELETE CASCADE,
    FOREIGN KEY (fonte_id) REFERENCES fonte(id)
);