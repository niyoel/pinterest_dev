<?php

namespace App\Controller;
use App\Entity\Pin;
use App\Repository\PinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class PinController extends AbstractController
{
     #[Route('/', name: 'app_home')]
     public function index(ManagerRegistry $doctrine, PinRepository $repo): Response
     {
         $pin = new Pin;
         $pin->setTitle("Pin ");
         $pin->setDescription("Description Pin ");
         
         $pin1 = new Pin;
         $pin1->setTitle("Pin 2");
         $pin1->setDescription("Description Pin 2");
        
         $pin2 = new Pin;
         $pin2->setTitle("Pin 2");
         $pin2->setDescription("Description Pin 2");
         

         $pin3 = new Pin;
         $pin3->setTitle("Pin 3");
         $pin3->setDescription("Description Pin 13");

         $pin4 = new Pin;
         $pin4->setTitle("Pin 4");
         $pin4->setDescription("Description Pin 4");

         $em = $doctrine->getManager();
         $em->persist($pin);
         $em->persist($pin1);
         $em->persist($pin2);
         $em->persist($pin3);
         $em->persist($pin4);

         $em->flush(); 
        
         
         return $this->render('pin/index.html.twig', ['pins' => $repo->findAll()]);
     }
}
