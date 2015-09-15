<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Modulo
 *
 * @ORM\Table(name="modulo")
 * @ORM\Entity
 */
class Modulo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idModulo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmodulo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreModulo", type="string", length=45, nullable=false)
     */
    private $nombremodulo;

    /**
     * @var integer
     *
     * @ORM\Column(name="duracion", type="integer", nullable=false)
     */
    private $duracion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaInicio", type="date", nullable=true)
     */
    private $fechainicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaFin", type="date", nullable=true)
     */
    private $fechafin;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Nivel", inversedBy="modulomodulo")
     * @ORM\JoinTable(name="modulo_has_nivel",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Modulo_idModulo", referencedColumnName="idModulo")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Nivel_idNivel", referencedColumnName="idNivel")
     *   }
     * )
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

