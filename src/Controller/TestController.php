<?php


namespace App\Controller;


use App\Repository\CategorieRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{

    /**
     * @Route("/test1",name="test1")
     */
    public function index(){
        return $this->render("bazz.html.twig");
    }

    /**
     * @Route("/test22",name="test2")
     */
    public function index22(){
        return $this->render("test2.html.twig");
    }

    /**
     * @Route("/test5",name="test5")
     */
    public function indexTest5(){
        return $this->render("publicationsU/allPub.html.twig");
    }
}
