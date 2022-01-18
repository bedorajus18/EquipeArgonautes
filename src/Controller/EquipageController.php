<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Equipage;
use App\Repository\EquipageRepository;
use App\Form\EquipageType; 

class EquipageController extends AbstractController
{
    /**
     * @Route("/equipage", name="creer_equipage")
     */
    public function create(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $formEquipage = new Equipage();
        $form = $this->createForm(EquipageType::class, $formEquipage);
        // Je récupère la liste des equipages
        $equipages = $this->getDoctrine()->getRepository(Equipage::class)->findAll();
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->persist($formEquipage);
            $em->flush();
        }
        return $this->render('equipage/index.html.twig', [
            'formEquipage' => $form->createView(),
            // J'affiche la liste quoi qu'il arrive
            'equipages' =>$equipages
        ]);
    }
          
}
