<?php

namespace App\Entity;

use App\Repository\ProvinciaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass=ProvinciaRepository::class)
 */
class Provincia implements JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity=Partido::class, mappedBy="provincia")
     */
    private $partidos;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $nacion_id;

    public function __construct()
    {
        $this->partidos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Partido[]
     */
    public function getPartidos(): Collection
    {
        return $this->partidos;
    }

    public function addPartido(Partido $partido): self
    {
        if (!$this->partidos->contains($partido)) {
            $this->partidos[] = $partido;
            $partido->setProvincia($this);
        }

        return $this;
    }

    public function removePartido(Partido $partido): self
    {
        if ($this->partidos->contains($partido)) {
            $this->partidos->removeElement($partido);
            // set the owning side to null (unless already changed)
            if ($partido->getProvincia() === $this) {
                $partido->setProvincia(null);
            }
        }

        return $this;
    }

    public function JsonSerialize(){     

        return [
        'id' => $this->getId(),    
        'nombre' => $this->getNombre()    
        ];  
    }

    public function getNacionId(): ?string
    {
        return $this->nacion_id;
    }

    public function setNacionId(?string $nacion_id): self
    {
        $this->nacion_id = $nacion_id;

        return $this;
    }
}
