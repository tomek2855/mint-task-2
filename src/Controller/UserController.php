<?php

namespace App\Controller;

use App\Entity\User;
use App\Extensions\Paginator\Paginator;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"}, defaults={"page": 1})
     * @Route("/page/{page<[1-9]\d*>}", name="user_index_paginated", methods={"GET"})
     */
    public function index(int $page, UserRepository $userRepository, Paginator $paginator): Response
    {
        $paginator->setPage($page);

        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAllPaginated($paginator),
            'paginator' => $paginator
        ]);
    }

    /**
     * @Route("/{id}/disable", name="user_disable", methods={"GET","POST"})
     */
    public function disable(Request $request, User $user)
    {
        if (!$user->getDisabled())
        {
            $user->setDisabled(true);

            $this->getDoctrine()->getManager()->flush();
        }

        if ($this->getUser() === $user)
        {
            $session = new Session();
            $session->invalidate();
        }

        $page = $request->query->get('page', 1);

        return $this->redirectToRoute('user_index_paginated', ['page' => $page]);
    }
}
