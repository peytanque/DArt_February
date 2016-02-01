<?php

namespace DR\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Folder
 *
 * @ORM\Table(name="folder")
 * @ORM\Entity(repositoryClass="DR\PlatformBundle\Repository\FolderRepository")
 */
class Folder
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true, unique=true)
     */
    private $name;

    /**
    * @ORM\OneToMany(targetEntity="DR\PlatformBundle\Entity\Ref", mappedBy="folder")
    * @ORM\JoinColumn(nullable=false)
    * 
    */
    private $ref;


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
     * Set name
     *
     * @param string $name
     * @return Folder
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ref = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ref
     *
     * @param \DR\PlatformBundle\Entity\Ref $ref
     * @return Folder
     */
    public function addRef(\DR\PlatformBundle\Entity\Ref $ref)
    {
        $this->ref[] = $ref;

        return $this;
    }

    /**
     * Remove ref
     *
     * @param \DR\PlatformBundle\Entity\Ref $ref
     */
    public function removeRef(\DR\PlatformBundle\Entity\Ref $ref)
    {
        $this->ref->removeElement($ref);
    }

    /**
     * Get ref
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRef()
    {
        return $this->ref;
    }
}
