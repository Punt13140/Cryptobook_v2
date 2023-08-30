<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SetupType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/setup', name: 'app_user_setup')]
    public function setup(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SetupType::class, $this->getUser());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $newUser */
            $newUser = $form->getData();
            if (!$newUser->getWallets()->isEmpty()) {
                $newUser->addRole('ROLE_SETUP_OK');
                $entityManager->flush();
                return $this->redirectToRoute('app_welcome', [], Response::HTTP_SEE_OTHER);
            } else {
                $this->addFlash('warning', 'You must add at least one wallet.');
            }
        }

        return $this->render('user/setup.html.twig', [
            'form' => $form->createView(),
            'user' => $this->getUser(),
        ]);
    }
}
