<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class InventoryCampervan extends Inventory
{
    #[ORM\ManyToOne(targetEntity: Campervan::class, inversedBy: 'inventories')]
    private ?Campervan $campervan;

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
