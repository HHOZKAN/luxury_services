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

         

            if ($form['profil_picture']->getData()) {
                /**
                 **@var UploadedFile $profilPictureFile 
                 */
                $profilPictureFile = $form['profil_picture']->getData();

                $profilPictureName = Uuid::v7();

                $extension = $profilPictureFile->guessExtension();
                if(!$extension) {
                    $extension ='png';
                }

                $profilPictureName = $profilPictureName . '.' .$extension;

                $profilPictureFile->move('media/profilPictures', $profilPictureName);

                $profilPictureMedia = new Media();
                $profilPictureMedia->setUrl($profilPictureName);
                $profilPictureMedia->setOriginalName($profilPictureFile->getClientOriginalName());

                $entityManager->persist($profilPictureMedia);

                $candidat->setProfilPicture($profilPictureMedia);
            }
            if ($form['profil_picture
            ']->getData()) {
                /**
                 **@var UploadedFile $profilPictureFile 
                 */
                $profilPictureFile = $form['profil_picture']->getData();

                $profilPictureName = Uuid::v7();

                $extension = $profilPictureFile->guessExtension();
                if(!$extension) {
                    $extension ='png';
                }

                $profilPictureName = $profilPictureName . '.' .$extension;

                $profilPictureFile->move('media/profilPictures', $profilPictureName);

                $profilPictureMedia = new Media();
                $profilPictureMedia->setUrl($profilPictureName);
                $profilPictureMedia->setOriginalName($profilPictureFile->getClientOriginalName());

                $entityManager->persist($profilPictureMedia);

                $candidat->setProfilPicture($profilPictureMedia);
            }
            if ($form['profil_picture']->getData()) {
                /**
                 **@var UploadedFile $profilPictureFile 
                 */
                $profilPictureFile = $form['profil_picture']->getData();

                $profilPictureName = Uuid::v7();

                $extension = $profilPictureFile->guessExtension();
                if(!$extension) {
                    $extension ='png';
                }

                $profilPictureName = $profilPictureName . '.' .$extension;

                $profilPictureFile->move('media/profilPictures', $profilPictureName);

                $profilPictureMedia = new Media();
                $profilPictureMedia->setUrl($profilPictureName);
                $profilPictureMedia->setOriginalName($profilPictureFile->getClientOriginalName());

                $entityManager->persist($profilPictureMedia);

                $candidat->setProfilPicture($profilPictureMedia);
            }
            $entityManager->persist($candidat);
            $entityManager->flush();

            return $this->redirectToRoute('app_candidat_new');
        }

        return $this->render('candidat/new.html.twig', [
            'candidat' => $candidat,
            'form' => $form,
        ]);
    }

}
