<?php

namespace App\Controller;

use App\Form\ArgonautUpdateType;
use App\Form\UpdateProfilFormType;
use App\Repository\ArgonautsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArgaunotController extends AbstractController
{
    /**
     * @Route("/argaunot/{id}", name="argaunot")
     */
    public function detail( int $id,
                            ArgonautsRepository $argonautsRepository
    ): Response
    {
        $argonaut = $argonautsRepository->find($id);

        return $this->render('argaunot/index.html.twig', [
            'argonaut' => $argonaut,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete( int $id,
                            ArgonautsRepository $argonautsRepository,
                            EntityManagerInterface $entityManager
    ): Response
    {
        $argonaut = $argonautsRepository->find($id);

        $entityManager->remove($argonaut);
        $entityManager->flush();
        $this->addFlash('success', 'Argonaute supprimé');


        return $this->redirectToRoute('main_home');
    }

    /**
     * @Route("/update/{id}", name="update")
     */
    public function update( int $id,
                            Request $request,
                            ArgonautsRepository $argonautsRepository,
                            EntityManagerInterface $entityManager
    ): Response
    {
        $argonaut = $argonautsRepository->find($id);

        //on génére le form de modification
        $form = $this->createForm(ArgonautUpdateType::class, $argonaut);

        $form->handleRequest($request);

        $entityManager->persist($argonaut);
        $entityManager->flush();

        if ( $form->isSubmitted() && $form->isValid())
        {
            $this->addFlash('success','profil modifié');
            return $this->redirectToRoute('main_home');
        }


        return $this->render('argaunot/update.html.twig', [
            "updateForm" => $form->createView()
        ]);
    }

}


