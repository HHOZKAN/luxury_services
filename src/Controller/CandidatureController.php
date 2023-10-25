<?php

namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Entity\Candidature;
use App\Entity\Emploi;
use App\Form\CandidatureType;
use App\Repository\CandidatureRepository;
use App\Repository\EmploiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



#[Route('/candidature')]

class CandidatureController extends AbstractController
{
    #[Route('/', name: 'app_candidature')]
    public function select(EmploiRepository $emploiRepository): Response
    {
        $emplois = $emploiRepository->findAll();

        return $this->render('candidature/index.html.twig', [
            'emplois' => $emplois,
        ]);
        
    }

    #[Route('/detail/{id}', name: 'app_candidature_detail', methods: ['GET', 'POST'])]
    public function details(Emploi $emploi): Response
    {

        return $this->render('candidature/detail.html.twig', [
            'emploi' => $emploi,
        ]);
    }




    #[Route('/{id}', name: 'app_candidature_apply', methods: ['GET', 'POST'])]
    public function apply(CandidatureRepository $candidatureRepository ,EmploiRepository $emploiRepository, Request $request, Emploi $emploi, EntityManagerInterface $entityManager ): Response
    {

        
        /**
         **@var User $user
         */

        $user = $this->getUser();

        $candidature = $candidatureRepository->findOneBy([
            'emploi' => $emploi,
        ]);

        if($candidature == null) {

            $candidat = $user->getCandidat();

            $candidature = new Candidature();
            $candidature->setEmploi($emploi);
            $candidature->setCandidat($candidat);

        $form = $this->createForm(CandidatureType::class, $candidature);
        $form->handleRequest($request);
        $entityManager->persist($candidature);
        $entityManager->flush();
    

            return $this->render('candidature/detail.html.twig', [
                'candidature' => $candidature,
                'emploi' => $emploi,
                'candidat' => $candidat,
            ]);

        } else {
                return $this->render('candidature/detail.html.twig', [
                    'emploi' => $emploiRepository->findAll()
                ]);
            }
        }
    
        // En cas d'erreur, retournez à la page du formulaire

}

