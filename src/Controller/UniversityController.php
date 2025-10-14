<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UniversityController extends AbstractController
{
    #[Route('/university/getall', name: 'app_university')]
    public function index(): Response
    {
        return $this->render('university/index.html.twig', [
            'n' => '3A21',
        ]);
    }
    #[Route('/university/adduniversity', name: 'addU')]

    public function addUnivercity(): Response
    {
        return New Response("added successfulyyyyyyyyyy!!!!");
    }
     #[Route('/university/{name}', name: 'getU')]

    public function getUnivercityByName($name): Response
    {
        return New Response("get successfulyyyyyyyyyy!!!!".$name);
    }
}
