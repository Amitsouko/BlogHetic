<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
/**
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * @Route("/create-article", name="create_article")
     * @Template("AppBundle:User:create_article.html.twig")
     */
    public function createArticleAction(Request $request)
    {
        $article = new Article();

        $form = $this->createForm('AppBundle\Form\ArticleType', $article);
        $form->add('save', "submit", array(
                'attr' => array('class' => 'save'),
            ));
        $form->remove("owner");
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $article->setOwner($user);
            $em->persist($article);
            $em->flush();

            return $this->redirect($this->generateUrl("article", array("id" => $article->getId())));

        }

        return array("form" => $form->createView());
    }

    /**
     * @Route("/edit-article/{id}", name="edit_article")
     * @Template("AppBundle:User:create_article.html.twig")
     */
    public function editArticleAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository("AppBundle\Entity\Article")->findOneById($id);

        if(!$article) throw $this->createNotFoundException("L'article n'existe pas");

        if($article->getOwner() != $this->getUser()) throw $this->createAccessDeniedException("Cet article ne vous appartient pas.");

        $form = $this->createForm('AppBundle\Form\ArticleType', $article);
        $form->add('save', "submit", array(
                'attr' => array('class' => 'save'),
            ));
        $form->remove("owner");
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($article);
            $em->flush();

            return $this->redirect($this->generateUrl("article", array("id" => $article->getId())));

        }

        return array("form" => $form->createView());
    }

}
