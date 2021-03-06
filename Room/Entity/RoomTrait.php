<?php

namespace Grr\Core\Room\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Grr\Core\Area\Entity\AreaFieldTrait;
use Grr\Core\Authorization\Entity\AuthorizationsFieldTrait;
use Grr\Core\Contrat\Entity\AreaInterface;
use Grr\Core\Contrat\Entity\Security\AuthorizationInterface;
use Grr\Core\Doctrine\Traits\IdEntityTrait;
use Grr\Core\Doctrine\Traits\NameEntityTrait;
use Grr\Core\Entry\Entity\EntriesFieldTrait;

/**
 * Room.
 */
trait RoomTrait
{
    use IdEntityTrait;
    use NameEntityTrait;
    use AreaFieldTrait;
    use AuthorizationsFieldTrait;
    use EntriesFieldTrait;

    #[ORM\Column(type: 'string', length: 60, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $capacity;

    #[ORM\Column(type: 'smallint', nullable: false)]
    private int $maximumBooking;

    #[ORM\Column(type: 'boolean')]
    private bool $statutRoom;

    #[ORM\Column(name: 'show_fic_room', type: 'boolean', nullable: false)]
    private bool $showFicRoom;

    #[ORM\Column(name: 'picture_room', type: 'string', length: 50, nullable: true)]
    private ?string $pictureRoom = null;

    #[ORM\Column(name: 'comment_room', type: 'text', length: 65535, nullable: true)]
    private ?string $commentRoom = null;

    #[ORM\Column(name: 'show_comment', type: 'boolean', nullable: false)]
    private bool $showComment;

    #[ORM\Column(name: 'delais_max_resa_room', type: 'smallint', nullable: false)]
    private int $delaisMaxResaRoom;

    #[ORM\Column(name: 'delais_min_resa_room', type: 'smallint', nullable: false)]
    private int $delaisMinResaRoom;

    #[ORM\Column(type: 'boolean', nullable: false)]
    private bool $allowActionInPast;

    #[ORM\Column(type: 'smallint', nullable: false)]
    private int $orderDisplay;

    #[ORM\Column(name: 'delais_option_reservation', type: 'smallint', nullable: false)]
    private int $delaisOptionReservation;

    #[ORM\Column(type: 'boolean', nullable: false)]
    private bool $dontAllowModify;

    #[ORM\Column(name: 'type_affichage_reser', type: 'smallint', nullable: false)]
    private int $typeAffichageReser;

    #[ORM\Column(name: 'moderate', type: 'boolean', nullable: true)]
    private ?bool $moderate = null;

    #[ORM\Column(name: 'qui_peut_reserver_pour', type: 'string', length: 1, nullable: false)]
    private string $quiPeutReserverPour;

    #[ORM\Column(type: 'boolean', nullable: false)]
    private bool $activeRessourceEmpruntee;

    #[ORM\Column(type: 'smallint', nullable: false)]
    private int $ruleToAdd;

    /**
     * Override pour mappedBy.
     *
     * @var AuthorizationInterface[]|Collection
     */
    #[ORM\OneToMany(targetEntity: AuthorizationInterface::class, mappedBy: 'room', orphanRemoval: true)]
    private iterable $authorizations;

    public function __construct(AreaInterface $area)
    {
        $this->area = $area;
        $this->capacity = 0;
        $this->statutRoom = false;
        $this->showFicRoom = false;
        $this->showComment = false;
        $this->delaisMaxResaRoom = 0;
        $this->delaisMinResaRoom = 0;
        $this->allowActionInPast = false;
        $this->moderate = false;
        $this->orderDisplay = 0;
        $this->delaisOptionReservation = 0;
        $this->dontAllowModify = false;
        $this->typeAffichageReser = 0;
        $this->quiPeutReserverPour = '';
        $this->activeRessourceEmpruntee = false;
        $this->ruleToAdd = 0;
        $this->maximumBooking = -1;
        $this->entries = new ArrayCollection();
        $this->authorizations = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): void
    {
        $this->capacity = $capacity;
    }

