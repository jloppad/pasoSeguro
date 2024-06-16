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
            AssociationField::new('estudiante', 'Estudiante')->setFormTypeOptions([
                'required' => true,
            ]),
            AssociationField::new('grupo', 'Grupo')->setFormTypeOptions([
                'required' => true,
            ]),
            AssociationField::new('responsable', 'Responsable')->setFormTypeOptions([
                'required' => true,
            ]),
            AssociationField::new('llave', 'Llave'),
            AssociationField::new('motivos', 'Motivos')->setFormTypeOptions([
                'required' => true,
            ])
                ->formatValue(function ($value, $entity) {
                $motivos = $entity->getMotivos();
                $motivoDescriptions = [];
                foreach ($motivos as $motivo) {
                    $motivoDescriptions[] = $motivo->getDescripcion();
                }
                return implode(', ', $motivoDescriptions);
            }),
            DateTimeField::new('horaSalida', 'Salida')->setFormTypeOptions([
                'required' => true,
            ]),
            DateTimeField::new('horaEntrada', 'Entrada')->setFormTypeOptions([
                'required' => true,
            ]),
            TextField::new('duracion', 'Duración')
                ->onlyOnIndex()
                ->formatValue(function ($value, $entity) {
                    return $entity->getDuracion();
                }),
        ];
    }
}


