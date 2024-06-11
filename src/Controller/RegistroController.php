<?php

namespace App\Controller;

namespace App\Controller;

use App\Entity\Registro;
use App\Repository\EstudianteRepository;
use App\Repository\MotivoRepository;
use App\Repository\RegistroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RegistroController extends AbstractController
{
    #[Route('/registro/update', name: 'registro_update')]
    public function updateRegistro(Request $request, EstudianteRepository $estudianteRepository, MotivoRepository $motivoRepository, RegistroRepository $registroRepository, EntityManagerInterface $em): JsonResponse
    {
        // Decodifica el contenido JSON de la solicitud en un array asociativo
        $data = json_decode($request->getContent(), true);
        $studentId = $data['studentId'];
        $motivoName = $data['motivo'];
        $isChecked = $data['isChecked'];

        // Busca el estudiante y el motivo en la base de datos
        $estudiante = $estudianteRepository->find($studentId);
        $motivo = $motivoRepository->findOneBy(['descripcion' => $motivoName]);
        $user = $this->getUser();

        // Si no se encuentra el estudiante o el motivo, retorna un error
        if (!$estudiante || !$motivo) {
            return new JsonResponse(['success' => false], 400);
        }

        // Busca un registro activo para el estudiante (sin hora de entrada registrada)
        $registro = $registroRepository->findOneBy(['estudiante' => $estudiante, 'horaEntrada' => null]);

        if ($isChecked) {
            // Si el checkbox está marcado y no hay registro existente, crea uno nuevo
            if (!$registro) {
                $registro = new Registro();
                $registro->setEstudiante($estudiante)
                    ->setHoraSalida(new \DateTime()) // Asigna la hora de salida actual
                    ->setResponsable($user); // Asigna el usuario responsable
            }
            $registro->addMotivo($motivo); // Asocia el motivo al registro
        } else {
            if ($registro) {
                // Si se ha proporcionado la lista de checkboxes
                if (isset($data['allCheckboxes'])) {
                    $allCheckboxes = $data['allCheckboxes'];

                    // Verifica si todos los checkboxes están desmarcados
                    $allUnchecked = array_reduce($allCheckboxes, function($carry, $checkbox) {
                        return $carry && !$checkbox['checked'];
                    }, true);

                    // Si todos los checkboxes están desmarcados, registra la hora de entrada
                    if ($allUnchecked) {
                        $registro->setHoraEntrada(new \DateTime());
                    }
                }
            }
        }

        $em->persist($registro);
        $em->flush();

        return new JsonResponse(['success' => true]);
    }


    #[Route('/registro/update_all', name: 'registro_update_all')]
    public function updateAllRegistros(RegistroRepository $registroRepository, EntityManagerInterface $em): JsonResponse
    {
        $user = $this->getUser();
        $activeRegistros = $registroRepository->findBy(['responsable' => $user, 'horaEntrada' => null]);

        foreach ($activeRegistros as $registro) {
            $registro->setHoraEntrada(new \DateTime());
            $em->persist($registro);
        }

        $em->flush();

        return new JsonResponse(['success' => true]);
    }
}
