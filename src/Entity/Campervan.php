<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CampervanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CampervanRepository::class)]
#[ApiResource(
    denormalizationContext: ['groups' => ['write']],
    normalizationContext: ['groups' => ['read']],
)]
class Campervan
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["read"])]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 255)]
    #[Groups(["read", "write"])]
    private ?string $name;

    #[ORM\OneToMany(mappedBy: 'campervan', targetEntity: InventoryCampervan::class)]
    private Collection $inventories;

    #[ORM\OneToMany(mappedBy: 'campervan', targetEntity: CampervanOrderForecast::class)]
    private Collection $orderForecasts;

    public function __construct()
    {
        $this->inventories = new ArrayCollection();
        $this->orderForecasts = new ArrayCollection();
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

    /**
     * @return Collection
     */
    public function getInventories(): Collection
    {
        return $this->inventories;
    }

    /**
     * @param  InventoryCampervan  $inventory
     * @return $this
     */
    public function addInventory(InventoryCampervan $inventory): self
    {
        if (!$this->inventories->contains($inventory)) {
            $this->inventories[] = $inventory;
            $inventory->setCampervan($this);
        }

        return $this;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getOrderForecasts(): ArrayCollection|Collection
    {
        return $this->orderForecasts;
    }
}
