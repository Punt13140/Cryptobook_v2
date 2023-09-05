<?php

namespace App\Service;

use App\Entity\TypeWallet;
use App\Entity\User;
use App\Entity\Wallet;
use App\Repository\TypeWalletRepository;

class UserService
{
    public function __construct(
        private readonly TypeWalletRepository $typeWalletRepository,
    )
    {
    }

    /**
     * Default wallets for a new user, during setup phase.
     * @param User $user
     * @return User
     */
    public function setupUserDefaultWallets(User $user): User
    {
        if (in_array('ROLE_SETUP_OK', $user->getRoles())) {
            return $user;
        }

        $hardware = $this->typeWalletRepository->findOneBy(['id' => TypeWallet::$HARDWARE]);
        $software = $this->typeWalletRepository->findOneBy(['id' => TypeWallet::$SOFTWARE]);
        $exchange = $this->typeWalletRepository->findOneBy(['id' => TypeWallet::$EXCHANGE]);

        $mainWallet = new Wallet();
        $mainWallet
            ->setLibelle('Main wallet')
            ->setType($hardware);
        $user->addWallet($mainWallet);

        $softwareWallet = new Wallet();
        $softwareWallet
            ->setLibelle('Burner')
            ->setType($software);
        $user->addWallet($softwareWallet);

        $exchangeWallet = new Wallet();
        $exchangeWallet
            ->setLibelle('Binance Account')
            ->setType($exchange);
        $user->addWallet($exchangeWallet);

        return $user;
    }
}