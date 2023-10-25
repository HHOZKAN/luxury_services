<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\Media;
use App\Entity\User;
use App\Form\CandidatType;
use App\Repository\CandidatRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

#[Route('/candidat')]
class CandidatController extends AbstractController
{
    #[Route('/', name: 'app_candidat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {

        $candidat = new Candidat();


        /**
         **@var User $user
         */

        $user = $this->getUser();
        $candidat = $user->getCandidat();

        $form = $this->createForm(CandidatType::class, $candidat);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {


            $allConditionsMet = true;
            
            if ($form['profil_picture']->getData()) {
                /**
                 **@var UploadedFile $profilPictureFile 
                 */
                $profilPictureFile = $form['profil_picture']->getData();
                $profilPictureName = Uuid::v7();

                $extension = $profilPictureFile->guessExtension();
                if (!$extension) {
                    $extension = 'png';
                }

                $profilPictureName = $profilPictureName . '.' . $extension;

                $profilPictureFile->move('media/profilPictures', $profilPictureName);

                $profilPictureMedia = new Media();
                $profilPictureMedia->setUrl($profilPictureName);
                $profilPictureMedia->setOriginalName($profilPictureFile->getClientOriginalName());

                $entityManager->persist($profilPictureMedia);

                $candidat->setProfilPicture($profilPictureMedia);
                $entityManager->persist($candidat);

            } else {
                $allConditionsMet = false;
            }


            if ($form['cv']->getData()) {
                /**
                 **@var UploadedFile $cvPictureFile 
                 */
                $cvPictureFile = $form['cv']->getData();
                $cvPictureName = Uuid::v7();

                $extension = $cvPictureFile->guessExtension();
                if (!$extension) {
                    $extension = 'png';
                }

                $cvPictureName = $cvPictureName . '.' . $extension;

                $cvPictureFile->move('media/cvPictures', $cvPictureName);

                $cvPictureMedia = new Media();
                $cvPictureMedia->setUrl($cvPictureName);
                $cvPictureMedia->setOriginalName($cvPictureFile->getClientOriginalName());

                $entityManager->persist($cvPictureMedia);

                $candidat->setCv($cvPictureMedia);
                $entityManager->persist($candidat);

            } else {
                $allConditionsMet = false; // Si cette condition n'est pas remplie, définissez la variable à false
            }


            if ($form['passport']->getData()) {
                /**
                 **@var UploadedFile $passportPictureFile
                 */
                $passportPictureFile = $form['passport']->getData();

                $passportPictureName = Uuid::v7();

                $extension = $passportPictureFile->guessExtension();
                if (!$extension) {
                    $extension = 'png';
                }

                $passportPictureName = $passportPictureName . '.' . $extension;

                $passportPictureFile->move('media/passportPictures', $passportPictureName);

                $passportPictureMedia = new Media();
                $passportPictureMedia->setUrl($passportPictureName);
                $passportPictureMedia->setOriginalName($passportPictureFile->getClientOriginalName());

                $entityManager->persist($passportPictureMedia);

                $candidat->setPassport($passportPictureMedia);
                $entityManager->persist($candidat);

            } else {
                $allConditionsMet = false; // Si cette condition n'est pas remplie, définissez la variable à false
            }


            // if ($allConditionsMet) {
            //     // $user->setRoles(['ROLE_CANDIDAT']);
            //     // $entityManager->persist($user);
            // }
            $entityManager->flush();

            return $this->redirectToRoute('app_candidat_new');
        }

        return $this->render('candidat/new.html.twig', [
            'candidat' => $candidat,
            'form' => $form,
        ]);
    }
}
