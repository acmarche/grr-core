<?php

namespace Grr\Core\User\Entity;

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

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     *
     * @var string
     */
    private $username;

    /**
     * @var string
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     *
     * @var mixed[]
     */
    private $roles = [];

    /**
     * @var string|null The hashed password
     * @ORM\Column(type="string", nullable=true)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     *
     * @var string|null
     */
    private $first_name;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    private $isEnabled;
    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string
     */
    private $languageDefault;

    /**
     * @ORM\ManyToOne(targetEntity="Grr\Core\Contrat\Entity\AreaInterface")
     *
     * @var AreaInterface
     */
    private $area;

    /**
     * @ORM\ManyToOne(targetEntity="Grr\Core\Contrat\Entity\RoomInterface")
     *
     * @var RoomInterface
     */
    private $room;

    /**
     * @ORM\OneToMany(targetEntity="Grr\Core\Contrat\Entity\Security\AuthorizationInterface", mappedBy="user", orphanRemoval=true)
     *
     * @var AuthorizationInterface[]
     */
    private $authorizations;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
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
    public function getSalt(): void
    {
        // not needed for apps that do not check user passwords
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
        if (!$this->authorizations->contains($authorization)) {
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
