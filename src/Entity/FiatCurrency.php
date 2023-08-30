<?php

namespace App\Entity;

use App\Repository\FiatCurrencyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FiatCurrencyRepository::class)]
class FiatCurrency
{
    public static string $KEY_USD = 'USD';
    public static string $KEY_EUR = 'EUR';
    public static string $KEY_AUD = 'AUD';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(length: 5)]
    private ?string $fixerKey = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 5)]
    private ?string $symbol = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $rates = null;

    #[ORM\OneToMany(mappedBy: 'favoriteFiatCurrency', targetEntity: User::class)]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
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

    public function getFixerKey(): ?string
    {
        return $this->fixerKey;
    }

    public function setFixerKey(string $fixerKey): static
    {
        $this->fixerKey = $fixerKey;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

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

    public function getRates(): ?array
    {
        return $this->rates;
    }

    public function setRates(?array $rates): static
    {
        $this->rates = $rates;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setFavoriteFiatCurrency($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getFavoriteFiatCurrency() === $this) {
                $user->setFavoriteFiatCurrency(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->libelle;
    }
}
