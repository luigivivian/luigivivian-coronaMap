
create table gmap_estado(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome varchar(64) not null,
	uf varchar(2) not null,
);

ALTER TABLE coronavirus.gmap_estado 
DEFAULT CHARSET=utf8;

ALTER TABLE coronavirus.gmap_estado 
ENGINE=InnoDB;



create table gmap_cidade(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome varchar(64) not null,
	idEstado INT UNSIGNED not null,
	CONSTRAINT `fk_gmap_cidade_idEstado_estado` FOREIGN KEY (idEstado) REFERENCES gmap_estado (id)
);

ALTER TABLE coronavirus.gmap_cidade 
DEFAULT CHARSET=utf8;

ALTER TABLE coronavirus.gmap_cidade 
ENGINE=InnoDB;




create table gmap_tipoCondicao(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome varchar(64) not null,
	cor varchar(64) not null,
	descricao text not null
);

ALTER TABLE coronavirus.gmap_tipoCondicao 
DEFAULT CHARSET=utf8;

ALTER TABLE coronavirus.gmap_tipoCondicao 
ENGINE=InnoDB;


create table gmap_paciente(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome varchar(64) not null,
	sobrenome varchar(64) not null,
	datanascimento timestamp not null,
	telefone varchar(64) default null,
	rua varchar(64) not null,
	numero varchar(64) not null,
	endereco varchar(64) not null,
	idCondicao INT UNSIGNED not null,
	lat varchar(255) not null,
  	lng varchar(255) not null,
  	idCidade INT UNSIGNED not null,
  	created_at TIMESTAMP not null default CURRENT_TIMESTAMP,
  	total_familiares INT not null,
  	data_fim_quarentena DATE not null,
  	CONSTRAINT `fk_gmap_paciente_idCidade_cidade` FOREIGN KEY (idCidade) REFERENCES gmap_cidade (id),
  	CONSTRAINT `fk_gmap_paciente_idCondicao_tipoCondicao` FOREIGN KEY (idCondicao) REFERENCES gmap_tipoCondicao (id)
);



ALTER TABLE coronavirus.gmap_paciente 
DEFAULT CHARSET=utf8;

ALTER TABLE coronavirus.gmap_paciente 
ENGINE=InnoDB;


create table gmap_usuario(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome varchar(64) not NULL,
	sobrenome varchar(64) not null,
	email varchar(64) not null,
	login varchar(64) not null,
	celular varchar(64) not null,
	cidade varchar(64) not null,
	senha varchar(64) not null,
	medico boolean default false,
	idCidade INT UNSIGNED not null,
	CONSTRAINT `fk_gmap_paciente_idCidade_cidade` FOREIGN KEY (idCidade) REFERENCES gmap_cidade (id)
);


ALTER TABLE coronavirus.gmap_usuario 
DEFAULT CHARSET=utf8;

ALTER TABLE coronavirus.gmap_usuario 
ENGINE=InnoDB;




SELECT c.nome as cidade, e.nome as estado_nome from gmap_cidade c inner join gmap_estado e on c.idEstado = e.id where c.id = 1;


select * from gmap_estado;
select * from gmap_tipocondicao gt;
select * from gmap_cidade;
select * from gmap_usuario gu;
select * from gmap_paciente gp;

select * from gmap_estado ge;



SELECT u.idCidade, td.cor, td.nome as doencanome, u.datanascimento, td.descricao, u.id, u.idCondicao, u.lat, u.lng, u.nome, u.numero, u.sobrenome, u.rua, u.telefone
from gmap_paciente u
INNER JOIN gmap_tipoCondicao td
ON u.idCondicao = td.id and u.idCidade = 1;

// alterar cadastro paciente, cidade


-- condições pre cadastradas....
	ID	NOME				COR 	DESCRICAO
--	1	covid-19 Suspeito	#ffff00	Paciente com suspeita de coronavirus
--	3	covid-19 Curado	#00ff00	Paciente curado de covid-19
--	4	covid-19 morte	#804000	Paciente que veio a óbito por complicações devido covid-19
--	5	covid-19 Confirmado	#ff8000	paciente com exame positivo para covid-19
--	8	covid-19 Confirmado/Risco	#ff0000	Paciente caso confirmado coronavirus
--	10	covid-19 Síndrome gripal 	#0000ff	Paciente em isolamento domiciliar


