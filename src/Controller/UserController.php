<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    private $security;
    public function __construct(Security $security)
     {
         $this->security = $security;
     }

    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        if(!$this->security->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('user/index.html.twig', [
            'user' => $this->security->getUser()
        ]);
    }
}
