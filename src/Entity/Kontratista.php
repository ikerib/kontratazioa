<?php

namespace App\Entity;

use App\Repository\KontratistaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\OneToMany(targetEntity=Kontratua::class, mappedBy="kontratista")
     */
    private $kontratuak;

    public function __construct()
    {
        $this->kontratuak = new ArrayCollection();
    }

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
}
