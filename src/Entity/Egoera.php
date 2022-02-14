<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EgoeraRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=EgoeraRepository::class)
 */
class Egoera
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
     * @ORM\OneToMany(targetEntity=Kontratua::class, mappedBy="egoera")
     */
    private $kontratua;

    public function __construct()
    {
        $this->kontratua = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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
     * @return Collection|Kontratua[]
     */
    public function getKontratua(): Collection
    {
        return $this->kontratua;
    }

    public function addKontratua(Kontratua $kontratua): self
    {
        if (!$this->kontratua->contains($kontratua)) {
            $this->kontratua[] = $kontratua;
            $kontratua->setEgoera($this);
        }

        return $this;
    }

    public function removeKontratua(Kontratua $kontratua): self
    {
        if ($this->kontratua->removeElement($kontratua)) {
            // set the owning side to null (unless already changed)
            if ($kontratua->getEgoera() === $this) {
                $kontratua->setEgoera(null);
            }
        }

        return $this;
    }
}
