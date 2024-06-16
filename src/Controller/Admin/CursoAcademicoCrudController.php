<?php

namespace App\Controller\Admin;

use App\Entity\CursoAcademico;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CursoAcademicoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CursoAcademico::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('descripcion', 'Descripción'),
            DateField::new('fechaInicio', 'Fecha de Inicio'),
            DateField::new('fechaFinal', 'Fecha Final'),
            AssociationField::new('grupos', 'Grupos')->autocomplete(),
        ];
    }
}

