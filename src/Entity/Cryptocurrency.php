<?php

namespace App\Entity;

use App\Repository\CryptocurrencyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CryptocurrencyRepository::class)]
class Cryptocurrency
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(length: 255)]
    private ?string $libelleCoingecko = null;

    #[ORM\Column]
    private ?float $priceUsd = null;

    #[ORM\Column]
    private ?float $mcapUsd = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $urlImgThumb = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $urlImgSmall = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $urlImgLarge = null;

    #[ORM\Column(length: 8)]
    private ?string $symbol = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $color = null;

    #[ORM\Column]
    private ?bool $isStable = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getLibelleCoingecko(): ?string
    {
        return $this->libelleCoingecko;
    }

    public function setLibelleCoingecko(string $libelleCoingecko): static
    {
        $this->libelleCoingecko = $libelleCoingecko;

        return $this;
    }

    public function getPriceUsd(): ?float
    {
        return $this->priceUsd;
    }

    public function setPriceUsd(float $priceUsd): static
    {
        $this->priceUsd = $priceUsd;

        return $this;
    }

    public function getMcapUsd(): ?float
    {
        return $this->mcapUsd;
    }

    public function setMcapUsd(float $mcapUsd): static
    {
        $this->mcapUsd = $mcapUsd;

        return $this;
    }

    public function getUrlImgThumb(): ?string
    {
        return $this->urlImgThumb;
    }

    public function setUrlImgThumb(?string $urlImgThumb): static
    {
        $this->urlImgThumb = $urlImgThumb;

        return $this;
    }

    public function getUrlImgSmall(): ?string
    {
        return $this->urlImgSmall;
    }

    public function setUrlImgSmall(?string $urlImgSmall): static
    {
        $this->urlImgSmall = $urlImgSmall;

        return $this;
    }

    public function getUrlImgLarge(): ?string
    {
        return $this->urlImgLarge;
    }

    public function setUrlImgLarge(?string $urlImgLarge): static
    {
        $this->urlImgLarge = $urlImgLarge;

        return $this;
    }

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): static
    {
        $this->symbol = $symbol;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function isIsStable(): ?bool
    {
        return $this->isStable;
    }

    public function setIsStable(bool $isStable): static
    {
        $this->isStable = $isStable;

        return $this;
    }
}
