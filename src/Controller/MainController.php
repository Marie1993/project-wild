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
        $argonautForm = $this->createForm(ArgonautsType::class, $argonaut);

        //traiter form
        $argonautForm->handleRequest($request);

        if($argonautForm->isSubmitted()){
            $entityManager->persist($argonaut);
            $entityManager->flush();

            $this->addFlash('succes','Bienvenue !');
        }

        //affichage  liste des argonauts
        $argonauts = $argonautsRepository->findAll();

        return $this->render('main/home.html.twig', [
            "argonauts" => $argonauts,
            'argonautForm' => $argonautForm->createView()
        ]);
    }



}