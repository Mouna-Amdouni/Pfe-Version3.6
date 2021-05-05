<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/a", name="indexx")
     */
    public function indexx(): Response
    {
        return $this->render('admin/main.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
