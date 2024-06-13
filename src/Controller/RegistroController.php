<?php

namespace App\Controller;

use App\Entity\Registro;
use App\Repository\EstudianteRepository;
use App\Repository\GrupoRepository;
use App\Repository\MotivoRepository;
use App\Repository\RegistroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistroController extends AbstractController
{
    #[Route('/registro/update', name: 'registro_update')]
    public function updateRegistro(Request $request, EstudianteRepository $estudianteRepository, GrupoRepository $grupoRepository, MotivoRepository $motivoRepository, RegistroRepository $registroRepository, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $studentId = $data['studentId'];
        $groupId = $data['groupId'];
        $motivoName = $data['motivo'];
        $isChecked = $data['isChecked'];

        $estudiante = $estudianteRepository->find($studentId);
        $grupo = $grupoRepository->find($groupId);
        $motivo = $motivoRepository->findOneBy(['descripcion' => $motivoName]);
        $user = $this->getUser();

        if (!$estudiante || !$motivo || !$grupo) {
            return new JsonResponse(['success' => false], 400);
        }

        $registro = $registroRepository->findOneBy(['estudiante' => $estudiante, 'horaEntrada' => null]);

        if ($isChecked) {
            if (!$registro) {
                $registro = new Registro();
                $registro->setEstudiante($estudiante)
                    ->setHoraSalida(new \DateTime())
                    ->setResponsable($user)
                    ->setGrupo($grupo);
                $registro->addMotivo($motivo);
            } else {
                $registro->addMotivo($motivo);
            }

            $em->persist($registro);
            $em->flush();
        } else {
            if ($registro) {
                $allCheckboxes = $data['allCheckboxes'];
                $allUnchecked = array_reduce($allCheckboxes, function ($carry, $checkbox) {
                    return $carry && !$checkbox['checked'];
                }, true);

                if ($allUnchecked) {
                    $registro->setHoraEntrada(new \DateTime());
                    $em->persist($registro);
                    $em->flush();
                }
            }
        }

        $horaSalida = $registro && $registro->getHoraSalida() ? $registro->getHoraSalida()->format('H:i:s') : null;

        return new JsonResponse(['success' => true, 'horaSalida' => $horaSalida]);
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

    #[Route('/exterior/datos', name: 'exterior_datos')]
    public function exteriorDatos(RegistroRepository $registroRepository): Response
    {
        $registros = $registroRepository->findAllOut();
        return $this->render('listados/_registros.html.twig', [
            'registros' => $registros,
        ]);
    }
}
