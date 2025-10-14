<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

    // #[Route('/student')]
final class StudentController extends AbstractController
{
    #[Route('/student/getAll', name: 'app_student')]
    public function index(): Response
    {   $s1 = 9;
        $rating =[1,2,3];
        return $this->render('student/index.html.twig', [
            'class' => '3A22',
            'ons' => $s1, 
            'rate' => $rating

        ]);
    }
   
    #[Route('/student/addStudent', name: 'addStudent')]
    public function addStudent():Response
    {
        return new Response("Student added successfullyyyyyyy!!!");
    }
       #[Route('/student/{name}', name: 'getStudent')]
    public function GetStudentByName($name):Response
    {
     return new Response("Student:". $name);
    }
}
