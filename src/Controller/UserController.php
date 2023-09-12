<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SetupType;
use App\Service\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/setup', name: 'app_user_setup')]
    public function setup(Request $request, EntityManagerInterface $entityManager, UserService $userService, TokenStorageInterface $tokenStorage): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $form = $this->createForm(SetupType::class, $userService->setupUserDefaultWallets($user));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$user->getWallets()->isEmpty()) {
                $user->addRole('ROLE_SETUP_OK');
                $entityManager->flush();

                // We have to re-authenticate the user after updating the roles, otherwise the user will be logged out.
                $token = new UsernamePasswordToken($user, 'main', $user->getRoles());
                $tokenStorage->setToken($token);

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
