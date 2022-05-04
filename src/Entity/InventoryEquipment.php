<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ApiResource(
    denormalizationContext: ['groups' => ['write']],
    normalizationContext: ['groups' => ['read']],
)]
class InventoryEquipment extends Inventory
{
    #[ORM\ManyToOne(targetEntity: Equipment::class, inversedBy: 'inventories')]
    #[Assert\NotBlank]
    #[Groups(["read", "write"])]
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
