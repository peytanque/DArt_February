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
     * @ORM\Column(name="ref", type="string", length=255, unique=true)
     */
    private $ref;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true, unique=true)
     */
    private $name;

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
     * Set ref
     *
     * @param string $ref
     * @return Folder
     */
    public function setRef($ref)
    {
        $this->ref = $ref;

        return $this;
    }

    /**
     * Get ref
     *
     * @return string 
     */
    public function getRef()
    {
        return $this->ref;
    }
}
