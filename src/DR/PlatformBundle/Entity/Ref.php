<?php

namespace DR\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ref
 *
 * @ORM\Table(name="ref")
 * @ORM\Entity(repositoryClass="DR\PlatformBundle\Repository\RefRepository")
 */
class Ref
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
    * @ORM\ManyToOne(targetEntity="DR\PlatformBundle\Entity\Folder", inversedBy="refs")
    */
    private $folder;


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
     * @return Ref
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
     * Set folder
     *
     * @param \DR\PlatformBundle\Entity\Folder $folder
     * @return Ref
     */
    public function setFolder(\DR\PlatformBundle\Entity\Folder $folder)
    {
        $this->folder = $folder;

        return $this;
    }

    /**
     * Get folder
     *
     * @return \DR\PlatformBundle\Entity\Folder 
     */
    public function getFolder()
    {
        return $this->folder;
    }
}
