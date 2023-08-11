<?php

namespace App\Controller;

use App\Form\SetupType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/setup', name: 'app_user_setup')]
    public function setup(Request $request): Response
    {
        $form = $this->createForm(SetupType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // persist and add the role ROLE_SETUP_OK to the user
            // @todo
        }

        return $this->render('user/setup.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
