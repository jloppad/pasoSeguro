<?php

namespace App\DataFixtures;

use App\Factory\CursoAcademicoFactory;
use App\Factory\EstudianteFactory;
use App\Factory\UsuarioFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        // Personas
            EstudianteFactory::createMany(10);
            UsuarioFactory::createMany(5, function (){
                return [
                    'docente' => true
                ];
            });
            UsuarioFactory::createMany(1, function (){
                return [
                    'username' => 'chuck',
                    'password' => 'norris',
                    'admin' => true
                ];
            });
            UsuarioFactory::createMany(1, function (){
                return [
                    'username' => 'pepe',
                    'password' => 'madrid',
                    'conserje' => true
                ];
            });
        // Grupos
            CursoAcademicoFactory::createMany(5);

        $manager->flush();
    }
}
