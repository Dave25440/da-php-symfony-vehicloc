<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id')]
    private ?int $id = null;

    #[Assert\NotBlank()]
    #[ORM\Column(name: 'name', length: 255)]
    private ?string $name = null;

    #[Assert\Length(min: 20)]
    #[Assert\NotBlank()]
    #[ORM\Column(name: 'description', type: Types::TEXT)]
    private ?string $description = null;

    #[Assert\NotBlank()]
    #[Assert\Positive]
    #[ORM\Column(name: 'monthly_price', type: 'decimal', precision: 8, scale: 2)]
    private ?string $monthlyPrice = null;

    #[Assert\LessThan(propertyPath: 'monthlyPrice')]
    #[Assert\NotBlank()]
    #[Assert\Positive]
    #[ORM\Column(name: 'daily_price', type: 'decimal', precision: 8, scale: 2)]
    private ?string $dailyPrice = null;

    #[Assert\NotBlank()]
    #[Assert\Range(min: 1, max: 9)]
    #[Assert\Type(type: 'integer')]
    #[ORM\Column(name: 'seat_number')]
    private ?int $seatNumber = null;

    #[Assert\NotNull]
    #[ORM\Column(name: 'manual_transmission')]
    private ?bool $manualTransmission = null;

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

    public function getMonthlyPrice(): ?string
    {
        return $this->monthlyPrice;
    }

    public function setMonthlyPrice(string $monthlyPrice): static
    {
        $this->monthlyPrice = $monthlyPrice;

        return $this;
    }

    public function getDailyPrice(): ?string
    {
        return $this->dailyPrice;
    }

    public function setDailyPrice(string $dailyPrice): static
    {
        $this->dailyPrice = $dailyPrice;

        return $this;
    }

    public function getSeatNumber(): ?int
    {
        return $this->seatNumber;
    }

    public function setSeatNumber(int $seatNumber): static
    {
        $this->seatNumber = $seatNumber;

        return $this;
    }

    public function getManualTransmission(): ?bool
    {
        return $this->manualTransmission;
    }

    public function setManualTransmission(bool $manualTransmission): static
    {
        $this->manualTransmission = $manualTransmission;

        return $this;
    }
}
