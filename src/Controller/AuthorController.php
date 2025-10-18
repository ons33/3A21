<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\AuthorRepository;
use  Doctrine\Persistence\ManagerRegistry;
use App\Entity\Author;
use App\Form\AuthorType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
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
    public function addAuthor( ManagerRegistry $em, Request $request): Response
    {  $author1 = new Author();
       $form = $this->createForm(AuthorType::class, $author1);
       $form->handleRequest($request);

         if ($form->isSubmitted() ) {

        $em->getManager()->persist($author1);
        $em->getManager()->flush();
        
       return $this->redirectToRoute('get_author');
         }

        return $this->render('author/form.html.twig', [
            'f' => $form->createView(),
        ]);
       
    }
    
      #[Route('/delete/{id}', name: 'app_author_delete')]
    public function deleteAuthor($id, AuthorRepository $autherRepo,ManagerRegistry $em): Response
    {    
        $author=$autherRepo->find($id);
        $em->getManager()->remove($author);
        $em->getManager()->flush();
      return $this->redirectToRoute('get_author');
    }
        #[Route('/updateAuth/{id}',name:'app_author_update')]
    public function updateAuthor(Request $req,EntityManagerInterface $em,Author $author
    ,AuthorRepository $repo){
        //$author = $repo->find($id);
        $form = $this->createForm(AuthorType::class,$author);
        $form->handleRequest($req);
        if($form->isSubmitted())
        {
        $em->flush();
        return $this->redirectToRoute('get_author');
        }
       // $author->setName("author 1");
        //$author->setEmail("author1@gmail.com");

        return $this->render('author/form.html.twig',[
            'f'=>$form->createView()
        ]);
    }
}
