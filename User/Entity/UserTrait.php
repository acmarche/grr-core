<?php

namespace Grr\Core\User\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Grr\Core\Contrat\Entity\AreaInterface;
use Grr\Core\Contrat\Entity\RoomInterface;
use Grr\Core\Contrat\Entity\Security\AuthorizationInterface;
use Grr\Core\Doctrine\Traits\IdEntityTrait;
use Grr\Core\Doctrine\Traits\NameEntityTrait;
use Grr\Core\Doctrine\Traits\RolesTrait;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Symfony\Component\Security\Core\User\UserInterface;

trait UserTrait
{
    use IdEntityTrait;
    use TimestampableTrait;
    use NameEntityTrait;
    use RolesTrait;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private string $username;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private string $email;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $password = null;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private ?string $first_name = null;

    #[ORM\Column(type: 'boolean')]
    private bool $isEnabled;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $languageDefault = null;

    #[ORM\ManyToOne(targetEntity: AreaInterface::class)]
    private ?AreaInterface $area = null;

    #[ORM\ManyToOne(targetEntity: RoomInterface::class)]
    private ?RoomInterface $room = null;

    #[ORM\OneToMany(targetEntity: AuthorizationInterface::class, mappedBy: 'user', orphanRemoval: true)]
    private iterable $authorizations;

    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
        $this->isEnabled = true;
        $this->authorizations = new ArrayCollection();
    }

    public function __toString(): string
    {
        return mb_strtoupper($this->name).' '.$this->first_name;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(?string $first_name): void
    {
        $this->first_name = $first_name;
    }

    public function getIsEnabled(): ?bool
    {
        return $this->isEnabled;
    }

    public function setIsEnabled(bool $is_enabled): void
    {
        $this->isEnabled = $is_enabled;
    }

    /**
     * @return Collection|AuthorizationInterface[]
     */
    public function getAuthorizations(): Collection
    {
        return $this->authorizations;
    }

    public function addAuthorization(AuthorizationInterface $authorization): void
    {
        if (! $this->authorizations->contains($authorization)) {
            $this->authorizations[] = $authorization;
            $authorization->setUser($this);
        }
    }

    public function removeAuthorization(AuthorizationInterface $authorization): void
    {
        if ($this->authorizations->contains($authorization)) {
            $this->authorizations->removeElement($authorization);
            // set the owning side to null (unless already changed)
            if ($authorization->getUser() === $this) {
                $authorization->setUser(null);
            }
        }
    }

    public function getLanguageDefault(): ?string
    {
        return $this->languageDefault;
    }

    public function setLanguageDefault(?string $languageDefault): void
    {
        $this->languageDefault = $languageDefault;
    }

    public function getArea(): ?AreaInterface
    {
        return $this->area;
    }

    public function setArea(?AreaInterface $area): void
    {
        $this->area = $area;
    }

    public function getRoom(): ?RoomInterface
    {
        return $this->room;
    }

    public function setRoom(?RoomInterface $room): void
    {
        $this->room = $room;
    }
}
