<?php

namespace App\Entity;

use App\Repository\WalletRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WalletRepository::class)]
class Wallet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $information = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeWallet $type = null;

    #[ORM\ManyToOne(inversedBy: 'wallets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    /**
     * Contient l'état du wallet, c'est à dire les cryptomonnaies qu'il contient et leur quantité
     */
    #[ORM\OneToMany(mappedBy: 'wallet', targetEntity: CoupleCryptocurrencyNbcoins::class)]
    private Collection $state;

    public function __construct()
    {
        $this->state = new ArrayCollection();
    }

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

    public function getInformation(): ?string
    {
        return $this->information;
    }

    public function setInformation(?string $information): static
    {
        $this->information = $information;

        return $this;
    }

    public function getType(): ?TypeWallet
    {
        return $this->type;
    }

    public function setType(?TypeWallet $type): static
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

    /**
     * @return Collection<int, CoupleCryptocurrencyNbcoins>
     */
    public function getState(): Collection
    {
        return $this->state;
    }

    public function addState(CoupleCryptocurrencyNbcoins $state): static
    {
        if (!$this->state->contains($state)) {
            $this->state->add($state);
            $state->setWallet($this);
        }

        return $this;
    }

    public function removeState(CoupleCryptocurrencyNbcoins $state): static
    {
        if ($this->state->removeElement($state)) {
            // set the owning side to null (unless already changed)
            if ($state->getWallet() === $this) {
                $state->setWallet(null);
            }
        }

        return $this;
    }
}
