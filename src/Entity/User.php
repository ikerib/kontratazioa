<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 *
 * @ApiResource (
 *     collectionOperations={"get"},
 *     itemOperations={"get"},
 *     normalizationContext={"groups"={"user:read"}},
 * )
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    Use TimestampableEntity;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true, nullable=true)
     */
    private string $username;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private array $roles = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $deparment;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $displayname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $dn;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $enabled;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $hizkuntza;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $lanpostua;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $ldapsaila;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private ?string $nan;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $notes;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $sailburuada;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $surname;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private array $ldapTaldeak = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private array $ldapRolak = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Password;

    /************************************************************************************************************************************************************/
    /************************************************************************************************************************************************************/
    /************************************************************************************************************************************************************/


    /**
     * @ORM\OneToMany(targetEntity=Notification::class, mappedBy="user")
     */
    private $notifications;

    public function __construct()
    {
        $this->notifications = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->username;
    }

    /************************************************************************************************************************************************************/
    /************************************************************************************************************************************************************/
    /************************************************************************************************************************************************************/

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_PASAIA';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        // TODO: Implement getPassword() method.
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getDeparment(): ?string
    {
        return $this->deparment;
    }

    public function setDeparment(?string $deparment): self
    {
        $this->deparment = $deparment;

        return $this;
    }

    public function getDisplayname(): ?string
    {
        return $this->displayname;
    }

    public function setDisplayname(?string $displayname): self
    {
        $this->displayname = $displayname;

        return $this;
    }

    public function getDn(): ?string
    {
        return $this->dn;
    }

    public function setDn(?string $dn): self
    {
        $this->dn = $dn;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(?bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getHizkuntza(): ?string
    {
        return $this->hizkuntza;
    }

    public function setHizkuntza(?string $hizkuntza): self
    {
        $this->hizkuntza = $hizkuntza;

        return $this;
    }

    public function getLanpostua(): ?string
    {
        return $this->lanpostua;
    }

    public function setLanpostua(?string $lanpostua): self
    {
        $this->lanpostua = $lanpostua;

        return $this;
    }

    public function getLdapsaila(): ?string
    {
        return $this->ldapsaila;
    }

    public function setLdapsaila(?string $ldapsaila): self
    {
        $this->ldapsaila = $ldapsaila;

        return $this;
    }

    public function getNan(): ?string
    {
        return $this->nan;
    }

    public function setNan(?string $nan): self
    {
        $this->nan = $nan;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }

    public function getSailburuada(): ?bool
    {
        return $this->sailburuada;
    }

    public function setSailburuada(?bool $sailburuada): self
    {
        $this->sailburuada = $sailburuada;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getLdapTaldeak(): ?array
    {
        return $this->ldapTaldeak;
    }

    public function setLdapTaldeak(?array $ldapTaldeak): self
    {
        $this->ldapTaldeak = $ldapTaldeak;

        return $this;
    }

    public function getLdapRolak(): ?array
    {
        return $this->ldapRolak;
    }

    public function setLdapRolak(?array $ldapRolak): self
    {
        $this->ldapRolak = $ldapRolak;

        return $this;
    }

    public function setPassword(?string $Password): self
    {
        $this->Password = $Password;

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
            $notification->setUser($this);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): self
    {
        if ($this->notifications->removeElement($notification)) {
            // set the owning side to null (unless already changed)
            if ($notification->getUser() === $this) {
                $notification->setUser(null);
            }
        }

        return $this;
    }


}
