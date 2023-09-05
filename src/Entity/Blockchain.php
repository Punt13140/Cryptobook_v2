<?php

namespace App\Entity;

use App\Repository\BlockchainRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlockchainRepository::class)]
class Blockchain
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'blockchain', targetEntity: Dapp::class)]
    private Collection $dapps;

    #[ORM\ManyToOne(inversedBy: 'blockchains')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cryptocurrency $coin = null;

    public function __construct()
    {
        $this->dapps = new ArrayCollection();
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

    /**
     * @return Collection<int, Dapp>
     */
    public function getDapps(): Collection
    {
        return $this->dapps;
    }

    public function addDapp(Dapp $dapp): static
    {
        if (!$this->dapps->contains($dapp)) {
            $this->dapps->add($dapp);
            $dapp->setBlockchain($this);
        }

        return $this;
    }

    public function removeDapp(Dapp $dapp): static
    {
        if ($this->dapps->removeElement($dapp)) {
            // set the owning side to null (unless already changed)
            if ($dapp->getBlockchain() === $this) {
                $dapp->setBlockchain(null);
            }
        }

        return $this;
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

    public function __toString(): string
    {
        return $this->libelle;
    }
}
