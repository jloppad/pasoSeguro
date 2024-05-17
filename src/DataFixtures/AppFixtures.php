<?php

namespace App\DataFixtures;

use App\Entity\Usuario;
use App\Factory\CursoAcademicoFactory;
use App\Factory\EstudianteFactory;
use App\Factory\GrupoFactory;
use App\Factory\LlaveFactory;
use App\Factory\MotivoFactory;
use App\Factory\RegistroFactory;
use App\Factory\UsuarioFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {

        $cursosAcademicos = [];
        $motivos = ['Baño','Conserjeria','Despacho','Otro'];
        date_default_timezone_set('Europe/Madrid');
        $hora = new \DateTime(date('H:i:s'));

        for ($i = 0; $i < 2; $i++) {
            $cursosAcademicos[] = CursoAcademicoFactory::createOne();
        }

        UsuarioFactory::createOne([
            'username' => 'chuck',
            'password' => $this->passwordHasher->hashPassword(
                new Usuario(),
                'norris'
            ),
            'admin' => true
        ]);
        UsuarioFactory::createOne([
            'username' => 'pepe',
            'password' => $this->passwordHasher->hashPassword(
                new Usuario(),
                'madrid'
            ),
            'conserje' => true
        ]);

        $docentePass = $this->passwordHasher->hashPassword(
            new Usuario(),
            'docente'
        );

        foreach ($cursosAcademicos as $cursoAcademico) {
            GrupoFactory::createMany(8, function () use ($cursoAcademico, $docentePass) {
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
                    'docentes' => UsuarioFactory::createMany(2, function () use ($docentePass) {
                        return [
                            'docente' => true,
                            'password' => $docentePass
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

        RegistroFactory::createMany(5, function () use ($motivos, $hora){
            $minutos_aleatorios = rand(5, 30);
            $numMotivos = rand(1, count($motivos));
            $motivosAleatorios = MotivoFactory::randomRange(1, $numMotivos);
            $horaEntrada = (clone $hora)->modify("+$minutos_aleatorios minutes");
            return [
                'horaSalida' => $hora,
                'horaEntrada' => $horaEntrada,
                'responsable' => UsuarioFactory::random(['docente' => true]),
                'estudiante' => EstudianteFactory::random(),
                'motivos' => $motivosAleatorios,
                'llave' => RegistroFactory::faker()->boolean(50) ? null : LlaveFactory::createOne([
                    'descripcion' => $motivosAleatorios[array_rand($motivosAleatorios)]->getDescripcion(),
                    'horaDejada' => $hora,
                    'horaDevuelta' => $horaEntrada
                ])
            ];
        });

        $manager->flush();
    }
}
