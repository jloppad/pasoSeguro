<?php

namespace App\Controller\Admin;

use App\Entity\Llave;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LlaveCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Llave::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('descripcion', 'Descripción'),
            DateTimeField::new('horaDejada', 'Hora Dejada')->setFormTypeOptions([
                'required' => true,
            ]),
            DateTimeField::new('horaDevuelta', 'Hora Devuelta')->setFormTypeOptions([
                'required' => true,
            ]),
            AssociationField::new('registro', 'Registro'),
        ];
    }
}
