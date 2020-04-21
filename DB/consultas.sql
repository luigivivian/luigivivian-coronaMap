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



-- idade de 10 anos até 20
select count(*) as total, YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(datanascimento))) as idade
from gmap_paciente gp
where (YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(datanascimento))) >= 10 and YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(datanascimento))) <= 20)
and (gp.`idCondicao` = 1 or gp.`idCondicao` = 10) and gp.`idCidade` = 1;



-- idade de 20 anos até 30
select count(*) as total
from gmap_paciente gp
where (YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(datanascimento))) >= 20 and YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(datanascimento))) <= 30)
and (gp.`idCondicao` = 1 or gp.`idCondicao` = 10) and gp.`idCidade` = 1;

-- idade de 30 anos até 50
select count(*) as total
from gmap_paciente gp
where (YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(datanascimento))) >= 30 and YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(datanascimento))) <= 50)
and (gp.`idCondicao` = 1 or gp.`idCondicao` = 10) and gp.`idCidade` = 1;


-- idade de 10 anos até 20
select count(*) as total
from gmap_paciente gp
where (YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(datanascimento))) >= 60)
and (gp.`idCondicao` = 1 or gp.`idCondicao` = 10) and gp.`idCidade` = 1;


select YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(datanascimento))) as idade
from gmap_paciente gp
where (YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(datanascimento))) >= 60)
and (gp.`idCondicao` = 1 or gp.`idCondicao` = 10) and gp.`idCidade` = 1;


-- idade de 20 até 30 anos
select count(id) as total
from gmap_paciente gp
where (YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(datanascimento))) > 20 and YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(datanascimento))) <= 30)
and gp.`idCondicao` = 1 or gp.`idCondicao` = 10 and gp.`idCidade` = 1;




-- total pacientes suspeitos by id unidade
select count(id) from gmap_paciente p 
where (p.`idCondicao` = 10 or p.`idCondicao` = 1) and `idCidade` = 1;



todos pacientes da cidade ordenados pelo id da unidade;
select count(*) as total, `idUnidade` from gmap_paciente gp 
where `idCondicao` = 10 or `idCondicao` = 1 and `idCidade` = 1 
group by `idUnidade`
order by `idUnidade`;


select * from coronavirus.gmap_cidade;

select * from gmap_unidade gu;









select datanascimento from gmap_paciente;


select * from gmap_paciente gp;
select * from gmap_usuario gu;

select * from gmap_cidade gc;

select * from gmap_unidade gu;


-- total de pacientes por unidade by condicao
select count(gp.id) as total_pacientes, un.id, un.nome as unidade
from gmap_paciente gp inner join gmap_unidade un
on gp.idUnidade = un.id
where idCondicao = 1 or 10
group by gp.id, un.id;


select * from gmap_tipocondicao gt;


-- suspeitos
1, 10


-- confirmados
5,8

-- get casos por unidade de saude and get unidade with location 


SELECT * ffom 



select * from gmap_usuario gu;


select count(id) as total, DATE(created_at) AS data
 from gmap_paciente gp
where (`idCondicao` = 5 or `idCondicao` = 8)
 GROUP BY DATE(created_at);

                       

1	covid-19 Suspeito	#ffff00	Paciente com suspeita de coronavirus
3	covid-19 Curado	#00ff00	Paciente curado de covid-19
4	covid-19 morte	#804000	Paciente que veio a óbito por complicações devido covid-19
5	covid-19 Confirmado	#ff8000	paciente com exame positivo para covid-19
8	covid-19 Confirmado/Risco	#ff0000	Paciente caso confirmado coronavirus
10	covid-19 Síndrome gripal 	#0000ff	Paciente em isolamento domiciliar

   
-- popular unidades
select count(id) as total_suspeitos, `idUnidade`
from gmap_paciente gp
where `idCidade` = 1 and (idCondicao = 1 or idCondicao = 10)
group by `idUnidade`;


select count(id) as total_confirmados, `idUnidade`
from gmap_paciente gp
where `idCidade` = 1 and (idCondicao = 5 or idCondicao = 8)
group by `idUnidade`;


select count(id) as total_curados, `idUnidade`
from gmap_paciente gp
where `idCidade` = 1 and (idCondicao = 3)
group by `idUnidade`;

select * from gmap_unidade gu where `idCidade`;






select * from gmap_unidade gu;
                                     
