<?php

namespace App\Entity;

use App\Repository\LocalidadRepository;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass=LocalidadRepository::class)
 */
class Localidad implements JsonSerializable
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
     * @ORM\ManyToOne(targetEntity=Partido::class, inversedBy="localidads")
     * @ORM\JoinColumn(nullable=false)
     */
    private $partido;

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

    public function getPartido(): ?Partido
    {
        return $this->partido;
    }

    public function setPartido(?Partido $partido): self
    {
        $this->partido = $partido;

        return $this;
    }

    public function JsonSerialize(){     

        return [
        'id' => $this->getId(),   
      //  'partido'=> $this->getPartido(),
        'nombre' => $this->getNombre()    
        ];  
    }
}
