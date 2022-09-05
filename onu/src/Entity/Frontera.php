<?php

namespace App\Entity;

use App\Repository\FronteraRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FronteraRepository::class)]
class Frontera
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?Pais $codigoPaisFrontera = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pais $codigoPaisOrigen = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodigoPaisFrontera(): ?Pais
    {
        return $this->codigoPaisFrontera;
    }

    public function setCodigoPaisFrontera(?Pais $codigoPaisFrontera): self
    {
        $this->codigoPaisFrontera = $codigoPaisFrontera;

        return $this;
    }

    public function getCodigoPaisOrigen(): ?Pais
    {
        return $this->codigoPaisOrigen;
    }

    public function setCodigoPaisOrigen(?Pais $codigoPaisOrigen): self
    {
        $this->codigoPaisOrigen = $codigoPaisOrigen;

        return $this;
    }
}
