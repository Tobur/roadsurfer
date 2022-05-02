<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class InventoryEquipment extends Inventory
{
    #[ORM\ManyToOne(targetEntity: Equipment::class, inversedBy: 'inventory')]
    private ?Equipment $equipment;

    private $orderEquipment;
    /**
     * @return Equipment|null
     */
    public function getEquipment(): ?Equipment
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
