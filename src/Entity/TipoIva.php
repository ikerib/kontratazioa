<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TipoIvaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=TipoIvaRepository::class)
 */
class TipoIva
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
     */
    private $name;

    /******************************************************************************************************************/
    /******************************************************************************************************************/
    /******************************************************************************************************************/

    /**
     * @ORM\OneToMany(targetEntity=KontratuaLote::class, mappedBy="tipoIva")
     */
    private $lote;

    public function __toString()
    {
        return $this->name;
    }

    public function __construct()
    {
        $this->lote = new ArrayCollection();
    }

    /******************************************************************************************************************/
    /******************************************************************************************************************/
    /******************************************************************************************************************/

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|KontratuaLote[]
     */
    public function getLote(): Collection
    {
        return $this->lote;
    }

    public function addLote(KontratuaLote $lote): self
    {
        if (!$this->lote->contains($lote)) {
            $this->lote[] = $lote;
            $lote->setTipoIva($this);
        }

        return $this;
    }

    public function removeLote(KontratuaLote $lote): self
    {
        if ($this->lote->removeElement($lote)) {
            // set the owning side to null (unless already changed)
            if ($lote->getTipoIva() === $this) {
                $lote->setTipoIva(null);
            }
        }

        return $this;
    }
}
