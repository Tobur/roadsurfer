<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\StationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: StationRepository::class)]
#[ApiResource(
    denormalizationContext: ['groups' => ['write']],
    normalizationContext: ['groups' => ['read']],
)]
class Station
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["read"])]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["read", "write"])]
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 255)]
    private ?string $name;

    #[ORM\OneToMany(mappedBy: 'station', targetEntity: Inventory::class)]
    private Collection $inventories;

    #[ORM\OneToMany(mappedBy: 'station', targetEntity: OrderForecast::class, orphanRemoval: true)]
    private Collection $orderForecasts;

    public function __construct()
    {
        $this->equipmentInventories = new ArrayCollection();
        $this->campervanInventories = new ArrayCollection();
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
     * @return Collection<int, OrderForecast>
     */
    public function getOrderForecasts(): Collection
    {
        return $this->orderForecasts;
    }

    public function addOrderForecast(OrderForecast $orderForecast): self
    {
        if (!$this->orderForecasts->contains($orderForecast)) {
            $this->orderForecasts[] = $orderForecast;
            $orderForecast->setStation($this);
        }

        return $this;
    }

    public function removeOrderForecast(OrderForecast $orderForecast): self
    {
        if ($this->orderForecasts->removeElement($orderForecast)) {
            // set the owning side to null (unless already changed)
            if ($orderForecast->getStation() === $this) {
                $orderForecast->setStation(null);
            }
        }

        return $this;
    }
}
