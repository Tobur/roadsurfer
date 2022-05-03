<?php

namespace App\Entity;

use App\Enum\OrderStatus;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $rentalStartDate;

    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $rentalEndDate;

    #[ORM\ManyToOne(targetEntity: Station::class)]
    #[ORM\JoinColumn(name:"station_start_id", referencedColumnName:"id", nullable:false)]
    private Station $stationStart;

    #[ORM\ManyToOne(targetEntity: Station::class)]
    #[ORM\JoinColumn(name:"station_end_id", referencedColumnName:"id", nullable:true)]
    private ?Station $stationEnd;

    #[ORM\OneToMany(mappedBy: 'order',targetEntity: OrderEquipment::class)]
    private ArrayCollection $orderEquipments;

    #[ORM\Column(type: 'string', nullable: false, enumType: OrderStatus::class)]
    private ?string $status;

    #[ORM\ManyToOne(targetEntity: InventoryCampervan::class, inversedBy: 'orders')]
    private InventoryCampervan $campervanInventory;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRentalStartDate(): ?\DateTimeInterface
    {
        return $this->rentalStartDate;
    }

    public function setRentalStartDate(\DateTimeInterface $rentalStartDate): self
    {
        $this->rentalStartDate = $rentalStartDate;

        return $this;
    }

    public function getRentalEndDate(): ?\DateTimeInterface
    {
        return $this->rentalEndDate;
    }

    public function setRentalEndDate(\DateTimeInterface $rentalEndDate): self
    {
        $this->rentalEndDate = $rentalEndDate;

        return $this;
    }
}
