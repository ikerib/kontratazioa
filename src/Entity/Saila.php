<?php

namespace App\Entity;

use App\Repository\SailaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=SailaRepository::class)
 */
class Saila
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
    private $izena;

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
        $this->kontaktuak = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->izena;
    }

    /**
     * @ORM\OneToMany(targetEntity=Kontratua::class, mappedBy="saila")
     */
    private $kontratuak;

    /**
     * @ORM\OneToMany(targetEntity=Kontaktuak::class, mappedBy="saila")
     */
    private $kontaktuak;

    /******************************************************************************************************************/
    /******************************************************************************************************************/
    /******************************************************************************************************************/

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIzena(): ?string
    {
        return $this->izena;
    }

    public function setIzena(string $izena): self
    {
        $this->izena = $izena;

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
            $kontratuak->setSaila($this);
        }

        return $this;
    }

    public function removeKontratuak(Kontratua $kontratuak): self
    {
        if ($this->kontratuak->removeElement($kontratuak)) {
            // set the owning side to null (unless already changed)
            if ($kontratuak->getSaila() === $this) {
                $kontratuak->setSaila(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Kontaktuak[]
     */
    public function getKontaktuak(): Collection
    {
        return $this->kontaktuak;
    }

    public function addKontaktuak(Kontaktuak $kontaktuak): self
    {
        if (!$this->kontaktuak->contains($kontaktuak)) {
            $this->kontaktuak[] = $kontaktuak;
            $kontaktuak->setSaila($this);
        }

        return $this;
    }

    public function removeKontaktuak(Kontaktuak $kontaktuak): self
    {
        if ($this->kontaktuak->removeElement($kontaktuak)) {
            // set the owning side to null (unless already changed)
            if ($kontaktuak->getSaila() === $this) {
                $kontaktuak->setSaila(null);
            }
        }

        return $this;
    }


}
