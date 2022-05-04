<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Enum\OrderStatus;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiProperty;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: "orders")]
#[ApiResource(
    denormalizationContext: ['groups' => ['write']],
    normalizationContext: ['groups' => ['read']],
)]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["read"])]
    private $id;

    #[ORM\Column(type: 'date')]
    #[Groups(["read", "write"])]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $rentalStartDate;

    #[ORM\Column(type: 'date')]
    #[Groups(["read", "write"])]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $rentalEndDate;

    #[ORM\ManyToOne(targetEntity: Station::class)]
    #[ORM\JoinColumn(name:"station_start_id", referencedColumnName:"id", nullable:false)]
    #[Groups(["read", "write"])]
    #[Assert\NotBlank]
    private Station $stationStart;

    #[ORM\ManyToOne(targetEntity: Station::class)]
    #[ORM\JoinColumn(name:"station_end_id", referencedColumnName:"id", nullable:true)]
    #[Groups(["read", "write"])]
    private ?Station $stationEnd;

    #[ORM\OneToMany(mappedBy: 'order',targetEntity: OrderEquipment::class)]
    #[Groups(["read", "write"])]
    private Collection $orderEquipments;

    #[ORM\Column(type: 'string', nullable: false, enumType: OrderStatus::class)]
    #[Groups(["read", "write"])]
    #[ApiProperty(
        attributes: [
            "openapi_context" => [
                "type" => "string",
                "enum" => ['pending', 'created', 'finished', 'cancel', 'error'],
                "example" => "pending",
            ],
        ],
    )]
    #[Assert\NotBlank]
    #[Assert\Type(type: OrderStatus::class, message: 'Choose either pending, created, finished, cancel, error')]
    private ?OrderStatus $status;

    #[ORM\ManyToOne(targetEntity: InventoryCampervan::class, inversedBy: 'orders')]
    #[Groups(["read", "write"])]
    private InventoryCampervan $campervanInventory;

    #[ORM\Column(type: 'string', nullable: true)]
    #[Groups(["read", "write"])]
    #[Assert\Length(max: 255)]
    private ?string $context;

    public function __construct()
    {
        $this->orderEquipments = new ArrayCollection();
    }

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

    /**
     * @return Station
     */
    public function getStationStart(): Station
    {
        return $this->stationStart;
    }

    /**
     * @param  Station  $stationStart
     * @return Order
     */
    public function setStationStart(Station $stationStart): Order
    {
        $this->stationStart = $stationStart;

        return $this;
    }

    /**
     * @return Station|null
     */
    public function getStationEnd(): ?Station
    {
        return $this->stationEnd;
    }

    /**
     * @param  Station|null  $stationEnd
     * @return Order
     */
    public function setStationEnd(?Station $stationEnd): Order
    {
        $this->stationEnd = $stationEnd;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getOrderEquipments(): Collection
    {
        return $this->orderEquipments;
    }

    /**
     * @param  Collection  $orderEquipments
     * @return Order
     */
    public function setOrderEquipments(Collection $orderEquipments): Order
    {
        $this->orderEquipments = $orderEquipments;

        return $this;
    }

    /**
     * @return OrderStatus|null
     */
    public function getStatus(): null|OrderStatus
    {
        return $this->status;
    }

    /**
     * @param  OrderStatus  $status
     * @return Order
     */
    public function setStatus(OrderStatus $status): Order
    {
        $this->status = $status;

        return  $this;
    }

    /**
     * @return InventoryCampervan
     */
    public function getCampervanInventory(): InventoryCampervan
    {
        return $this->campervanInventory;
    }

    /**
     * @param  InventoryCampervan  $campervanInventory
     * @return Order
     */
    public function setCampervanInventory(InventoryCampervan $campervanInventory): Order
    {
        $this->campervanInventory = $campervanInventory;

        return $this;
    }
}
