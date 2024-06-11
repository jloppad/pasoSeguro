<?php

namespace App\Controller;

use App\Entity\Estudiante;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;

class FotoController extends AbstractController
{
    // Implementacion: src="{{ path('foto_estudiante', {'id': estudiante.id}) }}"
    #[Route('/foto/{id}', name: 'foto_estudiante')]
    public function getFotoAction(Estudiante $estudiante): StreamedResponse
    {
        $callback = function () use ($estudiante) {
            echo stream_get_contents($estudiante->getFoto());
        };
        $response = new StreamedResponse($callback);
        $response->headers->set('Content-Type', 'image/png');
        return $response;
    }

}