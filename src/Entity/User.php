<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: false)]
    private ?FiatCurrency $favoriteFiatCurrency = null;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Wallet::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $wallets;

    /**
     * Contient l'état des wallets de l'utilisateur, c'est à dire les cryptomonnaies qu'ils contiennent et leur quantité dans chaque wallet.
     */
    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: CoupleCryptocurrencyNbcoins::class, orphanRemoval: true)]
    private Collection $stateWallets;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Deposit::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $deposits;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Loan::class, orphanRemoval: true)]
    private Collection $loans;

    public function __construct()
    {
        $this->roles[] = 'ROLE_USER';
        $this->wallets = new ArrayCollection();
        $this->stateWallets = new ArrayCollection();
        $this->deposits = new ArrayCollection();
        $this->loans = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function addRole(string $role): static
    {
        if (!in_array($role, $this->roles)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Wallet>
     */
    public function getWallets(): Collection
    {
        return $this->wallets;
    }

    public function addWallet(Wallet $wallet): static
    {
        if (!$this->wallets->contains($wallet)) {
            $this->wallets->add($wallet);
            $wallet->setOwner($this);
        }

        return $this;
    }

    public function removeWallet(Wallet $wallet): static
    {
        if ($this->wallets->removeElement($wallet)) {
            // set the owning side to null (unless already changed)
            if ($wallet->getOwner() === $this) {
                $wallet->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CoupleCryptocurrencyNbcoins>
     */
    public function getStateWallets(): Collection
    {
        return $this->stateWallets;
    }

    public function addStateWallet(CoupleCryptocurrencyNbcoins $stateWallet): static
    {
        if (!$this->stateWallets->contains($stateWallet)) {
            $this->stateWallets->add($stateWallet);
            $stateWallet->setOwner($this);
        }

        return $this;
    }

    public function removeStateWallet(CoupleCryptocurrencyNbcoins $stateWallet): static
    {
        if ($this->stateWallets->removeElement($stateWallet)) {
            // set the owning side to null (unless already changed)
            if ($stateWallet->getOwner() === $this) {
                $stateWallet->setOwner(null);
            }
        }

        return $this;
    }

    public function getFavoriteFiatCurrency(): ?FiatCurrency
    {
        return $this->favoriteFiatCurrency;
    }

    public function setFavoriteFiatCurrency(?FiatCurrency $favoriteFiatCurrency): static
    {
        $this->favoriteFiatCurrency = $favoriteFiatCurrency;

        return $this;
    }

    /**
     * @return Collection<int, Deposit>
     */
    public function getDeposits(): Collection
    {
        return $this->deposits;
    }

    public function addDeposit(Deposit $deposit): static
    {
        if (!$this->deposits->contains($deposit)) {
            $this->deposits->add($deposit);
            $deposit->setOwner($this);
        }

        return $this;
    }

    public function removeDeposit(Deposit $deposit): static
    {
        if ($this->deposits->removeElement($deposit)) {
            // set the owning side to null (unless already changed)
            if ($deposit->getOwner() === $this) {
                $deposit->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Loan>
     */
    public function getLoans(): Collection
    {
        return $this->loans;
    }

    public function addLoan(Loan $loan): static
    {
        if (!$this->loans->contains($loan)) {
            $this->loans->add($loan);
            $loan->setOwner($this);
        }

        return $this;
    }

    public function removeLoan(Loan $loan): static
    {
        if ($this->loans->removeElement($loan)) {
            // set the owning side to null (unless already changed)
            if ($loan->getOwner() === $this) {
                $loan->setOwner(null);
            }
        }

        return $this;
    }
}
