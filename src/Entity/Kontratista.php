<?php

namespace App\Entity;

use App\Repository\KontratistaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=KontratistaRepository::class)
 */
class Kontratista
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
    private $izena_eus;

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

    public function __construct()
    {
        $this->lotes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->izena_eus;
    }

    /**
     * @ORM\OneToMany(targetEntity=KontratuaLote::class, mappedBy="kontratista")
     */
    private $lotes;

    /******************************************************************************************************************/
    /******************************************************************************************************************/
    /******************************************************************************************************************/

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Kontratua[]
     */
    public function getKontratuak(): Collection
    {
        return $this->kontratuak;
    }

    public function addKontratuak(Kontratua $kontratuak): self
    {
        if (!$this->kontratuak->contains($kontratuak)) {
            $this->kontratuak[] = $kontratuak;
            $kontratuak->setKontratista($this);
        }

        return $this;
    }

    public function removeKontratuak(Kontratua $kontratuak): self
    {
        if ($this->kontratuak->removeElement($kontratuak)) {
            // set the owning side to null (unless already changed)
            if ($kontratuak->getKontratista() === $this) {
                $kontratuak->setKontratista(null);
            }
        }

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
            $lote->setKontratista($this);
        }

        return $this;
    }

    public function removeLote(KontratuaLote $lote): self
    {
        if ($this->lotes->removeElement($lote)) {
            // set the owning side to null (unless already changed)
            if ($lote->getKontratista() === $this) {
                $lote->setKontratista(null);
            }
        }

        return $this;
    }
}
