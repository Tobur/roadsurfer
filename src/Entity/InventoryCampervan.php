<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class InventoryCampervan extends Inventory
{
    #[ORM\ManyToOne(targetEntity: Campervan::class, inversedBy: 'inventories')]
    private ?Campervan $campervan;

    #[ORM\OneToMany(mappedBy: 'campervanInventory', targetEntity: Order::class)]
    private ArrayCollection $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getOrders(): ArrayCollection
    {
        return $this->orders;
    }

    /**
     * @return Campervan|null
     */
    public function getCampervan(): ?Campervan
    {
        return $this->compervan;
    }

    /**
     * @param  Campervan|null  $campervan
     * @return InventoryCampervan
     */
    public function setCampervan(?Campervan $campervan): InventoryCampervan
    {
        $this->compervan = $campervan;

        return $this;
    }
}
