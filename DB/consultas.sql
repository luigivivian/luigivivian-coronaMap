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