    public function getMaximumBooking(): ?int
    {
        return $this->maximumBooking;
    }

    public function setMaximumBooking(int $maximumBooking): void
    {
        $this->maximumBooking = $maximumBooking;
    }

    public function getStatutRoom(): ?bool
    {
        return $this->statutRoom;
    }

    public function setStatutRoom(bool $statutRoom): void
    {
        $this->statutRoom = $statutRoom;
    }

    public function getShowFicRoom(): ?bool
    {
        return $this->showFicRoom;
    }

    public function setShowFicRoom(bool $showFicRoom): void
    {
        $this->showFicRoom = $showFicRoom;
    }

    public function getPictureRoom(): ?string
    {
        return $this->pictureRoom;
    }

    public function setPictureRoom(?string $pictureRoom): void
    {
        $this->pictureRoom = $pictureRoom;
    }

    public function getCommentRoom(): ?string
    {
        return $this->commentRoom;
    }

    public function setCommentRoom(?string $commentRoom): void
    {
        $this->commentRoom = $commentRoom;
    }

    public function getShowComment(): ?bool
    {
        return $this->showComment;
    }

    public function setShowComment(bool $showComment): void
    {
        $this->showComment = $showComment;
    }

    public function getDelaisMaxResaRoom(): int
    {
        return $this->delaisMaxResaRoom;
    }

    public function setDelaisMaxResaRoom(int $delaisMaxResaRoom): void
    {
        $this->delaisMaxResaRoom = $delaisMaxResaRoom;
    }

    public function getDelaisMinResaRoom(): int
    {
        return $this->delaisMinResaRoom;
    }

    public function setDelaisMinResaRoom(int $delaisMinResaRoom): void
    {
        $this->delaisMinResaRoom = $delaisMinResaRoom;
    }

    public function getAllowActionInPast(): ?bool
    {
        return $this->allowActionInPast;
    }

    public function setAllowActionInPast(bool $allowActionInPast): void
    {
        $this->allowActionInPast = $allowActionInPast;
    }

    public function getOrderDisplay(): int
    {
        return $this->orderDisplay;
    }

    public function setOrderDisplay(int $orderDisplay): void
    {
        $this->orderDisplay = $orderDisplay;
    }

    public function getDelaisOptionReservation(): int
    {
        return $this->delaisOptionReservation;
    }

    public function setDelaisOptionReservation(int $delaisOptionReservation): void
    {
        $this->delaisOptionReservation = $delaisOptionReservation;
    }

    public function getDontAllowModify(): bool
    {
        return $this->dontAllowModify;
    }

    public function setDontAllowModify(bool $dontAllowModify): void
    {
        $this->dontAllowModify = $dontAllowModify;
    }

    public function getTypeAffichageReser(): int
    {
        return $this->typeAffichageReser;
    }

    public function setTypeAffichageReser(int $typeAffichageReser): void
    {
        $this->typeAffichageReser = $typeAffichageReser;
    }

    public function getModerate(): ?bool
    {
        return $this->moderate;
    }

    public function setModerate(?bool $moderate): void
    {
        $this->moderate = $moderate;
    }

    public function getQuiPeutReserverPour(): string
    {
        return $this->quiPeutReserverPour;
    }

    public function setQuiPeutReserverPour(string $quiPeutReserverPour): void
    {
        $this->quiPeutReserverPour = $quiPeutReserverPour;
    }

    public function getActiveRessourceEmpruntee(): ?bool
    {
        return $this->activeRessourceEmpruntee;
    }

    public function setActiveRessourceEmpruntee(bool $activeRessourceEmpruntee): void
    {
        $this->activeRessourceEmpruntee = $activeRessourceEmpruntee;
    }

    public function getRuleToAdd(): int
    {
        return $this->ruleToAdd;
    }

    public function setRuleToAdd(int $ruleToAdd): void
    {
        $this->ruleToAdd = $ruleToAdd;
    }
}
