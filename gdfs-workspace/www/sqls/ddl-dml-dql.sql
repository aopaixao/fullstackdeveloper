CREATE TABLE cidade(
id int UNSIGNED  auto_increment PRIMARY KEY,
nome varchar(100) NOT null
);

INSERT INTO cidade (nome) VALUES ('Petrópolis');
INSERT INTO cidade (nome) VALUES ('Rio de Janeiro');

UPDATE cidade SET nome = 'Juiz de Fora' WHERE nome LIKE 'Petrópolis';

SELECT * FROM cidade;