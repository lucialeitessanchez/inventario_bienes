/*INSERTAR RESPONSABLES EN inventario_bienesv2*/
SELECT id id_responsable,nombre,dni,funcionario,cargo,
id_responsableArea responsable_area_id_responsable_area,
idOficina oficina_id_oficina 
FROM `responsable` WHERE 1
/*------------------------------------------------*/

/* RESPOBSABLES DE AREA*/
SELECT id id_responsable_area,cargo area,cargo,responsable_id_responsable 
FROM `responsable_area` WHERE 1 
/*-----------------------------------------------*/
