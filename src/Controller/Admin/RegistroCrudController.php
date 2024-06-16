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
            AssociationField::new('estudiante', 'Estudiante')->hideOnForm(),
            AssociationField::new('grupo', 'Grupo'),
            AssociationField::new('responsable', 'Responsable'),
            AssociationField::new('llave', 'Llave'),
            AssociationField::new('motivos', 'Motivos')->formatValue(function ($value, $entity) {
                $motivos = $entity->getMotivos();
                $motivoDescriptions = [];
                foreach ($motivos as $motivo) {
                    $motivoDescriptions[] = $motivo->getDescripcion();
                }
                return implode(', ', $motivoDescriptions);
            }),
            DateTimeField::new('horaSalida', 'Salida'),
            DateTimeField::new('horaEntrada', 'Entrada'),
            TextField::new('duracion', 'Duración')
                ->onlyOnIndex()
                ->formatValue(function ($value, $entity) {
                    return $entity->getDuracion();
                }),
        ];
    }
}


