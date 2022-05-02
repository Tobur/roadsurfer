<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class InventoryCampervan extends Inventory
{
    #[ORM\ManyToOne(targetEntity: Campervan::class, inversedBy: 'inventory')]
    private ?Campervan $compervan;

    /**
     * @return Campervan|null
     */
    public function getCompervan(): ?Campervan
    {
        return $this->compervan;
    }

    /**
     * @param  Campervan|null  $compervan
     * @return InventoryCampervan
     */
    public function setCompervan(?Campervan $compervan): InventoryCampervan
    {
        $this->compervan = $compervan;

        return $this;
    }
}
