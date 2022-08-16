<?php
/**
 * @package BASE
 */
namespace App\Service;

class Validation{
	
	/**
	 *
	 * @var string expresion regular para validar Texto. No tiene expresion de repeticion
	 *			no permitido: ' " < > \ | · % = ` 
	 */
	public static $valid_char = '[[:space:]a-zA-Z0-9_áéíóúÁÉÍÓÚñÑüÜöÖëËïÏäÄ´?¿¡!ºª°çÇ()\/,;:@#&\$\.\{\}\*\+\[\]\-]';
	
	
	public static $char_search_filename = 'ŠŽšžŸÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÑÒÓÔÕÖØÙÚÛÜÝàáâãäåçèéêëìíîïñòóôõöøùúûüýÿ';
   public static $char_replacement_filename = 'SZszYAAAAAACEEEEIIIINOOOOOOUUUUYaaaaaaceeeeiiiinoooooouuuuyy';

	
	
	/**
	 *
	 * @var string almacena el encoding de la expresion regular, para cachearlo
	 */
	public static $local_encoding;
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/**
 * Valida una fecha, por formato y rango
 *
 * @param date $valor : Fecha
 * @param string $formato : Formato en que esta la fecha
 * @param date $min : Fecha minima ('Y-m-d')
 * @param date $max : Fecha maxima ('Y-m-d')
 * @param bool $estricto : Si es 0, la comparacion con los limites es por <= y >=, si es 1 la comparacion es por < y >
 * @return int : Código de error
 * 			0 => OK
 * 			1 => Formato incorrecto
 * 			2 => La fecha es menor al minimo
 * 			3 => La fecha es mayor al maximo
 */
public static function date($valor, $formato='Y-m-d', $min=null, $max=null, $estricto=false){
	return self::_validate_datetime($valor, $formato, 'Y-m-d', $min, $max, $estricto);
}	//	fin validar_date
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/**
 * Valida una fecha, por formato y rango
 *
 * @param datetime $valor : Fecha-hora
 * @param string $formato : Formato en que esta la fecha
 * @param datetime $min : Fecha-hora minima ('Y-m-d H:i:s')
 * @param datetime $max : Fecfecha-horaha maxima ('Y-m-d H:i:s')
 * @param bool $estricto : 	Si es 0, devuelve OK si esta dentro del intervalo cerrado 1 in [1..5] => OK
 * 							Si es 1, devuelve OK si esta dentro del intervalo abierto 1 in (1..5) => error
 * @return int : Código de error
 * 			0 => OK
 * 			1 => Formato incorrecto
 * 			2 => La fecha-hora es menor al minimo
 * 			3 => La fecha-hora es mayor al maximo
 */
public static function datetime($valor, $formato='Y-m-d H:i:s', $min=null, $max=null, $estricto=false){
	return self::_validate_datetime($valor, $formato, 'Y-m-d H:i:s', $min, $max, $estricto);
}	//	fin validar_datetime
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/**
 * Valida una fecha, por formato y rango
 *
 * @param datetime $valor : Hora
 * @param string $formato : Formato en que esta la hora
 * @param datetime $min : Fecha-hora minima ('H:i:s')
 * @param datetime $max : Fecfecha-horaha maxima ('H:i:s')
 * @param bool $estricto : 	Si es 0, devuelve OK si esta dentro del intervalo cerrado 1 in [1..5] => OK
 * 							Si es 1, devuelve OK si esta dentro del intervalo abierto 1 in (1..5) => error
 * @return int : Código de error
 * 			0 => OK
 * 			1 => Formato incorrecto
 * 			2 => La fecha-hora es menor al minimo
 * 			3 => La fecha-hora es mayor al maximo
 */
public static function time($valor, $formato='H:i:s', $min=null, $max=null, $estricto=false){
	return self::_validate_datetime($valor, $formato, 'H:i:s', $min, $max, $estricto);
}	//	fin time
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
public static function _validate_datetime($valor_p, $formato_from, $formato_to, $min, $max, $estricto){
	
	$salida = 0;
	$val_convertido = false;
	
	if(is_object($valor_p)){
		//	obj datetime de PHP
		$valor = $valor_p->format($formato_from);
	}
	else{
		$valor = $valor_p;
	}
	
	if($valor){
		if($formato_from != $formato_to)
			$val_convertido = self::date_format($valor, $formato_from, $formato_to);
		else
			$val_convertido = $valor;
		
		if($val_convertido){
			// verificar limites de fecha
			if($min !== null){
				$aux_1 = strcmp($val_convertido, $min);
				if($estricto){
					if($aux_1 <= 0){ $salida = 2;}
				}
				else{
					if($aux_1 < 0){ $salida = 2;}
				}
			}
			if($max !== null){
				$aux_2 = strcmp($val_convertido, $max);
				if($estricto){
					if($aux_2 >= 0){ $salida = 3;}
				}
				else{
					if($aux_2 > 0){ $salida = 3;}
				}
			}
		}
		else{
			// formato incorrecto
			$salida = 1;
		}
	}
	else{
		//	no tengo valor, pero engo que ver si tengo min y max seteado
		if($min)
			$salida = 2;
		else if($max)
			$salida = 3;
	}
	
	return $salida;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/**
 * Valida un entero, por formato y rango
 *
 * @param int $valor : Número
 * @param int $min : Valor minimo
 * @param int $max : Valor maximo
 * @param bool $estricto : 	Si es 0, devuelve OK si esta dentro del intervalo cerrado 1 in [1..5] => OK
 * 							Si es 1, devuelve OK si esta dentro del intervalo abierto 1 in (1..5) => error
 * @return int : Código de error
 * 			0 => OK
 * 			1 => Formato incorrecto
 * 			2 => El número es menor al minimo
 * 			3 => El número es mayor al maximo
 */
public static function int($valor, $min=null, $max=null, $estricto=false){
	global $gl_debug;
	
	$salida = 0;
	
	//$pat = '/^[-]{0,1}([1-9][0-9]*)$|^0$/';
	$pat = '^[-]{0,1}([1-9][0-9]*)$|^0$';
	//$formato_ok = preg_match('/^[-]{0,1}([1-9][0-9]*)$|^0$/', "$valor");
	$formato_ok = mb_ereg_match($pat, "$valor");
	if($formato_ok){
		if(!$estricto){
			if(($min !== null) && ($valor < $min)){ $salida=2;}
			else if(($max !== null) && ($valor > $max)){ $salida=3;}
		}
		else{
			if(($min !== null) && ($valor <= $min)){ $salida=2;}
			else if(($max !== null) && ($valor >= $max)){ $salida=3;}
		}
	}
	else{
		$salida = 1;
	}
	
	return $salida;
}	//	fin int
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/**
 * Valida un entero, por formato y rango
 *
 * @param mixed $valor : dato a validar
 * @param int $min : sin uso
 * @param int $max : sin uso
 * @param bool $estricto : 	sin uso
 * @return int : Código de error
 * 			0 => OK
 * 			1 => Formato incorrecto
 */
public static function bool($valor){
	
	if(($valor === true) || ($valor === false) || ($valor === 1) || ($valor === 0)){
		$salida = 0;
	}
	else{
		$salida = 1;
	}
	
	return $salida;
}	//	fin int
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/**
 * Valida un float, por formato y rango
 *		USA UNA PRESICION ARBITRARIA DE 8 DECIMALES para comparar el min y max
 *
 * @param float $valor : Número
 * @param float $min : Valor mínimo
 * @param float $max : Valor máximo
 * @param bool $estricto : 	Si es 0, devuelve OK si esta dentro del intervalo cerrado 1 in [1..5] => OK
 * 							Si es 1, devuelve OK si esta dentro del intervalo abierto 1 in (1..5) => error
 * @return int : Código de error
 * 			0 => OK
 * 			1 => Formato incorrecto
 * 			2 => El número es menor al minimo
 * 			3 => El número es mayor al maximo
 */
public static function float($valor, $min=null, $max=null, $estricto=false){
	global $gl_debug;
	
	$salida = 0;
	$min = ($min !== null) ? round($min, 8) : null;
	$max = ($max !== null) ? round($max, 8) : null;
	
	//$pat = '/^[-]{0,1}([0]\.[0-9]+)$|^[-]{0,1}([1-9][0-9]+\.[0-9]+)$|^[-]{0,1}([1-9][0-9]*)$|^0$/';
	$pat = '^[-]{0,1}([0]\.[0-9]+)$|^[-]{0,1}([1-9][0-9]*\.[0-9]+)$|^[-]{0,1}([1-9][0-9]*)$|^0$';
	//$formato_ok = preg_match('/^[-]{0,1}([0]\.[0-9]+)$|^[-]{0,1}([1-9][0-9]+\.[0-9]+)$|^[-]{0,1}([1-9][0-9]*)$|^0$/', "$valor");
	$formato_ok = mb_ereg_match($pat, "$valor");
	if($formato_ok){
		$valor = round($valor, 8);
		if(!$estricto){
			if(($min !== null) && ($valor < $min)){ $salida=2;}
			else if(($max !== null) && ($valor > $max)){ $salida=3;}
		}
		else{
			if(($min !== null) && ($valor <= $min)){ $salida=2;}
			else if(($max !== null) && ($valor >= $max)){ $salida=3;}
		}
	}
	else{
		$salida = 1;
	}
	
	return $salida;
}	//	fin float
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/**
 * Valida un texto, por formato y longitud
 *
 * @param string $valor : Texto
 * @param int $min : Long mínimo
 * @param int $max : Long maximo
 * @return int : Código de error
 * 			0 => OK
 * 			1 => Formato incorrecto
 * 			2 => El número es menor al minimo
 * 			3 => El número es mayor al maximo
 */
public static function text($valor, $min=null, $max=null){
	
	$salida = 0;
	
	if(! self::$local_encoding)
		self::$local_encoding = mb_detect_encoding(self::$valid_char, 'UTF-8,ISO-8859-1');
	$enc_cadena = mb_detect_encoding($valor, 'UTF-8,ISO-8859-1');
	if($enc_cadena != self::$local_encoding){
		$valor = mb_convert_encoding($valor, self::$local_encoding, $enc_cadena);
	}
	
	$formato_ok = mb_ereg_match('^'.self::$valid_char.'*$', $valor);
	if($formato_ok){
		if($min > 0){
			$long = mb_strlen($valor, self::$local_encoding);
			if($long < $min)
				$salida = 2;
		}
		if($max !== null){
			if(! isset($long)){ $long = mb_strlen($valor, self::$local_encoding); }
			if($long > $max)
				$salida = 3;
		}
	}
	else{
		$salida = 1;
	}
	
	return $salida;
}	//	fin text
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/**
 * Valida un texto, por formato y longitud
 *
 * @param string $valor : Path del archivo
 * @param int $min : Tamaño mínimo en Bytes
 * @param int $max : Tamaño máximo en Bytes
 * @return int : Código de error
 * 			0 => OK
 * 			1 => Formato incorrecto
 * 			2 => El número es menor al minimo
 * 			3 => El número es mayor al maximo
 */
public static function file($valor, $min=null, $max=null){
	
	$salida = 0;
	
	if(!is_file($valor)){
		return 1;
	}
	
	if($min > 0){
		$long = filesize($valor);
		if($long < $min)
			$salida = 2;
	}
	if($max !== null){
		$long = filesize($valor);
		if($long > $max)
			$salida = 3;
	}
	
	return $salida;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/**
 * Formatea un fecha/fechaHora/hora desde un formato a otro
 *	@param $fecha : Fecha
 *  @param $formato_from : Formato actual
 *  @param $formato_to : Formato de salida
 *	@return		si formateo => date : fecha convertida
				si no pudo formatear => FALSE
				si la fecha es invalida => null
 */
public static function date_format($fecha, $formato_from, $formato_to){
	
	global $gl_debug;
	
	$fecha = trim($fecha);
	if (!($fecha)){
		return null;
	}
	if (($fecha == '0000-00-00') || ($fecha == '0000-00-00 00:00:00')){
		return null;
	}
	
	$hora = 0 ; $minuto = 0 ; $segundo = 0 ; $mes =1; $dia =1; $anio =0; $dia_s=0;
	
	if ( (! $formato_from) || (! $formato_to) ){
		if($gl_debug > 9){
			$obj_e = new GC_Exception("  no me pasan los parametros para convertir la fecha !!!   \nfecha: $fecha \nf_1: $formato_from \nf_2: $formato_to \n", 4);
			throw $obj_e;
		}
		return $fecha;
	}
	
	$formats = array(
				'Y' => array('l_min' => 4, 'l_max' => 4, 'v_min' => 1,  'v_max' => 4000, 'var' => &$anio ),		//	anio
				'y' => array('l_min' => 2, 'l_max' => 2, 'v_min' => 1,  'v_max' => 99, 'var' => &$anio ),		//	anio
				'm' => array('l_min' => 2, 'l_max' => 2, 'v_min' => 1,  'v_max' => 12, 'var' => &$mes),			//	mes
				'n' => array('l_min' => 1, 'l_max' => 2, 'v_min' => 1,  'v_max' => 12, 'var' => &$mes ),		//	mes
				'd' => array('l_min' => 2, 'l_max' => 2, 'v_min' => 1,  'v_max' => 31, 'var' => &$dia ),		//	dia
				'j' => array('l_min' => 1, 'l_max' => 2, 'v_min' => 1,  'v_max' => 31, 'var' => &$dia ),		//	dia
				'N' => array('l_min' => 1, 'l_max' => 1, 'v_min' => 1,  'v_max' => 7, 'var' => &$dia_s ),		//	lunes = 1 .. dom = 7
				'w' => array('l_min' => 1, 'l_max' => 1, 'v_min' => 1,  'v_max' => 7, 'var' => &$dia_s ),		//	dom = 0 .. sab = 6
				'H' => array('l_min' => 2, 'l_max' => 2, 'v_min' => 0,  'v_max' => 24, 'var' => &$hora ),		//	hora
				'i' => array('l_min' => 2, 'l_max' => 2, 'v_min' => 0,  'v_max' => 59, 'var' => &$minuto ),		//	min
				's' => array('l_min' => 2, 'l_max' => 2, 'v_min' => 0,  'v_max' => 59, 'var' => &$segundo )		//	seg
				);
	
	$len_f = mb_strlen($formato_from);
	$i = 0;		//	idx del formato
	$idx = 0;	//	idx de la fecha
	$long_fecha_original = mb_strlen($fecha);
	while($i < $len_f){
		$char = $formato_from[$i];
		if( isset($formats[$char]) ){
			$aux_f = $formats[$char];
			$copia = '';
			for($j = 0; $j < $aux_f['l_min']; $j++){
				$posicion = $idx + $j;
				if($long_fecha_original <= $posicion)
					return null;
				if( is_numeric($fecha[$posicion]) ){
					$copia .= $fecha[$posicion];
				}
				else{
					//	formato incorrecto
					return false;
				}
			}
			$idx += $j;
			$primero = true;
			$dif_long = $aux_f['l_max'] - $aux_f['l_min'];
			for($j = 0; $j < $dif_long; $j++){
				$posicion = $idx + $j;
				if( is_numeric($fecha[$posicion]) ){
					$copia .= $fecha[$posicion];
				}
				else{
					if($primero)
						break;
					else
						//	formato incorrecto
						return false;
				}
				$primero = false;
			}
			//	aumento el index en el string FECHA
			$idx += $j;
			//	asigno la variable
			$aux_f['var'] = (int)$copia;
			//	controlo el rango de valores
			if(! ( ($aux_f['var'] >= $aux_f['v_min']) && ($aux_f['var'] <= $aux_f['v_max']) ) ){
				//	formato incorrecto
				return false;
			}
		}
		else{
			//	aumento el indice de la fecha en un caracter
			$idx++;
		}
		//	paso al sig caracter del formato
		$i++;
		
	}
	
	$date = mktime($hora,$minuto,$segundo, $mes, $dia, $anio);
	if($date === false)
		return null;	//	fecha invalida (si devuelve 0 si es una fecha valida)
	$aux_validar = date($formato_from, $date);
	if($fecha != $aux_validar){
		//	el formato es incorrecto
		//	puede ser que pongan dia del mes = 40, el mktime funciona igual (pasa al mes siguiente)
		//	pero sintacticamente esta mal
		return null;
	}
    $salida = date($formato_to, $date);
	return $salida;
	
}	//	fin date_format
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/**
 * Incrementa una fecha la cantidad de TIEMPO (dia, hora, mini, mes...) especificada
 *
 * @param  $fecha : La fecha inicial
 * @param  $formato : El formato en que esta
 * @param  $campo_inc : Que es lo que hay que incrementar (el año, mes, dia, hora, etc.)
 * 					puede ser : (Y m d H i s)
 * @param  $cantidad : cuanto hay que incrementarlo
 */
public static function fecha_incrementar($fecha, $formato, $campo_inc, $cantidad){
	
	global $gl_debug;
	
	$fecha_aux = self::date_format($fecha, $formato, 'Y-m-d H:i:s');
	
	// 'YYYY-mm-dd HH-ii-ss'
	
	$anio = substr($fecha_aux, 0, 4);
	$mes = substr($fecha_aux, 5, 2);
	$dia = substr($fecha_aux, 8, 2);
	$hora = substr($fecha_aux, 11, 2);
	$min = substr($fecha_aux, 14, 2);
	$seg = substr($fecha_aux, 17, 2);
	
	if($campo_inc == 'Y'){ $anio += $cantidad; }
	else if($campo_inc == 'm'){ $mes += $cantidad; }
	else if($campo_inc == 'd'){ $dia += $cantidad; }
	else if($campo_inc == 'H'){ $hora += $cantidad; }
	else if($campo_inc == 'i'){ $min += $cantidad; }
	else if($campo_inc == 's'){ $seg += $cantidad; }
	
	$tiempo = mktime($hora, $min, $seg, $mes, $dia, $anio);
	if($tiempo !== false){
		$salida = date($formato, $tiempo);
		return $salida;
	}
	
	return null;
}	//	fecha_incrementar
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/**
*   $genero = 1 (masculino)
*	$moneda = "";
*	$prefijo = "";
*	$sufijo = "";
*	$mayusculas = 0		(1 => may ; 0 => min)
 * @param type $numero
 * @param bool $genero
 * @param string $moneda
 * @param string $prefijo
 * @param string $sufijo
 * @param bool $mayusculas
 * @return string 
 */
public static function int_to_literal($numero, $genero = 1, $moneda = "", $prefijo = "", $sufijo = "", $mayusculas = 0){
	
	
    //textos
    $textos_posibles = array(
    0 => array ('UNA ','DOS ','TRES ','CUATRO ','CINCO ','SEIS ','SIETE ','OCHO ','NUEVE ','UN '),
    1 => array ('ONCE ','DOCE ','TRECE ','CATORCE ','QUINCE ','DIECISEIS ','DIECISIETE ','DIECIOCHO ','DIECINUEVE ',''),
    2 => array ('DIEZ ','VEINTE ','TREINTA ','CUARENTA ','CINCUENTA ','SESENTA ','SETENTA ','OCHENTA ','NOVENTA ','VEINTI'),
    3 => array ('CIEN ','DOSCIENTAS ','TRESCIENTAS ','CUATROCIENTAS ','QUINIENTAS ','SEISCIENTAS ','SETECIENTAS ','OCHOCIENTAS ','NOVECIENTAS ','CIENTO '),
    4 => array ('CIEN ','DOSCIENTOS ','TRESCIENTOS ','CUATROCIENTOS ','QUINIENTOS ','SEISCIENTOS ','SETECIENTOS ','OCHOCIENTOS ','NOVECIENTOS ','CIENTO '),
    5 => array ('MIL ','MILLON ','MILLONES ','CERO ','Y ','UNO ','DOS ','CON ','','')
    );
    $aTexto = array();

	for($i=0; $i<6;$i++)
		for($j=0;$j<10;$j++)
			$aTexto[$i][$j] = $textos_posibles[$i][$j];
	
	
	if($genero == 1){ //masculino
			$aTexto[0][0] = $textos_posibles[5][5];
			for($j=0;$j<9;$j++)
				$aTexto[3][$j] = $aTexto[4][$j];
	}
	else{//femenino
		$aTexto[0][0] = $textos_posibles[0][0];
		for($j=0;$j<9;$j++)
			$aTexto[3][$j] = $aTexto[3][$j];
	}
	
	$cnumero = sprintf("%015.2f", $numero);
	$texto = "";
	if(strlen($cnumero)>15){
		$texto = "Excede tamaño permitido";
	}
	else{
		$hay_significativo = false;
		for ($pos=0; $pos<12; $pos++){
			// Control existencia Dígito significativo 
			if (!($hay_significativo)&&(substr($cnumero,$pos,1) == '0')) ;
			else $hay_dignificativo = true;
			// Detectar Tipo de Dígito 
			switch($pos % 3) {
				case 0: 
					$texto .= self::letraCentena($pos, $cnumero, $aTexto);
					break;
				case 1: 
					$texto.= self::letraDecena($pos, $cnumero, $aTexto);
					break;
				case 2: 
					$texto.= self::letraUnidad($pos, $cnumero, $aTexto);
					break;
			}
		}
		// Detectar caso 0 
		if ($texto == '') $texto = $aTexto[5][3];
		if($mayusculas){
			//mayusculas
			$texto = strtoupper($prefijo.$texto." ".$moneda." con ".substr($cnumero,-2)."/100 centavos".$sufijo);    
		}
		else{
			//minusculas
			$texto = strtolower($prefijo.$texto." ".$moneda." con ".substr($cnumero,-2)."/100 centavos".$sufijo);    
		}
	}
	return $texto;
}
//------------------------------------------------------------------------------
/**
 *Traducir letra a unidad
 * @param int $pos
 * @param int $cnumero
 * @param string $aTexto
 * @return string
 */
public static function letraUnidad($pos, $cnumero, &$aTexto){
	
	$unidad_texto="";
	if( !((substr($cnumero,$pos,1) == '0') || 
		(substr($cnumero,$pos - 1,1) == '1') ||
		((substr($cnumero, $pos - 2, 3) == '001') &&  (($pos == 2) || ($pos == 8)) ) 
		)){ 
		if((substr($cnumero,$pos,1) == '1') && ($pos <= 6)){
			$unidad_texto .= $aTexto[0][9]; 
		}
		else{
			$unidad_texto .= $aTexto[0][substr($cnumero,$pos,1) - 1];
		}
	}
	if((($pos == 2) || ($pos == 8)) && 
		(substr($cnumero, $pos - 2, 3) != '000')){//miles
		if(substr($cnumero,$pos,1) == '1'){
			if($pos <= 6){
				$unidad_texto = substr($unidad_texto,0,-1)." ";
			}
			else{
				$unidad_texto = substr($unidad_texto,0,-2)." ";
			}
			$unidad_texto .= $aTexto[5][0]; 
		}
		else{
			$unidad_texto .= $aTexto[5][0]; 
		}
	}
	if($pos == 5 && substr($cnumero, 0, 6) != '000000'){
		if(substr($cnumero, 0, 6) == '000001'){//millones
			$unidad_texto .= $aTexto[5][1];
		}
		else{
			$unidad_texto .= $aTexto[5][2];
		}
	}
	return $unidad_texto;
}
//------------------------------------------------------------------------------
/**
 *Traducir digito a decena
 * @param int $pos
 * @param int $cnumero
 * @param string $aTexto
 * @return string 
 */
public static function letraDecena($pos, $cnumero, &$aTexto){
	
	$decena_texto = "";
	if (substr($cnumero,$pos,1) == '0'){
		return;
	}
	else if(substr($cnumero,$pos + 1,1) == '0'){ 
		$decena_texto .= $aTexto[2][substr($cnumero,$pos,1)-1];
	}
	else if(substr($cnumero,$pos,1) == '1'){ 
		$decena_texto .= $aTexto[1][substr($cnumero,$pos+ 1,1)- 1];
	}
	else if(substr($cnumero,$pos,1) == '2'){
		$decena_texto .= $aTexto[2][9];
	}
	else{
		$decena_texto .= $aTexto[2][substr($cnumero,$pos,1)- 1] . $aTexto[5][4];
	}
	return $decena_texto;
}
//------------------------------------------------------------------------------
/**
 * Traducir digito centena
 * @param int $pos
 * @param int $cnumero
 * @param string $aTexto
 * @return string 
 */
public static function letraCentena($pos, $cnumero, &$aTexto){
	
	$centena_texto = "";
	if (substr($cnumero, $pos, 1) == '0') return;
	$pos2 = 3;
	if((substr($cnumero,$pos,1) == '1') && (substr($cnumero,$pos+ 1, 2) != '00')){
		$centena_texto .= $aTexto[$pos2][9];
	}
	else{
		$centena_texto .= $aTexto[$pos2][substr($cnumero,$pos,1) - 1];
	}
	return $centena_texto;
}
//------------------------------------------------------------------------------

//------------------------------------------------------------------------------
public static function mb_str_pad($input, $pad_length, $pad_string=' ', $pad_type=STR_PAD_RIGHT) {
    $diff = strlen($input) - mb_strlen($input, 'UTF-8');
    return str_pad($input, $pad_length+$diff, $pad_string, $pad_type);
}
//------------------------------------------------------------------------------
public static function clear_text($valor){
	
	if(! self::$local_encoding)
		self::$local_encoding = mb_detect_encoding(self::$valid_char, 'UTF-8,ISO-8859-1');
        
        // encondig detectado
	$enc_cadena = mb_detect_encoding($valor, 'UTF-8,ISO-8859-1');

	if($enc_cadena != self::$local_encoding){
            $valor = mb_convert_encoding($valor, self::$local_encoding, $enc_cadena);
	}
	
	$expr_replace = '[^'.substr(self::$valid_char, 1);                
	$valor = mb_ereg_replace($expr_replace, '', $valor);
	return $valor;
}
//------------------------------------------------------------------------------
public static function clear_filename($filename){
	
	
	$clean_name = \strtr($filename, self::$char_search_filename, self::$char_replacement_filename);
	$clean_name = \preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), $clean_name);
	
	return $clean_name;
}
	
//==============================================================================
public static function to_seconds(\DateInterval $interval){
	
	$sec = ($interval->y * 31536000) + ($interval->m * 2592000) + ($interval->d * 86400) + ($interval->h * 3600) + ($interval->i * 60) + $interval->s;
	return $sec;
}
//==============================================================================
	


}




