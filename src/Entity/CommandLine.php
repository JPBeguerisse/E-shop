<?php

namespace App\Entity;

use App\Repository\CommandLineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandLineRepository::class)]
class CommandLine
{
    // #[ORM\Id]
    // #[ORM\GeneratedValue]
    // #[ORM\Column]
    // private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'commandLines')]
    private ?Orders $oders = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'commandLines')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Products $product = null;

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getOders(): ?Orders
    {
        return $this->oders;
    }

    public function setOders(?Orders $oders): static
    {
        $this->oders = $oders;

        return $this;
    }

    public function getProduct(): ?Products
    {
        return $this->product;
    }

    public function setProduct(?Products $product): static
    {
        $this->product = $product;

        return $this;
    }
}
