<?php

namespace App\Form;

use App\Entity\Estudiante;
use App\Entity\Grupo;
use App\Entity\Llave;
use App\Entity\Motivo;
use App\Entity\Registro;
use App\Entity\Usuario;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('horaSalida', DateTimeType::class, [
                'label' => 'Hora de Salida',
                'widget' => 'single_text',
                'html5' => true,
                'required' => true,
            ])
            ->add('horaEntrada', DateTimeType::class, [
                'label' => 'Hora de Entrada',
                'widget' => 'single_text',
                'html5' => true,
                'required' => true,
            ])
            ->add('responsable', EntityType::class, [
                'class' => Usuario::class,
                'choice_label' => 'userName',
                'label' => 'Responsable',
                'required' => true,
            ])
            ->add('estudiante', EntityType::class, [
                'class' => Estudiante::class,
                'choice_label' => 'nombreCompleto',
                'label' => 'Estudiante',
                'required' => true,
            ])
            ->add('grupo', EntityType::class, [
                'class' => Grupo::class,
                'choice_label' => 'nombre',
                'label' => 'Grupo',
                'required' => true,
            ])
            ->add('llave', EntityType::class, [
                'class' => Llave::class,
                'choice_label' => 'nombre',
                'label' => 'Llave',
                'required' => false,
            ])
            ->add('motivos', EntityType::class, [
                'class' => Motivo::class,
                'choice_label' => 'nombre',
                'label' => 'Motivos',
                'multiple' => true,
                'expanded' => true,
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Registro::class,
        ]);
    }
}
