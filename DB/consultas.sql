select * from gmap_usuario gu;


select * from gmap_paciente gp;



select * from gmap_tipocondicao gt where id = 5 or id = 8;


-- casos confirmados
select * from gmap_paciente gp where `idCondicao` = 5 or `idCondicao` = 8;


-- total de casos confirmados ( id confirmado  5 e 8)
select count(id), DATE(created_at) AS ForDate
from gmap_paciente gp
where (`idCondicao` = 2 or `idCondicao` = 3) and `idCidade` = 1
GROUP BY DATE(created_at);


-- total casos suspeitos (ids = )
select count(id), DATE(created_at) AS ForDate
from gmap_paciente gp
where `idCondicao` = 1 and `idCidade` = 1
GROUP BY DATE(created_at);


-- regra graficos, se array for menor que 7 não é possivel montar grafico.



select * from gmap_paciente gp;




SELECT c.nome as cidade, e.nome as estado_nome from gmap_cidade c inner join gmap_estado e on c.idEstado = e.id where c.id = 1;


select * from gmap_estado;
select * from gmap_tipocondicao gt;
select * from gmap_cidade;
select * from gmap_usuario gu;
select * from gmap_paciente gp;

select * from gmap_estado ge;




SELECT * FROM gmap_usuario WHERE login = "luigivivian" and senha like "e277dd1e05688a22e377e25a3dae5de1";

SELECT u.idCidade, td.cor, td.nome as doencanome, u.datanascimento, td.descricao, u.id, u.idCondicao, u.lat, u.lng, u.nome, u.numero, u.sobrenome, u.rua, u.telefone
from gmap_paciente u
INNER JOIN gmap_tipoCondicao td
ON u.idCondicao = td.id and u.idCidade = 1;

// alterar cadastro paciente, cidade


select * from gmap_paciente gp;



-- total de pacientes por unidade by condicao
select count(gp.id) as total_pacientes, un.id, un.nome as unidade
from gmap_paciente gp inner join gmap_unidade un
on gp.idUnidade = un.id
where idCondicao = 3
group by gp.id, un.id;



-- get casos por unidade de saude and get unidade with location 


SELECT * ffom 
1	covid-19 Suspeito	#ffff00	Paciente com suspeita de coronavirus
3	covid-19 Curado	#00ff00	Paciente curado de covid-19
4	covid-19 morte	#804000	Paciente que veio a óbito por complicações devido covid-19
5	covid-19 Confirmado	#ff8000	paciente com exame positivo para covid-19
8	covid-19 Confirmado/Risco	#ff0000	Paciente caso confirmado coronavirus
10	covid-19 Síndrome gripal 	#0000ff	Paciente em isolamento domiciliar









