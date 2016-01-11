<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return array();
    }

    /**
     * @Route("/contact", name="contact")
     * @Template()
     */
    public function contactAction()
    {
        return array();
    }

    /**
     * @Route("/articles", name="articles")
     * @Template()
     */
    public function articlesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository("AppBundle\Entity\Article")->findBy(
                array(),
                array("id" => 'DESC'),
                10,
                0
            );

        return array("articles" => $articles);
    }

    /**
     * @Route("/article/{id}", name="article")
     * @Template()
     */
    public function articleAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository("AppBundle\Entity\Article")->findOneById($id);

        if(!$article) throw $this->createNotFoundException("L'article n'existe pas");


        return array("article" => $article);
    }



    /**
     * @Template("AppBundle:Render:register.html.twig")
     */
    public function renderRegisterAction()
    {
        // replace this example code with whatever you need
        return array();
    }
}
