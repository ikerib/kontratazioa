<?php

namespace App\Entity;

use App\Repository\MotaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=MotaRepository::class)
 */
class Mota
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
    private $mota_eus;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mota_es;

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
        return $this->mota_eus;
    }

    /**
     * @ORM\OneToMany(targetEntity=Kontratua::class, mappedBy="mota")
     */
    private $kontratuak;

    /******************************************************************************************************************/
    /******************************************************************************************************************/
    /******************************************************************************************************************/

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotaEus(): ?string
    {
        return $this->mota_eus;
    }

    public function setMotaEus(string $mota_eus): self
    {
        $this->mota_eus = $mota_eus;

        return $this;
    }

    public function getMotaEs(): ?string
    {
        return $this->mota_es;
    }

    public function setMotaEs(string $mota_es): self
    {
        $this->mota_es = $mota_es;

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
            $kontratuak->setMota($this);
        }

        return $this;
    }

    public function removeKontratuak(Kontratua $kontratuak): self
    {
        if ($this->kontratuak->removeElement($kontratuak)) {
            // set the owning side to null (unless already changed)
            if ($kontratuak->getMota() === $this) {
                $kontratuak->setMota(null);
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
