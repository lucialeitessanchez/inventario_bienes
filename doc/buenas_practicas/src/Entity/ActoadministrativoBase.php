<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 * */
class ActoadministrativoBase {

    /**
     * @var int
     *
     * @ORM\Column(name="idActoAdministrativo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idactoadministrativo;

    /**
     * @var int|null
     *
     * @ORM\Column(name="nroNota", type="integer", nullable=true)
     */
    private $nronota;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fechaNota", type="date", nullable=true)
     */
    private $fechanota;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcionProyecto", type="text", length=65535, nullable=true)
     */
    private $descripcionproyecto;

    /**
     * @var float
     *
     * @ORM\Column(name="montoSolicitado", type="float", precision=10, scale=0, nullable=false)
     */
    private $montosolicitado;

    /**
     * @var float|null
     *
     * @ORM\Column(name="montoAprobado", type="float", precision=10, scale=0, nullable=true)
     */
    private $montoaprobado;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fechaMontoAprobado", type="date", nullable=true)
     */
    private $fechamontoaprobado;

    /**
     * @var string|null
     *
     * @ORM\Column(name="observacion", type="string", length=255, nullable=true)
     */
    private $observacion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="referente", type="text", length=65535, nullable=true, options={"comment"="emisor de la nota / pedido"})
     */
    private $referente;

    /**
     * @var string|null
     *
     * @ORM\Column(name="referente2", type="text", length=65535, nullable=true, options={"comment"="emisor de la nota / pedido"})
     */
    private $referente2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="referente2codigoarea", type="string", length=5, nullable=true)
     */
    private $referente2codigoarea;

    /**
     * @var string|null
     *
     * @ORM\Column(name="referente2Te", type="string", length=45, nullable=true)
     */
    private $referente2Te;

    /**
     * @var string|null
     *
     * @ORM\Column(name="referente2Mail", type="string", length=45, nullable=true)
     */
    private $referente2mail;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contactoApenom", type="string", length=45, nullable=true)
     */
    private $contactoapenom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contactocodigoarea", type="string", length=5, nullable=true)
     */
    private $contactocodigoarea;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contactoTe", type="string", length=45, nullable=true)
     */
    private $contactote;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contactoMail", type="string", length=45, nullable=true)
     */
    private $contactomail;

    /**
     * @var bool
     *
     * @ORM\Column(name="tramiteUrgente", type="boolean", nullable=false)
     */
    private $tramiteurgente = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombreInstitucion", type="string", length=45, nullable=true)
     */
    private $nombreinstitucion;

    /**
     * @var int
     *
     * @ORM\Column(name="idLocalidadInst", type="integer", nullable=false)
     */
    private $idlocalidadinst;

    /**
     * @var string
     *
     * @ORM\Column(name="localidadInst", type="string", length=45, nullable=false)
     */
    private $localidadinst;

    /**
     * @var string
     *
     * @ORM\Column(name="departamentoInst", type="string", length=45, nullable=false)
     */
    private $departamentoinst;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cbuInstitucion", type="string", length=22, nullable=true)
     */
    private $cbuinstitucion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nroExpediente", type="string", length=45, nullable=true)
     */
    private $nroexpediente;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fechaExpediente", type="date", nullable=true)
     */
    private $fechaexpediente;

    /**
     * @var string|null
     *
     * @ORM\Column(name="caratula", type="text", length=65535, nullable=true)
     */
    private $caratula;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fechaCaratula", type="date", nullable=true)
     */
    private $fechacaratula;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fechaDictamen", type="date", nullable=true)
     */
    private $fechadictamen;

    /**
     * @var string|null
     *
     * @ORM\Column(name="observacionDictamen", type="text", length=65535, nullable=true)
     */
    private $observaciondictamen;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fechapago", type="date", nullable=true)
     */
    private $fechapago;

    /**
     * @var int|null
     *
     * @ORM\Column(name="nroresolucion", type="integer", nullable=true)
     */
    private $nroresolucion;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecharesolucion", type="date", nullable=true)
     */
    private $fecharesolucion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="etapas", type="string", length=45, nullable=true, options={"default"="1"})
     */
    private $etapas = '1';

    /**
     * @var string|null
     *
     * @ORM\Column(name="nrosipaf", type="string", length=50, nullable=true)
     */
    private $nrosipaf;

    /**
     * @var string|null
     *
     * @ORM\Column(name="usuario", type="string", length=45, nullable=true)
     */
    private $usuario;

    /**
     * @var string|null
     *
     * @ORM\Column(name="area_carga", type="string", length=45, nullable=true)
     */
    private $areaCarga;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fechaCarga", type="datetime", nullable=true)
     */
    private $fechacarga;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fechaBaja", type="datetime", nullable=true)
     */
    private $fechabaja;

    /**
     * @var string|null
     *
     * @ORM\Column(name="motivoBaja", type="string", length=255, nullable=true)
     */
    private $motivobaja;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cantidadBenefDirectos", type="integer", nullable=true)
     */
    private $cantidadbenefdirectos;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cantidadBenefIndirectos", type="integer", nullable=true)
     */
    private $cantidadbenefindirectos;

    /**
     * @var \Tiposolicitante
     *
     * @ORM\ManyToOne(targetEntity="Tiposolicitante")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipoSolicitante_idtipoSolicitante", referencedColumnName="idtipoSolicitante")
     * })
     */
    private $tiposolicitanteIdtiposolicitante;

    /**
     * @var int
     *
     * @ORM\Column(name="Institucion_inst_id", type="integer", nullable=false)
     */
    private $instId;

    public function getIdactoadministrativo(): ?int {
        return $this->idactoadministrativo;
    }

    public function getNronota(): ?int {
        return $this->nronota;
    }

    public function setNronota(?int $nronota): self {
        $this->nronota = $nronota;

        return $this;
    }

    public function getFechanota(): ?\DateTimeInterface {
        return $this->fechanota;
    }

    public function setFechanota(?\DateTimeInterface $fechanota): self {
        $this->fechanota = $fechanota;

        return $this;
    }

    public function getDescripcionproyecto(): ?string {
        return $this->descripcionproyecto;
    }

    public function setDescripcionproyecto(string $descripcionproyecto): self {
        $this->descripcionproyecto = $descripcionproyecto;

        return $this;
    }

    public function getMontosolicitado(): ?float {
        return $this->montosolicitado;
    }

    public function setMontosolicitado(float $montosolicitado): self {
        $this->montosolicitado = $montosolicitado;

        return $this;
    }

    public function getMontoaprobado(): ?float {
        return $this->montoaprobado;
    }

    public function setMontoaprobado(?float $montoaprobado): self {
        $this->montoaprobado = $montoaprobado;

        return $this;
    }

    public function getFechamontoaprobado(): ?\DateTimeInterface {
        return $this->fechamontoaprobado;
    }

    public function setFechamontoaprobado(?\DateTimeInterface $fechamontoaprobado): self {
        $this->fechamontoaprobado = $fechamontoaprobado;

        return $this;
    }

    public function getObservacion(): ?string {
        return $this->observacion;
    }

    public function setObservacion(?string $observacion): self {
        $this->observacion = $observacion;

        return $this;
    }

    public function getReferente(): ?string {
        return $this->referente;
    }

    public function setReferente(?string $referente): self {
        $this->referente = $referente;

        return $this;
    }

    public function getReferente2(): ?string {
        return $this->referente2;
    }

    public function setReferente2(?string $referente2): self {
        $this->referente2 = $referente2;

        return $this;
    }

    public function getReferente2codigoarea(): ?string {
        return $this->referente2codigoarea;
    }

    public function setReferente2codigoarea(?string $referente2codigoarea): self {
        $this->referente2codigoarea = $referente2codigoarea;

        return $this;
    }

    public function getReferente2te(): ?string {
        return $this->referente2Te;
    }

    public function setReferente2te(?string $referente2Te): self {
        $this->referente2Te = $referente2Te;

        return $this;
    }

    public function getReferente2mail(): ?string {
        return $this->referente2mail;
    }

    public function setReferente2mail(?string $referente2mail): self {
        $this->referente2mail = $referente2mail;

        return $this;
    }

    public function getContactoapenom(): ?string {
        return $this->contactoapenom;
    }

    public function setContactoapenom(?string $contactoapenom): self {
        $this->contactoapenom = $contactoapenom;

        return $this;
    }

    public function getContactocodigoarea(): ?string {
        return $this->contactocodigoarea;
    }

    public function setContactocodigoarea(?string $contactocodigoarea): self {
        $this->contactocodigoarea = $contactocodigoarea;

        return $this;
    }

    public function getContactote(): ?string {
        return $this->contactote;
    }

    public function setContactote(?string $contactote): self {
        $this->contactote = $contactote;

        return $this;
    }

    public function getContactomail(): ?string {
        return $this->contactomail;
    }

    public function setContactomail(?string $contactomail): self {
        $this->contactomail = $contactomail;

        return $this;
    }

    public function getTramiteurgente(): ?bool {
        return $this->tramiteurgente;
    }

    public function setTramiteurgente(bool $tramiteurgente): self {
        $this->tramiteurgente = $tramiteurgente;

        return $this;
    }

    public function getNombreinstitucion(): ?string {
        return $this->nombreinstitucion;
    }

    public function setNombreinstitucion(?string $nombreinstitucion): self {
        $this->nombreinstitucion = $nombreinstitucion;

        return $this;
    }

    public function getIdlocalidadinst(): ?int {
        return $this->idlocalidadinst;
    }

    public function setIdlocalidadinst(int $idlocalidadinst): self {
        $this->idlocalidadinst = $idlocalidadinst;

        return $this;
    }

    public function getLocalidadinst(): ?string {
        return $this->localidadinst;
    }

    public function setLocalidadinst(string $localidadinst): self {
        $this->localidadinst = $localidadinst;

        return $this;
    }

    public function getDepartamentoinst(): ?string {
        return $this->departamentoinst;
    }

    public function setDepartamentoinst(string $departamentoinst): self {
        $this->departamentoinst = $departamentoinst;

        return $this;
    }

    public function getCbuinstitucion(): ?string {
        return $this->cbuinstitucion;
    }

    public function setCbuinstitucion(?string $cbuinstitucion): self {
        $this->cbuinstitucion = $cbuinstitucion;

        return $this;
    }

    public function getNroexpediente(): ?string {
        return $this->nroexpediente;
    }

    public function setNroexpediente(?string $nroexpediente): self {
        $this->nroexpediente = $nroexpediente;

        return $this;
    }

    public function getFechaexpediente(): ?\DateTimeInterface {
        return $this->fechaexpediente;
    }

    public function setFechaexpediente(?\DateTimeInterface $fechaexpediente): self {
        $this->fechaexpediente = $fechaexpediente;

        return $this;
    }

    public function getCaratula(): ?string {
        return $this->caratula;
    }

    public function setCaratula(?string $caratula): self {
        $this->caratula = $caratula;

        return $this;
    }

    public function getFechacaratula(): ?\DateTimeInterface {
        return $this->fechacaratula;
    }

    public function setFechacaratula(?\DateTimeInterface $fechacaratula): self {
        $this->fechacaratula = $fechacaratula;

        return $this;
    }

    public function getFechadictamen(): ?\DateTimeInterface {
        return $this->fechadictamen;
    }

    public function setFechadictamen(?\DateTimeInterface $fechadictamen): self {
        $this->fechadictamen = $fechadictamen;

        return $this;
    }

    public function getObservaciondictamen(): ?string {
        return $this->observaciondictamen;
    }

    public function setObservaciondictamen(?string $observaciondictamen): self {
        $this->observaciondictamen = $observaciondictamen;

        return $this;
    }

    public function getFechapago(): ?\DateTimeInterface {
        return $this->fechapago;
    }

    public function setFechapago(?\DateTimeInterface $fechapago): self {
        $this->fechapago = $fechapago;

        return $this;
    }

    public function getFecharesolucion(): ?\DateTimeInterface {
        return $this->fecharesolucion;
    }

    public function setFecharesolucion(?\DateTimeInterface $fecharesolucion): self {
        $this->fecharesolucion = $fecharesolucion;

        return $this;
    }

    public function getNroresolucion(): ?int {
        return $this->nroresolucion;
    }

    public function setNroresolucion(?int $nroresolucion): self {
        $this->nroresolucion = $nroresolucion;

        return $this;
    }

    public function getEtapas(): ?string {
        return $this->etapas;
    }

    public function setEtapas(?string $etapas): self {
        $this->etapas = $etapas;

        return $this;
    }

    public function getNrosipaf(): ?string {
        return $this->nrosipaf;
    }

    public function setNrosipaf(?string $nrosipaf): self {
        $this->nrosipaf = $nrosipaf;

        return $this;
    }

    public function getUsuario(): ?string {
        return $this->usuario;
    }

    public function setUsuario(?string $usuario): self {
        $this->usuario = $usuario;

        return $this;
    }

    public function getAreacarga(): ?string {
        return $this->areaCarga;
    }

    public function setAreacarga(?string $areaCarga): self {
        $this->areaCarga = $areaCarga;

        return $this;
    }

    public function getFechacarga(): ?\DateTimeInterface {
        return $this->fechacarga;
    }

    public function setFechacarga(?\DateTimeInterface $fechacarga): self {
        $this->fechacarga = $fechacarga;

        return $this;
    }

    public function getFechabaja(): ?\DateTimeInterface {
        return $this->fechabaja;
    }

    public function setFechabaja(?\DateTimeInterface $fechabaja): self {
        $this->fechabaja = $fechabaja;

        return $this;
    }

    public function getMotivobaja(): ?string {
        return $this->motivobaja;
    }

    public function setMotivobaja(?string $motivobaja): self {
        $this->motivobaja = $motivobaja;

        return $this;
    }

    public function getCantidadbenefdirectos(): ?int {
        return $this->cantidadbenefdirectos;
    }

    public function setCantidadbenefdirectos(?int $cantidadbenefdirectos): self {
        $this->cantidadbenefdirectos = $cantidadbenefdirectos;

        return $this;
    }

    public function getCantidadbenefindirectos(): ?int {
        return $this->cantidadbenefindirectos;
    }

    public function setCantidadbenefindirectos(?int $cantidadbenefindirectos): self {
        $this->cantidadbenefindirectos = $cantidadbenefindirectos;

        return $this;
    }

    public function getTiposolicitanteIdtiposolicitante(): ?Tiposolicitante {
        return $this->tiposolicitanteIdtiposolicitante;
    }

    public function setTiposolicitanteIdtiposolicitante(?Tiposolicitante $tiposolicitanteIdtiposolicitante): self {
        $this->tiposolicitanteIdtiposolicitante = $tiposolicitanteIdtiposolicitante;

        return $this;
    }

    public function getInstId() {
        return $this->instId;
    }

    public function setInstId($instId): self {
        $this->instId = $instId;

        return $this;
    }

}
