
/*armar COMBO DE AREAS*/
SELECT idArea,cargo 
FROM `oficina` 
inner join responsable_area on id=idArea 
WHERE 1 group by idArea 
ORDER BY `oficina`.`idArea` ASC 

/*LISTADO OFICINAS CON AREA RESPONSABLE Y UBICACION*/
SELECT idArea,cargo AS area_responsable,oficina.idOficina,oficina.oficina,  idUbicacion, calle,numero, localidad FROM `oficina`
inner join responsable_area on responsable_area.id=oficina.idArea
inner join ubicacion on idUbicacion=ubicacion.id
WHERE 1
order by cargo,oficina

/*LISTADO RESPONSABLES POR AREA-OFICINA*/
SELECT responsable_area.cargo,responsable.idOficina,oficina.oficina,
responsable.nombre,dni,responsable.cargo,funcionario 
FROM `responsable` 
left join responsable_area on id_responsableArea=responsable_area.id
left join oficina on responsable.idOficina=oficina.idOficina
WHERE 1
order by responsable_area.cargo,oficina.oficina,responsable.nombre


/*OFICINAS*/
INSERT INTO `oficina` (`idOficina`, `oficina`, `idUbicacion`) 
VALUES
(null,'DGA - Dpto Presupuesto Contable',null),
(null,'DGA - Revisiva',null),
(null,'DGA - Dto Personal y Sueldos',null),
(null,'DGA - Dto Personal y Sueldos - Informes y Legajos',null),
(null,'DGA - Dto Tesoreria, Habilitación y Mov. de Fondos',null),
(null,'DGA - Dto Tesoreria, Habilitación y Mov. de Fondos - Habilitación',null),
(null,'DGA - Dto Tesoreria, Habilitación y Mov. de Fondos - Oficina de Compras',null),
(null,'DGA - Archivo',null)

INSERT INTO `oficina` (`idOficina`, `oficina`, `idUbicacion`) 
VALUES
(null,'Mesa de Entradas',null),
(null,'Secretaría Privada',null),
(null,'Secretaría de Planificación y Coord. Adm. Legal y Técnica',null),
(null,'Subsec. Legal y Técnica y Gestión de la Información',null),
(null,'Subsec. de Planificación, Evaluación y Coop. estratégica de Políticas de Igualdad',null),
(null,'Dir. Gral. Asuntos Jurídicos y Despacho',null),
(null,'Dir. Gral. Asuntos Jurídicos - Dictamen',null),
(null,'Dir. Gral. Asuntos Jurídicos - Descpacho',null),
(null,'Archivo Jurisdiccional',null),
(null,'Sectorial Informática',null)

INSERT INTO `oficina` (`idOficina`, `oficina`, `idUbicacion`) 
VALUES
(null,'Secretaría de Mujeres, Género y Diversidad',null),
(null,'SubSec. de Fortalecimiento territorial en Igualdad, Género y Diversidad',null),
(null,'SubSec de Políticas contra la Violencia por razones de Género',null),
(null,'Casa de Amparo Gabriela Ulloa',null),
(null,'SubSec. de Políticas de Igualdad y Género',null),
(null,'Dir. Pcial. Promoción de Derechos para la Igualdad',null),
(null,'Secretaría de Formación y Capacitación para la Igualdad',null),
(null,'Dir. Pcial. Capacitación en Género y Diversidad',null),
(null,'SubSec. de Planificación estratégica de contenidos',null),
(null,'Agencia ATR Santa Fe - Juventudes',null),
(null,'Delegación Rosario - Mesa de Entradas',null),
(null,'DGA Rosario',null),
(null,'DGA Rosario - Compras y Habilitación',null),
(null,'DGA Rosario - Personal',null),
(null,'DGA Reconquista - Mesa de Entradas',null)


