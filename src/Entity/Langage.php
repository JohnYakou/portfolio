<?php

namespace App\Entity;

use App\Repository\LangageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LangageRepository::class)
 */
class Langage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $langage;

    // /**
    //  * @ORM\Column(type="string", length=255)
    //  */
    // private $niveau;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $logo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLangage(): ?string
    {
        return $this->langage;
    }

    public function setLangage(string $langage): self
    {
        $this->langage = $langage;

        return $this;
    }

    // public function getNiveau(): ?string
    // {
    //     return $this->niveau;
    // }

    // public function setNiveau(string $niveau): self
    // {
    //     $this->niveau = $niveau;

    //     return $this;
    // }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }
}
