<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seccion
 *
 * @ORM\Table(name="seccion")
 * @ORM\Entity
 */
class Seccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idSeccion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idseccion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreSeccion", type="string", length=1, nullable=false)
     */
    private $nombreseccion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Nivel", mappedBy="seccionseccion")
     */
    private $nivelnivel;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->nivelnivel = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

