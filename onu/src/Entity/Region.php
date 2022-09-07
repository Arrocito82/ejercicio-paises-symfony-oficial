<?php

namespace App\Entity;
use App\Repository\RegionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegionRepository::class)]
class Region
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $codigo = null;

    #[ORM\Column(length: 25)]
    private ?string $nombre = null;

    #[ORM\OneToMany(mappedBy: 'region', targetEntity: Pais::class)]
    private Collection $pais;

    public function __construct()
    {
        $this->pais = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodigo(): ?int
    {
        return $this->codigo;
    }

    public function setCodigo(int $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    // /**
    //  * @return Collection<int, Pais>
    //  */
    // public function getPaises(): ?Collection
    // {
    //     return $this->pais;
    // }
 
    public function addPais(Pais $pais): self
    {
        if (!$this->pais->contains($pais)) {
            $this->pais->add($pais);
            $pais->setRegion($this);
        }

        return $this;
    }

    public function removePais(Pais $pais): self
    {
        if ($this->pais->removeElement($pais)) {
            // set the owning side to null (unless already changed)
            if ($pais->getRegion() === $this) {
                $pais->setRegion(null);
            }
        }

        return $this;
    }
}
