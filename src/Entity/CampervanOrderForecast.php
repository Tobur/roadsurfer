<?php

namespace App\Entity;

use App\Repository\CampervanOrderForecastRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CampervanOrderForecastRepository::class)]
class CampervanOrderForecast extends OrderForecast
{
    #[ORM\ManyToOne(targetEntity: Campervan::class, inversedBy: 'orderForecasts')]
    #[ORM\JoinColumn(nullable: false)]
    private Campervan $campervan;

    /**
     * @return Campervan
     */
    public function getCampervan(): Campervan
    {
        return $this->campervan;
    }

    /**
     * @param  Campervan  $campervan
     * @return CampervanOrderForecast
     */
    public function setCampervan(Campervan $campervan): CampervanOrderForecast
    {
        $this->campervan = $campervan;

        return $this;
    }
}
