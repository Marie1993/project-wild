<?php


namespace App\Controller;


use App\Entity\Argonauts;
use App\Form\ArgonautsType;
use App\Repository\ArgonautsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    /**
     * @Route("/", name="main_home")
     */
    public function home(   ArgonautsRepository $argonautsRepository,
                            Request $request,
                            EntityManagerInterface $entityManager): \Symfony\Component\HttpFoundation\Response
    {

        $argonaut = new Argonauts();
        $argonaut->setDateCreated(new \DateTime());
        $argonautForm = $this->createForm(ArgonautsType::class, $argonaut);

        //traitement du formulaire
        $argonautForm->handleRequest($request);

        if($argonautForm->isSubmitted()){
            $entityManager->persist($argonaut);
            $entityManager->flush();

            $this->addFlash('succes','Bienvenue parmis nous ');
        }

        //affichage de la liste des argonauts
        $argonauts = $argonautsRepository->findAll();

        return $this->render('main/home.html.twig', [
            "argonaut" => $argonaut,
            "argonauts" => $argonauts,
            'argonautForm' => $argonautForm->createView()
        ]);
    }



}