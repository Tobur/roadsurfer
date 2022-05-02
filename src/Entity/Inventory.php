<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\InventoryRepository;

#[ORM\Entity(repositoryClass: InventoryRepository::class)]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap(['campervan' => InventoryCampervan::class, 'equipment' => InventoryEquipment::class])]
class Inventory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private ?string $sku;

    #[ORM\ManyToOne(targetEntity: Station::class, inversedBy: 'station')]
    private ?Station $station;

    #[ORM\Column(type: 'string', length: 50)]
    private string $type;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getSku(): ?string
    {
        return $this->sku;
    }

    /**
     * @param  string|null  $sku
     * @return Inventory
     */
    public function setSku(?string $sku): Inventory
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * @return Station|null
     */
    public function getStation(): ?Station
    {
        return $this->station;
    }

    /**
     * @param  Station|null  $station
     * @return Inventory
     */
    public function setStation(?Station $station): Inventory
    {
        $this->station = $station;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param  string  $type
     * @return Inventory
     */
    public function setType(string $type): Inventory
    {
        $this->type = $type;

        return $this;
    }
}
