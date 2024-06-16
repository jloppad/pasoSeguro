<?php

namespace App\Controller\Admin;

use App\Entity\Estudiante;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EstudianteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Estudiante::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('apellidos','Apellidos'),
            TextField::new('nombre','Nombre'),
            TextField::new('foto','Foto')->onlyOnForms(),
            IntegerField::new('nie', 'NIE'),
            AssociationField::new('grupos', 'Grupos')->formatValue(function ($value, $entity) {
                $grupos = $entity->getGrupos();
                $gruposDescriptions = [];
                foreach ($grupos as $grupo) {
                    $gruposDescriptions[] = $grupo->getDescripcion();
                }
                return implode(', ', $gruposDescriptions);
            }),
            AssociationField::new('registros', 'Registros'),
        ];
    }

}
