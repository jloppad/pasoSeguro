<?php

namespace App\Controller\Admin;

use App\Entity\Usuario;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\HiddenField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UsuarioCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Usuario::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('apellidos','Apellidos'),
            TextField::new('nombre','Nombre'),
            TextField::new('userName', 'Nombre de Usuario'),
            TextField::new('password', 'Contraseña')->onlyOnForms(),
            BooleanField::new('docente', 'Docente'),
            BooleanField::new('conserje', 'Conserje'),
            BooleanField::new('admin', 'Admin'),
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
