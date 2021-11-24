<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\NotificationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"},
 *     normalizationContext={"groups"={"notification:read"}},
 * )
 * @ORM\Entity(repositoryClass=NotificationRepository::class)
 */
class Notification
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"notification:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"notification:read"})
     */
    private $noiz;

    /**
     * @ORM\ManyToOne(targetEntity=KontratuaLote::class, inversedBy="notifications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $lote;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="notifications")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNoiz(): ?\DateTimeInterface
    {
        return $this->noiz;
    }

    public function setNoiz(\DateTimeInterface $noiz): self
    {
        $this->noiz = $noiz;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
