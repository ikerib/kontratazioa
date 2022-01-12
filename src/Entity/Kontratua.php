<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\KontratuaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={},
 *     itemOperations={"get"},
 *     normalizationContext={"groups"={"kontratua:read"}},
 *     shortName="contract"
 * )
 * @ORM\Entity(repositoryClass=KontratuaRepository::class)
 */
class Kontratua
{
    Use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"kontratua:read"})
     */
    private $espedientea;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"kontratua:read"})
     */
    private $izena_eus;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"kontratua:read"})
     */
    private $izena_es;

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
        return ''.$this->izena_eus;
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
     * @ORM\ManyToOne(targetEntity=Saila::class, inversedBy="kontratuas")
     */
    private $saila;

    /**
     * @ORM\OneToMany(targetEntity=KontratuaLote::class, mappedBy="kontratua")
     * @Groups({"kontratua:read"})
     */
    private $lotes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $artxiboa;

    /**
     * @ORM\OneToMany(targetEntity=Fitxategia::class, mappedBy="kontratua")
     */
    private $fitxategiak;

    public function __construct()
    {
        $this->lotes = new ArrayCollection();
        $this->fitxategiak = new ArrayCollection();
    }

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

    public function getSaila(): ?Saila
    {
        return $this->saila;
    }

    public function setSaila(?Saila $saila): self
    {
        $this->saila = $saila;

        return $this;
    }

    /**
     * @return Collection|KontratuaLote[]
     */
    public function getLotes(): Collection
    {
        return $this->lotes;
    }

    public function addLote(KontratuaLote $lote): self
    {
        if (!$this->lotes->contains($lote)) {
            $this->lotes[] = $lote;
            $lote->setKontratua($this);
        }

        return $this;
    }

    public function removeLote(KontratuaLote $lote): self
    {
        if ($this->lotes->removeElement($lote)) {
            // set the owning side to null (unless already changed)
            if ($lote->getKontratua() === $this) {
                $lote->setKontratua(null);
            }
        }

        return $this;
    }

    public function getArtxiboa(): ?string
    {
        return $this->artxiboa;
    }

    public function setArtxiboa(?string $artxiboa): self
    {
        $this->artxiboa = $artxiboa;

        return $this;
    }

    /**
     * @return Collection|Fitxategia[]
     */
    public function getFitxategiak(): Collection
    {
        return $this->fitxategiak;
    }

    public function addFitxategiak(Fitxategia $fitxategiak): self
    {
        if (!$this->fitxategiak->contains($fitxategiak)) {
            $this->fitxategiak[] = $fitxategiak;
            $fitxategiak->setKontratua($this);
        }

        return $this;
    }

    public function removeFitxategiak(Fitxategia $fitxategiak): self
    {
        if ($this->fitxategiak->removeElement($fitxategiak)) {
            // set the owning side to null (unless already changed)
            if ($fitxategiak->getKontratua() === $this) {
                $fitxategiak->setKontratua(null);
            }
        }

        return $this;
    }


}
