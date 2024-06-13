<?php

namespace App\Controller\Admin;

use App\Entity\Registro;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
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
            IdField::new('id')->hideOnForm(),
            AssociationField::new('estudiante', 'Estudiante'),
            AssociationField::new('grupo', 'Grupo'),
            AssociationField::new('responsable', 'Responsable'),
            AssociationField::new('llave', 'Llave'),
            AssociationField::new('motivos', 'Motivos'),
            DateTimeField::new('horaSalida', 'Hora de Salida'),
            DateTimeField::new('horaEntrada', 'Hora de Entrada'),
            TextField::new('duracion', 'Duración')
                ->onlyOnIndex()
                ->formatValue(function ($value, $entity) {
                    return $entity->getDuracion();
                }),
        ];
    }
}


