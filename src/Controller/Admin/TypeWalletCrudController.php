<?php

namespace App\Controller\Admin;

use App\Entity\TypeWallet;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TypeWalletCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeWallet::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
