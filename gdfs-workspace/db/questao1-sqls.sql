--DDL - Tabelas

CREATE TABLE cidade(
id int UNSIGNED  auto_increment PRIMARY KEY,
nome varchar(100) NOT null
);

CREATE TABLE categoria(
id int UNSIGNED  auto_increment PRIMARY KEY,
nome varchar(100) NOT null
);

CREATE TABLE cidade_categoria(
id int UNSIGNED  auto_increment PRIMARY KEY,
id_cidade int UNSIGNED NOT null,
id_categoria int UNSIGNED NOT null,
vr_bandeirada decimal(10,2),
vr_hora decimal(10,2),
vr_km decimal(10,2),
FOREIGN KEY (id_cidade) REFERENCES cidade(id) ON DELETE CASCADE,
FOREIGN KEY (id_categoria) REFERENCES categoria(id) ON DELETE CASCADE
);

CREATE TABLE historico_calculo(
id int UNSIGNED  auto_increment PRIMARY KEY,
data_hora_calculo timestamp,
id_cidade int UNSIGNED NOT NULL,
id_categoria int UNSIGNED NOT NULL,
endereco_origem varchar(200) CHECK (endereco_origem >= 200),
--endereco_origem varchar(200) CHECK (endereco_origem >= 200),
endereco_destino varchar(200),
--endereco_destino varchar(200)  CHECK (endereco_destino >= 200),
distancia decimal(10,2),
duracao_minuto int UNSIGNED,
valor_calculado decimal(10,2),
FOREIGN KEY (id_cidade) REFERENCES cidade(id) ON DELETE CASCADE,
FOREIGN KEY (id_categoria) REFERENCES categoria(id) ON DELETE CASCADE
);



--Inserts
INSERT INTO cidade (nome) VALUES ('Petrópolis'), ('Rio de Janeiro'), ('Niterói'), ('Angra dos Reis');
INSERT INTO categoria (nome) VALUES ('Carro Executivo'), ('Carro Luxo'), ('Carro Família'), ('Carro Blindado'), ('Mototaxi');
INSERT INTO cidade_categoria (id_cidade, id_categoria, vr_bandeirada, vr_hora, vr_km)
VALUES 
(1, 1, '50.00', '200.00', '10.00'), (1, 2, '100.00', '250.00', '20.00'), (1, 3, '30.00', '150.00', '10.00'),
(2, 1, '5.00', '2.00', '2.00'), (2, 2, '7.00', '4.00', '5.00'), (2, 3, '5.00', '6.00', '3.00'), (2, 4, '10.00', '7.00', '8.00'), (2, 5, '2.00', '1.00', '1.00'),
(3, 1, '70.00', '170.00', '15.00'), (3, 2, '120.00', '270.00', '40.00'), (3, 3, '60.00', '160.00', '30.00');