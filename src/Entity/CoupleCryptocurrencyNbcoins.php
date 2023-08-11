<?php

namespace App\Entity;

use App\Repository\CoupleCryptocurrencyNbcoinsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoupleCryptocurrencyNbcoinsRepository::class)]
class CoupleCryptocurrencyNbcoins
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cryptocurrency $coin = null;

    #[ORM\Column]
    private ?float $nbCoins = null;

    #[ORM\ManyToOne(inversedBy: 'stateWallets')]
    private ?User $owner = null;

    #[ORM\ManyToOne(inversedBy: 'state')]
    private ?Wallet $wallet = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCoin(): ?Cryptocurrency
    {
        return $this->coin;
    }

    public function setCoin(?Cryptocurrency $coin): static
    {
        $this->coin = $coin;

        return $this;
    }

    public function getNbCoins(): ?float
    {
        return $this->nbCoins;
    }

    public function setNbCoins(float $nbCoins): static
    {
        $this->nbCoins = $nbCoins;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    public function getWallet(): ?Wallet
    {
        return $this->wallet;
    }

    public function setWallet(?Wallet $wallet): static
    {
        $this->wallet = $wallet;

        return $this;
    }
}
