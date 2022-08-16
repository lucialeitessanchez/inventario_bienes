<?php

namespace MDS\RuinstitucionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Autoridad
 *
 * @ORM\Table(schema="mds_ruinstituciones", name="Autoridad")
 * @ORM\Entity
 */
class Autoridad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="aut_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $autId;

    /**
     * @var integer
     *
     * @ORM\Column(name="doctrine_version", type="integer", nullable=false)
     */
    private $doctrineVersion = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="aut_ape", type="string", length=255, nullable=true)
     */
    private $autApe;

    /**
     * @var string
     *
     * @ORM\Column(name="aut_nom", type="string", length=255, nullable=true)
     */
    private $autNom;

    /**
     * @var integer
     *
     * @ORM\Column(name="aut_doc", type="integer", nullable=true)
     */
    private $autDoc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="aut_fec_nac", type="date", nullable=true)
     */
    private $autFecNac;

    /**
     * @var string
     *
     * @ORM\Column(name="aut_cuil_cdi", type="string", length=255, nullable=true)
     */
    private $autCuilCdi;

    /**
     * @var string
     *
     * @ORM\Column(name="aut_sexo", type="string", length=255, nullable=true)
     */
    private $autSexo;

    /**
     * @var string
     *
     * @ORM\Column(name="aut_telefono", type="string", length=255, nullable=true)
     */
    private $autTelefono;

    /**
     * @var string
     *
     * @ORM\Column(name="aut_celular", type="string", length=255, nullable=true)
     */
    private $autCelular;

    /**
     * @var string
     *
     * @ORM\Column(name="aut_mail", type="string", length=255, nullable=true)
     */
    private $autMail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="aut_cargo_fec_ini", type="date", nullable=true)
     */
    private $autCargoFecIni;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="aut_cargo_fec_fin", type="date", nullable=true)
     */
    private $autCargoFecFin;

    /**
     * @var string
     *
     * @ORM\Column(name="aut_dir_calle", type="string", length=255, nullable=true)
     */
    private $autDirCalle;

    /**
     * @var integer
     *
     * @ORM\Column(name="aut_dir_nro", type="integer", nullable=true)
     */
    private $autDirNro;

    /**
     * @var integer
     *
     * @ORM\Column(name="aut_dir_piso", type="integer", nullable=true)
     */
    private $autDirPiso;

    /**
     * @var string
     *
     * @ORM\Column(name="aut_dir_dpto_ofi_casa", type="string", nullable=true)
     */
    private $autDirDptoOfiCasa;

    /**
     * @var string
     *
     * @ORM\Column(name="aut_dir_dpto_ofi_casa_nro", type="string", length=255, nullable=true)
     */
    private $autDirDptoOfiCasaNro;

    /**
     * @var string
     *
     * @ORM\Column(name="aut_dir_manz", type="string", length=255, nullable=true)
     */
    private $autDirManz;

    /**
     * @var string
     *
     * @ORM\Column(name="aut_dir_torre_monob", type="string", nullable=true)
     */
    private $autDirTorreMonob;

    /**
     * @var string
     *
     * @ORM\Column(name="aut_dir_torre_monob_nro", type="string", length=255, nullable=true)
     */
    private $autDirTorreMonobNro;

    /**
     * @var string
     *
     * @ORM\Column(name="aut_dir_esc_pasillo", type="string", nullable=true)
     */
    private $autDirEscPasillo;

    /**
     * @var string
     *
     * @ORM\Column(name="aut_dir_esc_pasillo_nro", type="string", length=255, nullable=true)
     */
    private $autDirEscPasilloNro;

    /**
     * @var string
     *
     * @ORM\Column(name="aut_dir_vec_asent", type="string", nullable=true)
     */
    private $autDirVecAsent;

    /**
     * @var string
     *
     * @ORM\Column(name="aut_dir_vec_asent_nro", type="string", length=255, nullable=true)
     */
    private $autDirVecAsentNro;

    /**
     * @var string
     *
     * @ORM\Column(name="aut_dir_ruta", type="string", length=255, nullable=true)
     */
    private $autDirRuta;

    /**
     * @var string
     *
     * @ORM\Column(name="aut_dir_ruta_km", type="string", length=255, nullable=true)
     */
    private $autDirRutaKm;

    /**
     * @var string
     *
     * @ORM\Column(name="aut_dir_ref_vis_geo", type="string", length=255, nullable=true)
     */
    private $autDirRefVisGeo;

    /**
     * @var string
     *
     * @ORM\Column(name="aut_dir_cod_pos", type="string", length=255, nullable=true)
     */
    private $autDirCodPos;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_documento", type="integer", nullable=true)
     */
    private $tipoDocumento;   
    
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="CargoAutoridad")
     * @ORM\JoinColumn(name="cargo_autoridad", referencedColumnName="cargo_aut_id")     
     */
    private $cargoAutoridad;

    /**
     * @var integer
     *
     * @ORM\Column(name="nacionalidad", type="integer", nullable=true)
     */
    private $nacionalidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="t_persona", type="integer", nullable=true)
     */
    private $tPersona;

    /**
     * @var integer
     *
     * @ORM\Column(name="localidad", type="integer", nullable=true)
     */
    private $localidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="vinculo", type="integer", nullable=true)
     */
    private $vinculo;

    /**
     * @var integer
     *
     * @ORM\Column(name="comision_directiva", type="integer", nullable=true)
     */
    private $comisionDirectiva;
    
    
    
    
    
    
    public function getAutId() {
        return $this->autId;
    }

    public function getDoctrineVersion() {
        return $this->doctrineVersion;
    }

    public function getAutApe() {
        return $this->autApe;
    }

    public function getAutNom() {
        return $this->autNom;
    }

    public function getAutDoc() {
        return $this->autDoc;
    }

    public function getAutFecNac(){
        return $this->autFecNac;
    }

    public function getAutCuilCdi() {
        return $this->autCuilCdi;
    }

    public function getAutSexo() {
        return $this->autSexo;
    }

    public function getAutTelefono() {
        return $this->autTelefono;
    }

    public function getAutCelular() {
        return $this->autCelular;
    }

    public function getAutMail() {
        return $this->autMail;
    }

    public function getAutCargoFecIni(){
        return $this->autCargoFecIni;
    }

    public function getAutCargoFecFin(){
        return $this->autCargoFecFin;
    }

    public function getAutDirCalle() {
        return $this->autDirCalle;
    }

    public function getAutDirNro() {
        return $this->autDirNro;
    }

    public function getAutDirPiso() {
        return $this->autDirPiso;
    }

    public function getAutDirDptoOfiCasa() {
        return $this->autDirDptoOfiCasa;
    }

    public function getAutDirDptoOfiCasaNro() {
        return $this->autDirDptoOfiCasaNro;
    }

    public function getAutDirManz() {
        return $this->autDirManz;
    }

    public function getAutDirTorreMonob() {
        return $this->autDirTorreMonob;
    }

    public function getAutDirTorreMonobNro() {
        return $this->autDirTorreMonobNro;
    }

    public function getAutDirEscPasillo() {
        return $this->autDirEscPasillo;
    }

    public function getAutDirEscPasilloNro() {
        return $this->autDirEscPasilloNro;
    }

    public function getAutDirVecAsent() {
        return $this->autDirVecAsent;
    }

    public function getAutDirVecAsentNro() {
        return $this->autDirVecAsentNro;
    }

    public function getAutDirRuta() {
        return $this->autDirRuta;
    }

    public function getAutDirRutaKm() {
        return $this->autDirRutaKm;
    }

    public function getAutDirRefVisGeo() {
        return $this->autDirRefVisGeo;
    }

    public function getAutDirCodPos() {
        return $this->autDirCodPos;
    }

    public function getTipoDocumento() {
        return $this->tipoDocumento;
    }

    public function getCargoAutoridad() {
        return $this->cargoAutoridad;
    }

    public function getNacionalidad() {
        return $this->nacionalidad;
    }

    public function getTPersona() {
        return $this->tPersona;
    }

    public function getLocalidad() {
        return $this->localidad;
    }

    public function getVinculo() {
        return $this->vinculo;
    }

    public function getComisionDirectiva() {
        return $this->comisionDirectiva;
    }

    public function setAutId($autId) {
        $this->autId = $autId;
    }

    public function setDoctrineVersion($doctrineVersion) {
        $this->doctrineVersion = $doctrineVersion;
    }

    public function setAutApe($autApe) {
        $this->autApe = $autApe;
    }

    public function setAutNom($autNom) {
        $this->autNom = $autNom;
    }

    public function setAutDoc($autDoc) {
        $this->autDoc = $autDoc;
    }

    public function setAutFecNac(\DateTime $autFecNac) {
        $this->autFecNac = $autFecNac;
    }

    public function setAutCuilCdi($autCuilCdi) {
        $this->autCuilCdi = $autCuilCdi;
    }

    public function setAutSexo($autSexo) {
        $this->autSexo = $autSexo;
    }

    public function setAutTelefono($autTelefono) {
        $this->autTelefono = $autTelefono;
    }

    public function setAutCelular($autCelular) {
        $this->autCelular = $autCelular;
    }

    public function setAutMail($autMail) {
        $this->autMail = $autMail;
    }

    public function setAutCargoFecIni(\DateTime $autCargoFecIni) {
        $this->autCargoFecIni = $autCargoFecIni;
    }

    public function setAutCargoFecFin(\DateTime $autCargoFecFin) {
        $this->autCargoFecFin = $autCargoFecFin;
    }

    public function setAutDirCalle($autDirCalle) {
        $this->autDirCalle = $autDirCalle;
    }

    public function setAutDirNro($autDirNro) {
        $this->autDirNro = $autDirNro;
    }

    public function setAutDirPiso($autDirPiso) {
        $this->autDirPiso = $autDirPiso;
    }

    public function setAutDirDptoOfiCasa($autDirDptoOfiCasa) {
        $this->autDirDptoOfiCasa = $autDirDptoOfiCasa;
    }

    public function setAutDirDptoOfiCasaNro($autDirDptoOfiCasaNro) {
        $this->autDirDptoOfiCasaNro = $autDirDptoOfiCasaNro;
    }

    public function setAutDirManz($autDirManz) {
        $this->autDirManz = $autDirManz;
    }

    public function setAutDirTorreMonob($autDirTorreMonob) {
        $this->autDirTorreMonob = $autDirTorreMonob;
    }

    public function setAutDirTorreMonobNro($autDirTorreMonobNro) {
        $this->autDirTorreMonobNro = $autDirTorreMonobNro;
    }

    public function setAutDirEscPasillo($autDirEscPasillo) {
        $this->autDirEscPasillo = $autDirEscPasillo;
    }

    public function setAutDirEscPasilloNro($autDirEscPasilloNro) {
        $this->autDirEscPasilloNro = $autDirEscPasilloNro;
    }

    public function setAutDirVecAsent($autDirVecAsent) {
        $this->autDirVecAsent = $autDirVecAsent;
    }

    public function setAutDirVecAsentNro($autDirVecAsentNro) {
        $this->autDirVecAsentNro = $autDirVecAsentNro;
    }

    public function setAutDirRuta($autDirRuta) {
        $this->autDirRuta = $autDirRuta;
    }

    public function setAutDirRutaKm($autDirRutaKm) {
        $this->autDirRutaKm = $autDirRutaKm;
    }

    public function setAutDirRefVisGeo($autDirRefVisGeo) {
        $this->autDirRefVisGeo = $autDirRefVisGeo;
    }

    public function setAutDirCodPos($autDirCodPos) {
        $this->autDirCodPos = $autDirCodPos;
    }

    public function setTipoDocumento($tipoDocumento) {
        $this->tipoDocumento = $tipoDocumento;
    }

    public function setCargoAutoridad($cargoAutoridad) {
        $this->cargoAutoridad = $cargoAutoridad;
    }

    public function setNacionalidad($nacionalidad) {
        $this->nacionalidad = $nacionalidad;
    }

    public function setTPersona($tPersona) {
        $this->tPersona = $tPersona;
    }

    public function setLocalidad($localidad) {
        $this->localidad = $localidad;
    }

    public function setVinculo($vinculo) {
        $this->vinculo = $vinculo;
    }

    public function setComisionDirectiva($comisionDirectiva) {
        $this->comisionDirectiva = $comisionDirectiva;
    }




}

