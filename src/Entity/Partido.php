<?php

namespace App\Entity;

use App\Repository\PartidoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PartidoRepository::class)
 */
class Partido
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
     * @ORM\ManyToOne(targetEntity=Provincia::class, inversedBy="partidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $provincia;

    /**
     * @ORM\OneToMany(targetEntity=Localidad::class, mappedBy="partido")
     */
    private $localidads;

    public function __construct()
    {
        $this->localidads = new ArrayCollection();
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

    public function getProvincia(): ?Provincia
    {
        return $this->provincia;
    }

    public function setProvincia(?Provincia $provincia): self
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * @return Collection|Localidad[]
     */
    public function getLocalidads(): Collection
    {
        return $this->localidads;
    }

    public function addLocalidad(Localidad $localidad): self
    {
        if (!$this->localidads->contains($localidad)) {
            $this->localidads[] = $localidad;
            $localidad->setPartido($this);
        }

        return $this;
    }

    public function removeLocalidad(Localidad $localidad): self
    {
        if ($this->localidads->contains($localidad)) {
            $this->localidads->removeElement($localidad);
            // set the owning side to null (unless already changed)
            if ($localidad->getPartido() === $this) {
                $localidad->setPartido(null);
            }
        }

        return $this;
    }
}