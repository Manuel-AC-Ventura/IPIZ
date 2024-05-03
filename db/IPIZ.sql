CREATE DATABASE IF NOT EXISTS IPIZ DEFAULT CHARACTER SET utf8;

USE IPIZ;

-- Tabela de Alunos
CREATE TABLE IF NOT EXISTS `alunos` (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome varchar(100) NOT NULL,
  sobrenome varchar(100) NOT NULL,
  numBI varchar(100) NOT NULL,
  naturalidade varchar(100) NOT NULL,
  nomePai varchar(100) NOT NULL,
  nomeMae varchar(100) NOT NULL,
  morada varchar(100) NOT NULL,
  contacto varchar(100) NOT NULL,
  outroContacto varchar(100) NULL,
  dataNascimento date NOT NULL,
  genero varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Tabela de Papéis
CREATE TABLE IF NOT EXISTS `papeis` (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Populando a tabela de Papéis
INSERT INTO `papeis` (nome) VALUES
('Diretor'),
('Professor'),
('Secretaria');

-- Tabela de Funcionários
CREATE TABLE IF NOT EXISTS `funcionarios`(
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome varchar(100) NOT NULL,
  sobrenome varchar(100) NOT NULL,
  numBI varchar(100) NOT NULL,
  naturalidade varchar(100) NOT NULL,
  morada varchar(100) NOT NULL,
  contacto varchar(100) NOT NULL,
  cargo varchar(100) NOT NULL,
  especialidade varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  senha varchar(500) NOT NULL DEFAULT '12345678',
  ativo TINYINT NOT NULL DEFAULT 1,
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Tabela de Matrículas
CREATE TABLE IF NOT EXISTS `matriculas` (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  idAluno int(11) NOT NULL,
  anoEscolar varchar(100) NOT NULL,
  curso varchar(100) NOT NULL,
  turno varchar(100) NOT NULL,
  dataMatricula DATE DEFAULT CURRENT_DATE,
  FOREIGN KEY (idAluno) REFERENCES alunos(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Tabela de Permissões
CREATE TABLE IF NOT EXISTS `permissoes` (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_funcionario int(11) NOT NULL,
  id_papel int(11) NOT NULL,
  FOREIGN KEY (id_funcionario) REFERENCES funcionarios(id),
  FOREIGN KEY (id_papel) REFERENCES papeis(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
