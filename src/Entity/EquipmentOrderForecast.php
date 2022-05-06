<?php

namespace App\Entity;

use App\Repository\EquipmentOrderForecastRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipmentOrderForecastRepository::class)]
class EquipmentOrderForecast extends OrderForecast
{
    #[ORM\ManyToOne(targetEntity: Equipment::class, inversedBy: 'orderForecasts')]
    #[ORM\JoinColumn(nullable: false)]
    private Equipment $equipment;

    /**
     * @return Equipment
     */
    public function getEquipment(): Equipment
    {
        return $this->equipment;
    }

    /**
     * @param  Equipment  $equipment
     * @return EquipmentOrderForecast
     */
    public function setEquipment(Equipment $equipment): EquipmentOrderForecast
    {
        $this->equipment = $equipment;

        return $this;
    }
}
