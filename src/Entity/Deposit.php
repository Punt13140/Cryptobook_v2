<?php

namespace App\Entity;

use App\Repository\DepositRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepositRepository::class)]
class Deposit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $depositedAt = null;

    #[ORM\ManyToOne(inversedBy: 'deposits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?DepositType $type = null;

    #[ORM\ManyToOne(inversedBy: 'deposits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    #[ORM\Column]
    private ?float $amount = null;

    #[ORM\ManyToOne(inversedBy: 'deposits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Exchange $exchange = null;

    #[ORM\ManyToOne(inversedBy: 'deposits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?FiatCurrency $fiatCurrency = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepositedAt(): ?\DateTimeImmutable
    {
        return $this->depositedAt;
    }

    public function setDepositedAt(?\DateTimeImmutable $depositedAt): static
    {
        $this->depositedAt = $depositedAt;

        return $this;
    }

    public function getType(): ?DepositType
    {
        return $this->type;
    }

    public function setType(?DepositType $type): static
    {
        $this->type = $type;

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

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getExchange(): ?Exchange
    {
        return $this->exchange;
    }

    public function setExchange(?Exchange $exchange): static
    {
        $this->exchange = $exchange;

        return $this;
    }

    public function getFiatCurrency(): ?FiatCurrency
    {
        return $this->fiatCurrency;
    }

    public function setFiatCurrency(?FiatCurrency $fiatCurrency): static
    {
        $this->fiatCurrency = $fiatCurrency;

        return $this;
    }
}
