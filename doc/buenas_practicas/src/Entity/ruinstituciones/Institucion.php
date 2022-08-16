<?php

namespace App\Entity\ruinstituciones;

use Doctrine\ORM\Mapping as ORM;


/**
 * Institucion
 *
 * @ORM\Table(name="Institucion")
 * @ORM\Entity(repositoryClass="App\Repository\institucionRepository")
 */
class Institucion
{
    /**
     * @var int
     *
     * @ORM\Column(name="inst_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $instId;

    /**
     * @var int
     *
     * @ORM\Column(name="doctrine_version", type="integer", nullable=false, options={"default"="1"})
     */
    private $doctrineVersion = 1;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_institucion", type="integer", nullable=true)
     */
    private $idInstitucion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_nom", type="string", length=255, nullable=true)
     */
    private $instNom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_nom_abr", type="string", length=255, nullable=true)
     */
    private $instNomAbr;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_pag_web", type="string", length=255, nullable=true)
     */
    private $instPagWeb;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_mail", type="string", length=255, nullable=true)
     */
    private $instMail;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_telefono", type="string", length=255, nullable=true)
     */
    private $instTelefono;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_celular", type="string", length=255, nullable=true)
     */
    private $instCelular;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="inst_fec_fun", type="date", nullable=true)
     */
    private $instFecFun;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_cuit_cdi", type="string", length=255, nullable=true)
     */
    private $instCuitCdi;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_sit_iva", type="string", length=0, nullable=true)
     */
    private $instSitIva;

    /**
     * @var int|null
     *
     * @ORM\Column(name="inst_nro_sipaf", type="integer", nullable=true)
     */
    private $instNroSipaf;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="inst_estatuto", type="boolean", nullable=true)
     */
    private $instEstatuto;

    /**
     * @var int|null
     *
     * @ORM\Column(name="inst_nro_rong", type="integer", nullable=true)
     */
    private $instNroRong;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="inst_nro_rong_fec", type="date", nullable=true)
     */
    private $instNroRongFec;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_sede_fisica", type="string", length=0, nullable=true)
     */
    private $instSedeFisica;

    /**
     * @var int|null
     *
     * @ORM\Column(name="inst_sede_fisica_nro", type="integer", nullable=true)
     */
    private $instSedeFisicaNro;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_ocu_sede", type="string", length=0, nullable=true)
     */
    private $instOcuSede;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_alcance_act", type="string", length=0, nullable=true)
     */
    private $instAlcanceAct;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_amb_trab", type="string", length=0, nullable=true)
     */
    private $instAmbTrab;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_beneficiarios_act", type="string", length=0, nullable=true)
     */
    private $instBeneficiariosAct;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_pob_otros", type="string", length=255, nullable=true)
     */
    private $instPobOtros;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_tip_act_otros", type="string", length=255, nullable=true)
     */
    private $instTipActOtros;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_origen_datos", type="string", length=255, nullable=true)
     */
    private $instOrigenDatos;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_rec_mat_otros", type="string", length=255, nullable=true)
     */
    private $instRecMatOtros;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_area_tem_otros", type="string", length=255, nullable=true)
     */
    private $instAreaTemOtros;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_dir_calle", type="string", length=255, nullable=true)
     */
    private $instDirCalle;

    /**
     * @var int|null
     *
     * @ORM\Column(name="inst_dir_nro", type="integer", nullable=true)
     */
    private $instDirNro;

    /**
     * @var int|null
     *
     * @ORM\Column(name="inst_dir_piso", type="integer", nullable=true)
     */
    private $instDirPiso;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_zon_trab", type="string", length=0, nullable=true)
     */
    private $instZonTrab;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_tema_otros", type="string", length=255, nullable=true)
     */
    private $instTemaOtros;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_dir_dpto_ofi_casa", type="string", length=0, nullable=true)
     */
    private $instDirDptoOfiCasa;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_tipo_inst_otros", type="string", length=255, nullable=true)
     */
    private $instTipoInstOtros;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_dir_manz", type="string", length=255, nullable=true)
     */
    private $instDirManz;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_dir_torre_monob_nro", type="string", length=255, nullable=true)
     */
    private $instDirTorreMonobNro;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_dir_dpto_ofi_casa_nro", type="string", length=255, nullable=true)
     */
    private $instDirDptoOfiCasaNro;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_dir_esc_pasillo", type="string", length=0, nullable=true)
     */
    private $instDirEscPasillo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_dir_esc_pasillo_nro", type="string", length=255, nullable=true)
     */
    private $instDirEscPasilloNro;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_dir_vec_asent_nro", type="string", length=255, nullable=true)
     */
    private $instDirVecAsentNro;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_dir_torre_monob", type="string", length=0, nullable=true)
     */
    private $instDirTorreMonob;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_dir_ruta", type="string", length=255, nullable=true)
     */
    private $instDirRuta;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_dir_ruta_km", type="string", length=255, nullable=true)
     */
    private $instDirRutaKm;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_dir_vec_asent", type="string", length=0, nullable=true)
     */
    private $instDirVecAsent;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_dir_ref_vis_geo", type="string", length=255, nullable=true)
     */
    private $instDirRefVisGeo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inst_dir_cod_pos", type="string", length=255, nullable=true)
     */
    private $instDirCodPos;

    /**
     * @var int|null
     *
     * @ORM\Column(name="inst_nro", type="integer", nullable=true)
     */
    private $instNro;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Agrup_institucion", type="string", length=255, nullable=true)
     */
    private $agrupInstitucion;

    /**
     * @var int|null
     *
     * @ORM\Column(name="estado_reg", type="integer", nullable=true)
     */
    private $estadoReg;

    /**
     * @var int|null
     *
     * @ORM\Column(name="localidad", type="integer", nullable=true)
     */
    private $localidad;

    /**
     * @var int|null
     *
     * @ORM\Column(name="tipo_institucion", type="integer", nullable=true)
     */
    private $tipoInstitucion;

    /**
     * @var int|null
     *
     * @ORM\Column(name="clave_pago", type="integer", nullable=true)
     */
    private $clavePago;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ipec_calle", type="integer", nullable=true)
     */
    private $ipecCalle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="estatuto", type="string", length=1024, nullable=true)
     */
    private $estatuto;

    /**
     * @var int|null
     *
     * @ORM\Column(name="institucion_geo", type="integer", nullable=true)
     */
    private $institucionGeo;

    /**
     * @var int|null
     *
     * @ORM\Column(name="fortalecimiento", type="integer", nullable=true)
     */
    private $fortalecimiento;

    /**
     * @var int|null
     *
     * @ORM\Column(name="inst_nro_enc", type="integer", nullable=true)
     */
    private $instNroEnc;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ID_TIPO", type="integer", nullable=true)
     */
    private $idTipo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mutual", type="string", length=0, nullable=true)
     */
    private $mutual;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cuenta_bancaria", type="string", length=0, nullable=true)
     */
    private $cuentaBancaria;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sipaf", type="string", length=0, nullable=true)
     */
    private $sipaf;

    public function getInstId(): ?int
    {
        return $this->instId;
    }

    public function getDoctrineVersion(): ?int
    {
        return $this->doctrineVersion;
    }

    public function setDoctrineVersion(int $doctrineVersion): self
    {
        $this->doctrineVersion = $doctrineVersion;

        return $this;
    }

    public function getIdInstitucion(): ?int
    {
        return $this->idInstitucion;
    }

    public function setIdInstitucion(?int $idInstitucion): self
    {
        $this->idInstitucion = $idInstitucion;

        return $this;
    }

    public function getInstNom(): ?string
    {
        return $this->instNom;
    }

    public function setInstNom(?string $instNom): self
    {
        $this->instNom = $instNom;

        return $this;
    }

    public function getInstNomAbr(): ?string
    {
        return $this->instNomAbr;
    }

    public function setInstNomAbr(?string $instNomAbr): self
    {
        $this->instNomAbr = $instNomAbr;

        return $this;
    }

    public function getInstPagWeb(): ?string
    {
        return $this->instPagWeb;
    }

    public function setInstPagWeb(?string $instPagWeb): self
    {
        $this->instPagWeb = $instPagWeb;

        return $this;
    }

    public function getInstMail(): ?string
    {
        return $this->instMail;
    }

    public function setInstMail(?string $instMail): self
    {
        $this->instMail = $instMail;

        return $this;
    }

    public function getInstTelefono(): ?string
    {
        return $this->instTelefono;
    }

    public function setInstTelefono(?string $instTelefono): self
    {
        $this->instTelefono = $instTelefono;

        return $this;
    }

    public function getInstCelular(): ?string
    {
        return $this->instCelular;
    }

    public function setInstCelular(?string $instCelular): self
    {
        $this->instCelular = $instCelular;

        return $this;
    }

    public function getInstFecFun(): ?\DateTimeInterface
    {
        return $this->instFecFun;
    }

    public function setInstFecFun(?\DateTimeInterface $instFecFun): self
    {
        $this->instFecFun = $instFecFun;

        return $this;
    }

    public function getInstCuitCdi(): ?string
    {
        return $this->instCuitCdi;
    }

    public function setInstCuitCdi(?string $instCuitCdi): self
    {
        $this->instCuitCdi = $instCuitCdi;

        return $this;
    }

    public function getInstSitIva(): ?string
    {
        return $this->instSitIva;
    }

    public function setInstSitIva(?string $instSitIva): self
    {
        $this->instSitIva = $instSitIva;

        return $this;
    }

    public function getInstNroSipaf(): ?int
    {
        return $this->instNroSipaf;
    }

    public function setInstNroSipaf(?int $instNroSipaf): self
    {
        $this->instNroSipaf = $instNroSipaf;

        return $this;
    }

    public function getInstEstatuto(): ?bool
    {
        return $this->instEstatuto;
    }

    public function setInstEstatuto(?bool $instEstatuto): self
    {
        $this->instEstatuto = $instEstatuto;

        return $this;
    }

    public function getInstNroRong(): ?int
    {
        return $this->instNroRong;
    }

    public function setInstNroRong(?int $instNroRong): self
    {
        $this->instNroRong = $instNroRong;

        return $this;
    }

    public function getInstNroRongFec(): ?\DateTimeInterface
    {
        return $this->instNroRongFec;
    }

    public function setInstNroRongFec(?\DateTimeInterface $instNroRongFec): self
    {
        $this->instNroRongFec = $instNroRongFec;

        return $this;
    }

    public function getInstSedeFisica(): ?string
    {
        return $this->instSedeFisica;
    }

    public function setInstSedeFisica(?string $instSedeFisica): self
    {
        $this->instSedeFisica = $instSedeFisica;

        return $this;
    }

    public function getInstSedeFisicaNro(): ?int
    {
        return $this->instSedeFisicaNro;
    }

    public function setInstSedeFisicaNro(?int $instSedeFisicaNro): self
    {
        $this->instSedeFisicaNro = $instSedeFisicaNro;

        return $this;
    }

    public function getInstOcuSede(): ?string
    {
        return $this->instOcuSede;
    }

    public function setInstOcuSede(?string $instOcuSede): self
    {
        $this->instOcuSede = $instOcuSede;

        return $this;
    }

    public function getInstAlcanceAct(): ?string
    {
        return $this->instAlcanceAct;
    }

    public function setInstAlcanceAct(?string $instAlcanceAct): self
    {
        $this->instAlcanceAct = $instAlcanceAct;

        return $this;
    }

    public function getInstAmbTrab(): ?string
    {
        return $this->instAmbTrab;
    }

    public function setInstAmbTrab(?string $instAmbTrab): self
    {
        $this->instAmbTrab = $instAmbTrab;

        return $this;
    }

    public function getInstBeneficiariosAct(): ?string
    {
        return $this->instBeneficiariosAct;
    }

    public function setInstBeneficiariosAct(?string $instBeneficiariosAct): self
    {
        $this->instBeneficiariosAct = $instBeneficiariosAct;

        return $this;
    }

    public function getInstPobOtros(): ?string
    {
        return $this->instPobOtros;
    }

    public function setInstPobOtros(?string $instPobOtros): self
    {
        $this->instPobOtros = $instPobOtros;

        return $this;
    }

    public function getInstTipActOtros(): ?string
    {
        return $this->instTipActOtros;
    }

    public function setInstTipActOtros(?string $instTipActOtros): self
    {
        $this->instTipActOtros = $instTipActOtros;

        return $this;
    }

    public function getInstOrigenDatos(): ?string
    {
        return $this->instOrigenDatos;
    }

    public function setInstOrigenDatos(?string $instOrigenDatos): self
    {
        $this->instOrigenDatos = $instOrigenDatos;

        return $this;
    }

    public function getInstRecMatOtros(): ?string
    {
        return $this->instRecMatOtros;
    }

    public function setInstRecMatOtros(?string $instRecMatOtros): self
    {
        $this->instRecMatOtros = $instRecMatOtros;

        return $this;
    }

    public function getInstAreaTemOtros(): ?string
    {
        return $this->instAreaTemOtros;
    }

    public function setInstAreaTemOtros(?string $instAreaTemOtros): self
    {
        $this->instAreaTemOtros = $instAreaTemOtros;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getInstDirCalle(): ?string
    {
        return $this->instDirCalle;
    }

    public function setInstDirCalle(?string $instDirCalle): self
    {
        $this->instDirCalle = $instDirCalle;

        return $this;
    }

    public function getInstDirNro(): ?int
    {
        return $this->instDirNro;
    }

    public function setInstDirNro(?int $instDirNro): self
    {
        $this->instDirNro = $instDirNro;

        return $this;
    }

    public function getInstDirPiso(): ?int
    {
        return $this->instDirPiso;
    }

    public function setInstDirPiso(?int $instDirPiso): self
    {
        $this->instDirPiso = $instDirPiso;

        return $this;
    }

    public function getInstZonTrab(): ?string
    {
        return $this->instZonTrab;
    }

    public function setInstZonTrab(?string $instZonTrab): self
    {
        $this->instZonTrab = $instZonTrab;

        return $this;
    }

    public function getInstTemaOtros(): ?string
    {
        return $this->instTemaOtros;
    }

    public function setInstTemaOtros(?string $instTemaOtros): self
    {
        $this->instTemaOtros = $instTemaOtros;

        return $this;
    }

    public function getInstDirDptoOfiCasa(): ?string
    {
        return $this->instDirDptoOfiCasa;
    }

    public function setInstDirDptoOfiCasa(?string $instDirDptoOfiCasa): self
    {
        $this->instDirDptoOfiCasa = $instDirDptoOfiCasa;

        return $this;
    }

    public function getInstTipoInstOtros(): ?string
    {
        return $this->instTipoInstOtros;
    }

    public function setInstTipoInstOtros(?string $instTipoInstOtros): self
    {
        $this->instTipoInstOtros = $instTipoInstOtros;

        return $this;
    }

    public function getInstDirManz(): ?string
    {
        return $this->instDirManz;
    }

    public function setInstDirManz(?string $instDirManz): self
    {
        $this->instDirManz = $instDirManz;

        return $this;
    }

    public function getInstDirTorreMonobNro(): ?string
    {
        return $this->instDirTorreMonobNro;
    }

    public function setInstDirTorreMonobNro(?string $instDirTorreMonobNro): self
    {
        $this->instDirTorreMonobNro = $instDirTorreMonobNro;

        return $this;
    }

    public function getInstDirDptoOfiCasaNro(): ?string
    {
        return $this->instDirDptoOfiCasaNro;
    }

    public function setInstDirDptoOfiCasaNro(?string $instDirDptoOfiCasaNro): self
    {
        $this->instDirDptoOfiCasaNro = $instDirDptoOfiCasaNro;

        return $this;
    }

    public function getInstDirEscPasillo(): ?string
    {
        return $this->instDirEscPasillo;
    }

    public function setInstDirEscPasillo(?string $instDirEscPasillo): self
    {
        $this->instDirEscPasillo = $instDirEscPasillo;

        return $this;
    }

    public function getInstDirEscPasilloNro(): ?string
    {
        return $this->instDirEscPasilloNro;
    }

    public function setInstDirEscPasilloNro(?string $instDirEscPasilloNro): self
    {
        $this->instDirEscPasilloNro = $instDirEscPasilloNro;

        return $this;
    }

    public function getInstDirVecAsentNro(): ?string
    {
        return $this->instDirVecAsentNro;
    }

    public function setInstDirVecAsentNro(?string $instDirVecAsentNro): self
    {
        $this->instDirVecAsentNro = $instDirVecAsentNro;

        return $this;
    }

    public function getInstDirTorreMonob(): ?string
    {
        return $this->instDirTorreMonob;
    }

    public function setInstDirTorreMonob(?string $instDirTorreMonob): self
    {
        $this->instDirTorreMonob = $instDirTorreMonob;

        return $this;
    }

    public function getInstDirRuta(): ?string
    {
        return $this->instDirRuta;
    }

    public function setInstDirRuta(?string $instDirRuta): self
    {
        $this->instDirRuta = $instDirRuta;

        return $this;
    }

    public function getInstDirRutaKm(): ?string
    {
        return $this->instDirRutaKm;
    }

    public function setInstDirRutaKm(?string $instDirRutaKm): self
    {
        $this->instDirRutaKm = $instDirRutaKm;

        return $this;
    }

    public function getInstDirVecAsent(): ?string
    {
        return $this->instDirVecAsent;
    }

    public function setInstDirVecAsent(?string $instDirVecAsent): self
    {
        $this->instDirVecAsent = $instDirVecAsent;

        return $this;
    }

    public function getInstDirRefVisGeo(): ?string
    {
        return $this->instDirRefVisGeo;
    }

    public function setInstDirRefVisGeo(?string $instDirRefVisGeo): self
    {
        $this->instDirRefVisGeo = $instDirRefVisGeo;

        return $this;
    }

    public function getInstDirCodPos(): ?string
    {
        return $this->instDirCodPos;
    }

    public function setInstDirCodPos(?string $instDirCodPos): self
    {
        $this->instDirCodPos = $instDirCodPos;

        return $this;
    }

    public function getInstNro(): ?int
    {
        return $this->instNro;
    }

    public function setInstNro(?int $instNro): self
    {
        $this->instNro = $instNro;

        return $this;
    }

    public function getAgrupInstitucion(): ?string
    {
        return $this->agrupInstitucion;
    }

    public function setAgrupInstitucion(?string $agrupInstitucion): self
    {
        $this->agrupInstitucion = $agrupInstitucion;

        return $this;
    }

    public function getEstadoReg(): ?int
    {
        return $this->estadoReg;
    }

    public function setEstadoReg(?int $estadoReg): self
    {
        $this->estadoReg = $estadoReg;

        return $this;
    }

    public function getLocalidad(): ?int
    {
        return $this->localidad;
    }

    public function setLocalidad(int $localidad): self
    {
        $this->localidad = $localidad;

        return $this;
    }

    public function getTipoInstitucion(): ?int
    {
        return $this->tipoInstitucion;
    }

    public function setTipoInstitucion(?int $tipoInstitucion): self
    {
        $this->tipoInstitucion = $tipoInstitucion;

        return $this;
    }

    public function getClavePago(): ?int
    {
        return $this->clavePago;
    }

    public function setClavePago(?int $clavePago): self
    {
        $this->clavePago = $clavePago;

        return $this;
    }

    public function getIpecCalle(): ?int
    {
        return $this->ipecCalle;
    }

    public function setIpecCalle(?int $ipecCalle): self
    {
        $this->ipecCalle = $ipecCalle;

        return $this;
    }

    public function getEstatuto(): ?string
    {
        return $this->estatuto;
    }

    public function setEstatuto(?string $estatuto): self
    {
        $this->estatuto = $estatuto;

        return $this;
    }

    public function getInstitucionGeo(): ?int
    {
        return $this->institucionGeo;
    }

    public function setInstitucionGeo(?int $institucionGeo): self
    {
        $this->institucionGeo = $institucionGeo;

        return $this;
    }

    public function getFortalecimiento(): ?int
    {
        return $this->fortalecimiento;
    }

    public function setFortalecimiento(?int $fortalecimiento): self
    {
        $this->fortalecimiento = $fortalecimiento;

        return $this;
    }

    public function getInstNroEnc(): ?int
    {
        return $this->instNroEnc;
    }

    public function setInstNroEnc(?int $instNroEnc): self
    {
        $this->instNroEnc = $instNroEnc;

        return $this;
    }

    public function getIdTipo(): ?int
    {
        return $this->idTipo;
    }

    public function setIdTipo(?int $idTipo): self
    {
        $this->idTipo = $idTipo;

        return $this;
    }

    public function getMutual(): ?string
    {
        return $this->mutual;
    }

    public function setMutual(?string $mutual): self
    {
        $this->mutual = $mutual;

        return $this;
    }

    public function getCuentaBancaria(): ?string
    {
        return $this->cuentaBancaria;
    }

    public function setCuentaBancaria(?string $cuentaBancaria): self
    {
        $this->cuentaBancaria = $cuentaBancaria;

        return $this;
    }

    public function getSipaf(): ?string
    {
        return $this->sipaf;
    }

    public function setSipaf(?string $sipaf): self
    {
        $this->sipaf = $sipaf;

        return $this;
    }


}
