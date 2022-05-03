<?php

namespace App\Entity;

use App\Repository\EquipmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipmentRepository::class)]
class Equipment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name;

    #[ORM\OneToMany(mappedBy: 'equipment', targetEntity: InventoryEquipment::class)]
    private Collection $inventories;

    public function __construct()
    {
        $this->inventories = new ArrayCollection();
    }

    /**
     * @param  InventoryEquipment  $inventory
     * @return $this
     */
    public function addInventory(InventoryEquipment $inventory): self
    {
        if (!$this->inventories->contains($inventory)) {
            $this->inventories[] = $inventory;
            $inventory->setEquipment($this);
        }

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getInventories(): ArrayCollection
    {
        return $this->inventories;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
