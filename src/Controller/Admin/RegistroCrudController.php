<?php

namespace App\Controller\Admin;

use App\Entity\Registro;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RegistroCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Registro::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            DateTimeField::new('horaSalida', 'Your Date/Time Label')
                ->setFormat('short', 'short'),
            DateTimeField::new('horaEntrada', 'Your Date/Time Label')
                ->setFormat('short', 'short'),
        ];
    }

}
