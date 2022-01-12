<?php

namespace App\Entity;

use App\Repository\ProzeduraRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=ProzeduraRepository::class)
 */
class Prozedura
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
    private $prozedura_eus;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prozedura_es;

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
        $this->kontratuak = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->prozedura_eus;
    }

    /**
     * @ORM\OneToMany(targetEntity=Kontratua::class, mappedBy="prozedura")
     */
    private $kontratuak;

    /******************************************************************************************************************/
    /******************************************************************************************************************/
    /******************************************************************************************************************/

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProzeduraEus(): ?string
    {
        return $this->prozedura_eus;
    }

    public function setProzeduraEus(string $prozedura_eus): self
    {
        $this->prozedura_eus = $prozedura_eus;

        return $this;
    }

    public function getProzeduraEs(): ?string
    {
        return $this->prozedura_es;
    }

    public function setProzeduraEs(string $prozedura_es): self
    {
        $this->prozedura_es = $prozedura_es;

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
            $kontratuak->setProzedura($this);
        }

        return $this;
    }

    public function removeKontratuak(Kontratua $kontratuak): self
    {
        if ($this->kontratuak->removeElement($kontratuak)) {
            // set the owning side to null (unless already changed)
            if ($kontratuak->getProzedura() === $this) {
                $kontratuak->setProzedura(null);
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
}
