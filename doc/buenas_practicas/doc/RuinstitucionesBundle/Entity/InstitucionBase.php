<?php

namespace MDS\RuinstitucionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
**/
class InstitucionBase
{
    /**
     * @var integer
     *
     * @ORM\Column(name="inst_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $instId;

    /**
     * @var integer
     *
     * @ORM\Column(name="doctrine_version", type="integer", nullable=false)
     */
    private $doctrineVersion = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="id_institucion", type="integer", nullable=true)
     */
    private $idInstitucion;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_nom", type="string", length=255, nullable=true)
     */
    private $instNom;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_nom_abr", type="string", length=255, nullable=true)
     */
    private $instNomAbr;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_pag_web", type="string", length=255, nullable=true)
     */
    private $instPagWeb;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_mail", type="string", length=255, nullable=true)
     */
    private $instMail;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_telefono", type="string", length=255, nullable=true)
     */
    private $instTelefono;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_celular", type="string", length=255, nullable=true)
     */
    private $instCelular;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inst_fec_fun", type="date", nullable=true)
     */
    private $instFecFun;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_cuit_cdi", type="string", length=255, nullable=true)
     */
    private $instCuitCdi;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_sit_iva", type="string", nullable=true)
     */
    private $instSitIva;

    /**
     * @var integer
     *
     * @ORM\Column(name="inst_nro_sipaf", type="integer", nullable=true)
     */
    private $instNroSipaf;

    /**
     * @var boolean
     *
     * @ORM\Column(name="inst_estatuto", type="boolean", nullable=true)
     */
    private $instEstatuto;

    /**
     * @var integer
     *
     * @ORM\Column(name="inst_nro_rong", type="integer", nullable=true)
     */
    private $instNroRong;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inst_nro_rong_fec", type="date", nullable=true)
     */
    private $instNroRongFec;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_sede_fisica", type="string", nullable=true)
     */
    private $instSedeFisica;

    /**
     * @var integer
     *
     * @ORM\Column(name="inst_sede_fisica_nro", type="integer", nullable=true)
     */
    private $instSedeFisicaNro;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_ocu_sede", type="string", nullable=true)
     */
    private $instOcuSede;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_alcance_act", type="string", nullable=true)
     */
    private $instAlcanceAct;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_amb_trab", type="string", nullable=true)
     */
    private $instAmbTrab;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_beneficiarios_act", type="string", nullable=true)
     */
    private $instBeneficiariosAct;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_pob_otros", type="string", length=255, nullable=true)
     */
    private $instPobOtros;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_tip_act_otros", type="string", length=255, nullable=true)
     */
    private $instTipActOtros;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_origen_datos", type="string", length=255, nullable=true)
     */
    private $instOrigenDatos;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_rec_mat_otros", type="string", length=255, nullable=true)
     */
    private $instRecMatOtros;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_area_tem_otros", type="string", length=255, nullable=true)
     */
    private $instAreaTemOtros;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_dir_calle", type="string", length=255, nullable=true)
     */
    private $instDirCalle;

    /**
     * @var integer
     *
     * @ORM\Column(name="inst_dir_nro", type="integer", nullable=true)
     */
    private $instDirNro;

    /**
     * @var integer
     *
     * @ORM\Column(name="inst_dir_piso", type="integer", nullable=true)
     */
    private $instDirPiso;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_zon_trab", type="string", nullable=true)
     */
    private $instZonTrab;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_tema_otros", type="string", length=255, nullable=true)
     */
    private $instTemaOtros;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_dir_dpto_ofi_casa", type="string", nullable=true)
     */
    private $instDirDptoOfiCasa;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_tipo_inst_otros", type="string", length=255, nullable=true)
     */
    private $instTipoInstOtros;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_dir_manz", type="string", length=255, nullable=true)
     */
    private $instDirManz;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_dir_torre_monob_nro", type="string", length=255, nullable=true)
     */
    private $instDirTorreMonobNro;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_dir_dpto_ofi_casa_nro", type="string", length=255, nullable=true)
     */
    private $instDirDptoOfiCasaNro;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_dir_esc_pasillo", type="string", nullable=true)
     */
    private $instDirEscPasillo;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_dir_esc_pasillo_nro", type="string", length=255, nullable=true)
     */
    private $instDirEscPasilloNro;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_dir_vec_asent_nro", type="string", length=255, nullable=true)
     */
    private $instDirVecAsentNro;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_dir_torre_monob", type="string", nullable=true)
     */
    private $instDirTorreMonob;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_dir_ruta", type="string", length=255, nullable=true)
     */
    private $instDirRuta;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_dir_ruta_km", type="string", length=255, nullable=true)
     */
    private $instDirRutaKm;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_dir_vec_asent", type="string", nullable=true)
     */
    private $instDirVecAsent;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_dir_ref_vis_geo", type="string", length=255, nullable=true)
     */
    private $instDirRefVisGeo;

    /**
     * @var string
     *
     * @ORM\Column(name="inst_dir_cod_pos", type="string", length=255, nullable=true)
     */
    private $instDirCodPos;

    /**
     * @var integer
     *
     * @ORM\Column(name="inst_nro", type="integer", nullable=true)
     */
    private $instNro;

    /**
     * @var string
     *
     * @ORM\Column(name="Agrup_institucion", type="string", length=255, nullable=true)
     */
    private $agrupInstitucion;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_reg", type="integer", nullable=true)
     */
    private $estadoReg;

    /**
     * @var integer
     *
     * @ORM\Column(name="localidad", type="integer", nullable=true)
     */
    private $localidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_institucion", type="integer", nullable=true)
     */
    private $tipoInstitucion;

    /**
     * @var integer
     *
     * @ORM\Column(name="clave_pago", type="integer", nullable=true)
     */
    private $clavePago;

    /**
     * @var integer
     *
     * @ORM\Column(name="ipec_calle", type="integer", nullable=true)
     */
    private $ipecCalle;

    /**
     * @var string
     *
     * @ORM\Column(name="estatuto", type="string", length=1024, nullable=true)
     */
    private $estatuto;

    /**
     * @var integer
     *
     * @ORM\Column(name="institucion_geo", type="integer", nullable=true)
     */
    private $institucionGeo;

    /**
     * @var integer
     *
     * @ORM\Column(name="fortalecimiento", type="integer", nullable=true)
     */
    private $fortalecimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="inst_nro_enc", type="integer", nullable=true)
     */
    private $instNroEnc;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_TIPO", type="integer", nullable=true)
     */
    private $idTipo;

    /**
     * @var string
     *
     * @ORM\Column(name="mutual", type="string", nullable=true)
     */
    private $mutual;

    /**
     * @var string
     *
     * @ORM\Column(name="cuenta_bancaria", type="string", nullable=true)
     */
    private $cuentaBancaria;

    /**
     * @var string
     *
     * @ORM\Column(name="sipaf", type="string", nullable=true)
     */
    private $sipaf;
    
    
    
    
    public function getInstId() {
        return $this->instId;
    }

    public function getDoctrineVersion() {
        return $this->doctrineVersion;
    }

    public function getIdInstitucion() {
        return $this->idInstitucion;
    }

    public function getInstNom() {
        return $this->instNom;
    }

    public function getInstNomAbr() {
        return $this->instNomAbr;
    }

    public function getInstPagWeb() {
        return $this->instPagWeb;
    }

    public function getInstMail() {
        return $this->instMail;
    }

    public function getInstTelefono() {
        return $this->instTelefono;
    }

    public function getInstCelular() {
        return $this->instCelular;
    }

    public function getInstFecFun(){
        return $this->instFecFun;
    }

    public function getInstCuitCdi() {
        return $this->instCuitCdi;
    }

    public function getInstSitIva() {
        return $this->instSitIva;
    }

    public function getInstNroSipaf() {
        return $this->instNroSipaf;
    }

    public function getInstEstatuto() {
        return $this->instEstatuto;
    }

    public function getInstNroRong() {
        return $this->instNroRong;
    }

    public function getInstNroRongFec(){
        return $this->instNroRongFec;
    }

    public function getInstSedeFisica() {
        return $this->instSedeFisica;
    }

    public function getInstSedeFisicaNro() {
        return $this->instSedeFisicaNro;
    }

    public function getInstOcuSede() {
        return $this->instOcuSede;
    }

    public function getInstAlcanceAct() {
        return $this->instAlcanceAct;
    }

    public function getInstAmbTrab() {
        return $this->instAmbTrab;
    }

    public function getInstBeneficiariosAct() {
        return $this->instBeneficiariosAct;
    }

    public function getInstPobOtros() {
        return $this->instPobOtros;
    }

    public function getInstTipActOtros() {
        return $this->instTipActOtros;
    }

    public function getInstOrigenDatos() {
        return $this->instOrigenDatos;
    }

    public function getInstRecMatOtros() {
        return $this->instRecMatOtros;
    }

    public function getInstAreaTemOtros() {
        return $this->instAreaTemOtros;
    }

    public function getCreatedAt(){
        return $this->createdAt;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    public function getInstDirCalle() {
        return $this->instDirCalle;
    }

    public function getInstDirNro() {
        return $this->instDirNro;
    }

    public function getInstDirPiso() {
        return $this->instDirPiso;
    }

    public function getInstZonTrab() {
        return $this->instZonTrab;
    }

    public function getInstTemaOtros() {
        return $this->instTemaOtros;
    }

    public function getInstDirDptoOfiCasa() {
        return $this->instDirDptoOfiCasa;
    }

    public function getInstTipoInstOtros() {
        return $this->instTipoInstOtros;
    }

    public function getInstDirManz() {
        return $this->instDirManz;
    }

    public function getInstDirTorreMonobNro() {
        return $this->instDirTorreMonobNro;
    }

    public function getInstDirDptoOfiCasaNro() {
        return $this->instDirDptoOfiCasaNro;
    }

    public function getInstDirEscPasillo() {
        return $this->instDirEscPasillo;
    }

    public function getInstDirEscPasilloNro() {
        return $this->instDirEscPasilloNro;
    }

    public function getInstDirVecAsentNro() {
        return $this->instDirVecAsentNro;
    }

    public function getInstDirTorreMonob() {
        return $this->instDirTorreMonob;
    }

    public function getInstDirRuta() {
        return $this->instDirRuta;
    }

    public function getInstDirRutaKm() {
        return $this->instDirRutaKm;
    }

    public function getInstDirVecAsent() {
        return $this->instDirVecAsent;
    }

    public function getInstDirRefVisGeo() {
        return $this->instDirRefVisGeo;
    }

    public function getInstDirCodPos() {
        return $this->instDirCodPos;
    }

    public function getInstNro() {
        return $this->instNro;
    }

    public function getAgrupInstitucion() {
        return $this->agrupInstitucion;
    }

    public function getEstadoReg() {
        return $this->estadoReg;
    }

    public function getLocalidad() {
        return $this->localidad;
    }

    public function getTipoInstitucion() {
        return $this->tipoInstitucion;
    }

    public function getClavePago() {
        return $this->clavePago;
    }

    public function getIpecCalle() {
        return $this->ipecCalle;
    }

    public function getEstatuto() {
        return $this->estatuto;
    }

    public function getInstitucionGeo() {
        return $this->institucionGeo;
    }

    public function getFortalecimiento() {
        return $this->fortalecimiento;
    }

    public function getInstNroEnc() {
        return $this->instNroEnc;
    }

    public function getIdTipo() {
        return $this->idTipo;
    }

    public function getMutual() {
        return $this->mutual;
    }

    public function getCuentaBancaria() {
        return $this->cuentaBancaria;
    }

    public function getSipaf() {
        return $this->sipaf;
    }

    public function setInstId($instId) {
        $this->instId = $instId;
    }

    public function setDoctrineVersion($doctrineVersion) {
        $this->doctrineVersion = $doctrineVersion;
    }

    public function setIdInstitucion($idInstitucion) {
        $this->idInstitucion = $idInstitucion;
    }

    public function setInstNom($instNom) {
        $this->instNom = $instNom;
    }

    public function setInstNomAbr($instNomAbr) {
        $this->instNomAbr = $instNomAbr;
    }

    public function setInstPagWeb($instPagWeb) {
        $this->instPagWeb = $instPagWeb;
    }

    public function setInstMail($instMail) {
        $this->instMail = $instMail;
    }

    public function setInstTelefono($instTelefono) {
        $this->instTelefono = $instTelefono;
    }

    public function setInstCelular($instCelular) {
        $this->instCelular = $instCelular;
    }

    public function setInstFecFun(\DateTime $instFecFun) {
        $this->instFecFun = $instFecFun;
    }

    public function setInstCuitCdi($instCuitCdi) {
        $this->instCuitCdi = $instCuitCdi;
    }

    public function setInstSitIva($instSitIva) {
        $this->instSitIva = $instSitIva;
    }

    public function setInstNroSipaf($instNroSipaf) {
        $this->instNroSipaf = $instNroSipaf;
    }

    public function setInstEstatuto($instEstatuto) {
        $this->instEstatuto = $instEstatuto;
    }

    public function setInstNroRong($instNroRong) {
        $this->instNroRong = $instNroRong;
    }

    public function setInstNroRongFec(\DateTime $instNroRongFec) {
        $this->instNroRongFec = $instNroRongFec;
    }

    public function setInstSedeFisica($instSedeFisica) {
        $this->instSedeFisica = $instSedeFisica;
    }

    public function setInstSedeFisicaNro($instSedeFisicaNro) {
        $this->instSedeFisicaNro = $instSedeFisicaNro;
    }

    public function setInstOcuSede($instOcuSede) {
        $this->instOcuSede = $instOcuSede;
    }

    public function setInstAlcanceAct($instAlcanceAct) {
        $this->instAlcanceAct = $instAlcanceAct;
    }

    public function setInstAmbTrab($instAmbTrab) {
        $this->instAmbTrab = $instAmbTrab;
    }

    public function setInstBeneficiariosAct($instBeneficiariosAct) {
        $this->instBeneficiariosAct = $instBeneficiariosAct;
    }

    public function setInstPobOtros($instPobOtros) {
        $this->instPobOtros = $instPobOtros;
    }

    public function setInstTipActOtros($instTipActOtros) {
        $this->instTipActOtros = $instTipActOtros;
    }

    public function setInstOrigenDatos($instOrigenDatos) {
        $this->instOrigenDatos = $instOrigenDatos;
    }

    public function setInstRecMatOtros($instRecMatOtros) {
        $this->instRecMatOtros = $instRecMatOtros;
    }

    public function setInstAreaTemOtros($instAreaTemOtros) {
        $this->instAreaTemOtros = $instAreaTemOtros;
    }

    public function setCreatedAt(\DateTime $createdAt) {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt) {
        $this->updatedAt = $updatedAt;
    }

    public function setInstDirCalle($instDirCalle) {
        $this->instDirCalle = $instDirCalle;
    }

    public function setInstDirNro($instDirNro) {
        $this->instDirNro = $instDirNro;
    }

    public function setInstDirPiso($instDirPiso) {
        $this->instDirPiso = $instDirPiso;
    }

    public function setInstZonTrab($instZonTrab) {
        $this->instZonTrab = $instZonTrab;
    }

    public function setInstTemaOtros($instTemaOtros) {
        $this->instTemaOtros = $instTemaOtros;
    }

    public function setInstDirDptoOfiCasa($instDirDptoOfiCasa) {
        $this->instDirDptoOfiCasa = $instDirDptoOfiCasa;
    }

    public function setInstTipoInstOtros($instTipoInstOtros) {
        $this->instTipoInstOtros = $instTipoInstOtros;
    }

    public function setInstDirManz($instDirManz) {
        $this->instDirManz = $instDirManz;
    }

    public function setInstDirTorreMonobNro($instDirTorreMonobNro) {
        $this->instDirTorreMonobNro = $instDirTorreMonobNro;
    }

    public function setInstDirDptoOfiCasaNro($instDirDptoOfiCasaNro) {
        $this->instDirDptoOfiCasaNro = $instDirDptoOfiCasaNro;
    }

    public function setInstDirEscPasillo($instDirEscPasillo) {
        $this->instDirEscPasillo = $instDirEscPasillo;
    }

    public function setInstDirEscPasilloNro($instDirEscPasilloNro) {
        $this->instDirEscPasilloNro = $instDirEscPasilloNro;
    }

    public function setInstDirVecAsentNro($instDirVecAsentNro) {
        $this->instDirVecAsentNro = $instDirVecAsentNro;
    }

    public function setInstDirTorreMonob($instDirTorreMonob) {
        $this->instDirTorreMonob = $instDirTorreMonob;
    }

    public function setInstDirRuta($instDirRuta) {
        $this->instDirRuta = $instDirRuta;
    }

    public function setInstDirRutaKm($instDirRutaKm) {
        $this->instDirRutaKm = $instDirRutaKm;
    }

    public function setInstDirVecAsent($instDirVecAsent) {
        $this->instDirVecAsent = $instDirVecAsent;
    }

    public function setInstDirRefVisGeo($instDirRefVisGeo) {
        $this->instDirRefVisGeo = $instDirRefVisGeo;
    }

    public function setInstDirCodPos($instDirCodPos) {
        $this->instDirCodPos = $instDirCodPos;
    }

    public function setInstNro($instNro) {
        $this->instNro = $instNro;
    }

    public function setAgrupInstitucion($agrupInstitucion) {
        $this->agrupInstitucion = $agrupInstitucion;
    }

    public function setEstadoReg($estadoReg) {
        $this->estadoReg = $estadoReg;
    }

    public function setLocalidad($localidad) {
        $this->localidad = $localidad;
    }

    public function setTipoInstitucion($tipoInstitucion) {
        $this->tipoInstitucion = $tipoInstitucion;
    }

    public function setClavePago($clavePago) {
        $this->clavePago = $clavePago;
    }

    public function setIpecCalle($ipecCalle) {
        $this->ipecCalle = $ipecCalle;
    }

    public function setEstatuto($estatuto) {
        $this->estatuto = $estatuto;
    }

    public function setInstitucionGeo($institucionGeo) {
        $this->institucionGeo = $institucionGeo;
    }

    public function setFortalecimiento($fortalecimiento) {
        $this->fortalecimiento = $fortalecimiento;
    }

    public function setInstNroEnc($instNroEnc) {
        $this->instNroEnc = $instNroEnc;
    }

    public function setIdTipo($idTipo) {
        $this->idTipo = $idTipo;
    }

    public function setMutual($mutual) {
        $this->mutual = $mutual;
    }

    public function setCuentaBancaria($cuentaBancaria) {
        $this->cuentaBancaria = $cuentaBancaria;
    }

    public function setSipaf($sipaf) {
        $this->sipaf = $sipaf;
    }


    


}

