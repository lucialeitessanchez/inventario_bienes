<?php

namespace App\Service;

use App\Service\Validation;
use App\Service\IOINPUT;

class ConsultaSie{
	
	/**
	 *
	 * @var string la url para obtener el wsdl del web service que se consulta
	 */
	//public $wsdl = 'http://asw.santafe.gov.ar/geex20a.wsdl';
    public $wsdl = 'http://asw.santafe.gov.ar/geex20a.wsdl';
	
	/**
	 *
	 * @var SoapClient el cliente del webservice
	 */
	public $client;
	
//==============================================================================
public function __construct() {
	
	ini_set("soap.wsdl_cache_enabled", "0");  // Para limpiar cache wsdl
	
	$this->client = new \SoapClient($this->wsdl);
}
//==============================================================================
/**
 * prueba : 01501-0071926-8   <-   01501-0070329-0
 *			01501-0077119-8
 * 
 * @param string $sie el sie, todfo junto o separado por '-'
 * @return array asociativo: 
			['error']	=> string se setea solo si hay error
			['fecha_inicio'] => string fecha Y-m-d . si esta seteado, es porque hay datos
			['iniciador'] => string
			['tema'] = string
			['concepto'] => string
			['fecha_ultimo_pase'] => string
			['folio'] => string
			['remitente'] => string				//Remitente - 1er renglon
			['remitente_oficina'] => string		//Ofic.rtte - 2do renglon
			['destino'] => string				//Destino - 1er renglon
			['destino_oficina'] => string		//Ofic.dest - 2do renglon
			['agregado_a'] => string nro de expediente principal, si es que esta agregado
 */
public function consultarSie($sie){
	
	try{
		$salida = array('sie' => $sie);
		
		$input = new IOINPUT();
		$input->in_ll = "00";
		$input->in_zz = "00";
		$input->in_datos = 'GEMEX20A '.\str_replace(' ', '', \str_replace('-', '', $sie));
		$results = $this->client->GEEX20AOperation($input);
		if(! ($results && is_object($results)) ){
			$salida['error'] = "Se encontro un error en [".__LINE__."]:\n[results no es un objeto]\n";
                        return $salida;
		}
		$cadena_resultado = $results->out_datos;
		$nom_error = \str_replace(" ", "", \trim( \substr($cadena_resultado, 669, 78) ) );
		
		if($nom_error){
			//	hay un error en la busqueda??
			//throw new Exception("Se encontro un error en [".__LINE__."]:\n$nom_error\n");
			$salida['error'] = "Se encontro un error en [".__LINE__."]:\n$nom_error\n";
			return $salida;
		}
		
		//............................................
		//	parseo el resultado
		//............................................
		$encontrado = false;
		$f_inicio_1 = \substr($cadena_resultado, 172, 4) . "-" . \substr($cadena_resultado, 178, 2) . "-" . \substr($cadena_resultado, 182, 2);
		$f_inicio_2 = substr($cadena_resultado, 173, 4) . "-" . substr($cadena_resultado, 179, 2) . "-" . substr($cadena_resultado, 183, 2);
		$f_inicio_3 = substr($cadena_resultado, 174, 4) . "-" . substr($cadena_resultado, 180, 2) . "-" . substr($cadena_resultado, 184, 2);
		if (\preg_match("/[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/", $f_inicio_1)) {
			$salida['fecha_inicio'] = $f_inicio_1;
			$offset_campos = 0;
		}
		else if (preg_match("/[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/", $f_inicio_2)) {
			$salida['fecha_inicio'] = $f_inicio_2;
			$offset_campos = 1;
		}
		else if (preg_match("/[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/", $f_inicio_3)) {
			$salida['fecha_inicio'] = $f_inicio_3;
			$offset_campos = 2;
		}
		
		if(isset($salida['fecha_inicio'])){
			$salida['iniciador'] = Validation::clear_text( \substr($cadena_resultado, 88, 40) );
			$salida['tema'] = Validation::clear_text( \substr($cadena_resultado, (198+$offset_campos), 51) );
			$salida['concepto'] = Validation::clear_text( \substr($cadena_resultado, (850+$offset_campos), 177) );
			$salida['fecha_ultimo_pase'] = \substr($cadena_resultado, (251+$offset_campos), 4) . "-" . \substr($cadena_resultado, (257+$offset_campos), 2) . "-" . \substr($cadena_resultado, (261+$offset_campos), 2);
			$salida['folio'] = Validation::clear_text( \substr($cadena_resultado, (265+$offset_campos), 4) );
			$salida['remitente'] = Validation::clear_text( \substr($cadena_resultado, (271+$offset_campos), 48) );				//Remitente - 1er renglon
			$salida['remitente_oficina'] = Validation::clear_text( \substr($cadena_resultado, (321+$offset_campos), 48) );		//Ofic.rtte - 2do renglon
			$salida['destino'] = Validation::clear_text( \substr($cadena_resultado, (371+$offset_campos), 48) );				//Destino - 1er renglon
			$salida['destino_oficina'] = Validation::clear_text( \substr($cadena_resultado, (421+$offset_campos), 48) );		//Ofic.dest - 2do renglon
			
			$agremesa = \trim(\str_replace(" ", "", \substr($cadena_resultado, (485+$offset_campos), 5) ) );
			$agrenumero = \trim(\substr($cadena_resultado, (492+$offset_campos), 7) );
			$agredigito = \trim(\substr($cadena_resultado, (501+$offset_campos), 1) );
			if($agremesa && $agrenumero && $agredigito){
				$salida['agregado_a'] = Validation::clear_text("{$agremesa}-{$agrenumero}-{$agredigito}");
				if(\strlen($salida['agregado_a']) != 15){
					$salida['agregado_a'] = NULL;
				}
			}
			else{
				$salida['agregado_a'] = NULL;
			}
			
			//	la limpieza ya la hice arriba
//			foreach($salida as $k => $v){
//				if($v !== NULL){
//					//	filtro los valores recibidos, porque en SIE viene de todo, caracteres no imprimibles, de control, etc
//					$salida[$k] = \filter_var( \trim( str_replace('\\', ' ', $v))  , FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW );
//				}
//			}
		}
		
		
		
		
		return $salida;
		
	}catch (\Exception $ex) {
		$salida['error'] = "Se encontro un error en [".__LINE__."]:\n".$ex->getMessage()."\n".$ex->getTraceAsString()."\n";
		return $salida;
	}
}
//==============================================================================

//==============================================================================

//==============================================================================
	
}
