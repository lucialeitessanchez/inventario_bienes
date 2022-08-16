<?php

namespace App\Entity\ruinstituciones;

use Doctrine\ORM\Mapping as ORM;

/**
 * AutoridadRui
 *
 * @ORM\Table(name="Autoridad", indexes={@ORM\Index(name="IDX_2C0B5FFF6AE56588", columns={"cargo_autoridad"}), @ORM\Index(name="IDX_2C0B5FFFBC90EF8", columns={"t_persona"}), @ORM\Index(name="IDX_2C0B5FFF74C107E5", columns={"vinculo"}), @ORM\Index(name="IDX_2C0B5FFF54DF9189", columns={"tipo_documento"}), @ORM\Index(name="IDX_2C0B5FFF931D5FC3", columns={"nacionalidad"}), @ORM\Index(name="IDX_2C0B5FFF4F68E010", columns={"localidad"}), @ORM\Index(name="IDX_2C0B5FFF79987C8", columns={"comision_directiva"})})
 * @ORM\Entity
 */
class AutoridadRui
{
/**
 * @var int
 *
 * @ORM\Column(name="aut_id", type="integer", nullable=false)
 * @ORM\Id
 * @ORM\GeneratedValue(strategy="IDENTITY")
 */
private $autId;

/**
 * @var int
 *
 * @ORM\Column(name="doctrine_version", type="integer", nullable=false, options={"default"="1"})
 */
private $doctrineVersion = 1;

/**
 * @var string|null
 *
 * @ORM\Column(name="aut_ape", type="string", length=255, nullable=true)
 */
private $autApe;

/**
 * @var string|null
 *
 * @ORM\Column(name="aut_nom", type="string", length=255, nullable=true)
 */
private $autNom;

/**
 * @var int|null
 *
 * @ORM\Column(name="aut_doc", type="integer", nullable=true)
 */
private $autDoc;

/**
 * @var \DateTime|null
 *
 * @ORM\Column(name="aut_fec_nac", type="date", nullable=true)
 */
private $autFecNac;

/**
 * @var string|null
 *
 * @ORM\Column(name="aut_cuil_cdi", type="string", length=255, nullable=true)
 */
private $autCuilCdi;

/**
 * @var string|null
 *
 * @ORM\Column(name="aut_sexo", type="string", length=255, nullable=true)
 */
private $autSexo;

/**
 * @var string|null
 *
 * @ORM\Column(name="aut_telefono", type="string", length=255, nullable=true)
 */
private $autTelefono;

/**
 * @var string|null
 *
 * @ORM\Column(name="aut_celular", type="string", length=255, nullable=true)
 */
private $autCelular;

/**
 * @var string|null
 *
 * @ORM\Column(name="aut_mail", type="string", length=255, nullable=true)
 */
private $autMail;

/**
 * @var \DateTime|null
 *
 * @ORM\Column(name="aut_cargo_fec_ini", type="date", nullable=true)
 */
private $autCargoFecIni;

/**
 * @var \DateTime|null
 *
 * @ORM\Column(name="aut_cargo_fec_fin", type="date", nullable=true)
 */
private $autCargoFecFin;

/**
 * @var string|null
 *
 * @ORM\Column(name="aut_dir_calle", type="string", length=255, nullable=true)
 */
private $autDirCalle;

/**
 * @var int|null
 *
 * @ORM\Column(name="aut_dir_nro", type="integer", nullable=true)
 */
private $autDirNro;

/**
 * @var int|null
 *
 * @ORM\Column(name="aut_dir_piso", type="integer", nullable=true)
 */
private $autDirPiso;

/**
 * @var string|null
 *
 * @ORM\Column(name="aut_dir_dpto_ofi_casa", type="string", length=0, nullable=true)
 */
private $autDirDptoOfiCasa;

/**
 * @var string|null
 *
 * @ORM\Column(name="aut_dir_dpto_ofi_casa_nro", type="string", length=255, nullable=true)
 */
private $autDirDptoOfiCasaNro;

/**
 * @var string|null
 *
 * @ORM\Column(name="aut_dir_manz", type="string", length=255, nullable=true)
 */
private $autDirManz;

/**
 * @var string|null
 *
 * @ORM\Column(name="aut_dir_torre_monob", type="string", length=0, nullable=true)
 */
private $autDirTorreMonob;

/**
 * @var string|null
 *
 * @ORM\Column(name="aut_dir_torre_monob_nro", type="string", length=255, nullable=true)
 */
private $autDirTorreMonobNro;

/**
 * @var string|null
 *
 * @ORM\Column(name="aut_dir_esc_pasillo", type="string", length=0, nullable=true)
 */
private $autDirEscPasillo;

/**
 * @var string|null
 *
 * @ORM\Column(name="aut_dir_esc_pasillo_nro", type="string", length=255, nullable=true)
 */
private $autDirEscPasilloNro;

/**
 * @var string|null
 *
 * @ORM\Column(name="aut_dir_vec_asent", type="string", length=0, nullable=true)
 */
private $autDirVecAsent;

/**
 * @var string|null
 *
 * @ORM\Column(name="aut_dir_vec_asent_nro", type="string", length=255, nullable=true)
 */
private $autDirVecAsentNro;

/**
 * @var string|null
 *
 * @ORM\Column(name="aut_dir_ruta", type="string", length=255, nullable=true)
 */
private $autDirRuta;

/**
 * @var string|null
 *
 * @ORM\Column(name="aut_dir_ruta_km", type="string", length=255, nullable=true)
 */
private $autDirRutaKm;

/**
 * @var string|null
 *
 * @ORM\Column(name="aut_dir_ref_vis_geo", type="string", length=255, nullable=true)
 */
private $autDirRefVisGeo;

/**
 * @var string|null
 *
 * @ORM\Column(name="aut_dir_cod_pos", type="string", length=255, nullable=true)
 */
private $autDirCodPos;

/**
 * @var int|null
 *
 * @ORM\Column(name="tipo_documento", type="integer", nullable=true)
 */
private $tipoDocumento;



/**
 * @var int|null
 *
 * @ORM\Column(name="nacionalidad", type="integer", nullable=true)
 */
private $nacionalidad;

/**
 * @var int|null
 *
 * @ORM\Column(name="t_persona", type="integer", nullable=true)
 */
private $tPersona;

/**
 * @var int|null
 *
 * @ORM\Column(name="localidad", type="integer", nullable=true)
 */
private $localidad;

/**
 * @var int|null
 *
 * @ORM\Column(name="vinculo", type="integer", nullable=true)
 */
private $vinculo;

/**
 * @var int|null
 *
 * @ORM\Column(name="comision_directiva", type="integer", nullable=true)
 */
private $comisionDirectiva;


/**
 * 
 * @ORM\ManyToOne(targetEntity="CargoAutoridad")
 * @ORM\JoinColumn(name="cargo_autoridad", referencedColumnName="cargo_aut_id")     
 */
private $cargoAutoridad;

public function getAutId(): ?int
{
return $this->autId;
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

public function getAutApe(): ?string
{
return $this->autApe;
}

public function setAutApe(?string $autApe): self
{
$this->autApe = $autApe;

return $this;
}

public function getAutNom(): ?string
{
return $this->autNom;
}

public function setAutNom(?string $autNom): self
{
$this->autNom = $autNom;

return $this;
}

public function getAutDoc(): ?int
{
return $this->autDoc;
}

public function setAutDoc(?int $autDoc): self
{
$this->autDoc = $autDoc;

return $this;
}

public function getAutFecNac(): ?\DateTimeInterface
{
return $this->autFecNac;
}

public function setAutFecNac(?\DateTimeInterface $autFecNac): self
{
$this->autFecNac = $autFecNac;

return $this;
}

public function getAutCuilCdi(): ?string
{
return $this->autCuilCdi;
}

public function setAutCuilCdi(?string $autCuilCdi): self
{
$this->autCuilCdi = $autCuilCdi;

return $this;
}

public function getAutSexo(): ?string
{
return $this->autSexo;
}

public function setAutSexo(?string $autSexo): self
{
$this->autSexo = $autSexo;

return $this;
}

public function getAutTelefono(): ?string
{
return $this->autTelefono;
}

public function setAutTelefono(?string $autTelefono): self
{
$this->autTelefono = $autTelefono;

return $this;
}

public function getAutCelular(): ?string
{
return $this->autCelular;
}

public function setAutCelular(?string $autCelular): self
{
$this->autCelular = $autCelular;

return $this;
}

public function getAutMail(): ?string
{
return $this->autMail;
}

public function setAutMail(?string $autMail): self
{
$this->autMail = $autMail;

return $this;
}

public function getAutCargoFecIni(): ?\DateTimeInterface
{
return $this->autCargoFecIni;
}

public function setAutCargoFecIni(?\DateTimeInterface $autCargoFecIni): self
{
$this->autCargoFecIni = $autCargoFecIni;

return $this;
}

public function getAutCargoFecFin(): ?\DateTimeInterface
{
return $this->autCargoFecFin;
}

public function setAutCargoFecFin(?\DateTimeInterface $autCargoFecFin): self
{
$this->autCargoFecFin = $autCargoFecFin;

return $this;
}

public function getAutDirCalle(): ?string
{
return $this->autDirCalle;
}

public function setAutDirCalle(?string $autDirCalle): self
{
$this->autDirCalle = $autDirCalle;

return $this;
}

public function getAutDirNro(): ?int
{
return $this->autDirNro;
}

public function setAutDirNro(?int $autDirNro): self
{
$this->autDirNro = $autDirNro;

return $this;
}

public function getAutDirPiso(): ?int
{
return $this->autDirPiso;
}

public function setAutDirPiso(?int $autDirPiso): self
{
$this->autDirPiso = $autDirPiso;

return $this;
}

public function getAutDirDptoOfiCasa(): ?string
{
return $this->autDirDptoOfiCasa;
}

public function setAutDirDptoOfiCasa(?string $autDirDptoOfiCasa): self
{
$this->autDirDptoOfiCasa = $autDirDptoOfiCasa;

return $this;
}

public function getAutDirDptoOfiCasaNro(): ?string
{
return $this->autDirDptoOfiCasaNro;
}

public function setAutDirDptoOfiCasaNro(?string $autDirDptoOfiCasaNro): self
{
$this->autDirDptoOfiCasaNro = $autDirDptoOfiCasaNro;

return $this;
}

public function getAutDirManz(): ?string
{
return $this->autDirManz;
}

public function setAutDirManz(?string $autDirManz): self
{
$this->autDirManz = $autDirManz;

return $this;
}

public function getAutDirTorreMonob(): ?string
{
return $this->autDirTorreMonob;
}

public function setAutDirTorreMonob(?string $autDirTorreMonob): self
{
$this->autDirTorreMonob = $autDirTorreMonob;

return $this;
}

public function getAutDirTorreMonobNro(): ?string
{
return $this->autDirTorreMonobNro;
}

public function setAutDirTorreMonobNro(?string $autDirTorreMonobNro): self
{
$this->autDirTorreMonobNro = $autDirTorreMonobNro;

return $this;
}

public function getAutDirEscPasillo(): ?string
{
return $this->autDirEscPasillo;
}

public function setAutDirEscPasillo(?string $autDirEscPasillo): self
{
$this->autDirEscPasillo = $autDirEscPasillo;

return $this;
}

public function getAutDirEscPasilloNro(): ?string
{
return $this->autDirEscPasilloNro;
}

public function setAutDirEscPasilloNro(?string $autDirEscPasilloNro): self
{
$this->autDirEscPasilloNro = $autDirEscPasilloNro;

return $this;
}

public function getAutDirVecAsent(): ?string
{
return $this->autDirVecAsent;
}

public function setAutDirVecAsent(?string $autDirVecAsent): self
{
$this->autDirVecAsent = $autDirVecAsent;

return $this;
}

public function getAutDirVecAsentNro(): ?string
{
return $this->autDirVecAsentNro;
}

public function setAutDirVecAsentNro(?string $autDirVecAsentNro): self
{
$this->autDirVecAsentNro = $autDirVecAsentNro;

return $this;
}

public function getAutDirRuta(): ?string
{
return $this->autDirRuta;
}

public function setAutDirRuta(?string $autDirRuta): self
{
$this->autDirRuta = $autDirRuta;

return $this;
}

public function getAutDirRutaKm(): ?string
{
return $this->autDirRutaKm;
}

public function setAutDirRutaKm(?string $autDirRutaKm): self
{
$this->autDirRutaKm = $autDirRutaKm;

return $this;
}

public function getAutDirRefVisGeo(): ?string
{
return $this->autDirRefVisGeo;
}

public function setAutDirRefVisGeo(?string $autDirRefVisGeo): self
{
$this->autDirRefVisGeo = $autDirRefVisGeo;

return $this;
}

public function getAutDirCodPos(): ?string
{
return $this->autDirCodPos;
}

public function setAutDirCodPos(?string $autDirCodPos): self
{
$this->autDirCodPos = $autDirCodPos;

return $this;
}

public function getTipoDocumento(): ?int
{
return $this->tipoDocumento;
}

public function setTipoDocumento(?int $tipoDocumento): self
{
$this->tipoDocumento = $tipoDocumento;

return $this;
}

public function getNacionalidad(): ?int
{
return $this->nacionalidad;
}

public function setNacionalidad(?int $nacionalidad): self
{
$this->nacionalidad = $nacionalidad;

return $this;
}

public function getTPersona(): ?int
{
return $this->tPersona;
}

public function setTPersona(?int $tPersona): self
{
$this->tPersona = $tPersona;

return $this;
}

public function getLocalidad(): ?int
{
return $this->localidad;
}

public function setLocalidad(?int $localidad): self
{
$this->localidad = $localidad;

return $this;
}

public function getVinculo(): ?int
{
return $this->vinculo;
}

public function setVinculo(?int $vinculo): self
{
$this->vinculo = $vinculo;

return $this;
}

public function getComisionDirectiva(): ?int
{
return $this->comisionDirectiva;
}

public function setComisionDirectiva(?int $comisionDirectiva): self
{
$this->comisionDirectiva = $comisionDirectiva;

return $this;
}
function getCargoAutoridad() {
return $this->cargoAutoridad;
}
public function setCargoAutoridad($cargoAutoridad) {
$this->cargoAutoridad = $cargoAutoridad;
}

}
