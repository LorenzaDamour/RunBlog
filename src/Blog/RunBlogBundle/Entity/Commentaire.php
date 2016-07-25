<?php

namespace Blog\RunBlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity(repositoryClass="Blog\RunBlogBundle\Repository\CommentaireRepository")
 */
class Commentaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text")
     */
    private $commentaire;

    /**
     * @var int
     *
     * @ORM\Column(name="nombreDeJaime", type="integer")
     */
    private $nombreDeJaime;

    /**
    * @ORM\ManyToOne(targetEntity="Utilisateur", inversedBy="commentaire")
    * @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id")
    */
    private $utilisateur;

    /**
    * @ORM\ManyToOne(targetEntity="Article", inversedBy="commentaire")
    * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
    */
    protected $article;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Commentaire
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set nombreDeJaime
     *
     * @param integer $nombreDeJaime
     *
     * @return Commentaire
     */
    public function setNombreDeJaime($nombreDeJaime)
    {
        $this->nombreDeJaime = $nombreDeJaime;

        return $this;
    }

    /**
     * Get nombreDeJaime
     *
     * @return integer
     */
    public function getNombreDeJaime()
    {
        return $this->nombreDeJaime;
    }

    /**
     * Set utilisateur
     *
     * @param \Blog\RunBlogBundle\Entity\Utilisateur $utilisateur
     *
     * @return Commentaire
     */
    public function setUtilisateur(\Blog\RunBlogBundle\Entity\Utilisateur $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \Blog\RunBlogBundle\Entity\Utilisateur
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set article
     *
     * @param \Blog\RunBlogBundle\Entity\Article $article
     *
     * @return Commentaire
     */
    public function setArticle(\Blog\RunBlogBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \Blog\RunBlogBundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }
}
