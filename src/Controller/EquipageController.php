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

use App\Entity\Equipage;
use App\Repository\EquipageRepository;
use App\Form\EquipageType; 

class EquipageController extends AbstractController
{
    /**
     * @Route("/equipage/new", name="equipage")
     */
    public function create(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $equipage = new Equipage();
        $form = $this->createForm(EquipageType::class, $equipage);
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->persist($equipage);
            $em->flush();
        }
        return $this->render('equipage/index.html.twig', [
            'formEquipage' => $form->createView(),
        ]);
    }

    /**
     * @Route("/equipage/read", name="read_equipage", methods="GET")
     */
    public function read(EquipageRepository $equipageRepository): Response
    {
        $membres = $equipageRepository->findAll();
        $json = json_encode($membres);
        $reponse = new Response($json, 200, [
        'content-type' => 'application/json'
        ]);
        return $reponse;
    }
}
