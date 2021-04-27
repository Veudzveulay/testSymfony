<?php

namespace App\Entity;

use App\Repository\MonkeyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MonkeyRepository::class)
 */
class Monkey
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
    private $monkey;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMonkey(): ?string
    {
        return $this->monkey;
    }

    public function setMonkey(string $monkey): self
    {
        $this->monkey = $monkey;

        return $this;
    }
}
