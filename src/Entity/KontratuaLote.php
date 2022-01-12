<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\KontratuaLoteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"},
 *     normalizationContext={"groups"={"lote:read"}},
 *     shortName="lote"
 * )
 * @ORM\Entity(repositoryClass=KontratuaLoteRepository::class)
 */
class KontratuaLote
{
    Use TimestampableEntity;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"kontratua:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"kontratua:read"})
     */
    private $name;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $aurrekontuaIva;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $aurrekontuaIvaGabe;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $sinadura;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $iraupena;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fetxaIraupena;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $adjudikazioaIva;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $adjudikazioaIvaGabe;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $amaitua;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $luzapena;

    /******************************************************************************************************************/
    /******************************************************************************************************************/
    /******************************************************************************************************************/

    public function __toString()
    {
        return ''.$this->name;
    }

    /**
     * @ORM\ManyToOne(targetEntity=Kontratua::class, inversedBy="lotes")
     */
    private $kontratua;

    /**
     * @ORM\ManyToOne(targetEntity=Kontratista::class, inversedBy="lotes")
     */
    private $kontratista;

    /**
     * @ORM\OneToMany(targetEntity=KontratuaLoteAlarma::class, mappedBy="lote", orphanRemoval=true)
     */
    private $alarmak;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $prorroga1;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $prorroga2;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $prorroga3;

    /**
     * @ApiSubresource()
     * @ORM\OneToMany(targetEntity=Notification::class, mappedBy="lote", orphanRemoval=true)
     */
    private $notifications;

    /**
     * @ORM\OneToMany(targetEntity=Fitxategia::class, mappedBy="lotea")
     */
    private $fitxategiak;

    public function __construct()
    {
        $this->alarmak = new ArrayCollection();
        $this->notifications = new ArrayCollection();
        $this->fitxategiak = new ArrayCollection();
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

    public function getAurrekontuaIva(): ?float
    {
        return $this->aurrekontuaIva;
    }

    public function setAurrekontuaIva(?float $aurrekontuaIva): self
    {
        $this->aurrekontuaIva = $aurrekontuaIva;

        return $this;
    }

    public function getAurrekontuaIvaGabe(): ?float
    {
        return $this->aurrekontuaIvaGabe;
    }

    public function setAurrekontuaIvaGabe(?float $aurrekontuaIvaGabe): self
    {
        $this->aurrekontuaIvaGabe = $aurrekontuaIvaGabe;

        return $this;
    }

    public function getSinadura(): ?\DateTimeInterface
    {
        return $this->sinadura;
    }

    public function setSinadura(\DateTimeInterface $sinadura): self
    {
        $this->sinadura = $sinadura;

        return $this;
    }

    public function getIraupena(): ?string
    {
        return $this->iraupena;
    }

    public function setIraupena(string $iraupena): self
    {
        $this->iraupena = $iraupena;

        return $this;
    }

    public function getAdjudikazioaIva(): ?float
    {
        return $this->adjudikazioaIva;
    }

    public function setAdjudikazioaIva(?float $adjudikazioaIva): self
    {
        $this->adjudikazioaIva = $adjudikazioaIva;

        return $this;
    }

    public function getAdjudikazioaIvaGabe(): ?float
    {
        return $this->adjudikazioaIvaGabe;
    }

    public function setAdjudikazioaIvaGabe(?float $adjudikazioaIvaGabe): self
    {
        $this->adjudikazioaIvaGabe = $adjudikazioaIvaGabe;

        return $this;
    }

    public function getAmaitua(): ?bool
    {
        return $this->amaitua;
    }

    public function setAmaitua(bool $amaitua): self
    {
        $this->amaitua = $amaitua;

        return $this;
    }

    public function getLuzapena(): ?string
    {
        return $this->luzapena;
    }

    public function setLuzapena(string $luzapena): self
    {
        $this->luzapena = $luzapena;

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

    public function getKontratista(): ?Kontratista
    {
        return $this->kontratista;
    }

    public function setKontratista(?Kontratista $kontratista): self
    {
        $this->kontratista = $kontratista;

        return $this;
    }

    public function getFetxaIraupena(): ?\DateTimeInterface
    {
        return $this->fetxaIraupena;
    }

    public function setFetxaIraupena(?\DateTimeInterface $fetxaIraupena): self
    {
        $this->fetxaIraupena = $fetxaIraupena;

        return $this;
    }

    /**
     * @return Collection|KontratuaLoteAlarma[]
     */
    public function getAlarmak(): Collection
    {
        return $this->alarmak;
    }

    public function addAlarmak(KontratuaLoteAlarma $alarmak): self
    {
        if (!$this->alarmak->contains($alarmak)) {
            $this->alarmak[] = $alarmak;
            $alarmak->setLote($this);
        }

        return $this;
    }

    public function removeAlarmak(KontratuaLoteAlarma $alarmak): self
    {
        if ($this->alarmak->removeElement($alarmak)) {
            // set the owning side to null (unless already changed)
            if ($alarmak->getLote() === $this) {
                $alarmak->setLote(null);
            }
        }

        return $this;
    }

    public function getProrroga1(): ?\DateTimeInterface
    {
        return $this->prorroga1;
    }

    public function setProrroga1(?\DateTimeInterface $prorroga1): self
    {
        $this->prorroga1 = $prorroga1;

        return $this;
    }

    public function getProrroga2(): ?\DateTimeInterface
    {
        return $this->prorroga2;
    }

    public function setProrroga2(?\DateTimeInterface $prorroga2): self
    {
        $this->prorroga2 = $prorroga2;

        return $this;
    }

    public function getProrroga3(): ?\DateTimeInterface
    {
        return $this->prorroga3;
    }

    public function setProrroga3(?\DateTimeInterface $prorroga3): self
    {
        $this->prorroga3 = $prorroga3;

        return $this;
    }

    /**
     * @return Collection|Notification[]
     */
    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function addNotification(Notification $notification): self
    {
        if (!$this->notifications->contains($notification)) {
            $this->notifications[] = $notification;
            $notification->setLote($this);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): self
    {
        if ($this->notifications->removeElement($notification)) {
            // set the owning side to null (unless already changed)
            if ($notification->getLote() === $this) {
                $notification->setLote(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Fitxategia[]
     */
    public function getFitxategiak(): Collection
    {
        return $this->fitxategiak;
    }

    public function addFitxategiak(Fitxategia $fitxategiak): self
    {
        if (!$this->fitxategiak->contains($fitxategiak)) {
            $this->fitxategiak[] = $fitxategiak;
            $fitxategiak->setLotea($this);
        }

        return $this;
    }

    public function removeFitxategiak(Fitxategia $fitxategiak): self
    {
        if ($this->fitxategiak->removeElement($fitxategiak)) {
            // set the owning side to null (unless already changed)
            if ($fitxategiak->getLotea() === $this) {
                $fitxategiak->setLotea(null);
            }
        }

        return $this;
    }
}
