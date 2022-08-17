<?php

declare(strict_types=1);

namespace App\Storage\Entity;

use App\Domain\Gender;
use App\Domain\TeamAgeCategory;
use App\Domain\TeamJuniorAge;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Team extends AbstractEntity
{
    #[ORM\Column(type: Types::STRING)]
    private string $name;

    #[ORM\Column(type: Types::STRING, enumType: Gender::class)]
    private Gender $gender;

    #[ORM\Column(type: Types::STRING, nullable: true, enumType: TeamAgeCategory::class)]
    private TeamAgeCategory $ageCategory;

    #[ORM\Column(type: Types::STRING, nullable: true, enumType: TeamJuniorAge::class)]
    private ?TeamJuniorAge $juniorAge = null;

    #[ORM\OneToOne(targetEntity: File::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ?File $image = null;

    #[ORM\OneToMany(mappedBy: 'team', targetEntity: Player::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $players;

    #[ORM\OneToMany(mappedBy: 'team', targetEntity: Staff::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $staffs;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $facebook = null;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $instagram = null;

    public function __construct(
        //        string $name,
        //        Gender $gender,
        //        TeamAgeCategory $ageCategory,
    ) {
//        $this->name        = $name;
//        $this->gender      = $gender;
//        $this->ageCategory = $ageCategory;

        $this->players = new ArrayCollection();
        $this->staffs  = new ArrayCollection();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getGender(): Gender
    {
        return $this->gender;
    }

    public function setGender(Gender $gender): void
    {
        $this->gender = $gender;
    }

    public function getAgeCategory(): TeamAgeCategory
    {
        return $this->ageCategory;
    }

    public function setAgeCategory(TeamAgeCategory $ageCategory): void
    {
        $this->ageCategory = $ageCategory;
    }

    public function getJuniorAge(): ?TeamJuniorAge
    {
        return $this->juniorAge;
    }

    public function setJuniorAge(?TeamJuniorAge $juniorAge): void
    {
        $this->juniorAge = $juniorAge;
    }

    public function getImage(): ?File
    {
        return $this->image;
    }

    public function setImage(?File $image): void
    {
        $this->image = $image;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): void
    {
        $this->facebook = $facebook;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(?string $instagram): void
    {
        $this->instagram = $instagram;
    }

    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player): void
    {
        if ($this->players->contains($player)) {
            return;
        }

        $player->setTeam($this);
        $this->players->add($player);
    }

    public function removePlayer(Player $player): void
    {
        if (! $this->players->contains($player)) {
            return;
        }

        $this->players->removeElement($player);
    }

    public function getStaffs(): Collection
    {
        return $this->staffs;
    }

    public function addStaff(Staff $staff): void
    {
        if ($this->staffs->contains($staff)) {
            return;
        }

        $staff->setTeam($this);
        $this->staffs->add($staff);
    }

    public function removeStaff(Staff $staff): void
    {
        if (! $this->staffs->contains($staff)) {
            return;
        }

        $this->staffs->removeElement($staff);
    }
}
