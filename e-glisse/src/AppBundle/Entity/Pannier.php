<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pannier
 *
 * @ORM\Table(name="pannier")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PannierRepository")
 */
class Pannier
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
     * @var int
     *
     * @ORM\Column(name="buyer", type="integer", nullable=true)
     */
    private $buyer;

    /**
     * @var array
     *
     * @ORM\Column(name="indent", type="array")
     */
    private $indent;

    public function __construct($indent, $buyer = 1)
    {
        $this->buyer = $buyer;
        $this->indent = $indent;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set buyer
     *
     * @param integer $buyer
     *
     * @return Pannier
     */
    public function setBuyer($buyer)
    {
        $this->buyer = $buyer;

        return $this;
    }

    /**
     * Get buyer
     *
     * @return int
     */
    public function getBuyer()
    {
        return $this->buyer;
    }

    /**
     * Set indent
     *
     * @param array $indent
     *
     * @return Pannier
     */
    public function setIndent($indent)
    {
        $this->indent = $indent;

        return $this;
    }

    /**
     * Get indent
     *
     * @return array
     */
    public function getIndent()
    {
        return $this->indent;
    }
}

