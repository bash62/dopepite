<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UsersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Users::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            ChoiceField::new("roles", "Roles")->setChoices([
                "Utilisateur" => "ROLE_USER", "Administrateur" => "ROLE_ADMIN"
            ])->allowMultipleChoices(),
            TextField::new('username', "Pseudo"),
 

        ];
    }
    
}
