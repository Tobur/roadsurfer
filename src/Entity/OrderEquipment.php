<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrderEquipmentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OrderEquipmentRepository::class)]
#[ApiResource(
    denormalizationContext: ['groups' => ['write']],
    normalizationContext: ['groups' => ['read']],
)]
class OrderEquipment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["read"])]
    private $id;

    #[ORM\ManyToOne(targetEntity: InventoryEquipment::class, inversedBy: 'orderEquipments')]
    #[ORM\JoinColumn(name:"equipment_inventory_id", referencedColumnName:"id", nullable:false)]
    #[Groups(["read", "write"])]
    #[Assert\NotBlank]
    private InventoryEquipment $inventory;

    #[ORM\Column(type: 'integer')]
    #[Groups(["read", "write"])]
    #[Assert\NotBlank]
    #[Assert\Positive]
    private int $amount;

    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'orderEquipments')]
    #[ORM\JoinColumn(name:"order_id", referencedColumnName:"id", nullable:false)]
    #[Groups(["read", "write"])]
    #[Assert\NotBlank]
    private Order $order;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?int
    {
        return $this->фьamount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @param  Order  $order
     * @return OrderEquipment
     */
    public function setOrder(Order $order): OrderEquipment
    {
        $this->order = $order;

        return $this;
    }

    /**
     * @return InventoryEquipment
     */
    public function getInventory(): InventoryEquipment
    {
        return $this->inventory;
    }

    /**
     * @param  InventoryEquipment  $inventory
     * @return OrderEquipment
     */
    public function setInventory(InventoryEquipment $inventory): OrderEquipment
    {
        $this->inventory = $inventory;

        return $this;
    }
}
