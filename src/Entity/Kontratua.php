<?php

namespace App\Entity;

use App\Repository\KontratuaRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=KontratuaRepository::class)
 */
class Kontratua
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $espedientea;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $izena_eus;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $izena_es;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $aurrekontuaIva;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $aurrekontuaIvaGabe;

    /**
     * @ORM\Column(type="date")
     */
    private $sinadura;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $iraupena;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $adjudikazioaIva;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $adjudikazioaIvaGabe;

    /**
     * @ORM\Column(type="boolean")
     */
    private $amaitua;

    /**
     * @ORM\Column(type="integer")
     */
    private $luzapena;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $oharrak;

    /**
     * @ORM\Column(type="string", length=12, nullable=true)
     */
    private $espedienteElektronikoa;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /******************************************************************************************************************/
    /******************************************************************************************************************/
    /******************************************************************************************************************/

    public function __toString()
    {
        return $this->izena_eus;
    }

    /**
     * @ORM\ManyToOne(targetEntity=Mota::class, inversedBy="kontratuak")
     */
    private $mota;

    /**
     * @ORM\ManyToOne(targetEntity=Prozedura::class, inversedBy="kontratuak")
     */
    private $prozedura;

    /**
     * @ORM\ManyToOne(targetEntity=Kontratista::class, inversedBy="kontratuak")
     */
    private $kontratista;

    /**
     * @ORM\ManyToOne(targetEntity=Saila::class, inversedBy="kontratuas")
     */
    private $saila;

    /******************************************************************************************************************/
    /******************************************************************************************************************/
    /******************************************************************************************************************/

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEspedientea(): ?string
    {
        return $this->espedientea;
    }

    public function setEspedientea(string $espedientea): self
    {
        $this->espedientea = $espedientea;

        return $this;
    }

    public function getIzenaEus(): ?string
    {
        return $this->izena_eus;
    }

    public function setIzenaEus(string $izena_eus): self
    {
        $this->izena_eus = $izena_eus;

        return $this;
    }

    public function getIzenaEs(): ?string
    {
        return $this->izena_es;
    }

    public function setIzenaEs(string $izena_es): self
    {
        $this->izena_es = $izena_es;

        return $this;
    }

    public function getMota(): ?Mota
    {
        return $this->mota;
    }

    public function setMota(?Mota $mota): self
    {
        $this->mota = $mota;

        return $this;
    }

    public function getProzedura(): ?Prozedura
    {
        return $this->prozedura;
    }

    public function setProzedura(?Prozedura $prozedura): self
    {
        $this->prozedura = $prozedura;

        return $this;
    }

    public function getAurrekontuaIva(): ?float
    {
        return $this->aurrekontuaIva;
    }

    public function setAurrekontuaIva(?float $aurrekontuaIva): self
    {
        $this->aurrekontuaIva = $aurrekontuaIva;

        return $this;
    }

    public function getAurrekontuaIvaGabe(): ?float
    {
        return $this->aurrekontuaIvaGabe;
    }

    public function setAurrekontuaIvaGabe(?float $aurrekontuaIvaGabe): self
    {
        $this->aurrekontuaIvaGabe = $aurrekontuaIvaGabe;

        return $this;
    }

    public function getKontratista(): ?Kontratista
    {
        return $this->kontratista;
    }

    public function setKontratista(?Kontratista $kontratista): self
    {
        $this->kontratista = $kontratista;

        return $this;
    }

    public function getSinadura(): ?\DateTimeInterface
    {
        return $this->sinadura;
    }

    public function setSinadura(\DateTimeInterface $sinadura): self
    {
        $this->sinadura = $sinadura;

        return $this;
    }

    public function getIraupena(): ?string
    {
        return $this->iraupena;
    }

    public function setIraupena(string $iraupena): self
    {
        $this->iraupena = $iraupena;

        return $this;
    }

    public function getAdjudikazioaIva(): ?float
    {
        return $this->adjudikazioaIva;
    }

    public function setAdjudikazioaIva(?float $adjudikazioaIva): self
    {
        $this->adjudikazioaIva = $adjudikazioaIva;

        return $this;
    }

    public function getAdjudikazioaIvaGabe(): ?float
    {
        return $this->adjudikazioaIvaGabe;
    }

    public function setAdjudikazioaIvaGabe(?float $adjudikazioaIvaGabe): self
    {
        $this->adjudikazioaIvaGabe = $adjudikazioaIvaGabe;

        return $this;
    }

    public function getAmaitua(): ?bool
    {
        return $this->amaitua;
    }

    public function setAmaitua(bool $amaitua): self
    {
        $this->amaitua = $amaitua;

        return $this;
    }

    public function getLuzapena(): ?int
    {
        return $this->luzapena;
    }

    public function setLuzapena(int $luzapena): self
    {
        $this->luzapena = $luzapena;

        return $this;
    }

    public function getSaila(): ?Saila
    {
        return $this->saila;
    }

    public function setSaila(?Saila $saila): self
    {
        $this->saila = $saila;

        return $this;
    }

    public function getOharrak(): ?string
    {
        return $this->oharrak;
    }

    public function setOharrak(?string $oharrak): self
    {
        $this->oharrak = $oharrak;

        return $this;
    }

    public function getEspedienteElektronikoa(): ?string
    {
        return $this->espedienteElektronikoa;
    }

    public function setEspedienteElektronikoa(?string $espedienteElektronikoa): self
    {
        $this->espedienteElektronikoa = $espedienteElektronikoa;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }
}
