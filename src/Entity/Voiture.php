<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    private ?string $description = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?float $monthly_price = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?float $dailly_price = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Range(
        min: 1,
        max: 9,
        notInRangeMessage: 'Le nombre de place doit être compris entre 1 et 9',
    )]
    private ?int $seats = null;

    #[ORM\Column]
    #[Assert\NotNull]
    private ?bool $gearbox_type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getMonthlyPrice(): ?float
    {
        return $this->monthly_price;
    }

    public function setMonthlyPrice(float $monthly_price): static
    {
        $this->monthly_price = $monthly_price;

        return $this;
    }

    public function getDaillyPrice(): ?float
    {
        return $this->dailly_price;
    }

    public function setDaillyPrice(float $dailly_price): static
    {
        $this->dailly_price = $dailly_price;

        return $this;
    }

    public function getSeats(): ?int
    {
        return $this->seats;
    }

    public function setSeats(int $seats): static
    {
        $this->seats = $seats;

        return $this;
    }

    public function isGearboxType(): ?bool
    {
        return $this->gearbox_type;
    }

    public function setGearboxType(bool $gearbox_type): static
    {
        $this->gearbox_type = $gearbox_type;

        return $this;
    }
}
