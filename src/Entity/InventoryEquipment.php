<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class InventoryEquipment extends Inventory
{
    #[ORM\ManyToOne(targetEntity: Equipment::class, inversedBy: 'inventory')]
    private ?Equipment $equipment;

    #[ORM\OneToMany(mappedBy: 'inventory', targetEntity: OrderEquipment::class)]
    private ArrayCollection $orderEquipments;

    /**
     * @return Equipment|null
     */
    public function getEquipments(): ?Equipment
    {
        return $this->equipment;
    }

    /**
     * @param  Equipment|null  $equipment
     * @return InventoryEquipment
     */
    public function setEquipment(?Equipment $equipment): InventoryEquipment
    {
        $this->equipment = $equipment;

        return $this;
    }
}
