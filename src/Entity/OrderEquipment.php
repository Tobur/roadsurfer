<?php

namespace App\Entity;

use App\Repository\OrderEquipmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderEquipmentRepository::class)]
class OrderEquipment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(mappedBy: 'orderEquipment', targetEntity: InventoryEquipment::class)]
    private $inventory;

    #[ORM\Column(type: 'integer')]
    private $amount;

    #[ORM\ManyToOne(targetEntity: Order::class,inversedBy: 'orderEquipments')]
    private Order $order;

    public function __construct()
    {
        $this->inventory = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, InventoryCampervan>
     */
    public function getInventory(): Collection
    {
        return $this->inventory;
    }

    public function addInventory(InventoryCampervan $inventory): self
    {
        if (!$this->inventory->contains($inventory)) {
            $this->inventory[] = $inventory;
            $inventory->setOrderEquipment($this);
        }

        return $this;
    }

    public function removeInventory(InventoryCampervan $inventory): self
    {
        if ($this->inventory->removeElement($inventory)) {
            // set the owning side to null (unless already changed)
            if ($inventory->getOrderEquipment() === $this) {
                $inventory->setOrderEquipment(null);
            }
        }

        return $this;
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
}
