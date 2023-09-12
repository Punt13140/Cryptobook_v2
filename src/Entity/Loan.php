<?php

namespace App\Entity;

use App\Entity\Trait\DescriptionTrait;
use App\Repository\LoanRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoanRepository::class)]
class Loan extends OwnedByUser
{
    use DescriptionTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'loans')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cryptocurrency $coin = null;

    #[ORM\Column]
    private ?float $nbCoins = null;

    #[ORM\ManyToOne(inversedBy: 'loans')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Dapp $dapp = null;

    private ?Blockchain $blockchain = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $loanedAt = null;

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

    public function getDapp(): ?Dapp
    {
        return $this->dapp;
    }

    public function setDapp(?Dapp $dapp): static
    {
        $this->dapp = $dapp;

        return $this;
    }

    public function getLoanedAt(): ?\DateTimeImmutable
    {
        return $this->loanedAt;
    }

    public function setLoanedAt(?\DateTimeImmutable $loanedAt): static
    {
        $this->loanedAt = $loanedAt;

        return $this;
    }

    public function getBlockchain(): ?Blockchain
    {
        if (null === $this->blockchain && null !== $this->dapp && $this->dapp->getBlockchain() !== $this->blockchain) {
            $this->blockchain = $this->dapp->getBlockchain();
        }

        return $this->blockchain;
    }

    public function setBlockchain(?Blockchain $blockchain): self
    {
        $this->blockchain = $blockchain;

        return $this;
    }
}
