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
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

trait UserTrait
{
    use IdEntityTrait;
    use TimestampableTrait;
    use NameEntityTrait;

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

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getRoles(): ?array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_GRR
        $roles[] = 'ROLE_GRR';

        return array_unique($roles);
    }

    public function addRole(string $role): self
    {
        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    public function removeRole(string $role): self
    {
        if (in_array($role, $this->roles, true)) {
            $index = array_search($role, $this->roles);
            unset($this->roles[$index]);
        }

        return $this;
    }

    public function hasRole(string $role): bool
    {
        return in_array($role, $this->getRoles(), true);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed for apps that do not check user passwords
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(?string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getIsEnabled(): ?bool
    {
        return $this->isEnabled;
    }

    public function setIsEnabled(bool $is_enabled): self
    {
        $this->isEnabled = $is_enabled;

        return $this;
    }

    /**
     * @return Collection|AuthorizationInterface[]
     */
    public function getAuthorizations(): Collection
    {
        return $this->authorizations;
    }

    public function addAuthorization(AuthorizationInterface $authorization): self
    {
        if (!$this->authorizations->contains($authorization)) {
            $this->authorizations[] = $authorization;
            $authorization->setUser($this);
        }

        return $this;
    }

    public function removeAuthorization(AuthorizationInterface $authorization): self
    {
        if ($this->authorizations->contains($authorization)) {
            $this->authorizations->removeElement($authorization);
            // set the owning side to null (unless already changed)
            if ($authorization->getUser() === $this) {
                $authorization->setUser(null);
            }
        }

        return $this;
    }

    public function getLanguageDefault(): ?string
    {
        return $this->languageDefault;
    }

    public function setLanguageDefault(?string $languageDefault): self
    {
        $this->languageDefault = $languageDefault;

        return $this;
    }

    public function getArea(): ?AreaInterface
    {
        return $this->area;
    }

    public function setArea(?AreaInterface $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getRoom(): ?RoomInterface
    {
        return $this->room;
    }

    public function setRoom(?RoomInterface $room): self
    {
        $this->room = $room;

        return $this;
    }
}
