<?php

namespace Blog\RunBlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Blog\RunBlogBundle\Entity\User;
use Blog\RunBlogBundle\Entity\Article;
use Blog\RunBlogBundle\Entity\Commentaire;
use Blog\RunBlogBundle\Form\CommentaireType;
use Blog\RunBlogBundle\Entity\Avis;

/**
 * Commentaire controller.
 *
 * @Route("/commentaire")
 */
class CommentaireController extends Controller
{
    /**
     * Lists all Commentaire entities.
     *
     * @Route("/", name="commentaire_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('BlogRunBlogBundle:Default:index.html.twig');
        /*$em = $this->getDoctrine()->getManager();

        $commentaires = $em->getRepository('BlogRunBlogBundle:Commentaire')->findAll();

        return $this->render('commentaire/index.html.twig', array(
            'commentaires' => $commentaires,
        ));*/
    }

    /**
     * Creates a new Commentaire entity.
     *
     * @Route("{id}/new", name="commentaire_new")
     * @Method({"GET", "POST"})
     */
    public function newAction($id, Request $request)
    {
        $commentaire = new Commentaire();
        $form = $this->createForm('Blog\RunBlogBundle\Form\CommentaireType', $commentaire);
        $form->handleRequest($request);
        $user = $this->getUser();
        $user->getId();
        $commentaire->setUtilisateur($user)
                    ->setDate(date("d-m-Y"))
                    ->setArticle($article);
        $article= $this->getDoctrine()->getRepository(Article::class)->find($id);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaire);
            $em->flush();
            return $this->redirectToRoute('commentaire_show', array('id' => $commentaire->getId()));
        }

        return $this->render('commentaire/new.html.twig', array(
            'commentaire' => $commentaire,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Commentaire entity.
     *
     * @Route("/{id}", name="commentaire_show")
     * @Method("GET")
     */
    public function showAction(Commentaire $commentaire)
    {
        $deleteForm = $this->createDeleteForm($commentaire);

        return $this->render('commentaire/show.html.twig', array(
            'commentaire' => $commentaire,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Commentaire entity.
     *
     * @Route("/{id}/edit", name="commentaire_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Commentaire $commentaire)
    {
        $deleteForm = $this->createDeleteForm($commentaire);
        $editForm = $this->createForm('Blog\RunBlogBundle\Form\CommentaireType', $commentaire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaire);
            $em->flush();

            return $this->redirectToRoute('commentaire_edit', array('id' => $commentaire->getId()));
        }

        return $this->render('commentaire/edit.html.twig', array(
            'commentaire' => $commentaire,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     *
     * @Route("/{id}/liste", name="commentaire_user")
     * @Method({"GET","POST"})
     */

     public function CommentAction(Commentaire $commentaire){

       $utilisateur = $this->getUser();
       $utilisateur->getId();
       $commentaire = $this->getDoctrine()->getRepository(Commentaire::class)->findBy(['utilisateur'=>$utilisateur]);
       return $this->render('article/articlecommentaire.html.twig', array(
            'commentaires' => $commentaire,
        ));
     }

     /**
      *
      * @Route("/user/", name="commentaire_like")
      * @Method({"GET","POST"})
      */

      public function avisAction(){
        $utilisateur = $this->getUser();
        $utilisateur->getId();
        $avis = new Avis();
        $commentaire = new Commentaire();
        $avis = $this->getDoctrine()->getRepository(Avis::class)->findBy(['reaction'=> 1,
                                                                         'utilisateur'=> $utilisateur]);
        return $this->render('commentaire/autrecommentaire.html.twig', array(
             'avis' => $avis,
         ));
      }

      /**
       *
       * @Route("/lesjaimes/", name="commentaire_aime")
       * @Method({"GET","POST"})
       */
       public function aimerAction(){
         $em = $this->getDoctrine()->getManager();

         $utilisateur = $this->getUser();
         $utilisateur->getId();
         $commentaire = $em->getRepository('BlogRunBlogBundle:Commentaire')
                           ->findby(array('utilisateur' => $utilisateur ));

         return $this->render('commentaire/cequiaime.html.twig', array(
               'commentaire' => $commentaire,
               'utilisateurs' => $utilisateur,
         ));

       }


    /**
     * Deletes a Commentaire entity.
     *
     * @Route("/{id}", name="commentaire_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Commentaire $commentaire)
    {
        $form = $this->createDeleteForm($commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($commentaire);
            $em->flush();
        }

        return $this->redirectToRoute('commentaire_index');
    }

    /**
     * Creates a form to delete a Commentaire entity.
     *
     * @param Commentaire $commentaire The Commentaire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Commentaire $commentaire)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('commentaire_delete', array('id' => $commentaire->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
