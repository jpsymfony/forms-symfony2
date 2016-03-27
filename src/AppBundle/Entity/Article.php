<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity
 */
class Article
{
    const FILES_LIMIT = 3;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var text
     *
     * @ORM\Column(name="body", type="text", length=255)
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="tags", type="string", length=255)
     */
    private $tags;

    /**
     * @ORM\Column(name="publication_date", type="date", length=255, nullable = true)
     */
    private $publicationDate;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\File", mappedBy="article", cascade={ "persist" })
     */
    private $files;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Author", mappedBy="article", cascade={ "persist" }, orphanRemoval=true)
     */
    private $authors;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->files = new ArrayCollection();
        $this->authors = new ArrayCollection();
    }

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
     * Set title
     *
     * @param string $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Article
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set tags
     *
     * @param string $tags
     * @return Article
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return string 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set publicationDate
     *
     * @param \DateTime $publicationDate
     * @return Article
     */
    public function setPublicationDate($publicationDate)
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    /**
     * Get publicationDate
     *
     * @return \DateTime 
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * Add file
     *
     * @param \AppBundle\Entity\File $file
     * @return Article
     */
    public function addFile(File $file)
    {
        if (!$this->files->contains($file)) {
            $this->files->add($file);
            $file->setArticle($this);
        }

        return $this;
    }

    /**
     * Remove files
     *
     * @param \AppBundle\Entity\File $file
     */
    public function removeFile(File $file)
    {
        if ($this->files->contains($file)) {
            $this->files->removeElement($file);
        }
    }

    /**
     * Get files
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * Add authors
     *
     * @param \AppBundle\Entity\Author $author
     * @return Article
     */
    public function addAuthor(Author $author)
    {
        if (!$this->authors->contains($author)) {
            $this->authors->add($author);
            $author->setArticle($this);
        }

        return $this;
    }

    /**
     * Remove authors
     *
     * @param \AppBundle\Entity\Author $author
     */
    public function removeAuthor(Author $author)
    {
        if ($this->authors->contains($author)) {
            $this->authors->removeElement($author);
        }
    }


    /**
     * Get authors
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAuthors()
    {
        return $this->authors;
    }
}
