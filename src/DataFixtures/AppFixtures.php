<?php

namespace App\DataFixtures;

use App\Entity\CursoAcademico;
use App\Factory\CursoAcademicoFactory;
use App\Factory\EstudianteFactory;
use App\Factory\GrupoFactory;
use App\Factory\UsuarioFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $cursosAcademicos = [];

        for ($i = 0; $i < 2; $i++) {
            $cursosAcademicos[] = CursoAcademicoFactory::createOne();
        }

        UsuarioFactory::createOne([
            'username' => 'chuck',
            'password' => 'norris',
            'admin' => true
        ]);
        UsuarioFactory::createMany(1, function (){
                return [
                    'username' => 'pepe',
                    'password' => 'madrid',
                    'conserje' => true
                ];
            });

        foreach ($cursosAcademicos as $cursoAcademico) {
            GrupoFactory::createMany(8, function () use ($cursoAcademico) {
                static $letra = 'A';
                static $count = 1;

                $oldLetra = $letra;
                $oldCount = $count;

                if ($letra == 'B') {
                    $letra = 'A';
                    $count++;
                } else {
                    $letra = 'B';
                }

                return [
                    'descripcion' => $oldCount . "ºESO " . $oldLetra,
                    'cursoAcademico' => $cursoAcademico,
                    'estudiantes' => EstudianteFactory::createMany(5),
                    'docentes' => UsuarioFactory::createMany(2, function (){
                        return [
                            'docente' => true
                        ];
                    })
                ];
            });
        }

        $manager->flush();
    }
}
