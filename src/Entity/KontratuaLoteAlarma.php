<?php

namespace App\Entity;

use App\Repository\KontratuaLoteAlarmaRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=KontratuaLoteAlarmaRepository::class)
 */
class KontratuaLoteAlarma
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     */
    private $fetxa;

    /**
     * @ORM\ManyToOne(targetEntity=KontratuaLote::class, inversedBy="alarmak")
     * @ORM\JoinColumn(nullable=false)
     */
    private $lote;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFetxa(): ?\DateTimeInterface
    {
        return $this->fetxa;
    }

    public function setFetxa(\DateTimeInterface $fetxa): self
    {
        $this->fetxa = $fetxa;

        return $this;
    }

    public function getLote(): ?KontratuaLote
    {
        return $this->lote;
    }

    public function setLote(?KontratuaLote $lote): self
    {
        $this->lote = $lote;

        return $this;
    }
}
