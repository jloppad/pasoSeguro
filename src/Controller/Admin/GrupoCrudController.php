<?php

namespace App\Controller\Admin;

use App\Entity\Grupo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GrupoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Grupo::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('descripcion', 'Descripción'),
            AssociationField::new('cursoAcademico', 'Curso Académico'),
            AssociationField::new('docentes', 'Docentes')->autocomplete(),
            AssociationField::new('estudiantes', 'Estudiantes')->autocomplete(),
            AssociationField::new('registros', 'Registros')->autocomplete()
        ];
    }
}
