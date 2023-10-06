<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\User;
use App\Form\RegistrationFormType;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, MailerInterface  $mailer): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $candidat = new Candidat();
            $candidat->setUser($user);
            
            $candidat->setDateCreate(new DateTimeImmutable());
            $candidat->setDateUptaded(new DateTimeImmutable());


            $entityManager->persist($user);
            $entityManager->persist($candidat);
            $entityManager->flush();
            // do anything else you need here, like send an email
            $email = (new Email())
                ->from('contact@luxury_services.com')
                ->to($user->getEmail())
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Welcome abroad !')
                // ->text('Sending emails is fun again!')
                ->html('
                <h2> Bravo, ton compte a été crée ! </h2>
                <p>Nous t\'accueillons avec plaisir a bord de ce yatch !</p>
                ');

            $mailer->send($email);
            return $this->redirectToRoute('app_login');
        }

        return $this->render('auth/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
