<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FitxategiaRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=FitxategiaRepository::class)
 */
class Fitxategia
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

    /**
     * @ORM\ManyToOne(targetEntity=FitxategiMota::class, inversedBy="fitxategiak")
     */
    private $fitxategimota;

    /**
     * @ORM\ManyToOne(targetEntity=Kontratua::class, inversedBy="fitxategiak")
     */
    private $kontratua;

    /**
     * @ORM\ManyToOne(targetEntity=KontratuaLote::class, inversedBy="fitxategiak")
     */
    private $lotea;

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

    public function getFitxategimota(): ?FitxategiMota
    {
        return $this->fitxategimota;
    }

    public function setFitxategimota(?FitxategiMota $fitxategimota): self
    {
        $this->fitxategimota = $fitxategimota;

        return $this;
    }

    public function getKontratua(): ?Kontratua
    {
        return $this->kontratua;
    }

    public function setKontratua(?Kontratua $kontratua): self
    {
        $this->kontratua = $kontratua;

        return $this;
    }

    public function getLotea(): ?KontratuaLote
    {
        return $this->lotea;
    }

    public function setLotea(?KontratuaLote $lotea): self
    {
        $this->lotea = $lotea;

        return $this;
    }
}
