<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, [
                'label' => 'Nombre',
                'required' => true,
            ])
            ->add('apellidos', TextType::class, [
                'label' => 'Apellidos',
                'required' => true,
            ])
            ->add('userName', TextType::class, [
                'label' => 'Nombre de usuario',
                'required' => true,
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Contraseña',
                'required' => true,
            ])
            ->add('docente', CheckboxType::class, [
                'label' => '¿Es docente?',
                'required' => false,
            ])
            ->add('conserje', CheckboxType::class, [
                'label' => '¿Es conserje?',
                'required' => false,
            ])
            ->add('admin', CheckboxType::class, [
                'label' => '¿Es administrador?',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}
