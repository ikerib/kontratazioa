<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\NotificationRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get", "post"},
 *     itemOperations={"get", "put", "delete"},
 *     normalizationContext={"groups"={"notification:read", "notification:write"}},
 *     denormalizationContext={"groups"={"notification:write"}}
 * )
 * @ORM\Entity(repositoryClass=NotificationRepository::class)
 */
class Notification
{
    Use TimestampableEntity;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"notification:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"notification:read", "notification:write"})
     */
    private $noiz;

    /**
     * @ORM\ManyToOne(targetEntity=KontratuaLote::class, inversedBy="notifications")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"notification:write"})
     */
    private $lote;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="notifications")
     * @Groups({"notification:write"})
     */
    private $user;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"notification:write"})
     */
    private $notify=0;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $emailed=0;

    /******************************************************************************************************************/
    /******************************************************************************************************************/
    /******************************************************************************************************************/

    public function __toString()
    {
        return $this->lote;
    }

    /******************************************************************************************************************/
    /******************************************************************************************************************/
    /******************************************************************************************************************/


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

    public function getNotified(): ?bool
    {
        return $this->notified;
    }

    public function setNotified(bool $notified): self
    {
        $this->notified = $notified;

        return $this;
    }

    public function getEmailed(): ?bool
    {
        return $this->emailed;
    }

    public function setEmailed(bool $emailed): self
    {
        $this->emailed = $emailed;

        return $this;
    }

    public function getNotify(): ?bool
    {
        return $this->notify;
    }

    public function setNotify(?bool $notify): self
    {
        $this->notify = $notify;

        return $this;
    }
}
