<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\AuthorRepository;
use  Doctrine\Persistence\ManagerRegistry;
use App\Entity\Author;
final class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

        #[Route('/get', name: 'get_author')]
    public function getAllAuthors(AuthorRepository $autherRepo): Response
    {
       $auhtors= $autherRepo->findAll();

        return $this->render('author/index.html.twig', [
            'authors' => $auhtors,
        ]);
    }

      #[Route('/add', name: 'add_author')]
    public function addAuthor( ManagerRegistry $em): Response
    {  $author1 = new Author();
        $author1->setUsername('foulen');
        $author1->setEmail('foulen@esprit.tn');

         $author2 = new Author();
        $author2->setUsername('foulen2');
        $author2->setEmail('foulen2@esprit.tn');

        $em->getManager()->persist($author1);
        $em->getManager()->persist($author2);
        $em->getManager()->flush();
        
       return new Response('author added');
    }
    
      #[Route('/delete/{a}', name: 'delete')]
    public function deleteAuthor($a, AuthorRepository $autherRepo,ManagerRegistry $em): Response
    {    
        $author=$autherRepo->find($a);
        $em->getManager()->remove($author);
        $em->getManager()->flush();
        return new Response('author deleted');
    }
}
