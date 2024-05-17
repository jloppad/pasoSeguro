<?php

namespace App\DataFixtures;

use App\Entity\CursoAcademico;
use App\Entity\Motivo;
use App\Factory\CursoAcademicoFactory;
use App\Factory\EstudianteFactory;
use App\Factory\GrupoFactory;
use App\Factory\LlaveFactory;
use App\Factory\MotivoFactory;
use App\Factory\RegistroFactory;
use App\Factory\UsuarioFactory;
use App\Repository\UsuarioRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $cursosAcademicos = [];
        $motivos = ['Baño','Conserjeria','Despacho','Otro'];
        date_default_timezone_set('Europe/Madrid');
        $hora = date('H:i:s');

        for ($i = 0; $i < 2; $i++) {
            $cursosAcademicos[] = CursoAcademicoFactory::createOne();
        }

        UsuarioFactory::createOne([
            'username' => 'chuck',
            'password' => 'norris',
            'admin' => true
        ]);
        UsuarioFactory::createOne([
            'username' => 'pepe',
            'password' => 'madrid',
            'conserje' => true
        ]);

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

        foreach ($motivos as $i => $motivo) {
            MotivoFactory::createOne([
                'descripcion' => $motivo,
                'numeroOrden' => $i
            ]);
        }

        RegistroFactory::createOne([
            $minutos_aleatorios = rand(5, 30),
            'horaSalida' => $hora,
            'horaEntrada' => date('H:i:s', strtotime("+$minutos_aleatorios minutes", strtotime($hora))),
            'responsable' => ,
            'estudiante' => ,
            'motivos' => ,
            'llave'

        ]);

        $manager->flush();
    }
}
