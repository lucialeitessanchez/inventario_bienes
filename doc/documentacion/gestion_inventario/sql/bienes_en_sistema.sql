SELECT fechaBaja,fechaAlta,codigo,nro_sari,nombreTipo,nombreRama,descripcion,nombre,dni,cargo as cargo_resp,oficina,
concat(calle," ",numero," ") as ubicacion
FROM `bien` 
inner join rama on id_rama=rama.id 
inner join tipo on bien.id_tipo=tipo.id 
inner join responsable on id_responsable=responsable.id 
left join ubicacion on id_ubicacion=ubicacion.id
WHERE 1 
ORDER BY nombreTipo,nombreRama,fechaAlta

/*PARA REPORTE*/
SELECT concat(calle," ",numero," ") as ubicacion,oficina,nombre,cargo as cargo_resp,
fechaAlta,bien.codigo,
nro_licitacion,nro_serie,nro_sari,
nombreTipo,nombreRama,descripcion,
firmado
FROM `bien` 
inner join rama on id_rama=rama.id 
inner join tipo on bien.id_tipo=tipo.id 
inner join responsable on id_responsable=responsable.id 
left join ubicacion on id_ubicacion=ubicacion.id
left JOIN seguimiento_firmas on seguimiento_firmas.codigo=bien.codigo
WHERE nro_licitacion like '%176/21%'
ORDER BY ubicacion,oficina,fechaAlta



/*ACTUALIZACOMO SARI EN BIEN CON PLANILLA RECIBIDAS*/

SELECT POSITION("COM" IN "W3Schools.com") AS MatchPosition; 

select * from bien,genero 
where position (genero.nro inv in descripcion) >0


select genero.`NRO INV` from bien,genero 
where locate(genero.`NRO INV`,descripcion) >0

update bien,genero set nro_sari=genero.`NRO INV` 
where locate(genero.`NRO INV`,descripcion) >0)

select genero.`NRO SERIE` from bien,genero 
where locate(genero.`NRO SERIE`,descripcion) >0