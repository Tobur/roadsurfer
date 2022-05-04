<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ApiResource(
    denormalizationContext: ['groups' => ['write']],
    normalizationContext: ['groups' => ['read']],
)]
class InventoryCampervan extends Inventory
{
    #[ORM\ManyToOne(targetEntity: Campervan::class, inversedBy: 'inventories')]
    #[Groups(["read", "write"])]
    #[Assert\NotBlank]
    private ?Campervan $campervan;

    #[ORM\OneToMany(mappedBy: 'campervanInventory', targetEntity: Order::class)]
    private Collection $orders;

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
        return $this->campervan;
    }

    /**
     * @param  Campervan|null  $campervan
     * @return InventoryCampervan
     */
    public function setCampervan(?Campervan $campervan): InventoryCampervan
    {
        $this->campervan = $campervan;

        return $this;
    }
}
