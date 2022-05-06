<?php

namespace App\Entity;

use App\Repository\EquipmentOrderForecastRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap(['campervan' => CampervanOrderForecast::class, 'equipment' => EquipmentOrderForecast::class])]
abstract class OrderForecast
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Station::class, inversedBy: 'orderForecasts')]
    #[ORM\JoinColumn(nullable: false)]
    private Station $station;

    #[ORM\Column(type: 'date')]
    private \DateTimeInterface $rentalDate;

    #[ORM\Column(type: 'float')]
    private float $expectedAmount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStation(): ?Station
    {
        return $this->station;
    }

    public function setStation(?Station $station): self
    {
        $this->station = $station;

        return $this;
    }

    public function getRentalDate(): ?\DateTimeInterface
    {
        return $this->rentalDate;
    }

    public function setRentalDate(\DateTimeInterface $rentalDate): self
    {
        $this->rentalDate = $rentalDate;

        return $this;
    }

    /**
     * @return float
     */
    public function getExpectedAmount(): float
    {
        return $this->expectedAmount;
    }

    /**
     * @param  float  $expectedAmount
     * @return OrderForecast
     */
    public function setExpectedAmount(float $expectedAmount): OrderForecast
    {
        $this->expectedAmount = $expectedAmount;

        return $this;
    }
}
