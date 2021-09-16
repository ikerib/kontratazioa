<?php

namespace App\Entity;

use App\Repository\SailaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SailaRepository::class)
 */
class Saila
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
    private $izena;

    /**
     * @ORM\OneToMany(targetEntity=Kontratua::class, mappedBy="saila")
     */
    private $kontratuas;

    public function __construct()
    {
        $this->kontratuas = new ArrayCollection();
    }

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

    /**
     * @return Collection|Kontratua[]
     */
    public function getKontratuas(): Collection
    {
        return $this->kontratuas;
    }

    public function addKontratua(Kontratua $kontratua): self
    {
        if (!$this->kontratuas->contains($kontratua)) {
            $this->kontratuas[] = $kontratua;
            $kontratua->setSaila($this);
        }

        return $this;
    }

    public function removeKontratua(Kontratua $kontratua): self
    {
        if ($this->kontratuas->removeElement($kontratua)) {
            // set the owning side to null (unless already changed)
            if ($kontratua->getSaila() === $this) {
                $kontratua->setSaila(null);
            }
        }

        return $this;
    }
}
