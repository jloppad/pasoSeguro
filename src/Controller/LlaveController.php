<?php

namespace App\Controller;

use App\Entity\Llave;
use App\Repository\LlaveRepository;
use App\Repository\RegistroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LlaveController extends AbstractController
{
    #[Route('/llave/toggle', name: 'llave_toggle')]
    public function toggleLlave(Request $request, RegistroRepository $registroRepository, LlaveRepository $llaveRepository, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $studentId = $data['studentId'];
        $groupId = $data['groupId'];
        $descripcion = $data['descripcion'];
        $isChecked = $data['isChecked'];

        $registro = $registroRepository->findOneBy(['estudiante' => $studentId, 'grupo' => $groupId, 'horaEntrada' => null]);

        if (!$registro) {
            return new JsonResponse(['success' => false, 'message' => 'Registro no encontrado'], 404);
        }

        if ($isChecked) {

            $llave = new Llave();
            $llave->setDescripcion($descripcion);
            $llave->setHoraDejada(new \DateTime());

            $registro->setLlave($llave);

            $em->persist($llave);
            $em->persist($registro);
            $em->flush();

            return new JsonResponse(['success' => true, 'horaDejada' => $llave->getHoraDejada()->format('H:i:s')]);
        } else {
            // Solo actualizar horaDevuelta
            $llave = $registro->getLlave();
            if ($llave) {
                $llave->setHoraDevuelta(new \DateTime());
                $em->persist($llave);
                $em->flush();

                return new JsonResponse(['success' => true, 'horaDevuelta' => $llave->getHoraDevuelta()->format('H:i:s')]);
            }

            return new JsonResponse(['success' => false, 'message' => 'Llave no encontrada'], 404);
        }
    }
}
